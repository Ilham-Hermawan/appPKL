<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= site_url(IMAGES_USER.$user_info['user_avatar']) ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $user_info['user_nama'] ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> <?= $user_info['user_level'] ?></a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li<?= ($this->uri->segment(1) == "dashboard") ? ' class="active"' : "" ?>>
        <a href="<?= site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>
      <?php if($this->session->userdata('userlevel') != "3"): ?>
      <li class="treeview <?= (($this->uri->segment(2) == "project")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-home"></i>
          <span>Project</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?= (($this->uri->segment(2) == "project") AND ($this->uri->segment(3) == "add")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/project/add') ?>"><i class="fa fa-plus"></i> Tambah Project</a>
          </li>
          <?php if(!empty($project)): ?>
            <?php foreach($project as $row): ?>
            <li <?= (($this->uri->segment(2) == "project") AND ($this->uri->segment(3) == "display") AND ($this->uri->segment(4) == "<?= $row->rumah_id ?>")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/project/display/'.$row->rumah_id) ?>"><i class="fa fa-minus"></i> <?= ucwords(strtolower($row->rumah_nama)) ?></a>
            </li>
          <?php endforeach; ?>
          <?php else: ?>
            <li>
              <a href="javascript:void(0)"><i class="fa fa-minus"></i> No Project Available...</a>
            </li>
          <?php endif; ?>
        </ul>
      </li>
      <!-- <li class="treeview <?= (($this->uri->segment(2) == "rumah")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-home"></i>
          <span>Rumah</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?= (($this->uri->segment(2) == "rumah") AND ($this->uri->segment(3) == "add")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/rumah/add') ?>"><i class="fa fa-minus"></i> Tambah</a>
          </li>
          <li <?= (($this->uri->segment(2) == "rumah") AND ($this->uri->segment(3) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/rumah/list') ?>"><i class="fa fa-minus"></i> Rumah</a>
          </li>
        </ul>
      </li> -->
      <?php endif; ?>
      <?php if($this->session->userdata('userlevel') != "3"): ?>
      <!-- <li class="treeview <?= (($this->uri->segment(2) == "pelanggan")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Pelanggan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?= (($this->uri->segment(2) == "pelanggan") AND ($this->uri->segment(3) == "add")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/pelanggan/add') ?>"><i class="fa fa-minus"></i> Tambah</a>
          </li>
          <li <?= (($this->uri->segment(2) == "pelanggan") AND ($this->uri->segment(3) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/pelanggan/list') ?>"><i class="fa fa-minus"></i> Pelanggan</a>
          </li>
        </ul>
      </li> -->
      <?php endif; ?>

      <!-- <li class="treeview <?= (($this->uri->segment(2) == "booking")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Booking</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php if($this->session->userdata('userlevel') != "3"): ?>
          <li <?= (($this->uri->segment(2) == "booking") AND ($this->uri->segment(3) == "add")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/booking/add') ?>"><i class="fa fa-minus"></i> Tambah</a>
          </li>
          <?php endif; ?>
          <li <?= (($this->uri->segment(2) == "booking") AND ($this->uri->segment(3) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/booking/list') ?>"><i class="fa fa-minus"></i> Booking</a>
          </li>
        </ul>
      </li> -->
      <?php if($this->session->userdata('userlevel') != "3"): ?>
        <li class="treeview <?= (($this->uri->segment(2) == "booking")) ? " active" : "" ?>">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Admin</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if(!empty($project)): ?>
              <?php foreach($project as $row): ?>
              <li <?= (($this->uri->segment(2) == "booking") AND ($this->uri->segment(3) == "list") AND ($this->uri->segment(4) == $row->rumah_id)) ? "class='active'" : "" ?>>
                <a href="<?= site_url('dashboard/booking/list/'.$row->rumah_id) ?>"><i class="fa fa-minus"></i> <?= ucwords(strtolower($row->rumah_nama)) ?></a>
              </li>
            <?php endforeach; ?>
            <?php else: ?>
              <li>
                <a href="javascript:void(0)"><i class="fa fa-minus"></i> No Project Available...</a>
              </li>
            <?php endif; ?>
          </ul>
        </li>
      <!-- <li class="treeview <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-file-o"></i>
          <span>Admin</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "bichecking") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/bichecking/list') ?>"><i class="fa fa-minus"></i> BI Checking</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "ppjb") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/ppjb/list') ?>"><i class="fa fa-minus"></i> PPJB</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "kelengkapanberkas")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/kelengkapanberkas/list') ?>"><i class="fa fa-minus"></i> Kelengkapan Berkas</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "wawancara")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/wawancara/list') ?>"><i class="fa fa-minus"></i> Wawancara</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "kirimdatabtn") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/kirimdatabtn/list') ?>"><i class="fa fa-minus"></i> Kirim Data ke BTN</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "ots") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/ots/list') ?>"><i class="fa fa-minus"></i> OTS</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "sp3k") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/sp3k/list') ?>"><i class="fa fa-minus"></i> SP3K</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "lpa") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/lpa/list') ?>"><i class="fa fa-minus"></i> LPA</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "vpajak") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/vpajak/list') ?>"><i class="fa fa-minus"></i> Validasi Pajak</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "akad") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/akad/list') ?>"><i class="fa fa-minus"></i> Akad</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "skr") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/skr/list') ?>"><i class="fa fa-minus"></i> SKR</a>
          </li>
          <li <?= (($this->uri->segment(2) == "admin") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "jaminan") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/admin/transaksi/jaminan/list') ?>"><i class="fa fa-minus"></i> Jaminan 100 Hari</a>
          </li>
        </ul>
      </li> -->
      <?php endif; ?>
      <?php if($this->session->userdata('userlevel') == "3" OR $this->session->userdata('userlevel') == "0" OR $this->session->userdata('userlevel') == "1"): ?>
        <li class="treeview<?= (($this->uri->segment(2) == "penerimaan") OR ($this->uri->segment(2) == "pengeluaran")) ? " active" : "" ?>">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Finance</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if(!empty($project)): ?>
              <?php foreach($project as $row): ?>
              <li<?= (($this->uri->segment(2) == "penerimaan") AND ($this->uri->segment(3) == $row->rumah_id)) ? " class='active'" : "" ?>>
                <a href="javascript:void(0)"><i class="fa fa-minus"></i> <?= ucwords(strtolower($row->rumah_nama)) ?></a>

                <ul class="treeview-menu">
                  <li><a href="<?= site_url('dashboard/penerimaan/'.$row->rumah_id) ?>"><i class="fa fa-minus"></i> Penerimaan</a></li>
                  <li><a href="<?= site_url('dashboard/pengeluaran/'.$row->rumah_id) ?>"><i class="fa fa-minus"></i> Pengeluaran</a></li>
                </ul>
              </li>
            <?php endforeach; ?>
            <?php else: ?>
              <li>
                <a href="javascript:void(0)"><i class="fa fa-minus"></i> No Project Available...</a>
              </li>
            <?php endif; ?>
          </ul>
        </li>
        <!-- <li class="treeview <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi")) ? " active" : "" ?>">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Finance</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "dp")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/transaksi/dp/list') ?>"><i class="fa fa-minus"></i> Rencana DP</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "pi") AND ($this->uri->segment(5) == "list")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/transaksi/pi/list') ?>"><i class="fa fa-minus"></i> Pencairan Induk</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "pl")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/transaksi/pl/list') ?>"><i class="fa fa-minus"></i> Pencairan Listrik</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "imb")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/transaksi/imb/list') ?>"><i class="fa fa-minus"></i> Pencairan IMB</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "sertifikat")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/transaksi/sertifikat/list') ?>"><i class="fa fa-minus"></i> Pencairan Sertifikat</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "100")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/transaksi/100/list') ?>"><i class="fa fa-minus"></i> Pencairan 100 Hari</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "transaksi") AND ($this->uri->segment(4) == "jalan")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/transaksi/jalan/list') ?>"><i class="fa fa-minus"></i> Pencairan Jalan</a>
            </li>
          </ul>
        </li> -->
        <!-- <li class="treeview <?= (($this->uri->segment(3) == "penerimaan")) ? " active" : "" ?>">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Penerimaan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "penerimaan") AND ($this->uri->segment(4) == "pp")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/penerimaan/pp/list') ?>"><i class="fa fa-minus"></i> PP</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "penerimaan") AND ($this->uri->segment(4) == "hpp")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/penerimaan/hpp/list') ?>"><i class="fa fa-minus"></i> HPP</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "penerimaan") AND ($this->uri->segment(4) == "buda")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/penerimaan/buda/list') ?>"><i class="fa fa-minus"></i> BUDA</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?= (($this->uri->segment(3) == "pengeluaran")) ? " active" : "" ?>">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Pengeluaran</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "bpt")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/bpt/list') ?>"><i class="fa fa-minus"></i> BPT</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "bppt")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/bppt/list') ?>"><i class="fa fa-minus"></i> BPPT</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "blp")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/blp/list') ?>"><i class="fa fa-minus"></i> BLP</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "bpsu")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/bpsu/list') ?>"><i class="fa fa-minus"></i> BPSU</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "bkr")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/bkr/list') ?>"><i class="fa fa-minus"></i> BKR</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "bp")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/bp/list') ?>"><i class="fa fa-minus"></i> BP</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "bua")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/bua/list') ?>"><i class="fa fa-minus"></i> BUA</a>
            </li>
            <li <?= (($this->uri->segment(2) == "finance") AND ($this->uri->segment(3) == "pengeluaran") AND ($this->uri->segment(4) == "bpbp")) ? "class='active'" : "" ?>>
              <a href="<?= site_url('dashboard/finance/pengeluaran/bpbp/list') ?>"><i class="fa fa-minus"></i> BPBP</a>
            </li>
          </ul>
        </li> -->
      <?php endif; ?>
      <li class="treeview <?= (($this->uri->segment(2) == "laporan")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-file-o"></i>
          <span>Laporan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <?php if($this->session->userdata('userlevel') == "0" OR $this->session->userdata('userlevel') == "1"): ?>
          <li <?= (($this->uri->segment(2) == "laporan") AND ($this->uri->segment(3) == "master")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/laporan/master') ?>"><i class="fa fa-minus"></i> Master</a>
          </li>
          <?php endif; ?>
          <li <?= (($this->uri->segment(2) == "laporan") AND ($this->uri->segment(3) == "transaksi")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/laporan/transaksi') ?>"><i class="fa fa-minus"></i> Transaksi</a>
          </li>
        </ul>
      </li>
      <?php if($this->session->userdata('userlevel') != "2" AND $this->session->userdata('userlevel') != "3"): ?>
      <li class="treeview <?= (($this->uri->segment(2) == "user")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>User</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?= (($this->uri->segment(2) == "user") AND ($this->uri->segment(3) == "add")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/user/add') ?>"><i class="fa fa-minus"></i> Tambah</a>
          </li>
          <li <?= (($this->uri->segment(2) == "user") AND ($this->uri->segment(3) == "list")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/user/list') ?>"><i class="fa fa-minus"></i> Users</a>
          </li>
        </ul>
      </li>
      <!-- <li class="treeview <?= (($this->uri->segment(2) == "owner")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-file-o"></i>
          <span>RAB</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "rab")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/rab/list') ?>"><i class="fa fa-minus"></i> RAB</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "bpt")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/bpt/list') ?>"><i class="fa fa-minus"></i> BPT</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "bppt")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/bppt/list') ?>"><i class="fa fa-minus"></i> BPPT</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "blp")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/blp/list') ?>"><i class="fa fa-minus"></i> BLP</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "bpsu")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/bpsu/list') ?>"><i class="fa fa-minus"></i> BPSU</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "bkr")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/bkr/list') ?>"><i class="fa fa-minus"></i> BKR</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "bp")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/bp/list') ?>"><i class="fa fa-minus"></i> BP</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "bua")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/bua/list') ?>"><i class="fa fa-minus"></i> BUA</a>
          </li>
          <li <?= (($this->uri->segment(2) == "owner") AND ($this->uri->segment(3) == "bpbp")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/owner/bpbp/list') ?>"><i class="fa fa-minus"></i> BPBP</a>
          </li>
        </ul>
      </li> -->
      <li<?= ($this->uri->segment(2) == "configuration" AND $this->uri->segment(3) == "list") ? ' class="active"' : "" ?>>
        <a href="<?= site_url('dashboard/configuration/list'); ?>"><i class="fa fa-gear"></i> <span>Configuration</span></a>
      </li>
      <li class="treeview <?= (($this->uri->segment(2) == "log")) ? " active" : "" ?>">
        <a href="#">
          <i class="fa fa-pencil"></i>
          <span>Log</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?= (($this->uri->segment(2) == "log") AND ($this->uri->segment(3) == "log_login")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/log/log_login') ?>"><i class="fa fa-minus"></i> Log Login</a>
          </li>
          <li <?= (($this->uri->segment(2) == "log") AND ($this->uri->segment(3) == "log_action")) ? "class='active'" : "" ?>>
            <a href="<?= site_url('dashboard/log/log_action') ?>"><i class="fa fa-minus"></i> Log Action</a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <li><a id="logout"><i class="fa fa-sign-out text-red"></i> <span>Log Out</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
