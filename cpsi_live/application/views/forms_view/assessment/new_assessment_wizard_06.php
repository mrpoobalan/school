<style>
    select{
        width:auto!important;
    }
    .errorchk{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment6', 'name' => 'assessment6', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment6', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment6", 'class' => "healthform");
$sif = array('class' => 'form-control', 'name' => 'sif', 'id' => 'sif');
$confirmsif = array('class' => 'form-control', 'name' => 'confirmsif', 'id' => 'confirmsif');
$firstname = array('class' => 'form-control', 'name' => 'fname', 'id' => 'fname');
$lastname = array('class' => 'form-control', 'name' => 'last_name', 'id' => 'last_name');
$nickname = array('class' => 'form-control', 'name' => 'nickname', 'id' => 'nickname');
$dob = array('class' => 'form-control', 'name' => 'dob', 'id' => 'dob');
$parentname = array('class' => 'form-control', 'name' => 'parentname', 'id' => 'parentname');
$cellphone = array('class' => 'form-control', 'name' => 'cellphone', 'id' => 'cellphone');
$street = array('class' => 'form-control', 'name' => 'street', 'id' => 'street');
$homephone = array('class' => 'form-control', 'name' => 'homephone', 'id' => 'homephone');
$city = array('class' => 'form-control', 'name' => 'city', 'id' => 'city');
$workphone = array('class' => 'form-control', 'name' => 'workphone', 'id' => 'workphone');
$zip = array('class' => 'form-control', 'name' => 'zip', 'id' => 'zip');
$addtnlcontact = array('class' => 'form-control', 'name' => 'addtnlcontact', 'id' => 'addtnlcontact');
$addtnlcellphone = array('class' => 'form-control', 'name' => 'addtnlcellphone', 'id' => 'addtnlcellphone');
$addtnlhomephone = array('class' => 'form-control', 'name' => 'addtnlhomephone', 'id' => 'addtnlhomephone');
$addtnlworkphone = array('class' => 'form-control', 'name' => 'addtnlworkphone', 'id' => 'addtnlworkphone');
$none_text = array('class' => 'form-control', 'name' => 'none_text', 'id' => 'none_text');
$preferred_hospital = array('class' => 'form-control', 'name' => 'preferred_hospital', 'id' => 'preferred_hospital');
$medical_reason = array('class' => 'form-control', 'name' => 'medical_reason', 'id' => 'medical_reason');
$contactattempt1 = array('class' => 'form-control', 'name' => 'contactattempt1', 'id' => 'contactattempt1');
$assessment = array('class' => 'form-control', 'name' => 'assessment', 'id' => 'assessment');
if (empty($wiz_06->sif)):
    $wiz_06 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_06->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_06->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;

if ($wiz_06->hearing_screening == '01-01-1970' || $wiz_06->hearing_screening == "1970-01-01") {
    $wiz_06->hearing_screening = "";
}
if ($wiz_06->vision_screening == '01-01-1970' || $wiz_06->vision_screening == "1970-01-01") {
    $wiz_06->vision_screening = "";
}
if ($wiz_06->last_seizure_exam == '01-01-1970' || $wiz_06->last_seizure_exam == "1970-01-01") {
    $wiz_06->last_seizure_exam = "";
}

if ($wiz_06->last_seizure == '01-01-1970' || $wiz_06->last_seizure == "1970-01-01") {
    $wiz_06->last_seizure = "";
}

if ($wiz_06->shunt_placement == '01-01-1970' || $wiz_06->shunt_placement == "1970-01-01") {
    $wiz_06->last_seizure = "";
}
if ($wiz_06->last_revision == '01-01-1970' || $wiz_06->last_revision == "1970-01-01") {
    $wiz_06->last_revision = "";
}
?>
<div id="assessment_wizard_6">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_06->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;   ?></div>
        <?php endif; ?>
        <fieldset class="new-section threecol">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(7)" id="hide7" name="hide7" value = "on" <?php echo!empty($wiz_06->hide7) ? ' checked ' : '' ?> /> <label for="hide7"><span></span>No needs at this time</label></span>
            <legend>Communication/Vision/Hearing Requirements</legend>
            <div class="hide7">
                <section>
                    <label for="need-type">Select Requirement Type</label>
                    <div class="check-group">
                        <span><input type="checkbox" name="need_type_verbal" value="yes" id="need_type_verbal" <?php echo!empty($wiz_06->need_type_verbal) ? ' checked ' : '' ?>/> <label for="need_type_verbal"><span></span>Verbal</label></span>
                        <span><input type="checkbox" name="need_type_nonverbal" value="yes" id="need_type_nonverbal" <?php echo!empty($wiz_06->need_type_nonverbal) ? ' checked ' : '' ?> /> <label for="need_type_nonverbal"><span></span>Non-Verbal</label></span>
                        <span><input type="checkbox" name="need_type_speech" value="yes" id="need_type_speech" <?php echo!empty($wiz_06->need_type_speech) ? ' checked ' : '' ?>/> <label for="need_type_speech"><span></span>Speech/Language Needs</label></span>
                        <span><input type="checkbox" name="need_type_audiology" value="yes" id="need_type_audiology" <?php echo!empty($wiz_06->need_type_audiology) ? ' checked ' : '' ?>/> <label for="need_type_audiology"><span></span>Audiology Needs</label></span>
                        <span><input type="checkbox" name="need_type_vision" value="yes" id="need_type_vision" <?php echo!empty($wiz_06->need_type_vision) ? ' checked ' : '' ?> /> <label for="need_type_vision"><span></span>Vision Needs</label></span>
                        <span><input type="checkbox" name="need_type_signs" value="yes" id="need_type_signs" <?php echo!empty($wiz_06->need_type_signs) ? ' checked ' : '' ?> /> <label for="need_type_signs"><span></span>Signs/Gestures</label></span>
                        <span><input type="checkbox" name="need_type_expressions" value="yes" id="need_type_expressions" <?php echo!empty($wiz_06->need_type_expressions) ? ' checked ' : '' ?> /> <label for="need_type_expressions"><span></span>Expressions</label></span>
                        <span><input type="checkbox" name="need_type_cries" value="yes" id="need_type_cries" <?php echo!empty($wiz_06->need_type_cries) ? ' checked ' : '' ?> /> <label for="need_type_cries"><span></span>Cries/Smiles</label></span>
                        <span><input type="checkbox" name="need_type_pictures" value="yes" id="need_type_pictures" <?php echo!empty($wiz_06->need_type_pictures) ? ' checked ' : '' ?> /> <label for="need_type_pictures"><span></span>Pictures</label></span>
                        <span><input type="checkbox" name="need_type_nocommunication" value="yes" id="need_type_nocommunication"  <?php echo!empty($wiz_06->need_type_nocommunication) ? ' checked ' : '' ?> /> <label for="need_type_nocommunication"><span></span>No Communication</label></span>
                    </div>
                </section>
                <section>
                    <label for="devices">Assistive Communication Devices?</label>
                    <span class="inline"><input type="radio" name="devices" value="yes" onclick="showvalue3()" id="devices" <?php echo!empty($wiz_06->devices) ? ' checked ' : '' ?> /> <label for="devices-yes"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="devices" value="" onclick="showvalue3()"  id="devices" <?php echo empty($wiz_06->devices) ? ' checked ' : '' ?> /> <label for="devices-no"><span></span>No</label></span>
                    <div id="divval3" style="display: none">
                        <label for="device_describe">If Yes, Describe</label>
                        <textarea id="device_describe" name="device_describe"><?php echo $wiz_06->device_describe ?></textarea>
                    </div>
                </section>
                <section>
                    <label for="devicelist">Device(s) Used</label>
                    <span><input type="checkbox" name="devicelist_glasses" value="yes" id="devicelist_glasses" <?php echo!empty($wiz_06->devicelist_glasses) ? ' checked ' : '' ?> /> <label for="devicelist_glasses"><span></span>Wears Glasses</label></span>
                    <span><input type="checkbox" name="devicelist_hearingaid" value="yes" id="devicelist_hearingaid" <?php echo!empty($wiz_06->devicelist_hearingaid) ? ' checked ' : '' ?> /> <label for="devicelist_hearingaid"><span></span>Wears Hearing Aid</label></span>
                    <span><input type="checkbox" name="devicelist_cochlear" value="yes" id="devicelist_cochlear" <?php echo!empty($wiz_06->devicelist_cochlear) ? ' checked ' : '' ?> /> <label for="devicelist_cochlear"><span></span>Cochlear Implant</label></span>
                    <span><input type="checkbox" name="devicelist_fm" value="yes" id="devicelist_fm" <?php echo!empty($wiz_06->devicelist_fm) ? ' checked ' : '' ?> /> <label for="devicelist_fm"><span></span>FM System</label></span>
                    <label for="hearing-screening">Last Hearing Screening</label>
                    <input type="text" id="hearing_screening" name="hearing_screening" value="<?php echo $wiz_06->hearing_screening ?>" />
                    <label for="vision-screening">Last Vision Screening</label>
                    <input type="text" id="vision_screening" name="vision_screening" value="<?php echo $wiz_06->vision_screening ?>" />
                </section>
                <section class="largetext">
                    <label for="communication_comments">Additional Comments</label>
                    <textarea id="communication_comments" name="communication_comments"><?php echo $wiz_06->communication_comments ?></textarea>
                </section>
            </div>
        </fieldset>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(8)" id="hide8" name="hide8" value = "on" <?php echo!empty($wiz_06->hide8) ? ' checked ' : '' ?> /> <label for="hide8"><span></span>No needs at this time</label></span>
            <legend>Neurological Requirements</legend>
            <div class="hide8">
                <section>
                    <label for="seizures">Seizures Disorder</label>
                    <span class="inline"><input type="radio" name="seizures" value="yes" onclick="showvalue4()" id="seizures" <?php echo!empty($wiz_06->seizures) ? ' checked ' : '' ?>/> <label for="seizures-yes"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="seizures" value="" onclick="showvalue4()" id="seizures" <?php echo empty($wiz_06->seizures) ? ' checked ' : '' ?> /> <label for="seizures-no"><span></span>No</label></span>
                    <div id="divval4" style="display: none">
                        <label for="seizure-type">If yes, type:</label>
                        <input type="text" id="seizure_type" name="seizure_type" value="<?php echo $wiz_06->seizure_type ?>"/>
                    </div>
                    <label for="last-seizure-exam">Last Exam</label>
                    <input type="text" id="last_seizure_exam" name="last_seizure_exam" value="<?php echo $wiz_06->last_seizure_exam ?>" />
                    <label for="onset-age">Age of Onset</label>
                    <input type="text" id="onset_age" name="onset_age" value="<?php echo $wiz_06->onset_age ?>" />
                </section>
                <section>
                    <label for="last-seizure">Date of Last Seizure</label>
                    <input type="text" id="last_seizure" name="last_seizure"  value="<?php echo $wiz_06->last_seizure ?>" />
                    <label for="usual-duration">Usual Duration</label>
                    <input type="text" id="usual_duration" name="usual_duration" value="<?php echo $wiz_06->usual_duration ?>" />
                    <label for="seizure-frequency">Frequency of Seizures</label>
                    <input type="text" id="seizure_frequency" name="seizure_frequency" value="<?php echo $wiz_06->seizure_frequency ?>" />
                    <label for="status-epilecticus">Hx of Status Epilecticus</label>
                    <input type="text" id="status_epilecticus" name="status_epilecticus" value="<?php echo $wiz_06->status_epilecticus ?>" />
                </section>
                <section class="two-col">
                    <label for="triggers">Triggers</label>
                    <textarea  id="triggers" name="triggers"><?php echo $wiz_06->triggers ?></textarea>
                    <label for="ketogenic">Ketogenic Diet?</label>
                    <span class="inline"><input type="radio" name="ketogenic" value="yes" id="ketogenic"  <?php echo!empty($wiz_06->ketogenic) ? ' checked ' : '' ?>/> <label for="ketogenic-yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="ketogenic" value="no" id="ketogenic" <?php echo empty($wiz_06->ketogenic) ? ' checked ' : '' ?> /> </span> No</label></span>
                    <input type="hidden" name="spam" id="spam"/>
                    <label for="seizure_treatment">Treatment</label>

                    <span><input type="checkbox" name="treatment_diastat" class="require-one"  value="yes" id="treatment_diastat" <?php echo!empty($wiz_06->treatment_diastat) ? ' checked ' : '' ?> /> <label for="treatment_diastat"><span></span>Diastat</label></span>
                    <span><input type="checkbox" name="treatment_oxygen" class="require-one"  value="yes" id="treatment_oxygen" <?php echo!empty($wiz_06->treatment_oxygen) ? ' checked ' : '' ?> /> <label for="treatment_oxygen"><span></span>Oxygen</label></span>
                    <span><input type="checkbox" name="treatment_vagal" class="require-one"  value="yes" id="treatment_vagal" <?php echo!empty($wiz_06->treatment_vagal) ? ' checked ' : '' ?> /> <label for="treatment_vagal"><span></span>Vagal Nerve Stimulator</label></span>
                    <span><input type="checkbox" name="treatment_medication" class="require-one"  value="yes" id="treatment_medication" <?php echo!empty($wiz_06->treatment_medication) ? ' checked ' : '' ?> /> <label for="treatment_medication"><span></span>Medication (see medication list)</label></span>
                    <div id="chkerror"></div>
                </section>
                <section>
                    <label for="post-seizure">Post Seizure Activity</label>
                    <textarea id="post_seizure" name="post_seizure"><?php echo $wiz_06->post_seizure ?></textarea>
                    <label for="aura">Aura?</label>
                    <span class="inline"><input type="radio" name="aura" value="yes" id="aura" onclick="showvalue6()"  <?php echo!empty($wiz_06->aura) && $wiz_06->aura == 'yes' ? ' checked ' : '' ?> /> <label for="aura"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="aura" value="no" id="aura" onclick="showvalue6()"  <?php echo empty($wiz_06->aura) || $wiz_06->aura == 'no' ? ' checked ' : '' ?>/> <label for="aura"><span></span>No</label></span>
                    <div id="divval6">
                        <label for="aura-description">If Yes, Describe</label>
                        <textarea id="aura_description" name="aura_description"><?php echo $wiz_06->aura_description ?></textarea>
                    </div>
                </section>
                <section class="two-col">
                    <label for="shunt">Shunt?</label>
                    <span class="inline"><input type="radio" name="shunt" value="yes" onclick="showvalue5()" id="shunt" <?php echo!empty($wiz_06->shunt) ? ' checked ' : '' ?> /> <label for="shunt-yes"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="shunt" value="" onclick="showvalue5()" id="shunt-no" <?php echo empty($wiz_06->shunt) ? ' checked ' : '' ?> /> <label for="shunt-no"><span></span>No</label></span>
                    <div id="divval5" style="display: none">
                        <label for="shunt-type">If yes, type:</label>
                        <input type="text" id="shunt_type" name="shunt_type" value="<?php echo $wiz_06->shunt_type ?>" />
                        <label for="placement-date">Date of Shunt Placement</label>
                        <input type="text" id="shunt_placement"  name="shunt_placement" value="<?php echo $wiz_06->shunt_placement ?>" />
                        <label for="last-revision">Date of Last Revision</label>
                        <input type="text" id="last_revision" name="last_revision" value="<?php echo $wiz_06->last_revision ?>" />
                    </div>
                </section>
                <section class="largetext">
                    <label for="seizure_comments">Additional Comments (Episode description, safety needs)</label>
                    <textarea id="seizure_comments" name="seizure_comments"><?php echo $wiz_06->seizure_comments ?></textarea>
                </section>
            </div>
        </fieldset>
        <fieldset>
            <section class="buttons" >
                <div class="nextbutton">
                    <?= $link_back; ?>
                    <?= form_submit($attr_FormSubmit_assessment); ?>
                </div>
                <div class="savebuttons float-left">
                    <?php $sif = array('name' => 'sif', 'type' => 'hidden'); ?>
                    <?= form_input($sif, set_value("sif", $sif_num)); ?>
                    <?php
                    if (!empty($wiz_06->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_06->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
                    endif;
                    ?>
                    <?= form_submit($attr_FormSave_assessment); ?>
                    <?= form_close(); ?>
                </div>
            </section>
        </fieldset>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#shunt-no').click(function() {
            $('#shunt_type').val('');
            $('#shunt_placement').val('');
            $('#last_revision').val('');
        });
        $('#assessment6').submit(function() {
            var $ckbox = ($('input[name=hide8]:checked', '#assessment6').val());
            var $fields1 = $(this).find('input[name="treatment_diastat"]:checked');
            var $fields2 = $(this).find('input[name="treatment_oxygen"]:checked');
            var $fields3 = $(this).find('input[name="treatment_vagal"]:checked');
            var $fields4 = $(this).find('input[name="treatment_medication"]:checked');
            if (!$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && $ckbox != 'on') {
                $('.errorchk').remove();
                $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one treatment" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk').remove();
                return true;
            }
        });

        //Autosave
        setInterval(function() {
            var queryString = $('#assessment6').serialize();
            var baseurl = '<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
//Autosave end
//show values for edit
        var devices1 = $('#devices').val();
        var seizures1 = $('#seizures').val();
        var shunt1 = $('#shunt').val();
        var aura1 = $('#aura').val();
        if (devices1 == 'yes') {
            showvalue3();

        }
        if (seizures1 == 'yes') {
            showvalue4();

        }
        if (shunt1 == 'yes') {
            showvalue5();

        }
        if (aura1 == 'yes') {
            showvalue6();
        }

        $("input[type=checkbox]").change();
        $("#dob").datepicker({dateFormat: 'mm/dd/yy'});
        $("#contactattempt1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#reevaldate").datepicker({dateFormat: 'mm/dd/yy'});
        $("#previousdate").datepicker({dateFormat: 'mm/dd/yy'});
        $("#release_exp1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#release_exp2").datepicker({dateFormat: 'mm/dd/yy'});
        $("#dentalexam").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hearingexam").datepicker({dateFormat: 'mm/dd/yy'});
        $("#visionexam").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sco_last").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hip_last").datepicker({dateFormat: 'mm/dd/yy'});
        $("#swallow_study_date").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_seizure_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_seizure_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_hypo_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_hypo_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_allergy_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_allergy_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_gtube_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_gtube_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_cardiac_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_cardiac_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_resp_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_resp_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_emer_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#hcap_emer_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#swallow_study_date").datepicker({dateFormat: 'mm/dd/yy'});
        $("#release-exp1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#release-exp2").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastexam2").datepicker({dateFormat: 'mm/dd/yy'});
        $("#nextexam2").datepicker({dateFormat: 'mm/dd/yy'});
        $("#dentalexam").datepicker({dateFormat: 'mm/dd/yy'});
        $("#previous").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastevent1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#shuntplacement").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastrevision").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastseizure").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastexam1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#nextexam1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#releaseexp1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#releaseexp2").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastseizureexam").datepicker({dateFormat: 'mm/dd/yy'});
    });
</script>
