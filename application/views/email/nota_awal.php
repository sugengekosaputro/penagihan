<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nota Awal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<table border="0"  style="width:100%;">
  <tr valign="top" align="left">
    <th style="width:10%"><img width="220px" height="70px" src="<?php echo base_url('assets/images/udbbbicon.png'); ?>" alt="UDBBB"></th>
    <th style="width:40%;padding-top:5%;padding-bottom:1%;" align="center"><a style="font-size:20px"><u>Nota Pemesanan</th>
    <th style="width:50%">Pasuruan &emsp; <?php echo date('d-m-Y');?></th>
  </tr>
</table>
<br>
<table border="0"  style="width:100%;">
    <tr valign="top" align="left">
    <th style="width:10%"></th>
    <th style="width:60%"></th>
    <th style="width:30%"></th>
  </tr>
  <tr valign="top">
    <td>Office</td>
    <td>: Perum Permata Asri F6 Bangil Pasuruan</td> 
    <td></td>
  </tr>
  <tr valign="top">
    <td >Were House </td>
    <td>: Jl Raya Nganglang RT02/RW03 Oro Oro<br>&nbsp;&nbsp;Ombo Kulon Rembang Pasuruan Jatim</td>
    <td>Tuan/Toko&nbsp;: <?php echo $pelanggan->nama_pelanggan;?></td> 
  </tr>
  <tr valign="top">
    <td>Telp</td>
    <td>: 0343-6750665<br>&nbsp;&nbsp;+6281217155793</td>
    <td valign="top">Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $pelanggan->alamat;?></td> 
  </tr>
  <tr valign="top">
    <td>Email </td>
    <td>: <a style="color:blue"><u>moch.subani@gmail.com</u></a></td>
    <td>Nota No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $pelanggan->id_order;?></td> 
  </tr>
</table>
<br>
<table border="1" style="width:100%; border-collapse: collapse;">
  <tr align="center" valign="top"> 
      <th style="width:15%;">Tanggal</th>
      <th style="width:5%;">Jumlah</th>
      <th style="width:5%;">Satuan</th>
      <th>Nama Barang</th>
      <th style="width:10%;">Harga</th>
      <th style="width:15%;">Total</th>
  </tr>
  <tr valign="top" style="border-bottom:1pt solid white;">
      <td style="border-bottom:1pt solid white;">&emsp;</td>
      <td style="border-bottom:1pt solid white;">&emsp;</td>
      <td style="border-bottom:1pt solid white;">&emsp;</td>
      <td style="border-bottom:1pt solid white;">&emsp;</td>
      <td style="border-bottom:1pt solid white;">&emsp;</td>
      <td style="padding-bottom:50px;border-bottom:1pt solid white;">&emsp;</td>
  </tr>
  <?php foreach($listbarang as $list){?> 
  <tr  style="border-bottom:1pt solid white;" valign="top">
      <td style="border-bottom:1pt solid white; "><?php echo date('d-m-Y',strtotime($list->tanggal_order));?></td>
      <td style="border-bottom:1pt solid white; " align="right"><?php echo $list->jumlah;?></td>
      <td style="border-bottom:1pt solid white;" align="left"><?php echo $list->satuan;?></td>
      <td style="border-bottom:1pt solid white; "><?php echo $list->nama_barang;?></td>
      <td style="border-bottom:1pt solid white; "><?php echo 'Rp. '.number_format($list->harga);?></td>
      <td style="border-bottom:1pt solid white; "><?php echo 'Rp. '.number_format($list->harga * $list->jumlah);?></td>
  </tr>
  <?php } ?>

  <tr valign="top" style="">
      <td style="border-top:1pt solid white; padding-top:50px">&emsp;</td>
      <td style="border-top:1pt solid white;">&emsp;</td>
      <td style="border-top:1pt solid white;">&emsp;</td>
      <td style="border-top:1pt solid white;">&emsp;</td>
      <td style="border-top:1pt solid white;">&emsp;</td>
      <td style="border-top:1pt solid white;">&emsp;</td>
  </tr>
  <tr  style="border-bottom:1pt solid white;padding-top:20px" valign="top">
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="right"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="left"></td>
      <td style="border:1pt solid white; border-top:1pt solid black;border-right:1pt solid black;">acc transf: bca 2250531306</td>
      <td style="border-bottom:1pt solid black; ">Jumlah</td>
      <td style="border-bottom:1pt solid black; "><?php echo 'Rp. '.number_format($jumlah->total_bayar);?></td>
  </tr>
  <tr  style="border-bottom:1pt solid white;padding-top:20px" valign="top">
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="right"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="left"></td>
      <td style="border:1pt solid white; border-top:1pt solid black;border-right:1pt solid black;">A.n : Subani</td>
      <td style="border-bottom:1pt solid black; ">diBayar</td>
      <td style="border-bottom:1pt solid black; "><?php echo 'Rp. '.number_format($jumlah->dp); ?></td>
  </tr>
  <tr  style="border-bottom:1pt solid white;padding-top:20px" valign="top">
      <td style="border:1pt solid white; border-top:1pt solid black;"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="right"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="left"></td>
      <td style="border:1pt solid white; border-top:1pt solid black;border-right:1pt solid black;padding-top:20px"></td>
      <td style="border-bottom:1pt solid black; background-color:yellow">Dp 50%</td>
      <td style="border-bottom:1pt solid black; background-color:yellow"><?php echo 'Rp. '.number_format($jumlah->total_bayar / 2);?></td>
  </tr>
  <tr  style="border-bottom:1pt solid white;padding-top:20px" valign="top">
      <td style="border:1pt solid white; border-top:1pt solid black;"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="right"></td>
      <td style="border:1pt solid white; border-top:1pt solid black; padding-top:20px" align="left"></td>
      <td style="border:1pt solid white; border-top:1pt solid black;border-right:1pt solid white;padding-top:20px"><a style="color:red">Nb: jumlah harga & barang dapat berubah sesuai pengiriman</a></td>
      <td style="border:1pt solid white;"></td>
      <td style="border:1pt solid white;" ></td>
  </tr>

 </table>  
 <table style="margin-left:10%">
    <tr>
    <th style="padding-bottom:20px">Hormat Kami</th>
    </tr>
    <tr>
    <td style="padding-bottom:20px" align="center">ttd.</td>
    </tr>
    <tr>
    <td align="center">Subani</td>
    </tr>
 </table>
</body>
</html>