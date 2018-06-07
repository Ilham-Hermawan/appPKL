<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'dashboard';
$route['dashboard/logout'] = 'auth/log_out';

$route['dashboard/user/list'] = 'user/list_data';
$route['dashboard/user/add'] = 'user/add_data';
$route['dashboard/user/save'] = 'user/save_data';
$route['dashboard/user/edit/(:num)'] = 'user/edit_data/$1';
$route['dashboard/user/delete/(:any)/(:any)'] = 'user/delete_data/$1/$2';
$route['dashboard/user/edit_profile'] = 'user/edit_profile';

$route['dashboard/rumah/list'] = 'rumah/list_data';
$route['dashboard/rumah/add'] = 'rumah/add_data';
$route['dashboard/rumah/save'] = 'rumah/save_data';
$route['dashboard/rumah/edit/(:num)'] = 'rumah/edit_data/$1';
$route['dashboard/rumah/delete/(:any)'] = 'rumah/delete_data/$1';
$route['dashboard/rumah/kavling/(:num)'] = 'rumah/kavling_data/$1';
$route['dashboard/rumah/kavling_save'] = 'rumah/kavling_save';

$route['dashboard/pelanggan/list'] = 'pelanggan/list_data';
$route['dashboard/pelanggan/add'] = 'pelanggan/add_data';
$route['dashboard/pelanggan/save'] = 'pelanggan/save_data';
$route['dashboard/pelanggan/edit/(:num)'] = 'pelanggan/edit_data/$1';
$route['dashboard/pelanggan/delete/(:any)/(:any)'] = 'pelanggan/delete_data/$1/$2';
$route['dashboard/pelanggan/transaksi/(:num)'] = 'pelanggan/list_transaksi/$1';


$route['dashboard/booking/add'] = 'booking/booking';
$route['dashboard/booking/list'] = 'booking/list_data';
// $route['dashboard/booking/save'] = 'booking/save_data';
$route['dashboard/booking/delete/(:any)/(:any)'] = 'booking/delete/$1/$2';

$route['dashboard/admin/transaksi/bichecking/list'] = 'transaksi/bi_checking_list';
$route['dashboard/admin/transaksi/ppjb/list'] = 'transaksi/ppjb_list';
$route['dashboard/admin/transaksi/ppjb/dokument/(:num)'] = 'transaksi/get_laporan_ppjb/$1';
$route['dashboard/admin/transaksi/kelengkapanberkas/list'] = 'transaksi/kelengkapan_berkas_list';
$route['dashboard/admin/transaksi/kelengkapanberkas/edit/(:num)/(:num)'] = 'transaksi/kelengkapan_berkas_edit/$1/$2';
$route['dashboard/admin/transaksi/kelengkapanberkas/save'] = 'transaksi/kelengkapanberkas_save';
$route['dashboard/admin/transaksi/wawancara/list'] = 'transaksi/wawancara_list';
$route['dashboard/admin/transaksi/wawancara/add'] = 'transaksi/wawancara_add';
$route['dashboard/admin/transaksi/wawancara/save'] = 'transaksi/wawancara_save';
$route['dashboard/admin/transaksi/wawancara/edit/(:num)'] = 'transaksi/wawancara_edit/$1';
$route['dashboard/admin/transaksi/wawancara/dokument/(:num)'] = 'transaksi/get_laporan_wawancara/$1';
$route['dashboard/admin/transaksi/kirimdatabtn/list'] = 'transaksi/dbtn_list';
$route['dashboard/admin/transaksi/ots/list'] = 'transaksi/ots_list';
$route['dashboard/admin/transaksi/sp3k/list'] = 'transaksi/sp3k_list';
$route['dashboard/admin/transaksi/lpa/list'] = 'transaksi/lpa_list';
$route['dashboard/admin/transaksi/lpa/dokument/(:num)'] = 'transaksi/get_laporan_lpa/$1';
$route['dashboard/admin/transaksi/vpajak/list'] = 'transaksi/vpajak_list';
$route['dashboard/admin/transaksi/akad/add'] = 'transaksi/akad_add';
$route['dashboard/admin/transaksi/akad/save'] = 'transaksi/akad_save';
$route['dashboard/admin/transaksi/akad/list'] = 'transaksi/akad_list';
$route['dashboard/admin/transaksi/akad/edit/(:num)'] = 'transaksi/akad_edit/$1';
$route['dashboard/admin/transaksi/akad/dokument/(:num)'] = 'transaksi/get_laporan_akad/$1';
// $route['dashboard/admin/transaksi/lpa/dokument/(:num)'] = 'transaksi/get_laporan_lpa/$1';
$route['dashboard/admin/transaksi/skr/list'] = 'transaksi/skr_list';
$route['dashboard/admin/transaksi/skr/dokument/(:num)'] = 'transaksi/get_laporan_skr/$1';
$route['dashboard/admin/transaksi/jaminan/list'] = 'transaksi/jaminan_list';

