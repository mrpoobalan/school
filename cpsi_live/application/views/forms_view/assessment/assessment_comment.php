<?php
// there are a couple of required fields for this view (under a comment object):
// 1. SIF number
// 2. Comment type {Rejection/Escalation}
// 3. Comment page title
// optionally, we allow the comment to be pre-loaded (ie: in case we need to support comment edits in the future)


$this->load->view("menu/top_menu");
$formAttributes = array('id' => "appraisal", 'class' => "commentform");
$sifHiddenField = array('name' => 'sif', 'type' => 'hidden', 'value' => $comment->sif);
$cidHiddenField = array('name' => 'cid', 'type' => 'hidden', 'value' => $comment->cid);
$modeHiddenField = array('name' => 'mode', 'type' => 'hidden', 'value' => $comment->mode);

$formSubmitButton = array('class' => 'styled-button-10', 'id' => 'appraisalComment', 'name' => 'appraisalComment', 'value' => 'Submit', 'type' => 'submit');

if (property_exists($comment, 'cid') == false)
{
    $comment->cid = "";
}
?>

<section class="page">
    <h1><?= $comment->Title ?></h1>
    <?php
//click to final page
    $sif = end(explode('_', $this->uri->segment(4)));
    $formtype = (explode('_', $this->uri->segment(4)));
    $formname = $formtype[0];

    $backbutton = $this->uri->segment(6);
//    echo $backbutton;
//    exit;
    $unique_number = $this->uri->segment(5);
    if (!empty($backbutton) && $formname == "assessment"):
        $back = anchor("nurse_assessment/assessment/final_step/" . $sif . "/" . $unique_number, "<button type='button' ' class='myButton' styel='text-decoration:none'>Back</button>");
    elseif(!empty($backbutton)):
        $back = anchor("health_appraisal/appraisal/complete_appraisal/" . $sif . "/" . $unique_number, "<button type='button' ' class='myButton' styel='text-decoration:none'>Back</button>");
    endif;
    ?>
    <?= form_open("{$comment->action}", $formAttributes); ?>

    <fieldset id="identification">
        <section>
            <textarea id="commentText" name="commentText" required="required"><?= !empty($comment->commentText) ? $comment->text : ''; ?></textarea>
        </section>
        <div class="savebuttons">
            <?= $back; ?>
            <?= form_submit($formSubmitButton); ?>
            <?= form_input($sifHiddenField); ?>
            <?= form_input($cidHiddenField); ?>
            <?= form_input($modeHiddenField); ?>
        </div>
        <div class="clear" />
    </fieldset>

    <?= form_close(); ?>
</section>

<style type="text/css"> 
    .styled-button-10 {
        background:#5CCD00;
        background:-moz-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
        background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#5CCD00),color-stop(100%,#4AA400));
        background:-webkit-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
        background:-o-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
        background:-ms-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
        background:linear-gradient(top,#5CCD00 0%,#4AA400 100%);
        /*filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#5CCD00', endColorstr='#4AA400',GradientType=0);*/
        padding:10px 15px;
        color:#fff;
        font-family:'Helvetica Neue',sans-serif;
        font-size:16px;
        border-radius:5px;
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border:1px solid #459A00
    }
    .myButton {
        -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
        -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
        box-shadow:inset 0px 1px 0px 0px #ffffff;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
        background:-moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background:-webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background:-o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background:-ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
        background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
        background-color:#f9f9f9;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        border:1px solid #dcdcdc;
        display:inline-block;
        cursor:pointer;
        color:#666666;
        font-family:Arial;
        font-size:15px;
        font-weight:bold;
        padding:6px 9px;
        text-decoration:none;
        text-shadow:0px 1px 0px #ffffff;
        max-width: 70px;
    }
    .myButton:hover {
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9));
        background:-moz-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
        background:-webkit-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
        background:-o-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
        background:-ms-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
        background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9',GradientType=0);
        background-color:#e9e9e9;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }


</style>