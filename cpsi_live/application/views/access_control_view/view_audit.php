<?php
$this->load->view("menu/top_menu");
$userrole = json_decode(json_encode($userrole), true); //for converting object to array
$get_names = get_last_name($default['sif']);
//echo "<pre>";
//print_r($get_names);
$formtype = $this->uri->segment(5);

if (!empty($formtype) && $formtype == "form"):
    $path = "access_control/nurse/nurse_manager";
else:
    $path = "search/student_search/find_student";
endif;

$formname_type = $this->uri->segment(4);
if (strpos($formname_type, 'appraisal') !== false) {
    $default['dob'] = date('m/d/Y', strtotime($default['dob']));
}
?>
<section class="page">
    <h1><?= $subtitle ?></h1>
    <div style="float: right">
        <form name="view_version" id="view_version" method="post" action="<?php echo base_url() . $path; ?>" >
            <input type="hidden" name="<?php echo ($userrole['name'] == "Nurse") ? "sif" : "sif"; ?>"
                   id="<?php echo ($userrole['name'] == "Nurse") ? "sif" : "sif"; ?>"
                   value ="<?php echo ($userrole['name'] == "Nurse") ? $default['sif'] : $default['sif']; ?>"  >
            <input type="submit" name='back' id='back' value='back' class="btn">
        </form>
    </div>
    <p><label> <b>SIF:</b></label> <?php echo $default['sif'] != '' ? $default['sif'] : 'N/A'; ?> </p>
    <p>&nbsp;</p>
    <p><label> <b>Name:</b></label> <?php echo $get_names['first_name'] != '' ? $get_names['first_name'] . " " . $get_names['last_name'] : 'N/A'; //echo $default['fname'] != '' ? $default['fname'] . " " . $default['lname'] : 'N/A';                                ?></p>
    <p>&nbsp;</p>
    <p><label> <b>DOB:</b></label> <?php echo $default['dob'] != '' ? str_replace("-", "/", $default['dob']) : 'N/A'; ?> </p>
    <p>&nbsp;</p>
    <p><label> <b>School:</b></label> <?php echo $default['school'] != '' ? $default['school'] : 'N/A'; ?></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <?= br(); ?>
    <div><?= $pagination; ?></div>
    <?= br(); ?>
    <?= $table; ?>
</section>

<style>
    .btn {
        background: #3498db;
        background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
        background-image: -moz-linear-gradient(top, #3498db, #2980b9);
        background-image: -ms-linear-gradient(top, #3498db, #2980b9);
        background-image: -o-linear-gradient(top, #3498db, #2980b9);
        background-image: linear-gradient(to bottom, #3498db, #2980b9);
        -webkit-border-radius: 34;
        -moz-border-radius: 34;
        border-radius: 34px;
        text-shadow: 1px 1px 3px #666666;
        font-family: Arial;
        color: #ffffff;
        font-size: 11px;
        padding: 7px 16px 7px 15px;
        border: solid #1f628d 1px;
        text-decoration: none;
    }

    .btn:hover {
        background: #3cb0fd;
        background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
        background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
        text-decoration: none;
    }
</style>
