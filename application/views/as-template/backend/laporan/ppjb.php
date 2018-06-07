<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PPJB</title>

	<style type="text/css">
    /*@page { margin: 111.6pt 72pt 56.88pt 72pt; }*/
    html{
      margin: 98.5pt 72pt 56.88pt 72pt;
    }
    body{
      color:#111 !important;
      font-size:9pt;
      font-family: "calibri", "Helvetica Neue", Helvetica, Arial, sans-serif;
      padding-bottom: 10px;
    }
    #header { position: fixed; left: 0px; top: -110px; right: 0px; text-align: center;}
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

	</style>
</head>
<body>

  <div id="header">
    <img src="<?= site_url(IMAGES_WEB.'homenesty_logo.png') ?>" width="400px;">
  </div>
  <div id="footer">
    <div id="footerz">
      <div id="left">
         <img src="<?= site_url(IMAGES_WEB.'logo.png') ?>" width="150px;">
      </div>

      <div id="right">
         <strong style="font-family:arial;">PERJANJIAN PENGIKAT JUAL BELI</strong>
      </div>
    </div>

    <div style="clear:both"></div>
  </div>

  <div class="content">
    <span style="font-weight:bold">PENJELASAN AWAL SEBELUM PERJANJIAN</span>
    <p style="font-style:italic;">Halaman ini dipergunakan marketing sebagai acuan dan koreksi dalam pembacaan isi perjanjian yang dijelaskan langsung kepada calon konsumen atau yang mewakili.</p>
    <p style="font-style:italic;">Dalam setiap halaman ini, PPJB harus dipaparkan oleh marketing dan diparaf di setiap pasalnya oleh konsumen sebagai tanda persetujuan kedua belah pihak.</p>
    <p>Penjelasan tentang <strong>PERJANJIAN PENGIKAT JUAL BELI</strong></p>
    <table class="table" border="0px" width="100%">
      <tr>
        <td width="15%"><strong>Umum</strong></td>
        <td>
          Lokasi perumahan dan letak kavling<br/>
          Surat tanah dan luas tanah kavling<br/>
          Type / luas bangunan
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 1</strong></td>
        <td>
          Harga Jual<br/>
          Biaya Balik Nama (BBN) dan pajak pajak pembelian (BPHTB)<br/>
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 2</strong></td>
        <td>
          Sistem Pembayaran
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 3</strong></td>
        <td>
          Pembelian dengan Fasilitas Kredit Pemilikan Rumah (KPR)
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 4</strong></td>
        <td>
          Keterlambatan Pembayaran dan Denda
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 5</strong></td>
        <td>
          Pembatalan
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 6</strong></td>
        <td>
          Gambar Rencana Rumah
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 7</strong></td>
        <td>
          Pembangunan
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 8</strong></td>
        <td>
          Perubahan Bangunan
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 9</strong></td>
        <td>
          Serah Terima Bangunan
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 10</strong></td>
        <td>
          Jaminan PIHAK PERTAMA
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 11</strong></td>
        <td>
          Biaya Transaksi Jual Beli
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 12</strong></td>
        <td>
          Musyawarah dalam hal-hal yang belum diatur dalam perjanjian
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 13</strong></td>
        <td>
          Tambahan
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Pasal 14</strong></td>
        <td>
          Penutup
        </td>
      </tr>
      <tr>
        <td width="15%"><strong>Lampiran</strong></td>
        <td>
          Nomor Rekening yang Digunakan<br/>
          Spesifikasi Teknis Bangunan<br/>
          Gambar Standar
        </td>
      </tr>


    </table>
  </div><!--end content-->

  <div class="content">
    <div style="text-align:right;font-style:italic;">Singkawang, <?= $date ?></div>
    <p style="font-style:italic">Saya menyatakan telah membacakan dan menjelaskan dengan baik seluruh isi dokumen Perjanjian Pengikatan Jual Beli (PPJB) berikut lampiran yang ada.</p>
    <table width="100%" border="0">
      <tr>
        <td width="20%;">Tanggal</td>
        <td>: <?= $date ?></td>
      </tr>
      <tr>
        <td width="20%;">Nama</td>
        <td>: <strong style="font-family:cambria;">FRANSISKUS</strong></td>
      </tr>
      <tr>
        <td width="20%;">Tanda Tangan</td>
        <td>
          <div style="border:1px solid #363636;height:100px;width:50%;">
          </div>
        </td>
      </tr>
    </table>
    <br/><br/><br/>
    <p style="font-style:italic">Saya menyatakan telah menerima penjelaskan dengan baik seluruh isi dokumen Perjanjian Pengikatan Jual Beli (PPJB) berikut lampiran yang ada.</p>
    <br/><br/><br/>
    <table width="100%" border="0">
      <tr>
        <td width="20%;">Tanggal</td>
        <td>: <?= $date ?></td>
      </tr>
      <tr>
        <td width="20%;">Nama</td>
        <td>: <strong style="font-family:cambria;"><?= strtoupper($set->pelanggan_nama) ?></strong></td>
      </tr>
      <tr>
        <td width="20%;">Tanda Tangan</td>
        <td>
          <div style="border:1px solid #363636;height:100px;width:50%;">
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div class="content">
    <p style="font-size:12pt;font-weight:bold;">Perjanjian Pengikatan Jual Beli – PPJB</p>
    <p style="font-size:10pt;font-weight:bold;border-bottom:2px solid #474747;">No.  <?= $set->ppjb_no ?></p>
    <p>Pada hari ini, <?= $hari; ?> tanggal <?= $tanggal ?> bulan <?= $bulan ?> tahun <?= $tahun ?> yang bertanda tangan dibawah ini dengan diketahui para saksi yang akan turut menandatangani perjanjian ini :</p>
    <table class="table" width="100%" border="0" style="font-weight:bold;">
      <tr>
        <td width="5%">1.</td>
        <td width="25%">Nama</td>
        <td width="1%">:</td>
        <td>CHALID RAZALVI</td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">Jabatan</td>
        <td width="1%">:</td>
        <td>Direktur PT. RAVINDO KARYA (VILAND PROPERTY), Selaku Developer Perumahan Homenesty Residence</td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">No.KTP</td>
        <td width="1%">:</td>
        <td>6172020201900003</td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">Tempat / Tgl Lahir</td>
        <td width="1%">:</td>
        <td>Pontianak, 02-01-1990</td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">Alamat KTP</td>
        <td width="1%">:</td>
        <td>Jl. Yos Sudarso No.1 Rt. 004/002, Kel. Melayu, Kec. Singkawang Barat</td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">No. Telp / HP</td>
        <td width="1%">:</td>
        <td>089604569699 / 085345344144</td>
      </tr>
    </table>
    <br/><br/>
    <p>Dalam hal ini mewakili PT. RAVINDO KARYA selaku developer perumahan Homenesty Residence, selanjutnya disebeut sebagai <strong>PIHAK PERTAMA</strong>.</p>
    <br/>
    <table class="table" width="100%" border="0" style="font-weight:bold;">
      <tr>
        <td width="5%">2.</td>
        <td width="25%">Nama</td>
        <td width="1%">:</td>
        <td><?= strtoupper($set->pelanggan_nama) ?></td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">No. KTP</td>
        <td width="1%">:</td>
        <td><?= !empty($set->pelanggan_ktp) ? $set->pelanggan_ktp : "-" ?></td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">Tempat / Tgl Lahir</td>
        <td width="1%">:</td>
        <td><?= !empty($set->pelanggan_ttl) ? $set->pelanggan_ttl : "-" ?></td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">Alamat KTP</td>
        <td width="1%">:</td>
        <td><?= !empty($set->pelanggan_alamat) ? $set->pelanggan_alamat : "-" ?></td>
      </tr>
      <tr>
        <td width="5%"></td>
        <td width="25%">No. Telp / HP</td>
        <td width="1%">:</td>
        <td><?= !empty($set->pelanggan_kontak) ? $set->pelanggan_kontak : "-" ?></td>
      </tr>
    </table>
    <br/><br/>
    <p>Dalam hal ini bertindak selaku pembeli, selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong>.</p>
    <p>Dengan diketahui para saksi yang turut menandatangani perjanjian ini.</p>
    <p>Bahwa <strong>PIHAK PERTAMA</strong> dengan ini mengikatkan diri untuk menjual, memindahkan, dan mengalihkan serta menyerahkan kepada <strong>PIHAK KEDUA</strong>, dan <strong>PIHAK KEDUA</strong> dengan ini pula mengikatkan diri dalam perjanjian ini untuk membeli, menerima pemindahan dan pengalihan serta penyerahan dari <strong>PIHAK PERTAMA</strong> sebuah rumah seluas <?= $set->kavling_lb ?> (<?= $lb_terbilang ?> meter persegi ) dan berdiri di atas sebidang tanah seluas <?= $set->kavling_lt ?> (<?= $lt_terbilang ?> meter persegi ) yang terletak di :</p>
    <table class="table" width="100%" border="0">
      <tr>
        <td width="23%">Desa / Kelurahan</td>
        <td>: <?= !empty($set->rumah_desa) ? $set->rumah_desa : "-" ?></td>
      </tr>
      <tr>
        <td width="23%">Kecamatan</td>
        <td>: <?= !empty($set->rumah_kecamatan) ? $set->rumah_kecamatan : "-" ?></td>
      </tr>
      <tr>
        <td width="23%">Kota</td>
        <td>: <?= !empty($set->rumah_kota) ? $set->rumah_kota : "-" ?></td>
      </tr>
      <tr>
        <td width="23%">Provinsi</td>
        <td>: <?= !empty($set->rumah_provinsi) ? $set->rumah_provinsi : "-" ?></td>
      </tr>
    </table>
  </div>

  <div class="content">
    <p>Yang dikenal sebagai perumahan “<?= $set->rumah_nama ?>” nomor Kavling <?= $set->kavling_blok ?>, dengan type Lb <?= $set->kavling_lb ?> / Lt <?= $set->kavling_lt ?>, spesifikasi material finishing dan gambar standar terlampir, telah disetujui dan ditandatangani antar kedua belah pihak pada perjanjian ini.</p>
    <p>Dengan demikian kedua belah pihak telah bersepakat mengikatkan dirinya masing-masing untuk mengadakan Perjanjian Pengikat Jual Beli (PPJB) dengan syarat-syarat dan ketentuan sebagai berikut :</p>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 1</p>
    <p style="font-weight:bold;text-align:center;">HARGA JUAL</p>
    <ol type="1" style="padding-left:20px;">
      <li><strong>PIHAK PERTAMA</strong> mengikatkan diri untuk menjual, memindahkan serta menyerahkan kepada <strong>PIHAK KEDUA</strong> dan <strong>PIHAK KEDUA</strong> mengikatkan diri untuk membeli, menerima pemindahan dan pengalihan, serta penyerahan dari <strong>PIHAK PERTAMA</strong> atas tanah dan bangunan tersebut dengan harga kesepakatan sebesar :</li>
      <br/><br/>
      <table class="table" width="100%" border="0">
        <tr>
          <td width="15%">Rp.</td>
          <td width="1%">:</td>
          <td><?= "Rp. ".number_format($set->kavling_harga) ?></td>
        </tr>
        <tr>
          <td width="15%">Terbilang</td>
          <td width="1%">:</td>
          <td><?= ucwords($harga_terbilang); ?> Rupiah</td>
        </tr>
      </table>
      <br/><br/>
      <li>Harga tersebut belum termasuk Biaya Balik Nama (BBN), Pajak Pertambahan Nilai (PPN) dan Biaya Perolehan Hak atas Tanah dan Bangunan (BPHTB) sesuai dengan peraturan perundangan yang berlaku yang harus dibayarkan oleh <strong>PIHAK KEDUA</strong> sebelum penandatanganan Akte Jual Beli di Notaris.</li>
    </ol>
    <br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 2</p>
    <p style="font-weight:bold;text-align:center;">TATA CARA PEMBAYARAN</p>
    <br/>
    <ol type="1" style="padding-left:20px;">
      <li><strong>PIHAK KEDUA</strong> sanggup melunasi pembayaran tersebut dalam pasal 1 dengan sistem dan cara pembayaran sebagai berikut :</li>
      <table class="table" width="100%" border="0">
        <tr>
          <td width="5%">No.</td>
          <td width="20%">Tahapan Pembayaran</td>
          <td width="20%">Tanggal Pembayaran</td>
          <td width="20%">Jumlah Pembayaran</td>
        </tr>
        <tr>
          <td width="5%">1.</td>
          <td width="20%">Tanda Jadi</td>
          <td width="20%">-</td>
          <td width="20%"><?= "Rp. 500.000" ?></td>
        </tr>
        <tr>
          <td width="5%">2.</td>
          <td width="20%">Harga Tambahan</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%">3.</td>
          <td width="20%">Uang Muka / DP.</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  1</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  2</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  3</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>

      </table>
    </ol>
  </div>

  <div class="content">
      <table class="table" width="100%" border="0">
        <tr>
          <td width="5%">4.</td>
          <td width="20%">Kekuraangan DP.</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  1</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  2</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  3</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  4</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%"></td>
          <td width="20%">Pembayaran  5</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
        <tr>
          <td width="5%">5</td>
          <td width="20%">KPR</td>
          <td width="20%">-</td>
          <td width="20%">-</td>
        </tr>
      </table>
      <br/><br/>
    <ol type="1" style="padding-left:20px;" start="2">
      <li><strong>PIHAK KEDUA</strong> menjamin bahwa tahapan pembayaran angsuran ini dilaksanakan oleh <strong>PIHAK KEDUA</strong> sebelum dan sesudah hari dan tanggal perjanjian ini ditandatangani sebagaimana yang telah disebutkan pada pasal 2 ayat 1.</li>
      <li>Untuk setiap pembayaran (angsuran, denda dan bunga) yang dilakukan <strong>PIHAK KEDUA</strong> kepada <strong>PIHAK PERTAMA</strong>, harus dilakukan ke alamat <strong>PIHAK PERTAMA</strong> atau transfer bank ke rekening <strong>PIHAK PERTAMA</strong>. Pembayaran melalui cek atau transfer baru dianggap sah diterima setelah dana yang bersangkutan efektif diterima oleh <strong>PIHAK PERTAMA</strong> dan akan diberikan tanda terima berupa kwitansi oleh <strong>PIHAK PERTAMA</strong> yang merupakan bagian yang tidak terpisahkan dari isi perjanjian ini.</li>
    </ol>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 3</p>
    <p style="font-weight:bold;text-align:center;">PEMBELIAN DENGAN FASILITAS KREDIT PEMILIKAN RUMAH (KPR)</p>
    <ol type="1" style="padding-left:20px;">
      <li>Apabila pelunasan pembayaran dilaksanakan melalui fasilitas Kredit Pemilikan Rumah (KPR), maka <strong>PIHAK KEDUA</strong> bersedia memenuhi segala persyaratan dan biaya - biaya yang diminta oleh pihak bank pemberi kredit. Bank pemberi KPR adalah bank yang ditunjuk oleh <strong>PIHAK PERTAMA</strong>.</li>
      <li><strong>PIHAK KEDUA</strong> bersedia melaksanakan pelunasan pembayaran  dengan melakukan akad kredit dengan pihak bank selambat – lambatnya 7 (tujuh) hari sejak disetujuinya Kredit Pemilikan Rumah (KPR) oleh pihak Bank. Jika ternyata <strong>PIHAK KEDUA</strong> membatalkan pembelian dengan menggunakan fasilitas Kredit Pemilikan Rumah (KPR), atau pihak bank tidak menyetujui sebagian atau seluruhnya dari Kredit Pemilikan Rumah (KPR) yang diajukan, maka <strong>PIHAK KEDUA</strong> sanggup melunasi pembayaran secara tunai. Apabila <strong>PIHAK KEDUA</strong> tidak dapat memenuhi hal tersebut di atas, maka perjanjian ini batal dan untuk selanjutnya <strong>PIHAK KEDUA</strong> dikenakan denda sesuai dengan Pasal 5 perjanjian ini. </li>
    </ol>
		<br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 4</p>
    <p style="font-weight:bold;text-align:center;">KETERLAMBATAN DAN PEMBAYARAN DENDA</p>
    <br/>
		<ol type="1" style="padding-left:20px;">
			<li><strong>PIHAK KEDUA</strong> harus membayar segala pembayaran yang telah disepakati kepada  <strong>PIHAK PERTAMA</strong> sesuai dengan jadwal yang telah disepakati.</li>
			<li>Bilamana <strong>PIHAK KEDUA</strong> membayar kewajibannya melebihi batas waktu tersebut di atas, maka <strong>PIHAK KEDUA</strong> harus membayar denda sebesar 2,5 % (dua koma lima persen) perbulan dari nilai pembayaran yang terlambat dan dihitung secara proporsional harian sejak tanggal jatuh tempo pembayaran dari jadwal yang disepakati di atas.</li>
			<br/><br/><br/><br/><br/><br/><br/><br/>
			<li>Untuk keterlambatan Uang Muka yang berlangsung 2 (dua) kali angsuran, maka perjanjian ini dianggap batal dan <strong>PIHAK KEDUA</strong> telah dianggap melepaskan segala hak - haknya termasuk pembayaran tanda jadi dan angsuran yang telah dibayarkan kepada <strong>PIHAK PERTAMA</strong>, dan <strong>PIHAK PERTAMA</strong> berhak untuk mengambil alih segala hak - hak tersebut termasuk pembayaran tanda jadi dan angsuran yang telah dibayar oleh <strong>PIHAK KEDUA</strong>. <strong>PIHAK PERTAMA</strong> juga dapat mengalihkan hak atas tanah dan bangunan tersebut kepada <strong>PIHAK KETIGA</stromg>.</li>
		</ol>

		<br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 5</p>
    <p style="font-weight:bold;text-align:center;">PEMBATALAN</p>
    <br/>
		<p>Dalam hal terjadi pembatalan jual beli yang dilakukan oleh <strong>PIHAK KEDUA</strong>, kedua belah pihak sepakat untuk mengecualikan ketentuan pasal 1266 dan 1267 Kitab Undang - Undang Hukum Perdata, sehingga hal tersebut tidaklah diperlukan suatu keputusan atau ketetapan Pengadilan Negeri, dan selanjutnya <strong>PIHAK KEDUA</strong> setuju untuk membayar biaya administrasi pembatalan kepada <strong>PIHAK PERTAMA</strong> dengan perincian sebagai berikut :</p>
		<ul type="square" style="padding-left:20px;">
			<li>Uang Tanda Jadi/Booking Fee hangus tidak dapat diambil kembali.</li>
			<li>Pada saat pembangunan rumah sudah berjalan maka <strong>PIHAK KEDUA</strong> hanya akan menerima pengembalian sebesar 50% dari total uang yang telah dibayarkan kepada <strong>PIHAK PERTAMA</strong>.</li>
			<li>Setelah fisik bangunan rumah sudah selesai, maka semua uang yang sudah terbayar dianggap hangus dan menjadi milik <strong>PIHAK PERTAMA</strong>.</li>
		</ul>
		<br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 6</p>
    <p style="font-weight:bold;text-align:center;">GAMBAR RENCANA RUMAH</p>
    <br/>
		<ol type="1" style="padding-left:20px;">
			<li>Gambar rencana bangunan sesuai dengan harga dalam pasal perjanjian ini akan disiapkan oleh <strong>PIHAK PERTAMA</strong>. Perubahan gambar untuk tampak depan/muka tidak diperkenankan.</li>
			<li><strong>PIHAK KEDUA</strong> tidak diperkenankan meminta perubahan bentuk dan luasan bangunan rumah, dikarenakan khusus rumah subsidi type 36 tidak diperkanankan merubah atau menambah luasan bangunan rumah sebelum di akad.</li>
		</ol>
		<br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 7</p>
    <p style="font-weight:bold;text-align:center;">PEMBANGUNAN</p>
    <br/>
		<ol type="1" style="padding-left:20px;">
			<li><strong>PIHAK PERTAMA</strong> akan melaksanakan pembangunan fisik rumah dimulai atas kesepakatan para pihak <br/>dengan memperhatikan hal-hal sebagai berikut :
				<br/><br/>
				<ul type="square">
					<li>Kesiapan di lapangan atau selama – lamanya 30 (tiga puluh) hari semenjak disetujuinya gambar rencana oleh pihak yang berwenang dan ditandatanganinnya perjanjian oleh kedua belah pihak;</li>
					<li><strong>PIHAK KEDUA</strong> membayar angsuran Uang Muka mencapai nilai 30% (tiga puluh persen) dari Uang Muka yang telah disepakati dan setelah disetujuinya Kredit Pemilikan Rumah (KPR) dari bank (bila pembiayaan melalui fasilitas kredit bank).</li>
				</ul>
			</li>
			<br/><br/><br/><br/><br/><br/><br/><br/>
			<li><strong>PIHAK PERTAMA</strong> berkewajiban menyelesaikan pembangunan rumah milik <strong>PIHAK KEDUA</strong> dalam jangka waktu selambat–lambatnya 90 (sembilan puluh) hari, dihitung sejak syarat dalam pasal 7 ayat 1 terpenuhi. Bila dalam jangka waktu yang telah ditentukan <strong>PIHAK PERTAMA</strong> belum menyelesaikan pembangunan rumah tersebut, maka <strong>PIHAK KEDUA</strong> pada bulan setelah bulan penyelesaian rumah yang telah ditentukan dalam adendum akan mendapat ganti - rugi atas keterlambatan penyelesaian <strong>PIHAK PERTAMA</strong> sebesar 0,05 % (nol koma nol lima persen) per hari dari total uang yang telah dibayarkan oleh <strong>PIHAK KEDUA</strong> kepada <strong>PIHAK PERTAMA</strong>, dengan nilai setinggi-tingginya sebesar 2% (dua persen) dari total uang yang telah dibayarkan <strong>PIHAK KEDUA</strong> kepada <strong>PIHAK PERTAMA</strong>.</li>
			<li>Dalam hal terjadi keterlambatan masa pembangunan sebagaimana diatur dalam pasal 7 ayat 2 perjanjian ini, dikecualikan untuk hal – hal yang di luar kemampuan <strong>PIHAK PERTAMA</strong>, yakni sambungan listrik yang sepenuhnya tergantung pada ketersediaan jaringan, daya meter dan meteran listrik dari pihak PLN atau instansi yang berwenang untuk hal tersebut.</li>
		</ol>
		<br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 8</p>
    <p style="font-weight:bold;text-align:center;">SERAH TERIMA BANGUNAN</p>
    <br/>
		<ol type="1" style="padding-left:20px;">
			<li>Serah terima bangunan (serah terima kunci) dari <strong>PIHAK PERTAMA</strong> kepada <strong>PIHAK KEDUA</strong> dilakukan apabila telah dipenuhinya hal sebagai berikut :
				<br/><br/>
				<ul type="square">
					<li><strong>PIHAK KEDUA</strong> telah melunasi seluruh kewajibannya kepada <strong>PIHAK PERTAMA</strong> seperti tercantum dalam pasal 2 perjanjian ini;</li>
					<li><strong>PIHAK PERTAMA</strong> telah menyelesaikan pembangunan 100% atau sesuai dengan kesepakatan bersama.</li>
				</ul>
			</li>
			<li>Sebelum serah terima bangunan (serah terima kunci) dilaksanakan, maka <strong>PIHAK KEDUA</strong> tidak diperkenankan melakukan hal-hal sebagai berikut:
				<br/><br/>
				<ul type="square">
					<li><strong>PIHAK KEDUA</strong> tidak diperkenankan untuk melaksanakan pembangunan, mengubah maupun menambah bangunan, baik dilaksanakan sendiri maupun <strong>PIHAK KETIGA</strong>;</li>
					<li><strong>PIHAK KEDUA</strong> tidak diperkenankan untuk menempati bangunan atau menempatkan <strong>PIHAK KETIGA</strong> dengan alasan apapun di lokasi pembangunan;</li>
					<li><strong>PIHAK KEDUA</strong> tidak diperkenankan untuk memasuki atau menempatkan barang apapun juga di lokasi pembangunan.</li>
				</ul>
			</li>
			<li>Penyerahan kunci rumah akan dibuatkan dengan Berita Acara Serah Terima Kunci rumah tersendiri yang merupakan bagian yang tidak terpisahkan dari perjanjian ini. Sejak diserahkannya bangunan dari <strong>PIHAK PERTAMA</strong> kepada <strong>PIHAK KEDUA</strong>, maka segala biaya-biaya yang berkaitan dengan fasilitas pada bangunan tersebut menjadi tanggung jawab <strong>PIHAK KEDUA</strong>.</li>
			<li><strong>PIHAK KEDUA</strong> harus dan bersedia menandatangani Berita Acara Serah Terima Kunci apabila Pasal 8 ayat 1 dan 2 telah terpenuhi syaratnya.</li>
			<li>Apabila terjadi dikemudian hari <strong>PIHAK KEDUA</strong> tidak memenuhi kewajibannya sebagaimana disebutkan dalan Pasal 8 ayat 4, maka <strong>PIHAK PERTAMA</strong> akan menganggap secara sepihak telah ada serah terima kunci. Selanjutnya <strong>PIHAK PERTAMA</strong> tidak akan bertanggung jawab terhadap kerusakan yang terjadi terhadap bangunan dan serta merta jaminan pada Pasal 9 juga terabaikan.</li>
		</ol>


  </div>

	<div class="content">
		<p style="font-weight:bold;text-align:center;">PASAL 9</p>
    <p style="font-weight:bold;text-align:center;">PENJAMINAN</p>
    <br/>
		<ol type="1" style="padding-left:20px;">
			<li><strong>PIHAK PERTAMA</strong> menjamin kepada <strong>PIHAK KEDUA</strong> bahwa pada saat akan diserahkannya bangunan rumah tersebut kepada <strong>PIHAK KEDUA</strong>, tanah dan rumah tersebut benar-benar dibawah penguasaan dan/atau pengelolaan <strong>PIHAK PERTAMA</strong> dan bebas dari sitaan, ikatan dan beban apapun lainnya serta tidak dipergunakan sebagai jaminan hutang dengan cara apapun.</li>
			<li><strong>PIHAK PERTAMA</strong> akan memberikan jaminan kepada <strong>PIHAK KEDUA</strong> selama 90 (sembilan puluh) hari apabila terjadi kerusakan yang disebabkan oleh kelalaian <strong>PIHAK PERTAMA</strong> sejak penandatanganan realisasi penyerahan rumah (Berita Acara Penyerahan Rumah), kecuali bila terjadi force majeur (bencana alam, huru hara, pemogokan, perang).</li>
			<li>Bila telah melewati jangka waktu dan masa jaminan 90 (sembilan puluh) hari terjadi keluhan/komplain, maka akan menjadi tanggung jawab <strong>PIHAK KEDUA</strong> secara penuh.</li>
		</ol>
		<br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 10</p>
    <p style="font-weight:bold;text-align:center;">PENGALIHAN HAK ATAS TANAH DAN BANGUNAN</p>
    <br/>
		<ol type="1" style="padding-left:20px;">
			<li>Setelah pembangunan rumah yang dijanjikan selesai, maka <strong>PIHAK PERTAMA</strong> berkewajiban untuk mengalihkan hak atas tanah dimana rumah tersebut berdiri kepada <strong>PIHAK KEDUA</strong> dan untuk biaya Akta Jual Beli (AJB), biaya Balik Nama (BBN), Pajak Pertambahan Nilai (PPN) serta Biaya Perolehan Hak atas Tanah dan Bangunan (BPHTB) akan dibayar oleh masing-masing pihak mengikuti peraturan perundang-undangan yang berlaku.</li>
			<li>Status hak atas tanah sepenuhnya menyesuaikan dengan ketentuan peraturan yang berlaku dimana lokasi rumah tersebut berada oleh Badan Pertanahan Nasional (BPN) setempat.</li>
		</ol>
		<br/>
    <br/>
    <p style="font-weight:bold;text-align:center;">PASAL 11</p>
    <p style="font-weight:bold;text-align:center;">ADENDUM</p>
    <br/>
		<ol type="1" style="padding-left:20px;">
			<li>Hal – hal yang belum diatur dalam perjanjian ini oleh <strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong> akan diatur dan ditetapkan dikemudian hari secara musyawarah dan mufakat, dengan syarat disetujui dan ditandatangani bersama oleh kedua belah pihak dan merupakan bagian yang tidak terpisahkan dari perjanjian ini.</li>
			<li>Apabila di kemudian hari ternyata terdapat kesalahan dan kekeliruan dalam perjanjian ini akan diadakan perubahan dan pembetulan (adendum) sebagaimana mestinya.</li>
			<li>Dengan tidak menyimpang dari pasal 5 perjanjian ini, apabila dikemudian hari terjadi perselisihan antara <strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong> yang tidak dapat diselesaikan secara musyawarah dan mufakat, maka <strong>PIHAK PERTAMA</strong> berhak untuk membatalkan secara sepihak perjanjian ini dan akan mengembalikan 50% dari total uang yang masuk dan diterima <strong>PIHAK PERTAMA</strong>.</li>
		</ol>

	</div>

	<div class="content">
		<p style="font-weight:bold;text-align:center;">PASAL 12</p>
    <p style="font-weight:bold;text-align:center;">TAMBAHAN</p>
    <br/>
	</div>

	<div class="content">
		<p style="font-weight:bold;text-align:center;">PASAL 13</p>
    <p style="font-weight:bold;text-align:center;">PENUTUP</p>
    <br/>
		<p><strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong> menyatakan dengan sungguh-sungguh bahwa Perjanjian Pengikatan Jual Beli ini dibuat dengan tanpa adanya paksaan dari pihak manapun, dan merupakan perjanjian terakhir yang menghapus perjanjian sebelumnya baik lisan maupun tertulis. Demikian perjanjian ini dibuat rangkap 2 dimana masing-masing bermeterai cukup dan mempunyai kekuatan hukum yang sama.</p>
		<br/><br/>
		<table class="table" border="0" width="100%">
			<tr>
				<td width="50%" align="center">
					<strong>PIHAK KEDUA</strong>
					<br/><br/><br/><br/><br/><br/><br/>
					<strong><?= strtoupper($set->pelanggan_nama) ?></strong>
				</td>
				<td width="50%" align="center">
					<strong>PIHAK PERTAMA</strong>
					<br/><br/><br/><br/><br/><br/><br/>
					<strong>CHALID  RAZALVI</strong>
				</td>
			</tr>
		</table>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<table class="table" border="0" width="100%">
			<tr>
				<td width="50%" align="center">
					Saksi – saksi :<br/>
					<strong>Saksi PIHAK KEDUA</strong>
					<br/><br/><br/><br/><br/><br/><br/>
					<strong><u>LEONARD KARAMOY, SH</u></strong><br/>
					<u><i>NIK : 6171020708770004</i></u>
				</td>
				<td width="50%" align="center">
					<br/>
					<strong>Saksi PIHAK PERTAMA</strong>
					<br/><br/><br/><br/><br/><br/><br/>
					<strong><u>URAY YUSI MANDELA, S.Kom</u></strong><br/>
					<i>General Manager</i>
				</td>
			</tr>
		</table>
	</div>

	<div class="content">
		<strong>LEMBAR PERIKSA PPJB</strong><br/>
		<p>Lembar halaman ini dibuat dan ditandatangani sebagai koreksi akhir sebelum dokumen perjanjian diajukan kepada calon konsumen.</p>
		<br/><br/>
		<table class="table" border="0" width="100%">
			<tr>
				<td width="22%">Nomor PPJB</td>
				<td width="1%">:</td>
				<td><strong><?= $set->ppjb_no ?></strong></td>
			</tr>
			<tr>
				<td width="22%">Nama Konsumen</td>
				<td width="1%">:</td>
				<td><strong><?= strtoupper($set->pelanggan_nama) ?></strong></td>
			</tr>
			<tr>
				<td width="22%">Nama Perumahan</td>
				<td width="1%">:</td>
				<td><strong><?= strtoupper($set->rumah_nama) ?></strong></td>
			</tr>
			<tr>
				<td width="22%">Nomor Kavling</td>
				<td width="1%">:</td>
				<td><strong><?= $set->kavling_blok ?></strong></td>
			</tr>
		</table>
		<br/><br/><br/>
		<table class="table table-bordered" border="0" width="100%">
			<tr>
				<td width="5%" align="center">No.</td>
				<td width="30%" align="center">Nama</td>
				<td width="15%" align="center">Bagian</td>
				<td width="20%" align="center">Tanggal</td>
				<td width="20%" align="center">Tanda Tangan</td>
			</tr>
			<tr>
				<td align="center" style="vertical-align:middle !important;">1.</td>
				<td style="vertical-align:middle !important;">URAY YUSI MANDELA , S.Kom</td>
				<td align="center" style="vertical-align:middle !important;">GENERAL MANAGER</td>
				<td align="center" style="vertical-align:middle !important;">...................................</td>
				<td></td>
			</tr>
		</table>
		<br/><br/><br/><br/>
		<strong>CATATAN</strong><br/><br/>
		<ul type="disc">
			<li>Lembaran koreksi ini diserahkan kepada general manager, dan general manager harus menyelesaikan koreksi dokumen ini dan ditandatangani lengkap oleh general manager maksimal 2 hari kerja.</li>
		</ul>
	</div>

	<div class="content">
		<strong>NOMOR REKENING yang digunakan :</strong>
		<br/><br/>
		<div style="border:2px solid #333;padding:20px">
			<table class="table" border="0" width="100%">
				<tr>
					<td width="20%"><strong>Nama Bank</strong></td>
					<td width="1%"><strong>:</strong></td>
					<td><strong>BANK BTN,  KC  PONTIANAK</strong></td>
				</tr>
				<tr>
					<td width="20%"><strong>No. Rekening</strong></td>
					<td width="1%"><strong>:</strong></td>
					<td><strong>001 600 1300000605</strong></td>
				</tr>
				<tr>
					<td width="20%"><strong>Atas Nama</strong></td>
					<td width="1%"><strong>:</strong></td>
					<td><strong>PT RAVINDO KARYA</strong></td>
				</tr>
			</table>
		</div>
		<br/><br/><br/>
		<strong>BIAYA YANG TIMBUL AKIBAT TRANSAKSI :</strong><br/>
		<strong>Biaya Notaris / PPAT :</strong><br/><br/>
		<p>Yang menjadi kewajiban <strong>PIHAK PERTAMA / PENJUAL</strong>, yaitu :</p>
		<ol type="1" style="padding-left:20px;">
			<li>Pengecekan Sertifikat</li>
			<li>Pajak Penjualan / PPH</li>
		</ol>
		<p>Yang menjadi kewajiban <strong>PIHAK KEDUA / PEMBELI</strong>, yaitu :</p>
		<ol type="1" style="padding-left:20px;">
			<li>Biaya Balik Nama / BBN</li>
			<li>Pajak Pembelian / BPHTB</li>
			<li>Pajak Pertambahan Nilai / PPN</li>
		</ol>
		<br/>
		<strong>BIAYA ADMINISTRASI BANK :</strong><br/><br/>
		<p>Bila pembayaran dengan cara Kredit Pemilikan Rumah (KPR) maka otomatis menjadi kewajiban <strong>PIHAK KEDUA / PEMBELI</strong> :</p>
		<ol type="1" style="padding-left:20px;">
			<li>Akta Pengakuan Hak Tanggungan / APHT</li>
			<li>Pengurusan Pemasangan APHT</li>
			<li>Administrasi Bank</li>
			<li>Biaya Materai</li>
			<li>Provisi</li>
			<li>Asuransi Jiwa Kredit</li>
		</ol>
		<br/>
		<strong>UNTUK PENJELASAN dapat menghubungi bagian marketing :</strong><br/><br/>
		<div style="border:2px solid #333;padding:20px">
			<table class="table" border="0" width="100%">
				<tr>
					<td width="20%"><strong>Nama</strong></td>
					<td width="1%"><strong>:</strong></td>
					<td><strong>FRANSISKUS ( Manager Marketing )</strong></td>
				</tr>
				<tr>
					<td width="20%"><strong>No. Telpon</strong></td>
					<td width="1%"><strong>:</strong></td>
					<td><strong>0822 5501 3477</strong></td>
				</tr>
			</table>
		</div>
	</div>

	<div style="page-break-after:avoid">
		<strong>LAMPIRAN</strong>
		<br/>
		<p>Dokumen Perjanjian Pengikat Jual Beli</p>
		<table class="table" border="0" width="100%">
			<tr>
				<td width="5%">1.</td>
				<td>Sampul</td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="5%">2.</td>
				<td>
					Spesifikasi Teknis Bangunan
					<ul type="square">
						<li>Pekerjaan Rangka Badan, Kuda-kuda dan Atap</li>
						<li>Pekerjaan Lantai dan Dinding</li>
						<li>Pekerjaan Pintu, Jendela dan Ventilasi</li>
						<li>Pekerjaan Plafond</li>
						<li>Pekerjaan Kamar Mandi</li>
						<li>Pekerjaan Pengecetan</li>
						<li>Pekerjaan Listrik</li>
						<li>Pekerjaan Penunjang/pendukung</li>
					</ul>
				</td>
				<td width="20%" style="padding-top:30px;">
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
					<div style="width:15px;height:15px;border:1px solid #333;margin-bottom:10px;margin-left:70px;">
					</div>
				</td>
			</tr>
			<tr>
				<td width="5%">3.</td>
				<td>
					Gambar Standar
					<ul type="square">
						<li>Master Plan Kawasan Perumahan Homenesty Residence</li>
						<li>Denah Bangunan Rumah</li>
						<li>Elivasi Potongan</li>
						<li>Potongan A-A</li>
						<li>Potongan B-B</li>
						<li>Denah dan Detai Rencana Pondasi</li>
						<li>Denah Rencana Blok Sloof dan Kolom</li>
						<li>Denah Rencana Ring Balok</li>
						<li>Denah Rencana Pola Keramik</li>
						<li>Denah Rencana Rangka Atap</li>
						<li>Denah Rencana Plafond</li>
						<li>Denah Rencana PJV	</li>
						<li>Denah Rencana Titik Lampu</li>
						<li>Denah Rencana Pemipaan Air Bersih</li>
						<li>Denah Rencana Pemipaan Air Kotor</li>
					</ul>
				</td>
				<td width="20%" style="padding-top:20px;">
					<ul type="none">
						<li>Gambar 1</li>
						<li>Gambar 2</li>
						<li>Gambar 3</li>
						<li>Gambar 4</li>
						<li>Gambar 5</li>
						<li>Gambar 6</li>
						<li>Gambar 7</li>
						<li>Gambar 8</li>
						<li>Gambar 9</li>
						<li>Gambar 10</li>
						<li>Gambar 11</li>
						<li>Gambar 12</li>
						<li>Gambar 13</li>
						<li>Gambar 14</li>
						<li>Gambar 15</li>
					</ul>
				</td>
			</tr>
		</table>
	</div>


</body>
</html>
