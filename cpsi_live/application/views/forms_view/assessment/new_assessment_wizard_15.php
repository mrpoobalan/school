<style>
    select{
        width:auto!important;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn_primary', 'id' => 'assessment15', 'name' => 'assessment15', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment15', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment15", 'class' => "healthform");
if (empty($wiz_15->sif)):
    $wiz_15 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_15->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_15->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_15">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_15->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;  ?></div>
        <?php endif; ?>
        <fieldset class="new_section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(16)" id="hide16" name="hide16" value="on"  <?php echo!empty($wiz_15->hide16) ? ' checked ' : '' ?> /> <label for="hide16"><span></span>No needs at this time</label></span>
            <legend class="legends">Transportation Status</legend>
            <div class="hide16">
                <fieldset>
                    <section>
                        <label for="trans_method">Method of Transportation</label>
                        <span class="inline"><input type="checkbox" name="trans_method_walker" id="trans_method_walker" value="Walker" <?php echo!empty($wiz_15->trans_method_walker) ? ' checked ' : '' ?> /><label for="trans_method_walker"><span></span> Walker</label></span>
                        <span class="inline"><input type="checkbox" name="trans_method_car" id="trans_method_car" value="Car Rider" <?php echo!empty($wiz_15->trans_method_car) ? ' checked ' : '' ?> /><label for="trans_method_car"><span></span> Car Rider</label></span>
                        <span class="inline"><input type="checkbox" name="trans_method_bus" id="trans_method_bus" value="Bus Rider" <?php echo!empty($wiz_15->trans_method_bus) ? ' checked ' : '' ?> /><label for="trans_method_bus"><span></span> Bus Rider</label></span>
                        <span class="inline"><input type="checkbox" name="trans_method_lift" id="trans_method_lift" value="Lift Bus" <?php echo!empty($wiz_15->trans_method_lift) ? ' checked ' : '' ?> /><label for="trans_method_lift"><span></span> Lift Bus</label></span>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="bus_services">Current Bus Services Provided</label>
                        <span><input type="checkbox" name="bus_services_assist" id="bus_services_assist" value="Assistance Needed" <?php echo!empty($wiz_15->bus_services_assist) ? ' checked ' : '' ?> /><label for="bus_services_assist"><span></span> Assistance Needed</label></span>
                        <span><input type="checkbox" name="bus_services_aide" id="bus_services_aide" value="Aide on Bus" <?php echo!empty($wiz_15->bus_services_aide) ? ' checked ' : '' ?> /><label for="bus_services_aide"><span></span> Aide on Bus</label></span>
                        <span><input type="checkbox" name="bus_services_nursing" id="bus_services_nursing" value="Nursing Services on Bus" <?php echo!empty($wiz_15->bus_services_nursing) ? ' checked ' : '' ?> /><label for="bus_services_nursing"><span></span> Nursing Services on Bus</label></span>
                        <span><input type="checkbox" name="bus_services_equip" id="bus_services_equip" value="Equipment Checklist Used" <?php echo!empty($wiz_15->bus_services_equip) ? ' checked ' : '' ?> /><label for="bus_services_equip"><span></span> Equipment Checklist Used</label></span>
                    </section>
                    <section>
                        <label for="bus_meds">Medication on Bus?</label>
                        <span class="inline"><input type="radio" name="bus_meds" onclick="showvalue19()" id="bus_meds" value="yes" <?php echo!empty($wiz_15->bus_meds) ? ' checked ' : '' ?> /><label for="bus_meds_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="bus_meds" onclick="showvalue19()" id="bus_meds" value="" <?php echo empty($wiz_15->bus_meds) ? ' checked ' : '' ?> /><label for="bus_meds_no"><span></span> No</label></span>
                        <div id="divval19" style="display: none">
                            <label for="list_bus_meds">If Yes, List</label>
                            <input type="text" id="list_bus_meds"  name="list_bus_meds" value="<?php echo $wiz_15->list_bus_meds ?>" />
                        </div>
                    </section>
                    <section>
                        <label for="med_bus">How is medication handled?</label>
                        <span><input type="checkbox" name="med_bus_selfadmin" id="med_bus_selfadmin" value="Self Carries/Self Administers" <?php echo!empty($wiz_15->med_bus_selfadmin) ? ' checked ' : '' ?> /><label for="med_bus_selfadmin"><span></span> Self Carries/Self Administers</label></span>
                        <span><input type="checkbox" name="med_bus_selfmed" id="med_bus_selfmed" value="Self Carries/Unable to Self_Administer" <?php echo!empty($wiz_15->med_bus_selfmed) ? ' checked ' : '' ?> /><label for="med_bus_selfmed"><span></span> Self Carries/Unable to Self Administer</label></span>
                        <span><input type="checkbox" name="med_bus_aideadmin" id="med_bus_aideadmin" value="Driver/Aide Trained to Administer" <?php echo!empty($wiz_15->med_bus_aideadmin) ? ' checked ' : '' ?> /><label for="med_bus_aideadmin"><span></span> Driver/Aide Trained to Administer</label></span>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <label for="bus_snacks">Snacks on Bus</label>
                        <span class="inline"><input type="radio" name="bus_snacks" id="bus_snacks" value="yes" <?php echo!empty($wiz_15->bus_snacks) ? ' checked ' : '' ?> /><label for="bus_snacks_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="bus_snacks" id="bus_snacks" value="" <?php echo empty($wiz_15->bus_snacks) ? ' checked ' : '' ?> /><label for="bus_snacks_no"><span></span> No</label></span>

                        <label for="bus_mod">Special Modifications Needed for Bus?</label>
                        <span class="inline"><input type="radio" name="bus_mod" id="bus_mod" onclick="showvalue20()" value="yes" <?php echo!empty($wiz_15->bus_mod) ? ' checked ' : '' ?> /><label for="bus_mod_yes"><span></span> Yes</label></span>
                        <span class="inline"><input type="radio" name="bus_mod" id="bus_mod" onclick="showvalue20()" value="" <?php echo empty($wiz_15->bus_mod) ? ' checked ' : '' ?> /><label for="bus_mod_no"><span></span> No</label></span>

                    </section>
                    <div id="divval20" style="display: none">
                        <section>
                            <label for="bus_mod_list">If Yes, List Special Modifications Needed</label>
                            <textarea id="bus_mod_list" name="bus_mod_list"><?php echo $wiz_15->bus_mod_list ?></textarea>
                        </section>
                    </div>
                </fieldset>
                <fieldset>
                    <section class="largetext">
                        <label for="trans_comments">Additional Comments</label>
                        <textarea id="trans_comments" name="trans_comments"><?php echo $wiz_15->trans_comments ?></textarea>
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
                    if (!empty($wiz_15->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_15->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
        //Fifteenth form
        //Autosave
        setInterval(function() {
            var queryString = $('#assessment15').serialize();
            var baseurl = '<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end
        var bus_meds;
        var bus_mod;
        bus_meds = $('#bus_meds').val();
        bus_mod = $('#bus_mod').val();
        if (bus_meds == 'yes') {
            showvalue19();
        }
        if (bus_mod == 'yes') {
            showvalue20();
        }

    });
</script>