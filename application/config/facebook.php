<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['facebook_appId'] = '118233688333682';
$config['facebook_secret'] = '9fd3ee247a04675e468147f44a767537';
$config['facebook_fileUpload'] = false; // optional
$config['facebook_scope'][] = 'email';
$config['facebook_scope'][] = 'user_birthday';
//$config['facebook_scope'][] = 'read_stream';
$config['facebook_scope'][] = 'publish_stream';
?>