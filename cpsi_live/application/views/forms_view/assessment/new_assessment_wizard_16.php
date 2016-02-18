<style>
    select{
        width:auto!important;
    }
    .agency{

    }
    .errorchk,.errorchk2,.errorchk3,.errorchk4,.errorchk5,.errorchk6,.errorchk7,.errorchk8,.errorchk9,.errorchk10,.errorchk11,.errorchk12{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }

</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
//$attr_FormSubmit_assessment = array('class' => 'btn btn_primary', 'id' => 'assessment16', 'name' => 'assessment16', 'value' => 'Submit', 'type' => 'submit');
$attr_FormSubmit_assessment = array('class' => 'btn btn_primary', 'id' => 'assessment16', 'name' => 'assessment16', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment16', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment16", 'class' => "healthform");

$sif = array('class' => 'form_control', 'name' => 'sif', 'id' => 'sif');
$confirmsif = array('class' => 'form_control', 'name' => 'confirmsif', 'id' => 'confirmsif');
$firstname = array('class' => 'form_control', 'name' => 'fname', 'id' => 'fname');
$lastname = array('class' => 'form_control', 'name' => 'last_name', 'id' => 'last_name');
$nickname = array('class' => 'form_control', 'name' => 'nickname', 'id' => 'nickname');
$dob = array('class' => 'form_control', 'name' => 'dob', 'id' => 'dob');
$parentname = array('class' => 'form_control', 'name' => 'parentname', 'id' => 'parentname');
$cellphone = array('class' => 'form_control', 'name' => 'cellphone', 'id' => 'cellphone');
$street = array('class' => 'form_control', 'name' => 'street', 'id' => 'street');
$homephone = array('class' => 'form_control', 'name' => 'homephone', 'id' => 'homephone');
$city = array('class' => 'form_control', 'name' => 'city', 'id' => 'city');
$workphone = array('class' => 'form_control', 'name' => 'workphone', 'id' => 'workphone');
$zip = array('class' => 'form_control', 'name' => 'zip', 'id' => 'zip');
$addtnlcontact = array('class' => 'form_control', 'name' => 'addtnlcontact', 'id' => 'addtnlcontact');
$addtnlcellphone = array('class' => 'form_control', 'name' => 'addtnlcellphone', 'id' => 'addtnlcellphone');
$addtnlhomephone = array('class' => 'form_control', 'name' => 'addtnlhomephone', 'id' => 'addtnlhomephone');
$addtnlworkphone = array('class' => 'form_control', 'name' => 'addtnlworkphone', 'id' => 'addtnlworkphone');
$none_text = array('class' => 'form_control', 'name' => 'none_text', 'id' => 'none_text');
$preferred_hospital = array('class' => 'form_control', 'name' => 'preferred_hospital', 'id' => 'preferred_hospital');
$medical_reason = array('class' => 'form_control', 'name' => 'medical_reason', 'id' => 'medical_reason');
$contactattempt1 = array('class' => 'form_control', 'name' => 'contactattempt1', 'id' => 'contactattempt1');
$assessment = array('class' => 'form_control', 'name' => 'assessment', 'id' => 'assessment');

if (empty($wiz_16->sif)):
    $wiz_16 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_16->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_16->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;

function date_change($val) {
    $res = str_replace('_', '-', $val);
    $exp = explode("-", $res);
    return $exp[1] . "-" . $exp[2] . "-" . $exp[0];
}

//echo '<pre>';
//print_r($wiz_16);
//exit;
?>

<div id="assessment_wizard_16">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_16->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;                         ?></div>
        <?php endif; ?>
        <fieldset class="new_section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(17)" id="hide17" name="hide17" value="on" <?php echo!empty($wiz_16->hide17) ? ' checked ' : '' ?> /> <label for="hide17"><span></span>No needs at this time</label></span>
            <legend class="legends">Additional Information/Specific Cultural Beliefs</legend>
            <div class="hide17">
                <label for="cultural_info">Awareness of safety issues/behaviors/awareness of pain/soothers</label>
                <textarea id="cultural_info" name="cultural_info"><?php echo $wiz_16->cultural_info ?></textarea>
            </div>
        </fieldset>

        <fieldset class="new_section ">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(188)" id="hide188"  name="hide188" value="on" <?php echo!empty($wiz_16->hide188) ? ' checked ' : '' ?> /> <label for="hide188"><span></span>No needs at this time</label></span>
            <legend class="legends">Emergency Action Plans</legend>
            <div class="hide188">

                <!---- Section 1 ----->
                <section>
                    <label for="planname1">Seizure Plans</label>
                    <span class="inline"><input type="radio" name="planname1" id="planname1"  onclick="showvalue310(this.value)" value="yes"
                                                <?php if (!empty($wiz_16->planname1)) : ?> checked="checked" <?php endif; ?>  /> <label for="yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="planname1" id="planname1"
                                                <?php if (empty($wiz_16->planname1)): ?>  checked="checked" <?php endif; ?> onclick="showvalue310(this.value)" value="" /> <label for=""><span></span> No</label></span>
                    <br>
                    <div id="hidename310" style="display: none">
                        <span class="inline"><input type="checkbox" name="teacher1" id="teacher1" value="teacher1"
                                                    <?php if (!empty($wiz_16->hcap_seizure_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher1"><span></span> Teachers</label></span>
                        <span class="inline"><input type="checkbox" name="bus1" id="bus1" value="bus1"
                                                    <?php if (!empty($wiz_16->hcap_seizure_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus1"><span></span> Bus</label></span>
                        <span class="inline"><input type="checkbox" name="hr1" id="hr1" value="hr1"
                                                    <?php if (!empty($wiz_16->hcap_seizure_hr)) : ?> checked="checked" <?php endif; ?> /><label for="hr1"><span></span> HR File</label></span>
                        <div id="chkerror"></div>
                        <label for="datereview1">Date Reviewed</label>
                        <input type="text" id="datereview1" name="datereview1"  class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_seizure_review)) ? $wiz_16->hcap_seizure_review : ''; ?>"/>

                        <label for="datedist1">Date Distributed</label>
                        <input type="text" id="datedist1" name="datedist1" class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_seizure_dist)) ? $wiz_16->hcap_seizure_dist : ''; ?>">

                    </div>
                </section>
                <!---- Section 2 ----->
                <section>
                    <label for="hcap_hypo">Hypo/Hyperglycemia Plans</label>
                    <span class="inline"><input type="radio" name="planname2" id="planname2"  onclick="showvalue311(this.value)" value="yes"
                                                <?php if (!empty($wiz_16->planname2)) : ?> checked="checked" <?php endif; ?>/> <label for="yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="planname2" id="planname2"
                                                <?php if (empty($wiz_16->planname2)): ?>  checked="checked" <?php endif; ?>onclick="showvalue311(this.value)" value="" /> <label for=""><span></span> No</label></span>
                    <br>
                    <div id="hidename311" style="display: none">
                        <span class="inline"><input type="checkbox" name="teacher2" id="teacher2" value="teacher2"
                                                    <?php if (!empty($wiz_16->hcap_hypo_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher2"><span></span> Teachers</label></span>
                        <span class="inline"><input type="checkbox" name="bus2" id="bus2" value="bus2"
                                                    <?php if (!empty($wiz_16->hcap_hypo_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus2"><span></span> Bus</label></span>
                        <span class="inline"><input type="checkbox" name="hr2" id="hr2" value="hr2"
                                                    <?php if (!empty($wiz_16->hcap_hypo_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr2"><span></span> HR File</label></span>
                        <div id="chkerror2"></div>
                        <label for="datereview2">Date Reviewed</label>
                        <input type="text" id="datereview2" name="datereview2"  class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_hypo_review)) ? $wiz_16->hcap_hypo_review : ''; ?>"/>

                        <label for="datedist2">Date Distributed</label>
                        <input type="text" id="datedist2" name="datedist2" class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_hypo_dist)) ? $wiz_16->hcap_hypo_dist : ''; ?>">

                    </div>
                </section>
                <!---- Section 3 ----->
                <section>
                    <label for="Allergy">Allergy Plans</label>
                    <span class="inline"><input type="radio" name="planname3" id="planname3"  onclick="showvalue312(this.value)" value="yes"
                                                <?php if (!empty($wiz_16->planname3)) : ?> checked="checked" <?php endif; ?>/> <label for="yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="planname3" id="planname3"
                                                <?php if (empty($wiz_16->planname3)): ?>  checked="checked" <?php endif; ?>onclick="showvalue312(this.value)" value="" /> <label for=""><span></span> No</label></span>
                    <br>
                    <div id="hidename312" style="display: none">
                        <span class="inline"><input type="checkbox" name="teacher3" id="teacher3" value="teacher3"
                                                    <?php if (!empty($wiz_16->hcap_allergy_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher3"><span></span> Teachers</label></span>
                        <span class="inline"><input type="checkbox" name="bus3" id="bus3" value="bus3"
                                                    <?php if (!empty($wiz_16->hcap_allergy_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus3"><span></span> Bus</label></span>
                        <span class="inline"><input type="checkbox" name="hr3" id="hr3" value="hr3"
                                                    <?php if (!empty($wiz_16->hcap_allergy_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr3"><span></span> HR File</label></span>
                        <div id="chkerror3"></div>
                        <label for="datereview3">Date Reviewed</label>
                        <input type="text" id="datereview3" name="datereview3"  class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_allergy_review)) ? $wiz_16->hcap_allergy_review : ''; ?>"/>

                        <label for="datedist3">Date Distributed</label>
                        <input type="text" id="datedist3" name="datedist3" class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_allergy_dist)) ? $wiz_16->hcap_allergy_dist : ''; ?>">

                    </div>
                </section>
                <div style="clear:both"></div>
                <!---- Section 4 ----->
                <section>
                    <label for="hcap_gtube">G-Tube Replacement Plans</label>
                    <span class="inline"><input type="radio" name="planname4" id="planname4"  onclick="showvalue313(this.value)" value="yes"
                                                <?php if (!empty($wiz_16->planname4)) : ?> checked="checked" <?php endif; ?>/> <label for="yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="planname4" id="planname4"
                                                <?php if (empty($wiz_16->planname4)): ?>  checked="checked" <?php endif; ?> onclick="showvalue313(this.value)" value="" /> <label for=""><span></span> No</label></span>
                    <br>
                    <div id="hidename313" style="display: none">
                        <span class="inline"><input type="checkbox" name="teacher4" id="teacher4" value="teacher4"
                                                    <?php if (!empty($wiz_16->hcap_gtube_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher4"><span></span> Teachers</label></span>
                        <span class="inline"><input type="checkbox" name="bus4" id="bus4" value="bus4"
                                                    <?php if (!empty($wiz_16->hcap_gtube_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus4"><span></span> Bus</label></span>
                        <span class="inline"><input type="checkbox" name="hr4" id="hr4" value="hr4"
                                                    <?php if (!empty($wiz_16->hcap_gtube_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr4"><span></span> HR File</label></span>
                        <div id="chkerror4"></div>
                        <label for="datereview4">Date Reviewed</label>
                        <input type="text" id="datereview4" name="datereview4"  class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_gtube_review)) ? $wiz_16->hcap_gtube_review : ''; ?>"/>

                        <label for="datedist4">Date Distributed</label>
                        <input type="text" id="datedist4" name="datedist4" class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_gtube_dist)) ? $wiz_16->hcap_gtube_dist : ''; ?>">

                    </div>
                </section>


                <!---- Section 5 ----->
                <section>
                    <label for="hcap_cardiac">Cardiac Plans</label>
                    <span class="inline"><input type="radio" name="planname5" id="planname5"  onclick="showvalue314(this.value)" value="yes"
                                                <?php if (!empty($wiz_16->planname5)) : ?> checked="checked" <?php endif; ?> /> <label for="yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="planname5" id="planname5"
                                                <?php if (empty($wiz_16->planname5)): ?>  checked="checked" <?php endif; ?> onclick="showvalue314(this.value)" value="" /> <label for=""><span></span> No</label></span>
                    <br>
                    <div id="hidename314" style="display: none">
                        <span class="inline"><input type="checkbox" name="teacher5" id="teacher5" value="teacher5"
                                                    <?php if (!empty($wiz_16->hcap_cardiac_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher5"><span></span> Teachers</label></span>
                        <span class="inline"><input type="checkbox" name="bus5" id="bus5" value="bus5"
                                                    <?php if (!empty($wiz_16->hcap_cardiac_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus5"><span></span> Bus</label></span>
                        <span class="inline"><input type="checkbox" name="hr5" id="hr5" value="hr5"
                                                    <?php if (!empty($wiz_16->hcap_cardiac_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr5"><span></span> HR File</label></span>
                        <div id="chkerror5"></div>
                        <label for="datereview5">Date Reviewed</label>
                        <input type="text" id="datereview5" name="datereview5"
                               value="<?php echo (!empty($wiz_16->hcap_cardiac_review)) ? $wiz_16->hcap_cardiac_review : ''; ?>" class="generate_datepic"/>

                        <label for="datedist5">Date Distributed</label>
                        <input type="text" id="datedist5" name="datedist5" class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_cardiac_dist)) ? $wiz_16->hcap_cardiac_dist : ''; ?>">

                    </div>
                </section>

                <!---- Section 6 ----->

                <section>
                    <label for="hcap_resp">Respiratory Distress Plans</label>
                    <span class="inline"><input type="radio" name="planname6" id="planname6"  onclick="showvalue315(this.value)" value="yes"
                                                <?php if (!empty($wiz_16->planname6)): ?> checked="checked" <?php endif; ?>  /> <label for="yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="planname6" id="planname6"
                                                <?php if (empty($wiz_16->planname6)): ?>  checked="checked" <?php endif; ?>  onclick="showvalue315(this.value)" value="" /> <label for=""><span></span> No</label></span>
                    <br>
                    <div id="hidename315" style="display: none">
                        <span class="inline"><input type="checkbox" name="teacher6" id="teacher6" value="teacher6"
                                                    <?php if (!empty($wiz_16->hcap_resp_teacher)) : ?> checked="checked" <?php endif; ?> /><label for="teacher6"><span></span> Teachers</label></span>
                        <span class="inline"><input type="checkbox" name="bus6" id="bus6" value="bus6"
                                                    <?php if (!empty($wiz_16->hcap_resp_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus6"><span></span> Bus</label></span>
                        <span class="inline"><input type="checkbox" name="hr6" id="hr6" value="hr6"
                                                    <?php if (!empty($wiz_16->hcap_resp_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr6"><span></span> HR File</label></span>
                        <div id="chkerror6"></div>
                        <label for="datereview6">Date Reviewed</label>
                        <input type="text" id="datereview6" name="datereview6"
                               value="<?php echo (!empty($wiz_16->hcap_resp_review)) ? $wiz_16->hcap_resp_review : ''; ?>" class="generate_datepic"/>

                        <label for="datedist6">Date Distributed</label>
                        <input type="text" id="datedist6" name="datedist6" class="generate_datepic"
                               value="<?php echo (!empty($wiz_16->hcap_resp_dist)) ? $wiz_16->hcap_resp_dist : ''; ?>">

                    </div>
                </section>
                <!---- Section 7 ----->
                <div id="sheepItForm1">
                    <div id="sheepItForm1_template" style="border-bottom: dashed #444 0px;">
                        <section>
                            <label for="hcap_emer#index#">Emergency Exit Plans</label>
                            <div id="hideemer#index#">
                                <label for="hcap_emer">Plan Name
                                    <a id="sheepItForm1_remove_current">
                                        <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                    </a>
                                </label>
                                <input type="text" id="sheepItForm1_#index#_newplanname"  name="sheepItForm1_newplanname[#index#]" required="required" class="agency"/>
                            </div>
                            <span class="inline"><input type="radio" name="sheepItForm1_#index#_seizure_planname7" id="sheepItForm1_#index#_seizure_planname7"  onclick="showvalue316(this.value, '#index#')" value="yes" /> <label for="sheepItForm1_#index#_seizure_plan7"><span></span> Yes</label></span>
                            <span class="inline"><input type="radio" name="sheepItForm1_#index#_seizure_planname7" id="sheepItForm1_#index#_seizure_planname8" checked="checked"  onclick="showvalue316(this.value, '#index#')" value=""  /> <label for="sheepItForm1_#index#_seizure_plan8"><span></span> No</label></span>
                            <br>
                            <div id="hidename316_#index#" style="display: none">
                                <span class="inline"><input type="checkbox" name="sheepItForm1_#index#_hcap_emer_teacher" id="sheepItForm1_#index#_hcap_emer_teacher" value="Teachers" /><label for="sheepItForm1_#index#_hcap_emer_teacher"><span></span> Teachers</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm1_#index#_hcap_emer_bus" id="sheepItForm1_#index#_hcap_emer_bus" value="Bus" /><label for="sheepItForm1_#index#_hcap_emer_bus"><span></span> Bus</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm1_#index#_hcap_emer_hr" id="sheepItForm1_#index#_hcap_emer_hr" value="HR File"/><label for="sheepItForm1_#index#_hcap_emer_hr"><span></span> HR File</label></span>
                                <div id="newplanerror#index#"></div>
                                <label for="hcap_emer_review">Date Reviewed</label>
                                <input type="text" id="sheepItForm1_#index#_hcap_emer_review" name="sheepItForm1_hcap_emer_review[#index#]" required="required" class="generate_datepic agency"/>

                                <label for="hcap_emer_dist">Date Distributed</label>
                                <input type="text" id="sheepItForm1_#index#_hcap_emer_dist"  name="sheepItForm1_hcap_emer_dist[#index#]" required="required" class="generate_datepic agency"/>


                            </div>
                        </section>

                    </div>

                    <!-- No forms template -->
                    <div id="sheepItForm1_noforms_template">No Emergency plan</div>
                    <!-- /No forms template-->
                </div>
                <!--- Add more Treatments button here----->
                <!-- Controls -->
                <div id="sheepItForm1_controls">
                    <div id="sheepItForm1_add"><a class="addnew-button" href="javascript:addNewEmergency()" style="text-decoration:none;margin-bottom: 10px;">Add New Emergency Action Plan</a></div>
                </div>


            </div>

        </fieldset>
        <div style="clear: both"></div>
        <fieldset class="new_section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(19)" id="hide19"  name="hide19"  value = "on" <?php echo!empty($wiz_16->hide19) ? ' checked ' : '' ?> /> <label for="hide19"><span></span>No needs at this time</label></span>
            <legend class="legends">Needs for School Attendance</legend>
            <div class="hide19">
                <fieldset class="twocol">
                    <section>
                        <label for="delegatable">Delegatable Nursing Services During the School Day <span class="tiny">(Please list)</span></label>
                        <textarea id="delegatable" name="delegatable"><?php echo $wiz_16->delegatable ?></textarea>
                    </section>
                    <section>
                        <label for="non_delegatable">Non-Delegatable Nursing Services During the School Day <span class="tiny">(Please list)</span></label>
                        <textarea id="non_delegatable" name="non_delegatable"><?php echo $wiz_16->non_delegatable ?></textarea>
                    </section>
                </fieldset>
                <fieldset class="twocol">
                    <section>
                        <label for="parents_provide">Parents Will Provide</label>
                        <textarea id="parents_provide" name="parents_provide"><?php echo $wiz_16->parents_provide ?></textarea>
                        <input type="hidden" name="completed" id="completed" value="1">
                    </section>
                    <section>
                        <label for="school_provide">School Will Provide</label>
                        <textarea id="school_provide" name="school_provide"><?php echo $wiz_16->school_provide ?></textarea>
                    </section>
                </fieldset>
            </div>
        </fieldset>
        <?php
        // echo "<pre>";
        // print_r($wiz_16);
        ?>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(115)" id="hide115"  name="hide115"  value = "on" <?php echo!empty($wiz_16->hide115) ? ' checked ' : '' ?> /> <label for="hide115" style="margin-right: 9px;"><span></span>No needs at this time</label></span>
            <legend  style="margin-top: -37px;">Individualized Healthcare Plan</legend>
            <div class="hide115" style="margin-left: 10px;">
                <label for="ihp">IHP?</label>
                <span class="inline"><input type="radio" name="ihp" id="ihp" value="yes" onclick="showvals(this)" <?php echo ($wiz_16->ihp == 'yes') ? 'checked' : '' ?> /><label for="ihp-yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="ihp" id="ihp" value="no" onclick="showvals(this)"  <?php echo empty($wiz_16->ihp) ? 'checked' : '' ?> /><label for="ihp-no"><span></span> No</label></span>
                <span class="inline"><input type="radio" name="ihp" id="ihp" value="ip" onclick="showvals(this)"  <?php echo ($wiz_16->ihp == 'ip') ? 'checked' : '' ?>/><label for="ihp-ip"><span></span> In Progress</label></span>

                <div class="ihps">
                    <p class="note">If Yes, please see Individualized Healthcare Plan</p>
                </div>
            </div>


        </fieldset>

        <!--        <fieldset>
                    <section class="buttons" >
                        <div class="savebuttons  float-left1">
        <?php /* $sif = array('name' => 'sif', 'type' => 'hidden'); ?><br/>
          <?= form_input($sif, set_value("sif", $sif_num)); ?>
          <?= $link_back; ?>
          <?php
          if (!empty($wiz_16->sif) && $status['wizard_status'] == 25 && $userrole->level == 50): echo form_submit($attr_FormSave_reassessment);
          endif;
          ?>
          <?= form_submit($attr_FormSubmit_assessment); ?>
          <?= form_close(); */ ?>

                        </div>
                    </section>-->
        </fieldset>
        <fieldset>
            <section class="buttons" >
                <div class="nextbutton">
                    <?= $link_back; ?>
                    <?= form_submit($attr_FormSubmit_assessment); ?>
                </div>
                <div class="savebuttons  float-left">
                    <?php $sif = array('name' => 'sif', 'type' => 'hidden'); ?>
                    <?= form_input($sif, set_value("sif", $sif_num)); ?>
                    <?php
                    if (!empty($wiz_16->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>

                    <?= form_submit($attr_FormSave_assessment); ?>
                    <?= form_close(); ?>
                </div>
            </section>
        </fieldset>
    </section>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        //Checkbox validation 1
        $('#assessment16').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#assessment16').val();
            var $planname1 = $('input[name=planname1]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="teacher1"]:checked');
            var $fields2 = $(this).find('input[name="bus1"]:checked');
            var $fields3 = $(this).find('input[name="hr1"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk').remove();
                $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk').remove();
                return true;
            }
        });
        //Checkbox validation 2
        $('#assessment16').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#assessment16').val();
            var $planname1 = $('input[name=planname2]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="teacher2"]:checked');
            var $fields2 = $(this).find('input[name="bus2"]:checked');
            var $fields3 = $(this).find('input[name="hr2"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk2').remove();
                $('#chkerror2').append("<span class='errorchk2'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk2').remove();
                return true;
            }
        });
        //Checkbox validation 3
        $('#assessment16').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#assessment16').val();
            var $planname1 = $('input[name=planname3]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="teacher3"]:checked');
            var $fields2 = $(this).find('input[name="bus3"]:checked');
            var $fields3 = $(this).find('input[name="hr3"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk3').remove();
                $('#chkerror3').append("<span class='errorchk3'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk3').remove();
                return true;
            }
        });
        //Checkbox validation 4
        $('#assessment16').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#assessment16').val();
            var $planname1 = $('input[name=planname4]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="teacher4"]:checked');
            var $fields2 = $(this).find('input[name="bus4"]:checked');
            var $fields3 = $(this).find('input[name="hr4"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk4').remove();
                $('#chkerror4').append("<span class='errorchk4'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk4').remove();
                return true;
            }
        });
        //Checkbox validation 5
        $('#assessment16').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#assessment16').val();
            var $planname1 = $('input[name=planname5]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="teacher5"]:checked');
            var $fields2 = $(this).find('input[name="bus5"]:checked');
            var $fields3 = $(this).find('input[name="hr5"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk5').remove();
                $('#chkerror5').append("<span class='errorchk5'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk5').remove();
                return true;
            }
        });
        //Checkbox validation 6
        $('#assessment16').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#assessment16').val();
            var $planname1 = $('input[name=planname6]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="teacher6"]:checked');
            var $fields2 = $(this).find('input[name="bus6"]:checked');
            var $fields3 = $(this).find('input[name="hr6"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk6').remove();
                $('#chkerror6').append("<span class='errorchk6'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk6').remove();
                return true;
            }
        });
        //Checkbox validation 7
        $('#assessment16').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#assessment16').val();
            var $planname1 = $('input[name=sheepItForm1_0_seizure_planname7]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_0_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_0_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_0_hcap_emer_hr"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk7').remove();
                $('#newplanerror0').append("<span class='errorchk7'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk7').remove();
                return true;
            }
        });

        $('#assessment16').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#assessment16').val());
            var $planname1 = $('input[name=sheepItForm1_1_seizure_planname7]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_1_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_1_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_1_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk9').remove();
                $('#newplanerror1').append("<span class='errorchk9'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk9').remove();
                return true;
            }
        });
        $('#assessment16').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#assessment16').val());
            var $planname1 = $('input[name=sheepItForm1_2_seizure_planname7]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_2_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_2_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_2_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk10').remove();
                $('#newplanerror2').append("<span class='errorchk10'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk10').remove();
                return true;
            }
        });
        $('#assessment16').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#assessment16').val());
            var $planname1 = $('input[name=sheepItForm1_3_seizure_planname7]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_3_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_3_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_3_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk11').remove();
                $('#newplanerror3').append("<span class='errorchk11'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk11').remove();
                return true;
            }
        });
        $('#assessment16').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#assessment16').val());
            var $planname1 = $('input[name=sheepItForm1_4_seizure_planname7]:checked', '#assessment16').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_4_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_4_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_4_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk12').remove();
                $('#newplanerror4').append("<span class='errorchk12'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk12').remove();
                return true;
            }
        });









        $('#assessment16').submit(function() {
            //form validation for clone
            $('generate_datepic agency.agency').each(function() {
                if (!$.trim($(this).val()).length) {
                    return false; // or e.preventDefault();
                }
            });
        });
        //Autosave
        setInterval(function() {
            var queryString = $('#assessment16').serialize();
            //alert(queryString);
            var baseurl = '<?php echo base_url(); ?>';
            //alert(baseurl);
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end


        // Add more emergency plan here
        var sheepItForm1 = $('#sheepItForm1').sheepIt({
            separator: '',
            allowRemoveLast: true,
            allowRemoveCurrent: true,
            allowRemoveAll: true,
            allowAdd: true,
            allowAddN: true,
            maxFormsCount: 10,
            minFormsCount: 1,
            iniFormsCount: <?php
                    if (count($wiz_16->planname7) > 1) {
                        echo count($wiz_16->planname7);
                    } else {
                        echo "1";
                    }
                    ?>, afterAdd: function(source, newForm) {



                $('label[for="hcap_emer1"]').hide();
                $('label[for="hcap_emer2"]').hide();
                $('label[for="hcap_emer3"]').hide();
                $('label[for="hcap_emer4"]').hide();
                $('label[for="hcap_emer5"]').hide();
                $('label[for="hcap_emer6"]').hide();
                $('label[for="hcap_emer7"]').hide();
                $('.generate_datepic').each(function(i, e) {

//                                $(e).datepicker("destroy");
//                                $(e).datepicker();
                });

            }, afterRemoveCurrent: function(source) {
                $('.generate_datepic').each(function(i, e) {
//                                $(e).datepicker("destroy");
//                                $(e).datepicker();
                });
            }

        });


//Date7
<?php
foreach ($wiz_16->hcap_emer_review as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_hcap_emer_review').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wiz_16->hcap_emer_dist as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_hcap_emer_dist').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wiz_16->newplanname as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_newplanname').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>

//sheepItForm1_0_seizure_plan7
        //Edit option data brings
<?php
for ($i = 0; $i < count($wiz_16->planname7); $i++) {
//Date7
    if ($wiz_16->planname7[$i] == 'yes') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_seizure_planname7').prop('checked', 'true');
        <?php
    }
    if ($wiz_16->planname7[$i] == '') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_seizure_planname8').prop('checked', 'true');
        <?php
    }
    if ($wiz_16->hcap_emer_teacher[$i] == 'Teachers') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_hcap_emer_teacher').prop('checked', 'true');
        <?php
    }
    if ($wiz_16->hcap_emer_bus[$i] == 'Bus') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_hcap_emer_bus').prop('checked', 'true');
        <?php
    }
    if ($wiz_16->hcap_emer_hr[$i] == 'HR File') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_hcap_emer_hr').prop('checked', 'true');
        <?php
    }
}
?>
//Add health care plan more
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
$count = count($diagnosis_array);
if ($count > 1) {
    echo $count;
} else {
    echo "1";
}
?>


        });


<?php
if (!empty($diagnosis_array)):
    foreach ($diagnosis_array as $key => $val) {
        ?>
                $('#sheepItForm_<?php echo $key; ?>_diagnosis').val(<?php echo $this->db->escape($val); ?>);
    <?php } endif;
?>

    });

</script>