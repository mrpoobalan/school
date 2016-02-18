<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="<?= base_url("assets/js/jquery.min.js"); ?>"></script>

        <?php
//$title = "New Nursing Assessment - AAHD Nursing Assessment";
        $title = "Administrator - AAHD Nursing Assessment";

// <!-- Core CSS - Include with every page -->
        $style = array(
            'href' => base_url("assets/css/styles.css"),
            'rel' => 'stylesheet',
            'type' => 'text/css'
        );

        $style_google = array(
            'href' => 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800',
            'rel' => 'stylesheet',
            'type' => 'text/css'
        );

        $jqueryui = array(
            'href' => base_url("assets/css/themes/smoothness/jquery-ui.css"),
            'rel' => 'stylesheet',
            'type' => 'text/css'
        );

        echo link_tag($style);
        echo link_tag($style_google);
        echo link_tag($jqueryui);
        ?>

        <title><?= $title; ?></title>

    </head><body class="draft">
        <div class="bluebg"></div>
        <div class="wrapper">



