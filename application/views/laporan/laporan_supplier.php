<h2><center>UD. Martha Agung</center></h2>
  <h4><center>Laporan Data Supplier</center></h4>
  <br>
  Dicetak Tanggal: <?php echo date('d M Y') ?>
  <br><br>

  <table width="100%" border="1" style="border: 1px solid #000">
      <tr>
        <th>Kode Supplier</th>
        <th>Nama</th>
        <th>No Telepon</th>
        <th>Alamat</th>
      </tr>
      <?php 
      foreach ($dt_supplier->result() as $data){
            echo '
            <tr>
              <td>'.$data->kd_supplier.'</td>
              <td>'.$data->nm_supplier.'</td>
              <td>'.$data->no_telepon.'</td>
              <td>'.$data->alamat.'</td>
            </tr>';
        } ?>
  </table>

<br><br>
<center>Mengetahui, Kepala UD. Martha Agung</center>
<br>
<br>
<br>
<br>
<center>Misman</center>
