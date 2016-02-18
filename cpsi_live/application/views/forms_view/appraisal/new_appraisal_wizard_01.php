<style>
    select{
        width:auto!important;
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
// load dashboard admin menu
$this->load->view("menu/top_menu");

if (empty($wiz01->sif)):
    $wiz01 = $autosave;
endif;
$attr_FormSubmit_appraisal = array('class' => 'nextbutton', 'id' => 'appraisal', 'name' => 'appraisal', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_appraisal = array('id' => 'appraisal', 'name' => 'appraisal_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "appraisal", 'class' => "healthform", 'onsubmit' => "return checkval()");

$sif = array('name' => 'sif', 'id' => 'sif', 'required' => 'required', 'value' => $wiz01->sif);
$confirmsif = array('name' => 'confirmsif', 'id' => 'confirmsif', 'required' => 'required', 'value' => $wiz01->sif);
$statenum = array('name' => 'statenum', 'id' => 'statenum', 'required' => 'required', 'value' => $wiz01->statenum);
$statenum_cnfrm = array('name' => 'confirmstatenum', 'id' => 'confirmstatenum', 'required' => 'required', 'value' => $wiz01->statenum);
$firstname = array('name' => 'fname', 'id' => 'fname', 'required' => 'required', 'value' => $wiz01->fname);
$lastname = array('name' => 'lname', 'id' => 'lname', 'required' => 'required', 'value' => $wiz01->lname);
$nickname = array('name' => 'nickname', 'id' => 'nickname', 'value' => $wiz01->nickname);
//$dob   = array('name' => 'dob', 'id'=>'dob', 'required' => 'required', 'value'=>$wiz01->dob);
$parentname = array('name' => 'parentname', 'required' => 'required', 'id' => 'parentname', 'value' => $wiz01->parentname);
$cellphone = array('name' => 'cellphone', 'required' => 'required', 'id' => 'cellphone', 'value' => $wiz01->cellphone);
$street = array('name' => 'street', 'required' => 'required', 'id' => 'street', 'value' => $wiz01->street);
$homephone = array('name' => 'homephone', 'id' => 'homephone', 'required' => 'required', 'value' => $wiz01->homephone);
$city = array('name' => 'city', 'id' => 'city', 'required' => 'required', 'value' => $wiz01->city);
$workphone = array('name' => 'workphone', 'id' => 'workphone', 'required' => 'required', 'value' => $wiz01->workphone);
$zip = array('name' => 'zip', 'id' => 'zip', 'required' => 'required', 'value' => $wiz01->zip);
$addtnlcontact = array('name' => 'addtnlcontact', 'id' => 'addtnlcontact', 'required' => 'required', 'value' => $wiz01->addtnlcontact);
$addtnlcellphone = array('name' => 'addtnlcellphone', 'id' => 'addtnlcellphone', 'required' => 'required', 'value' => $wiz01->addtnlcellphone);
$addtnlhomephone = array('name' => 'addtnlhomephone', 'id' => 'addtnlhomephone', 'required' => 'required', 'value' => $wiz01->addtnlhomephone);
$addtnlworkphone = array('name' => 'addtnlworkphone', 'id' => 'addtnlworkphone', 'required' => 'required', 'value' => $wiz01->addtnlworkphone);
//$none_text   = array('name' => 'none_text', 'id'=>'none_text', 'value'=>$wiz01->none_text);
$preferred_hospital = array('name' => 'preferred_hospital', 'id' => 'preferred_hospital', 'required' => 'required', 'value' => $wiz01->preferred_hospital);
$medical_reason = array('name' => 'medical_reason', 'id' => 'medical_reason', 'value' => $wiz01->medical_reason);
$contactattempt1 = array('name' => 'contactattempt1', 'id' => 'contactattempt1', 'required' => 'required', 'value' => $wiz01->contactattempt1);

$schoolID = array('name' => 'schoolID', 'id' => 'schoolID', 'required' => 'required', 'value' => $wiz01->schoolID);
//print_r($wiz01->schoolID);
// setup values for all checkboxes
if ($wiz01) {
    $checkboxFields = array('immunized', 'exempt', 'ins');

    foreach ($checkboxFields as $field) {
        if (property_exists($wiz01, $field) && is_array($wiz01->{$field})) {
            foreach ($wiz01->{$field} as $key => $selectedValue) {
                $selectedValue = strtolower($selectedValue);
                $wiz01->$selectedValue = $selectedValue;
            }
        }
    }
}

//echo $wiz01->contactattempt1;
//echo $wiz01->dob . 'here';

if ($wiz01->dob == '01-01-1970' || $wiz01->dob == '1970-01-01') {
    $wiz01->dob = "";
}
if ($wiz01->contactattempt1 == '01-01-1970' || $wiz01->contactattempt1 == '1970-01-01' || $wiz01->contactattempt1 == '1970-01-01,') {
    $wiz01->contactattempt1 = "";
}
//print_r($wiz01->contactattempt1);
//echo '<pre>';
//print_r($wiz01);
//echo '</pre>';
//exit;
//echo $this->session->userdata('unique_number');

$uniquenumber = $this->uri->segment(4);
if (is_numeric($uniquenumber)):
    $this->session->set_userdata('sifunique_number', $uniquenumber);
endif;
?>
<section class="page">
    <h1><?= $subtitle ?></h1>
    <?= validation_errors(); ?>
    <h2><?php
        if (!empty($form_status)) {
            echo $form_status;
        }
        ?></h2>
    <?= form_open("{$action}", $attr_FormOpen); ?>


    <fieldset id="identification">
        <section>
            <label>SIF Number</label>
            <?= form_input($sif, set_value("sif"), "class='textbox'"); ?>
            <input type="hidden" name="sifhide" id="sifhide">
            <div id="body">
                <!--                                    <a href="javascript:void(0);" style="margin-left: 5px;" id="chk_avail">Check Availability</a>-->
                <div id="msgbx_err" class="alert-box error"><span>error: </span>SIF is already in the system and to go to "Find a Student"</div>
                <!--                                    <div id="msgbx_success" class="alert-box success">Sif number available.</div>-->
            </div>
            <label>Confirm SIF Number</label>
            <?= form_input($confirmsif, set_value("confirmsif"), "class='textbox'"); ?>
        </section>
        <section>
            <label>State Number</label>
            <?= form_input($statenum, set_value("sif"), "class='textbox'"); ?>
            <label>Confirm State Number</label>
            <?= form_input($statenum_cnfrm, set_value("sif"), "class='textbox'"); ?>
        </section>
        <section>
            <label>First Name</label>
            <?= form_input($firstname, set_value("fname"), "class='textbox'"); ?>
            <label>Last Name</label>
            <?= form_input($lastname, set_value("lname"), "class='textbox'"); ?>
        </section>
    </fieldset>
    <fieldset id="contact">

<!-- <section>
            <label>Not Applicable</label>
            <span><input type="checkbox" name="is_applicable" value="1" id="is_applicable" checked="checked" />
                <label for="is_applicable"><span></span></label></span>
        </section>-->
    </fieldset>
    <fieldset>
        <section>
            <label for="nickname">Nickname</label>
            <?= form_input($nickname, set_value("nickname"), "class='textbox'"); ?>
        </section>
        <section>
            <label for="dob">Date of Birth</label>
            <?php
            if (strtotime($wiz01->dob) == "") {
                $dob_date = str_replace("-", "/", "$wiz01->dob");
            } else {
                $dob_date = date('m/d/Y', strtotime($wiz01->dob));
            }
            ?>
            <input readonly type="text"  id="dob" name="dob" class="textbox" value="<?php echo isset($wiz01->dob) ? $dob_date : ''; ?>">
        </section>
        <section>
            <label for="school-level">School Type</label>
            <select name="schoolID" id="schoolID" onchange="getSchools(this)" required="required" class='textbox'>
                <option value="">Select DB Type</option>
                <?php foreach ($schooltype_array->result_array() as $row) : ?>
                    <option value="<?= $row['ID']; ?>" <?= set_select("DisplayName", "{$row['ID']}", (!empty($wiz01->schoolID) && $wiz01->schoolID == "{$row['ID']}" ? TRUE : FALSE)); ?>><?= $row['DisplayName']; ?></option>
                <?php endforeach; ?>
            </select>

            <!--  some work needed for pre-loading this field and persisting the data -->
            <label for="school">School</label>
            <select name="school"  id="school" class='textbox'>
                <option value="">Select</option>
            </select>
        </section>
        <input type="hidden" name="schoolname_changed" id="schoolname_changed" value="1"/>
        <input type="hidden" name="schoolname" id="schoolname" value="<?php echo (!empty($wiz01->school)) ? $wiz01->school : ''; ?>">
    </fieldset>
    <fieldset id="parent">
        <section class="nobottommargin">
            <label>Parent(s)/Guardian(s)</label>
            <input type="text" name="parentname" required="required"  class="textbox" id="parentname" value="<?= $wiz01->parentname ?>"/>
        </section>
    </fieldset>
    <fieldset id="address">
        <section>
            <label>Cell Phone Number</label>
            <input type="text" name="cellphone" id="cellphone" required="required"  class="textbox" value="<?= $wiz01->cellphone ?>"/>
            <label>Street Address</label>
            <input type="text" name="street" id="street" required="required" value="<?= $wiz01->street ?>" class='textbox' />
        </section>
        <section>
            <label>Home Phone Number</label>
            <input type="text" name="homephone" id="homephone" required="required" value="<?= $wiz01->homephone ?>" class='textbox' />
            <label>City</label>
            <input type="text" name="city" id="city" required="required" value="<?= $wiz01->city ?>" class='textbox' />
        </section>
        <section>
            <label>Work Phone Number</label>
            <input type="text" name="workphone" id="workphone" required="required" value="<?= $wiz01->workphone ?>" class='textbox' />
            <label>Zip Code</label>
            <input type="text" name="zip" id="zip" required="required" value="<?= $wiz01->zip ?>" class='textbox' />
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
                        <input type="text" id="sheepItForm1_#index#_addtnlcontact" name="sheepItForm1_addtnlcontact[#index#]" />
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
                <span><input type="checkbox" class='textbox' name="ins[]" value="private" id="private" <?= !empty($wiz01->private) ? ' checked ' : '' ?>/> <label for="private"><span></span>Private</label></span>
                <span><input type="checkbox" class='textbox' name="ins[]" value="MCHP" id="mchp" <?= !empty($wiz01->mchp) ? ' checked ' : '' ?>/> <label for="mchp"><span></span>MCHP</label></span>
                <span><input type="checkbox" class='textbox' name="ins[]" value="Other" id="other" <?= !empty($wiz01->other) ? ' checked ' : '' ?> /> <label for="other"><span></span>Other:</label></span>
            </div>
            <div class="col-two">
                <span><input type="checkbox" class='textbox' name="ins[]" value="Medicaid" id="medicaid" <?= !empty($wiz01->medicaid) ? ' checked ' : '' ?>/> <label for="medicaid"><span></span>Medicaid</label></span>
                <span><input type="checkbox" class='textbox' name="ins[]" value="None" id="none" <?= !empty($wiz01->none) ? ' checked ' : '' ?> /> <label for="none"><span></span>None</label></span>
            </div>
            <br />
            <?php !empty($wiz01->none_text) ? $wiz01->other_insure = $wiz01->none_text : '' ?>
            <input type="text" name="other_insure" placeholder="Enter other type of insurance" class="show" value="<?= $wiz01->other_insure ?>"/>
        </section>
        <section>
            <label>Preferred Hospital</label>
            <input type="text" name="preferred_hospital" class='textbox' required="required" id="preferred_hospital" value= "<?= $wiz01->preferred_hospital ?>" />
            <div id="checkbg">
                <label>Is there a DNR Order?</label>
                <span class="inline"><input type="radio"  name="dnrorder" value="yes" id="i-yes" onclick="showvalue350(this.value)"  <?php echo!empty($wiz01->dnrorder) ? ' checked ' : '' ?> /> <label for="i-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio"  name="dnrorder" value="" id="i-no" onclick="showvalue350(this.value)"   <?= empty($wiz01->dnrorder) ? ' checked ' : '' ?>/> <label for="i-no"><span></span>No</label></span>
            </div><br>
            <div id="hidename350" >
                <label>The School team has developed a plan</label>
                <span class="inline"><input type="radio" name="schoolplan" value="yes" id="schoolplan" <?php echo!empty($wiz01->schoolplan) ? ' checked ' : '' ?>   /> <label for="i-yes"><span></span>Yes</label></span>
                <span class="inline"><input type="radio" name="schoolplan" value="" id="schoolplan" <?php echo $wiz01->schoolplan == '' ? ' checked ' : '' ?> /> <label for="i-no"><span></span>No</label></span>
            </div>
        </section>
        <section>
            <label>Immunization Current?</label>
            <span class="inline"><input type="radio"  name="immunized" value="immunizeyes" id="i-yes" <?= 'checked'; ?>/> <label for="i-yes"><span></span>Yes</label></span>
            <span class="inline"><input type="radio"  name="immunized" value="" id="i-no"  <?= 'checked'; ?>  <?= !empty($wiz01->immunized) ? ' checked ' : '' ?>/> <label for="i-no"><span></span>No</label></span>


            <label>Immunocompromised?</label>
            <span class="inline"><input type="radio" name="immunocompromised" value="yes" onclick="hideSection(this)" id="immunocompromised" <?php echo 'checked'; ?>   /> <label for="i-yess"><span></span>Yes</label></span>
            <span class="inline"><input type="radio" name="immunocompromised" value="" onclick="hideSection(this)" id="immunocompromised" <?php echo empty($wiz01->immunocompromised) ? ' checked ' : '' ?> /> <label for="i-noo"><span></span>No</label></span>

            <label>Choose Exemption Type</label>
            <span><input type="checkbox" name="exempt[]" class='textbox' value="Religious" id="religious" <?= !empty($wiz01->religious) ? ' checked ' : '' ?>/> <label for="religious"><span></span>Religious Exemption</label></span>
            <span><input type="checkbox" name="exempt[]" class='textbox' value="Medical" id="medical" <?= !empty($wiz01->medical) ? ' checked ' : '' ?> /> <label for="medical"><span></span>Medical Exemption</label></span>

            <br />
            <input type="text" id="medical_reason"  class='textbox' name="medical_reason"  value = "<?= $wiz01->medical_reason ?>" class="textbox" />
        </section>
    </fieldset>
    <fieldset id="contact">
        <section>
            <?php
            $contact_array = array();
            $contact_array = explode(',', $wiz01->contactattempt1);
            $contact_array = array_filter($contact_array);
            ?>
            <div id="sheepItForm" style="float:left">
                <div id="sheepItForm_template">
                    <label for="sheepItForm_#index#_contact">Contact Attempt <text id="sheepItForm_label"></text></label>
                    <input id="sheepItForm_#index#_contact" name="contactattempt1[]" type="text" class="generate_datepic" readonly/>
                    <a id="sheepItForm_remove_current">
                        <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                    </a>
                </div>
                <!-- No forms template -->
                <div id="sheepItForm_noforms_template">No Contacts</div>
            </div>
            <div id="sheepItForm_add" style="float:left; margin-top:20px;"><span><a>Add Attempts</a></span></div>
        </section>

    </fieldset>


    <section class="buttons">
        <div class="nextbutton">
            <?= $link_back; ?>
            <?php echo form_submit($attr_FormSubmit_appraisal); ?>

        </div>

        <div class="savebuttons float-left">
            <?php
//click to final page
            $reviewvalue = $this->session->userdata('reviewappraisal');
            $wiz01->unique_number = $this->session->userdata('sifunique_number');
            if (!empty($reviewvalue)):
                echo anchor("health_appraisal/appraisal/complete_appraisal/" . $wiz01->sif . "/" . $wiz01->unique_number, "<button type='button' class='previous'>Go to final page</button>");
            endif;
            ?>
            <? #= form_submit($attr_FormSubmit_appraisal); ?>
            <?= form_submit($attr_FormSave_appraisal); ?>
        </div>
        <div class="clear"></div>
    </section>

    <?= form_close(); ?>
</section>
<script>
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

        $('#is_applicable').on('change', function() {
            var checked = $(this).prop('checked');
            $('.textbox').prop('disabled', checked);
        });
        $("#is_applicable").trigger("change");
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
            var queryString = $('#appraisal').serialize();
            //alert(queryString);
            var baseurl = '<?php echo base_url(); ?>';
            //alert(baseurl);
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end

        //form validation
        $('#appraisal').validate({
            rules: {
                addtnlcellphone: {
                    required: {
                        depends: function(element) {
                            return ($("#addtnlhomephone").val() == '' && $("#addtnlworkphone").val() == '');

                        }
                    }
                },
                addtnlhomephone: {
                    required: {
                        depends: function(element) {
                            return ($("#addtnlcellphone").val() == '' && $("#addtnlworkphone").val() == '');
                        }
                    }
                },
                addtnlworkphone: {
                    required: {
                        depends: function(element) {
                            return ($("#addtnlhomephone").val() == '' && $("#addtnlcellphone").val() == '');

                        }
                    }
                }


            }
        });

    });
</script>
<script>
//    $(document).ready(function() {
////       $( "#appraisal" ).submit(function() {
////           if($('#is_applicable').is(":checked")){
////             alert("Please uncheck the checkbox before the submit");
////             return false;
////           }
////       })
//        $('#is_applicable').on('change', function() {
//            var checked = $(this).prop('checked');
//            $('.textbox').prop('disabled', checked);
//             $('#sif').removeAttr('disabled');
//             $("#confirmsif").removeAttr('disabled');
//             $("#statenum").removeAttr('disabled');
//             $("#confirmstatenum").removeAttr('disabled');
//             $("#fname").removeAttr('disabled');
//             $("#lname").removeAttr('disabled');
//        });
//        $("#is_applicable").trigger("change");
//    });</script>
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
                    $('#sheepItForm_<?php echo $key; ?>_contact').val('<?php echo date('m-d-Y', strtotime($val)); ?>');
            <?php
        }
    } endif;