$route['dashboard/finance/transaksi/pi/list'] = 'finance/pi_list';
$route['dashboard/finance/transaksi/pl/list'] = 'finance/pl_list';


$route['dashboard/penerimaan/add'] = 'finance/penerimaan_add';

$route['dashboard/pencairan_induk/list'] = 'finance/pi_list';
$route['dashboard/finance/transaksi/pl/add'] = 'finance/pl_add';
$route['dashboard/finance/transaksi/pl/edit/(:num)'] = 'finance/pl_edit/$1';
$route['dashboard/finance/transaksi/pl/save'] = 'finance/pl_save';
$route['dashboard/finance/transaksi/pl/dokument/(:num)'] = 'finance/get_laporan_pl/$1';

$route['dashboard/finance/transaksi/imb/list'] = 'finance/imb_list';
$route['dashboard/finance/transaksi/imb/add'] = 'finance/imb_add';
$route['dashboard/finance/transaksi/imb/edit/(:num)'] = 'finance/imb_edit/$1';
$route['dashboard/finance/transaksi/imb/save'] = 'finance/imb_save';
$route['dashboard/finance/transaksi/imb/dokument/(:num)'] = 'finance/get_laporan_imb/$1';

$route['dashboard/finance/transaksi/sertifikat/list'] = 'finance/sertifikat_list';
$route['dashboard/finance/transaksi/sertifikat/add'] = 'finance/sertifikat_add';
$route['dashboard/finance/transaksi/s/save'] = 'finance/sertifikat_save';
$route['dashboard/finance/transaksi/s/edit/(:num)'] = 'finance/s_edit/$1';
$route['dashboard/finance/transaksi/s/dokument/(:num)'] = 'finance/get_laporan_s/$1';

$route['dashboard/finance/transaksi/100/list'] = 'finance/j100_list';
$route['dashboard/finance/transaksi/100/add'] = 'finance/j100_add';
$route['dashboard/finance/transaksi/100/edit/(:num)'] = 'finance/j100_edit/$1';
$route['dashboard/finance/transaksi/100/save'] = 'finance/j100_save';
$route['dashboard/finance/transaksi/100/dokument/(:num)'] = 'finance/get_laporan_100/$1';

$route['dashboard/finance/transaksi/jalan/list'] = 'finance/jalan_list';
$route['dashboard/finance/transaksi/jalan/add'] = 'finance/jalan_add';
$route['dashboard/finance/transaksi/jalan/edit/(:num)'] = 'finance/jalan_edit/$1';
$route['dashboard/finance/transaksi/jalan/save'] = 'finance/jalan_save';
$route['dashboard/finance/transaksi/jalan/dokument/(:num)'] = 'finance/get_laporan_jalan/$1';

