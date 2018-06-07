<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= strtoupper($judul); ?></title>
	<style type="text/css">
    /*@page { margin: 90.4252pt 48.189pt 36pt 45.3543pt; }*/
    html{
      margin: 10pt 48.189pt 36pt 45.3543pt;
    }
    body{
      color:#111 !important;
      font-size:10pt;
      font-family: "calibri", "Helvetica Neue", Helvetica, Arial, sans-serif;
      padding-bottom: 10px;
      padding-top: 0px;
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
    .table-bordered th{
      background:#e2e2e2;
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
  <div style="page-break-after:auto;">
    <div style="text-align:center">
      <h3>
        <?= strtoupper($judul); ?><?= !empty($rab_nama) ? " ".$rab_nama : "-"  ?><br/>
        <small>Per <?= $tanggal ?></small>
      </h3>
    </div>
    <?= br(2) ?>
    <h4 style="margin-bottom:5px">Biaya Perolehan Tanah</h4>
    <table width="100%" class="table table-bordered" cellpadding="4px;">
      <thead>
        <tr>
          <th width="6%">No.</th>
          <th>Uraian</th>
          <th width="6%">Volume</th>
          <th width="10%">Satuan</th>
          <th width="17%">Harga Satuan</th>
          <th width="17%">Sub Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($bpt)): ?>
          <?php $i =1; ?>
          <?php foreach($bpt as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drb_uraian ?></td>
              <td style="text-align:center;"><?= $row->drb_volume ?></td>
              <td style="text-align:center;"><?= $row->drb_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drb_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drb_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bpt_set->bpt_total); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?= br(2) ?>
    <h4 style="margin-bottom:5px">Biaya Persiapan & Pengolahan Tanah</h4>
    <table width="100%" class="table table-bordered" cellpadding="4px;">
      <thead>
        <tr>
          <th width="6%">No.</th>
          <th>Uraian</th>
          <th width="6%">Volume</th>
          <th width="10%">Satuan</th>
          <th width="17%">Harga Satuan</th>
          <th width="17%">Sub Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($bppt)): ?>
          <?php $i =1; ?>
          <?php foreach($bppt as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drbp_uraian ?></td>
              <td style="text-align:center;"><?= $row->drbp_volume ?></td>
              <td style="text-align:center;"><?= $row->drbp_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drbp_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drbp_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bppt_set->bppt_total); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?= br(2) ?>
    <h4 style="margin-bottom:5px">Biaya Prasarana, Sarana & Utilitas</h4>
    <table width="100%" class="table table-bordered" cellpadding="4px;">
      <thead>
        <tr>
          <th width="6%">No.</th>
          <th>Uraian</th>
          <th width="6%">Volume</th>
          <th width="10%">Satuan</th>
          <th width="17%">Harga Satuan</th>
          <th width="17%">Sub Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="6" style="background:#b9d3da;font-weight:bold;">Prasarana</td>
        </tr>
        <?php if(!empty($bpsup)): ?>

          <?php $i =1; ?>
          <?php foreach($bpsup as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drbps_uraian ?></td>
              <td style="text-align:center;"><?= $row->drbps_volume ?></td>
              <td style="text-align:center;"><?= $row->drbps_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drbps_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drbps_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bpsu_set->bpsu_totalp); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
        <tr>
          <td colspan="6" style="background:#b9d3da;font-weight:bold;">Sarana</td>
        </tr>
        <?php if(!empty($bpsus)): ?>
          <?php $i =1; ?>
          <?php foreach($bpsus as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drbps_uraian ?></td>
              <td style="text-align:center;"><?= $row->drbps_volume ?></td>
              <td style="text-align:center;"><?= $row->drbps_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drbps_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drbps_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bpsu_set->bpsu_totals); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?= br(2) ?>
    <h4 style="margin-bottom:5px">Biaya Konstruksi Rumah</h4>
    <table width="100%" class="table table-bordered" cellpadding="4px;">
      <thead>
        <tr>
          <th width="6%">No.</th>
          <th>Uraian</th>
          <th width="6%">Volume</th>
          <th width="10%">Satuan</th>
          <th width="17%">Harga Satuan</th>
          <th width="17%">Sub Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($bkr)): ?>
          <?php $i =1; ?>
          <?php foreach($bkr as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drbk_uraian ?></td>
              <td style="text-align:center;"><?= $row->drbk_volume ?></td>
              <td style="text-align:center;"><?= $row->drbk_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drbk_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drbk_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bkr_set->bkr_total); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?= br(2) ?>
    <h4 style="margin-bottom:5px">Biaya Pemasaran</h4>
    <table width="100%" class="table table-bordered" cellpadding="4px;">
      <thead>
        <tr>
          <th width="6%">No.</th>
          <th>Uraian</th>
          <th width="6%">Volume</th>
          <th width="10%">Satuan</th>
          <th width="17%">Harga Satuan</th>
          <th width="17%">Sub Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($bp)): ?>
          <?php $i =1; ?>
          <?php foreach($bp as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drbp_uraian ?></td>
              <td style="text-align:center;"><?= $row->drbp_volume ?></td>
              <td style="text-align:center;"><?= $row->drbp_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drbp_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drbp_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bp_set->bp_total); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?= br(2) ?>
    <h4 style="margin-bottom:5px">Biaya Umum & Administrasi</h4>
    <table width="100%" class="table table-bordered" cellpadding="4px;">
      <thead>
        <tr>
          <th width="6%">No.</th>
          <th>Uraian</th>
          <th width="6%">Volume</th>
          <th width="10%">Satuan</th>
          <th width="17%">Harga Satuan</th>
          <th width="17%">Sub Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($bua)): ?>
          <?php $i =1; ?>
          <?php foreach($bua as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drba_uraian ?></td>
              <td style="text-align:center;"><?= $row->drba_volume ?></td>
              <td style="text-align:center;"><?= $row->drba_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drba_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drba_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bua_set->bua_total); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?= br(2) ?>
    <h4 style="margin-bottom:5px">Biaya Pajak & Bunga Pinjaman</h4>
    <table width="100%" class="table table-bordered" cellpadding="4px;">
      <thead>
        <tr>
          <th width="6%">No.</th>
          <th>Uraian</th>
          <th width="6%">Volume</th>
          <th width="10%">Satuan</th>
          <th width="17%">Harga Satuan</th>
          <th width="17%">Sub Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($bpbp)): ?>
          <?php $i =1; ?>
          <?php foreach($bpbp as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->drbp_uraian ?></td>
              <td style="text-align:center;"><?= $row->drbp_volume ?></td>
              <td style="text-align:center;"><?= $row->drbp_satuan ?></td>
              <td style="text-align:right;"><?= number_format($row->drbp_harga_satuan) ?></td>
              <td style="text-align:right;"><?= number_format($row->drbp_sub_jumlah) ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="5" style="text-align:right;">TOTAL</td>
            <td style="text-align:right;"><?= number_format($bpbp_set->bpbp_total); ?></td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="6">Data tidak ada</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>



  </div>



</body>
</html>
