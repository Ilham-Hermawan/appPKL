<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kwitansi Booking</title>
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
      page-break-after: after;
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
		h1 small{
			font-size: 10pt;
			font-weight: normal;
		}
		hr{
			height: 1px;
			border:0px;
			border-top:1px dashed #bbbbbb;
			display: block;
		}
		.order{
			margin:0px 0px 0px 30px;padding:0px;
		}
		.order li{
			padding:0px !important;
		}

	</style>
</head>
<body>

  <div style="page-break-after:always">
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
            Website : <?= $company_website ?>

          </p>
        </td>
        <td width="40%" style="text-align:right;">
          <h1 style="margin-top:10px;"><?= $kwitansi ?><br/>
						<small><?= $detil_kwitansi ?></small>
					</h1>
        </td>
      </tr>
    </table>

    <table width="100%" class="table">
      <tr>
        <td width="50%" style="padding:0px 5px 10px -3px;">
          <div style="border:1px solid #b3b3b3;padding:5px;">
            <table width="100%;" class="table">
              <tr>
                <td width="24%">No Booking</td>
                <td width="3%">:</td>
                <td><strong><?= $set->booking_no ?></strong></td>
              </tr>
              <tr>
                <td>Hari / Tanggal</td>
                <td>:</td>
                <td><?= $hari ?>, <?= $tanggal ?></td>
              </tr>
            </table>
          </di>
        </td>
        <td width="50%" style="padding:0px -3px 10px 5px;">
          <div style="border:1px solid #b3b3b3;padding:5px 5px 5px;">
            <table width="100%;" class="table">
							<tr>
                <td width="28%">Total Harga</td>
                <td width="3%">:</td>
                <td><strong><?= !empty($set->harga) ? "Rp. ".number_format($set->harga) : "ERROR" ?></td>
              </tr>
              <tr>
                <td>Tanda Jadi</td>
                <td>:</td>
                <td><strong>Rp. 500.000</strong></td>
              </tr>
            </table>
          </di>
        </td>
      </tr>
    </table>

    <table class="table table-bordered" width="100%">
			<tr>
				<td colspan="2" style="text-align:center;">
					<h4>DATA PELANGGAN</h4>
				</td>
				<td colspan="2" style="text-align:center;">
					<h4>DATA PERUMAHAN</h4>
				</td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">NO. KTP</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_ktp) ? $set->pelanggan_ktp : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">PERUMAHAN</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->rumah_nama) ? $set->rumah_nama : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">NAMA</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->pelanggan_nama) ? $set->pelanggan_nama : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">ALAMAT</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->rumah_alamat) ? $set->rumah_alamat.', Kelurahan '.$set->rumah_desa.', Kec. '.$set->rumah_kecamatan.', Kota '.$set->rumah_kota.', Prov. '.$set->rumah_provinsi : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">JENIS KELAMIN</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;">
					<?php
						if(!empty($set->pelanggan_jk)){
							if($set->pelanggan_jk === 'l'){
								echo "LAKI-LAKI";
							}
							else{
								echo "PEREMPUAN";
							}
						}
						else{
							echo "ERROR";
						}
					?>
				</td>
				<th style="text-align:right;width:40%;">BLOK</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->kavling_blok) ? "<strong>".$set->kavling_blok."</strong>" : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">TTL</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_ttl) ? $set->pelanggan_ttl : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">TIPE</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->kavling_tipe) ? $set->kavling_tipe : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">ALAMAT</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_alamat) ? $set->pelanggan_alamat : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">LUAS BANGUNAN</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->kavling_lb) ? $set->kavling_lb : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">ALAMAT SURAT</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_alamat_surat) ? $set->pelanggan_alamat_surat : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">LUAS TANAH</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->kavling_lt) ? $set->kavling_lt : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">KONTAK</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_kontak) ? $set->pelanggan_kontak : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">NO. SHM</th>
				<td style="padding-left:5px;width:60%;">
					<?php
						if($set->kavling_shm === "y"){
							echo !empty($set->kavling_shm_no) ? $set->kavling_shm_no : '-';
						}
						else if($set->kavling_shm === "n"){
							echo "TIDAK ADA";
						}
						else if($set->kavling_shm === "p"){
							echo "PROSES";
						}
						else{
							echo "-";
						}
					?>
				</td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">PEKERJAAN</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_pekerjaan) ? $set->pelanggan_pekerjaan : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">NO. IMB</th>
				<td style="padding-left:5px;width:60%;">
					<?php
						if($set->kavling_imb === "y"){
							echo !empty($set->kavling_imb_no) ? $set->kavling_imb_no : '-';
						}
						else if($set->kavling_imb === "n"){
							echo "TIDAK ADA";
						}
						else if($set->kavling_imb === "p"){
							echo "PROSES";
						}
						else{
							echo "-";
						}
					?>
				</td>
			</tr>

    </table>
		<br/><br/>
		<table class="table table-bordered" width="100%" style="text-align:center;">
			<tr>
				<td colspan="3" style="height:50px;text-align:left;padding:5px;font-size:6pt;">
					<strong><u>CATATAN</u></strong>
						<ol type="1" class="order">
							<li>Tanda jadi dipergunakan untuk proses BI Checking dan pemesanan kavling, bukan untuk pembayaran uang muka rumah.</li>
							<li>Tanda jadi berlaku 14 hari dari tanggal kwitansi tanda jadi ini dikeluarkan, apabila selama 14 hari konsumen tidak melakukan pembayaran uang muka maka dianggap batal/pembatalan sepihak.</li>
							<li>Apabila ada pembatalan sepihak dari proses BI Checking ataupun pada saat BI Checking sudah dinyatakan lolos maka tanda jadi yang sudah di bayarkan hangus 100%.</li>
							<li>Apabila tidak lolos BI Checking maka tanda jadi yang sudah dibayarkan akan dikembalikan sebesar 60%.</li>
							<li>Apabila lolos BI Checking maka tanda jadi yang sudah dibayarkan secara otomatis dipergunakan untuk biaya administrasi kantor sebesar Rp. 500.000.</li>
						</ol>
				</td>
				<td width="30%" style="height:50px">
					Disetujui Oleh:
				</td>
			</tr>
		</table>
		<br/><br/>
		<hr/>
	</div>

	<div style="page-break-after:auto">
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
            Website : <?= $company_website ?>

          </p>
        </td>
        <td width="40%" style="text-align:right;">
          <h1 style="margin-top:10px;"><?= 'BUKTI BOOKING' ?><br/>
						<small><?= $detil_kwitansi ?></small>
					</h1>
        </td>
      </tr>
    </table>

    <table width="100%" class="table">
      <tr>
        <td width="50%" style="padding:0px 5px 10px -3px;">
          <div style="border:1px solid #b3b3b3;padding:5px;">
            <table width="100%;" class="table">
              <tr>
                <td width="24%">No Booking</td>
                <td width="3%">:</td>
                <td><strong><?= $set->booking_no ?></strong></td>
              </tr>
              <tr>
                <td>Hari / Tanggal</td>
                <td>:</td>
                <td><?= $hari ?>, <?= $tanggal ?></td>
              </tr>
            </table>
          </di>
        </td>
        <td width="50%" style="padding:0px -3px 10px 5px;">
          <div style="border:1px solid #b3b3b3;padding:5px 5px 5px;">
            <table width="100%;" class="table">
							<tr>
                <td width="28%">Total Harga</td>
                <td width="3%">:</td>
                <td><strong><?= !empty($set->harga) ? "Rp. ".number_format($set->harga) : "ERROR" ?></td>
              </tr>
              <tr>
                <td>Tanda Jadi</td>
                <td>:</td>
                <td><strong>Rp. 500.000</strong></td>
              </tr>
            </table>
          </di>
        </td>
      </tr>
    </table>

    <table class="table table-bordered" width="100%">
			<tr>
				<td colspan="2" style="text-align:center;">
					<h4>DATA PELANGGAN</h4>
				</td>
				<td colspan="2" style="text-align:center;">
					<h4>DATA PERUMAHAN</h4>
				</td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">NO. KTP</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_ktp) ? $set->pelanggan_ktp : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">PERUMAHAN</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->rumah_nama) ? $set->rumah_nama : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">NAMA</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->pelanggan_nama) ? $set->pelanggan_nama : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">ALAMAT</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->rumah_alamat) ? $set->rumah_alamat.', Kelurahan '.$set->rumah_desa.', Kec. '.$set->rumah_kecamatan.', Kota '.$set->rumah_kota.', Prov. '.$set->rumah_provinsi : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">JENIS KELAMIN</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;">
					<?php
						if(!empty($set->pelanggan_jk)){
							if($set->pelanggan_jk === 'l'){
								echo "LAKI-LAKI";
							}
							else{
								echo "PEREMPUAN";
							}
						}
						else{
							echo "ERROR";
						}
					?>
				</td>
				<th style="text-align:right;width:40%;">BLOK</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->kavling_blok) ? "<strong>".$set->kavling_blok."</strong>" : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">TTL</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_ttl) ? $set->pelanggan_ttl : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">TIPE</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->kavling_tipe) ? $set->kavling_tipe : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">ALAMAT</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_alamat) ? $set->pelanggan_alamat : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">LUAS BANGUNAN</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->kavling_lb) ? $set->kavling_lb : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">ALAMAT SURAT</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_alamat_surat) ? $set->pelanggan_alamat_surat : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">LUAS TANAH</th>
				<td style="padding-left:5px;width:60%;vertical-align:middle;"><?= !empty($set->kavling_lt) ? $set->kavling_lt : "ERROR" ?></td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">KONTAK</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_kontak) ? $set->pelanggan_kontak : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">NO. SHM</th>
				<td style="padding-left:5px;width:60%;">
					<?php
						if($set->kavling_shm === "y"){
							echo !empty($set->kavling_shm_no) ? $set->kavling_shm_no : '-';
						}
						else if($set->kavling_shm === "n"){
							echo "TIDAK ADA";
						}
						else if($set->kavling_shm === "p"){
							echo "PROSES";
						}
						else{
							echo "-";
						}
					?>
				</td>
			</tr>
			<tr>
				<th style="text-align:right;width:40%;">PEKERJAAN</th>
				<td style="padding-left:5px;width:60%;"><?= !empty($set->pelanggan_pekerjaan) ? $set->pelanggan_pekerjaan : "ERROR" ?></td>
				<th style="text-align:right;width:40%;">NO. IMB</th>
				<td style="padding-left:5px;width:60%;">
					<?php
						if($set->kavling_imb === "y"){
							echo !empty($set->kavling_imb_no) ? $set->kavling_imb_no : '-';
						}
						else if($set->kavling_imb === "n"){
							echo "TIDAK ADA";
						}
						else if($set->kavling_imb === "p"){
							echo "PROSES";
						}
						else{
							echo "-";
						}
					?>
				</td>
			</tr>


    </table>
		<br/><br/>
		<table class="table table-bordered" width="100%" style="text-align:center;">
			<tr>
				<td colspan="3" style="height:50px;text-align:left;padding:5px;font-size:6pt;">
					<strong><u>CATATAN</u></strong>
						<ol type="1" class="order">
							<li>Tanda jadi dipergunakan untuk proses BI Checking dan pemesanan kavling, bukan untuk pembayaran uang muka rumah.</li>
							<li>Tanda jadi berlaku 14 hari dari tanggal kwitansi tanda jadi ini dikeluarkan, apabila selama 14 hari konsumen tidak melakukan pembayaran uang muka maka dianggap batal/pembatalan sepihak.</li>
							<li>Apabila ada pembatalan sepihak dari proses BI Checking ataupun pada saat BI Checking sudah dinyatakan lolos maka tanda jadi yang sudah di bayarkan hangus 100%.</li>
							<li>Apabila tidak lolos BI Checking maka tanda jadi yang sudah dibayarkan akan dikembalikan sebesar 60%.</li>
							<li>Apabila lolos BI Checking maka tanda jadi yang sudah dibayarkan secara otomatis dipergunakan untuk biaya administrasi kantor sebesar Rp. 500.000.</li>
						</ol>
				</td>
				<td width="30%" style="height:50px">
					Disetujui Oleh:
				</td>
			</tr>
		</table>
		<br/><br/>
		<hr/>



  </div><!--end content-->


</body>
</html>
