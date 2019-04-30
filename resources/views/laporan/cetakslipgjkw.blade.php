<table width="100%" border="0">
    @foreach($data2 as $row)
<tr>
    <td>
<table width="25%" border="1">
<tr>
    <td>
 <table width="100%" border="0">
<tr>
<!--     <td style="width: 100px;">
&nbsp;<img  style="height: 80px;width: 90%; padding: 0px" src="{{asset('img/LOGO1.png')}}" alt="">
    </td> -->
    <td style="text-align: right;">
        <b> Slip Gaji</b>
        <hr>
        <b>{{date('d-M-Y')}}</b>
    </td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td colspan="2">
        kode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:{{$row->kode_karyawan}}<br>
        Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:{{$row->nama_karyawan}}<br>
        Jabatan&nbsp;&nbsp; :{{$row->jabatan}}<br><p></p>
    </td> 
</tr>

<tr>
    <td colspan="2" style="background-color: black; padding: 10px;"><b style="color: white">PENERIMAAN</b></td>
</tr>
<tr>
    <td colspan="2" style="padding: 5px; text-align: justify;">
        &nbsp;<span>Gaji Pokok</span>  <span style="padding-left: 130px;">{{"Rp ".number_format($row->gaji_pokok,0,',','.')}}</span><br>
        <hr>
        &nbsp;<span>Uang Makan</span> <span style="padding-left: 120px;">{{"Rp ".number_format($row->uang_makan,0,',','.')}}</span><br>
        <hr>
        &nbsp;<span>Gaji Tambahan</span>  <span style="padding-left: 105px;">{{"Rp ".number_format($row->gaji_tambahan,0,',','.')}}</span><br>
        <hr>
        &nbsp;<span>Cash Bon</span>  <span style="padding-left: 140px;">Rp. -</span><br>
        <hr>
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
    <td><span style="padding-left: 165px;">(..................................)</span></td>
</tr>
</table>
      </td>
</tr>
</table>
    </td>
</tr>
    @endforeach
</table>