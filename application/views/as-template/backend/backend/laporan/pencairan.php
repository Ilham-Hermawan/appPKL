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
      margin: 18pt 48.189pt 18pt 45.3543pt;
    }
    body{
      color:#111 !important;
      font-size:7pt;
      font-family: "calibri", "Helvetica Neue", Helvetica, Arial, sans-serif;
      padding-bottom: 10px;
      padding-top: 0px;
    }
    #header { position: fixed; left: 0px; top: 0px; right: 0px;text-align: center;}
    #footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 180px; border-top: 2px solid #282828;padding-top: 8px;}
    #footer .page:after { content: counter(page, upper-roman); }
    .content{
      page-break-after: auto;
			padding-top: 70px !important;
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
    .table-nonbordered{
			border-spacing: 0;
			border-collapse: collapse;
		}
    .table-nonbordered th {
	    padding:10px;
	  }
		.table-bordered{
			border-spacing: 0;
			border-collapse: collapse;
		}
		.table-bordered th{
			text-align: center !important;
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

    .right {
        float: left;
        background: red;
        width: 150px;
    }

    .leftcolumn {
        width: 100px;
        float: left;
        text-align: left;
    }

	</style>
</head>
<body>

	<div id="header">
		<div style="text-align:center">
      <h3>
        <?= strtoupper($judul); ?>
      </h3>
    </div>
    <?= br(2) ?>
    <div style="text-align:center;font-size:16px;color:#499DCB !important; font-weight:bold;text-transform:uppercase;"><?= !empty($perumahan) ? "Perumahan : ".$perumahan : "" ?></div>
	</div>

  <div class="content">

		<?php if(!empty($set)): ?>

			<?php
				$kategori = array(
					'Tanda Jadi',
					'Pembayaran ke 1',
					'Pembayaran ke 2',
					'Pembayaran ke 3',
					'Pembayaran ke 4',
					'Pembayaran ke 5',
					'Pembayaran ke 6',
					'Pencairan IMB',
					'Pencairan Induk',
					'Pencairan Jalan',
					'Pencairan Listrik',
					'Pencairan Sertifikat',
					'Bantuan Uang Muka'
				);
			?>

			<table width="100%" class="table table-bordered" cellpadding="2px" style="margin:20px 0px;" border="0">
				<thead>
					<tr style="background:#EEEEEE !important;">
						<th rowspan="3">No.</th>
						<th rowspan="3">PELANGGAN</th>
						<th colspan="9">LAPORAN PENERIMAAN</th>
						<th rowspan="3">HARGA<br />RUMAH</th>
						<th rowspan="3">TOTAL<br />PEMASUKKAN</th>
						<th rowspan="3">KEKURANGAN</th>
					</tr>
					<tr style="background:#EEEEEE !important;">
						<th colspan="3" rowspan="2">UANG MUKA</th>
						<th colspan="6">PENCAIRAN BANK</th>
					</tr>
					<tr style="background:#EEEEEE !important;">
						<th>RUMAH</th>
						<th>SERTIFIKAT</th>
						<th>IMB</th>
						<th>LISTRIK</th>
						<th>JALAN</th>
						<th>SBUM</th>
					</tr>
				</thead>
				<tbody>
					<?php $x =1; ?>
					<?php foreach($set as $row):?>
					<tr>
						<td rowspan="7" style="width:3%;text-align:center">
							<?= $x++; ?>
						</td>
						<td rowspan="7">
							<strong>Nama</strong> : <?= $row->pelanggan_nama ?><br/>
							<strong>No. Kavling</strong> : <?= $row->kavling_blok ?><br/>
							<strong>No. Booking</strong> : <?= $row->booking_no ?><br/>
						</td>
						<td style="text-align:center;width:4%;">TJ</td>
						<td style="text-align:center;width:5%;">
							<?php $tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[0]) ?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)) : '' ?>
						</td>
						<td style="text-align:right;width:5%;">
							<?php $total = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[0]) ?>
							<?= !empty($total) ? number_format($total->penerimaan_total) : ''; ?>
						</td>
						<td rowspan="7" style="text-align:center;width:5%">
							<?php
							//rumah / induk
								$tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[8])
							?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)).'<br/>'.number_format($tanggal->penerimaan_total) : ''; ?>
						</td>
						<td rowspan="7" style="text-align:center;width:5%">
							<?php
							//sertifikat
								$tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[11]);
							?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)).'<br/>'.number_format($tanggal->penerimaan_total) : ''; ?>
						</td>
						<td rowspan="7" style="text-align:center;width:5%">
							<?php
								//imb
								$tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[7]);
							?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)).'<br/>'.number_format($tanggal->penerimaan_total) : ''; ?>
						</td>
						<td rowspan="7" style="text-align:center;width:5%">
							<?php
								//listrik
								$tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[10])
							?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)).'<br/>'.number_format($tanggal->penerimaan_total) : ''; ?>
						</td>
						<td rowspan="7" style="text-align:center;width:5%">
							<?php
								//Jalan
								$tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[9])
							?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)).'<br/>'.number_format($tanggal->penerimaan_total) : ''; ?>
						</td>
						<td rowspan="7" style="text-align:center;width:5%">
							<?php
								//sbum
								$tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[12]);
							?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)).'<br/>'.number_format($tanggal->penerimaan_total) : ''; ?>
						</td>
						<td rowspan="7" style="text-align:center;width:7%">
							<strong><?= number_format($row->kavling_harga) ?></strong>
						</td>
						<td rowspan="7" style="text-align:center;width:7%">
							<strong><?= number_format($this->laporan_model->count_total_penerimaan($row->booking_id)) ?></strong>
						</td>
						<td rowspan="7" style="text-align:center;width:7%">
							<?php $kekurangan = intval($row->kavling_harga) - intval($this->laporan_model->count_total_penerimaan($row->booking_id)); ?>
							<strong><?= number_format($kekurangan);  ?></strong>
						</td>
					</tr>
					<tr>
						<td style="text-align:center;width:4%;">UM.1</td>
						<td style="text-align:center;width:5%;">
							<?php $tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[1]) ?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)) : '' ?>
						</td>
						<td style="text-align:right;width:5%;">
							<?php $total = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[1]) ?>
							<?= !empty($total) ? number_format($total->penerimaan_total) : ''; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align:center;width:4%;">UM.2</td>
						<td style="text-align:center;width:5%;">
							<?php $tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[2]) ?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)) : '' ?>
						</td>
						<td style="text-align:right;width:5%;">
							<?php $total = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[2]) ?>
							<?= !empty($total) ? number_format($total->penerimaan_total) : ''; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align:center;width:4%;">UM.3</td>
						<td style="text-align:center;width:5%;">
							<?php $tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[3]) ?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)) : '' ?>
						</td>
						<td style="text-align:right;width:5%;">
							<?php $total = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[3]) ?>
							<?= !empty($total) ? number_format($total->penerimaan_total) : ''; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align:center;width:4%;">UM.4</td>
						<td style="text-align:center;width:5%;">
							<?php $tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[4]) ?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)) : '' ?>
						</td>
						<td style="text-align:right;width:5%;">
							<?php $total = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[4]) ?>
							<?= !empty($total) ? number_format($total->penerimaan_total) : ''; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align:center;width:2%;">UM.5</td>
						<td style="text-align:center;width:5%;">
							<?php $tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[5]) ?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)) : '' ?>
						</td>
						<td style="text-align:right;width:5%;">
							<?php $total = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[5]) ?>
							<?= !empty($total) ? number_format($total->penerimaan_total) : ''; ?>
						</td>
					</tr>
					<tr>
						<td style="text-align:center;width:2%;">UM.6</td>
						<td style="text-align:center;width:5%;">
							<?php $tanggal = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[6]) ?>
							<?= !empty($tanggal) ? date('d/m/Y', strtotime($tanggal->penerimaan_tanggal)) : '' ?>
						</td>
						<td style="text-align:right;width:5%;">
							<?php $total = $this->laporan_model->get_detil_penerimaan($row->booking_id, $row->pelanggan_id, $kategori[6]) ?>
							<?= !empty($total) ? number_format($total->penerimaan_total) : ''; ?>
						</td>
					</tr>

					<?php endforeach; ?>
				</tbody>
				</table>

		<?php else:?>
			<h4>Data Belum Tersedia.</h4>
		<?php endif; ?>

	</div>



</body>
</html>
