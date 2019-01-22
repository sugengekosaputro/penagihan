<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Pemesanan<small>Billy Box Bangil</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>pemesanan/tambah" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap col-xs-12" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>ID Order</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                    <th>Total Kirim</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $dt){ ?>
                  <tr>
                      <td><?php echo $dt->id_order ?></td>
                      <td><?php echo $dt->nama_pelanggan ?></td>
                      <td><?php echo $dt->alamat ?></td>
                      <td><?php echo $dt->tanggal_order ?></td>
                      <td>
                        Order : <?php echo $dt->status_order ?> <br>
                        Pembayaran : <?php echo $dt->status_pembayaran ?>
                      </td>
                      <td style="color:red"><?php echo ''?></td>
                    <td>
                      <a href="<?php echo site_url('pemesanan/detail/'.$dt->id_order) ?>" class="btn btn-success"><span class="fa fa-list">&nbsp</span>Detail</a>
                       <br>
                      <a href="<?php echo site_url('') ?>" class="btn btn-primary"><span class="fa fa-chevron-down">&nbsp</span>Pesanan Selesai</a>
                    </td>
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
