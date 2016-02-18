<style>
    select{
        width:auto!important;
    }
    .errorchk{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
    .errorchk2,.errorchk7,.errorchk8,.errorchk9{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
    .req_question{

    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment11', 'name' => 'assessment11', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment11', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment11", 'class' => "healthform");
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
if (empty($wiz_11->sif)):
    $wiz_11 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_11->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_11->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_11">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_11->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;   ?></div>
        <?php endif; ?>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(122)" id="hide122"  name="hide122"  value="on" <?php echo!empty($wiz_11->hide122) ? ' checked ' : '' ?> /> <label for="hide122"><span></span>No needs at this time</label></span>
            <legend>Respiratory - Oxygen/Tracheostomy/Ventilation Requirements</legend>
            <div class="hide122">
                <fieldset class="twocol">
                    <section>
                        <label for="resp-assess">Respiratory Assessment</label>
                        <span><input type="checkbox" name="resp_assess_continuous" class="req_question" id="resp_assess_continuous" value="Continuous"   <?php echo!empty($wiz_11->resp_assess_continuous) ? ' checked ' : '' ?>/><label for="resp_assess_continuous"><span></span> Continuous</label></span>
                        <span><input type="checkbox" name="resp_assess_intermittant" class="req_question" id="resp_assess_intermittant" value="Intermittant/As Needed"   <?php echo!empty($wiz_11->resp_assess_intermittant) ? ' checked ' : '' ?> /><label for="resp_assess_intermittant"><span></span> Intermittant/As Needed</label></span>
                        <span><input type="checkbox" name="resp_assess_signal" id="resp_assess_signal"  class="req_question" value="Student Communicates/Signals Need"   <?php echo!empty($wiz_11->resp_assess_signal) ? ' checked ' : '' ?> /><label for="resp_assess_signal"><span></span> Student Communicates/Signals Need</label></span>
                        <div id="chkerror2"></div>
                        <label for="baseline-assess">Baseline Respiratory Assessment</label>
                        <textarea id="baseline_assess" name="baseline_assess"><?php echo $wiz_11->baseline_assess ?></textarea>

                        <label for="distress-sign">Signs/Symptoms of Respiratory Distress</label>
                        <textarea id="distress_sign" name="distress_sign"><?php echo $wiz_11->distress_sign ?></textarea>
                    </section>
                    <section>
                        <label for="ventilation">Mechanical Ventilation?</label>
                        <span class="inline"><input type="radio" name="ventilation" id="ventilation" value="" checked="checked" /><label for="ventilation-none"><span></span> None</label></span>
                        <span class="inline"><input type="radio" name="ventilation" id="ventilation" value="CPAP" <?php echo ($wiz_11->ventilation == 'CPAP') ? ' checked ' : '' ?> /><label for="ventilation-cpap"><span></span> CPAP</label></span>
                        <span class="inline"><input type="radio" name="ventilation" id="ventilation" value="BIPAP" <?php echo ($wiz_11->ventilation == 'BIPAP') ? ' checked ' : '' ?> /><label for="ventilation-bipap"><span></span> BIPAP</label></span>

                        <label for="where">Ventilation Needed</label>
                        <span class="inline"><input type="checkbox" name="where_home" id="where_home" value="Home"   <?php echo!empty($wiz_11->where_home) ? ' checked ' : '' ?> /><label for="where_home"><span></span> Home</label></span>
                        <span class="inline"><input type="checkbox" name="where_school" id="where_school" value="School"   <?php echo!empty($wiz_11->where_school) ? ' checked ' : '' ?> /><label for="where_school"><span></span> School</label></span>
                        <span class="inline"><input type="checkbox" name="where_sleep" id="where_sleep" value="Sleep"   <?php echo!empty($wiz_11->where_sleep) ? ' checked ' : '' ?> /><label for="where_sleep"><span></span> Sleep</label></span>
                        <span class="inline"><input type="checkbox" name="where_as_needed" id="where_as_needed" value="As Needed Per Orders"   <?php echo!empty($wiz_11->where_as_needed) ? ' checked ' : '' ?> /><label for="where_as_needed"><span></span> As Needed</label></span>
                        <label for="vent-depend">Ventilator Dependent?</label>
                        <span class="inline"><input type="checkbox" name="vent_depend_dependent" onclick="showvalue13()" id="vent_depend_dependent" value="Ventilator Dependent"   <?php echo!empty($wiz_11->vent_depend_dependent) ? ' checked ' : '' ?> /><label for="vent_depend_dependent"><span></span> Ventilator Dependent</label></span>
                        <span class="inline"><input type="checkbox" name="vent_depend_assist" id="vent_depend_assist" onclick="showvalue13()" value="Ventilator Assist"   <?php echo!empty($wiz_11->vent_depend_assist) ? ' checked ' : '' ?> /><label for="vent_depend_assist"><span></span> Ventilator Assist</label></span>
                        <div id="divval13" style="display: none">
                            <label for="vent-assist">If Vent Assist, how long can student be off vent?</label>
                            <input type="text" id="vent_assist" name="vent_assist" value="<?php echo $wiz_11->vent_assist ?>"  />
                        </div>
                        <label for="vent_set">Ventilator Settings</label>
                        <input type="text" id="vent_set"  name="vent_set" value="<?php echo $wiz_11->vent_set ?>"  />

                        <label for="vent_co">Ventilator Company</label>
                        <input type="text" id="vent_co" name="vent_co" value="<?php echo $wiz_11->vent_co ?>"  />

                        <label for="vent_contact">Contact Information</label>
                        <input type="text" id="vent_contact" name="vent_contact" value="<?php echo $wiz_11->vent_contact ?>"  />
                    </section>
                </fieldset>
                <section>
                    <label for="oxygen">Oxygen</label>
                    <span class="inline"><input type="checkbox" name="oxygen_cont" id="oxygen_cont" value="yes"   <?php echo!empty($wiz_11->oxygen_cont) ? ' checked ' : '' ?> /><label for="oxygen_cont"><span></span> Continous</label></span>
                    <span class="inline"><input type="checkbox" name="oxygen_inter" id="oxygen_inter" value="yes"   <?php echo!empty($wiz_11->oxygen_inter) ? ' checked ' : '' ?> /><label for="oxygen_inter"><span></span> Intermittent</label></span>

                    <label for="oximetry">Oximetry</label>
                    <span class="inline"><input type="radio" name="oximetry" id="oximetry" onclick="showvalue301(this.value)" value="yes" <?php echo!empty($wiz_11->oximetry) ? ' checked ' : '' ?> /><label for="oximetry"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="oximetry" id="oximetry" onclick="showvalue301(this.value)" value="" <?php echo empty($wiz_11->oximetry) ? ' checked ' : '' ?>  /><label for="oximetry"><span></span> No</label></span>
                    <div id="hidename301">
                        <label for="ox-freq">Frequency</label>
                        <input type="text" id="ox_freq" name="ox_freq" value="<?php echo $wiz_11->ox_freq ?>" />

                        <label for="ox-param">Parameters</label>
                        <input type="text" id="ox_param" name="ox_param"  value="<?php echo $wiz_11->ox_param ?>" />
                    </div>
                </section>
                <section>
                    <label for="ox-route">Oxygen Route</label>
                    <span><input type="checkbox" name="ox_route_nasal" id="ox_route_nasal" value="yes"   <?php echo!empty($wiz_11->ox_route_nasal) ? ' checked ' : '' ?> /><label for="ox_route_nasal"><span></span> Nasal Cannula</label></span>
                    <span><input type="checkbox" name="ox_route_trach" id="ox_route_trach" value="yes"   <?php echo!empty($wiz_11->ox_route_trach) ? ' checked ' : '' ?> /><label for="ox_route_trach"><span></span> Tracheotomy</label></span>
                    <span><input type="checkbox" name="ox_route_mask" id="ox_route_mask" value="yes"   <?php echo!empty($wiz_11->ox_route_mask) ? ' checked ' : '' ?> /><label for="ox_route_mask"><span></span> Mask/Non-Rebreather</label></span>

                    <label for="ox-source">Oxygen Source</label>
                    <span><input type="checkbox" name="ox_source_tank" id="ox_source_tank" value="yes"   <?php echo!empty($wiz_11->ox_source_tank) ? ' checked ' : '' ?> /><label for="ox_source_tank"><span></span> Tank</label></span>
                    <span><input type="checkbox" name="ox_source_liquid" id="ox_source_liquid" value="yes"   <?php echo!empty($wiz_11->ox_source_liquid) ? ' checked ' : '' ?> /><label for="ox_source_liquid"><span></span> Liquid</label></span>
                    <span><input type="checkbox" name="ox_source_concentrator" id="ox_source_concentrator" value="yes"   <?php echo!empty($wiz_11->ox_source_concentrator) ? ' checked ' : '' ?> /><label for="ox_source_concentrator"><span></span> Concentrator</label></span>

                </section>
                <section>
                    <label for="trach-size">Trach Size</label>
                    <input type="text" id="trach_size" name="trach_size"  value="<?php echo $wiz_11->trach_size ?>" />

                    <label for="cuffed">Cuffed?</label>
                    <span class="inline"><input type="radio" name="cuffed" id="cuffed" value="yes" <?php echo!empty($wiz_11->cuffed) ? ' checked ' : '' ?> /><label for="cuffed"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="cuffed" id="cuffed" value="" <?php echo empty($wiz_11->cuffed) ? ' checked ' : '' ?> /><label for="cuffed"><span></span> No</label></span>

                    <label for="thermo">Thermo-Vent?</label>
                    <span class="inline"><input type="radio" name="thermo" id="thermo" value="yes" <?php echo!empty($wiz_11->thermo) ? ' checked ' : '' ?> /><label for="thermo"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="thermo" id="thermo" value="" <?php echo empty($wiz_11->thermo) ? ' checked ' : '' ?> /><label for="thermo"><span></span> No</label></span>

                    <label for="muir">Passy Muir?</label>
                    <span class="inline"><input type="radio" name="muir" id="muir" value="yes" <?php echo!empty($wiz_11->muir) ? ' checked ' : '' ?> /><label for="muir"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="muir" id="muir" value="" <?php echo empty($wiz_11->muir) ? ' checked ' : '' ?>  /><label for="muir"><span></span> No</label></span>
                </section>
                <fieldset class="twocol clear">
                    <section>
                        <label for="co2">CO2 Monitor?</label>
                        <span class="inline"><input type="radio" name="co2" id="co2" onclick="showvalue302(this.value)" value="yes" <?php echo!empty($wiz_11->co2) ? ' checked ' : '' ?> /><label for="co2"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="co2" id="co2" onclick="showvalue302(this.value)" value=""  <?php echo empty($wiz_11->co2) ? ' checked ' : '' ?> /><label for="co2"><span></span> No</label></span>
                        <div id="hidename302">
                            <label for="co2-freq">Frequency</label>
                            <input type="text" id="co2_freq" name="co2_freq" value="<?php echo $wiz_11->co2_freq ?>" />

                            <label for="co2-param">Parameters</label>
                            <input type="text" id="co2_param" name="co2_param" value="<?php echo $wiz_11->co2_param ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="addtnl-vent">Additional Ventilator Information (Heated or Humidified, Plugged in or batteries, Is equipment portable, etc.)</label>
                        <textarea id="addtnl_vent" name="addtnl_vent"><?php echo $wiz_11->addtnl_vent ?></textarea>
                    </section>
                </fieldset>
                <fieldset class="threecol clear">
                    <section>
                        <label for="suction">Suctioning?</label>
                        <span class="inline"><input type="radio" name="suction" id="suction" onclick="showvalue338(this.value)" value="yes" <?php echo!empty($wiz_11->suction) ? ' checked ' : '' ?> /><label for="suction-yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="suction" id="suction" onclick="showvalue338(this.value)" value="" <?php echo empty($wiz_11->suction) ? ' checked ' : '' ?> /><label for="suction-no"><span></span> No</label></span>
                        <!--<span><input type="checkbox" name="suction_drain" id="suction_drain" value="yes" <?php //echo !empty($wiz_11->suction_drain)? ' checked ':''                    ?> /><label for="suction_drain"><span></span> Postural Drainage</label></span>-->
                        <div id="hidename338">
                            <label for="trach-type">Type</label>
                            <span><input type="checkbox" name="trach_type_o" id="trach_type_o" onchange="typechecked1()" value="Oropharyngeal" <?= !empty($wiz_11->{'trach_type_o'}) ? ' checked ' : ''; ?> /><label for="trach_type_o"><span></span> Oropharyngeal</label></span>
                            <!----- Type 1 --->
                            <div id="suctiontype1">
                                <label for="cath">Catheter Type</label>
                                <span class="inline"><input type="checkbox" name="cath_y" id="cath_y" value="Yankauer Catheter" <?= !empty($wiz_11->{'cath_y'}) ? ' checked ' : ''; ?> /><label for="cath_y"><span></span> Yankauer Catheter</label></span><br>
                                <span class="inline"><input type="checkbox" name="cath_f" id="cath_f" value="Flexible Catheter" <?= !empty($wiz_11->{'cath_f'}) ? ' checked ' : ''; ?> /><label for="cath_f"><span></span> Flexible Catheter</label></span>
                                <div id="oerror"></div>
                                <label for="cath_size">Catheter Size</label>
                                <input type="text" id="cath_size" name="cath_size" value="<?= !empty($wiz_11->cath_size) ? $wiz_11->cath_size : ''; ?>" />

                                <label for="cath_freq">Frequency</label>
                                <input type="text" id="cath_freq" name="cath_freq" value="<?= !empty($wiz_11->cath_freq) ? $wiz_11->cath_freq : ''; ?>" />

                                <label for="cath_color">Color of Secretions</label>
                                <input type="text" id="cath_color" name="cath_color" value="<?= !empty($wiz_11->cath_color) ? $wiz_11->cath_color : ''; ?>" />

                                <label for="suction_equip">Equipment needed for suctioning</label>
                                <textarea id="suction_equip" name="suction_equip" ><?= !empty($wiz_11->suction_equip) ? $wiz_11->suction_equip : ''; ?></textarea>
                            </div>

                            <span><input type="checkbox" name="trach_type_n" id="trach_type_n" onchange="typechecked1()" value="Nasopharyngeal" <?= !empty($wiz_11->{'trach_type_n'}) ? ' checked ' : ''; ?> /><label for="trach_type_n"><span></span> Nasopharyngeal</label></span>
                            <!----- Type 2 --->
                            <div id="suctiontype2">
                                <label for="cath">Catheter Type</label>
                                <span class="inline"><input type="checkbox" name="cath_y2" id="cath_y2" value="Yankauer Catheter" <?= !empty($wiz_11->{'cath_y2'}) ? ' checked ' : ''; ?> /><label for="cath_y2"><span></span> Yankauer Catheter</label></span><br>
                                <span class="inline"><input type="checkbox" name="cath_f2" id="cath_f2" value="Flexible Catheter" <?= !empty($wiz_11->{'cath_f2'}) ? ' checked ' : ''; ?> /><label for="cath_f2"><span></span> Flexible Catheter</label></span>
                                <div id="nerror"></div>
                                <label for="cath_size">Catheter Size</label>
                                <input type="text" id="cath_size2" name="cath_size2" value="<?= !empty($wiz_11->cath_size2) ? $wiz_11->cath_size2 : ''; ?>" />

                                <label for="cath_freq">Frequency</label>
                                <input type="text" id="cath_freq2" name="cath_freq2" value="<?= !empty($wiz_11->cath_freq2) ? $wiz_11->cath_freq2 : ''; ?>" />

                                <label for="cath_color">Color of Secretions</label>
                                <input type="text" id="cath_color2" name="cath_color2" value="<?= !empty($wiz_11->cath_color2) ? $wiz_11->cath_color2 : ''; ?>" />

                                <label for="suction_equip">Equipment needed for suctioning</label>
                                <textarea id="suction_equip2" name="suction_equip2" ><?= !empty($wiz_11->suction_equip2) ? $wiz_11->suction_equip2 : ''; ?></textarea>
                            </div>

                            <span><input type="checkbox" name="trach_type_e" id="trach_type_e" onchange="typechecked1()" value="Endotracheal" <?= !empty($wiz_11->{'trach_type_e'}) ? ' checked ' : ''; ?> /><label for="trach_type_e"><span></span> Endotracheal</label></span>
                            <!----- Type 3 --->
                            <div id="suctiontype3">
                                <label for="cath">Catheter Type</label>
                                <span class="inline"><input type="checkbox" name="cath_y3" id="cath_y3" value="Yankauer Catheter3" <?= !empty($wiz_11->{'cath_y3'}) ? ' checked ' : ''; ?> /><label for="cath_y3"><span></span> Yankauer Catheter</label></span><br>
                                <span class="inline"><input type="checkbox" name="cath_f3" id="cath_f3" value="Flexible Catheter3" <?= !empty($wiz_11->{'cath_f3'}) ? ' checked ' : ''; ?> /><label for="cath_f3"><span></span> Flexible Catheter</label></span>
                                <div id="eerror"></div>
                                <label for="cath_size">Catheter Size</label>
                                <input type="text" id="cath_size3" name="cath_size3" value="<?= !empty($wiz_11->cath_size3) ? $wiz_11->cath_size3 : ''; ?>" />

                                <label for="cath_freq">Frequency</label>
                                <input type="text" id="cath_freq3" name="cath_freq3" value="<?= !empty($wiz_11->cath_freq3) ? $wiz_11->cath_freq3 : ''; ?>" />

                                <label for="cath_color">Color of Secretions</label>
                                <input type="text" id="cath_color3" name="cath_color3" value="<?= !empty($wiz_11->cath_color3) ? $wiz_11->cath_color3 : ''; ?>" />

                                <label for="suction_equip">Equipment needed for suctioning</label>
                                <textarea id="suction_equip3" name="suction_equip3" ><?= !empty($wiz_11->suction_equip3) ? $wiz_11->suction_equip3 : ''; ?></textarea>
                            </div>


                            <div id="chkerror"></div>
                        </div>
                    </section>

                    <fieldset class="twocol clear">
                        <section>
                            <label for="other_equip">Other Equipment Needed for School</label>
                            <textarea id="other_equip" name="other_equip"><?= !empty($wiz_11->other_equip) ? $wiz_11->other_equip : ''; ?> </textarea>

                            <label for="equip_check">Equipment Checklist Utilized?</label>
                            <span class="inline"><input type="radio" name="equip_check" id="equip_check_yes" value="Yes" <?= !empty($wiz_11->{'equip_check'}) ? ' checked ' : ''; ?> /><label for="equip_check_yes"><span></span> Yes</label></span>
                            <span class="inline"><input type="radio" name="equip_check" id="equip_check_no" value="" <?= empty($wiz_11->{'equip_check'}) ? ' checked ' : ''; ?> /><label for="equip_check_no"><span></span> No</label></span>

                        </section>
                        <section>
                            <label for="evac">Evacuation/Emergency Instructions</label>
                            <textarea id="evac" name="evac" ><?= !empty($wiz_11->evac) ? $wiz_11->evac : ''; ?></textarea>
                        </section>
                    </fieldset>
                    <fieldset>
                        <section class="largetext">
                            <label for="oxy_addntl">Additional Comments</label>
                            <textarea id="oxy_addtnl" name="oxy_addtnl"> <?= !empty($wiz_11->oxy_addtnl) ? $wiz_11->oxy_addtnl : ''; ?></textarea>
                        </section>
                    </fieldset>
            </div>
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
                    if (!empty($wiz_11->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_11->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
                    endif;
                    ?>
                    <?= form_submit($attr_FormSave_assessment); ?>
                    <?= form_close(); ?>
                </div>
            </section>
        </fieldset>
</div>

<script type="text/javascript">
    function typechecked1()
    {
        if ($('#trach_type_o').is(":checked"))
            $("#suctiontype1").show();
        else
            $("#suctiontype1").hide();
        //Tyep2
        if ($('#trach_type_n').is(":checked"))
            $("#suctiontype2").show();
        else
            $("#suctiontype2").hide();
        //Tyep3
        if ($('#trach_type_e').is(":checked"))
            $("#suctiontype3").show();
        else
            $("#suctiontype3").hide();
    }
    $(document).ready(function() {
        $('#assessment11').submit(function() {
            var $suction = $('input[name=suction]:checked', '#assessment11').val();
            var $fields1 = $(this).find('input[name="trach_type_o"]:checked');
            var $fields2 = $(this).find('input[name="trach_type_n"]:checked');
            var $fields3 = $(this).find('input[name="trach_type_e"]:checked');
            if ($suction == "yes" && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk').remove();
                $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one type" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk').remove();
                return true;
            }
        });
        //Validation for Respiratory Assessment Oropharyngeal
        $('#assessment11').submit(function() {
            if ($('input[name=trach_type_o]:checked', '#assessment11').val() == 'Oropharyngeal') {
                var ckbox = ($('input[name=hide122]:checked', '#assessment11').val());
                var $suction = $('input[name=suction]:checked', '#assessment11').val();
                var $fields1 = $(this).find('input[name="cath_y"]:checked');
                var $fields2 = $(this).find('input[name="cath_f"]:checked');
                var $fields3 = $(this).find('input[name="trach_type_o"]:checked');
                if ($suction == "yes" && ckbox != 'on' && !$fields3.lendth && $fields1.length == 0 && $fields2.length == 0) {
                    $('.errorchk7').remove();
                    $('#oerror').append("<span class='errorchk7'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk7').remove();
                    return true;
                }
            }
        });
        //Validation for Respiratory Assessment Nasopharyngeal
        $('#assessment11').submit(function() {
            if ($('input[name=trach_type_n]:checked', '#assessment11').val() == 'Nasopharyngeal') {
                var ckbox = ($('input[name=hide122]:checked', '#assessment11').val());
                var $suction = $('input[name=suction]:checked', '#assessment11').val();
                var $fields1 = $(this).find('input[name="cath_y2"]:checked');
                var $fields2 = $(this).find('input[name="cath_f2"]:checked');
                var $fields3 = $(this).find('input[name="trach_type_n"]:checked');
                if ($suction == "yes" && ckbox != 'on' && !$fields3.lendth && $fields1.length == 0 && $fields2.length == 0) {
                    $('.errorchk8').remove();
                    $('#nerror').append("<span class='errorchk8'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk8').remove();
                    return true;
                }
            }
        });
        //Validation for Respiratory Assessment Endotracheal
        $('#assessment11').submit(function() {
            if ($('input[name=trach_type_e]:checked', '#assessment11').val() == 'Endotracheal') {
                var ckbox = ($('input[name=hide122]:checked', '#assessment11').val());
                var $suction = $('input[name=suction]:checked', '#assessment11').val();
                var $fields1 = $(this).find('input[name="cath_y3"]:checked');
                var $fields2 = $(this).find('input[name="cath_f3"]:checked');
                var $fields3 = $(this).find('input[name="trach_type_e"]:checked');
                if ($suction == "yes" && ckbox != 'on' && !$fields3.lendth && $fields1.length == 0 && $fields2.length == 0) {
                    $('.errorchk9').remove();
                    $('#eerror').append("<span class='errorchk9'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk9').remove();
                    return true;
                }
            }
        });


        $('#assessment11').submit(function() {

            var ckbox = ($('input[name=hide122]:checked', '#assessment11').val());
            var $fields6 = $(this).find('input[name="resp_assess_continuous"]:checked');
            var $fields4 = $(this).find('input[name="resp_assess_intermittant"]:checked');
            var $fields5 = $(this).find('input[name="resp_assess_signal"]:checked');
            if (ckbox != 'on' && !$fields6.length && !$fields4.length && !$fields5.length) {
                $('.errorchk2').remove();
                $('#chkerror2').append("<span class='errorchk2'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk2').remove();
                return true;
            }

        });
//Second form
        //Autosave
        setInterval(function() {
            var queryString = $('#assessment11').serialize();
            var baseurl = '<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end
        var depend_assistchkbox = $('#vent_depend_assist').val();
        if (depend_assistchkbox == 'Ventilator Assist') {
            showvalue13();
        }
    });
</script>