$route['dashboard/finance/transaksi/penerimaan/list'] = 'finance/penerimaan_list';
$route['dashboard/finance/transaksi/penerimaan/add'] = 'finance/penerimaan_add';
$route['dashboard/finance/transaksi/penerimaan/edit/(:num)'] = 'finance/penerimaan_edit/$1';
$route['dashboard/finance/transaksi/penerimaan/delete/(:num)'] = 'finance/penerimaan_delete/$1';

$route['dashboard/finance/transaksi/dp/list'] = 'finance/dp_list';
$route['dashboard/finance/transaksi/dp/add'] = 'finance/dp_add';
$route['dashboard/finance/transaksi/dp/save'] = 'finance/dp_save';
$route['dashboard/finance/transaksi/dp/edit/(:num)'] = 'finance/dp_edit/$1';

$route['dashboard/owner/rab/list'] = 'rab/rab_list';
$route['dashboard/owner/rab/add'] = 'rab/rab_add';
$route['dashboard/owner/rab/save'] = 'rab/rab_save';
$route['dashboard/owner/rab/edit/(:num)'] = 'rab/rab_edit/$1';
$route['dashboard/owner/rab/delete/(:num)'] = 'rab/rab_delete/$1';

$route['dashboard/owner/bpt/list'] = 'rab/bpt_list';
$route['dashboard/owner/bpt/add'] = 'rab/bpt_add';
$route['dashboard/owner/bpt/save'] = 'rab/bpt_save';
$route['dashboard/owner/bpt/edit/(:num)'] = 'rab/bpt_edit/$1';
$route['dashboard/owner/bpt/delete/(:num)'] = 'rab/bpt_delete/$1';

$route['dashboard/owner/bppt/list'] = 'rab/bppt_list';
$route['dashboard/owner/bppt/add'] = 'rab/bppt_add';
$route['dashboard/owner/bppt/save'] = 'rab/bppt_save';
$route['dashboard/owner/bppt/edit/(:num)'] = 'rab/bppt_edit/$1';
$route['dashboard/owner/bppt/delete/(:num)'] = 'rab/bppt_delete/$1';

$route['dashboard/owner/blp/list'] = 'rab/blp_list';
$route['dashboard/owner/blp/add'] = 'rab/blp_add';
$route['dashboard/owner/blp/save'] = 'rab/blp_save';
$route['dashboard/owner/blp/edit/(:num)'] = 'rab/blp_edit/$1';
$route['dashboard/owner/blp/delete/(:num)'] = 'rab/blp_delete/$1';

$route['dashboard/owner/bpsu/list'] = 'rab/bpsu_list';
$route['dashboard/owner/bpsu/add'] = 'rab/bpsu_add';
$route['dashboard/owner/bpsu/save'] = 'rab/bpsu_save';
$route['dashboard/owner/bpsu/edit/(:num)'] = 'rab/bpsu_edit/$1';
$route['dashboard/owner/bpsu/delete/(:num)'] = 'rab/bpsu_delete/$1';

$route['dashboard/owner/bkr/list'] = 'rab/bkr_list';
$route['dashboard/owner/bkr/add'] = 'rab/bkr_add';
$route['dashboard/owner/bkr/save'] = 'rab/bkr_save';
$route['dashboard/owner/bkr/edit/(:num)'] = 'rab/bkr_edit/$1';
$route['dashboard/owner/bkr/delete/(:num)'] = 'rab/bkr_delete/$1';

$route['dashboard/owner/bp/list'] = 'rab/bp_list';
$route['dashboard/owner/bp/add'] = 'rab/bp_add';
$route['dashboard/owner/bp/save'] = 'rab/bp_save';
$route['dashboard/owner/bp/edit/(:num)'] = 'rab/bp_edit/$1';
$route['dashboard/owner/bp/delete/(:num)'] = 'rab/bp_delete/$1';

$route['dashboard/owner/bua/list'] = 'rab/bua_list';
$route['dashboard/owner/bua/add'] = 'rab/bua_add';
$route['dashboard/owner/bua/save'] = 'rab/bua_save';
$route['dashboard/owner/bua/edit/(:num)'] = 'rab/bua_edit/$1';
$route['dashboard/owner/bua/delete/(:num)'] = 'rab/bua_delete/$1';

