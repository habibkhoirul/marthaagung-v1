<h2><center>UD. ROHMAHTANI</center></h2>
<h4><center>Laporan Data Petugas</center></h4>
<br>
Dicetak Tanggal: <?php echo date('d M Y') ?>
<br><br>

<table width="100%" border="1" style="border: 1px solid #000">
<tr>
	<th>ID Petugas</th>
	<th>Nama</th>
	<th>No Telepon</th>
	<th>Username</th>
	<th>Level</th>
</tr>
<?php 
foreach ($dt_petugas->result() as $data){
	echo '
	<tr>
		<td>'.$data->kd_petugas.'</td>
		<td>'.$data->nm_petugas.'</td>
		<td>'.$data->no_telepon.'</td>
		<td>'.$data->username.'</td>
		<td>'.$data->level.'</td>
	</tr>';
} ?>
</table>

<br><br>
<center>Mengetahui, Kepala UD. RohmahTani</center>
<br>
<br>
<br>
<br>
<center>Kasmuri</center>