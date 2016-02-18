<style>
    select{
        width:auto!important;
    }
    .error{
        color: red;
    }
    .errorchk,.errorchk2,.errorchk3,.errorchk4,.errorchk5,.errorchk6,.errorchk7,.errorchk8,.errorchk9,.errorchk10,.errorchk11,.errorchk12,.errorchk15,.errorchk16,.errorchk17,.errorchk18,.errorchk19{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
    .agency{

    }

</style>

<?php
$copy = $this->session->userdata('copy_assigned_unique_number_appraisal');
$diagnosis_array = array();
$diagnosis_array = explode(',', $wizardData->newdiagnosis);
$i = 0;
// load dashboard admin menu
$this->load->view("menu/top_menu");
if (empty($wizardData->sif)):
    $wizardData = $autosave;
endif;
//echo $wizardData->tube_feedings;
$attr_FormSave_appraisal = array('id' => 'appraisal', 'name' => 'appraisal_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormSubmit_appraisal = array('class' => 'save', 'id' => 'appraisal6', 'name' => 'appraisal6', 'value' => 'Next', 'type' => 'submit');
$attr_FormOpen = array('id' => "appraisal6", 'class' => "healthform");
$sif = array('name' => 'sif', 'type' => 'hidden');
if (!empty($copy)):
    $wizardData = "";
endif;

//Wizard data is empty while copy assessment / appraisal
$previous = $this->uri->segment(4);
$sessionval = $this->session->userdata('copy_assigned_unique_number_appraisal');
if (!empty($sessionval) && !empty($previous) && $previous == "copy"):
    $wizardData = array();
endif;
?>

<section class="page">
    <h1><?= $subtitle ?></h1>
    <?= form_open("{$action}", $attr_FormOpen); ?>
    <fieldset class="new-section">
        <span class="inline hide"><input type="checkbox" onclick="hideSection(14)" id="hide14" value="on" name="hide14"  /> <label for="hide14"><span></span>Not Applicable</label></span>
        <legend>Nutrition and Feeding Safety Requirements</legend>
        <div class="hide14">
            <fieldset>
                <section>
                    <span class="inline"><input type="radio" name="diet" id="diet" onclick="showvalue306(this.value)" value="Nothing By Mouth"  <?php echo ($wizardData->diet == "Nothing By Mouth") ? ' checked ' : '' ?> /><label for="diet_nothing"><span></span> Nothing By Mouth</label></span><br/>
                    <span class="inline"><input type="radio" name="diet" id="diet" onclick="showvalue306(this.value)"  value="Regular Diet" <?php echo ($wizardData->diet == "Regular Diet") ? ' checked ' : '' ?> /><label for="diet_reg"><span></span> Regular Diet</label></span><br/>
                    <span class="inline"><input type="radio" name="diet" id="diet" onclick="showvalue306(this.value)" value="Special Diet"  <?php echo ($wizardData->diet == "Special Diet") ? ' checked ' : '' ?> /><label for="diet_special"><span></span> Special Diet</label></span>
                    <div id="hidename306">
                        <label for="food_texture">Description</label>
                        <input type="text" id="food_texture" name="food_texture" value="<?php echo $wizardData->food_texture ?>" />
                    </div>
                    <br/><br/>
                    <span><input type="checkbox" name="prepare_parent" id="prepare_parent" value="Parent Prepares" <?php echo!empty($wizardData->prepare_parent) ? ' checked ' : '' ?> /><label for="prepare_parent"><span></span> Parent Prepares</label></span>
                    <span><input type="checkbox" name="prepare_school" id="prepare_school" value="School Cafe Prepares" <?php echo!empty($wizardData->prepare_school) ? ' checked ' : '' ?>  /><label for="prepare_school"><span></span> School Cafe Prepares</label></span>

                </section>
                <section>
                    <label for="food_restriction">Other Dietary Restriction</label>
                    <textarea name="food_restriction" id="food_restriction"><?= !empty($wizardData->food_restriction) ? $wizardData->food_restriction : ''; ?></textarea>

                    <label for="fluid_restriction">Fluid Consistency/Restrictions</label>
                    <textarea name="fluid_restriction" id="fluid_restriction"><?= !empty($wizardData->fluid_restriction) ? $wizardData->fluid_restriction : ''; ?></textarea>
                </section>
            </fieldset>
            <fieldset>
                <section>
                    <label for="feeding_assist">Feeding Assistance Needed?</label>
                    <span class="inline"><input type="radio" name="feeding_assist" onclick="showvalue340(this.value)" id="feeding_assist" value="yes" <?php echo!empty($wizardData->feeding_assist) ? ' checked ' : '' ?> /><label for="feeding_assist_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="feeding_assist"  onclick="showvalue340(this.value)"   id="feeding_assist" value="" <?php echo empty($wizardData->feeding_assist) ? ' checked ' : '' ?> /><label for="feeding_assist_no"><span></span> No</label></span>
                    <div id="hidename340">
                        <label for="feeding_type">If Yes, what assistance is needed?</label>
                        <span><input type="checkbox" name="feeding_type_total" id="feeding_type_total" value="Total" <?php echo!empty($wizardData->feeding_type_total) ? ' checked ' : '' ?> /><label for="feeding_type_total"><span></span> Total</label></span>
                        <span><input type="checkbox" name="feeding_type_assess" id="feeding_type_assess" value="Assessing food only" <?php echo!empty($wizardData->feeding_type_assess) ? ' checked ' : '' ?> /><label for="feeding_type_assess"><span></span> Assessing food only</label></span>
                        <span><input type="checkbox" name="feeding_type_open" id="feeding_type_open" value="Opening containers" <?php echo!empty($wizardData->feeding_type_open) ? ' checked ' : '' ?> /><label for="feeding_type_open"><span></span> Opening containers</label></span>
                        <span><input type="checkbox" name="feeding_type_cutting" id="feeding_type_cutting" value="Cutting food" <?php echo!empty($wizardData->feeding_type_cutting) ? ' checked ' : '' ?> /><label for="feeding_type_cutting"><span></span> Cutting food</label></span>
                    </div>
                    <div id="chkerror"></div>
                </section>
                <section>
                    <label for="feeding_tube">Feeding Tube?</label>
                    <span class="inline"><input type="radio" name="feeding_tubeval"  id="feeding_tubeval" onclick="showvalue339(this.value)" value="yes" <?php echo!empty($wizardData->feeding_tubeval) ? ' checked ' : '' ?> /><label for="feeding_assist_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="feeding_tubeval"    id="feeding_tubeval" onclick="showvalue339(this.value)" value="" <?php echo empty($wizardData->feeding_tubeval) ? ' checked ' : '' ?> /><label for="feeding_assist_no"><span></span> No</label></span>
                    <div id="hidename339">
                        <label for="feeding_tube">If Yes, what Feeding Tube is needed</label>
                        <span><input type="checkbox" name="feeding_tube_mic" id="feeding_tube_mic" value="Mic_key Button" <?php echo!empty($wizardData->feeding_tube_mic) ? ' checked ' : '' ?> /><label for="feeding_tube_mic"><span></span> Button</label></span>
                        <span><input type="checkbox" name="feeding_tube_peg" id="feeding_tube_peg" value="PEG Tube" <?php echo!empty($wizardData->feeding_tube_peg) ? ' checked ' : '' ?> /><label for="feeding_tube_peg"><span></span> PEG Tube</label></span>
                        <span><input type="checkbox" name="feeding_tube_jtube" id="feeding_tube_jtube" value="J_Tube" <?php echo!empty($wizardData->feeding_tube_jtube) ? ' checked ' : '' ?> /><label for="feeding_tube_jtube"><span></span> J-Tube</label></span>
                        <span><input type="checkbox" name="feeding_tube_ng" id="feeding_tube_ng" value="N/G Tube" <?php echo!empty($wizardData->feeding_tube_ng) ? ' checked ' : '' ?> /><label for="feeding_tube_ng"><span></span> N/G Tube</label></span>
                        <span><input type="checkbox" name="feeding_tube_gj" id="feeding_tube_gj" value="G/J Tube" <?php echo!empty($wizardData->feeding_tube_gj) ? ' checked ' : '' ?> /><label for="feeding_tube_gj"><span></span> G/J-Tube</label></span>
                        <div id="chkerror2"></div>

                        <label for="gtube_size">G-Tube Size</label>
                        <input type="text" id="gtube_size" name="gtube_size" value="<?php echo $wizardData->gtube_size ?>" />

                        <label for="tube_type">Type</label>
                        <input type="text" id="tube_type" name="tube_type" value="<?php echo $wizardData->tube_type ?>" />
                    </div>
                </section>

            </fieldset>
            <fieldset>
                <section>
                    <label for="inst_dislodged">Instructions if dislodged at school</label>
                    <textarea name="inst_dislodged" id="inst_dislodged"><?= !empty($wizardData->inst_dislodged) ? $wizardData->inst_dislodged : ''; ?></textarea>
                </section>
                <section>
                    <label for="tube_feedings">Tube Feedings</label>
                    <span class="inline"><input type="checkbox" name="tube_feedings_bolus" onclick="showvalue307(this.value)" id="tube_feedings_bolus" value="Bolus" <?php echo!empty($wizardData->tube_feedings_bolus) ? ' checked ' : '' ?> /> <label for="tube_feedings_bolus"><span></span> Bolus</label></span>
                    <span class="inline"><input type="checkbox" name="tube_feedings_pump"  onclick="showvalue307(this.value)" id="tube_feedings_pump" value="Pump" <?php echo!empty($wizardData->tube_feedings_pump) ? ' checked ' : '' ?> /> <label for="tube_feedings_pump"><span></span> Pump</label></span>
                    <div id="hidename307">
                        <label for="feed_freq">Type/Time/Frequency (in hours)/Amount</label>
                        <input type="text" id="feed_freq" name="feed_freq" value="<?php echo $wizardData->feed_freq ?>" />
                    </div>
                </section>

            </fieldset>
            <fieldset>
                <section>
                    <label for="water_flush">Water Flush?</label>
                    <span class="inline"><input type="radio" name="water_flush" id="water_flush_yes" value="Yes" <?= !empty($wizardData->{'water_flush'}) ? ' checked ' : ''; ?> /><label for="water_flush_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="water_flush" id="water_flush_no" value="" <?= empty($wizardData->{'water_flush'}) ? ' checked ' : ''; ?> /><label for="water_flush_no"><span></span> No</label></span>

                    <label for="free_water">Free Water?</label>
                    <span class="inline"><input type="radio" name="free_water" id="free_water_yes" value="Yes" <?= !empty($wizardData->{'free_water'}) ? ' checked ' : ''; ?> /><label for="free_water_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="free_water" id="free_water_no" value="" <?= empty($wizardData->{'free_water'}) ? ' checked ' : ''; ?> /><label for="free_water_no"><span></span> No</label></span>

                    <label for="fundo">Fundoplication?</label>
                    <span class="inline"><input type="radio" name="fundo" id="fundo_yes" value="Yes" <?= !empty($wizardData->{'fundo'}) ? ' checked ' : ''; ?> /><label for="fundo_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="fundo" id="fundo_no" value="" <?= empty($wizardData->{'fundo'}) ? ' checked ' : ''; ?> /><label for="fundo_no"><span></span> No</label></span>

                </section>

                <section>
                    <label for="swallow_study">Last Swallow Study</label>
                    <span class="inline"><input type="checkbox" name="swallow_vfss" id="swallow_vfss" value="VFSS" <?php echo!empty($wizardData->swallow_vfss) ? ' checked ' : '' ?> /> <label for="swallow_vfss"><span></span> VFSS</label></span>
                    <span class="inline"><input type="checkbox" name="swallow_endo" id="swallow_endo" value="Endo" <?php echo!empty($wizardData->swallow_endo) ? ' checked ' : '' ?> /> <label for="swallow_endo"><span></span> Endo</label></span>
                    <div id="chkerror4"></div>
                    <label for="swallow_study_date">Date of Study</label>
                    <input type="text" id="swallow_study_date" name="swallow_study_date" value="<?= !empty($wizardData->swallow_study_date) ? $wizardData->swallow_study_date : ''; ?>"  />

                    <label for="swallow_study_loc">Location of Study</label>
                    <input type="text" id="swallow_study_loc" name="swallow_study_loc" value="<?= !empty($wizardData->swallow_study_loc) ? $wizardData->swallow_study_loc : ''; ?>"   />

                </section>
                <section>
                    <label for="reflux">Reflux?</label>
                    <span class="inline"><input type="radio" name="reflux" id="reflux_yes" value="Yes" onclick="showvalue341(this.value)" <?= !empty($wizardData->{'reflux'}) ? ' checked ' : ''; ?> /><label for="reflux_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="reflux" id="reflux_no" value="" onclick="showvalue341(this.value)" <?= empty($wizardData->{'reflux'}) ? ' checked ' : ''; ?> /><label for="reflux_no"><span></span> No</label></span>
                    <div id="hidename341">
                        <label for="reflux_tx">Treatment</label>
                        <input type="text" id="reflux_tx" name ="reflux_tx" value="<?= !empty($wizardData->reflux_tx) ? $wizardData->reflux_tx : ''; ?>"  />
                    </div>
                    <!--
                                        <label for="ordering_doc">Ordering MD</label>
                                        <input type="text" id="ordering_doc" name="ordering_doc" value="<? #= !empty($wizardData->ordering_doc) ? $wizardData->ordering_doc : '';                                 ?>"  />
                    -->
                </section>
            </fieldset>
            <fieldset class="threecol">
                <section>
                    <label for="clinic">Feeding Clinic?</label>
                    <span class="inline"><input type="radio" name="clinic" id="clinic_yes" value="yes" onclick="showvalue353(this.value)"  <?= !empty($wizardData->{'clinic'}) ? ' checked ' : ''; ?> /><label for="clinic_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="clinic" id="clinic_no" value="" onclick="showvalue353(this.value)"  <?= empty($wizardData->{'clinic'}) ? ' checked ' : ''; ?> /><label for="clinic_no"><span></span> No</label></span>
                    <div id="hidename353">
                        <label for="clinic_details">Where and How Often?</label>
                        <input type="text" id="clinic_details" name="clinic_details"  value="<?= !empty($wizardData->clinic_details) ? $wizardData->clinic_details : ''; ?>"  />
                    </div>
                </section>
                <section>
                    <label for="smart_team">AACPS SMART Team Managing?</label>
                    <span class="inline"><input type="radio" name="smart_team" id="smart_team_yes" value="yes" onclick="showvalue354(this.value)" <?= !empty($wizardData->{'smart_team'}) ? ' checked ' : ''; ?>  /><label for="smart_team_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="smart_team" id="smart_team_no" onclick="showvalue354(this.value)" value="" <?= empty($wizardData->{'smart_team'}) ? ' checked ' : ''; ?> /><label for="smart_team_no"><span></span> No</label></span>
                    <div id="hidename354">
                        <label for="smart_manager">Case Manager</label>
                        <input type="text" id="smart_manager" name="smart_manager" value="<?= !empty($wizardData->smart_manager) ? $wizardData->smart_manager : ''; ?>"  />
                    </div>
                    <label for="meal_care">Mealtime Plan of Care</label>
                    <textarea id="meal_care" name="meal_care"><?= !empty($wizardData->meal_care) ? $wizardData->meal_care : ''; ?></textarea>
                </section>
            </fieldset>
            <fieldset>
                <section class="largetext">
                    <label for="nutr_comments">Additional Comments</label>
                    <textarea id="nutr_comments" name="nutr_comments"><?= !empty($wizardData->nutr_comments) ? $wizardData->nutr_comments : ''; ?></textarea>
                </section>
            </fieldset>
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
        <span class="inline hide"><input type="checkbox" onclick="hideSection(15)" id="hide15" name="hide15"  /> <label for="hide15"><span></span>Not Applicable</label></span>
        <legend>Diabetes Management</legend>
        <div class="hide15">
            <fieldset class="wide threecol">
                <section>
                    <label for="gluc_test">Tests blood glucose at school?</label>
                    <span class="inline"><input type="radio" name="gluc_test" id="gluc_test_yes" vallue="Yes" <?= !empty($wizardData->{'gluc_test'}) ? ' checked ' : ''; ?> /> <label><span for="gluc_test_yes"></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="gluc_test" id="gluc_test_no" vallue="" <?= empty($wizardData->{'gluc_test'}) ? ' checked ' : ''; ?> /> <label><span for="gluc_test_no"></span> No</label></span>

                    <label for="test_when">When should student test?</label>
                    <div class="col_one" style="float:left;">
                        <span><input type="checkbox" name="test_when_arrival" id="test_when_arrival" value="On arrival" <?= !empty($wizardData->{'test_when_arrival'}) ? ' checked ' : ''; ?> /> <label for="test_when_arrival"><span></span> On arrival</label></span>
                        <span><input type="checkbox" name="test_when_breakfast" id="test_when_breakfast" value="Before Breakfast" <?= !empty($wizardData->{'test_when_breakfast'}) ? ' checked ' : ''; ?> /> <label for="test_when_breakfast"><span></span> Before Breakfast</label></span>
                        <span><input type="checkbox" name="test_when_blunch" id="test_when_blunch" value="Before lunch" <?= !empty($wizardData->{'test_when_blunch'}) ? ' checked ' : ''; ?> /> <label for="test_when_blunch"><span></span> Before lunch</label></span>
                        <span><input type="checkbox" name="test_when_alunch" id="test_when_alunch" value="After lunch" <?= !empty($wizardData->{'test_when_alunch'}) ? ' checked ' : ''; ?> /> <label for="test_when_alunch"><span></span> After lunch</label></span>
                        <span><input type="checkbox" name="test_when_bpe" id="test_when_bpe" value="Before PE" <?= !empty($wizardData->{'test_when_bpe'}) ? ' checked ' : ''; ?> /> <label for="test_when_bpe"><span></span> Before PE</label></span>
                    </div>
                    <div class="col_two" dtyle="float:left; padding-left:10px;">
                        <span><input type="checkbox" name="test_when_ape" id="test_when_ape" value="After PE" <?= !empty($wizardData->{'test_when_ape'}) ? ' checked ' : ''; ?> /> <label for="test_when_ape"><span></span> After PE</label></span>
                        <span><input type="checkbox" name="test_when_snack" id="test_when_snack" value="Before Snacks" <?= !empty($wizardData->{'test_when_snack'}) ? ' checked ' : ''; ?> /> <label for="test_when_snack"><span></span> Before Snacks</label></span>
                        <span><input type="checkbox" name="test_when_dismissal" id="test_when_dismissal" value="Before Dismissal" <?= !empty($wizardData->{'test_when_dismissal'}) ? ' checked ' : ''; ?> /> <label for="test_when_dismissal"><span></span> Before Dismissal</label></span>
                        <span><input type="checkbox" name="test_when_other" id="test_when_other" value="other" <?php echo!empty($wizardData->test_when_other) ? ' checked ' : '' ?> /> <label for="test_when_other"><span></span> Other</label></span>
                    </div>

                    <br><br><br><br>
                    <div id="chkerror12"></div>
                    <div id="othertestdiv">
                        <label for="test_whends">Please specify</label>
                        <span class="inline"><input type="text" name="othertest" id="othertest" value="<?= !empty($wizardData->othertest) ? $wizardData->othertest : ''; ?>" /></span>
                    </div>
                </section>
                <section>
                    <label for="test_ind">Level of Independence</label>
                    <span><input type="checkbox" name="test_ind_outhr" onclick="showvalue17()" id="test_ind_outhr" value="Independent (outside HR)" <?php echo!empty($wizardData->test_ind_outhr) ? ' checked ' : '' ?> /> <label for="test_ind_outhr"><span></span> Independent (outside HR)</label></span>
                    <span><input type="checkbox" name="test_ind_inhr" onclick="showvalue17()"  id="test_ind_inhr" value="Independent (in HR)" <?php echo!empty($wizardData->test_ind_inhr) ? ' checked ' : '' ?> /> <label for="test_ind_inhr"><span></span> Independent (in HR)</label></span>
                    <span><input type="checkbox" name="test_ind_super" onclick="showvalue17()"  id="test_ind_super" value="Supervision Only" <?php echo!empty($wizardData->test_ind_super) ? ' checked ' : '' ?> /> <label for="test_ind_super"><span></span> Supervision Only</label></span>
                    <span><input type="checkbox" name="test_ind_assist" onclick="showvalue17()"  id="test_ind_assist" value="Assistance Needed" <?php echo!empty($wizardData->test_ind_assist) ? ' checked ' : '' ?> /> <label for="test_ind_assist"><span></span> Assistance Needed</label></span>
                    <span><input type="checkbox" name="test_ind_dep" onclick="showvalue17()"  id="test_ind_dep" value="Dependent" <?php echo!empty($wizardData->test_ind_dep) ? ' checked ' : '' ?> /> <label for="test_ind_dep"><span></span> Dependent</label></span>
                </section>
                <!--                <div id="divval17" style="display: none">
                                    <section>
                                        <label for="test_assist">If assistance is needed, describe</label>
                                        <textarea id="test_assist" name="test_assist"><?php #echo $wizardData->test_assist                                                                  ?></textarea>
                                    </section>
                                </div>-->
            </fieldset>
            <fieldset>
                <section>
                    <label for="target">Target Range</label>
                    <input type="text" id="target" name="target" value="<?= !empty($wizardData->target) ? $wizardData->target : ''; ?>"  />

                    <label for="insulin_type">Insulin Delivery</label>
                    <div class="col_two">
                        <span><input type="checkbox" name="insulin_type_syringe" id="insulin_type_syringe" value="syringe" <?php echo!empty($wizardData->insulin_type_syringe) ? ' checked ' : '' ?> /> <label for="insulin_type_syringe"><span></span> Syringe </label></span>
                        <span><input type="checkbox" name="insulin_type_pen" id="insulin_type_pen" value="pen" <?php echo!empty($wizardData->insulin_type_pen) ? ' checked ' : '' ?> /> <label for="insulin_type_pen"><span></span> Insulin Pen </label></span>
                        <!--<span><input type="checkbox" name="insulin_type_pump" id="insulin_type_pump" value="pump" <?php #echo!empty($wizardData->insulin_type_pump) ? ' checked ' : ''                                                                  ?> /> <label for="insulin_type_pump"><span></span> Pump </label></span>-->
                        <span><input type="checkbox" name="insulin_type_pod" id="insulin_type_pod" value="pod" <?php echo!empty($wizardData->insulin_type_pod) ? ' checked ' : '' ?> /> <label for="insulin_type_pod"><span></span> Pod </label></span>
                        <span><input type="checkbox" name="insulin_type_other" id="insulin_type_other" value="other" <?php echo!empty($wizardData->insulin_type_other) ? ' checked ' : '' ?> /> <label for="insulin_type_other"><span></span> Other </label></span>
                        <div id="chkerror3"></div>
                    </div>
                    <div id="otherinsdiv">
                        <label for="test_when">Please specify</label>
                        <input type="text" name="otherins" id="otherins" value="<?= !empty($wizardData->otherins) ? $wizardData->otherins : ''; ?>" />
                    </div>
                    <label class="clear" for="insulin_manu">Manufacturer</label>
                    <input type="text" id="insulin_manu" name="insulin_manu" value="<?= !empty($wizardData->insulin_manu) ? $wizardData->insulin_manu : ''; ?>"  />
                </section>
                <section>
                    <label for="insulin_school">Insulin at school?</label>
                    <span class="inline"><input type="radio" name="insulin_school" id="insulin_school_yes" value="Yes" <?= !empty($wizardData->{'insulin_school'}) ? ' checked ' : ''; ?> /> <label for="insulin_school_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="insulin_school" id="insulin_school_no" value="" <?= empty($wizardData->{'insulin_school'}) ? ' checked ' : ''; ?> /> <label for="insulin_school_no"><span></span> No</label></span>

                    <label for="type_ins_school">Type of insulin</label>
                    <input type="text" id="type_ins_school" name="type_ins_school" value="<?= !empty($wizardData->type_ins_school) ? $wizardData->type_ins_school : ''; ?>"  />
                </section>
                <section>
                    <label for="dose">How is dose calculated?</label>
                    <span><input type="checkbox" name="dose_correct" id="dose_correct" value="Correction factor/carb ratio"  <?php echo!empty($wizardData->dose_correct) ? ' checked ' : '' ?> /> <label for="dose_correct"><span></span> Correction factor/carb ratio</label></span>
                    <span><input type="checkbox" name="dose_standard" id="dose_standard" value="Standard lunch dose" <?php echo!empty($wizardData->dose_standard) ? ' checked ' : '' ?> /> <label for="dose_standard"><span></span> Standard lunch dose</label></span>
                    <span><input type="checkbox" name="dose_slide" id="dose_slide" value="Sliding scale" <?php echo!empty($wizardData->dose_slide) ? ' checked ' : '' ?> /> <label for="dose_slide"><span></span> Sliding scale</label></span>
                    <span><input type="checkbox" name="dose_pump" id="dose_pump" value="Pump calculations" <?php echo!empty($wizardData->dose_pump) ? ' checked ' : '' ?> /> <label for="dose_pump"><span></span> Pump/Pod Calculations</label></span>
                </section>
            </fieldset>
            <fieldset class="threecol">
                <section>
                    <label for="before_lunch">Insulin before lunch?</label>
                    <span class="inline"><input type="radio" name="before_lunch" id="before_lunch_yes" value="Yes" onclick="showvalue346(this.value)" <?= !empty($wizardData->{'before_lunch'}) ? ' checked ' : ''; ?>  /> <label for="before_lunch_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="before_lunch" id="before_lunch_no" value="" onclick="showvalue346(this.value)" <?= empty($wizardData->{'before_lunch'}) ? ' checked ' : ''; ?> /> <label for="before_lunch_no"><span></span> No</label></span>
                    <div id="hidename346">
                        <label for="lunch_correction">Lunch Correction Factor</label>
                        <input type="text" id="lunch_correction" name="lunch_correction"  value="<?= !empty($wizardData->lunch_correction) ? $wizardData->lunch_correction : ''; ?>"  />
                    </div>
                    <label for="insulin_snack">Insulin for Snack Order?</label>
                    <span class="inline"><input type="radio" name="insulin_snack" id="insulin_snack_yes" value="Yes" <?= !empty($wizardData->{'insulin_snack'}) ? ' checked ' : ''; ?> /> <label for="insulin_snack_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="insulin_snack" id="insulin_snack_no" value="" <?= empty($wizardData->{'insulin_snack'}) ? ' checked ' : ''; ?> /> <label for="insulin_snack_no"><span></span> No</label></span>

                </section>
                <section>
                    <label for="counts_carbs">Counts Carbs?</label>
                    <span class="inline"><input type="radio" name="counts_carbs" id="counts_carbs_yes" value="Yes" onclick="showvalue347(this.value)" <?= 'checked'; ?> /> <label for="counts_carbs_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="counts_carbs" id="counts_carbs_no" value="" onclick="showvalue347(this.value)" <?= $wizardData->counts_carbs == "" ? ' checked ' : ''; ?> /> <label for="counts_carbs_no"><span></span> No</label></span>
                    <div id="hidename347">
                        <label for="lunch_carb">Lunch Carb Ratio</label>
                        <input type="text" id="lunch_carb" name="lunch_carb"  value="<?= !empty($wizardData->lunch_carb) ? $wizardData->lunch_carb : ''; ?>"  />

                        <label for="snack_carb">Snack Carb Ratio</label>
                        <input type="text" id="snack_carb" name="snack_carb" value="<?= !empty($wizardData->snack_carb) ? $wizardData->snack_carb : ''; ?>"  />
                    </div>
                </section>
                <section>
                    <label for="after_lunch_reason">Insulin may be given after lunch if</label>
                    <textarea id="after_lunch_reason" name="after_lunch_reason"><?= !empty($wizardData->after_lunch_reason) ? $wizardData->after_lunch_reason : ''; ?></textarea>

                </section>
            </fieldset>
            <fieldset class="threecol">
                <section>
                    <label for="school_breakfast">Breakfast at School?</label>
                    <span class="inline"><input type="radio" name="school_breakfast" id="school_breakfast_yes" value="Yes" onclick="showvalue348(this.value)" <?= !empty($wizardData->{'school_breakfast'}) ? ' checked ' : ''; ?> /> <label for="school_breakfast_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="school_breakfast" id="school_breakfast_no" value="" onclick="showvalue348(this.value)" <?= empty($wizardData->{'school_breakfast'}) ? ' checked ' : ''; ?> /> <label for="school_breakfast_no"><span></span> No</label></span>
                    <div id="hidename348">
                        <label for="break_carb">Breakfast Carb Ratio</label>
                        <textarea id="break_carb" name="break_carb"><?= !empty($wizardData->break_carb) ? $wizardData->break_carb : ''; ?></textarea>
                    </div>
                </section>
                <section>
                    <label for="school_glucagon">Glucagon at School?</label>
                    <span class="inline"><input type="radio" name="school_glucagon" id="school_glucagon_yes" value="Yes" onclick="showvalue349(this.value)" <?= !empty($wizardData->{'school_glucagon'}) ? ' checked ' : ''; ?> /> <label for="school_glucagon_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="school_glucagon" id="school_glucagon_no" value="" onclick="showvalue349(this.value)" <?= empty($wizardData->{'school_glucagon'}) ? ' checked ' : ''; ?> /> <label for="school_glucagon_no"><span></span> No</label></span>
                    <div id="hidename349">
                        <label for="glucagon_order">Glucagon Order (dose/symptoms)</label>
                        <textarea id="glucagon_order" name="glucagon_order"><?= !empty($wizardData->glucagon_order) ? $wizardData->glucagon_order : ''; ?></textarea>
                    </div>
                </section>
<!--                <section>
                    <label for="hypo_treatment">Treatment for Hypoglycemia</label>
                    <textarea id="hypo_treatment" name="hypo_treatment"><? #= !empty($wizardData->hypo_treatment) ? $wizardData->hypo_treatment : '';                ?></textarea>
                </section>-->
            </fieldset>
            <fieldset class="threecol">

                <section>
                    <label for="emer_kit">Emergency Kit</label>
                    <span><input type="checkbox" name="emer_kit_hrs" id="emer_kit_hrs" value="In HR" <?= !empty($wizardData->{'emer_kit_hrs'}) ? ' checked ' : ''; ?> /> <label for="emer_kit_hrs"><span></span> In HR</label></span>
                    <span><input type="checkbox" name="emer_kit_class" id="emer_kit_class" value="In Classroom" <?= !empty($wizardData->{'emer_kit_class'}) ? ' checked ' : ''; ?> /> <label for="emer_kit_class"><span></span> In Classroom</label></span>
                    <span><input type="checkbox" name="emer_kit_carry" id="emer_kit_carry" value="Carried with Student" <?= !empty($wizardData->{'emer_kit_carry'}) ? ' checked ' : ''; ?> /> <label for="emer_kit_carry"><span></span> Carried with Student</label></span>
                </section>
                <section>
                    <label for="kit_contents">Emergency Kit Contents</label>
                    <span><input type="checkbox" name="kit_contents_glucose_gel" id="kit_contents_glucose_gel" value="Glucose Gel/Cake Mate" <?= !empty($wizardData->{'kit_contents_glucose_gel'}) ? ' checked ' : ''; ?> /> <label for="kit_contents_glucose_gel"><span></span> Glucose Gel/Cake Mate</label></span>
                    <span><input type="checkbox" name="kit_contents_glucose_tabs" id="kit_contents_glucose_tabs" value="Glucose Tabs" <?= !empty($wizardData->{'kit_contents_glucose_tabs'}) ? ' checked ' : ''; ?> /> <label for="kit_contents_glucose_tabs"><span></span> Glucose Tabs</label></span>
                    <span><input type="checkbox" name="kit_contents_juice" id="kit_contents_juice" value="Juice" <?= !empty($wizardData->{'kit_contents_juice'}) ? ' checked ' : ''; ?> /> <label for="kit_contents_juice"><span></span> Juice</label></span>
                    <span><input type="checkbox" name="kit_contents_snacks" id="kit_contents_snacks" value="Snack(s)" value="<?= !empty($wizardData->kit_contents_snacks) ? $wizardData->kit_contents_snacks : ''; ?>" /> <label for="kit_contents_snacks"><span></span> Snack(s)</label></span>
                    <input type="text" id="emer_snacks" name="emer_snacks"  value="<?= !empty($wizardData->emer_snacks) ? $wizardData->emer_snacks : ''; ?>"  />
                </section>
                <section>
                    <label for="hyper_treatment">Treatment for Hypoglycemia if different than Standard Emergency Action Plan</label>
                    <textarea id="hyper_treatment" name="hyper_treatment"><?= !empty($wizardData->hyper_treatment) ? $wizardData->hyper_treatment : ''; ?></textarea>
                </section>
                <section>
                    <label for="hyper_treatment">Treatment for Hyperglycemia if different than Standard Emergency Action Plan</label>
                    <textarea id="hypergly_treatment" name="hypergly_treatment"><?= !empty($wizardData->hypergly_treatment) ? $wizardData->hypergly_treatment : ''; ?></textarea>
                </section>
            </fieldset>
            <fieldset class="threecol">
                <section>
                    <label for="insulin_key">Insulin for Ketones</label>
                    <span class="inline"><input type="radio" name="insulin_key" onclick="showvalue309(this.value)" id="insulin_key_yes" value="Yes" <?= !empty($wizardData->{'insulin_key'}) ? ' checked ' : ''; ?> /> <label for="insulin_key_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="insulin_key" onclick="showvalue309(this.value)" id="insulin_key_no" value="" <?= empty($wizardData->{'insulin_key'}) ? ' checked ' : ''; ?> /> <label for="insulin_key_no"><span></span> No</label></span>
                    <div id="hidename309">
                        <label for="insulin_key_order">Insulin for Ketones Order</label>
                        <textarea id="insulin_key_order" name="insulin_key_order"><?= !empty($wizardData->insulin_key_order) ? $wizardData->insulin_key_order : ''; ?></textarea>
                    </div>
                </section>
                <section>
                    <label for="discrete">Discretionary Orders</label>
                    <span class="inline"><input type="radio" name="discrete" onclick="showva22(this.value)" id="discrete_yes" value="Yes" <?= !empty($wizardData->{'discrete'}) ? ' checked ' : ''; ?> /> <label for="discrete_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="discrete" onclick="showva22(this.value)"  id="discrete_no" value="" <?= empty($wizardData->{'discrete'}) ? ' checked ' : ''; ?> /> <label for="discrete_no"><span></span> No</label></span>
                    <div id="hidename22" style="display: none">
                        <label for="discretionary_list">If yes, please list</label>
                        <textarea id="discretionary_list" name="discretionary_list"><?= !empty($wizardData->discretionary_list) ? $wizardData->discretionary_list : ''; ?></textarea>
                    </div>
                </section>
                <section>
                    <label for="home_insulin_order">Home Insulin Order <span class="tiny">(type, dose, time)</span></label>
                    <input type="text" id="home_insulin_order" name="home_insulin_order" value="<?= !empty($wizardData->home_insulin_order) ? $wizardData->home_insulin_order : ''; ?>"  />

                    <label for="lockdown">Lock Down Insulin Orders</label>
                    <input type="text" id="lockdown" name="lockdown" value="<?= !empty($wizardData->lockdown) ? $wizardData->lockdown : ''; ?>"  />
                </section>
            </fieldset>
            <fieldset>
                <section class="largetext">
                    <label for="diabetes_additional">Additional Comments</label>
                    <textarea id="diabetes_additional" name="diabetes_additional"><?= !empty($wizardData->diabetes_additional) ? $wizardData->diabetes_additional : ''; ?></textarea>
                </section>
            </fieldset>
        </div>
        <!---- Newest one 1 start----->

        <legend >Adrenal Insufficiency</legend>
        <span class="inline hide"><input type="checkbox" onclick="showvalue334(this.value)" id="hide334"  name="hide334" value="on" <?php echo!empty($wizardData->hide334) ? ' checked ' : '' ?> /> <label for="hide334"><span></span>Not Applicable</label></span>
        <div id="hidename334">
            <fieldset class="threecol">
                <section>
                    <label for="after_lunch_reasdon">Age of diagnosis </label>
                    <input type="text" id="ageofdia"  name="ageofdia" value="<?php echo $wizardData->ageofdia ?>" />
                    <label for="before_luncdh">Has experienced adrenal crisis</label>
                    <span class="inline"><input type="radio" name="crisis_ex" id="crisis_ex" onclick="showvalue317(this.value)" value="yes" <?php echo!empty($wizardData->crisis_ex) ? ' checked ' : '' ?> /> <label for="before_lunch_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="crisis_ex" id="crisis_ex" onclick="showvalue317(this.value)" value="" <?php echo empty($wizardData->crisis_ex) ? ' checked ' : '' ?> /> <label for="before_lunch_no"><span></span> No</label></span>
                    <div id="hidename317">
                        <label for="after_lunch_readson">If yes</label>
                        <label for="after_lunch_redason">Date</label>
                        <input type="text" id="crisis_date"  name="crisis_date" value="<?php echo $wizardData->crisis_date ?>" />
                        <label for="after_lunch_reasddon">Symptoms</label>
                        <input type="text" id="crisis_symptoms"  name="crisis_symptoms" value="<?php echo $wizardData->crisis_symptoms ?>" />
                    </div>
                </section>
                <section>

                    <label for="insulin_snadck">Treatment for Adrenal Crisis </label><br>
                    <label for="insulin_snadsck">Hydrocortisone  P.O </label>
                    <span class="inline"><input type="radio" name="hydro" id="hydro" value="yes" <?php echo!empty($wizardData->hydro) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="hydro" id="hydro" value=""  <?php echo empty($wizardData->hydro) ? ' checked ' : '' ?> /><label> No</label></span>

                    <label for="insulin_ssnack">Solu-Cortef  IM </label>
                    <span class="inline"><input type="radio" name="solu" id="solu" value="yes" <?php echo!empty($wizardData->solu) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="solu" id="solu" value=""  <?php echo empty($wizardData->solu) ? ' checked ' : '' ?> /><label> No</label></span>

                    <label for="lunch_correcftion">Other</label>
                    <input type="text" id="troher" name="troher" value="<?php echo $wizardData->troher ?>" />

                </section>
                <section>

                    <label for="insulinc_snack">Emergency Injection Kit</label><br>
                    <label for="insulin_snack">In health room </label>
                    <span class="inline"><input type="radio" name="healthroom" id="healthroom" value="yes" <?php echo!empty($wizardData->healthroom) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="healthroom" id="healthroom" value=""  <?php echo empty($wizardData->healthroom) ? ' checked ' : '' ?> /><label> No</label></span>

                    <label for="insulin_snack">In classroom </label>
                    <span class="inline"><input type="radio" name="classroom" id="classroom" value="yes" <?php echo!empty($wizardData->classroom) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="classroom" id="classroom" value=""  <?php echo empty($wizardData->classroom) ? ' checked ' : '' ?> /><label> No</label></span>

                    <label for="insulin_snack">Carried with Student</label>
                    <span class="inline"><input type="radio" name="carried" id="carried" value="yes" <?php echo!empty($wizardData->carried) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="carried" id="carried" value=""  <?php echo empty($wizardData->carried) ? ' checked ' : '' ?> /><label> No</label></span>

                </section>


            </fieldset>
            <fieldset class="twocol">
                <section>
                    <label for="insulin_snack">Medical Alert bracelet </label>
                    <span class="inline"><input type="radio" name="bracelet" id="bracelet" value="yes" <?php echo!empty($wizardData->bracelet) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="bracelet" id="bracelet" value=""  <?php echo empty($wizardData->bracelet) ? ' checked ' : '' ?> /><label> No</label></span>

                    <label for="insulin_snack">Sick day orders and meds </label>
                    <span class="inline"><input type="radio" name="sickday" id="sickday" value="yes" <?php echo!empty($wizardData->sickday) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="sickday" id="sickday" value=""  <?php echo empty($wizardData->sickday) ? ' checked ' : '' ?> /><label> No</label></span>

                    <label for="insulin_snack">Lock Down orders and meds</label>
                    <span class="inline"><input type="radio" name="lockdownorders" id="lockdown" value="yes" <?php echo!empty($wizardData->lockdownorders) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="lockdownorders" id="lockdown" value=""  <?php echo empty($wizardData->lockdownorders) ? ' checked ' : '' ?> /><label> No</label></span>
                    <label for="after_lunch_reason">Additional comments </label>
                    <textarea id="addcomments" name="addcomments"><?php echo $wizardData->addcomments ?></textarea>
                </section>
            </fieldset>
        </div>
        <!---- Newest one 1 end----->
        <!---- Newest one 2 start----->
        <legend class="legends">Other Diagnosis</legend>
        <span class="inline hide"><input type="checkbox" onclick="showvalue335(this.value)" id="hide335"  name="hide335" value="on" <?php echo!empty($wizardData->hide335) ? ' checked ' : '' ?> /> <label for="hide335"><span></span>Not Applicable</label></span>
        <div id="hidename335">
            <fieldset class="twocol">
                <section>
                    <label for="after_lunch_reasDon">Diagnosis or health concern </label>
                    <input type="text" id="health_concern"  name="health_concern" value="<?php echo $wizardData->health_concern ?>" />
                    <label for="after_lunch_redSason">Age at time of diagnosis </label>
                    <input type="text" id="timedia"  name="timedia" value="<?php echo $wizardData->timedia ?>" />
                    <label for="after_lunch_reaAson">Symptoms? </label>
                    <input type="text" id="od_sym"  name="od_sym" value="<?php echo $wizardData->od_sym ?>" />
                    <label for="after_lunch_reGason">How often?</label>
                    <input type="text" id="od_often"  name="od_often" value="<?php echo $wizardData->od_often ?>" />
                </section>
                <section>
                    <label for="after_lunch_reaXson">Do the symptoms or treatment for symptoms impact your child’s daily schedule or routine?  </label>
                    <span class="inline"><input type="radio" name="routine" id="routine" onclick="showvalue318(this.value)" value="yes" <?php echo!empty($wizardData->routine) ? ' checked ' : '' ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="routine" id="routine" onclick="showvalue318(this.value)" value=""  <?php echo empty($wizardData->routine) ? ' checked ' : '' ?> /><label> No</label></span>
                    <div id="hidename318">
                        <label for="after_lunch_reason">how and when? </label>
                        <input type="text" id="od_when"  name="od_when" value="<?php echo $wizardData->od_when ?>" />
                    </div>
                    <label for="after_lunch_reasFon">When was the last visit to the PCP for this condition?</label>
                    <input type="text" id="od_lvisit"  name="od_lvisit" value="<?php echo $wizardData->od_lvisit ?>" />
                </section>

                <section>
                    <label for="after_lunfch_reason">Has your child needed to receive urgent care/ emergency care (and/or surgery) for this condition?    </label>
                    <span class="inline"><input type="radio" name="or_surg" id="or_surg" onclick="showvalue319(this.value)" value="yes" <?php echo 'checked'; ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="or_surg" id="or_surg" onclick="showvalue319(this.value)" value=""  <?php echo $wizardData->or_surg == '' ? ' checked ' : '' ?> /><label> No</label></span>
                    <div id="hidename319">
                        <label for="after_luanch_reason">How many times ?</label>
                        <input type="text" id="od_times2"  name="od_times2" value="<?php echo $wizardData->od_times2 ?>" />
                        <label for="after_lusnch_reason"> Last time: </label>
                        <input type="text" id="od_timelast"  name="od_timelast" value="<?php echo $wizardData->od_timelast ?>" />
                    </div>
                    <label for="after_launch_reason">Will medications/treatments be needed at school? </label>
                    <span class="inline"><input type="radio" name="od_needschool" id="od_needschool" onclick="showvalue320(this.value)"  value="yes" <?php echo 'checked'; ?>/>  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="od_needschool" id="od_needschool" onclick="showvalue320(this.value)"  value=""  <?php echo ($wizardData->od_needschool == '') ? ' checked ' : '' ?> /><label> No</label></span>
                    <div id="hidename320">
                        <label for="aftaer_lunech_reason">please list </label>
                        <textarea id="od_desc" name="od_desc"><?php echo $wizardData->od_desc ?></textarea>
                    </div>
                </section>
                <section>
                    <label for="afgter_lunch_reason">Other equipment or supplies needed at school? </label>
                    <span class="inline"><input type="radio" name="o_supp" id="o_supp" onclick="showvalue331(this.value)" value="yes" <?php echo 'checked'; ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="o_supp" id="o_supp" onclick="showvalue331(this.value)" value=""  <?php echo ($wizardData->o_supp == "") ? ' checked ' : '' ?> /><label> No</label></span>
                    <div id="hidename331">
                        <label for="aftfer_lunch_reason">If yes, please list? </label>
                        <textarea id="o_supp_desc" name="o_supp_desc"><?php echo $wizardData->o_supp_desc ?></textarea>
                    </div>

                    <label for="chilhd">Did your child miss school last year due to his/her health condition? (Illness/appointments)  </label>
                    <span class="inline"><input type="radio" name="o_cdue" id="o_cdue" onclick="showvalue332(this.value)" value="yes" <?php echo 'checked'; ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="o_cdue" id="o_cdue" onclick="showvalue332(this.value)" value=""  <?php echo ($wizardData->o_cdue == "") ? ' checked ' : '' ?> /><label> No</label></span>
                    <div id="hidename332">
                        <label for="after_lunch_reaaasosn">If yes, how many </label>
                        <textarea id="o_cdue_desc" name="o_cdue_desc"><?php echo $wizardData->o_cdue_desc ?></textarea>
                    </div>
                    <label for="o_rjfgfes">Does your child have any activity restriction/ PE Restriction related to this diagnosis?  </label>
                    <span class="inline"><input type="radio" name="o_res" id="o_res" onclick="showvalue333(this.value)" value="yes" <?php echo 'checked'; ?> />  <label>Yes</label></span>
                    <span class="inline"><input type="radio" name="o_res" id="o_res" onclick="showvalue333(this.value)" value=""  <?php echo $wizardData->o_res == '' ? ' checked ' : '' ?> /><label> No</label></span>
                    <div id="hidename333">
                        <label for="after_lunch_reasosn">If yes, please describe? </label>
                        <textarea id="o_res_desc" name="o_res_desc"><?php echo $wizardData->o_res_desc ?></textarea>
                    </div>

                    <label for="after_lunsdch_rd">Additional Information </label>
                    <textarea id="od_add_info" name="od_add_info"><?php echo $wizardData->od_add_info ?></textarea>

                </section>

            </fieldset>
        </div>
        <!---- Newest one 2 end----->

    </fieldset>
    <!---- Newest one 2 end----->

</fieldset>
<fieldset class="new-section">
    <span class="inline hide"><input type="checkbox" onclick="hideSection(367)" id="hide367"  name="hide367" value="on" <?php echo!empty($wiz_14->hide367) ? ' checked ' : '' ?> /> <label for="hide367"><span></span>Not Applicable</label></span>
    <legend>Educational Status</legend>
    <div class="hide367">
        <section>
            <span class="inline"><input type="radio"  value="itp" id="edustatus" name="edustatus" <?php echo ($wizardData->edustatus == 'itp') ? 'checked' : '' ?> /> <label for="edustatus-itp"><span></span>ITP</label></span>
            <span class="inline"><input type="radio"  value="eci" id="edustatus" name="edustatus" <?php echo ($wizardData->edustatus == 'eci') ? ' checked ' : '' ?> /> <label for="edustatus-eci"><span></span>ECI</label></span>
            <span class="inline"><input type="radio"  value="" id="edustatus" name="edustatus" <?php echo ($wizardData->edustatus == '') ? ' checked ' : '' ?> /> <label for="edustatus-none"><span></span>None</label></span>
        </section>
        <section>
            <span class="inline"><input type="checkbox" name="edustatus2[]" value="eduregular" id="edustatus2-regular" <?= !empty($wizardData->eduregular) || !empty($wizardData->edustatus2_regular) ? ' checked ' : ''; ?> /> <label for="edustatus2-regular"><span></span>Regular Education</label></span>
            <span class="inline"><input type="checkbox" name="edustatus2[]" value="eduIEP" id="edustatus2-iep" <?= !empty($wizardData->eduiep) || !empty($wizardData->edustatus2_iep) ? ' checked ' : ''; ?>/> <label for="edustatus2-iep"><span></span>IEP</label></span>
            <span class="inline"><input type="checkbox" name="edustatus2[]" value="edu504" id="edustatus2-504" <?= !empty($wizardData->edu504) || !empty($wizardData->edustatus2_504) ? ' checked ' : ''; ?>/> <label for="edustatus2-504"><span></span>504</label></span>
        </section>
        <section>
            <label for="grade">Current Grade</label>
            <!--<input type="text" name="grade" id="grade" value="<? #= !empty($wizardData->grade) ? $wizardData->grade : '';                         ?>" />-->
            <select name="grade" id="grade" onclick="showvalue357(this.value)">
                <option value="Pre-Kindergarten" <?php
                if ($wizardData->grade == "Pre-Kindergarten"): echo 'selected="selected"';
                endif;
                ?>>Pre-Kindergarten</option>
                <option value="Kindergarten" <?php
                if ($wizardData->grade == "Kindergarten"): echo 'selected="selected"';
                endif;
                ?>>Kindergarten</option>
                <option value="First" <?php
                if ($wizardData->grade == "First"): echo 'selected="selected"';
                endif;
                ?>>First</option>
                <option value="Second" <?php
                if ($wizardData->grade == "Second"): echo 'selected="selected"';
                endif;
                ?>>Second</option>
                <option value="Third" <?php
                if ($wizardData->grade == "Third"): echo 'selected="selected"';
                endif;
                ?>>Third</option>
                <option value="Fourth" <?php
                if ($wizardData->grade == "Fourth"): echo 'selected="selected"';
                endif;
                ?>>Fourth</option>
                <option value="Fifth" <?php
                if ($wizardData->grade == "Fifth"): echo 'selected="selected"';
                endif;
                ?>>Fifth</option>
                <option value="Sixth" <?php
                if ($wizardData->grade == "Sixth"): echo 'selected="selected"';
                endif;
                ?>>Sixth</option>
                <option value="Seventh" <?php
                if ($wizardData->grade == "Seventh"): echo 'selected="selected"';
                endif;
                ?>>Seventh</option>
                <option value="Eighth" <?php
                if ($wizardData->grade == "Eighth"): echo 'selected="selected"';
                endif;
                ?>>Eighth</option>
                <option value="Ninth" <?php
                if ($wizardData->grade == "Ninth"): echo 'selected="selected"';
                endif;
                ?>>Ninth</option>
                <option value="Tenth" <?php
                if ($wizardData->grade == "Tenth"): echo 'selected="selected"';
                endif;
                ?>>Tenth</option>
                <option value="Eleventh" <?php
                if ($wizardData->grade == "Eleventh"): echo 'selected="selected"';
                endif;
                ?>>Eleventh</option>
                <option value="Twelfth" <?php
                if ($wizardData->grade == "Twelfth"): echo 'selected="selected"';
                endif;
                ?>>Twelfth</option>
                <option value="Other" <?php
                if ($wizardData->grade == "Other"): echo 'selected="selected"';
                endif;
                ?>>Other</option>
            </select>
            <div id="hidename357">
                <label for="grade">Other Grade</label>
                <input type="text" name="othergrade" id="othergrade" value="<?= !empty($wizardData->othergrade) ? $wizardData->othergrade : ''; ?>" />
            </div>
        </section>
        <section>
            <label for="assistant">Current Individual Educational Assistant?</label>
            <span class="inline"><input type="radio" name="assistant[]" value="assistantyes" id="assistant-yes" checked="checked" /> <label for="assistant-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio" name="assistant[]" value="assistantno" id="assistant-no" <?= !empty($wizardData->assistantno) || !empty($wizardData->assistant) && $wizardData->assistant <> 'yes' ? ' checked ' : ''; ?>/> <label for="assistant-no"><span></span>No</label></span>
        </section>
        <section>
            <label for="eduservices">Services Used</label>
            <div class="check-group">
                <span><input type="checkbox" name="eduservices[]" value="occupationaltherapy" id="eduservices-occupational" <?= !empty($wizardData->occupationaltherapy) || !empty($wizardData->eduservices_occupational) ? ' checked ' : ''; ?> /> <label for="eduservices-occupational"><span></span>Occupational Therapy</label></span>
                <span><input type="checkbox" name="eduservices[]" value="physicaltherapy" id="eduservices-physical" <?= !empty($wizardData->physicaltherapy) || !empty($wizardData->eduservices_physical) ? ' checked ' : ''; ?> /> <label for="eduservices-physical"><span></span>Physical Therapy</label></span>
                <span><input type="checkbox" name="eduservices[]" value="speechlanguage" id="eduservices-speech" <?= !empty($wizardData->speechlanguage) || !empty($wizardData->eduservices_speech) ? ' checked ' : ''; ?> /> <label for="eduservices-speech"><span></span>Speech/Language</label></span>
                <span><input type="checkbox" name="eduservices[]" value="counseling" id="eduservices-counseling" <?= !empty($wizardData->counseling) || !empty($wizardData->eduservices_counseling) ? ' checked ' : ''; ?> /> <label for="eduservices-counseling"><span></span>Counseling</label></span>
                <span><input type="checkbox" name="eduservices[]" value="adaptivepe" id="eduservices-pe" <?= !empty($wizardData->adaptivepe) || !empty($wizardData->eduservices_pe) ? ' checked ' : ''; ?> /> <label for="eduservices-pe"><span></span>Adaptive PE</label></span>
            </div>
        </section>
        <div style="clear:both"></div>
        <section>
            <span><input type="checkbox" name="offlocation[]" value="offlocation_hospital" id="offlocation-hospital" <?= !empty($wizardData->offlocation_hospital) ? ' checked ' : ''; ?> /> <label for="offlocation-hospital"><span></span>Home Hospital Teaching</label></span>
            <span><input type="checkbox" name="offlocation[]" value="offlocation_home" id="offlocation-home" <?= !empty($wizardData->offlocation_home) ? ' checked ' : ''; ?> /> <label for="offlocation-home"><span></span>Concurrent Home Teaching</label></span>
            <label for="reevaldate">Re-Evaluation Date</label>
            <?php !empty($wizardData->reevaldate) && $wizardData->reevaldate == '1970-01-01' ? $wizardData->reevaldate = '' : $wizardData->reevaldate; ?>
            <input type="text" id="reevaldate" name="reevaldate"  value="<?= !empty($wizardData->reevaldate) ? $wizardData->reevaldate : ''; ?>" />
        </section>
        <section class="two-col">
            <label for="assisttech">Assistive Technology</label>
            <span class="inline"><input type="radio" name="assisttech" value="assisttechyes" id="assist-tech-yes" onclick="showvalue358(this.value)" checked="checked" /><label for="assist-tech-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio" name="assisttech" value="assisttechno" id="assist-tech-no" onclick="showvalue358(this.value)"  <?= !empty($wizardData->assisttech) && ($wizardData->assisttech == 'assisttechno') ? ' checked ' : ''; ?> /><label for="assist-tech-no"><span></span>No</label></span>
            <div id="hidename358">
                <label for="assisttechlist">Please List Assistive Technology</label>
                <?php !empty($wizardData->assist_tech_lt) ? $wizardData->assisttechlist = $wizardData->assist_tech_lt : ''; ?>
                <textarea id="assisttechlist" name="assisttechlist"><?= !empty($wizardData->assisttechlist) ? $wizardData->assisttechlist : ''; ?></textarea>
            </div>
        </section>
        <div style="clear:both"></div>
        <section class="two-col">
            <label for="accomodations">Classroom Accommodations</label>

            <span class="inline"><input type="radio"  name="accomodations" value="accomodationsyes" id="accomodations-yes" onclick="showvalue359(this.value)" checked="checked" /><label for="accomodations-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio" name="accomodations" value="accomodationsno" id="accomodations-no" onclick="showvalue359(this.value)" <?= !empty($wizardData->accomodations) && $wizardData->accomodations == 'accomodationsno' ? ' checked ' : ''; ?>/><label for="accomodations-no"><span></span>No</label></span>
            <div id="hidename359">
                <label for="accomodationslist">Please List Classroom Accomodations</label>
                <?php !empty($wizardData->accomodations_lt) ? $wizardData->accomodationslist = $wizardData->accomodations_lt : ''; ?>
                <textarea id="accomodationslist" name="accomodationslist"><?= !empty($wizardData->accomodationslist) ? $wizardData->accomodationslist : ''; ?></textarea>
            </div>
        </section>
    </div>
</fieldset>

<!--- Add Trasportation Status here --->
<fieldset class="new-section">
    <span class="inline hide"><input type="checkbox" onclick="hideSection(16)" id="hide16" name="hide16"  /> <label for="hide16"><span></span>Not Applicable</label></span>
    <legend>Transportation Status</legend>
    <div class="hide16">
        <fieldset>
            <section>
                <label for="trans_method">Method of Transportation</label>

                <span class="inline"><input type="checkbox" name="trans_method_walker" id="trans_method_walker" value="Walker" <?= !empty($wizardData->{'trans_method_walker'}) ? ' checked ' : ''; ?>  /><label for="trans_method_walker"><span></span> Walker</label></span>
                <span class="inline"><input type="checkbox" name="trans_method_car" id="trans_method_car" value="Car Rider" <?= !empty($wizardData->{'trans_method_car'}) ? ' checked ' : ''; ?> /><label for="trans_method_car"><span></span> Car Rider</label></span>
                <span class="inline"><input type="checkbox" name="trans_method_bus" id="trans_method_bus" value="Bus Rider" <?= !empty($wizardData->{'trans_method_bus'}) ? ' checked ' : ''; ?> /><label for="trans_method_bus"><span></span> Bus Rider</label></span>
                <span class="inline"><input type="checkbox" name="trans_method_lift" id="trans_method_lift" value="Lift Bus" <?= !empty($wizardData->{'trans_method_lift'}) ? ' checked ' : ''; ?> /><label for="trans_method_lift"><span></span> Lift Bus</label></span>
            </section>
        </fieldset>
        <fieldset>
            <section>
                <label for="bus_services">Current Bus Services Provided</label>
                <span><input type="checkbox" name="bus_services_assist" id="bus_services_assist" value="Assistance Needed" <?= !empty($wizardData->{'bus_services_assist'}) ? ' checked ' : ''; ?> /><label for="bus_services_assist"><span></span> Assistance Needed</label></span>
                <span><input type="checkbox" name="bus_services_aide" id="bus_services_aide" value="Aide on Bus"  <?= !empty($wizardData->{'bus_services_aide'}) ? ' checked ' : ''; ?>/><label for="bus_services_aide"><span></span> Aide on Bus</label></span>
                <span><input type="checkbox" name="bus_services_nursing" id="bus_services_nursing" value="Nursing Services on Bus" <?= !empty($wizardData->{'bus_services_nursing'}) ? ' checked ' : ''; ?> /><label for="bus_services_nursing"><span></span> Nursing Services on Bus</label></span>
                <span><input type="checkbox" name="bus_services_equip" id="bus_services_equip" value="Equipment Checklist Used" <?= !empty($wizardData->{'bus_services_equip'}) ? ' checked ' : ''; ?> /><label for="bus_services_equip"><span></span> Equipment Checklist Used</label></span>
            </section>
            <section>
                <label for="bus_meds">Medication on Bus?</label>
                <span class="inline"><input type="radio" name="bus_meds" onclick="showva23(this.value)" id="bus_meds_yes" value="Yes" <?= !empty($wizardData->{'bus_meds'}) ? ' checked ' : ''; ?> /><label for="bus_meds_yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="bus_meds" onclick="showva23(this.value)" id="bus_meds_no" value="" <?= empty($wizardData->{'bus_meds'}) ? ' checked ' : ''; ?> /><label for="bus_meds_no"><span></span> No</label></span>
                <div id="hidename23" style="display: block">
                    <label for="list_bus_meds">If Yes, List</label>
                    <input type="text" id="list_bus_meds" name="list_bus_meds" value="<?= !empty($wizardData->list_bus_meds) ? $wizardData->list_bus_meds : ''; ?>"  />
                </div>
            </section>
            <section>
                <label for="med_bus">How is medication handled?</label>
                <span><input type="checkbox" name="med_bus_selfadmin" id="med_bus_selfadmin" value="Self Carries/Self Administers" <?= ($wizardData->{'med_bus_selfadmin'} == 'Self Carries/Self Administers') ? ' checked ' : ''; ?> /><label for="med_bus_selfadmin"><span></span> Self Carries/Self Administers</label></span>
                <span><input type="checkbox" name="med_bus_selfmed" id="med_bus_selfmed" value="Self Carries/Unable to Self-Administer" <?= ($wizardData->{'med_bus_selfmed'} == 'Self Carries/Unable to Self-Administer') ? ' checked ' : ''; ?> /><label for="med_bus_selfmed"><span></span> Self Carries/Unable to Self-Administer</label></span>
                <span><input type="checkbox" name="med_bus_aideadmin" id="med_bus_aideadmin" value="Driver/Aide Trained to Administer" <?= ($wizardData->{'med_bus_aideadmin'} == 'Driver/Aide Trained to Administer') ? ' checked ' : ''; ?> /><label for="med_bus_aideadmin"><span></span> Driver/Aide Trained to Administer</label></span>
            </section>
        </fieldset>
        <fieldset>
            <section>
                <label for="bus_snacks">Snacks on Bus</label>
                <span class="inline"><input type="radio" name="bus_snacks" id="bus_snacks" onclick="showvalue50(this.value)" value="yes" <?php echo!empty($wizardData->bus_snacks) ? ' checked ' : '' ?> /><label for="bus_snacks_yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="bus_snacks" id="bus_snacks" onclick="showvalue50(this.value)" value="" <?php echo empty($wizardData->bus_snacks) ? ' checked ' : '' ?> /><label for="bus_snacks_no"><span></span> No</label></span>
                <div id="hidename50">
                    <label for="list_bus_meds">list or explain</label>
                    <textarea id="describe_Snacks" name="describe_Snacks"><?php echo $wizardData->describe_Snacks ?></textarea>
                </div>
                <label for="bus_mod">Special Modifications Needed for Bus?</label>
                <span class="inline"><input type="radio" name="bus_mod" onclick="showva24(this.value)" id="bus_mod_yes" value="Yes" <?= !empty($wizardData->{'bus_mod'}) ? ' checked ' : ''; ?> /><label for="bus_mod_yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="bus_mod" onclick="showva24(this.value)"  id="bus_mod_no" value="" <?= empty($wizardData->{'bus_mod'}) ? ' checked ' : ''; ?>/><label for="bus_mod_no"><span></span> No</label></span>

            </section>
            <div id="hidename24">
                <section>
                    <label for="bus_mod_list">If Yes, List Special Modifications Needed</label>
                    <textarea id="bus_mod_list" name="bus_mod_list"><?= !empty($wizardData->bus_mod_list) ? $wizardData->bus_mod_list : ''; ?></textarea>
                </section>
            </div>
        </fieldset>
        <fieldset>
            <section class="largetext">
                <label for="trans_comments">Additional Comments</label>
                <textarea id="trans_comments" name="trans_comments"><?= !empty($wizardData->trans_comments) ? $wizardData->trans_comments : ''; ?></textarea>
            </section>
        </fieldset>
        <fieldset>
            <section class="largetext">
                <label for="trans_comments">Needs for Field Trips</label>
                <textarea id="trans_field" name="trans_field"><?php echo $wizardData->trans_field ?></textarea>
            </section>
        </fieldset>

    </div>
</fieldset>
<fieldset class="new-section">
    <span class="inline hide"><input type="checkbox" onclick="hideSection(17)" id="hide17" name="hide17"  /> <label for="hide17"><span></span>Not Applicable</label></span>
    <legend>Additional Information/Specific Cultural Beliefs</legend>
    <div class="hide17">
        <label for="cultural_info">Enter any additional information or cultural beliefs - Awareness of safety issues/Behaviors/Awareness of pain/Soothers</label>
        <textarea id="cultural_info" name="cultural_info" placeholder=""><?= !empty($wizardData->cultural_info) ? $wizardData->cultural_info : ''; ?></textarea>
    </div>
</fieldset>

<fieldset class="new_section ">
    <span class="inline hide"><input type="checkbox" onclick="hideSection(188)" id="hide188"  name="hide188" value="on" <?php echo!empty($wizardData->hide188) ? ' checked ' : '' ?> /> <label for="hide188" style="margin-right: 30px;"><span></span>Not Applicable</label></span>
    <legend class="legends" style="max-width: 997px;">Emergency Action Plans</legend>
    <div class="hide188">

        <!---- Section 1 ----->
        <section>
            <label for="planname1">Seizure Plans</label>
            <span class="inline"><input type="radio" name="planname1" id="planname1"  onclick="showvalue310(this.value)" value="yes"
                                        <?php if (!empty($wizardData->planname1)) : ?> checked="checked" <?php endif; ?>  /> <label for="yes"><span></span> Yes</label></span>
            <span class="inline"><input type="radio" name="planname1" id="planname1"
                                        <?php if (empty($wizardData->planname1)): ?>  checked="checked" <?php endif; ?> onclick="showvalue310(this.value)" value="" /> <label for=""><span></span> No</label></span>
            <br>
            <div id="hidename310" style="display: none">
                <span class="inline"><input type="checkbox" name="teacher1" id="teacher1" value="teacher1"
                                            <?php if (!empty($wizardData->hcap_seizure_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher1"><span></span> Teachers</label></span>
                <span class="inline"><input type="checkbox" name="bus1" id="bus1" value="bus1"
                                            <?php if (!empty($wizardData->hcap_seizure_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus1"><span></span> Bus</label></span>
                <span class="inline"><input type="checkbox" name="hr1" id="hr1" value="hr1"
                                            <?php if (!empty($wizardData->hcap_seizure_hr)) : ?> checked="checked" <?php endif; ?> /><label for="hr1"><span></span> HR File</label></span>
                <div id="chkerror5"></div>
                <label for="datereview1">Date Reviewed</label>
                <input type="text" id="datereview1" name="datereview1"  class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_seizure_review)) ? $wizardData->hcap_seizure_review : ''; ?>"/>

                <label for="datedist1">Date Distributed</label>
                <input type="text" id="datedist1" name="datedist1" class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_seizure_dist)) ? $wizardData->hcap_seizure_dist : ''; ?>">

            </div>
        </section>
        <!---- Section 2 ----->
        <section>
            <label for="hcap_hypo">Hypo/Hyperglycemia Plans</label>
            <span class="inline"><input type="radio" name="planname2" id="planname2"  onclick="showvalue311(this.value)" value="yes"
                                        <?php if (!empty($wizardData->planname2)) : ?> checked="checked" <?php endif; ?>/> <label for="yes"><span></span> Yes</label></span>
            <span class="inline"><input type="radio" name="planname2" id="planname2"
                                        <?php if (empty($wizardData->planname2)): ?>  checked="checked" <?php endif; ?>onclick="showvalue311(this.value)" value="" /> <label for=""><span></span> No</label></span>
            <br>
            <div id="hidename311" style="display: none">
                <span class="inline"><input type="checkbox" name="teacher2" id="teacher2" value="teacher2"
                                            <?php if (!empty($wizardData->hcap_hypo_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher2"><span></span> Teachers</label></span>
                <span class="inline"><input type="checkbox" name="bus2" id="bus2" value="bus2"
                                            <?php if (!empty($wizardData->hcap_hypo_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus2"><span></span> Bus</label></span>
                <span class="inline"><input type="checkbox" name="hr2" id="hr2" value="hr2"
                                            <?php if (!empty($wizardData->hcap_hypo_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr2"><span></span> HR File</label></span>
                <div id="chkerror6"></div>
                <label for="datereview2">Date Reviewed</label>
                <input type="text" id="datereview2" name="datereview2"  class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_hypo_review)) ? $wizardData->hcap_hypo_review : ''; ?>"/>

                <label for="datedist2">Date Distributed</label>
                <input type="text" id="datedist2" name="datedist2" class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_hypo_dist)) ? $wizardData->hcap_hypo_dist : ''; ?>">

            </div>
        </section>
        <!---- Section 3 ----->
        <section>
            <label for="Allergy">Allergy Plans</label>
            <span class="inline"><input type="radio" name="planname3" id="planname3"  onclick="showvalue312(this.value)" value="yes"
                                        <?php if (!empty($wizardData->planname3)) : ?> checked="checked" <?php endif; ?>/> <label for="yes"><span></span> Yes</label></span>
            <span class="inline"><input type="radio" name="planname3" id="planname3"
                                        <?php if (empty($wizardData->planname3)): ?>  checked="checked" <?php endif; ?>onclick="showvalue312(this.value)" value="" /> <label for=""><span></span> No</label></span>
            <br>
            <div id="hidename312" style="display: none">
                <span class="inline"><input type="checkbox" name="teacher3" id="teacher3" value="teacher3"
                                            <?php if (!empty($wizardData->hcap_allergy_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher3"><span></span> Teachers</label></span>
                <span class="inline"><input type="checkbox" name="bus3" id="bus3" value="bus3"
                                            <?php if (!empty($wizardData->hcap_allergy_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus3"><span></span> Bus</label></span>
                <span class="inline"><input type="checkbox" name="hr3" id="hr3" value="hr3"
                                            <?php if (!empty($wizardData->hcap_allergy_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr3"><span></span> HR File</label></span>
                <div id="chkerror7"></div>
                <label for="datereview3">Date Reviewed</label>
                <input type="text" id="datereview3" name="datereview3"  class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_allergy_review)) ? $wizardData->hcap_allergy_review : ''; ?>"/>

                <label for="datedist3">Date Distributed</label>
                <input type="text" id="datedist3" name="datedist3" class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_allergy_dist)) ? $wizardData->hcap_allergy_dist : ''; ?>">

            </div>
        </section>
        <div style="clear:both"></div>
        <!---- Section 4 ----->
        <section>
            <label for="hcap_gtube">G-Tube Replacement Plans</label>
            <span class="inline"><input type="radio" name="planname4" id="planname4"  onclick="showvalue313(this.value)" value="yes"
                                        <?php if (!empty($wizardData->planname4)) : ?> checked="checked" <?php endif; ?>/> <label for="yes"><span></span> Yes</label></span>
            <span class="inline"><input type="radio" name="planname4" id="planname4"
                                        <?php if (empty($wizardData->planname4)): ?>  checked="checked" <?php endif; ?> onclick="showvalue313(this.value)" value="" /> <label for=""><span></span> No</label></span>
            <br>
            <div id="hidename313" style="display: none">
                <span class="inline"><input type="checkbox" name="teacher4" id="teacher4" value="teacher4"
                                            <?php if (!empty($wizardData->hcap_gtube_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher4"><span></span> Teachers</label></span>
                <span class="inline"><input type="checkbox" name="bus4" id="bus4" value="bus4"
                                            <?php if (!empty($wizardData->hcap_gtube_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus4"><span></span> Bus</label></span>
                <span class="inline"><input type="checkbox" name="hr4" id="hr4" value="hr4"
                                            <?php if (!empty($wizardData->hcap_gtube_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr4"><span></span> HR File</label></span>
                <div id="chkerror8"></div>
                <label for="datereview4">Date Reviewed</label>
                <input type="text" id="datereview4" name="datereview4"  class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_gtube_review)) ? $wizardData->hcap_gtube_review : ''; ?>"/>

                <label for="datedist4">Date Distributed</label>
                <input type="text" id="datedist4" name="datedist4" class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_gtube_dist)) ? $wizardData->hcap_gtube_dist : ''; ?>">

            </div>
        </section>


        <!---- Section 5 ----->
        <section>
            <label for="hcap_cardiac">Cardiac Plans</label>
            <span class="inline"><input type="radio" name="planname5" id="planname5"  onclick="showvalue314(this.value)" value="yes"
                                        <?php if (!empty($wizardData->planname5)) : ?> checked="checked" <?php endif; ?> /> <label for="yes"><span></span> Yes</label></span>
            <span class="inline"><input type="radio" name="planname5" id="planname5"
                                        <?php if (empty($wizardData->planname5)): ?>  checked="checked" <?php endif; ?> onclick="showvalue314(this.value)" value="" /> <label for=""><span></span> No</label></span>
            <br>
            <div id="hidename314" style="display: none">
                <span class="inline"><input type="checkbox" name="teacher5" id="teacher5" value="teacher5"
                                            <?php if (!empty($wizardData->hcap_cardiac_teacher)) : ?> checked="checked" <?php endif; ?>/><label for="teacher5"><span></span> Teachers</label></span>
                <span class="inline"><input type="checkbox" name="bus5" id="bus5" value="bus5"
                                            <?php if (!empty($wizardData->hcap_cardiac_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus5"><span></span> Bus</label></span>
                <span class="inline"><input type="checkbox" name="hr5" id="hr5" value="hr5"
                                            <?php if (!empty($wizardData->hcap_cardiac_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr5"><span></span> HR File</label></span>
                <div id="chkerror9"></div>
                <label for="datereview5">Date Reviewed</label>
                <input type="text" id="datereview5" name="datereview5"
                       value="<?php echo (!empty($wizardData->hcap_cardiac_review)) ? $wizardData->hcap_cardiac_review : ''; ?>" class="generate_datepic"/>

                <label for="datedist5">Date Distributed</label>
                <input type="text" id="datedist5" name="datedist5" class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_cardiac_dist)) ? $wizardData->hcap_cardiac_dist : ''; ?>">

            </div>
        </section>

        <!---- Section 6 ----->

        <section>
            <label for="hcap_resp">Respiratory Distress Plans</label>
            <span class="inline"><input type="radio" name="planname6" id="planname6"  onclick="showvalue315(this.value)" value="yes"
                                        <?php if (!empty($wizardData->planname6)): ?> checked="checked" <?php endif; ?>  /> <label for="yes"><span></span> Yes</label></span>
            <span class="inline"><input type="radio" name="planname6" id="planname6"
                                        <?php if (empty($wizardData->planname6)): ?>  checked="checked" <?php endif; ?>  onclick="showvalue315(this.value)" value="" /> <label for=""><span></span> No</label></span>
            <br>
            <div id="hidename315" style="display: none">
                <span class="inline"><input type="checkbox" name="teacher6" id="teacher6" value="teacher6"
                                            <?php if (!empty($wizardData->hcap_resp_teacher)) : ?> checked="checked" <?php endif; ?> /><label for="teacher6"><span></span> Teachers</label></span>
                <span class="inline"><input type="checkbox" name="bus6" id="bus6" value="bus6"
                                            <?php if (!empty($wizardData->hcap_resp_bus)) : ?> checked="checked" <?php endif; ?>/><label for="bus6"><span></span> Bus</label></span>
                <span class="inline"><input type="checkbox" name="hr6" id="hr6" value="hr6"
                                            <?php if (!empty($wizardData->hcap_resp_hr)) : ?> checked="checked" <?php endif; ?>/><label for="hr6"><span></span> HR File</label></span>
                <div id="chkerror10"></div>
                <label for="datereview6">Date Reviewed</label>
                <input type="text" id="datereview6" name="datereview6"
                       value="<?php echo (!empty($wizardData->hcap_resp_review)) ? $wizardData->hcap_resp_review : ''; ?>" class="generate_datepic"/>

                <label for="datedist6">Date Distributed</label>
                <input type="text" id="datedist6" name="datedist6" class="generate_datepic"
                       value="<?php echo (!empty($wizardData->hcap_resp_dist)) ? $wizardData->hcap_resp_dist : ''; ?>">

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
    <span class="inline hide"><input type="checkbox" onclick="hideSection(19)" id="hide19" name="hide19"  /> <label for="hide19"><span></span>Not Applicable</label></span>
    <legend>Needs for School Attendance</legend>
    <div class="hide19">
        <fieldset class="twocol">
            <section>
                <label for="delegatable">Delegatable Nursing Services During the School Day <span class="tiny">(Please list)</span></label>
                <textarea id="delegatable" name="delegatable"><?= !empty($wizardData->delegatable) ? $wizardData->delegatable : ''; ?></textarea>
            </section>
            <section>
                <label for="non_delegatable">Non-Delegatable Nursing Services During the School Day <span class="tiny">(Please list)</span></label>
                <textarea id="non_delegatable" name="non_delegatable"><?= !empty($wizardData->non_delegatable) ? $wizardData->non_delegatable : ''; ?></textarea>
            </section>
        </fieldset>
        <fieldset class="twocol">
            <section>
                <label for="parents_provide">Parents Will Provide</label>
                <textarea id="parents_provide" name="parents_provide"><?= !empty($wizardData->parents_provide) ? $wizardData->parents_provide : ''; ?></textarea>
            </section>
            <section>
                <label for="school_provide">School Will Provide</label>
                <textarea id="school_provide" name="school_provide"><?= !empty($wizardData->school_provide) ? $wizardData->school_provide : ''; ?></textarea>
            </section>

                                        <!-- <section>
                                        </section>-->
        </fieldset>
    </div>

</fieldset>


<fieldset class="new-section">
    <span class="inline hide"><input type="checkbox" onclick="hideSection(115)" id="hide115"  name="hide115"  value = "on" <?php echo!empty($wizardData->hide115) ? ' checked ' : '' ?> /> <label for="hide115" style="margin-right: 20px;"><span></span>Not Applicable</label></span>
    <legend  style="margin-top: -37px;">Individualized Healthcare Plan</legend>
    <div class="hide115" style="margin-left: 10px;">
        <label for="ihp">IHP?</label>
        <span class="inline"><input type="radio" name="ihp" id="ihp" value="yes" onclick="showvals(this)" <?php echo ($wizardData->ihp == 'yes') ? ' checked ' : '' ?> /><label for="ihp-yes"><span></span> Yes</label></span>
        <span class="inline"><input type="radio" name="ihp" id="ihp" value="no" onclick="showvals(this)"  <?php echo 'checked'; ?>/><label for="ihp-no"><span></span> No</label></span>
        <span class="inline"><input type="radio" name="ihp" id="ihp" value="ip" onclick="showvals(this)"  <?php echo ($wizardData->ihp == 'ip') ? ' checked ' : '' ?>/><label for="ihp-ip"><span></span> In Progress</label></span>

        <div class="ihps">
            <p class="note">If Yes, please see Individualized Healthcare Plan</p>
        </div>
    </div>


</fieldset>
<section class="buttons">
    <div class="nextbutton">
        <?= $link_back; ?>
        <?= form_submit($attr_FormSubmit_appraisal); ?>
    </div>
    <div class="savebuttons float-left">
        <?= form_input($sif, set_value("sif", $sif_num)); ?>
        <?= form_submit($attr_FormSave_appraisal); ?>
    </div>
    <div class="clear"></div>
</section>
<?= form_close(); ?>
</section>

<script type="text/javascript">
    $(document).ready(function() {


//        var acccheck = $('input[name=accomodations]').is(':checked');
//        if (acccheck == true) {
//            $("#accomodations-yes").attr('checked', 'checked');
//        } else {
//            $("#accomodations-no").attr('checked', 'checked');
//        }

        //Checkbox validation 1
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#appraisal6').val();
            var $planname1 = $('input[name=planname1]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="teacher1"]:checked');
            var $fields2 = $(this).find('input[name="bus1"]:checked');
            var $fields3 = $(this).find('input[name="hr1"]:checked');
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
        //Checkbox validation 2
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#appraisal6').val();
            var $planname1 = $('input[name=planname2]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="teacher2"]:checked');
            var $fields2 = $(this).find('input[name="bus2"]:checked');
            var $fields3 = $(this).find('input[name="hr2"]:checked');
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
        //Checkbox validation 3
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#appraisal6').val();
            var $planname1 = $('input[name=planname3]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="teacher3"]:checked');
            var $fields2 = $(this).find('input[name="bus3"]:checked');
            var $fields3 = $(this).find('input[name="hr3"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk7').remove();
                $('#chkerror7').append("<span class='errorchk7'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk7').remove();
                return true;
            }
        });
        //Checkbox validation 4
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#appraisal6').val();
            var $planname1 = $('input[name=planname4]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="teacher4"]:checked');
            var $fields2 = $(this).find('input[name="bus4"]:checked');
            var $fields3 = $(this).find('input[name="hr4"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk8').remove();
                $('#chkerror8').append("<span class='errorchk8'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk8').remove();
                return true;
            }
        });
        //Checkbox validation 5
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#appraisal6').val();
            var $planname1 = $('input[name=planname5]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="teacher5"]:checked');
            var $fields2 = $(this).find('input[name="bus5"]:checked');
            var $fields3 = $(this).find('input[name="hr5"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk9').remove();
                $('#chkerror9').append("<span class='errorchk9'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk9').remove();
                return true;
            }
        });
        //Checkbox validation 6
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#appraisal6').val();
            var $planname1 = $('input[name=planname6]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="teacher6"]:checked');
            var $fields2 = $(this).find('input[name="bus6"]:checked');
            var $fields3 = $(this).find('input[name="hr6"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk10').remove();
                $('#chkerror10').append("<span class='errorchk10'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk10').remove();
                return true;
            }
        });
        //Checkbox validation 7
        //Checkbox validation 7
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide188]:checked', '#appraisal6').val();
            var $planname1 = $('input[name=sheepItForm1_0_seizure_planname7]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_0_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_0_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_0_hcap_emer_hr"]:checked');
            if ($feed != "on" && $planname1 == 'yes' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk15').remove();
                $('#newplanerror0').append("<span class='errorchk15'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk15').remove();
                return true;
            }
        });

        $('#appraisal6').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#appraisal6').val());
            var $planname1 = $('input[name=sheepItForm1_1_seizure_planname7]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_1_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_1_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_1_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk16').remove();
                $('#newplanerror1').append("<span class='errorchk16'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk16').remove();
                return true;
            }
        });
        $('#appraisal6').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#appraisal6').val());
            var $planname1 = $('input[name=sheepItForm1_2_seizure_planname7]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_2_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_2_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_2_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk17').remove();
                $('#newplanerror2').append("<span class='errorchk17'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk17').remove();
                return true;
            }
        });
        $('#appraisal6').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#appraisal6').val());
            var $planname1 = $('input[name=sheepItForm1_3_seizure_planname7]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_3_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_3_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_3_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk18').remove();
                $('#newplanerror3').append("<span class='errorchk18'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk18').remove();
                return true;
            }
        });
        $('#appraisal6').submit(function() {
            var ckbox = ($('input[name=hide188]:checked', '#appraisal6').val());
            var $planname1 = $('input[name=sheepItForm1_4_seizure_planname7]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_4_hcap_emer_teacher"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_4_hcap_emer_bus"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_4_hcap_emer_hr"]:checked');
            if ($planname1 == "yes" && ckbox != 'on' && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk19').remove();
                $('#newplanerror4').append("<span class='errorchk19'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk19').remove();
                return true;
            }
        });










        //when should student test
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=hide15]:checked', '#appraisal6').val();
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

                $('.errorchk12').remove();
                $('#chkerror12').append("<span class='errorchk12'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk12').remove();
                return true;
            }
        });


        $("#sheepItForm1_0_planname").hide();
        $('#test_when_other').on('change', function() {
            var selectedval = $('#test_when_other:checkbox:checked').length;
            var chkbox = $('input[name=hide14]:checked', '#appraisal6').val();
//                     alert(chkbox);
            if (selectedval == 1 && chkbox != "on") {
                $("#othertestdiv").show();
            }
            else {
                $("#othertestdiv").hide();
            }
        });
        $('#insulin_type_other').on('change', function() {
            var selectedval = $('#insulin_type_other:checkbox:checked').length;
            var $chkbox = $('input[name=hide14]:checked', '#appraisal6').val();
            if (selectedval == 1 && $chkbox != "on") {
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

        $('#appraisal6').submit(function() {
            //Clone validation
            $('generate_datepic agency.agency').each(function() {
                if (!$.trim($(this).val()).length) {
                    return false; // or e.preventDefault();
                }
            });

            var $feedtube = $('input[name=feeding_tubeval]:checked', '#appraisal6').val();
            var $chkbox = $('input[name=hide14]:checked', '#appraisal6').val();
            var $fieldss1 = $(this).find('input[name="feeding_tube_mic"]:checked');
            var $fieldss2 = $(this).find('input[name="feeding_tube_peg"]:checked');
            var $fieldss3 = $(this).find('input[name="feeding_tube_jtube"]:checked');
            var $fieldss4 = $(this).find('input[name="feeding_tube_ng"]:checked');
            var $fieldss5 = $(this).find('input[name="feeding_tube_gj"]:checked');
            if ($feedtube == "yes" && $chkbox != "on" && !$fieldss1.length && !$fieldss2.length && !$fieldss3.length && !$fieldss4.length && !$fieldss5.length) {
                $('.errorchk2').remove();
                $('#chkerror2').append("<span class='errorchk2'>Error: " + "You must check at least one Feeding Tube" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk2').remove();
                return true;
            }
        });
        $('#appraisal6').submit(function() {
            var $feed = $('input[name=feeding_assist]:checked', '#appraisal6').val();
            var $chkbox = $('input[name=hide14]:checked', '#appraisal6').val();
            var $fields1 = $(this).find('input[name="feeding_type_total"]:checked');
            var $fields2 = $(this).find('input[name="feeding_type_assess"]:checked');
            var $fields3 = $(this).find('input[name="feeding_type_open"]:checked');
            var $fields4 = $(this).find('input[name="feeding_type_cutting"]:checked');
            if ($feed == "yes" && $chkbox != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length) {
                $('.errorchk').remove();
                $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one assistance" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk').remove();
                return true;
            }

        });



        //Insulin Delivery
        $('#appraisal6').submit(function() {
//                        alert('cal');
//                        alert($('input[name=hide8]:checked', '#assessment6').val());
            var $fields1 = $(this).find('input[name="insulin_type_syringe"]:checked');
            var $chkbox = $('input[name=hide15]:checked', '#appraisal6').val();
            var $fields2 = $(this).find('input[name="insulin_type_pen"]:checked');
            var $fields3 = $(this).find('input[name="insulin_type_pump"]:checked');
            var $fields4 = $(this).find('input[name="insulin_type_pod"]:checked');
            var $fields5 = $(this).find('input[name="insulin_type_other"]:checked');
            if (!$fields1.length && $chkbox != "on" && !$fields2.length && !$fields3.length && !$fields4.length && !$fields5.length) {
                $('.errorchk3').remove();
                $('#chkerror3').append("<span class='errorchk3'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk3').remove();
                return true;
            }
        });

        $('#appraisal6').submit(function() {

            var $fieldss1 = $(this).find('input[name="swallow_vfss"]:checked');
            var $fieldss2 = $(this).find('input[name="swallow_endo"]:checked');
            var $fieldss3 = $(this).find('input[name="hide14"]:checked');
            if (!$fieldss1.length && !$fieldss2.length && !$fieldss3.length) {
                $('.errorchk4').remove();
                $('#chkerror4').append("<span class='errorchk4'>Error: " + "You must check at least one for the Last Swallow Study" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk4').remove();
                return true;
            }
        });
        //Autosave
        setInterval(function() {
            var queryString = $('#appraisal6').serialize();
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
if (count($wizardData->planname7) > 1) {
    echo count($wizardData->planname7);
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

//                            $(e).datepicker("destroy");
//                            $(e).datepicker();
                });

            }, afterRemoveCurrent: function(source) {
                $('.generate_datepic').each(function(i, e) {
//                            $(e).datepicker("destroy");
//                            $(e).datepicker();
                });
            }

        });


//Date7
<?php
foreach ($wizardData->hcap_emer_review as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_hcap_emer_review').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($wizardData->hcap_emer_dist as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_hcap_emer_dist').val('<?php echo $value2; ?>');
<?php } ?>
<?php
foreach ($wizardData->newplanname as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_newplanname').val('<?php echo $value2; ?>');
<?php } ?>

//sheepItForm1_0_seizure_plan7
        //Edit option data brings
<?php
for ($i = 0; $i < count($wizardData->planname7); $i++) {
//Date7
    if ($wizardData->planname7[$i] == 'yes') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_seizure_planname7').prop('checked', 'true');
        <?php
    }
    if ($wizardData->planname7[$i] == '') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_seizure_planname8').prop('checked', 'true');
        <?php
    }
    if ($wizardData->hcap_emer_teacher[$i] == 'Teachers') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_hcap_emer_teacher').prop('checked', 'true');
        <?php
    }
    if ($wizardData->hcap_emer_bus[$i] == 'Bus') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_hcap_emer_bus').prop('checked', 'true');
        <?php
    }
    if ($wizardData->hcap_emer_hr[$i] == 'HR File') {
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
//For health cate plan
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


    });
</script>