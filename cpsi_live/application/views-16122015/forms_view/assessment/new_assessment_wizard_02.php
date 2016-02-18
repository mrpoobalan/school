<style>
    select{
        width: auto!important;
    }
    .error{
        color:red;
    }
</style>
<?php
// load dashboard admin menu 
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment2', 'name' => 'assessment2', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment2", 'class' => "healthform");
$sif = array('name' => 'sif', 'type' => 'hidden');

if (empty($wiz_02->sif)):
    $wiz_02 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_02->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_02->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;

if ($wiz_02->reevaldate == '01-01-1970' || $wiz_02->reevaldate == '1970-01-01')
{
    $wiz_02->reevaldate = "";
}
if ($wiz_02->previousdate == '01-01-1970' || $wiz_02->previousdate == '1970-01-01')
{
    $wiz_02->previousdate = "";
}
//echo '<pre>';
//print_r($wiz_02);
//exit;
?>
<div id="assessment_wizard_2">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>  
        <?php if (!empty($editaction) && $wiz_02->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions; ?></div>
        <?php endif; ?>
        <fieldset>
            <section>
                <label>Type of Assessment</label>
                <span class="inline"><input type="radio"  value="initial"  id="assessment" name="assessment" <?php echo 'checked'; ?> /> <label for="initial"><span></span>Initial Assessment</label></span>
                <span class="inline"><input type="radio"  value="followup" id="assessment" name="assessment" <?php echo ($wiz_02->assessment == 'followup') ? ' checked ' : '' ?>/> <label for="followup"><span></span>Follow Up Assessment</label></span>
            </section>
        </fieldset>
        <fieldset class="new-section">
            <legend>Medical Diagnosis</legend>
            <span class="inline hide"><input type="checkbox" onclick="hideSection(366)" id="hide366"  name="hide366" value = "on" <?php echo!empty($wiz_02->hide366) && $wiz_02->hide366 == 'on' ? ' checked ' : '' ?> /> <label for="hide366"><span></span>No needs at this time</label></span>
            <div class="hide366">
                <?php
                $wiz_02->diagnosis1 = (!empty($wiz_02->diagnosis1)) ? $wiz_02->diagnosis1 : $wiz_02->newdiagnosis;
                $diagnosis_array = array();
                $diagnosis_array = explode(',', $wiz_02->diagnosis1);
                $diagnosis_array = array_filter($diagnosis_array);
                ?>
                <div id="sheepItForm" style="float:left">

                    <div id="sheepItForm_template">
                        <input id="sheepItForm_#index#_diagnosis" name="newdiagnosis[]" type="text"  />
                        <a id="sheepItForm_remove_current">
                            <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                        </a>
                        <div class="clear"></div>
                    </div>
                    <!-- No forms template -->
                    <div id="sheepItForm_noforms_template">No Medical Diagnosis</div>
                </div>
                <div id="sheepItForm_add" ><span><a>Add Medical Diagnosis</a></span></div>
            </div>
        </fieldset>

        <fieldset id="background" class="new-section">
            <legend>Background</legend>
            <section>
                <label for="birthweight">Birth Weight</label>
                <input id="birthweight"  name="birthweight" type="text" value="<?php echo $wiz_02->birthweight ?>" />
                <label for="gestation">Gestation</label>
                <input type="text" id="gestation" name="gestation" value="<?php echo $wiz_02->gestation ?>">
                <label for="birthtype">Birth Type</label>
                <span class="inline"><input type="radio" name="birthtype" value="vaginal" id="birthtype" checked="checked"/> <label for="vaginal"><span></span>Vaginal</label></span>
                <span class="inline"><input type="radio" name="birthtype" value="csection" id="birthtype" <?php echo ($wiz_02->birthtype == 'csection' || $wiz_02->birthtype[0] == 'csection') ? ' checked ' : '' ?>/> <label for="csection"><span></span>C-Section</label></span>
            </section>
            <section>
                <label>Developmental Milestones Met</label>
                <span class="inline"><input type="radio"  value="yes"  id="milestone" onclick="showva25(this.value)" name="milestone" <?php
                    if ($wiz_02->milestone <> "no" || $wiz_02->milestones == "milestoneyes")
                    {
                        ?> checked="checked" <?php } ?> /> <label for="m-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio"  value="no" id="milestone" onclick="showva25(this.value)"   name="milestone" <?php
                    if ($wiz_02->milestone == "no" || $wiz_02->milestones == "milestoneno")
                    {
                        ?> checked="checked" <?php } ?>/> <label for="m-no"><span></span>No</label></span>
                <div id="hidename25" style="display: block">
                    <label for="describe-milestones">If no, please describe</label>
                    <?php !empty($wiz_02->describe_milestones) ? $wiz_02->describe_milestones = $wiz_02->describe_milestones : ''; ?>
                    <?php !empty($wiz_02->describemilestones) ? $wiz_02->describe_milestones = $wiz_02->describemilestones : ''; ?>
                    <textarea id="describe_milestones" name="describe_milestones"><?php echo $wiz_02->describe_milestones ?></textarea>
                </div>
            </section>
            <div style="clear:both"></div>
            <section>
                <label>Complications</label>
                <span class="inline"><input type="radio"  value="yes"  id="complications" onclick="showva75(this.value)" name="complications" <?php
                    if ($wiz_02->complications == "yes")
                    {
                        ?> checked="checked" <?php } ?> /> <label for="m-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio"  value="no" id="complications" onclick="showva75(this.value)"   name="complications" <?php
                    if (empty($wiz_02->complications) || $wiz_02->complications == "no")
                    {
                        ?> checked="checked" <?php } ?>/> <label for="m-no"><span></span>No</label></span>
                <div id="hidename75">
                    <label for="describe-milestones">If yes, please describe</label>
                    <textarea id="describe_complications" name="describe_complications"><?php echo $wiz_02->describe_complications ?></textarea>
                </div>
            </section>
            <section>
                <label>Emergencies, Hospitalizations, or Surgeries</label>
                <span class="inline"><input type="radio"  value="yes"  id="emergencies" onclick="showva76(this.value)" name="emergencies" <?php
                    if ($wiz_02->emergencies == "yes")
                    {
                        ?> checked="checked" <?php } ?> /> <label for="m-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio"  value="no" id="emergencies" onclick="showva76(this.value)"   name="emergencies" <?php
                    if (empty($wiz_02->emergencies) || $wiz_02->emergencies == "no")
                    {
                        ?> checked="checked" <?php } ?>/> <label for="m-no"><span></span>No</label></span>
                <div id="hidename76">
                    <label for="describe_emergencies">If yes, please describe</label>
                    <textarea id="describe_emergencies" name="describe_emergencies"><?php echo $wiz_02->describe_emergencies ?></textarea>
                </div>
            </section>
        </fieldset>
        <fieldset class="new-section">
            <legend>History of Diagnosis/Current Health Status</legend>
            <label for="previousdate">See Previous Nursing Assessment Dated</label>
            <?php !empty($wiz_02->previousdate) ? $wiz_02->previousdate = $wiz_02->previousdate : '' ?>
            <?php !empty($wiz_02->previous) ? $wiz_02->previousdate = $wiz_02->previous : '' ?>

            <input type="text" id="previousdate"  name="previousdate" value="<?php echo $wiz_02->previousdate ?>" />			
            <span id="moredates1" name="moredates1"></span>
            <label for="narrative">Narrative</label>
            <textarea id="narrative" name="narrative"><?php
                if ($wiz_02->narrative <> "")
                {
                    echo $wiz_02->narrative;
                }
                ?></textarea>
        </fieldset>
        <fieldset>
            <section class="buttons" >
                <div class="nextbutton">
                    <?= $link_back; ?>	

                    <?= form_submit($attr_FormSubmit_assessment); ?>
                </div>
                <div class="savebuttons float-left">
                    <?= form_input($sif, set_value("sif", $sif_num)); ?>
                    <?php
                    if (!empty($wiz_02->sif) && $status['wizard_status'] == 25 && $userrole->level == 50): 
                        #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_02->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
                    endif;
                    ?>
                    <?= form_submit($attr_FormSave_assessment); ?>
                    <?= form_close(); ?>	
                </div>
            </section>
        </fieldset>		
    </section>		
</div>
<script type="text/javascript">
                $(document).ready(function() {
                    //Autosave
                    setInterval(function() {
                        var queryString = $('#assessment2').serialize();
                        //alert(queryString);
                        var baseurl = '<?php echo base_url(); ?>';
                        //alert(baseurl);
                        $.ajax({
                            type: "POST",
                            url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                        });
                    }, 10000); // 10 seconds
                    //Autosave end 

//For dropdown grade show / Hidden
                    $('#grade').on('change', function() {
                        var selectedval = $(this).val();
                        if (selectedval == "Other") {
                            $("#othergradediv").show();
                        }
                        else {
                            $("#othergradediv").hide();
                        }
                    });
                    $(function() {
                        $("select#grade").change();
                    });
                    //Add medical diagonisis
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
                    if ($count > 1)
                    {
                        echo $count;
                    }
                    else
                    {
                        echo "1";
                    }
                    ?>


                    });


<?php
if (!empty($diagnosis_array)):
    foreach ($diagnosis_array as $key => $val)
    {
        ?>
                            $('#sheepItForm_<?php echo $key; ?>_diagnosis').val('<?php echo $val; ?>');
    <?php } endif;
?>


                });
</script>
