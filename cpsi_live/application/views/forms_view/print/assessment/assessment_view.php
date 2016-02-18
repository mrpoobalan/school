<style>
    #bgpaln{
        border-color: red;
        border-style: dotted;
        border-width: 2px;
        margin-left: -0px;
        padding: 10px 2px 0 15px;
    }
    .viewsh1 h1 {
        background: none repeat scroll 0 0 #f2f2f2;
        font-size: 13px !important;
        margin: 20px 0 !important;
        padding: 5px 10px;
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
    label{
        word-wrap: normal;
    }

</style>
<?php
// load dashboard admin menu
//echo "<pre>";
//print_r($wiz16);
//exit;

$this->load->view("menu/top_menu");
$next_button = array('id' => 'view_print_assessment', 'name' => 'view_print_assessment', 'class' => "button", 'value' => 'View Print Page', 'type' => 'submit', 'content' => 'View Print Page');
$attr_FormOpen = array('id' => "assessment", 'class' => "healthform");
foreach ($wiz16 as $key => $val) {
    if ($wiz16->$key == "1970_01_01" || $wiz16->$key == "1970-01-01" || $wiz16->$key == "01-01-1970") {
        $wiz16->$key = "";
    }
}
foreach ($wiz15 as $key => $val) {
    if ($wiz15->$key == "1970_01_01" || $wiz15->$key == "1970-01-01" || $wiz16->$key == "01-01-1970") {
        $wiz15->$key = "";
    }
}
foreach ($wiz14 as $key => $val) {
    if ($wiz14->$key == "1970_01_01" || $wiz14->$key == "1970-01-01" || $wiz14->$key == "01-01-1970") {
        $wiz14->$key = "";
    }
}
foreach ($wiz13 as $key => $val) {
    if ($wiz13->$key == "1970_01_01" || $wiz13->$key == "1970-01-01" || $wiz13->$key == "01-01-1970") {
        $wiz13->$key = "";
    }
}
foreach ($wiz12 as $key => $val) {
    if ($wiz12->$key == "1970_01_01" || $wiz12->$key == "1970-01-01" || $wiz12->$key == "01-01-1970") {
        $wiz12->$key = "";
    }
}
foreach ($wiz11 as $key => $val) {
    if ($wiz11->$key == "1970_01_01" || $wiz11->$key == "1970-01-01" || $wiz11->$key == "01-01-1970") {
        $wiz11->$key = "";
    }
}
foreach ($wiz10 as $key => $val) {
    if ($wiz10->$key == "1970_01_01" || $wiz10->$key == "1970-01-01" || $wiz10->$key == "01-01-1970") {
        $wiz10->$key = "";
    }
}
foreach ($wiz09 as $key => $val) {
    if ($wiz09->$key == "1970_01_01" || $wiz09->$key == "1970-01-01" || $wiz09->$key == "01-01-1970") {
        $wiz09->$key = "";
    }
}
foreach ($wiz08 as $key => $val) {
    if ($wiz08->$key == "1970_01_01" || $wiz08->$key == "1970-01-01" || $wiz08->$key == "01-01-1970") {
        $wiz08->$key = "";
    }
}
foreach ($wiz07 as $key => $val) {
    if ($wiz07->$key == "1970_01_01" || $wiz07->$key == "1970-01-01" || $wiz07->$key == "01-01-1970") {
        $wiz07->$key = "";
    }
}
foreach ($wiz06 as $key => $val) {
    if ($wiz06->$key == "1970_01_01" || $wiz06->$key == "1970-01-01" || $wiz06->$key == "01-01-1970") {
        $wiz06->$key = "";
    }
}
foreach ($wiz05 as $key => $val) {
    if ($wiz05->$key == "1970_01_01" || $wiz05->$key == "1970-01-01" || $wiz05->$key == "01-01-1970") {
        $wiz05->$key = "";
    }
}
foreach ($wiz04 as $key => $val) {
    if ($wiz04->$key == "1970_01_01" || $wiz04->$key == "1970-01-01" || $wiz04->$key == "01-01-1970") {
        $wiz04->$key = "";
    }
}
foreach ($wiz03 as $key => $val) {
    if ($wiz03->$key == "1970_01_01" || $wiz03->$key == "1970-01-01" || $wiz03->$key == "01-01-1970") {
        $wiz03->$key = "";
    }
}
foreach ($wiz02 as $key => $val) {
    if ($wiz02->$key == "1970_01_01" || $wiz02->$key == "1970-01-01" || $wiz02->$key == "01-01-1970") {
        $wiz02->$key = "";
    }
}
foreach ($wiz01 as $key => $val) {
    if ($wiz01->$key == "1970_01_01" || $wiz01->$key == "1970-01-01" || $wiz01->$key == "01-01-1970") {
        $wiz01->$key = "";
    }
}

function date_change($val) {
    $res = str_replace('_', '-', $val);
    return $res[0];
}

//$status = check_form_status($wiz01->sif);
if (empty($wiz01)):
    $url = $this->uri->segment(4);
    $url = explode('-', $url);
    $wiz01->sif = end(explode('_', $url[0]));
endif;
$status = check_form_status($wiz01->sif);
if (empty($status)):
    $status = check_form_status_firstrow($wiz01->sif);
endif;
//Get form Who has created
$form_created_by = check_created_assessment($wiz01->sif);
$name_details = get_fullname($form_created_by['wizard_by']);

$userrole = check_user_role($this->session->userdata('user_id'));

$userrole_decode = json_decode(json_encode($userrole), true);
$get_names = get_last_name_view($wiz01->sif);

$form = $this->uri->segment(5);
if (!empty($form) && $form == "form"):
    $path = "access_control/nurse/nurse_manager";
elseif (!empty($form) && $form == "review"):
    $path = "nurse_assessment/assessment/final_step/" . $wiz01->sif . "/" . $wiz01->unique_number;
else:
    $path = "search/student_search/find_student";
endif;
//echo
//if ($status['wizard_status'] == 45)
//{
//     $printval =  'style="background:url('.base_url().'assets/images/completed.png)"';
//}
?>

<body>
    <section class = "page healthform viewsh1" >
        <div class=" col-lg-12">
            <div style="float: right">
                <form name="view_version" id="view_version" method="post" action="<?php echo base_url() . $path; ?>" >
                    <input type="hidden" name="<?php echo ($userrole_decode['name'] == "Nurse") ? "sif" : "sif"; ?>"
                           id="<?php echo ($userrole_decode['name'] == "Nurse") ? "sif" : "sif"; ?>"
                           value ="<?php echo ($userrole_decode['name'] == "Nurse") ? $wiz01->sif : $wiz01->sif; ?>"  >
                    <input type="button" name='print' id='print' value='Print' class="myButton"
                           title="Print the Page" >&nbsp;&nbsp;
                    <input type="submit" name='back' id='back' value='back' class="myButton">
                </form>
            </div>
        </div>
        <br>
        <div id="print-logo">
        </div>
        <br>
        <br>
        <div class="row">
            <p><label>Date & Time:</label>
                <?php echo $status['wizard_modified'] != '' ? date('m/d/Y', strtotime($status['wizard_modified'])) : 'N/A' ?> </p>
            <p><label> Status:</label>
                <?php
                if (!empty($status['wizard_status'])) {
                    if ($status['wizard_status'] == 5):
                        echo "In Progress";
                    elseif ($status['wizard_status'] == 15):
                        echo "Pending";
                    elseif ($status['wizard_status'] == 25):
                        echo "Rejected";
                    elseif ($status['wizard_status'] == 35):
                        echo "Escalated";
                    elseif ($status['wizard_status'] == 45):
                        echo "Completed";
                    endif;
                }
                else {
                    echo "N/A";
                }
                ?>
            </p>
            <p><label>Submitted by:</label> <?php echo $name_details['first_name'] != '' || $name_details['last_name'] != '' ? $name_details['first_name'] . " " . $name_details['last_name'] : 'N/A' ?></p>

        </div>

        <div class="assessmentActions"><?php echo $assessment_actions ?></div>

        <div id="bg-text">
            <div class="first-divs">

                <div class="section-div">
                    <?php if (!empty($staus_comments)): ?>
                        <label> Nursing Assessment </label>
                        <?php if ($status['wizard_status'] <> 45): ?>
                            <label>Assessment Comments</label>
                            <p> <?php echo $staus_comments != '' ? $staus_comments : 'N/A'; ?></p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="divclearboth"></div>
                    <br/>
                </div>


                <div class="section-div">
                    <?php if (empty($staus_comments)): ?>
                        <label> Nursing Assessment </label>
                    <?php endif; ?>
                    <label>ID</label>
                    <p class="leftadjust"><label>SIF Number:</label> <?php echo $wiz01->sif != '' ? $wiz01->sif : 'N/A'; ?></p>
                    <p class="rightadjust"> <label> State Number:</label> <?php echo $wiz01->statenum != '' ? $wiz01->statenum : 'N/A'; ?></p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <?php
                    if ($wiz01->schoolID == 3) :
                        $wiz01->schoolID = 'Elementary School';
                    elseif ($wiz01->schoolID == 4) :
                        $wiz01->schoolID = 'Middle School';
                    elseif ($wiz01->schoolID == 5) :
                        $wiz01->schoolID = 'High School';
                    elseif ($wiz01->schoolID == 6) :
                        $wiz01->schoolID = 'Charter/ Contract School';
                    elseif ($wiz01->schoolID == 7) :
                        $wiz01->schoolID = 'Other Educational Centers';
                    endif;
                    ?>
                    <?php
                    $dob_date = str_replace("-", "/", $wiz01->dob);
                    ?>
                    <label>Student Information</label>
                    <p class="leftadjust"><label>First Name:</label> <?php echo $wiz01->fname != '' ? $wiz01->fname : 'N/A' ?></p>
                    <p class="rightadjust"><label>Last Name:</label> <?php echo $wiz01->lname != '' ? $wiz01->lname : 'N/A'; ?></p>
                    <p  class="leftadjust"><label>Nickname:</label> <?php echo $wiz01->nickname != '' ? $wiz01->nickname : 'N/A'; ?></p>
                    <p class="rightadjust"><label>Date of Birth:</label> <?php echo $wiz01->dob != '' ? $dob_date : 'N/A'; ?></p>
                    <p  class="leftadjust"><label>School Type:</label> <?php echo $wiz01->schoolID != '' ? $wiz01->schoolID : 'N/A'; ?></p>
                    <p class="rightadjust" id='bgplan'><label>School:</label> <?php echo $wiz01->school != '' ? $wiz01->school : 'N/A'; ?></p>
                    <div class="divclearboth"></div>
                </div>

                <div class="section-div">
                    <label>Parent/Guardian Information</label>
                    <p class="leftadjust"><label>Parent(s)/Guardian(s):</label> <?php echo $wiz01->parentname != '' ? $wiz01->parentname : 'N/A'; ?></p>
                    <p class="rightadjust"><label >Address:</label> <?php echo ($wiz01->street != '' || $wiz01->city != '' || $wiz01->zip != '') ? $wiz01->street . ",<br>" . $wiz01->city . ",<br>" . $wiz01->zip : 'N/A'; ?>
                    <p class="leftadjust"><label>Home Phone Number:</label> <?php echo $wiz01->homephone != '' ? $wiz01->homephone : 'N/A'; ?></p>
                    <p class="rightadjust"><label>Cell Phone Number:</label> <?php echo $wiz01->cellphone != '' ? $wiz01->cellphone : 'N/A'; ?></p>
                    <p class="leftadjust"><label>Work Phone Number:</label> <?php echo $wiz01->workphone != '' ? $wiz01->workphone : 'N/A'; ?></p>
                    <div class="divclearboth"></div>
                </div>

                <?php
                foreach ($wiz01->addtnlcontact as $key => $agencies):

                    if ($key > 0):
                        if ($wiz01->addtnlcontact[$key] == '' && $wiz01->relationship[$key] == '' && $wiz01->addtnlcellphone[$key] == '' && $wiz01->addtnlhomephone[$key] == ''):
                            continue;
                        endif;
                    endif;
                    ?>
                    <div class="section-div">
                        <label>Additional Contact<?php echo $key + 1; ?></label>
                        <!--                        <h1>Additional Contact </h1>-->
                        <p class="leftadjust"><label>Additional Contact :</label> <?php echo $wiz01->addtnlcontact[$key] == '' ? 'N/A' : $wiz01->addtnlcontact[$key]; ?></p>
                        <p class="rightadjust"><label>Relationship :</label> <?php echo $wiz01->relationship[$key] == '' ? 'N/A' : $wiz01->relationship[$key]; ?></p>
                        <p class="leftadjust"><label>Cell Phone Number:</label> <?php echo $wiz01->addtnlcellphone[$key] == '' ? 'N/A' : $wiz01->addtnlcellphone[$key]; ?></p>
                        <p class="rightadjust"><label>Home Phone Number:</label> <?php echo $wiz01->addtnlhomephone[$key] == '' ? 'N/A' : $wiz01->addtnlhomephone[$key]; ?></p>
                        <p class="leftadjust"><label>Work Phone Number:</label> <?php echo $wiz01->addtnlworkphone[$key] == '' ? 'N/A' : $wiz01->addtnlworkphone[$key]; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endforeach; ?>

                <div class="section-div">
                    <label>Insurance</label>
                    <p class="leftadjust"><label> Private:</label> <?php echo $wiz01->private != '' ? $wiz01->private : 'N/A'; ?> </p>
                    <p class="rightadjust"><label> MCHP:</label> <?php echo $wiz01->mchp != '' ? $wiz01->mchp : 'N/A'; ?></p>
                    <p class="leftadjust" ><label> None :</label> <?php echo $wiz01->none != '' ? $wiz01->none : 'N/A'; ?></p>
                    <p class="rightadjust"><label> Medicaid:</label> <?php echo $wiz01->medicaid != '' ? $wiz01->medicaid : 'N/A'; ?> </p>
                    <p class="leftadjust"><label> Other:</label> <?php echo $wiz01->other != '' ? 'yes' : 'N/A'; ?></p>
                    <p class="rightadjust"><label>Other Insure:</label> <?= $wiz01->none_text == '' ? 'N/A' : $wiz01->none_text ?> </p>
                    <p class="leftadjust"><label>Preferred Hospital: </label><?php echo $wiz01->preferred_hospital != '' ? $wiz01->preferred_hospital : 'N/A'; ?></p>
                    <p class="rightadjust" <?php if ($wiz01->dnrorder != ''): ?> id="bgpaln" <?php endif; ?>> <label>Is there a DNR Order: </label><?php echo $wiz01->dnrorder != '' ? $wiz01->dnrorder : 'N/A'; ?></p>

                    <p class="leftadjust" ><label>The School team has developed a plan: </label><?php echo $wiz01->preferred_hospital != '' && $wiz01->schoolplan != '' ? $wiz01->schoolplan : 'N/A'; ?></p>

                    <p class="rightadjust"><label>Immunization Current?</label> <?php echo $wiz01->immunization != '' ? 'yes' : 'N/A' ?></p>
                    <p class="leftadjust"><label>Immunocompromised</label> <?php echo $wiz01->immunocompromised != '' ? $wiz01->immunocompromised : 'N/A' ?></p>
                    <p class="rightadjust"><label>Religious Exemption:</label> <?php echo $wiz01->religious != '' ? $wiz01->religious : 'N/A'; ?> </p>
                    <p class="leftadjust"><label>Medical Exemption:</label> <?php echo $wiz01->medical == '' ? 'N/A' : $wiz01->medical; ?></p>
                    <p class="rightadjust"><label>Medical reason :</label> <?php echo $wiz01->medical_reason == '' ? 'N/A' : $wiz01->medical_reason; ?></p>
                    <?php
//$obj['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $obj['dob'])));
                    $date = explode(",", $wiz01->contactattempt1);
                    foreach ($date as $val) {
                        $res = explode("-", $val);
                        $resval = $resval . $res[1] . "/" . $res[2] . "/" . $res[0] . " ";
                    }
                    if ($wiz01->contactattempt1 == "1970-01-01"):
                        $wiz01->contactattempt1 = "";
                    endif;
                    ?>
                    <p class="leftadjust"><label>Contact Attempts</label><?php echo $wiz01->contactattempt1 == '' ? 'N/A' : $resval; ?></p>
                    <div class="divclearboth"></div>
                </div>
                <?php if (isset($wiz02)) : ?>
                    <div class="section-div">
                        <label>Assessment Information</label>
                        <p class="leftadjust"><label>Type of Assessment:</label> <?php echo $wiz02->assessment == '' ? 'N/A' : $wiz02->assessment; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <label>Medical Diagnosis:</label>
                        <p class="leftadjust"><label>Details :</label> <?php echo $wiz02->diagnosis1 == '' ? 'N/A' : $wiz02->diagnosis1; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <!--<h1>Background</h1>-->
                        <label>Background:</label>
                        <p class="leftadjust"><label>Birth Weight: </label> <?php echo $wiz02->birthweight == '' ? 'N/A' : $wiz02->birthweight; ?></p>
                        <p class="rightadjust"><label>Gestation: </label> <?php echo $wiz02->gestation == '' ? 'N/A' : $wiz02->gestation; ?></p>
                        <p class="leftadjust"><label>Birth Type: </label> <?php echo $wiz02->birthtype == '' ? 'N/A' : $wiz02->birthtype ?></p>
                        <p class="rightadjust" ><label>Developmental Milestones Met:</label><?php echo $wiz02->milestone == '' ? 'N/A' : $wiz02->milestone ?></p>
                        <p class="leftadjust"><label>If Milestones, please describe:</label> <?php echo $wiz02->describe_milestones == '' || $wiz02->milestone == 'yes' ? 'N/A' : $wiz02->describe_milestones; ?></p>
                        <p class="rightadjust"><label>Complications:</label> <?php echo $wiz02->complications == '' ? 'N/A' : $wiz02->complications; ?></p>
                        <p class="leftadjust"><label>If yes Complications , please describe:</label> <?php echo $wiz02->describe_complications == '' || $wiz02->complications == 'no' ? 'N/A' : $wiz02->describe_complications; ?></p>
                        <p class="rightadjust"><label>Emergencies, Hospitalizations, or Surgeries:</label> <?php echo $wiz02->emergencies == '' ? 'N/A' : $wiz02->emergencies; ?></p>
                        <p class="leftadjust"><label>If yes Emergencies, please describe:</label> <?php echo $wiz02->describe_emergencies == '' || $wiz02->emergencies == 'no' ? 'N/A' : $wiz02->describe_emergencies; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <label>History of Diagnosis/Current Health Status</label>
                        <p class="leftadjust"><label>See Previous Nursing Assessment Dated:</label><?php echo $wiz02->previousdate == '' ? 'N/A' : $wiz02->previousdate ?></p>
                        <p class="rightadjust"><label>Narrative:</label> <?php echo $wiz02->narrative == '' ? 'N/A' : $wiz02->narrative ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <div class="section-div">
                    <label>Physicians</label>
                    <p class="leftadjust"><label>Primary Care:</label> <?php echo $wiz03->primary == '' ? 'N/A' : $wiz03->primary ?></p>
                    <p class="rightadjust"><label>Last Exam:</label> <?php echo $wiz03->lastexam1 == '' ? 'N/A' : $wiz03->lastexam1; ?></p>
                    <p class="leftadjust"><label>Next Exam:</label> <?php echo $wiz03->nextexam1 == '' ? 'N/A' : $wiz03->nextexam1 ?></p>
                    <p class="rightadjust"><label>Phone:</label> <?php echo $wiz03->phone1 == '' ? 'N/A' : $wiz03->phone1 ?></p>
                    <p class="leftadjust"><label>Fax:</label> <?php echo $wiz03->fax1 == '' ? 'N/A' : $wiz03->fax1 ?></p>
                    <p class="rightadjust"><label>Release:</label> <?php echo $wiz03->release1 == '' ? 'N/A' : $wiz03->release1; ?></p>
                    <p class="leftadjust"><label>list or explain:</label> <?= $wiz03->describe_release1 == '' || $wiz03->release1 <> 'yes' ? 'N/A' : $wiz03->describe_release1 ?> </p>
                    <p class="leftadjust"><label>Release Expiration:</label> <?php echo $wiz03->release_exp1 == '' ? 'N/A' : $wiz03->release_exp1 ?></p>
                    <div class="divclearboth"></div>
                </div>


                <?php
                foreach ($wiz03->specialist1 as $key => $specialists):

                    if ($key > 0):
                        if ($wiz03->specialist1[$key] == '' && $wiz03->lastexam2[$key] == '' && $wiz03->nextexam2[$key] == '' && $wiz03->phone2[$key] == '' && $wiz03->fax2[$key] == '' && $wiz03->release2[$key] == '' && $wiz03->release_exp2[$key] == ''):
                            continue;
                        endif;
                    endif;
                    ?>
                    <div class="section-div">
                        <label>Specialist Information <?php echo $key + 1; ?></label>
                        <p class="leftadjust"><label>Specialist Name:</label> <?php echo $wiz03->specialist1[$key] == '' ? 'N/A' : $wiz03->specialist1[$key]; ?></p>
                        <p class="rightadjust"><label>Type of Physician:</label> <?php echo $wiz03->type1[$key] == '' ? 'N/A' : $wiz03->type1[$key]; ?></p>
                        <p class="leftadjust"><label>Last Exam:</label> <?php echo $wiz03->lastexam2[$key] == '' ? 'N/A' : $wiz03->lastexam2[$key]; ?></p>
                        <p class="rightadjust"><label>Next Exam:</label> <?php echo $wiz03->nextexam2[$key] == '' ? 'N/A' : $wiz03->nextexam2[$key]; ?></p>
                        <p class="leftadjust"><label>Phone:</label> <?php echo $wiz03->phone2[$key] == '' ? 'N/A' : $wiz03->phone2[$key]; ?></p>
                        <p class="rightadjust"><label>Fax:</label> <?php echo $wiz03->fax2[$key] == '' ? 'N/A' : $wiz03->fax2[$key]; ?></p>
                        <p class="leftadjust"><label>Specialist Release:</label> <?php echo $wiz03->release2[$key] == '' ? 'N/A' : $wiz03->release2[$key]; ?></p>
                        <p class="rightadjust"><label>list or explain:</label> <?php echo $wiz03->describe_sheepItForm[$key] == '' ? 'N/A' : $wiz03->describe_sheepItForm[$key]; ?></p>
                        <p class="leftadjust"><label>Release Expiration:</label> <?php echo $wiz03->release_exp2[$key] == '' ? 'N/A' : $wiz03->release_exp2[$key]; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($wiz03->hide1)): ?>
                    <div class="section-div">
                        <label>Dentist, Hearing, and Vision</label>
                        <p class="leftadjust"><label>Dentist:</label> <?= $wiz03->dentist == '' ? 'N/A' : $wiz03->dentist ?> </p>
                        <p class="rightadjust"><label>Dental exam:</label> <?= $wiz03->dentalexam == '' ? 'N/A' : $wiz03->dentalexam ?> </p>
                        <p class="leftadjust"><label>Dental history:</label> <?= $wiz03->dentalhistory == '' ? 'N/A' : $wiz03->dentalhistory ?> </p>
                        <p class="rightadjust"><label>Consent for Record Release:</label> <?= $wiz03->dentalrelease[0] == '' ? 'No' : 'Yes' ?> </p>
                        <p class="leftadjust"><label>Hearing:</label> <?= $wiz03->hearing == '' ? 'N/A' : $wiz03->hearing ?> </p>
                        <p class="rightadjust"><label>Hearing exam:</label> <?= $wiz03->hearingexam == '' ? 'N/A' : $wiz03->hearingexam ?> </p>
                        <p class="leftadjust"><label>Hearing history:</label> <?= $wiz03->hearinghistory == '' ? 'N/A' : $wiz03->hearinghistory ?> </p>
                        <p class="rightadjust"><label>Consent for Record Release:</label> <?= $wiz03->hearingrelease[0] == '' ? 'No' : 'Yes' ?> </p>
                        <p class="leftadjust"><label>Vision:</label> <?= $wiz03->vision == '' ? 'N/A' : $wiz03->vision ?> </p>
                        <p class="rightadjust"><label>Vision exam:</label> <?= $wiz03->visionexam == '' ? 'N/A' : $wiz03->visionexam ?> </p>
                        <p class="leftadjust"><label>vision history:</label> <?= $wiz03->visionhistory == '' ? 'N/A' : $wiz03->visionhistory ?> </p>
                        <p class="rightadjust"><label>Consent for Record Release:</label> <?= $wiz03->visionrelease[0] == '' ? 'No' : 'Yes' ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>

                <?php
                if (empty($wiz03->hide2)):
                    foreach ($wiz03->name1 as $key => $agencies):

                        if ($key > 0):
                            if ($wiz03->name1[$key] == '' && $wiz03->agencyphone1[$key] == '' && $wiz03->agencyfax1[$key] == '' && $wiz03->agencyrelease1[$key] == ''):
                                continue;
                            endif;
                        endif;
                        ?>
                        <div class="section-div">
                            <label>Agencies and Case Managers <?php echo $key + 1; ?></label>
                            <p class="leftadjust"><label>Name:</label> <?php echo $wiz03->name1[$key] == '' ? 'N/A' : $wiz03->name1[$key]; ?></p>
                            <p class="rightadjust"><label>Agency Name:</label> <?= $wiz03->agname1[$key] == '' ? 'N/A' : $wiz03->agname1[$key]; ?> </p>
                            <p class="leftadjust"><label>Case Manager:</label> <?= $wiz03->cashman1[$key] == '' ? 'N/A' : $wiz03->cashman1[$key]; ?> </p>
                            <p class="rightadjust"><label>Contact Info:</label> <?php echo $wiz03->agencyphone1[$key] == '' ? 'N/A' : $wiz03->agencyphone1[$key]; ?></p>
                            <p class="leftadjust"><label>Release:</label> <?php echo $wiz03->agencyrelease1[$key] == '' ? 'N/A' : $wiz03->agencyrelease1[$key]; ?></p>
                            <div class="divclearboth"></div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>


                <?php
                if (empty($wiz04->hide3)):
                    foreach ($wiz04->med1 as $key => $Medications):
                        if ($key > 0):
                            if ($wiz04->med1[$key] == '' && $wiz04->dose1[$key] == '' && $wiz04->time1[$key] == '' && $wiz04->route1[$key] == '' && $wiz04->taken1_school[$key] == '' && $wiz04->taken1_home[$key] == ''):
                                continue;
                            endif;
                        endif;
                        ?>
                        <div class="section-div">
                            <label>Daily Medications <?php echo $key + 1; ?></label>

                            <p class="leftadjust"><label>Medication Name:</label> <?php echo $wiz04->med1[$key] == '' ? 'N/A' : $wiz04->med1[$key]; ?></p>
                            <p class="rightadjust"><label>Dosage:</label> <?php echo $wiz04->dose1[$key] == '' ? 'N/A' : $wiz04->dose1[$key]; ?></p>
                            <p class="leftadjust"><label>Time/Frequency:</label> <?php echo $wiz04->time1[$key] == '' ? 'N/A' : $wiz04->time1[$key]; ?></p>
                            <p class="rightadjust"><label>Route:</label> <?php echo $wiz04->route1[$key] == '' ? 'N/A' : $wiz04->route1[$key]; ?></p>
                            <p class="leftadjust"><label>Taken at School:</label> <?php echo $wiz04->taken1_school[$key] == '' ? 'N/A' : $wiz04->taken1_school[$key]; ?></p>
                            <p class="rightadjust"><label>Taken at Home:</label> <?php echo $wiz04->taken1_home[$key] == '' ? 'N/A' : $wiz04->taken1_home[$key]; ?></p>
                            <div class="divclearboth"></div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>

                <?php
                if (empty($wiz04->hide4)):
                    foreach ($wiz04->prnmed1 as $key => $prnMedications):

                        if ($key > 0):
                            if ($wiz04->prnmed1[$key] == '' && $wiz04->prndose1[$key] == '' && $wiz04->prntime1[$key] == '' && $wiz04->prnroute1[$key] == '' && $wiz04->prntaken1_school[$key] == '' && $wiz04->prntaken1_home[$key] == '' && $wiz04->prntaken1_emergency[$key] == ''):
                                continue;
                            endif;
                        endif;
                        ?>
                        <div class="section-div">
                            <label>PRN Medications <?php echo $key + 1; ?></label>

                            <p class="leftadjust"><label>Medication Name:</label> <?php echo $wiz04->prnmed1[$key] == '' ? 'N/A' : $wiz04->prnmed1[$key]; ?></p>
                            <p class="rightadjust"><label>Dosage:</label> <?php echo $wiz04->prndose1[$key] == '' ? 'N/A' : $wiz04->prndose1[$key]; ?></p>
                            <p class="leftadjust"><label>Time/Frequency:</label> <?php echo $wiz04->prntime1[$key] == '' ? 'N/A' : $wiz04->prntime1[$key]; ?></p>
                            <p class="rightadjust"><label>Route:</label> <?php echo $wiz04->prnroute1[$key] == '' ? 'N/A' : $wiz04->prnroute1[$key]; ?></p>
                            <p class="leftadjust"><label>Taken at School:</label> <?php echo $wiz04->prntaken1_school[$key] == '' ? 'N/A' : $wiz04->prntaken1_school[$key]; ?></p>
                            <p class="rightadjust"><label>Taken at Home:</label> <?php echo $wiz04->prntaken1_home[$key] == '' ? 'N/A' : $wiz04->prntaken1_home[$key]; ?></p>
                            <p class="leftadjust"><label>Taken In Emergency:</label> <?php echo $wiz04->prntaken1_emergency[$key] == '' ? 'N/A' : $wiz04->prntaken1_emergency[$key]; ?></p>

                            <div class="divclearboth"></div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>

                <?php
                if (empty($wiz05->hide502)):

                    foreach ($wiz05->treatment1 as $key => $prnMedications):

                        if ($key > 0):
                            if ($wiz05->treatment1[$key] == ''):
                                continue;
                            endif;
                        endif;
                        ?>
                        <div class="section-div">
                            <label>Treatments <?php echo $key + 1;
                        ?></label>

                            <p class="leftadjust"><label>Treatment Order:</label> <?php echo $wiz05->treatment1[$key] == '' ? 'N/A' : $wiz05->treatment1[$key]; ?></p>
                            <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz05->frequency1[$key] == '' ? 'N/A' : $wiz05->frequency1[$key]; ?></p>
                            <!--<label>Peformed</label>-->
                            <p class="leftadjust"><label>Performed:</label> <?php echo $wiz05->performed_school1[$key] == 'no' ? 'At Home' : 'At School'; ?></p>
                            <p class="rightadjust"><label>Person Performing:</label> <?php echo $wiz05->person1[$key] == '' ? 'N/A' : $wiz05->person1[$key]; ?></p>
                            <div class="divclearboth"></div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
                <?php
                if (empty($wiz05->hide6)):
                    foreach ($wiz05->allergy1 as $key => $prnMedications):

                        if ($key > 0):
                            if ($wiz05->allergy1[$key] == '' && $wiz05->reaction1[$key] == '' && $wiz05->deadly1[$key] == '' && $wiz05->sensitivity1_touch[$key] == '' && $wiz05->sensitivity1_ingest[$key] == '' && $wiz05->sensitivity1_air[$key] == '' && $wiz05->treatment1_epi[$key] == '' && $wiz05->treatment1_antihistamine[$key] == '' && $wiz05->ah1[$key] == '' && $wiz05->diagnosed1[$key] == '' && $wiz05->lastevent1[$key] == '' && $wiz05->addtnlcomments1[$key] == ''):
                                continue;
                            endif;
                        endif;
                        ?>
                        <div class="section-div">
                            <label>Allergies <?php echo $key + 1; ?></label>

                            <p class="leftadjust"><label>Allergic to:</label> <?php echo $wiz05->allergy1[$key] == '' ? 'N/A' : $wiz05->allergy1[$key]; ?></p>
                            <p class="rightadjust"><label>Reaction:</label> <?php echo $wiz05->reaction1[$key] == '' ? 'N/A' : $wiz05->reaction1[$key]; ?></p>
                            <p class="leftadjust"><label>Touch/Contact:</label> <?php echo $wiz05->sensitivity1_touch[$key] == '' ? 'N/A' : $wiz05->sensitivity1_touch[$key]; ?></p>
                            <p class="rightadjust"><label>Ingestion:</label> <?php echo $wiz05->sensitivity1_ingest[$key] == '' ? 'N/A' : $wiz05->sensitivity1_ingest[$key]; ?></p>
                            <p class="leftadjust"><label>Air:</label> <?php echo $wiz05->sensitivity1_air[$key] == '' ? 'N/A' : $wiz05->sensitivity1_air[$key]; ?></p>
                            <p class="rightadjust"><label>Sting/Bite:</label> <?php echo $wiz05->sensitivity1_sting[$key] == '' ? 'N/A' : $wiz05->sensitivity1_sting[$key]; ?></p>
                            <p class="leftadjust"><label>Epinephrine Auto-Injection:</label> <?php echo $wiz05->treatment1_epi[$key] == '' ? 'N/A' : $wiz05->treatment1_epi[$key]; ?></p>
                            <p class="rightadjust"><label>Antihistamine:</label> <?php echo $wiz05->treatment1_antihistamine[$key] == '' ? 'N/A' : $wiz05->treatment1_antihistamine[$key]; ?></p>
                            <p class="leftadjust" id="bgplan"><label>How was the allergy diagnosed?</label> <?php echo $wiz05->diagnosed1[$key] == '' ? 'N/A' : $wiz05->diagnosed1[$key]; ?></p>

                            <p class="rightadjust"><label>Last Event:</label> <?php echo $wiz05->lastevent1[$key] == '' ? 'N/A' : $wiz05->lastevent1[$key]; ?></p>
                            <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz05->addtnlcomments1[$key]) == '' ? 'N/A' : $wiz05->addtnlcomments1[$key]; ?></p>
                            <div class="divclearboth"></div>
                        </div>
                        <?php
                    endforeach;
                endif;
                if (empty($wiz06->hide7)):
                    ?>
                    <div class="section-div">
                        <label>Communication/Vision/Hearing Requirements</label>

                        <h1>Select Requirement Type</h1>

                        <p class="leftadjust"><label>Verbal:</label> <?php echo $wiz06->need_type_verbal == '' ? 'N/A' : $wiz06->need_type_verbal; ?></p>
                        <p class="rightadjust"><label >Non-verbal:</label> <?php echo $wiz06->need_type_nonverbal == '' ? 'N/A' : $wiz06->need_type_nonverbal; ?> </p>
                        <p class="leftadjust"><label>Speech/Language Needs:</label> <?php echo $wiz06->need_type_speech == '' ? 'N/A' : $wiz06->need_type_speech; ?> </p>
                        <p class="rightadjust"><label>Audiology Needs:</label> <?php echo $wiz06->need_type_audiology == '' ? 'N/A' : $wiz06->need_type_audiology; ?> </p>
                        <p class="leftadjust"><label>Vision Needs:</label> <?php echo $wiz06->need_type_vision == '' ? 'N/A' : $wiz06->need_type_vision; ?> </p>
                        <p class="rightadjust"><label>Signs/Gestures:</label> <?php echo $wiz06->need_type_signs == '' ? 'N/A' : $wiz06->need_type_signs; ?> </p>
                        <p class="leftadjust"><label>Expressions:</label> <?php echo $wiz06->need_type_expressions == '' ? 'N/A' : $wiz06->need_type_expressions; ?> </p>
                        <p class="rightadjust"><label>Cries/Smiles:</label> <?php echo $wiz06->need_type_cries == '' ? 'N/A' : $wiz06->need_type_cries; ?> </p>
                        <p class="leftadjust"><label>Pictures:</label> <?php echo $wiz06->need_type_pictures == '' ? 'N/A' : $wiz06->need_type_pictures; ?> </p>
                        <p class="rightadjust"><label>No Communication:</label> <?php echo $wiz06->need_type_nocommunication == '' ? 'N/A' : $wiz06->need_type_nocommunication ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <label>Assistive Communication Devices</label>

                        <p class="leftadjust"><label>Assistive Communication Devices:</label> <?php echo $wiz06->devices == '' ? 'N/A' : $wiz06->devices ?></p>
                        <p class="rightadjust"><label>Assistive Communication Device Description:</label> <?php echo $wiz06->device_describe == '' ? 'N/A' : $wiz06->device_describe; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Device(s) Used</h1>
                        <p class="leftadjust"><label>Wears Glasses:</label> <?php echo $wiz06->devicelist_glasses == '' ? 'N/A' : $wiz06->devicelist_glasses ?></p>
                        <p class="rightadjust"><label>Wears Hearing Aid:</label> <?php echo $wiz06->devicelist_hearingaid == '' ? 'N/A' : $wiz06->devicelist_hearingaid ?></p>
                        <p class="leftadjust"><label>Cochlear Implant:</label> <?php echo $wiz06->devicelist_cochlear == '' ? 'N/A' : $wiz06->devicelist_cochlear ?></p>
                        <p class="rightadjust"><label>FM System:</label> <?php echo $wiz06->devicelist_fm == '' ? 'N/A' : $wiz06->devicelist_fm ?></p>

                        <p class="leftadjust"><label>Last Hearing Screening:</label> <?php echo $wiz06->hearing_screening == '' ? 'N/A' : $wiz06->hearing_screening ?></p>
                        <p class="rightadjust"><label>Last Vision Screening:</label> <?php echo $wiz06->vision_screening == '' ? 'N/A' : $wiz06->vision_screening ?> </p>
                        <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz06->communication_comments) == '' ? 'N/A' : $wiz06->communication_comments ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz06->hide8)): ?>

                    <div class="section-div">

                        <label>Neurological Requirements</label>

                        <p class="leftadjust"><label>Seizures Disorder:</label> <?php echo $wiz06->seizures == '' ? 'N/A' : $wiz06->seizures ?></p>
                        <p class="rightadjust"><label>Seizure Description:</label> <?php echo $wiz06->seizure_type == '' || $wiz06->seizures == '' ? 'N/A' : $wiz06->seizure_type ?></p>
                        <p class="leftadjust"><label>Last Exam:</label> <?php echo $wiz06->last_seizure_exam == '' ? 'N/A' : $wiz06->last_seizure_exam ?> </p>
                        <p class="rightadjust"><label>Age of Onset:</label> <?php echo $wiz06->onset_age == '' ? 'N/A' : $wiz06->onset_age ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <p class="leftadjust"><label>Date of Last Seizure:</label>  <?php echo $wiz06->last_seizure == '' ? 'N/A' : $wiz06->last_seizure; ?></p>
                        <p class="rightadjust"><label>Usual Duration:</label> <?php echo $wiz06->usual_duration == '' ? 'N/A' : $wiz06->usual_duration ?></p>
                        <p class="leftadjust"><label>Frequency of Seizures:</label> <?php echo $wiz06->seizure_frequency == '' ? 'N/A' : $wiz06->seizure_frequency ?> </p>
                        <p class="rightadjust"><label>Hx of Status Epilecticus:</label> <?php echo $wiz06->status_epilecticus == '' ? 'N/A' : $wiz06->status_epilecticus ?></p>
                        <p class="leftadjust"><label>Triggers:</label> <?php echo $wiz06->triggers == '' ? 'N/A' : $wiz06->triggers ?></p>
                        <p class="rightadjust"><label>Ketogenic Diet:</label> <?php echo $wiz06->ketogenic == '' ? 'N/A' : $wiz06->ketogenic ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <label>Treatment</label>
                        <p class="leftadjust"><label>Diastat:</label> <?php echo $wiz06->treatment_diastat == '' ? 'N/A' : $wiz06->treatment_diastat ?></p>
                        <p class="rightadjust"><label>Oxygen:</label> <?php echo $wiz06->treatment_oxygen == '' ? 'N/A' : $wiz06->treatment_oxygen ?></p>
                        <p class="leftadjust"><label>Vagal Nerve Stimulator:</label> <?php echo $wiz06->treatment_vagal == '' ? 'N/A' : $wiz06->treatment_vagal ?></p>
                        <p class="rightadjust"><label>Medication (see medication list):</label> <?php echo $wiz06->treatment_medication == '' ? 'N/A' : $wiz06->treatment_medication ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Post Seizure Activity</h1>
                        <p class="leftadjust"><label>Post Seizure Activity:</label> <?php echo $wiz06->post_seizure == '' ? 'N/A' : $wiz06->post_seizure ?></p><div class="divclearboth"></div>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Shunt</h1>
                        <p class="leftadjust"><label>Shunt:</label> <?php echo $wiz06->shunt == '' ? 'N/A' : $wiz06->shunt ?></p>
                        <p class="rightadjust"><label>Shunt Type:</label> <?php echo trim($wiz06->shunt_type) == '' ? 'N/A' : $wiz06->shunt_type; ?></p>
                        <p class="leftadjust"><label>Date of Shunt Placement:</label> <?php echo $wiz06->shunt_placement == '' ? 'N/A' : $wiz06->shunt_placement; ?></p>
                        <p class="rightadjust"><label>Date of Last Revision:</label> <?php echo $wiz06->last_revision == '' ? 'N/A' : $wiz06->last_revision; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Aura</h1>
                        <p class="leftadjust"><label>Aura:</label> <?php echo $wiz06->aura == '' ? 'N/A' : $wiz06->aura; ?> </p>
                        <p class="rightadjust"><label>Aura Description:</label> <?php echo $wiz06->aura_description == '' || $wiz06->aura == 'no' ? 'N/A' : $wiz06->aura_description ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Comments</h1>
                        <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz06->seizure_comments) == '' ? 'N/A' : $wiz06->seizure_comments ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                <?php endif; ?>
                <?php if (empty($wiz07->hide9)): ?>

                    <div class="section-div">
                        <label>Elimination Requirements</label>

                        <p class="leftadjust"><label>Independent:</label> <?php echo $wiz07->elimination_independent == '' ? 'N/A' : $wiz07->elimination_independent; ?></p>
                        <p class="rightadjust"><label>Scheduled:</label> <?php echo $wiz07->elimination_scheduled == '' ? 'N/A' : $wiz07->elimination_scheduled; ?> </p>
                        <p class="leftadjust"><label>Prompted:</label> <?php echo $wiz07->elimination_prompted == '' ? 'N/A' : $wiz07->elimination_prompted; ?> </p>
                        <p class="rightadjust"><label>Diapered:</label> <?php echo $wiz07->elimination_diapered == '' ? 'N/A' : $wiz07->elimination_diapered; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Continence</h1>
                        <p class="leftadjust"><label>Continent:</label> <?php echo $wiz07->continence_continent == '' ? 'N/A' : $wiz07->continence_continent; ?></p>
                        <p class="rightadjust"><label>Incontinent - Bowel:</label> <?php echo $wiz07->continence_incontinent_bowel == '' ? 'N/A' : $wiz07->continence_incontinent_bowel; ?> </p>
                        <p class="leftadjust"><label>Incontinent - Bladder:</label> <?php echo $wiz07->continence_incontinent_bladder == '' ? 'N/A' : $wiz07->continence_incontinent_bladder; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>How Student is Toileted</h1>
                        <p class="leftadjust"><label>Toileted Type:</label> <?php echo $wiz07->toilet == '' ? 'N/A' : $wiz07->toilet; ?></p>
                        <p class="rightadjust"><label>Other Toilet Type:</label> <?php echo $wiz07->other_toilet == '' || $wiz07->toilet <> 'Other' ? 'N/A' : $wiz07->other_toilet; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Where is Student Toileted</h1>
                        <p class="leftadjust"><label>Toileted :</label> <?php echo $wiz07->toileted == '' ? 'N/A' : $wiz07->toileted; ?></p>
                        <p class="rightadjust"><label>Other Toilet:</label> <?php echo $wiz07->toileted_student == '' ? 'N/A' : $wiz07->toileted_student; ?></p>
                        <p class="leftadjust"><label>Bowel Regime:</label> <?php echo $wiz07->regime == '' ? 'N/A' : $wiz07->regime; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>History of Constipation</h1>
                        <p class="leftadjust"><label>Constipation:</label> <?php echo $wiz07->constipation == '' ? 'N/A' : $wiz07->constipation; ?></p>
                        <p class="rightadjust"><label>Management:</label> <?php echo $wiz07->constipation_mgmnt == '' ? 'N/A' : $wiz07->constipation_mgmnt; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Colostomy</h1>
                        <p class="leftadjust"><label>Colostomy:</label> <?php echo $wiz07->colostomy == '' ? 'N/A' : $wiz07->colostomy; ?></p>
                        <p class="rightadjust"><label>Colostomy Management:</label> <?php echo trim($wiz07->colostomy_mgmnt) == '' ? 'N/A' : $wiz07->colostomy_mgmnt; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Bladder Regime</h1>
                        <p class="leftadjust"><label>Bladder:</label> <?php echo $wiz07->bladder == '' ? 'N/A' : $wiz07->bladder; ?></p>
                        <p class="rightadjust"><label>Bladder Management:</label> <?php echo $wiz07->bladder_mgmnt == '' ? 'N/A' : $wiz07->bladder_mgmnt; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <?php if ($wiz07->cath_size <> '' || $wiz07->cath_freq <> '' || $wiz07->self_catheter <> '' || $wiz07->stoma <> ''): ?>
                        <div class="section-div">
                            <h1>Urinary Catheterization</h1>
                            <p class="leftadjust"><label>Urinary Catheterization:</label> <?php echo $wiz07->catheter == '' ? 'N/A' : $wiz07->catheter; ?></p>
                            <p class="rightadjust"><label>Catheter Size:</label> <?php echo $wiz07->cath_size == '' ? 'N/A' : $wiz07->cath_size; ?></p>
                            <p class="leftadjust"><label>Catheter Frequency:</label> <?php echo $wiz07->cath_freq == '' ? 'N/A' : $wiz07->cath_freq; ?></p>
                            <p class="rightadjust"><label>Self Catheter:</label> <?php echo $wiz07->self_catheter == '' ? 'N/A' : $wiz07->self_catheter; ?></p>
        <!--                            <p class="leftadjust"><label>Stoma:</label> <?php echo $wiz07->stoma == '' ? 'N/A' : $wiz07->stoma; ?></p>-->
                            <div class="divclearboth"></div>
                        </div>
                    <?php endif; ?>
                    <?php if ($wiz07->stoma <> ''): ?>
                        <div class="section-div">
                            <h1>Stoma</h1>

                            <p class="leftadjust"><label>Stoma:</label> <?php echo $wiz07->stoma == '' ? 'N/A' : $wiz07->stoma; ?></p>
                            <div class="divclearboth"></div>
                        </div>
                    <?php endif; ?>
                    <div class="section-div">
                        <h1>Menstruation</h1>
                        <p class="leftadjust"><label>Menstruation:</label> <?php echo $wiz07->menstruation == '' ? 'N/A' : $wiz07->menstruation; ?></p>
                        <p class="rightadjust"><label>Menstruation Management:</label> <?php echo $wiz07->menstruation_mgmt == '' ? 'N/A' : $wiz07->menstruation_mgmt; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Diabetic Details</h1>
                        <p class="leftadjust"><label>Diabetic Student:</label> <?php echo $wiz07->diabetic == '' ? 'N/A' : $wiz07->diabetic; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Liberal Bathroom Privileges</h1>
                        <p class="leftadjust"><label>Liberal Bathroom Privileges:</label> <?php echo $wiz07->br_privileges == '' ? 'N/A' : $wiz07->br_privileges; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Comments</h1>
                        <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz07->elimination_addtnl) == '' ? 'N/A' : $wiz07->elimination_addtnl; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz08->hide10)): ?>

                    <div class="section-div">
                        <label>Cardiac Requirements</label>
                        <p class="leftadjust"><label>Cardiac History:</label> <?php echo trim($wiz08->cardiac_history) == '' ? 'N/A' : $wiz08->cardiac_history; ?> </p>
                        <p class="rightadjust"><label>Restrictions:</label> <?php echo $wiz08->restrictions == '' ? 'N/A' : $wiz08->restrictions; ?> </p>
                        <p class="leftadjust"><label>If yes, please list:</label> <?php echo $wiz08->restrict_list == '' ? 'N/A' : $wiz08->restrict_list; ?> </p>
                        <p class="rightadjust"><label>Baseline Vital Signs:</label> <?php echo $wiz08->baseline == '' ? 'N/A' : $wiz08->baseline; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Symptoms of Distress</h1>
                        <p class="leftadjust"><label>Chest Pain/Tightness:</label> <?php echo $wiz08->distress_pain == '' ? 'N/A' : $wiz08->distress_pain; ?> </p>
                        <p class="rightadjust"><label>Shortness of Breath:</label> <?php echo $wiz08->distress_breath == '' ? 'N/A' : $wiz08->distress_breath; ?> </p>
                        <p class="leftadjust"><label>Palpitations:</label> <?php echo $wiz08->distress_palpitations == '' ? 'N/A' : $wiz08->distress_palpitations; ?> </p>
                        <p class="rightadjust"><label>Diaphoresis:</label> <?php echo $wiz08->distress_diaphoresis == '' ? 'N/A' : $wiz08->distress_diaphoresis; ?> </p>
                        <p class="leftadjust"><label>Fatigue:</label> <?php echo $wiz08->distress_fatigue == '' ? 'N/A' : $wiz08->distress_fatigue; ?> </p>
                        <p class="rightadjust"><label>Dyspnea on Exertion:</label> <?php echo $wiz08->distress_dyspnea == '' ? 'N/A' : $wiz08->distress_dyspnea; ?> </p>
                        <p class="leftadjust"><label>Fainting:</label> <?php echo $wiz08->distress_fainting == '' ? 'N/A' : $wiz08->distress_fainting; ?> </p>
                        <p class="rightadjust"><label>Other:</label> <?php echo $wiz08->distress_other == '' ? 'N/A' : $wiz08->distress_other; ?> </p>
                        <p class="leftadjust"><label>Other Symptoms:</label> <?php echo $wiz08->symptom_other == '' || $wiz08->distress_other == '' ? 'N/A' : $wiz08->symptom_other; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Pacemaker/Internal Defibrillator/Personal AED</h1>
                        <p class="leftadjust"><label>Pacemaker:</label> <?php echo $wiz08->pacemaker == '' ? 'No' : $wiz08->pacemaker; ?></p>
                        <p class="rightadjust"><label>Internal Defibrillator:</label> <?php echo $wiz08->defib == '' ? 'No' : $wiz08->defib; ?> </p>
                        <p class="leftadjust"><label>Personal AED:</label> <?php echo $wiz08->aed == '' ? 'No' : $wiz08->aed; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Baseline Skin Color</h1>
                        <p class="leftadjust"><label>Normal:</label> <?php echo $wiz08->skin_color_normal == '' ? 'N/A' : 'Yes'; ?> </p>
                        <p class="rightadjust"><label>Cyanosis:</label> <?php echo $wiz08->skin_color_cyanosis == '' ? 'N/A' : 'yes'; ?> </p>
                        <p class="leftadjust"><label>Jaundice:</label> <?php echo $wiz08->skin_color_jaundice == '' ? 'N/A' : 'Yes'; ?> </p>
                        <p class="rightadjust"><label>Pallor:</label> <?php echo $wiz08->skin_color_pallor == '' ? 'N/A' : 'Yes'; ?> </p>
                        <p class="leftadjust"><label>Erythema:</label> <?php echo $wiz08->skin_color_erythema == '' ? 'N/A' : 'Yes'; ?> </p>
                        <p class="rightadjust"><label>Other skin color:</label> <?php echo $wiz08->skin_color_other == '' ? 'N/A' : 'Yes'; ?> </p>
                        <p class="leftadjust"><label>Other Description:</label> <?php echo $wiz08->skin_color_comment == '' ? 'N/A' : $wiz08->skin_color_comment; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Comments</h1>
                        <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz08->cardiac_addtnl) == '' ? 'N/A' : $wiz08->cardiac_addtnl; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz09->hide11)): ?>

                    <div class="section-div">
                        <label>Respiratory Requirements</label>

                        <!--<label>Asthma</label>-->
                        <p class="leftadjust"><label>Asthma:</label> <?php echo $wiz09->asthma == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>If not asthma, what is the diagnosis:</label> <?php echo $wiz09->other_diagnosis == '' ? 'N/A' : $wiz09->other_diagnosis; ?> </p>
                        <p class="leftadjust"><label>Age Diagnosed:</label> <?php echo $wiz09->diagnosis_age == '' ? 'N/A' : $wiz09->diagnosis_age; ?> </p>
                        <p class="rightadjust"><label>Symptoms in the last 12 months:</label> <?php echo $wiz09->last_year == '' ? 'N/A' : $wiz09->last_year; ?> </p>
                        <p class="leftadjust"><label>Needed to use medication in the last 12 months:</label> <?php echo $wiz09->meds_last_year == '' ? 'N/A' : $wiz09->meds_last_year; ?> </p>
                        <p class="rightadjust"><label>Seen by health care provider in the last 12 months:</label> <?php echo $wiz09->doctor_last_year == '' ? 'N/A' : $wiz09->doctor_last_year; ?> </p>
                        <p class="leftadjust"><label>ED visit(s)in the last 12 months:</label> <?php echo $wiz09->ed_last_year == '' ? 'N/A' : $wiz09->ed_last_year; ?> </p>
                        <p class="rightadjust"><label>If yes, how many:</label> <?php echo trim($wiz09->num_ed_visits) == '' ? 'N/A' : $wiz09->num_ed_visits; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Triggers</h1>
                        <p class="leftadjust"><label>Smoke:</label> <?php echo $wiz09->triggers_smoke == '' ? 'N/A' : $wiz09->triggers_smoke; ?></p>
                        <p class="rightadjust"><label>Animals:</label> <?php echo $wiz09->triggers_animals == '' ? 'N/A' : $wiz09->triggers_animals; ?> </p>
                        <p class="leftadjust"><label>Dust:</label> <?php echo $wiz09->triggers_dust == '' ? 'N/A' : $wiz09->triggers_dust; ?> </p>
                        <p class="rightadjust"><label>Colds/Illness:</label> <?php echo $wiz09->triggers_colds == '' ? 'N/A' : $wiz09->triggers_colds; ?> </p>
                        <p class="leftadjust"><label>Changes in Weather:</label> <?php echo $wiz09->triggers_weather == '' ? 'N/A' : $wiz09->triggers_weather; ?> </p>
                        <p class="rightadjust"><label>Exercise:</label> <?php echo $wiz09->triggers_exercise == '' ? 'N/A' : $wiz09->triggers_exercise; ?> </p>
                        <p class="leftadjust"><label>Mold:</label> <?php echo $wiz09->triggers_mold == '' ? 'N/A' : $wiz09->triggers_mold; ?> </p>
                        <p class="rightadjust"><label>Grass/Pollen:</label> <?php echo $wiz09->triggers_grass == '' ? 'N/A' : $wiz09->triggers_grass; ?> </p>
                        <p class="leftadjust"><label>Perfumes/Smells:</label> <?php echo $wiz09->triggers_perfumes == '' ? 'N/A' : $wiz09->triggers_perfumes; ?> </p>
                        <p class="rightadjust"><label>Stress:</label> <?php echo $wiz09->triggers_stress == '' ? 'N/A' : $wiz09->triggers_stress; ?> </p>
                        <p class="leftadjust"><label>Food:</label> <?php echo $wiz09->triggers_food == '' ? 'N/A' : $wiz09->triggers_food; ?> </p>
                        <p class="rightadjust"><label>Other:</label> <?php echo $wiz09->other_trigger == '' ? 'N/A' : $wiz09->other_trigger; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Usual Symptoms</h1>
                        <p class="leftadjust"><label>Wheezing:</label> <?php echo $wiz09->usual_symptoms_wheezing == '' ? 'N/A' : $wiz09->usual_symptoms_wheezing; ?></p>
                        <p class="rightadjust"><label>Shortness of Breath:</label> <?php echo $wiz09->usual_symptoms_breath == '' ? 'N/A' : $wiz09->usual_symptoms_breath; ?> </p>
                        <p class="leftadjust"><label>Difficulty Breathing:</label> <?php echo $wiz09->usual_symptoms_breathing == '' ? 'N/A' : $wiz09->usual_symptoms_breathing; ?> </p>
                        <p class="rightadjust"><label>Itchy Throat:</label> <?php echo $wiz09->usual_symptoms_throat == '' ? 'N/A' : $wiz09->usual_symptoms_throat; ?> </p>
                        <p class="leftadjust"><label>Coughing:</label> <?php echo $wiz09->usual_symptoms_cough == '' ? 'N/A' : $wiz09->usual_symptoms_cough; ?> </p>
                        <p class="rightadjust"><label>Chest Tightness:</label> <?php echo $wiz09->usual_symptoms_chest == '' ? 'N/A' : $wiz09->usual_symptoms_chest; ?> </p>
                        <p class="leftadjust"><label>Irritability:</label> <?php echo $wiz09->usual_symptoms_irritability == '' ? 'N/A' : $wiz09->usual_symptoms_irritability; ?> </p>
                        <p class="rightadjust"><label>Waking at Night:</label> <?php echo $wiz09->usual_symptoms_waking == '' ? 'N/A' : $wiz09->usual_symptoms_waking; ?> </p>
                        <p class="leftadjust"><label>Stomach Ache:</label> <?php echo $wiz09->usual_symptoms_stomachache == '' ? 'N/A' : 'Stomach Ache'; ?> </p>
                        <p class="rightadjust"><label>Other:</label> <?php echo $wiz09->other_usual_symptoms == '' ? 'N/A' : $wiz09->other_usual_symptoms; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Symptoms During the Day (in the past month)</h1>
                        <p class="leftadjust"><label>None:</label> <?= $wiz09->day_symptoms == 'None' ? 'Yes' : 'N/A' ?> </p>
                        <p class="rightadjust"><label>2x/week or less:</label> <?= $wiz09->day_symptoms == '2x/week or less' ? 'Yes' : 'N/A' ?> </p>
                        <p class="leftadjust"><label> More than 2x/week:</label> <?= $wiz09->day_symptoms == 'More than 2x/week' ? 'Yes' : 'N/A' ?> </p>
                        <p class="rightadjust"><label>Every Day:</label> <?= $wiz09->day_symptoms == 'Every Day' ? 'Yes' : 'N/A' ?> </p>

                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Symptoms at Night (in the past month)</h1>
                        <p class="leftadjust"><label>None:</label> <?= $wiz09->night_symptoms == 'None' ? 'Yes' : 'N/A' ?> </p>
                        <p class="rightadjust"><label>2x/week or less:</label> <?= $wiz09->night_symptoms == '2x/week or less' ? 'Yes' : 'N/A' ?> </p>
                        <p class="leftadjust"><label>More than 2x/week:</label> <?= $wiz09->night_symptoms == 'More than 2x/week' ? 'Yes' : 'N/A' ?> </p>
                        <p class="rightadjust"><label>Every Day:</label> <?= $wiz09->night_symptoms == 'Every Day' ? 'Yes' : 'N/A' ?> </p>

                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Symptoms most likely occur in</h1>
                        <p class="leftadjust"><label>Fall:</label> <?= $wiz09->season_fall == '' ? 'N/A' : $wiz09->season_fall ?> </p>
                        <p class="rightadjust"><label>Winter:</label> <?= $wiz09->season_winter == '' ? 'N/A' : $wiz09->season_winter ?> </p>
                        <p class="leftadjust"><label>Spring:</label> <?= $wiz09->season_spring == '' ? 'N/A' : $wiz09->season_spring ?> </p>
                        <p class="rightadjust"><label>Summer:</label> <?= $wiz09->season_summer == '' ? 'N/A' : $wiz09->season_summer ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <p class="leftadjust"><label>Have symptoms prevented activities?</label>
                            <?= $wiz09->pe == '' ? 'N/A' : $wiz09->pe ?> </p>
                        <p class="rightadjust"><label>If yes, please explain:</label> <?= $wiz09->pe_explain == '' || $wiz09->pe == '' ? 'N/A' : $wiz09->pe_explain ?> </p>
                        <div class="divclearboth"></div>
                    </div>


                    <div class="section-div">
                        <h1>Student Requirements</h1>

                        <p class="leftadjust"><label>Did student miss school last year:</label> <?php echo $wiz09->miss_school == '' ? 'N/A' : $wiz09->miss_school; ?></p>
                        <p class="rightadjust"><label>If yes, how many times:</label> <?php echo $wiz09->missed_times == '' || $wiz09->miss_school == '' ? 'N/A' : $wiz09->missed_times; ?> </p>
                        <p class="leftadjust"><label>Medication Delivery:</label> <?php echo $wiz09->med_delivery == '' ? 'N/A' : $wiz09->med_delivery; ?> </p>

                        <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz09->med_freq == '' ? 'N/A' : $wiz09->med_freq; ?> </p>
                        <p class="leftadjust"><label>Student able to administer medication:</label> <?php echo $wiz09->student_admin == '' ? 'N/A' : $wiz09->student_admin; ?> </p>

                        <p class="rightadjust"><label>Student self-carries MDI:</label> <?php echo $wiz09->self_mdi == '' ? 'N/A' : $wiz09->self_mdi; ?> </p>
                        <p class="leftadjust"><label>MDI kept in health room:</label> <?php echo $wiz09->mdi == '' ? 'N/A' : $wiz09->mdi; ?> </p>
                        <p class="rightadjust"><label>Spacer:</label> <?php echo $wiz09->spacer == '' ? 'N/A' : $wiz09->spacer; ?> </p>
                        <p class="leftadjust"><label>Peak Flow:</label> <?php echo $wiz09->peak == '' ? 'N/A' : $wiz09->peak; ?> </p>
                        <p class="rightadjust"><label>Personal best?:</label> <?php echo $wiz09->peak_best == '' ? 'N/A' : $wiz09->peak_best; ?> </p>
                        <p class="leftadjust"><label>Pulmonary Vest:</label> <?php echo $wiz09->pulm_vest == '' ? 'N/A' : $wiz09->pulm_vest; ?> </p>
                        <p class="rightadjust"><label>Pulmonary Vest Frequency:</label> <?php echo $wiz09->vest_freq == '' ? 'N/A' : $wiz09->vest_freq; ?> </p>
                        <p class="leftadjust"><label>Chest PT:</label> <?php echo $wiz09->chest_pt == '' ? 'N/A' : $wiz09->chest_pt; ?> </p>
                        <p class="rightadjust"><label>Chest PT Frequency:</label> <?php echo $wiz09->chest_pt_freq == '' ? 'N/A' : $wiz09->chest_pt_freq; ?> </p>

                        <p class="leftadjust"><label>Standard Asthma Plan:</label> <?php echo $wiz09->standard == '' ? 'N/A' : $wiz09->standard; ?> </p>
                        <p class="rightadjust"><label>Asthma Action Plan:</label> <?php echo $wiz09->action == '' ? 'N/A' : $wiz09->action; ?> </p>
                        <p class="leftadjust"><label>IHP:</label> <?php echo $wiz09->ihp == '' ? 'N/A' : $wiz09->ihp; ?> </p>

                        <p class="rightadjust"><label>ED visit(s)  in the last 12 months:</label> <?php echo $wiz09->ed_asthma == '' ? 'N/A' : $wiz09->ed_asthma; ?> </p>
                        <p class="leftadjust"><label>If yes, how many:</label> <?php echo $wiz09->num_visits == '' || $wiz09->ed_asthma == 'no' ? 'N/A' : $wiz09->num_visits; ?> </p>
                        <p class="rightadjust"><label>Additional Comments:</label> <?php echo trim($wiz09->resp_addtnl) == '' ? 'N/A' : $wiz09->resp_addtnl; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz11->hide122)): ?>
                    <div class="section-div">
                        <label>Respiratory - Oxygen/Tracheostomy/Ventilation Requirements</label>
                        <!--<p class="leftadjust"><h1>Respiratory Assessment</h1></p>-->
                        <p class="leftadjust"><label>Continuous:</label> <?php echo $wiz11->resp_assess_continuous == '' ? 'N/A' : $wiz11->resp_assess_continuous; ?> </p>
                        <p class="rightadjust"><label>Intermittant/As Needed:</label> <?php echo $wiz11->resp_assess_intermittant == '' ? 'N/A' : $wiz11->resp_assess_intermittant; ?> </p>
                        <p class="leftadjust"><label>Student Communicates/Signals Need:</label> <?php echo $wiz11->resp_assess_signal == '' ? 'N/A' : $wiz11->resp_assess_signal; ?> </p>
                        <p class="rightadjust"><label>Baseline Respiratory Assessment:</label> <?php echo $wiz11->baseline_assess == '' ? 'N/A' : $wiz11->baseline_assess; ?> </p>
                        <p class="leftadjust"><label>Signs/Symptoms of Respiratory Distress:</label> <?php echo $wiz11->distress_sign == '' ? 'N/A' : $wiz11->distress_sign; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Mechanical Ventilation</h1>
                        <p class="leftadjust"><label>Mechanical Ventilation Type:</label> <?php echo $wiz11->ventilation == '' ? 'N/A' : $wiz11->ventilation; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Ventilation Needed</h1>
                        <p class="leftadjust"><label>Home:</label> <?php echo $wiz11->where_home == '' ? 'N/A' : $wiz11->where_home; ?> </p>
                        <p class="rightadjust"><label>School:</label> <?php echo $wiz11->where_school == '' ? 'N/A' : $wiz11->where_school; ?> </p>
                        <p class="leftadjust"><label>Sleep:</label> <?php echo $wiz11->where_sleep == '' ? 'N/A' : $wiz11->where_sleep; ?> </p>
                        <p class="rightadjust"><label>As Needed:</label> <?php echo $wiz11->where_as_needed == '' ? 'N/A' : $wiz11->where_as_needed; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Ventilator Dependent</h1>
                        <p class="leftadjust"><label>Ventilator Dependent:</label> <?php echo $wiz11->vent_depend_dependent == '' ? 'N/A' : $wiz11->vent_depend_dependent; ?> </p>
                        <p class="rightadjust"><label>Ventilator Assist:</label> <?php echo $wiz11->vent_depend_assist == '' ? 'N/A' : $wiz11->vent_depend_assist; ?> </p>
                        <p class="leftadjust"><label>If Vent Assist, how long can student be off vent:</label> <?php echo $wiz11->vent_assist == '' ? 'N/A' : $wiz11->vent_assist; ?> </p>
                        <p class="rightadjust"><label>Ventilator Settings:</label> <?php echo $wiz11->vent_set == '' ? 'N/A' : $wiz11->vent_set; ?> </p>
                        <p class="leftadjust"><label>Ventilator Company:</label> <?php echo $wiz11->vent_co == '' ? 'N/A' : $wiz11->vent_co; ?> </p>
                        <p class="rightadjust"><label>Contact Information:</label> <?php echo $wiz11->vent_contact == '' ? 'N/A' : $wiz11->vent_contact; ?> </p>

                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Oxygen</h1>
                        <p class="leftadjust"><label>Continous:</label> <?php echo $wiz11->oxygen_cont == '' ? 'N/A' : $wiz11->oxygen_cont; ?> </p>
                        <p class="rightadjust"><label>Intermittent:</label> <?php echo $wiz11->oxygen_inter == '' ? 'N/A' : $wiz11->oxygen_inter; ?> </p>
                        <p class="leftadjust"><label>Oximetry:</label> <?php echo $wiz11->oximetry == '' ? 'N/A' : $wiz11->oximetry; ?> </p>
                        <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz11->ox_freq == '' || $wiz11->oximetry == '' ? 'N/A' : $wiz11->ox_freq; ?> </p>
                        <p class="leftadjust"><label>Parameters:</label> <?php echo $wiz11->ox_param == '' || $wiz11->oximetry == '' ? 'N/A' : $wiz11->ox_param; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Oxygen Route</h1>
                        <p class="leftadjust"><label>Nasal Cannula:</label> <?php echo $wiz11->ox_route_nasal == '' ? 'N/A' : $wiz11->ox_route_nasal; ?> </p>
                        <p class="rightadjust"><label>Tracheotomy:</label> <?php echo $wiz11->ox_route_trach == '' ? 'N/A' : $wiz11->ox_route_trach; ?> </p>
                        <p class="leftadjust"><label>Mask/Non-Rebreather:</label> <?php echo $wiz11->ox_route_mask == '' ? 'N/A' : $wiz11->ox_route_mask; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Oxygen Source</h1>
                        <p class="leftadjust"><label>Tank:</label> <?php echo $wiz11->ox_source_tank == '' ? 'N/A' : $wiz11->ox_source_tank; ?> </p>
                        <p class="rightadjust"><label>Liquid:</label> <?php echo $wiz11->ox_source_liquid == '' ? 'N/A' : $wiz11->ox_source_liquid; ?> </p>
                        <p class="leftadjust"><label>Concentrator:</label> <?php echo $wiz11->ox_source_concentrator == '' ? 'N/A' : $wiz11->ox_source_concentrator; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Trach</h1>
                        <p class="leftadjust"><label>Trach Size:</label> <?php echo $wiz11->trach_size == '' ? 'N/A' : $wiz11->trach_size; ?> </p>
                        <p class="rightadjust"><label>Cuffed:</label> <?php echo $wiz11->cuffed == '' ? 'N/A' : $wiz11->cuffed; ?> </p>
                        <p class="leftadjust"><label>Thermo-Vent:</label> <?php echo $wiz11->thermo == '' ? 'N/A' : $wiz11->thermo; ?> </p>
                        <p class="rightadjust"><label>Passy Muir:</label> <?php echo $wiz11->muir == '' ? 'N/A' : $wiz11->muir; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>CO2 Monitor</h1>
                        <p class="leftadjust"><label>CO2 Monitor:</label> <?php echo $wiz11->co2 == '' ? 'N/A' : $wiz11->co2; ?> </p>
                        <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz11->co2_freq == '' || $wiz11->co2 == '' ? 'N/A' : $wiz11->co2_freq; ?> </p>
                        <p class="leftadjust"><label>Parameters:</label> <?php echo $wiz11->co2_param == '' || $wiz11->co2 == '' ? 'N/A' : $wiz11->co2_param; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Ventilator information</h1>
                        <p class="leftadjust"><label>Additional Ventilator information:</label> <?php echo $wiz11->addtnl_vent == '' ? 'N/A' : $wiz11->addtnl_vent; ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <?php if ($wiz11->suction == 'yes'): ?>
                        <div class="section-div">
                            <label>Suctioning</label>
                            <p class="leftadjust"><label>Suctioning:</label> <?php echo $wiz11->suction == '' ? 'N/A' : $wiz11->suction; ?> </p>
                            <div class="divclearboth"></div>
                        </div>
                        <div class="section-div">
                            <h1>Type of Oropharyngeal</h1>
                            <p class="leftadjust"><label>Oropharyngeal:</label> <?php echo $wiz11->trach_type_o == '' ? 'N/A' : $wiz11->trach_type_o; ?> </p>
                            <!--<p class="rightadjust">Catheter Type</p>-->
                            <p class="leftadjust"><label>Yankauer Catheter:</label> <?php echo $wiz11->cath_y == '' ? 'N/A' : 'Yankauer Catheter'; ?> </p>
                            <p class="rightadjust"><label>Flexible Catheter:</label> <?php echo $wiz11->cath_f == '' ? 'N/A' : 'Flexible Catheter'; ?> </p>
                            <p class="leftadjust"><label>Catheter Size:</label> <?php echo $wiz11->cath_size == '' ? 'N/A' : $wiz11->cath_size; ?> </p>
                            <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz11->cath_freq == '' ? 'N/A' : $wiz11->cath_freq; ?> </p>
                            <p class="leftadjust"><label>Color of Secretions:</label> <?php echo $wiz11->cath_color == '' ? 'N/A' : $wiz11->cath_color; ?> </p>
                            <p class="rightadjust"><label>Equipment needed for suctioning:</label> <?php echo $wiz11->suction_equip == '' ? 'N/A' : $wiz11->suction_equip; ?> </p>
                            <div class="divclearboth"></div>
                        </div>
                        <div class="section-div">
                            <h1>Type of  Nasopharyngeal</h1>
                            <p class="leftadjust"><label>Nasopharyngeal:</label> <?php echo $wiz11->trach_type_n == '' ? 'N/A' : $wiz11->trach_type_n; ?> </p>
                            <!--<p class="rightadjust"><label style="color:#000;font-weight: bold;">Catheter Type</label></p>-->
                            <p class="leftadjust"><label>Yankauer Catheter:</label> <?php echo $wiz11->cath_y2 == '' ? 'N/A' : 'Yankauer Catheter'; ?> </p>
                            <p class="rightadjust"><label>Flexible Catheter:</label> <?php echo $wiz11->cath_f2 == '' ? 'N/A' : 'Flexible Catheter'; ?> </p>
                            <p class="leftadjust"><label>Catheter Size:</label> <?php echo $wiz11->cath_size2 == '' ? 'N/A' : $wiz11->cath_size2; ?> </p>
                            <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz11->cath_freq2 == '' ? 'N/A' : $wiz11->cath_freq2; ?> </p>
                            <p class="leftadjust"><label>Color of Secretions:</label> <?php echo $wiz11->cath_color2 == '' ? 'N/A' : $wiz11->cath_color2; ?> </p>
                            <p class="rightadjust"><label>Equipment needed for suctioning:</label> <?php echo $wiz11->suction_equip2 == '' ? 'N/A' : $wiz11->suction_equip2; ?> </p>
                            <div class="divclearboth"></div>
                        </div>
                        <div class="section-div">
                            <h1>Type of  Endotracheal</h1>
                            <p class="leftadjust"><label>Endotracheal:</label> <?php echo $wiz11->trach_type_e == '' ? 'N/A' : $wiz11->trach_type_e; ?> </p>
                            <!--<p class="rightadjust"><h1>Catheter Type</h1></p>-->
                            <p class="leftadjust"><label>Yankauer Catheter:</label> <?php echo $wiz11->cath_y3 == '' ? 'N/A' : 'Yankauer Catheter'; ?> </p>
                            <p class="rightadjust"><label>Flexible Catheter:</label> <?php echo $wiz11->cath_f3 == '' ? 'N/A' : 'Flexible Catheter'; ?> </p>
                            <p class="leftadjust"><label>Catheter Size:</label> <?php echo $wiz11->cath_size3 == '' ? 'N/A' : $wiz11->cath_size3; ?> </p>
                            <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz11->cath_freq3 == '' ? 'N/A' : $wiz11->cath_freq3; ?> </p>
                            <p class="leftadjust"><label>Color of Secretions:</label> <?php echo $wiz11->cath_color3 == '' ? 'N/A' : $wiz11->cath_color3; ?> </p>
                            <p class="rightadjust"><label>Equipment needed for suctioning:</label> <?php echo $wiz11->suction_equip3 == '' ? 'N/A' : $wiz11->suction_equip3; ?> </p>
                            <div class="divclearboth"></div>
                        </div>
                    <?php endif; ?>
                    <div class="section-div">
                        <h1>Equipment Details</h1>
                        <p class="leftadjust"><label>Other Equipment Needed for School:</label> <?php echo trim($wiz11->other_equip) == '' ? 'N/A' : $wiz11->other_equip; ?> </p>
                        <p class="rightadjust"><label>Equipment Checklist Utilized:</label> <?php echo $wiz11->equip_check == '' ? 'No' : $wiz11->equip_check; ?> </p>
                        <p class="leftadjust"><label>Evacuation/Emergency Instructions:</label> <?php echo $wiz11->evac == '' ? 'N/A' : $wiz11->evac; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Comments</h1>
                        <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz11->oxy_addtnl) == '' ? 'N/A' : $wiz11->oxy_addtnl; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz12->hide13)): ?>
                    <div class="section-div">
                        <label>Orthopedics and Mobility Requirements</label>

                        <p class="leftadjust"><label>Ambulatory: </label><?php echo $wiz12->mobility_amb == '' ? 'N/A' : $wiz12->mobility_amb; ?></p>
                        <p class="rightadjust"><label>Independent</label><?php echo $wiz12->mobility_ind == '' ? 'N/A' : $wiz12->mobility_ind; ?></p>
                        <p class="leftadjust"><label>Needs Supervision</label><?php echo $wiz12->mobility_ns == '' ? 'N/A' : $wiz12->mobility_ns; ?></p>
                        <p class="rightadjust"><label>Uses Walker</label><?php echo $wiz12->mobility_uw == '' ? 'N/A' : $wiz12->mobility_uw; ?></p>
                        <p class="leftadjust"><label>Gait Trainer</label><?php echo $wiz12->mobility_gt == '' ? 'N/A' : $wiz12->mobility_gt; ?></p>
                        <p class="rightadjust"><label>Wheelchair</label><?php echo $wiz12->mobility_wheel == '' ? 'N/A' : $wiz12->mobility_wheel; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Wheelchair</h1>
                        <p class="leftadjust"><label>Manual Independent</label><?php echo $wiz12->wc_mi == '' ? 'N/A' : $wiz12->wc_mi; ?></p>
                        <p class="rightadjust"><label>Manual Assist</label><?php echo $wiz12->wc_ma == '' ? 'N/A' : $wiz12->wc_ma; ?></p>
                        <p class="leftadjust"><label>Power Independent</label><?php echo $wiz12->wc_pi == '' ? 'N/A' : $wiz12->wc_pi; ?></p>
                        <p class="rightadjust"><label>Power Assist</label><?php echo $wiz12->wc_pa == '' ? 'N/A' : $wiz12->wc_pa; ?></p>
                        <p class="leftadjust"><label>Supervision Only</label><?php echo $wiz12->wc_so == '' ? 'N/A' : $wiz12->wc_so; ?></p>

                        <p class="rightadjust"><label>Special Consideration:</label> <?php echo $wiz12->sc == '' ? 'N/A' : $wiz12->sc; ?></p>
                        <p class="leftadjust"><label>Equipment Provider:</label> <?php echo $wiz12->equip_provider == '' ? 'N/A' : $wiz12->equip_provider; ?></p>
                        <p class="rightadjust"><label>Contact Info:</label> <?php echo $wiz12->c_info == '' ? 'N/A' : $wiz12->c_info; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Scoliosis</h1>
                        <p class="leftadjust"><label>Scoliosis:</label> <?php echo $wiz12->scoliosis == '' ? 'N/A' : $wiz12->scoliosis; ?></p>
                        <p class="rightadjust"><label>Last X-Ray/Exam:</label> <?php echo $wiz12->sco_last == '' || $wiz12->scoliosis == '' ? 'N/A' : $wiz12->sco_last; ?></p>
                        <p class="leftadjust"><label>Treatment:</label> <?php echo $wiz12->sco_treat == '' || $wiz12->scoliosis == '' ? 'N/A' : $wiz12->sco_treat; ?></p>
                        <div class="divclearboth"></div>
                    </div>


                    <div class="section-div">

                        <h1>Hip Dislocation</h1>
                        <p class="leftadjust"><label>Hip Dislocation:</label> <?php echo $wiz12->hip == '' ? 'N/A' : $wiz12->hip; ?></p>
                        <p class="rightadjust"><label>Last X-Ray/Exam:</label> <?php echo $wiz12->hip_last == '' || $wiz12->hip == '' ? 'N/A' : $wiz12->hip_last; ?></p>
                        <p class="leftadjust"><label>Treatment:</label> <?php echo $wiz12->hip_treat == '' || $wiz12->hip == '' ? 'N/A' : $wiz12->hip_treat; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Physical Therapy Services</h1>
                        <p class="leftadjust"><label>Physical Therapy Services:</label> <?php echo $wiz12->pt == '' ? 'N/A' : $wiz12->pt; ?></p>
                        <p class="rightadjust"><label>If Yes, where:</label> <?php echo $wiz12->pt_where == '' || $wiz12->pt == '' ? 'N/A' : $wiz12->pt_where; ?></p>
                        <p class="leftadjust"><label>Details of Mobility Concerns:</label> <?php echo $wiz12->mobi_text == '' ? 'N/A' : $wiz12->mobi_text; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Orthotics</h1>
                        <p class="leftadjust"><label>Orthotics:</label> <?php echo $wiz12->orth == '' ? 'N/A' : $wiz12->orth; ?></p>
                        <p class="rightadjust"><label>Type:</label> <?php echo $wiz12->orth_desc == '' || $wiz12->orth == '' ? 'N/A' : $wiz12->orth_desc; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Splints</h1>
                        <p class="leftadjust"><label>Hand:</label> <?php echo $wiz12->splint_hand == '' ? 'N/A' : $wiz12->splint_hand; ?></p>
                        <p class="rightadjust"><label>Knee:</label> <?php echo $wiz12->splint_knee == '' ? 'N/A' : $wiz12->splint_knee; ?></p>
                        <p class="leftadjust"><label>Leg:</label> <?php echo $wiz12->splint_leg == '' ? 'N/A' : $wiz12->splint_leg; ?></p>
                        <p class="rightadjust"><label>Ankle:</label> <?php echo $wiz12->splint_ankle == '' ? 'N/A' : $wiz12->splint_ankle; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Transfer/Lift Assistance:</h1>
                        <p class="leftadjust"><label>One Person:</label> <?php echo $wiz12->lift_one == '' ? 'N/A' : $wiz12->lift_one; ?></p>
                        <p class="rightadjust"><label>Two Person:</label> <?php echo $wiz12->lift_two == '' ? 'N/A' : $wiz12->lift_two; ?></p>
                        <p class="leftadjust"><label>Hoyer:</label> <?php echo $wiz12->lift_hoyer == '' ? 'N/A' : $wiz12->lift_hoyer; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">

                        <h1>Positioning Plan:</h1>
                        <p class="rightadjust"><label>Positioning Plan:</label> <?php echo $wiz12->pos_plan == '' ? 'N/A' : $wiz12->pos_plan; ?></p>
                        <p class="leftadjust"><label>If Yes, where:</label> <?php echo $wiz12->pos_plan_desc == '' ? 'N/A' : $wiz12->pos_plan_desc; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Comments:</h1>
                        <p class="rightadjust"><label>Additional Comments:</label> <?php echo trim($wiz12->mobi_addtnl) == '' ? 'N/A' : $wiz12->mobi_addtnl; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz13->hide144)): ?>
                    <div class="section-div">
                        <label>Nutrition and Feeding Safety Requirements</label>
                        <p class="leftadjust"><label>Nothing by Mouth / Regular / Special:</label> <?php echo $wiz13->diet == '' ? 'N/A' : $wiz13->diet; ?></p>
                        <p class="rightadjust"><label>Description:</label> <?php echo $wiz13->food_texture == '' || $wiz13->diet <> 'Special Diet' ? 'N/A' : $wiz13->food_texture; ?></p>
                        <p class="leftadjust"><label>Parent Prepares:</label> <?php echo $wiz13->prepare_parent == '' ? 'No' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>School Cafe Prepares:</label> <?php echo $wiz13->prepare_school == '' ? 'No' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Other Dietary Restriction:</label> <?php echo $wiz13->food_restriction == '' ? 'N/A' : $wiz13->food_restriction; ?></p>
                        <p class="rightadjust"><label>Fluid Consistency/<br>Restrictions:</label> <?php echo $wiz13->fluid_restriction == '' ? 'N/A' : $wiz13->fluid_restriction; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Feeding Assistance Needed:</h1>
                        <p class="rightadjust"><label>Feeding Assistance Needed?</label> <?php echo $wiz13->feeding_assist == '' ? 'N/A' : $wiz13->feeding_assist; ?></p>
                        <p class="leftadjust"><label>Total:</label> <?php echo $wiz13->feeding_type_total == '' || $wiz13->feeding_assist == '' ? 'N/A' : $wiz13->feeding_type_total; ?></p>
                        <p class="rightadjust"><label>Assessing food only:</label> <?php echo $wiz13->feeding_type_assess == '' || $wiz13->feeding_assist == '' ? 'N/A' : $wiz13->feeding_type_assess; ?></p>
                        <p class="leftadjust"><label>Opening containers:</label> <?php echo $wiz13->feeding_type_open == '' || $wiz13->feeding_assist == '' ? 'N/A' : $wiz13->feeding_type_open; ?></p>
                        <p class="rightadjust"><label>Cutting food:</label> <?php echo $wiz13->feeding_type_cutting == '' || $wiz13->feeding_assist == '' ? 'N/A' : $wiz13->feeding_type_cutting; ?></p>

                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Feeding Tube:</h1>
                        <p class="leftadjust"><label>Feeding Tube:</label> <?php echo $wiz13->feeding_tubeval == '' ? 'N/A' : $wiz13->feeding_tubeval; ?></p>
                        <p class="leftadjust"><label>Button:</label> <?php echo $wiz13->feeding_tube_mic == '' || $wiz13->feeding_tubeval <> 'yes' ? 'N/A' : 'Button'; ?></p>
                        <p class="rightadjust"><label>PEG Tube:</label> <?php echo $wiz13->feeding_tube_peg == '' || $wiz13->feeding_tubeval <> 'yes' ? 'N/A' : $wiz13->feeding_tube_peg; ?></p>
                        <p class="leftadjust"><label>J-tube:</label> <?php echo $wiz13->feeding_tube_jtube == '' || $wiz13->feeding_tubeval <> 'yes' ? 'N/A' : 'J-tube'; ?></p>
                        <p class="rightadjust"><label>N/G Tube:</label> <?php echo $wiz13->feeding_tube_ng == '' || $wiz13->feeding_tubeval <> 'yes' ? 'N/A' : $wiz13->feeding_tube_ng; ?></p>
                        <p class="leftadjust"><label>G/J-Tube:</label> <?php echo $wiz13->feeding_tube_gj == '' || $wiz13->feeding_tubeval <> 'yes' ? 'N/A' : $wiz13->feeding_tube_gj; ?></p>
                        <p class="rightadjust"><label>G-Tube Size:</label> <?php echo $wiz13->gtube_size == '' ? 'N/A' : $wiz13->gtube_size; ?></p>
                        <p class="leftadjust"><label>Type:</label> <?php echo $wiz13->tube_type == '' ? 'N/A' : $wiz13->tube_type; ?></p>
                        <p class="rightadjust"><label>Instructions if dislodged at school:</label> <?php echo $wiz13->inst_dislodged == '' ? 'N/A' : $wiz13->inst_dislodged; ?></p>

                                                                                                                                                                                                                                                                                                                                                                                                <!--                        <p class="leftadjust"><label>Bolus:</label> <?php echo $wiz13->tube_feedings_bolus == '' ? 'N/A' : $wiz13->tube_feedings_bolus; ?></p>-->

                        <div class="divclearboth"></div>
                    </div>
                    <!--Changed on 10-12-2015-->
                    <div class="section-div">
                        <h1>Tube Feeding:</h1>
                        <p class="leftadjust"><label>Bolus:</label> <?php echo $wiz13->tube_feedings_bolus == '' ? 'N/A' : $wiz13->tube_feedings_bolus; ?></p>
                        <p class="rightadjust"><label>Pump:</label> <?php echo $wiz13->tube_feedings_pump == '' ? 'N/A' : $wiz13->tube_feedings_pump; ?></p>

                        <p class="leftadjust"><label>Type/Time/Frequency (in hours)/Amount:</label> <?php echo $wiz13->feed_freq == '' ? 'N/A' : $wiz13->feed_freq; ?></p>
                        <p class="rightadjust"><label>Water Flush:</label> <?php echo $wiz13->water_flush == '' ? 'N/A' : $wiz13->water_flush; ?></p>
                        <p class="leftadjust"><label>Free Water:</label> <?php echo $wiz13->free_water == '' ? 'N/A' : $wiz13->free_water; ?></p>
                        <p class="rightadjust"><label>Fundoplication:</label> <?php echo $wiz13->fundo == '' ? 'N/A' : $wiz13->fundo; ?></p>

                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Last Swallow Study:</h1>
                        <p class="leftadjust"><label>VFSS:</label> <?php echo $wiz13->swallow_vfss == '' ? 'N/A' : $wiz13->swallow_vfss; ?></p>
                        <p class="rightadjust"><label>Endo:</label> <?php echo $wiz13->swallow_endo == '' ? 'N/A' : $wiz13->swallow_endo; ?></p>

                        <p class="leftadjust"><label>Date of Study</label> <?php echo $wiz13->swallow_study_date == '' ? 'N/A' : $wiz13->swallow_study_date; ?></p>
                        <p class="rightadjust"><label>Location of Study</label> <?php echo $wiz13->swallow_study_loc == '' ? 'N/A' : $wiz13->swallow_study_loc; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Reflux / Treatment:</h1>
                        <p class="leftadjust"><label>Reflux:</label> <?php echo $wiz13->reflux == '' ? 'N/A' : $wiz13->reflux; ?></p>
                        <p class="rightadjust"><label>Treatment:</label> <?php echo $wiz13->reflux_tx == '' || $wiz13->reflux == '' ? 'N/A' : $wiz13->reflux_tx; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Feeding Clinic:</h1>
                        <p class="leftadjust"><label>Feeding Clinic:</label> <?php echo $wiz13->clinic == '' ? 'N/A' : $wiz13->clinic; ?></p>
                        <p class="rightadjust"><label>Where and How Often:</label> <?php echo $wiz13->clinic_details == '' ? 'N/A' : $wiz13->clinic_details; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>AACPS SMART Team Managing:</h1>
                        <p class="leftadjust"><label>AACPS SMART Team Managing:</label> <?php echo $wiz13->smart_team == '' ? 'N/A' : $wiz13->smart_team; ?></p>
                        <p class="rightadjust"><label>Case Manager:</label> <?php echo $wiz13->smart_manager == '' ? 'N/A' : $wiz13->smart_manager; ?></p>
    <!--                        <p class="leftadjust"><label>Mealtime Plan of Care:</label> <?php echo $wiz13->meal_care == '' ? 'N/A' : $wiz13->meal_care; ?></p>-->
                        <div class="divclearboth"></div>
                    </div>


                    <div class="section-div">
                        <h1>Mealtime Plan of Care:</h1>
                        <p class="leftadjust"><label>Mealtime Plan of Care:</label> <?php echo $wiz13->meal_care == '' ? 'N/A' : $wiz13->meal_care; ?></p>
                        <div class="divclearboth"></div>
                    </div>




                    <div class="section-div">
                        <h1>Additional Comments:</h1>
                        <p class="rightadjust"><label>Additional Comments:</label> <?php echo trim($wiz13->nutr_comments) == '' ? 'N/A' : $wiz13->nutr_comments; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz14->hide15)): ?>

                    <div class="section-div">
                        <label>Diabetes Management</label>
                        <p class="leftadjust"><label>Tests blood glucose at school:</label> <?php echo $wiz14->gluc_test == '' ? 'N/A' : $wiz14->gluc_test; ?></p>
                        <!--<label>When should student test:</label>-->
                        <h1 class="leftadjust">When should student test:</h1>
                        <p class="rightadjust"><label>On arrival:</label> <?php echo $wiz14->test_when_arrival == '' ? 'N/A' : $wiz14->test_when_arrival; ?></p>
                        <p class="leftadjust"><label>Before breakfast:</label> <?php echo $wiz14->test_when_breakfast == '' ? 'N/A' : $wiz14->test_when_breakfast; ?></p>
                        <p class="rightadjust"><label>Before lunch:</label> <?php echo $wiz14->test_when_blunch == '' ? 'N/A' : $wiz14->test_when_blunch; ?></p>
                        <p class="leftadjust"><label>After lunch:</label> <?php echo $wiz14->test_when_alunch == '' ? 'N/A' : $wiz14->test_when_alunch; ?></p>
                        <p class="rightadjust"><label>Before PE:</label> <?php echo $wiz14->test_when_bpe == '' ? 'N/A' : $wiz14->test_when_bpe; ?></p>
                        <p class="leftadjust"><label>After PE:</label> <?php echo $wiz14->test_when_ape == '' ? 'N/A' : $wiz14->test_when_ape; ?></p>
                        <p class="rightadjust"><label>Before snacks:</label> <?php echo $wiz14->test_when_snack == '' ? 'N/A' : $wiz14->test_when_snack; ?></p>

                        <p class="leftadjust"><label>Before dismissal:</label> <?php echo $wiz14->test_when_dismissal == '' ? 'N/A' : $wiz14->test_when_dismissal; ?></p>
                        <p class="rightadjust"><label>PRN if symptomatic:</label> <?php echo $wiz14->test_when_prn == '' ? 'N/A' : $wiz14->test_when_prn; ?></p>
                        <p class="leftadjust"><label>Other:</label> <?php echo $wiz14->test_when_other == '' ? 'N/A' : $wiz14->test_when_other; ?></p>
                        <p class="rightadjust"><label>Other description:</label> <?php echo $wiz14->othertest == '' || $wiz14->test_when_other == '' ? 'N/A' : $wiz14->othertest; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Level of Independence:</h1>
                        <p class="leftadjust"><label>Independent (outside HR):</label> <?php echo $wiz14->test_ind_outhr == '' ? 'N/A' : $wiz14->test_ind_outhr; ?></p>
                        <p class="rightadjust"><label> Independent (inside HR):</label> <?php echo $wiz14->test_ind_inhr == '' ? 'N/A' : $wiz14->test_ind_inhr; ?></p>
                        <p class="leftadjust"><label>Supervision Only:</label> <?php echo $wiz14->test_ind_super == '' ? 'N/A' : $wiz14->test_ind_super; ?></p>
                        <p class="rightadjust"><label>Assistance Needed:</label> <?php echo $wiz14->test_ind_assist == '' ? 'N/A' : $wiz14->test_ind_assist; ?></p>
                        <p class="leftadjust"><label>Dependant:</label> <?php echo $wiz14->test_ind_dep == '' ? 'N/A' : $wiz14->test_ind_dep; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Target Range:</h1>
                        <p class="rightadjust"><label>Target Range:</label> <?php echo $wiz14->target == '' ? 'N/A' : $wiz14->target; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Insulin Delivery</h1>
                        <p class="leftadjust"><label>Syringe:</label> <?php echo $wiz14->insulin_type_syringe == '' ? 'No' : $wiz14->insulin_type_syringe; ?></p>
                        <p class="rightadjust"><label>Insulin Pen:</label> <?php echo $wiz14->insulin_type_pen == '' ? 'N/A' : $wiz14->insulin_type_pen; ?></p>
                        <!--<p class="leftadjust"><label>Pump:</label> <?php #echo $wiz14->insulin_type_pump == '' ? 'N/A' : $wiz14->insulin_type_pump;                                                                                                                                                                                                                                                                     ?></p>-->
                        <p class="leftadjust"><label>Pod:</label> <?php echo $wiz14->insulin_type_pod == '' ? 'N/A' : $wiz14->insulin_type_pod; ?></p>
                        <p class="rightadjust"><label>Other:</label> <?php echo $wiz14->insulin_type_other == '' ? 'N/A' : $wiz14->insulin_type_other; ?></p>
                        <p class="leftadjust"><label>Other Description:</label> <?php echo $wiz14->otherins == '' || $wiz14->insulin_type_other == '' ? 'N/A' : $wiz14->otherins; ?></p>
                        <p class="rightadjust"><label>Manufacturer:</label> <?php echo $wiz14->insulin_manu == '' ? 'N/A' : $wiz14->insulin_manu; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Insulin at school</h1>
                        <p class="leftadjust"><label>Insulin at school:</label> <?php echo $wiz14->insulin_school == '' ? 'N/A' : $wiz14->insulin_school; ?></p>
                        <p class="rightadjust"><label>Type of insulin:</label> <?php echo $wiz14->type_ins_school == '' ? 'N/A' : $wiz14->type_ins_school; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>How is dose calculated?</h1>
                        <p class="leftadjust"><label>Correction factor/carb ratio:</label> <?php echo $wiz14->dose_correct == '' ? 'N/A' : $wiz14->dose_correct; ?></p>
                        <p class="rightadjust"><label>Standard lunch dose:</label> <?php echo $wiz14->dose_standard == '' ? 'N/A' : $wiz14->dose_standard; ?></p>
                        <p class="leftadjust"><label>Sliding scale:</label> <?php echo $wiz14->dose_slide == '' ? 'N/A' : $wiz14->dose_slide; ?></p>
                        <p class="rightadjust"><label>Pump/Pod calculations:</label> <?php echo $wiz14->dose_pump == '' ? 'N/A' : $wiz14->dose_pump; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Insulin before lunch?</h1>
                        <p class="leftadjust"><label>Insulin before lunch:</label> <?php echo $wiz14->before_lunch == '' ? 'N/A' : $wiz14->before_lunch; ?></p>
                        <p class="rightadjust"><label>Lunch correction factor:</label> <?php echo $wiz14->lunch_correction == '' ? 'N/A' : $wiz14->lunch_correction; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Insulin for Snack Order?</h1>
                        <p class="leftadjust"><label>Insulin for Snack Order:</label> <?php echo $wiz14->insulin_snack == '' ? 'No' : $wiz14->insulin_snack; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Carbs</h1>
                        <p class="leftadjust"><label>Counts Carbs:</label> <?php echo $wiz14->counts_carbs == '' ? 'No' : $wiz14->counts_carbs; ?></p>
                        <p class="rightadjust"><label>Lunch Carb Ratio:</label> <?php echo $wiz14->lunch_carb == '' ? 'N/A' : $wiz14->lunch_carb; ?></p>
                        <p class="leftadjust"><label>Snack Carb Ratio:</label> <?php echo $wiz14->snack_carb == '' ? 'N/A' : $wiz14->snack_carb; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">

                        <h1>Insulin may be given after lunch if</h1>
                        <p class="rightadjust"><label>Insulin may be given after lunch if:</label> <?php echo $wiz14->after_lunch_reason == '' ? 'N/A' : $wiz14->after_lunch_reason; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">

                        <h1>Breakfast</h1>
                        <p class="leftadjust"><label>Breakfast at School:</label> <?php echo $wiz14->school_breakfast == '' ? 'No' : $wiz14->school_breakfast; ?></p>
                        <p class="rightadjust"><label>Breakfast Carb Ratio:</label> <?php echo $wiz14->break_carb == '' ? 'N/A' : $wiz14->break_carb; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Glucagon</h1>
                        <p class="leftadjust"><label>Glucagon at School:</label> <?php echo $wiz14->school_glucagon == '' ? 'No' : $wiz14->school_glucagon; ?></p>
                        <p class="rightadjust"><label>Glucagon Order (dose/symptoms):</label> <?php echo $wiz14->glucagon_order == '' || $wiz14->school_glucagon == '' ? 'N/A' : $wiz14->glucagon_order; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Emergency Kit</h1>
                           <!--<p class="leftadjust"><label>Treatment for Hypoglycemia:</label> <?php #echo $wiz14->hypo_treatment == '' ? 'N/A' : $wiz14->hypo_treatment;                                                                                                                                                                                                                                                                     ?></p>-->
                        <p class="leftadjust"><label>In HR:</label> <?php echo $wiz14->emer_kit_hr == '' ? 'N/A' : $wiz14->emer_kit_hr; ?></p>
                        <p class="rightadjust"><label>In Classroom:</label> <?php echo $wiz14->emer_kit_class == '' ? 'N/A' : $wiz14->emer_kit_class; ?></p>
                        <p class="leftadjust"><label>Carried with Student:</label> <?php echo $wiz14->emer_kit_carry == '' ? 'N/A' : $wiz14->emer_kit_carry; ?></p>

                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Emergency Kit Contents</h1>
                        <p class="rightadjust"><label>Glucose Gel/Cake Mate:</label> <?php echo $wiz14->kit_contents_glucose_gel == '' ? 'N/A' : $wiz14->kit_contents_glucose_gel; ?></p>
                        <p class="leftadjust"><label>Glucose Tabs:</label> <?php echo $wiz14->kit_contents_glucose_tabs == '' ? 'N/A' : $wiz14->kit_contents_glucose_tabs; ?></p>
                        <p class="rightadjust"><label>Juice:</label> <?php echo $wiz14->kit_contents_juice == '' ? 'N/A' : $wiz14->kit_contents_juice; ?></p>
                        <p class="leftadjust"><label>Snacks:</label> <?php echo $wiz14->kit_contents_snacks == '' ? 'N/A' : $wiz14->kit_contents_snacks; ?></p>
                        <p class="rightadjust"><label>Snacks description:</label> <?php echo $wiz14->emer_snacks == '' || $wiz14->kit_contents_snacks == '' ? 'N/A' : $wiz14->emer_snacks; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Treatments</h1>
                        <p class="leftadjust"><label>Treatment for Hypoglycemia if different than Standard Emergency Action Plan:</label> <?php echo $wiz14->hyper_treatment == '' ? 'N/A' : $wiz14->hyper_treatment; ?></p>
                        <p class="rightadjust"><label>Treatment for Hyperglycemia if different than Standard Emergency Action Plan:</label> <?php echo $wiz14->hypergly_treatment == '' ? 'N/A' : $wiz14->hypergly_treatment; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Insulin for Ketones</h1>
                        <p class="leftadjust"><label>Insulin for Ketones:</label> <?php echo $wiz14->insulin_key == '' ? 'N/A' : $wiz14->insulin_key; ?></p>
                        <p class="rightadjust"><label>Insulin for Ketones Order:</label> <?php echo $wiz14->insulin_key_order == '' ? 'N/A' : $wiz14->insulin_key_order; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Discretionary</h1>
                        <p class="leftadjust"><label>Discretionary Orders:</label> <?php echo $wiz14->discrete == '' ? 'No' : $wiz14->discrete; ?></p>
                        <p class="rightadjust"><label>Discretionary description:</label> <?php echo $wiz14->discretionary_list == '' || $wiz14->discrete == '' ? 'N/A' : $wiz14->discretionary_list; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Home Insulin Order</h1>
                        <p class="leftadjust"><label>Home Insulin Order:</label> <?php echo $wiz14->home_insulin_order == '' ? 'N/A' : $wiz14->home_insulin_order; ?></p>
                        <p class="rightadjust"><label>Lock Down Insulin Orders:</label> <?php echo $wiz14->lockdowndesc == '' ? 'N/A' : $wiz14->lockdowndesc; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Comments</h1>
                        <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz14->diabetes_additional) == '' ? 'N/A' : $wiz14->diabetes_additional; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz14->hide334)): ?>

                    <div class="section-div">
                        <label>Adrenal Insufficiency</label>
                        <p class="leftadjust"><label> Age of diagnosis  :</label> <?= $wiz14->ageofdia == '' ? 'N/A' : $wiz14->ageofdia; ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Has Experienced adrenal crisis</h1>
                        <p class="rightadjust"><label>Has Experienced adrenal crisis:</label> <?= $wiz14->crisis_ex == '' ? 'N/A' : $wiz14->crisis_ex ?> </p>
                        <p class="leftadjust"><label>Date:</label> <?= $wiz14->crisis_date == '' || $wiz14->crisis_ex == '' ? 'N/A' : $wiz14->crisis_date ?> </p>
                        <p class="rightadjust"><label>Symptoms:</label> <?= $wiz14->crisis_symptoms == '' || $wiz14->crisis_ex == '' ? 'N/A' : $wiz14->crisis_symptoms ?> </p>
    <!--                        <p class="leftadjust"><label>Hydrocortisone P.O :</label> <?= $wiz14->hydro == '' ? 'N/A' : $wiz14->hydro ?> </p>
                        <p class="rightadjust"><label>Solu-Cortef IM:</label> <?= $wiz14->solu == '' ? 'N/A' : $wiz14->solu ?> </p>
                        <p class="leftadjust"><label>Other:</label> <?= $wiz14->troher == '' ? 'N/A' : $wiz14->troher ?> </p>-->
                        <div class="divclearboth"></div>
                    </div>

                    <!--Changed on 10-12-12015-->
                    <div class="section-div">
                        <h1>Treatment for Adrenal Crisis</h1>

                        <p class="leftadjust"><label>Hydrocortisone P.O :</label> <?= $wiz14->hydro == '' ? 'N/A' : $wiz14->hydro ?> </p>
                        <p class="rightadjust"><label>Solu-Cortef IM:</label> <?= $wiz14->solu == '' ? 'N/A' : $wiz14->solu ?> </p>
                        <p class="leftadjust"><label>Other:</label> <?= $wiz14->troher == '' ? 'N/A' : $wiz14->troher ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <h1>Emergency Injection Kit</h1>
                        <p class="rightadjust"><label>In health room :</label> <?= $wiz14->healthroom == '' ? 'N/A' : $wiz14->healthroom ?> </p>
                        <p class="leftadjust"><label>In classroom :</label> <?= $wiz14->classroom == '' ? 'N/A' : $wiz14->classroom ?> </p>
                        <p class="rightadjust"><label>Carried with Student:</label> <?= $wiz14->carried == '' ? 'N/A' : $wiz14->carried ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Medical Alert Bracelet or Orders</h1>
                        <p class="leftadjust"><label>Medical Alert bracelet:</label> <?= $wiz14->bracelet == '' ? 'N/A' : $wiz14->bracelet ?> </p>
                        <p class="rightadjust"><label>Sick day orders and meds:</label> <?= $wiz14->sickday == '' ? 'No' : $wiz14->sickday ?> </p>
                        <p class="leftadjust"><label>Lock Down orders and meds:</label> <?= $wiz14->lockdown == '' ? 'N/A' : $wiz14->lockdown ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional comments</h1>
                        <p class="rightadjust"><label>Additional comments:</label> <?= trim($wiz14->addcomments) == '' ? 'N/A' : $wiz14->addcomments ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz14->hide335)): ?>
                    <div class="section-div">
                        <label>Other Diagnosis</label>
                        <p class="leftadjust"><label>Diagnosis or health concern  :</label> <?= $wiz14->health_concern == '' ? 'N/A' : $wiz14->health_concern ?> </p>
                        <p class="rightadjust"><label>Age at time of diagnosis :</label> <?= $wiz14->timedia == '' ? 'N/A' : $wiz14->timedia ?> </p>
                        <p class="leftadjust"><label>Symptoms? </label> <?= $wiz14->od_sym == '' ? 'N/A' : $wiz14->od_sym ?> </p>
                        <p class="rightadjust"><label>How often?</label> <?= $wiz14->od_often == '' ? 'N/A' : $wiz14->od_often ?> </p>
                        <p class="leftadjust"><label>Do the symptoms or treatment for symptoms impact your childâ€™s daily schedule or routine? </label> <?= $wiz14->routine == '' ? 'N/A' : $wiz14->routine ?> </p>
                        <p class="rightadjust"><label>how and when? </label> <?= $wiz14->od_when == '' || $wiz14->routine == '' ? 'N/A' : $wiz14->od_when ?> </p>
                        <p class="leftadjust"><label>When was the last visit to the PCP?:</label> <?= $wiz14->od_lvisit == '' ? 'N/A' : $wiz14->od_lvisit ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Has your child needed to receive urgent care/ emergency care (and/or surgery) for this condition?</h1>
                        <p class="rightadjust"><label>Has your child needed to receive urgent care/ emergency care (and/or surgery) for this condition? </label> <?= $wiz14->or_surg == '' ? 'N/A' : $wiz14->or_surg ?> </p>
                        <p class="leftadjust"><label>How many times ? </label> <?= $wiz14->od_times == '' || $wiz14->or_surg == '' ? 'N/A' : $wiz14->od_times ?> </p>
                        <p class="rightadjust"><label>Last time:  :</label> <?= $wiz14->od_timelast == '' || $wiz14->or_surg == '' ? 'N/A' : $wiz14->od_timelast ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Will medications/treatments be needed at school?</h1>
                        <p class="leftadjust"><label>Will medications/treatments be needed at school? </label> <?= $wiz14->od_needschool == '' ? 'N/A' : $wiz14->od_needschool ?> </p>
                        <p class="rightadjust"><label>Please List :</label> <?= $wiz14->od_desc == '' || $wiz14->od_needschool == '' || $wiz14->od_needschool == '' ? 'N/A' : $wiz14->od_desc ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Other equipment or supplies needed at school?</h1>
                        <p class="leftadjust"><label>Other equipment or supplies needed at school?</label> <?= $wiz14->o_supp == '' ? 'N/A' : $wiz14->o_supp; ?> </p>
                        <p class="rightadjust"><label>please list? </label> <?= $wiz14->o_supp_desc == '' || $wiz14->o_supp == '' ? 'N/A' : $wiz14->o_supp_desc ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Did your child miss school last year due to his/her health condition:</h1>
                        <p class="leftadjust"><label>Did your child miss school last year due to his/her health condition:</label> <?= $wiz14->o_cdue == '' ? 'N/A' : $wiz14->o_cdue ?> </p>
                        <p class="rightadjust"><label>If yes, how many :</label> <?= $wiz14->o_cdue_desc == '' || $wiz14->o_cdue == '' ? 'N/A' : $wiz14->o_cdue_desc ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Does your child have any activity restriction/ PE Restriction related to this diagnosis?</h1>
                        <p class="leftadjust"><label>Does your child have any activity restriction/ PE Restriction related to this diagnosis? </label> <?= $wiz14->o_res == '' ? 'N/A' : $wiz14->o_res ?> </p>
                        <p class="rightadjust"><label>If yes, please describe?</label> <?= $wiz14->o_res_desc == '' || $wiz14->o_res == '' ? 'N/A' : $wiz14->o_res_desc ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Additional Information</h1>
                        <p class="leftadjust"><label>Additional Information </label> <?= $wiz14->od_add_info == '' ? 'N/A' : $wiz14->od_add_info ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz14->hide367)): ?>
                    <div class="section-div">

                        <label>Educational Status</label>
                        <?php if (isset($wiz14->hide367)): ?>
                            <p class="leftadjust"><label>Status:</label> <?php echo $wiz14->edustatus == "" ? 'None' : strtoupper($wiz14->edustatus); ?> </p>
                        <?php endif; ?>
                        <p class="leftadjust"><label>Regular Education:</label> <?php echo $wiz14->edustatus2_regular == 'yes' ? 'Regular Education' : "N/A"; ?> </p>
                        <p class="rightadjust"><label>IEP:</label> <?php echo $wiz14->edustatus2_iep == 'yes' ? 'IEP' : "N/A"; ?></p>
                        <p class="leftadjust"><label>504:</label> <?php echo $wiz14->edustatus2_504 == 'yes' ? '504' : "N/A"; ?></p>
                        <p class="rightadjust"><label>Current Grade: </label><?php echo $wiz14->grade == '' ? 'N/A' : $wiz14->grade; ?></p>
                        <p class="leftadjust"><label>Other Grade: </label><?php echo $wiz14->othergrade == '' || $wiz14->grade <> 'Other' ? 'N/A' : $wiz14->othergrade; ?></p>
                        <p class="rightadjust"><label>Current Individual Educational Assistant: </label> <?php echo $wiz14->assistant == '' ? 'N/A' : $wiz14->assistant; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Services</h1>
                        <p class="leftadjust"><label>Services Used: </label><?php echo $wiz14->assistant == '' ? 'N/A' : $wiz14->assistant; ?></p>
                        <p class="leftadjust"><label> Occupational Therapy: </label> <?php echo $wiz14->eduservices_occupational == '' ? 'N/A' : $wiz14->eduservices_occupational; ?></p>
                        <p class="rightadjust"><label> Physical Therapy:</label> <?php echo $wiz14->eduservices_physical == '' ? 'N/A' : $wiz14->eduservices_physical; ?></p>
                        <p class="leftadjust"><label> Speech/Language:</label> <?php echo $wiz14->eduservices_speech == '' ? 'N/A' : $wiz14->eduservices_speech; ?></p>
                        <p class="rightadjust"><label> Counseling:</label> <?php echo $wiz14->eduservices_counseling == '' ? 'N/A' : $wiz14->eduservices_counseling; ?></p>
                        <p class="leftadjust"><label> Adaptive PE:</label> <?php echo $wiz14->eduservices_pe == '' ? 'N/A' : $wiz14->eduservices_pe; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Teaching</h1>
                        <p class="rightadjust"><label>Home Hospital Teaching:</label>  <?php echo $wiz14->offlocation_hospital == '' ? 'N/A' : $wiz14->offlocation_hospital; ?></p>
                        <p class="leftadjust"><label>Concurrent Home Teaching:</label>  <?php echo $wiz14->offlocation_home == '' ? 'N/A' : $wiz14->offlocation_home; ?></p>
                        <p class="rightadjust"><label>Re-Evaluation Date</label> <?php echo $wiz14->reevaldate == '' ? 'N/A' : $wiz14->reevaldate; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Assistive Technology</h1>
                        <p class="leftadjust"><label>Assistive Technology: </label> <?php echo $wiz14->assist_tech == '' ? 'N/A' : $wiz14->assist_tech; ?></p>
                        <p class="rightadjust"><label>Please List Assistive Technology: </label> <?php echo $wiz14->assist_tech_lt == '' ? 'N/A' : $wiz14->assist_tech_lt; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <h1>Classroom Accommodations</h1>
                        <p class="leftadjust"><label>Classroom Accommodations: </label> <?php echo $wiz14->accomodations == '' ? 'N/A' : $wiz14->accomodations; ?></p>
                        <p class="rightadjust"><label>Classroom Accommodations List: </label> <?php echo $wiz14->accomodations_lt == '' || $wiz14->accomodations == '' ? 'N/A' : $wiz14->accomodations_lt; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>

                <?php $t = '<label>Transportation Status</label>'; ?>

                <?php if (empty($wiz14->hide16)): ?>

                    <label>Transportation Status</label>
                    <div class = "section-div">
                        <?php
                        if (!empty($wiz14->trans_method_walker) || !empty($wiz14->trans_method_car) || !empty($wiz14->trans_method_bus) || !empty($wiz14->trans_method_lift)) {
                            echo $t;
                            $t = '';
                        }
                        ?>
                        <h1>Method of Transportation</h1>
                        <p class = "leftadjust"><label>Walker:</label> <?php echo $wiz14->trans_method_walker == '' ? 'N/A' : $wiz14->trans_method_walker;
                        ?></p>
                        <p class="rightadjust"><label>Car Rider:</label> <?php echo $wiz14->trans_method_car == '' ? 'N/A' : $wiz14->trans_method_car; ?></p>
                        <p class="leftadjust"><label>Bus Rider:</label> <?php echo $wiz14->trans_method_bus == '' ? 'N/A' : $wiz14->trans_method_bus; ?></p>
                        <p class="rightadjust"><label>Lift Bus:</label> <?php echo $wiz14->trans_method_lift == '' ? 'N/A' : $wiz14->trans_method_lift; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <?php
                        if (!empty($wiz14->bus_services_assist) || !empty($wiz14->bus_services_aide) || !empty($wiz14->bus_services_nursing) || !empty($wiz14->bus_services_equip)) {
                            echo $t;
                            $t = '';
                        }
                        ?>
                        <h1>Current Bus Services Provided</h1>
                        <p class="leftadjust"><label>Assistance Needed:</label> <?php echo $wiz14->bus_services_assist == '' ? 'N/A' : $wiz14->bus_services_assist; ?></p>
                        <p class="rightadjust" ><label>Aide on Bus:</label> <?php echo $wiz14->bus_services_aide == '' ? 'N/A' : $wiz14->bus_services_aide; ?></p>
                        <p class="leftadjust"><label>Nursing Services on Bus:</label> <?php echo $wiz14->bus_services_nursing == '' ? 'N/A' : $wiz14->bus_services_nursing; ?></p>
                        <p class="rightadjust"><label>Equipment Checklist Used:</label> <?php echo $wiz14->bus_services_equip == '' ? 'N/A' : $wiz14->bus_services_equip; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <?php
                        if (!empty($wiz14->bus_meds) || !empty($wiz14->list_bus_meds)) {
                            echo $t;
                            $t = '';
                        }
                        ?>
                        <h1>Bus Medication</h1>
                        <p class="leftadjust"><label>Medication on Bus:</label> <?php echo $wiz14->bus_meds == '' ? 'N/A' : $wiz14->bus_meds; ?></p>
                        <p class="rightadjust"><label>If Yes, List:</label> <?php echo $wiz14->list_bus_meds == '' || $wiz14->bus_meds == '' ? 'N/A' : $wiz14->list_bus_meds; ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">
                        <?php
                        if (!empty($wiz14->med_bus_selfadmin) || !empty($wiz14->med_bus_selfmed) || !empty($wiz14->med_bus_aideadmin)) {
                            echo $t;
                            $t = '';
                        }
                        ?>
                        <h1>How is medication handled?</h1>
                        <p class="leftadjust"><label>Self Carries/Self Administers:</label> <?php echo $wiz14->med_bus_selfadmin == '' ? 'N/A' : $wiz14->med_bus_selfadmin; ?></p>
                        <p class="rightadjust"><label>Self Carries/Unable to Self Administer:</label> <?php echo $wiz14->med_bus_selfmed == '' ? 'N/A' : $wiz14->med_bus_selfmed; ?></p>
                        <p class="leftadjust"><label>Driver/Aide Trained to Administer:</label> <?php echo $wiz14->med_bus_aideadmin == '' ? 'N/A' : $wiz14->med_bus_aideadmin; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <?php
                        if (!empty($wiz14->bus_snacks) || !empty($wiz14->bus_snacks)) {
                            echo $t;
                            $t = '';
                        }
                        ?>
                        <h1>Snacks on Bus</h1>
                        <p class="rightadjust"><label>Snacks on Bus:</label> <?php echo $wiz14->bus_snacks == '' ? 'N/A' : $wiz14->bus_snacks; ?></p>
                        <p class="leftadjust"><label>If Yes, List:</label> <?php echo $wiz14->bus_snacks <> 'yes' || $wiz14->describe_Snacks == '' ? 'N/A' : $wiz14->describe_Snacks; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <?php
                        if (!empty($wiz14->bus_mod) || !empty($wiz14->bus_mod_list)) {
                            echo $t;
                            $t = '';
                        }
                        ?>
                        <h1>Special Modifications Needed for Bus?</h1>
                        <p class="rightadjust"><label>Special Modifications Needed for Bus?:</label> <?php echo $wiz14->bus_mod == '' ? 'N/A' : $wiz14->bus_mod; ?></p>
                        <p class="leftadjust"><label>If Yes, List Special Modifications Needed:</label> <?php echo $wiz14->bus_mod_list == '' || $wiz14->bus_mod == '' ? 'N/A' : $wiz14->bus_mod_list; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                    <div class="section-div">
                        <?php
                        if (!empty($wiz14->trans_comments) || !empty($wiz14->trans_field)) {
                            echo $t;
                            $t = '';
                        }
                        ?>
                        <h1>Additional Comments</h1>
                        <p class="rightadjust"><label>Additional Comments:</label> <?php echo trim($wiz14->trans_comments) == '' ? 'N/A' : $wiz14->trans_comments; ?></p>
                        <p class="leftadjust"><label>Needs for Field Trips:</label> <?php echo $wiz14->trans_field == '' ? 'N/A' : $wiz14->trans_field; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz16->hide17)): ?>
                    <div class="section-div">

                        <label>Additional Information/Specific Cultural Beliefs</label>

                        <h1>Awareness of safety issues/behaviors/awareness of pain/soothers:</h1>
                        <p class="leftadjust"><label>Cultural Information:</label> <?php echo $wiz16->cultural_info == '' ? 'N/A' : $wiz16->cultural_info; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz16->hide188)): ?>
                    <?php
                    if (!empty($wiz16->planname1) || !empty($wiz16->planname2) || !empty($wiz16->planname3) ||
                            !empty($wiz16->planname4) || !empty($wiz16->planname5) || !empty($wiz16->planname6) ||
                            !empty($wiz16->planname7)):
                        ?>
                        <div class="section-div">
                            <p class="leftadjust"><label></label> <?php echo $wiz16->planname1 == '' ? ' <label style="color: black !important; font-weight: bold;font-size:18px;margin-left: -22px;width: 217px;">Emergency Action Plans </label>' : '<label style="color: black !important; font-weight: bold;font-size:18px;margin-left: -22px;width: 217px;">Emergency Action Plans </label>'; ?></p>
                            <div class="divclearboth"></div>
                        </div>
                    <?php endif; ?>
                    <div class="section-div">

                        <h1>Seizure Plans:</h1>
                        <p class="leftadjust"><label>Seizure Plan:</label> <?php echo $wiz16->planname1 == '' ? 'N/A' : $wiz16->planname1; ?></p>
                        <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz16->hcap_seizure_teacher == '' || $wiz16->planname1 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Bus:</label> <?php echo $wiz16->hcap_seizure_bus == '' || $wiz16->planname1 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>HR File:</label> <?php echo $wiz16->hcap_seizure_hr == '' || $wiz16->planname1 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz16->hcap_seizure_review == '' || $wiz16->planname1 == '' ? 'N/A' : ($wiz16->hcap_seizure_review); ?></p>
                        <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz16->hcap_seizure_dist == '' || $wiz16->planname1 == '' ? 'N/A' : ($wiz16->hcap_seizure_dist); ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Hypo/Hyperglycemia Plans:</h1>
                        <p class="leftadjust"><label>Hypo/Hyperglycemia Plan:</label> <?php echo $wiz16->planname2 == '' ? 'N/A' : $wiz16->planname2; ?></p>
                        <p class="leftadjust"><label>Teachers:</label> <?php echo $wiz16->hcap_hypo_teacher == '' || $wiz16->planname2 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>Bus:</label> <?php echo $wiz16->hcap_hypo_bus == '' || $wiz16->planname2 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>HR File:</label> <?php echo $wiz16->hcap_hypo_hr == '' || $wiz16->planname2 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>Date Reviewed:</label> <?php echo $wiz16->hcap_hypo_review == '' || $wiz16->planname2 == '' ? 'N/A' : ($wiz16->hcap_hypo_review); ?></p>
                        <p class="leftadjust"><label>Date Distributed:</label> <?php echo $wiz16->hcap_hypo_dist == '' || $wiz16->planname2 == '' ? 'N/A' : ($wiz16->hcap_hypo_dist); ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Allergy Plans:</h1>
                        <p class="leftadjust"><label>Allergy Plan:</label> <?php echo $wiz16->planname3 == '' ? 'N/A' : $wiz16->planname3; ?></p>
                        <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz16->hcap_allergy_teacher == '' || $wiz16->planname3 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Bus:</label> <?php echo $wiz16->hcap_allergy_bus == '' || $wiz16->planname3 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>HR File:</label> <?php echo $wiz16->hcap_allergy_hr == '' || $wiz16->planname3 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz16->hcap_allergy_review == '' || $wiz16->planname3 == '' ? 'N/A' : ($wiz16->hcap_allergy_review); ?></p>
                        <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz16->hcap_allergy_dist == '' || $wiz16->planname3 == '' ? 'N/A' : ($wiz16->hcap_allergy_dist); ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>G-Tube Replacement Plans:</h1>
                        <p class="leftadjust"><label>G-Tube Replacement Plan:</label> <?php echo $wiz16->planname4 == '' ? 'N/A' : $wiz16->planname4; ?></p>
                        <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz16->hcap_gtube_teacher == '' || $wiz16->planname4 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Bus:</label> <?php echo $wiz16->hcap_gtube_bus == '' || $wiz16->planname4 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>HR File:</label> <?php echo $wiz16->hcap_gtube_hr == '' || $wiz16->planname4 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz16->hcap_gtube_review == '' || $wiz16->planname4 == '' ? 'N/A' : ($wiz16->hcap_gtube_review); ?></p>
                        <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz16->hcap_gtube_dist == '' || $wiz16->planname4 == '' ? 'N/A' : ($wiz16->hcap_gtube_dist); ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Cardiac Plans:</h1>
                        <p class="leftadjust"><label>Cardiac Plan:</label> <?php echo $wiz16->planname5 == '' ? 'N/A' : $wiz16->planname5; ?></p>
                        <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz16->hcap_cardiac_teacher == '' || $wiz16->planname5 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Bus:</label> <?php echo $wiz16->hcap_cardiac_bus == '' || $wiz16->planname5 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>HR File:</label> <?php echo $wiz16->hcap_cardiac_hr == '' || $wiz16->planname5 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz16->hcap_cardiac_review == '' || $wiz16->planname5 == '' ? 'N/A' : ($wiz16->hcap_cardiac_review); ?></p>
                        <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz16->hcap_cardiac_dist == '' || $wiz16->planname5 == '' ? 'N/A' : ($wiz16->hcap_cardiac_dist); ?></p>
                        <div class="divclearboth"></div>
                    </div>

                    <div class="section-div">

                        <h1>Respiratory Distress Plans:</h1>
                        <p class="leftadjust"><label>Respiratory Distress Plan:</label> <?php echo $wiz16->planname6 == '' ? 'N/A' : $wiz16->planname6; ?></p>
                        <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz16->hcap_resp_teacher == '' || $wiz16->planname6 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Bus:</label> <?php echo $wiz16->hcap_resp_bus == '' || $wiz16->planname6 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="rightadjust"><label>HR File:</label> <?php echo $wiz16->hcap_resp_hr == '' || $wiz16->planname6 == '' ? 'N/A' : 'Yes'; ?></p>
                        <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz16->hcap_resp_review == '' || $wiz16->planname6 == '' ? 'N/A' : ($wiz16->hcap_resp_review); ?></p>
                        <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz16->hcap_resp_dist == '' || $wiz16->planname6 == '' ? 'N/A' : ($wiz16->hcap_resp_dist); ?></p>
                        <div class="divclearboth"></div>
                    </div>


                    <?php
                    foreach ($wiz16->planname7 as $key => $prnMedications):

                        if ($key > 0):
                            if ($wiz16->planname7 == ''):
                                continue;
                            endif;
                        endif;
                        ?>
                        <div class="section-div">
                            <h1><?php echo ($key == 0) ? 'Emergency Exit Plans' : $wiz16->newplanname[$key]; ?></h1>
                            <p class="leftadjust"><label><?php echo ($key == 0) ? 'Emergency Exit Plans' : $wiz16->newplanname[$key]; ?></label> <?php echo $wiz16->planname7[$key] == '' ? 'N/A' : $wiz16->planname7[$key]; ?></p>
                            <p class="leftadjust"><label>Teachers:</label> <?php echo $wiz16->hcap_emer_teacher[$key] == '' || $wiz16->planname7[$key] == '' ? 'N/A' : 'Yes'; ?></p>
                            <p class="rightadjust"><label>Bus:</label> <?php echo $wiz16->hcap_emer_bus[$key] == '' || $wiz16->planname7[$key] == '' ? 'N/A' : 'Yes'; ?></p>
                            <p class="leftadjust"><label>HR File:</label> <?php echo $wiz16->hcap_emer_hr[$key] == '' || $wiz16->planname7[$key] == '' ? 'N/A' : 'Yes'; ?></p>
                            <p class="rightadjust"><label>Date Reviewed:</label> <?php echo $wiz16->hcap_emer_review[$key] == '' || $wiz16->planname7[$key] == '' ? 'N/A' : ($wiz16->hcap_emer_review[$key]); ?></p>
                            <p class="leftadjust"><label>Date Distributed:</label> <?php echo $wiz16->hcap_emer_dist[$key] == '' || $wiz16->planname7[$key] == '' ? 'N/A' : ($wiz16->hcap_emer_dist[$key]); ?></p>


                            <div class="divclearboth"></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (empty($wiz16->hide19)): ?>
                    <div class="section-div">
                        <label>Needs for School Attendance:</label>
                        <?php //echo $wiz16->delegatable;             ?>
                        <p class="leftadjust"><label>Delegatable Nursing Services During the School Day:</label> <?php echo $wiz16->delegatable == '' ? 'N/A' : $wiz16->delegatable; ?></p>
                        <p class="rightadjust"><label>NON-Delegatable Nursing Services During the School Day:</label> <?php echo $wiz16->non_delegatable == '' ? 'N/A' : $wiz16->non_delegatable; ?></p>
                        <p class="leftadjust"><label>Parents Will Provide:</label> <?php echo $wiz16->parents_provide == '' ? 'N/A' : $wiz16->parents_provide; ?></p>
                        <p class="rightadjust"><label>School Will Provide:</label> <?php echo $wiz16->school_provide == '' ? 'N/A' : $wiz16->school_provide; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
                <?php if (empty($wiz16->hide115)): ?>
                    <div class="section-div">

                        <label>Individualized Healthcare Plan</label>
                        <?php
                        if (!empty($wiz16->ihp) && $wiz16->ihp == 'ip') {
                            $wiz16->ihp = "In Progress";
                        } else if (!empty($wiz16->ihp) && $wiz16->ihp == 'no') {
                            $wiz16->ihp = "No";
                        } else if (!empty($wiz16->ihp) && $wiz16->ihp == 'yes') {
                            $wiz16->ihp = "yes";
                        }
                        ?>
                        <p class="leftadjust"> <label>IHP:</label> <?php echo $wiz16->ihp == '' ? 'N/A' : $wiz16->ihp; ?></p>
                        <div class="divclearboth"></div>
                    </div>
                <?php endif; ?>
            </div>

            <fieldset>
                <section style="width: 100%;">
                    <div id="data-available">
                    </div>
                </section>
