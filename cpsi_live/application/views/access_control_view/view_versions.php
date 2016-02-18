<?php // load top menu 
$userrole =  json_decode(json_encode($userrole),true); //for converting object to array
//echo '<pre>';
//print_r($userrole);
//print_r($default);
//exit;
 //Get first name and last name
 $get_names = get_last_name($default['sif']);
?>
<?php $this->load->view("menu/top_menu"); ?>

<section class="page">
    
    <h1><?= $subtitle ?></h1>
    <div style="float: right">
        <form name="view_version" id="view_version" method="post" action="<?php echo base_url(); ?>search/student_search/find_student" >
            <input type="hidden" name="<?php echo ($userrole['name'] == "Nurse") ? "sif" : "lastname"; ?>" 
               id="<?php echo ($userrole['name'] == "Nurse") ? "sif" : "lastname"; ?>" 
               value ="<?php echo ($userrole['name'] == "Nurse") ? $default['sif'] : $get_names['last_name'];?>"  >
        <input type="submit" name='back' id='back' value='back' class="label label-info">
    </form>
    </div>
    <p><label> <b>SIF:</b></label> <?php echo $default['sif'] != '' ? $default['sif'] : 'N/A'; ?> </p>
    <p>&nbsp;</p>
    <p><label> <b>Name:</b></label> <?php echo $get_names['first_name'] != '' ? $get_names['first_name'] . " " . $get_names['last_name'] : 'N/A'; ?></p>
    <p>&nbsp;</p>
    <p><label> <b>DOB:</b></label> <?php echo $default['dob'] != '' ? str_replace("-", "/", $default['dob']) : 'N/A'; ?> </p>
    <p>&nbsp;</p>
    <p><label> <b>School:</b></label> <?php echo $default['school'] != '' ? $default['school'] : 'N/A'; ?></p>
    <p>&nbsp;</p>
    <?= br(); ?>
    <div><?php echo $pagination; ?></div>
    <?= br(); ?>			
    <?= $table; ?>
</section>