$route['dashboard/owner/bpbp/list'] = 'rab/bpbp_list';
$route['dashboard/owner/bpbp/add'] = 'rab/bpbp_add';
$route['dashboard/owner/bpbp/save'] = 'rab/bpbp_save';
$route['dashboard/owner/bpbp/edit/(:num)'] = 'rab/bpbp_edit/$1';
$route['dashboard/owner/bpbp/delete/(:num)'] = 'rab/bpbp_delete/$1';

$route['dashboard/finance/pengeluaran/bpt/list'] = 'pengeluaran/bpt_list';
$route['dashboard/finance/pengeluaran/bpt/add'] = 'pengeluaran/bpt_add';
$route['dashboard/finance/pengeluaran/bpt/save'] = 'pengeluaran/bpt_save';
$route['dashboard/finance/pengeluaran/bpt/print/(:num)'] = 'pengeluaran/bpt_print/$1';
$route['dashboard/finance/pengeluaran/bpt/edit/(:num)'] = 'pengeluaran/bpt_edit/$1';
$route['dashboard/finance/pengeluaran/bpt/delete/(:num)'] = 'pengeluaran/bpt_delete/$1';

$route['dashboard/finance/pengeluaran/bppt/list'] = 'pengeluaran/bppt_list';
$route['dashboard/finance/pengeluaran/bppt/add'] = 'pengeluaran/bppt_add';
$route['dashboard/finance/pengeluaran/bppt/save'] = 'pengeluaran/bppt_save';
$route['dashboard/finance/pengeluaran/bppt/print/(:num)'] = 'pengeluaran/bppt_print/$1';
$route['dashboard/finance/pengeluaran/bppt/edit/(:num)'] = 'pengeluaran/bppt_edit/$1';
$route['dashboard/finance/pengeluaran/bppt/delete/(:num)'] = 'pengeluaran/bppt_delete/$1';

$route['dashboard/finance/pengeluaran/blp/list'] = 'pengeluaran/blp_list';
$route['dashboard/finance/pengeluaran/blp/add'] = 'pengeluaran/blp_add';
$route['dashboard/finance/pengeluaran/blp/save'] = 'pengeluaran/blp_save';
$route['dashboard/finance/pengeluaran/blp/print/(:num)'] = 'pengeluaran/blp_print/$1';
$route['dashboard/finance/pengeluaran/blp/edit/(:num)'] = 'pengeluaran/blp_edit/$1';
$route['dashboard/finance/pengeluaran/blp/delete/(:num)'] = 'pengeluaran/blp_delete/$1';

$route['dashboard/finance/pengeluaran/bpsu/list'] = 'pengeluaran/bpsu_list';
$route['dashboard/finance/pengeluaran/bpsu/add'] = 'pengeluaran/bpsu_add';
$route['dashboard/finance/pengeluaran/bpsu/save'] = 'pengeluaran/bpsu_save';
$route['dashboard/finance/pengeluaran/bpsu/print/(:num)'] = 'pengeluaran/bpsu_print/$1';
$route['dashboard/finance/pengeluaran/bpsu/edit/(:num)'] = 'pengeluaran/bpsu_edit/$1';
$route['dashboard/finance/pengeluaran/bpsu/delete/(:num)'] = 'pengeluaran/bpsu_delete/$1';

$route['dashboard/finance/pengeluaran/bkr/list'] = 'pengeluaran/bkr_list';
$route['dashboard/finance/pengeluaran/bkr/add'] = 'pengeluaran/bkr_add';
$route['dashboard/finance/pengeluaran/bkr/save'] = 'pengeluaran/bkr_save';
$route['dashboard/finance/pengeluaran/bkr/print/(:num)'] = 'pengeluaran/bkr_print/$1';
$route['dashboard/finance/pengeluaran/bkr/edit/(:num)'] = 'pengeluaran/bkr_edit/$1';
$route['dashboard/finance/pengeluaran/bkr/delete/(:num)'] = 'pengeluaran/bkr_delete/$1';

