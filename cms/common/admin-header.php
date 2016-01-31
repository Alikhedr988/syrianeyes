<!DOCTYPE html>
<?php include_once( '../../includes/initialize.php');?>
<script type="text/javascript" src="../../includes/tinymce/js/tinymce/tinymce.js"></script>

<script>
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width: 200,
        height: 200,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [{
            title: 'Bold text',
            inline: 'b'
        }, {
            title: 'Red text',
            inline: 'span',
            styles: {
                color: '#ff0000'
            }
        }, {
            title: 'Red header',
            block: 'h1',
            styles: {
                color: '#ff0000'
            }
        }, {
            title: 'Example 1',
            inline: 'span',
            classes: 'example1'
        }, {
            title: 'Example 2',
            inline: 'span',
            classes: 'example2'
        }, {
            title: 'Table styles'
        }, {
            title: 'Table row 1',
            selector: 'tr',
            classes: 'tablerow1'
        }]
    });
</script>



<html lang="en">

<head>



    <link href="../includes/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="../../Data/icon.jpg" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link rel="stylesheet" href="../../includes/bootstrap.css">
    <script type="text/javascript" src="../../includes/bootstrap.js"></script>
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <title>Syrian Eyes - CMS</title>
</head>



<body>

    <div class="container-fluid">
       <div class="cms-header row">
        <p class="c-panel col-md-3">Control Panel</p>
        <div class="img-circle col-md-1 col-md-offset-3 logo-container"></div>
           <p class="c-panel col-md-3 col-md-offset-2">Syrian Eyes</p>
        </div>

        <div class="row">