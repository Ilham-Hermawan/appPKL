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
      /*margin: 18pt 38.189pt 48pt 38.189pt;*/
			margin: 18pt 38.189pt 20pt 38.189pt;
    }
    body{
      color:#111 !important;
      font-size:6pt;
      font-family: "calibri", "Helvetica Neue", Helvetica, Arial, sans-serif;
      padding-bottom: 10px;
      padding-top: 0px;
    }
    #header { position: fixed; left: 0px; top: 0px; right: 0px;text-align: center;}
    #footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 180px; border-top: 2px solid #282828;padding-top: 8px;}
    #footer .page:after { content: counter(page, upper-roman); }
    .content{
      page-break-after: auto;
			padding-top: 60px !important;
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

			<table width="100%" class="table table-bordered" cellpadding="2px" style="margin:20px 0px;" border="0">
				<thead>
					<tr style="background:#EEEEEE !important;">
						<th rowspan="2" style="text-align:center;width:3%;">
							No.
						</th>
						<th rowspan="2" style="text-align:center;">
							Pelanggan
						</th>
						<th colspan="12" style="text-align:center;">
							PROGRES ADMINISTRASI PENGAJUAN KPR
						</th>
					</tr>
					<tr style="background:#EEEEEE !important;">
						<th style="width:6%;text-align:center;">BI CHECKING</th>
						<th style="width:6%;text-align:center;">PPJB</th>
						<th style="width:6%;text-align:center;">BERKAS</th>
						<th style="width:6%;text-align:center;">WAWANCARA</th>
						<th style="width:6%;text-align:center;">PENYERAHAN<br />BERKAS</th>
						<th style="width:6%;text-align:center;">OTS<br />/SURVEY</th>
						<th style="width:6%;text-align:center;">SP3K</th>
						<th style="width:6%;text-align:center;">LPA</th>
						<th style="width:6%;text-align:center;">VALIDASI<br />PAJAK</th>
						<th style="width:6%;text-align:center;">AKAD</th>
						<th style="width:6%;text-align:center;">SKR</th>
						<th style="width:6%;text-align:center;">JAMINAN</th>
					</tr>
				</thead>
				<tbody>
					<?php $x = 1;?>
					<?php foreach($set as $row): ?>
						<tr>
							<td rowspan="2" style="text-align:center;"><?= $x; ?></td>
							<td rowspan="2">
								<strong>NAMA : <?= $row->pelanggan_nama ?></strong><br />
								<strong>NO. KAVLING : <?= $row->kavling_blok ?></strong><br />
								<strong>NO. BOOKING : <?= $row->booking_no ?></strong>
							</td>
							<td style="text-align:center;">
								<!-- BI CHECKING -->
								<?php
									if(!empty($this->project_model->get_booking_data($row->booking_id)->booking_date)){
										if($this->project_model->get_booking_data($row->booking_id)->booking_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_booking_data($row->booking_id)->booking_date));
										}
									}
									else{
										echo "";
									}
								?>
							</td>
							<td style="text-align:center;">
								<!-- PPJB -->
								<?php
									if(!empty($this->project_model->get_ppjb($row->booking_id)->ppjb_date)){
										if($this->project_model->get_ppjb($row->booking_id)->ppjb_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_ppjb($row->booking_id)->ppjb_date));
										}
									}
									else{
										echo "";
									}
								?>
							</td>
							<td style="text-align:center;">
								<!-- BERKAS -->

							</td>
							<td style="text-align:center;">
								<!-- WAWANCARA -->
								<?php
									if(!empty($this->project_model->get_detil_wawancara($row->booking_id)->wawancara_tanggal)){
										if($this->project_model->get_detil_wawancara($row->booking_id)->wawancara_tanggal === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_detil_wawancara($row->booking_id)->wawancara_tanggal));
										}
									}
									else{
										echo "";
									}
								?>
							</td>
							<td style="text-align:center;">
								<!-- PENYERAHAN BERKAS -->
								<?php
									if(!empty($this->project_model->get_pb($row->booking_id)->db_date)){
										if($this->project_model->get_pb($row->booking_id)->db_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_pb($row->booking_id)->db_date));
										}
									}
									else{
										echo "";
									}
								?>

							</td>
							<td style="text-align:center;">
								<!-- OTS / SURVEY -->
								<?php
									if(!empty($this->project_model->get_ots($row->booking_id)->ots_date)){
										if($this->project_model->get_ots($row->booking_id)->ots_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_ots($row->booking_id)->ots_date));
										}
									}
									else{
										echo "";
									}
								?>

							</td>
							<td style="text-align:center;">
								<!-- SP3K -->
								<?php
									if(!empty($this->project_model->get_sp3k($row->booking_id)->sp3k_date)){
										if($this->project_model->get_sp3k($row->booking_id)->sp3k_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_sp3k($row->booking_id)->sp3k_date));
										}
									}
									else{
										echo "";
									}
								?>

							</td>
							<td style="text-align:center;">
								<!-- LPA -->
								<?php
									if(!empty($this->project_model->get_detil_lpa($row->booking_id)->lpa_tanggal)){
										if($this->project_model->get_detil_lpa($row->booking_id)->lpa_tanggal === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_detil_lpa($row->booking_id)->lpa_tanggal));
										}
									}
									else{
										echo "";
									}
								?>
							</td>
							<td style="text-align:center;">
								<!-- VALIDASI PAJAK -->
								<?php
									if(!empty($this->project_model->get_vpajak($row->booking_id)->vp_date)){
										if($this->project_model->get_vpajak($row->booking_id)->vp_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_vpajak($row->booking_id)->vp_date));
										}
									}
									else{
										echo "";
									}
								?>
							</td>
							<td style="text-align:center;">
								<!-- AKAD -->
								<?php
									if(!empty($this->project_model->get_detil_akad($row->booking_id)->akad_date)){
										if($this->project_model->get_detil_akad($row->booking_id)->akad_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_detil_akad($row->booking_id)->akad_date));
										}
									}
									else{
										echo "";
									}
								?>
							</td>
							<td style="text-align:center;">
								<!-- SKR -->
								<?php
									if(!empty($this->project_model->get_skr2($row->booking_id)->skr_date)){
										if($this->project_model->get_skr2($row->booking_id)->skr_date === "0000-00-00"){
											echo "00/00/00";
										}
										else{
											echo date('d/m/y', strtotime($this->project_model->get_skr($row->booking_id)->skr_date));
										}
									}
									else{
										echo "";
									}
								?>
							</td>
							<td style="text-align:center;">
								<!-- JAMINAN -->
							</td>
						</tr>
						<tr>
							<td style="text-align:center;">
								<!-- BI Checking -->
								<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
							</td>
							<td style="text-align:center;">
								<!-- PPJB -->
								<?php if(!empty($this->project_model->get_ppjb($row->booking_id)->ppjb_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- Berkas -->
								<?= $this->transaksi_model->count_kelengkapan_berkas($row->booking_id) ?> BERKAS
							</td>
							<td style="text-align:center;">
								<!-- Wawancara -->
								<?php if(!empty($this->project_model->get_detil_wawancara($row->booking_id)->dw_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- Penyerahan Berkas -->
								<?php if(!empty($this->project_model->get_pb($row->booking_id)->db_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- OTS/Survey -->
								<?php if(!empty($this->project_model->get_ots($row->booking_id)->ots_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- SP3K -->
								<?php if(!empty($this->project_model->get_sp3k($row->booking_id)->sp3k_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- LPA -->
								<?php if(!empty($this->project_model->get_detil_lpa($row->booking_id)->dlpa_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- VALIDASI PAJAK -->
								<?php if(!empty($this->project_model->get_vpajak($row->booking_id)->vp_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- AKAD -->
								<?php if(!empty($this->project_model->get_detil_akad($row->booking_id)->ad_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- SKR -->
								<?php if(!empty($this->project_model->get_skr2($row->booking_id)->skr_status)): ?>
									<img src="<?= base_url(IMAGES_ICONS.'tick.png') ?>" />
								<?php endif; ?>
							</td>
							<td style="text-align:center;">
								<!-- Jaminan -->
								<?php if(!empty($this->project_model->get_jaminan($row->booking_id))): ?>
									<?= date('d/m/Y', strtotime($this->project_model->get_jaminan($row->booking_id)->jaminan_expired)); ?>
								<?php endif; ?>
							</td>
						</tr>
					<?php $x++; ?>
					<?php endforeach; ?>

				</tbody>
				</table>

		<?php else:?>
			<h4>Data Belum Tersedia.</h4>
		<?php endif; ?>

	</div>



</body>
</html>
