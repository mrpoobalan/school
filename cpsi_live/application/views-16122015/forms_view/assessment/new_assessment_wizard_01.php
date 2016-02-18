<style>
    select{
        width:auto!important;
    }
    .send{

    }
    .agency{

    }
    .agency1{

    }
    .bgplan{
        border-color: red;
        border-style: dotted;
        border-width: 2px;
        margin-left: -6px;
        padding: 10px 2px 0 15px;
    }

</style>
<?php
date_default_timezone_set("Asia/calcutta");
//echo "<pre>";
//print_r($wiz01);
//echo "</pre>";
//exit;
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('id' => 'assessment', 'name' => 'wizard_01', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment", 'name' => "assessment", 'class' => "healthform", 'onsubmit' => "return checkval()");

if (empty($wiz01->sif)):
    $wiz01 = $autosave;
else:

    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $this->session->set_userdata('resubmit_unique_number', $unumber);
        $status = check_form_status_resubmit($wiz01->sif);
    else:
        $unumber = $this->session->userdata('unique_number');
        if (empty($unumber)):
            $unumber = $this->uri->segment(5);
        endif;
        $this->session->set_userdata('resubmit_unique_number', $unumber);
        $status = check_form_status_resubmit($wiz01->sif);
    endif;

    if ($status['wizard_status'] == 25 && $userrole->level == 50):
//        exit('comre');
        //Create session for unique number for an resubmit action
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
if ($wiz01->dob == '01-01-1970' || $wiz01->dob == '1970-01-01') {
    $wiz01->dob = "";
}
if ($wiz01->contactattempt1 == '01-01-1970' || $wiz01->contactattempt1 == '1970-01-01' || $wiz01->contactattempt1 == '1970-01-01,') {
    $wiz01->contactattempt1 = "";
}
?>

<div id="assessment_wizard_1">
    <section class="page">
        <h1><?php echo $subtitle ?></h1>
        <?php echo form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if ((!empty($editaction)) && ($wiz01->wizard_by <> $this->session->userdata('username') || $userrole->level == 50)): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;        ?></div>
        <?php endif; ?>
        <br>
        <fieldset id="identification" name="identification">
            <section>
                <label for="sif">SIF Number</label>
                <input type="text" id="sif" name="sif" value="<?php echo $wiz01->sif; ?>" size="50"  required />
                <?php
                if ($wiz01->sif <> "") {
                    ?>
                    <input type="hidden" name="sifdub" id="sifdub" value="1">
                <?php } ?>
                <div id="body">
                    <!--                                    <a href="javascript:void(0);" style="margin-left: 5px;" id="chk_avail">Check Availability</a>-->
                    <div id="msgbx_err" class="alert-box error"><span>error: </span>SIF is already in the system and to go to "Find a Student"</div>
                    <!--                                    <div id="msgbx_success" class="alert-box success">Sif number available.</div>-->
                    <input type="hidden" name="sifhide" id="sifhide">
                </div>
                <label for="confirmsif">Confirm SIF Number</label>
                <input type="text"  id="confirmsif"  name="confirmsif" required value="<?php echo $wiz01->sif ?>" size="50" />
            </section>
            <section>
                <label for="statenum">State Number</label>
                <input type="text"  id="statenum" required  name="statenum" value="<?php echo $wiz01->statenum ?>" size="50"/>
                <label for="confirmstatenum">Confirm State Number</label>
                <input type="text"  id="confirmstatenum" required name="confirmstatenum" value="<?php echo $wiz01->statenum ?>"/>
            </section>
            <section>
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" required value="<?php echo $wiz01->fname ?>"/>
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" required value="<?php echo $wiz01->lname ?>" />
            </section>
        </fieldset>

        <fieldset>
            <section>
                <label for="nickname">Nickname</label>
                <input type="text" id="nickname" name="nickname"  value="<?php echo $wiz01->nickname ?>"/>
            </section>
            <section>
                <label for="dob">Date of Birth</label>
                <input type="text" id="dob" name="dob" required value="<?php echo $wiz01->dob ?>"/>
            </section>

            <section>
                <label for="school-level">School Type</label>
                <select name="schoolID" id="schoolID" required onchange="getSchools(this)">
                    <option value="">Select DB Type</option>
                    <?php foreach ($schooltype_array->result_array() as $row) : ?>
                        <option value="<?php echo $row['ID']; ?>" <?php echo set_select("DisplayName", "{$row['ID']}", (!empty($wiz01->schoolID) && $wiz01->schoolID == "{$row['ID']}" ? TRUE : FALSE)); ?>><?php echo $row['DisplayName']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!--  some work needed for pre-loading this field and persisting the data -->
                <label for="school">School</label>
                <select name="school"  id="school">
                    <option value="">Select</option>
                </select>
            </section>
            <input type="hidden" name="schoolname_changed" id="schoolname_changed" value="1"/>
            <input type="hidden" name="schoolname" id="schoolname" value="<?php echo ($wiz01->school <> "") ? $wiz01->school : ''; ?>">
        </fieldset>
        <fieldset id="parent">
            <section class="nobottommargin">
                <label>Parent(s)/Guardian(s)</label>
                <input type="text" id="parentname" required name="parentname" value="<?php echo $wiz01->parentname ?>"/>
            </section>

        </fieldset>
        <fieldset id="address">
            <section>
                <label>Cell Phone Number</label>
                <input type="text" id="cellphone" required name="cellphone" value="<?php echo $wiz01->cellphone ?>"/>
                <label>Street Address</label>
                <input type="text" id="street" required name="street" value="<?php echo $wiz01->street ?>" />
            </section>
            <section>
                <label>Home Phone Number</label>
                <input type="text" id="homephone" required  name="homephone" value="<?php echo $wiz01->homephone ?>"/>
                <label>City</label>
                <input type="text" id="city" required name="city" value="<?php echo $wiz01->city ?>"/>
            </section>
            <section>
                <label>Work Phone Number</label>
                <input type="text" id="workphone" required name="workphone" value="<?php echo $wiz01->workphone ?>"/>
                <label>Zip Code</label>
                <input type="text" id="zip" required name="zip" value="<?php echo $wiz01->zip ?>"/>
            </section>
        </fieldset>
        <!--- Add Additional Contact------>
        <fieldset class="new-section">
            <div id="sheepItForm1">
                <div id="sheepItForm1_template" style="border-bottom: dashed #444 0px;">
                    <fieldset id="addtnl-contact">
                        <section>
                            <label for="sheepItForm1_#index#_addtn">Additional Contact
                                <a id="sheepItForm1_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a>
                            </label>
                            <input type="text" id="sheepItForm1_#index#_addtnlcontact" name="sheepItForm1_addtnlcontact[#index#]"/>
                        </section>
                        <section>
                            <label for="frequency1">Relationship?</label>
                            <input type="text" id="sheepItForm1_#index#_relationship" name="sheepItForm1_relationship[#index#]" />
                        </section>
                    </fieldset>
                    <fieldset id="addtnl-info">
                        <section>
                            <label for="person1">Cell Phone Number</label>
                            <input type="text" id="sheepItForm1_#index#_addtnlcellphone" name="sheepItForm1_addtnlcellphone[#index#]"  class="agencyname"   />
                        </section>
                        <section>
                            <label for="person1">Home Phone Number</label>
                            <input type="text" id="sheepItForm1_#index#_addtnlhomephone" name="sheepItForm1_addtnlhomephone[#index#]" class="agencyname" />
                        </section>
                        <section>
                            <label for="person1">Work Phone Number</label>
                            <input type="text" id="sheepItForm1_#index#_addtnlworkphone" name="sheepItForm1_addtnlworkphone[#index#]" class="agencyname" />
                        </section>
                    </fieldset>
                </div>
                <!-- No forms template -->
                <div id="sheepItForm1_noforms_template">No Additional Contact</div>
                <!-- /No forms template-->
            </div>
            <!--- Add more Treatments button here----->
            <!-- Controls -->
            <div id="sheepItForm1_controls">
                <div id="sheepItForm1_add" style="margin-left: -40px;"><a class="addnew-button" href="javascript:addNewContact()" style="text-decoration:none">Add Additional Contact</a></div>
            </div>
            <!-- /Controls -->
        </fieldset>



        <fieldset id="ins-hospital">
            <section>
                <label>Insurance:</label>
                <div class="col-one">
                    <span><input type="checkbox" name="private" value="yes" id="private" <?php echo!empty($wiz01->private) || in_array('private', $wiz01->ins) ? ' checked ' : '' ?> /> <label for="private"><span></span>Private</label></span>
                    <span><input type="checkbox" name="mchp" value="yes" id="mchp" <?php echo!empty($wiz01->mchp) || in_array('MCHP', $wiz01->ins) ? ' checked ' : '' ?> /> <label for="mchp"><span></span>MCHP</label></span>
                    <span><input type="checkbox" name="other" value="yes" id="other" <?php echo!empty($wiz01->other) || in_array('Other', $wiz01->ins) ? ' checked ' : '' ?> /> <label for="other"><span></span>Other:</label></span>
                </div>
                <div class="col-two">
                    <span><input type="checkbox" name="medicaid" value="yes" id="medicaid" <?php echo!empty($wiz01->medicaid) || in_array('Medicaid', $wiz01->ins) ? ' checked ' : '' ?> /> <label for="medicaid"><span></span>Medicaid</span>
                    <span><input type="checkbox" name="none" value="yes" id="none" <?php echo!empty($wiz01->none) || in_array('None', $wiz01->ins) ? ' checked ' : '' ?> /><label for="none"><span></span>None</span>
                </div>
                <br />
                <input type="text" id = "none_text" name = "none_text" value="<?php echo $wiz01->none_text ?>" class="show" />
            </section>
            <section>
                <label>Preferred Hospital</label>
                <input id = "preferred_hospital" required  name ="preferred_hospital" type="text" value="<?php echo $wiz01->preferred_hospital ?>"  />
                <div id="checkbg">
                    <label>Is there a DNR Order?</label>
                    <span class="inline"><input type="radio" name="dnrorder" value="yes" onclick="showvalue350(this.value)" id="dnrorder" <?php echo!empty($wiz01->dnrorder) ? ' checked ' : '' ?>   /> <label for="i-yes"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="dnrorder" value="" onclick="showvalue350(this.value)" id="dnrorder" <?php echo empty($wiz01->dnrorder) ? ' checked ' : '' ?> /> <label for="i-no"><span></span>No</label></span>
                </div>
                <br>
                <div id="hidename350" >
                    <label>The School team has developed a plan</label>
                    <span class="inline"><input type="radio" name="schoolplan" value="yes" id="schoolplan" <?php echo!empty($wiz01->schoolplan) ? ' checked ' : '' ?>   /> <label for="i-yes"><span></span>Yes</label></span>
                    <span class="inline"><input type="radio" name="schoolplan" value="" id="schoolplan" <?php echo empty($wiz01->schoolplan) ? ' checked ' : '' ?> /> <label for="i-no"><span></span>No</label></span>
                </div>
            </section>
            <section>
                <label>Immunization Current?</label>
                <span class="inline"><input type="radio" name="immunization" value="yes" onclick="hideSection(this)" id="immunization" <?php echo!empty($wiz01->immunization) ? ' checked ' : '' ?>   /> <label for="i-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="immunization" value="" onclick="hideSection(this)" id="immunization" <?php echo empty($wiz01->immunization) ? ' checked ' : '' ?> /> <label for="i-no"><span></span>No</label></span>

                <label>Immunocompromised?</label>
                <span class="inline"><input type="radio" name="immunocompromised" value="yes" onclick="hideSection(this)" id="immunocompromised" <?php echo!empty($wiz01->immunocompromised) ? ' checked ' : '' ?>   /> <label for="i-yess"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="immunocompromised" value="" onclick="hideSection(this)" id="immunocompromised" <?php echo empty($wiz01->immunocompromised) ? ' checked ' : '' ?> /> <label for="i-noo"><span></span>No</label></span>

                <label>Choose Exemption Type</label>
                <span><input type="checkbox" name="religious" value="yes" id="religious" <?php echo!empty($wiz01->religious) || in_array('Religious', $wiz01->exempt) ? ' checked ' : '' ?>  /> <label for="religious"><span></span>Religious Exemption</label></span>
                <span><input type="checkbox" name="medical" value="yes" id="medical"  <?php echo!empty($wiz01->medical) || in_array('Medical', $wiz01->exempt) ? ' checked ' : '' ?> /> <label for="medical"><span></span>Medical Exemption</label></span>
                <br />
                <input type="text" class="show" id="medical_reason" name="medical_reason" value="<?php echo $wiz01->medical_reason ?>" />

            </section>
        </fieldset>

        <br>
        <fieldset id="contact">
            <section class="buttons1">
                <?php $contact_array = explode(',', $wiz01->contactattempt1); ?>
                <section class="">
                    <div id="sheepItForm" style="float:left;">
                        <div id="sheepItForm_template">
                            <label for="sheepItForm_#index#_contact">Contact Attempt <text id="sheepItForm_label"></text></label>
                            <input id="sheepItForm_#index#_contact" name="contactattempt[]" type="text" class="generate_datepic"/>
                            <a id="sheepItForm_remove_current">
                                <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                            </a>
                        </div>
                        <!-- No forms template -->
                        <div id="sheepItForm_noforms_template">No Contacts</div>
                    </div>
                    <div id="sheepItForm_add" style="margin-top:20px; float:left;"><span><a>Add Attempts</a></span></div>

                </section>
        </fieldset>
        <fieldset>
            <section class="buttons" >
                <div class="nextbutton">
                    <?= $link_back; ?>
                    <?php echo form_submit($attr_FormSubmit_assessment); ?>

                </div>

                <div class="savebuttons float-left">
                    <?php
//click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz01->sif . "/" . $wiz01->unique_number, "<button type='button' class='previous'>Go to final page</button>");
                    endif;
//Resubmit Button
                    if (!empty($wiz01->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
// echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>

                    <?php echo form_submit($attr_FormSave_assessment); ?>
                    <?php echo form_close(); ?>
                </div>

            </section>
        </fieldset>
</div>
<?php
$contact_array = array();
$contact_array = explode(',', $wiz01->contactattempt1);
$contact_array = array_filter($contact_array);
?>
<script type="text/javascript">
    $(document).ready(function() {


        //Background color is displayed if radio yes is selected
        $("input:radio[name=dnrorder]").change(function() {
            var value = $('input:radio[name=dnrorder]:checked').val();
            if (value == "") {
                $('#checkbg').removeClass('bgplan');
            }
            else {
                $('#checkbg').addClass('bgplan');
            }
        });


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
$count = count($contact_array);
if ($count > 1) {
    echo $count;
} else {
    echo "1";
}
?>, afterAdd: function(source, newForm) {

                $('.generate_datepic').each(function(i, e) {

                    $(e).datepicker("destroy");
                    $(e).datepicker();
                });
            }, afterRemoveCurrent: function(source) {
                $('.generate_datepic').each(function(i, e) {
                    $(e).datepicker("destroy");
                    $(e).datepicker();
                });
            }

        });
<?php
if (!empty($contact_array)):

    foreach ($contact_array as $key => $val) {
        if ($val <> '1970-01-01') {
            ?>
                    $('#sheepItForm_<?php echo $key; ?>_contact').val('<?php echo $val; ?>');
            <?php
        }
    } endif;
?>
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        //Clone form validation
        $('#assessment').submit(function() {
            //form validation for clone
            $('.agency').each(function() {
                if (!$.trim($(this).val()).length) {
                    return false; // or e.preventDefault();
                }
            });
        });
        //Autosave
        setInterval(function() {
            var queryString = $('#assessment').serialize();
            //alert(queryString);
            var baseurl = '<?php echo base_url(); ?>';
            //alert(baseurl);
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end

        // Add Additional contact

// Add more Additional contact here
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
if (count($wiz01->addtnlcontact) > 1) {
    echo count($wiz01->addtnlcontact);
} else {
    echo "1";
}
?>
        });
<?php
foreach ($wiz01->addtnlcontact as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_addtnlcontact').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($wiz01->relationship as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_relationship').val('<?php echo $value2; ?>');
<?php } ?>


<?php
foreach ($wiz01->addtnlcellphone as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_addtnlcellphone').val('<?php echo $value3; ?>');
<?php } ?>
<?php
foreach ($wiz01->addtnlhomephone as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_addtnlhomephone').val('<?php echo $value3; ?>');
<?php } ?>
<?php
foreach ($wiz01->addtnlworkphone as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_addtnlworkphone').val('<?php echo $value3; ?>');
<?php } ?>



    });
</script>
