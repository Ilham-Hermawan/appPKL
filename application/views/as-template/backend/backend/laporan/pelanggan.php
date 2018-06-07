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
      padding: 8px;
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
        <?= strtoupper($judul); ?><br/>
        <small>Per <?= $tanggal ?></small>
      </h3>
    </div>
    <?= br(3) ?>
    <table width="100%" class="table table-bordered" cellpadding="4px">
      <thead>
        <tr>
          <th width="7%">No.</th>
          <th width="11%">KTP</th>
          <th>Nama</th>
          <th>Detil</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($pelanggan)): ?>
          <?php $i =1; ?>
          <?php foreach($pelanggan as $row): ?>
            <tr>
              <td style="text-align:center;"><?= $i; ?></td>
              <td><?= $row->pelanggan_ktp; ?></td>
              <td><?= $row->pelanggan_nama; ?></td>
              <td>
                <?php
                if($row->pelanggan_jk === "l"){
                  $jk = "LAKI-LAKI";
                }
                else{
                  $jk = "PEREMPUAN";
                }
                ?>
                <small>
                <strong>Jenis Kelamin</strong> : <?= $jk ?><br/>
                <strong>Alamat</strong> : <?= $row->pelanggan_alamat ?><br/>
                <strong>TTL</strong> :<?= $row->pelanggan_ttl ?><br/>
                <strong>Kontak</strong> : <?= $row->pelanggan_kontak ?><br/>
                <strong>Pekerjaan</strong> : <?= $row->pelanggan_pekerjaan ?>
                </small>
              </td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="3">Data tidak ada</td>
					</tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>



</body>
</html>
