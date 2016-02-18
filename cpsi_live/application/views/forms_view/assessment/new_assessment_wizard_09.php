<style>
    select{
        width:auto!important;
    }
    .errorchk15,.errorchk16,.errorchk17,.errorchk18{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment9', 'name' => 'assessment9', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment9', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment9", 'class' => "healthform");
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
if (empty($wiz_09->sif)):
    $wiz_09 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_09->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_09->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_9">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_09->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;   ?></div>
        <?php endif; ?>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(11)" id="hide11" name="hide11" value="on" <?php echo!empty($wiz_09->hide11) ? ' checked ' : '' ?> /> <label for="hide11"><span></span>No needs at this time</label></span>
            <legend>Respiratory Requirements</legend>
            <div class="hide11">
                <fieldset>
                    <section>
                        <label for="asthma">Asthma?</label>
                        <span class="inline"><input type="radio" id="asthma" value="yes" name="asthma" onclick="showvalue8()"  <?php echo!empty($wiz_09->asthma) ? ' checked ' : '' ?> /><label for="asthma"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" id="asthma" value="" name="asthma" onclick="showvalue8()"  <?php echo empty($wiz_09->asthma) ? ' checked ' : '' ?> /><label for="asthma"><span></span> No</label></span>
                        <div id="divval8">
                            <label for="other-diagnosis">If not asthma, what is the diagnosis?</label>
                            <input type="text" id="other_diagnosis" name="other_diagnosis" value="<?php echo $wiz_09->other_diagnosis ?>" />
                        </div>
                        <label id="diagnosis-age">Age Diagnosed</label>
                        <input type="text" id="diagnosis_age" name="diagnosis_age" value="<?php echo $wiz_09->diagnosis_age ?>"/>
                    </section>
                    <section>
                        <label for="last-year">Symptoms in the last 12 months?</label>
                        <span class="inline"><input type="radio" id="last_year" value="yes" name="last_year" <?php echo!empty($wiz_09->last_year) ? ' checked ' : '' ?> /><label for="last_year"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" id="last_year" value="" name="last_year" <?php echo empty($wiz_09->last_year) ? ' checked ' : '' ?>/><label for="last_year"><span></span> No</label></span>

                        <label for="meds_last_year">Needed to use medication in the last 12 months?</label>
                        <span class="inline"><input type="radio" id="meds_last_year" value="yes" name="meds_last_year" <?php echo!empty($wiz_09->meds_last_year) ? ' checked ' : '' ?> /><label for="meds_last_year-yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" id="meds_last_year" value="" name="meds_last_year" <?php echo empty($wiz_09->meds_last_year) ? ' checked ' : '' ?>  /><label for="meds_last_year-no"><span></span> No</label></span>

                        <label for="doctor_last_year">Seen by health care provider in the last 12 months?</label>
                        <span class="inline"><input type="radio" id="doctor_last_year" value="yes" name="doctor_last_year" <?php echo!empty($wiz_09->doctor_last_year) ? ' checked ' : '' ?> /><label for="doctor_last_year-yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" id="doctor_last_year" value="" name="doctor_last_year" <?php echo empty($wiz_09->doctor_last_year) ? ' checked ' : '' ?> /><label for="doctor_last_year-no"><span></span> No</label></span>

                        <label for="ed_last_year">ED visit(s) and/or hospitalizations in the last 12 months?</label>
                        <span class="inline"><input type="radio" id="ed_last_year" value="yes" onclick="showvalue9()" name="ed_last_year" <?php echo!empty($wiz_09->ed_last_year) ? ' checked ' : '' ?> /><label for="ed_last_year-yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" id="ed_last_year" value="no" onclick="showvalue9()" name="ed_last_year" <?php echo empty($wiz_09->ed_last_year) ? ' checked ' : '' ?> /><label for="ed_last_year-no"><span></span> No</label></span>
                        <div id="divval9">
                            <label for="num_ed_visits">If yes, how many?</label>
                            <span class="inline"><input type="radio" id="num_ed_visits" value="0" name="num_ed_visits" <?php echo ($wiz_09->num_ed_visits == '0') ? ' checked ' : '' ?> /><label for="num_ed_visits-1"><span></span> 0</label></span>
                            <span class="inline"><input type="radio" id="num_ed_visits" value="1" name="num_ed_visits" <?php echo ($wiz_09->num_ed_visits == '1') ? ' checked ' : '' ?> /><label for="num_ed_visits-1"><span></span> 1</label></span>
                            <span class="inline"><input type="radio" id="num_ed_visits" value="2" name="num_ed_visits" <?php echo ($wiz_09->num_ed_visits == '2') ? ' checked ' : '' ?> /><label for="num_ed_visits-2"><span></span> 2</label></span>
                            <span class="inline"><input type="radio" id="num_ed_visits" value="3" name="num_ed_visits" <?php echo ($wiz_09->num_ed_visits == '3') ? ' checked ' : '' ?> /><label for="num_ed_visits-3"><span></span> 3</label></span>
                            <span class="inline"><input type="radio" id="num_ed_visits" value="4" name="num_ed_visits" <?php echo ($wiz_09->num_ed_visits == '4') ? ' checked ' : '' ?> /><label for="num_ed_visits-4"><span></span> 4</label></span>
                            <span class="inline"><input type="radio" id="num_ed_visits" value="5 or more" name="num_ed_visits" <?php echo ($wiz_09->num_ed_visits == '5') ? ' checked ' : '' ?> /><label for="num_ed_visits-5"><span></span> 5 or more</label></span>
                        </div>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="triggers">Triggers</label>
                        <span><input type="checkbox" id="triggers_smoke" onclick="showvalue344(this.value)" value="Smoke" name="triggers_smoke" <?php echo!empty($wiz_09->triggers_smoke) ? ' checked ' : '' ?> /><label for="triggers_smoke"><span></span> Smoke</label></span>
                        <span><input type="checkbox" id="triggers_animals" onclick="showvalue344(this.value)" value="Animals" name="triggers_animals" <?php echo!empty($wiz_09->triggers_animals) ? ' checked ' : '' ?> /><label for="triggers_animals"><span></span> Animals</label></span>
                        <span><input type="checkbox" id="triggers_dust" onclick="showvalue344(this.value)" value="Dust" name="triggers_dust" <?php echo!empty($wiz_09->triggers_dust) ? ' checked ' : '' ?> /><label for="triggers_dust"><span></span> Dust</label></span>
                        <span><input type="checkbox" id="triggers_colds" onclick="showvalue344(this.value)" value="Colds/Illness" name="triggers_colds" <?php echo!empty($wiz_09->triggers_colds) ? ' checked ' : '' ?> /><label for="triggers_colds"><span></span> Colds/Illness</label></span>
                        <span><input type="checkbox" id="triggers_weather" onclick="showvalue344(this.value)" value="Changes in Weather" name="triggers_weather" <?php echo!empty($wiz_09->triggers_colds) ? ' checked ' : '' ?> /><label for="triggers_weather"><span></span> Changes in Weather</label></span>
                        <span><input type="checkbox" id="triggers_exercise" onclick="showvalue344(this.value)" value="Exercise" name="triggers_exercise" <?php echo!empty($wiz_09->triggers_exercise) ? ' checked ' : '' ?> /><label for="triggers_exercise"><span></span> Exercise</label></span>
                        <span><input type="checkbox" id="triggers_mold"  onclick="showvalue344(this.value)" value="Mold" name="triggers_mold" <?php echo!empty($wiz_09->triggers_mold) ? ' checked ' : '' ?> /><label for="triggers_mold"><span></span> Mold</label></span>
                        <span><input type="checkbox" id="triggers_grass" onclick="showvalue344(this.value)" value="Grass/Pollen" name="triggers_grass" <?php echo!empty($wiz_09->triggers_grass) ? ' checked ' : '' ?> /><label for="triggers_grass"><span></span> Grass/Pollen</label></span>
                        <span><input type="checkbox" id="triggers_perfumes" onclick="showvalue344(this.value)" value="Perfumes/Smells" name="triggers_perfumes" <?php echo!empty($wiz_09->triggers_perfumes) ? ' checked ' : '' ?> /><label for="triggers_perfumes"><span></span> Perfumes/Smells</label></span>
                        <span><input type="checkbox" id="triggers_stress" onclick="showvalue344(this.value)" value="Stress" name="triggers_stress" <?php echo!empty($wiz_09->triggers_stress) ? ' checked ' : '' ?> /><label for="triggers_stress"><span></span> Stress</label></span>
                        <span><input type="checkbox" id="triggers_food" onclick="showvalue344(this.value)" value="Food" name="triggers_food" <?php echo!empty($wiz_09->triggers_food) ? ' checked ' : '' ?> /><label for="triggers_food"><span></span> Food</label></span>
                        <span><input type="checkbox" id="triggers_other" onclick="showvalue344(this.value)" value="Other" name="triggers_other" <?php echo!empty($wiz_09->triggers_other) ? ' checked ' : '' ?> /><label for="triggers_other"><span></span> Other</label></span>
                        <div id="chkerror15"></div>
                        <div id="hidename344">
                            <input type="text" id="other_trigger" name="other_trigger"   value="<?php echo $wiz_09->other_trigger ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="usual-symptoms">Usual Symptoms</label>
                        <span><input type="checkbox" id="usual_symptoms_wheezing" onclick="showvalue345(this.value)" value="Wheezing" name="usual_symptoms_wheezing" <?php echo!empty($wiz_09->usual_symptoms_wheezing) ? ' checked ' : '' ?> /><label for="usual_symptoms_wheezing"><span></span> Wheezing</label></span>
                        <span><input type="checkbox" id="usual_symptoms_breath" onclick="showvalue345(this.value)" value="Shortness of Breath" name="usual_symptoms_breath" <?php echo!empty($wiz_09->usual_symptoms_breath) ? ' checked ' : '' ?> /><label for="usual_symptoms_breath"><span></span> Shortness of Breath</label></span>
                        <span><input type="checkbox" id="usual_symptoms_breathing" onclick="showvalue345(this.value)" value="Difficulty Breathing" name="usual_symptoms_breathing" <?php echo!empty($wiz_09->usual_symptoms_breathing) ? ' checked ' : '' ?> /><label for="usual_symptoms_breathing"><span></span> Difficulty Breathing</label></span>
                        <span><input type="checkbox" id="usual_symptoms_throat" onclick="showvalue345(this.value)" value="Itchy Throat" name="usual_symptoms_throat" <?php echo!empty($wiz_09->usual_symptoms_throat) ? ' checked ' : '' ?> /><label for="usual_symptoms_throat"><span></span> Itchy Throat</label></span>
                        <span><input type="checkbox" id="usual_symptoms_cough" onclick="showvalue345(this.value)" value="Coughing" name="usual_symptoms_cough" <?php echo!empty($wiz_09->usual_symptoms_cough) ? ' checked ' : '' ?> /><label for="usual_symptoms_cough"><span></span> Coughing</label></span>
                        <span><input type="checkbox" id="usual_symptoms_chest" onclick="showvalue345(this.value)" value="Chest Tightness" name="usual_symptoms_chest" <?php echo!empty($wiz_09->usual_symptoms_chest) ? ' checked ' : '' ?> /><label for="usual_symptoms_chest"><span></span> Chest Tightness</label></span>
                        <span><input type="checkbox" id="usual_symptoms_irritability" onclick="showvalue345(this.value)" value="Irritability" name="usual_symptoms_irritability" <?php echo!empty($wiz_09->usual_symptoms_irritability) ? ' checked ' : '' ?> /><label for="usual_symptoms_irritability"><span></span> Irritability</label></span>
                        <span><input type="checkbox" id="usual_symptoms_waking" onclick="showvalue345(this.value)" value="Waking at Night" name="usual_symptoms_waking" <?php echo!empty($wiz_09->usual_symptoms_waking) ? ' checked ' : '' ?> /><label for="usual_symptoms_waking"><span></span> Waking at Night</label></span>
                        <span><input type="checkbox" id="usual_symptoms_stomachache" onclick="showvalue345(this.value)" value="Stomachache" name="usual_symptoms_stomachache" <?php echo!empty($wiz_09->usual_symptoms_stomachache) ? ' checked ' : '' ?> /><label for="usual_symptoms_stomachache"><span></span> Stomach Ache</label></span>
                        <span><input type="checkbox" id="usual_symptoms_other" onclick="showvalue345(this.value)" value="Other" name="usual_symptoms_other" <?php echo!empty($wiz_09->usual_symptoms_other) ? ' checked ' : '' ?> /><label for="usual_symptoms_other"><span></span> Other</label></span>
                        <div id="chkerror16"></div>
                        <div id="hidename345">
                            <input type="text" id="other_usual_symptoms" name="other_usual_symptoms"  value="<?php echo $wiz_09->other_usual_symptoms ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="day_symptoms">Symptoms During the Day <span class="tiny">(in the past month)</span></label>
                        <span class="inline"><input type="radio" id="day_symptoms" value="None" name="day_symptoms" checked="checked" /><label for="day_symptoms_none"><span></span> None</label></span><br>
                        <span class="inline"><input type="radio" id="day_symptoms" value="2x/week or less" name="day_symptoms" <?php echo ($wiz_09->day_symptoms == '2x/week or less') ? ' checked ' : '' ?> /><label for="day_symptoms_twice"><span></span> 2x/week or less</label></span><br>
                        <span class="inline"><input type="radio" id="day_symptoms" value="More than 2x/week" name="day_symptoms" <?php echo ($wiz_09->day_symptoms == 'More than 2x/week') ? ' checked ' : '' ?> /><label for="day-symptoms-twiceplus"><span></span> More than 2x/week</label></span><br>
                        <span class="inline"><input type="radio" id="day_symptoms" value="Every Day" name="day_symptoms" <?php echo ($wiz_09->day_symptoms == 'Every Day') ? ' checked ' : '' ?> /><label for="day-symptoms-always"><span></span> Every Day</label></span>

                        <label for="night-symptoms">Symptoms at Night <span class="tiny">(in the past month)</span></label>
                        <span class="inline"><input type="radio" id="night_symptoms" value="None" name="night_symptoms" checked="checked" /><label for="night-symptoms-none"><span></span> None</label></span><br>
                        <span class="inline"><input type="radio" id="night_symptoms" value="2x/week or less" name="night_symptoms"  <?php echo ($wiz_09->night_symptoms == '2x/week or less') ? ' checked ' : '' ?>  /><label for="night-symptoms-twice"><span></span> 2x/week or less</label></span><br>
                        <span class="inline"><input type="radio" id="night_symptoms" value="More than 2x/week" name="night_symptoms" <?php echo ($wiz_09->night_symptoms == 'More than 2x/week') ? ' checked ' : '' ?>  /><label for="night-symptoms-twiceplus"><span></span> More than 2x/week</label></span><br>
                        <span class="inline"><input type="radio" id="night_symptoms" value="Every Night" name="night_symptoms" <?php echo ($wiz_09->night_symptoms == 'Every Night') ? ' checked ' : '' ?>  /><label for="night-symptoms-always"><span></span> Every Night</label></span>

                        <label for="season">Symptoms most likely occur in</label>
                        <div class="col-one">
                            <span><input type="checkbox" name="season_fall" id="season_fall" value="Fall" <?php echo!empty($wiz_09->season_fall) ? ' checked ' : '' ?>  /> <label for="season_fall"><span></span> Fall</label></span>
                            <span><input type="checkbox" name="season_winter" id="season_winter" value="Winter" <?php echo!empty($wiz_09->season_winter) ? ' checked ' : '' ?> /><label for="season_winter"><span></span> Winter</label></span>
                        </div>
                        <div class="col-two">
                            <span><input type="checkbox" name="season_spring" id="season_spring" value="Spring" <?php echo!empty($wiz_09->season_spring) ? ' checked ' : '' ?> /><label for="season_spring"><span></span> Spring</label></span>
                            <span><input type="checkbox" name="season_summer" id="season_summer" value="Summer" <?php echo!empty($wiz_09->season_summer) ? ' checked ' : '' ?> /><label for="season_summer"><span></span> Summer</label></span>
                        </div>
                        <br><br><br><br><br><br>
                        <div id="chkerror17"></div>
                    </section>

                </fieldset>
                <fieldset>
                    <section class="largetext">
                        <label for="pe">Have symptoms ever prevented student from participating in PE, Recess, Sports, or Other Activites?</label>
                        <span class="inline"><input type="radio" name="pe" id="pe" onclick="showvalue10();" value="yes" <?php echo!empty($wiz_09->pe) ? ' checked ' : '' ?> /><label for="pe"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="pe" id="pe" onclick="showvalue10();" value="" <?php echo empty($wiz_09->pe) ? ' checked ' : '' ?> /><label for="pe"><span></span> No</label></span>
                        <div id="divval10" style="display: none">
                            <label for="pe_explain">If yes, please explain</label>
                            <textarea id="pe_explain" name="pe_explain"><?php echo $wiz_09->pe_explain ?></textarea>
                        </div>
                    </section>
                    <!--- Page 10 continue here------>
                    <fieldset>
                        <section>
                            <label for="miss_school">Did student miss school last year?<span class="tiny">(relating to Diagnosis)</span></label>
                            <span class="inline"><input type="radio" name="miss_school" id="miss_school" onclick="showvalue11()" value="yes" <?php echo!empty($wiz_09->miss_school) ? ' checked ' : '' ?> /><label for="miss_school"><span></span> Yes</label></span>
                            <span class="inline"><input type="radio" name="miss_school" id="miss_school" onclick="showvalue11()" value="" <?php echo empty($wiz_09->miss_school) ? ' checked ' : '' ?> /><label for="miss_school"><span></span> No</label></span>
                            <div id="divval11" style="display: none">
                                <label for="missed_times">If yes, how many times?</label>
                                <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="1-2" checked="checked"/><label for="missed_times_1"><span></span> 1-2</label></span>
                                <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="3-5" <?php echo ($wiz_09->missed_times == '3-5') ? ' checked ' : '' ?>/><label for="missed_times_3"><span></span> 3-5</label></span>
                                <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="6-9" <?php echo ($wiz_09->missed_times == '6-9') ? ' checked ' : '' ?>/><label for="missed_times_6"><span></span> 6-9</label></span>
                                <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="10 or more" <?php echo ($wiz_09->missed_times == '10 or more') ? ' checked ' : '' ?> /><label for="missed_times_10"><span></span> 10 or more</label></span>

                            </div>
                            <label for="med_delivery">Medication Delivery</label>
                            <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)" value="None" checked="checked" /><label for="med_delivery-neb"><span></span> None</label></span>
                            <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)" value="Nebulizer"  <?php echo ($wiz_09->med_delivery == 'Nebulizer') ? ' checked ' : '' ?>/><label for="med_delivery-neb"><span></span> Nebulizer</label></span>
                            <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)"b  value="Inhaler" <?php echo ($wiz_09->med_delivery == 'Inhaler') ? ' checked ' : '' ?> /><label for="med_delivery-inhaler"><span></span> Inhaler</label></span>
                            <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" onclick="showvalue327(this.value)" onclick="showvalue327(this.value)" value="Both" <?php echo ($wiz_09->med_delivery == 'Both') ? ' checked ' : '' ?> /><label for="med_delivery-both"><span></span> Both</label></span>
                            <div id="hidename327">
                                <label for="med-freq">Frequency</label>
                                <input type="text" id="med_freq"  name="med_freq" value="<?php echo $wiz_09->med_freq ?>" />
                            </div>
                            <label for="student_admin">Student able to administer medication?</label>
                            <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Independent" checked="checked" /><label for="student_admin_independent"><span></span> Independent<label></span>
                                        <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Dependent" <?php echo ($wiz_09->student_admin == 'Dependent') ? ' checked ' : '' ?> /><label for="student_admin_dependent"><span></span> Dependent<label></span>
                                                    <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Assistance Required" <?php echo ($wiz_09->student_admin == 'Assistance Required') ? ' checked ' : '' ?> /><label for="student_admin_assist"><span></span> Assistance Required<label></span>
                                                                </section>
                                                                <section>
                                                                    <label for="self-mdi">Student self-carries MDI?</label>
                                                                    <span class="inline"><input type="radio" name="self_mdi" id="self_mdi" value="yes" <?php echo!empty($wiz_09->self_mdi) ? ' checked ' : '' ?> /><label for="self_mdi"><span></span> Yes<label></span>
                                                                                <span class="inline"><input type="radio" name="self_mdi" id="self_mdi" value="no" <?php echo empty($wiz_09->self_mdi) ? ' checked ' : '' ?>  /><label for="self_mdi"><span></span> No<label></span>

                                                                                            <label for="mdi">MDI kept in health room?</label>
                                                                                            <span class="inline"><input type="radio" name="mdi" id="mdi" value="yes" <?php echo!empty($wiz_09->mdi) ? ' checked ' : '' ?> /><label for="mdi-yes"><span></span> Yes<label></span>
                                                                                                        <span class="inline"><input type="radio" name="mdi" id="mdi" value="" <?php echo empty($wiz_09->mdi) ? ' checked ' : '' ?> /><label for="mdi-no"><span></span> No<label></span>

                                                                                                                    <label for="spacer">Spacer?</label>
                                                                                                                    <span class="inline"><input type="radio" name="spacer" id="spacer" value="yes"  <?php echo!empty($wiz_09->spacer) ? ' checked ' : '' ?>/><label for="spacer"><span></span> Yes<label></span>
                                                                                                                                <span class="inline"><input type="radio" name="spacer" id="spacer" value="" <?php echo empty($wiz_09->spacer) ? ' checked ' : '' ?> /><label for="spacer"><span></span> No<label></span>
                                                                                                                                            <br>
                                                                                                                                            <input type="hidden" id="spacer_type" name="spacer_type" value="<?php echo $wiz_09->spacer_type ?>" />

                                                                                                                                            <label for="peak">Peak flow?</label>
                                                                                                                                            <span class="inline"><input type="radio" name="peak" id="peak"  value="yes" onclick="showvalue300(this.value)" <?php echo!empty($wiz_09->peak) ? ' checked ' : '' ?> /><label for="peak"><span></span> Yes<label></span>
                                                                                                                                                        <span class="inline"><input type="radio" name="peak" id="peak"  value="" onclick="showvalue300(this.value)" <?php echo empty($wiz_09->peak) ? ' checked ' : '' ?>  /><label for="peak"><span></span> No<label></span>

                                                                                                                                                                    <div id="hidename300">
                                                                                                                                                                        <label for="peak">Personal best?</label>
                                                                                                                                                                        <input type="text" id="peak_best" name="peak_best" value="<?php echo $wiz_09->peak_best ?>" />
                                                                                                                                                                    </div>
                                                                                                                                                                    </section>
                                                                                                                                                                    </fieldset>
                                                                                                                                                                    <fieldset>
                                                                                                                                                                        <section>

                                                                                                                                                                            <label for="pulm_vest">Pulmonary Vest?</label>
                                                                                                                                                                            <span class="inline"><input type="radio" name="pulm_vest" onclick="showvalue328(this.value)" id="pulm_vest" value="yes"  <?php echo!empty($wiz_09->pulm_vest) ? ' checked ' : '' ?> /><label for="pulm_vest"><span></span> Yes</label></span>
                                                                                                                                                                            <span class="inline"><input type="radio" name="pulm_vest"  onclick="showvalue328(this.value)"  id="pulm_vest" value=""  <?php echo empty($wiz_09->pulm_vest) ? ' checked ' : '' ?>  /><label for="pulm_vest"><span></span> No</label></span>
                                                                                                                                                                            <div id="hidename328">
                                                                                                                                                                                <label for="vest-freq">Frequency</label>
                                                                                                                                                                                <input type="text" id="vest_freq" name="vest_freq" value="<?php echo $wiz_09->vest_freq ?>" />
                                                                                                                                                                            </div>
                                                                                                                                                                            <label for="chest-pt">Chest PT?</label>
                                                                                                                                                                            <span class="inline"><input type="radio" name="chest_pt" id="chest_pt" onclick="showvalue336(this.value)" value="yes" <?php echo!empty($wiz_09->chest_pt) ? ' checked ' : '' ?> /><label for="chest-pt-yes"><span></span> Yes</label></span>
                                                                                                                                                                            <span class="inline"><input type="radio" name="chest_pt" id="chest_pt" onclick="showvalue336(this.value)" value="" <?php echo empty($wiz_09->chest_pt) ? ' checked ' : '' ?> /><label for="chest-pt-no"><span></span> No</label></span>
                                                                                                                                                                            <div id="hidename336">
                                                                                                                                                                                <label for="chest-pt-freq">Frequency</label>
                                                                                                                                                                                <input type="text" id="chest_pt_freq" name="chest_pt_freq" value="<?php echo $wiz_09->chest_pt_freq ?>" />
                                                                                                                                                                            </div>
                                                                                                                                                                        </section>
                                                                                                                                                                        <section>
                                                                                                                                                                            <label for="t-plan">Treatment Plan in School</label>
                                                                                                                                                                            <span class="inline"><input type="checkbox" name="standard"  id="standard" value="yes" <?php echo!empty($wiz_09->standard) ? ' checked ' : '' ?> >  <label for="standard"><span></span>Standard Asthma Plan </label></span>
                                                                                                                                                                            <span class="inline"><input type="checkbox" name="action" id="action" value="yes" <?php echo!empty($wiz_09->action) ? ' checked ' : '' ?> /> <label for="action"><span></span> Asthma Action Plan</label></span>
                                                                                                                                                                            <span class="inline"><input type="checkbox" name="ihp" id="ihp" value="yes" <?php echo!empty($wiz_09->ihp) ? ' checked ' : '' ?> /> <label for="ihp"><span></span> IHP</label></span>
                                                                                                                                                                            <div id="chkerror18"></div>
                                                                                                                                                                        </section>
