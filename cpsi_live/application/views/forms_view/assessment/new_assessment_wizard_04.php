<style>
    select{
        width:auto!important;
    }
    .agency{
    }
    .errorchk0,.errorchk1,.errorchk2,.errorchk3,.errorchk4,.errorchk5,.errorchk6,.errorchk7,.errorchk8,.errorchk9{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment4', 'name' => 'assessment4', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment4', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment4", 'class' => "healthform");

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
if (empty($wiz_04->sif)):
    $wiz_04 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_04->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_04->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
//echo "<pre>";
//print_r($wiz_04);
//echo "</pre>";
//exit;
?>
<div id="assessment_wizard_4">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>

        <?php if (!empty($editaction) && $wiz_04->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;         ?></div>
        <?php endif; ?>
        <fieldset class="new-section">

            <legend>Daily Medications</legend>
            <span class="inline hide"><input type="checkbox" onclick="hideSection(3)" id="hide3"  name="hide3" value = "on" <?php echo!empty($wiz_04->hide3) ? ' checked ' : '' ?> /> <label for="hide3"><span></span>No needs at this time</label></span>
            <div class="hide3">
                <section>
                    <div id="sheepItForm">
                        <!-- Form template-->
                        <div id="sheepItForm_template" style="border-bottom: dashed #444 0px;">
                            <label><text id="sheepItForm_template"></text><a id="sheepItForm_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a></label>
                            <label for="sheepItForm_#index#_med">Medication Name</label>
                            <input type="text" id="sheepItForm_#index#_med" name="sheepItForm_med[#index#]" class="agency"  required="required" />
                            <label for="sheepItForm_#index#_dos">Dosage</label>
                            <input type="text" id="sheepItForm_#index#_dos" name="sheepItForm_dos[#index#]" class="agency"   required="required" />
                            <label for="sheepItForm_#index#_time">Time/Frequency</label>
                            <input type="text" id="sheepItForm_#index#_time" name="sheepItForm_time[#index#]" class="agency"   required="required"/>
                            <label for="sheepItForm_#index#_route">Route</label>
                            <input type="text" id="sheepItForm_#index#_route" name="sheepItForm_route[#index#]" class="agency"   required="required" />
                            <label for="sheepItForm_taken#index#">Taken:</label>
                            <span class="inline"><input type="checkbox" name="sheepItForm_school#index#" value="school" id="sheepItForm_#index#_school"  /> <label for="sheepItForm_#index#_school"  ><span></span>At School</label></span>
                            <span class="inline"><input type="checkbox" name="sheepItForm_home#index#" value="home" id="sheepItForm_#index#_home" /> <label for="sheepItForm_#index#_home"><span></span>At Home</label></span>
                            <div id="chkerror#index#"></div>
                        </div>
                        <!-- /Form template-->
                        <!-- No forms template -->
                        <div id="sheepItForm_noforms_template">No Medications</div>
                        <!-- /No forms template-->
                    </div>
                </section>
                <section class="buttons">
                    <p><div id="sheepItForm_add"><a class="addnew-button" href="javascript:addNewMed()">Add New Daily Medication</a></div></p>
                </section>
            </div>
        </fieldset>
        <fieldset class="new-section">
            <legend>PRN Medications</legend>
            <span class="inline hide"><input type="checkbox" onclick="hideSection(4)" id="hide4" name="hide4" value = "on"  <?php echo!empty($wiz_04->hide4) ? ' checked ' : '' ?> /> <label for="hide4"><span></span>No needs at this time</label></span>
            <div class="hide4">
                <section>
                    <div id="sheepItForm1">
                        <!-- Form template-->
                        <div id="sheepItForm1_template" style="border-bottom: dashed #444 0px;">
                            <label>PRN Medications<text id="sheepItForm_template"></text><a id="sheepItForm1_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a></label>
                            <label for="sheepItForm1_#index#_prnmed">Medication Name</label>
                            <input type="text" id="sheepItForm1_#index#_prnmed" name="sheepItForm1_prnmed[#index#]" class="agency"  required="required"  />
                            <label for="sheepItForm1_#index#_prndos">Dosage</label>
                            <input type="text" id="sheepItForm1_#index#_prndos" name="sheepItForm1_prndos[#index#]" class="agency"   required="required"  />
                            <label for="sheepItForm1_#index#_time">Time/Frequency</label>
                            <input type="text" id="sheepItForm1_#index#_prntime" name="sheepItForm1_prntime[#index#]"  class="agency"   required="required"  />
                            <label for="sheepItForm1_#index#_prnroute">Route</label>
                            <input type="text" id="sheepItForm1_#index#_prnroute" name="sheepItForm1_prnroute[#index#]" class="agency"   required="required"  />
                            <label for="sheepItForm1_taken#index#">Taken:</label>
                            <span class="inline"><input type="checkbox" name="sheepItForm1_prnschool#index#" value="school" id="sheepItForm1_#index#_prnschool"  /> <label for="sheepItForm1_#index#_prnschool"  ><span></span>At School</label></span>
                            <span class="inline"><input type="checkbox" name="sheepItForm1_prnhome#index#" value="home" id="sheepItForm1_#index#_prnhome" /> <label for="sheepItForm1_#index#_prnhome"><span></span>At Home</label></span>
                            <span class="inline"><input type="checkbox" name="sheepItForm1_prnemerg#index#" value="yes" id="sheepItForm1_#index#_prnemerg"/> <label for="sheepItForm1_#index#_prnemerg"><span></span>In Emergency</label></span>
                            <div id="chk#index#"></div>
                        </div>

                        <!-- /Form template-->
                        <!-- No forms template -->
                        <div id="sheepItForm1_noforms_template">No PRN Medications</div>
                        <!-- /No forms template-->
                    </div>
                </section>
                <section class="buttons">
                    <p><div id="sheepItForm1_add"><a class="addnew-button" href="javascript:addNewMed()">Add New Prn Medication</a></div></p>
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
                    if (!empty($wiz_04->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_04->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
//Daily  Medication
        //Checkbox validation 1
        $('#assessment4').submit(function() {
            var $feed = $('input[name=hide3]:checked', '#assessment4').val();
            var $fields1 = $(this).find('input[name="sheepItForm_school0"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm_home0"]:checked');
            if ($feed != "on" && !$fields1.length && !$fields2.length) {
                $('.errorchk0').remove();
                $('#chkerror0').append("<span class='errorchk0'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk0').remove();
                return true;
            }
        });
        //Checkbox validation 2
        $('#assessment4').submit(function() {
            if ($("#sheepItForm_1_school").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide3]:checked', '#assessment4').val();
                var $fields1 = $(this).find('input[name="sheepItForm_school1"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm_home1"]:checked');
                if ($feed != "on" && !$fields1.length && !$fields2.length) {
                    $('.errorchk1').remove();
                    $('#chkerror1').append("<span class='errorchk1'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk1').remove();
                    return true;
                }
            }
        });
//                     Checkbox validation 2
        $('#assessment4').submit(function() {
            if ($("#sheepItForm_2_school").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide3]:checked', '#assessment4').val();
                var $fields1 = $(this).find('input[name="sheepItForm_school2"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm_home2"]:checked');
                if ($feed != "on" && !$fields1.length && !$fields2.length) {
                    $('.errorchk2').remove();
                    $('#chkerror2').append("<span class='errorchk2'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk2').remove();
                    return true;
                }
            }
        });

        //PRN Medication
        //Checkbox validation 1
        $('#assessment4').submit(function() {
            var $feed = $('input[name=hide4]:checked', '#assessment4').val();
            var $fields1 = $(this).find('input[name="sheepItForm1_prnschool0"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm1_prnhome0"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm1_prnemerg0"]:checked');
            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk3').remove();
                $('#chk0').append("<span class='errorchk3'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk3').remove();
                return true;
            }
        });
        //Checkbox validation 2
        $('#assessment4').submit(function() {
            if ($("#sheepItForm1_1_prnhome").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide4]:checked', '#assessment4').val();
                var $fields1 = $(this).find('input[name="sheepItForm1_prnschool1"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm1_prnhome1"]:checked');
                var $fields3 = $(this).find('input[name="sheepItForm1_prnemerg1"]:checked');
                if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length) {
                    $('.errorchk4').remove();
                    $('#chk1').append("<span class='errorchk4'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk4').remove();
                    return true;
                }
            }
        });
//                     Checkbox validation 2
        $('#assessment4').submit(function() {
            if ($("#sheepItForm1_2_prnhome").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide4]:checked', '#assessment4').val();
                var $fields1 = $(this).find('input[name="sheepItForm1_prnschool2"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm1_prnhome2"]:checked');
                var $fields3 = $(this).find('input[name="sheepItForm1_prnemerg2"]:checked');
                if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length) {
                    $('.errorchk5').remove();
                    $('#chk2').append("<span class='errorchk5'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk5').remove();
                    return true;
                }
            }
        });










//                     Checkbox validation 3
        $('#assessment4').submit(function() {
            if ($("#sheepItForm_3_school").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide3]:checked', '#assessment4').val();
                var $fields1 = $(this).find('input[name="sheepItForm_school2"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm_home2"]:checked');
                if ($feed != "on" && !$fields1.length && !$fields2.length) {
                    $('.errorchk3').remove();
                    $('#chkerror3').append("<span class='errorchk3'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk3').remove();
                    return true;
                }
            }
        });



        //clone form validation
        $('#assessment4').submit(function() {
            //form validation for clone
            $('.agency').each(function() {
                if (!$.trim($(this).val()).length) {
//                                    alert('Name Field should not leave empty');
                    return false; // or e.preventDefault();
                }
            });
            //Autosave
            setInterval(function() {
                var queryString = $('#assessment4').serialize();
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
                    if (count($wiz_04->med1) > 1) {
                        echo count($wiz_04->med1);
                    } else {
                        echo "1";
                    }
                    ?>,
//            afterAdd: function(source, newForm) {
////                alert('add');
//    //Assessment 04 validation
//    $('#assessment4').validate({
//        rules: {
//            'sheepItForm_med[]': {
//                 required: true
//            },
//
//            'sheepItForm_dos[]': {
//                required: true
//            },
//            'sheepItForm_time[]': {
//                required: true
//            },
//            'sheepItForm_route[]': {
//                required: true
//            },
//            'sheepItForm1_prnmed[]': {
//                required: true
//            },
//            'sheepItForm1_prndos[]': {
//                required: true
//            },
//            'sheepItForm1_prntime[]': {
//                required: true
//            },
//            'sheepItForm1_prnroute[]': {
//                required: true
//            }
//
//
//        }
//
//    });
//
//            }, afterRemoveCurrent: function(source) {
//                alert('remove');
//            },

        });
<?php
foreach ($wiz_04->med1 as $key1 => $value1) {
    ?>
            $('#sheepItForm_<?php echo $key1 ?>_med').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wiz_04->dose1 as $key2 => $value2) {
    ?>
            $('#sheepItForm_<?php echo $key2 ?>_dos').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wiz_04->route1 as $key3 => $value3) {
    ?>
            $('#sheepItForm_<?php echo $key3 ?>_route').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>
<?php
foreach ($wiz_04->time1 as $key4 => $value4) {
    ?>
            $('#sheepItForm_<?php echo $key4 ?>_time').val(<?php echo $this->db->escape($value4); ?>);
<?php } ?>

<?php
for ($i = 0; $i < count($wiz_04->med1); $i++) {
    if ($wiz_04->taken1_school[$i] == 'school') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_school').prop('checked', 'true');
        <?php
    }
    if ($wiz_04->taken1_home[$i] == 'home') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_home').prop('checked', 'true');
        <?php
    }
}
?>
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
if (count($wiz_04->prnmed1) > 1) {
    echo count($wiz_04->prnmed1);
} else {
    echo "1";
}
?>
        });


<?php
foreach ($wiz_04->prnmed1 as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_prnmed').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wiz_04->prndose1 as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_prndos').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wiz_04->prnroute1 as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_prnroute').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>
<?php
foreach ($wiz_04->prntime1 as $key4 => $value4) {
    ?>
            $('#sheepItForm1_<?php echo $key4 ?>_prntime').val(<?php echo $this->db->escape($value4); ?>);
<?php } ?>

<?php
for ($i = 0; $i < count($wiz_04->prnmed1); $i++) {
    if ($wiz_04->prntaken1_school[$i] == 'school') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_prnschool').prop('checked', 'true');
        <?php
    }
    if ($wiz_04->prntaken1_home[$i] == 'home') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_prnhome').prop('checked', 'true');
        <?php
    }
    if ($wiz_04->prntaken1_emergency[$i] == 'yes') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_prnemerg').prop('checked', 'true');
        <?php
    }
}
?>
    });
</script>

