<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kwitansi Pengeluaran</title>
	<style type="text/css">
    @page { margin: 10pt 20pt 10pt 20pt; }
    html{
      margin: 10pt 20pt 10pt 20pt;
    }
    body{
      color:#111 !important;
      font-size:8pt;
      font-family: "calibri", "Helvetica Neue", Helvetica, Arial, sans-serif;
      padding-bottom: 10px;
    }
    #header { position: fixed; left: 0px; top: -90px; right: 0px; text-align: center;}
    #footer { position: fixed; left: 0px; bottom: -110px; right: 0px; height: 180px; border-top: 2px solid #282828;padding-top: 8px;}
    #footer .page:after { content: counter(page, upper-roman); }
    .content{
      page-break-after: auto;
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
	    border: 1px solid #b3b3b3 !important;
	  }

    ol li,
		ul li{
      text-align: justify;
			padding-bottom: 10px !important;
    }

		hr{
			height: 1px;
			border:0px;
			border-top:1px dashed #bbbbbb;
			display: block;
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

  <div class="content">
    <table width="100%">
      <tr>
				<td width="12%">
          <img src="<?= site_url(IMAGES_WEB.'viland_logo.png'); ?>" height="60px">
        </td>
        <td>
          <p>
            <strong><?= $company_name; ?></strong><br/>
            <?= $company_address ?><br/>
            Phone : <?= $company_phone ?><br/>
            Email : <?= $company_email ?><br/>
						Website : <?= $company_website ?><br/>

          </p>
        </td>
        <td width="40%" style="text-align:right;">
          <h1 style="margin-top:22px;"><?= 'KWITANSI PEMBAYARAN' ?><br/>
						<small><?= $detil_kwitansi ?></small>
					</h1>
        </td>
      </tr>
    </table>

    <table width="100%" class="table">
      <tr>
        <td width="50%" style="padding:0px 10px 10px 0px;">
          <div style="border:1px solid #b3b3b3;padding:5px;">
            <table width="100%;" class="table">
              <tr>
                <td width="24%">No</td>
                <td width="3%">:</td>
                <td><strong><?= !empty($set->pengeluaran_no) ? $set->pengeluaran_no : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Hari / Tanggal</td>
                <td>:</td>
                <td><?= $hari ?>, <?= $tanggal ?></td>
              </tr>
            </table>
          </di>
        </td>
        <td width="50%" style="padding:0px 0px 10px 10px;">
          <div style="border:1px solid #b3b3b3;padding:5px 5px 5px;">
            <table width="100%;" class="table">
              <tr>
                <td>Dibayar Kepada :</td>
              </tr>
              <tr>
                <td><strong><?= $set->pengeluaran_kepada ?></strong></td>
              </tr>
            </table>
          </di>
        </td>
      </tr>
    </table>

    <table class="table table-bordered" width="100%">
      <tr>
        <th width="5%">NO</th>
        <th>URAIAN</th>
        <th width="8%">VOLUME</th>
        <th width="8%">SATUAN</th>
        <th width="18%">HARGA SATUAN</th>
        <th width="18%">SUB TOTAL</th>
      </tr>
      <tr>
        <td style="text-align:center;">1</td>
        <td><?= $set->pengeluaran_nama ?></td>
        <td style="text-align:center;"><?= $set->pengeluaran_volume ?></td>
        <td style="text-align:center;"><?= $set->pengeluaran_satuan ?></td>
        <td>
					<span style="display:inline-block;float:left;width:15px;">Rp.</span>
					<span style="display:inline-block;float:right;width:110px;text-align:right;"><?= number_format($set->pengeluaran_harga_satuan) ?></span>
					<span style="clear:both;"></span>
        </td>
        <td>
					<span style="display:inline-block;float:left;width:15px;">Rp.</span>
					<span style="display:inline-block;float:right;width:110px;text-align:right;"><?= number_format($set->pengeluaran_total) ?></span>
					<span style="clear:both;"></span>
				</td>
      </tr>
			<tr>
        <td style="text-align:center;">2</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">3</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">4</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">5</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">6</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
				<td colspan="5" style="text-align:right;padding-right:10px;"><strong>TOTAL</strong></td>
			  <td>
					<span style="display:inline-block;float:left;width:15px;">Rp.</span>
					<span style="display:inline-block;float:right;width:110px;text-align:right;"><strong><?= number_format($set->pengeluaran_total) ?></strong></span>
					<span style="clear:both;"></span>
				</td>
			</tr>
    </table>
		<br/><br/>
		<table class="table table-bordered" width="100%" style="text-align:center;">
			<tr>
				<td width="25%" style="height:70px"></td>
				<td width="25%" style="height:70px"></td>
				<td width="25%" style="height:70px">
					&nbsp;
				</td>
				<td width="25%" style="height:70px">
					Disetujui Oleh:
				</td>
			</tr>
		</table>

		<br/><br/><br/>
		<hr/>
		<br/><br/>

		<table width="100%">
      <tr>
				<td width="12%">
          <img src="<?= site_url(IMAGES_WEB.'viland_logo.png'); ?>" height="60px">
        </td>
        <td>
          <p>
            <strong><?= $company_name; ?></strong><br/>
            <?= $company_address ?><br/>
            Phone : <?= $company_phone ?><br/>
            Email : <?= $company_email ?><br/>
						Website : <?= $company_website ?><br/>

          </p>
        </td>
        <td width="40%" style="text-align:right;">
          <h1 style="margin-top:22px;"><?= 'BUKTI PEMBAYARAN' ?><br/>
						<small><?= $detil_kwitansi ?></small>
					</h1>
        </td>
      </tr>
    </table>

    <table width="100%" class="table">
      <tr>
        <td width="50%" style="padding:0px 10px 10px 0px;">
          <div style="border:1px solid #b3b3b3;padding:5px;">
            <table width="100%;" class="table">
              <tr>
                <td width="24%">No</td>
                <td width="3%">:</td>
                <td><strong><?= !empty($set->pengeluaran_no) ? $set->pengeluaran_no : '-' ?></strong></td>
              </tr>
              <tr>
                <td>Hari / Tanggal</td>
                <td>:</td>
                <td><?= $hari ?>, <?= $tanggal ?></td>
              </tr>
            </table>
          </di>
        </td>
        <td width="50%" style="padding:0px 0px 10px 10px;">
          <div style="border:1px solid #b3b3b3;padding:5px 5px 5px;">
            <table width="100%;" class="table">
              <tr>
                <td>Dibayar Kepada :</td>
              </tr>
              <tr>
                <td><strong><?= $set->pengeluaran_kepada ?></strong></td>
              </tr>
            </table>
          </di>
        </td>
      </tr>
    </table>

    <table class="table table-bordered" width="100%">
      <tr>
        <th width="5%">NO</th>
        <th>URAIAN</th>
        <th width="8%">VOLUME</th>
        <th width="8%">SATUAN</th>
        <th width="18%">HARGA SATUAN</th>
        <th width="18%">SUB TOTAL</th>
      </tr>
      <tr>
        <td style="text-align:center;">1</td>
        <td><?= $set->pengeluaran_nama ?></td>
        <td style="text-align:center;"><?= $set->pengeluaran_volume ?></td>
        <td style="text-align:center;"><?= $set->pengeluaran_satuan ?></td>
        <td>
					<span style="display:inline-block;float:left;width:15px;">Rp.</span>
					<span style="display:inline-block;float:right;width:110px;text-align:right;"><?= number_format($set->pengeluaran_harga_satuan) ?></span>
					<span style="clear:both;"></span>
        </td>
        <td>
					<span style="display:inline-block;float:left;width:15px;">Rp.</span>
					<span style="display:inline-block;float:right;width:110px;text-align:right;"><?= number_format($set->pengeluaran_total) ?></span>
					<span style="clear:both;"></span>
				</td>
      </tr>
			<tr>
        <td style="text-align:center;">2</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">3</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">4</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">5</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
        <td style="text-align:center;">6</td>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
			<tr>
				<td colspan="5" style="text-align:right;padding-right:10px;"><strong>TOTAL</strong></td>
			  <td>
					<span style="display:inline-block;float:left;width:15px;">Rp.</span>
					<span style="display:inline-block;float:right;width:110px;text-align:right;"><strong><?= number_format($set->pengeluaran_total) ?></strong></span>
					<span style="clear:both;"></span>
				</td>
			</tr>
    </table>
		<br/><br/>
		<table class="table table-bordered" width="100%" style="text-align:center;">
			<tr>
				<td width="25%" style="height:70px"></td>
				<td width="25%" style="height:70px"></td>
				<td width="25%" style="height:70px">
					&nbsp;
				</td>
				<td width="25%" style="height:70px">
					Disetujui Oleh:
				</td>
			</tr>
		</table>

  </div><!--end content-->


</body>
</html>
