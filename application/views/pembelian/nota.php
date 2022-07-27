<?php
$koneksidb = mysqli_connect("localhost","root","","MarthaAgung.com");

# Baca noNota dari URL
if(isset($id)){
	$noNota = $id;
	// Perintah untuk mendapatkan data dari tabel pembelian
	$mySql = "SELECT pembelian.*, petugas.nm_petugas FROM pembelian
				LEFT JOIN petugas ON pembelian.kd_petugas=petugas.kd_petugas 
				WHERE no_pembelian='$noNota'";
	$myQry = mysqli_query($koneksidb,$mySql)  or die ("Query salah");
	$kolomData = mysqli_fetch_array($myQry);
}
else {
	echo "Nomor Nota (noNota) tidak ditemukan";
	exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
  window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>

<style type="text/css">
  body,td,th {
    font-family: Courier New, Courier, monospace;
  }
  body{
    margin:0px auto 0px;
    padding:3px;
    font-size:12px;
    color:#333;
    width:95%;
    background-position:top;
    background-color:#fff;
  }
  .table-list {
    clear: both;
    text-align: left;
    border-collapse: collapse;
    margin: 0px 0px 10px 0px;
    background:#fff;  
  }
  .table-list td {
    color: #333;
    font-size:12px;
    border-color: #fff;
    border-collapse: collapse;
    vertical-align: center;
    padding: 3px 5px;
    border-bottom:1px #CCCCCC solid;
  }
</style>

<body onLoad="window.print()">
<table class="table-list" width="430" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td height="87" colspan="6" align="center">
		<strong>UD. ROHMAHTANI</strong><br />
        <center>Tuban</center> 
    </td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong>Nota Pembelian</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>No Nota :</strong> <?php echo $kolomData['no_pembelian']; ?></td>
    <td colspan="3" align="right"> <?php echo ($kolomData['tgl_pembelian']); ?></td>
  </tr>
  <tr>
    <td width="32" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="193" bgcolor="#F5F5F5"><strong>Daftar Produk </strong></td>
    <td width="193" bgcolor="#F5F5F5"><strong>Supplier </strong></td>
    <td width="55" align="right" bgcolor="#F5F5F5"><strong>Harga@</strong></td>
    <td width="27" align="right" bgcolor="#F5F5F5"><strong>Qty</strong></td>
    <td width="97" align="right" bgcolor="#F5F5F5"><strong>Subtotal(Rp) </strong></td>
  </tr>
<?php
# Baca variabel
$totalBayar = 0; 
$jumlahProduk = 0;  
$uangKembali=0;

# Menampilkan List Item produk yang dibeli untuk Nomor Transaksi Terpilih
$notaSql = "SELECT detail_pembelian.*, produk.nm_produk, produk.harga_modal, supplier.nm_supplier
            FROM detail_pembelian 
            INNER JOIN produk ON detail_pembelian.kd_produk = produk.kd_produk
            INNER JOIN supplier ON detail_pembelian.kd_supplier = supplier.kd_supplier
            WHERE no_pembelian='$noNota'";

$notaQry = mysqli_query($koneksidb, $notaSql)  or die ("Query list salah");
$nomor  = 0;  
while ($notaData = mysqli_fetch_array($notaQry)) {
  $nomor++;
	$subTotal 	= $notaData['subtotal'];
	$totalBayar	= $totalBayar + $subTotal;
	$jumlahProduk = $jumlahProduk + $notaData['jumlah'];
	$uangKembali= $kolomData['uang_bayar'] - $totalBayar;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $notaData['nm_produk']; ?></td>
    <td><?php echo $notaData['nm_supplier']; ?></td>
    <td align="right">Rp. <?php echo $notaData['harga_modal']; ?></td>
    <td align="right"><?php echo $notaData['jumlah']; ?></td>
    <td align="right">Rp. <?php echo $subTotal; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3" align="right"><strong>Total Belanja (Rp) : </strong></td>
    <td colspan="3" align="right" bgcolor="#F5F5F5">Rp. <?php echo $kolomData['total']; ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><strong> Uang Bayar (Rp) : </strong></td>
    <td colspan="3" align="right">Rp. <?php echo $kolomData['uang_bayar']; ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><strong>Uang Kembali (Rp) : </strong></td>
    <td colspan="3" align="right">Rp. <?php echo $uangKembali; ?></td>
  </tr>
  <tr>
    <td colspan="6"><strong>Petugas :</strong> <?php echo $kolomData['nm_petugas']; ?></td>
  </tr>
</table>
</body>
</html>
