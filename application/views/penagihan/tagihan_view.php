<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Nota Penjualan</h2>
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
                    <td><?php echo $dt->dikirim ?></td>
                    <td><?php echo $dt->harga ?></td>
                    <td>
                      <?php
                        $tot = $dt->harga * $dt->dikirim;
                        echo $tot;
                        $total_bayar[] = $tot;
                      ?>
                    </td>
                  </tr>
                <?php } ?>
                  <tr>
                    <td colspan=3></td>
                    <td class="text-right"><b>Harga Bayar</b></td>
                    <td><b><?php echo array_sum($total_bayar) ?></b></td>
                  </tr>
                  <tr>
                    <td colspan=3></td>
                    <td class="text-right"><b>DP</td>
                    <td><b><?php echo $dt->dp ?></b></td>
                  </tr>
                  <tr class="table table-border-0">
                    <td colspan=3></td>
                    <td class="text-right"><b>Sisa Pembayaran</b></td>
                    <td><b><?php echo $dt->sisa ?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>   
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Rincian Surat Jalan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Nama Barang</th>
                  <th>Jumlah Kirim</th>
                  <th>Tanggal Kirim</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($rincian as $rin){ ?>
                <tr>
                  <td><?php echo $rin->nama_barang ?></td>
                  <td><?php echo $rin->dikirim ?></td>
                  <td></td>
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
    </div>
  </div>
</div>