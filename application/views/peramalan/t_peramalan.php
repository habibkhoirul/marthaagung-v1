
<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa fa-industry"></i> Peramalan
    </center>
  </h3>
</div>

<div class="col-md-12">

  <form clas="row" action="<?php echo base_url() ?>Peramalan/generate" method="GET" name="simpanform" enctype="multipart/form-data">
    
    <div class="form-group row">
      <label for="peramalan_data" class="col-md-2 col-sm-2 col-form-label text-right">Pilih Produk</label>
      <div class="col-md-4 col-sm-10">
        <select class="js-example-basic-single form-control " id="kd_produk" name="kd_produk" required>
          <option value="">--- Pilih Produk ---</option>
          <?php foreach ($produks->result() as $produk) echo "<option value='$produk->kd_produk'".(isset($selectedProduk) && $selectedProduk == $produk->kd_produk ? "selected" : "").">$produk->nm_produk</option>"; ?>
        </select>
      </div>
      <label for="peramalan_data" class="col-md-3 col-sm-2 col-form-label text-right">Periode Yang Diramal</label>
      <div class="col-md-3 col-sm-12">
        <input type="number" min='1' name="jumlah_periode_peramalan" id="jumlah_periode_peramalan" class="form-control" value="<?= (isset($selectedJumlahPeriodePeramalan) ? $selectedJumlahPeriodePeramalan : '1') ?>" required>
      </div>  
    </div>

    <div class="form-group row">
      <div class="col-md-12 col-sm-12">
        <button type="submit" class="btn btn-outline-primary btn-block" >
          <i class="fa fa-check"></i> Buat Peramalan
        </button>
      </div>
    </div>
    
  </form>
</div>

