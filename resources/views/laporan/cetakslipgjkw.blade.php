<!DOCTYPE html>
<html>
<head>
    <title>Cetak Slip Gaji</title>
</head>
<body onload="window.print()">
<link href="{{asset('assets/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{asset('assets/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{asset('assets/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{asset('assets/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon" type="image/png">
    <link href="{{asset('assets/img/favicon.ico')}}" rel="shortcut icon">
    <link rel="stylesheet" href="{{asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/lib/lobipanel/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/lib/jqueryui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/pages/widgets.min.css')}}">

<div class="page-content"  id="halinput">
        <div class="container-fluid">
            <div class="row">
@foreach($data2 as $row)
                <div class="col-xl-5 dahsboard-column" style="max-width: 27.333333%;">
<section class="widget">
<table width="100%" border="1">
<tr>
    <td>
 <table width="100%" border="0">
<tr>
    <td >
        &nbsp;&nbsp;@foreach($title as $ro){{$ro->header}}@endforeach<b style="padding-left: 65px"> Slip Gaji</b>
        <hr style="border-top-color: black;margin: 1em 0;">
        <b style="padding-left: 225px">{{date('d-M-Y')}}</b>
    </td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td colspan="2">
        &nbsp;&nbsp;kode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:{{$row->kode_karyawan}}<br>
        &nbsp;&nbsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:{{$row->nama_karyawan}}<br>
        &nbsp;&nbsp;Jabatan&nbsp;&nbsp; :{{$row->jabatan}}<br><p></p>
    </td> 
</tr>

<tr>
    <td colspan="2" style="background-color: black; padding: 10px;"><b style="color: white">PENERIMAAN</b></td>
</tr>
<tr>
    <td colspan="2" style="padding: 5px; text-align: justify;">
        &nbsp;<span>Gaji Pokok</span>  <span style="padding-left: 130px;">{{"Rp ".number_format($row->gaji_pokok,0,',','.')}}</span><br>
        <hr style="border-top-color: black;margin: 1em 0;">
        &nbsp;<span>Uang Makan</span> <span style="padding-left: 120px;">{{"Rp ".number_format($row->uang_makan,0,',','.')}}</span><br>
        <hr style="border-top-color: black;margin: 1em 0;">
        &nbsp;<span>Gaji Tambahan</span>  <span style="padding-left: 105px;">{{"Rp ".number_format($row->gaji_tambahan,0,',','.')}}</span><br>
        <hr style="border-top-color: black;margin: 1em 0;">
        &nbsp;<span>Cash Bon</span>  <span style="padding-left: 140px;">Rp. -</span><br>
        <hr style="border-top-color: black;margin: 1em 0;">
    </td>
</tr>
<tr>
    <td style="background-color: black;" colspan="2"><span style="color: white">Total</span> <span style="padding-left: 170px;color: white;">{{"Rp ".number_format($row->total,0,',','.')}}</span></td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td><span style="padding-left: 190px;">Disetujui Oleh:</span><p></p><p></p></td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td><span style="padding-left: 175px;">(..................................)</span><p></p></td>
</tr>
</table>
      </td>
</tr>
</table>
</section>
                </div>
    @endforeach

            </div>
        </div><!--.container-fluid-->
    </div>

<script src="{{asset('assets/js/lib/d3/d3.min.js')}}"></script>

    <script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/tether/tether.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    
    <script src="{{asset('assets/js/app.js')}}"></script>

</body>
</html>
