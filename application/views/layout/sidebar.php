<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Menu</h3>
    <ul class="nav side-menu">
      <li><a href="<?php echo base_url('home')?>"><i class="fa fa-home"></i>
          Home<span class="label label-success pull-right"></span></a>
      </li>
      <li class="<?php if(isset($libarang)){echo $libarang;} ?>"><a><i class="fa fa-edit"></i> Barang <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="<?php if(isset($ulbarang)){echo $ulbarang;} ?>">
          <li class="<?php if(isset($lidaftarbarang)){echo $lidaftarbarang;} ?>"><a href="<?php echo base_URL('barang'); ?>">Daftar Barang</a></li>
          <li><a href="<?php echo base_URL('barang/stok_barang'); ?>">Stok Gudang</a></li>
        </ul>
      </li>
      <li class="<?php if(isset($lipemesanan)){echo $lipemesanan;} ?>"><a><i class="fa fa-desktop"></i> Pemesanan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="<?php if(isset($ulpemesanan)){echo $ulpemesanan;} ?>">
          <li class="<?php if(isset($lidaftarpesanan)){echo $lidaftarpesanan;} ?>"><a href="<?php echo base_url('pemesanan'); ?>">Daftar Pesanan</a></li>
          <li><a href="<?php echo base_url('pemesanan/riwayat'); ?>">Riwayat Pesanan</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-table"></i> Penagihan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url('penagihan')?>">Belum Lunas</a></li>
          <li><a href="<?php echo base_url('penagihan/riwayat')?>">Riwayat Penagihan</a></li>
        </ul>
      </li>
      <li class="<?php if(isset($lipelanggan)){echo $lipelanggan;} ?>"><a href="<?php echo base_url('pelanggan')?>"><i class="fa fa-bar-chart-o"></i>
          Pelanggan<span class="label label-success pull-right"></span></a>
      </li>
      <li class="<?php if(isset($liuser)){echo $liuser;} ?>"><a href="<?php echo base_url('user')?>"><i class="fa fa-bar-chart-o"></i>
          User<span class="label label-success pull-right"></span></a>
      </li>
      <li><a><i class="fa fa-clone"></i>MASTER LAYOUT<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url('Master/formMultiple')?>"><i class="fa fa-bar-chart-o"></i>
              form multiple<span class="label label-success pull-right"></span></a>
          </li>
          <li><a href="<?php echo base_url('Master/selectsuggest')?>"><i class="fa fa-bar-chart-o"></i>
              Select Suggest<span class="label label-success pull-right"></span></a>
          </li>
          <li><a href="<?php echo base_url('Master/checkbox')?>"><i class="fa fa-bar-chart-o"></i>
              Checkbox<span class="label label-success pull-right"></span></a>
          </li>
        </ul>
      </li>
    </ul>
  </div>             
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Settings">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Lock">
    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('login/logout')?>">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->