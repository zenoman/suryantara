<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Slip</title>
    <style>
        @media print{
            table{page-break-after: auto;page-break-inside: avoid}
            tr{page-break-inside: avoid;page-break-after: auto}
            td{page-break-inside: avoid;page-break-after: auto}
        }
        @page{
            size:8.5in 14in;            
        }
    </style>
</head>
<body>
    <div style="padding-top: 0px;">
        @foreach($data2 as $row)
                        <!-- onload="window.print()" <div class="col-xl-5 dahsboard-column" style="max-width: 29%;">
        <section class="widget"> -->
             <div style="max-width: 100%; ">
                            <section class="box-typical box-typical-dashboard panel panel-default scrollable">
        <table width="100%" border="1" lass="tbl-typical">
        <tr>
            <td>
         <table width="100%" border="0">
        <tr>
            <td >
                &nbsp;&nbsp;@foreach($title as $ro){{$ro->header}}@endforeach<b style="padding-left: 65%;"> Slip Gaji</b>
                <hr style="border-top-color: black;margin: 1em 0;">
                <b style="padding-left: 88%;">{{date('d-M-Y')}}</b>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                &nbsp;&nbsp;kode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{$row->kode_karyawan}}<br>
                &nbsp;&nbsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{$row->nama_karyawan}}<br>
                &nbsp;&nbsp;Jabatan&nbsp;&nbsp; :&nbsp;&nbsp;{{$row->jabatan}}<br><p></p>
            </td> 
        </tr>
        
        <tr>
            <td colspan="2" style="background-color: black;-webkit-print-color-adjust:exact" style="padding: 10px;"><b style="color: white">PENERIMAAN</b></td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 5px; text-align: justify;">
                &nbsp;<span>Gaji Pokok</span>  <span style="padding-left: 74%;">{{"Rp ".number_format($row->gaji_pokok,0,',','.')}}</span><br>
                <hr style="border-top-color: black;margin: 1em 0;">
                &nbsp;<span>Uang Makan</span> <span style="padding-left: 73%;">&nbsp;{{"Rp ".number_format($row->uang_makan,0,',','.')}}</span><br>
                <hr style="border-top-color: black;margin: 1em 0;">
                &nbsp;<span>Hutang / Bon</span> <span style="padding-left: 73%;">&nbsp;{{"Rp ".number_format($row->bon,0,',','.')}}</span><br>
                <hr style="border-top-color: black;margin: 1em 0;">
                &nbsp;<span>Bonus</span>  <span style="padding-left: 77%;">{{"Rp ".number_format($row->gaji_tambahan,0,',','.')}}</span><br>
                <hr style="border-top-color: black;margin: 1em 0;">
            </td>
        </tr>
        <tr>
            <td style="background-color: black;-webkit-print-color-adjust:exact" colspan="2"><span style="color: white">Total</span> <span style="padding-left: 78%;color: white;">{{"Rp ".number_format($row->total,0,',','.')}}</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><span style="padding-left: 80%;">Disetujui Oleh:</span><p></p><p></p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><span style="padding-left: 78%;">(..................................)</span><p></p></td>
        </tr>
        </table>
              </td>
        </tr>
        </table>

        </section>
                        </div>
                        <p></p>
            @endforeach
            </div>    
</body>
<script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
<script>
    $(document).ready(function(){	
        window.print();
        })
        window.onafterprint = function() {
            history.go(-1);
        };

</script>
</html>


