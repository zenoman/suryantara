$(document).ready(function(){

	var noresi;
	var satuan = 'kg';
	var kotatujuan ='';
	var kategori='biasa';
	carikode();
	$('#nama_barang').focus();
	//=============================================ganti satuan	
	$('#satuan').on('change',function(e){
		satuan = this.value;
	})
	//=============================================ganti kategori	
	$('#kategori').on('change',function(e){
		kategori = this.value;
	})
	//===========================================
	function carikode(){
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
								$('#b_charge').html(0);
							}else{
								if (kategori=='biasa') {
									$('#status').val('Normal Cargo');
									var berat = $('#berat').val();
									var jumlah  = item.perkg*berat;
									var ppn		= (jumlah*1)/100;
									$('#b_charge').html(0);
									$('#biaya_kirim').val(jumlah);
									$('#b_kirim').html(rupiah(jumlah));
									$('#b_ppn').html(rupiah(ppn));
								}else{
									$('#status').val('Normal Cargo');
									var berat = $('#berat').val();
									var jumlah  = item.perkg*berat;
									var ppn		= (jumlah*1)/100;
									var totalcarge = (jumlah*kategori)/100;
									$('#b_charge').html(rupiah(totalcarge));
									$('#biaya_kirim').val(jumlah);
									$('#b_kirim').html(rupiah(jumlah));
									$('#b_ppn').html(rupiah(ppn));
								}
								
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
								$('#b_charge').html(0);
							}
							kotatujuan = item.tujuan;
							$('#biaya_smu').val(item.biaya_dokumen);
							$('#b_smu').html(rupiah(item.biaya_dokumen));
							hitung_total();
					})
				}
				
			},
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
		var biaya_ppn 		= parseInt($('#b_ppn').text().replace(/\./g,''));
		var biaya_charge = parseInt($('#b_charge').text().replace(/\./g,''));
		var jumlah = biaya_kirim + biaya_dokumen + biaya_karantina + biaya_ppn +biaya_charge;
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
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/6000;
			var vt = parseFloat(total);
			$("#volume").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/6000;
			var vt = parseFloat(total);
			$("#volume").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/6000;
			var vt = parseFloat(total);
			$("#volume").val(vt.toFixed(2));
			}
			
		})
	//==============================================
		$("#biaya_kirim").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim").val();
			var ppn = (biaya_kirim*1)/100;
			if (kategori!='biasa') {
			var charge = (biaya_kirim*kategori)/100;	
			$('#b_charge').html(rupiah(charge));
			}else{
			$('#b_charge').html(0);
			}
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
	//================================================
	$("#btncetak").click(function(){
		var validasi = valid();
		if(validasi=='y'){
			tempelresi();
		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		}else{
			notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
		}
		
	})
	//=================================================
	function tempelresi(){
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
			$("#cetak_jumlah_barang").html($("#jumlah").val());
			$("#cetak_jumlah_barang2").html($("#jumlah").val());
			$("#cetak_jumlah_barang3").html($("#jumlah").val());
			$("#cetak_jumlah_barang4").html($("#jumlah").val());

		}
		
		$("#cetak_berat").html($("#berat").val()+" Kg");
		$("#cetak_dimensi").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik").html($("#volume").val()+" Kg");
		$("#cetak_pengirim").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim").html("No. Telp : "+$("#t_pengirim").val());
		$("#cetak_penerima").html($("#n_penerima").val());
		$("#cetak_telp_penerima").html("No. Telp : "+$("#t_penerima").val());
		$("#cetak_isi_paket").html($("#nama_barang").val());
		$("#cetak_biaya_kirim").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$('#cetak_biaya_ppn').html("Rp. "+$('#b_ppn').html());
		$('#cetak_biaya_charge').html("Rp. "+$('#b_charge').html());
		$('#cetak_biaya_charge2').html("Rp. "+$('#b_charge').html());
		$('#cetak_biaya_charge3').html("Rp. "+$('#b_charge').html());
		$('#cetak_biaya_charge4').html("Rp. "+$('#b_charge').html());
		$("#cetak_total").html("Rp. " +$('#total').html());
		var d = new Date();
		var tanggal = d.getDate()+" - "+(d.getMonth()+1)+" - "+d.getFullYear();
		$("#cetak_tanggal").html("Kediri, "+tanggal);
		$('#cetak_nosmu').html($('#nomer_smu').val());
		//================file 2======================================
		$("#cetak_kota_asal2").html($("#kota_asal").val());
		$("#cetak_berat2").html($("#berat").val()+" Kg");
		$("#cetak_dimensi2").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik2").html($("#volume").val()+" Kg");
		$("#cetak_pengirim2").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim2").html("No. Telp : "+$("#t_pengirim").val());
		$("#cetak_penerima2").html($("#n_penerima").val());
		$("#cetak_telp_penerima2").html("No. Telp : "+$("#t_penerima").val());
		$("#cetak_isi_paket2").html($("#nama_barang").val());
		$("#cetak_biaya_kirim2").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu2').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina2').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$('#cetak_biaya_ppn2').html("Rp. "+$('#b_ppn').html());
		$("#cetak_total2").html("Rp. " +$('#total').html());
		$("#cetak_tanggal2").html("Kediri, "+tanggal);
		$('#cetak_nosmu2').html($('#nomer_smu').val());
		//================file 3============================
		$("#cetak_kota_asal3").html($("#kota_asal").val());
		$("#cetak_berat3").html($("#berat").val()+" Kg");
		$("#cetak_dimensi3").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik3").html($("#volume").val()+" Kg");
		$("#cetak_pengirim3").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim3").html("No. Telp : "+$("#t_pengirim").val());
		$("#cetak_penerima3").html($("#n_penerima").val());
		$("#cetak_telp_penerima3").html("No. Telp : "+$("#t_penerima").val());
		$("#cetak_isi_paket3").html($("#nama_barang").val());
		$("#cetak_biaya_kirim3").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu3').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina3').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$('#cetak_biaya_ppn3').html("Rp. "+$('#b_ppn').html());
		$("#cetak_total3").html("Rp. " +$('#total').html());
		$("#cetak_tanggal3").html("Kediri, "+tanggal);
		$('#cetak_nosmu3').html($('#nomer_smu').val());
		//=====================file 4 ========================
		$("#cetak_kota_asal4").html($("#kota_asal").val());
		$("#cetak_berat4").html($("#berat").val()+" Kg");
		$("#cetak_dimensi4").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
		$("#cetak_volumetrik4").html($("#volume").val()+" Kg");
		$("#cetak_pengirim4").html($("#n_pengirim").val());
		$("#cetak_telp_pengirim4").html("No. Telp : "+$("#t_pengirim").val());
		$("#cetak_penerima4").html($("#n_penerima").val());
		$("#cetak_telp_penerima4").html("No. Telp : "+$("#t_penerima").val());
		$("#cetak_isi_paket4").html($("#nama_barang").val());
		$("#cetak_biaya_kirim4").html("Rp. "+rupiah($("#biaya_kirim").val()));
		$('#cetak_biaya_smu4').html("Rp. "+rupiah($('#biaya_smu').val()));
		$('#cetak_biaya_karantina4').html("Rp. "+rupiah($('#biaya_karantina').val()));
		$('#cetak_biaya_ppn4').html("Rp. "+$('#b_ppn').html());
		$("#cetak_total4").html("Rp. " +$('#total').html());
		$("#cetak_tanggal4").html("Kediri, "+tanggal);
		$('#cetak_nosmu4').html($('#nomer_smu').val());
	}
	//===============================================
	function valid(){
			var telahvalid 	= '';
			var no_resi		= $('#noresi').val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang").val();
			var d_panjang	= $("#d_panjang").val();
			var d_tinggi	= $("#d_tinggi").val();
			var d_lebar		= $("#d_lebar").val();
			var volume		= $("#volume").val();
			var jumlah		= $("#jumlah").val();
			var berat		= $("#berat").val();
			var kota_asal	= $("#kota_asal").val();
			var kota_tujuan = $("#cetak_kota_tujuan").html();
			var n_pengirim 	= $("#n_pengirim").val();
			var t_pengirim	= $("#t_pengirim").val();
			var n_penerima	= $("#n_penerima").val();
			var t_penerima 	= $("#t_penerima").val();
			var biaya_kirim	= $("#biaya_kirim").val();
			var biaya_smu = $("#biaya_smu").val();
			var a_pengirim 	= $("#alamat_pengirim").val();
			var a_penerima	= $("#alamat_penerima").val();
			var biaya_karantina = $("#biaya_karantina").val();
			var keterangan 	= $.trim($("#keterangan").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan').val();
			var ppn 		= $('#b_ppn').text().replace(/\./g,'');
			var total_biaya = parseInt(ppn) + parseInt(biaya_smu) +  parseInt(biaya_karantina) +  parseInt(biaya_karantina);
			var metode		= $("#metode").val();
		if(a_penerima==''||a_pengirim==''||iduser==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_smu=='' || biaya_karantina =='' || keterangan==''){
				telahvalid = 'n';		
   		}else{
   			telahvalid = 'y';
   		}
   		return telahvalid;
	}
	//========================================================
	$("#btnsimpan").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var no_resi		= noresi;
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang").val();
			var d_panjang	= $("#d_panjang").val();
			var d_tinggi	= $("#d_tinggi").val();
			var d_lebar		= $("#d_lebar").val();
			var volume		= $("#volume").val();
			var jumlah		= $("#jumlah").val();
			var berat		= $("#berat").val();
			var kota_asal	= $("#kota_asal").val();
			var kota_tujuan = $("#cetak_kota_tujuan").html();
			var n_pengirim 	= $("#n_pengirim").val();
			var t_pengirim	= $("#t_pengirim").val();
			var n_penerima	= $("#n_penerima").val();
			var t_penerima 	= $("#t_penerima").val();
			var biaya_kirim	= $("#biaya_kirim").val();
			var biaya_smu = $("#biaya_smu").val();
			var biaya_karantina = $("#biaya_karantina").val();
			var keterangan 	= $.trim($("#keterangan").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan').val();
			var ppn 		= $('#b_ppn').text().replace(/\./g,'');
			var change		= $('#b_charge').text().replace(/\./g,'');
			var total_biaya = parseInt(change) + parseInt(ppn) + parseInt(biaya_kirim) +  parseInt(biaya_smu) +  parseInt(biaya_karantina);
			var metode		= $("#metode").val();
			var nosmu 		= $('#nomer_smu').val();
			var a_pengirim 	= $("#alamat_pengirim").val();
			var a_penerima	= $("#alamat_penerima").val();
			if(a_penerima==''||a_pengirim==''||iduser==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_smu=='' || biaya_karantina =='' || keterangan==''){
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
					'kota_asal'		: kota_asal,
					'kota_tujuan' 	: kota_tujuan,
					'n_pengirim' 	: n_pengirim,
					't_pengirim'	: t_pengirim,
					'n_penerima'	: n_penerima,
					't_penerima'	: t_penerima,
					'biaya_kirim'	: biaya_kirim,
					'biaya_smu'		: biaya_smu,
					'biaya_karantina' : biaya_karantina,
					'keterangan'	: keterangan,
                	'total_biaya'	: total_biaya,
                	'satuan'		: satuan,
                	'metode'		: metode,
                	'ppn'			: ppn,
                	'nosmu'			: nosmu,
                	'charge'		: change,
                	'alamat_pengirim' : a_pengirim,
                	'alamat_penerima' : a_penerima
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                	bersih();
                	carikode();
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
	//================================================
	function bersih(){
			$("#nama_barang").val('');
			$("#d_panjang").val(0);
			$("#d_tinggi").val(0);
			$("#d_lebar").val(0);
			$("#volume").val(0);
			$("#jumlah").val('');
			$("#berat").val('');
			$("#kota_asal").val('');
			$("#kota_tujuan").val(null).trigger('change');
			$('#status').val('');
			$("#n_pengirim").val('');
			$("#t_pengirim").val('');
			$("#n_penerima").val('');
			$("#t_penerima").val('');
			$("#biaya_kirim").val(0);
			$("#biaya_smu").val(0);
			$("#biaya_karantina").val(0);
			$("#keterangan").val('');
			$("#b_kirim").html(0);
			$("#b_smu").html(0);
			$("#b_karantina").html(0);
			$("#b_ppn").html(0);
			$("#b_charge").html(0);
			$("#total").html(0);
			$('#satuan').val('kg');
			$('#kategori').val('');
			$('#nomer_smu').val('');
			$("#alamat_pengirim").val('');
			$("#alamat_penerima").val('');
			$('#metode').val('cash');
			$('#nama_barang').focus();
			kotatujuan ='';
			noresi = '';
			satuan = 'kg';
			kategori = 'biasa';
		}
});