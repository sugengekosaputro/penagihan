<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Barang Gudang<small>UD.BBB</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Ukuran</th>
                    <th>Gramatur</th>
                    <th>Foto</th>
                    <th>Harga Jual</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $data){ ?>
                  <tr>
                    <td><?php echo $data->nama_barang; ?></td>
                    <td><?php echo $data->stok; ?></td>
                    <td><?php echo $data->ukuran; ?></td>
                    <td><?php echo $data->gramatur; ?></td>
                    <td><img src="<?php echo $data->foto_barang; ?>" alt="" height="100px" weight="100px"></td>
                    <td><?php echo $data->harga_jual; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
