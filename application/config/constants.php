<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    B
SD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//System
defined('POWERED_BY') OR define('POWERED_BY', 'www.delapanbit.co.id');

//PATH
defined('PATH_BACKEND') OR define('PATH_BACKEND', 'as-template/backend/');

//ASSET PATH
defined('ASSET_CSS') OR define('ASSET_CSS', 'assets/css/');
defined('ASSET_JS') OR define('ASSET_JS', 'assets/js/');
defined('ASSET_PLUGIN') OR define('ASSET_PLUGIN', 'assets/plugins/');

//IMG
defined('IMAGES_WEB') OR define('IMAGES_WEB', 'assets/images/web/');
defined('IMAGES_USER') OR define('IMAGES_USER', 'assets/images/users/');
defined('IMAGES_ICONS') OR define('IMAGES_ICONS', 'assets/images/icons/');
defined('IMAGES_AVATAR') OR define('IMAGES_AVATAR', 'assets/images/user/');

//messages
defined('MESSAGE_LOGIN_GAGAL') OR define('MESSAGE_LOGIN_GAGAL', '<div class="callout callout-danger text-center"><i class="fa fa-ban"></i> <strong>Username</strong> atau <strong>password</strong> yang Anda masukkan salah.</div>');
defined('MESSAGE_BERHASIL_LOGOUT') OR define('MESSAGE_BERHASIL_LOGOUT', '<div class="callout callout-success text-center"><i class="fa fa-info"></i> Anda Berhasil Logout</div>');
defined('MESSAGE_LOGIN_DULU') OR define('MESSAGE_LOGIN_DULU', '<div class="callout callout-danger text-center"><i class="icon fa fa-ban"></i> Untuk mengakses sistem, Anda harus login ke akun Anda terlebih dahulu.</div>');
defined('MESSAGE_GAGAL_UPLOAD') OR define('MESSAGE_GAGAL_UPLOAD', '<div class="callout callout-danger text-center"><i class="icon fa fa-ban"></i> Gagal upload gambar.</div>');
defined('MESSAGE_BERHASIL_DIHAPUS') OR define('MESSAGE_BERHASIL_DIHAPUS', '<div class="callout callout-success text-center"><i class="fa fa-info"></i> Data berhasil dihapus</div>');
defined('MESSAGE_GAGAL_DIHAPUS') OR define('MESSAGE_GAGAL_DIHAPUS', '<div class="callout callout-danger text-center"><i class="icon fa fa-ban"></i> Data Gagal dihapus.</div>');
defined('MESSAGE_BERHASIL_SIMPAN') OR define('MESSAGE_BERHASIL_SIMPAN', '<div class="callout callout-success text-center"><i class="fa fa-info"></i> Data berhasil disimpan</div>');

//Level User
defined('LEVEL_0') OR define('LEVEL_0', 'Programmer');
defined('LEVEL_1') OR define('LEVEL_1', 'Owner');
defined('LEVEL_2') OR define('LEVEL_2', 'Admin');
defined('LEVEL_3') OR define('LEVEL_3', 'Finance');
defined('LEVEL_UNDIFINED') OR define('LEVEL_UNDIFINED', 'Tidak diketahui');
