<div class="right_col" role="main">
  <div class="">
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
                    <th>Total Pesanan</th>
                    <th>Total Kirim</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>181221001</td>
                    <td>Cv. Fabi Nur Cahyo</td>
                    <td>Jl.Dr Soetomo</td>
                    <td>2018-12-21</td>
                    <td>2500</td>
                    <td><a style=color:red>300</a></td>
                    <td>
                      <a href="<?php echo site_url('pemesanan/detail') ?>" class="btn btn-success"><span class="fa fa-list">&nbsp</span>Detail</a>
                       <br>
                      <a href="<?php echo site_url('pemesanan/surat_jalan') ?>" class="btn btn-warning"><span class="fa fa-edit">&nbsp</span>Surat Jalan</a>
                       <br>
                      <a href="<?php echo site_url('') ?>" class="btn btn-primary"><span class="fa fa-chevron-down">&nbsp</span>Pesanan Selesai</a>
                    </td>
                  </tr>
                
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
