$(document).ready(function(){
	var halaman='darat';
	var satuan_darat = 'kg';
	var satuan_laut = 'kg';
	var satuan_city = 'kg';
	var satuan_udara = 'kg';
	var kategori_udara ='biasa';
	var kotatujuanudara = '';
	var jumlahbarang =1;
	var totalberat=0;
	var jumlahbaranghevy=0;
	//======================================
	$('#metode').on('change',function(e){
		halaman = this.value;
		if(halaman=='darat'){
		 $("#formdarat").show(700);
         $("#formudara").hide(700);
         $("#formlaut").hide(700);
         $("#formcity").hide(700);		
		 $('#nama_barang_darat').focus();
		}else if(halaman=='laut'){
		 $("#formdarat").hide(700);
         $("#formudara").hide(700);
         $("#formlaut").show(700);
         $("#formcity").hide(700);	
		 $('#nama_barang_laut').focus();
		}else if(halaman=='udara'){
		 $("#formdarat").hide(700);
         $("#formudara").show(700);
         $("#formlaut").hide(700);
         $("#formcity").hide(700);	
         $('#nama_barang_udara').focus();
		}else{
			$("#formdarat").hide(700);
         $("#formudara").hide(700);
         $("#formlaut").hide(700);
         $("#formcity").show(700);	
		}
	});

	//###############################halaman city
	$('#satuan_city').on('change',function(e){
		satuan_city = this.value;
	})
	//================================================
	$("#berat_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var berat = $("#berat_city").val();
			var vt = parseFloat(berat);
			$("#berat_city").val(vt.toFixed());
			}
			
		})
	
	//============================================ hitung volumetrik
		$("#d_panjang_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_city = $("#d_panjang_city").val();
			var lebar_city = $("#d_lebar_city").val();
			var tinggi_city = $("#d_tinggi_city").val();
			var total_city =  (parseInt(panjang_city) *  parseInt(lebar_city) *  parseInt(tinggi_city))/4000;
			var vt = parseFloat(total_city);
			$("#volume_city").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_city = $("#d_panjang_city").val();
			var lebar_city = $("#d_lebar_city").val();
			var tinggi_city = $("#d_tinggi_city").val();
			var total_city =  (parseInt(panjang_city) *  parseInt(lebar_city) *  parseInt(tinggi_city))/4000;
			var vt = parseFloat(total_city);
			$("#volume_city").val(vt.toFixed());
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_city = $("#d_panjang_city").val();
			var lebar_city = $("#d_lebar_city").val();
			var tinggi_city = $("#d_tinggi_city").val();
			var total_city =  (parseInt(panjang_city) *  parseInt(lebar_city) *  parseInt(tinggi_city))/4000;
			var vt = parseFloat(total_city);
			$("#volume_city").val(vt.toFixed());
			}
			
		})
	//=============================================cari kota tujuan
		$('#kota_tujuan_city').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/carikotacity',
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
	$('#kota_tujuan_city').on('select2:select',function(e){
			$('#formcity').loading('toggle');
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasilkota/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan_city=='kg'){
								hitung_city(item.tarif,item.tujuan);
							}else{
								$("#biaya_kirim_city").val(0);
								$("#b_kirim_city").html(0);
								hitung_total_city();
							}
					})
				}
			},complete:function(){
                $('#formcity').loading('stop');
            }
            });
		});
	//============================================ hitung estimasi tujuan
		function hitung_city(harga,tujuan){
			var berat = $("#berat_city").val();
			var volume = $("#volume_city").val();
			if(berat!='' && volume!=''){
				if(parseInt(berat) > parseInt(volume)){
					var jumlah = harga*berat;
				}else{
					var jumlah = harga*volume;
				}
			$("#biaya_kirim_city").val(jumlah);
			$("#b_kirim_city").html(rupiah(jumlah));
			hitung_total_city();		
		}}
	//============================================ hitung total biaya
		function hitung_total_city(){
			var b_kirim = $("#biaya_kirim_city").val();
			var b_packing = $("#biaya_packing_city").val();
			var dibayar = $('#dibayar_city').val();
			var b_asuransi = $("#biaya_asuransi_city").val();
			var totalnya = parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#subtotal_city").html(rupiah(totalnya));
			if(dibayar >= totalnya){
				var totalakhir = parseInt(dibayar) - totalnya;
				$('#status_bayar_city').val('lunas');
				$('#ketuang_city').html('Kembalian');
			}else{
				var totalakhir = totalnya - parseInt(dibayar);
				$('#status_bayar_city').val('belum_lunas');
				$('#ketuang_city').html('Kekurangan');
			}
			$("#total_city").html(rupiah(totalakhir));
		}
	//============================================ hitung total biaya
		$("#biaya_asuransi_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi_city").val();
			$("#b_asuransi_city").html(rupiah(biaya_asu));
			hitung_total_city();	
			}
			
		})
	//============================================ hitung total
		$("#biaya_kirim_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_city").val();
			$("#b_kirim_city").html(rupiah(biaya_kirim));
			hitung_total_city();		
			}
			
		})
	//============================================ hitung total biaya
		$("#dibayar_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_bayar = $("#dibayar_city").val();
			$("#b_dibayar_city").html(rupiah(biaya_bayar));
			hitung_total_city();	
			}
			
		})
	//============================================ hitung total	
		$("#biaya_packing_city").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing_city").val();
			$("#b_packing_city").html(rupiah(biaya_pack));
			hitung_total_city();		
			}
			
		})
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_city").on('select2:close',function(e){
			$('#n_pengirim_city').focus();
		});
	//============================================ simpan transaksi
		$("#btnsimpan_city").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var koderesi	= $('#resinya').val();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_city").val();
			var d_panjang	= $("#d_panjang_city").val();
			var d_tinggi	= $("#d_tinggi_city").val();
			var d_lebar		= $("#d_lebar_city").val();
			var volume		= $("#volume_city").val();
			var jumlah		= $("#jumlah_city").val();
			var berat		= $("#berat_city").val();
			var kota_asal	= $("#kota_asal_city").val();
			var isi_kota_tujuan = $('#kota_tujuan_city').val();
			var a_pengirim 	= $("#alamat_pengirim_city").val();
			var a_penerima	= $("#alamat_penerima_city").val();
			var n_pengirim 	= $("#n_pengirim_city").val();
			var t_pengirim	= $("#t_pengirim_city").val();
			var n_penerima	= $("#n_penerima_city").val();
			var t_penerima 	= $("#t_penerima_city").val();
			var biaya_kirim	= $("#biaya_kirim_city").val();
			var biaya_packing = $("#biaya_packing_city").val();
			var biaya_asu 	= $("#biaya_asuransi_city").val();
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_city').val();
			var ppn 		= 0;
			var total_biaya = parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode_city").val();
			var status_bayar = $('#status_bayar_city').val();
			var dibayar = $("#dibayar_city").val();
			if(dibayar==''||a_pengirim==''||a_penerima==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || isi_kota_tujuan==null || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var dats = $('#kota_tujuan_city').select2('data');
				var kota_tujuan = dats[0].text;
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanmanualcity',
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
                	'status_bayar':status_bayar,
                	'koderesi':koderesi,
                	'dibayar':dibayar
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

	//###############################halaman darat
	$('#satuan_darat').on('change',function(e){
		satuan_darat = this.value;
	})
	//================================================
	$("#berat_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var berat = $("#berat_darat").val();
			var vt = parseFloat(berat);
			$("#berat_darat").val(vt.toFixed());
			}
			
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
	//============================================ hitung total
		$("#biaya_kirim_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_darat").val();
			$("#b_kirim_darat").html(rupiah(biaya_kirim));
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
			var koderesi	= $('#resinya').val();
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
			if(dibayar==''||a_penerima=='' || a_pengirim=='' || nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || isi_kota_tujuan==null || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var dats = $('#kota_tujuan_darat').select2('data');
				var kota_tujuan = dats[0].text;
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
                	'total_biaya'	: total_biaya,
                	'satuan'		: satuan,
                	'metode'		: metode,
                	'ppn'			: ppn,
                	'alamat_pengirim' : a_pengirim,
                	'alamat_penerima' : a_penerima,
                	'status_bayar' : status_bayar,
                	'koderesi':koderesi,
                	'dibayar'	: dibayar
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



	//###############################halaman laut
	$('#satuan_laut').on('change',function(e){
		satuan_laut = this.value;
	})
	//================================================
	$("#berat_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var berat = $("#berat_laut").val();
			var vt = parseFloat(berat);
			$("#berat_laut").val(vt.toFixed());
			}
			
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
			var koderesi	= $('#resinya').val();
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
			if(dibayar==''||a_pengirim==''||a_penerima==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || isi_kota_tujuan==null || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var dats = $('#kota_tujuan_laut').select2('data');
				var kota_tujuan = dats[0].text;
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanmanuallaut',
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
                	'status_bayar':status_bayar,
                	'koderesi':koderesi,
                	'dibayar'	: dibayar
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
							kotatujuanudara = item.tujuan;
							$('#maskapai').val(item.airlans);
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
		var dibayar = $("#dibayar_udara").val();
		var biaya_charge = parseInt($('#b_charge_udara').text().replace(/\./g,''));
		var jumlah = biaya_kirim + biaya_charge + biaya_dokumen + biaya_karantina;
		$("#subtotal_udara").html(rupiah(jumlah));
			if(dibayar >= jumlah){
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
			var maskapai = $('#maskapai').val();
			var jumlah		= $("#jumlah_udara").val();
			var dimensi ='';
			var subberat='';
			var volume='';
			for (var i = 1; i <= jumlah ; i++) {
				var d_panjang	= $("#d_panjang_udara"+i).val();
				var d_tinggi	= $("#d_tinggi_udara"+i).val();
				var d_lebar		= $("#d_lebar_udara"+i).val();
				var beranya = $('#berat_udara'+i).val();
				var volum = $('#volume_udara'+i).val();

				dimensi = dimensi+""+d_panjang+" x "+d_lebar+" x "+d_tinggi+",";
				subberat = subberat+''+beranya+',';
				volume = volume+''+volum+',';
			}
			var koderesi	= $('#resinya').val();
			var berat		= $("#totalberat").val();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_udara").val();
			
			var kota_asal	= $("#kota_asal_udara").val();
			var kota_tujuan = kotatujuanudara;
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
			if(dibayar==''||a_pengirim==''||a_penerima==''||nama_barang == '' || jumlah=='' || berat=='' || berat==0 || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_smu=='' || biaya_karantina ==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanmanualudara',
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
                	'status_bayar':status_bayar,
                	'koderesi':koderesi,
                	'dibayar'	: dibayar,
                	'maskapai' : maskapai
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