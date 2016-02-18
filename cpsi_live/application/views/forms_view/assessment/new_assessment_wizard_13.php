<style>
    select{
        width:auto!important;
    }
    .errorchk{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
    .errorchk2{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
    .errorchk3{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
</style>
<?php
// load dashboard admin menu 
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn_primary', 'id' => 'assessment13', 'name' => 'assessment13', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment13', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment13", 'class' => "healthform");
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
if (empty($wiz_13->sif)):
    $wiz_13 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_13->sif);
     else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_13->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
if ($wiz_13->swallow_study_date == '1970_01_01')
{
    $wiz_13->swallow_study_date = "";
}

function date_change($val)
{
    $res = str_replace('_', '-', $val);
    $exp = explode("-", $res);
    return $exp[1] . "-" . $exp[2] . "-" . $exp[0];
}
?>
<div id="assessment_wizard_13">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>  
        <?php if (!empty($editaction) && $wiz_13->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions; ?></div>
        <?php endif; ?>
        <fieldset class="new_section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(14)" id="hide144" name="hide144" value="on" <?php echo!empty($wiz_13->hide144) ? ' checked ' : '' ?>/> <label for="hide144"><span></span>No needs at this time</label></span>
            <legend class="legends">Nutrition and Feeding Safety Requirements</legend>
            <div class="hide144">
                <fieldset>
                    <section>
                        <span class="inline"><input type="radio" name="diet" id="diet" onclick="showvalue306(this.value)" value="Nothing By Mouth" checked="checked" /><label for="diet_nothing"><span></span> Nothing By Mouth</label></span><br/>
                        <span class="inline"><input type="radio" name="diet" id="diet" onclick="showvalue306(this.value)"  value="Regular Diet" <?php echo ($wiz_13->diet == "Regular Diet") ? ' checked ' : '' ?> /><label for="diet_reg"><span></span> Regular Diet</label></span><br/>
                        <span class="inline"><input type="radio" name="diet" id="diet" onclick="showvalue306(this.value)" value="Special Diet"  <?php echo ($wiz_13->diet == "Special Diet") ? ' checked ' : '' ?> /><label for="diet_special"><span></span> Special Diet</label></span>
                        <div id="hidename306">
                            <label for="food_texture">Description</label>
                            <input type="text" id="food_texture" name="food_texture" value="<?php echo $wiz_13->food_texture ?>" />
                        </div>
                        <span><input type="checkbox" name="prepare_parent" id="prepare_parent" value="Parent Prepares" <?php echo!empty($wiz_13->prepare_parent) ? ' checked ' : '' ?> /><label for="prepare_parent"><span></span> Parent Prepares</label></span>
                        <span><input type="checkbox" name="prepare_school" id="prepare_school" value="School Cafe Prepares" <?php echo!empty($wiz_13->prepare_school) ? ' checked ' : '' ?>  /><label for="prepare_school"><span></span> School Cafe Prepares</label></span>

                    </section>
                    <section>
                        <label for="food_restriction">Other Dietary Restriction</label>
                        <textarea id="food_restriction" name="food_restriction"><?php echo $wiz_13->food_restriction ?></textarea>

                        <label for="fluid_restriction">Fluid Consistency/Restrictions</label>
                        <textarea id="fluid_restriction" name="fluid_restriction"><?php echo $wiz_13->fluid_restriction ?></textarea>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="feeding_assist">Feeding Assistance Needed?</label>
                        <span class="inline"><input type="radio" name="feeding_assist" onclick="showvalue340(this.value)" id="feeding_assist" value="yes" <?php echo!empty($wiz_13->feeding_assist) ? ' checked ' : '' ?> /><label for="feeding_assist_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="feeding_assist"  onclick="showvalue340(this.value)"  id="feeding_assist" value="" <?php echo empty($wiz_13->feeding_assist) ? ' checked ' : '' ?> /><label for="feeding_assist_no"><span></span> No</label></span>
                        <div id="hidename340">
                            <label for="feeding_type">If Yes, what assistance is needed?</label>
                            <span><input type="checkbox" name="feeding_type_total" id="feeding_type_total" value="Total" <?php echo!empty($wiz_13->feeding_type_total) ? ' checked ' : '' ?> /><label for="feeding_type_total"><span></span> Total</label></span>
                            <span><input type="checkbox" name="feeding_type_assess" id="feeding_type_assess" value="Assessing food only" <?php echo!empty($wiz_13->feeding_type_assess) ? ' checked ' : '' ?> /><label for="feeding_type_assess"><span></span> Assessing food only</label></span>
                            <span><input type="checkbox" name="feeding_type_open" id="feeding_type_open" value="Opening containers" <?php echo!empty($wiz_13->feeding_type_open) ? ' checked ' : '' ?> /><label for="feeding_type_open"><span></span> Opening containers</label></span>
                            <span><input type="checkbox" name="feeding_type_cutting" id="feeding_type_cutting" value="Cutting food" <?php echo!empty($wiz_13->feeding_type_cutting) ? ' checked ' : '' ?> /><label for="feeding_type_cutting"><span></span> Cutting food</label></span>
                        </div>
                        <div id="chkerror"></div>
                    </section>
                    <section>
                        <label for="feeding_tube">Feeding Tube?</label>
                        <span class="inline"><input type="radio" name="feeding_tubeval"  id="feeding_tubeval" onclick="showvalue339(this.value)" value="yes" <?php echo!empty($wiz_13->feeding_tubeval) ? ' checked ' : '' ?> /><label for="feeding_assist_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="feeding_tubeval"    id="feeding_tubeval" onclick="showvalue339(this.value)" value="" <?php echo empty($wiz_13->feeding_tubeval) ? ' checked ' : '' ?> /><label for="feeding_assist_no"><span></span> No</label></span>
                        <div id="hidename339">
                            <label for="feeding_tube">If Yes, what Feeding Tube is needed</label>
                            <span><input type="checkbox" name="feeding_tube_mic" id="feeding_tube_mic" value="Mic_key Button" <?php echo!empty($wiz_13->feeding_tube_mic) ? ' checked ' : '' ?> /><label for="feeding_tube_mic"><span></span> Button</label></span>
                            <span><input type="checkbox" name="feeding_tube_peg" id="feeding_tube_peg" value="PEG Tube" <?php echo!empty($wiz_13->feeding_tube_peg) ? ' checked ' : '' ?> /><label for="feeding_tube_peg"><span></span> PEG Tube</label></span>
                            <span><input type="checkbox" name="feeding_tube_jtube" id="feeding_tube_jtube" value="J_Tube" <?php echo!empty($wiz_13->feeding_tube_jtube) ? ' checked ' : '' ?> /><label for="feeding_tube_jtube"><span></span> J-Tube</label></span>
                            <span><input type="checkbox" name="feeding_tube_ng" id="feeding_tube_ng" value="N/G Tube" <?php echo!empty($wiz_13->feeding_tube_ng) ? ' checked ' : '' ?> /><label for="feeding_tube_ng"><span></span> N/G Tube</label></span>
                            <span><input type="checkbox" name="feeding_tube_gj" id="feeding_tube_gj" value="G/J Tube" <?php echo!empty($wiz_13->feeding_tube_gj) ? ' checked ' : '' ?> /><label for="feeding_tube_gj"><span></span> G/J-Tube</label></span>
                            <div id="chkerror2"></div>
                       
                        <label for="gtube_size">G-Tube Size</label>
                        <input type="text" id="gtube_size" name="gtube_size" value="<?php echo $wiz_13->gtube_size ?>" />

                        <label for="tube_type">Type</label>
                        <input type="text" id="tube_type" name="tube_type" value="<?php echo $wiz_13->tube_type ?>" />
                         </div>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="inst_dislodged">Instructions if dislodged at school</label>
                        <textarea id="inst_dislodged" name="inst_dislodged"><?php echo $wiz_13->inst_dislodged ?></textarea>
                    </section>
                    <section>
                        <label for="tube_feedings">Tube Feedings</label>
                        <span class="inline"><input type="checkbox" name="tube_feedings_bolus" onclick="showvalue307(this.value)" id="tube_feedings_bolus" value="Bolus" <?php echo!empty($wiz_13->tube_feedings_bolus) ? ' checked ' : '' ?> /> <label for="tube_feedings_bolus"><span></span> Bolus</label></span>
                        <span class="inline"><input type="checkbox" name="tube_feedings_pump"  onclick="showvalue307(this.value)" id="tube_feedings_pump" value="Pump" <?php echo!empty($wiz_13->tube_feedings_pump) ? ' checked ' : '' ?> /> <label for="tube_feedings_pump"><span></span> Pump</label></span>
                      
                        <div id="hidename307">
                            <label for="feed_freq">Type/Time/Frequency (in hours)/Amount</label>
                            <input type="text" id="feed_freq" name="feed_freq" value="<?php echo $wiz_13->feed_freq ?>" />
                        </div>
                    </section>

                </fieldset>
                <fieldset>
                    <section>
                        <label for="water_flush">Water Flush?</label>
                        <span class="inline"><input type="radio" name="water_flush" id="water_flush" value="yes" <?php echo!empty($wiz_13->water_flush) ? ' checked ' : '' ?> /><label for="water_flush_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="water_flush" id="water_flush" value="" <?php echo empty($wiz_13->water_flush) ? ' checked ' : '' ?> /><label for="water_flush_no"><span></span> No</label></span>

                        <label for="free_water">Free Water?</label>
                        <span class="inline"><input type="radio" name="free_water" id="free_water" value="yes" <?php echo!empty($wiz_13->free_water) ? ' checked ' : '' ?> /><label for="free_water_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="free_water" id="free_water" value="" <?php echo empty($wiz_13->free_water) ? ' checked ' : '' ?> /><label for="free_water_no"><span></span> No</label></span>

                        <label for="fundo">Fundoplication?</label>
                        <span class="inline"><input type="radio" name="fundo" id="fundo" value="yes" <?php echo!empty($wiz_13->fundo) ? ' checked ' : '' ?> /><label for="fundo_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="fundo" id="fundo" value="" <?php echo empty($wiz_13->fundo) ? ' checked ' : '' ?> /><label for="fundo_no"><span></span> No</label></span>

                    </section>

                    <section>
                        <label for="swallow_study">Last Swallow Study</label>
                        <span class="inline"><input type="checkbox" name="swallow_vfss" id="swallow_vfss" value="VFSS" <?php echo!empty($wiz_13->swallow_vfss) ? ' checked ' : '' ?> /> <label for="swallow_vfss"><span></span> VFSS</label></span>
                        <span class="inline"><input type="checkbox" name="swallow_endo" id="swallow_endo" value="Endo" <?php echo!empty($wiz_13->swallow_endo) ? ' checked ' : '' ?> /> <label for="swallow_endo"><span></span> Endo</label></span>
                        <div id="chkerror3"></div>
                        <label for="swallow_study_date">Date of Study</label>
                        <input type="text" id="swallow_study_date" name="swallow_study_date" 
                               value="<?php
                               if ($wiz_13->swallow_study_date <> "")
                               {
                                   echo ($wiz_13->swallow_study_date);
                               }
                               ?>" />

                        <label for="swallow_study_loc">Location of Study</label>
                        <input type="text" id="swallow_study_loc" name="swallow_study_loc" value="<?php echo $wiz_13->swallow_study_loc ?>" />

                    </section>
                    <section>
                        <label for="reflux">Reflux?</label>
                        <span class="inline"><input type="radio" name="reflux" id="reflux" onclick="showvalue341(this.value)" value="yes" <?php echo!empty($wiz_13->reflux) ? ' checked ' : '' ?> /><label for="reflux_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="reflux" id="reflux" onclick="showvalue341(this.value)" value="" <?php echo empty($wiz_13->reflux) ? ' checked ' : '' ?> /><label for="reflux_no"><span></span> No</label></span>
                        <div id="hidename341">
                            <label for="reflux_tx">Treatment</label>
                            <input type="text" id="reflux_tx" name="reflux_tx" value="<?php echo $wiz_13->reflux_tx ?>" />
                        </div>

                    </section>
                </fieldset>
                <fieldset class="threecol">
                    <section>
                        <label for="clinic">Feeding Clinic?</label>
                        <span class="inline"><input type="radio" name="clinic" id="clinic" onclick="showvalue353(this.value)" value="yes" <?php echo!empty($wiz_13->clinic) ? ' checked ' : '' ?> /><label for="clinic_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="clinic" id="clinic" onclick="showvalue353(this.value)" value="" <?php echo empty($wiz_13->clinic) ? ' checked ' : '' ?> /><label for="clinic_no"><span></span> No</label></span>
                        <div id="hidename353">
                        <label for="clinic_details">Where and How Often?</label>
                        <input type="text" id="clinic_details" name="clinic_details"  value="<?php echo $wiz_13->clinic_details ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="smart_team">AACPS SMART Team Managing?</label>
                        <span class="inline"><input type="radio" name="smart_team" id="smart_team" onclick="showvalue354(this.value)" value="yes" <?php echo!empty($wiz_13->smart_team) ? ' checked ' : '' ?> /><label for="smart_team_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="smart_team" id="smart_team" onclick="showvalue354(this.value)" value="" <?php echo empty($wiz_13->smart_team) ? ' checked ' : '' ?> /><label for="smart_team_no"><span></span> No</label></span>
                        <div id="hidename354">
                        <label for="smart_manager">Case Manager</label>
                        <input type="text" id="smart_manager" name="smart_manager" value="<?php echo $wiz_13->smart_manager ?>" />
                        </div>
                        <label for="meal_care">Mealtime Plan of Care</label>
                        <textarea id="meal_care" name="meal_care"><?php echo $wiz_13->meal_care ?></textarea>
                    </section>
                </fieldset>
                <fieldset>
                    <section class="largetext">
                        <label for="nutr_comments">Additional Comments</label>
                        <textarea id="nutr_comments" name="nutr_comments"><?php echo $wiz_13->nutr_comments ?></textarea>
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
                    if (!empty($wiz_13->sif) && $status['wizard_status'] == 25 && $userrole->level == 50): 
                        #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                     <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_13->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
                    $('#assessment13').submit(function() {
                        var $feed = $('input[name=feeding_assist]:checked', '#assessment13').val();
                        var $fields1 = $(this).find('input[name="feeding_type_total"]:checked');
                        var $fields2 = $(this).find('input[name="feeding_type_assess"]:checked');
                        var $fields3 = $(this).find('input[name="feeding_type_open"]:checked');
                        var $fields4 = $(this).find('input[name="feeding_type_cutting"]:checked');
                        if ($feed == "yes" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length) {
                            $('.errorchk').remove();
                            $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one assistance" + "</span>");
                            return false; // The form will *not* submit
                        }
                        else {
                            $('.errorchk').remove();
                            return true;
                        }

                    });
                    $('#assessment13').submit(function() {
                        var $feedtube = $('input[name=feeding_tubeval]:checked', '#assessment13').val();
                        var $fieldss1 = $(this).find('input[name="feeding_tube_mic"]:checked');
                        var $fieldss2 = $(this).find('input[name="feeding_tube_peg"]:checked');
                        var $fieldss3 = $(this).find('input[name="feeding_tube_jtube"]:checked');
                        var $fieldss4 = $(this).find('input[name="feeding_tube_ng"]:checked');
                        var $fieldss5 = $(this).find('input[name="feeding_tube_gj"]:checked');
                        if ($feedtube == "yes" && !$fieldss1.length && !$fieldss2.length && !$fieldss3.length && !$fieldss4.length && !$fieldss5.length) {
                            $('.errorchk2').remove();
                            $('#chkerror2').append("<span class='errorchk2'>Error: " + "You must check at least one Feeding Tube" + "</span>");
                            return false; // The form will *not* submit
                        }
                        else {
                            $('.errorchk2').remove();
                            return true;
                        }
                    });
                    $('#assessment13').submit(function() {

                        var $fieldss1 = $(this).find('input[name="swallow_vfss"]:checked');
                        var $fieldss2 = $(this).find('input[name="swallow_endo"]:checked');
                        var $fieldss3 = $(this).find('input[name="hide144"]:checked');
                        if (!$fieldss1.length && !$fieldss2.length && !$fieldss3.length) {
                            $('.errorchk3').remove();
                            $('#chkerror3').append("<span class='errorchk3'>Error: " + "You must check at least one for the Last Swallow Study" + "</span>");
                            return false; // The form will *not* submit
                        }
                        else {
                            $('.errorchk3').remove();
                            return true;
                        }
                    });
                    //Autosave
                    setInterval(function() {
                        var queryString = $('#assessment13').serialize();
                        var baseurl = '<?php echo base_url(); ?>';
                        $.ajax({
                            type: "POST",
                            url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                        });
                    }, 10000); // 10 seconds
                    //Autosave end 
                    var fa = $('#feeding_assist').val();
                    if (fa == 'yes') {
                        showvalue16();
                    }
                });
</script>