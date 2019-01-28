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
					'<div class="form-group row">'+
					'<p id="no1'+counter+'"></p>'+
						'<label class="col-sm-2 form-control-label semibold">Nama Jabatan</label>'+
						'<div class="col-sm-10">'+
'<p class="form-control-static"><input type="text" class="form-control" id="inputPassword" name="jabatan[]" placeholder="Masukan Nama Jabatan">'+
'<a href="#" onclick="del('+counter+')"><button class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button></a>'+
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
							<h2>Input Nama Jabatan</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('jabatan') }}" role="form" method="POST">


<!--  -->
<div id="dynamicInput">
						<div class="form-group row">
						<label for="exampleSelect" class="col-sm-2 form-control-label  semibold">Kategori</label>
						<div class="col-sm-10">
							<select id="exampleSelect" name="kate" class="form-control">
								<option>Pilih Kategori</option>
								<option value="Staff">Staff</option>
								<option value="Operasional">Operasional</option>
							</select>
						</div>
					</div><br>
</div>
<!--  -->

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onClick="addInput('dynamicInput');" class="btn btn-warning btn-sm"><i class="fa fa-plus"> Masukan Nama Jabatan</i></button>
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