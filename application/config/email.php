<?php defined('BASEPATH') or exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'in-v3.mailjet.com',
    'smtp_port' => 587,
    'smtp_user' => '64fac2c4d69dc053462cb94b4249a3aa',
    'smtp_pass' => 'e654f9d9a6b75e58887638a3d37512f9',
    'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
    //  'mailtype' => 'text', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => true,
    'mailtype' => 'html',
);
