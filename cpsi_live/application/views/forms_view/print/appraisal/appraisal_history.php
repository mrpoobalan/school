<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$next_button = array('id' => 'view_print_appraisal', 'name' => 'view_print_appraisal', 'class' => "button", 'value' => 'View Print Page', 'type' => 'submit', 'content' => 'View Print Page');
$attr_FormOpen = array('id' => "appraisal", 'class' => "healthform");

if (empty($wiz01) && empty($wiz02) && empty($wiz03) && empty($wiz04) && empty($wiz05) && empty($wiz06)):
    $msg = "There is no data to be edited";
endif;

function date_change($val) {
    $res = str_replace('_', '-', $val);
    $exp = explode("-", $res);

//return $exp[1] . "-" . $exp[2] . "-" . $exp[0];
    $dob = $exp[1] . "-" . $exp[2] . "-" . $exp[0];

    if ($dob == '01-01-1970') {
        return "";
    } else {
        return $dob;
    }
}

//if (empty($wiz01)):
//    $url = $this->uri->segment(4);
//    $url = explode('-', $url);
//    $sifnum = end(explode('_', $url[0]));
//endif;

$sifnum = end(explode("_", $this->uri->segment(4)));
$autoid = $this->uri->segment(5);
$sifunum = $this->uri->segment(7);
$arguments = $sifnum . "-" . $autoid . "-" . $sifunum;
$status = check_app_form_status_history($sifnum);
if (empty($status)):
    $status = check_app_form_status_history_firstrow($sifnum);
endif;

$name_details = get_fullname_history();
$userrole = check_user_role($this->session->userdata('user_id'));
$userrole_decode = json_decode(json_encode($userrole), true);
$get_names = get_last_name_view($wiz01->sif);
$form = $this->uri->segment(5);
$path = "access_control/admin/audit_trail/appraisal_wiz01_$arguments/res";
$subtitle = "View Audit Trail";
$created_date = $this->uri->segment(8);
$version = $created_date . " - " . $name_details['first_name'] . " " . $name_details['last_name'] . " - " . $status['form_type'];
?>
<style type="text/css">
    p{
        font-weight: bold;
    }
    .page.noshadow{
        box-shadow: 0 0 6px 4px rgba(119, 119, 119, 0);
    }
    .page.healthform.viewsh1.noshadow {
        margin-top: -400px;
    }
