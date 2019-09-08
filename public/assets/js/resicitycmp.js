$(document).ready(function(){
	//============================================deklarasi variabel
	var satuan = 'kg';
	var kotatujuan ='';
	var noresi;
	//=============================================ganti satuan	
	$('#satuan').on('change',function(e){
		satuan = this.value;
	})
	
	//=============================================cari kota tujuan
		$('#kota_tujuan').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/carikotacitycmd',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.id,
							text: item.tujuan
						}

					})
				}
			},
			cache: true
		}
	});
	//=================================================
	$('#kota_tujuan').on('select2:select',function(e){
		$('#panelnya').loading('toggle');
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasilkota/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan=='kg'){
								hitung(item.tarif,item.tujuan);
								
								kotatujuan = item.tujuan;	
							}else{
							
								kotatujuan = item.tujuan;
								$("#biaya_kirim").val(0);
								$("#b_kirim").html(0);
								hitung_total();
							}
					})
				}
			},complete:function(){
                $('#panelnya').loading('stop');
            }
            });
		});
	//============================================ fokus input pengirim 	
		$("#kota_tujuan").on('select2:close',function(e){
			$('#n_pengirim').focus();
		});
	
	//============================================ hitung estimasi tujuan
		function hitung(harga,tujuan){
			var berat = $("#berat").val();
			var volume = $("#volume").val();
			if(berat!='' && volume!=''){
				if(parseInt(berat) > parseInt(volume)){
					var jumlah = harga*berat;		
				}else{
					var jumlah = harga*volume;
				}
			
			$("#biaya_kirim").val(jumlah);
			$("#b_kirim").html(rupiah(jumlah));
			hitung_total();		
		}}
	//============================================ hitung total
		$("#biaya_kirim").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim").val();
			$("#b_kirim").html(rupiah(biaya_kirim));
			hitung_total();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_packing").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing").val();
			$("#b_packing").html(rupiah(biaya_pack));
			hitung_total();		
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_panjang").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume").val(vt.toFixed());
			}
			
		})
	//================================================
	$("#berat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var berat = $("#berat").val();
			var vt = parseFloat(berat);
			$("#berat").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume").val(vt.toFixed());
			}
			
		})
	//============================================ hitung total biaya
		$("#biaya_asuransi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi").val();
			$("#b_asuransi").html(rupiah(biaya_asu));
			hitung_total();	
			}
			
		})
	//============================================ hitung total biaya
		$("#dibayar").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_bayar = $("#dibayar").val();
			$("#b_dibayar").html(rupiah(biaya_bayar));
			hitung_total();	
			}
			
		})
	//============================================ hitung total biaya
		function hitung_total(){
			var b_kirim = $("#biaya_kirim").val();
			var b_packing = $("#biaya_packing").val();
			var b_asuransi = $("#biaya_asuransi").val();
			var dibayar = $("#dibayar").val();

			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#subtotal").html(rupiah(totalnya));
			
			if(dibayar >= totalnya){
				var totalakhir = parseInt(dibayar) - totalnya;
				$('#status_bayar').val('lunas');
				$('#ketuang').html('Kembalian');
			}else{
				var totalakhir = totalnya - parseInt(dibayar);
				$('#status_bayar').val('belum_lunas');
				$('#ketuang').html('Kekurangan');
			}
			$("#total").html(rupiah(totalakhir));
		}
	//============================================ bersih
		function bersih(){
			$("#nama_barang").val('');
			$("#d_panjang").val(0);
			$("#d_tinggi").val(0);
			$("#d_lebar").val(0);
			$("#volume").val('');
			$("#jumlah").val('');
			$("#berat").val('');
			$("#kota_asal").val('');
			$("#kota_tujuan").val(null).trigger('change');
			$("#n_pengirim").val('');
			$("#t_pengirim").val('');
			$("#n_penerima").val('');
			$("#t_penerima").val('');
			$("#biaya_kirim").val(0);
			$("#biaya_packing").val(0);
			$("#biaya_asuransi").val(0);
			$("#b_kirim").html(0);
			$("#b_packing").html(0);
			$("#b_asuransi").html(0);
			$("#total").html(0);
			$('#satuan').val('kg');
			$("#alamat_pengirim").val('');
			$("#alamat_penerima").val('');
			$('#metode').val('cash');
			$('#nama_barang').focus();
			kotatujuan ='';
			noresi = '';
			satuan='kg';
		}
		//==========================================selesai transaksi
		 $('#btnselesai').click(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var foo = "bar";
    if(foo=="bar"){
        var isgood = confirm('Apakah anda yakin transaksi telah selesai ?');
        if(isgood){
            location.reload();  
        }
    }
        });
	//============================================ simpan transaksi
		$("#btnsimpan").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var no_resi		= $('#koderesi').val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang").val();
			var d_panjang	= $("#d_panjang").val();
			var d_tinggi	= $("#d_tinggi").val();
			var d_lebar		= $("#d_lebar").val();
			var volume		= $("#volume").val();
			var jumlah		= $("#jumlah").val();
			var berat		= $("#berat").val();
			var kota_asal	= $("#kota_asal").val();
			var kota_tujuan = kotatujuan;
			var n_pengirim 	= $("#n_pengirim").val();
			var t_pengirim	= $("#t_pengirim").val();
			var n_penerima	= $("#n_penerima").val();
			var t_penerima 	= $("#t_penerima").val();
			var a_pengirim 	= $("#alamat_pengirim").val();
			var a_penerima	= $("#alamat_penerima").val();
			var biaya_kirim	= $("#biaya_kirim").val();
			var biaya_packing = $("#biaya_packing").val();
			var biaya_asu 	= $("#biaya_asuransi").val();
			var keterangan 	= $.trim($("#keterangan").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan').val();
			var ppn 		= 0;
			var total_biaya = parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode").val();
			var status_bayar = $('#status_bayar').val();
			var dibayar = $("#dibayar").val();
			if(dibayar=='' || no_resi=='' || a_penerima==''|| a_pengirim =='' || iduser==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: 'simpancitycmp',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'noresi'		: no_resi,
                    'iduser'		: iduser,
                    'nama_barang'	: nama_barang,
					'dimensi'		: dimensi,
					'ukuran_volume'	: volume,
					'jumlah'		: jumlah,
					'berat'			: berat,
					'kota_asal'		: kota_asal,
					'kota_tujuan' 	: kota_tujuan,
					'n_pengirim' 	: n_pengirim,
					't_pengirim'	: t_pengirim,
					'n_penerima'	: n_penerima,
					't_penerima'	: t_penerima,
					'biaya_kirim'	: biaya_kirim,
					'biaya_packing'	: biaya_packing,
					'biaya_asu' 	: biaya_asu,
					'keterangan'	: keterangan,
                	'total_biaya'	: total_biaya,
                	'satuan'		: satuan,
                	'metode'		: metode,
                	'ppn'			: ppn,
                	'alamat_pengirim' : a_pengirim,
                	'alamat_penerima' : a_penerima,
                	'status_bayar'	: status_bayar,
                	'dibayar'	: dibayar
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
		//==================================================
		function rupiah(bilangan){
			var	number_string = bilangan.toString(),
			sisa 	= number_string.length % 3,
			rupiah 	= number_string.substr(0, sisa),
			ribuan 	= number_string.substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

			return rupiah;
		}
});