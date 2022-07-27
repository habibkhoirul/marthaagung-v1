<div class="modal fade" id="modal_supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width: 100%">
  <div class="modal-dialog modal-lg" role="document" style="width: 100%">
    <div class="modal-content">
      <div class="modal-header">
    
        <div class="col-md-10">
          <h4 class="modal-title" id="myModalLabel">
            <span class="glyphicon glyphicon-search"></span> Pilih Data Supplier               
          </h4>
        </div>
    
        <div class="col-md-1">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

      </div>

      <div class="modal-body table-responsive">
        <table class="table table-striped" style="font-size: small;" id="tabel2">
            <thead>
            <th>Kode Supplier</th>
            <th>Nama</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Opsi</th>
          </thead>
          <tbody>
          <?php 
          foreach ($dt_supplier->result() as $data){
                echo '
                <tr>
                <td>'.$data->kd_supplier.'</td>
                <td>'.$data->nm_supplier.'</td>
                <td>Rp. '.$data->no_telepon.'</td>
                <td>Rp. '.$data->alamat.'</td>
                <td>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Pilih Data Ini" onClick="simpanform.supplier.value = \''.$data->nm_supplier.'\'; simpanform.kdsupplier.value = \''.$data->kd_supplier.'\'" data-dismiss="modal">
                          <i class="fas fa-check"></i>
                        </button>
                      </td>
                    </tr>';
          } ?>
    
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>