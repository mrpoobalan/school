<style>
    select{
        width:auto!important;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment7', 'name' => 'assessment7', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment7', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment7", 'class' => "healthform");
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
if (empty($wiz_07->sif)):
    $wiz_07 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_07->sif);
     else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_07->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_7">
    <section class="page">
        <h1><?= $subtitle ?></h1>
<?= form_open("" . $action . "", $attr_FormOpen); ?>
<?php if (!empty($editaction) && $wiz_07->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions; ?></div>
        <?php endif; ?>
        <fieldset class="new-section">
            <span class="inline hide">
                <input type="checkbox" onclick="hideSection(9)" id="hide9" name="hide9" value = "on" <?php echo!empty($wiz_07->hide9) ? ' checked ' : '' ?> />
                <label for="hide9"><span></span>No needs at this time</label>
            </span>
            <legend>Elimination Requirements</legend>
            <div class="hide9">
                <section>
                    <span class="inline"><input type="checkbox" name="elimination_independent" value="yes" id="elimination_independent" <?php echo!empty($wiz_07->elimination_independent) ? ' checked ' : '' ?> /> <label for="elimination_independent"><span></span>Independent</label></span>
                    <span class="inline"><input type="checkbox" name="elimination_scheduled" value="yes" id="elimination_scheduled" <?php echo!empty($wiz_07->elimination_scheduled) ? ' checked ' : '' ?> /> <label for="elimination_scheduled"><span></span>Scheduled</label></span>
                    <span class="inline"><input type="checkbox" name="elimination_prompted" value="yes" id="elimination_prompted" <?php echo!empty($wiz_07->elimination_prompted) ? ' checked ' : '' ?> /> <label for="elimination_prompted"><span></span>Prompted</label></span>
                    <span class="inline"><input type="checkbox" name="elimination_diapered" value="yes" id="elimination_diapered" <?php echo!empty($wiz_07->elimination_diapered) ? ' checked ' : '' ?> /> <label for="elimination_diapered"><span></span>Diapered</label></span>
                </section>
                <section class="clear threecol">
                    <label for="continence">Continence</label>
                    <span><input type="checkbox" name="continence_continent" value="yes" id="continence_continent"  <?php echo!empty($wiz_07->continence_continent) ? ' checked ' : '' ?> /><label for="continence_continent"><span></span> Continent</label></span>
                    <span><input type="checkbox" name="continence_incontinent_bowel" value="yes" id="continence_incontinent_bowel" <?php echo!empty($wiz_07->continence_incontinent_bowel) ? ' checked ' : '' ?> /><label for="continence_incontinent_bowel"><span></span> Incontinent - Bowel</label></span>
                    <span><input type="checkbox" name="continence_incontinent_bladder" value="yes" id="continence_incontinent_bladder" <?php echo!empty($wiz_07->continence_incontinent_bladder) ? ' checked ' : '' ?> /><label for="continence_incontinent_bladder"><span></span> Incontinent - Bladder</label></span>
                </section>
                <section>
                    <label for="toilet-type">How Student is Toileted</label>
                    <!--<span class="inline"><input type="radio" name="toilet" value="no" id="toilet" <?php //echo ($wiz_07->toilet == "no")? ' checked ':''            ?> /><label> No</label></span><br>-->
                    <span class="inline"><input type="radio" name="toilet" value="Toilet" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wiz_07->toilet == "Toilet") ? ' checked ' : '' ?> /> <label> Toilet</label></span><br>
                    <span class="inline"><input type="radio" name="toilet" value="Changing Table" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wiz_07->toilet == "Changing Table") ? ' checked ' : '' ?> /> <label> Changing Table</label></span><br>
                    <span class="inline"><input type="radio" name="toilet" value="Commode" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wiz_07->toilet == "Commode") ? ' checked ' : '' ?> /> <label> Commode</label></span><br>
                    <span class="inline"><input type="radio" name="toilet" value="Other" id="toilet" onclick="showvalue342(this.value)" <?php echo ($wiz_07->toilet == "Other") ? ' checked ' : '' ?> /> <label> Other</label></span><br>
                    <div id="hidename342">
                        <input type="text" id="other_toilet"  name="other_toilet" value="<?php echo $wiz_07->other_toilet ?>" />
                    </div>
                </section>
                <section>
                    <label for="toileted">Where is Student Toileted</label>
                    <!--<span class="inline"><input type="radio" name="toileted" value="none" id="toileted" <?php //echo ($wiz_07->toileted == "none")? ' checked ':''            ?> /><label> No &nbsp;&nbsp;</label></span><br>-->
                    <span class="inline"><input type="radio" name="toileted" onclick="showvalue343(this.value)" value="In HR" id="toileted" <?php echo ($wiz_07->toileted == "In HR") ? ' checked ' : '' ?> /> <label> In HR </label></span><br>
                    <span class="inline"><input type="radio" name="toileted" onclick="showvalue343(this.value)" value="In Bathroom" id="toileted" <?php echo ($wiz_07->toileted == "In Bathroom") ? ' checked ' : '' ?> /> <label> In Bathroom </label></span><br>
                    <span class="inline"><input type="radio" name="toileted" onclick="showvalue343(this.value)" value="Other" id="toileted" <?php echo ($wiz_07->toileted == "Other") ? ' checked ' : '' ?> /> <label>  Other</label><br>
                        <div id="hidename343">
                            <span class="inline"><input type="text" id="toileted_student" name="toileted_student" value="<?php echo $wiz_07->toileted_student ?>" />
                            </span>
                        </div>
                </section>
                <div style="clear:both"></div>
                <fieldset>
                    <section class="clear">
                        <label for="regime">Bowel Regime</label>
                        <span class="inline"><input type="radio" name="regime" id="regime" value="yes" <?php echo!empty($wiz_07->regime) ? ' checked ' : '' ?> /> <label>Yes</label> &nbsp;
                            <input type="radio" name="regime" id="regime" value="" <?php echo empty($wiz_07->regime) ? ' checked ' : '' ?> /> <label>No</label></span>
                    </section>
                    <section>
                        <label for="constipation">History of Constipation?</label>
                        <span class="inline"><input type="radio" name=constipation id="constipation" onclick="showvalue322(this.value)" value="yes" <?php echo!empty($wiz_07->constipation) ? ' checked ' : '' ?> /> <label>Yes &nbsp;</label>
                            <input type="radio" name="constipation" id="constipation" onclick="showvalue322(this.value)" value="" <?php echo empty($wiz_07->constipation) ? ' checked ' : '' ?> /> <label> No</label></span>
                        <div id="hidename322">
                            <label for="constipation_mgmnt">Management</label>
                            <textarea id="constipation_mgmnt" name="constipation_mgmnt"><?php echo $wiz_07->constipation_mgmnt ?></textarea>
                        </div>
                    </section>				

                    <section class="clear">
                        <label for="colostomy">Colostomy?</label>
                        <span class="inline"><input type="radio" name="colostomy" id="colostomy" onclick="showvalue323(this.value)" value="yes" <?php echo!empty($wiz_07->colostomy) ? ' checked ' : '' ?> /> <label>Yes</label></span>
                        <span class="inline"><input type="radio" name="colostomy" id="colostomy" onclick="showvalue323(this.value)" value="" <?php echo empty($wiz_07->colostomy) ? ' checked ' : '' ?> /> <label>No</label></span>
                        <div id="hidename323">
                            <label for="colostomy_mgmnt">Management</label>
                            <textarea id="colostomy_mgmnt" name="colostomy_mgmnt"><?php echo $wiz_07->colostomy_mgmnt ?></textarea>
                        </div>
                    </section>
                    <section>
                        <label for="bladder">Bladder Regime?</label>
                        <span class="inline"><input type="radio" name="bladder" id="bladder" onclick="showvalue324(this.value)" value="yes" <?php echo!empty($wiz_07->bladder) ? ' checked ' : '' ?> /> <label> Yes</label></span>
                        <span class="inline"><input type="radio" name="bladder" id="bladder" onclick="showvalue324(this.value)" value="" <?php echo empty($wiz_07->bladder) ? ' checked ' : '' ?> /> <label> No</label></span>
                        <div id="hidename324">
                            <label for="bladder-mgmnt">Management</label>
                            <textarea id="bladder_mgmnt" name="bladder_mgmnt"><?php echo $wiz_07->bladder_mgmnt ?></textarea>
                        </div>
                    </section>
                </fieldset>
                <fieldset  class="threecol">
                    <section>
                        <label for="catheter">Urinary Catheterization?</label>
                        <span class="inline"><input type="radio" name="catheter" onclick="showvalue326(this.value)" id="catheter" value="yes"  <?php echo (!empty($wiz_07->catheter) && $wiz_07->catheter == "yes") ? ' checked ' : '' ?>  /> <label for="catheter"> Yes</label></span>
                        <span class="inline"><input type="radio" name="catheter" onclick="showvalue326(this.value)" id="catheter" value="" <?php echo (empty($wiz_07->catheter)) ? 'checked' : ''; ?>/> <label for="catheter"> No</label></span>

                        <div id="hidename326">
                            <label for="cath-size">Catheter Size</label>
                            <input type="text" id="cath_size" name="cath_size" value="<?php echo $wiz_07->cath_size ?>" />
                            <label for="cath-freq">Frequency</label>
                            <input type="text" id="cath_freq"  name="cath_freq" value="<?php echo $wiz_07->cath_freq ?>" />
                        </div>
                        <label for="self-catheter">Self-Catheterization?</label>
                        <span class="inline"><input type="radio" name="self_catheter" id="self_catheter" value="yes" <?php echo!empty($wiz_07->self_catheter) ? ' checked ' : '' ?> /> <label for="self_catheter"> Yes</label></span>
                        <span class="inline"><input type="radio" name="self_catheter" id="self_catheter" value="" <?php echo empty($wiz_07->self_catheter) ? ' checked ' : '' ?> /> <label for="self_catheter"> No</label></span>

                        <label for="stoma">Stoma?</label>
                        <span class="inline"><input type="radio" name="stoma" id="stoma" value="yes" <?php echo!empty($wiz_07->stoma) ? ' checked ' : '' ?> /> <label for="stoma"> Yes</label></span>
                        <span class="inline"><input type="radio" name="stoma" id="stoma" value="" <?php echo empty($wiz_07->stoma) ? ' checked ' : '' ?> /> <label for="stoma"> No</label></span>
                    </section>
                    <section>
                        <label for="menstruation">Menstruation?</label>
                        <span class="inline"><input type="radio" name="menstruation" onclick="showvalue325(this.value)" id="menstruation" value="yes" <?php echo!empty($wiz_07->menstruation) ? ' checked ' : '' ?>  /> <label for="menstruation-yes"> Yes</label></span>
                        <span class="inline"><input type="radio" name="menstruation" onclick="showvalue325(this.value)" id="menstruation" value="" <?php echo empty($wiz_07->menstruation) ? ' checked ' : '' ?>   /> <label for="menstruation"> No</label></span>
                        <div id="hidename325">
                            <label for="menstruation_mgmt">Management</label>
                            <textarea id="menstruation_mgmt" name="menstruation_mgmt"><?php echo $wiz_07->menstruation_mgmt ?></textarea>
                        </div>
                    </section>
                    <section>
                        <label for="diabetic">Diabetic Student?</label>
                        <span class="inline"><input type="radio" name="diabetic" id="diabetic" value="yes" <?php echo!empty($wiz_07->diabetic) ? ' checked ' : '' ?> /> <label for="diabetic"> Yes</label></span>
                        <span class="inline"><input type="radio" name="diabetic" id="diabetic" value="" <?php echo empty($wiz_07->diabetic) ? ' checked ' : '' ?> /> <label for="diabetic"> No</label></span>

                        <label for="br_privileges">Liberal Bathroom Privileges?</label>
                        <span class="inline"><input type="radio" name="br_privileges" id="br_privileges" value="yes" <?php echo!empty($wiz_07->br_privileges) ? ' checked ' : '' ?> /> <label for="br_privileges"> Yes</label></span>
                        <span class="inline"><input type="radio" name="br_privileges" id="br_privileges" value="" <?php echo empty($wiz_07->br_privileges) ? ' checked ' : '' ?> /> <label for="br_privileges"> No</label></span>
                    </section>
                    <section class="largetext">
                        <label for="elimination_addtnl">Additional Comments</label>
                        <textarea id="elimination_addtnl" name="elimination_addtnl"><?php echo $wiz_07->elimination_addtnl ?></textarea>
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
                    if (!empty($wiz_07->sif) && $status['wizard_status'] == 25 && $userrole->level == 50): 
                        #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_07->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
                        $("input[type=checkbox]").change(function()
                        {
                            var divId = $(this).attr("id");
                            if ($(this).is(":checked")) {
                                $("." + divId).hide();
                            }
                            else {
                                $("." + divId).show();
                            }
                        });
//Second form
//Autosave
                        setInterval(function() {
                            var queryString = $('#assessment7').serialize();
                            var baseurl = '<?php echo base_url(); ?>';
                            $.ajax({
                                type: "POST",
                                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                            });
                        }, 10000); // 10 seconds
//Autosave end 
                        $("input[type=checkbox]").change();
                    });
</script>
