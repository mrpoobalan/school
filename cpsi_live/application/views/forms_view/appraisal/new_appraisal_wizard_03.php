<style>
    select{
        width:auto!important;
    }
    .error{
        color: red;
    }
    .errorchk21,.errorchk22,.errorchk23,.errorchk15,.errorchk16,.errorchk17,.errorchk18,.errorchk0,.errorchk,.errorchk1,.errorchk2,.errorchk3,.errorchk4,.errorchk5,.errorchk6,.errorchk7,.errorchk8,.errorchk9,.errorchk10,.errorchk11{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
    .req_question{

    }
    .agency {
    }

</style>

<?php
// load dashboard admin menu

$this->load->view("menu/top_menu");
if (empty($wizardData)):
    $wizardData = $autosave;
endif;
$attr_FormSubmit_appraisal = array('class' => 'save', 'id' => 'appraisal3', 'name' => 'appraisal3', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_appraisal = array('id' => 'appraisal', 'name' => 'appraisal_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "appraisal3", 'class' => "healthform");
$sif = array('name' => 'sif', 'type' => 'hidden');
// setup values for all checkboxes
//echo $wizardData->sheepItForm5_0_performed_school;
//echo "<pre>";print_r($wizardData);exit;
if (empty($wizardData)) {
    $checkboxFields = array('release1', 'seizures', 'shunt', 'dentalrelease', 'hearingrelease',
        'visionrelease', 'agencyrelease1', 'taken1', 'prntaken1', 'deadly1', 'sensitivity1', 'treatment1',
        'allergiestreatment1', 'seizuretreatment', 'devicelist', 'needtype', 'diagnosed1', 'performed1',
        'performed1', 'release2', 'devices', 'seizures', 'shunt', 'ketogenic', 'aura', 'sheepItForm5_0_performed_school', 'sheepItForm5_1_performed_school', 'sheepItForm5_2_performed_school',
        'hideSection1', 'hideSection2', 'hideSection3', 'hideSection4', 'hideSection5', 'hideSection6', 'hideSection7', 'hideSection8');

    foreach ($checkboxFields as $field) {
        if (property_exists($wizardData, $field) && is_array($wizardData->{$field})) {
            foreach ($wizardData->{$field} as $key => $selectedValue) {
                $selectedValue = strtolower($selectedValue);
                $wizardData->$selectedValue = $selectedValue;
            }
        }
    }
}
//echo '<pre>';
//print_r($wizardData);
//exit;
?>

<section class="page">
    <h1><?= $subtitle ?></h1>
    <?= form_open("{$action}", $attr_FormOpen); ?>
    <fieldset class="new-section">
        <legend>Physicians</legend>
        <section>
            <label for="primary">Primary Care</label>
            <input type="text" id="primary" name="primary" value="<?= !empty($wizardData->primary) ? $wizardData->primary : ''; ?>"/>
            <label for="lastexam1">Last Exam</label>
            <input type="text" id="lastexam1" name="lastexam1" value="<?= !empty($wizardData->lastexam1) ? $wizardData->lastexam1 : ''; ?>"/>
            <label for="nextexam1">Next Exam</label>
            <input type="text" id="nextexam1" name="nextexam1" value="<?= !empty($wizardData->nextexam1) ? $wizardData->nextexam1 : ''; ?>"/>
            <label for="phone1">Phone</label>
            <input type="text" id="phone1" name="phone1" value="<?= !empty($wizardData->phone1) ? $wizardData->phone1 : ''; ?>" />
            <label for="fax1">Fax</label>
            <input type="text" id="fax1" name="fax1" value="<?= !empty($wizardData->fax1) ? $wizardData->fax1 : ''; ?>"/>

            <label for="release1">Release?</label>
            <span class="inline"><input type="radio" name="release1" value="release1yes" id="release1-yes"  onclick="showvalue51(this.value)" <?= $wizardData->release1 == "release1yes" || $wizardData->release1 == "yes" ? ' checked ' : ''; ?> /> <label for="release1-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio" name="release1" value="release1no" id="release1-no"  onclick="showvalue51(this.value)" <?= $wizardData->release1 == "release1no" || $wizardData->release1 == " " ? ' checked ' : ''; ?>/> <label for="release1-no"><span></span>No</label></span>
            <div id="hidename51">
                <label for="list_bus_meds">list or explain</label>
                <textarea id="describe_release1" name="describe_release1"><?php echo $wizardData->describe_release1 ?></textarea>

                <label for="release-exp1">Release Expiration</label>
                <?php !empty($wizardData->release_exp1) ? $wizardData->releaseexp1 = $wizardData->release_exp1 : ''; ?>
                <input type="text" id="releaseexp1"  name="releaseexp1" value="<?= !empty($wizardData->releaseexp1) ? $wizardData->releaseexp1 : ''; ?>" />
            </div>
        </section>
        <section>


            <div id="sheepItForm1">
                <!-- Form template-->
                <div id="sheepItForm1_template" style="border-bottom: dashed #444 0px;">
                    <label>Specialist<text id="sheepItForm1_label"></text><a id="sheepItForm1_remove_current">
                            <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                        </a></label>
                    <input id="sheepItForm1_#index#_specialist" name="sheepItForm1_specialist[#index#]" type="text" size="15" maxlength="25" />
                    <label for="sheepItForm1_#index#_lastexam">Type of Physician</label>
                    <input id="sheepItForm1_#index#_type" name="sheepItForm1_type[#index#]" type="text" size="15" maxlength="50"  />

                    <label for="sheepItForm1_#index#_lastexam">Last Exam</label>
                    <input id="sheepItForm1_#index#_lastexam" name="sheepItForm1_lastexam[]" type="text" size="15" maxlength="100"  class="generate_datepic"/>
                    <label for="sheepItForm1_#index#_nextexam">Next Exam</label>
                    <input id="sheepItForm1_#index#_nextexam" name="sheepItForm1_nextexam[]" type="text" size="15" maxlength="100"  class="generate_datepic" />
                    <label for="sheepItForm1_#index#_phone">Phone</label>
                    <input id="sheepItForm1_#index#_phone" name="sheepItForm1_phone[#index#]" type="text" size="15" maxlength="25" />
                    <label for="sheepItForm1_#index#_fax">Fax</label>
                    <input id="sheepItForm1_#index#_fax" name="sheepItForm1_fax[]" type="text" size="15" maxlength="25" />
                    <label for="sheepItForm1_#index#_release">Release</label>
                    <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                        <input type="radio" name="sheepItForm1_release#index#" value="yes" onclick="showvalue52(this.value, '#index#')" id="sheepItForm1_#index#_release1"  /><label for="release1-yes">Yes</label>
                    </span>
                    <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                        <input type="radio" name="sheepItForm1_release#index#" value="no" onclick="showvalue52(this.value, '#index#')" id="sheepItForm1_#index#_release2" checked="checked" /><label for="release1-no">No</label>
                    </span>
                    <div id="hidename52_#index#">
                        <label for="list_bus_meds">list or explain</label>
                        <textarea id="sheepItForm1_#index#_describe_sheepItForm" name="sheepItForm1_describe_sheepItForm[]"><?php #echo $wizardData->describe_sheepItForm                                                                                                                                                                                                                                                                                                       ?></textarea>

                        <label for="sheepItForm1_#index#_exp">Release Expiration</label>

                        <input id="sheepItForm1_#index#_releaseexp" name="sheepItForm1_releaseexp[]" type="text" size="15" maxlength="10" class="generate_datepic"/>
                    </div>
                </div>
                <!-- /Form template-->

                <!-- No forms template -->
                <div id="sheepItForm1_noforms_template">No Specialists</div>
                <!-- /No forms template-->
            </div>
        </section>
        <section class="buttons">
            <p><div id="sheepItForm1_add"><a class="addnew-button" href="javascript:addNewDr()">Add New Specialist</a></div></p>
        </section>
    </fieldset>
    <fieldset class="new-section threecol">
        <span class="inline hide <?= !empty($wizardData->hideSection1) ? 'hide' : '' ?>"><input type="checkbox" onclick="hideSection(1)" name="hideSection1" id="hideSection1" value="hideSection1" <?= !empty($wizardData->hideSection1) ? ' checked ' : ''; ?> /> <label for="hideSection1"><span></span>Not Applicable</label></span>
        <legend>Dental, Hearing, and Vision</legend>
        <div  class="hideSection1">
            <section>
                <label for="dentist">Dentist</label>
                <input type="text" id="dentist" name="dentist" value="<?= !empty($wizardData->dentist) ? $wizardData->dentist : ''; ?>"/>
                <label for="dentalexam">Exam Date</label>
                <input type="text" id="dentalexam" name="dentalexam"  value="<?= !empty($wizardData->dentalexam) ? $wizardData->dentalexam : ''; ?>"/>
                <label for="dentalhistory">History and Treatment</label>
                <textarea id="dentalhistory" name="dentalhistory"><?= !empty($wizardData->dentalhistory) ? $wizardData->dentalhistory : ''; ?></textarea>
                <label for="dentalrelease">Consent for Record Release?</label>
                <span class="inline"><input type="radio" name="dentalrelease[]" value="dentalreleaseyes" id="dentalrelease-yes" <?= 'checked'; ?> /> <label for="dentalrelease-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="dentalrelease[]" value="dentalreleaseno" id="dentalrelease-no" <?= (!empty($wizardData->dentalrelease[0]) && $wizardData->dentalrelease[0] == "dentalreleaseno") || (empty($wizardData->dentalrelease)) ? 'checked' : ''; ?> /> <label for="dentalrelease-no"><span></span>No</label></span>
            </section>
            <section>
                <label for="hearing">Hearing</label>
                <input type="text" id="hearing" name="hearing" value="<?= !empty($wizardData->hearing) ? $wizardData->hearing : ''; ?>"/>
                <label for="hearingexam">Exam Date</label>
                <input type="text" id="hearingexam" name="hearingexam"  value="<?= !empty($wizardData->hearingexam) ? $wizardData->hearingexam : ''; ?>"/>
                <label for="hearinghistory">History and Treatment</label>
                <textarea id="hearinghistory" name="hearinghistory"><?= !empty($wizardData->hearinghistory) ? $wizardData->hearinghistory : ''; ?></textarea>
                <label for="hearingrelease">Consent for Record Release?</label>
                <span class="inline"><input type="radio" name="hearingrelease[]" value="hearingreleaseyes" id="hearingrelease-yes" <?= 'checked'; ?> /> <label for="hearingrelease-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="hearingrelease[]" value="hearingreleaseno" id="hearingrelease-no" <?= (!empty($wizardData->hearingrelease[0]) && $wizardData->hearingrelease[0] == "hearingreleaseno") || (empty($wizardData->hearingrelease)) ? ' checked ' : ''; ?> /> <label for="hearingrelease-no"><span></span>No</label></span>
            </section>
            <section>
                <label for="vision">Vision</label>
                <input type="text" id="vision" name="vision" value="<?= !empty($wizardData->vision) ? $wizardData->vision : ''; ?>"/>
                <label for="visionexam">Exam Date</label>
                <input type="text" id="visionexam" name="visionexam" value="<?= !empty($wizardData->visionexam) ? $wizardData->visionexam : ''; ?>"/>
                <label for="visionhistory">History and Treatment</label>
                <textarea id="visionhistory" name="visionhistory"><?= !empty($wizardData->visionhistory) ? $wizardData->visionhistory : ''; ?></textarea>
                <label for="visionrelease">Consent for Record Release?</label>
                <span class="inline"><input type="radio" name="visionrelease[]" value="visionreleaseyes" id="visionrelease-yes" <?= 'checked'; ?> /> <label for="visionrelease-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="visionrelease[]" value="visionreleaseno" id="visionrelease-no" <?= (!empty($wizardData->visionrelease) && $wizardData->visionrelease[0] == "visionreleaseno") || (empty($wizardData->visionrelease)) ? ' checked ' : ''; ?> /> <label for="visionrelease-no"><span></span>No</label></span>
            </section>
        </div>
    </fieldset>

    <?php
//Declaration array fields
    // echo $wizardData->sheepItForm1_specialist . '==spec';
    // echo $wizardData->sheepItForm1_specialist1 . '==spec1';
    $specialist_array = $lastexam_array = $nextexam_array = $phone_array = $fax_array = $release_array = $releaseexpiration_array = array();
//copy/edit value assign here
    $specialist_array = (!empty($wizardData->sheepItForm1_specialist)) ? $wizardData->sheepItForm1_specialist : $wizardData->specialist1;
    $type_array = (!empty($wizardData->sheepItForm1_type)) ? $wizardData->sheepItForm1_type : $wizardData->type1;
    $lastexam_array = (!empty($wizardData->sheepItForm1_lastexam)) ? $wizardData->sheepItForm1_lastexam : $wizardData->lastexam2;
    $nextexam_array = (!empty($wizardData->sheepItForm1_nextexam)) ? $wizardData->sheepItForm1_nextexam : $wizardData->nextexam2;
    $phone_array = (!empty($wizardData->sheepItForm1_phone)) ? $wizardData->sheepItForm1_phone : $wizardData->phone2;
    $fax_array = (!empty($wizardData->sheepItForm1_fax)) ? $wizardData->sheepItForm1_fax : $wizardData->fax2;
    $release_array = (!empty($wizardData->specialistRelease)) ? $wizardData->specialistRelease : $wizardData->release2;
    $release_desc = (!empty($wizardData->sheepItForm1_describe_sheepItForm)) ? $wizardData->sheepItForm1_describe_sheepItForm : $wizardData->describe_sheepItForm;
    $releaseexpiration_array = (!empty($wizardData->sheepItForm1_releaseexp)) ? $wizardData->sheepItForm1_releaseexp : $wizardData->release_exp2;
    ?>


    <?php
    $previous = $this->uri->segment(4);
    $sessionval = $this->session->userdata('copy_assigned_unique_number_appraisal');
    if (!empty($sessionval) && !empty($previous) && $previous == "copy"):
        $wizardData = array();
    endif;
    ?>
    <fieldset class="new-section">
        <span class="inline hide <?= !empty($wizardData->hideSection2) ? 'hide' : '' ?>"><input type="checkbox" onclick="hideSection(2)" id="hideSection2" name="hideSection2" <?= !empty($wizardData->hideSection2) ? ' checked ' : ''; ?> /> <label for="hideSection2"><span></span>Not Applicable</label></span>
        <legend>Agencies and Case Managers</legend>
        <div class="hideSection2">
            <section>
                <div id="sheepItForm">
                    <!-- Form template-->
                    <div id="sheepItForm_template" style="border-bottom: dashed #444 0px;margin-top:10px">
                        <legend>Agencies and Case Managers <text id="sheepItForm_label"></text><a id="sheepItForm_remove_current">
                                <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                            </a></legend>
                        <label for="sheepItForm_#index#_name">Name</label>
                        <input id="sheepItForm_#index#_name" name="sheepItForm_name[#index#]" type="text" size="15" maxlength="50" required="required"  class="agency" />
                        <div class="clear"></div>
                        <label for="sheepItForm_#index#_adname">Agency Name</label>
                        <input id="sheepItForm_#index#_agname" name="sheepItForm_agname[#index#]" type="text" size="15" maxlength="50" />
                        <div class="clear"></div>
                        <label for="sheepItForm_#index#_cashman">Case Manager</label>
                        <input id="sheepItForm_#index#_cashman" name="sheepItForm_cashman[#index#]" type="text" size="15" maxlength="50" />
                        <div class="clear"></div>
                        <label for="sheepItForm_#index#_phone">contact Info</label>
                        <input id="sheepItForm_#index#_phone" name="sheepItForm_phone[#index#]" type="text" size="15" required="required" class="agency" />
                        <div class="clear"></div>
                        <label for="sheepItForm_#index#_release">Consent for Record Release?</label>
                        <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                            <input type="radio" name="sheepItForm_release#index#" value="yes" id="sheepItForm_#index#_release1"   /> <label>Yes</label>
                        </span>&nbsp;&nbsp;
                        <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                            <input type="radio" name="sheepItForm_release#index#" value="no" id="sheepItForm_#index#_release2"  checked="checked"   /> <label>No</label>
                        </span>
                        <span>&nbsp;<br></span>
                    </div>
                    <!-- /Form template-->

                    <!-- No forms template -->
                    <div id="sheepItForm_noforms_template">No Agencies and Case Managers</div>
                    <!-- /No forms template-->
                </div>
            </section>
            <section class="buttons">
                <!-- Controls -->
                <div id="sheepItForm_controls">
                    <div id="sheepItForm_add"><a herf="javascript:addNewDr()" style="text-decoration:underline"><span>Add Agencies and Case Managers</span></a></div>
                </div>
                <!-- /Controls -->
            </section>
        </div>
    </fieldset>

    <fieldset class="new-section">
        <span class="inline hide <?= !empty($wizardData->hideSection3) ? 'hide' : '' ?>"><input type="checkbox" onclick="hideSection(3)" id="hideSection3" name="hideSection3"  <?= !empty($wizardData->hideSection3) ? ' checked ' : ''; ?> /> <label for="hideSection3"><span></span>Not Applicable</label></span>
        <legend>Daily Medications</legend>
        <div class="hideSection3">
            <section>
                <div id="sheepItForm2">

                    <!-- Form template-->
                    <div id="sheepItForm2_template" style="border-bottom: dashed #444 0px;">

                        <legend><a id="sheepItForm2_remove_current">
                                <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                            </a></legend>
                        <label for="sheepItForm2_#index#_med">Medication Name</label>
                        <input type="text" id="sheepItForm2_#index#_med" name="sheepItForm2_med[#index#]" required="required" class="agency"/>
                        <label for="sheepItForm2_#index#_dos">Dosage</label>
                        <input type="text" id="sheepItForm2_#index#_dos" name="sheepItForm2_dos[#index#]" required="required" class="agency" />
                        <label for="sheepItForm2_#index#_time">Time/Frequency</label>
                        <input type="text" id="sheepItForm2_#index#_time" name="sheepItForm2_time[#index#]" required="required" class="agency" />
                        <label for="sheepItForm2_#index#_route">Route</label>
                        <input type="text" id="sheepItForm2_#index#_route" name="sheepItForm2_route[#index#]" required="required" class="agency" />
                        <label for="sheepItForm2_taken#index#">Taken:</label>
                        <span class="inline"><input type="checkbox" name="sheepItForm2_school#index#" value="school" id="sheepItForm2_#index#_school"  /> <label for="sheepItForm2_#index#_school"  ><span></span>At School</label></span>
                        <span class="inline"><input type="checkbox" name="sheepItForm2_home#index#" value="home" id="sheepItForm2_#index#_home" /> <label for="sheepItForm2_#index#_home"><span></span>At Home</label></span>
                        <div id="dailyerror#index#"></div>
                    </div>
                    <!-- /Form template-->

                    <!-- No forms template -->
                    <div id="sheepItForm2_noforms_template">No Daily Medications</div>
                    <!-- /No forms template-->

                </div>
            </section>
            <section class="buttons">
                <p><div id="sheepItForm2_add"><a class="addnew-button" href="javascript:addNewMed()">Add New Daily Medication</a></div></p>
            </section>
        </div>
    </fieldset>
    <fieldset class="new-section">
        <span class="inline hide <?= !empty($wizardData->hideSection4) ? 'hide' : '' ?>"><input type="checkbox" onclick="hideSection(4)" id="hideSection4" <?= !empty($wizardData->hideSection4) ? ' checked ' : ''; ?> name="hideSection4" /> <label for="hideSection4"><span></span>Not Applicable</label></span>
        <legend>PRN Medications</legend>
        <div class="hideSection4">
            <section>
                <div id="sheepItForm3">

                    <!-- Form template-->
                    <div id="sheepItForm3_template" style="border-bottom: dashed #444 0px;">

                        <legend><a id="sheepItForm3_remove_current">
                                <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                            </a></legend>
                        <label for="sheepItForm3_#index#_prnmed">Medication Name</label>
                        <input type="text" id="sheepItForm3_#index#_prnmed" name="sheepItForm3_prnmed[#index#]" required="required" class="agency" />
                        <label for="sheepItForm3_#index#_prndos">Dosage</label>
                        <input type="text" id="sheepItForm3_#index#_prndos" name="sheepItForm3_prndos[#index#]" required="required" class="agency"/>
                        <label for="sheepItForm3_#index#_time">Time/Frequency</label>
                        <input type="text" id="sheepItForm3_#index#_prntime" name="sheepItForm3_prntime[#index#]" required="required" class="agency"/>
                        <label for="sheepItForm3_#index#_prnroute">Route</label>
                        <input type="text" id="sheepItForm3_#index#_prnroute" name="sheepItForm3_prnroute[#index#]" required="required" class="agency"/>
                        <label for="sheepItForm3_taken#index#">Taken:</label>
                        <span class="inline"><input type="checkbox" name="sheepItForm3_prnschool#index#" value="school" id="sheepItForm3_#index#_prnschool"  /> <label for="sheepItForm3_#index#_prnschool"  ><span></span>At School</label></span>
                        <span class="inline"><input type="checkbox" name="sheepItForm3_prnhome#index#" value="home" id="sheepItForm3_#index#_prnhome" /> <label for="sheepItForm3_#index#_prnhome"><span></span>At Home</label></span>
                        <span class="inline"><input type="checkbox" name="sheepItForm3_prnemerg#index#" value="yes" id="sheepItForm3_#index#_prnemerg"/> <label for="sheepItForm3_#index#_prnemerg"><span></span>In Emergency</label></span>
                        <div id="prnerror#index#"></div>
                    </div>
                    <!-- /Form template-->

                    <!-- No forms template -->
                    <div id="sheepItForm3_noforms_template">No Prn Medication</div>
                    <!-- /No forms template-->


                </div>
            </section>
            <section class="buttons">
                <p><div id="sheepItForm3_add"><a class="addnew-button" href="javascript:addNewMed()">Add New Prn Medication</a></div></p>
            </section>
        </div>
    </fieldset>
    <!--<section class="buttons">
            <div class="nextbutton">
                    <button class="previous">Previous Page</button>
                    <button class="next">Next Page</button>
            </div>
            <div class="savebuttons">
                    <button class="save">Save Form</button>

            </div>
            <div class="clear"></div>
    </section>-->
    <fieldset class="new-section">
        <span class="inline hide"><input type="checkbox" onclick="hideSection(5)" id="hide5022" name="hide5022" value = "on" <?php echo!empty($wizardData->hide5022) ? ' checked ' : '' ?> /> <label for="hide5022"><span></span>Not Applicable</label></span>
        <legend>Treatments</legend>
        <div class="hide5022">
            <section class="buttons">
                <div id="sheepItForm5">
                    <div id="sheepItForm5_template" style="border-bottom: dashed #444 0px;">
                        <section>
                            <label for="sheepItForm5_#index#_treatment">Treatment Order
                                <a id="sheepItForm5_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a>
                            </label>
                            <input type="text" id="sheepItForm5_#index#_treatment" name="sheepItForm5_treatment[#index#]" required="required" class="agency" />
                            <label for="frequency1">Frequency</label>
                            <input type="text" id="sheepItForm5_#index#_frequency" name="sheepItForm5_frequency[#index#]" required="required" class="agency" />
                            <label for="taken1">Performed:</label>

                            <span class="inline"><input type="radio" id="sheepItForm5_#index#_performed_school1" name="sheepItForm5_#index#_performed_school" value="yes"  /> <label><span></span>At School</label></span>
                            <span class="inline"><input type="radio" id="sheepItForm5_#index#_performed_school2" name="sheepItForm5_#index#_performed_school" value="no" /> <label><span></span>At Home</label></span>
                            <label for="person1">Person Performing</label>
                            <input type="text" id="sheepItForm5_#index#_person" name="sheepItForm5_person[#index#]" required="required" class="agency"/>
                        </section>
                    </div>
                    <!-- No forms template -->
                    <div id="sheepItForm5_noforms_template">No Specialists</div>
                    <!-- /No forms template-->
                </div>
                <!-- Controls -->
            </section>
            <section class="buttons">
                <div id="sheepItForm5_controls">
                    <div id="sheepItForm5_add"><a class="addnew-button" href="javascript:addNewTreatments()">Add New Treatments</a></div>
                </div>
            </section>
            <!-- /Controls -->

        </div>

    </fieldset>
    <fieldset class="new-section">
        <span class="inline hide <?= !empty($wizardData->hideSection6) ? 'hide' : '' ?>"><input type="checkbox" onclick="hideSection(6)" name="hideSection6" id="hideSection6" <?= !empty($wizardData->hideSection6) ? ' checked ' : ''; ?> /> <label for="hideSection6"><span></span>Not Applicable</label></span>
        <legend>Allergies</legend>
        <div class="hideSection6">
            <section class="buttons">
                <div id="sheepItForm4">

                    <!-- Form template-->
                    <div id="sheepItForm4_template">
                        <section>
                            <legend for="sheepItForm4_#index#">Allergies <a id="sheepItForm4_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a></legend>
                            <label for="sheepItForm4_#index#_allergy">Allergic to</label>
                            <input type="text" id="sheepItForm4_#index#_allergy" name="sheepItForm4_allergy[#index#]" >
                            <label for="sheepItForm4_#index#_reaction">Reaction</label>
                            <textarea id="sheepItForm4_#index#_reaction" name="sheepItForm4_reaction[#index#]" ></textarea>

                            <label for="sheepItForm4_#index#_sensitivity">Sensitivity Level</label>
                            <div class="check-group">
                                <span class="inline"><input type="checkbox" name="sheepItForm4_#index#_touch"  class="req_question" value="yes" id="sheepItForm4_#index#_touch"  /> <label for="sheepItForm4_#index#_touch"><span></span>Touch/Contact</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm4_#index#_ingest"  class="req_question"  value="yes" id="sheepItForm4_#index#_ingest" /> <label for="sheepItForm4_#index#_ingest"><span></span>Ingestion</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm4_#index#_air"  class="req_question"  value="yes"  id="sheepItForm4_#index#_air"  /> <label for="sheepItForm4_#index#_air" ><span></span>Air</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm4_#index#_sting" class="req_question"  value="yes"  id="sheepItForm4_#index#_sting"  /> <label for="sheepItForm4_#index#_sting" ><span></span>Sting/Bite</label></span>
                                <div id="senserror#index#"></div>
                            </div>
                        </section>

                        <section>

                            <label for="sheepItForm4_#index#_treatment">Treatment</label>
                            <span class="inline"><input type="checkbox" name="sheepItForm4_#index#_epi" value="yes" id="sheepItForm4_#index#_epi" value= "yes"  /><label for="sheepItForm4_#index#_epi"><span></span>Epinephrine Auto-Injection</label></span>
                            <span class="inline"><input type="checkbox" name="sheepItForm4_#index#_antihistamine" value="yes" id="sheepItForm4_#index#_antihistamine"   /> <label for="sheepItForm4_#index#_antihistamine"><span></span>Antihistamine</label></span>
                            <div id="allerror#index#"></div>
                            <label for="sheepItForm4_#index#_diagnosed">How was the allergy diagnosed?</label>
                            <div>
                                <span class="inline"><input type="radio" name="sheepItForm4_#index#_diagnosed" value="Exposure" id="sheepItForm4_#index#_diagnosed1" checked="checked" /> <label for="diagnosed1">Exposure</label></span>
                                <span class="inline"><input type="radio" name="sheepItForm4_#index#_diagnosed" value="Allergy Testing and Exposure" id="sheepItForm4_#index#_diagnosed2" <?php echo ($wizardData->diagnosed1 == 'Allergy Testing and Exposure') ? ' checked ' : '' ?> /> <label for="diagnosed1"><span></span>Allergy Testing and Exposure</label></span>
                                <span class="inline"><input type="radio" name="sheepItForm4_#index#_diagnosed" value="Allergy Testing/Never Exposed" id="sheepItForm4_#index#_diagnosed3" <?php echo ($wizardData->diagnosed1 == 'Allergy Testing/Never Exposed') ? ' checked ' : '' ?> /> <label for="diagnosed1"><span></span>Allergy Testing/Never Exposed</label></span>
                            </div><br>
                            <label for="sheepItForm4_#index#_lastevent">Last Event</label>
                            <input type="text" id="sheepItForm4_#index#_lastevent" name="sheepItForm4_lastevent[#index#]" required="required" class="agency">
                        </section>
                        <div class="clear"></div>
                        <section class="largetext">
                            <label for="sheepItForm4_#index#_addtnlcomments">Additional Comments</label>
                            <textarea id="sheepItForm4_#index#_addtnlcomments" name="sheepItForm4_addtnlcomments[#index#]" required="required" class="agency"> </textarea>
                        </section>

                    </div>
                    <!-- /Form template-->

                    <!-- No forms template -->
                    <div id="sheepItForm4_noforms_template">No Allergy</div>
                    <!-- /No forms template-->

                    <!-- Controls -->
                    <!-- /Controls -->

                </div>
                <!-- /sheepIt Form -->
            </section>
            <section class="buttons">
                <div id="sheepItForm4_controls">
                    <div id="sheepItForm4_add"><p><a class="addnew-button" href="javascript:addNewAllergy()">Add New Allergy</a></p></div>
                </div>
            </section>
        </div>
    </fieldset>
    <fieldset class="new-section threecol">
        <span class="inline hide <?= !empty($wizardData->hideSection77) ? 'hide' : '' ?>">
            <input type="checkbox" onclick="hideSection(77)" id="hideSection77" name="hideSection77"
                   <?= !empty($wizardData->hideSection77) ? ' checked ' : ''; ?> /> <label for="hideSection77"><span></span>Not Applicable</label></span>
        <legend>Communication/Vision/Hearing Requirements</legend>
        <div class="hideSection77">
            <section>
                <label for="needtype">Select Requirement Type</label>
                <div class="check-group">
                    <span><input type="checkbox" name="needtype[]" value="needtypeverbal" id="needtypeverbal" <?= in_array('needtypeverbal', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypeverbal"><span></span>Verbal</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypenonverbal" id="needtypenonverbal" <?= in_array('needtypenonverbal', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypenonverbal"><span></span>Non-Verbal</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypespeech" id="needtypespeech" <?= in_array('needtypespeech', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypespeech"><span></span>Speech/Language Needs</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypeaudiology" id="needtypeaudiology" <?= in_array('needtypeaudiology', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypeaudiology"><span></span>Audiology Needs</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypevision" id="needtypevision" <?= in_array('needtypevision', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypevision"><span></span>Vision Needs</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypesigns" id="needtypesigns" <?= in_array('needtypesigns', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypesigns"><span></span>Signs/Gestures</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypeexpressions" id="needtypeexpressions" <?= in_array('needtypeexpressions', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypeexpressions"><span></span>Expressions</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypecries" id="needtypecries" <?= in_array('needtypecries', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypecries"><span></span>Cries/Smiles</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypepictures" id="needtypepictures" <?= in_array('needtypepictures', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypepictures"><span></span>Pictures</label></span>
                    <span><input type="checkbox" name="needtype[]" value="needtypenocommunication" id="needtypenocommunication" <?= in_array('needtypenocommunication', $wizardData->needtype) ? ' checked ' : ''; ?>/> <label for="needtypenocommunication"><span></span>No Communication</label></span>
                </div>
            </section>
            <section>
                <label for="devices">Assistive Communication Devices?</label>
                <span class="inline"><input type="radio" name="devices" value="yes" onclick="showvalue3(this.value)" id="devices" <?php echo!empty($wizardData->devices) ? ' checked ' : '' ?> /> <label for="devices-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="devices" value="" onclick="showvalue3(this.value)"  id="devices" <?php echo empty($wizardData->devices) ? ' checked ' : '' ?> /> <label for="devices-no"><span></span>No</label></span>
                <div id="divval3" style="display: none">
                    <label for="device_describe">If Yes, Describe</label>
                    <textarea id="device_describe" name="device_describe"><?php echo $wizardData->device_describe ?></textarea>
                </div>
            </section>
            <section>
                <label for="devicelist">Device(s) Used</label>
                <span><input type="checkbox" name="devicelist[]" value="devicelistglasses" id="devicelist-glasses" <?= in_array('devicelistglasses', $wizardData->devicelist) ? ' checked ' : ''; ?>/> <label for="devicelist-glasses"><span></span>Wears Glasses</label></span>
                <span><input type="checkbox" name="devicelist[]" value="devicelisthearingaid" id="devicelist-hearingaid" <?= in_array('devicelisthearingaid', $wizardData->devicelist) ? ' checked ' : ''; ?>/> <label for="devicelist-hearingaid"><span></span>Wears Hearing Aid</label></span>
                <span><input type="checkbox" name="devicelist[]" value="devicelistcochlear" id="devicelist-cochlear" <?= in_array('devicelistcochlear', $wizardData->devicelist) ? ' checked ' : ''; ?>/> <label for="devicelist-cochlear"><span></span>Cochlear Implant</label></span>
                <span><input type="checkbox" name="devicelist[]" value="devicelistfmsystem" id="devicelist-fm" <?= in_array('devicelistfmsystem', $wizardData->devicelist) ? ' checked ' : ''; ?>/> <label for="devicelist-fm"><span></span>FM System</label></span>
                <label for="hearing-screening">Last Hearing Screening</label>
                <input type="text" id="hearingscreening" name="hearingscreening" value="<?= !empty($wizardData->hearingscreening) ? $wizardData->hearingscreening : ''; ?>" />
                <label for="vision-screening">Last Vision Screening</label>
                <input type="text" id="visionscreening" name="visionscreening" value="<?= !empty($wizardData->visionscreening) ? $wizardData->visionscreening : ''; ?>" />
            </section>
            <section class="largetext">
                <label for="communication-comments">Additional Comments</label>
                <textarea id="communication-comments" name="communicationcomments"><?= !empty($wizardData->communicationcomments) ? $wizardData->communicationcomments : ''; ?></textarea>
            </section>
        </div>
    </fieldset>
    <fieldset class="new-section">
        <span class="inline hide <?= !empty($wizardData->hideSection8) ? 'hide' : '' ?>"><input type="checkbox" onclick="hideSection8" name="hideSection8" id="hideSection8" <?= !empty($wizardData->hideSection8) ? ' checked ' : ''; ?> /> <label for="hideSection8"><span></span>Not Applicable</label></span>
        <legend>Neurological Requirements</legend>
        <div class="hideSection8">

            <section>
                <label for="seizures">Seizures Disorder</label>
                <span class="inline"><input type="radio" name="seizures[]" value="seizuresyes" id="seizures-yes" <?= 'checked'; ?>/> <label for="seizures-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="seizures[]" value="seizuresno" id="seizures-no" <?= !empty($wizardData->seizures{0}) && $wizardData->seizures{0} == 'seizuresno' ? ' checked ' : ''; ?>/> <label for="seizures-no"><span></span>No</label></span>
                <div id="hidename2">
                    <label for="seizuretype">If yes, type:</label>
                    <input type="text" id="seizuretype" name="seizuretype" value="<?= !empty($wizardData->seizuretype) ? $wizardData->seizuretype : ''; ?>"/>
                </div>
                <label for="last-seizure-exam">Last Exam</label>
                <input type="text" id="lastseizureexam" name="lastseizureexam" placeholder="Select a date" value="<?= !empty($wizardData->lastseizureexam) ? $wizardData->lastseizureexam : ''; ?>"/>
                <label for="onsetage">Age of Onset</label>
                <input type="text" id="onsetage" name="onsetage" value="<?= !empty($wizardData->onsetage) ? $wizardData->onsetage : ''; ?>"/>
            </section>

            <section>
                <label for="lastseizure">Date of Last Seizure</label>
                <input type="text" id="lastseizure" name="lastseizure" value="<?= !empty($wizardData->lastseizure) ? $wizardData->lastseizure : ''; ?>"/>
                <label for="usualduration">Usual Duration</label>
                <input type="text" id="usualduration" name="usualduration" value="<?= !empty($wizardData->usualduration) ? $wizardData->usualduration : ''; ?>"/>
                <label for="seizurefrequncy">Frequency of Seizures</label>
                <input type="text" id="seizurefrequncy" name="seizurefrequncy" value="<?= !empty($wizardData->seizurefrequncy) ? $wizardData->seizurefrequncy : ''; ?>"/>
                <label for="statusepilectus">Hx of Status Epilecticus</label>
                <input type="text" id="statusepilectus" name="statusepilectus" value="<?= !empty($wizardData->statusepilectus) ? $wizardData->statusepilectus : ''; ?>"/>
            </section>
            <section class="two-col">
                <label for="triggers">Triggers</label>
                <textarea id="triggers" name="triggers" style="width:250px" ><?= !empty($wizardData->triggers) ? $wizardData->triggers : ''; ?></textarea>
                <label for="ketogenic">Ketogenic Diet?</label>
                <?php print_r($wizardData->ketogenicno); ?>
                <span class="inline"><input type="radio" name="ketogenic[]" value="ketogenicyes" id="ketogenicyes" <?= !empty($wizardData->ketogenic) && ($wizardData->ketogenic{0} == 'ketogenicyes') ? ' checked ' : ' '; ?>/> <label for="ketogenicyes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="ketogenic[]" value="ketogenicno" id="ketogenicno" <?= empty($wizardData->ketogenic) || ($wizardData->ketogenic{0} == 'ketogenicno') ? ' checked ' : ' '; ?>/> <label for="ketogenicno"><span></span> No</label></span>
                <label for="seizuretreatment">Treatment</label>
                <?php
                if (!empty($wizardData->seizuretreatment)):
                    $treatment = json_decode(json_encode($wizardData->seizuretreatment), true);

                    if (in_array("seizuretreatmentdiastat", $treatment)) {
                        $seizuretreatmentdiastat = 1;
                    }
                    if (in_array("seizuretreatmentoxygen", $treatment)) {
                        $seizuretreatmentoxygen = 1;
                    }
                    if (in_array("seizuretreatmentvagalnervestimulator", $treatment)) {
                        $seizuretreatmentvagalnervestimulator = 1;
                    }
                    if (in_array("seizuretreatmentmedication", $treatment)) {
                        $seizuretreatmentmedication = 1;
                    }

                endif;
                ?>
                <span><input type="checkbox" name="seizuretreatment[]" value="seizuretreatmentdiastat" id="treatment-diastat" <?= !empty($seizuretreatmentdiastat) ? ' checked ' : ''; ?>/> <label for="treatment-diastat"><span></span>Diastat</label></span>
                <span><input type="checkbox" name="seizuretreatment[]" value="seizuretreatmentoxygen" id="treatment-oxygen" <?= !empty($seizuretreatmentoxygen) ? ' checked ' : ''; ?>/> <label for="treatment-oxygen"><span></span>Oxygen</label></span>
                <span><input type="checkbox" name="seizuretreatment[]" value="seizuretreatmentvagalnervestimulator" id="treatment-vagal" <?= !empty($seizuretreatmentvagalnervestimulator) ? ' checked ' : ''; ?>/> <label for="treatment-vagal"><span></span>Vagal Nerve Stimulator</label></span>
                <span><input type="checkbox" name="seizuretreatment[]" value="seizuretreatmentmedication" id="treatment-medication" <?= !empty($seizuretreatmentmedication) ? ' checked ' : ''; ?>/> <label for="treatment-medication"><span></span>Medication (see medication list)</label></span>
                <div id="chkerror"></div>
            </section>
            <div class="clear"></div>

            <section>
                <label for="postseizure">Post Seizure Activity</label>
                <textarea id="postseizure" name="postseizure"><?= !empty($wizardData->postseizure) ? $wizardData->postseizure : ''; ?></textarea>
                <label for="aura">Aura?</label>
                <span class="inline"><input type="radio" name="aura"  onclick="showvalue360(this.value)"  value="postseizureaurayes" id="postseizureaurayes"  <?php echo!empty($wizardData->aura) && $wizardData->aura == 'postseizureaurayes' ? ' checked ' : '' ?>/> <label for="postseizureaurayes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="aura" onclick="showvalue360(this.value)"  value="postseizureaurano" id="postseizureaurano" <?php echo empty($wizardData->aura) || $wizardData->aura == 'postseizureaurano' ? ' checked ' : '' ?>/> <label for="postseizureaurano"><span></span>No</label></span>
                <div id="hidename360">
                    <label for="auradescription">If Yes, Describe</label>
                    <textarea id="auradescription" name="auradescription"><?= !empty($wizardData->auradescription) ? $wizardData->auradescription : ''; ?></textarea>
                </div>
            </section>
            <section class="two-col">
                <?php //echo $wizardData->shunt . 'here';      ?>
                <label for="shunt">Shunt?</label>
                <span class="inline"><input type="radio" name="shunt" value="shuntyes" id="shuntyes" onclick="showvalue321(this.value)" <?= $wizardData->shunt == 'shuntyes' ? ' checked ' : ''; ?> /> <label for="shunt-yes" ><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="shunt" value="shuntno" id="shuntno" onclick="showvalue321(this.value)" <?= $wizardData->shunt == 'shuntno' || $wizardData->shunt == '' ? ' checked ' : '' ?> /> <label for="shunt-no"><span></span>No</label></span>
                <div id="hidename321">
                    <label for="shunttype">If yes, type:</label>
                    <input type="text" id="shunttype" name="shunttype" value="<?= !empty($wizardData->shunttype) ? $wizardData->shunttype : ''; ?>"/>
                    <label for="shuntplacement">Date of Shunt Placement</label>
                    <input type="text" id="shuntplacement" name="shuntplacement" value="<?= !empty($wizardData->shuntplacement) ? $wizardData->shuntplacement : ''; ?>" />
                    <label for="lastrevision">Date of Last Revision</label>
                    <input type="text" id="lastrevision" name="lastrevision"  value="<?= !empty($wizardData->lastrevision) ? $wizardData->lastrevision : ''; ?>"/>
                </div>
            </section>
            <section class="largetext">
                <label for="seizure-comments">Additional Comments</label>
                <textarea id="seizurecomments" name="seizurecomments" placeholder="(episode description, safety needs)"><?= !empty($wizardData->seizurecomments) ? $wizardData->seizurecomments : ''; ?></textarea>
            </section>
        </div>
    </fieldset>
    <!---- Add 5th form here ---->
    <fieldset class="new-section">
        <span class="inline hide"><input type="checkbox" onclick="hideSection(37)" id="hide37" name="hide37"  /> <label for="hide37"><span></span>Not Applicable</label></span>
        <legend  for="elimination_requirements">Elimination Requirements</legend>
        <div class="hide37">
            <section class="clear">
                <span class="inline"><input type="checkbox" name="elimination_independent" value="Independent" id="elimination_independent" <?= !empty($wizardData->{'elimination_independent'}) ? ' checked ' : ''; ?> /> <label for="elimination_independent"><span></span>Independent</label></span>
                <span class="inline"><input type="checkbox" name="elimination_scheduled" value="Scheduled" id="elimination_scheduled" <?= !empty($wizardData->{'elimination_scheduled'}) ? ' checked ' : ''; ?> /> <label for="elimination_scheduled"><span></span>Scheduled</label></span>
                <span class="inline"><input type="checkbox" name="elimination_prompted" value="Prompted" id="elimination_prompted" <?= !empty($wizardData->{'elimination_prompted'}) ? ' checked ' : ''; ?> /> <label for="elimination_prompted"><span></span>Prompted</label></span>
                <span class="inline"><input type="checkbox" name="elimination_diapered" value="Diapered" id="elimination_diapered" <?= !empty($wizardData->{'elimination_diapered'}) ? ' checked ' : ''; ?> /> <label for="elimination_diapered"><span></span>Diapered</label></span>
            </section>
            <div style="clear:both"></div>
            <section class="threecol">
                <label for="continence">Continence</label>
                <span><input type="checkbox" name="continence_continent" value="Continent" id="continence_continent" <?= !empty($wizardData->{'continence_continent'}) ? ' checked ' : ''; ?> /><label for="continence_continent"><span></span> Continent</label></span>
                <span><input type="checkbox" name="continence_incontinent_bowel" value="Incontinent-Bowel" id="continence_incontinent_bowel" <?= !empty($wizardData->{'continence_incontinent_bowel'}) ? ' checked ' : ''; ?> /><label for="continence_incontinent_bowel"><span></span> Incontinent - Bowel</label></span>
                <span><input type="checkbox" name="continence_incontinent_bladder" value="Incontinent-Bladder" id="continence_incontinent_bladder" <?= !empty($wizardData->{'continence_incontinent_bladder'}) ? ' checked ' : ''; ?> /><label for="continence_incontinent_bladder"><span></span> Incontinent - Bladder</label></span>
            </section>

            <section>
                <label for="toilet-type">How Student is Toileted</label>
                <!--<span class="inline"><input type="radio" name="toilet" value="no" id="toilet" <?php //echo ($wizardData->toilet == "no")? ' checked ':''                                                                                                                                                                                                                                                                                                                 ?> /><label> No</label></span><br>-->
                <span class="inline"><input type="radio" name="toilet" value="Toilet" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wizardData->toilet == "Toilet") ? ' checked ' : '' ?> /> <label> Toilet</label></span><br>
                <span class="inline"><input type="radio" name="toilet" value="Changing Table" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wizardData->toilet == "Changing Table") ? ' checked ' : '' ?> /> <label> Changing Table</label></span><br>
                <span class="inline"><input type="radio" name="toilet" value="Commode" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wizardData->toilet == "Commode") ? ' checked ' : '' ?> /> <label> Commode</label></span><br>
                <span class="inline"><input type="radio" name="toilet" value="Other" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wizardData->toilet == "Other") ? ' checked ' : '' ?> /> <label> Other</label></span><br>
                <div id="hidename342">
                    <input type="text" id="other_toilet"  name="other_toilet" value="<?php echo $wizardData->other_toilet ?>" />
                </div>
            </section>
            <section>
                <label for="toileted">Where is Student Toileted</label>
                <!--<span class="inline"><input type="radio" name="toileted" value="none" id="toileted" <?php //echo ($wizardData->toileted == "none")? ' checked ':''                                                                                                                                                                                                                                                                                                                 ?> /><label> No &nbsp;&nbsp;</label></span><br>-->
                <span class="inline"><input type="radio" name="toileted" onclick="showvalue343(this.value)" value="In HR" id="toileted" <?php echo ($wizardData->toileted == "In HR") ? ' checked ' : '' ?> /> <label> In HR </label></span><br>
                <span class="inline"><input type="radio" name="toileted" onclick="showvalue343(this.value)" value="In Bathroom" id="toileted" <?php echo ($wizardData->toileted == "In Bathroom") ? ' checked ' : '' ?> /> <label> In Bathroom </label></span><br>
                <span class="inline"><input type="radio" name="toileted" onclick="showvalue343(this.value)" value="Other" id="toileted" <?php echo ($wizardData->toileted == "Other") ? ' checked ' : '' ?> /> <label>  Other</label><br>
                    <div id="hidename343">
                        <span class="inline"><input type="text" id="toileted_student" name="toileted_student" value="<?php echo $wizardData->toileted_student ?>" />
                        </span>
                    </div>
            </section>
            <div style="clear:both"></div>
            <fieldset>
                <section class="">
                    <label for="regime">Bowel Regime</label>
                    <span class="inline"><input type="radio" name="regime" id="regime_yes" value="Yes" <?= !empty($wizardData->{'regime'}) ? ' checked ' : ''; ?> /><label for="regime_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="regime" id="regime_no" value="" <?= empty($wizardData->{'regime'}) ? ' checked ' : ''; ?> /><label for="regime_no"><span></span> No</label></span>
                </section>
                <section>
                    <label for="constipation">History of Constipation?</label>
                    <span class="inline"><input type="radio" name="constipation" id="constipation_yes" onclick="showvalue322(this.value)" value="Yes" <?= !empty($wizardData->{'constipation'}) ? ' checked ' : ''; ?> /><label for="constipation_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="constipation" id="constipation_no" onclick="showvalue322(this.value)" value="" <?= empty($wizardData->{'constipation'}) ? ' checked ' : ''; ?> /><label for="constipation_no"><span></span> No</label></span>
                    <div id="hidename322">
                        <label for="constipation_mgmnt">Management</label>
                        <textarea id="constipation_mgmnt" name="constipation_mgmnt"><?= !empty($wizardData->constipation_mgmnt) ? $wizardData->constipation_mgmnt : ''; ?></textarea>
                    </div>
                </section>
                <section  class="clear threecol">
                    <label for="colostomy">Colostomy?</label>
                    <span class="inline"><input type="radio" name="colostomy" id="colostomy_yes" onclick="showvalue323(this.value)" value="Yes" <?= !empty($wizardData->{'colostomy'}) ? ' checked ' : ''; ?> /><label for="colostomy_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="colostomy" id="colostomy_no" onclick="showvalue323(this.value)" value="" <?= empty($wizardData->{'colostomy'}) ? ' checked ' : ''; ?>/><label for="colostomy_no"><span></span> No</label></span>
                    <div id="hidename323">
                        <label for="colostomy_mgmnt">Management</label>
                        <textarea id="colostomy_mgmnt" name="colostomy_mgmnt" ><?= !empty($wizardData->colostomy_mgmnt) ? $wizardData->colostomy_mgmnt : ''; ?></textarea>
                    </div>
                </section>
                <section>
                    <label for="bladder">Bladder Regime?</label>
                    <span class="inline"><input type="radio" name="bladder" id="bladder_yes" onclick="showvalue324(this.value)" value="Yes" <?= !empty($wizardData->{'bladder'}) ? ' checked ' : ''; ?> /><label for="bladder_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="bladder" id="bladder_no" onclick="showvalue324(this.value)" value="" <?= empty($wizardData->{'bladder'}) ? ' checked ' : ''; ?> /><label for="bladder_no"><span></span> No</label></span>
                    <div id="hidename324">
                        <label for="bladder_mgmnt">Management</label>
                        <textarea id="bladder_mgmnt" name="bladder_mgmnt"><?= !empty($wizardData->bladder_mgmnt) ? $wizardData->bladder_mgmnt : ''; ?></textarea>
                    </div>
                </section>
            </fieldset>
            <fieldset  class=""missschool>
                <section>
                    <label for="catheter">Urinary Catheterization?</label>
                    <span class="inline"><input type="radio" name="catheter" id="catheter_yes" onclick="showvalue326(this.value)" value="Yes" <?php echo (!empty($wizardData->catheter) && $wizardData->catheter == "Yes") ? ' checked ' : '' ?>/><label for="catheter_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="catheter" id="catheter_no" onclick="showvalue326(this.value)" value=""   <?php echo (empty($wizardData->catheter)) ? 'checked' : ''; ?> /><label for="catheter_no"><span></span> No</label></span>
                    <div id="hidename326">
                        <label for="cath_size">Catheter Size</label>
                        <input type="text" id="cath_size" name="cath_size" value="<?= !empty($wizardData->cath_size) ? $wizardData->cath_size : ''; ?>" />

                        <label for="cath_freq">Frequency</label>
                        <input type="text" id="cath_freq" name="cath_freq" value="<?= !empty($wizardData->cath_freq) ? $wizardData->cath_freq : ''; ?>" />
                    </div>
                    <label for="self_catheter">Self-Catheterization?</label>
                    <span class="inline"><input type="radio" name="self_catheter" id="self_catheter_yes" value="Yes" <?= !empty($wizardData->{'self_catheter'}) ? ' checked ' : ''; ?> /><label for="self_catheter_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="self_catheter" id="self_catheter_no" value="" <?= empty($wizardData->{'self_catheter'}) ? ' checked ' : ''; ?> /><label for="self_catheter_no"><span></span> No</label></span>

                    <label for="stoma">Stoma?</label>
                    <span class="inline"><input type="radio" name="stoma" id="stoma_yes" value="Yes" <?= !empty($wizardData->{'stoma'}) ? ' checked ' : ''; ?> /><label for="stoma_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="stoma" id="stoma_no" value="" <?= empty($wizardData->{'stoma'}) ? ' checked ' : ''; ?> /><label for="stoma_no"><span></span> No</label></span>
                </section>

                <section>
                    <label for="menstruation">Menstruation?</label>
                    <span class="inline"><input type="radio" name="menstruation" onclick="showvalue325(this.value)"  id="menstruation_yes" value="Yes" <?= !empty($wizardData->{'menstruation'}) ? ' checked ' : ''; ?> /><label for="menstruation_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="menstruation" onclick="showvalue325(this.value)"  id="menstruation_no" value="" <?= empty($wizardData->{'menstruation'}) ? ' checked ' : ''; ?> /><label for="menstruation_no"><span></span> No</label></span>
                    <div id="hidename325">
                        <label for="menstruation_mgmt">Management</label>
                        <textarea id="menstruation_mgmt" name="menstruation_mgmt"><?= !empty($wizardData->menstruation_mgmt) ? $wizardData->menstruation_mgmt : ''; ?></textarea>
                    </div>
                </section>

                <section>
                    <label for="diabetic">Diabetic Student?</label>
                    <span class="inline"><input type="radio" name="diabetic" id="diabetic_yes" value="Yes" <?= !empty($wizardData->{'diabetic'}) ? ' checked ' : ''; ?> /><label for="diabetic_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="diabetic" id="diabetic_no" value="" <?= empty($wizardData->{'diabetic'}) ? ' checked ' : ''; ?> /><label for="diabetic_no"><span></span> No</label></span>

                    <label for="br_privileges">Liberal Bathroom Privileges?</label>
                    <span class="inline"><input type="radio" name="br_privileges" id="br_privileges_yes" value="Yes" <?= !empty($wizardData->{'br_privileges'}) ? ' checked ' : ''; ?> /><label for="br_privileges_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="br_privileges" id="br_privileges_no" value=""  <?= empty($wizardData->{'br_privileges'}) ? ' checked ' : ''; ?>/><label for="br_privileges_no"><span></span> No</label></span>
                </section>
                <section class="largetext">
                    <label for="elimination_addtnl">Additional Comments</label>
                    <textarea id="elimination_addtnl" name ="elimination_addtnl"><?= !empty($wizardData->elimination_addtnl) ? $wizardData->elimination_addtnl : ''; ?></textarea>
                </section>

            </fieldset>
        </div>
    </fieldset>
    <fieldset class="new-section">
        <span class="inline hide"><input type="checkbox" onclick="hideSection(38)" id="hide38"  /> <label for="hide38"><span></span>Not Applicable</label></span>
        <legend>Cardiac Requirements</legend>
        <div class="hide38">
            <section class="largetext">
                <label for="cardiac_history">Cardiac History</label>
                <textarea id="cardiac_history" name="cardiac_history"><?= !empty($wizardData->cardiac_history) ? $wizardData->cardiac_history : ''; ?></textarea>
            </section>
            <fieldset class=" clear threecol">
                <section>
                    <label for="restrictions">Restrictions?</label>
                    <span class="inline"><input type="radio" name="restrictions" id="restrictions_yes" onclick="showval6(this.value)" value="Yes" <?= !empty($wizardData->{'restrictions'}) ? ' checked ' : ''; ?> /><label for="restrictions_yes" ><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="restrictions" id="restrictions_no" onclick="showval6(this.value)"  value="" <?= empty($wizardData->{'restrictions'}) ? ' checked ' : ''; ?> /><label for="restrictions_no" ><span></span> No</label></span>
                    <div id="hidename16" style="display: none">
                        <label for="restrict_list">If yes, please list:</label>
                        <textarea id="restrict_list" name ="restrict_list"><?= !empty($wizardData->restrict_list) ? $wizardData->restrict_list : ''; ?></textarea>
                    </div>
                    <label for="baseline">Baseline Vital Signs</label>
                    <textarea id="baseline" name="baseline"><?= !empty($wizardData->baseline) ? $wizardData->baseline : ''; ?></textarea>

                </section>
                <section>
                    <label for="distress">Symptoms of Distress</label>
                    <span><input type="checkbox" name="distress_pain" id="distress_pain" value="Chest Pain/Tightness" <?= !empty($wizardData->{'distress_pain'}) ? ' checked ' : ''; ?> /><label for="distress_pain"><span></span> Chest Pain/Tightness</label></span>
                    <span><input type="checkbox" name="distress_breath" id="distress_breath" value="Shortness of Breath" <?= !empty($wizardData->{'distress_breath'}) ? ' checked ' : ''; ?> /><label for="distress_breath"><span></span> Shortness of Breath</label></span>
                    <span><input type="checkbox" name="distress_palpitations" id="distress_palpitations" value="Palpitations" <?= !empty($wizardData->{'distress_palpitations'}) ? ' checked ' : ''; ?> /><label for="distress_palpitations"><span></span> Palpitations</label></span>
                    <span><input type="checkbox" name="distress_diaphoresis" id="distress_diaphoresis" value="Diaphoresis" <?= !empty($wizardData->{'distress_diaphoresis'}) ? ' checked ' : ''; ?> /><label for="distress_diaphoresis"><span></span> Diaphoresis</label></span>
                    <span><input type="checkbox" name="distress_fatigue" id="distress_fatigue" value="Fatigue" <?= !empty($wizardData->{'distress_fatigue'}) ? ' checked ' : ''; ?> /><label for="distress_fatigue"><span></span> Fatigue</label></span>
                    <span><input type="checkbox" name="distress_dyspnea" id="distress_dyspnea" value="Dyspnea on Exertion" <?= !empty($wizardData->{'distress_dyspnea'}) ? ' checked ' : ''; ?> /><label for="distress_dyspnea"><span></span> Dyspnea on Exertion</label></span>
                    <span><input type="checkbox" name="distress_fainting" id="distress_fainting" value="Fainting" <?= !empty($wizardData->{'distress_fainting'}) ? ' checked ' : ''; ?> /><label for="distress_fainting"><span></span> Fainting</label></span>
                    <span><input type="checkbox" name="distress_other" id="distress_other" value="Other" <?= !empty($wizardData->{'distress_other'}) ? ' checked ' : ''; ?> /><label for="distress_other"><span></span> Other</label></span>
                    <input type="text" id="symptom_other" name="symptom_other" placeholder="enter other symptom" value="<?= !empty($wizardData->symptom_other) ? $wizardData->symptom_other : ''; ?>" />
                </section>
                <section>
                    <label for="pacemaker">Pacemaker?</label>
                    <span class="inline"><input type="radio" name="pacemaker" id="pacemaker_yes" value="Yes" <?= !empty($wizardData->{'pacemaker'}) ? ' checked ' : ''; ?> /><label for="pacemaker_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="pacemaker" id="pacemaker_no" value="" <?= empty($wizardData->{'pacemaker'}) ? ' checked ' : ''; ?> /><label for="pacemaker_no"><span></span> No</label></span>

                    <label for="defib">Internal Defibrillator?</label>
                    <span class="inline"><input type="radio" name="defib" id="defib_yes" value="Yes" <?= !empty($wizardData->{'defib'}) ? ' checked ' : ''; ?> /><label for="defib_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="defib" id="defib_no" value="" <?= empty($wizardData->{'defib'}) ? ' checked ' : ''; ?> /><label for="defib_no"><span></span> No</label></span>

                    <label for="aed">Personal AED?</label>
                    <span class="inline"><input type="radio" name="aed" id="aed_yes" value="Yes" <?= !empty($wizardData->{'aed'}) ? ' checked ' : ''; ?> /><label for="aed_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="aed" id="aed_no" value="" <?= empty($wizardData->{'aed'}) ? ' checked ' : ''; ?> /><label for="aed_no"><span></span> No</label></span>
                </section>
            </fieldset>
            <fieldset>
                <section>
                    <label for="skin_color">Baseline Skin Color</label>
                    <span><input type="checkbox" name="skin_color_normal" id="skin_color_normal" value="Normal" <?= !empty($wizardData->{'skin_color_normal'}) ? ' checked ' : ''; ?> /><label for="skin_color_normal"><span></span> Normal</label></span>
                    <span><input type="checkbox" name="skin_color_cyanosis" id="skin_color_cyanosis" value="Cyanosis" <?= !empty($wizardData->{'skin_color_cyanosis'}) ? ' checked ' : ''; ?> /><label for="skin_color_cyanosis"><span></span> Cyanosis</label></span>
                    <span><input type="checkbox" name="skin_color_jaundice" id="skin_color_jaundice" value="Jaundice" <?= !empty($wizardData->{'skin_color_jaundice'}) ? ' checked ' : ''; ?> /><label for="skin_color_jaundice"><span></span> Jaundice</label></span>
                    <span><input type="checkbox" name="skin_color_pallor" id="skin_color_pallor" value="Pallor" <?= !empty($wizardData->{'skin_color_pallor'}) ? ' checked ' : ''; ?> /><label for="skin_color_pallor"><span></span> Pallor</label></span>
                    <span><input type="checkbox" name="skin_color_erythema" id="skin_color_erythema" value="Erythema" <?= !empty($wizardData->{'skin_color_erythema'}) ? ' checked ' : ''; ?> /><label for="skin_color_erythema"><span></span> Erythema</label></span>
                    <span><input type="checkbox" name="skin_color_other" id="skin_color_other" value="Other" <?= !empty($wizardData->{'skin_color_other'}) ? ' checked ' : ''; ?> /><label for="skin_color_other"><span></span> Other</label></span>
                    <input type="text" id="skin_color_comment" name="skin_color_comment" placeholder="enter other skin color" value="<?= !empty($wizardData->skin_color_comment) ? $wizardData->skin_color_comment : ''; ?>" />
                </section>
                <section>
                    <label for="cardiac_addtnl">Additional Comments</label>
                    <textarea id="cardiac_addtnl" name="cardiac_addtnl"><?= !empty($wizardData->cardiac_addtnl) ? $wizardData->cardiac_addtnl : ''; ?></textarea>
                </section>
            </fieldset>
        </div>
    </fieldset>
    <fieldset class="new-section">
        <span class="inline hide"><input type="checkbox" onclick="hideSection(39)" id="hide39" name="hide39"  /> <label for="hide39"><span></span>Not Applicable</label></span>
        <legend>Respiratory Requirements</legend>
        <div class="hide39">
            <fieldset>
                <section>
                    <label for="asthma">Asthma?</label>
                    <span class="inline"><input type="radio" id="asthma_yes" value="Yes" onclick="showval7(this.value)" name="asthma" <?= !empty($wizardData->{'asthma'}) ? ' checked ' : ''; ?> /><label for="asthma_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" id="asthma_no" value=""  onclick="showval7(this.value)" name="asthma" <?= empty($wizardData->{'asthma'}) ? ' checked ' : ''; ?> /><label for="asthma_no"><span></span> No</label></span>
                    <div id="hidename17">
                        <label for="other_diagnosis">If not asthma, what is the diagnosis?</label>
                        <input type="text" id="other_diagnosis" name="other_diagnosis" value="<?= !empty($wizardData->other_diagnosis) ? $wizardData->other_diagnosis : ''; ?>" />
                    </div>
                    <label id="diagnosis_age">Age Diagnosed</label>
                    <input type="text" id="diagnosis_age" name="diagnosis_age" value="<?= !empty($wizardData->diagnosis_age) ? $wizardData->diagnosis_age : ''; ?>" />
                </section>
                <section>
                    <label for="last_year">Symptoms in the last 12 months?</label>
                    <span class="inline"><input type="radio" id="last_year_yes" value="Yes" name="last_year" <?= !empty($wizardData->{'last_year'}) ? ' checked ' : ''; ?> /><label for="last_year_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" id="last_year_no" value="" name="last_year" <?= empty($wizardData->{'last_year'}) ? ' checked ' : ''; ?> /><label for="last_year_no"><span></span> No</label></span>

                    <label for="meds_last_year">Needed to use medication in the last 12 months?</label>
                    <span class="inline"><input type="radio" id="meds_last_year_yes" value="Yes" name="meds_last_year" <?= !empty($wizardData->{'meds_last_year'}) ? ' checked ' : ''; ?> /><label for="meds_last_year_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" id="meds_last_year_no" value="" name="meds_last_year" <?= empty($wizardData->{'meds_last_year'}) ? ' checked ' : ''; ?> /><label for="meds_last_year_no"><span></span> No</label></span>

                    <label for="doctor_last_year">Seen by health care provider in the last 12 months?</label>
                    <span class="inline"><input type="radio" id="doctor_last_year_yes" value="Yes" name="doctor_last_year" <?= !empty($wizardData->{'doctor_last_year'}) ? ' checked ' : ''; ?> /><label for="doctor_last_year_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" id="doctor_last_year_no" value="" name="doctor_last_year" <?= empty($wizardData->{'doctor_last_year'}) ? ' checked ' : ''; ?> /><label for="doctor_last_year_no"><span></span> No</label></span>

                    <label for="ed_last_year">ED visit(s) and/or hospitalizations in the last 12 months?</label>
                    <span class="inline"><input type="radio" id="ed_last_year_yes" onclick="showval8(this.value)" value="Yes" name="ed_last_year" <?= !empty($wizardData->{'ed_last_year'}) ? ' checked ' : ''; ?>  /><label for="ed_last_year_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" id="ed_last_year_no" onclick="showval8(this.value)" value="" name="ed_last_year" <?= empty($wizardData->{'ed_last_year'}) ? ' checked ' : ''; ?> /><label for="ed_last_year_no"><span></span> No</label></span>
                    <div id="hidename18">
                        <label for="num_ed_visits">If yes, how many?</label>
                        <span class="inline"><input type="radio" id="num_ed_visits_1" value="1" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'} == '1') ? ' checked ' : ''; ?>/><label for="num_ed_visits_1"><span></span> 1</label></span>
                        <span class="inline"><input type="radio" id="num_ed_visits_2" value="2" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'} == '2') ? ' checked ' : ''; ?>/><label for="num_ed_visits_2"><span></span> 2</label></span>
                        <span class="inline"><input type="radio" id="num_ed_visits_3" value="3" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'} == '3') ? ' checked ' : ''; ?>/><label for="num_ed_visits_3"><span></span> 3</label></span>
                        <span class="inline"><input type="radio" id="num_ed_visits_4" value="4" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'} == '4') ? ' checked ' : ''; ?>/><label for="num_ed_visits_4"><span></span> 4</label></span>
                        <span class="inline"><input type="radio" id="num_ed_visits_5" value="5 or more" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'} == '5') ? ' checked ' : ''; ?>/><label for="num_ed_visits_5"><span></span> 5 or more</label></span>
                    </div>
                </section>
            </fieldset>
            <fieldset>
                <section>
                    <label for="triggers">Triggers</label>
                    <span><input type="checkbox" id="triggers_smoke" value="Smoke" name="triggers_smoke" <?= !empty($wizardData->{'triggers_smoke'}) ? ' checked ' : ''; ?>/><label for="triggers_smoke"><span></span> Smoke</label></span>
                    <span><input type="checkbox" id="triggers_animals" value="Animals" name="triggers_animals" <?= !empty($wizardData->{'triggers_animals'}) ? ' checked ' : ''; ?>/><label for="triggers_animals"><span></span> Animals</label></span>
                    <span><input type="checkbox" id="triggers_dust" value="Dust" name="triggers_dust" <?= !empty($wizardData->{'triggers_dust'}) ? ' checked ' : ''; ?>/><label for="triggers_dust"><span></span> Dust</label></span>
                    <span><input type="checkbox" id="triggers_colds" value="Colds/Illness" name="triggers_colds" <?= !empty($wizardData->{'triggers_colds'}) ? ' checked ' : ''; ?>/><label for="triggers_colds"><span></span> Colds/Illness</label></span>
                    <span><input type="checkbox" id="triggers_weather" value="Changes in Weather" name="triggers_weather" <?= !empty($wizardData->{'triggers_weather'}) ? ' checked ' : ''; ?>/><label for="triggers_weather"><span></span> Changes in Weather</label></span>
                    <span><input type="checkbox" id="triggers_exercise" value="Exercise" name="triggers_exercise" <?= !empty($wizardData->{'triggers_exercise'}) ? ' checked ' : ''; ?>/><label for="triggers_exercise"><span></span> Exercise</label></span>
                    <span><input type="checkbox" id="triggers_mold" value="Mold" name="triggers_mold" <?= !empty($wizardData->{'triggers_mold'}) ? ' checked ' : ''; ?>/><label for="triggers_mold"><span></span> Mold</label></span>
                    <span><input type="checkbox" id="triggers_grass" value="Grass/Pollen" name="triggers_grass" <?= !empty($wizardData->{'triggers_grass'}) ? ' checked ' : ''; ?>/><label for="triggers_grass"><span></span> Grass/Pollen</label></span>
                    <span><input type="checkbox" id="triggers_perfumes" value="Perfumes/Smells" name="triggers_perfumes"<?= !empty($wizardData->{'triggers_perfumes'}) ? ' checked ' : ''; ?> /><label for="triggers_perfumes"><span></span> Perfumes/Smells</label></span>
                    <span><input type="checkbox" id="triggers_stress" value="Stress" name="triggers_stress" <?= !empty($wizardData->{'triggers_stress'}) ? ' checked ' : ''; ?>/><label for="triggers_stress"><span></span> Stress</label></span>
                    <span><input type="checkbox" id="triggers_food" value="Food" name="triggers_food" <?= !empty($wizardData->{'triggers_food'}) ? ' checked ' : ''; ?>/><label for="triggers_food"><span></span> Food</label></span>
                    <span><input type="checkbox" id="triggers_other" value="Other" name="triggers_other" <?= !empty($wizardData->{'triggers_other'}) ? ' checked ' : ''; ?>/><label for="triggers_other"><span></span> Other</label></span>
                    <input type="text" id="other_trigger" placeholder="enter other trigger" name="other_trigger" value="<?= !empty($wizardData->other_trigger) ? $wizardData->other_trigger : ''; ?>" />
                    <div id="chkerror15"></div>
                </section>
                <section>
                    <label for="usual_symptoms">Usual Symptoms</label>
                    <span><input type="checkbox" id="usual_symptoms_wheezing" value="Wheezing" name="usual_symptoms_wheezing" <?= !empty($wizardData->{'usual_symptoms_wheezing'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_wheezing"><span></span> Wheezing</label></span>
                    <span><input type="checkbox" id="usual_symptoms_breath" value="Shortness of Breath" name="usual_symptoms_breath" <?= !empty($wizardData->{'usual_symptoms_breath'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_breath"><span></span> Shortness of Breath</label></span>
                    <span><input type="checkbox" id="usual_symptoms_breathing" value="Difficulty Breathing" name="usual_symptoms_breathing" <?= !empty($wizardData->{'usual_symptoms_breathing'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_breathing"><span></span> Difficulty Breathing</label></span>
                    <span><input type="checkbox" id="usual_symptoms_throat" value="Itchy Throat" name="usual_symptoms_throat" <?= !empty($wizardData->{'usual_symptoms_throat'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_throat"><span></span> Itchy Throat</label></span>
                    <span><input type="checkbox" id="usual_symptoms_cough" value="Coughing" name="usual_symptoms_cough" <?= !empty($wizardData->{'usual_symptoms_cough'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_cough"><span></span> Coughing</label></span>
                    <span><input type="checkbox" id="usual_symptoms_chest" value="Chest Tightness" name="usual_symptoms_chest" <?= !empty($wizardData->{'usual_symptoms_chest'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_chest"><span></span> Chest Tightness</label></span>
                    <span><input type="checkbox" id="usual_symptoms_irritability" value="Irritability" name="usual_symptoms_irritability" <?= !empty($wizardData->{'usual_symptoms_irritability'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_irritability"><span></span> Irritability</label></span>
                    <span><input type="checkbox" id="usual_symptoms_waking" value="Waking at Night" name="usual_symptoms_waking" <?= !empty($wizardData->{'usual_symptoms_waking'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_waking"><span></span> Waking at Night</label></span>
                    <span><input type="checkbox" id="usual_symptoms_stomachache" value="Stomachache" name="usual_symptoms_stomachache" <?= !empty($wizardData->{'usual_symptoms_stomachache'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_stomachache"><span></span> Stomach Ache</label></span>
                    <span><input type="checkbox" id="usual_symptoms_other" value="Other" name="usual_symptoms_other" <?= !empty($wizardData->{'usual_symptoms_other'}) ? ' checked ' : ''; ?>/><label for="usual_symptoms_other"><span></span> Other</label></span>
                    <input type="text" id="other_usual_symptoms" name="other_usual_symptoms" placeholder="enter other symptom" value="<?= !empty($wizardData->other_usual_symptoms) ? $wizardData->other_usual_symptoms : ''; ?>" />
                    <div id="chkerror16"></div>
                </section>
                <section>
                    <label for="day_symptoms">Symptoms During the Day <span class="tiny">(in the past month)</span></label>
                    <span><input type="checkbox" id="day_symptoms_none" value="None" name="day_symptoms_none" <?= !empty($wizardData->{'day_symptoms_none'}) ? ' checked ' : ''; ?> /><label for="day_symptoms_none"><span></span> None</label></span>
                    <span><input type="checkbox" id="day_symptoms_twice" value="2x/week or less" name="day_symptoms_twice" <?= !empty($wizardData->{'day_symptoms_twice'}) ? ' checked ' : ''; ?> /><label for="day_symptoms_twice"><span></span> 2x/week or less</label></span>
                    <span><input type="checkbox" id="day_symptoms_twiceplus" value="More than 2x/week" name="day_symptoms_twiceplus" <?= !empty($wizardData->{'day_symptoms_twiceplus'}) ? ' checked ' : ''; ?> /><label for="day_symptoms_twiceplus"><span></span> More than 2x/week</label></span>
                    <span><input type="checkbox" id="day_symptoms_always" value="Every Day" name="day_symptoms_always" <?= !empty($wizardData->{'day_symptoms_always'}) ? ' checked ' : ''; ?> /><label for="day_symptoms_always"><span></span> Every Day</label></span>

                    <label for="night_symptoms">Symptoms at Night <span class="tiny">(in the past month)</span></label>
                    <span><input type="checkbox" id="night_symptoms_none" value="None" name="night_symptoms_none" <?= !empty($wizardData->{'night_symptoms_none'}) ? ' checked ' : ''; ?> /><label for="night_symptoms_none"><span></span> None</label></span>
                    <span><input type="checkbox" id="night_symptoms_twice" value="2x/week or less" name="night_symptoms_twice" <?= !empty($wizardData->{'night_symptoms_twice'}) ? ' checked ' : ''; ?> /><label for="night_symptoms_twice"><span></span> 2x/week or less</label></span>
                    <span><input type="checkbox" id="night_symptoms_twiceplus" value="More than 2x/week" name="night_symptoms_twiceplus" <?= !empty($wizardData->{'night_symptoms_twiceplus'}) ? ' checked ' : ''; ?> /><label for="night_symptoms_twiceplus"><span></span> More than 2x/week</label></span>
                    <span><input type="checkbox" id="night_symptoms_always" value="Every Night" name="night_symptoms_always" <?= !empty($wizardData->{'night_symptoms_always'}) ? ' checked ' : ''; ?> /><label for="night_symptoms_always"><span></span> Every Night</label></span>

                    <label for="season">Symptoms most likely occur in</label>
                    <div class="col_one">
                        <span><input type="checkbox" name="season_fall" id="season_fall" value="Fall"  <?= !empty($wizardData->{'season_fall'}) ? ' checked ' : ''; ?> /><label for="season_fall"><span></span> Fall</label></span>
                        <span><input type="checkbox" name="season_winter" id="season_winter" value="Winter" <?= !empty($wizardData->{'season_winter'}) ? ' checked ' : ''; ?> /><label for="season_winter"><span></span> Winter</label></span>
                    </div>
                    <div class="col_two">
                        <span><input type="checkbox" name="season_spring" id="season_spring" value="Spring" <?= !empty($wizardData->{'season_spring'}) ? ' checked ' : ''; ?> /><label for="season_spring"><span></span> Spring</label></span>
                        <span><input type="checkbox" name="season_summer" id="season_summer" value="Summer" <?= !empty($wizardData->{'season_summer'}) ? ' checked ' : ''; ?> /><label for="season_summer"><span></span> Summer</label></span>
                    </div>
                    <div id="chkerror17"></div>
                </section>
            </fieldset>
            <fieldset>
                <section class="largetext">
                    <label for="pe">Have symptoms ever prevented student from participating in PE, Recess, Sports, or Other Activites?</label>
                    <span class="inline"><input type="radio" name="pe" onclick="showval9(this.value)" id="pe_yes" value="Yes" <?= !empty($wizardData->{'pe'}) ? ' checked ' : ''; ?> /><label for="pe_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="pe" onclick="showval9(this.value)" id="pe_no" value="" <?= empty($wizardData->{'pe'}) ? ' checked ' : ''; ?> /><label for="pe_no"><span></span> No</label></span>
                    <div id="hidename19" style="display: none">
                        <label for="pe_explain">If yes, please explain</label>
                        <textarea id="pe_explain" name="pe_explain"><?= !empty($wizardData->pe_explain) ? $wizardData->pe_explain : ''; ?></textarea>
                    </div>
                </section>
            </fieldset>
            <fieldset>
                <section>
                    <label for="miss_school">Did student miss school last year?<span class="tiny">(relating to Diagnosis)</span></label>
                    <span class="inline"><input type="radio" name="missschool" id="missschoolyes" onclick="showval(this.value)"   value="missschoolyes" <?= !empty($wizardData->{'missschool'}) ? ' checked ' : ''; ?> /><label for="missschoolyes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="missschool" id="missschoolno" onclick="showval(this.value)"  value="" <?= empty($wizardData->{'missschool'}) ? ' checked ' : ''; ?>/><label for="missschoolno"><span></span> No</label></span>
                    <div id="hidename11">
                        <label for="missed_times">If yes, how many times?</label>
                        <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="1-2" checked="checked"/><label for="missed_times_1"><span></span> 1-2</label></span>
                        <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="3-5" <?php echo ($wizardData->missed_times == '3-5') ? ' checked ' : '' ?>/><label for="missed_times_3"><span></span> 3-5</label></span>
                        <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="6-9" <?php echo ($wizardData->missed_times == '6-9') ? ' checked ' : '' ?>/><label for="missed_times_6"><span></span> 6-9</label></span>
                        <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="10 or more" <?php echo ($wizardData->missed_times == '10 or more') ? ' checked ' : '' ?> /><label for="missed_times_10"><span></span> 10 or more</label></span>

                    </div>
                    <label for="med_delivery">Medication Delivery</label>
                    <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)" value="None" checked="checked" <?php echo ($wizardData->med_delivery == 'None') ? ' checked ' : '' ?> /><label for="med_delivery-neb"><span></span> None</label></span>
                    <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)" value="Nebulizer"  <?php echo ($wizardData->med_delivery == 'Nebulizer') ? ' checked ' : '' ?>/><label for="med_delivery-neb"><span></span> Nebulizer</label></span>
                    <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)"b  value="Inhaler" <?php echo ($wizardData->med_delivery == 'Inhaler') ? ' checked ' : '' ?> /><label for="med_delivery-inhaler"><span></span> Inhaler</label></span>
                    <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)" value="Both" <?php echo ($wizardData->med_delivery == 'Both') ? ' checked ' : '' ?> /><label for="med_delivery-both"><span></span> Both</label></span>
                    <div id="hidename327">
                        <label for="med-freq">Frequency</label>
                        <input type="text" id="med_freq"  name="med_freq" value="<?php echo $wizardData->med_freq ?>" />
                    </div>

                    <label for="student_admin">Student able to administer medication?</label>
                    <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Independent" <?php echo ($wizardData->student_admin == 'Independent') ? ' checked ' : '' ?> /><label for="student_admin_independent"><span></span> Independent<label></span>
                                <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Dependent" <?php echo ($wizardData->student_admin == 'Dependent') ? ' checked ' : '' ?> /><label for="student_admin_dependent"><span></span> Dependent<label></span>
                                            <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Assistance Required" <?php echo ($wizardData->student_admin == 'Assistance Required') ? ' checked ' : '' ?> /><label for="student_admin_assist"><span></span> Assistance Required<label></span>
                                                        </section>
                                                        <section>
                                                            <label for="self_mdi">Student self-carries MDI?</label>
                                                            <span class="inline"><input type="radio" name="selfmdi" id="selfmdiyes" value="selfmdiyes" <?= !empty($wizardData->{'selfmdi'}) ? ' checked ' : ''; ?>/><label for="selfmdiyes"><span></span> Yes<label></span>
                                                                        <span class="inline"><input type="radio" name="selfmdi" id="selfmdino" value="" <?= empty($wizardData->{'selfmdi'}) ? ' checked ' : ''; ?>/><label for="selfmdino"><span></span> No<label></span>

                                                                                    <label for="mdi">MDI kept in health room?</label>
                                                                                    <span class="inline"><input type="radio" name="mdi" id="mdiyes" value="mdiyes" <?= !empty($wizardData->{'mdi'}) ? ' checked ' : ''; ?>/><label for="mdiyes"><span></span> Yes<label></span>
                                                                                                <span class="inline"><input type="radio" name="mdi" id="mdino" value="" <?= empty($wizardData->{'mdi'}) ? ' checked ' : ''; ?>/><label for="mdino"><span></span> No<label></span>

                                                                                                            <label for="spacer">Spacer?</label>
                                                                                                            <span class="inline"><input type="radio" name="spacer" id="spaceryes" value="spaceryes" <?= !empty($wizardData->{'spacer'}) ? ' checked ' : ''; ?>/><label for="spaceryes"><span></span> Yes<label></span>
                                                                                                                        <span class="inline"><input type="radio" name="spacer" id="spacerno" value="" <?= empty($wizardData->{'spacer'}) ? ' checked ' : ''; ?>/><label for="spacerno"><span></span> No<label></span>
                                                                                                                                    <br />
                                                                                                                                    <input type="hidden" id="spacertype" name="spacertype" placeholder="enter type" value="<?= !empty($wizardData->spacertype) ? $wizardData->spacertype : ''; ?>" />

                                                                                                                                    <label for="peak">Peak flow?</label>
                                                                                                                                    <span class="inline"><input type="radio" name="peak" onclick="showvalue300(this.value)" id="peakyes" value="peakyes" <?= !empty($wizardData->{'peak'}) ? ' checked ' : ''; ?>/><label for="peakyes"><span></span> Yes<label></span>
                                                                                                                                                <span class="inline"><input type="radio" onclick="showvalue300(this.value)" name="peak" id="peakno" value="" <?= empty($wizardData->{'peak'}) ? ' checked ' : ''; ?>/><label for="peakno"><span></span> No<label></span>
                                                                                                                                                            <div id="hidename300">
                                                                                                                                                                <label for="peak">Personal best?</label>
                                                                                                                                                                <input type="text" id="peak_best" name="peak_best" value="<?php echo $wizardData->peak_best ?>" />
                                                                                                                                                            </div>
                                                                                                                                                            </section>
                                                                                                                                                            </fieldset>

                                                                                                                                                            <fieldset>
                                                                                                                                                                <section>
                                                                                                                                                                    <label for="pulm_vest">Pulmonary Vest?</label>
                                                                                                                                                                    <span class="inline"><input type="radio" name="pulmvest" id="pulmvestyes" onclick="showvalue329(this.value)" value="pulmvestyes" <?= !empty($wizardData->{'pulmvest'}) ? ' checked ' : ''; ?>/><label for="pulmvestyes"><span></span> Yes</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" name="pulmvest" id="pulmvestno" onclick="showvalue329(this.value)" value="" <?= empty($wizardData->{'pulmvest'}) ? ' checked ' : ''; ?>/><label for="pulmvestno"><span></span> No</label></span>
                                                                                                                                                                    <div id="hidename329">
                                                                                                                                                                        <label for="vestfreq">Frequency</label>
                                                                                                                                                                        <input type="text" id="vestfreq" name="vestfreq" value="<?= !empty($wizardData->vestfreq) ? $wizardData->vestfreq : ''; ?>"/>
                                                                                                                                                                    </div>
                                                                                                                                                                    <label for="chest_pt">Chest PT?</label>
                                                                                                                                                                    <span class="inline"><input type="radio" name="chestpt" onclick="showvalue337(this.value)" id="chestptyes" value="chestptyes" <?= !empty($wizardData->{'chestpt'}) ? ' checked ' : ''; ?>/><label for="chestptyes"><span></span> Yes</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" name="chestpt" onclick="showvalue337(this.value)" id="chestptno" value="" <?= empty($wizardData->{'chestpt'}) ? ' checked ' : ''; ?>/><label for="chestptno"><span></span> No</label></span>
                                                                                                                                                                    <div id="hidename337">
                                                                                                                                                                        <label for="chestptfreq">Frequency</label>
                                                                                                                                                                        <input type="text" id="chestptfreq" name="chestptfreq" value="<?= !empty($wizardData->chestptfreq) ? $wizardData->chestptfreq : ''; ?>"/>
                                                                                                                                                                    </div>
                                                                                                                                                                </section>
                                                                                                                                                                <section>
                                                                                                                                                                    <label for="tplan">Treatment Plan in School</label>
                                                                                                                                                                    <span><input type="checkbox" name="tplan[]" id="tplan_standard" value="tplan_standard" <?= in_array('tplan_standard', $wizardData->tplan) ? ' checked ' : ''; ?>/><label for="tplan_standard"><span></span> Standard Asthma Plan</label></span>
                                                                                                                                                                    <span><input type="checkbox" name="tplan[]" id="tplan_action" value="tplan_action" <?= in_array('tplan_action', $wizardData->tplan) ? ' checked ' : ''; ?>/><label for="tplan_action"><span></span> Asthma Action Plan</label></span>
                                                                                                                                                                    <span><input type="checkbox" name="tplan[]" id="tplan_ihp" value="tplan_ihp" <?= in_array('tplan_ihp', $wizardData->tplan) ? ' checked ' : ''; ?>/><label for="tplan_ihp"><span></span> IHP</label></span>
                                                                                                                                                                    <div id="chkerror18"></div>
                                                                                                                                                                    <label for="edasthma">ED visit(s) and/or hospitalizations in the last 12 months?</label>
                                                                                                                                                                    <span class="inline"><input type="radio" id="edasthmayes" name="edasthma" value="edasthmayes" onclick="showval2(this.value)"  <?= !empty($wizardData->{'edasthma'}) ? ' checked ' : ''; ?>/><label for="edasthmayes"><span></span> Yes</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" id="edasthmano"  name="edasthma" value="" onclick="showval2(this.value)"  <?= empty($wizardData->{'edasthma'}) ? ' checked ' : ''; ?>/><label for="edasthmano"><span></span> No</label></span>
                                                                                                                                                                    <div id="hidename12">
                                                                                                                                                                        <label for="numvisits">If yes, how many?</label>
                                                                                                                                                                        <span class="inline"><input type="radio" id="numvisits1" value="numvisits1" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits1') ? ' checked ' : ''; ?>/><label for="numvisits1"><span></span> 1</label></span>
                                                                                                                                                                        <span class="inline"><input type="radio" id="numvisits2" value="numvisits2" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits2') ? ' checked ' : ''; ?>/><label for="numvisits2"><span></span> 2</label></span>
                                                                                                                                                                        <span class="inline"><input type="radio" id="numvisits3" value="numvisits3" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits3') ? ' checked ' : ''; ?>/><label for="numvisits3"><span></span> 3</label></span>
                                                                                                                                                                        <span class="inline"><input type="radio" id="numvisits4" value="numvisits4" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits4') ? ' checked ' : ''; ?>/><label for="numvisits4"><span></span> 4</label></span>
                                                                                                                                                                        <span class="inline"><input type="radio" id="numvisits5" value="numvisits5" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits5') ? ' checked ' : ''; ?>/><label for="numvisits5"><span></span> 5 or more</label></span>
                                                                                                                                                                    </div>
                                                                                                                                                                </section>
                                                                                                                                                                <section class="largetext">
                                                                                                                                                                    <label for="resp_addtnl">Additional Comments</label>
                                                                                                                                                                    <textarea id="resp_addtnl" name="resp_addtnl"><?= !empty($wizardData->{'resp_addtnl'}) ? $wizardData->{'resp_addtnl'} : ''; ?></textarea>
                                                                                                                                                                </section>
                                                                                                                                                            </fieldset>
                                                                                                                                                            </div>
                                                                                                                                                            </fieldset>

                                                                                                                                                            <section class="buttons">
                                                                                                                                                                <div class="nextbutton">
                                                                                                                                                                    <?= $link_back; ?>
                                                                                                                                                                    <?= form_submit($attr_FormSubmit_appraisal); ?>
                                                                                                                                                                </div>
                                                                                                                                                                <div class="savebuttons float-left">
                                                                                                                                                                    <?= form_input($sif, set_value("sif", $sif_num)); ?>
                                                                                                                                                                    <?php
//click to final page
                                                                                                                                                                    $reviewvalue = $this->session->userdata('reviewappraisal');
                                                                                                                                                                    $wiz03->sif = $this->session->userdata('sifnumberval');
                                                                                                                                                                    $wiz03->unique_number = $this->session->userdata('sifunique_number');
                                                                                                                                                                    if (!empty($reviewvalue)):
                                                                                                                                                                        echo anchor("health_appraisal/appraisal/complete_appraisal/" . $wiz03->sif . "/" . $wiz03->unique_number, "<button type='button' class='previous'>Go to final page</button>");
                                                                                                                                                                    endif;
                                                                                                                                                                    ?>
                                                                                                                                                                    <?= form_submit($attr_FormSave_appraisal); ?>
                                                                                                                                                                </div>



                                                                                                                                                                <div class="clear"></div>
                                                                                                                                                            </section>
                                                                                                                                                            <?= form_close(); ?>
                                                                                                                                                            </section>

                                                                                                                                                            <script type="text/javascript">
                                                                                                                                                                $(document).ready(function() {

                                                                                                                                                                    //for shunt no - 30 Dec - sridhar - starts

                                                                                                                                                                    $('#shuntno').click(function() {
                                                                                                                                                                        $('#shunttype').val('');
                                                                                                                                                                        $('#shuntplacement').val('');
                                                                                                                                                                        $('#lastrevision').val('');
                                                                                                                                                                    });

                                                                                                                                                                    if (document.getElementById('devices').checked == true) {
                                                                                                                                                                        document.getElementById('divval3').style.display = 'block';
                                                                                                                                                                    }
//Release-yes on click
                                                                                                                                                                    $('#release1-yes').click(function() {
                                                                                                                                                                        $('#hidename51').show();
                                                                                                                                                                    });

                                                                                                                                                                    var release = $("input:radio[name='release1']").is(":checked");
                                                                                                                                                                    //alert(false);
                                                                                                                                                                    if (release == false) {
                                                                                                                                                                        $("#release1-no").prop('checked', true);
                                                                                                                                                                    }
                                                                                                                                                                    var seizure = $("#seizures-no").is(":checked", true);
                                                                                                                                                                    if (seizure) {
                                                                                                                                                                        $("#seizuretype").val('');
                                                                                                                                                                        $("#hidename2").hide();

                                                                                                                                                                    }
//                                                                                                                                                                    if (release == '' || release == 'undefined' || release == undefined || release == release1no) {
//                                                                                                                                                                        $("#release1-no").prop('checked', true);
//                                                                                                                                                                    }                                                                                                                              //Checkbox validation 1
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hideSection3]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[name="sheepItForm2_school0"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[name="sheepItForm2_home0"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length) {
                                                                                                                                                                            $('.errorchk3').remove();
                                                                                                                                                                            $('#dailyerror0').append("<span class='errorchk3'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk3').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });
                                                                                                                                                                    //Checkbox validation 2
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm2_1_school").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection3]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm2_school1"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm2_home1"]:checked');
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length) {
                                                                                                                                                                                $('.errorchk4').remove();
                                                                                                                                                                                $('#dailyerror1').append("<span class='errorchk4'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk4').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });
//                     Checkbox validation 2
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm2_2_school").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection3]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm2_school2"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm2_home2"]:checked');
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length) {
                                                                                                                                                                                $('.errorchk5').remove();
                                                                                                                                                                                $('#dailyerror2').append("<span class='errorchk5'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk5').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });


// //PRN Medication
                                                                                                                                                                    //Checkbox validation 1
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hideSection4]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[name="sheepItForm3_prnschool0"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[name="sheepItForm3_prnhome0"]:checked');
                                                                                                                                                                        var $fields3 = $(this).find('input[name="sheepItForm3_prnemerg0"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length) {
                                                                                                                                                                            $('.errorchk6').remove();
                                                                                                                                                                            $('#prnerror0').append("<span class='errorchk6'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk6').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });
                                                                                                                                                                    //Checkbox validation 2
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm3_1_prnschool").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection4]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm3_prnschool1"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm3_prnhome1"]:checked');
                                                                                                                                                                            var $fields3 = $(this).find('input[name="sheepItForm3_prnemerg1"]:checked');
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length) {
                                                                                                                                                                                $('.errorchk7').remove();
                                                                                                                                                                                $('#prnerror1').append("<span class='errorchk7'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk7').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });
//                     Checkbox validation 2
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm3_2_prnschool").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection4]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm3_prnschool2"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm3_prnhome2"]:checked');
                                                                                                                                                                            var $fields3 = $(this).find('input[name="sheepItForm3_prnemerg2"]:checked');
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length) {
                                                                                                                                                                                $('.errorchk8').remove();
                                                                                                                                                                                $('#prnerror2').append("<span class='errorchk8'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk8').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });

                                                                                                                                                                    // //Allergies
                                                                                                                                                                    //Checkbox validation 1
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hideSection6]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[name="sheepItForm4_0_epi"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[name="sheepItForm4_0_antihistamine"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length) {
                                                                                                                                                                            $('.errorchk9').remove();
                                                                                                                                                                            $('#allerror0').append("<span class='errorchk9'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk9').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });
                                                                                                                                                                    //Checkbox validation 2
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm4_1_epi").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection6]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm4_1_epi"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm4_1_antihistamine"]:checked');
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length) {
                                                                                                                                                                                $('.errorchk10').remove();
                                                                                                                                                                                $('#allerror1').append("<span class='errorchk10'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk10').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });
//                     Checkbox validation 2
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm4_2_epi").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection4]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm4_2_epi"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm4_2_epi"]:checked');
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length) {
                                                                                                                                                                                $('.errorchk11').remove();
                                                                                                                                                                                $('#allerror2').append("<span class='errorchk11'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk11').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });

                                                                                                                                                                    //Triggers
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hide39]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[name="triggers_smoke"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[name="triggers_dust"]:checked');
                                                                                                                                                                        var $fields3 = $(this).find('input[name="triggers_colds"]:checked');
                                                                                                                                                                        var $fields4 = $(this).find('input[name="triggers_weather"]:checked');
                                                                                                                                                                        var $fields5 = $(this).find('input[name="triggers_exercise"]:checked');
                                                                                                                                                                        var $fields6 = $(this).find('input[name="triggers_animals"]:checked');
                                                                                                                                                                        var $fields7 = $(this).find('input[name="triggers_mold"]:checked');
                                                                                                                                                                        var $fields8 = $(this).find('input[name="triggers_grass"]:checked');
                                                                                                                                                                        var $fields9 = $(this).find('input[name="triggers_perfumes"]:checked');
                                                                                                                                                                        var $fields10 = $(this).find('input[name="triggers_stress"]:checked');
                                                                                                                                                                        var $fields11 = $(this).find('input[name="triggers_food"]:checked');
                                                                                                                                                                        var $fields12 = $(this).find('input[name="triggers_other"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && !$fields5.length
                                                                                                                                                                                && !$fields6.length && !$fields7.length && !$fields8.length && !$fields9.length && !$fields10.length && !$fields11.length
                                                                                                                                                                                && !$fields12.length) {

                                                                                                                                                                            $('.errorchk15').remove();
                                                                                                                                                                            $('#chkerror15').append("<span class='errorchk15'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk15').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });

                                                                                                                                                                    //Usual Symptoms
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hide39]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[name="usual_symptoms_wheezing"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[name="usual_symptoms_breath"]:checked');
                                                                                                                                                                        var $fields3 = $(this).find('input[name="usual_symptoms_breathing"]:checked');
                                                                                                                                                                        var $fields4 = $(this).find('input[name="usual_symptoms_throat"]:checked');
                                                                                                                                                                        var $fields5 = $(this).find('input[name="usual_symptoms_cough"]:checked');
                                                                                                                                                                        var $fields6 = $(this).find('input[name="usual_symptoms_chest"]:checked');
                                                                                                                                                                        var $fields7 = $(this).find('input[name="usual_symptoms_irritability"]:checked');
                                                                                                                                                                        var $fields8 = $(this).find('input[name="usual_symptoms_waking"]:checked');
                                                                                                                                                                        var $fields9 = $(this).find('input[name="usual_symptoms_stomachache"]:checked');
                                                                                                                                                                        var $fields10 = $(this).find('input[name="usual_symptoms_other"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && !$fields5.length
                                                                                                                                                                                && !$fields6.length && !$fields7.length && !$fields8.length && !$fields9.length && !$fields10.length) {

                                                                                                                                                                            $('.errorchk16').remove();
                                                                                                                                                                            $('#chkerror16').append("<span class='errorchk16'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk16').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });

                                                                                                                                                                    //Symptoms most likely occur in
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hide39]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[name="season_fall"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[name="season_winter"]:checked');
                                                                                                                                                                        var $fields3 = $(this).find('input[name="season_spring"]:checked');
                                                                                                                                                                        var $fields4 = $(this).find('input[name="season_summer"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length) {

                                                                                                                                                                            $('.errorchk17').remove();
                                                                                                                                                                            $('#chkerror17').append("<span class='errorchk17'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk17').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });
                                                                                                                                                                    //Treatment Plan in School
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hide39]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[id="tplan_standard"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[id="tplan_action"]:checked');
                                                                                                                                                                        var $fields3 = $(this).find('input[id="tplan_ihp"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length) {

                                                                                                                                                                            $('.errorchk18').remove();
                                                                                                                                                                            $('#chkerror18').append("<span class='errorchk18'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk18').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });







//
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        //form validation for clone
                                                                                                                                                                        $('.agency').each(function() {
                                                                                                                                                                            if (!$.trim($(this).val()).length) {
//                                    alert('Name Field should not leave empty');
                                                                                                                                                                                return false; // or e.preventDefault();
                                                                                                                                                                            }
                                                                                                                                                                        });


                                                                                                                                                                        var $ckbox = ($('input[name=hideSection8]:checked', '#appraisal3').val());
                                                                                                                                                                        var $fields1 = $(this).find('input[name="seizuretreatment[]"]:checked');
                                                                                                                                                                        if (!$fields1.length && $ckbox != 'on') {
                                                                                                                                                                            $('.errorchk').remove();
                                                                                                                                                                            $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one treatment" + "</span>");

                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }

                                                                                                                                                                    });

                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var ckbox = ($('input[name=hideSection6]:checked', '#appraisal3').val());
                                                                                                                                                                        if ($('.req_question:checked').length == 0 && ckbox != 'on') {
                                                                                                                                                                            $('.errorchk2').remove();
                                                                                                                                                                            $('#chkerror2').append("<span class='errorchk2'>Error: " + "You must check at least one Sensitivity Level" + "</span>");
                                                                                                                                                                            return false;
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk2').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });

                                                                                                                                                                    //Allergies Sensitive level
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        var $feed = $('input[name=hideSection6]:checked', '#appraisal3').val();
                                                                                                                                                                        var $fields1 = $(this).find('input[name="sheepItForm4_0_touch"]:checked');
                                                                                                                                                                        var $fields2 = $(this).find('input[name="sheepItForm4_0_ingest"]:checked');
                                                                                                                                                                        var $fields3 = $(this).find('input[name="sheepItForm4_0_air"]:checked');
                                                                                                                                                                        var $fields4 = $(this).find('input[name="sheepItForm4_0_sting"]:checked');
                                                                                                                                                                        if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length) {
                                                                                                                                                                            $('.errorchk21').remove();
                                                                                                                                                                            $('#senserror0').append("<span class='errorchk21'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                            return false; // The form will *not* submit
                                                                                                                                                                        }
                                                                                                                                                                        else {
                                                                                                                                                                            $('.errorchk21').remove();
                                                                                                                                                                            return true;
                                                                                                                                                                        }
                                                                                                                                                                    });

                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm4_1_touch").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection6]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm4_1_touch"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm4_1_ingest"]:checked');
                                                                                                                                                                            var $fields3 = $(this).find('input[name="sheepItForm4_1_air"]:checked');
                                                                                                                                                                            var $fields4 = $(this).find('input[name="sheepItForm4_1_sting"]:checked');
                                                                                                                                                                            var $fields5 = $("#sheepItForm4_1_allergy").val();
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && $fields5 != "") {
                                                                                                                                                                                $('.errorchk22').remove();
                                                                                                                                                                                $('#senserror1').append("<span class='errorchk22'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk22').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });
                                                                                                                                                                    $('#appraisal3').submit(function() {
                                                                                                                                                                        if ($("#sheepItForm4_2_touch").attr('type') == 'checkbox') {
                                                                                                                                                                            var $feed = $('input[name=hideSection6]:checked', '#appraisal3').val();
                                                                                                                                                                            var $fields1 = $(this).find('input[name="sheepItForm4_2_touch"]:checked');
                                                                                                                                                                            var $fields2 = $(this).find('input[name="sheepItForm4_2_ingest"]:checked');
                                                                                                                                                                            var $fields3 = $(this).find('input[name="sheepItForm4_2_air"]:checked');
                                                                                                                                                                            var $fields4 = $(this).find('input[name="sheepItForm4_2_sting"]:checked');
                                                                                                                                                                            var $fields5 = $("#sheepItForm4_2_allergy").val();
                                                                                                                                                                            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && $fields5 != "") {
                                                                                                                                                                                $('.errorchk23').remove();
                                                                                                                                                                                $('#senserror2').append("<span class='errorchk23'>Error: " + "You must check at least one" + "</span>");
                                                                                                                                                                                return false; // The form will *not* submit
                                                                                                                                                                            }
                                                                                                                                                                            else {
                                                                                                                                                                                $('.errorchk23').remove();
                                                                                                                                                                                return true;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    });
                                                                                                                                                                    //Autosave
                                                                                                                                                                    setInterval(function() {
                                                                                                                                                                        var queryString = $('#appraisal3').serialize();
                                                                                                                                                                        //alert(queryString);
                                                                                                                                                                        var baseurl = '<?php #echo base_url();                                                                                                                                                                                                                                                                                                          ?>';
                                                                                                                                                                        //alert(baseurl);
                                                                                                                                                                        $.ajax({
                                                                                                                                                                            type: "POST",
                                                                                                                                                                            url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                                                                                                                                                                        });
                                                                                                                                                                    }, 10000); // 10 seconds
                                                                                                                                                                    //Autosave end


                                                                                                                                                                });
                                                                                                                                                            </script>


                                                                                                                                                            <?php
//Declaration array fields
                                                                                                                                                            // echo $wizardData->sheepItForm1_specialist . '==spec';
                                                                                                                                                            // echo $wizardData->sheepItForm1_specialist1 . '==spec1';
//                                                                                                                                                            $specialist_array = $lastexam_array = $nextexam_array = $phone_array = $fax_array = $release_array = $releaseexpiration_array = array();
////copy/edit value assign here
//                                                                                                                                                            $specialist_array = (!empty($wizardData->sheepItForm1_specialist)) ? $wizardData->sheepItForm1_specialist : $wizardData->specialist1;
//                                                                                                                                                            $type_array = (!empty($wizardData->sheepItForm1_type)) ? $wizardData->sheepItForm1_type : $wizardData->type1;
//                                                                                                                                                            $lastexam_array = (!empty($wizardData->sheepItForm1_lastexam)) ? $wizardData->sheepItForm1_lastexam : $wizardData->lastexam2;
//                                                                                                                                                            $nextexam_array = (!empty($wizardData->sheepItForm1_nextexam)) ? $wizardData->sheepItForm1_nextexam : $wizardData->nextexam2;
//                                                                                                                                                            $phone_array = (!empty($wizardData->sheepItForm1_phone)) ? $wizardData->sheepItForm1_phone : $wizardData->phone2;
//                                                                                                                                                            $fax_array = (!empty($wizardData->sheepItForm1_fax)) ? $wizardData->sheepItForm1_fax : $wizardData->fax2;
//                                                                                                                                                            $release_array = (!empty($wizardData->specialistRelease)) ? $wizardData->specialistRelease : $wizardData->release2;
//                                                                                                                                                            $release_desc = (!empty($wizardData->sheepItForm1_describe_sheepItForm)) ? $wizardData->sheepItForm1_describe_sheepItForm : $wizardData->describe_sheepItForm;
//                                                                                                                                                            $releaseexpiration_array = (!empty($wizardData->sheepItForm1_releaseexp)) ? $wizardData->sheepItForm1_releaseexp : $wizardData->release_exp2;
                                                                                                                                                            ?>
                                                                                                                                                            <script type="text/javascript">
                                                                                                                                                                $(document).ready(function() {
                                                                                                                                                                    var sheepItForm1 = $('#sheepItForm1').sheepIt({
                                                                                                                                                                        separator: '',
                                                                                                                                                                        allowRemoveLast: true,
                                                                                                                                                                        allowRemoveCurrent: true,
                                                                                                                                                                        allowRemoveAll: true,
                                                                                                                                                                        allowAdd: true,
                                                                                                                                                                        allowAddN: true,
                                                                                                                                                                        maxFormsCount: 10,
                                                                                                                                                                        minFormsCount: 1,
                                                                                                                                                                        iniFormsCount:<?php
                                                                                                                                                            if (count($specialist_array) > 1) {
                                                                                                                                                                echo count($specialist_array);
                                                                                                                                                            } else {
                                                                                                                                                                echo "1";
                                                                                                                                                            }
                                                                                                                                                            ?>, afterAdd: function(source, newForm) {

                                                                                                                                                                            $('.generate_datepic').each(function(i, e) {
//                                                                                                                                                                                $(e).datepicker("destroy");
//                                                                                                                                                                                $(e).datepicker();
                                                                                                                                                                                $('#hidename52_1').hide();
                                                                                                                                                                                $('#hidename52_2').hide();
                                                                                                                                                                                $('#hidename52_3').hide();
                                                                                                                                                                                $('#hidename52_4').hide();
                                                                                                                                                                                $('#hidename52_5').hide();
                                                                                                                                                                            });

                                                                                                                                                                        }, afterRemoveCurrent: function(source) {
                                                                                                                                                                            $('.generate_datepic').each(function(i, e) {
                                                                                                                                                                                $(e).datepicker("destroy");
                                                                                                                                                                                $(e).datepicker();
                                                                                                                                                                            });
                                                                                                                                                                        }

                                                                                                                                                                    });
<?php
foreach ($specialist_array as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key1 ?>_specialist').val('<?php echo $value1; ?>');

<?php } ?>
<?php
foreach ($type_array as $key11 => $value11) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key11 ?>_type').val('<?php echo $value11; ?>');
<?php } ?>
<?php
foreach ($releaseexpiration_array as $key4 => $value4) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key4 ?>_releaseexp').val('<?php echo $value4; ?>');
<?php } ?>

<?php
foreach ($lastexam_array as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key2 ?>_lastexam').val('<?php echo $value2; ?>');
<?php } ?>
<?php
foreach ($nextexam_array as $key3 => $value3) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key3 ?>_nextexam').val('<?php echo $value3; ?>');
<?php } ?>
<?php
foreach ($phone_array as $key5 => $value5) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key5 ?>_phone').val('<?php echo $value5; ?>');
<?php } ?>
<?php
foreach ($fax_array as $key6 => $value6) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key6 ?>_fax').val('<?php echo $value6; ?>');
<?php } ?>
<?php
foreach ($release_desc as $key7 => $value7) {
    ?>
                                                                                                                                                                        $('#sheepItForm1_<?php echo $key7 ?>_describe_sheepItForm').val('<?php echo $value7; ?>');
<?php } ?>
<?php
for ($i = 0; $i < count($specialist_array); $i++) {
    if ($release_array[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm1_<?php echo $i; ?>_release1').prop('checked', 'true');
        <?php
    }
    if ($release_array[$i] == 'no') {
        ?>
                                                                                                                                                                            $('#sheepItForm1_<?php echo $i; ?>_release2').prop('checked', 'true');
        <?php
    }
}
?>
                                                                                                                                                                });
                                                                                                                                                            </script>
                                                                                                                                                            <script type="text/javascript">
                                                                                                                                                                $(document).ready(function() {
                                                                                                                                                                    var sheepItForm = $('#sheepItForm').sheepIt({
                                                                                                                                                                        separator: '',
                                                                                                                                                                        allowRemoveLast: true,
                                                                                                                                                                        allowRemoveCurrent: true,
                                                                                                                                                                        allowRemoveAll: true,
                                                                                                                                                                        allowAdd: true,
                                                                                                                                                                        allowAddN: true,
                                                                                                                                                                        maxFormsCount: 10,
                                                                                                                                                                        minFormsCount: 1,
                                                                                                                                                                        iniFormsCount: <?php
if (count($wizardData->sheepItForm_name) > 1) {
    echo count($wizardData->sheepItForm_name);
} else {
    echo "1";
}
?>
                                                                                                                                                                    });

<?php
foreach ($wizardData->sheepItForm_name as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm_<?php echo $key1 ?>_name').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm_agname as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm_<?php echo $key1 ?>_agname').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm_cashman as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm_<?php echo $key1 ?>_cashman').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm_phone as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm_<?php echo $key2 ?>_phone').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm_fax as $key3 => $value3) {
    ?>
                                                                                                                                                                        $('#sheepItForm_<?php echo $key3 ?>_fax').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>
<?php
for ($i = 0; $i < count($wizardData->sheepItForm_name); $i++) {
    if ($wizardData->sheepItForm_release[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm_<?php echo $i; ?>_release1').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm_release[$i] == 'no') {
        ?>
                                                                                                                                                                            $('#sheepItForm_<?php echo $i; ?>_release2').prop('checked', 'true');
        <?php
    }
}
?>
                                                                                                                                                                });
                                                                                                                                                            </script>
                                                                                                                                                            <script type="text/javascript">
                                                                                                                                                                $(document).ready(function() {
                                                                                                                                                                    var sheepItForm2 = $('#sheepItForm2').sheepIt({
                                                                                                                                                                        separator: '',
                                                                                                                                                                        allowRemoveLast: true,
                                                                                                                                                                        allowRemoveCurrent: true,
                                                                                                                                                                        allowRemoveAll: true,
                                                                                                                                                                        allowAdd: true,
                                                                                                                                                                        allowAddN: true,
                                                                                                                                                                        maxFormsCount: 10,
                                                                                                                                                                        minFormsCount: 1,
                                                                                                                                                                        iniFormsCount: <?php
if (count($wizardData->sheepItForm2_med) > 1) {
    echo count($wizardData->sheepItForm2_med);
} else {
    echo "1";
}
?>,
                                                                                                                                                                    });
<?php
foreach ($wizardData->sheepItForm2_med as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm2_<?php echo $key1 ?>_med').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm2_dos as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm2_<?php echo $key2 ?>_dos').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm2_route as $key3 => $value3) {
    ?>
                                                                                                                                                                        $('#sheepItForm2_<?php echo $key3 ?>_route').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm2_time as $key4 => $value4) {
    ?>
                                                                                                                                                                        $('#sheepItForm2_<?php echo $key4 ?>_time').val(<?php echo $this->db->escape($value4); ?>);
<?php } ?>

<?php
for ($i = 0; $i < count($wizardData->sheepItForm2_med); $i++) {
    if ($wizardData->sheepItForm2_school[$i] == 'school') {
        ?>
                                                                                                                                                                            $('#sheepItForm2_<?php echo $i; ?>_school').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm2_home[$i] == 'home') {
        ?>
                                                                                                                                                                            $('#sheepItForm2_<?php echo $i; ?>_home').prop('checked', 'true');
        <?php
    }
}
?>
                                                                                                                                                                });
                                                                                                                                                            </script>
                                                                                                                                                            <script>
                                                                                                                                                                $(document).ready(function() {
                                                                                                                                                                    var sheepItForm3 = $('#sheepItForm3').sheepIt({
                                                                                                                                                                        separator: '',
                                                                                                                                                                        allowRemoveLast: true,
                                                                                                                                                                        allowRemoveCurrent: true,
                                                                                                                                                                        allowRemoveAll: true,
                                                                                                                                                                        allowAdd: true,
                                                                                                                                                                        allowAddN: true,
                                                                                                                                                                        maxFormsCount: 10,
                                                                                                                                                                        minFormsCount: 1,
                                                                                                                                                                        iniFormsCount: <?php
if (count($wizardData->sheepItForm3_prnmed) > 1) {
    echo count($wizardData->sheepItForm3_prnmed);
} else {
    echo "1";
}
?>
                                                                                                                                                                    });


<?php
foreach ($wizardData->sheepItForm3_prnmed as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm3_<?php echo $key1 ?>_prnmed').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm3_prndos as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm3_<?php echo $key2 ?>_prndos').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm3_prnroute as $key3 => $value3) {
    ?>
                                                                                                                                                                        $('#sheepItForm3_<?php echo $key3 ?>_prnroute').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm3_prntime as $key4 => $value4) {
    ?>
                                                                                                                                                                        $('#sheepItForm3_<?php echo $key4 ?>_prntime').val(<?php echo $this->db->escape($value4); ?>);
<?php } ?>

<?php
for ($i = 0; $i < count($wizardData->sheepItForm3_prnmed); $i++) {
    if ($wizardData->sheepItForm3_prnschool[$i] == 'school') {
        ?>
                                                                                                                                                                            $('#sheepItForm3_<?php echo $i; ?>_prnschool').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm3_prnhome[$i] == 'home') {
        ?>
                                                                                                                                                                            $('#sheepItForm3_<?php echo $i; ?>_prnhome').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm3_prnemerg[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm3_<?php echo $i; ?>_prnemerg').prop('checked', 'true');
        <?php
    }
}
?>

                                                                                                                                                                });

                                                                                                                                                            </script>

                                                                                                                                                            <script type="text/javascript">

                                                                                                                                                                $(document).ready(function() {

                                                                                                                                                                    var sheepItForm4 = $('#sheepItForm4').sheepIt({
                                                                                                                                                                        separator: '',
                                                                                                                                                                        allowRemoveLast: true,
                                                                                                                                                                        allowRemoveCurrent: true,
                                                                                                                                                                        allowRemoveAll: true,
                                                                                                                                                                        allowAdd: true,
                                                                                                                                                                        allowAddN: true,
                                                                                                                                                                        maxFormsCount: 10,
                                                                                                                                                                        minFormsCount: 1,
                                                                                                                                                                        iniFormsCount: <?php
if (count($wizardData->sheepItForm4_allergy) > 1) {
    echo count($wizardData->sheepItForm4_allergy);
} else {
    echo "1";
}
?>
                                                                                                                                                                    });
<?php
foreach ($wizardData->sheepItForm4_allergy as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm4_<?php echo $key1 ?>_allergy').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm4_reaction as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm4_<?php echo $key2 ?>_reaction').html(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm4_addtnlcomments as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm4_<?php echo $key2 ?>_addtnlcomments').html(<?php echo $this->db->escape($value2); ?>);
<?php } ?>

<?php
foreach ($wizardData->sheepItForm4_lastevent as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm4_<?php echo $key2 ?>_lastevent').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>

<?php
foreach ($wizardData->sheepItForm4_ah as $key3 => $value3) {
    ?>
                                                                                                                                                                        $('#sheepItForm4_<?php echo $key3; ?>_ah1').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>

<?php
for ($i = 0; $i < count($wizardData->sheepItForm4_allergy); $i++) {
    if ($wizardData->sheepItForm4_deadly[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_deadly1').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_deadly[$i] == 'no') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_deadly2').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_diagnosed[$i] == 'Exposure') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_diagnosed1').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_diagnosed[$i] == 'Allergy Testing/Never Exposed') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_diagnosed3').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_diagnosed[$i] == 'Allergy Testing and Exposure') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_diagnosed2').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_touch[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_touch').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_ingest[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_ingest').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_air[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_air').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_sting[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_sting').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_epi[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_epi').prop('checked', 'true');
        <?php
    }
    if ($wizardData->sheepItForm4_antihistamine[$i] == 'yes') {
        ?>
                                                                                                                                                                            $('#sheepItForm4_<?php echo $i; ?>_antihistamine').prop('checked', 'true');
        <?php
    }
}
?>



                                                                                                                                                                    // Add more treatments here
                                                                                                                                                                    var sheepItForm5 = $('#sheepItForm5').sheepIt({
                                                                                                                                                                        separator: '',
                                                                                                                                                                        allowRemoveLast: true,
                                                                                                                                                                        allowRemoveCurrent: true,
                                                                                                                                                                        allowRemoveAll: true,
                                                                                                                                                                        allowAdd: true,
                                                                                                                                                                        allowAddN: true,
                                                                                                                                                                        maxFormsCount: 10,
                                                                                                                                                                        minFormsCount: 1,
                                                                                                                                                                        iniFormsCount: <?php
if (count($wizardData->sheepItForm5_treatment) > 1) {
    echo count($wizardData->sheepItForm5_treatment);
} else {
    echo "1";
}
?>
                                                                                                                                                                    });
<?php
//echo '<pre>';
//print_r($wizardData->treatment1);
//exit;
foreach ($wizardData->sheepItForm5_treatment as $key1 => $value1) {
    ?>
                                                                                                                                                                        $('#sheepItForm5_<?php echo $key1 ?>_treatment').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wizardData->sheepItForm5_frequency as $key2 => $value2) {
    ?>
                                                                                                                                                                        $('#sheepItForm5_<?php echo $key2 ?>_frequency').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>


<?php
foreach ($wizardData->sheepItForm5_person as $key3 => $value3) {
    ?>
                                                                                                                                                                        $('#sheepItForm5_<?php echo $key3 ?>_person').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>

                                                                                                                                                                    //Edit option data brings

<?php
if ($wizardData->sheepItForm5_0_performed_school == "yes") {
    ?>

                                                                                                                                                                        $('#sheepItForm5_0_performed_school1').prop('checked', 'true');
    <?php
} else {
    ?>
                                                                                                                                                                        $('#sheepItForm5_0_performed_school2').prop('checked', 'true');
    <?php
}

if ($wizardData->sheepItForm5_1_performed_school == "yes") {
    ?>

                                                                                                                                                                        $('#sheepItForm5_1_performed_school1').prop('checked', 'true');
    <?php
} else {
    ?>
                                                                                                                                                                        $('#sheepItForm5_1_performed_school2').prop('checked', 'true');
    <?php
}

if ($wizardData->sheepItForm5_2_performed_school == "yes") {
    ?>

                                                                                                                                                                        $('#sheepItForm5_2_performed_school1').prop('checked', 'true');
    <?php
} else {
    ?>
                                                                                                                                                                        $('#sheepItForm5_2_performed_school2').prop('checked', 'true');
    <?php
}
?>
                                                                                                                                                                });

                                                                                                                                                            </script>