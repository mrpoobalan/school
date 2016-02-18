<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php

//$title = "New Nursing Assessment - AAHD Nursing Assessment";

if (base_url("nurse_assessment/assessment/new_assessment")) {
	$title = "New Nursing Assessment - AAHD Nursing Assessment";
} elseif (base_url("health_appraisal/appraisal/wizard_01")) {
	$title = "New Health Appraisal - AAHD Nursing Assessment";
}

// <!-- Core CSS - Include with every page -->
$style = array (
		'href' => base_url ("assets/css/styles.css"),
		'rel' => 'stylesheet',
		'type' => 'text/css' 
);

$style_google = array (
		'href' => 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800',
		'rel' => 'stylesheet',
		'type' => 'text/css'
);

$jqueryui = array (
		'href' => base_url("assets/css/themes/smoothness/jquery-ui.css"),
		'rel' => 'stylesheet',
		'type' => 'text/css'
);



echo link_tag($style);
echo link_tag($style_google);
echo link_tag($jqueryui);

?>
<title><?= $title; ?></title>
<script src="<?= base_url("assets/js/jquery.min.js"); ?>"></script>
<script src="<?= base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script src="<?= base_url("assets/js/jquery-ui.js"); ?>"></script>
<!-- Form validator -->
<script src="<?= base_url("assets/js/jquery.validate.js"); ?>"></script>
<script src="<?= base_url("assets/js/additional-methods.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.sheepItPlugin.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datepic/jquery.datepick.css"> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepic/jquery.plugin.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepic/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/assessment.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/appraisal.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
</head>
<body class="draft" onload="readyFunction();">

	<div class="bluebg"></div>
		<div class="wrapper">
<!--
                    <script type="text/javascript">
                    
    function readyFunction() {
        //alert('cal');
        showva25($("#milestone:checked").val());
        showva75($("#complications:checked").val());
        showva76($("#emergencies:checked").val());
        showvalue26($("input[name='milestones[]']:checked").val());
        showval3($("input[name='vent_depend']:checked").val());
        showval4($("input[name='pt']:checked").val());
        showval5($("input[name='pos_plan']:checked").val());
        showval6($("input[name='restrictions']:checked").val());
        showval7($("input[name='asthma']:checked").val());
        showval8($("input[name='ed_last_year']:checked").val());
        showval9($("input[name='pe']:checked").val());
        showval($("input[name='missschool']:checked").val());
        showval2($("input[name='edasthma']:checked").val());
        showva20($("input[name='feeding_assist']:checked").val());
        showva21($("input[name='test_ind']:checked").val());
        showva22($("input[name='discrete']:checked").val());
        showva23($("input[name='bus_meds']:checked").val());
        showva24($("input[name='bus_mod']:checked").val());
        showvalue50($("input[name='bus_snacks']:checked").val());
        showvalue51($("input[name='release1']:checked").val());
        showvalue52($("input[name='sheepItForm1_release0']:checked").val());
        showvalue20($("input[name='bus_mod']:checked").val());
        showvalue19($("input[name='bus_meds']:checked").val());
        showvalue300($("input[name='peak']:checked").val());
        showvalue301($("input[name='oximetry']:checked").val());
        showvalue302($("input[name='co2']:checked").val());
        showvalue303($("input[name='scoliosis']:checked").val());
        showvalue304($('#orth:checkbox:checked').length);
        showvalue305($("input[name='orth']:checked").val());
        showvalue306($("input[name='diet']:checked").val());
        showvalue307($("input[name='tube_feedings_bolus']:checked").val());
        showvalue307($("input[name='tube_feedings_pump']:checked").val());
        showvalue308($("input[name='diet_special']:checked").val());
        showvalue309($("input[name='insulin_key']:checked").val());
        showvalue310($("input[name='seizure_plan1']:checked").val());
        showvalue311($("input[name='seizure_plan2']:checked").val());
        showvalue312($("input[name='seizure_plan3']:checked").val());
        showvalue313($("input[name='seizure_plan4']:checked").val());
        showvalue314($("input[name='seizure_plan5']:checked").val());
        showvalue315($("input[name='seizure_plan6']:checked").val());
        showvalue316($("input[name='seizure_plan7']:checked").val());

        // alert('fd');
    }
                    </script>             -->