<!--                                                                                                                                                                        <section>
                                                                                                                                                                            <label for="ed-asthma">ED visit(s) and/or hospitalizations in the last 12 months?</label>
                                                                                                                                                                            <span class="inline"><input type="radio" id="ed_asthma" value="yes" name="ed_asthma" onclick="showvalue12()" <?php echo!empty($wiz_09->ed_asthma) ? ' checked ' : '' ?> /><label for="ed_asthma"><span></span> Yes</label></span>
                                                                                                                                                                            <span class="inline"><input type="radio" id="ed_asthma" value="no" name="ed_asthma" onclick="showvalue12()" <?php echo empty($wiz_09->ed_asthma) ? ' checked ' : '' ?>  /><label for="ed_asthma"><span></span> No</label></span>
                                                                                                                                                                            <div id="divval12">
                                                                                                                                                                                <label for="num-visits">If yes, how many?</label>
                                                                                                                                                                                <span class="inline"><input type="radio" id="num_visits" value="0" name="num_visits" <?php echo empty($wiz_09->num_visits) ? ' checked ' : '' ?> /><label for="num-visits-1"><span></span> 0</label></span>
                                                                                                                                                                                <span class="inline"><input type="radio" id="num_visits" value="1" name="num_visits" <?php echo ($wiz_09->num_visits == '1') ? ' checked ' : '' ?> /><label for="num-visits-1"><span></span> 1</label></span>
                                                                                                                                                                                <span class="inline"><input type="radio" id="num_visits" value="2" name="num_visits" <?php echo ($wiz_09->num_visits == '2') ? ' checked ' : '' ?> /><label for="num-visits-2"><span></span> 2</label></span>
                                                                                                                                                                                <span class="inline"><input type="radio" id="num_visits" value="3" name="num_visits" <?php echo ($wiz_09->num_visits == '3') ? ' checked ' : '' ?> /><label for="num-visits-3"><span></span> 3</label></span>
                                                                                                                                                                                <span class="inline"><input type="radio" id="num_visits" value="4" name="num_visits" <?php echo ($wiz_09->num_visits == '4') ? ' checked ' : '' ?> /><label for="num-visits-4"><span></span> 4</label></span>
                                                                                                                                                                                <span class="inline"><input type="radio" id="num_visits" value="5 or more" name="num_visits" <?php echo ($wiz_09->num_visits == '5 or more') ? ' checked ' : '' ?> /><label for="num-visits-5"><span></span> 5 or more</label></span>
                                                                                                                                                                            </div>
                                                                                                                                                                        </section>-->
                                                                                                                                                                        <section class="largetext">
                                                                                                                                                                            <label for="resp-addtnl">Additional Comments</label>
                                                                                                                                                                            <textarea id="resp_addtnl" name="resp_addtnl" ><?php echo $wiz_09->resp_addtnl ?></textarea>
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
                                                                                                                                                                                if (!empty($wiz_09->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                                                                                                                                                                                #echo form_submit($attr_FormSave_reassessment);
                                                                                                                                                                                endif;
                                                                                                                                                                                ?>
                                                                                                                                                                                <?php
                                                                                                                                                                                //click to final page
                                                                                                                                                                                $reviewvalue = $this->session->userdata('reviewassesment');
                                                                                                                                                                                $unique_number = $this->session->userdata('unique_number');
                                                                                                                                                                                if (!empty($reviewvalue)):
                                                                                                                                                                                    echo anchor("nurse_assessment/assessment/final_step/" . $wiz_09->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
                                                                                                                                                                            //Triggers
                                                                                                                                                                            $('#assessment9').submit(function() {
                                                                                                                                                                                var $feed = $('input[name=hide11]:checked', '#assessment9').val();
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
                                                                                                                                                                            $('#assessment9').submit(function() {
                                                                                                                                                                                var $feed = $('input[name=hide11]:checked', '#assessment9').val();
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
                                                                                                                                                                            $('#assessment9').submit(function() {
                                                                                                                                                                                var $feed = $('input[name=hide11]:checked', '#assessment9').val();
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
                                                                                                                                                                            $('#assessment9').submit(function() {
                                                                                                                                                                                var $feed = $('input[name=hide11]:checked', '#assessment9').val();
                                                                                                                                                                                var $fields1 = $(this).find('input[name="standard"]:checked');
                                                                                                                                                                                var $fields2 = $(this).find('input[name="action"]:checked');
                                                                                                                                                                                var $fields3 = $(this).find('input[name="ihp"]:checked');
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


                                                                                                                                                                            //Autosave
                                                                                                                                                                            setInterval(function() {
                                                                                                                                                                                var queryString = $('#assessment9').serialize();
                                                                                                                                                                                //alert(queryString);
                                                                                                                                                                                var baseurl = '<?php echo base_url(); ?>';
                                                                                                                                                                                //alert(baseurl);
                                                                                                                                                                                $.ajax({
                                                                                                                                                                                    type: "POST",
                                                                                                                                                                                    url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                                                                                                                                                                                });
                                                                                                                                                                            }, 10000); // 10 seconds
                                                                                                                                                                            //Autosave end
                                                                                                                                                                            var yesbtn = $('#pe').val();
                                                                                                                                                                            var ed_last_year = $('#ed_last_year').val();
                                                                                                                                                                            var asthma = $('#asthma').val();
                                                                                                                                                                            if (yesbtn == 'yes') {
                                                                                                                                                                                showvalue10();
                                                                                                                                                                            }
                                                                                                                                                                            if (ed_last_year == 'yes') {
                                                                                                                                                                                showvalue9();
                                                                                                                                                                            }
                                                                                                                                                                            if (asthma == 'no') {
                                                                                                                                                                                showvalue8();
                                                                                                                                                                            }
                                                                                                                                                                            var miss_school = $('#miss_school').val();
                                                                                                                                                                            var ed_asthma = $('#ed_asthma').val();
                                                                                                                                                                            if (miss_school == 'yes') {
                                                                                                                                                                                showvalue11();
                                                                                                                                                                            }
                                                                                                                                                                            if (ed_asthma == 'yes') {
                                                                                                                                                                                showvalue12();
                                                                                                                                                                            }
                                                                                                                                                                            $("input[type=checkbox]").change();
                                                                                                                                                                        });
                                                                                                                                                                    </script>