</style>
<body>
    <section class = "page">
        <div class=" col-lg-12">
            <h1 style="background: none"><?= $subtitle ?></h1>
            <div style="float: right">
                <form name="view_version" id="view_version" method="post" action="<?php echo base_url() . $path; ?>" >
                    <input type="hidden" name="<?php echo ($userrole_decode['name'] == "Nurse") ? "sif" : "sif"; ?>"
                           id="<?php echo ($userrole_decode['name'] == "Nurse") ? "sif" : "sif"; ?>"
                           value ="<?php echo ($userrole_decode['name'] == "Nurse") ? $wiz01->sif : $wiz01->sif; ?>"  >
                    <input type="submit" name='back' id='back' value='back' class="btn">
                </form>
            </div>
        </div>
        <br>
        <br>
        <div class="section-divs">
            <p><label> SIF:</label><?php echo $sifnum != '' ? $sifnum : 'N/A'; ?> </p>
            <p>&nbsp;</p>
            <p><label> Name:</label> <?php echo $status['first_name'] . " " . $status['last_name'] ?></p>
            <p>&nbsp;</p>
            <?php if (date_change($status['birth_date']) != '') { ?>
                <p><label> DOB:</label> <?php echo date_change($status['birth_date']) != '' ? date_change($status['birth_date']) : 'N/A'; ?> </p>
                <p>&nbsp;</p>
            <?php } ?>

            <p><label> School:</label><?php echo $status['student_school']; ?></p>
            <p>&nbsp;</p>
            <p><label> Version:</label> <?php echo $version; ?></p>
            <p>&nbsp;</p>

        </div>
    </section>

    <section class = "page healthform viewsh1 noshadow">
        <div class="section-divs">
            <h1> <strong> Edits Made: </strong> </h1>
            <h2 style="padding-left: 9px; margin-top: 25px;"><?php echo $msg; ?></h2>
            <div class="assessmentActions"><?#= $appraisal_actions ?></div>
        </div>
        <div class="first-divs">
            <div class="section-div">
                <p class="leftadjust"><label>SIF Number:</label> <?= $wiz01->sif == '' ? 'N/A' : $wiz01->sif ?> </p>
                <p class="rightadjust"><label>State Number</label> <?= $wiz01->statenum == '' ? 'N/A' : $wiz01->statenum ?> </p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">

                <label>Student Information</label>
                <?php
                if ($wiz01->dob == '1970-01-01') {
                    $wiz01->dob = '';
                }
                ?>
                <p class="leftadjust"><label>First Name:</label> <?php echo $wiz01->fname != '' ? $wiz01->fname : 'N/A' ?></p>
                <p class="rightadjust"><label>Last Name:</label> <?php echo $wiz01->lname != '' ? $wiz01->lname : 'N/A'; ?></p>
                <p  class="leftadjust"><label>Nickname:</label> <?php echo $wiz01->nickname != '' ? $wiz01->nickname : 'N/A'; ?></p>
                <p class="rightadjust"><label>Date of Birth:</label> <?php echo $wiz01->dob != '' ? date('m/d/Y', strtotime($wiz01->dob)) : 'N/A'; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">


                <label>Parent/Guardian Information</label>

                <p class="leftadjust"><label>Parent(s)/Guardian(s):</label> <?php echo $wiz01->parentname != '' ? $wiz01->parentname : 'N/A'; ?></p>
                <p class="rightadjust"><label >Address:</label> <?php echo $wiz01->street != '' ? $wiz01->street : 'N/A'; ?>  <?php echo '<br>' . $wiz01->city ?>, <?php echo '<br>' . $wiz01->zip ?></p>
                <p class="leftadjust"><label>Home Phone Number:</label> <?php echo $wiz01->homephone != '' ? $wiz01->homephone : 'N/A'; ?></p>
                <p class="rightadjust"><label>Cell Phone Number:</label> <?php echo $wiz01->cellphone != '' ? $wiz01->cellphone : 'N/A'; ?></p>
                <p class="leftadjust"><label>Work Phone Number:</label> <?php echo $wiz01->workphone != '' ? $wiz01->workphone : 'N/A'; ?></p>
                <div class="divclearboth"></div>
            </div>

            <?php
            foreach ($wiz01->sheepItForm1_addtnlcontact as $key => $agencies):

                if ($key > 0):
                    if ($wiz01->sheepItForm1_addtnlcontact[$key] == '' && $wiz01->sheepItForm1_relationship[$key] == '' && $wiz01->sheepItForm1_addtnlcellphone[$key] == '' && $wiz01->sheepItForm1_addtnlhomephone[$key] == ''):
                        continue;
                    endif;
                endif;
                ?>
                <div class="section-div">
                    <label>Additional Contact <?php echo $key + 1; ?></label>
                    <p class="leftadjust"><label>Additional Contact :</label> <?php echo $wiz01->sheepItForm1_addtnlcontact[$key] == '' ? 'N/A' : $wiz01->sheepItForm1_addtnlcontact[$key]; ?></p>
                    <p class="rightadjust"><label>Relationship :</label> <?php echo $wiz01->sheepItForm1_relationship[$key] == '' ? 'N/A' : $wiz01->sheepItForm1_relationship[$key]; ?></p>
                    <p class="leftadjust"><label>Cell Phone Number:</label> <?php echo $wiz01->sheepItForm1_addtnlcellphone[$key] == '' ? 'N/A' : $wiz01->sheepItForm1_addtnlcellphone[$key]; ?></p>
                    <p class="rightadjust"><label>Home Phone Number:</label> <?php echo $wiz01->sheepItForm1_addtnlhomephone[$key] == '' ? 'N/A' : $wiz01->sheepItForm1_addtnlhomephone[$key]; ?></p>
                    <p class="leftadjust"><label>Work Phone Number:</label> <?php echo $wiz01->sheepItForm1_addtnlworkphone[$key] == '' ? 'N/A' : $wiz01->sheepItForm1_addtnlworkphone[$key]; ?></p>
                    <div class="divclearboth"></div>
                </div>
            <?php endforeach; ?>

            <div class="section-div">
                <label>Insurance</label>
                <p class="leftadjust"><label> Private:</label> <?php echo in_array('private', $insurance) ? 'Private' : 'N/A'; ?> </p>
                <p class="rightadjust"><label> MCHP:</label> <?php echo in_array('MCHP', $insurance) ? 'MCHP' : 'N/A'; ?></p>
                <p class="leftadjust"><label> Medicaid:</label> <?php echo in_array('Medicaid', $insurance) ? 'Medicaid' : 'N/A'; ?> </p>
                <p class="rightadjust"><label> None:</label> <?php echo in_array('None', $insurance) ? 'None' : 'N/A'; ?> </p>
                <p class="leftadjust"><label> Other:</label> <?php echo in_array('Other', $insurance) ? 'Other' : 'N/A'; ?></p>
                <p class="rightadjust"><label>Other Insure:</label> <?= $wiz01->other_insure == '' ? 'N/A' : $wiz01->other_insure ?> </p>
                <p class="leftadjust"><label>Preferred Hospital: </label><?php echo $wiz01->preferred_hospital != '' ? $wiz01->preferred_hospital : 'N/A'; ?></p>
                <p class="rightadjust"><label>Is there a DNR Order: </label><?php echo $wiz01->dnrorder != '' ? $wiz01->dnrorder : 'N/A'; ?></p>
                <p class="leftadjust" <?php if ($wiz01->preferred_hospital != '' && $wiz01->schoolplan != ''): ?> id="bgpaln" <?php endif; ?>><label>The School team has developed a plan: </label><?php echo $wiz01->preferred_hospital != '' && $wiz01->schoolplan != '' ? $wiz01->schoolplan : 'N/A'; ?></p>
                <p class="rightadjust"><label>Immunization Current?</label> <?php echo $wiz01->immunized != '' ? $wiz01->immunized : 'No' ?></p>
                <p class="leftadjust"><label>immunocompromised</label> <?php echo $wiz01->immunocompromised != '' ? $wiz01->immunocompromised : 'No' ?></p>
                <p class="rightadjust"><label>Religious Exemption:</label> <?php echo in_array('Religious', $exempt) ? 'Religious' : 'N/A'; ?> </p>
                <p class="leftadjust"><label>Medical Exemption:</label> <?php echo in_array('Medical', $exempt) ? 'Medical' : 'N/A'; ?></p>
                <p class="rightadjust"><label>Medical reason:</label> <?= $wiz01->medical_reason == '' ? 'N/A' : $wiz01->medical_reason ?> </p>
                <?php
                $date = explode(",", $wiz01->contactattempt1);
                foreach ($date as $val) {
                    if ($val <> "") {
                        $res = explode("-", $val);
                        $resval = $resval . $res[1] . "/" . $res[2] . "/" . $res[0] . " ";
                    }
                }
                if ($wiz01->contactattempt1 == "1970-01-01" || $wiz01->contactattempt1 == '1970-01-01,'):
                    $wiz01->contactattempt1 = "";
                endif;
                ?>
                <p class="leftadjust"><label>Contact Attempts1</label><?php echo $wiz01->contactattempt1 == '' ? 'N/A' : rtrim($resval); ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <?php $medicaldiag = rtrim($wiz02->newdiagnosis, ','); ?>
                <label>Medical Diagnosis:</label>
                <p class="rightadjust"><label>Medical Diagnosis:</label> <?php echo $medicaldiag == '' ? 'N/A' : rtrim($wiz02->newdiagnosis, ','); ?></p>
                <div class="divclearboth"></div>
            </div>


            <div class="section-div">
                <label>Background</label>
                <p class="leftadjust"><label>Birth Weight: </label> <?php echo $wiz02->birthweight == '' ? 'N/A' : $wiz02->birthweight; ?></p>
                <p class="rightadjust"><label>Gestation: </label> <?php echo $wiz02->gestation == '' ? 'N/A' : $wiz02->gestation; ?></p>
                <p class="leftadjust"><label>Birth Type: </label> <?php echo $wiz02->birthtype[0] == '' ? 'N/A' : $wiz02->birthtype[0] ?></p>
                <!--$wiz02->milestones-->
                <p class="rightadjust"><label>Developmental Milestones Met:</label> <?php echo $wiz02->milestones <> 'milestoneyes' ? 'None' : 'Yes'; ?></p>
                <p class="leftadjust"><label>If no, please describe:</label> <?php echo $wiz02->describemilestones == '' || $wiz02->milestones == 'milestoneyes' ? 'N/A' : $wiz02->describemilestones; ?></p>
                <p class="rightadjust"><label>Complications:</label> <?php echo $wiz02->complications == '' ? 'N/A' : $wiz02->complications; ?></p>
                <p class="leftadjust"><label>If yes Complications , please describe:</label> <?php echo $wiz02->describe_complications == '' || $wiz02->complications == 'no' ? 'N/A' : $wiz02->describe_complications; ?></p>
                <p class="rightadjust"><label>Emergencies, Hospitalizations, or Surgeries:</label> <?php echo $wiz02->emergencies == '' ? 'N/A' : $wiz02->emergencies; ?></p>
                <p class="leftadjust"><label>If yes Emergencies, please describe:</label> <?php echo $wiz02->describe_emergencies == '' || $wiz02->emergencies == 'no' ? 'N/A' : $wiz02->describe_emergencies; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>History of Diagnosis/Current Health Status</label>
                <p class="leftadjust"><label>See Previous Nursing Assessment Dated:</label><?php echo $wiz02->previous == '' ? 'N/A' : $wiz02->previous ?></p>
                <p class="rightadjust"><label>Narrative:</label> <?php echo $wiz02->narrative == '' ? 'N/A' : $wiz02->narrative ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Physicians </label>
                <p class="leftadjust"><label>Primary Care:</label> <?= $wiz03->primary == '' ? 'N/A' : $wiz03->primary ?> </p>

                <p class="rightadjust"><label>Last Exam1:</label> <?= $wiz03->lastexam1 == '' ? 'N/A' : $wiz03->lastexam1 ?> </p>
                <p class="leftadjust"><label>Next Exam1:</label> <?= $wiz03->nextexam1 == '' ? 'N/A' : $wiz03->nextexam1 ?> </p>
                <p class="rightadjust"><label>Phone1:</label> <?= $wiz03->phone1 == '' ? 'N/A' : $wiz03->phone1 ?> </p>
                <p class="leftadjust"><label>Fax1:</label> <?= $wiz03->fax1 == '' ? 'N/A' : $wiz03->fax1 ?> </p>
                <p class="rightadjust"><label>Release:</label> <?= $wiz03->release1 == '' ? 'N/A' : "Yes" ?> </p>
                <p class="leftadjust"><label>List or Explain:</label> <?= $wiz03->describe_release1 == '' || $wiz03->releaseexp1 == '' ? 'N/A' : $wiz03->describe_release1 ?> </p>
                <p class="rightadjust"><label>Release expiration1:</label> <?= $wiz03->releaseexp1 == '' ? 'N/A' : $wiz03->releaseexp1 ?> </p>
                <div class="divclearboth"></div>
            </div>
            <?php
            foreach ($wiz03->sheepItForm1_specialist as $key => $specialists):

                if ($key > 0):
                    if ($wiz03->sheepItForm1_specialist[$key] == '' && $wiz03->sheepItForm1_lastexam[$key] == '' && $wiz03->sheepItForm1_nextexam[$key] == '' && $wiz03->sheepItForm1_phone[$key] == '' && $wiz03->sheepItForm1_fax[$key] == '' && $wiz03->sheepItForm1_release0[$key] == '' && $wiz03->sheepItForm1_releaseexp[$key] == ''):
                        continue;
                    endif;
                endif;
                ?>
                <div class="section-div">
                    <label>Specialist Information <?php echo $key + 1; ?></label>
                    <p class="leftadjust"><label>Specialist Name:</label> <?php echo $wiz03->sheepItForm1_specialist[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_specialist[$key]; ?></p>
                    <p class="rightadjust"><label>Type of Physician:</label> <?php echo $wiz03->sheepItForm1_type[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_type[$key]; ?></p>
                    <p class="leftadjust"><label>Last Exam:</label> <?php echo $wiz03->sheepItForm1_lastexam[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_lastexam[$key]; ?></p>
                    <p class="rightadjust"><label>Next Exam:</label> <?php echo $wiz03->sheepItForm1_nextexam[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_nextexam[$key]; ?></p>
                    <p class="leftadjust"><label>Phone:</label> <?php echo $wiz03->sheepItForm1_phone[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_phone[$key]; ?></p>
                    <p class="rightadjust"><label>Fax:</label> <?php echo $wiz03->sheepItForm1_fax[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_fax[$key]; ?></p>
                    <p class="leftadjust"><label>Specialist Release:</label> <?php echo $wiz03->sheepItForm1_release0[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Specialist Description:</label> <?php echo $wiz03->sheepItForm1_describe_sheepItForm[$key] == '' || $wiz03->sheepItForm1_release0[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_describe_sheepItForm[$key]; ?></p>
                    <p class="leftadjust"><label>Release Expiration:</label> <?php echo $wiz03->sheepItForm1_releaseexp[$key] == '' ? 'N/A' : $wiz03->sheepItForm1_releaseexp[$key]; ?></p>
                    <div class="divclearboth"></div>
                </div>
            <?php endforeach; ?>
            <div class="section-div">
                <label>Dentist, Hearing, and Vision</label>
                <p class="leftadjust"><label>Dentist:</label> <?= $wiz03->dentist == '' ? 'N/A' : $wiz03->dentist ?> </p>
                <p class="rightadjust"><label>Dental exam:</label> <?= $wiz03->dentalexam == '' ? 'N/A' : $wiz03->dentalexam ?> </p>
                <p class="leftadjust"><label>Dental history:</label> <?= $wiz03->dentalhistory == '' ? 'N/A' : $wiz03->dentalhistory ?> </p>
                <p class="rightadjust"><label>Consent for Record Release:</label> <?= $wiz03->dentalrelease[0] == 'dentalreleaseno' ? 'No' : 'Yes' ?> </p>
                <p class="leftadjust"><label>Hearing:</label> <?= $wiz03->hearing == '' ? 'N/A' : $wiz03->hearing ?> </p>
                <p class="rightadjust"><label>Hearing exam:</label> <?= $wiz03->hearingexam == '' ? 'N/A' : $wiz03->hearingexam ?> </p>
                <p class="leftadjust"><label>Hearing history:</label> <?= $wiz03->hearinghistory == '' ? 'N/A' : $wiz03->hearinghistory ?> </p>
                <p class="rightadjust"><label>Consent for Record Release:</label> <?= $wiz03->hearingrelease[0] == 'hearingreleaseno' ? 'No' : 'Yes' ?> </p>
                <p class="leftadjust"><label>Vision:</label> <?= $wiz03->vision == '' ? 'N/A' : $wiz03->vision ?> </p>
                <p class="rightadjust"><label>Vision exam:</label> <?= $wiz03->visionexam == '' ? 'N/A' : $wiz03->visionexam ?> </p>
                <p class="leftadjust"><label>vision history:</label> <?= $wiz03->visionhistory == '' ? 'N/A' : $wiz03->visionhistory ?> </p>
                <p class="rightadjust"><label>Consent for Record Release:</label> <?= $wiz03->visionrelease[0] == 'visionreleaseno' ? 'No' : 'Yes' ?> </p>
                <div class="divclearboth"></div>
            </div>
            <?php
            foreach ($wiz03->sheepItForm_name as $key => $agencies):
                if ($key > 0):
                    if ($wiz03->sheepItForm_name[$key] == '' && $wiz03->sheepItForm_phone[$key] == '' && $wiz03->sheepItForm_fax[$key] == ''):
                        continue;
                    endif;
                endif;
                ?>
                <div class="section-div">
                    <label>Agencies and Case Managers <?php echo $key + 1; ?></label>
                    <p class="leftadjust"><label>Name:</label> <?= $wiz03->sheepItForm_name[$key] == '' ? 'N/A' : $wiz03->sheepItForm_name[$key]; ?> </p>
                    <p class="rightadjust"><label>Agency Name:</label> <?= $wiz03->sheepItForm_agname[$key] == '' ? 'N/A' : $wiz03->sheepItForm_agname[$key]; ?> </p>
                    <p class="leftadjust"><label>Case Manager:</label> <?= $wiz03->sheepItForm_cashman[$key] == '' ? 'N/A' : $wiz03->sheepItForm_cashman[$key]; ?> </p>
                    <p class="rightadjust"><label>contact Info:</label> <?= $wiz03->sheepItForm_phone[$key] == '' ? 'N/A' : $wiz03->sheepItForm_phone[$key]; ?> </p>
                    <p class="leftadjust"><label>Consent for Record Release:</label> <?= $wiz03->sheepItForm_release[$key] == '' ? 'N/A' : $wiz03->sheepItForm_release[$key]; ?> </p>
                    <div class="divclearboth"></div>
                </div>
                <?php
            endforeach;
            /* } */
            ?>

            <?php
            foreach ($wiz03->sheepItForm2_med as $key => $medi):

                if ($key > 0):
                    if ($wiz03->sheepItForm2_med[$key] == '' && $wiz03->sheepItForm2_dos[$key] == '' && $wiz03->sheepItForm2_time[$key] == '' && $wiz03->sheepItForm2_route[$key] == ''):
                        continue;
                    endif;
                endif;
                ?>
                <div class="section-div">
                    <label>Daily Medications <?php echo $key + 1; ?></label>
                    <p class="leftadjust"><label>Medication1:</label> <?= $wiz03->sheepItForm2_med[$key] == '' ? 'N/A' : $wiz03->sheepItForm2_med[$key]; ?> </p>
                    <p class="rightadjust"><label>Dosage1:</label> <?= $wiz03->sheepItForm2_dos[$key] == '' ? 'N/A' : $wiz03->sheepItForm2_dos[$key]; ?> </p>
                    <p class="leftadjust"><label>Time/Frequency1:</label> <?= $wiz03->sheepItForm2_time[$key] == '' ? 'N/A' : $wiz03->sheepItForm2_time[$key]; ?> </p>
                    <p class="rightadjust"><label>Route1:</label> <?= $wiz03->sheepItForm2_route[$key] == '' ? 'N/A' : $wiz03->sheepItForm2_route[$key]; ?> </p>
                    <div class="divclearboth"></div>
                </div>
            <?php endforeach; /* } */ ?>
            <?php
            /*
              if(empty($wiz03->sheepItForm3_prnmed)){ ?>
              <h1>PRN Medications</h1>
              <p><label>PRN medication1:</label> </p>
              <p><label>PRN Dosage1:</label></p>
              <p><label>PRN Time/Frequency1:</label></p>
              <p><label>PRN Route1:</label> </p>
              <?php }else{ */
            foreach ($wiz03->sheepItForm3_prnmed as $key => $prnmedi):
                if ($key > 0):
                    if ($wiz03->sheepItForm3_prnmed[$key] == '' && $wiz03->sheepItForm3_prndos[$key] == '' && $wiz03->sheepItForm3_prntime[$key] == '' && $wiz03->sheepItForm3_prnroute[$key] == ''):
                        continue;
                    endif;
                endif;
                ?>
                <div class="section-div">
                    <label>PRN Medications <?php echo $key + 1; ?></label>
                    <p class="leftadjust"><label>PRN medication1:</label> <?= $wiz03->sheepItForm3_prnmed[$key] == '' ? 'N/A' : $wiz03->sheepItForm3_prnmed[$key]; ?> </p>
                    <p class="rightadjust"><label>PRN Dosage1:</label> <?php
                        if (!empty($wiz03->sheepItForm3_prndos[$key])): echo $wiz03->sheepItForm3_prndos[$key];
                        else : echo "N/A";
                        endif;
                        ?> </p>
                    <p class="leftadjust"><label>PRN Time/Frequency1:</label> <?php
                        if (!empty($wiz03->sheepItForm3_prntime[$key])): echo $wiz03->sheepItForm3_prntime[$key];
                        else : echo "N/A";
                        endif;
                        ?> </p>
                    <p class="rightadjust"><label>PRN Route1:</label> <?php
                        if (!empty($wiz03->sheepItForm3_prnroute[$key])): echo $wiz03->sheepItForm3_prnroute[$key];
                        else : echo "N/A";
                        endif;
                        ?> </p>
                    <p class="leftadjust"><label>Taken at School:</label> <?php echo $wiz03->sheepItForm3_prnschool[$key] <> 'school' ? 'N/A' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Taken at Home:</label> <?php echo $wiz03->sheepItForm3_prnhome[$key] <> 'home' ? 'N/A' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Taken In Emergency:</label> <?php echo $wiz03->sheepItForm3_prnemerg[$key] <> 'yes' ? 'N/A' : 'Yes'; ?></p>

                    <div class="divclearboth"></div>
                </div>
            <?php endforeach;  /* } */ ?>
            <?php
            $z = 0;

            foreach ($wiz03->sheepItForm5_treatment as $key => $prnMedications):
                if ($key > 0):
                    if ($wiz03->sheepItForm5_treatment[$key] == ''):
                        continue;
                    endif;
                endif;
                ?>
                <!--Condition has added for only entered values-->
                <?php if (!empty($prnMedications)) { ?>
                    <div class="section-div">
                        <label>Treatments <?php echo $key + 1; ?></label>
                        <p class="leftadjust"><label>Treatment Order:</label> <?php
                            if (!empty($wiz03->sheepItForm5_treatment[$key])): echo $wiz03->sheepItForm5_treatment[$key];
                            else : echo "N/A";
                            endif;
                            ?> </p>
                        <p class="rightadjust"><label>Frequency:</label>  <?php
                            if (!empty($wiz03->sheepItForm5_frequency[$key])): echo $wiz03->sheepItForm5_frequency[$key];
                            else : echo "N/A";
                            endif;
                            ?> </p>
                        <p class="leftadjust"><label>Performed:</label>  <?php
                            $performed = 'sheepItForm5_' . $z . '_performed_school';

                            if ($wiz03->$performed == 'yes') {
                                echo 'At School';
                            } else if ($wiz03->$performed == 'no') {
                                echo 'At Home';
                            } else {
                                echo 'N/A';
                            }
                            ?> </p>
                        <p class="rightadjust"><label>Person Performing:</label> <?php
                            if (!empty($wiz03->sheepItForm5_person[$key])): echo $wiz03->sheepItForm5_person[$key];
                            else : echo "N/A";
                            endif;
                            ?> </p>
                        <div class="divclearboth"></div>
                    </div>
                <?php } ?>

                <?php
                $z++;
            endforeach;
            ?>
            <?php if (empty($wiz03->hideSection6)): ?>
                <?php
                $z = 0;
                foreach ($wiz03->sheepItForm4_allergy as $key => $allergy):
                    if ($key > 0):
                        if ($wiz03->sheepItForm4_allergy[$key] == '' && $wiz03->sheepItForm4_reaction[$key] == '' && $wiz03->ah1[$key] == '' && $wiz03->sheepItForm4_lastevent[$key] == '' && $wiz03->sheepItForm4_addtnlcomments[$key] == ''):
                            continue;
                        endif;
                    endif;
                    ?>

                    <div class="section-div">

                        <?php if (!empty($wiz03->sheepItForm4_allergy[$key])) { ?>
                            <label>Allergies <?php echo $key + 1; ?></label>
                            <p class="leftadjust"><label>Allergic to:</label>
                                <?php
                                if (!empty($wiz03->sheepItForm4_allergy[$key])): echo $wiz03->sheepItForm4_allergy[$key];
                                else : echo "N/A";
                                endif;
                                ?> </p>
                        <?php }
                        ?>
                        <p class = "rightadjust"><label>Reaction:</label><?php
                            if (!empty($wiz03->sheepItForm4_reaction[$key])): echo $wiz03->sheepItForm4_reaction[$key];
                            else : echo "N/A";
                            endif;
                            ?> </p>
                        <?php
                        //Sensitive level
                        $tocuh = 'sheepItForm4_' . $z . '_touch';
                        $ingestion = 'sheepItForm4_' . $z . '_ingest';
                        $air = 'sheepItForm4_' . $z . '_air';
                        $sting = 'sheepItForm4_' . $z . '_sting';
                        //Treatment
                        $epi = 'sheepItForm4_' . $z . '_epi';
                        $antihistamine = 'sheepItForm4_' . $z . '_antihistamine';
                        //Diagnosed
                        $diagonised = 'sheepItForm4_' . $z . '_diagnosed';
                        if ($wiz03->$tocuh == 'yes' || $wiz03->$ingestion == 'yes' || $wiz03->$air == 'yes' || $wiz03->$sting == 'yes'):
                            ?>

                            <p class="leftadjust"><label style="color:#000;">Sensitivity Level</label></p>

                            <p class="rightadjust"><label>Touch/Contact:</label> <?php echo $wiz03->$tocuh <> 'yes' ? 'N/A' : 'Yes'; ?></p>
                            <p class="leftadjust"><label>Ingestion:</label> <?php echo $wiz03->$ingestion <> 'yes' ? 'N/A' : 'Yes'; ?></p>
                            <p class="rightadjust"><label>Air:</label> <?php echo $wiz03->$air <> 'yes' ? 'N/A' : 'Yes'; ?></p>
                            <p class="leftadjust"><label>Sting/Bite:</label> <?php echo $wiz03->$sting <> 'yes' ? 'N/A' : 'Yes'; ?></p>
                            <?php
                        endif;
                        if ($wiz03->$epi == 'yes' || $wiz03->$antihistamine == 'yes'):
                            ?>
                            <p class="rightadjust"><label style="color:#000;">Treatment</label></p>
                            <p class="leftadjust"><label>Epinephrine Auto-Injection:</label> <?php echo $wiz03->$epi <> 'yes' ? 'N/A' : 'Yes'; ?></p>
                            <p class="rightadjust"><label>Antihistamine:</label> <?php echo $wiz03->$antihistamine <> 'yes' ? 'N/A' : 'Yes'; ?></p>
                        <?php endif; ?>
                        <p class="leftadjust"><label>How was the allergy diagnosed:</label>  <?php echo (!empty($wiz03->$diagonised)) ? $wiz03->$diagonised : 'N/A'; ?></p>
                        <p class="rightadjust"><label>Last event:</label> <?php
                            if (!empty($wiz03->sheepItForm4_lastevent[$key])): echo $wiz03->sheepItForm4_lastevent[$key];
                            else : echo "N/A";
                            endif;
                            ?> </p>
                        <p class="leftadjust"><label>Additional comments:</label> <?php
                            if (!empty($wiz03->sheepItForm4_addtnlcomments[$key]) && trim($wiz03->sheepItForm4_addtnlcomments[$key]) <> ""): echo $wiz03->sheepItForm4_addtnlcomments[$key];
                            else : echo "N/A";
                            endif;
                            ?> </p>
                        <div class="divclearboth"></div>
                    </div>

                    <?php
                    $z++;
                endforeach; /* } */
                ?>
            <?php endif; ?>
            <div class="section-div">
                <label>Communication/Vision/Hearing Requirements</label>
                <h1>Select Requirement Type</h1>
                <p class="leftadjust"><label>Verbal:</label> <?php echo in_array('needtypeverbal', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="rightadjust"><label>Non-Verbal:</label> <?php echo in_array('needtypenonverbal', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="leftadjust"><label>Speech/Language Needs:</label> <?php echo in_array('needtypespeech', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="rightadjust"><label>Audiology Needs:</label> <?php echo in_array('needtypeaudiology', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="leftadjust"><label>Vision Needs:</label> <?php echo in_array('needtypevision', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="rightadjust"><label>Signs/Gestures:</label> <?php echo in_array('needtypesigns', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="leftadjust"><label>Expressions:</label> <?php echo in_array('needtypeexpressions', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="rightadjust"><label>Cries/Smiles:</label> <?php echo in_array('needtypecries', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="leftadjust"><label>Pictures:</label> <?php echo in_array('needtypepictures', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <p class="rightadjust"><label>No Communication:</label> <?php echo in_array('needtypenocommunication', $wiz03->needtype) ? 'Yes' : 'N/A' ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Assistive Communication Devices</h1>

                <p class="leftadjust"><label>Assistive Communication Devices:</label> <?php echo $wiz03->devices == '' ? 'N/A' : $wiz03->devices ?></p>
                <p class="rightadjust"><label>Assistive Communication Device Description:</label> <?php echo $wiz03->device_describe == '' ? 'N/A' : $wiz03->device_describe; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Device(s) Used</h1>
                <p class="leftadjust"><label>Wears Glasses:</label> <?php echo in_array('devicelistglasses', $wiz03->devicelist) ? 'Yes' : 'N/A' ?></p>
                <p class="rightadjust"><label>Wears Hearing Aid:</label> <?php echo in_array('devicelisthearingaid', $wiz03->devicelist) ? 'Yes' : 'N/A' ?></p>
                <p class="leftadjust"><label> Cochlear Implant:</label> <?php echo in_array('devicelistcochlear', $wiz03->devicelist) ? 'Yes' : 'N/A' ?></p>
                <p class="rightadjust"><label>FM System:</label> <?php echo in_array('devicelistfmsystem', $wiz03->devicelist) ? 'Yes' : 'N/A' ?></p>

                <p class="leftadjust"><label>Last Hearing Screening:</label> <?php echo $wiz03->hearingscreening == '' ? 'N/A' : $wiz03->hearingscreening ?></p>
                <p class="rightadjust"><label>Last Vision Screening:</label> <?php echo $wiz03->visionscreening == '' ? 'N/A' : $wiz03->visionscreening ?> </p>
                <p class="leftadjust"><label>Additional Comments:</label> <?php echo trim($wiz03->communicationcomments) == '' ? 'N/A' : $wiz03->communicationcomments ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <label>Neurological Requirements</label>
                <?php if ($wiz03->seizuretype != '') { ?>
                    <p class="leftadjust"><label>Seizures Disorder:</label> <?= in_array('seizuresno', $wiz03->seizures) ? 'No' : 'Yes'; ?> </p>
                <?php } ?>
                <p class="rightadjust"><label>Seizure type:</label> <?= $wiz03->seizuretype == '' || in_array('seizuresno', $wiz03->seizures) ? 'N/A' : $wiz03->seizuretype; ?> </p>
                <p class="leftadjust"><label>Last seizure exam:</label> <?= $wiz03->lastseizureexam == '' ? 'N/A' : $wiz03->lastseizureexam; ?> </p>
                <p class="rightadjust"><label>Age of Onset:</label> <?= $wiz03->onsetage == '' ? 'N/A' : $wiz03->onsetage; ?> </p>
                <p class="leftadjust"><label>Date of Last seizure:</label> <?= $wiz03->lastseizure == '' ? 'N/A' : $wiz03->lastseizure; ?> </p>
                <p class="rightadjust"><label>Usual duration:</label> <?= $wiz03->usualduration == '' ? 'N/A' : $wiz03->usualduration; ?> </p>
                <p class="leftadjust"><label>Frequency of Seizures:</label> <?= $wiz03->seizurefrequncy == '' ? 'N/A' : $wiz03->seizurefrequncy; ?> </p>
                <p class="rightadjust"><label>Hx of Status Epilecticus:</label> <?= $wiz03->statusepilectus == '' ? 'N/A' : $wiz03->statusepilectus; ?> </p>
                <p class="leftadjust"><label>Triggers:</label> <?= $wiz03->triggers == '' ? 'N/A' : $wiz03->triggers; ?> </p>
                <p class="rightadjust"><label>Ketogenic Diet:</label><?= in_array('ketogenicno', $wiz03->ketogenic) ? 'No' : 'Yes'; ?> </p>
                <?php
                if (!empty($wiz03->seizuretreatment)):
                    ?>
                    <p class="leftadjust"><label style="color:#000;">Treatment</label></p>
                    <p class="leftadjust"><label>Diastat:</label> <?php echo in_array('seizuretreatmentdiastat', $wiz03->seizuretreatment) ? 'Yes' : 'N/A' ?></p>
                    <p class="rightadjust"><label>Oxygen:</label> <?php echo in_array('seizuretreatmentoxygen', $wiz03->seizuretreatment) ? 'Yes' : 'N/A' ?></p>
                    <p class="leftadjust"><label>Vagal Nerve Stimulator:</label> <?php echo in_array('seizuretreatmentvagalnervestimulator', $wiz03->seizuretreatment) ? 'Yes' : 'N/A' ?></p>
                    <p class="rightadjust"><label>Medication :</label> <?php echo in_array('seizuretreatmentmedication', $wiz03->seizuretreatment) ? 'Yes' : 'N/A' ?></p>
                <?php endif; ?>
                <p class="leftadjust"><label>Post Seizure Activity:</label> <?= $wiz03->postseizure == '' ? 'N/A' : $wiz03->postseizure; ?> </p>
                <p class="rightadjust"><label>Shunt:</label> <?= $wiz03->shunt == 'shuntno' ? 'No' : 'Yes'; ?> </p>
                <p class="leftadjust"><label>If yes, type:</label> <?= $wiz03->shunttype == '' ? 'N/A' : $wiz03->shunttype; ?> </p>
                <p class="rightadjust"><label>Date of Shunt Placement:</label> <?= $wiz03->shuntplacement == '' ? 'N/A' : $wiz03->shuntplacement; ?> </p>
                <p class="leftadjust"><label>Date of Last Revision:</label> <?= $wiz03->lastrevision == '' ? 'N/A' : $wiz03->lastrevision; ?> </p>
                <p class="rightadjust"><label>Aura description:</label> <?= $wiz03->auradescription == '' ? 'N/A' : $wiz03->auradescription; ?> </p>
                <p class="leftadjust"><label>Seizure comments:</label> <?= trim($wiz03->seizurecomments) == '' ? 'N/A' : $wiz03->seizurecomments; ?> </p>

                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Elimination Requirements</label>

                <p class="leftadjust"><label>Independent:</label> <?php echo $wiz03->elimination_independent == '' ? 'N/A' : $wiz03->elimination_independent; ?></p>
                <p class="rightadjust"><label>Scheduled:</label> <?php echo $wiz03->elimination_scheduled == '' ? 'N/A' : $wiz03->elimination_scheduled; ?> </p>
                <p class="leftadjust"><label>Prompted:</label> <?php echo $wiz03->elimination_prompted == '' ? 'N/A' : $wiz03->elimination_prompted; ?> </p>
                <p class="rightadjust"><label>Diapered:</label> <?php echo $wiz03->elimination_diapered == '' ? 'N/A' : $wiz03->elimination_diapered; ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">

                <h1>Continence</h1>
                <p class="leftadjust"><label>Continent:</label> <?php echo $wiz03->continence_continent == '' ? 'N/A' : $wiz03->continence_continent; ?></p>
                <p class="rightadjust"><label>Incontinent:</label> <?php echo $wiz03->continence_incontinent_bowel == '' ? 'N/A' : $wiz03->continence_incontinent_bowel; ?> </p>
                <p class="leftadjust"><label>Incontinent:</label> <?php echo $wiz03->continence_incontinent_bladder == '' ? 'N/A' : $wiz03->continence_incontinent_bladder; ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">

                <h1>How Student is Toileted</h1>
                <p class="leftadjust"><label>Toilet:</label> <?php echo $wiz03->toilet == '' ? 'N/A' : $wiz03->toilet; ?></p>
                <p class="rightadjust"><label>Other Toilet Type:</label> <?php echo $wiz03->other_toilet == '' || $wiz03->toilet <> 'Other' ? 'N/A' : $wiz03->other_toilet; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Where is Student Toileted</h1>
                <p class="leftadjust"><label>Toileted :</label> <?php echo $wiz03->toileted == '' ? 'N/A' : $wiz03->toileted; ?></p>
                <p class="rightadjust"><label>Other Toilet:</label> <?php echo $wiz03->toileted_student == '' ? 'N/A' : $wiz03->toileted_student; ?></p>
                <p class="leftadjust"><label>Bowel Regime:</label> <?php echo $wiz03->regime == '' ? 'N/A' : $wiz03->regime; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">

                <h1>History of Constipation</h1>
                <p class="leftadjust"><label>Constipation:</label> <?php echo $wiz03->constipation == '' ? 'N/A' : $wiz03->constipation; ?></p>
                <p class="rightadjust"><label>Management:</label> <?php echo $wiz03->constipation_mgmnt == '' ? 'N/A' : $wiz03->constipation_mgmnt; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Colostomy</h1>
                <p class="leftadjust"><label>Colostomy:</label> <?php echo $wiz03->colostomy == '' ? 'N/A' : $wiz03->colostomy; ?></p>
                <p class="rightadjust"><label>Colostomy Management:</label> <?php echo trim($wiz03->colostomy_mgmnt) == '' ? 'N/A' : $wiz03->colostomy_mgmnt; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Bladder Regime</h1>
                <p class="leftadjust"><label>Bladder:</label> <?php echo $wiz03->bladder == '' ? 'N/A' : $wiz03->bladder; ?></p>
                <p class="rightadjust"><label>Bladder Management:</label> <?php echo $wiz03->bladder_mgmnt == '' ? 'N/A' : $wiz03->bladder_mgmnt; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Urinary Catheterization</h1>
                <p class="leftadjust"><label>Urinary Catheterization:</label> <?php echo $wiz03->catheter == '' ? 'N/A' : $wiz03->catheter; ?></p>
                <p class="rightadjust"><label>Catheter Size:</label> <?php echo$wiz03->cath_size == '' ? 'N/A' : $wiz03->cath_size; ?></p>
                <p class="leftadjust"><label>Catheter Frequency:</label> <?php echo $wiz03->cath_freq == '' ? 'N/A' : $wiz03->cath_freq; ?></p>
                <p class="rightadjust"><label>Self Catheter:</label> <?php echo $wiz03->self_catheter == '' ? 'N/A' : $wiz03->self_catheter; ?></p>
                <p class="leftadjust"><label>Stoma:</label> <?php echo $wiz03->stoma == '' ? 'N/A' : $wiz03->stoma; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Menstruation</h1>
                <p class="leftadjust"><label>Menstruation:</label> <?php echo $wiz03->menstruation == '' ? 'N/A' : $wiz03->menstruation; ?></p>
                <p class="rightadjust"><label>Menstruation Management:</label> <?php echo $wiz03->menstruation_mgmt == '' ? 'N/A' : $wiz03->menstruation_mgmt; ?></p>
                <p class="leftadjust"><label>Diabetic Student:</label> <?php echo $wiz03->diabetic == '' ? 'N/A' : $wiz03->diabetic; ?></p>
                <p class="rightadjust"><label>Liberal Bathroom Privileges:</label> <?php echo $wiz03->br_privileges == '' ? 'N/A' : $wiz03->br_privileges; ?></p>
                <p class="leftadjust"><label>Additional Comments:</label> <?php echo $wiz03->elimination_addtnl == '' ? 'N/A' : $wiz03->elimination_addtnl; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Cardiac Requirements</label>
                <p class="leftadjust"><label>Cardiac history:</label> <?= $wiz03->cardiac_history == '' ? 'N/A' : $wiz03->cardiac_history ?> </p>
                <p class="rightadjust"><label>Restrictions:</label> <?= $wiz03->restrictions == '' ? 'N/A' : $wiz03->restrictions ?> </p>
                <p class="leftadjust"><label>Restrict list:</label> <?= $wiz03->restrict_list == '' || $wiz03->restrictions == '' ? 'N/A' : $wiz03->restrict_list ?> </p>
                <p class="rightadjust"><label>Baseline Vital Signs:</label> <?= $wiz03->baseline == '' ? 'N/A' : $wiz03->baseline ?> </p>
                <?php
                if ($wiz03->distress_pain <> '' || $wiz03->distress_breath <> '' || $wiz03->distress_palpitations <> '' || $wiz03->distress_diaphoresis <> '' || $wiz03->distress_fatigue <> '' || $wiz03->distress_dyspnea <> '' || $wiz03->distress_fainting <> '' || $wiz03->distress_other <> ''):
                    ?>
                    <p class="leftadjust"><label style="color:#000;">Symptoms of Distress</label></p>
                    <p class="leftadjust"><label>Chest Pain/Tightness:</label> <?= $wiz03->distress_pain == '' ? 'N/A' : $wiz03->distress_pain ?> </p>
                    <p class="rightadjust"><label>Shortness of Breath:</label> <?= $wiz03->distress_breath == '' ? 'N/A' : $wiz03->distress_breath ?> </p>
                    <p class="leftadjust"><label>Palpitations:</label> <?= $wiz03->distress_palpitations == '' ? 'N/A' : $wiz03->distress_palpitations ?> </p>
                    <p class="rightadjust"><label>Diaphoresis:</label> <?= $wiz03->distress_diaphoresis == '' ? 'N/A' : $wiz03->distress_diaphoresis ?> </p>
                    <p class="leftadjust"><label>Fatigue:</label> <?= $wiz03->distress_fatigue == '' ? 'N/A' : $wiz03->distress_fatigue ?> </p>
                    <p class="rightadjust"><label>Dyspnea on Exertion:</label> <?= $wiz03->distress_dyspnea == '' ? 'N/A' : $wiz03->distress_dyspnea ?> </p>
                    <p class="leftadjust"><label>Fainting:</label> <?= $wiz03->distress_fainting == '' ? 'N/A' : $wiz03->distress_fainting ?> </p>
                    <p class="rightadjust"><label>Other:</label> <?= $wiz03->distress_other == '' ? 'N/A' : $wiz03->distress_other ?> </p>
                <?php endif; ?>
                <p class="leftadjust"><label>Other Symptoms:</label> <?= $wiz03->symptom_other == '' ? 'N/A' : $wiz03->symptom_other ?> </p>
                <p class="rightadjust"><label>Pacemaker:</label> <?= $wiz03->pacemaker == '' ? 'No' : $wiz03->pacemaker ?> </p>
                <p class="leftadjust"><label>Internal Defibrillator:</label> <?= $wiz03->defib == '' ? 'No' : $wiz03->defib ?> </p>
                <p class="rightadjust"><label>Personal AED:</label> <?= $wiz03->aed == '' ? 'No' : $wiz03->aed ?> </p>
                <?php if ($wiz03->skin_color_normal <> '' || $wiz03->skin_color_cyanosis <> '' || $wiz03->skin_color_jaundice <> '' || $wiz03->skin_color_pallor <> '' || $wiz03->skin_color_erythema <> '' || $wiz03->skin_color_other <> ''):
                    ?>
                    <p class="leftadjust"><label style="color:#000;">Baseline Skin Color</label></p>
                    <p class="leftadjust"><label>Normal:</label> <?= $wiz03->skin_color_normal == '' ? 'N/A' : $wiz03->skin_color_normal ?> </p>
                    <p class="rightadjust"><label>Cyanosis:</label> <?= $wiz03->skin_color_cyanosis == '' ? 'N/A' : $wiz03->skin_color_cyanosis ?> </p>
                    <p class="leftadjust"><label>Jaundice:</label> <?= $wiz03->skin_color_jaundice == '' ? 'N/A' : $wiz03->skin_color_jaundice ?> </p>
                    <p class="rightadjust"><label>Pallor:</label> <?= $wiz03->skin_color_pallor == '' ? 'N/A' : $wiz03->skin_color_pallor ?> </p>
                    <p class="leftadjust"><label>Erythema:</label> <?= $wiz03->skin_color_erythema == '' ? 'N/A' : $wiz03->skin_color_erythema ?> </p>
                    <p class="rightadjust"><label>Other:</label> <?= $wiz03->skin_color_other == '' ? 'N/A' : $wiz03->skin_color_other ?> </p>
                <?php endif; ?>
                <p class="leftadjust"><label>Additional Comments:</label> <?= $wiz03->cardiac_addtnl == '' ? 'N/A' : $wiz03->cardiac_addtnl ?> </p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Respiratory Requirements</label>
                <p class="leftadjust"><label>Asthma:</label> <?= $wiz03->asthma == '' ? 'No' : $wiz03->asthma ?> </p>
                <p class="rightadjust"><label>If not asthma, what is the diagnosis?</label> <?= $wiz03->other_diagnosis == '' || $wiz03->asthma <> '' ? 'N/A' : $wiz03->other_diagnosis ?> </p>
                <p class="leftadjust"><label>Age Diagnosed:</label> <?= $wiz03->diagnosis_age == '' ? 'N/A' : $wiz03->diagnosis_age ?> </p>
                <p class="rightadjust"><label>Symptoms in the last 12 months:</label> <?= $wiz03->last_year == '' ? 'N/A' : $wiz03->last_year ?> </p>
                <p class="leftadjust"><label>Needed to use medication in the last 12 months:</label> <?= $wiz03->meds_last_year == '' ? 'N/A' : $wiz03->meds_last_year ?> </p>
                <p class="rightadjust"><label>Seen by health care provider in the last 12 months:</label> <?= $wiz03->doctor_last_year == '' ? 'N/A' : $wiz03->doctor_last_year ?> </p>
                <p class="leftadjust"><label>ED visit(s) and/or hospitalizations in the last 12 months:</label> <?= $wiz03->ed_last_year == '' ? 'N/A' : $wiz03->ed_last_year ?> </p>
                <p class="rightadjust"><label>If yes, how many?:</label> <?= $wiz03->num_ed_visits == '' ? 'N/A' : $wiz03->num_ed_visits ?> </p>
                <p class="leftadjust"><label>Have symptoms ever prevented student from participating in PE, Recess, Sports, or Other Activites:</label> <?= $wiz03->pe == '' ? 'N/A' : $wiz03->pe ?> </p>
                <p class="rightadjust"><label>If yes, please explain:</label> <?= $wiz03->pe_explain == '' || $wiz03->pe == '' ? 'N/A' : $wiz03->pe_explain ?> </p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <h1>Triggers</h1>
                <p class="leftadjust"><label> Smoke:</label> <?= $wiz03->triggers_smoke == '' ? 'N/A' : $wiz03->triggers_smoke ?> </p>
                <p class="rightadjust"><label> Animals:</label> <?= $wiz03->triggers_animals == '' ? 'N/A' : $wiz03->triggers_animals ?> </p>
                <p class="leftadjust"><label>Dust:</label> <?= $wiz03->triggers_dust == '' ? 'N/A' : $wiz03->triggers_dust ?> </p>
                <p class="rightadjust"><label>Colds:</label> <?= $wiz03->triggers_colds == '' ? 'N/A' : $wiz03->triggers_colds ?> </p>
                <p class="leftadjust"><label>Weather:</label> <?= $wiz03->triggers_weather == '' ? 'N/A' : $wiz03->triggers_weather ?> </p>
                <p class="rightadjust"><label>Exercise:</label> <?= $wiz03->triggers_exercise == '' ? 'N/A' : $wiz03->triggers_exercise ?> </p>
                <p class="leftadjust"><label>Mold:</label> <?= $wiz03->triggers_mold == '' ? 'N/A' : $wiz03->triggers_mold ?> </p>
                <p class="rightadjust"><label>Grass:</label> <?= $wiz03->triggers_grass == '' ? 'N/A' : $wiz03->triggers_grass ?> </p>
                <p class="leftadjust"><label>Perfumes:</label> <?= $wiz03->triggers_perfumes == '' ? 'N/A' : $wiz03->triggers_perfumes ?> </p>
                <p class="rightadjust"><label>Stress:</label> <?= $wiz03->triggers_stress == '' ? 'N/A' : $wiz03->triggers_stress ?> </p>
                <p class="leftadjust"><label>Food:</label> <?= $wiz03->triggers_food == '' ? 'N/A' : $wiz03->triggers_food ?> </p>
                <p class="rightadjust"><label>Other:</label> <?= $wiz03->triggers_other == '' ? 'N/A' : $wiz03->triggers_other ?> </p>
                <p class="leftadjust"><label>Other trigger:</label> <?= $wiz03->other_trigger == '' ? 'N/A' : $wiz03->other_trigger ?> </p>

                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Usual Symptoms</h1>
                <p class="rightadjust"><label>Wheezing:</label> <?= $wiz03->usual_symptoms_wheezing == '' ? 'N/A' : $wiz03->usual_symptoms_wheezing ?> </p>
                <p class="leftadjust"><label>Breath:</label> <?= $wiz03->usual_symptoms_breath == '' ? 'N/A' : $wiz03->usual_symptoms_breath ?> </p>
                <p class="rightadjust"><label>Breathing:</label> <?= $wiz03->usual_symptoms_breathing == '' ? 'N/A' : $wiz03->usual_symptoms_breathing ?> </p>
                <p class="leftadjust"><label>Throat:</label> <?= $wiz03->usual_symptoms_throat == '' ? 'N/A' : $wiz03->usual_symptoms_throat ?> </p>
                <p class="rightadjust"><label>Cough:</label> <?= $wiz03->usual_symptoms_cough == '' ? 'N/A' : $wiz03->usual_symptoms_cough ?> </p>
                <p class="leftadjust"><label>Chest:</label> <?= $wiz03->usual_symptoms_chest == '' ? 'N/A' : $wiz03->usual_symptoms_chest ?> </p>
                <p class="rightadjust"><label>Irritability:</label> <?= $wiz03->usual_symptoms_irritability == '' ? 'N/A' : $wiz03->usual_symptoms_irritability ?> </p>
                <p class="leftadjust"><label>Waking:</label> <?= $wiz03->usual_symptoms_waking == '' ? 'N/A' : $wiz03->usual_symptoms_waking ?> </p>
                <p class="rightadjust"><label>Stomachache:</label> <?= $wiz03->usual_symptoms_stomachache == '' ? 'N/A' : $wiz03->usual_symptoms_stomachache ?> </p>
                <p class="leftadjust"><label>Other:</label> <?= $wiz03->usual_symptoms_other == '' ? 'N/A' : $wiz03->usual_symptoms_other ?> </p>
                <p class="rightadjust"><label>Other usual symptoms:</label> <?= $wiz03->other_usual_symptoms == '' ? 'N/A' : $wiz03->other_usual_symptoms ?> </p>

                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <h1>Symptoms During the Day (in the past month)</h1>
                <p class="leftadjust"><label>None:</label> <?= $wiz03->day_symptoms_none == '' ? 'N/A' : $wiz03->day_symptoms_none ?> </p>
                <p class="rightadjust"><label>2x/week or less:</label> <?= $wiz03->day_symptoms_twice == '' ? 'N/A' : $wiz03->day_symptoms_twice ?> </p>
                <p class="leftadjust"><label> More than 2x/week:</label> <?= $wiz03->day_symptoms_twiceplus == '' ? 'N/A' : $wiz03->day_symptoms_twiceplus ?> </p>
                <p class="rightadjust"><label>Every Day:</label> <?= $wiz03->day_symptoms_always == '' ? 'N/A' : $wiz03->day_symptoms_always ?> </p>

                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <h1>Symptoms at Night (in the past month)</h1>
                <p class="leftadjust"><label>None:</label> <?= $wiz03->night_symptoms_none == '' ? 'N/A' : $wiz03->night_symptoms_none ?> </p>
                <p class="rightadjust"><label>More than 2x/week:</label> <?= $wiz03->night_symptoms_twice == '' ? 'N/A' : $wiz03->night_symptoms_twice ?> </p>
                <p class="leftadjust"><label>Night symptoms twiceplus:</label> <?= $wiz03->night_symptoms_twiceplus == '' ? 'N/A' : $wiz03->night_symptoms_twiceplus ?> </p>
                <p class="rightadjust"><label>Every Day:</label> <?= $wiz03->night_symptoms_always == '' ? 'N/A' : $wiz03->night_symptoms_always ?> </p>

                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <h1>Symptoms most likely occur in</h1>
                <p class="leftadjust"><label>Fall:</label> <?= $wiz03->season_fall == '' ? 'N/A' : $wiz03->season_fall ?> </p>
                <p class="rightadjust"><label>Winter:</label> <?= $wiz03->season_winter == '' ? 'N/A' : $wiz03->season_winter ?> </p>
                <p class="leftadjust"><label>Spring:</label> <?= $wiz03->season_spring == '' ? 'N/A' : $wiz03->season_spring ?> </p>
                <p class="rightadjust"><label>Summer:</label> <?= $wiz03->season_summer == '' ? 'N/A' : $wiz03->season_summer ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <p class="leftadjust"><label>Did student miss school last year:</label> <?= $wiz03->missschool <> 'missschoolyes' ? 'No' : 'Yes' ?> </p>
                <?php if ($wiz03->missschool == 'missschoolyes') { ?>
                    <p class="rightadjust"><label>If yes, how many times:</label> <?php echo $wiz03->missed_times == '' ? 'N/A' || $wiz03->missschool <> 'missschoolyes' : $wiz03->missed_times; ?> </p>
                <?php } ?>
                <p class="leftadjust"><label>Medication Delivery:</label> <?= $wiz03->med_delivery == '' ? 'N/A' : $wiz03->med_delivery ?> </p>
                <p class="rightadjust"><label>Frequency:</label> <?= $wiz03->med_freq == '' ? 'N/A' : $wiz03->med_freq ?> </p>
                <p class="leftadjust"><label>Student able to administer medication:</label> <?= $wiz03->student_admin == '' ? 'N/A' : $wiz03->student_admin ?> </p>
                <p class="rightadjust"><label>Student self-carries MDI:</label> <?= $wiz03->selfmdi <> 'selfmdiyes' ? 'No' : 'Yes'; ?> </p>
                <p class="leftadjust"><label>MDI kept in health room:</label> <?= $wiz03->mdi <> 'mdiyes' ? 'No' : 'Yes'; ?> </p>
                <p class="rightadjust"><label>Spacer:</label> <?= $wiz03->spacer <> 'spaceryes' ? 'No' : 'Yes'; ?> </p>
                <p class="leftadjust"><label>Spacer type:</label> <?= $wiz03->spacertype == '' || $wiz03->spacer <> 'spaceryes' ? 'N/A' : $wiz03->spacertype ?> </p>
                <p class="rightadjust"><label>Peak flow:</label> <?= $wiz03->peak <> 'peakyes' ? 'N/A' : 'Yes'; ?> </p>
                <p class="leftadjust"><label>Personal best:</label> <?= $wiz03->peak_best == '' || $wiz03->peak <> 'peakyes' ? 'N/A' : $wiz03->peak_best ?> </p>
                <p class="rightadjust"><label>Pulmonary vest:</label> <?= $wiz03->pulmvest <> 'pulmvestyes' ? 'N/A' : 'Yes'; ?> </p>
                <p class="leftadjust"><label>Pulmonary vest frequency:</label> <?= $wiz03->vestfreq == '' || $wiz03->pulmvest <> 'pulmvestyes' ? 'N/A' : $wiz03->vestfreq ?> </p>
                <p class="rightadjust"><label>Chest PT:</label> <?= $wiz03->chestpt <> 'chestptyes' ? 'N/A' : 'Yes'; ?> </p>
                <p class="leftadjust"><label>Chest PT frequency:</label> <?= $wiz03->chestptfreq == '' || $wiz03->chestpt <> 'chestptyes' ? 'N/A' : $wiz03->chestptfreq ?> </p>
                <p class="rightadjust"><label>Ed visits asthma in the last 12 months?:</label> <?= $wiz03->edasthma <> 'edasthmayes' ? 'N/A' : 'Yes'; ?> </p>
                <p class="leftadjust"><label>Number of visits:</label> <?= $wiz03->numvisits == '' || $wiz03->edasthma <> 'edasthmayes' ? 'N/A' : preg_replace('/\D/', '', $wiz03->numvisits); ?> </p>
                <p class="rightadjust"><label>Respiratory additional comments:</label> <?= trim($wiz03->resp_addtnl) == '' ? 'N/A' : $wiz03->resp_addtnl; ?> </p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <h1>Treatment Plan in School</h1>
                <p class="leftadjust"><label>Standard Asthma Plan:</label> <?= in_array('tplan_standard', $wiz03->tplan) ? 'Yes' : 'N/A'; ?> </p>
                <p class="rightadjust"><label>Asthma Action Plan:</label>  <?= in_array('tplan_action', $wiz03->tplan) ? 'Yes' : 'N/A'; ?> </p>
                <p class="leftadjust"><label>IHP:</label> <?= in_array('tplan_ihp', $wiz03->tplan) ? 'Yes' : 'N/A'; ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <label>Respiratory-Oxygen/Tracheostomy/Ventilation Requirements</label>

                <p class="leftadjust"><label>Respiratory assessment continuous:</label> <?= $wiz04->resp_assess_continuous == '' ? 'N/A' : $wiz04->resp_assess_continuous ?> </p>
                <p class="rightadjust"><label>Respiratory assessment intermittant:</label> <?= $wiz04->resp_assess_intermittant == '' ? 'N/A' : $wiz04->resp_assess_intermittant ?> </p>
                <p class="leftadjust"><label>Respiratory assessment signal:</label> <?= $wiz04->resp_assess_signal == '' ? 'N/A' : $wiz04->resp_assess_signal ?> </p>
                <p class="rightadjust"><label>Baseline respiratory assessment:</label> <?= $wiz04->baseline_assess == '' ? 'N/A' : $wiz04->baseline_assess ?> </p>
                <p class="leftadjust"><label>Signs/Symptoms of respiratory distress:</label> <?= $wiz04->distress_sign == '' ? 'N/A' : $wiz04->distress_sign ?> </p>
                <p class="rightadjust"><label>Mechanical Ventilation:</label> <?= $wiz04->ventilation == '' ? 'N/A' : $wiz04->ventilation ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <?php if ($wiz04->where_home <> '' || $wiz04->where_school <> '' || $wiz04->where_sleep <> '' || $wiz04->where_as_needed <> ''): ?>
                                                                                                                                                                                                                                    <!--<p class="leftadjust"><label style="color:#000;">Ventilation Needed</label></p>-->
                    <h1>Ventilation Needed</h1>

                    <p class="leftadjust"><label>Home:</label> <?= $wiz04->where_home == '' ? 'N/A' : $wiz04->where_home ?> </p>
                    <p class="rightadjust"><label>School:</label> <?= $wiz04->where_school == '' ? 'N/A' : $wiz04->where_school ?> </p>
                    <p class="leftadjust"><label>Sleep:</label> <?= $wiz04->where_sleep == '' ? 'N/A' : $wiz04->where_sleep ?> </p>
                    <p class="rightadjust"><label>As needed:</label> <?= $wiz04->where_as_needed == '' ? 'N/A' : $wiz04->where_as_needed ?> </p>
                <?php endif; ?>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Ventilation dependant</h1>

                <p class="leftadjust"><label>Ventilation dependant:</label> <?= $wiz04->vent_depend == '' ? 'N/A' : $wiz04->vent_depend ?> </p>
                <p class="rightadjust"><label>If Vent Assist, how long can student be off vent:</label> <?= $wiz04->vent_assist == '' || $wiz04->vent_depend <> '' ? 'N/A' : $wiz04->vent_assist ?> </p>
                <p class="leftadjust"><label>Ventilator  settings:</label> <?= $wiz04->vent_set == '' ? 'N/A' : $wiz04->vent_set ?> </p>
                <p class="rightadjust"><label>Contact Information:</label> <?= $wiz04->vent_contact == '' ? 'N/A' : $wiz04->vent_contact ?> </p>
                <p class="leftadjust"><label>Ventilator  company:</label> <?= $wiz04->vent_co == '' ? 'N/A' : $wiz04->vent_co ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Oxygen</h1>
                <p class="rightadjust"><label>Oxygen Continuous:</label> <?= $wiz04->oxygen_cont == '' ? 'N/A' : $wiz04->oxygen_cont ?> </p>
                <p class="leftadjust"><label>Oxygen Intermittent:</label> <?= $wiz04->oxygen_inter == '' ? 'N/A' : $wiz04->oxygen_inter ?> </p>
                <p class="leftadjust"><label>Oximetry:</label> <?= $wiz04->oximetry == '' ? 'N/A' : $wiz04->oximetry ?> </p>
                <p class="rightadjust"><label>Oxygen frequency:</label> <?= $wiz04->ox_freq == '' || $wiz04->oximetry <> 'yes' ? 'N/A' : $wiz04->ox_freq ?> </p>
                <p class="leftadjust"><label>Oxygen parameters:</label> <?= $wiz04->ox_param == '' || $wiz04->oximetry <> 'yes' ? 'N/A' : $wiz04->ox_param ?> </p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">

                <?php if ($wiz04->ox_route_nasal <> '' || $wiz04->ox_route_trach <> '' || $wiz04->ox_route_mask <> ''): ?>
                                                                                                                                                                                                <!--<p class="leftadjust"><label style="color:#000;">Oxygen Route</label></p>-->
                    <h1>Oxygen Route</h1>

                    <p class="rightadjust"><label>Nasal Cannula:</label> <?= $wiz04->ox_route_nasal == '' ? 'N/A' : $wiz04->ox_route_nasal ?> </p>
                    <p class="leftadjust"><label>Tracheotomy:</label> <?= $wiz04->ox_route_trach == '' ? 'N/A' : $wiz04->ox_route_trach ?> </p>
                    <p class="rightadjust"><label> Mask/Non-Rebreather:</label> <?= $wiz04->ox_route_mask == '' ? 'N/A' : 'Yes'; ?> </p>
                    <?php
                endif;
                ?>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <?php
                if ($wiz04->ox_source_tank <> '' || $wiz04->ox_source_liquid <> '' || $wiz04->ox_source_concentrator <> ''):
                    ?>
                                                                                                                                                                                                                <!--<p class="leftadjust"><label style="color:#000;">Oxygen Source</label></p>-->
                    <h1>Oxygen Source</h1>

                    <p class="leftadjust"><label>Tank:</label> <?= $wiz04->ox_source_tank == '' ? 'N/A' : $wiz04->ox_source_tank ?> </p>
                    <p class="rightadjust"><label>Liquid:</label> <?= $wiz04->ox_source_liquid == '' ? 'N/A' : $wiz04->ox_source_liquid ?> </p>
                    <p class="leftadjust"><label>Concentrator:</label> <?= $wiz04->ox_source_concentrator == '' ? 'N/A' : $wiz04->ox_source_concentrator ?> </p>
                <?php endif; ?>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <p class="rightadjust"><label>Trach size:</label> <?= $wiz04->trach_size == '' ? 'N/A' : $wiz04->trach_size ?> </p>
                <p class="leftadjust"><label>Cuffed:</label> <?= $wiz04->cuffed == '' ? 'N/A' : $wiz04->cuffed ?> </p>
                <p class="rightadjust"><label>Thermo-vent:</label> <?= $wiz04->thermo == '' ? 'N/A' : $wiz04->thermo ?> </p>
                <p class="leftadjust"><label>Passy muir:</label> <?= $wiz04->muir == '' ? 'N/A' : $wiz04->muir ?> </p>
                <p class="rightadjust"><label>CO2 Monitor:</label> <?= $wiz04->co2 == '' ? 'N/A' : $wiz04->co2 ?> </p>
                <p class="leftadjust"><label>CO2 frequency:</label> <?= $wiz04->co2_freq == '' || $wiz04->co2 <> 'yes' ? 'N/A' : $wiz04->co2_freq ?> </p>
                <p class="rightadjust"><label>CO2 parameter:</label> <?= $wiz04->co2_param == '' || $wiz04->co2 <> 'yes' ? 'N/A' : $wiz04->co2_param ?> </p>
                <p class="leftadjust"><label>Addtional ventilator information:</label> <?= $wiz04->addtnl_vent == '' ? 'N/A' : $wiz04->addtnl_vent ?> </p>
                <p class="rightadjust"><label>Suctioning:</label> <?php echo $wiz04->suction == '' ? 'No' : $wiz04->suction; ?> </p>
                <div class="divclearboth"></div>
            </div>

            <?php if ($wiz04->suction == 'Yes'): ?>
                <div class="section-div">
                    <h1>Type of Oropharyngeal</h1>
                    <p class="leftadjust"><label>Oropharyngeal:</label> <?php echo $wiz04->trach_type_o == '' ? 'N/A' : $wiz04->trach_type_o; ?> </p>
                    <p class="rightadjust"><label style="color:#000;">Catheter Type</label></p>
                    <p class="leftadjust"><label>Yankauer Catheter:</label> <?php echo $wiz04->cath_y == '' ? 'N/A' : $wiz04->cath_y; ?> </p>
                    <p class="rightadjust"><label>Flexible Catheter:</label> <?php echo $wiz04->cath_f == '' ? 'N/A' : $wiz04->cath_f; ?> </p>
                    <p class="leftadjust"><label>Catheter Size:</label> <?php echo $wiz04->cath_size == '' ? 'N/A' : $wiz04->cath_size; ?> </p>
                    <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz04->cath_freq == '' ? 'N/A' : $wiz04->cath_freq; ?> </p>
                    <p class="leftadjust"><label>Color of Secretions:</label> <?php echo $wiz04->cath_color == '' ? 'N/A' : $wiz04->cath_color; ?> </p>
                    <p class="rightadjust"><label>Equipment needed for suctioning:</label> <?php echo $wiz04->suction_equip == '' ? 'N/A' : $wiz04->suction_equip; ?> </p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <h1>Type of  Nasopharyngeal</h1>
                    <p class="leftadjust"><label>Nasopharyngeal:</label> <?php echo $wiz04->trach_type_n == '' ? 'N/A' : $wiz04->trach_type_n; ?> </p>
                    <p class="rightadjust"><label style="color:#000;">Catheter Type</label></p>
                    <p class="leftadjust"><label>Yankauer Catheter:</label> <?php echo $wiz04->cath_y2 == '' ? 'N/A' : $wiz04->cath_y2; ?> </p>
                    <p class="rightadjust"><label>Flexible Catheter:</label> <?php echo $wiz04->cath_f2 == '' ? 'N/A' : $wiz04->cath_f2; ?> </p>
                    <p class="leftadjust"><label>Catheter Size:</label> <?php echo $wiz04->cath_size2 == '' ? 'N/A' : $wiz04->cath_size2; ?> </p>
                    <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz04->cath_freq2 == '' ? 'N/A' : $wiz04->cath_freq2; ?> </p>
                    <p class="leftadjust"><label>Color of Secretions:</label> <?php echo $wiz04->cath_color2 == '' ? 'N/A' : $wiz04->cath_color2; ?> </p>
                    <p class="rightadjust"><label>Equipment needed for suctioning:</label> <?php echo $wiz04->suction_equip2 == '' ? 'N/A' : $wiz04->suction_equip2; ?> </p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <h1>Type of  Endotracheal</h1>
                    <p class="leftadjust"><label>Endotracheal:</label> <?php echo $wiz04->trach_type_e == '' ? 'N/A' : $wiz04->trach_type_e; ?> </p>
                    <p class="rightadjust"><label style="color:#000;">Catheter Type</label></p>
                    <p class="leftadjust"><label>Yankauer Catheter:</label> <?php echo $wiz04->cath_y3 == '' ? 'N/A' : $wiz04->cath_y3; ?> </p>
                    <p class="rightadjust"><label>Flexible Catheter:</label> <?php echo $wiz04->cath_f3 == '' ? 'N/A' : $wiz04->cath_f3; ?> </p>
                    <p class="leftadjust"><label>Catheter Size:</label> <?php echo $wiz04->cath_size3 == '' ? 'N/A' : $wiz04->cath_size3; ?> </p>
                    <p class="rightadjust"><label>Frequency:</label> <?php echo $wiz04->cath_freq3 == '' ? 'N/A' : $wiz04->cath_freq3; ?> </p>
                    <p class="leftadjust"><label>Color of Secretions:</label> <?php echo $wiz04->cath_color3 == '' ? 'N/A' : $wiz04->cath_color3; ?> </p>
                    <p class="rightadjust"><label>Equipment needed for suctioning:</label> <?php echo $wiz04->suction_equip3 == '' ? 'N/A' : $wiz04->suction_equip3; ?> </p>
                    <div class="divclearboth"></div>
                </div>
            <?php endif; ?>
            <div class="section-div">
                <p class="leftadjust"><label>Other Equipment Needed for School:</label> <?php echo trim($wiz04->other_equip) == '' ? 'N/A' : $wiz04->other_equip; ?> </p>
                <p class="rightadjust"><label>Equipment Checklist Utilized:</label> <?php echo $wiz04->equip_check == '' ? 'N/A' : $wiz04->equip_check; ?> </p>
                <p class="leftadjust"><label>Evacuation/Emergency Instructions:</label> <?php echo $wiz04->evac == '' ? 'N/A' : $wiz04->evac; ?> </p>
                <p class="rightadjust"><label>Additional Comments:</label> <?php echo $wiz04->oxy_addtnl == '' || trim($wiz04->oxy_addtnl) == '' ? 'N/A' : $wiz04->oxy_addtnl; ?> </p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Orthopedics and Mobility Requirements</label>

                <p class="leftadjust"><label>Ambulatory: </label><?php echo $wiz04->mobility_amb == '' ? 'N/A' : $wiz04->mobility_amb; ?></p>
                <p class="rightadjust"><label>Independent</label><?php echo $wiz04->mobility_ind == '' ? 'N/A' : $wiz04->mobility_ind; ?></p>
                <p class="leftadjust"><label>Needs Supervision</label><?php echo $wiz04->mobility_ns == '' ? 'N/A' : $wiz04->mobility_ns; ?></p>
                <p class="rightadjust"><label>Uses Walker</label><?php echo $wiz04->mobility_uw == '' ? 'N/A' : $wiz04->mobility_uw; ?></p>
                <p class="leftadjust"><label>Gait Trainer</label><?php echo $wiz04->mobility_gt == '' ? 'N/A' : $wiz04->mobility_gt; ?></p>
                <p class="rightadjust"><label>Wheelchair</label><?php echo $wiz04->mobility_wheel == '' ? 'N/A' : $wiz04->mobility_wheel; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Wheelchair</h1>
                <p class="leftadjust"><label>Manual Independent</label><?php echo $wiz04->wc_mi == '' ? 'N/A' : $wiz04->wc_mi; ?></p>
                <p class="rightadjust"><label>Manual Assist</label><?php echo $wiz04->wc_ma == '' ? 'N/A' : $wiz04->wc_ma; ?></p>
                <p class="leftadjust"><label>Power Independent</label><?php echo $wiz04->wc_pi == '' ? 'N/A' : $wiz04->wc_pi; ?></p>
                <p class="rightadjust"><label>Power Assist</label><?php echo $wiz04->wc_pa == '' ? 'N/A' : $wiz04->wc_pa; ?></p>
                <p class="leftadjust"><label>Supervision Only</label><?php echo $wiz04->wc_so == '' ? 'N/A' : $wiz04->wc_so; ?></p>

                <p class="rightadjust"><label>Special Consideration:</label> <?php echo $wiz04->special_cond == '' ? 'N/A' : $wiz04->special_cond; ?></p>
                <p class="leftadjust"><label>Equipment Provider:</label> <?php echo $wiz04->equip_provider == '' ? 'N/A' : $wiz04->equip_provider; ?></p>
                <p class="rightadjust"><label>Contact Info:</label> <?php echo $wiz04->c_info == '' ? 'N/A' : $wiz04->c_info; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Scoliosis</h1>
                <p class="leftadjust"><label>Scoliosis:</label> <?php echo $wiz04->scoliosis == '' ? 'N/A' : $wiz04->scoliosis; ?></p>
                <p class="rightadjust"><label>Last X-Ray/Exam:</label> <?php echo $wiz04->sco_last == '' || $wiz04->scoliosis == '' ? 'N/A' : $wiz04->sco_last; ?></p>
                <p class="leftadjust"><label>Treatment:</label> <?php echo $wiz04->sco_treat == '' || $wiz04->scoliosis == '' ? 'N/A' : $wiz04->sco_treat; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">

                <h1>Hip Dislocation</h1>
                <p class="leftadjust"><label>Hip Dislocation:</label> <?php echo $wiz04->hip == '' ? 'N/A' : $wiz04->hip; ?></p>
                <p class="rightadjust"><label>Last X-Ray/Exam:</label> <?php echo $wiz04->hip_last == '' || $wiz04->hip == '' ? 'N/A' : $wiz04->hip_last; ?></p>
                <p class="leftadjust"><label>Treatment:</label> <?php echo $wiz04->hip_treat == '' || $wiz04->hip == '' ? 'N/A' : $wiz04->hip_treat; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Physical Therapy Services</h1>
                <p class="leftadjust"><label>Physical Therapy Services:</label> <?php echo $wiz04->pt == '' ? 'N/A' : $wiz04->pt; ?></p>
                <p class="rightadjust"><label>If Yes, where:</label> <?php echo $wiz04->pt_where == '' || $wiz04->pt == '' ? 'N/A' : $wiz04->pt_where; ?></p>
                <p class="leftadjust"><label>Details of Mobility Concerns:</label> <?php echo $wiz04->mobi_details == '' ? 'N/A' : $wiz04->mobi_details; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Orthotics</h1>
                <p class="leftadjust"><label>Orthotics:</label> <?php echo $wiz04->orth == '' ? 'No' : $wiz04->orth; ?></p>
                <p class="rightadjust"><label>Type:</label> <?php echo $wiz04->orth_desc == '' || $wiz04->orth <> 'yes' ? 'N/A' : $wiz04->orth_desc; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <h1>Splints</h1>
                <p class="leftadjust"><label>Hand:</label> <?php echo $wiz04->splint_hand == '' ? 'N/A' : $wiz04->splint_hand; ?></p>
                <p class="rightadjust"><label>Knee:</label> <?php echo $wiz04->splint_knee == '' ? 'N/A' : $wiz04->splint_knee; ?></p>
                <p class="leftadjust"><label>Leg:</label> <?php echo $wiz04->splint_leg == '' ? 'N/A' : $wiz04->splint_leg; ?></p>
                <p class="leftadjust"><label>Ankle:</label> <?php echo $wiz04->splint_ankle == '' ? 'N/A' : $wiz04->splint_ankle; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">

                <h1>Transfer/Lift Assistance:</h1>
                <p class="leftadjust"><label>One Person:</label> <?php echo $wiz04->lift_one == '' ? 'N/A' : $wiz04->lift_one; ?></p>
                <p class="rightadjust"><label>Two Person:</label> <?php echo $wiz04->lift_two == '' ? 'N/A' : $wiz04->lift_two; ?></p>
                <p class="leftadjust"><label>Hoyer:</label> <?php echo $wiz04->lift_hoyer == '' ? 'N/A' : $wiz04->lift_hoyer; ?></p>
                <p class="rightadjust"><label>Positioning Plan:</label> <?php echo $wiz04->pos_plan == '' ? 'N/A' : $wiz04->pos_plan; ?></p>
                <p class="leftadjust"><label>If Yes, where:</label> <?php echo $wiz04->pos_plan_desc == '' ? 'N/A' : $wiz04->pos_plan_desc; ?></p>
                <p class="rightadjust"><label>Additional Comments:</label> <?php echo $wiz04->mobi_addtnl == '' ? 'N/A' : $wiz04->mobi_addtnl; ?></p>
                <div class="divclearboth"></div>
            </div>


            <div class="section-div">
                <label>Nutrition and Feeding Safety Requirements</label>

                <p class="leftadjust"><label>Diet:</label> <?php echo $wiz06->diet == '' ? 'N/A' : $wiz06->diet; ?></p>
                <p class="rightadjust"><label>Description:</label> <?php echo $wiz06->food_texture == '' || $wiz06->diet <> 'Special Diet' ? 'N/A' : $wiz06->food_texture; ?></p>

                <p class="leftadjust"><label>Parent Prepares:</label> <?php echo $wiz06->prepare_parent == '' ? 'No' : 'Yes'; ?></p>
                <p class="rightadjust"><label>School Cafe Prepares:</label> <?php echo $wiz06->prepare_school == '' ? 'No' : 'Yes'; ?></p>

                <p class="leftadjust"><label>Other Dietary Restriction:</label> <?php echo $wiz06->food_restriction == '' ? 'N/A' : $wiz06->food_restriction; ?></p>
                <p class="rightadjust"><label>Fluid Consistency/Restrictions:</label> <?php echo $wiz06->fluid_restriction == '' ? 'N/A' : $wiz06->fluid_restriction; ?></p>
                <p class="leftadjust"><label>Feeding Assistance Needed?:</label> <?php echo $wiz06->feeding_assist == '' ? 'N/A' : $wiz06->feeding_assist; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>If Yes, what assistance is needed?</h1>
                <p class="leftadjust"><label>Total:</label> <?php echo $wiz06->feeding_type_total == '' || $wiz06->feeding_assist == '' ? 'N/A' : $wiz06->feeding_type_total; ?></p>
                <p class="rightadjust"><label>Assessing food only:</label> <?php echo $wiz06->feeding_type_assess == '' || $wiz06->feeding_assist == '' ? 'N/A' : $wiz06->feeding_type_assess; ?></p>
                <p class="leftadjust"><label>Opening containers:</label> <?php echo $wiz06->feeding_type_open == '' || $wiz06->feeding_assist == '' ? 'N/A' : $wiz06->feeding_type_open; ?></p>
                <p class="rightadjust"><label>Cutting food:</label> <?php echo $wiz06->feeding_type_cutting == '' || $wiz06->feeding_assist == '' ? 'N/A' : $wiz06->feeding_type_cutting; ?></p>
                <p class="leftadjust"><label>Feeding Tube:</label> <?php echo $wiz06->feeding_tubeval == '' ? 'N/A' : $wiz06->feeding_tubeval; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">

                <h1>Feeding Tube:</h1>

                <p class="leftadjust"><label>Button:</label> <?php echo $wiz06->feeding_tube_mic == '' || $wiz06->feeding_tubeval <> 'yes' ? 'N/A' : 'Button'; ?></p>
                <p class="rightadjust"><label>PEG Tube:</label> <?php echo $wiz06->feeding_tube_peg == '' || $wiz06->feeding_tubeval <> 'yes' ? 'N/A' : $wiz06->feeding_tube_peg; ?></p>
                <p class="leftadjust"><label>J-tube:</label> <?php echo $wiz06->feeding_tube_jtube == '' || $wiz06->feeding_tubeval <> 'yes' ? 'N/A' : $wiz06->feeding_tube_jtube; ?></p>
                <p class="rightadjust"><label>N/G Tube:</label> <?php echo $wiz06->feeding_tube_ng == '' || $wiz06->feeding_tubeval <> 'yes' ? 'N/A' : $wiz06->feeding_tube_ng; ?></p>
                <p class="leftadjust"><label>G/J-Tube:</label> <?php echo $wiz06->feeding_tube_gj == '' || $wiz06->feeding_tubeval <> 'yes' ? 'N/A' : $wiz06->feeding_tube_gj; ?></p>
                <p class="rightadjust"><label>G-Tube Size:</label> <?php echo $wiz06->gtube_size == '' ? 'N/A' : $wiz06->gtube_size; ?></p>
                <p class="leftadjust"><label>Type:</label> <?php echo $wiz06->tube_type == '' ? 'N/A' : $wiz06->tube_type; ?></p>
                <p class="rightadjust"><label>Instructions if dislodged at school:</label> <?php echo $wiz06->inst_dislodged == '' ? 'N/A' : $wiz06->inst_dislodged; ?></p>

                <p class="leftadjust"><label>Bolus:</label> <?php echo $wiz06->tube_feedings_bolus == '' ? 'N/A' : $wiz06->tube_feedings_bolus; ?></p>
                <p class="rightadjust"><label>Pump:</label> <?php echo $wiz06->tube_feedings_pump == '' ? 'N/A' : $wiz06->tube_feedings_pump; ?></p>


                <p class="leftadjust"><label>Type/Time/Frequency (in hours)/Amount:</label> <?php echo $wiz06->feed_freq == '' ? 'N/A' : $wiz06->feed_freq; ?></p>
                <p class="rightadjust"><label>Water Flush:</label> <?php echo $wiz06->water_flush == '' ? 'N/A' : $wiz06->water_flush; ?></p>
                <p class="leftadjust"><label>Free Water:</label> <?php echo $wiz06->free_water == '' ? 'N/A' : $wiz06->free_water; ?></p>
                <p class="rightadjust"><label>Fundoplication:</label> <?php echo $wiz06->fundo == '' ? 'N/A' : $wiz06->fundo; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Last Swallow Study:</h1>
                <p class="leftadjust"><label>VFSS:</label> <?php echo $wiz06->swallow_vfss == '' ? 'N/A' : $wiz06->swallow_vfss; ?></p>
                <p class="rightadjust"><label>Endo:</label> <?php echo $wiz06->swallow_endo == '' ? 'N/A' : $wiz06->swallow_endo; ?></p>

                <p class="rightadjust"><label>Date of Study</label> <?php echo $wiz06->swallow_study_date == '' ? 'N/A' : $wiz06->swallow_study_date; ?></p>
                <p class="leftadjust"><label>Location of Study</label> <?php echo $wiz06->swallow_study_loc == '' ? 'N/A' : $wiz06->swallow_study_loc; ?></p>
                <p class="rightadjust"><label>Reflux:</label> <?php echo $wiz06->reflux == '' ? 'N/A' : $wiz06->reflux; ?></p>
                <p class="leftadjust"><label>Treatment:</label> <?php echo $wiz06->reflux_tx == '' || $wiz06->reflux == '' ? 'N/A' : $wiz06->reflux_tx; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Feeding Clinic:</h1>
                <p class="leftadjust"><label>Feeding Clinic:</label> <?php echo $wiz06->clinic == '' ? 'N/A' : $wiz06->clinic; ?></p>
                <p class="rightadjust"><label>Where and How Often:</label> <?php echo $wiz06->clinic_details == '' ? 'N/A' : $wiz06->clinic_details; ?></p>
                <p class="leftadjust"><label>AACPS SMART Team Managing:</label> <?php echo $wiz06->smart_team == '' ? 'N/A' : $wiz06->smart_team; ?></p>
                <p class="rightadjust"><label>Case Manager:</label> <?php echo $wiz06->smart_manager == '' ? 'N/A' : $wiz06->smart_manager; ?></p>
                <p class="leftadjust"><label>Mealtime Plan of Care:</label> <?php echo $wiz06->meal_care == '' ? 'N/A' : $wiz06->meal_care; ?></p>
                <p class="rightadjust"><label>Additional Comments:</label> <?php echo $wiz06->nutr_comments == '' || trim($wiz06->nutr_comments) == '' ? 'N/A' : $wiz06->nutr_comments; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Diabetes Management</label>
                <?php if ($wiz06->target != '') { ?>
                    <p class="leftadjust"><label>Tests blood glucose at school:</label> <?php echo $wiz06->gluc_test == '' ? 'No' : 'Yes'; ?></p>
                <?php } ?>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>When should student test:</h1>
                <p class="rightadjust"><label>On arrival:</label> <?php echo $wiz06->test_when_arrival == '' ? 'N/A' : $wiz06->test_when_arrival; ?></p>
                <p class="leftadjust"><label>Before breakfast:</label> <?php echo $wiz06->test_when_breakfast == '' ? 'N/A' : $wiz06->test_when_breakfast; ?></p>
                <p class="rightadjust"><label>Before lunch:</label> <?php echo $wiz06->test_when_blunch == '' ? 'N/A' : $wiz06->test_when_blunch; ?></p>
                <p class="leftadjust"><label>After lunch:</label> <?php echo $wiz06->test_when_alunch == '' ? 'N/A' : $wiz06->test_when_alunch; ?></p>
                <p class="rightadjust"><label>Before PE:</label> <?php echo $wiz06->test_when_bpe == '' ? 'N/A' : $wiz06->test_when_bpe; ?></p>
                <p class="leftadjust"><label>After PE:</label> <?php echo $wiz06->test_when_ape == '' ? 'N/A' : $wiz06->test_when_ape; ?></p>
                <p class="rightadjust"><label>Before snacks:</label> <?php echo $wiz06->test_when_snack == '' ? 'N/A' : $wiz06->test_when_snack; ?></p>
                <p class="leftadjust"><label>Before dismissal:</label> <?php echo $wiz06->test_when_dismissal == '' ? 'N/A' : $wiz06->test_when_dismissal; ?></p>
                <p class="rightadjust"><label>Other:</label> <?php echo $wiz06->test_when_other == '' ? 'N/A' : $wiz06->test_when_other; ?></p>
                <p class="leftadjust"><label>Other description:</label> <?php echo $wiz06->othertest == '' || $wiz06->test_when_other == '' ? 'N/A' : $wiz06->othertest; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">

                <h1>Level of Independence:</h1>
                <p class="leftadjust"><label>Independent (outside HR):</label> <?php echo $wiz06->test_ind_outhr == '' ? 'N/A' : $wiz06->test_ind_outhr; ?></p>
                <p class="rightadjust"><label> Independent (inside HR):</label> <?php echo $wiz06->test_ind_inhr == '' ? 'N/A' : $wiz06->test_ind_inhr; ?></p>
                <p class="leftadjust"><label>Supervision Only:</label> <?php echo $wiz06->test_ind_super == '' ? 'N/A' : $wiz06->test_ind_super; ?></p>
                <p class="rightadjust"><label>Assistance Needed:</label> <?php echo $wiz06->test_ind_assist == '' ? 'N/A' : $wiz06->test_ind_assist; ?></p>
                <p class="leftadjust"><label>Dependant:</label> <?php echo $wiz06->test_ind_dep == '' ? 'N/A' : $wiz06->test_ind_dep; ?></p>

                    <!--<p class="rightadjust"><label>If assistance is needed, describe:</label> <?php #echo $wiz06->test_assist == '' || $wiz06->test_ind_assist == '' ? 'N/A' : $wiz06->test_assist;                                                                                                                                                                                                                                 ?></p>-->
                <p class="rightadjust"><label>Target Range:</label> <?php echo $wiz06->target == '' ? 'N/A' : $wiz06->target; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Insulin Delivery</h1>
                <p class="leftadjust"><label>Syringe:</label> <?php echo $wiz06->insulin_type_syringe == '' ? 'N/A' : $wiz06->insulin_type_syringe; ?></p>
                <p class="rightadjust"><label>Insulin Pen:</label> <?php echo $wiz06->insulin_type_pen == '' ? 'N/A' : $wiz06->insulin_type_pen; ?></p>
                <!--<p class="leftadjust"><label>Pump:</label> <?php #echo $wiz06->insulin_type_pump == '' ? 'N/A' : $wiz06->insulin_type_pump;                                                                                                                                                                                                                                 ?></p>-->
                <p class="leftadjust"><label>Pod:</label> <?php echo $wiz06->insulin_type_pod == '' ? 'N/A' : $wiz06->insulin_type_pod; ?></p>
                <p class="rightadjust"><label>Other:</label> <?php echo $wiz06->insulin_type_other == '' ? 'N/A' : $wiz06->insulin_type_other; ?></p>
                <p class="leftadjust"><label>Other Description:</label> <?php echo $wiz06->otherins == '' || $wiz06->insulin_type_other == '' ? 'N/A' : $wiz06->otherins; ?></p>
                <p class="rightadjust"><label>Manufacturer:</label> <?php echo $wiz06->insulin_manu == '' ? 'N/A' : $wiz06->insulin_manu; ?></p>
                <p class="leftadjust"><label>Insulin at school:</label> <?php echo $wiz06->insulin_school == '' ? 'N/A' : $wiz06->insulin_school; ?></p>
                <p class="rightadjust"><label>Type of insulin:</label> <?php echo $wiz06->type_ins_school == '' ? 'N/A' : $wiz06->type_ins_school; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>How is dose calculated?</h1>
                <p class="leftadjust"><label>Correction factor/carb ratio:</label> <?php echo $wiz06->dose_correct == '' ? 'N/A' : $wiz06->dose_correct; ?></p>
                <p class="rightadjust"><label>Standard lunch dose:</label> <?php echo $wiz06->dose_standard == '' ? 'N/A' : $wiz06->dose_standard; ?></p>
                <p class="leftadjust"><label>Sliding scale:</label> <?php echo $wiz06->dose_slide == '' ? 'N/A' : $wiz06->dose_slide; ?></p>
                <p class="rightadjust"><label>Pump calculations:</label> <?php echo $wiz06->dose_pump == '' ? 'N/A' : $wiz06->dose_pump; ?></p>

                <p class="leftadjust"><label>Insulin before lunch:</label> <?php echo $wiz06->before_lunch == '' ? 'N/A' : $wiz06->before_lunch; ?></p>
                <p class="rightadjust"><label>Lunch correction factor:</label> <?php echo $wiz06->lunch_correction == '' ? 'N/A' : $wiz06->lunch_correction; ?></p>
                <p class="leftadjust"><label>Insulin for Snack Order:</label> <?php echo $wiz06->insulin_snack == '' ? 'N/A' : $wiz06->insulin_snack; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">

                <p class="leftadjust"><label>Counts Carbs:</label> <?php echo $wiz06->counts_carbs == '' ? 'N/A' : $wiz06->counts_carbs; ?></p>
                <p class="rightadjust"><label>Lunch Carb Ratio:</label> <?php echo $wiz06->lunch_carb == '' ? 'N/A' : $wiz06->lunch_carb; ?></p>
                <p class="leftadjust"><label>Snack Carb Ratio:</label> <?php echo $wiz06->snack_carb == '' ? 'N/A' : $wiz06->snack_carb; ?></p>
                <p class="rightadjust"><label>Insulin may be given after lunch if:</label> <?php echo $wiz06->after_lunch_reason == '' ? 'N/A' : $wiz06->after_lunch_reason; ?></p>
                <p class="leftadjust"><label>Breakfast at School:</label> <?php echo $wiz06->school_breakfast == '' ? 'N/A' : $wiz06->school_breakfast; ?></p>
                <p class="rightadjust"><label>Breakfast Carb Ratio:</label> <?php echo $wiz06->break_carb == '' ? 'N/A' : $wiz06->break_carb; ?></p>
                <p class="leftadjust"><label>Glucagon at School:</label> <?php echo $wiz06->school_glucagon == '' ? 'N/A' : $wiz06->school_glucagon; ?></p>
                <p class="rightadjust"><label>Glucagon Order (dose/symptoms):</label> <?php echo $wiz06->glucagon_order == '' ? 'N/A' : $wiz06->glucagon_order; ?></p>
                <!--<p class="leftadjust"><label>Treatment for Hypoglycemia:</label> <?php #echo $wiz06->hypo_treatment == '' ? 'N/A' : $wiz06->hypo_treatment;                                                                                                                                                                                                                        ?></p>-->
                <?php if ($wiz06->emer_kit_hrs <> '' || $wiz06->emer_kit_class <> '' || $wiz06->emer_kit_carry <> ''): ?>
                    <p class="leftadjust">
                        <label style="color:#000;">Emergency Kit</label>&nbsp;
                    </p>
                    <p class="leftadjust"><label>In HR:</label> <?php echo $wiz06->emer_kit_hrs == '' ? 'N/A' : $wiz06->emer_kit_hrs; ?></p>
                    <p class="rightadjust"><label>In Classroom:</label> <?php echo $wiz06->emer_kit_class == '' ? 'N/A' : $wiz06->emer_kit_class; ?></p>
                    <p class="leftadjust"><label>Carried with Student:</label> <?php echo $wiz06->emer_kit_carry == '' ? 'N/A' : $wiz06->emer_kit_carry; ?></p>
                    <?php
                endif;
                if ($wiz06->kit_contents_glucose_gel <> '' || $wiz06->kit_contents_glucose_tabs <> '' || $wiz06->kit_contents_juice <> '' ||
                        $wiz06->kit_contents_snacks <> ''):
                    ?>
                    <label class="rightadjust">&nbsp;</label>
                    <p class="leftadjust"><label style="color:#000;">Emergency Kit Contents</label>&nbsp;</p>
                    <p class="rightadjust"><label>Glucose Gel/Cake Mate:</label> <?php echo $wiz06->kit_contents_glucose_gel == '' ? 'N/A' : $wiz06->kit_contents_glucose_gel; ?></p>
                    <p class="leftadjust"><label>Glucose Tabs:</label> <?php echo $wiz06->kit_contents_glucose_tabs == '' ? 'N/A' : $wiz06->kit_contents_glucose_tabs; ?></p>
                    <p class="rightadjust"><label>Juice:</label> <?php echo $wiz06->kit_contents_juice == '' ? 'N/A' : $wiz06->kit_contents_juice; ?></p>
                    <p class="leftadjust"><label>Snacks:</label> <?php echo $wiz06->kit_contents_snacks == '' ? 'N/A' : $wiz06->kit_contents_snacks; ?></p>
                    <p class="rightadjust"><label>Snacks description:</label> <?php echo $wiz06->emer_snacks == '' || $wiz06->kit_contents_snacks == '' ? 'N/A' : $wiz06->emer_snacks; ?></p>
                <?php endif; ?>

                <p class="leftadjust"><label>Treatment for Hypoglycemia if different than Standard Emergency Action Plan:</label> <?php echo $wiz06->hyper_treatment == '' ? 'N/A' : $wiz06->hyper_treatment; ?></p>

                <p class="rightadjust"><label>Insulin for Ketones:</label> <?php echo $wiz06->insulin_key == '' ? 'N/A' : $wiz06->insulin_key; ?></p>
                <p class="leftadjust"><label>Insulin for Ketones Order:</label> <?php echo $wiz06->insulin_key_order == '' ? 'N/A' : $wiz06->insulin_key_order; ?></p>
                <p class="rightadjust"><label>Discretionary Orders:</label> <?php echo $wiz06->discrete == '' ? 'N/A' : $wiz06->discrete; ?></p>
                <p class="leftadjust"><label>Discretionary description:</label> <?php echo $wiz06->discretionary_list == '' || $wiz06->discrete == '' ? 'N/A' : $wiz06->discretionary_list; ?></p>
                <p class="rightadjust"><label>Home Insulin Order:</label> <?php echo $wiz06->home_insulin_order == '' ? 'N/A' : $wiz06->home_insulin_order; ?></p>
                <p class="leftadjust"><label>Lock Down Insulin Orders:</label> <?php echo $wiz06->lockdown == '' ? 'N/A' : $wiz06->lockdown; ?></p>
                <p class="rightadjust"><label>Additional Comments:</label> <?php echo $wiz06->diabetes_additional == '' ? 'N/A' : $wiz06->diabetes_additional; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Adrenal Insufficiency</label>
                <p class="leftadjust"><label>Age of diagnosis :</label> <?= $wiz06->ageofdia == '' ? 'N/A' : $wiz06->ageofdia ?> </p>
                <p class="rightadjust"><label>Has experienced adrenal crisis:</label> <?= $wiz06->crisis_ex == '' ? 'N/A' : $wiz06->crisis_ex ?> </p>
                <p class="leftadjust"><label>Date:</label> <?= $wiz06->crisis_date == '' || $wiz06->crisis_ex == '' ? 'N/A' : $wiz06->crisis_date ?> </p>
                <p class="rightadjust"><label>Symptoms:</label> <?= $wiz06->crisis_symptoms == '' || $wiz06->crisis_ex == '' ? 'N/A' : $wiz06->crisis_symptoms ?> </p>
                <p class="leftadjust"><label>Hydrocortisone P.O :</label> <?= $wiz06->hydro == '' ? 'N/A' : $wiz06->hydro ?> </p>
                <p class="rightadjust"><label>Solu-Cortef IM:</label> <?= $wiz06->solu == '' ? 'N/A' : $wiz06->solu ?> </p>
                <p class="leftadjust"><label>Other:</label> <?= $wiz06->troher == '' ? 'N/A' : $wiz06->troher ?> </p>
                <p class="rightadjust"><label>In health room :</label> <?= $wiz06->healthroom == '' ? 'N/A' : $wiz06->healthroom ?> </p>
                <p class="leftadjust"><label>In classroom :</label> <?= $wiz06->classroom == '' ? 'N/A' : $wiz06->classroom ?> </p>
                <p class="rightadjust"><label>Carried with Student:</label> <?= $wiz06->carried == '' ? 'N/A' : $wiz06->carried ?> </p>
                <p class="leftadjust"><label>Medical Alert bracelet: </label> <?= $wiz06->bracelet == '' ? 'N/A' : $wiz06->bracelet ?> </p>
                <p class="rightadjust"><label>Sick day orders and meds:</label> <?= $wiz06->sickday == '' ? 'N/A' : $wiz06->sickday ?> </p>
                <p class="leftadjust"><label>Lock Down orders and meds:</label> <?= $wiz06->lockdown == '' ? 'N/A' : $wiz06->lockdown ?> </p>
                <p class="rightadjust"><label>Additional comments:</label> <?= trim($wiz06->addcomments) == '' ? 'N/A' : $wiz06->addcomments ?> </p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Other Diagnosis</label>
                <p class="leftadjust"><label>Diagnosis or health concern  :</label> <?= $wiz06->health_concern == '' ? 'N/A' : $wiz06->health_concern ?> </p>
                <p class="rightadjust"><label>Age at time of diagnosis :</label> <?= $wiz06->timedia == '' ? 'N/A' : $wiz06->timedia ?> </p>
                <p class="leftadjust"><label>Symptoms? </label> <?= $wiz06->od_sym == '' ? 'N/A' : $wiz06->od_sym ?> </p>
                <p class="rightadjust"><label>How often?</label> <?= $wiz06->od_often == '' ? 'N/A' : $wiz06->od_often ?> </p>
                <p class="leftadjust"><label>Do the symptoms or treatment for symptoms impact your child’s daily schedule or routine? </label> <?= $wiz06->routine == '' ? 'N/A' : $wiz06->routine ?> </p>
                <p class="rightadjust"><label>how and when? </label> <?= $wiz06->od_when == '' || $wiz06->routine == '' ? 'N/A' : $wiz06->od_when ?> </p>
                <p class="leftadjust"><label>When was the last visit to the PCP?:</label> <?= $wiz06->od_lvisit == '' ? 'N/A' : $wiz06->od_lvisit ?> </p>
                <p class="rightadjust"><label>Has your child needed to receive urgent care/ emergency care (and/or surgery) for this condition? </label> <?= $wiz06->or_surg == '' ? 'N/A' : $wiz06->or_surg ?> </p>
                <p class="leftadjust"><label>How many times ? </label> <?= $wiz06->od_times == '' || $wiz06->or_surg == '' ? 'N/A' : $wiz06->od_times ?> </p>
                <p class="rightadjust"><label>Last time:  :</label> <?= $wiz06->od_timelast == '' || $wiz06->or_surg == '' ? 'N/A' : $wiz06->od_timelast ?> </p>
                <p class="leftadjust"><label>Will medications/treatments be needed at school? </label> <?= $wiz06->od_needschool == '' ? 'N/A' : $wiz06->od_needschool ?> </p>
                <p class="rightadjust"><label>Please List :</label> <?= $wiz06->od_desc == '' || $wiz06->od_needschool == '' || $wiz06->od_needschool == '' ? 'N/A' : $wiz06->od_desc ?> </p>
                <p class="leftadjust"><label>Other equipment or supplies needed at school?</label> <?= $wiz06->o_supp == '' ? 'N/A' : $wiz06->o_supp; ?> </p>
                <p class="rightadjust"><label>please list? </label> <?= $wiz06->o_supp_desc == '' || $wiz06->o_supp == '' ? 'N/A' : $wiz06->o_supp_desc ?> </p>
                <p class="leftadjust"><label>Did your child miss school last year due to his/her health condition:</label> <?= $wiz06->o_cdue == '' ? 'N/A' : $wiz06->o_cdue ?> </p>
                <p class="rightadjust"><label>If yes, how many :</label> <?= $wiz06->o_cdue_desc == '' || $wiz06->o_cdue == '' ? 'N/A' : $wiz06->o_cdue_desc ?> </p>
                <p class="leftadjust"><label>Does your child have any activity restriction/ PE Restriction related to this diagnosis? </label> <?= $wiz06->o_res == '' ? 'N/A' : $wiz06->o_res ?> </p>
                <p class="rightadjust"><label>If yes, please describe?</label> <?= $wiz06->o_res_desc == '' || $wiz06->o_res == '' ? 'N/A' : $wiz06->o_res_desc ?> </p>
                <p class="leftadjust"><label>Additional Information </label> <?= $wiz06->od_add_info == '' ? 'N/A' : $wiz06->od_add_info ?> </p>

                <div class="divclearboth"></div>

            </div>
            <div class="section-div">
                <label>Educational Status</label>
                <?php if ($wiz06->edustatus != '') { ?>
                    <p class="leftadjust"><label>ITP:</label> <?php echo $wiz06->edustatus <> '' ? $wiz06->edustatus : "Nil"; ?> </p>
                <?php } ?>
                <p class="rightadjust"><label>Regular Education:</label> <?php echo in_array('eduIEP', $wiz06->edustatus2) ? 'Regular Education' : "N/A"; ?> </p>
                <p class="leftadjust"><label>IEP:</label> <?php echo in_array('eduIEP', $wiz06->edustatus2) ? 'IEP' : "N/A"; ?></p>
                <p class="rightadjust"><label>504:</label> <?php echo in_array('edu504', $wiz06->edustatus2) ? '504' : "N/A"; ?></p>
                <p class="leftadjust"><label>Current Grade: </label><?php echo $wiz06->grade == '' ? 'N/A' : $wiz06->grade; ?></p>
                <p class="rightadjust"><label>Other Grade: </label><?php echo $wiz06->othergrade == '' || $wiz06->grade <> 'Other' ? 'N/A' : $wiz06->othergrade; ?></p>
                <p class="leftadjust"><label>Current Individual Educational Assistant: </label> <?php echo $wiz06->assistant[0] <> 'assistantyes' ? 'N/A' : "yes"; ?></p>
                <p class="rightadjust"><label> Occupational Therapy: </label> <?php echo in_array('occupationaltherapy', $wiz06->eduservices) ? 'Occupational Therapy' : "N/A"; ?></p>
                <p class="leftadjust"><label> Physical Therapy:</label> <?php echo in_array('physicaltherapy', $wiz06->eduservices) ? 'physicaltherapy' : "N/A"; ?></p>
                <p class="rightadjust"><label> Speech/Language:</label> <?php echo in_array('speechlanguage', $wiz06->eduservices) ? 'speechlanguage' : "N/A"; ?></p>
                <p class="leftadjust"><label> Counseling:</label> <?php echo in_array('counseling', $wiz06->eduservices) ? 'counseling' : "N/A"; ?></p>
                <p class="rightadjust"><label> Adaptive PE:</label> <?php echo in_array('adaptivepe', $wiz06->eduservices) ? 'adaptivepe' : "N/A"; ?></p>
                <p class="leftadjust"><label>Home Hospital Teaching:</label>  <?php echo in_array('offlocation_hospital', $wiz06->offlocation) ? 'Home Hospital Teaching' : "N/A"; ?></p>
                <p class="rightadjust"><label>Concurrent Home Teaching:</label>  <?php echo in_array('offlocation_home', $wiz06->offlocation) ? 'Concurrent Home Teaching' : "N/A"; ?></p>
                <p class="leftadjust"><label>Re-Evaluation Date</label> <?php echo $wiz06->reevaldate == '' ? 'N/A' : $wiz06->reevaldate; ?></p>
                <p class="rightadjust"><label>Assistive Technology: </label> <?php echo $wiz06->accomodations[0] <> 'accomodationsyes' ? 'N/A' : 'yes'; ?></p>
                <p class="leftadjust"><label>Please List Assistive Technology: </label> <?php echo $wiz06->assisttechlist == '' || $wiz06->accomodations[0] <> 'accomodationsyes' ? 'N/A' : $wiz06->assisttechlist; ?></p>
                <p class="rightadjust"><label>Classroom Accommodations: </label> <?php echo $wiz06->accomodations[0] <> 'accomodationsyes' ? 'N/A' : 'yes'; ?></p>
                <p class="leftadjust"><label> List Classroom Accommodations: </label> <?php echo $wiz06->accomodationslist == '' || $wiz06->accomodations[0] <> 'accomodationsyes' ? 'N/A' : $wiz06->accomodationslist; ?></p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">
                <label>Transportation Status</label>

                <h1>Method of Transportation</h1>
                <p class="leftadjust"><label>Walker:</label> <?php echo $wiz06->trans_method_walker == '' ? 'N/A' : $wiz06->trans_method_walker; ?></p>
                <p class="rightadjust"><label>Car Rider:</label> <?php echo $wiz06->trans_method_car == '' ? 'N/A' : $wiz06->trans_method_car; ?></p>
                <p class="leftadjust"><label>Bus Rider:</label> <?php echo $wiz06->trans_method_bus == '' ? 'N/A' : $wiz06->trans_method_bus; ?></p>
                <p class="rightadjust"><label>Lift Bus:</label> <?php echo $wiz06->trans_method_lift == '' ? 'N/A' : $wiz06->trans_method_lift; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Current Bus Services Provided</h1>
                <p class="leftadjust"><label>Assistance Needed:</label> <?php echo $wiz06->bus_services_assist == '' ? 'N/A' : $wiz06->bus_services_assist; ?></p>
                <p class="rightadjust" ><label>Aide on Bus:</label> <?php echo $wiz06->bus_services_aide == '' ? 'N/A' : $wiz06->bus_services_aide; ?></p>
                <p class="leftadjust"><label>Nursing Services on Bus:</label> <?php echo $wiz06->bus_services_nursing == '' ? 'N/A' : $wiz06->bus_services_nursing; ?></p>
                <p class="rightadjust"><label>Equipment Checklist Used:</label> <?php echo $wiz06->bus_services_equip == '' ? 'N/A' : $wiz06->bus_services_equip; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>Bus Medication</h1>
                <p class="leftadjust"><label>Medication on Bus:</label> <?php echo $wiz06->bus_meds == '' ? 'N/A' : $wiz06->bus_meds; ?></p>
                <p class="rightadjust"><label>If Yes, List:</label> <?php echo $wiz06->list_bus_meds == '' || $wiz06->bus_meds == '' ? 'N/A' : $wiz06->list_bus_meds; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <h1>How is medication handled?</h1>
                <p class="leftadjust"><label>Self Carries/Self Administers:</label> <?php echo $wiz06->med_bus_selfadmin == '' ? 'N/A' : $wiz06->med_bus_selfadmin; ?></p>
                <p class="rightadjust"><label>Self Carries/Unable to Self Administer:</label> <?php echo $wiz06->med_bus_selfmed == '' ? 'N/A' : $wiz06->med_bus_selfmed; ?></p>
                <p class="leftadjust"><label>Driver/Aide Trained to Administer:</label> <?php echo $wiz06->med_bus_aideadmin == '' ? 'N/A' : $wiz06->med_bus_aideadmin; ?></p>
                <p class="rightadjust"><label>Snacks on Bus:</label> <?php echo $wiz06->bus_snacks == '' ? 'N/A' : $wiz06->bus_snacks; ?></p>
                <p class="leftadjust"><label>If Yes, List:</label> <?php echo $wiz06->bus_snacks <> 'yes' || $wiz06->describe_Snacks == '' ? 'N/A' : $wiz06->describe_Snacks; ?></p>
                <p class="rightadjust"><label>Special Modifications Needed for Bus?:</label> <?php echo $wiz06->bus_mod == '' ? 'N/A' : $wiz06->bus_mod; ?></p>
                <p class="leftadjust"><label>If Yes, List Special Modifications Needed:</label> <?php echo $wiz06->bus_mod_list == '' ? 'N/A' : $wiz06->bus_mod_list; ?></p>
                <p class="rightadjust"><label>Additional Comments:</label> <?php echo trim($wiz06->trans_comments) == '' ? 'N/A' : $wiz06->trans_comments; ?></p>
                <p class="leftadjust"><label>Needs for Field Trips:</label> <?php echo $wiz06->trans_field == '' ? 'N/A' : $wiz06->trans_field; ?></p>
                <div class="divclearboth"></div>
            </div>

            <div class="section-div">
                <label>Additional Information/Specific Cultural Beliefs</label>
                <p class="leftadjust"><label style="color:#000;">Awareness of safety issues/behaviors/awareness of pain/soothers:</label>
                    <?= $wiz06->cultural_info == '' ? 'N/A' : $wiz06->cultural_info ?> </p>
                <div class="divclearboth"></div>

            </div>
            <?php
            foreach ($wiz06->sheepItForm1_planname as $key => $prnMedications):
                if ($key > 0):
                    if ($wiz06->sheepItForm1_planname == ""):
                        continue;
                    endif;
                endif;
                ?>
                <div class="section-div">
                    <label>Emergency Action Plans <?php echo $key + 1; ?></label>
                    <h1>Seizure Plans:</h1>
                    <?php $wiz06->sheepItForm1_planname[0] = 'N/A'; ?>
                    <p class="leftadjust"><label>Plan Name:</label> <?php echo $wiz06->sheepItForm1_planname[$key] == '' ? 'N/A' : ( $wiz06->sheepItForm1_planname[$key]); ?></p>
                    <p class="leftadjust"><label>Seizure Plan:</label> <?php echo $wiz06->sheepItForm1_0_seizure_plan1[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz06->sheepItForm1_0_hcap_seizure_teacher[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan1[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Bus:</label> <?php echo $wiz06->sheepItForm1_0_hcap_seizure_bus[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan1[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>HR File:</label> <?php echo $wiz06->sheepItForm1_0_hcap_seizure_hr[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan1[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz06->sheepItForm1_hcap_seizure_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan1[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_seizure_review[$key]); ?></p>
                    <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz06->sheepItForm1_hcap_seizure_dist[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan1[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_seizure_dist[$key]); ?></p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <h1>Hypo/Hyperglycemia Plans:</h1>
                    <p class="leftadjust"><label>Hypo/Hyperglycemia Plan:</label> <?php echo $wiz06->sheepItForm1_0_seizure_plan2[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz06->sheepItForm1_0_hcap_hypo_teacher[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan2[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Bus:</label> <?php echo $wiz06->sheepItForm1_0_hcap_hypo_bus[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan2[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>HR File:</label> <?php echo $wiz06->sheepItForm1_0_hcap_hypo_hr[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan2[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz06->sheepItForm1_hcap_hypo_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan2[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_hypo_review[$key]); ?></p>
                    <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz06->sheepItForm1_hcap_hypo_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan2[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_hypo_review[$key]); ?></p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <label>Allergy Plans:</label>
                    <p class="leftadjust"><label>Allergy Plan:</label> <?php echo $wiz06->sheepItForm1_0_seizure_plan3[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz06->sheepItForm1_0_hcap_allergy_teacher[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan3[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Bus:</label> <?php echo $wiz06->sheepItForm1_0_hcap_allergy_bus[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan3[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>HR File:</label> <?php echo $wiz06->sheepItForm1_0_hcap_allergy_hr[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan3[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz06->sheepItForm1_hcap_allergy_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan3[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_allergy_review[$key]); ?></p>
                    <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz06->sheepItForm1_hcap_allergy_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan3[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_allergy_review[$key]); ?></p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <h1>G-Tube Replacement Plans:</h1>
                    <p class="leftadjust"><label>G-Tube Replacement Plan:</label> <?php echo $wiz06->sheepItForm1_0_seizure_plan4[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz06->sheepItForm1_0_hcap_gtube_teacher[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan4[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Bus:</label> <?php echo $wiz06->sheepItForm1_0_hcap_gtube_bus[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan4[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>HR File:</label> <?php echo $wiz06->sheepItForm1_0_hcap_gtube_hr[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan4[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz06->sheepItForm1_hcap_gtube_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan4[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_gtube_review[$key]); ?></p>
                    <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz06->sheepItForm1_hcap_gtube_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan4[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_gtube_review[$key]); ?></p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <h1>Cardiac Plans:</h1>
                    <p class="leftadjust"><label>Cardiac Plan:</label> <?php echo $wiz06->sheepItForm1_0_seizure_plan5[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz06->sheepItForm1_0_hcap_cardiac_teacher[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan5[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Bus:</label> <?php echo $wiz06->sheepItForm1_0_hcap_cardiac_bus[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan5[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>HR File:</label> <?php echo $wiz06->sheepItForm1_0_hcap_cardiac_hr[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan5[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz06->sheepItForm1_hcap_cardiac_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan5[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_cardiac_review[$key]); ?></p>
                    <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz06->sheepItForm1_hcap_cardiac_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan5[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_cardiac_review[$key]); ?></p>
                    <div class="divclearboth"></div>
                </div>
                <div class="section-div">
                    <h1>Respiratory Distress Plans:</h1>
                    <p class="leftadjust"><label>Respiratory Distress Plan:</label> <?php echo $wiz06->sheepItForm1_0_seizure_plan6[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz06->sheepItForm1_0_hcap_resp_teacher[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan6[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Bus:</label> <?php echo $wiz06->sheepItForm1_0_hcap_resp_bus[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan6[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>HR File:</label> <?php echo $wiz06->sheepItForm1_0_hcap_resp_hr[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan6[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz06->sheepItForm1_hcap_resp_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan6[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_resp_review[$key]); ?></p>
                    <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz06->sheepItForm1_hcap_resp_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan6[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_resp_review[$key]); ?></p>
                    <div class="divclearboth"></div>
                </div>

                <div class="section-div">
                    <h1>Emergency Exit Plans:</h1>
                    <p class="leftadjust"><label>Emergency Exit Plan:</label> <?php echo $wiz06->sheepItForm1_0_seizure_plan7[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>Teachers:</label> <?php echo $wiz06->sheepItForm1_0_hcap_emer_teacher[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan7[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Bus:</label> <?php echo $wiz06->sheepItForm1_0_hcap_emer_bus[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan7[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="rightadjust"><label>HR File:</label> <?php echo $wiz06->sheepItForm1_0_hcap_emer_hr[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan7[$key] == '' ? 'No' : 'Yes'; ?></p>
                    <p class="leftadjust"><label>Date Reviewed:</label> <?php echo $wiz06->sheepItForm1_hcap_emer_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan7[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_emer_review[$key]); ?></p>
                    <p class="rightadjust"><label>Date Distributed:</label> <?php echo $wiz06->sheepItForm1_hcap_emer_review[$key] == '' || $wiz06->sheepItForm1_0_seizure_plan7[$key] == '' ? 'N/A' : ($wiz06->sheepItForm1_hcap_emer_review[$key]); ?></p>

                    <div class="divclearboth"></div>
                </div>
            <?php endforeach; ?>

            <div class="section-div">
                <label>Needs for School Attendance</label>
                <p class="leftadjust"><label>Delegatable Nursing Services During the School Day :</label> <?= $wiz06->delegatable == '' ? 'N/A' : $wiz06->delegatable ?> </p>
                <p class="rightadjust"><label>Non-Delegatable Nursing Services During the School Day:</label> <?= $wiz06->non_delegatable == '' ? 'N/A' : $wiz06->non_delegatable ?> </p>
                <p class="leftadjust"><label>Parents Will Provide:</label> <?= $wiz06->parents_provide == '' ? 'N/A' : $wiz06->parents_provide ?> </p>
                <p class="rightadjust"><label>School Will Provide:</label> <?= $wiz06->school_provide == '' ? 'N/A' : $wiz06->school_provide ?> </p>
                <div class="divclearboth"></div>
            </div>
            <div class="section-div">

                <h1>Individualized Healthcare Plan</h1>
                <?php
                if (!empty($wiz06->ihp) && $wiz06->ihp == 'ip') {
                    $wiz06->ihp = "In Progress";
                } else if (!empty($wiz06->ihp) && $wiz06->ihp == 'no') {
                    $wiz06->ihp = "No";
                } else if (!empty($wiz06->ihp) && $wiz06->ihp == 'yes') {
                    $wiz06->ihp = "yes";
                }
                ?>
                <p class="leftadjust"> <label>IHP:</label> <?php echo $wiz06->ihp == '' ? 'N/A' : $wiz06->ihp; ?></p>
                <p class="rightadjust"><label>Medical Diagnosis:</label> <?php echo $wiz06->newdiagnosis == '' || $wiz06->ihp <> 'yes' ? 'N/A' : rtrim($wiz06->newdiagnosis, ','); ?></p>
                <div class="divclearboth"></div>
            </div>
        </div>

        <div id="data-available">

        </div>

        <!--        <div id="no-data">

                </div>-->
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
                if ($.trim($(this).html()) === 'N/A' || $.trim($(this).html()) === 'No' || $.trim($(this).html()) === 'no') {
                    counter++;
                }
            });
            if ($(this).find('p').length === counter) {
                if (appendHtml)
                    $('div#no-data').append("<h1>" + appendHtml + "</h1>").append("<p>Not Applicable</p>");
            }
            else {
                $('div#data-available').append(totalHtml);
            }
        })
                .promise().done(function() {
            $('div#data-available').each(function() {
//                $(this).find('p').each(function() {
//                    if ($(this).html().indexOf("N/A") != -1 || $(this).html().indexOf("No") != -1 || $(this).html().indexOf("no") != -1) {
//                        $(this).remove();
//                    }
//                });
                $(this).find('p').each(function() {
                    spl = $(this).html().split('</label>');
                    if (spl[1]) {
                        if (($.trim(spl[1]) == "N/A") || ($.trim(spl[1]) == "No") || ($.trim(spl[1]) == "no") || ($.trim(spl[1]) == "None")) {
                            $(this).remove();  // Here remove the empty data (N/A)
                        }
                    }
                });
            });
            $('div.first-divs').remove();
        }).promise().done(function() {
            $('div.section-div').each(function() {
                $(this).find("p").each(function(index) {
                    $(this).removeClass('leftadjust').removeClass('rightadjust');
                    if (index % 2) {
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
<style>
    h1.pagetitle{
        font-size: 2.5em !important;
        font-weight: 400 !important;
        margin-bottom: 45px !important;
        background: none !important;
    }
    .page.noshadow{
        box-shadow: 0 0 6px 4px rgba(119, 119, 119, 0);
    }
    .page.healthform.viewsh1.noshadow {
        margin-top: -400px;
    }

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
