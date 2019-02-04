$(document).ready(function(){
	var halaman='darat';
	var satuan_darat = 'kg';
	//======================================
	$('#metode').on('change',function(e){
		halaman = this.value;
		if(halaman=='darat'){
		 $("#formdarat").show(700);
         $("#formudara").hide(700);
         $("#formlaut").hide(700);	
		}else if(halaman=='laut'){
		 $("#formdarat").hide(700);
         $("#formudara").hide(700);
         $("#formlaut").show(700);
		}else{
		 $("#formdarat").hide(700);
         $("#formudara").show(700);
         $("#formlaut").hide(700);
		}
	});
	//###############################halaman darat
	$('#satuan_darat').on('change',function(e){
		satuan_darat = this.value;
	})
	//============================================ hitung volumetrik
		$("#d_panjang_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume_darat").val(total);
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume_darat").val(total);
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume_darat").val(total);
			}
			
		})
	//=============================================cari kota tujuan
		$('#kota_tujuan_darat').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/carikota',
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
	$('#kota_tujuan_darat').on('select2:select',function(e){
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasilkota/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan_darat=='kg'){
								hitung(item.tarif,item.tujuan);
							}else{
								kotatujuan = item.tujuan;
								$("#biaya_kirim_darat").val(0);
								$("#b_kirim_darat").html(0);
								hitung_total();
							}
					})
				}
			},
            });
		});
	//============================================ hitung estimasi tujuan
		function hitung(harga,tujuan){
			var berat = $("#berat_darat").val();
			if(berat!=''){
			var jumlah = harga*berat;
			var ppn = (jumlah*1)/100;
			$("#biaya_kirim_darat").val(jumlah);
			$("#b_kirim_darat").html(rupiah(jumlah));
			$("#b_ppn_darat").html(rupiah(ppn));
			hitung_total();		
		}}
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
	//============================================ hitung total biaya
		function hitung_total(){
			var b_kirim = $("#biaya_kirim_darat").val();
			var b_packing = $("#biaya_packing_darat").val();
			var b_asuransi = $("#biaya_asuransi_darat").val();
			var b_ppn		= $("#b_ppn_darat").html().replace('.','');
			var totalnya = parseInt(b_ppn)+parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#total_darat").html(rupiah(totalnya));
		}
	//============================================ hitung total biaya
		$("#biaya_asuransi_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi_darat").val();
			$("#b_asuransi_darat").html(rupiah(biaya_asu));
			hitung_total();	
			}
			
		})
	//============================================ hitung total
		$("#biaya_kirim_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_darat").val();
			var ppn = (biaya_kirim*1)/100;
			$("#b_kirim_darat").html(rupiah(biaya_kirim));
			$("#b_ppn_darat").html(rupiah(ppn));
			hitung_total();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_packing_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing_darat").val();
			$("#b_packing_darat").html(rupiah(biaya_pack));
			hitung_total();		
			}
			
		})
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_darat").on('select2:close',function(e){
			$('#n_pengirim_darat').focus();
		});
	//============================================ simpan transaksi
		$("#btnsimpan_darat").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_darat").val();
			var d_panjang	= $("#d_panjang_darat").val();
			var d_tinggi	= $("#d_tinggi_darat").val();
			var d_lebar		= $("#d_lebar_darat").val();
			var volume		= $("#volume_darat").val();
			var jumlah		= $("#jumlah_darat").val();
			var berat		= $("#berat_darat").val();
			var kota_asal	= $("#kota_asal_darat").val();
			var kota_tujuan = $('#kota_tujuan_darat').select2('data').text;
			var n_pengirim 	= $("#n_pengirim_darat").val();
			var t_pengirim	= $("#t_pengirim_darat").val();
			var n_penerima	= $("#n_penerima_darat").val();
			var t_penerima 	= $("#t_penerima_darat").val();
			var biaya_kirim	= $("#biaya_kirim_darat").val();
			var biaya_packing = $("#biaya_packing_darat").val();
			var biaya_asu 	= $("#biaya_asuransi_darat").val();
			var keterangan 	= $.trim($("#keterangan_darat").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_darat').val();
			var ppn 		= $('#b_ppn_darat').text().replace('.','');
			var total_biaya = parseInt(ppn) + parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode_darat").val();
			if(nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanmanualdarat',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'idresi'		: idresi,
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
                	'ppn'			: ppn
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                	window.location.href = "/Manual";
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
});