$(document).ready(function(){
	//============================================deklarasi variabel
	var satuan = 'kg';
	var kotatujuan ='';
	var noresi;
	//=============================================ganti satuan	
	$('#satuan').on('change',function(e){
		satuan = this.value;
	})
	//=============================================cari kode
		carikode();

	//=============================================cari kota tujuan
		$('#kota_tujuan').select2({
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
	$('#kota_tujuan').on('select2:select',function(e){
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasilkota/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan=='kg'){
								hitung(item.tarif,item.tujuan);
								$("#cetak_kota_tujuan").html(item.tujuan);
								$("#cetak_kota_tujuan2").html(item.tujuan);
								$("#cetak_kota_tujuan3").html(item.tujuan);
								$("#cetak_kota_tujuan4").html(item.tujuan);
								kotatujuan = item.tujuan;	
							}else{
								$("#cetak_kota_tujuan").html(item.tujuan);
								$("#cetak_kota_tujuan2").html(item.tujuan);
								$("#cetak_kota_tujuan3").html(item.tujuan);
								$("#cetak_kota_tujuan4").html(item.tujuan);
								kotatujuan = item.tujuan;
								$("#biaya_kirim").val(0);
								$("#b_kirim").html(0);
								hitung_total();
							}
					})
				}
			},
            });
		});
	//============================================ fokus input pengirim 	
		$("#kota_tujuan").on('select2:close',function(e){
			$('#n_pengirim').focus();
		});
	//============================================ cari kode
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
	//============================================ hitung estimasi tujuan
		function hitung(harga,tujuan){
			var berat = $("#berat").val();
			if(berat!=''){
			var jumlah = harga*berat;
			var ppn = (jumlah*1)/100;
			$("#biaya_kirim").val(jumlah);
			$("#b_kirim").html(rupiah(jumlah));
			$("#b_ppn").html(rupiah(ppn));
			hitung_total();		
		}}
	//============================================ hitung total
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
	//============================================ hitung total biaya
		$("#biaya_asuransi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi").val();
			$("#b_asuransi").html(rupiah(biaya_asu));
			hitung_total();	
			}
			
		})
	//============================================ hitung total biaya
		function hitung_total(){
			var b_kirim = $("#biaya_kirim").val();
			var b_packing = $("#biaya_packing").val();
			var b_asuransi = $("#biaya_asuransi").val();
			var b_ppn		= $("#b_ppn").html().replace('.','');
			var totalnya = parseInt(b_ppn)+parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#total").html(rupiah(totalnya));
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
			$("#keterangan").val('');
			$("#b_kirim").html(0);
			$("#b_packing").html(0);
			$("#b_asuransi").html(0);
			$("#b_ppn").html(0);
			$("#total").html(0);
			$('#satuan').val('kg');
			$('#nama_barang').focus();
			kotatujuan ='';
			noresi = '';
			satuan='kg';
		}
	//============================================ cetak resi
		
		$("#btncetak").click(function(){
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
			var biaya_packing = $("#biaya_packing").val();
			var biaya_asu 	= $("#biaya_asuransi").val();
			var keterangan 	= $.trim($("#keterangan").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan').val();
			var total_biaya = parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			
			if(iduser==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
		tempelresi();

		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();}
		});
	//============================================ tempel variabel
		function tempelresi(){
			carikode();
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
			$("#cetak_dimensi").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x "+$("#d_tinggi").val()+" cm");
			$("#cetak_volumetrik").html($("#volume").val()+" Kg");
			$("#cetak_pengirim").html($("#n_pengirim").val());
			$("#cetak_telp_pengirim").html("No. Telp : "+$("#t_pengirim").val());
			$("#cetak_penerima").html($("#n_penerima").val());
			$("#cetak_telp_penerima").html("No. Telp : "+$("#t_penerima").val());
			$("#cetak_isi_paket").html($("#nama_barang").val());
			$("#cetak_biaya_kirim").html("Rp. "+rupiah($("#biaya_kirim").val()));
			$("#cetak_biaya_packing").html("Rp. "+rupiah($("#biaya_packing").val()));
			$("#cetak_biaya_asu").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			$("#cetak_biaya_ppn").html("Rp. "+$("#b_ppn").html());
			$("#cetak_biaya_ppn2").html("Rp. "+$("#b_ppn").html());
			$("#cetak_biaya_ppn3").html("Rp. "+$("#b_ppn").html());

			var b_kirim = $("#biaya_kirim").val();
			var b_packing = $("#biaya_packing").val();
			var b_asuransi = $("#biaya_asuransi").val();
			var b_ppn		=$("#b_ppn").text().replace('.','');
			var totalnya = parseInt(b_ppn) + parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#cetak_total").html("Rp. " + rupiah(totalnya));

			var d = new Date();
			var tanggal = d.getDate()+" - "+(d.getMonth()+1)+" - "+d.getFullYear();
			$("#cetak_tanggal").html("Kediri, "+tanggal);
			//========================================================
			$("#cetak_kota_asal2").html($("#kota_asal").val());
			$("#cetak_berat2").html($("#berat").val()+" Kg");
			$("#cetak_dimensi2").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x "+$("#d_tinggi").val()+" cm");
			$("#cetak_volumetrik2").html($("#volume").val()+" Kg");
			$("#cetak_pengirim2").html($("#n_pengirim").val());
			$("#cetak_telp_pengirim2").html("No. Telp : "+$("#t_pengirim").val());
			$("#cetak_penerima2").html($("#n_penerima").val());
			$("#cetak_telp_penerima2").html("No. Telp : "+$("#t_penerima").val());
			$("#cetak_isi_paket2").html($("#nama_barang").val());
			$("#cetak_biaya_kirim2").html("Rp. "+rupiah($("#biaya_kirim").val()));
			$("#cetak_biaya_packing2").html("Rp. "+rupiah($("#biaya_packing").val()));
			$("#cetak_biaya_asu2").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			$("#cetak_total2").html("Rp. "+rupiah(totalnya));
			$("#cetak_tanggal2").html("Kediri, "+tanggal);
			//===========================================================
			$("#cetak_kota_asal3").html($("#kota_asal").val());
			$("#cetak_berat3").html($("#berat").val()+" Kg");
			$("#cetak_dimensi3").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x "+$("#d_tinggi").val()+" cm");
			$("#cetak_volumetrik3").html($("#volume").val()+" Kg");
			$("#cetak_pengirim3").html($("#n_pengirim").val());
			$("#cetak_telp_pengirim3").html("No. Telp : "+$("#t_pengirim").val());
			$("#cetak_penerima3").html($("#n_penerima").val());
			$("#cetak_telp_penerima3").html("No. Telp : "+$("#t_penerima").val());
			$("#cetak_isi_paket3").html($("#nama_barang").val());
			$("#cetak_biaya_kirim3").html("Rp. "+rupiah($("#biaya_kirim").val()));
			$("#cetak_biaya_packing3").html("Rp. "+rupiah($("#biaya_packing").val()));
			$("#cetak_biaya_asu3").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			$("#cetak_total3").html("Rp. "+rupiah(totalnya));
			$("#cetak_tanggal3").html("Kediri, "+tanggal);
		//============================================================
			$("#cetak_kota_asal4").html($("#kota_asal").val());
			$("#cetak_berat4").html($("#berat").val()+" Kg");
			$("#cetak_dimensi4").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x "+$("#d_tinggi").val()+" cm");
			$("#cetak_volumetrik4").html($("#volume").val()+" Kg");
			$("#cetak_pengirim4").html($("#n_pengirim").val());
			$("#cetak_telp_pengirim4").html("No. Telp : "+$("#t_pengirim").val());
			$("#cetak_penerima4").html($("#n_penerima").val());
			$("#cetak_telp_penerima4").html("No. Telp : "+$("#t_penerima").val());
			$("#cetak_isi_paket4").html($("#nama_barang").val());
			$("#cetak_biaya_kirim4").html("Rp. "+rupiah($("#biaya_kirim").val()));
			$("#cetak_biaya_packing4").html("Rp. "+rupiah($("#biaya_packing").val()));
			$("#cetak_biaya_asu4").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			$("#cetak_total4").html("Rp. "+rupiah(totalnya));
			$("#cetak_tanggal4").html("Kediri, "+tanggal);
		}
	//============================================ simpan transaksi
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
			var biaya_packing = $("#biaya_packing").val();
			var biaya_asu 	= $("#biaya_asuransi").val();
			var keterangan 	= $.trim($("#keterangan").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan').val();
			var ppn 		= $('#b_ppn').text().replace('.','');
			var total_biaya = parseInt(ppn) + parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode").val();
			if(iduser==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: 'residarat',
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
                	'ppn'			: ppn
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