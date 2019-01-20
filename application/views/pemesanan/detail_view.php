<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Detail Pemesanan<small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <table class="table nowrap" cellspacing="0" width="100%" >
              <tr>
                <td style="border-top:none"><?php echo $pelanggan ?></td>
                <td class="text-right" style="border-top:none"><?php echo date('d F Y', strtotime($tanggal)); ?></td>
              </tr>
              <tr>
                <td style="border-top:none"><?php echo $alamat ?></td>
                <td class="text-right" style="border-top:none"></td>
              </tr>
            </table>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Jml Order</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $dt){?>
                  <tr>
                    <td><?php echo $dt->id_barang ?></td>
                    <td><?php echo $dt->nama_barang ?></td>
                    <td><?php echo $dt->jumlah ?></td>
                    <td><?php echo $dt->harga ?></td>
                    <td><?php echo $dt->harga * $dt->jumlah ?></td>
                  </tr>
                <?php } ?>
                  <tr>
                    <td colspan=3></td>
                    <td class="text-right"><b>Harga Bayar</b></td>
                    <td><b><?php echo $dt->total_bayar ?></b></td>
                  </tr>
                  <tr>
                    <td colspan=3></td>
                    <td class="text-right"><b>DP</td>
                    <td><b><?php echo $dt->total_bayar / 2; ?></b></td>
                  </tr>
                  <tr>
                    <td colspan=3></td>
                    <td class="text-right"><b>Total Bayar</td>
                    <td><b><?php echo $dt->dp;; ?></b></td>
                  </tr>
                  <tr class="table table-border-0">
                    <td colspan=3></td>
                    <td class="text-right"><b>Sisa Pembayaran</b></td>
                    <td><b><?php echo $dt->sisa ?></b></td>
                  </tr>
                </tbody>
              </table>
              <h4>Status Order : <label> <?php echo $order ?></label></h4>
              <h4>Status Bayar : <label> <?php echo $bayar ?></label></h4>
              <a href="#" class="btn btn-primary input-pembayaran"><span class="fa fa-shopping-cart"> &nbsp</span>Input Pembayaran</a>
            </div>
          </div>
        </div>   
      </div>

      <?php if($tagihan == null){ ?>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>History Surat Jalan</h2>
            <ul class="nav navbar-right panel_toolbox">
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            Pesanan Belum Dikirim
            <a href="<?php echo site_url('pemesanan/surat_jalan/'.$dt->id_order) ?>" class="btn btn-warning"><span class="fa fa-edit">&nbsp</span>Surat Jalan</a>
            <p class="text-muted font-13 m-b-30">
              <a href="<?php echo site_url('pemesanan')?>" class="btn btn-primary"><span class="fa fa-arrow-left">&nbsp</span>Kembali</a>
            </p>
          </div>
        </div>
      </div>

      <?php } else { ?>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>History Surat Jalan</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <a href="<?php echo site_url('pemesanan/surat_jalan/'.$dt->id_order) ?>" class="btn btn-warning"><span class="fa fa-edit">&nbsp</span>Surat Jalan</a>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No.Surat Jalan</th>
                  <th>Jumlah Kirim</th>
                  <th>Tanggal Kirim</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($tagihan as $tagihan){ ?>
                <tr>
                  <td><?php echo $tagihan->no_sj ?></td>
                  <td><?php echo $tagihan->total_dikirim ?></td>
                  <td><?php echo $tagihan->tanggal ?></td>
                  <td><a href="<?php echo site_url('tagihan/detail/'.$id_order.'/'.$tagihan->no_sj)?>" class="btn btn-primary btn-sm"><span class="fa fa-arrow-left">&nbsp</span>Lihat Rincian</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <p class="text-muted font-13 m-b-30">
              <a href="<?php echo site_url('pemesanan')?>" class="btn btn-primary"><span class="fa fa-arrow-left">&nbsp</span>Kembali</a>
            </p>
          </div>
        </div>
      </div>
      <?php }?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php echo site_url('pemesanan/pembayaran')?>" method="POST">
        <div class="modal-body">
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input name="id_order" value="<?php echo $dt->id_order ?>" hidden>
              <input name ="id_pembayaran" value="<?php echo $dt->id_pembayaran ?>" hidden>
              <input name ="dp" value="<?php echo $dt->dp ?>" hidden>
              <input name ="total_bayar" value="<?php echo $dt->total_bayar ?>" hidden>
              <input type="number" name="dibayar" class="form-control has-feedback-left" id="inputSuccess2" placeholder="total bayar">
              <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
          </div>
          <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
             <div class="radio">
                <label>
                  <input type="radio" class="flat" checked value="Baru" name="check"> Baru
                </label>
              </div>
             <div class="radio">  
                <label>
                  <input type="radio" class="flat" value="diproses" name="check"> Diproses
                </label>
              </div>
          </div> -->
          <div class="form-group">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" value="Simpan"/>     
        </div>
      </form>  
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
  $('.input-pembayaran').on('click', function () {
    $('#modelId').modal('show');
  });
})
</script>