<!--                <section style="width: 100%;">
                    <div id="no-data">
                    </div>
                </section>-->
            </fieldset>
        </div>
    </section>
</body>



<script>
    $(document).ready(function() {

        if (window.location.href.indexOf('reload') == -1) {
            window.location.replace(window.location.href + '/reload');
        }
        /* Remove all cookies */
        $('#print').click(function() {
            window.print();
        });
        //Orginal
        $('div.section-div').each(function() {
            var totalHtml = $(this).outerHTML();
            var appendHtml = $(this).find("h1").html();
            var counter = 0;
            var lengthOfNA = $(this).find('p label').remove('label');
            $(this).find('p').each(function() {
                if ($.trim($(this).html()) === "N/A" || $.trim($(this).html()) === 'No' || $.trim($(this).html()) === 'no') {
                    counter++;
                }
            });
            if ($(this).find('p').length === counter) {
                if (appendHtml)
                    $('div#no-data').append("<h1>" + appendHtml + "</h1>").append("<p>No Need At This Time</p>");
            }
            else {

                $('div#data-available').append(totalHtml);
            }
        })
                .promise().done(function() {
            $('div#data-available').each(function() {
                $(this).find('p').each(function() {
                    spl = $(this).html().split('</label>');
                    if (spl[1]) {

                        //                        if ($.trim(spl[1].indexOf("N/A")) != -1 || $.trim(spl[1].indexOf("No")) != -1 || $.trim(spl[1].indexOf("no")) != -1) {
                        //                            $(this).remove();  // Here remove the empty data (N/A)
                        //                        }
                        if (($.trim(spl[1]) == "N/A") || ($.trim(spl[1]) == "No") || ($.trim(spl[1]) == "no")) {

                            $(this).remove();  // Here remove the empty data (N/A)
                        }
                    }
                });
            });
            $('div.first-divs').remove();
        })
                .promise().done(function() {
            $('div.section-div').each(function() {
                $(this).find("p").each(function(index) {
                    $(this).removeClass('leftadjust').removeClass('rightadjust'); // Remove the default class (LA/RA)
                    if (index % 2) {     // take the each value and mod it
                        $(this).addClass('rightadjust');
                    }
                    else {
                        $(this).addClass('leftadjust');
                    }
                });
            });
        });
    });
    jQuery.fn.outerHTML = function(s) {
        return s
                ? this.before(s).remove()
                : jQuery("<p>").append(this.eq(0).clone()).html();
    };

