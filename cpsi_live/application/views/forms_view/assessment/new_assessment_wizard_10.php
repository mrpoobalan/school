<style>
    select{
        width:auto!important;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment10', 'name' => 'assessment10', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment10', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment10", 'class' => "healthform");
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
if (empty($wiz_10->sif)):
    $wiz_10 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_10->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_10->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_10">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_10->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions; ?></div>
        <?php endif; ?>
        <fieldset>
            <section>
                <label for="miss_school">Did student miss school last year?<span class="tiny">(relating to Diagnosis)</span></label>
                <span class="inline"><input type="radio" name="miss_school" id="miss_school" onclick="showvalue11()" value="yes" <?php echo!empty($wiz_10->miss_school) ? ' checked ' : '' ?> /><label for="miss_school"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="miss_school" id="miss_school" onclick="showvalue11()" value="" <?php echo empty($wiz_10->miss_school) ? ' checked ' : '' ?> /><label for="miss_school"><span></span> No</label></span>

                <div id="divval11" style="display: none">
                    <label for="missed_times">If yes, how many times?</label>
                    <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="1-2" <?php echo ($wiz_10->missed_times == '1-2') ? ' checked ' : '' ?>/><label for="missed_times_1"><span></span> 1-2</label></span>
                    <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="3-5" <?php echo ($wiz_10->missed_times == '3-5') ? ' checked ' : '' ?>/><label for="missed_times_3"><span></span> 3-5</label></span>
                    <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="6-9" <?php echo ($wiz_10->missed_times == '6-9') ? ' checked ' : '' ?>/><label for="missed_times_6"><span></span> 6-9</label></span>
                    <span class="inline"><input type="radio" name="missed_times" id="missed_times" value="10 or more" <?php echo ($wiz_10->missed_times == '10 or more') ? ' checked ' : '' ?> /><label for="missed_times_10"><span></span> 10 or more</label></span>
                </div>

                <label for="med_delivery">Medication Delivery</label>
                <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" value="None" <?php echo ($wiz_10->med_delivery == 'None') ? ' checked ' : '' ?> /><label for="med_delivery-neb"><span></span> None</label></span>
                <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" value="Nebulizer"  <?php echo ($wiz_10->med_delivery == 'Nebulizer') ? ' checked ' : '' ?>/><label for="med_delivery-neb"><span></span> Nebulizer</label></span>
                <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" value="Inhaler" <?php echo ($wiz_10->med_delivery == 'Inhaler') ? ' checked ' : '' ?> /><label for="med_delivery-inhaler"><span></span> Inhaler</label></span>
                <span class="inline"><input type="radio" name="med_delivery" id="med_delivery" value="Both" <?php echo ($wiz_10->med_delivery == 'Both') ? ' checked ' : '' ?> /><label for="med_delivery-both"><span></span> Both</label></span>

                <label for="med-freq">Frequency</label>
                <input type="text" id="med_freq"  name="med_freq" value="<?php echo $wiz_10->med_freq ?>" />
                <label for="student_admin">Student able to administer medication?</label>
                <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Independent" <?php echo ($wiz_10->student_admin == 'Independent') ? ' checked ' : '' ?> /><label for="student_admin_independent"><span></span> Independent<label></span>
                            <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Dependent" <?php echo ($wiz_10->student_admin == 'Dependent') ? ' checked ' : '' ?> /><label for="student_admin_dependent"><span></span> Dependent<label></span>
                                        <span class="inline"><input type="radio" name="student_admin" id="student_admin" value="Assistance Required" <?php echo ($wiz_10->student_admin == 'Assistance Required') ? ' checked ' : '' ?> /><label for="student_admin_assist"><span></span> Assistance Required<label></span>
                                                    </section>
                                                    <section>
                                                        <label for="self-mdi">Student self-carries MDI?</label>
                                                        <span class="inline"><input type="radio" name="self_mdi" id="self_mdi" value="yes" <?php echo!empty($wiz_10->self_mdi) ? ' checked ' : '' ?> /><label for="self_mdi"><span></span> Yes<label></span>
                                                                    <span class="inline"><input type="radio" name="self_mdi" id="self_mdi" value="no" <?php echo empty($wiz_10->self_mdi) ? ' checked ' : '' ?>  /><label for="self_mdi"><span></span> No<label></span>

                                                                                <label for="mdi">MDI kept in health room?</label>
                                                                                <span class="inline"><input type="radio" name="mdi" id="mdi" value="yes" <?php echo!empty($wiz_10->mdi) ? ' checked ' : '' ?> /><label for="mdi-yes"><span></span> Yes<label></span>
                                                                                            <span class="inline"><input type="radio" name="mdi" id="mdi" value="" <?php echo empty($wiz_10->mdi) ? ' checked ' : '' ?> /><label for="mdi-no"><span></span> No<label></span>

                                                                                                        <label for="spacer">Spacer?</label>
                                                                                                        <span class="inline"><input type="radio" name="spacer" id="spacer" value="yes"  <?php echo!empty($wiz_10->spacer) ? ' checked ' : '' ?>/><label for="spacer"><span></span> Yes<label></span>
                                                                                                                    <span class="inline"><input type="radio" name="spacer" id="spacer" value="" <?php echo empty($wiz_10->spacer) ? ' checked ' : '' ?> /><label for="spacer"><span></span> No<label></span>
                                                                                                                                <br />
                                                                                                                                <input type="text" id="spacer_type" name="spacer_type" value="<?php echo $wiz_10->spacer_type ?>" />

                                                                                                                                <label for="peak">Peak flow?</label>
                                                                                                                                <span class="inline"><input type="radio" name="peak" id="peak" value="yes" <?php echo!empty($wiz_10->peak) ? ' checked ' : '' ?> /><label for="peak"><span></span> Yes<label></span>
                                                                                                                                            <span class="inline"><input type="radio" name="peak" id="peak" value="" <?php echo empty($wiz_10->peak) ? ' checked ' : '' ?>  /><label for="peak"><span></span> No<label></span>
                                                                                                                                                        <br />
                                                                                                                                                        <input type="text" id="peak_best" name="peak_best" value="<?php echo $wiz_10->peak_best ?>" />
                                                                                                                                                        </section>
                                                                                                                                                        </fieldset>
                                                                                                                                                        <fieldset>
                                                                                                                                                            <section>

                                                                                                                                                                <label for="pulm_vest">Pulmonary Vest?</label>
                                                                                                                                                                <span class="inline"><input type="radio" name="pulm_vest" id="pulm_vest" value="yes"  <?php echo!empty($wiz_10->pulm_vest) ? ' checked ' : '' ?> /><label for="pulm_vest"><span></span> Yes</label></span>
                                                                                                                                                                <span class="inline"><input type="radio" name="pulm_vest" id="pulm_vest" value=""  <?php echo empty($wiz_10->pulm_vest) ? ' checked ' : '' ?>  /><label for="pulm_vest"><span></span> No</label></span>

                                                                                                                                                                <label for="vest-freq">Frequency</label>
                                                                                                                                                                <input type="text" id="vest_freq" name="vest_freq" value="<?php echo $wiz_10->vest_freq ?>" />

                                                                                                                                                                <label for="chest-pt">Chest PT?</label>
                                                                                                                                                                <span class="inline"><input type="radio" name="chest_pt" id="chest_pt" value="yes" <?php echo!empty($wiz_10->chest_pt) ? ' checked ' : '' ?> /><label for="chest-pt-yes"><span></span> Yes</label></span>
                                                                                                                                                                <span class="inline"><input type="radio" name="chest_pt" id="chest_pt" value="" <?php echo empty($wiz_10->chest_pt) ? ' checked ' : '' ?> /><label for="chest-pt-no"><span></span> No</label></span>

                                                                                                                                                                <label for="chest-pt-freq">Frequency</label>
                                                                                                                                                                <input type="text" id="chest_pt_freq" name="chest_pt_freq" value="<?php echo $wiz_10->chest_pt_freq ?>" />
                                                                                                                                                            </section>
                                                                                                                                                            <section>
                                                                                                                                                                <label for="t-plan">Treatment Plan in School</label>
                                                                                                                                                                <span class="inline"><input type="checkbox" name="standard"  id="standard" value="yes" <?php echo!empty($wiz_10->standard) ? ' checked ' : '' ?> <label for="standard"><span></span>Standard Asthma Plan</label></span>
                                                                                                                                                                <span class="inline"><input type="checkbox" name="action" id="action" value="yes" <?php echo!empty($wiz_10->action) ? ' checked ' : '' ?> /> <label for="action"><span></span> Asthma Action Plan</label></span>
                                                                                                                                                                <span class="inline"><input type="checkbox" name="ihp" id="ihp" value="yes" <?php echo!empty($wiz_10->ihp) ? ' checked ' : '' ?> /> <label for="ihp"><span></span> IHP</label></span>
                                                                                                                                                            </section>
                                                                                                                                                            <section>
                                                                                                                                                                <label for="ed-asthma">ED visit(s) and/or hospitalizations in the last 12 months?</label>
                                                                                                                                                                <span class="inline"><input type="radio" id="ed_asthma" value="yes" name="ed_asthma" onclick="showvalue12()" <?php echo!empty($wiz_10->ed_asthma) ? ' checked ' : '' ?> /><label for="ed_asthma"><span></span> Yes</label></span>
                                                                                                                                                                <span class="inline"><input type="radio" id="ed_asthma" value="no" name="ed_asthma" onclick="showvalue12()" <?php echo empty($wiz_10->ed_asthma) ? ' checked ' : '' ?>  /><label for="ed_asthma"><span></span> No</label></span>
                                                                                                                                                                <div id="divval12">
                                                                                                                                                                    <label for="num-visits">If yes, how many?</label>
                                                                                                                                                                    <span class="inline"><input type="radio" id="num_visits" value="0" name="num_visits" <?php echo empty($wiz_10->num_visits) ? ' checked ' : '' ?> /><label for="num-visits-1"><span></span> 0</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" id="num_visits" value="1" name="num_visits" <?php echo ($wiz_10->num_visits == '1') ? ' checked ' : '' ?> /><label for="num-visits-1"><span></span> 1</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" id="num_visits" value="2" name="num_visits" <?php echo ($wiz_10->num_visits == '2') ? ' checked ' : '' ?> /><label for="num-visits-2"><span></span> 2</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" id="num_visits" value="3" name="num_visits" <?php echo ($wiz_10->num_visits == '3') ? ' checked ' : '' ?> /><label for="num-visits-3"><span></span> 3</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" id="num_visits" value="4" name="num_visits" <?php echo ($wiz_10->num_visits == '4') ? ' checked ' : '' ?> /><label for="num-visits-4"><span></span> 4</label></span>
                                                                                                                                                                    <span class="inline"><input type="radio" id="num_visits" value="5 or more" name="num_visits" <?php echo ($wiz_10->num_visits == '5 or more') ? ' checked ' : '' ?> /><label for="num-visits-5"><span></span> 5 or more</label></span>
                                                                                                                                                                </div>
                                                                                                                                                            </section>
                                                                                                                                                            <section class="largetext">
                                                                                                                                                                <label for="resp-addtnl">Additional Comments</label>
                                                                                                                                                                <textarea id="resp_addtnl" name="resp_addtnl" ><?php echo $wiz_10->resp_addtnl ?></textarea>
                                                                                                                                                            </section>
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
                                                                                                                                                                    if (!empty($wiz_10->sif) && $status['wizard_status'] == 25 && $userrole->level == 50): 
                                                                                                                                                                        #echo form_submit($attr_FormSave_reassessment);
                                                                                                                                                                    endif;
                                                                                                                                                                    ?>
                                                                                                                                                                    <?php
                                                                                                                                                                    //click to final page
                                                                                                                                                                    $reviewvalue = $this->session->userdata('reviewassesment');
                                                                                                                                                                    $unique_number = $this->session->userdata('unique_number');
                                                                                                                                                                    if (!empty($reviewvalue)):
                                                                                                                                                                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_10->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
                            var queryString = $('#assessment10').serialize();
                            var baseurl = '<?php echo base_url(); ?>';
                            $.ajax({
                                type: "POST",
                                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                            });
                        }, 10000); // 10 seconds
                        //Autosave end 
                        //Show values for edit
                        var miss_school = $('#miss_school').val();
                        var ed_asthma = $('#ed_asthma').val();
                        if (miss_school == 'yes') {
                            showvalue11();
                        }
                        if (ed_asthma == 'yes') {
                            showvalue12();
                        }
                    });
                                                                                                                                                        </script>