<div class="col-md-12 mt-1">   

  <!-- Start of Alert Section -->
  <?php if( ($this->session->flashdata('error') != null) || ($this->session->flashdata('success') != null) ) { 
    if( $this->session->flashdata('error') != null) {
      $messages = $this->session->flashdata('error');
      $alertType = 'danger';
    
    } else {
      $messages = $this->session->flashdata('success');
      $alertType = 'success';
    } 
  ?>
  <div class="alert alert-<?php echo $alertType ?> alert-dismissible fade show mt-3" role="alert">
    <strong><?php echo $messages ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>
  <!-- End of Alert Section -->

  <div class="table-responsive" style="border-top: 2px solid #6c757d; margin-top: 10px; padding-top: 10px;">

  	<table class="table table-striped table-hover" id="tabel">
  		<thead>
        <th>#</th>
  			<th>Bulan &amp; Tahun</th>
  			<th>Minggu</th>
  			<th>Produk</th>
  			<th>Jumlah Penjualan (y)</th>
        <?= ($config->tampil_perhitungan) ? '
          <th>Waktu (x)</th>
          <th>x*y</th>
          <th>x^2</th>' : '' 
        ?>
        <th>MAPE</th>
  		</thead>
  		<tbody>
  		<?php 
        $no = 1;
        $chartLabel = '';
        $chartPenjualan = '';
        $chartPeramalan = '';
        $chatTitle = '';
        if(isset($penjualans) && is_array($penjualans)) {
          foreach ($penjualans['data'] as $keyPenjualanMonth => $penjualanWeek){
            foreach ($penjualanWeek as $key => $penjualan) {
              if(strpos("$keyPenjualanMonth", "$this->periodeKey") !== false) {
                echo '
                  <tr>
                    <td>'.$no++.'</td>
                    <td>'.$keyPenjualanMonth.'</td>
                    <td> Minggu ke-'.$key.'</td>
                    <td>'.$penjualan->nm_produk.'</td>
                    <td>'.$penjualan->y.'</td>'.
                    ($config->tampil_perhitungan ? '
                      <td>'.$penjualan->x.'</td>
                      <td>'.$penjualan->xy.'</td>
                      <td>'.$penjualan->xkuadrat.'</td>' : '').'
                    <td>'.$penjualan->mape.'</td>
                  </tr>
                ';
                // $chartPenjualan .= '"0",';
                $chartPeramalan .= '"'.$penjualan->y.'"'.',';
                $chartLabel .= '"'.$keyPenjualanMonth.'"'.',';
                $chatTitle = '"Grafik Penjualan dan Peramalan '.$penjualan->nm_produk.'"';

              } else {
                // Menampilkan Data sebelum diramal
                echo '
                  <tr>
                    <td>'.$no++.'</td>
                    <td>'.date('F Y', DateTime::createFromFormat('!Y-m', trim($keyPenjualanMonth))->getTimestamp()).'</td>
                    <td> Minggu ke-'.$key.'</td>
                    <td>'.$penjualan->nm_produk.'</td>
                    <td>'.$penjualan->y.'</td>'.
                    ($config->tampil_perhitungan ? '
                      <td>'.$penjualan->x.'</td>
                      <td>'.$penjualan->xy.'</td>
                      <td>'.$penjualan->xkuadrat.'</td>' : '').'
                    <td>0</td>
                  </tr>
                ';
                $chartPenjualan .= '"'.$penjualan->y.'"'.',';
                $chartPeramalan .= 'null,';
                $chartLabel .= '"'.date('F Y', DateTime::createFromFormat('!Y-m', trim($keyPenjualanMonth))->getTimestamp()).'"'.',';
              }
            }
          } 

          echo '
            <tr>
              <th colspan="4">Jumlah</th>
              <th>'.$penjualans['jumlah']->y.'</th>'.
              ($config->tampil_perhitungan ? '
              <th>'.$penjualans['jumlah']->x.'</th>
              <th>'.$penjualans['jumlah']->xy.'</th>
              <th>'.$penjualans['jumlah']->xkuadrat.'</th>' : '').'
              <th>'.$penjualans['jumlah']->mape.'</th>
            </tr>
            <tr>
              <th colspan="4">Rata-Rata</th>
              <th>'.$penjualans['ratarata']->y.'</th>'.
              ($config->tampil_perhitungan ? '
              <th>'.$penjualans['ratarata']->x.'</th>
              <th>'.$penjualans['ratarata']->xy.'</th>
              <th>'.$penjualans['ratarata']->xkuadrat.'</th>' : '').'
              <th>'.round($penjualans['jumlah']->mape / $selectedJumlahPeriodePeramalan, 2).'</th>
            </tr>
            <tr>
              <th colspan="'.($config->tampil_perhitungan ? '8' : '5').'">MAPE</th>
              <th>'.round($penjualans['jumlah']->mape / $selectedJumlahPeriodePeramalan, 2).'</th>
            </tr>
          ';
        }
      ?>
  		</tbody>
  	</table>

  </div>

  <div>
    <canvas width="1000" height="400" id="myChart"></canvas>
  </div>
</div>

<!-- Load CDN Chart Js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  function gettgl(){
    var d, nowdate, year, month;
    d = new Date();
    nowdate = d.getDate();
    month = d.getMonth()+1; 
    year = d.getFullYear();

    document.getElementById("tgl_start").value =  year + '-' + month + '-' + nowdate;
  };

  // Menampilkan Chart Js
  const labels = [<?php echo substr($chartLabel, 0, -1); ?>];

  const data = {
    labels: labels,
    datasets: [
      {
        label: 'Data Penjualan',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [<?php echo substr($chartPenjualan, 0, -1); ?>],
      },
      {
        label: 'Data Peramalan',
        backgroundColor: 'rgb(255, 191, 0)',
        borderColor: 'rgb(255, 191, 0)',
        data: [<?php echo substr($chartPeramalan, 0, -1); ?>],
      }
    ]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: <?php echo $chatTitle ?>
        }
      },
      hover: {
        mode: 'index',
        intersec: false
      },
      scales: {
        y: {
          ticks: {
            // forces step size to be 50 units
            stepSize: 5,
            beginAtZero: false
          }
        }
      }
    }
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
  
  consol.log(myChart);
</script>