?>

<?php
//copy/edit value assign here
$wiz01->sheepItForm1_addtnlcontact = (!empty($wiz01->sheepItForm1_addtnlcontact)) ? $wiz01->sheepItForm1_addtnlcontact : $wiz01->addtnlcontact;
$wiz01->sheepItForm1_relationship = (!empty($wiz01->sheepItForm1_relationship)) ? $wiz01->sheepItForm1_relationship : $wiz01->relationship;
$wiz01->sheepItForm1_addtnlcellphone = (!empty($wiz01->sheepItForm1_addtnlcellphone)) ? $wiz01->sheepItForm1_addtnlcellphone : $wiz01->addtnlcellphone;
$wiz01->sheepItForm1_addtnlhomephone = (!empty($wiz01->sheepItForm1_addtnlhomephone)) ? $wiz01->sheepItForm1_addtnlhomephone : $wiz01->addtnlhomephone;
$wiz01->sheepItForm1_addtnlworkphone = (!empty($wiz01->sheepItForm1_addtnlworkphone)) ? $wiz01->sheepItForm1_addtnlworkphone : $wiz01->addtnlworkphone;
?>

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
if (count($wiz01->sheepItForm1_addtnlcontact) > 1) {
    echo count($wiz01->sheepItForm1_addtnlcontact);
} else {
    echo "1";
}
?>
        });
<?php
foreach ($wiz01->sheepItForm1_addtnlcontact as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_addtnlcontact').val('<?php echo $value1; ?>');
<?php } ?>
<?php
foreach ($wiz01->sheepItForm1_relationship as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_relationship').val('<?php echo $value2; ?>');
<?php } ?>


<?php
foreach ($wiz01->sheepItForm1_addtnlcellphone as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_addtnlcellphone').val('<?php echo $value3; ?>');
<?php } ?>
<?php
foreach ($wiz01->sheepItForm1_addtnlhomephone as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_addtnlhomephone').val('<?php echo $value3; ?>');
<?php } ?>
<?php
foreach ($wiz01->sheepItForm1_addtnlworkphone as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_addtnlworkphone').val('<?php echo $value3; ?>');
<?php } ?>



    });


</script>
