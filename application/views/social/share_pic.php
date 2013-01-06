<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta property="fb:app_id" content="<?= $app_id; ?>"/>
        <meta property="og:title" content="<?= $picture->pic_name; ?>" />
        <meta property="og:url" content="<?= $pic_url; ?>" />
        <meta property="og:image" content="<?= base_url().$picture->pic_url; ?>" />   
        <meta property="og:description" content="<?= $picture->pic_comment; ?>"/>
        <meta property="og:site_name" content="florBooks" />           
    </head>
    <body>
        <img src='<?= base_url().$picture->pic_url; ?>' />
    </body>
</html>