$route['dashboard/finance/pengeluaran/bp/list'] = 'pengeluaran/bp_list';
$route['dashboard/finance/pengeluaran/bp/add'] = 'pengeluaran/bp_add';
$route['dashboard/finance/pengeluaran/bp/save'] = 'pengeluaran/bp_save';
$route['dashboard/finance/pengeluaran/bp/print/(:num)'] = 'pengeluaran/bp_print/$1';
$route['dashboard/finance/pengeluaran/bp/edit/(:num)'] = 'pengeluaran/bp_edit/$1';
$route['dashboard/finance/pengeluaran/bp/delete/(:num)'] = 'pengeluaran/bp_delete/$1';

$route['dashboard/finance/pengeluaran/bua/list'] = 'pengeluaran/bua_list';
$route['dashboard/finance/pengeluaran/bua/add'] = 'pengeluaran/bua_add';
$route['dashboard/finance/pengeluaran/bua/save'] = 'pengeluaran/bua_save';
$route['dashboard/finance/pengeluaran/bua/print/(:num)'] = 'pengeluaran/bua_print/$1';
$route['dashboard/finance/pengeluaran/bua/edit/(:num)'] = 'pengeluaran/bua_edit/$1';
$route['dashboard/finance/pengeluaran/bua/delete/(:num)'] = 'pengeluaran/bua_delete/$1';

$route['dashboard/finance/pengeluaran/bpbp/list'] = 'pengeluaran/bpbp_list';
$route['dashboard/finance/pengeluaran/bpbp/add'] = 'pengeluaran/bpbp_add';
$route['dashboard/finance/pengeluaran/bpbp/save'] = 'pengeluaran/bpbp_save';
$route['dashboard/finance/pengeluaran/bpbp/print/(:num)'] = 'pengeluaran/bpbp_print/$1';
$route['dashboard/finance/pengeluaran/bpbp/edit/(:num)'] = 'pengeluaran/bpbp_edit/$1';
$route['dashboard/finance/pengeluaran/bpbp/delete/(:num)'] = 'pengeluaran/bpbp_delete/$1';

$route['dashboard/finance/penerimaan/pp/list'] = 'penerimaan/pp_list';
$route['dashboard/finance/penerimaan/pp/add'] = 'penerimaan/pp_add';
$route['dashboard/finance/penerimaan/pp/save'] = 'penerimaan/pp_save';
$route['dashboard/finance/penerimaan/pp/print/(:num)'] = 'penerimaan/pp_print/$1';
$route['dashboard/finance/penerimaan/pp/edit/(:num)'] = 'penerimaan/pp_edit/$1';
$route['dashboard/finance/penerimaan/pp/delete/(:num)'] = 'penerimaan/pp_delete/$1';

$route['dashboard/finance/penerimaan/hpp/list'] = 'penerimaan/hpp_list';
$route['dashboard/finance/penerimaan/hpp/add'] = 'penerimaan/hpp_add';
$route['dashboard/finance/penerimaan/hpp/save'] = 'penerimaan/hpp_save';
$route['dashboard/finance/penerimaan/hpp/print/(:num)'] = 'penerimaan/hpp_print/$1';
$route['dashboard/finance/penerimaan/hpp/edit/(:num)'] = 'penerimaan/hpp_edit/$1';
$route['dashboard/finance/penerimaan/hpp/delete/(:num)'] = 'penerimaan/hpp_delete/$1';

$route['dashboard/finance/penerimaan/buda/list'] = 'penerimaan/buda_list';
$route['dashboard/finance/penerimaan/buda/add'] = 'penerimaan/buda_add';
$route['dashboard/finance/penerimaan/buda/save'] = 'penerimaan/buda_save';
$route['dashboard/finance/penerimaan/buda/print/(:num)'] = 'penerimaan/buda_print/$1';
$route['dashboard/finance/penerimaan/buda/edit/(:num)'] = 'penerimaan/buda_edit/$1';
$route['dashboard/finance/penerimaan/buda/delete/(:num)'] = 'penerimaan/buda_delete/$1';

