$(document).ready(function(){
	var halaman='darat';
	var satuan_darat = 'kg';
	var satuan_laut = 'kg';
	var satuan_udara = 'kg';
	var satuan_ck = 'kg';
	var kategori_udara ='biasa';
	var kotatujuanudara = '';
	if($('#status_company').val() == 'personal'){
	var urlcity ='/carikotacity';
	}else{
	var urlcity ='/carikotacitycmd';
	}
	var jumlahbarang =parseInt($('#jumlah_udara').val());
	var totalberat=0;
	var jumlahbaranghevy=0;
	//======================================
	$('#metode').on('change',function(e){
		halaman = this.value;
		if(halaman=='darat'){
			$('#formcity').hide(700);
		 $("#formdarat").show(700);
         $("#formudara").hide(700);
         $("#formlaut").hide(700);	
		 $('#nama_barang_darat').focus();
		}else if(halaman=='laut'){
			$('#formcity').hide(700);
		 $("#formdarat").hide(700);
         $("#formudara").hide(700);
         $("#formlaut").show(700);
		 $('#nama_barang_laut').focus();
		}else if(halaman =='city kurier'){
		$('#formcity').show(700);
		 $("#formdarat").hide(700);
         $("#formudara").hide(700);
         $("#formlaut").hide(700);
         $('#nama_barang_ck').focus();
		}else{
			$('#formcity').hide(700);
		 $("#formdarat").hide(700);
         $("#formudara").show(700);
         $("#formlaut").hide(700);
         $('#nama_barang_udara').focus();
		}
	});
	//###############################halaman ck
	$('#satuan_ck').on('change',function(e){
		satuan_ck = this.value;
	})
	//============================================ hitung volumetrik
		$("#d_panjang_ck").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_ck = $("#d_panjang_ck").val();
			var lebar_ck = $("#d_lebar_ck").val();
			var tinggi_ck = $("#d_tinggi_ck").val();
			var total_ck =  (parseInt(panjang_ck) *  parseInt(lebar_ck) *  parseInt(tinggi_ck))/4000;
			var vt = parseFloat(total_ck);
			$("#volume_ck").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_ck").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_ck = $("#d_panjang_ck").val();
			var lebar_ck = $("#d_lebar_ck").val();
			var tinggi_ck = $("#d_tinggi_ck").val();
			var total_ck =  (parseInt(panjang_ck) *  parseInt(lebar_ck) *  parseInt(tinggi_ck))/4000;
			var vt = parseFloat(total_ck);
			$("#volume_ck").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_ck").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_ck = $("#d_panjang_ck").val();
			var lebar_ck = $("#d_lebar_ck").val();
			var tinggi_ck = $("#d_tinggi_ck").val();
			var total_ck =  (parseInt(panjang_ck) *  parseInt(lebar_ck) *  parseInt(tinggi_ck))/4000;
			var vt = parseFloat(total_ck);
			$("#volume_ck").val(vt.toFixed());
			}
			
		})
	//=============================================cari kota tujuan
		$('#kota_tujuan_ck').select2({
			
				placeholder: 'Cari kota tujuan',
				ajax:{
			url:urlcity,
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
	$('#kota_tujuan_ck').on('select2:select',function(e){
			$('#formcity').loading('toggle');
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasilkota/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan_ck=='kg'){
								hitung_ck(item.tarif,item.tujuan);
							}else{
								$("#biaya_kirim_ck").val(0);
								$("#b_kirim_ck").html(0);
								hitung_total_ck();
							}
					})
				}
			},complete:function(){
                $('#formcity').loading('stop');
            }
            });
		});
	//============================================ hitung estimasi tujuan
		function hitung_ck(harga,tujuan){
			var berat = $("#berat_ck").val();
			var volume = $("#volume_ck").val();
			if(berat!='' && volume!=''){
			if(parseInt(berat) > parseInt(volume)){
					var jumlah = harga*berat;
				}else{
					var jumlah = harga*volume;
				}
			$("#biaya_kirim_ck").val(jumlah);
			$("#b_kirim_ck").html(rupiah(jumlah));
			hitung_total_ck();		
		}}
	//============================================ hitung total biaya
		function hitung_total_ck(){
			var b_kirim = $("#biaya_kirim_ck").val();
			var b_packing = $("#biaya_packing_ck").val();
			var b_asuransi = $("#biaya_asuransi_ck").val();
			var dibayar = $("#dibayar_ck").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#subtotal_ck").html(rupiah(totalnya));

			if(dibayar >= totalnya){
				var totalakhir = parseInt(dibayar) - totalnya;
				$('#status_bayar_ck').val('lunas');
				$('#ketuang_ck').html('Kembalian');
			}else{
				var totalakhir = totalnya - parseInt(dibayar);
				$('#status_bayar_ck').val('belum_lunas');
				$('#ketuang_ck').html('Kekurangan');
			}
			$("#total_ck").html(rupiah(totalakhir));
		}
	//============================================ hitung total biaya
		$("#biaya_asuransi_ck").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi_ck").val();
			$("#b_asuransi_ck").html(rupiah(biaya_asu));
			hitung_total_ck();	
			}
			
		})
	//============================================ hitung total biaya
		$("#dibayar_ck").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_bayar = $("#dibayar_ck").val();
			$("#b_dibayar_ck").html(rupiah(biaya_bayar));
			hitung_total_ck();	
			}
			
		})
	//============================================ hitung total
		$("#biaya_kirim_ck").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_ck").val();
			$("#b_kirim_ck").html(rupiah(biaya_kirim));
			hitung_total_ck();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_packing_ck").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing_ck").val();
			$("#b_packing_ck").html(rupiah(biaya_pack));
			hitung_total_ck();		
			}
			
		})
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_ck").on('select2:close',function(e){
			$('#n_pengirim_ck').focus();
		});
	//============================================ simpan transaksi
		$("#btnsimpan_ck").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_ck").val();
			var d_panjang	= $("#d_panjang_ck").val();
			var d_tinggi	= $("#d_tinggi_ck").val();
			var d_lebar		= $("#d_lebar_ck").val();
			var volume		= $("#volume_ck").val();
			var jumlah		= $("#jumlah_ck").val();
			var berat		= $("#berat_ck").val();
			var kota_asal	= $("#kota_asal_ck").val();
			var isi_kota_tujuan = $('#kota_tujuan_ck').val();
			var a_pengirim 	= $("#alamat_pengirim_ck").val();
			var a_penerima	= $("#alamat_penerima_ck").val();
			var n_pengirim 	= $("#n_pengirim_ck").val();
			var t_pengirim	= $("#t_pengirim_ck").val();
			var n_penerima	= $("#n_penerima_ck").val();
			var t_penerima 	= $("#t_penerima_ck").val();
			var biaya_kirim	= $("#biaya_kirim_ck").val();
			var biaya_packing = $("#biaya_packing_ck").val();
			var biaya_asu 	= $("#biaya_asuransi_ck").val();
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_ck').val();
			var ppn 		= 0;
			var total_biaya = parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode_ck").val();
			var status_bayar = $('#status_bayar_ck').val();
			var dibayar = $("#dibayar_ck").val();
			if(dibayar==''||a_pengirim==''||a_penerima==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || isi_kota_tujuan==null || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var dats = $('#kota_tujuan_ck').select2('data');
				var kota_tujuan = dats[0].text;
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanubahck',
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
                    cetakresick();
                	//window.location.href = "/listpengiriman";
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
	//===========================================================
	$(".btnselesai").click(function(e){
		e.preventDefault();
            e.stopImmediatePropagation();
            var foo = "bar";
    if(foo=="bar"){
        var isgood = confirm('Apakah anda yakin telah selesai ?');
        if(isgood){
            location.reload();  
        }
    }
	})
	//=============================================================
		function cetakresick(){
		tempelresick();

		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
	}
	//============================================ tempel ck
		function tempelresick(){
			var dats = $('#kota_tujuan_ck').select2('data');
			var kota_tujuan = dats[0].text;
			$('#cetak_pengiriman_via').html("Pengiriman Via : City Kurier");
			$('#cetak_pengiriman_via2').html("Pengiriman Via : City Kurier");
			$('#cetak_pengiriman_via3').html("Pengiriman Via : City Kurier");
			$('#cetak_pengiriman_via4').html("Pengiriman Via : City Kurier");
			$("#cetak_resi").html($("#koderesinya").val());
			$("#cetak_resi2").html($("#koderesinya").val());
			$("#cetak_resi3").html($("#koderesinya").val());
			$("#cetak_resi4").html($("#koderesinya").val());
			$("#cetak_metode").html($("#metode_ck").val());
			$("#cetak_metode2").html($("#metode_ck").val());
			$("#cetak_metode3").html($("#metode_ck").val());
			$("#cetak_metode4").html($("#metode_ck").val());
			$("#cetak_kota_tujuan").html(kota_tujuan);
			$("#cetak_kota_tujuan2").html(kota_tujuan);
			$("#cetak_kota_tujuan3").html(kota_tujuan);
			$("#cetak_kota_tujuan4").html(kota_tujuan);
			$("#cetak_alamat_pengirim").html($("#alamat_pengirim_ck").val());
			$("#cetak_alamat_pengirim2").html($("#alamat_pengirim_ck").val());
			$("#cetak_alamat_pengirim3").html($("#alamat_pengirim_ck").val());
			$("#cetak_alamat_pengirim4").html($("#alamat_pengirim_ck").val());
			$("#cetak_alamat_penerima").html($("#alamat_penerima_ck").val());
			$("#cetak_alamat_penerima2").html($("#alamat_penerima_ck").val());
			$("#cetak_alamat_penerima3").html($("#alamat_penerima_ck").val());
			$("#cetak_alamat_penerima4").html($("#alamat_penerima_ck").val());

			$("#cetak_kota_asal").html($("#kota_asal_ck").val());

			if(satuan_ck=='koli'){
			$("#cetak_jumlah_barang").html($("#jumlah_ck").val()+" "+satuan);
			$("#cetak_jumlah_barang2").html($("#jumlah_ck").val()+" "+satuan);
			$("#cetak_jumlah_barang3").html($("#jumlah_ck").val()+" "+satuan);
			$("#cetak_jumlah_barang4").html($("#jumlah_ck").val()+" "+satuan);
			}else{
			$("#cetak_jumlah_barang").html($("#jumlah_ck").val());
			$("#cetak_jumlah_barang2").html($("#jumlah_ck").val());
			$("#cetak_jumlah_barang3").html($("#jumlah_ck").val());
			$("#cetak_jumlah_barang4").html($("#jumlah_ck").val());
			}
			$("#cetak_berat").html($("#berat_ck").val()+" Kg");
			$("#cetak_dimensi").html($("#d_panjang_ck").val()+" cm x "+$("#d_lebar_ck").val()+" cm x "+$("#d_tinggi_ck").val()+" cm");
			$("#cetak_volumetrik").html($("#volume_ck").val()+" Kg");
			$("#cetak_pengirim").html($("#n_pengirim_ck").val());
			$("#cetak_telp_pengirim").html($("#t_pengirim_ck").val());
			$("#cetak_penerima").html($("#n_penerima_ck").val());
			$("#cetak_telp_penerima").html($("#t_penerima_ck").val());
			$("#cetak_isi_paket").html($("#nama_barang_ck").val());
			$("#cetak_biaya_kirim").html("Rp. "+rupiah($("#biaya_kirim_ck").val()));
			$("#cetak_biaya_packing").html("Rp. "+rupiah($("#biaya_packing_ck").val()));
			$("#cetak_biaya_asu").html("Rp. "+rupiah($("#biaya_asuransi_ck").val()));
			
			var b_kirim = $("#biaya_kirim_ck").val();
			var b_packing = $("#biaya_packing_ck").val();
			var b_asuransi = $("#biaya_asuransi_ck").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#cetak_total").html("Rp. " + rupiah(totalnya));

			var d = new Date();
			var tanggal = d.getDate()+" - "+(d.getMonth()+1)+" - "+d.getFullYear();
			
			//========================================================
			$("#cetak_kota_asal2").html($("#kota_asal_ck").val());
			$("#cetak_berat2").html($("#berat_ck").val()+" Kg");
			$("#cetak_dimensi2").html($("#d_panjang_ck").val()+" cm x "+$("#d_lebar_ck").val()+" cm x "+$("#d_tinggi_ck").val()+" cm");
			$("#cetak_volumetrik2").html($("#volume_ck").val()+" Kg");
			$("#cetak_pengirim2").html($("#n_pengirim_ck").val());
			$("#cetak_telp_pengirim2").html($("#t_pengirim_ck").val());
			$("#cetak_penerima2").html($("#n_penerima_ck").val());
			$("#cetak_telp_penerima2").html($("#t_penerima_ck").val());
			$("#cetak_isi_paket2").html($("#nama_barang_ck").val());
			$("#cetak_biaya_kirim2").html("Rp. "+rupiah($("#biaya_kirim_ck").val()));
			$("#cetak_biaya_packing2").html("Rp. "+rupiah($("#biaya_packing_ck").val()));
			$("#cetak_biaya_asu2").html("Rp. "+rupiah($("#biaya_asuransi_ck").val()));
			$("#cetak_total2").html("Rp. "+rupiah(totalnya));
			
			//===========================================================
			$("#cetak_kota_asal3").html($("#kota_asal_ck").val());
			$("#cetak_berat3").html($("#berat_ck").val()+" Kg");
			$("#cetak_dimensi3").html($("#d_panjang_ck").val()+" cm x "+$("#d_lebar_ck").val()+" cm x "+$("#d_tinggi_ck").val()+" cm");
			$("#cetak_volumetrik3").html($("#volume_ck").val()+" Kg");
			$("#cetak_pengirim3").html($("#n_pengirim_ck").val());
			$("#cetak_telp_pengirim3").html($("#t_pengirim_ck").val());
			$("#cetak_penerima3").html($("#n_penerima_ck").val());
			$("#cetak_telp_penerima3").html($("#t_penerima_ck").val());
			$("#cetak_isi_paket3").html($("#nama_barang_ck").val());
			// $("#cetak_biaya_kirim3").html("Rp. "+rupiah($("#biaya_kirim").val()));
			// $("#cetak_biaya_packing3").html("Rp. "+rupiah($("#biaya_packing").val()));
			// $("#cetak_biaya_asu3").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			// $("#cetak_total3").html("Rp. "+rupiah(totalnya));
			
		//============================================================
			$("#cetak_kota_asal4").html($("#kota_asal_ck").val());
			$("#cetak_berat4").html($("#berat_ck").val()+" Kg");
			$("#cetak_dimensi4").html($("#d_panjang_ck").val()+" cm x "+$("#d_lebar_ck").val()+" cm x "+$("#d_tinggi_ck").val()+" cm");
			$("#cetak_volumetrik4").html($("#volume_ck").val()+" Kg");
			$("#cetak_pengirim4").html($("#n_pengirim_ck").val());
			$("#cetak_telp_pengirim4").html($("#t_pengirim_ck").val());
			$("#cetak_penerima4").html($("#n_penerima_ck").val());
			$("#cetak_telp_penerima4").html($("#t_penerima_ck").val());
			$("#cetak_isi_paket4").html($("#nama_barang_ck").val());
			// $("#cetak_biaya_kirim4").html("Rp. "+rupiah($("#biaya_kirim").val()));
			// $("#cetak_biaya_packing4").html("Rp. "+rupiah($("#biaya_packing").val()));
			// $("#cetak_biaya_asu4").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			// $("#cetak_total4").html("Rp. "+rupiah(totalnya));
			
		}


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
			var vt = parseFloat(total);
			$("#volume_darat").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume_darat").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume_darat").val(vt.toFixed());
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
		$('#formdarat').loading('toggle');
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
								$("#biaya_kirim_darat").val(0);
								$("#b_kirim_darat").html(0);
								hitung_total();
							}
					})
				}
			},complete:function(){
                $('#formdarat').loading('stop');
            }
            });
		});
	//================================================
	$("#berat_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var berat = $("#berat_laut").val();
			var vt = parseFloat(berat);
			$("#berat_laut").val(vt.toFixed());
			}
			
		})
	//================================================
	$("#berat_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var berat = $("#berat_darat").val();
			var vt = parseFloat(berat);
			$("#berat_darat").val(vt.toFixed());
			}
			
		})
	//============================================ hitung estimasi tujuan
		function hitung(harga,tujuan){
			var berat = $("#berat_darat").val();
			var volume = $("#volume_darat").val();
			if(berat!='' && volume!=''){
			if(parseInt(berat)>parseInt(volume)){
					var jumlah  = harga*berat;
				}else{
					var jumlah  = harga*volume;
				}
			$("#biaya_kirim_darat").val(jumlah);
			$("#b_kirim_darat").html(rupiah(jumlah));
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
			var dibayar = $("#dibayar_darat").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#subtotal_darat").html(rupiah(totalnya));

			if(dibayar >= totalnya){
				var totalakhir = parseInt(dibayar) - totalnya;
				$('#status_bayar_darat').val('lunas');
				$('#ketuang_darat').html('Kembalian');
			}else{
				var totalakhir = totalnya - parseInt(dibayar);
				$('#status_bayar_darat').val('belum_lunas');
				$('#ketuang_darat').html('Kekurangan');
			}
			$("#total_darat").html(rupiah(totalakhir));
		}
	//============================================ hitung total biaya
		$("#biaya_asuransi_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi_darat").val();
			$("#b_asuransi_darat").html(rupiah(biaya_asu));
			hitung_total();	
			}
			
		})
	//============================================ hitung total biaya
		$("#dibayar_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_bayar = $("#dibayar_darat").val();
			$("#b_dibayar_darat").html(rupiah(biaya_bayar));
			hitung_total();	
			}
			
		})
	//============================================ hitung total
		$("#biaya_kirim_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_darat").val();
			$("#b_kirim_darat").html(rupiah(biaya_kirim));
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
			var isi_kota_tujuan = $('#kota_tujuan_darat').val();
			var a_pengirim 	= $("#alamat_pengirim_darat").val();
			var a_penerima	= $("#alamat_penerima_darat").val();
			var n_pengirim 	= $("#n_pengirim_darat").val();
			var t_pengirim	= $("#t_pengirim_darat").val();
			var n_penerima	= $("#n_penerima_darat").val();
			var t_penerima 	= $("#t_penerima_darat").val();
			var biaya_kirim	= $("#biaya_kirim_darat").val();
			var biaya_packing = $("#biaya_packing_darat").val();
			var biaya_asu 	= $("#biaya_asuransi_darat").val();
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_darat').val();
			var ppn 		= 0;
			var total_biaya = parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode_darat").val();
			var status_bayar = $('#status_bayar_darat').val();
			var dibayar = $("#dibayar_darat").val();
			if(dibayar=='' || a_penerima=='' || a_pengirim=='' || nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || isi_kota_tujuan==null || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var dats = $('#kota_tujuan_darat').select2('data');
				var kota_tujuan = dats[0].text;
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanubahdarat',
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
                    cetakresidarat();
                	
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
	//=============================================================
		function cetakresidarat(){
		tempelresidarat();

		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
	}
	//============================================ tempel laut
		function tempelresidarat(){
			var dats = $('#kota_tujuan_darat').select2('data');
			var kota_tujuan = dats[0].text;
			$('#cetak_pengiriman_via').html("Pengiriman Via : Darat");
			$('#cetak_pengiriman_via2').html("Pengiriman Via : Darat");
			$('#cetak_pengiriman_via3').html("Pengiriman Via : Darat");
			$('#cetak_pengiriman_via4').html("Pengiriman Via : Darat");
			$("#cetak_resi").html($("#koderesinya").val());
			$("#cetak_resi2").html($("#koderesinya").val());
			$("#cetak_resi3").html($("#koderesinya").val());
			$("#cetak_resi4").html($("#koderesinya").val());
			$("#cetak_metode").html($("#metode_darat").val());
			$("#cetak_metode2").html($("#metode_darat").val());
			$("#cetak_metode3").html($("#metode_darat").val());
			$("#cetak_metode4").html($("#metode_darat").val());
			$("#cetak_kota_tujuan").html(kota_tujuan);
			$("#cetak_kota_tujuan2").html(kota_tujuan);
			$("#cetak_kota_tujuan3").html(kota_tujuan);
			$("#cetak_kota_tujuan4").html(kota_tujuan);
			$("#cetak_alamat_pengirim").html($("#alamat_pengirim_darat").val());
			$("#cetak_alamat_pengirim2").html($("#alamat_pengirim_darat").val());
			$("#cetak_alamat_pengirim3").html($("#alamat_pengirim_darat").val());
			$("#cetak_alamat_pengirim4").html($("#alamat_pengirim_darat").val());
			$("#cetak_alamat_penerima").html($("#alamat_penerima_darat").val());
			$("#cetak_alamat_penerima2").html($("#alamat_penerima_darat").val());
			$("#cetak_alamat_penerima3").html($("#alamat_penerima_darat").val());
			$("#cetak_alamat_penerima4").html($("#alamat_penerima_darat").val());

			$("#cetak_kota_asal").html($("#kota_asal_darat").val());

			if(satuan_laut=='koli'){
			$("#cetak_jumlah_barang").html($("#jumlah_darat").val()+" "+satuan);
			$("#cetak_jumlah_barang2").html($("#jumlah_darat").val()+" "+satuan);
			$("#cetak_jumlah_barang3").html($("#jumlah_darat").val()+" "+satuan);
			$("#cetak_jumlah_barang4").html($("#jumlah_darat").val()+" "+satuan);
			}else{
			$("#cetak_jumlah_barang").html($("#jumlah_darat").val());
			$("#cetak_jumlah_barang2").html($("#jumlah_darat").val());
			$("#cetak_jumlah_barang3").html($("#jumlah_darat").val());
			$("#cetak_jumlah_barang4").html($("#jumlah_darat").val());
			}
			$("#cetak_berat").html($("#berat_darat").val()+" Kg");
			$("#cetak_dimensi").html($("#d_panjang_darat").val()+" cm x "+$("#d_lebar_darat").val()+" cm x "+$("#d_tinggi_darat").val()+" cm");
			$("#cetak_volumetrik").html($("#volume_darat").val()+" Kg");
			$("#cetak_pengirim").html($("#n_pengirim_darat").val());
			$("#cetak_telp_pengirim").html($("#t_pengirim_darat").val());
			$("#cetak_penerima").html($("#n_penerima_darat").val());
			$("#cetak_telp_penerima").html($("#t_penerima_darat").val());
			$("#cetak_isi_paket").html($("#nama_barang_darat").val());
			$("#cetak_biaya_kirim").html("Rp. "+rupiah($("#biaya_kirim_darat").val()));
			$("#cetak_biaya_packing").html("Rp. "+rupiah($("#biaya_packing_darat").val()));
			$("#cetak_biaya_asu").html("Rp. "+rupiah($("#biaya_asuransi_darat").val()));
			
			var b_kirim = $("#biaya_kirim_darat").val();
			var b_packing = $("#biaya_packing_darat").val();
			var b_asuransi = $("#biaya_asuransi_darat").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#cetak_total").html("Rp. " + rupiah(totalnya));

			var d = new Date();
			var tanggal = d.getDate()+" - "+(d.getMonth()+1)+" - "+d.getFullYear();
			
			//========================================================
			$("#cetak_kota_asal2").html($("#kota_asal_darat").val());
			$("#cetak_berat2").html($("#berat_darat").val()+" Kg");
			$("#cetak_dimensi2").html($("#d_panjang_darat").val()+" cm x "+$("#d_lebar_darat").val()+" cm x "+$("#d_tinggi_darat").val()+" cm");
			$("#cetak_volumetrik2").html($("#volume_darat").val()+" Kg");
			$("#cetak_pengirim2").html($("#n_pengirim_darat").val());
			$("#cetak_telp_pengirim2").html($("#t_pengirim_darat").val());
			$("#cetak_penerima2").html($("#n_penerima_darat").val());
			$("#cetak_telp_penerima2").html($("#t_penerima_darat").val());
			$("#cetak_isi_paket2").html($("#nama_barang_darat").val());
			$("#cetak_biaya_kirim2").html("Rp. "+rupiah($("#biaya_kirim_darat").val()));
			$("#cetak_biaya_packing2").html("Rp. "+rupiah($("#biaya_packing_darat").val()));
			$("#cetak_biaya_asu2").html("Rp. "+rupiah($("#biaya_asuransi_darat").val()));
			$("#cetak_total2").html("Rp. "+rupiah(totalnya));
			
			//===========================================================
			$("#cetak_kota_asal3").html($("#kota_asal_darat").val());
			$("#cetak_berat3").html($("#berat_darat").val()+" Kg");
			$("#cetak_dimensi3").html($("#d_panjang_darat").val()+" cm x "+$("#d_lebar_darat").val()+" cm x "+$("#d_tinggi_darat").val()+" cm");
			$("#cetak_volumetrik3").html($("#volume_darat").val()+" Kg");
			$("#cetak_pengirim3").html($("#n_pengirim_darat").val());
			$("#cetak_telp_pengirim3").html($("#t_pengirim_darat").val());
			$("#cetak_penerima3").html($("#n_penerima_darat").val());
			$("#cetak_telp_penerima3").html($("#t_penerima_darat").val());
			$("#cetak_isi_paket3").html($("#nama_barang_darat").val());
			// $("#cetak_biaya_kirim3").html("Rp. "+rupiah($("#biaya_kirim").val()));
			// $("#cetak_biaya_packing3").html("Rp. "+rupiah($("#biaya_packing").val()));
			// $("#cetak_biaya_asu3").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			// $("#cetak_total3").html("Rp. "+rupiah(totalnya));
			
		//============================================================
			$("#cetak_kota_asal4").html($("#kota_asal_darat").val());
			$("#cetak_berat4").html($("#berat_darat").val()+" Kg");
			$("#cetak_dimensi4").html($("#d_panjang_darat").val()+" cm x "+$("#d_lebar_darat").val()+" cm x "+$("#d_tinggi_darat").val()+" cm");
			$("#cetak_volumetrik4").html($("#volume_darat").val()+" Kg");
			$("#cetak_pengirim4").html($("#n_pengirim_darat").val());
			$("#cetak_telp_pengirim4").html($("#t_pengirim_darat").val());
			$("#cetak_penerima4").html($("#n_penerima_darat").val());
			$("#cetak_telp_penerima4").html($("#t_penerima_darat").val());
			$("#cetak_isi_paket4").html($("#nama_barang_darat").val());
			// $("#cetak_biaya_kirim4").html("Rp. "+rupiah($("#biaya_kirim").val()));
			// $("#cetak_biaya_packing4").html("Rp. "+rupiah($("#biaya_packing").val()));
			// $("#cetak_biaya_asu4").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			// $("#cetak_total4").html("Rp. "+rupiah(totalnya));
			
		}


	//###############################halaman laut
	$('#satuan_laut').on('change',function(e){
		satuan_laut = this.value;
	})
	//============================================ hitung volumetrik
		$("#d_panjang_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_laut = $("#d_panjang_laut").val();
			var lebar_laut = $("#d_lebar_laut").val();
			var tinggi_laut = $("#d_tinggi_laut").val();
			var total_laut =  (parseInt(panjang_laut) *  parseInt(lebar_laut) *  parseInt(tinggi_laut))/4000;
			var vt = parseFloat(total_laut);
			$("#volume_laut").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_laut = $("#d_panjang_laut").val();
			var lebar_laut = $("#d_lebar_laut").val();
			var tinggi_laut = $("#d_tinggi_laut").val();
			var total_laut =  (parseInt(panjang_laut) *  parseInt(lebar_laut) *  parseInt(tinggi_laut))/4000;
			var vt = parseFloat(total_laut);
			$("#volume_laut").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_laut = $("#d_panjang_laut").val();
			var lebar_laut = $("#d_lebar_laut").val();
			var tinggi_laut = $("#d_tinggi_laut").val();
			var total_laut =  (parseInt(panjang_laut) *  parseInt(lebar_laut) *  parseInt(tinggi_laut))/4000;
			var vt = parseFloat(total_laut);
			$("#volume_laut").val(vt.toFixed());
			}
			
		})
	//=============================================cari kota tujuan
		$('#kota_tujuan_laut').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/carilaut',
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
	$('#kota_tujuan_laut').on('select2:select',function(e){
			$('#formlaut').loading('toggle');
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasillaut/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan_laut=='kg'){
								hitung_laut(item.tarif,item.tujuan);
							}else{
								$("#biaya_kirim_laut").val(0);
								$("#b_kirim_laut").html(0);
								hitung_total_laut();
							}
					})
				}
			},complete:function(){
                $('#formlaut').loading('stop');
            }
            });
		});
	//============================================ hitung estimasi tujuan
		function hitung_laut(harga,tujuan){
			var berat = $("#berat_laut").val();
			var volume = $("#volume_laut").val();
			if(berat!='' && volume!=''){
			if(parseInt(berat) > parseInt(volume)){
					var jumlah = harga*berat;
				}else{
					var jumlah = harga*volume;
				}
			$("#biaya_kirim_laut").val(jumlah);
			$("#b_kirim_laut").html(rupiah(jumlah));
			hitung_total_laut();		
		}}
	//============================================ hitung total biaya
		function hitung_total_laut(){
			var b_kirim = $("#biaya_kirim_laut").val();
			var b_packing = $("#biaya_packing_laut").val();
			var b_asuransi = $("#biaya_asuransi_laut").val();
			var dibayar = $("#dibayar_laut").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#subtotal_laut").html(rupiah(totalnya));

			if(dibayar >= totalnya){
				var totalakhir = parseInt(dibayar) - totalnya;
				$('#status_bayar_laut').val('lunas');
				$('#ketuang_laut').html('Kembalian');
			}else{
				var totalakhir = totalnya - parseInt(dibayar);
				$('#status_bayar_laut').val('belum_lunas');
				$('#ketuang_laut').html('Kekurangan');
			}
			$("#total_laut").html(rupiah(totalakhir));
		}
	//============================================ hitung total biaya
		$("#biaya_asuransi_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi_laut").val();
			$("#b_asuransi_laut").html(rupiah(biaya_asu));
			hitung_total_laut();	
			}
			
		})
	//============================================ hitung total biaya
		$("#dibayar_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_bayar = $("#dibayar_laut").val();
			$("#b_dibayar_laut").html(rupiah(biaya_bayar));
			hitung_total_laut();	
			}
			
		})
	//============================================ hitung total
		$("#biaya_kirim_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_laut").val();
			$("#b_kirim_laut").html(rupiah(biaya_kirim));
			hitung_total_laut();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_packing_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing_laut").val();
			$("#b_packing_laut").html(rupiah(biaya_pack));
			hitung_total_laut();		
			}
			
		})
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_laut").on('select2:close',function(e){
			$('#n_pengirim_laut').focus();
		});
	//============================================ simpan transaksi
		$("#btnsimpan_laut").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_laut").val();
			var d_panjang	= $("#d_panjang_laut").val();
			var d_tinggi	= $("#d_tinggi_laut").val();
			var d_lebar		= $("#d_lebar_laut").val();
			var volume		= $("#volume_laut").val();
			var jumlah		= $("#jumlah_laut").val();
			var berat		= $("#berat_laut").val();
			var kota_asal	= $("#kota_asal_laut").val();
			var isi_kota_tujuan = $('#kota_tujuan_laut').val();
			
			var a_pengirim 	= $("#alamat_pengirim_laut").val();
			var a_penerima	= $("#alamat_penerima_laut").val();

			var n_pengirim 	= $("#n_pengirim_laut").val();
			var t_pengirim	= $("#t_pengirim_laut").val();

			var n_penerima	= $("#n_penerima_laut").val();
			var t_penerima 	= $("#t_penerima_laut").val();

			var biaya_kirim	= $("#biaya_kirim_laut").val();
			var biaya_packing = $("#biaya_packing_laut").val();
			var biaya_asu 	= $("#biaya_asuransi_laut").val();
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_laut').val();
			var ppn 		= 0;
			var total_biaya = parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode_laut").val();
			var status_bayar = $('#status_bayar_laut').val();
			var dibayar = $("#dibayar_laut").val();
			if(dibayar==''||a_pengirim==''||a_penerima==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || isi_kota_tujuan==null || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var dats = $('#kota_tujuan_laut').select2('data');
				var kota_tujuan = dats[0].text;
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanubahlaut',
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
                    cetakresilaut();
                	//window.location.href = "/listpengiriman";
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
	//===========================================================
	$(".btnselesai").click(function(e){
		window.location.href = "/listpengiriman";
	})
	//=============================================================
		function cetakresilaut(){
		tempelresilaut();

		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
	}
	//============================================ tempel laut
		function tempelresilaut(){
			var dats = $('#kota_tujuan_laut').select2('data');
			var kota_tujuan = dats[0].text;
			$('#cetak_pengiriman_via').html("Pengiriman Via : Laut");
			$('#cetak_pengiriman_via2').html("Pengiriman Via : Laut");
			$('#cetak_pengiriman_via3').html("Pengiriman Via : Laut");
			$('#cetak_pengiriman_via4').html("Pengiriman Via : Laut");
			$("#cetak_resi").html($("#koderesinya").val());
			$("#cetak_resi2").html($("#koderesinya").val());
			$("#cetak_resi3").html($("#koderesinya").val());
			$("#cetak_resi4").html($("#koderesinya").val());
			$("#cetak_metode").html($("#metode_laut").val());
			$("#cetak_metode2").html($("#metode_laut").val());
			$("#cetak_metode3").html($("#metode_laut").val());
			$("#cetak_metode4").html($("#metode_laut").val());
			$("#cetak_kota_tujuan").html(kota_tujuan);
			$("#cetak_kota_tujuan2").html(kota_tujuan);
			$("#cetak_kota_tujuan3").html(kota_tujuan);
			$("#cetak_kota_tujuan4").html(kota_tujuan);
			$("#cetak_alamat_pengirim").html($("#alamat_pengirim_laut").val());
			$("#cetak_alamat_pengirim2").html($("#alamat_pengirim_laut").val());
			$("#cetak_alamat_pengirim3").html($("#alamat_pengirim_laut").val());
			$("#cetak_alamat_pengirim4").html($("#alamat_pengirim_laut").val());
			$("#cetak_alamat_penerima").html($("#alamat_penerima_laut").val());
			$("#cetak_alamat_penerima2").html($("#alamat_penerima_laut").val());
			$("#cetak_alamat_penerima3").html($("#alamat_penerima_laut").val());
			$("#cetak_alamat_penerima4").html($("#alamat_penerima_laut").val());

			$("#cetak_kota_asal").html($("#kota_asal_laut").val());

			if(satuan_laut=='koli'){
			$("#cetak_jumlah_barang").html($("#jumlah_laut").val()+" "+satuan);
			$("#cetak_jumlah_barang2").html($("#jumlah_laut").val()+" "+satuan);
			$("#cetak_jumlah_barang3").html($("#jumlah_laut").val()+" "+satuan);
			$("#cetak_jumlah_barang4").html($("#jumlah_laut").val()+" "+satuan);
			}else{
			$("#cetak_jumlah_barang").html($("#jumlah_laut").val());
			$("#cetak_jumlah_barang2").html($("#jumlah_laut").val());
			$("#cetak_jumlah_barang3").html($("#jumlah_laut").val());
			$("#cetak_jumlah_barang4").html($("#jumlah_laut").val());
			}
			$("#cetak_berat").html($("#berat_laut").val()+" Kg");
			$("#cetak_dimensi").html($("#d_panjang_laut").val()+" cm x "+$("#d_lebar_laut").val()+" cm x "+$("#d_tinggi_laut").val()+" cm");
			$("#cetak_volumetrik").html($("#volume_laut").val()+" Kg");
			$("#cetak_pengirim").html($("#n_pengirim_laut").val());
			$("#cetak_telp_pengirim").html($("#t_pengirim_laut").val());
			$("#cetak_penerima").html($("#n_penerima_laut").val());
			$("#cetak_telp_penerima").html($("#t_penerima_laut").val());
			$("#cetak_isi_paket").html($("#nama_barang_laut").val());
			$("#cetak_biaya_kirim").html("Rp. "+rupiah($("#biaya_kirim_laut").val()));
			$("#cetak_biaya_packing").html("Rp. "+rupiah($("#biaya_packing_laut").val()));
			$("#cetak_biaya_asu").html("Rp. "+rupiah($("#biaya_asuransi_laut").val()));
			
			var b_kirim = $("#biaya_kirim_laut").val();
			var b_packing = $("#biaya_packing_laut").val();
			var b_asuransi = $("#biaya_asuransi_laut").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#cetak_total").html("Rp. " + rupiah(totalnya));

			var d = new Date();
			var tanggal = d.getDate()+" - "+(d.getMonth()+1)+" - "+d.getFullYear();
			
			//========================================================
			$("#cetak_kota_asal2").html($("#kota_asal_laut").val());
			$("#cetak_berat2").html($("#berat_laut").val()+" Kg");
			$("#cetak_dimensi2").html($("#d_panjang_laut").val()+" cm x "+$("#d_lebar_laut").val()+" cm x "+$("#d_tinggi_laut").val()+" cm");
			$("#cetak_volumetrik2").html($("#volume_laut").val()+" Kg");
			$("#cetak_pengirim2").html($("#n_pengirim_laut").val());
			$("#cetak_telp_pengirim2").html($("#t_pengirim_laut").val());
			$("#cetak_penerima2").html($("#n_penerima_laut").val());
			$("#cetak_telp_penerima2").html($("#t_penerima_laut").val());
			$("#cetak_isi_paket2").html($("#nama_barang_laut").val());
			$("#cetak_biaya_kirim2").html("Rp. "+rupiah($("#biaya_kirim_laut").val()));
			$("#cetak_biaya_packing2").html("Rp. "+rupiah($("#biaya_packing_laut").val()));
			$("#cetak_biaya_asu2").html("Rp. "+rupiah($("#biaya_asuransi_laut").val()));
			$("#cetak_total2").html("Rp. "+rupiah(totalnya));
			
			//===========================================================
			$("#cetak_kota_asal3").html($("#kota_asal_laut").val());
			$("#cetak_berat3").html($("#berat_laut").val()+" Kg");
			$("#cetak_dimensi3").html($("#d_panjang_laut").val()+" cm x "+$("#d_lebar_laut").val()+" cm x "+$("#d_tinggi_laut").val()+" cm");
			$("#cetak_volumetrik3").html($("#volume_laut").val()+" Kg");
			$("#cetak_pengirim3").html($("#n_pengirim_laut").val());
			$("#cetak_telp_pengirim3").html($("#t_pengirim_laut").val());
			$("#cetak_penerima3").html($("#n_penerima_laut").val());
			$("#cetak_telp_penerima3").html($("#t_penerima_laut").val());
			$("#cetak_isi_paket3").html($("#nama_barang_laut").val());
			// $("#cetak_biaya_kirim3").html("Rp. "+rupiah($("#biaya_kirim").val()));
			// $("#cetak_biaya_packing3").html("Rp. "+rupiah($("#biaya_packing").val()));
			// $("#cetak_biaya_asu3").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			// $("#cetak_total3").html("Rp. "+rupiah(totalnya));
			
		//============================================================
			$("#cetak_kota_asal4").html($("#kota_asal_laut").val());
			$("#cetak_berat4").html($("#berat_laut").val()+" Kg");
			$("#cetak_dimensi4").html($("#d_panjang_laut").val()+" cm x "+$("#d_lebar_laut").val()+" cm x "+$("#d_tinggi_laut").val()+" cm");
			$("#cetak_volumetrik4").html($("#volume_laut").val()+" Kg");
			$("#cetak_pengirim4").html($("#n_pengirim_laut").val());
			$("#cetak_telp_pengirim4").html($("#t_pengirim_laut").val());
			$("#cetak_penerima4").html($("#n_penerima_laut").val());
			$("#cetak_telp_penerima4").html($("#t_penerima_laut").val());
			$("#cetak_isi_paket4").html($("#nama_barang_laut").val());
			// $("#cetak_biaya_kirim4").html("Rp. "+rupiah($("#biaya_kirim").val()));
			// $("#cetak_biaya_packing4").html("Rp. "+rupiah($("#biaya_packing").val()));
			// $("#cetak_biaya_asu4").html("Rp. "+rupiah($("#biaya_asuransi").val()));
			// $("#cetak_total4").html("Rp. "+rupiah(totalnya));
			
		}
	//###############################halaman udara
	//===================================
	function hitungbiayakirim(berat){
		var newberat = Number(berat);

		var barangheavy = carihevy($('#min_heavy').val());
		var neperkg =  $('#bpk').val().replace(/\./g,'');
		var perkg = Number(neperkg);
		if(perkg > 0){
			if(satuan_udara == 'kg'){
				if(barangheavy > 0){
					$('#biaya_kirim_udara').val(0);
					$('#b_kirim_udara').html(0);
					$('#b_charge_udara').html(0);
				}else{
					if (kategori_udara=='biasa'){
						var jumlah  = perkg*newberat;
						$('#b_charge_udara').html(0);
						$('#biaya_kirim_udara').val(jumlah);
						$('#b_kirim_udara').html(rupiah(jumlah));
					}else{
						var jumlah  = perkg*newberat;
						var totalcarge = (jumlah*kategori_udara)/100;
						$('#b_charge_udara').html(rupiah(totalcarge));
						$('#biaya_kirim_udara').val(jumlah);
						$('#b_kirim_udara').html(rupiah(jumlah));
						}
					}
					}else{
					$('#biaya_kirim_udara').val(0);
					$('#b_kirim_udara').html(0);
					$('#b_charge_udara').html(0);}
					hitung_total_udara();
		}
	}
	//=================================================
	function carihevy(nomer){
		if (nomer>0) {
			jumlahbaranghevy =0;
		for (var i = 1; i <= jumlahbarang; i++) { 
		var beratbarang=0;
  		var volume = Number(document.getElementById('volume_udara'+i).value);
		var berataktual = Number(document.getElementById('berat_udara'+i).value);
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
	//======================================================
	function hitungberat(){
		totalberat=0;
		for (var i = 1; i <= jumlahbarang; i++) { 
  			var volume = Number(document.getElementById('volume_udara'+i).value);
		var berataktual = Number(document.getElementById('berat_udara'+i).value);
		if(volume > berataktual){
			totalberat += parseFloat(volume);
			beratbaru = parseFloat(berataktual);
		}else{
			totalberat += parseFloat(berataktual);
			beratbaru = parseFloat(berataktual);
		}
		$('#berat_udara'+i).val(beratbaru.toFixed());
		}
		$('#totalberat').val(totalberat.toFixed());
		hitungbiayakirim(totalberat.toFixed());
		$('#jumlah_udara').val(jumlahbarang);
	}
	window.hitungberat=hitungberat;
	//===================================================
	function hayy(nomer){
		var panjang = Number(document.getElementById('d_panjang_udara'+nomer).value);
		var lebar = Number(document.getElementById('d_lebar_udara'+nomer).value);
		var tinggi = Number(document.getElementById('d_tinggi_udara'+nomer).value);
		var total =  (panjang * lebar * tinggi)/6000;
		var vt = parseFloat(total);
		$('#volume_udara'+nomer).val(vt.toFixed());
		hitungberat();
	}
	window.hayy=hayy;
	//=============================================hapus jumlah
	$('#kolomjumlah').on('click', '.removejumlah', function(e) {
    jumlahbarang -=1;
	$('#jumlah_udara').val(jumlahbarang);
	hitungberat();
    e.preventDefault();
	$(this).parent().remove();
	});
	//=============================================tambah jumlah
	$("#tambahjumlah").click(function(){
		jumlahbarang +=1;
		$('#jumlah_udara').val(jumlahbarang);
		$("#kolomjumlah").append(
			'<div class="row" id="rowjumlah'+jumlahbarang+'">'+
			'<div class="col-md-4 col-sm-6">'+
						'<div class="form-group">'+
							'<label class="form-label" for="exampleInputDisabled">Dimensi Dalam Satuan <b>cm</b> (P, L, T)  </label>'+
							'<div class="input-group">'+
								'<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_panjang_udara'+jumlahbarang+'" onchange="hayy('+jumlahbarang+')" value="0">&nbsp;'+
								'<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_lebar_udara'+jumlahbarang+'" onchange="hayy('+jumlahbarang+')" value="0">&nbsp;'+
								'<input type="text" onkeypress="return isNumberKey(event)" class="col-sm-4 col-md-4 form-control" id="d_tinggi_udara'+jumlahbarang+'" onchange="hayy('+jumlahbarang+')" value="0">'+
									
							'</div>'+
						'</div>'+
					'</div>'+
			'<div class="col-md-4 col-sm-6">'+
						'<div class="form-group">'+
							'<label class="form-label" for="exampleInputDisabled">Berat Volumetrik</label>'+
							'<div class="input-group">'+
								'<input type="text" class="form-control" id="volume_udara'+jumlahbarang+'" onchange="hitungberat()" onkeypress="return isNumberKey2(event)"  value="0">'+
								'<div class="input-group-addon">Kg</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 col-sm-5">'+
						'<div class="form-group">'+
							'<label class="form-label" for="exampleInputDisabled">Berat Aktual</label>'+
							'<div class="input-group">'+
								'<input type="text" class="form-control" id="berat_udara'+jumlahbarang+'" onchange="hitungberat()" onkeypress="return isNumberKey2(event)" value="0">'+
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

	//=============================================ganti satuan	
	$('#satuan_udara').on('change',function(e){
		satuan_udara = this.value;
	})
	//=============================================ganti kategori	
	$('#kategori_udara').on('change',function(e){
		kategori_udara = this.value;
		if (kategori_udara=='biasa') {
			var newkat = 0;
		}else{
			var newkat = kategori_udara;
		}
		var biaya_kirim = parseInt($('#biaya_kirim_udara').val());
		if(biaya_kirim > 0){
			var totalcarge = (biaya_kirim*newkat)/100;
			$('#b_charge_udara').html(rupiah(totalcarge));
			hitung_total_udara();
		}else{
			$('#b_charge_udara').html(0);
			hitung_total_udara();
		}
	})
	//===========================================
		$('#kota_tujuan_udara').select2({
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
	$('#kota_tujuan_udara').on('select2:select',function(e){
		$('#formudara').loading('toggle');
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasiludara/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							$('#min_heavy').val(item.minimal_heavy);
							$('#maskapai').val(item.airlans);
							var barangheavy = carihevy(item.minimal_heavy);
							if(satuan_udara == 'kg'){
								if(barangheavy > 0){
								$('#biaya_kirim_udara').val(0);
								$('#b_kirim_udara').html(0);
								$('#b_charge_udara').html(0);
								}else{
								if (kategori_udara=='biasa'){
									$('#status_udara').val('Normal Cargo');
									var berat = $('#totalberat').val();
									var jumlah  = item.perkg*berat;
									$('#b_charge_udara').html(0);
									$('#biaya_kirim_udara').val(jumlah);
									$('#b_kirim_udara').html(rupiah(jumlah));
									
								}else{
									$('#status_udara').val('Normal Cargo');
									var berat = $('#totalberat').val();
									var jumlah  = item.perkg*berat;
									var totalcarge = (jumlah*kategori_udara)/100;
									$('#b_charge_udara').html(rupiah(totalcarge));
									$('#biaya_kirim_udara').val(jumlah);
									$('#b_kirim_udara').html(rupiah(jumlah));
								}
								
							}
							}else{								
								$('#biaya_kirim_udara').val(0);
								$('#b_kirim_udara').html(0);
								$('#b_charge_udara').html(0);
							}
							$('#kta_tujuan_udara').val(item.tujuan);
							kotatujuanudara = item.tujuan;
							$('#ket_pti').html('&emsp;&emsp;Menerangkan bahwa kiriman yang diserahkan untuk diangkut oleh '+item.airlans);
							
							$('#bpk').val(rupiah(item.perkg));
							$('#biaya_smu_udara').val(item.biaya_dokumen);
							$('#b_smu_udara').html(rupiah(item.biaya_dokumen));
							hitung_total_udara();
					})
				}
				
			},complete:function(){
                $('#formudara').loading('stop');
            }
            });
		});
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_udara").on('select2:close',function(e){
			$('#nomer_smu_udara').focus();
		});
	//==============================================
	function hitung_total_udara(){
		var biaya_kirim = parseInt($('#biaya_kirim_udara').val());
		var biaya_dokumen = parseInt($('#biaya_smu_udara').val());
		var biaya_karantina = parseInt($('#biaya_karantina_udara').val());
		var biaya_charge = parseInt($('#b_charge_udara').text().replace(/\./g,''));
		var dibayar = $("#dibayar_udara").val();
		var jumlah = biaya_kirim + biaya_charge + biaya_dokumen + biaya_karantina;
		$('#subtotal_udara').html(rupiah(jumlah));

			if(parseInt(dibayar) >= parseInt(jumlah)){
				var totalakhir = parseInt(dibayar) - jumlah;
				$('#status_bayar_udara').val('lunas');
				$('#ketuang_udara').html('Kembalian');
			}else{
				var totalakhir = jumlah - parseInt(dibayar);
				$('#status_bayar_udara').val('belum_lunas');
				$('#ketuang_udara').html('Kekurangan');
			}
			$("#total_udara").html(rupiah(totalakhir));
	}

	//==============================================
		$("#biaya_kirim_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_udara").val();
			if (kategori_udara!='biasa'){
			var charge = (biaya_kirim*kategori_udara)/100;	
			$('#b_charge_udara').html(rupiah(charge));
			}else{
			$('#b_charge_udara').html(0);
			}
			$("#b_kirim_udara").html(rupiah(biaya_kirim));
			hitung_total_udara();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_smu_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_smu = $("#biaya_smu_udara").val();
			$("#b_smu_udara").html(rupiah(biaya_smu));
			hitung_total_udara();		
			}
			
		})
	//============================================ hitung total biaya
		$("#dibayar_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_bayar = $("#dibayar_udara").val();
			$("#b_dibayar_udara").html(rupiah(biaya_bayar));
			hitung_total_udara();	
			}
			
		})
	//============================================ hitung total	
		$("#biaya_karantina_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_karantina = $("#biaya_karantina_udara").val();
			$("#b_karantina_udara").html(rupiah(biaya_karantina));
			hitung_total_udara();		
			}
			
		})
	//========================================================
	$("#btnsimpan_udara").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();

			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_udara").val();
			var jumlah		= $("#jumlah_udara").val();

			var dimensi = '';
			var subberat = '';
			var volume = '';

			for (var i = 1; i <= jumlah; i++){
				var d_panjang	= $("#d_panjang_udara"+i).val();
				var d_tinggi	= $("#d_tinggi_udara"+i).val();
				var d_lebar		= $("#d_lebar_udara"+i).val();
				var beranya = $('#berat_udara'+i).val();
				var volum = $('#volume_udara'+i).val();

				dimensi = dimensi+""+d_panjang+" x "+d_lebar+" x "+d_tinggi+",";
				subberat = subberat+''+beranya+',';
				volume = volume+''+volum+',';
			}
			
			var berat		= $('#totalberat').val();
			var kota_asal	= $("#kota_asal_udara").val();
			var kota_tujuan = $('#kta_tujuan_udara').val();
			var n_pengirim 	= $("#n_pengirim_udara").val();
			var t_pengirim	= $("#t_pengirim_udara").val();
			var n_penerima	= $("#n_penerima_udara").val();
			var t_penerima 	= $("#t_penerima_udara").val();
			var biaya_kirim	= $("#biaya_kirim_udara").val();
			var a_pengirim 	= $("#alamat_pengirim_udara").val();
			var a_penerima	= $("#alamat_penerima_udara").val();
			var biaya_smu = $("#biaya_smu_udara").val();
			var biaya_karantina = $("#biaya_karantina_udara").val();
			
			var satuan		= $('#satuan_udara').val();
			var ppn 		= 0;
			var change		= $('#b_charge_udara').text().replace(/\./g,'');
			var total_biaya = parseInt(change) + parseInt(biaya_kirim) +  parseInt(biaya_smu) +  parseInt(biaya_karantina);
			var metode		= $("#metode_udara").val();
			var nosmu 		= $('#nomer_smu_udara').val();
			var status_bayar = $('#status_bayar_udara').val();
			var dibayar = $("#dibayar_udara").val();
			var maskapai = $('#maskapai').val();
			if(dibayar==''||a_pengirim==''||a_penerima==''||nama_barang == '' || jumlah=='' || berat=='' || berat==0 || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_smu=='' || biaya_karantina ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanubahudara',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'idresi'		: idresi,
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
                	'dibayar'	: dibayar,
                	'maskapai':maskapai
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                	cetakresiudara();
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
	//================================================
	function cetakresiudara(){
		tempelresiudara();
		var divToPrint2=document.getElementById('hidden_div_pti');
		var divToPrint=document.getElementById('hidden_div_udara');
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
	function tempelresiudara(){
		hitung_total_udara();
		var dats = $('#kota_tujuan_udara').select2('data');
		var kota_tujuan = dats[0].text;
		var rows ='';
		var rowpti ='';
		var jumlahvolume=0;
		var jumlahkg= 0;
		for (var i = 1; i <= jumlahbarang; i++) {
		rows = rows + '<tr>';
        rows = rows + '<td style="border-top: 1px solid black; border-bottom: 1px solid black;" align="center">'+$('#d_panjang_udara'+i).val()+'cm x '+$('#d_lebar_udara'+i).val()+'cm x '+$('#d_tinggi_udara'+i).val()+'cm</td>';
        rows = rows + '<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center">' +$('#volume_udara'+i).val()+'Kg</td>';
        rows = rows + '<td style="border-top: 1px solid black; border-left:1px solid black; border-bottom: 1px solid black; " align="center">' +$('#berat_udara'+i).val()+'Kg</td>';
        rows = rows + '</tr>';

        rowpti = rowpti + '<tr>';
				rowpti = rowpti + '<td width="5%" align="center">1</td>';
                rowpti = rowpti + '<td width="10%" align="center">koli</td>';
                rowpti = rowpti + '<td width="35%" align="center">'+$("#nama_barang_udara").val()+'</td>';
                rowpti = rowpti + '<td width="30%" align="center">'+$('#d_panjang_udara'+i).val()+'cm x '+$('#d_lebar_udara'+i).val()+'cm x '+$('#d_tinggi_udara'+i).val()+'cm</td>';
                rowpti = rowpti + '<td width="10%" align="center">' +$('#volume_udara'+i).val()+'Kg</td>';
                rowpti = rowpti + '<td width="10%" align="center">' +$('#berat_udara'+i).val()+'Kg</td>';
                rowpti = rowpti + '</tr>';
        jumlahvolume +=parseInt($('#volume_udara'+i).val());
        jumlahkg +=parseInt($('#berat_udara'+i).val());
		}
		$('#ket_pti').html('&emsp;&emsp;Menerangkan bahwa kiriman yang diserahkan untuk diangkut oleh '+$('#maskapai').val());
		$('#cetak_pti_penerima').html($("#n_penerima_udara").val());
		$('#cetak_pti_alamatp').html($("#alamat_penerima_udara").val());
		$('#cetak_smu_pti').html($('#nomer_smu_udara').val());
		$('#listpti').html(rowpti);
		$('#berat_pti').html($("#totalberat").val()+" Kg");

		$("#listbarang").html(rows);
		$("#listbarang2").html(rows);
		$("#listbarang3").html(rows);
		$("#listbarang4").html(rows);
		$("#cetak_resi_udara").html($("#koderesinya").val());
		$("#cetak_resi_udara2").html($("#koderesinya").val());
		$("#cetak_resi_udara3").html($("#koderesinya").val());
		$("#cetak_resi_udara4").html($("#koderesinya").val());
		$("#cetak_metode_udara").html($("#metode_udara").val());
		$("#cetak_metode_udara2").html($("#metode_udara").val());
		$("#cetak_metode_udara3").html($("#metode_udara").val());
		$("#cetak_metode_udara4").html($("#metode_udara").val());
		$("#cetak_alamat_pengirim_udara").html($("#alamat_pengirim_udara").val());
		$("#cetak_alamat_pengirim_udara2").html($("#alamat_pengirim_udara").val());
		$("#cetak_alamat_pengirim_udara3").html($("#alamat_pengirim_udara").val());
		$("#cetak_alamat_pengirim_udara4").html($("#alamat_pengirim_udara").val());
		$("#cetak_alamat_penerima_udara").html($("#alamat_penerima_udara").val());
		$("#cetak_alamat_penerima_udara2").html($("#alamat_penerima_udara").val());
		$("#cetak_alamat_penerima_udara3").html($("#alamat_penerima_udara").val());
		$("#cetak_alamat_penerima_udara4").html($("#alamat_penerima_udara").val());
		$("#cetak_kota_tujuan_udara").html(kota_tujuan);
		$("#cetak_kota_tujuan_udara2").html(kota_tujuan);
		$("#cetak_kota_tujuan_udara3").html(kota_tujuan);
		$("#cetak_kota_tujuan_udara4").html(kota_tujuan);
		$("#cetak_kota_asal_udara").html($("#kota_asal_udara").val());
		if(satuan_udara=='koli'){
			$("#cetak_jumlah_barang_udara").html($("#jumlah_udara").val()+" "+satuan);
			$("#cetak_jumlah_barang_udara2").html($("#jumlah_udara").val()+" "+satuan);
			$("#cetak_jumlah_barang_udara3").html($("#jumlah_udara").val()+" "+satuan);
			$("#cetak_jumlah_barang_udara4").html($("#jumlah_udara").val()+" "+satuan);
		}else{
			$("#cetak_jumlah_barang_udara").html($("#jumlah_udara").val());
			$("#cetak_jumlah_barang_udara2").html($("#jumlah_udara").val());
			$("#cetak_jumlah_barang_udara3").html($("#jumlah_udara").val());
			$("#cetak_jumlah_barang_udara4").html($("#jumlah_udara").val());
		}
		$("#cetak_berat_udara").html($('#totalberat').val()+" Kg");
		$("#cetak_pengirim_udara").html($("#n_pengirim_udara").val());
		$("#cetak_telp_pengirim_udara").html($("#t_pengirim_udara").val());
		$("#cetak_penerima_udara").html($("#n_penerima_udara").val());
		$("#cetak_telp_penerima_udara").html($("#t_penerima_udara").val());
		$("#cetak_isi_paket_udara").html($("#nama_barang_udara").val());
		$("#cetak_biaya_kirim_udara").html("Rp. "+rupiah($("#biaya_kirim_udara").val()));
		$('#cetak_biaya_smu_udara').html("Rp. "+rupiah($('#biaya_smu_udara').val()));
		$('#cetak_biaya_karantina_udara').html("Rp. "+rupiah($('#biaya_karantina_udara').val()));
		$('#cetak_biaya_charge_udara').html("Rp. "+$('#b_charge_udara').html());
		$('#cetak_biaya_charge_udara2').html("Rp. "+$('#b_charge_udara').html());
		$('#cetak_biaya_charge_udara3').html("Rp. "+$('#b_charge_udara').html());
		$('#cetak_biaya_charge_udara4').html("Rp. "+$('#b_charge_udara').html());
		$("#cetak_total_udara").html("Rp. " +$('#total_udara').html());
		var d = new Date();
		var tanggal = d.getDate()+" - "+(d.getMonth()+1)+" - "+d.getFullYear();
		
		$('#cetak_nosmu_udara').html($('#nomer_smu_udara').val());
		//================file 2======================================
		$("#cetak_kota_asal_udara2").html($("#kota_asal_udara").val());
		$("#cetak_berat_udara2").html($("#totalberat").val()+" Kg");
		$("#cetak_pengirim_udara2").html($("#n_pengirim_udara").val());
		$("#cetak_telp_pengirim_udara2").html($("#t_pengirim_udara").val());
		$("#cetak_penerima_udara2").html($("#n_penerima_udara").val());
		$("#cetak_telp_penerima_udara2").html($("#t_penerima_udara").val());
		$("#cetak_isi_paket_udara2").html($("#nama_barang_udara").val());
		$("#cetak_biaya_kirim_udara2").html("Rp. "+rupiah($("#biaya_kirim_udara").val()));
		$('#cetak_biaya_smu_udara2').html("Rp. "+rupiah($('#biaya_smu_udara').val()));
		$('#cetak_biaya_karantina_udara2').html("Rp. "+rupiah($('#biaya_karantina_udara').val()));
		$("#cetak_total_udara2").html("Rp. " +$('#total_udara').html());
		
		$('#cetak_nosmu_udara2').html($('#nomer_smu_udara').val());
		//================file 3============================
		$("#cetak_kota_asal_udara3").html($("#kota_asal_udara").val());
		$("#cetak_berat_udara3").html($("#totalberat").val()+" Kg");
		$("#cetak_pengirim_udara3").html($("#n_pengirim_udara").val());
		$("#cetak_telp_pengirim_udara3").html($("#t_pengirim_udara").val());
		$("#cetak_penerima_udara3").html($("#n_penerima_udara").val());
		$("#cetak_telp_penerima_udara3").html($("#t_penerima_udara").val());
		$("#cetak_isi_paket_udara3").html($("#nama_barang_udara").val());
		$("#cetak_biaya_kirim_udara3").html("Rp. "+rupiah($("#biaya_kirim_udara").val()));
		$('#cetak_biaya_smu_udara3').html("Rp. "+rupiah($('#biaya_smu_udara').val()));
		$('#cetak_biaya_karantina_udara3').html("Rp. "+rupiah($('#biaya_karantina_udara').val()));
		$("#cetak_total_udara3").html("Rp. " +$('#total_udara').html());
		
		$('#cetak_nosmu_udara3').html($('#nomer_smu_udara').val());
		//=====================file 4 ========================
		$("#cetak_kota_asal_udara4").html($("#kota_asal_udara").val());
		$("#cetak_berat_udara4").html($("#totalberat").val()+" Kg");
		$("#cetak_pengirim_udara4").html($("#n_pengirim_udara").val());
		$("#cetak_telp_pengirim_udara4").html($("#t_pengirim_udara").val());
		$("#cetak_penerima_udara4").html($("#n_penerima_udara").val());
		$("#cetak_telp_penerima_udara4").html($("#t_penerima_udara").val());
		$("#cetak_isi_paket_udara4").html($("#nama_barang_udara").val());
		$("#cetak_biaya_kirim_udara4").html("Rp. "+rupiah($("#biaya_kirim_udara").val()));
		$('#cetak_biaya_smu_udara4').html("Rp. "+rupiah($('#biaya_smu_udara').val()));
		$('#cetak_biaya_karantina_udara4').html("Rp. "+rupiah($('#biaya_karantina_udara').val()));
		$("#cetak_total_udara4").html("Rp. " +$('#total_udara').html());
		
		$('#cetak_nosmu_udara4').html($('#nomer_smu_udara').val());
	}
});