<!-- page content -->

            <div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Responsive example<small>Users</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <p class="text-muted font-13 m-b-30">
           <a href="<?php echo site_url()?>barang/tambah" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
      </p>
      
      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Id Order</th>
            <th>Nama Barang</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Telpon</th>
            <th>Jumlah Order</th>
            <th>Tanggal Order</th>
            <th>Total Kirim</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($data as $data){  ?>
          <tr>
            <td><?php echo $data->id_order; ?></td>
            <td><?php echo $data->nama_barang; ?></td>
            <td><?php echo $data->nama_pelanggan; ?></td>
            <td><?php echo $data->alamat; ?></td>
            <td><?php echo $data->nomor_telepon ?></td>
            <td><?php echo $data->jumlah_order; ?></td>
            <td><?php echo date("Y-m-d",strtotime($data->tanggal_order)); ?></td>
            <td><?php echo $data->total_kirim; ?></td>
            <td><?php echo 'Rp. '.$data->total_bayar; ?></td>
            <td><?php echo $data->status_order; ?></td>
            <td>
            <a href="<?php echo site_url('barang/edit/'.$data->id_order) ?>" class="btn btn-warning"><span class="fa fa-edit">&nbsp</span>Update</a>
              <a href="<?php echo site_url('barang/hapus/'.$data->id_order) ?>" class="btn btn-danger"><span class="fa fa-trash">&nbsp</span>Hapus</a></td>
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
<!-- /page content -->
<?
