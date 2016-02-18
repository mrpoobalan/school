<style>
    select{
        width:auto!important;
    }
    .error{
        color:red;
    }
    .agency{

    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment3', 'name' => 'assessment3', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment3', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment3", 'class' => "healthform");

$sif = array('class' => 'form-control', 'name' => 'sif', 'id' => 'sif');
$confirmsif = array('class' => 'form-control', 'name' => 'confirmsif', 'id' => 'confirmsif');
$firstname = array('class' => 'form-control', 'name' => 'fname', 'id' => 'fname');
$lastname = array('class' => 'form-control', 'name' => 'last_name', 'id' => 'last_name');
$nickname = array('class' => 'form-control', 'name' => 'nickname', 'id' => 'nickname');
$assessment = array('class' => 'form-control', 'name' => 'assessment', 'id' => 'assessment');
$sif = array('name' => 'sif', 'type' => 'hidden');
if (empty($wiz_03->sif)):
    $wiz_03 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_03->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_03->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
if ($wiz_03->dentalexam == "01-01-1970" || $wiz_03->dentalexam == "1970-01-01") {
    $wiz_03->dentalexam = "";
}
if ($wiz_03->hearingexam == "01-01-1970" || $wiz_03->hearingexam == "1970-01-01") {
    $wiz_03->hearingexam = "";
}
if ($wiz_03->visionexam == "01-01-1970" || $wiz_03->visionexam == "1970-01-01") {
    $wiz_03->visionexam = "";
}


//echo "<pre>";
//print_r($wiz_03);
//echo "</pre>";
//exit;
?>
<div id="assessment_wizard_3">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_03->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;                          ?></div>
        <?php endif; ?>
        <fieldset class="new-section">
            <legend>Physicians</legend>
            <section>
                <label for="primary">Primary Care</label>
                <input type="text" id="primary" name="primary" value="<?php echo $wiz_03->primary ?>" />
                <label for="lastexam1">Last Exam</label>
                <input type="text" id="lastexam1" name="lastexam1" value="<?php echo $wiz_03->lastexam1 ?>" />
                <label for="nextexam1">Next Exam</label>
                <input type="text" id="nextexam1" name="nextexam1" value="<?php echo $wiz_03->nextexam1 ?>" />
                <label for="phone1">Phone</label>
                <input type="text" id="phone1" name="phone1" value="<?php echo $wiz_03->phone1 ?>" />
                <label for="fax1">Fax</label>
                <input type="text" id="fax1" name="fax1"  value="<?php echo $wiz_03->fax1 ?>" />
                <label for="release1">Release?</label>

                <span class="inline"><input type="radio" name="release1" value="yes" onclick="showvalue51(this.value)"  id="release1" <?php echo!empty($wiz_03->release1) && $wiz_03->release1 == 'yes' ? ' checked ' : ''; ?>  /> <label for="release1"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="release1" value=""  onclick="showvalue51(this.value)" id="release1"  <?php echo $wiz_03->release1 == '' ? ' checked ' : ''; ?> /> <label for="release1"><span></span>No</label></span>
                <div id="hidename51">
                    <label for="list_bus_meds">list or explain</label>
                    <textarea id="describe_release1" name="describe_release1"><?php echo $wiz_03->describe_release1 ?></textarea>

                    <label for="release-exp1">Release Expiration</label>
                    <?php !empty($wiz_03->release_exp1) ? $wiz_03->release_exp1 = $wiz_03->release_exp1 : $wiz_03->release_exp1; ?>
                    <?php !empty($wiz_03->releaseexp1) ? $wiz_03->release_exp1 = $wiz_03->releaseexp1 : $wiz_03->releaseexp1; ?>

                    <input type="text" id="release_exp1" name="release_exp1" value= "<?php echo $wiz_03->release_exp1 ?>" />
                </div>
            </section>
            <section>
                <div id="sheepItForm1">
                    <!-- Form template-->
                    <div id="sheepItForm1_template" style="border-bottom: dashed #444 0px;">
                        <label>Specialist<text id="sheepItForm1_label"></text><a id="sheepItForm1_remove_current">
                                <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                            </a></label>
                        <input id="sheepItForm1_#index#_specialist" name="sheepItForm1_specialist[#index#]" type="text" size="15" maxlength="25"  />
                        <label for="sheepItForm1_#index#_lastexam">Type of Physician</label>
                        <input id="sheepItForm1_#index#_type" name="sheepItForm1_type[#index#]" type="text" size="15" maxlength="50"  />

                        <label for="sheepItForm1_#index#_lastexam">Last Exam</label>
                        <input id="sheepItForm1_#index#_lastexam" name="sheepItForm1_lastexam[]" type="text" size="15" maxlength="10" class="generate_datepic" />

                        <label for="sheepItForm1_#index#_nextexam">Next Exam</label>
                        <input id="sheepItForm1_#index#_nextexam" name="sheepItForm1_nextexam[]" type="text" size="15" maxlength="10" class="generate_datepic" />
                        <label for="sheepItForm1_#index#_phone">Phone</label>
                        <input id="sheepItForm1_#index#_phone" name="sheepItForm1_phone[#index#]" type="text" size="15" maxlength="25" />
                        <label for="sheepItForm1_#index#_fax">Fax</label>
                        <input id="sheepItForm1_#index#_fax" name="sheepItForm1_fax[]" type="text" size="15" maxlength="25" />
                        <label for="sheepItForm1_#index#_release">Release</label>
                        <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                            <input type="radio" name="sheepItForm1_release#index#" value="yes" onclick="showvalue52(this.value, '#index#')" onload="showvalue52(this.value, '#index#')"
                                   id="sheepItForm1_#index#_release1" <?php echo!empty($wiz_03->sheepItForm1_release) ? ' checked ' : '' ?>  /> <label>Yes</label>
                        </span>
                        <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                            <input type="radio" name="sheepItForm1_release#index#" value="no"  onclick="showvalue52(this.value, '#index#')" onload="showvalue52(this.value, '#index#')"   id="sheepItForm1_#index#_release1"  <?php echo empty($wiz_03->sheepItForm1_release) ? ' checked ' : '' ?>/> <label>No</label>
                        </span>
                        <div id="hidename52_#index#">
                            <label for="list_bus_meds">list or explain</label>
                            <textarea id="sheepItForm1_#index#_describe_sheepItForm" name="sheepItForm1_describe_sheepItForm[]"><?php #echo $wiz_03->describe_sheepItForm                            ?></textarea>

                            <label for="sheepItForm1_#index#_exp">Release Expiration</label>
                            <input id="sheepItForm1_#index#_releaseexp" name="sheepItForm1_releaseexp[]" type="text" size="15" maxlength="10" class="generate_datepic" />
                        </div>
                    </div>
                    <!-- /Form template-->
                    <!-- No forms template -->
                    <div id="sheepItForm1_noforms_template">No Specialists</div>
                    <!-- /No forms template-->
                </div>
            </section>
            <section class="buttons">
                <p><div id="sheepItForm1_add"><a class="addnew-button" href="javascript:addNewDr()">Add New Specialist</a></div></p>
            </section>
        </fieldset>
        <fieldset class="new-section threecol">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(1)" id="hide1" name="hide1" value = "on" <?php echo!empty($wiz_03->hide1) ? ' checked ' : '' ?> /> <label for="hide1" ><span></span>No needs at this time</label></span>
            <legend>Dental, Hearing, and Vision</legend>
            <div class="hide1">
                <section>
                    <label for="dentist">Dentist</label>
                    <input type="text" id="dentist"  name="dentist"  value="<?php echo $wiz_03->dentist ?>" />
                    <label for="dentalexam">Exam Date</label>
                    <input type="text" id="dentalexam" name="dentalexam"  value="<?php echo $wiz_03->dentalexam ?>" />
                    <label for="dentalhistory">History and Treatment</label>
                    <textarea id="dentalhistory" name="dentalhistory"><?php echo $wiz_03->dentalhistory ?></textarea>
                    <label for="dentalrelease">Consent for Record Release?</label>
                    <span class="inline"><input type="radio" name="dentalrelease" value="yes" id="dentalrelease" <?php echo 'checked'; ?> /> <label for="dentalrelease"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="dentalrelease" value="" id="dentalrelease" <?php echo empty($wiz_03->dentalrelease) || $wiz_03->dentalrelease[0] == 'dentalreleaseno' ? ' checked ' : '' ?>  /> <label for="dentalrelease"><span></span>No</label></span>
                </section>
                <section>
                    <label for="hearing">Hearing</label>
                    <input type="text" id="hearing" name="hearing" value="<?php echo $wiz_03->hearing ?>" />
                    <label for="hearingexam">Exam Date</label>
                    <input type="text" id="hearingexam" name="hearingexam"   value= "<?php echo $wiz_03->hearingexam ?>" />
                    <label for="hearinghistory">History and Treatment</label>
                    <textarea id="hearinghistory" name="hearinghistory"><?php echo $wiz_03->hearinghistory ?></textarea>
                    <label for="hearingrelease">Consent for Record Release?</label>
                    <span class="inline"><input type="radio" name="hearingrelease" value="yes" id="hearingrelease" <?php echo 'checked'; ?> /> <label for="hearingrelease"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="hearingrelease" value="" id="hearingrelease" <?php echo empty($wiz_03->hearingrelease) || $wiz_03->hearingrelease[0] == 'hearingreleaseno' ? ' checked ' : '' ?>/> <label for="hearingrelease"><span></span>No</label></span>
                </section>
                <section>
                    <label for="vision">Vision</label>
                    <input type="text" id="vision" name="vision" value="<?php echo $wiz_03->vision ?>" />
                    <label for="visionexam">Exam Date</label>
                    <input type="text" id="visionexam" name="visionexam" value= "<?php echo $wiz_03->visionexam ?>"  />
                    <label for="visionhistory">History and Treatment</label>
                    <textarea id="visionhistory" name="visionhistory"><?php echo $wiz_03->visionhistory ?></textarea>
                    <label for="visionrelease">Consent for Record Release?</label>
                    <span class="inline"><input type="radio" name="visionrelease" value="yes" id="visionrelease" <?php echo 'checked'; ?> /> <label for="visionrelease"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="visionrelease" value="" id="visionrelease" <?php echo empty($wiz_03->visionrelease) || $wiz_03->visionrelease[0] == 'visionreleaseno' ? 'checked ' : '' ?>  /> <label for="visionrelease"><span></span>No</label></span>
                </section>
            </div>
        </fieldset>

        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(2)" id="hide2" name="hide2" value = "on" <?php echo!empty($wiz_03->hide2) ? ' checked ' : '' ?>/> <label for="hide2"><span></span>No needs at this time</label></span>
            <legend>Agencies and Case Managers</legend>
            <div class="hide2">
                <section>
                    <div id="sheepItForm">
                        <!-- Form template-->
                        <div id="sheepItForm_template" style="border-bottom: dashed #444 0px;">
                            <legend>Agencies and Case Managers <text id="sheepItForm_label"></text><a id="sheepItForm_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a></legend>
                            <label for="sheepItForm_#index#_name">Name</label>
                            <input id="sheepItForm_#index#_name" name="sheepItForm_name[#index#]" type="text" size="15" maxlength="50" required="required" class="agency" />
                            <div class="clear"></div>
                            <label for="sheepItForm_#index#_adname">Agency Name</label>
                            <input id="sheepItForm_#index#_agname" name="sheepItForm_agname[#index#]" type="text" size="15" maxlength="50" />
                            <div class="clear"></div>
                            <label for="sheepItForm_#index#_cashman">Case Manager</label>
                            <input id="sheepItForm_#index#_cashman" name="sheepItForm_cashman[#index#]" type="text" size="15" maxlength="50" />
                            <div class="clear"></div>

                            <label for="sheepItForm_#index#_phone">Contact Info</label>
                            <input type="text" id="sheepItForm_#index#_phone" name="sheepItForm_phone[#index#]" required="required" class="agency" />
                            <label for="sheepItForm_#index#_release">Consent for Record Release?</label>
                            <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                                <input type="radio" name="sheepItForm_release#index#" value="yes" id="sheepItForm_#index#_release1"   /> <label>Yes</label>
                            </span>&nbsp;&nbsp;
                            <span class="inline" style="font-size: 1.333em;font-weight: 300;">
                                <input type="radio" name="sheepItForm_release#index#" value="no" id="sheepItForm_#index#_release2"  checked="checked"/><label>No</label>
                            </span>
                            <span>&nbsp;<br></span>
                        </div>
                        <!-- /Form template-->
                        <!-- No forms template -->
                        <div id="sheepItForm_noforms_template">No Agencies and Case Managers</div>
                        <!-- /No forms template-->
                    </div>
                    <!-- Controls -->
                    <div id="sheepItForm_controls">
                        <div id="sheepItForm_add"><a class="addnew-button" href="javascript:addNewDr()" style="text-decoration:none">Add Agencies and Case Managers</a></div>
                    </div>
                    <!-- /Controls -->
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
                    <?= form_input($sif, set_value("sif", $sif_num)); ?>
                    <?php
                    if (!empty($wiz_03->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
#echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_03->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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

        var checkboxrel = $("input[name='release1']:checked").val();
        if (checkboxrel == '') {
            $('#describe_release1').val('');
            $('#release_exp1').val('');

        }
        $('#assessment3').submit(function() {
            //form validation for clone
            $('.agency').each(function() {
                if (!$.trim($(this).val()).length) {
//                                    alert('Name Field should not leave empty');
                    return false; // or e.preventDefault();
                }
            });
            //Autosave
            setInterval(function() {
                var queryString = $('#assessment3').serialize();
                var baseurl = '<?php echo base_url(); ?>';
                $.ajax({
                    type: "POST",
                    url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
                });
            }, 10000); // 10 seconds
            //Autosave end
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
                    if (count($wiz_03->name1) > 1) {
                        echo count($wiz_03->name1);
                    } else {
                        echo "1";
                    }
                    ?>
        });

<?php
foreach ($wiz_03->name1 as $key1 => $value1) {
    ?>
            $('#sheepItForm_<?php echo $key1 ?>_name').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($wiz_03->agname1 as $key1 => $value1) {
    ?>
            $('#sheepItForm_<?php echo $key1 ?>_agname').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($wiz_03->cashman1 as $key1 => $value1) {
    ?>
            $('#sheepItForm_<?php echo $key1 ?>_cashman').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($wiz_03->agencyphone1 as $key2 => $value2) {
    ?>
            $('#sheepItForm_<?php echo $key2 ?>_phone').val('<?php echo $value2; ?>');
<?php } ?>
<?php
foreach ($wiz_03->agencyfax1 as $key3 => $value3) {
    ?>
            $('#sheepItForm_<?php echo $key3 ?>_fax').val('<?php echo $value3; ?>');
<?php } ?>
        //Edit action from here
<?php
for ($i = 0; $i < count($wiz_03->name1); $i++) {
    if ($wiz_03->agencyrelease1[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_release1').prop('checked', 'true');
        <?php
    }
    if ($wiz_03->agencyrelease1[$i] == 'no') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_release2').prop('checked', 'true');
        <?php
    }
}

//Declaration array fields
$specialist_array = $lastexam_array = $nextexam_array = $phone_array = $fax_array = $release_array = $releaseexpiration_array = array();
//copy/edit value assign here
$specialist_array = (!empty($wiz_03->sheepItForm1_specialist)) ? $wiz_03->sheepItForm1_specialist : $wiz_03->specialist1;
$type_array = (!empty($wiz_03->sheepItForm1_type)) ? $wiz_03->sheepItForm1_type : $wiz_03->type1;
$lastexam_array = (!empty($wiz_03->sheepItForm1_lastexam)) ? $wiz_03->sheepItForm1_lastexam : $wiz_03->lastexam2;
$nextexam_array = (!empty($wiz_03->sheepItForm1_nextexam)) ? $wiz_03->sheepItForm1_nextexam : $wiz_03->nextexam2;
$phone_array = (!empty($wiz_03->sheepItForm1_phone)) ? $wiz_03->sheepItForm1_phone : $wiz_03->phone2;
$fax_array = (!empty($wiz_03->sheepItForm1_fax)) ? $wiz_03->sheepItForm1_fax : $wiz_03->fax2;
$release_array = (!empty($wiz_03->specialistRelease)) ? $wiz_03->specialistRelease : $wiz_03->release2;
$release_desc = (!empty($wiz_03->sheepItForm1_describe_sheepItForm)) ? $wiz_03->sheepItForm1_describe_sheepItForm : $wiz_03->describe_sheepItForm;
$releaseexpiration_array = (!empty($wiz_03->sheepItForm1_releaseexp)) ? $wiz_03->sheepItForm1_releaseexp : $wiz_03->release_exp2;
?>

//Add more treatments here
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
if (count($specialist_array) > 1) {
    echo count($specialist_array);
} else {
    echo "1";
}
?>,
            afterAdd: function(source, newForm) {

                $('.generate_datepic').each(function(i, e) {
//                    $(e).datepicker("destroy");
//                    $(e).datepicker();
                    $('#hidename52_1').hide();
                    $('#hidename52_2').hide();
                    $('#hidename52_3').hide();
                    $('#hidename52_4').hide();
                    $('#hidename52_5').hide();
                });

            }, afterRemoveCurrent: function(source) {
                $('.generate_datepic').each(function(i, e) {
                    $(e).datepicker("destroy");
                    $(e).datepicker();
                });
            }
        });

<?php
foreach ($specialist_array as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_specialist').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($type_array as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_type').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($releaseexpiration_array as $key4 => $value4) {
    ?>
            $('#sheepItForm1_<?php echo $key4 ?>_releaseexp').val('<?php echo $value4; ?>');
<?php } ?>
<?php
foreach ($lastexam_array as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_lastexam').val('<?php echo $value2; ?>');
<?php } ?>
<?php
foreach ($nextexam_array as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_nextexam').val('<?php echo $value3; ?>');
<?php } ?>
<?php
foreach ($phone_array as $key5 => $value5) {
    ?>
            $('#sheepItForm1_<?php echo $key5 ?>_phone').val('<?php echo $value5; ?>');
<?php } ?>
<?php
foreach ($fax_array as $key6 => $value6) {
    ?>
            $('#sheepItForm1_<?php echo $key6 ?>_fax').val('<?php echo $value6; ?>');
<?php } ?>

<?php
foreach ($release_desc as $key7 => $value7) {
    ?>
            $('#sheepItForm1_<?php echo $key7 ?>_describe_sheepItForm').val('<?php echo $value7; ?>');
<?php } ?>
<?php
for ($i = 0; $i < count($specialist_array); $i++) {
    if ($release_array[$i] == 'yes') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_release1').prop('checked', 'true');
        <?php
    }
    if ($release_array[$i] == 'no') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_release2').prop('checked', 'true');
        <?php
    }
}
?>

    });
</script>