$route['dashboard/configuration/list'] = 'configuration/list_data';
$route['dashboard/configuration/save'] = 'configuration/save_data';

$route['dashboard/laporan/master'] = 'Laporan/list_data_master';
$route['dashboard/laporan/master/perumahan/(:any)'] = 'Laporan/get_report_pdf_perumahan/$1';
$route['dashboard/laporan/master/pelanggan'] = 'Laporan/get_report_pdf_pelanggan';

$route['dashboard/laporan/transaksi'] = 'Laporan/list_data_transaksi';
$route['dashboard/laporan/transaksi/booking/(:any)/(:any)/(:any)'] = 'Laporan/list_data_booking/$1/$2/$3';
$route['dashboard/laporan/pencairan/(:any)'] = 'laporan/get_report_pdf_pencairan/$1';
$route['dashboard/laporan/progress_booking/(:any)'] = 'laporan/get_report_pdf_progress_booking/$1';

$route['dashboard/project/add'] = 'project/add_data';
$route['dashboard/project/edit/(:num)'] = 'project/edit_data/$1';
$route['dashboard/project/kavling/(:num)'] = 'project/kavling_data/$1';
$route['dashboard/project/display/(:num)'] = 'project/display_data/$1';
$route['dashboard/project'] = 'dashboard';
$route['dashboard/project/tersedia/(:num)'] = 'project/tersedia_data/$1';
$route['dashboard/project/terjual/(:num)'] = 'project/terjual_data/$1';
$route['dashboard/project/dibatalkan/(:num)'] = 'project/dibatalkan_data/$1';
$route['dashboard/project/booking/(:num)/(:num)'] = 'project/booking/$1/$2';
$route['dashboard/booking/save'] = 'project/booking_save';
$route['dashboard/booking/list/(:num)'] = 'project/booking_list/$1';
$route['dashboard/booking/print/(:num)'] = 'project/print_kwitansi/$1';
$route['dashboard/booking/edit/(:num)'] = 'project/edit_booking/$1';
$route['dashboard/booking/detil/(:num)'] = 'project/booking_detil/$1';

$route['dashboard/penerimaan/(:num)'] = 'penerimaan/list_penerimaan/$1';
$route['dashboard/penerimaan/detil/(:num)/(:num)'] = 'penerimaan/penerimaan_detil/$1/$2';
$route['dashboard/penerimaan/bayar/(:num)/(:num)'] = 'penerimaan/bayar_penerimaan/$1/$2';
$route['dashboard/penerimaan/bayar/(:num)/(:num)/(:num)'] = 'penerimaan/bayar_penerimaan/$1/$2/$3';
$route['dashboard/penerimaan/kwitansi/(:num)'] = 'penerimaan/kwitansi_penerimaan/$1';
$route['dashboard/pengeluaran/(:num)'] = 'pengeluaran/list_pengeluaran/$1';
$route['dashboard/pengeluaran/list/(:num)/(:num)'] = 'pengeluaran/list2_pengeluaran/$1/$2';
$route['dashboard/pengeluaran/bayar/(:num)/(:num)'] = 'pengeluaran/bayar_pengeluaran/$1/$2';
$route['dashboard/pengeluaran/bayar/(:num)/(:num)/(:num)'] = 'pengeluaran/bayar_pengeluaran/$1/$2/$3';
$route['dashboard/pengeluaran/kwitansi/(:num)'] = 'pengeluaran/kwitansi_pengeluaran/$1';
$route['dashboard/pengeluaran/history/(:num)/(:num)'] = 'pengeluaran/history_pengeluaran/$1/$2';

$route['dashboard/log/log_login'] = 'log/log_login';
$route['dashboard/log/log_action'] = 'log/log_action';
