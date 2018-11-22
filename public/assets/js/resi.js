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
						hitung(item.tarif);	
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

		function hitung(harga){
			var berat = $("#berat").val();
			if(berat!=''){
			var jumlah = harga*berat;
			$("#biaya_kirim").val(jumlah);
			$("#b_kirim").html(jumlah);
			hitung_total();		
		}}
		$("#biaya_packing").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing").val();
			$("#b_packing").html(biaya_pack);
			hitung_total();		
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
		$("#kota_tujuan").keydown(function(e){
			if(e.keyCode == 13){
				alert('enter');
			}
		})
	});