<style>
    select{
        width:auto!important;
    }
</style>
<?php
// load dashboard admin menu 
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment12', 'name' => 'assessment12', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment12', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment12", 'class' => "healthform");
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
if (empty($wiz_12->sif)):
    $wiz_12 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_12->sif);
     else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_12->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;

//exit;
?>
<div id="assessment_wizard_12">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>  
        <?php if (!empty($editaction) && $wiz_12->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions; ?></div>
        <?php endif; ?>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(13)" id="hide13" name="hide13" value="on" <?php echo!empty($wiz_12->hide13) ? ' checked ' : '' ?> /> <label for="hide13"><span></span>No needs at this time</label></span>
            <legend>Orthopedics and Mobility Requirements</legend>
            <div class="hide13">
                <fieldset>
                    <section>
                        <span class="inline"><input type="checkbox" name="mobility_amb" id="mobility_amb" value="Ambulatory" <?php echo!empty($wiz_12->mobility_amb) ? ' checked ' : '' ?> /><label for="mobility_amb"><span></span> Ambulatory</label></span>
                        <span class="inline"><input type="checkbox" name="mobility_ind" id="mobility_ind" value="Independent" <?php echo!empty($wiz_12->mobility_ind) ? ' checked ' : '' ?> /><label for="mobility_ind"><span></span> Independent</label></span>
                        <span class="inline"><input type="checkbox" name="mobility_ns" id="mobility_ns" value="Needs Supervision" <?php echo!empty($wiz_12->mobility_ns) ? ' checked ' : '' ?> /><label for="mobility_ns"><span></span> Needs Supervision</label></span>
                        <span class="inline"><input type="checkbox" name="mobility_uw" id="mobility_uw" value="Uses Walker" <?php echo!empty($wiz_12->mobility_uw) ? ' checked ' : '' ?> /><label for="mobility_uw"><span></span> Uses Walker</label></span>
                        <span class="inline"><input type="checkbox" name="mobility_gt" id="mobility_gt" value="Gait Trainer" <?php echo!empty($wiz_12->mobility_gt) ? ' checked ' : '' ?> /><label for="mobility_gt"><span></span> Gait Trainer</label></span>
                        <span class="inline"><input type="checkbox" name="mobility_wheel" id="mobility_wheel" value="Wheelchair" <?php echo!empty($wiz_12->mobility_wheel) ? ' checked ' : '' ?> /><label for="mobility_wheel"><span></span> Wheelchair</label></span>

                        <label for="wc">Wheelchair</label>
                        <span class="inline"><input type="checkbox" name="wc_mi" id="wc_mi" value="Manual Independent" <?php echo!empty($wiz_12->wc_mi) ? ' checked ' : '' ?> /><label for="wc_mi"><span></span> Manual Independent</label></span>
                        <span class="inline"><input type="checkbox" name="wc_ma" id="wc_ma" value="Manual Assist" <?php echo!empty($wiz_12->wc_ma) ? ' checked ' : '' ?> /><label for="wc_ma"><span></span> Manual Assist</label></span>
                        <span class="inline"><input type="checkbox" name="wc_pi" id="wc_pi" value="Power Independent" <?php echo!empty($wiz_12->wc_pi) ? ' checked ' : '' ?> /><label for="wc_pi"><span></span> Power Independent</label></span>
                        <span class="inline"><input type="checkbox" name="wc_pa" id="wc_pa" value="Power Assist" <?php echo!empty($wiz_12->wc_pa) ? ' checked ' : '' ?> /><label for="wc_pa"><span></span> Power Assist</label></span>
                        <span class="inline"><input type="checkbox" name="wc_so" id="wc_so" value="Supervision Only" <?php echo!empty($wiz_12->wc_so) ? ' checked ' : '' ?> /><label for="wc_so"><span></span> Supervision Only</label></span>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="sc">Special Consideration</label>
                        <textarea id="sc" name="sc"><?php echo $wiz_12->sc ?></textarea>
                    </section>
                    <section>
                        <label for="equip-provider">Equipment Provider</label>
                        <input type="text" id="equip_provider" name="equip_provider"  value="<?php echo $wiz_12->equip_provider ?>"/>

                        <label for="c-info">Contact Info</label>
                        <input type="text" id="c_info" name="c_info" value="<?php echo $wiz_12->c_info ?>" />
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="scoliosis">Scoliosis?</label>
                        <span class="inline"><input type="radio" name="scoliosis" id="scoliosis" onclick="showvalue303(this.value)" value="yes" <?php echo!empty($wiz_12->scoliosis) ? ' checked ' : '' ?> /><label for="scoliosis"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="scoliosis" id="scoliosis" onclick="showvalue303(this.value)" value="" <?php echo empty($wiz_12->scoliosis) ? ' checked ' : '' ?> /><label for="scoliosis"><span></span> No</label></span>
                        <div id="hidename303">
                            <label for="sco-last">Last X-Ray/Exam</label>
                            <input type="text" id="sco_last" name="sco_last" value="<?php echo $wiz_12->sco_last ?>" />

                            <label for="sco-treat">Treatment</label>
                            <input type="text" id="sco_treat" name="sco_treat" value="<?php echo $wiz_12->sco_treat ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="hip">Hip Dislocation?</label>
                        <span class="inline"><input type="radio" name="hip" id="hip" value="yes" onclick="showvalue330(this.value)" <?php echo!empty($wiz_12->hip) ? ' checked ' : '' ?> /><label for="hip"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="hip" id="hip" value="" onclick="showvalue330(this.value)" <?php echo empty($wiz_12->hip) ? ' checked ' : '' ?> /><label for="hip"><span></span> No</label></span>
                        <div id="hidename330">
                            <label for="hip-last">Last X-Ray/Exam</label>
                            <input type="text" id="hip_last" name="hip_last" value="<?php echo $wiz_12->hip_last ?>" />

                            <label for="hip-treat">Treatment</label>
                            <input type="text" id="hip_treat" name="hip_treat" value="<?php echo $wiz_12->hip_treat ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="pt">Physical Therapy Services?</label>
                        <span class="inline"><input type="radio" name="pt" onclick="showvalue14()" id="pt" value="yes" <?php echo!empty($wiz_12->pt) ? ' checked ' : '' ?>/><label for="pt"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="pt" onclick="showvalue14()" id="pt" value="" <?php echo empty($wiz_12->pt) ? ' checked ' : '' ?>  /><label for="pt"><span></span> No</label></span>
                        <div id="divval14" style="display: none">
                            <label for="pt_where">If Yes, where?</label>
                            <span class="inline"><input type="radio" name="pt_where" id="pt_where" value="Home" <?php echo ($wiz_12->pt_where == "Home") ? ' checked ' : '' ?> /><label for="pt_where"><span></span> Home</label></span>
                            <span class="inline"><input type="radio" name="pt_where" id="pt_where" value="School" <?php echo ($wiz_12->pt_where == "School") ? ' checked ' : '' ?> /><label for="pt_where"><span></span> School</label></span>
                            <span class="inline"><input type="radio" name="pt_where" id="pt_where" value="Both" <?php echo ($wiz_12->pt_where == "Both") ? ' checked ' : '' ?> /><label for="pt_where"><span></span> Both</label></span>
                        </div>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="mobi-details">Details of mobility concerns, tone, strength, endurance</label>
                        <textarea  name="mobi_text" id="mobi_text"><?php echo $wiz_12->mobi_text ?></textarea>
                    </section>
                    <section>
                        <label for="orth">Orthotics?</label>
                        <span class="inline"><input type="radio" name="orth" id="orth" value="yes" onclick="showvalue305(this.value)" <?php echo!empty($wiz_12->orth) ? ' checked ' : '' ?> /><label for="orth"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="orth" id="orth" value="" onclick="showvalue305(this.value)" <?php echo empty($wiz_12->orth) ? ' checked ' : '' ?> /><label for="orth"><span></span> No</label></span>
                        
                        <div id="hidename305">
                            <label for="pos_plan_desc">Type</label>
                            <input type="text" id="orth_desc" name="orth_desc" value="<?php echo $wiz_12->orth_desc ?>" />
                        </div>
                        <label for="splint">Splints?</label>
                        <span class="inline"><input type="checkbox" name="splint_hand" id="splint_hand" value="Hand" <?php echo!empty($wiz_12->splint_hand) ? ' checked ' : '' ?> /><label for="splint_hand"><span></span> Hand</label></span>
                        <span class="inline"><input type="checkbox" name="splint_knee" id="splint_knee" value="Knee" <?php echo!empty($wiz_12->splint_knee) ? ' checked ' : '' ?> /><label for="splint_knee"><span></span> Knee</label></span>	
                        <span class="inline"><input type="checkbox" name="splint_leg" id="splint_leg" value="Leg" <?php echo!empty($wiz_12->splint_leg) ? ' checked ' : '' ?> /><label for="splint_leg"><span></span> Leg</label></span>
                        <span class="inline"><input type="checkbox" name="splint_ankle" id="splint_ankle" value="Ankle" <?php echo!empty($wiz_12->splint_ankle) ? ' checked ' : '' ?> /><label for="splint_ankle"><span></span> Ankle</label></span>

                        <label for="lift">Transfer/Lift Assistance?</label>
                        <span class="inline"><input type="checkbox" name="lift_one" id="lift_one" value="One Person" <?php echo!empty($wiz_12->lift_one) ? ' checked ' : '' ?> /><label for="lift_one"><span></span> One Person</label></span>
                        <span class="inline"><input type="checkbox" name="lift_two" id="lift_two" value="Two Person" <?php echo!empty($wiz_12->lift_two) ? ' checked ' : '' ?> /><label for="lift_two"><span></span> Two Person</label></span>
                        <span class="inline"><input type="checkbox" name="lift_hoyer" id="lift_hoyer" value="Hoyer" <?php echo!empty($wiz_12->lift_hoyer) ? ' checked ' : '' ?> /><label for="lift_hoyer"><span></span> Hoyer</label></span>
                    </section>
                </fieldset>
                <fieldset class="twocol">
                    <section>
                        <label for="pos-plan">Positioning Plan?</label>
                        <span class="inline"><input type="radio" name="pos_plan" onclick="showvalue15()" id="pos_plan" value="yes" <?php echo!empty($wiz_12->pos_plan) ? ' checked ' : '' ?> /><label for="pos_plan"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="pos_plan" onclick="showvalue15()" id="pos_plan" value="" <?php echo empty($wiz_12->pos_plan) ? ' checked ' : '' ?> /><label for="pos_plan"><span></span> No</label></span>
                        <div id="divval15" style="display: none">
                            <label for="pos-plan-desc">If Yes, describe</label>
                            <textarea id="pos_plan_desc" name="pos_plan_desc"><?php echo $wiz_12->pos_plan_desc ?></textarea>
                        </div>
                    </section>
                    <section>
                        <label for="mobi-addtnl">Additional Comments</label>
                        <textarea id="mobi_addtnl" name="mobi_addtnl"><?php echo $wiz_12->mobi_addtnl ?></textarea>
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
                    if (!empty($wiz_12->sif) && $status['wizard_status'] == 25 && $userrole->level == 50): 
                        #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                     <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_12->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
                    //Autosave
                    setInterval(function() {
                        var queryString = $('#assessment12').serialize();
                        //alert(queryString);
                        var baseurl = '<?php echo base_url(); ?>';
                        //alert(baseurl);
                        $.ajax({
                            type: "POST",
                            url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                        });
                    }, 10000); // 10 seconds
                    //Autosave end 
                    var pt = $('#pt').val();
                    var pp = $('#pos_plan').val();

                    if (pt == 'yes') {
                        showvalue14();
                    }
                    if (pp == 'yes') {
                        showvalue15();
                    }
                });
</script>