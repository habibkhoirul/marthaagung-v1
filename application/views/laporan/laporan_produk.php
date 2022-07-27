  <h2><center>UD. Martha Agung</center></h2>
  <h4><center>Laporan Data Produk</center></h4>
  <br>
  Dicetak Tanggal: <?php echo date('d M Y') ?>
  <br><br>

  <table width="100%" border="1" style="border: 1px solid #000">
      <tr>
        <th>Kode Produk</th>
        <th>Nama</th>
        <th>Hrg Modal</th>
        <th>Hrg Jual</th>
        <th>Stok</th>
        <th>Keterangan</th>
      </tr>
      <?php 
      foreach ($dt_produk->result() as $data){
            echo '
            <tr>
              <td>'.$data->kd_produk.'</td>
              <td>'.$data->nm_produk.'</td>
              <td>Rp. '.$data->harga_modal.'</td>
              <td>Rp. '.$data->harga_jual.'</td>
              <td>'.$data->stok.'</td>
              <td>'.$data->keterangan.'</td>
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
