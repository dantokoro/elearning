<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Dabaki Elearning System</title>
        <link href="src/img/chmsc.png" rel="icon" type="image">
        <link href="src/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link href="src/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" media="screen">
        <link href="src/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="src/css/DT_bootstrap.css">
        <?php include('connect.php'); ?>
    </head>
    <script src="src/js/jquery.js" type="text/javascript"></script>
    <script src="src/js/bootstrap.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8" language="javascript" src="src/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="src/js/DT_bootstrap.js"></script>
    <script type='text/javascript' language='javascript' src='src/js/ndhui.js'></script>


    <!--slider -->
    <link rel="stylesheet" href="src/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="src/themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="src/themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="src/themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="src/css/nivo-slider.css" type="text/css" media="screen" /> 

    <script type="text/javascript" src="src/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
        });
    </script>