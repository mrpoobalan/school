<style>
    select{
        width:auto!important;
    }
    .errorchk,.errorchk3{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
</style>
<?php
//echo "<pre>";
//print_r($wiz_14);
//echo "</pre>";
//exit;
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn_primary', 'id' => 'assessment14', 'name' => 'assessment14', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment14', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment14", 'class' => "healthform");

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
if (empty($wiz_14->sif)):
    $wiz_14 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_14->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_14->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_14">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_14->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;       ?></div>
        <?php endif; ?>

        <fieldset class="new_section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(15)" id="hide15"  name="hide15" value="on" <?php echo!empty($wiz_14->hide15) ? ' checked ' : '' ?> /> <label for="hide15"><span></span>No needs at this time</label></span>
            <legend class="legends">Diabetes Management</legend>
            <div class="hide15">
                <fieldset class="wide threecol">
                    <section>
                        <label for="gluc_test">Tests blood glucose at school?</label>
                        <span class="inline"><input type="radio" name="gluc_test" id="gluc_test" value="yes" <?php echo!empty($wiz_14->gluc_test) ? ' checked ' : '' ?> /> <label><span for="gluc_test_yes"></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="gluc_test" id="gluc_test" value="" <?php echo empty($wiz_14->gluc_test) ? ' checked ' : '' ?>  /> <label><span for="gluc_test_no"></span> No</label></span>

                        <label for="test_when">When should student test?</label>
                        <div class="col_one"  style="float:left">
                            <span><input type="checkbox" name="test_when_arrival" id="test_when_arrival" value="On arrival" <?php echo!empty($wiz_14->test_when_arrival) ? ' checked ' : '' ?> /> <label for="test_when_arrival"><span></span> On arrival</label></span>
                            <span><input type="checkbox" name="test_when_breakfast" id="test_when_breakfast" value="Before Breakfast" <?php echo!empty($wiz_14->test_when_breakfast) ? ' checked ' : '' ?> /> <label for="test_when_breakfast"><span></span> Before Breakfast</label></span>
                            <span><input type="checkbox" name="test_when_blunch" id="test_when_blunch" value="Before lunch" <?php echo!empty($wiz_14->test_when_blunch) ? ' checked ' : '' ?> /> <label for="test_when_blunch"><span></span> Before lunch</label></span>
                            <span><input type="checkbox" name="test_when_alunch" id="test_when_alunch" value="After lunch" <?php echo!empty($wiz_14->test_when_alunch) ? ' checked ' : '' ?> /> <label for="test_when_alunch"><span></span> After lunch</label></span>
                            <span><input type="checkbox" name="test_when_bpe" id="test_when_bpe" value="Before PE" <?php echo!empty($wiz_14->test_when_bpe) ? ' checked ' : '' ?> /> <label for="test_when_bpe"><span></span> Before PE</label></span>

                        </div>

                        <div class="col_two"  style="float:left; padding-left: 15px;">
                            <span><input type="checkbox" name="test_when_ape" id="test_when_ape" value="After PE" <?php echo!empty($wiz_14->test_when_ape) ? ' checked ' : '' ?> /> <label for="test_when_ape"><span></span> After PE</label></span>
                            <span><input type="checkbox" name="test_when_snack" id="test_when_snack" value="Before Snacks" <?php echo!empty($wiz_14->test_when_snack) ? ' checked ' : '' ?>  /> <label for="test_when_snack"><span></span> Before Snacks</label></span>
                            <span><input type="checkbox" name="test_when_dismissal" id="test_when_dismissal" value="Before Dismissal" <?php echo!empty($wiz_14->test_when_dismissal) ? ' checked ' : '' ?> /> <label for="test_when_dismissal"><span></span> Before Dismissal</label></span>
                            <span><input type="checkbox" name="test_when_prn" id="test_when_prn" value="PRN if symptomatic" <?php echo!empty($wiz_14->test_when_prn) ? ' checked ' : '' ?> /> <label for="test_when_prn"><span></span> PRN if symptomatic</label></span>
                            <span><input type="checkbox" name="test_when_other" id="test_when_other" value="other" <?php echo!empty($wiz_14->test_when_other) ? ' checked ' : '' ?> /> <label for="test_when_other"><span></span> Other</label></span>
                        </div>
                        <div id="chkerror3"></div>
                        <div id="othertestdiv">
                            <label for="test_when">Please specify</label>
                            <input type="text" name="othertest" id="othertest" value="<?= !empty($wiz_14->othertest) ? $wiz_14->othertest : ''; ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="test_ind">Level of Independence</label>
                        <span><input type="checkbox" name="test_ind_outhr" onclick="showvalue17()" id="test_ind_outhr" value="Independent (outside HR)" <?php echo!empty($wiz_14->test_ind_outhr) ? ' checked ' : '' ?> /> <label for="test_ind_outhr"><span></span> Independent (outside HR)</label></span>
                        <span><input type="checkbox" name="test_ind_inhr" onclick="showvalue17()"  id="test_ind_inhr" value="Independent (in HR)" <?php echo!empty($wiz_14->test_ind_inhr) ? ' checked ' : '' ?> /> <label for="test_ind_inhr"><span></span> Independent (in HR)</label></span>
                        <span><input type="checkbox" name="test_ind_super" onclick="showvalue17()"  id="test_ind_super" value="Supervision Only" <?php echo!empty($wiz_14->test_ind_super) ? ' checked ' : '' ?> /> <label for="test_ind_super"><span></span> Supervision Only</label></span>
                        <span><input type="checkbox" name="test_ind_assist" onclick="showvalue17()"  id="test_ind_assist" value="Assistance Needed" <?php echo!empty($wiz_14->test_ind_assist) ? ' checked ' : '' ?> /> <label for="test_ind_assist"><span></span> Assistance Needed</label></span>
                        <span><input type="checkbox" name="test_ind_dep" onclick="showvalue17()"  id="test_ind_dep" value="Dependent" <?php echo!empty($wiz_14->test_ind_dep) ? ' checked ' : '' ?> /> <label for="test_ind_dep"><span></span> Dependent</label></span>
                    </section>
                    <!--                    <div id="divval17" style="display: none">
                                            <section>
                                                <label for="test_assist">If assistance is needed, describe</label>
                                                <textarea id="test_assist" name="test_assist"><?php #echo $wiz_14->test_assist         ?></textarea>
                                            </section>
                                        </div>-->
                </fieldset>
                <fieldset>
                    <section>
                        <label for="target">Target Range</label>
                        <input type="text" id="target" name="target" value="<?php echo $wiz_14->target ?>" />

                        <label for="insulin_type">Insulin Delivery</label>
                        <div class="col_two">
                            <span><input type="checkbox" name="insulin_type_syringe" id="insulin_type_syringe" value="syringe" <?php echo!empty($wiz_14->insulin_type_syringe) ? ' checked ' : '' ?> /> <label for="insulin_type_syringe"><span></span> Syringe </label></span>
                            <span><input type="checkbox" name="insulin_type_pen" id="insulin_type_pen" value="pen" <?php echo!empty($wiz_14->insulin_type_pen) ? ' checked ' : '' ?> /> <label for="insulin_type_pen"><span></span> Insulin Pen </label></span>
                            <!--<span><input type="checkbox" name="insulin_type_pump" id="insulin_type_pump" value="pump" <?php #echo!empty($wiz_14->insulin_type_pump) ? ' checked ' : ''         ?> /> <label for="insulin_type_pump"><span></span> Pump </label></span>-->
                            <span><input type="checkbox" name="insulin_type_pod" id="insulin_type_pod" value="pod" <?php echo!empty($wiz_14->insulin_type_pod) ? ' checked ' : '' ?> /> <label for="insulin_type_pod"><span></span> Pod </label></span>
                            <span><input type="checkbox" name="insulin_type_other" id="insulin_type_other" value="other" <?php echo!empty($wiz_14->insulin_type_other) ? ' checked ' : '' ?> /> <label for="insulin_type_other"><span></span> Other </label></span>
                            <div id="chkerror"></div>
                        </div>
                        <div id="otherinsdiv">
                            <label for="test_when">Please specify</label>
                            <input type="text" name="otherins" id="otherins" value="<?= !empty($wiz_14->otherins) ? $wiz_14->otherins : ''; ?>" />
                        </div>
                        <label class="clear" for="insulin_manu">Manufacturer</label>
                        <input type="text" id="insulin_manu" name="insulin_manu" value="<?php echo $wiz_14->insulin_manu ?>" />
                    </section>
                    <section>
                        <label for="insulin_school">Insulin at school?</label>
                        <span class="inline"><input type="radio" name="insulin_school" id="insulin_school" value="yes" <?php echo!empty($wiz_14->insulin_school) ? ' checked ' : '' ?>/> <label for="insulin_school_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="insulin_school" id="insulin_school" value="" <?php echo empty($wiz_14->insulin_school) ? ' checked ' : '' ?> /> <label for="insulin_school_no"><span></span> No</label></span>

                        <label for="type_ins_school">Type of insulin</label>
                        <input type="text" id="type_ins_school" name="type_ins_school" value="<?php echo $wiz_14->type_ins_school ?>" />
                    </section>
                    <section>
                        <label for="dose">How is dose calculated?</label>
                        <span><input type="checkbox" name="dose_correct" id="dose_correct" value="Correction factor/carb ratio"  <?php echo!empty($wiz_14->dose_correct) ? ' checked ' : '' ?> /> <label for="dose_correct"><span></span> Correction factor/carb ratio</label></span>
                        <span><input type="checkbox" name="dose_standard" id="dose_standard" value="Standard lunch dose" <?php echo!empty($wiz_14->dose_standard) ? ' checked ' : '' ?> /> <label for="dose_standard"><span></span> Standard lunch dose</label></span>
                        <span><input type="checkbox" name="dose_slide" id="dose_slide" value="Sliding scale" <?php echo!empty($wiz_14->dose_slide) ? ' checked ' : '' ?> /> <label for="dose_slide"><span></span> Sliding scale</label></span>
                        <span><input type="checkbox" name="dose_pump" id="dose_pump" value="Pump calculations" <?php echo!empty($wiz_14->dose_pump) ? ' checked ' : '' ?> /> <label for="dose_pump"><span></span> Pump/Pod Calculations</label></span>
                    </section>
                </fieldset>
                <fieldset class="threecol">
                    <section>
                        <label for="before_lunch">Insulin before lunch?</label>
                        <span class="inline"><input type="radio" name="before_lunch" id="before_lunch" value="yes" onclick="showvalue346(this.value)" <?php echo!empty($wiz_14->before_lunch) ? ' checked ' : '' ?> /> <label for="before_lunch_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="before_lunch" id="before_lunch" value="" onclick="showvalue346(this.value)" <?php echo empty($wiz_14->before_lunch) ? ' checked ' : '' ?> /> <label for="before_lunch_no"><span></span> No</label></span>
                        <div id="hidename346">
                            <label for="lunch_correction">Lunch Correction Factor</label>
                            <input type="text" id="lunch_correction" name="lunch_correction" value="<?php echo $wiz_14->lunch_correction ?>" />
                        </div>
                        <label for="insulin_snack">Insulin for Snack Order?</label>
                        <span class="inline"><input type="radio" name="insulin_snack" id="insulin_snack" value="yes" <?php echo!empty($wiz_14->insulin_snack) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="insulin_snack" id="insulin_snack" value=""  <?php echo empty($wiz_14->insulin_snack) ? ' checked ' : '' ?> /><label> No</label></span>

                    </section>
                    <section>
                        <label for="counts_carbs">Counts Carbs?</label>
                        <span class="inline"><input type="radio" name="counts_carbs" id="counts_carbs" value="yes" onclick="showvalue347(this.value)" <?php echo 'checked'; ?> /> <label for="counts_carbs_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="counts_carbs" id="counts_carbs" value="" onclick="showvalue347(this.value)" <?php echo ($wiz_14->counts_carbs == "") ? ' checked ' : '' ?>  /> <label for="counts_carbs_no"><span></span> No</label></span>
                        <div id="hidename347">
                            <label for="lunch_carb">Lunch Carb Ratio</label>
                            <input type="text" id="lunch_carb" name="lunch_carb" value="<?php echo $wiz_14->lunch_carb ?>" />

                            <label for="snack_carb">Snack Carb Ratio</label>
                            <input type="text" id="snack_carb"  name="snack_carb" value="<?php echo $wiz_14->snack_carb ?>"/>
                        </div>
                    </section>
                    <section>
                        <label for="after_lunch_reason">Insulin may be given after lunch if</label>
                        <textarea id="after_lunch_reason" name="after_lunch_reason"><?php echo $wiz_14->after_lunch_reason ?></textarea>
                    </section>
                </fieldset>
                <fieldset class="threecol">
                    <section>
                        <label for="school_breakfast">Breakfast at School?</label>
                        <span class="inline"><input type="radio" name="school_breakfast" id="school_breakfast" value="yes" onclick="showvalue348(this.value)" <?php echo!empty($wiz_14->school_breakfast) ? ' checked ' : '' ?> /> <label for="school_breakfast_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="school_breakfast" id="school_breakfast" value=""  onclick="showvalue348(this.value)"<?php echo empty($wiz_14->school_breakfast) ? ' checked ' : '' ?>  /> <label for="school_breakfast_no"><span></span> No</label></span>
                        <div id="hidename348">
                            <label for="break_carb">Breakfast Carb Ratio</label>
                            <textarea id="break_carb" name="break_carb"><?php echo $wiz_14->break_carb ?></textarea>
                        </div>
                    </section>
                    <section>
                        <label for="school_glucagon">Glucagon at School?</label>
                        <span class="inline"><input type="radio" name="school_glucagon" id="school_glucagon" value="yes" onclick="showvalue349(this.value)"  <?php echo!empty($wiz_14->school_glucagon) ? ' checked ' : '' ?> /> <label for="school_glucagon"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="school_glucagon" id="school_glucagon" value="" onclick="showvalue349(this.value)"  <?php echo empty($wiz_14->school_glucagon) ? ' checked ' : '' ?> /> <label for="school_glucagon"><span></span> No</label></span>
                        <div id="hidename349">
                            <label for="glucagon_order">Glucagon Order (dose/symptoms)</label>
                            <textarea id="glucagon_order" name="glucagon_order"><?php echo $wiz_14->glucagon_order ?></textarea>
                        </div>
                    </section>

                </fieldset>
                <fieldset class="threecol">

                    <section>
                        <label for="emer_kit">Emergency Kit</label>
                        <span><input type="checkbox" name="emer_kit_hr" id="emer_kit_hr" value="In HR" <?php echo!empty($wiz_14->emer_kit_hr) ? ' checked ' : '' ?> /> <label for="emer_kit_hr"><span></span> In HR</label></span>
                        <span><input type="checkbox" name="emer_kit_class" id="emer_kit_class" value="In Classroom" <?php echo!empty($wiz_14->emer_kit_class) ? ' checked ' : '' ?> /> <label for="emer_kit_class"><span></span> In Classroom</label></span>
                        <span><input type="checkbox" name="emer_kit_carry" id="emer_kit_carry" value="Carried with Student" <?php echo!empty($wiz_14->emer_kit_carry) ? ' checked ' : '' ?> /> <label for="emer_kit_carry"><span></span> Carried with Student</label></span>
                    </section>
                    <section>
                        <label for="kit_contents">Emergency Kit Contents</label>
                        <span><input type="checkbox" name="kit_contents_glucose_gel" id="kit_contents_glucose_gel" value="Glucose Gel/Cake Mate" <?php echo!empty($wiz_14->kit_contents_glucose_gel) ? ' checked ' : '' ?> /> <label for="kit_contents_glucose_gel"><span></span> Glucose Gel/Cake Mate</label></span>
                        <span><input type="checkbox" name="kit_contents_glucose_tabs" id="kit_contents_glucose_tabs" value="Glucose Tabs" <?php echo!empty($wiz_14->kit_contents_glucose_tabs) ? ' checked ' : '' ?> /> <label for="kit_contents_glucose_tabs"><span></span> Glucose Tabs</label></span>
                        <span><input type="checkbox" name="kit_contents_juice" id="kit_contents_juice" value="Juice"  <?php echo!empty($wiz_14->kit_contents_juice) ? ' checked ' : '' ?> /> <label for="kit_contents_juice"><span></span> Juice</label></span>
                        <span><input type="checkbox" name="kit_contents_snacks" id="kit_contents_snacks" value="Snack(s)" <?php echo!empty($wiz_14->kit_contents_snacks) ? ' checked ' : '' ?> /> <label for="kit_contents_snacks"><span></span> Snack(s)</label></span>
                        <input type="text" id="emer_snacks" name="emer_snacks"  value="<?php echo $wiz_14->emer_snacks ?>" />
                    </section>
                    <section>
                        <label for="hyper_treatment">Treatment for Hypoglycemia if different than Standard Emergency Action Plan</label>
                        <textarea id="hyper_treatment" name="hyper_treatment"><?php echo $wiz_14->hyper_treatment ?></textarea>
                    </section>
                    <section>
                        <label for="hyper_treatment">Treatment for Hyperglycemia if different than Standard Emergency Action Plan</label>
                        <textarea id="hypergly_treatment" name="hypergly_treatment"><?php echo $wiz_14->hypergly_treatment ?></textarea>
                    </section>
                </fieldset>
                <fieldset class="threecol">
                    <section>
                        <label for="insulin_key">Insulin for Ketones</label>
                        <span class="inline"><input type="radio" name="insulin_key" id="insulin_key" onclick="showvalue309(this.value)" value="yes" <?php echo!empty($wiz_14->insulin_key) ? ' checked ' : '' ?> /> <label for="insulin_key_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="insulin_key" id="insulin_key" onclick="showvalue309(this.value)" value="" <?php echo empty($wiz_14->insulin_key) ? ' checked ' : '' ?>  /> <label for="insulin_key_no"><span></span> No</label></span>

                        <div id="hidename309">
                            <label for="insulin_key_order">Insulin for Ketones Order</label>
                            <textarea id="insulin_key_order" name="insulin_key_order"><?php echo $wiz_14->insulin_key_order ?></textarea>
                        </div>
                    </section>
                    <section>
                        <label for="discrete">Discretionary Orders</label>
                        <span class="inline"><input type="radio" name="discrete" onclick="showvalue18()" id="discrete" value="yes" <?php echo!empty($wiz_14->discrete) ? ' checked ' : '' ?> /> <label for="discrete_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="discrete" onclick="showvalue18()" id="discrete" value="" <?php echo empty($wiz_14->discrete) ? ' checked ' : '' ?>  /> <label for="discrete_no"><span></span> No</label></span>

                        <div id="divval18" style="display: none">
                            <label for="discretionary_list">If yes, please list</label>
                            <textarea id="discretionary_list" name="discretionary_list"><?php echo $wiz_14->discretionary_list ?></textarea>
                        </div>
                    </section>
                    <section>
                        <label for="home_insulin_order">Home Insulin Order <span class="tiny">(type, dose, time)</span></label>
                        <input type="text" id="home_insulin_order" name="home_insulin_order" value="<?php echo $wiz_14->home_insulin_order ?>" />

                        <label for="lockdown">Lock Down Insulin Orders</label>
                        <input type="text" id="lockdowndesc"  name="lockdowndesc" value="<?php echo $wiz_14->lockdowndesc ?>" />
                    </section>
                </fieldset>
                <fieldset>
                    <section class="largetext">
                        <label for="diabetes_additional">Additional Comments</label>
                        <textarea id="diabetes_additional" name="diabetes_additional"><?php echo $wiz_14->diabetes_additional ?></textarea>
                    </section>
                </fieldset>
            </div>
            <!---- Newest one 1 start----->
            <legend class="legends">Adrenal Insufficiency</legend>
            <span class="inline hide"><input type="checkbox" onclick="showvalue334(this.value)" id="hide334"  name="hide334" value="on" <?php echo!empty($wiz_14->hide334) ? ' checked ' : '' ?> /> <label for="hide334"><span></span>No needs at this time</label></span>
            <div id="hidename334">
                <fieldset class="threecol">
                    <section>
                        <label for="after_luncasasah_reason">Age of diagnosis </label>
                        <input type="text" id="ageofdia"  name="ageofdia" value="<?php echo $wiz_14->ageofdia ?>" />
                        <label for="before_lunch">Has experienced adrenal crisis</label>
                        <span class="inline"><input type="radio" name="crisis_ex" id="crisis_ex" onclick="showvalue317(this.value)" value="yes" <?php echo!empty($wiz_14->crisis_ex) ? ' checked ' : '' ?> /> <label for="before_lunch_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="crisis_ex" id="crisis_ex" onclick="showvalue317(this.value)" value="" <?php echo empty($wiz_14->crisis_ex) ? ' checked ' : '' ?> /> <label for="before_lunch_no"><span></span> No</label></span>
                        <div id="hidename317">
                            <label for="after_lunch_reason">If yes</label>
                            <label for="after_lunch_reason">Date</label>
                            <input type="text" id="crisis_date"  name="crisis_date" value="<?php echo $wiz_14->crisis_date ?>" />
                            <label for="after_lunch_reason">Symptoms</label>
                            <input type="text" id="crisis_symptoms"  name="crisis_symptoms" value="<?php echo $wiz_14->crisis_symptoms ?>" />
                        </div>
                    </section>
                    <section>

                        <label for="insulin_snack">Treatment for Adrenal Crisis </label><br>
                        <label for="insulin_snack">Hydrocortisone  P.O </label>
                        <span class="inline"><input type="radio" name="hydro" id="hydro" value="yes" <?php echo!empty($wiz_14->hydro) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="hydro" id="hydro" value=""  <?php echo empty($wiz_14->hydro) ? ' checked ' : '' ?> /><label> No</label></span>

                        <label for="insulin_snack">Solu-Cortef  IM </label>
                        <span class="inline"><input type="radio" name="solu" id="solu" value="yes" <?php echo!empty($wiz_14->solu) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="solu" id="solu" value=""  <?php echo empty($wiz_14->solu) ? ' checked ' : '' ?> /><label> No</label></span>

                        <label for="lunch_correction">Other</label>
                        <input type="text" id="troher" name="troher" value="<?php echo $wiz_14->troher ?>" />

                    </section>
                    <section>

                        <label for="insulin_snack">Emergency Injection Kit</label><br>
                        <label for="insulin_snack">In health room </label>
                        <span class="inline"><input type="radio" name="healthroom" id="healthroom" value="yes" <?php echo!empty($wiz_14->healthroom) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="healthroom" id="healthroom" value=""  <?php echo empty($wiz_14->healthroom) ? ' checked ' : '' ?> /><label> No</label></span>

                        <label for="insulin_snack">In classroom </label>
                        <span class="inline"><input type="radio" name="classroom" id="classroom" value="yes" <?php echo!empty($wiz_14->classroom) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="classroom" id="classroom" value=""  <?php echo empty($wiz_14->classroom) ? ' checked ' : '' ?> /><label> No</label></span>

                        <label for="insulin_snack">Carried with Student</label>
                        <span class="inline"><input type="radio" name="carried" id="carried" value="yes" <?php echo!empty($wiz_14->carried) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="carried" id="carried" value=""  <?php echo empty($wiz_14->carried) ? ' checked ' : '' ?> /><label> No</label></span>

                    </section>


                </fieldset>
                <fieldset class="twocol">
                    <section>
                        <label for="insulin_snack">Medical Alert bracelet </label>
                        <span class="inline"><input type="radio" name="bracelet" id="bracelet" value="yes" <?php echo!empty($wiz_14->bracelet) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="bracelet" id="bracelet" value=""  <?php echo empty($wiz_14->bracelet) ? ' checked ' : '' ?> /><label> No</label></span>

                        <label for="insulin_snack">Sick day orders and meds </label>
                        <span class="inline"><input type="radio" name="sickday" id="sickday" value="yes" <?php echo!empty($wiz_14->sickday) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="sickday" id="sickday" value=""  <?php echo empty($wiz_14->sickday) ? ' checked ' : '' ?> /><label> No</label></span>

                        <label for="insulin_snack">Lock Down orders and meds</label>
                        <span class="inline"><input type="radio" name="lockdown" id="lockdown" value="yes" <?php echo!empty($wiz_14->lockdown) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="lockdown" id="lockdown" value=""  <?php echo empty($wiz_14->lockdown) ? ' checked ' : '' ?> /><label> No</label></span>
                        <label for="after_lunch_reason">Additional comments </label>
                        <textarea id="addcomments" name="addcomments"><?php echo $wiz_14->addcomments ?></textarea>
                    </section>
                </fieldset>
            </div>
            <!---- Newest one 1 end----->
            <!---- Newest one 2 start----->
            <legend class="legends">Other Diagnosis</legend>
            <span class="inline hide"><input type="checkbox" onclick="showvalue335(this.value)" id="hide335"  name="hide335" value="on" <?php echo!empty($wiz_14->hide335) ? ' checked ' : '' ?> /> <label for="hide335"><span></span>No needs at this time</label></span>
            <div id="hidename335">
                <fieldset class="twocol">
                    <section>
                        <label for="after_lunch_reasreaon">Diagnosis or health concern </label>
                        <input type="text" id="health_concern"  name="health_concern" value="<?php echo $wiz_14->health_concern ?>" />
                        <label for="after_lunch_reasaeoan">Age at time of diagnosis </label>
                        <input type="text" id="timedia"  name="timedia" value="<?php echo $wiz_14->timedia ?>" />
                        <label for="after_lunch_reason">Symptoms? </label>
                        <input type="text" id="od_sym"  name="od_sym" value="<?php echo $wiz_14->od_sym ?>" />
                        <label for="after_lunch_redaston">How often?</label>
                        <input type="text" id="od_often"  name="od_often" value="<?php echo $wiz_14->od_often ?>" />
                    </section>
                    <section>
                        <label for="after_lunch_rdfeason">Do the symptoms or treatment for symptoms impact your child’s daily schedule or routine?  </label>
                        <span class="inline"><input type="radio" name="routine" id="routine" onclick="showvalue318(this.value)" value="yes" <?php echo!empty($wiz_14->routine) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="routine" id="routine" onclick="showvalue318(this.value)" value=""  <?php echo empty($wiz_14->routine) ? ' checked ' : '' ?> /><label> No</label></span>
                        <div id="hidename318">
                            <label for="after_lunch_reyhason">how and when? </label>
                            <input type="text" id="od_when"  name="od_when" value="<?php echo $wiz_14->od_when ?>" />
                        </div>
                        <label for="after_lunch_reasotn">When was the last visit to the PCP for this condition?</label>
                        <input type="text" id="od_lvisit"  name="od_lvisit" value="<?php echo $wiz_14->od_lvisit ?>" />
                    </section>
                    <section>
                        <label for="after_lunch_reasonnotj">Has your child needed to receive urgent care/ emergency care (and/or surgery) for this condition?    </label>
                        <span class="inline"><input type="radio" name="or_surg" id="or_surg" onclick="showvalue319(this.value)" value="yes" <?php echo 'checked'; ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="or_surg" id="or_surg" onclick="showvalue319(this.value)" value=""  <?php echo $wiz_14->or_surg == "" ? ' checked ' : '' ?> /><label> No</label></span>
                        <div id="hidename319">
                            <label for="after_lunch_reason">How many times ?</label>
                            <input type="text" id="od_times"  name="od_times" value="<?php echo $wiz_14->od_times ?>" />
                            <label for="after_lunch_reason"> Last time: </label>
                            <input type="text" id="od_timelast"  name="od_timelast" value="<?php echo $wiz_14->od_timelast ?>" />
                        </div>
                        <label for="after_lunch_reasonss">Will medications/treatments be needed at school?</label>
                        <span class="inline"><input type="radio" name="od_needschool" id="od_needschool"   value="yes" onclick="showvalue320(this.value)" <?php echo 'checked'; ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="od_needschool" id="od_needschool"   value=""  onclick="showvalue320(this.value)" <?php echo empty($wiz_14->od_needschool) ? ' checked ' : '' ?> /><label> No</label></span>
                        <div id="hidename320">
                            <label for="after_lunch_reason">please list </label>
                            <textarea id="od_desc" name="od_desc"><?php echo $wiz_14->od_desc ?></textarea>
                        </div>
                    </section>

                    <section>
                        <label for="after_lunch_reasonss">Other equipment or supplies needed at school? </label>
                        <span class="inline"><input type="radio" name="o_supp" id="o_supp" onclick="showvalue331(this.value)" value="yes" <?php echo!empty($wiz_14->o_supp) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="o_supp" id="o_supp" onclick="showvalue331(this.value)" value=""  <?php echo empty($wiz_14->o_supp) ? ' checked ' : '' ?> /><label> No</label></span>
                        <div id="hidename331">
                            <label for="after_lunch_reasonss">If yes, please list? </label>
                            <textarea id="o_supp_desc" name="o_supp_desc"><?php echo $wiz_14->o_supp_desc ?></textarea>
                        </div>

                        <label for="childs">Did your child miss school last year due to his/her health condition? (Illness/appointments)  </label>
                        <span class="inline"><input type="radio" name="o_cdue" id="o_cdue" onclick="showvalue332(this.value)" value="yes" <?php echo!empty($wiz_14->o_cdue) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="o_cdue" id="o_cdue" onclick="showvalue332(this.value)" value=""  <?php echo empty($wiz_14->o_cdue) ? ' checked ' : '' ?> /><label> No</label></span>
                        <div id="hidename332">
                            <label for="after_lunch_reasosnssq">If yes, how many </label>
                            <textarea id="o_cdue_desc" name="o_cdue_desc"><?php echo $wiz_14->o_cdue_desc ?></textarea>
                        </div>
                        <label for="o_resqq">Does your child have any activity restriction/ PE Restriction related to this diagnosis?  </label>
                        <span class="inline"><input type="radio" name="o_res" id="o_res" onclick="showvalue333(this.value)" value="yes" <?php echo!empty($wiz_14->o_res) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="o_res" id="o_res" onclick="showvalue333(this.value)" value=""  <?php echo empty($wiz_14->o_res) ? ' checked ' : '' ?> /><label> No</label></span>
                        <div id="hidename333">
                            <label for="after_lunch_reasosaan">If yes, please describe? </label>
                            <textarea id="o_res_desc" name="o_res_desc"><?php echo $wiz_14->o_res_desc ?></textarea>
                        </div>
                        <label for="after_lunch_rddd">Additional Information </label>
                        <textarea id="od_add_info" name="od_add_info"><?php echo $wiz_14->od_add_info ?></textarea>
                    </section>
                </fieldset>
            </div>
            <!---- Newest one 2 end----->
        </fieldset>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(367)" id="hide367"  name="hide367" value="on" <?php echo!empty($wiz_14->hide367) ? ' checked ' : '' ?> /> <label for="hide367" style="margin-right: 10px;"><span></span>No needs at this time</label></span>
            <legend>Educational Status</legend>
            <div class="hide367" >
                <section>
                    <span class="inline"><input type="radio"  value="itp" id="edustatus" name="edustatus" <?php echo ($wiz_14->edustatus == 'itp') ? 'checked' : '' ?> /> <label for="edustatus-itp"><span></span>ITP</label></span>
                    <span class="inline"><input type="radio"  value="eci" id="edustatus" name="edustatus" <?php echo ($wiz_14->edustatus == 'eci') ? ' checked ' : '' ?> /> <label for="edustatus-eci"><span></span>ECI</label></span>
                    <span class="inline"><input type="radio"  value="" id="edustatus" name="edustatus" <?php echo ($wiz_14->edustatus == '') ? ' checked ' : '' ?> /> <label for="edustatus-none"><span></span>None</label></span>
                </section>
                <section>
                    <span class="inline"><input type="checkbox" name="edustatus2_regular" value="yes" id="edustatus2_regular" <?php echo!empty($wiz_14->edustatus2_regular) || in_array('eduregular', $wiz_14->edustatus2) ? ' checked ' : '' ?> /> <label for="edustatus2_regular"><span></span>Regular Education</label></span>
                    <span class="inline"><input type="checkbox" name="edustatus2_iep" value="yes" id="edustatus2_iep" <?php echo!empty($wiz_14->edustatus2_iep) || in_array('eduIEP', $wiz_14->edustatus2) ? ' checked ' : '' ?> /> <label for="edustatus2_iep"><span></span>IEP</label></span>
                    <span class="inline"><input type="checkbox" name="edustatus2_504" value="yes" id="edustatus2_504" <?php echo!empty($wiz_14->edustatus2_504) || in_array('edu504', $wiz_14->edustatus2) ? ' checked ' : '' ?> /> <label for="edustatus2_504"><span></span>504</label></span>
                </section>
                <section>

                    <label for="grade">Current Grade</label>
                    <select name="grade" id="grade" onclick="showvalue357(this.value)" >
                        <option value="Pre-Kindergarten" <?php
                        if ($wiz_14->grade == "Pre-Kindergarten"): echo 'selected="selected"';
                        endif;
                        ?>>Pre-Kindergarten</option>
                        <option value="Kindergarten" <?php
                        if ($wiz_14->grade == "Kindergarten"): echo 'selected="selected"';
                        endif;
                        ?>>Kindergarten</option>
                        <option value="First" <?php
                        if ($wiz_14->grade == "First"): echo 'selected="selected"';
                        endif;
                        ?>>First</option>
                        <option value="Second" <?php
                        if ($wiz_14->grade == "Second"): echo 'selected="selected"';
                        endif;
                        ?>>Second</option>
                        <option value="Third" <?php
                        if ($wiz_14->grade == "Third"): echo 'selected="selected"';
                        endif;
                        ?>>Third</option>
                        <option value="Fourth" <?php
                        if ($wiz_14->grade == "Fourth"): echo 'selected="selected"';
                        endif;
                        ?>>Fourth</option>
                        <option value="Fifth" <?php
                        if ($wiz_14->grade == "Fifth"): echo 'selected="selected"';
                        endif;
                        ?>>Fifth</option>
                        <option value="Sixth" <?php
                        if ($wiz_14->grade == "Sixth"): echo 'selected="selected"';
                        endif;
                        ?>>Sixth</option>
                        <option value="Seventh" <?php
                        if ($wiz_14->grade == "Seventh"): echo 'selected="selected"';
                        endif;
                        ?>>Seventh</option>
                        <option value="Eighth" <?php
                        if ($wiz_14->grade == "Eighth"): echo 'selected="selected"';
                        endif;
                        ?>>Eighth</option>
                        <option value="Ninth" <?php
                        if ($wiz_14->grade == "Ninth"): echo 'selected="selected"';
                        endif;
                        ?>>Ninth</option>
                        <option value="Tenth" <?php
                        if ($wiz_14->grade == "Tenth"): echo 'selected="selected"';
                        endif;
                        ?>>Tenth</option>
                        <option value="Eleventh" <?php
                        if ($wiz_14->grade == "Eleventh"): echo 'selected="selected"';
                        endif;
                        ?>>Eleventh</option>
                        <option value="Twelfth" <?php
                        if ($wiz_14->grade == "Twelfth"): echo 'selected="selected"';
                        endif;
                        ?>>Twelfth</option>
                        <option value="Other" <?php
                        if ($wiz_14->grade == "Other"): echo 'selected="selected"';
                        endif;
                        ?> >Other</option>
                    </select>
                    <div id="hidename357">
                        <label for="grade">Other Grade</label>
                        <input type="text" name="othergrade" id="othergrade" value="<?= !empty($wiz_14->othergrade) ? $wiz_14->othergrade : ''; ?>" />
                    </div>
                </section>
                <section>
                    <label for="assistant">Current Individual Educational Assistant?</label>
                    <span class="inline"><input type="radio" name="assistant" value="yes" id="assistant" <?php echo!empty($wiz_14->assistant) ? ' checked ' : '' ?> /> <label for="assistant"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="assistant" value="" id="assistant" <?php echo empty($wiz_14->assistant) ? ' checked ' : '' ?> /> <label for="assistant"><span></span>No</label></span>
                </section>
                <section>
                    <label for="eduservices">Services Used</label>
                    <div class="check-group">
                        <span class="inline"><input type="checkbox" name="eduservices_occupational" value="yes" id="eduservices_occupational" <?php echo!empty($wiz_14->eduservices_occupational) || in_array('occupationaltherapy', $wiz_14->eduservices) ? ' checked ' : '' ?> /> <label for="eduservices_occupational"><span></span>Occupational Therapy</label></span>
                        <span class="inline"><input type="checkbox" name="eduservices_physical" value="yes" id="eduservices_physical" <?php echo!empty($wiz_14->eduservices_physical) || in_array('physicaltherapy', $wiz_14->eduservices) ? ' checked ' : '' ?> /> <label for="eduservices_physical"><span></span>Physical Therapy</label></span>
                        <span class="inline"><input type="checkbox" name="eduservices_speech" value="yes" id="eduservices_speech" <?php echo!empty($wiz_14->eduservices_speech) || in_array('speechlanguage', $wiz_14->eduservices) ? ' checked ' : '' ?> /> <label for="eduservices_speech"><span></span>Speech/Language</label></span>
                        <span class="inline"><input type="checkbox" name="eduservices_counseling" value="yes" id="eduservices_counseling" <?php echo!empty($wiz_14->eduservices_counseling) || in_array('counseling', $wiz_14->eduservices) ? ' checked ' : '' ?> /> <label for="eduservices_counseling"><span></span>Counseling</label></span><br>
                        <span class="inline"><input type="checkbox" name="eduservices_pe" value="yes" id="eduservices_pe" <?php echo!empty($wiz_14->eduservices_pe) || in_array('adaptivepe', $wiz_14->eduservices) ? ' checked ' : '' ?> /> <label for="eduservices_pe"><span></span>Adaptive PE</label></span>
                    </div>
                </section><div style="clear:both"></div>
                <section>
                    <span class="inline"><input type="checkbox" name="offlocation_hospital" value="yes" id="offlocation_hospital" <?php echo!empty($wiz_14->offlocation_hospital) || in_array('offlocation_hospital', $wiz_14->offlocation) ? ' checked ' : '' ?> /> <label for="offlocation_hospital"><span></span>Home Hospital Teaching</label></span><br>
                    <span class="inline"><input type="checkbox" name="offlocation_home" value="yes" id="offlocation_home" <?php echo!empty($wiz_14->offlocation_home) || in_array('offlocation_home', $wiz_14->offlocation) ? ' checked ' : '' ?> /> <label for="offlocation_home"><span></span>Concurrent Home Teaching</label></span>

                    <label for="reevaldate">Re-Evaluation Date</label>
                    <input type="text" id="reevaldate" name="reevaldate" value="<?php echo $wiz_14->reevaldate ?>" />

                </section>
                <section class="two-col">
                    <label for="assist-tech">Assistive Technology</label>
                    <span class="inline"><input type="radio" name="assist_tech" value="yes" onclick="showvalue355(this.value)" id="assist_tech" checked="checked"/><label for="assist-tech-yes"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="assist_tech" value="" id="assist_tech" onclick="showvalue355(this.value)" <?php echo isset($wiz_14->assist_tech) && $wiz_14->assist_tech == "" ? ' checked ' : '' ?> /><label for="assist-tech-no"><span></span>No</label></span>
                    <div id='hidename355'>
                        <label for="assist-tech-list">Please List Assistive Technology</label>
                        <?php !empty($wiz_14->assist_tech_lt) ? $wiz_14->assist_tech_lt = $wiz_14->assist_tech_lt : ''; ?>
                        <?php !empty($wiz_14->assisttechlist) ? $wiz_14->assist_tech_lt = $wiz_14->assisttechlist : ''; ?>
                        <textarea id="assist_tech_lt" name="assist_tech_lt" ><?php echo $wiz_14->assist_tech_lt ?></textarea>
                    </div>
                </section>
                <div style="clear:both"></div>
                <section class="two-col">
                    <label for="accomodations">Classroom Accomodations <?php echo $wiz_14->accomodations; ?></label>
                    <span class="inline"><input type="radio" name="accomodations" value="yes" id="accomodations" onclick="showvalue356(this.value)" checked="checked"/><label for="accomodations"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="accomodations" value="" id="accomodations" onclick="showvalue356(this.value)" <?php echo isset($wiz_14->accomodations) && $wiz_14->accomodations == "" ? ' checked ' : '' ?> /><label for="accomodations"><span></span>No</label></span>
                    <div id='hidename356'>
                        <label for="accomodations-list">Please List Classroom Accomodations</label>
                        <?php !empty($wiz_14->accomodations_lt) ? $wiz_14->accomodations_lt = $wiz_14->accomodations_lt : ''; ?>
                        <?php !empty($wiz_14->accomodationslist) ? $wiz_14->accomodations_lt = $wiz_14->assisttechlist : ''; ?>
                        <textarea id="accomodations_lt" name="accomodations_lt" ><?php echo $wiz_14->accomodations_lt ?></textarea>
                    </div>
                </section>
            </div>
        </fieldset>
        <fieldset class="new_section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(16)" id="hide16" name="hide16" value="on"  <?php echo!empty($wiz_14->hide16) ? ' checked ' : '' ?> /> <label for="hide16"><span></span>No needs at this time</label></span>
            <legend class="legends">Transportation Status</legend>
            <div class="hide16">
                <fieldset>
                    <section>
                        <label for="trans_method">Method of Transportation</label>

                        <span class="inline"><input type="checkbox" name="trans_method_walker" id="trans_method_walker" value="Walker" <?php echo!empty($wiz_14->trans_method_walker) ? ' checked ' : '' ?> /><label for="trans_method_walker"><span></span> Walker</label></span>
                        <span class="inline"><input type="checkbox" name="trans_method_car" id="trans_method_car" value="Car Rider" <?php echo!empty($wiz_14->trans_method_car) ? ' checked ' : '' ?> /><label for="trans_method_car"><span></span> Car Rider</label></span>
                        <span class="inline"><input type="checkbox" name="trans_method_bus" id="trans_method_bus" value="Bus Rider" <?php echo!empty($wiz_14->trans_method_bus) ? ' checked ' : '' ?> /><label for="trans_method_bus"><span></span> Bus Rider</label></span>
                        <span class="inline"><input type="checkbox" name="trans_method_lift" id="trans_method_lift" value="Lift Bus" <?php echo!empty($wiz_14->trans_method_lift) ? ' checked ' : '' ?> /><label for="trans_method_lift"><span></span> Lift Bus</label></span>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="bus_services">Current Bus Services Provided</label>
                        <span><input type="checkbox" name="bus_services_assist" id="bus_services_assist" value="Assistance Needed" <?php echo!empty($wiz_14->bus_services_assist) ? ' checked ' : '' ?> /><label for="bus_services_assist"><span></span> Assistance Needed</label></span>
                        <span><input type="checkbox" name="bus_services_aide" id="bus_services_aide" value="Aide on Bus" <?php echo!empty($wiz_14->bus_services_aide) ? ' checked ' : '' ?> /><label for="bus_services_aide"><span></span> Aide on Bus</label></span>
                        <span><input type="checkbox" name="bus_services_nursing" id="bus_services_nursing" value="Nursing Services on Bus" <?php echo!empty($wiz_14->bus_services_nursing) ? ' checked ' : '' ?> /><label for="bus_services_nursing"><span></span> Nursing Services on Bus</label></span>
                        <span><input type="checkbox" name="bus_services_equip" id="bus_services_equip" value="Equipment Checklist Used" <?php echo!empty($wiz_14->bus_services_equip) ? ' checked ' : '' ?> /><label for="bus_services_equip"><span></span> Equipment Checklist Used</label></span>
                    </section>
                    <section>
                        <label for="bus_meds">Medication on Bus?</label>
                        <span class="inline"><input type="radio" name="bus_meds" onclick="showvalue19(this.value)" id="bus_meds" value="yes" <?php echo!empty($wiz_14->bus_meds) ? ' checked ' : '' ?> /><label for="bus_meds_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="bus_meds" onclick="showvalue19(this.value)" id="bus_meds" value="" <?php echo empty($wiz_14->bus_meds) ? ' checked ' : '' ?> /><label for="bus_meds_no"><span></span> No</label></span>
                        <div id="divval19" style="display: none">
                            <label for="list_bus_meds">If Yes, List</label>
                            <input type="text" id="list_bus_meds"  name="list_bus_meds" value="<?php echo $wiz_14->list_bus_meds ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="med_bus">How is medication handled?</label>
                        <span><input type="checkbox" name="med_bus_selfadmin" id="med_bus_selfadmin" value="Self Carries/Self Administers" <?php echo!empty($wiz_14->med_bus_selfadmin) ? ' checked ' : '' ?> /><label for="med_bus_selfadmin"><span></span> Self Carries/Self Administers</label></span>
                        <span><input type="checkbox" name="med_bus_selfmed" id="med_bus_selfmed" value="Self Carries/Unable to Self_Administer" <?php echo!empty($wiz_14->med_bus_selfmed) ? ' checked ' : '' ?> /><label for="med_bus_selfmed"><span></span> Self Carries/Unable to Self Administer</label></span>
                        <span><input type="checkbox" name="med_bus_aideadmin" id="med_bus_aideadmin" value="Driver/Aide Trained to Administer" <?php echo!empty($wiz_14->med_bus_aideadmin) ? ' checked ' : '' ?> /><label for="med_bus_aideadmin"><span></span> Driver/Aide Trained to Administer</label></span>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="bus_snacks">Snacks on Bus</label>
                        <span class="inline"><input type="radio" name="bus_snacks" id="bus_snacks" onclick="showvalue50(this.value)" value="yes" <?php echo!empty($wiz_14->bus_snacks) ? ' checked ' : '' ?> /><label for="bus_snacks_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="bus_snacks" id="bus_snacks" onclick="showvalue50(this.value)" value="" <?php echo empty($wiz_14->bus_snacks) ? ' checked ' : '' ?> /><label for="bus_snacks_no"><span></span> No</label></span>
                        <div id="hidename50">
                            <label for="list_bus_meds">list or explain</label>
                            <textarea id="describe_Snacks" name="describe_Snacks"><?php echo $wiz_14->describe_Snacks ?></textarea>
                        </div>
                        <label for="bus_mod">Special Modifications Needed for Bus?</label>
                        <span class="inline"><input type="radio" name="bus_mod" id="bus_mod" onclick="showvalue20(this.value)" value="yes" <?php echo!empty($wiz_14->bus_mod) ? ' checked ' : '' ?> /><label for="bus_mod_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="bus_mod" id="bus_mod" onclick="showvalue20(this.value)" value="" <?php echo empty($wiz_14->bus_mod) ? ' checked ' : '' ?> /><label for="bus_mod_no"><span></span> No</label></span>

                    </section>
                    <div id="divval20" style="display: none">
                        <section>
                            <label for="bus_mod_list">If Yes, List Special Modifications Needed</label>
                            <textarea id="bus_mod_list" name="bus_mod_list"><?php echo $wiz_14->bus_mod_list ?></textarea>
                        </section>
                    </div>
                </fieldset>
                <fieldset>
                    <section class="largetext">
                        <label for="trans_comments">Additional Comments</label>
                        <textarea id="trans_comments" name="trans_comments"><?php echo $wiz_14->trans_comments ?></textarea>
                    </section>
                </fieldset>
                <fieldset>
                    <section class="largetext">
                        <label for="trans_comments">Needs for Field Trips</label>
                        <textarea id="trans_field" name="trans_field"><?php echo $wiz_14->trans_field ?></textarea>
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
                    if (!empty($wiz_14->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_14->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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

        //when should student test
        $('#assessment14').submit(function() {
            var $feed = $('input[name=hide15]:checked', '#assessment14').val();
            var $fields1 = $(this).find('input[name="test_when_arrival"]:checked');
            var $fields2 = $(this).find('input[name="test_when_breakfast"]:checked');
            var $fields3 = $(this).find('input[name="test_when_blunch"]:checked');
            var $fields4 = $(this).find('input[name="test_when_alunch"]:checked');
            var $fields5 = $(this).find('input[name="test_when_bpe"]:checked');
            var $fields6 = $(this).find('input[name="test_when_ape"]:checked');
            var $fields7 = $(this).find('input[name="test_when_snack"]:checked');
            var $fields8 = $(this).find('input[name="test_when_dismissal"]:checked');
            var $fields9 = $(this).find('input[name="test_when_prn"]:checked');
            var $fields10 = $(this).find('input[name="test_when_other"]:checked');
            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && !$fields5.length
                    && !$fields6.length && !$fields7.length && !$fields8.length && !$fields9.length && !$fields10.length) {

                $('.errorchk3').remove();
                $('#chkerror3').append("<span class='errorchk3'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk3').remove();
                return true;
            }
        });
        //Second form
        $('#test_when_other').on('change', function() {
            var selectedval = $('#test_when_other:checkbox:checked').length;
            if (selectedval == 1) {
                $("#othertestdiv").show();
            }
            else {
                $("#othertestdiv").hide();
            }
        });
        $('#insulin_type_other').on('change', function() {
            var selectedval = $('#insulin_type_other:checkbox:checked').length;
            if (selectedval == 1) {
                $("#otherinsdiv").show();
            }
            else {
                $("#otherinsdiv").hide();
            }
        });
        $(function() {
            $("select#test_when_other").change();
            $("select#insulin_type_other").change();
        });
        //Insulin Delivery
        $('#assessment14').submit(function() {
            var $feed = $('input[name=hide15]:checked', '#assessment14').val();
            var $fields1 = $(this).find('input[name="insulin_type_syringe"]:checked');
            var $fields2 = $(this).find('input[name="insulin_type_pen"]:checked');
            var $fields3 = $(this).find('input[name="insulin_type_pump"]:checked');
            var $fields4 = $(this).find('input[name="insulin_type_pod"]:checked');
            var $fields5 = $(this).find('input[name="insulin_type_other"]:checked');
            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && !$fields5.length) {
                $('.errorchk').remove();
                $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk').remove();
                return true;
            }
        });
        //Autosave
        setInterval(function() {
            var queryString = $('#assessment14').serialize();
            var baseurl = '<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end
        var discrete = $('#discrete').val();
        var assist = $('#test_ind_assist').val();
        if (discrete == 'yes') {
            showvalue18();
        }
        if (assist == 'Assistance Needed') {
            showvalue17();
        }
    });
</script>