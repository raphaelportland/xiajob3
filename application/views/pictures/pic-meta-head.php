<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />   
        <meta property="fb:app_id" content="<?= $app_id; ?>"/>
        <meta property="og:title" content="<?= $picture->pic_name; ?>" />
        <meta property="og:url" content="<?= $pic_url; ?>" />
        <meta property="og:image" content="<?= base_url().$picture->th_url; ?>" />   
        <meta property="og:description" content="<?= $picture->pic_comment; ?>"/>
        <meta property="og:site_name" content="florBooks" />               
        <link rel="stylesheet" href="<?= base_url(); ?>public/bootstrap/css/bootstrap.min.css" type="text/css" media="all" />
        
        <link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">       
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/jquery.fileupload-ui.css" type="text/css" media="all"/>
        
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/book.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/icon-color.css" type="text/css" media="all"/>
        
<link href='http://fonts.googleapis.com/css?family=Yesteryear|Grand+Hotel&subset=latin-ext' rel='stylesheet' type='text/css'>

        
     
        <title><?= $picture->pic_name; ?> florBooks</title>
        
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.7.2.min.js" ></script>  
        <script type="text/javascript" src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/book-tpl.js" ></script>
    </head>
    <body>
    <?php $this->load->view('common/analytics'); ?>