<!-- 
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
      
      </div>
    </div>
  </div>
</div>
-->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Barang<small>UD.BBB</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>barang/tambah" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Gramatur</th>
                    <th>Foto</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $data){ ?>
                  <tr>
                    <td><?php echo $data->id_barang; ?></td>
                    <td><?php echo $data->nama_barang; ?></td>
                    <td><?php echo $data->ukuran; ?></td>
                    <td><?php echo $data->gramatur; ?></td>
                    <td><img src="<?php echo $data->foto_barang; ?>" alt="" height="100px" weight="100px"></td>
                    <td><?php echo $data->harga_beli; ?></td>
                    <td><?php echo $data->harga_jual; ?></td>
                    <td>
                    <a href="<?php echo site_url('barang/edit/'.$data->id_barang) ?>" class="btn btn-warning"><span class="fa fa-edit">&nbsp</span>Update</a>
                      <a href="<?php echo site_url('barang/hapus/'.$data->id_barang) ?>" class="btn btn-danger"><span class="fa fa-trash">&nbsp</span>Hapus</a></td>
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
