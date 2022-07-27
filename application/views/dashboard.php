
<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa-id-badge"></i> Stok Produk Habis
    </center>
  </h3>
</div>

<div class="table-responsive" style="border-top: 2px solid #6c757d; margin-top: 10px; padding: 10px">

  	<table class="table table-striped table-hover" id="tabel" style="font-size: 14px;">
      <thead>
  			<th>Kode Produk</th>
  			<th>Nama</th>
  			<th>Stok</th>
  		</thead>
  		<tbody>
  		<?php 
  		  foreach ($dt_produk_stok_tipis->result() as $data){
            echo '
            <tr>
            <td>'.$data->kd_produk.'</td>
            <td>'.$data->nm_produk.'</td>
            <td><strong>'.($data->stok < 0 ? 'HABIS' : $data->stok).'</strong></td>
            </tr>';
        } ?>
  		</tbody>
  	</table>

  </div>

