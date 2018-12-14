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
					
							cariitem(item.nama_barang,item.jumlah,item.berat);
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
	function cariitem(barang,jumlah,berat){
		$('#isipaket').val(barang);
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
            $.each(data,function(key, value){
                rows = rows + '<tr>';
                rows = rows + '<td>' +value.no_resi+'</td>';
                rows = rows + '<td> suryantara cargo </td>';
                rows = rows + '<td>' +value.penerima+'</td>';
                rows = rows + '<td>' +value.alamat+'</td>';
                rows = rows + '<td>' +value.jumlah+'</td>';
                rows = rows + '<td>' +value.berat+'</td>';
                rows = rows + '<td>' +value.isi+'</td>';
                rows = rows + '<td><button type="button" class="btn btn-warning" onclick="halo('+value.id+')"><i class="fa fa-trash"></i></button></td>';
                rows = rows + '</tr>';
            });
            $("tbody").html(rows);
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
    		var noresi = resi[0].text;
    		$.ajax({
                type: 'POST',
                url: '/tambahdetailsj',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'kode': noresisj,
                    'noresi': noresi,
                    'penerima' : $("#penerima").val(),
			    	'jumlah' : $("#jumlah").val(),
			    	'berat' : $("#berat").val(),
			    	'tujuan' : $("#tujuan").val(),
			    	'isipaket' : $("#isipaket").val()
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
    	$("#penerima").val('');
    	$("#jumlah").val('');
    	$("#berat").val('');
    	$("#tujuan").val('');
    	$("#isipaket").val('');
    	$("#carinoresi").focus();
    }
    //==================================================================
    function halo(id){
    var foo='bar';
    if(foo=='bar'){
     var isgood = confirm('hapus ? ');
     if(isgood == true){
            alert(id);
     }   
    }
    }
    window.halo=halo;
    
});