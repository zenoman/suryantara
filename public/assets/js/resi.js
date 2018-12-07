$(document).ready(function(){
		var satuan = 'kg';
		$('#satuan').on('change',function(e){
			satuan = this.value;
		})
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
							if(satuan=='kg'){
								hitung(item.tarif,item.tujuan);
								$("#cetak_kota_tujuan").html(item.tujuan);
								$("#cetak_kota_tujuan2").html(item.tujuan);	
							}else{
								$("#cetak_kota_tujuan").html(item.tujuan);
								$("#cetak_kota_tujuan2").html(item.tujuan);
								$("#biaya_kirim").val(0);
								$("#b_kirim").html(0);
								hitung_total();
							}
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
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume").val(total);
			}
			
		})
		$("#d_lebar").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			$("#volume").val(total);
			}
			
		})
		$("#d_tinggi").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang").val();
			var lebar = $("#d_lebar").val();
			var tinggi = $("#d_tinggi").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
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
		
		$("#btncetak").click(function(){
		tempelresi();

		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		setTimeout(function(){newWin.close();},10);
		});

		function tempelresi(){
			$("#cetak_kota_asal").html($("#kota_asal").val());
			$("#cetak_jumlah_barang").html($("#jumlah").val());
			$("#cetak_berat").html($("#berat").val()+" "+satuan);
			$("#cetak_dimensi").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
			$("#cetak_volumetrik").html($("#volume").val()+" Kg");
			$("#cetak_pengirim").html($("#n_pengirim").val());
			$("#cetak_telp_pengirim").html("No. Telp : "+$("#t_pengirim").val());
			$("#cetak_penerima").html($("#n_penerima").val());
			$("#cetak_telp_penerima").html("No. Telp : "+$("#t_penerima").val());
			$("#cetak_isi_paket").html($("#nama_barang").val());
			$("#cetak_biaya_kirim").html("Rp. "+$("#biaya_kirim").val());
			$("#cetak_biaya_packing").html("Rp. "+$("#biaya_packing").val());
			$("#cetak_biaya_asu").html("Rp. "+$("#biaya_asuransi").val());
			
			var b_kirim = $("#biaya_kirim").val();
			var b_packing = $("#biaya_packing").val();
			var b_asuransi = $("#biaya_asuransi").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#cetak_total").html("Rp. "+totalnya);

			var d = new Date();
			var tanggal = d.getDate()+" - "+d.getMonth()+" - "+d.getFullYear();
			$("#cetak_tanggal").html("Kediri, "+tanggal);
			//========================================================
			$("#cetak_kota_asal2").html($("#kota_asal").val());
			$("#cetak_jumlah_barang2").html($("#jumlah").val());
			$("#cetak_berat2").html($("#berat").val()+" "+satuan);
			$("#cetak_dimensi2").html($("#d_panjang").val()+" cm x "+$("#d_lebar").val()+" cm x"+$("#d_tinggi").val()+" cm");
			$("#cetak_volumetrik2").html($("#volume").val()+" Kg");
			$("#cetak_pengirim2").html($("#n_pengirim").val());
			$("#cetak_telp_pengirim2").html("No. Telp : "+$("#t_pengirim").val());
			$("#cetak_penerima2").html($("#n_penerima").val());
			$("#cetak_telp_penerima2").html("No. Telp : "+$("#t_penerima").val());
			$("#cetak_isi_paket2").html($("#nama_barang").val());
			$("#cetak_biaya_kirim2").html("Rp. "+$("#biaya_kirim").val());
			$("#cetak_biaya_packing2").html("Rp. "+$("#biaya_packing").val());
			$("#cetak_biaya_asu2").html("Rp. "+$("#biaya_asuransi").val());
			$("#cetak_total2").html("Rp. "+totalnya);
			$("#cetak_tanggal2").html("Kediri, "+tanggal);
		}

		$("#btnsimpan").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var iduser		= $("#iduser").val();
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
			if(iduser==''||nama_barang == '' || d_panjang == 0 || d_lebar==0 || d_tinggi==0 || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_packing ==0 || biaya_kirim==0 || biaya_packing==0 || biaya_asu =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
				$.ajax({
                type: 'POST',
                url: 'residarat',
                data: {
                    '_token': $('input[name=_token]').val(),
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
                	'total_biaya'	: total_biaya
                },
                success:function(){
                    alert('Data Berhasil Disimpan');
                	bersih();
                },
            });
			}
		});
	});