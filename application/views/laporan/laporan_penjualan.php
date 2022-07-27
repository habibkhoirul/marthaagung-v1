<h2><center>MArtha Agung</center></h2>
<h4><center>Laporan Data Penjualan</center></h4>
<br>
Dicetak Tanggal: <?php echo date('d M Y') ?>
<br><br>

<table width="100%" border="1" style="border: 1px solid #000">
<tr>
  <th>No Penjualan</th>
  <th>Tgl Penjualan</th>
  <th>Total</th>
  <th>Bayar</th>
  <th>Petugas</th>
</tr>
<?php

foreach ($dt_penjualan->result() as $data){
      echo '
      <tr>
        <td>'.$data->no_penjualan.'</td>
        <td>'.$data->tgl_penjualan.'</td>
        <td>Rp. '.$data->total.'</td>
        <td>Rp. '.$data->uang_bayar.'</td>
        <td>'.$data->kd_petugas.'/ '.$data->nm_petugas.'</td>
      </tr>';
  } ?>
</table>
    
<br><br>
<center>Mengetahui, Kepala Martha Agung</center>
<br>
<br>
<br>
<br>
<center>Misman</center>
