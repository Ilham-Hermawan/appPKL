<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LPA</title>
	<style type="text/css">
    @page { margin: 90.4252pt 48.189pt 36pt 45.3543pt; }
    html{
      margin: 90.4252pt 48.189pt 36pt 45.3543pt;
    }
    body{
      color:#111 !important;
      font-size:10pt;
      font-family: "calibri", "Helvetica Neue", Helvetica, Arial, sans-serif;
      padding-bottom: 10px;
      padding-top: 50px;
    }
    #header { position: fixed; left: 0px; top: -90px; right: 0px; text-align: center;}
    #footer { position: fixed; left: 0px; bottom: -110px; right: 0px; height: 180px; border-top: 2px solid #282828;padding-top: 8px;}
    #footer .page:after { content: counter(page, upper-roman); }
    .content{
      page-break-after: always;
    }
    p{
      text-align: justify;
    }
    .table > tr > td {
      padding: 4px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }
    .table > tr > td {
      padding: 0px;
      line-height: 1.42857143;
      vertical-align: top;
      border:0px;
    }
		.table-bordered{
			border-spacing: 0;
			border-collapse: collapse;
		}
		.table-bordered th,
	  .table-bordered td {
	    border: 1px solid #333 !important;
	  }

    ol li,
		ul li{
      text-align: justify;
			padding-bottom: 10px !important;
    }

    #footerz {
      width: 100%;
    }

    #left, #right {
      display: inline-block;
      box-sizing: border-box;
      width: 45%;
      height: 100%;
    }

    #left {
      margin-right: 50px;
    }
    #wrapper {
      margin: 0 auto;
      width: 1000px;
    }

    #content {
        float: left;
        background: #FFFFFF;
        width: 850px;
    }

    #leftcolumn {
        background: #33CCFF;
        width: 150px;
        float: left;
    }

	</style>
