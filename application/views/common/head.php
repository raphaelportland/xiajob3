<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
        
        <!-- CSS -->
        <link rel="stylesheet" href="<?= base_url(); ?>public/bootstrap/css/bootstrap.min.css" type="text/css" media="all" />
        <link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">       
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/jquery.fileupload-ui.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/icon-color.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/private.css" type="text/css" media="all"/>
        
        
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/autosuggest_inquisitor.css" type="text/css" media="all"/>

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Yesteryear|Grand+Hotel&subset=latin-ext' rel='stylesheet' type='text/css'>
        
     
        <title>florBooks</title>
        
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.7.2.min.js" ></script>  
        <script type="text/javascript" src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js" ></script>
        
        <!-- autocomplete -->
        <script type="text/javascript" src="<?php echo base_url();?>public/js/bsn.AutoSuggest_2.1.3_comp.js" ></script>
        

        <script type="text/javascript" src="<?php echo base_url();?>public/js/registration.js" ></script>  
        <script type="text/javascript" src="<?php echo base_url();?>public/js/private.js" ></script>  
             
        <!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]--> 


    </head>
    <body>
    <?php $this->load->view('common/analytics'); ?>