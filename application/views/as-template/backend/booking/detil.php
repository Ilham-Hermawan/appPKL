
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header content-header-default">
    <h1 style="font-size:28px;">
      <?= $data['header_title'] ?>
      <?php if(!empty($data['sub_header_title'])):  ?>
      <small>/ <?= $data['sub_header_title'] ?></small>
      <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('dashboard'); ?>">Home</a></li>
      <li><a href="#">Booking</a></li>
      <li class="active">Detil</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <?= $this->session->flashdata('flashInfo'); ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

        <h3 class="text-center" style="margin:0;">Data Detil Booking</h3>
        <hr/>

        <table width="100%" class="table table-bordered">
          <tr>
            <th style="width:15%;text-align:right">KTP</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_ktp ?></td>
            <th style="width:15%;text-align:right">Perumahan</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->rumah_nama ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Nama</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_nama ?></td>
            <th style="width:15%;text-align:right">Alamat</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->rumah_alamat.', Desa '.$data['set']->rumah_desa.', Kec. '.$data['set']->rumah_kecamatan.', Kota '.$data['set']->rumah_kota.', Prov. '.$data['set']->rumah_provinsi ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Jenis Kelamin</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;">
              <?php
                if($data['set']->pelanggan_jk === "l"){
                  echo "LAKI-LAKI";
                }
                else{
                  echo "PEREMPUAN";
                }
                ?>
            </td>
            <th style="width:15%;text-align:right">Blok</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_blok ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">TTL</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_ttl ?></td>
            <th style="width:15%;text-align:right">Tipe</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_tipe ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Alamat</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_alamat ?></td>
            <th style="width:15%;text-align:right">Luas Bangunan</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_lb ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Alamat Surat</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_alamat_surat ?></td>
            <th style="width:15%;text-align:right">Luas Tanah</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_lt ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Kontak</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_kontak ?></td>
            <th style="width:15%;text-align:right">Harga</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;" class="text-green text-bold"><h4><?= "Rp. ".number_format($data['set']->harga) ?></h4></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Pekerjaan</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_pekerjaan ?></td>
            <th style="width:15%;text-align:right">&nbsp;</th>
            <td style="width:1%;">&nbsp;</td>
            <td style="width:34%;">&nbsp;</td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Agama</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->agama_nama ?></td>
            <th style="width:15%;text-align:right">&nbsp;</th>
            <td style="width:1%;">&nbsp;</td>
            <td style="width:34%;">&nbsp;</td>
          </tr>
        </table>
        <hr/>
          <h3 class="text-center" style="margin:0;">Proses Booking</h3>
        <hr/>

        <div class="row">
          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">BI CHECKING</h4>
              </div>
              <div class="box-body total_transaksi">
                <i class="fa fa-check fa-4x text-green"></i>
              </div>
              <div class="box-footer">
                <a href="#" class="btn btn-primary btn-block disabled">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">PPJB</h4>
              </div>
              <div class="box-body" id="ppjb">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="ppjb-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-ppjb" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h5 class="text-bold" style="margin:0;">KELENGKAPAN BERKAS</h5>
              </div>
              <div class="box-body total_transaksi" id="kb">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="kb-loading">
              </div>
              <div class="box-footer">
                <a href="<?= site_url('dashboard/admin/transaksi/kelengkapanberkas/edit/'.$this->uri->segment(4).'/'.$data['set']->pelanggan_id) ?>" class="btn btn-primary btn-block">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">WAWANCARA</h4>
              </div>
              <div class="box-body" id="w">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="w-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-wawancara" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h5 class="text-bold" style="margin:0;">PENYERAHAN BERKAS</h5>
              </div>
              <div class="box-body" id="pb">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="pb-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-pb" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">OTS / SURVEY</h4>
              </div>
              <div class="box-body" id="ots">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="ots-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-ots" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">SP3K</h4>
              </div>
              <div class="box-body total_transaksi" id="sp3k">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="sp3k-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-sp3k" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">LPA</h4>
              </div>
              <div class="box-body total_transaksi" id="lpa">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="lpa-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-lpa" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">VALIDASI PAJAK</h4>
              </div>
              <div class="box-body total_transaksi" id="vpajak">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="vpajak-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-vpajak" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">AKAD</h4>
              </div>
              <div class="box-body total_transaksi" id="akad">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="akad-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-akad" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">SKR</h4>
              </div>
              <div class="box-body total_transaksi" id="skr">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="skr-loading">
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-target="#view-modal-skr" data-toggle="modal">Action</a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box box-primary box-solid text-center">
              <div class="box-header with-border">
                <h4 class="text-bold" style="margin:0;">JAMINAN 100 HARI</h4>
              </div>
              <div class="box-body total_transaksi" id="jaminan">
                <img src="<?= site_url(IMAGES_WEB.'loading.gif') ?>" height="56px" id="jaminan-loading">
              </div>
              <div class="box-footer">
                <a href="#" class="btn btn-primary btn-block disabled">Action</a>
              </div>
            </div>
          </div>




        </div>

        <div class="box box-default box-solid">
          <div class="box-header with-border">
            <div class="box-title"><strong>Keterangan</strong></div>
          </div>
          <div class="box-body">
            <i class="fa fa-check text-gray"></i> Belum di Proses &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-check text-green"></i> Sudah di Proses
          </div>
        </div>


        </div><!-- /.box-body -->
      <div class="box-footer">

      </div>
    </div><!-- /.box -->


    <!-- Modal Informasi Detil  -->
    <div id="view-modal-ppjb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> PPJB</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="ppjb-id" value="0">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="ppjb-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-ppjb">
                  </div>
                  <br/><br/><br/>
                  <div class="form-group">
                    <a href="<?= site_url('dashboard/admin/transaksi/ppjb/dokument/'.$this->uri->segment(4)) ?>" target="_blank" class="btn btn-primary" id="ppjb-print"><i class="fa fa-print"></i> CETAK PPJB</a>
                  </div>
                  <br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="ppjb-simpan">
                      <i class="fa fa-save"></i> Simpan
                      <!-- <img src="<?= site_url(IMAGES_WEB.'loading_2.svg') ?>" height="8px;"> -->
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-wawancara" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Wawancara</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="wawancara-id">
                  <input type="hidden" id="dw-id">
                  <input type="hidden" id="rumah-id" value="<?= $data['set']->rumah_id ?>">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="wawancara-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-wawancara">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="wawancara-simpan">
                      <i class="fa fa-save"></i> Simpan
                      <!-- <img src="<?= site_url(IMAGES_WEB.'loading_2.svg') ?>" height="8px;"> -->
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-pb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Penyerahan Berkas</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="pb-id">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="pb-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-pb">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="pb-simpan">
                      <i class="fa fa-save"></i> Simpan
                      <!-- <img src="<?= site_url(IMAGES_WEB.'loading_2.svg') ?>" height="8px;"> -->
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-ots" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> OTS / SURVEY</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="ots-id">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="ots-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-ots">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="ots-simpan">
                      <i class="fa fa-save"></i> Simpan
                      <!-- <img src="<?= site_url(IMAGES_WEB.'loading_2.svg') ?>" height="8px;"> -->
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-sp3k" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> SP3K</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="sp3k-id">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="sp3k-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-sp3k">
                  </div>
                  <br/><br/><br/>
                  <div class="form-group">
                    <label>No SP3K</label>
                    <input type="text" class="form-control pull-right input-lg" id="no-sp3k">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="sp3k-simpan">
                      <i class="fa fa-save"></i> Simpan
                      <!-- <img src="<?= site_url(IMAGES_WEB.'loading_2.svg') ?>" height="8px;"> -->
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal LPA  -->
    <div id="view-modal-lpa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> LPA</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="lpa-id">
                  <input type="hidden" id="dlpa-id">
                  <input type="hidden" id="rumah-id" value="<?= $data['set']->rumah_id ?>">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="lpa-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-lpa">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="lpa-simpan">
                      <i class="fa fa-save"></i> Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal LPA -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-vpajak" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> VALIDASI PAJAK</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="vpajak-id">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="vpajak-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-vpajak">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="vpajak-simpan">
                      <i class="fa fa-save"></i> Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-akad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Akad</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="akad-id">
                  <input type="hidden" id="ad-id">
                  <input type="hidden" id="rumah-id" value="<?= $data['set']->rumah_id ?>">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="akad-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-akad">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="akad-simpan">
                      <i class="fa fa-save"></i> Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-skr" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Serah Terima Kunci Rumah</h4>
                </div>
                <div class="modal-body edit-content">
                  <input type="hidden" id="skr-id" value="0">
                  <div class="form-group">
                    <label>Status</label>
                    <select id="skr-status" class="form-control input-lg">
                      <option value="n">Belum</<option>
                      <option value="y">Sudah</<option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="dt-skr">
                  </div>
                  <br/><br/><br/>
                  <a href="<?= site_url('dashboard/admin/transaksi/skr/dokument/'.$this->uri->segment(4)) ?>" target="_blank" id="skr-print" class="btn btn-primary"><i class="fa fa-print"></i> CETAK SURAT SKR</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="skr-simpan">
                      <i class="fa fa-save"></i> Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'ajaxQueue/jquery.ajaxQueue.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."moment.min.js"); ?>"></script>

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('kavling').deleteRow(i);
  }

  $(window).load(function(){
    var x = 1;
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $('.input-harga').priceFormat(rupiah);
    $('.datepicker').datepicker({
      autoclose: true
    });

    reload_data();

    $("#AddRow").click(function(){
       addRow();
    });


    $('#view-modal-ppjb').on('show.bs.modal', function(e) {
      $('#ppjb-print').hide();
       document.getElementById("ppjb-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $('#ppjb-status').change(function(){
         if($('#ppjb-status').val() === 'y' && $('#ppjb-id').val() != '0'){
           $('#ppjb-print').show();
         }
       });

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_ppjb/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#ppjb-id').val('0');
              }
              else{
                $('#ppjb-id').val(obj.ppjb_id);
                $("#ppjb-status").val(obj.ppjb_status).change();
                $("#dt-ppjb").val(obj.ppjb_date);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#ppjb-simpan").click(function(){

      if((!$("#dt-ppjb").val()) || ($("#dt-ppjb").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{
        document.getElementById("ppjb-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_ppjb'); ?>',
            data: {
                'id': $('#ppjb-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'ppjb_status' : $( "#ppjb-status" ).val(),
                'ppjb_date' : $('#dt-ppjb').val()
            },
            success: function(data) {
              $(".se-pre-con").show();
              $('#view-modal-ppjb').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
              // console.log(gg);

            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });
      }


    });

    $('#view-modal-wawancara').on('show.bs.modal', function(e) {
      $('#ppjb-print').hide();
       document.getElementById("wawancara-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_wawancara/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#wawancara-id').val('0');
                $('#dw-id').val('0');
              }
              else{
                $('#wawancara-id').val(obj.wawancara_id);
                $('#dw-id').val(obj.dw_id);
                $("#wawancara-status").val(obj.dw_status).change();
                $("#dt-wawancara").val(obj.wawancara_tanggal);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#wawancara-simpan").click(function(){

      if((!$("#dt-wawancara").val()) || ($("#dt-wawancara").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{

        document.getElementById("wawancara-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_wawancara'); ?>',
            data: {
                'id': $('#wawancara-id').val(),
                'dw': $('#dw-id').val(),
                'rumah_id':$('#rumah-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'dw_status' : $( "#wawancara-status" ).val(),
                'wawancara_tanggal' : $('#dt-wawancara').val()
            },
            success: function(data) {
              $(".se-pre-con").show();
              $('#view-modal-wawancara').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
              // console.log(gg);

            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });

      }

    });

    $('#view-modal-pb').on('show.bs.modal', function(e) {
       document.getElementById("pb-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_pb/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#pb-id').val('0');
              }
              else{
                $('#pb-id').val(obj.db_id);
                $("#pb-status").val(obj.db_status).change();
                $("#dt-pb").val(obj.db_date);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#pb-simpan").click(function(){

      if((!$("#dt-pb").val()) || ($("#dt-pb").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{

        document.getElementById("pb-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_pb'); ?>',
            data: {
                'id': $('#pb-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'pb_status' : $( "#pb-status" ).val(),
                'pb_date' : $('#dt-pb').val()
            },
            success: function(data) {
              $(".se-pre-con").show();
              $('#view-modal-pb').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
              // console.log(gg);

            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });

      }


    });

    $('#view-modal-ots').on('show.bs.modal', function(e) {
       document.getElementById("ots-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_ots/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#ots-id').val('0');
              }
              else{
                $('#ots-id').val(obj.ots_id);
                $("#ots-status").val(obj.ots_status).change();
                $("#dt-ots").val(obj.ots_date);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#ots-simpan").click(function(){

      if((!$("#dt-ots").val()) || ($("#dt-ots").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{

        document.getElementById("ots-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_ots'); ?>',
            data: {
                'id': $('#ots-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'ots_status' : $( "#ots-status" ).val(),
                'ots_date' : $('#dt-ots').val()
            },
            success: function(data) {
              $(".se-pre-con").show();
              $('#view-modal-ots').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
              // console.log(gg);

            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });

      }


    });

    $('#view-modal-sp3k').on('show.bs.modal', function(e) {
       document.getElementById("sp3k-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_sp3k/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#sp3k-id').val('0');
              }
              else{
                $('#sp3k-id').val(obj.sp3k_id);
                $("#sp3k-status").val(obj.sp3k_status).change();
                $("#dt-sp3k").val(obj.sp3k_date);
                $("#no-sp3k").val(obj.sp3k_no);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#sp3k-simpan").click(function(){

      if((!$("#dt-sp3k").val()) || ($("#dt-sp3k").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{
        document.getElementById("sp3k-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_sp3k'); ?>',
            data: {
                'id': $('#sp3k-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'sp3k_status' : $( "#sp3k-status" ).val(),
                'sp3k_date' : $('#dt-sp3k').val(),
                'sp3k_no' : $('#no-sp3k').val(),
            },
            success: function(data) {
              $(".se-pre-con").show();
              $('#view-modal-sp3k').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });
      }


    });

    $('#view-modal-lpa').on('show.bs.modal', function(e) {
       document.getElementById("lpa-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_lpa/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#lpa-id').val('0');
                $('#dlpa-id').val('0');
              }
              else{
                $('#lpa-id').val(obj.lpa_id);
                $('#dlpa-id').val(obj.dlpa_id);
                $("#lpa-status").val(obj.dlpa_status).change();
                $("#dt-lpa").val(obj.lpa_tanggal);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#lpa-simpan").click(function(){

      if((!$("#dt-lpa").val()) || ($("#dt-lpa").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{
        document.getElementById("lpa-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_lpa'); ?>',
            data: {
                'id': $('#lpa-id').val(),
                'dlpa': $('#dlpa-id').val(),
                'rumah_id':$('#rumah-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'dlpa_status' : $( "#lpa-status" ).val(),
                'lpa_tanggal' : $('#dt-lpa').val()
            },
            success: function(data) {
              $(".se-pre-con").show();
              $('#view-modal-lpa').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
              // console.log(gg);

            },
            error: function (ts) {
              alert(ts.responseText);
              console.log(ts.responseText);
            }

        });
      }



    });

    $('#view-modal-vpajak').on('show.bs.modal', function(e) {
       document.getElementById("vpajak-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_vpajak/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#vpajak-id').val('0');
              }
              else{
                $('#vpajak-id').val(obj.vp_id);
                $("#vpajak-status").val(obj.vp_status).change();
                $("#dt-vpajak").val(obj.vp_date);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#vpajak-simpan").click(function(){

      if((!$("#dt-vpajak").val()) || ($("#dt-vpajak").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{

        document.getElementById("vpajak-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_vpajak'); ?>',
            data: {
                'id': $('#vpajak-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'vp_status' : $( "#vpajak-status" ).val(),
                'vp_date' : $('#dt-vpajak').val()
            },
            success: function(data) {
              $(".se-pre-con").show();

              $('#view-modal-vpajak').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });

      }

    });

    $('#view-modal-akad').on('show.bs.modal', function(e) {
       document.getElementById("akad-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_detil_akad/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#akad-id').val('0');
                $('#ad-id').val('0');
              }
              else{
                $('#akad-id').val(obj.akad_id);
                $('#ad-id').val(obj.ad_id);
                $("#akad-status").val(obj.ad_status).change();
                $("#dt-akad").val(obj.akad_date);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#akad-simpan").click(function(){

      if((!$("#dt-akad").val()) || ($("#dt-akad").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{

        document.getElementById("akad-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_akad'); ?>',
            data: {
                'id': $('#akad-id').val(),
                'ad': $('#ad-id').val(),
                'rumah_id':$('#rumah-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'ad_status' : $( "#akad-status" ).val(),
                'akad_date' : $('#dt-akad').val()
            },
            success: function(data) {
              $(".se-pre-con").show();
              $('#view-modal-akad').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
              // console.log(gg);

            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });

      }


    });

    $('#view-modal-skr').on('show.bs.modal', function(e) {
      $('#skr-print').hide();

       document.getElementById("skr-simpan").disabled = false;
       var id = '<?= $this->uri->segment(4) ?>';

       $('#skr-status').change(function(){
         if($('#skr-status').val() === 'y' && $('#skr-id').val() != '0'){
           $('#skr-print').show();
         }
       });

       $.ajax({
           type: "GET",
           url: "<?=site_url('project/get_skr/" + id + "');?>",
           cache: false,
           success: function (data) {
              var obj = $.parseJSON(data);
              if(!obj){
                $('#skr-id').val('0');
              }
              else{
                $('#skr-id').val(obj.skr_id);
                $("#skr-status").val(obj.skr_status).change();
                $("#dt-skr").val(obj.skr_date);
              }
           },
           error: function(err) {
               console.log("ERROR AJAX");
           }
       });

    });

    $("#skr-simpan").click(function(){

      if((!$("#dt-skr").val()) || ($("#dt-skr").val() === '0000-00-00')){
        swal('Peringatan!', 'Jangan lupa pilih tanggal terlebih dahulu', 'warning');
      }
      else{

        document.getElementById("skr-simpan").disabled = true;

        $.ajax({
            type: 'POST',
            url: '<?= site_url('project/save_skr'); ?>',
            data: {
                'id': $('#skr-id').val(),
                'booking_id' : '<?= $this->uri->segment(4) ?>',
                'skr_status' : $( "#skr-status" ).val(),
                'skr_date' : $('#dt-skr').val()
            },
            success: function(data) {
              $(".se-pre-con").show();

              $('#view-modal-skr').modal('toggle');
              window.location.href = "<?= site_url('dashboard/booking/detil/'.$this->uri->segment(4)); ?>";
            },
            error: function (ts) {
              console.log(ts.responseText);
            }

        });

      }


    });



    function reload_data(){

      jQuery.ajaxQueue({
        url: "<?= site_url('project/check_ppjb/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#ppjb-loading').remove();
        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }

        $('#ppjb').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/kelengkapan_berkas/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#kb-loading').remove();

        var kb = '<span style="font-size:42px;">'+data+' berkas</span>';
        $('#kb').append(kb);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/wawancara/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#w-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#w').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/penyerahan_berkas/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#pb-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#pb').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/ots/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#ots-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#ots').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/sp3k/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#sp3k-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#sp3k').append(icon);
      });

      //lpa
      jQuery.ajaxQueue({
        url: "<?= site_url('project/lpa/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#lpa-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#lpa').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/vpajak/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#vpajak-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#vpajak').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/akad/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#akad-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#akad').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/skr/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#skr-loading').remove();

        if(data === 'y'){
          var icon = '<i class="fa fa-check fa-4x text-green"></i>'
        }
        else{
          var icon = '<i class="fa fa-check fa-4x text-gray"></i>'
        }
        $('#skr').append(icon);
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/jaminan/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#jaminan-loading').remove();

        if(data == "???"){
          var jaminan = '<span style="font-size:39px;">'+data+'</span>';
          $('#jaminan').append(jaminan);
        }
        else{
          var jaminan = '<span style="font-size:28px;margin:8px 0px;display:block;">'+moment(data).format("DD/MM/YYYY")+'</span>';
          $('#jaminan').append(jaminan);
        }

      });


    }

  });
</script>
