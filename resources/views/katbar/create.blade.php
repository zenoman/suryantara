@extends('layout.masteradmin')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<!--  -->
<script language="Javascript" type="text/javascript">
//fungsi remove html
//====================================================
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
//====================================================

var counter = 1; //variabel nomor inputan
var limit = 10; // limit

//fungsi tambah input
function addInput(divName){

 if (counter == limit)  {
    alert("Telah mencapai limit " + counter + " inputan");
 }
 else {
    var newdiv = document.createElement('div');
    newdiv.innerHTML = '<div id="input'+counter+'" class="">'+
				'<div class="row">'+
					'<p id="no1'+counter+'"></p>'+
					'<div class="col-lg-4">'+
						'<fieldset class="form-group">'+
							'<label class="form-label semibold" for="exampleInput">Nama</label>'+
		'<input type="text" class="form-control" id="exampleInput" placeholder="Masukan Nama Kategori Barang" name="spesial_cargo[]">'+
						'</fieldset>'+
					'</div>'+
					'<div class="col-lg-4">'+
						'<fieldset class="form-group">'+
							'<label class="form-label semibold" for="exampleInput" >Charge</label>'+
						'<div class="input-group">'+
		'<input type="tect" class="form-control"  placeholder="Contoh : 50 %"  name="charge[]">'+
						'<div class="input-group-addon">%</div>'+
						'</div>'+
						'</fieldset>'+
					'</div>'+
					'<div class="col-lg-4">'+
						'<fieldset class="form-group"><p>'+
						'<label class="form-label semibold" for="exampleInputPassword1" > Hapus</label>'+
						'<a href="#" onclick="del('+counter+')"><button class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button></a>'+
						'</fieldset>'+
					'</div>'+
				'</div>'+
                        '</div>';

    document.getElementById(divName).appendChild(newdiv);
    counter++;
 }
}
//fungsi hapus input
function del(no) {
  document.getElementById('input'+no).remove();
  counter = counter - 1;
  for(i=no;i<=limit;i++){
    var id = document.getElementById('input'+i);
    if (id === null){

    } else {

    }
  }
}
</script>
<!--  -->
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Nama Kategori Barang </h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('kat_bar') }}" role="form" method="POST">


<!--  -->
<div id="dynamicInput">
</div>
<!--  -->

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onClick="addInput('dynamicInput');" class="btn btn-warning btn-sm"><i class="fa fa-plus"> Masukan Nama Kategori Barang </i></button>
<br>
<hr></hr>


{{csrf_field()}}
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
			</div>
			</div>
        @endsection
		@section('js')
	<script src="{{asset('assets/class.php')}}"></script>
	@endsection