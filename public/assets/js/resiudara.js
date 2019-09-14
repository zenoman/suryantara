$(document).ready(function(){
	var noresi;
	var satuan = 'kg';
	var kotatujuan ='';
	var kategori='biasa';
	var jumlahbarang =1;
	var totalberat=0;
	var jumlahbaranghevy =0;
	carikode();
	//=============================================ganti metode	
	$('#metode').on('change',function(e){
		var metode = this.value;
		if(metode=='bt'){
			$('#status_bayar').val('belum_lunas');
			$('#status_bayar').prop('disabled','disabled');
		}else{
			$('#status_bayar').val('lunas');
			$('#status_bayar').prop('disabled', false);
		}
	})
	//===================================
	function hitungbiayakirim(berat){
		var newberat = Number(berat);

		var barangheavy = carihevy($('#tmh').val());
		var neperkg =  $('#bpk').val().replace(/\./g,'');
		var perkg = Number(neperkg);
		if(perkg > 0){
			if(satuan == 'kg'){
				if(barangheavy > 0){
					$('#biaya_kirim').val(0);
					$('#b_kirim').html(0);
					$('#b_charge').html(0);
				}else{
					if (kategori=='biasa'){
						var jumlah  = perkg*newberat;
						$('#b_charge').html(0);
						$('#biaya_kirim').val(jumlah);
						$('#b_kirim').html(rupiah(jumlah));
					}else{
						var jumlah  = perkg*newberat;
						var totalcarge = (jumlah*kategori)/100;
						$('#b_charge').html(rupiah(totalcarge));
						$('#biaya_kirim').val(jumlah);
						$('#b_kirim').html(rupiah(jumlah));
						}
					}
					}else{
					$('#biaya_kirim').val(0);
					$('#b_kirim').html(0);
					$('#b_charge').html(0);}
					hitung_total();
		}
	}
	//======================================================
	function hitungberat(){
		totalberat=0;
		for (var i = 1; i <= jumlahbarang; i++) { 
  		var volume = Number(document.getElementById('volume'+i).value);
		var berataktual = Number(document.getElementById('berat'+i).value);
		if(volume > berataktual){
			totalberat += parseFloat(volume);
			beratbaru = parseFloat(berataktual);
		}else{
			totalberat += parseFloat(berataktual);
			beratbaru = parseFloat(berataktual);
		}
		$('#berat'+i).val(beratbaru.toFixed());
		}
		$('#totalberat').val(totalberat.toFixed());
		hitungbiayakirim(totalberat.toFixed());
	}
	window.hitungberat=hitungberat;
	//===================================================
	function hayy(nomer){
		var panjang = Number(document.getElementById('d_panjang'+nomer).value);
		var lebar = Number(document.getElementById('d_lebar'+nomer).value);
		var tinggi = Number(document.getElementById('d_tinggi'+nomer).value);
		var total =  (panjang * lebar * tinggi)/6000;
		var vt = parseFloat(total);
		$('#volume'+nomer).val(vt.toFixed());
		hitungberat();
	}
	window.hayy=hayy;
	//=============================================tambah jumlah
	$("#tambahjumlah").click(function(){
		jumlahbarang +=1;
		$('#jumlah').val(jumlahbarang);
		$("#kolomjumlah").append(
			'<div class="row" id="rowjumlah'+jumlahbarang+'">'+
			'<div class="col-md-4 col-sm-6">'+
						'<div class="form-group">'+
							'<label class="form-label" for="exampleInputDisabled">Dimensi Dalam Satuan <b>cm</b> (P, L, T)  </label>'+
							'<div class="input-group">'+
								'<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_panjang'+jumlahbarang+'" onchange="hayy('+jumlahbarang+')" value="0">&nbsp;'+
								'<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_lebar'+jumlahbarang+'" onchange="hayy('+jumlahbarang+')" value="0">&nbsp;'+
								'<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_tinggi'+jumlahbarang+'" onchange="hayy('+jumlahbarang+')" value="0">'+
									
							'</div>'+
						'</div>'+
					'</div>'+
			'<div class="col-md-4 col-sm-6">'+
						'<div class="form-group">'+
							'<label class="form-label" for="exampleInputDisabled">Berat Volumetrik</label>'+
							'<div class="input-group">'+
								'<input type="text" class="form-control" id="volume'+jumlahbarang+'" onchange="hitungberat()" onkeypress="return isNumberKey2(event)"  value="0">'+
								'<div class="input-group-addon">Kg</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 col-sm-5">'+
						'<div class="form-group">'+
							'<label class="form-label" for="exampleInputDisabled">Berat Aktual</label>'+
							'<div class="input-group">'+
								'<input type="text" class="form-control" id="berat'+jumlahbarang+'" onchange="hitungberat()" onkeypress="return isNumberKey2(event)" value="0">'+
								'<div class="input-group-addon">Kg</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-1 col-sm-1 removejumlah" data-nomer="'+jumlahbarang+'">'+
						'<div class="form-group">'+
							'<label class="form-label" for="exampleInputDisabled">&nbsp;</label>'+
							'<div class="input-group">'+
								'<button class="btn btn-danger btn-block" type="button">-</button>'+
							'</div>'+
						'</div>'+
					'</div><br>'+
					'</div>'
					);
	});
	//=============================================hapus jumlah
	$('#kolomjumlah').on('click', '.removejumlah', function(e) {
    jumlahbarang -=1;
	$('#jumlah').val(jumlahbarang);
	hitungberat();
    e.preventDefault();
	$(this).parent().remove();
	});
	//=============================================fokus nama barang
	$('#nama_barang').focus();
	//=============================================ganti satuan	
	$('#satuan').on('change',function(e){
		satuan = this.value;
	})
	//=============================================ganti kategori	
	$('#kategori').on('change',function(e){
		kategori = this.value;
		if (kategori=='biasa') {
			var newkat = 0;
		}else{
			var newkat = kategori;
		}
		var biaya_kirim = parseInt($('#biaya_kirim').val());
		if(biaya_kirim > 0){
			var totalcarge = (biaya_kirim*newkat)/100;
			$('#b_charge').html(rupiah(totalcarge));
			hitung_total();
		}else{
			$('#b_charge').html(0);
			hitung_total();
		}
	})
	//=================================================
	function carihevy(nomer){
		if (nomer>0) {
			jumlahbaranghevy =0;
		for (var i = 1; i <= jumlahbarang; i++) { 
		var beratbarang=0;
  		var volume = Number(document.getElementById('volume'+i).value);
		var berataktual = Number(document.getElementById('berat'+i).value);
		if(volume > berataktual){
			beratbarang = parseFloat(volume);
		}else{
			beratbarang = parseFloat(berataktual);
		}
		if (nomer<beratbarang) {
			jumlahbaranghevy +=1;
		}}
		if (jumlahbaranghevy!=0) {
			$('#msgheavy').html('<b>Info :</b> ada '+jumlahbaranghevy+' paket yang melebihi minimal heavy cargo, tambahkan biaya kirim manual.');
		}else{
			$('#msgheavy').html('');
		}
		
	}
	return jumlahbaranghevy;
		
	}
	//===========================================
	function carikode(){
		$('#panelnya').loading('toggle');
			$.ajax({
			url:'/carikode',
			dataType:'json',
			success:function(data){
				noresi = data;
				$("#noresi").html(data);
				$("#cetak_resi").html(data);
				$("#cetak_resi2").html(data);
				$("#cetak_resi3").html(data);
				$("#cetak_resi4").html(data);
			},complete:function(){
                $('#panelnya').loading('stop');
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
		$('#panelnya').loading('toggle');
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasiludara/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							$('#min_heavy').val(item.minimal_heavy);
							$('#airland').val(item.airlans);
							var barangheavy = carihevy(item.minimal_heavy);
							if(satuan == 'kg'){
								if(barangheavy > 0){
								
								$('#biaya_kirim').val(0);
								$('#b_kirim').html(0);
								$('#b_charge').html(0);
							}else{
								if (kategori=='biasa'){
									
									var berat = $('#totalberat').val();
									var jumlah  = Number(item.perkg)*Number(berat);
									$('#b_charge').html(0);
									$('#biaya_kirim').val(jumlah);
									$('#b_kirim').html(rupiah(jumlah));
									
								}else{
									
									var berat = $('#totalberat').val();
									var jumlah  = Number(item.perkg)*Number(berat);
									var totalcarge = (jumlah*kategori)/100;
									$('#b_charge').html(rupiah(totalcarge));
									$('#biaya_kirim').val(jumlah);
									$('#b_kirim').html(rupiah(jumlah));
								}
								
							}
							}else{
								$('#biaya_kirim').val(0);
								$('#b_kirim').html(0);
								$('#b_charge').html(0);
							}
							kotatujuan = item.tujuan;
							$("#cetak_kota_tujuan").html(kotatujuan);
							$("#cetak_kota_tujuan2").html(kotatujuan);
							$("#cetak_kota_tujuan3").html(kotatujuan);
							$("#cetak_kota_tujuan4").html(kotatujuan);
							$('#ket_pti').html('&emsp;&emsp;Menerangkan bahwa kiriman yang diserahkan untuk diangkut oleh '+item.airlans);
							$('#biaya_smu').val(item.biaya_dokumen);
							$('#b_smu').html(rupiah(item.biaya_dokumen));
							$('#bpk').val(rupiah(item.perkg));
							$('#tmh').val(item.minimal_heavy);
							hitung_total();

					})
				}
				
			},complete:function(){
                $('#panelnya').loading('stop');
            }
            });
		});
	//============================================ fokus input pengirim 	
		$("#kota_tujuan").on('select2:close',function(e){
			$('#nomer_smu').focus();
		});
	//==============================================
	function hitung_total(){
		var biaya_kirim = parseInt($('#biaya_kirim').val());
		var biaya_dokumen = parseInt($('#biaya_smu').val());
		var biaya_karantina = parseInt($('#biaya_karantina').val());
		var dibayar = $("#dibayar").val();
		var biaya_charge = parseInt($('#b_charge').text().replace(/\./g,''));
		var jumlah = biaya_kirim + biaya_dokumen + biaya_karantina + biaya_charge;
		$("#subtotal").html(rupiah(jumlah));
			if(dibayar >= jumlah){
				var totalakhir = parseInt(dibayar) - jumlah;
				$('#status_bayar').val('lunas');
				$('#ketuang').html('Kembalian');
			}else{
				var totalakhir = jumlah - parseInt(dibayar);
				$('#status_bayar').val('belum_lunas');
				$('#ketuang').html('Kekurangan');
			}
		$("#total").html(rupiah(totalakhir));
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
	
	//==============================================
		$("#biaya_kirim").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim").val();
			if (kategori!='biasa') {
			var charge = (biaya_kirim*kategori)/100;	
			$('#b_charge').html(rupiah(charge));
			}else{
			$('#b_charge').html(0);
			}
			$("#b_kirim").html(rupiah(biaya_kirim));
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
	//============================================ hitung total biaya
		$("#dibayar").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_bayar = $("#dibayar").val();
			$("#b_dibayar").html(rupiah(biaya_bayar));
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
	//================================================
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
	//================================================
	function cetakresi(){
		tempelresi();
		var divToPrint2=document.getElementById('hidden_div_pti');
		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();

		var newWin2=window.open('','haloPrint-Window');
		newWin2.document.open();
		newWin2.document.write('<html><body onload="window.print();window.close()">'+divToPrint2.innerHTML+'</body></html>');
		newWin2.document.close();
		

		
	}
	//=================================================
	function tempelresi(){
		var rows ='';
		var rowpti ='';
		for (var i = 1; i <= jumlahbarang; i++) {
		rows = rows + '<tr>';
                rows = rows + '<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center">'+$('#d_panjang'+i).val()+'cm x '+$('#d_lebar'+i).val()+'cm x '+$('#d_tinggi'+i).val()+'cm</td>';
                rows = rows + '<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center">' +$('#volume'+i).val()+'Kg</td>';
                rows = rows + '<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center">' +$('#berat'+i).val()+'Kg</td>';
                rows = rows + '</tr>';
        rowpti = rowpti + '<tr>';
				rowpti = rowpti + '<td width="5%" align="center">1</td>';
                rowpti = rowpti + '<td width="10%" align="center">koli</td>';
                rowpti = rowpti + '<td width="35%" align="center">'+$("#nama_barang").val()+'</td>';
                rowpti = rowpti + '<td width="30%" align="center">'+$('#d_panjang'+i).val()+'cm x '+$('#d_lebar'+i).val()+'cm x '+$('#d_tinggi'+i).val()+'cm</td>';
                rowpti = rowpti + '<td width="10%" align="center">' +$('#volume'+i).val()+'Kg</td>';
                rowpti = rowpti + '<td width="10%" align="center">' +$('#berat'+i).val()+'Kg</td>';
                rowpti = rowpti + '</tr>';
		}

		//pti
		$('#cetak_pti_penerima').html($("#n_penerima").val());
		$('#cetak_pti_alamatp').html($("#alamat_penerima").val());
		$('#cetak_smu_pti').html($('#nomer_smu').val());
		$('#listpti').html(rowpti);
		$('#berat_pti').html($("#totalberat").val()+" Kg");
		$("#listbarang").html(rows);
		$("#listbarang2").html(rows);
		$("#listbarang3").html(rows);
		$("#listbarang4").html(rows);
		$("#cetak_metode").html($("#metode").val());
		$("#cetak_metode2").html($("#metode").val());
		$("#cetak_metode3").html($("#metode").val());
		$("#cetak_metode4").html($("#metode").val());
		$("#cetak_alamat_pengirim").html($("#alamat_pengirim").val());
		$("#cetak_alamat_pengirim2").html($("#alamat_pengirim").val());
		$("#cetak_alamat_pengirim3").html($("#alamat_pengirim").val());
		$("#cetak_alamat_pengirim4").html($("#alamat_pengirim").val());
		$("#cetak_alamat_penerima").html($("#alamat_penerima").val());
		$("#cetak_alamat_penerima2").html($("#alamat_penerima").val());
		$("#cetak_alamat_penerima3").html($("#alamat_penerima").val());
		$("#cetak_alamat_penerima4").html($("#alamat_penerima").val());
		$("#cetak_kota_tujuan").html(kotatujuan);
		$("#cetak_kota_tujuan2").html(kotatujuan);
		$("#cetak_kota_tujuan3").html(kotatujuan);
		$("#cetak_kota_tujuan4").html(kotatujuan);
		$("#cetak_kota_asal").html($("#kota_asal").val());
		if(satuan=='koli'){
			$("#cetak_jumlah_barang").html($("#jumlah").val()+" "+satuan);
			$("#cetak_jumlah_barang2").html($("#jumlah").val()+" "+satuan);
			$("#cetak_jumlah_barang3").html($("#jumlah").val()+" "+satuan);
			$("#cetak_jumlah_barang4").html($("#jumlah").val()+" "+satuan);
		}else{
			$("#cetak_jumlah_barang").html($("#jumlah").val()+" paket");
			$("#cetak_jumlah_barang2").html($("#jumlah").val()+" paket");
			$("#cetak_jumlah_barang3").html($("#jumlah").val()+" paket");
			$("#cetak_jumlah_barang4").html($("#jumlah").val()+" paket");

		}
		
		$("#cetak_berat").html($("#totalberat").val()+" Kg");
		$("#cetak_dimensi").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik").html($("#volume").val()+" Kg");
		$("#cetak_pengirim").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim").html($("#t_pengirim").val());
		$("#cetak_penerima").html($("#n_penerima").val());
		$("#cetak_telp_penerima").html($("#t_penerima").val());
		$("#cetak_isi_paket").html($("#nama_barang").val());
		$("#cetak_biaya_kirim").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$('#cetak_biaya_charge').html("Rp. "+$('#b_charge').html());
		$('#cetak_biaya_charge2').html("Rp. "+$('#b_charge').html());
		$('#cetak_biaya_charge3').html("Rp. "+$('#b_charge').html());
		$('#cetak_biaya_charge4').html("Rp. "+$('#b_charge').html());
		$("#cetak_total").html("Rp. " +$('#subtotal').html());
		var d = new Date();
		var tanggal = d.getDate()+" - "+(d.getMonth()+1)+" - "+d.getFullYear();
		$("#cetak_tanggal").html("Kediri, "+tanggal);
		$('#cetak_nosmu').html($('#nomer_smu').val());
		//================file 2======================================
		$("#cetak_kota_asal2").html($("#kota_asal").val());
		$("#cetak_berat2").html($("#totalberat").val()+" Kg");
		$("#cetak_dimensi2").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik2").html($("#volume").val()+" Kg");
		$("#cetak_pengirim2").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim2").html($("#t_pengirim").val());
		$("#cetak_penerima2").html($("#n_penerima").val());
		$("#cetak_telp_penerima2").html($("#t_penerima").val());
		$("#cetak_isi_paket2").html($("#nama_barang").val());
		$("#cetak_biaya_kirim2").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu2').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina2').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$("#cetak_total2").html("Rp. " +$('#subtotal').html());
		$("#cetak_tanggal2").html("Kediri, "+tanggal);
		$('#cetak_nosmu2').html($('#nomer_smu').val());
		//================file 3============================
		$("#cetak_kota_asal3").html($("#kota_asal").val());
		$("#cetak_berat3").html($("#totalberat").val()+" Kg");
		$("#cetak_dimensi3").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik3").html($("#volume").val()+" Kg");
		$("#cetak_pengirim3").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim3").html($("#t_pengirim").val());
		$("#cetak_penerima3").html($("#n_penerima").val());
		$("#cetak_telp_penerima3").html($("#t_penerima").val());
		$("#cetak_isi_paket3").html($("#nama_barang").val());
		$("#cetak_biaya_kirim3").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu3').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina3').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$("#cetak_total3").html("Rp. " +$('#subtotal').html());
		$("#cetak_tanggal3").html("Kediri, "+tanggal);
		$('#cetak_nosmu3').html($('#nomer_smu').val());
		//=====================file 4 ========================
		$("#cetak_kota_asal4").html($("#kota_asal").val());
		$("#cetak_berat4").html($("#totalberat").val()+" Kg");
		$("#cetak_dimensi4").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik4").html($("#volume").val()+" Kg");
		$("#cetak_pengirim4").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim4").html($("#t_pengirim").val());
		$("#cetak_penerima4").html($("#n_penerima").val());
		$("#cetak_telp_penerima4").html($("#t_penerima").val());
		$("#cetak_isi_paket4").html($("#nama_barang").val());
		$("#cetak_biaya_kirim4").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu4').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina4').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$("#cetak_total4").html("Rp. " +$('#subtotal').html());
		$("#cetak_tanggal4").html("Kediri, "+tanggal);
		$('#cetak_nosmu4').html($('#nomer_smu').val());
	}
	
	//========================================================
	$("#btnsimpan").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var no_resi		= noresi;
			var jumlah		= $("#jumlah").val();
			var iduser		= $("#iduser").val();

			var dimensi = '';
			var subberat = '';
			var volume = '';

			var nama_barang	= $("#nama_barang").val();
			for (var i = 1; i <= jumlah ; i++) {
				var d_panjang	= $("#d_panjang"+i).val();
				var d_tinggi	= $("#d_tinggi"+i).val();
				var d_lebar		= $("#d_lebar"+i).val();
				var beranya = $('#berat'+i).val();
				var volum = $('#volume'+i).val();

				dimensi = dimensi+""+d_panjang+" x "+d_lebar+" x "+d_tinggi+",";
				subberat = subberat+''+beranya+',';
				volume = volume+''+volum+',';
			}
			var berat		= $("#totalberat").val();
			var kota_asal	= $("#kota_asal").val();
			var kota_tujuan = $("#cetak_kota_tujuan").html();
			var n_pengirim 	= $("#n_pengirim").val();
			var t_pengirim	= $("#t_pengirim").val();
			var n_penerima	= $("#n_penerima").val();
			var t_penerima 	= $("#t_penerima").val();
			var biaya_kirim	= $("#biaya_kirim").val();
			var biaya_smu = $("#biaya_smu").val();
			var biaya_karantina = $("#biaya_karantina").val();
			var maskapai	= $("#airland").val();
			var satuan		= $('#satuan').val();
			var ppn 		= 0;
			var change		= $('#b_charge').text().replace(/\./g,'');
			var total_biaya = parseInt(change) + parseInt(biaya_kirim) +  parseInt(biaya_smu) +  parseInt(biaya_karantina);
			var metode		= $("#metode").val();
			var nosmu 		= $('#nomer_smu').val();
			var a_pengirim 	= $("#alamat_pengirim").val();
			var a_penerima	= $("#alamat_penerima").val();
			var status_bayar = $('#status_bayar').val();
			var dibayar = $("#dibayar").val();
			if(dibayar=='' || a_penerima==''||a_pengirim==''||iduser==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || jumlah=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_smu=='' || biaya_karantina ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: 'simpanudara',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'noresi'		: no_resi,
                    'iduser'		: iduser,
                    'nama_barang'	: nama_barang,
					'dimensi'		: dimensi,
					'ukuran_volume'	: volume,
					'jumlah'		: jumlah,
					'berat'			: berat,
					'subberat'		: subberat,
					'kota_asal'		: kota_asal,
					'kota_tujuan' 	: kota_tujuan,
					'n_pengirim' 	: n_pengirim,
					't_pengirim'	: t_pengirim,
					'n_penerima'	: n_penerima,
					't_penerima'	: t_penerima,
					'biaya_kirim'	: biaya_kirim,
					'maskapai'		: maskapai,
					'biaya_smu'		: biaya_smu,
					'biaya_karantina' : biaya_karantina,
                	'total_biaya'	: total_biaya,
                	'satuan'		: satuan,
                	'metode'		: metode,
                	'ppn'			: ppn,
                	'nosmu'			: nosmu,
                	'charge'		: change,
                	'alamat_pengirim' : a_pengirim,
                	'alamat_penerima' : a_penerima,
                	'status_bayar'	: status_bayar,
                	'dibayar'	: dibayar
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                    cetakresi();
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
});