$(document).ready(function(){
	var noresi;
	var satuan = 'kg';
	carikode();
	//=============================================ganti satuan	
	$('#satuan').on('change',function(e){
		satuan = this.value;
	})
	//===========================================
	function carikode(){
			$.ajax({
			url:'/carikode',
			dataType:'json',
			success:function(data){
				noresi = data;
				$("#noresi").html(data);
				
			}
		});
		}
	//===========================================
		$('#kota_tujuan').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/cariudara',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.id,
							text: item.tujuan+" - "+item.airlans
						}

					})
				}
			},
			cache: true
		}
	});
	//=================================================
	$('#kota_tujuan').on('select2:select',function(e){
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasiludara/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							$('#min_heavy').val(item.minimal_heavy);
							
							if(satuan == 'kg'){
								if(parseInt($('#min_heavy').val()) < parseInt($('#berat').val())){
								$('#status').val('Heavy Cargo');
								$('#biaya_kirim').val(0);
								$('#b_kirim').html(0);
								$('#b_ppn').html(0);
							}else{
								$('#status').val('Normal Cargo');
								var berat = $('#berat').val();
								var jumlah  = item.perkg*berat;
								var ppn		= (jumlah*1)/100;
								$('#biaya_kirim').val(jumlah);
								$('#b_kirim').html(rupiah(jumlah));
								$('#b_ppn').html(rupiah(ppn));
							}
							}else{
								if(parseInt($('#min_heavy').val()) < parseInt($('#berat').val())){
								$('#status').val('Heavy Cargo');
								}else{
								$('#status').val('Normal Cargo');
								}
								$('#biaya_kirim').val(0);
								$('#b_kirim').html(0);
								$('#b_ppn').html(0);
							}
							
							$('#biaya_smu').val(item.biaya_dokumen);
							$('#b_smu').html(rupiah(item.biaya_dokumen));
							hitung_total();
					})
				}
			},
            });
		});
	//==============================================
	function hitung_total(){
		var biaya_kirim = parseInt($('#biaya_kirim').val());
		var biaya_dokumen = parseInt($('#biaya_smu').val());
		var biaya_karantina = parseInt($('#biaya_karantina').val());
		var biaya_ppn 		= parseInt($('#b_ppn').text().replace('.',''));
		var jumlah = biaya_kirim + biaya_dokumen + biaya_karantina + biaya_ppn;
		$('#total').html(rupiah(jumlah));
	}
	//==============================================
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
	//============================================ hitung volumetrik
		$("#d_panjang").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume").val(total);
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume").val(total);
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume").val(total);
			}
			
		})
	//==============================================
		$("#biaya_kirim").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim").val();
			var ppn = (biaya_kirim*1)/100;
			$("#b_kirim").html(rupiah(biaya_kirim));
			$("#b_ppn").html(rupiah(ppn));
			hitung_total();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_smu").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_smu = $("#biaya_smu").val();
			$("#b_smu").html(rupiah(biaya_smu));
			hitung_total();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_karantina").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_karantina = $("#biaya_karantina").val();
			$("#b_karantina").html(rupiah(biaya_karantina));
			hitung_total();		
			}
			
		})
});