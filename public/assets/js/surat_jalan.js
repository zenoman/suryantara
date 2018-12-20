$(document).ready(function(){
	var noresisj ;
		carikode();

//=============================================cari resi
		$('#carinoresi').select2({
		placeholder: 'Cari nomor resi',
		ajax:{
			url:'/carinoresi',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						
						return {
							id: item.id,
							text: item.no_resi
						}

					})
				}
			},
			cache: true
		}
	});
		//=================================================
		$('#carinoresi').on('select2:select',function(e){
			var isi = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/cariresi/'+isi,
                success:function (data){
				return {
					results : $.map(data, function (item){
					cariitem(item.nama_barang,item.jumlah,item.berat,item.nama_pengirim,item.nama_penerima,item.kode_tujuan);
					})
				}
			},
            });
		});
	//===================================================
		$("#carinoresi").on('select2:close',function(e){
			$('#penerima').focus();
		});
	//===================================================
	function cariitem(barang,jumlah,berat,pengirim,penerima,tujuan){
        $('#penerima').val(penerima);
        $('#pengirim').val(pengirim);
		$('#isipaket').val(barang);
        $('#tujuan').val(tujuan);
		$('#jumlah').val(jumlah);
		$('#berat').val(berat);

	}
	//========================================================
	function carikode(){
			$.ajax({
			url:'/carikodesj',
			dataType:'json',
			success:function(data){
				noresisj = data;
				$("#noresi").html(data);
                 $("#cetak_kodesj").html(":&nbsp;"+data);
				getdata();
			}
		});
		}
	//==============================================================
    function hapusdetail(id){
    var foo = "bar";
    if(foo=="bar"){
    	var isgood = confirm('Dialogue');
    	if(isgood){
    		alert(id);	
    	}else{
    		alert('cancel');
    	}
    }
    }
	//========================================================
	 function getdata(){
            $.ajax({
                    type:'GET',
                    dataType:'json',
                    url: '/caridetailsj/'+noresisj,
                    success:function(data){
                        managerow(data);
                    },error:function(){
                        console.log(data);
                        alert('error');
                    }
                });
           }
    //==========================================================
    function managerow(data){
            var rows ='';
            var rows2 ='';
            var totaljumlah =0;
            var totalkg =0;
            var no = 0;
            $.each(data,function(key, value){
                no +=1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center">' +value.no_resi+'</td>';
                rows = rows + '<td>'+value.nama_pengirim+'</td>';
                rows = rows + '<td>' +value.nama_penerima+'</td>';
                rows = rows + '<td>' +value.kode_tujuan+'</td>';
                rows = rows + '<td class="text-center">' +value.jumlah+'</td>';
                rows = rows + '<td class="text-center">' +value.berat+'</td>';
                rows = rows + '<td>' +value.nama_barang+'</td>';
                rows = rows + '<td><button type="button" class="btn btn-warning" onclick="halo('+value.id+')"><i class="fa fa-trash"></i></button></td>';
                rows = rows + '</tr>';
                totaljumlah += value.jumlah;
                totalkg += value.berat;
                rows2 = rows2 + '<tr align="center">';
                rows2 = rows2 + '<td>'+no+'</td>';
                rows2 = rows2 + '<td>'+value.no_resi+'</td>';
                rows2 = rows2 + '<td>suryantara cargo</td>';
                rows2 = rows2 + '<td>'+value.penerima+'</td>';
                rows2 = rows2 + '<td>' +value.alamat+'</td>';
                rows2 = rows2 + '<td>' +value.jumlah+'</td>';
                rows2 = rows2 + '<td>' +value.berat+'</td>';
                rows2 = rows2 + '<td>' +value.isi+'</td>';
                rows2 = rows2 + '<td>-</td>';
                rows2 = rows2 + '<td>-</td>';
                rows2 = rows2 + '<td>-</td>';
                rows2 = rows2 + '<td>-</td>';
                rows2 = rows2 + '</tr>';
            });
            $("#tubuh").html(rows);
            $("#list_cetak").html(rows2);
            $("#totaljumlah").html(totaljumlah);
            $("#cetak_subtotaljumlah").html(totaljumlah);
            $("#cetak_subtotalberat").html(totalkg);
            $("#totalkg").html(totalkg);
        }
    //============================================================
    $("#btntambah").click(function(e){
    	// 
    	var penerima = $("#penerima").val();
    	var jumlah = $("#jumlah").val();
    	var berat = $("#berat").val();
    	var tujuan = $("#tujuan").val();
    	var isipaket = $("#isipaket").val();

    	if($("#carinoresi").val() =='' ||penerima==''||jumlah==''||berat==''||tujuan==''||isipaket==''){
    		notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
    	}else{
    		var resi = $("#carinoresi").select2('data');
    		var noresi = resi[0].id;
    		$.ajax({
                type: 'POST',
                url: '/tambahdetailsj',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'kode': noresisj,
                    'noresi': noresi
                },
                success: function(data) {
                	 notie.alert(1, 'Data Disimpan', 2);
                	 bersihdetail();
                    getdata();
                },
            });
    	}
    });
    //===============================================================
    function bersihdetail(){
        $('#pengirim').val('');
    	$("#penerima").val('');
    	$("#jumlah").val('');
    	$("#berat").val('');
    	$("#tujuan").val('');
    	$("#isipaket").val('');
        $("#carinoresi").val(null).trigger('change');
    	$("#carinoresi").focus();
    }
    //==================================================================
    function halo(id){
    var foo='bar';
    if(foo=='bar'){
     var isgood = confirm('hapus ? ');
     if(isgood == true){
           $.ajax({
                    type:'GET',
                    dataType:'json',
                    url: '/hapusdetailsj/'+id,
                    success:function(){
                        notie.alert(3, 'Detail Dihapus', 2);
                        getdata();
                    },error:function(){
                       notie.alert(3, 'Detail Dihapus', 2);
                        getdata();
                    }
                });
     }   
    }
    }
    window.halo=halo;
    //============================================ cetak resi
        
        $("#btncetak").click(function(){
        tempel_cetak();
        var divToPrint=document.getElementById('hidden_div');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        });
    //=====================================
    function tempel_cetak(){
    $("#cetak_tujuan").html(":&nbsp;"+$("#tujuan_sj").val());
    }
});