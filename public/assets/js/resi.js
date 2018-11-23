$(document).ready(function(){

		$('#kota_tujuan').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/carikota',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						if(item.kode != null){
						hitung(item.tarif,item.tujuan);	
						}
						return {
							id: item.kode,
							text: item.tujuan
						}

					})
				}
			},
			cache: true
		}
	});
		$("#kota_tujuan").on('select2:close',function(e){
			$('#n_pengirim').focus();
		});

		function hitung(harga,tujuan){
			var berat = $("#berat").val();
			if(berat!=''){
			var jumlah = harga*berat;
			$("#biaya_kirim").val(jumlah);
			$("#b_kirim").html(jumlah);
			hitung_total();		
		}}
		$("#biaya_kirim").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim").val();
			$("#b_kirim").html(biaya_kirim);
			hitung_total();		
			}
			
		})
		$("#biaya_packing").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing").val();
			$("#b_packing").html(biaya_pack);
			hitung_total();		
			}
			
		})
		$("#d_panjang").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  parseInt(panjang) +  parseInt(lebar) +  parseInt(tinggi);
			$("#volume").val(total);
			}
			
		})
		$("#d_lebar").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  parseInt(panjang) +  parseInt(lebar) +  parseInt(tinggi);
			$("#volume").val(total);
			}
			
		})
		$("#d_tinggi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  parseInt(panjang) +  parseInt(lebar) +  parseInt(tinggi);
			$("#volume").val(total);
			}
			
		})
		$("#biaya_asuransi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi").val();
			$("#b_asuransi").html(biaya_asu);
			hitung_total();	
			}
			
		})
		function hitung_total(){
			var b_kirim = $("#biaya_kirim").val();
			var b_packing = $("#biaya_packing").val();
			var b_asuransi = $("#biaya_asuransi").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#total").html(totalnya);
		}
		function bersih(){
			$("#nama_barang").val('');
			$("#d_panjang").val(0);
			$("#d_tinggi").val(0);
			$("#d_lebar").val(0);
			$("#volume").val('');
			$("#jumlah").val('');
			$("#berat").val('');
			$("#kota_asal").val('');
			$("#kota_tujuan").select2("val","");
			$("#n_pengirim").val('');
			$("#t_pengirim").val('');
			$("#n_penerima").val('');
			$("#t_penerima").val('');
			$("#biaya_kirim").val(0);
			$("#biaya_packing").val(0);
			$("#biaya_asuransi").val(0);
			$("#keterangan").val('');
			$("#b_kirim").html(0);
			$("#b_packing").html(0);
			$("#b_asuransi").html(0);
			$("#total").html(0);
			$('#nama_barang').focus();
		}
		$("#btnsimpan").click(function(){
			var nama_barang	= $("#nama_barang").val();
			var d_panjang	= $("#d_panjang").val();
			var d_tinggi	= $("#d_tinggi").val();
			var d_lebar		= $("#d_lebar").val();
			var volume		= $("#volume").val();
			var jumlah		= $("#jumlah").val();
			var berat		= $("#berat").val();
			var kota_asal	= $("#kota_asal").val();
			var kota_tujuan = $("#kota_tujuan").val();
			var n_pengirim 	= $("#n_pengirim").val();
			var t_pengirim	= $("#t_pengirim").val();
			var n_penerima	= $("#n_penerima").val();
			var t_penerima 	= $("#t_penerima").val();
			var biaya_kirim	= $("#biaya_kirim").val();
			var biaya_packing = $("#biaya_packing").val();
			var biaya_asu 	= $("#biaya_asuransi").val();
			var keterangan 	= $.trim($("#keterangan").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var total_biaya = parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			if(nama_barang == '' || d_panjang == 0 || d_lebar==0 || d_tinggi==0 || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_packing ==0 || biaya_kirim==0 || biaya_packing==0 || biaya_asu =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
				$.ajax({
                type: 'POST',
                url: 'residarat',
                data: {
                    '_token': $('input[name=_token]').val(),
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
                	'total_biaya'	: total_biaya
                },
                success:function(){
                    notie.confirm('Resi Disimpan<br>Cetak Resi ?', 'Ya', 'Tidak', function() {
            		notie.alert(1, 'Resi Dicetak', 2);});
                	bersih();
                },
            });
			}
		});
	});