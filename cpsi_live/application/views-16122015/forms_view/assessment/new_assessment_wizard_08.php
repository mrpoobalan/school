<style>
    select{
        width:auto!important;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment8', 'name' => 'assessment8', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment8', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment8", 'class' => "healthform");
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
if (empty($wiz_08->sif)):
    $wiz_08 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_08->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_08->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_8">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_08->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;   ?></div>
        <?php endif; ?>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(10)" id="hide10" name="hide10" value = "on" <?php echo!empty($wiz_08->hide10) ? ' checked ' : '' ?> /> <label for="hide10"><span></span>No needs at this time</label></span>
            <legend>Cardiac Requirements</legend>
            <div class="hide10">
                <fieldset class="threecol">
                    <section class="largetext" >
                        <label for="cardiac-history">Cardiac History</label>
                        <textarea id="cardiac_history" name="cardiac_history"> <?php echo $wiz_08->cardiac_history ?> </textarea>
                    </section>
                    <section>
                        <label for="restrictions">Restrictions?</label>
                        <span class="inline"><input type="radio" name="restrictions" onclick="showvalue7()" id="restrictions" value="yes" <?php echo!empty($wiz_08->restrictions) ? ' checked ' : '' ?>  /><label for="restrictions" /><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="restrictions" onclick="showvalue7()" id="restrictions" value="" <?php echo empty($wiz_08->restrictions) ? ' checked ' : '' ?>  /><label for="restrictions" /><span></span> No</label></span>
                        <div id="divval7" style="display:none">
                            <label for="restrict-list">If yes, please list:</label>
                            <textarea id="restrict_list" name="restrict_list"><?php echo $wiz_08->restrict_list ?></textarea>
                        </div>
                        <label for="baseline">Baseline Vital Signs</label>
                        <textarea id="baseline" name="baseline"><?php echo $wiz_08->baseline; ?></textarea>
                    </section>
                    <section>
                        <label for="distress">Symptoms of Distress</label>
                        <span><input type="checkbox" name="distress_pain" id="distress_pain" value="yes"  <?php echo!empty($wiz_08->distress_pain) ? ' checked ' : '' ?> /><label for="distress_pain"><span></span> Chest Pain/Tightness</label></span>
                        <span><input type="checkbox" name="distress_breath" id="distress_breath" value="yes" <?php echo!empty($wiz_08->distress_breath) ? ' checked ' : '' ?>  /><label for="distress_breath"><span></span> Shortness of Breath</label></span>
                        <span><input type="checkbox" name="distress_palpitations" id="distress_palpitations" value="yes" <?php echo!empty($wiz_08->distress_palpitations) ? ' checked ' : '' ?> /><label for="distress_palpitations"><span></span> Palpitations</label></span>
                        <span><input type="checkbox" name="distress_diaphoresis" id="distress_diaphoresis" value="yes" <?php echo!empty($wiz_08->distress_diaphoresis) ? ' checked ' : '' ?> /><label for="distress_diaphoresis"><span></span> Diaphoresis</label></span>
                        <span><input type="checkbox" name="distress_fatigue" id="distress_fatigue" value="yes" <?php echo!empty($wiz_08->distress_fatigue) ? ' checked ' : '' ?> /><label for="distress_fatigue"><span></span> Fatigue</label></span>
                        <span><input type="checkbox" name="distress_dyspnea" id="distress_dyspnea" value="yes" <?php echo!empty($wiz_08->distress_dyspnea) ? ' checked ' : '' ?> /><label for="distress_dyspnea"><span></span> Dyspnea on Exertion</label></span>
                        <span><input type="checkbox" name="distress_fainting" id="distress_fainting" value="yes" <?php echo!empty($wiz_08->distress_fainting) ? ' checked ' : '' ?> /><label for="distress_fainting"><span></span> Fainting</label></span>
                        <span><input type="checkbox" name="distress_other" id="distress_other" value="yes" <?php echo!empty($wiz_08->distress_other) ? ' checked ' : '' ?> /><label for="distress_other"><span></span> Other</label></span>
                        <input type="text" id="symptom_other" name="symptom_other" value="<?php echo $wiz_08->symptom_other ?>" />
                    </section>
                    <section>
                        <label for="pacemaker">Pacemaker?</label>
                        <span class="inline"><input type="radio" name="pacemaker" id="pacemaker" value="yes" <?php echo!empty($wiz_08->pacemaker) ? ' checked ' : '' ?>  /><label for="pacemaker-yes"> Yes</label></span>
                        <span class="inline"><input type="radio" name="pacemaker" id="pacemaker" value="" <?php echo empty($wiz_08->pacemaker) ? ' checked ' : '' ?> /><label for="pacemaker-no"> No</label></span>

                        <label for="defib">Internal Defibrillator?</label>
                        <span class="inline"><input type="radio" name="defib" id="defib" value="yes" <?php echo!empty($wiz_08->defib) ? ' checked ' : '' ?>  /><label for="defib-yes"> Yes</label></span>
                        <span class="inline"><input type="radio" name="defib" id="defib" value="" <?php echo empty($wiz_08->defib) ? ' checked ' : '' ?>  /><label for="defib-no"> No</label></span>

                        <label for="aed">Personal AED?</label>
                        <span class="inline"><input type="radio" name="aed" id="aed" value="yes" <?php echo!empty($wiz_08->aed) && $wiz_08->aed == "yes" ? ' checked ' : '' ?>  /><label for="aed-yes"> Yes</label></span>
                        <span class="inline"><input type="radio" name="aed" id="aed" value="" <?php echo empty($wiz_08->aed) ? ' checked ' : '' ?>  /><label for="aed-no"> No</label></span>
                    </section>
                </fieldset>
                <fieldset class="threecol">
                    <section>
                        <label for="skin-color">Baseline Skin Color</label>
                        <span><input type="checkbox" name="skin_color_normal" id="skin_color_normal" value="Normal"  <?php echo!empty($wiz_08->skin_color_normal) ? ' checked ' : '' ?> /><label for="skin_color_normal"><span></span> Normal</label></span>
                        <span><input type="checkbox" name="skin_color_cyanosis" id="skin_color_cyanosis" value="Cyanosis" <?php echo!empty($wiz_08->skin_color_cyanosis) ? ' checked ' : '' ?> /><label for="skin_color_cyanosis"><span></span> Cyanosis</label></span>
                        <span><input type="checkbox" name="skin_color_jaundice" id="skin_color_jaundice" value="Jaundice" <?php echo!empty($wiz_08->skin_color_jaundice) ? ' checked ' : '' ?>  /><label for="skin_color_jaundice"><span></span> Jaundice</label></span>
                        <span><input type="checkbox" name="skin_color_pallor" id="skin_color_pallor" value="Pallor" <?php echo!empty($wiz_08->skin_color_pallor) ? ' checked ' : '' ?>  /><label for="skin_color_pallor"><span></span> Pallor</label></span>
                        <span><input type="checkbox" name="skin_color_erythema" id="skin_color_erythema" value="Erythema" <?php echo!empty($wiz_08->skin_color_erythema) ? ' checked ' : '' ?>  /><label for="skin_color_erythema"><span></span> Erythema</label></span>
                        <span><input type="checkbox" name="skin_color_other" id="skin_color_other" value="Other" <?php echo!empty($wiz_08->skin_color_other) ? ' checked ' : '' ?>  /><label for="skin_color_other"><span></span> Other</label></span>
                        <input type="text" id="skin_color_comment"  name="skin_color_comment" value=" <?php echo $wiz_08->skin_color_comment ?>"  />
                    </section>
                    <section>
                        <label for="cardiac-addtnl">Additional Comments</label>
                        <textarea id="cardiac_addtnl" name="cardiac_addtnl"><?php echo $wiz_08->cardiac_addtnl ?></textarea>
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
                    if (!empty($wiz_08->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_08->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
                    endif;
                    ?>
                    <?= form_submit($attr_FormSave_assessment); ?>
                    <?= form_close(); ?>
                </div>
            </section>
        </fieldset>
</div>
<script type="text/javascript">
    $('#skin_color_other').change(function() {
        var colcheck = $('#skin_color_other').is(':checked');
        if (colcheck) {
            $('#skin_color_comment').show();
        } else {
            $('#skin_color_comment').hide();
            $('#skin_color_comment').val('');
        }
    });
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
        //Autosave
        setInterval(function() {
            var queryString = $('#assessment8').serialize();
            var baseurl = '<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end
        //show values for edit
        var restrictions = $('#restrictions').val();
        if (restrictions == 'yes') {
            showvalue7();
        }
        $("input[type=checkbox]").change();
        var colcheck = $('#skin_color_other').is(':checked');

        if (colcheck) {
            // alert(colcheck);
            $('#skin_color_comment').show();
        } else {
            $('#skin_color_comment').hide();
            $('#skin_color_comment').val('');
        }
    });
</script>