</head>
<body>

  <div id="header">

    <table width="100%" style="border:0px !important;">
      <tr>
        <td width="20%">
          <img src="<?= site_url(IMAGES_WEB.'rk_logo.png'); ?>" width="100px">
        </td>
        <td width="80%" style="text-align:center;">
          <span style="font-size:24pt;color:#0093dd !important;">PT. RAVINDO KARYA</span><br/>
          <span style="font-size:16pt;color:#1f497d !important;">DEVELOPER - CONTRACTOR</span><br/>
          <span style="font-size:9pt">JALAN ALIANYANG, KOMPLEK RUKO TERMINAL INDUK NO.3</span><br/>
          <span style="font-size:9pt">SINGKAWANG TENGAH 79116</span><br/>
          <span style="font-size:9pt">Telp. 0562-4644314 / E-mail : ravindo.karya@yahoo.com</span>
        </td>
      </tr>
    </table>
    <hr style="border:1px solid #111;margin-top:10px;">


  </div>


  <div class="content">
    <table width="100%" style="border:0px !important;">
      <tr>
        <td style="width:50%"></td>
        <td style="width:50%;text-align:center;">Singkawang, <?= $tanggal ?></td>
      </tr>
    </table>

    <table width="100%" class="table">
      <tr>
        <td width="5%"></td>
        <td width="1%"></td>
        <td width="40%"></td>
        <td style="padding-left:20px !important;">
          Kepada:
        </td>
      </tr>
      <tr>
        <td width="5%">No. </td>
        <td width="1%">:</td>
        <td width="40%"><strong><?= (!empty($set->lpa_no)) ? $set->lpa_no : '-'; ?></strong></td>
        <td rowspan="3" style="padding-left:20px !important;">
          <strong>Yth. Pimpinan PT. Bank Tabungan Negara</strong><br/>
          <strong>Cabang Pontianak</strong><br/>
          <strong>&nbsp;&nbsp;&nbsp;Di-</strong><br/><br/>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>PONTIANAK</u></strong>
        </td>
      </tr>
      <tr>
        <td width="5%">Lamp </td>
        <td width="1%">:</td>
        <td width="40%"><strong>- </strong></td>
      </tr>
      <tr>
        <td width="5%">Perihal </td>
        <td width="1%">:</td>
        <td width="40%"><strong>Permohonan Laporan Penilaian Akhir (LPA)</strong></td>
      </tr>
    </table>

    <br/><br/>
    <p>Dengan hormat,</p>
    <p>Sehubung dengan selesainya pembangunan fisik Perumahan <?= (!empty($set->rumah_nama)) ? $set->rumah_nama : 'ERROR' ?> <?= !empty($set->rumah_alamat) ? $set->rumah_alamat : 'ERROR' ?>, Kel. <?= !empty($set->rumah_desa) ? $set->rumah_desa : 'ERROR' ?>, Kec. <?= !empty($set->rumah_kecamatan) ? $set->rumah_kecamatan : 'ERROR' ?>. Maka dengan ini kami Mengajukan Laporan Penilaian Akhir (LPA) pembangunan fisik rumah.</p>
    <p>Adapun Blok dan Nomor Rumah Perumahan <?= !empty($set->rumah_nama) ? $set->rumah_nama : 'ERROR' ?>  sebagai berikut;</p>
    <p><i>- Terlampir</i></p>
    <p>Demikian surat permohonan ini kami sampaikan untuk dapat ditindaklanjuti. Atas perhatian dan kerjasamanya dari Pimpinan PT. Bank Tabungan Negara (Persero) Cabang Pontianak kami ucapkan terimakasih.</p>

    <table width="100%">
      <tr>
        <td width="50%"></td>
        <td width="50%" style="text-align:center;">
          Singkawang, <?= $tanggal ?><br/>
          <strong>PT. RAVINDO KARYA</strong>
          <br/><br/><br/><br/><br/>
          <strong><u>URAY YUSI MANDELA</u></strong><br/>
          General Manager
        </td>
      </tr>
    </table>

  </div><!--end content-->

	<div style="page-break-after:auto">
    <br/><br/>
    <br/><br/>
    <table class="table table-bordered" width="100%">
      <tr>
        <td style="text-align:center" width="5%"><strong>NO</strong></td>
        <td style="text-align:center"><strong>NAMA</strong></td>
        <td style="text-align:center" width="12%"><strong>BLOK</strong></td>
        <td style="text-align:center" width="12%"><strong>SHM</strong></td>
        <td style="text-align:center" width="12%"><strong>LUAS</strong></td>
        <td style="text-align:center" width="12%"><strong>IMB</strong></td>
      </tr>
      <?php $i= 1; ?>
      <?php foreach($detil as $row): ?>
        <tr>
          <td width="5%" style="text-align:center"><?= $i; ?></td>
          <td>&nbsp;<?= strtoupper($row->pelanggan_nama) ?></td>
          <td width="12%" style="text-align:center"><?= strtoupper($row->kavling_blok) ?></td>
          <td width="12%" style="text-align:center">
            <?php if($row->kavling_shm === "y"): ?>
							<?= $row->kavling_shm_no; ?>
						<?php elseif($row->kavling_shm === "p"): ?>
							<?= "PROSES"; ?>
						<?php else: ?>
							<?= "TIDAK ADA"; ?>
						<?php endif; ?>
          </td>
          <td width="12%" style="text-align:center"><?= $row->kavling_lt ?></td>
          <td width="12%" style="text-align:center">
            <?php if($row->kavling_imb === "y"): ?>
							ADA
						<?php elseif($row->kavling_imb === "p"): ?>
							PROSES
						<?php else: ?>
							TIDAK ADA
						<?php endif; ?>
          </td>
        </tr>
        <?php $i++; ?>
      <?php endforeach; ?>

    </table>
    <br/><br/><br/>
    <table width="100%">
      <tr>
        <td width="50%"></td>
        <td width="50%" style="text-align:center;">
          Singkawang, <?= $tanggal ?><br/>
          <strong>PT. RAVINDO KARYA</strong>
          <br/><br/><br/><br/><br/>
          <strong><u>URAY YUSI MANDELA</u></strong><br/>
          General Manager
        </td>
      </tr>
    </table>
  </div>




</body>
</html>
