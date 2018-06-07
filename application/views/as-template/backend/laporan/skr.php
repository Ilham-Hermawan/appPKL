<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Serah Terima Kunci Rumah</title>
	<style type="text/css">
    @page { margin: 90.4252pt 48.189pt 36pt 45.3543pt; }
    html{
      margin: 90.4252pt 48.189pt 36pt 45.3543pt;
    }
    body{
      color:#111 !important;
      font-size:8	pt;
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
    table > tr > td {
      vertical-align: top;
    }
    table > tr > td {
      vertical-align: top;
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


  <div style="page-break-after:auto">

    <div style="text-align:center">
      <h4>BERITA ACARA</h4>
      <h4>PENYERAHAN KUNCI / RUMAH</h4>
    </div>



    <br/><br/>
    <p>Pada hari ini <?= (!empty($hari)) ? $hari : '.................' ?>, Tanggal <?= (!empty($tanggal)) ? $tanggal : '.................' ?>, Bulan <?= (!empty($bulan)) ? $bulan : '.................' ?>, Tahun <?= (!empty($tahun)) ? $tahun : '.................' ?></p>
    <p>
      Yang bertanda tangan dibawah ini :
    </p>
    <table width="100%">
      <tr>
        <td style="width:5% !important;">1.</td>
        <td style="width:15% !important;">Nama</td>
        <td style="width:2%;">:</td>
        <td>CHALID RAZALVI</td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td style="width:15% !important;">Jabatan</td>
        <td style="width:2%;">:</td>
        <td>Direktur PT. RAVINDO KARYA (VILAND PROPERTY)</td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td style="width:15% !important;">Alamat</td>
        <td style="width:2%;">:</td>
        <td>Jl. Yos Sudarso No.1 Rt. 004/002, Kel. Melayu, Kec. Singkawang Barat</td>
      </tr>

    </table>
    <br/><br/>
    <p>
      Bertindak dan untuk atas nama PT.RAVINDO KARYA, selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong>.
    </p>
    <p>
      PIHAK PERTAMA adalah selaku pembuat dan penjual rumah dilokasi perumahan <?= !empty($set->rumah_nama) ? strtoupper($set->rumah_nama) : '........................' ?> di <?= !empty($set->rumah_alamat) ? strtoupper($set->rumah_alamat) : '.....................' ?>, Kelurahan <?= !empty($set->rumah_desa) ? strtoupper($set->rumah_desa) : '.....................' ?>, Kecamatan <?= !empty($set->rumah_kecamatan) ? strtoupper($set->rumah_kecamatan) : '.....................' ?>, Kota <?= !empty($set->rumah_kota) ? strtoupper($set->rumah_kota) : '.....................' ?>.
    </p>

    <table width="100%">
      <tr>
        <td style="width:5% !important;">2.</td>
        <td style="width:15% !important;">Nama</td>
        <td style="width:2%;">:</td>
        <td><?= !empty($set->pelanggan_nama) ? strtoupper($set->pelanggan_nama) : '............................................................................'; ?></td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td style="width:15% !important;">Jabatan</td>
        <td style="width:2%;">:</td>
        <td><?= !empty($set->pelanggan_pekerjaan) ? strtoupper($set->pelanggan_pekerjaan) : '............................................................................' ?></td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td style="width:15% !important;">Alamat</td>
        <td style="width:2%;">:</td>
        <td><?= !empty($set->pelanggan_alamat) ? $set->pelanggan_alamat : '............................................................................' ?></td>
      </tr>

    </table>
    <br/><br/>

    <p>
      Bertindak dan untuk atas nama konsumen,  selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong>.
    </p>
    <p>
      PIHAK KEDUA adalah selaku pembeli rumah dilokasi perumahan <?= !empty($set->rumah_nama) ? strtoupper($set->rumah_nama) : '........................' ?> di <?= !empty($set->rumah_alamat) ? strtoupper($set->rumah_alamat) : '.....................' ?>, Kelurahan <?= !empty($set->rumah_desa) ? strtoupper($set->rumah_desa) : '.....................' ?>, Kecamatan <?= !empty($set->rumah_kecamatan) ? strtoupper($set->rumah_kecamatan) : '.....................' ?>, Kota <?= !empty($set->rumah_kota) ? strtoupper($set->rumah_kota) : '.....................' ?>.
    </p>
    <p>
      Para pihak terlebih dahulu sebagai berikut :
    </p>
    <p>
      PIHAK PERTAMA dan PIHAK KEDUA telah sepakat untuk melakukan serah terima bangunan rumah dengan ketentuan-ketentuan sebagai berikut :
    </p>

    <table width="100%">
      <tr>
        <td style="width:5% !important;">1.</td>
        <td colspan="3">PIHAK KEDUA telah membeli rumah dari PIHAK PERTAMA  dengan cara KPR, untuk rumah sebagai berikut :</td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
				<td style="width:15% !important;">Lokasi</td>
        <td style="width:2%;">:</td>
        <td><?= !empty($set->rumah_alamat) ? strtoupper($set->rumah_alamat) : '.....................' ?>, Kelurahan <?= !empty($set->rumah_desa) ? strtoupper($set->rumah_desa) : '.....................' ?>, Kecamatan <?= !empty($set->rumah_kecamatan) ? strtoupper($set->rumah_kecamatan) : '.....................' ?>, Kota <?= !empty($set->rumah_kota) ? strtoupper($set->rumah_kota) : '.....................' ?></td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td style="width:15% !important;">Type/Blok</td>
        <td style="width:2%;">:</td>
        <td><?= !empty($set->kavling_blok) ? $set->kavling_blok : '................' ?></td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td style="width:15% !important;">Luas Bangunan</td>
        <td style="width:2%;">:</td>
        <td><?= !empty($set->kavling_lb) ? $set->kavling_lb : '................' ?></td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td style="width:15% !important;">Luas Tanah</td>
        <td style="width:2%;">:</td>
        <td><?= !empty($set->kavling_lt) ? $set->kavling_lt : '................' ?></td>
      </tr>

    </table>
    <br /><br />
    <table width="100%">
      <tr>
        <td style="width:5% !important;">2.</td>
        <td colspan="3">Setelah ditandatangani berita penyerahan kunci/rumah ini berlaku masa pemeliharaan selama 100 (seratus) hari.</td>
      </tr>
      <tr>
        <td style="width:5% !important;">&nbsp;</td>
        <td colspan="3">Apabila dalam masa 100 hari konsumen tidak mengajukan komplain, maka komplain tidak berlaku lagi, dan komplain berlaku untuk satu kali pengajuan.</td>
      </tr>

    </table>
		<br /><br />
		<p>
      Demikian Berita Acara ini kita buat rangkap 3 (tiga) untuk dipergunakan sebagaimana mestinya.
    </p>
		<br /><br />
    <table width="100%">
      <tr>
        <td style="width:50% !important;text-align:center;">
          <br /><br /><br />
          <strong>PIHAK PERTAMA</strong><br />
          <strong>PT. RAVINDO KARYA</strong>
					<br /><br /><br /><br /><br /><br /><br /><br />
					<strong>CHALID RAZALVI</strong>
        </td>
        <td style="width:50% !important;text-align:center;">
          <br /><br /><br />
          <strong>PIHAK KEDUA</strong><br />
          <strong>PEMBELI RUMAH</strong>
					<br /><br /><br /><br /><br /><br /><br /><br />
					<strong><?= !empty($set->pelanggan_nama) ? strtoupper($set->pelanggan_nama) : '.....................................'; ?></strong>
        </td>
      </tr>
    </table>


  </div><!--end content-->



</body>
</html>