</script>


<?php
$status = check_form_status($wiz01->sif);
if (empty($status)):
    $status = check_form_status_firstrow($wiz01->sif);
endif;
if ($status['wizard_status'] == 45) {
    ?>
    <style>
        /* Add Watermark here */

        @page
        {
            size: auto;   /* auto is the current printer page size */
            margin: 1.0cm;  /* this affects the margin in the printer settings */
        }

        section.page {

            background:#fff url('<?php echo base_url(); ?>assets/images/completed.png') center;
            background-position: -9999px -9999px;
            background-repeat: repeat-y;
            -webkit-print-color-adjust: exact;
            margin-top:60px;
            -moz-box-shadow: 2px 3px 2px #fff;
            -webkit-box-shadow: 2px 3px 2px #fff;
            box-shadow: 2px 3px 2px #fff;


        }
        .section-div > label {
            font-size:18px;
        }
        @media print{

            body{ background-color:#FFFFFF; color:#000000; margin: 10mm 0mm 10mm 0mm; }
            #ad{ display:none;}
            #leftbar{ display:none;}
            #contentarea{ width:100%;}
            .assessmentActions{
                display: none;
            }
            section.page {
                margin: 10mm 0mm 10mm 0mm;
                background:url('<?php echo base_url(); ?>assets/images/completed.png') center left 220px;
                background-position: initial;
                background-repeat: repeat-y;
                -webkit-print-color-adjust: exact;
                -moz-box-shadow: 2px 3px 2px #fff;
                -webkit-box-shadow: 2px 3px 2px #fff;
                box-shadow: 2px 3px 2px #fff;
            }


            .healthform section { background:none;}
            .wrapper {
                background: none;
            }
            .viewsh1 h1 { background:none;}
            .viewsh1 p {   border-bottom: 0px solid #f2f2f2; margin-right : 35px;}
            #print-logo { display:block; text-align:center; width:117px; height:62px; margin:0px 0px 20px 20px; background:url(<?php echo base_url() . "assets/images/md-logo.jpg" ?>)}


        }

        h1{
            font-weight: bolder;
            color:#000;
        }
        .leftadjust > label {
            display: block;
            width: 150px;
            word-break: break-all;
            word-break: keep-all;
        }
        .rightadjust > label {
            display: block;
            width: 150px;
            word-break: break-all;
            word-break: keep-all;
        }


    </style>

<?php } ?>

<?php
if ($status['wizard_status'] <> 45) {
    ?>
    <style>
        /* Add Watermark here */

        @page
        {
            size: auto;   /* auto is the current printer page size */
            margin: 1.0cm;  /* this affects the margin in the printer settings */
        }

        section.page {

            background:#fff url('<?php echo base_url(); ?>assets/images/draft.png') center;
            background-position: -9999px -9999px;
            background-repeat: repeat-y;
            -webkit-print-color-adjust: exact;
            margin-top:60px;
            -moz-box-shadow: 2px 3px 2px #fff;
            -webkit-box-shadow: 2px 3px 2px #fff;
            box-shadow: 2px 3px 2px #fff;


        }
        .section-div > label {
            font-size:18px;
        }
        #bg-text > .first-divs{
            display: none;
        }
        @media print{

            body{ background-color:#FFFFFF; color:#000000; margin: 10mm 0mm 10mm 0mm; }
            #ad{ display:none;}
            #leftbar{ display:none;}
            #contentarea{ width:100%;}
            .assessmentActions{
                display: none;
            }
            section.page {
                margin: 10mm 0mm 10mm 0mm;
                background:url('<?php echo base_url(); ?>assets/images/draft.png') center left 220px;
                background-position: initial;
                background-repeat: repeat-y;
                -webkit-print-color-adjust: exact;
                -moz-box-shadow: 2px 3px 2px #fff;
                -webkit-box-shadow: 2px 3px 2px #fff;
                box-shadow: 2px 3px 2px #fff;
            }


            .healthform section { background:none;}
            .wrapper {
                background: none;
            }
            .viewsh1 h1 { background:none;}
            .viewsh1 p {   border-bottom: 0px solid #f2f2f2; margin-right : 35px;}
            #print-logo { display:block; text-align:center; width:117px; height:62px; margin:0px 0px 20px 20px; background:url(<?php echo base_url() . "assets/images/md-logo.jpg" ?>)}


        }

        h1{
            font-weight: bolder;
            color:#000;
        }
        .leftadjust > label {
            display:block;
            width:150px;
            word-wrap:break-word;
            word-break: keep-all;
        }
        .rightadjust > label {
            display:block;
            width:150px;
            word-wrap:break-word;
            word-break: keep-all;
        }



    </style>

<?php } ?>
