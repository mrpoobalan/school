<style>
    select{
        width:auto!important;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
if (empty($wizardData->sif)):
    $wizardData = $autosave;
endif;
$attr_FormSubmit_appraisal = array('class' => 'save', 'id' => 'appraisal2', 'name' => 'appraisal2', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_appraisal = array('id' => 'appraisal', 'name' => 'appraisal_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "appraisal2", 'class' => "healthform");
$sif = array('name' => 'sif', 'type' => 'hidden');

// setup values for all checkboxes
if ($wizardData) {
    $checkboxFields = array('edustatus', 'edustatus2', 'eduservices', 'offlocation', 'assistant', 'birthtype', 'milestones', 'assisttech', 'accomodations');
    foreach ($checkboxFields as $field) {
        if (property_exists($wizardData, $field) && is_array($wizardData->{$field})) {
            foreach ($wizardData->{$field} as $key => $selectedValue) {
                $selectedValue = strtolower($selectedValue);
                $wizardData->$selectedValue = $selectedValue;
            }
        }
    }
}
//echo '<pre>';;
//print_r($wizardData);
//exit;
?>

<section class="page">
    <h1><?= $subtitle ?></h1>
    <?= form_open("{$action}", $attr_FormOpen); ?>
    <fieldset class="new-section">
        <legend>Medical Diagnosis</legend>
        <span class="inline hide"><input type="checkbox" onclick="hideSection(366)" id="hide366"  name="hide366" value = "on" <?php echo!empty($wizardData->hide366) && $wizardData->hide366 == 'on' ? ' checked ' : '' ?> /> <label for="hide366"><span></span>Not Applicable</label></span>
        <div class="hide366">
            <?php
            $wizardData->newdiagnosis = (!empty($wizardData->newdiagnosis)) ? $wizardData->newdiagnosis : $wizardData->diagnosis1;
            $diagnosis_array = array();
            $diagnosis_array = explode(',', $wizardData->newdiagnosis);
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
            <input id="birthweight" type="text" name="birthweight" value="<?= !empty($wizardData->birthweight) ? $wizardData->birthweight : ''; ?>" />
            <label for="gestation">Gestation</label>
            <input type="text" id="gestation" name="gestation" value="<?= !empty($wizardData->gestation) ? $wizardData->gestation : ''; ?>" >
            <label for="birthtype">Birth Type</label>
            <span class="inline"><input type="radio" name="birthtype[]" value="vaginal" id="vaginal" checked="checked"/> <label for="vaginal"><span></span>Vaginal</label></span>
            <span class="inline"><input type="radio" name="birthtype[]" value="csection" id="csection" <?= !empty($wizardData->csection) || !empty($wizardData->birthtype) && $wizardData->birthtype == 'csection' ? ' checked ' : ''; ?> /> <label for="csection"><span></span>C-Section</label></span>
        </section>
        <section>
            <label>Developmental Milestones Met</label>
            <span class="inline"><input type="radio" name="milestones" onchange="showvalue26(this.value)" value="yes" id="m-yes" checked="checked" /> <label for="m-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio" name="milestones" onchange="showvalue26(this.value)" value="no" id="m-no" <?= (!empty($wizardData->milestones) && $wizardData->milestones == "milestoneno") || (!empty($wizardData->milestones) && $wizardData->milestones == 'no') ? ' checked ' : ''; ?>/> <label for="m-no"><span></span>No</label></span>
            <div id="hidenamevalsmiles">
                <label for="describemilestones">If No, please descrbe</label>
                <?php !empty($wizardData->describe_milestones) ? $wizardData->describemilestones = $wizardData->describe_milestones : ''; ?>
                <textarea id="describemilestones" name="describemilestones"><?= !empty($wizardData->describemilestones) ? $wizardData->describemilestones : ''; ?></textarea>
            </div>
        </section>
        <div style="clear:both"></div>
        <section>

            <label>Complications</label>
            <span class="inline"><input type="radio"  value="yes"  id="complications" onclick="showva75(this.value)" name="complications" <?php
                if ($wizardData->complications == "yes") {
                    ?> checked="checked" <?php } ?> /> <label for="m-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio"  value="no" id="complications" onclick="showva75(this.value)"   name="complications" <?php
                if (empty($wizardData->complications) || $wizardData->complications == "no") {
                    ?> checked="checked" <?php } ?>/> <label for="m-no"><span></span>No</label></span>
            <div id="hidename75">
                <label for="describe-milestones">If yes, please describe</label>
                <textarea id="describe_complications" name="describe_complications"><?php echo $wizardData->describe_complications ?></textarea>
            </div>
        </section>
        <section>
            <label>Emergencies, Hospitalizations, or Surgeries</label>
            <span class="inline"><input type="radio"  value="yes"  id="emergencies" onclick="showva76(this.value)" name="emergencies" <?php
                if ($wizardData->emergencies == "yes") {
                    ?> checked="checked" <?php } ?> /> <label for="m-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio"  value="no" id="emergencies" onclick="showva76(this.value)"   name="emergencies"  <?php
                if (empty($wizardData->emergencies) || $wizardData->emergencies == "no") {
                    ?> checked="checked" <?php } ?> /> <label for="m-no"><span></span>No</label></span>
            <div id="hidename76">
                <label for="describe_emergencies">If yes, please describe</label>
                <textarea id="describe_emergencies" name="describe_emergencies"><?php echo $wizardData->describe_emergencies ?></textarea>
            </div>
        </section>
    </fieldset>
    <fieldset class="new-section">
        <legend>History of Diagnosis/Current Health Status</legend>
        <label for="previous">See Previous Nursing Assessment Dated</label>
        <?php !empty($wizardData->previousdate) ? $wizardData->previous = $wizardData->previousdate : '' ?>
        <input type="text" id="previous" name="previous"  value="<?= !empty($wizardData->previous) ? $wizardData->previous : ''; ?>"/>
        <label for="narrative">Narrative</label>
        <textarea id="narrative" name="narrative"><?= !empty($wizardData->narrative) ? $wizardData->narrative : ''; ?></textarea>
    </fieldset>


    <section class="buttons">
        <div class="nextbutton">
            <?= $link_back; ?>
            <?= form_submit($attr_FormSubmit_appraisal); ?>
        </div>
        <div class="savebuttons float-left">
            <?= form_input($sif, set_value("sif", $sif_num)); ?>
            <?php
            //click to final page
            $reviewvalue = $this->session->userdata('reviewappraisal');
            $wiz02->sif = $this->session->userdata('sifnumberval');
            $wiz02->unique_number = $this->session->userdata('sifunique_number');
            if (!empty($reviewvalue)):
                echo anchor("health_appraisal/appraisal/complete_appraisal/" . $wiz02->sif . "/" . $wiz02->unique_number, "<button type='button' class='previous'>Go to final page</button>");
            endif;
            ?>
            <?= form_submit($attr_FormSave_appraisal); ?>
        </div>
        <div class="clear"></div>
    </section>
    <?= form_close(); ?>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        //Autosave
        setInterval(function() {
            var queryString = $('#appraisal2').serialize();
            //alert(queryString);
            var baseurl = '<?php echo base_url(); ?>';
            //alert(baseurl);
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end

        //hidename show

        /* var milestonesval=($("input:radio[name='milestones[]']").val());
         alert(milestonesval);
         if(milestonesval=="milestoneyes"){
         alert('1');
         $("#hidenamevals").hide();
         //$("#hidenamevals").css("display","none");
         }else if(milestonesval=="milestoneno"){
         alert('2');
         $("#hidenamevals").show();
         }

         $("input:radio[name='milestones[]']").click(function(){
         var chkval=(this.value);
         if(chkval=='milestoneno'){
         $("#hidenamevals").css("display","block");
         }else if(chkval=='milestoneyes'){
         $("#hidenamevals").css("display","none");
         }
         });*/
//For dropdown grade show / Hidden
        $('#grade').on('change', function() {
            var selectedval = $(this).val();
//                   alert(selectedval);
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
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
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

<?php
if (!empty($diagnosis_array)):
    foreach ($diagnosis_array as $key => $val) {
        ?>
                $('#sheepItForm_<?php echo $key; ?>_diagnosis').val(<?php echo $this->db->escape($val); ?>);
    <?php } endif;
?>
    });

    //Appraisla 2nd form validation if yes is selected
    //Appraisal 4 validation


</script>

