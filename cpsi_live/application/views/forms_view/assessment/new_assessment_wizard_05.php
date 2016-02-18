<style>
    select{
        width:auto!important;

    }
    .errorchk2,.errorchk3,.errorchk4,.errorchk9,.errorchk10,.errorchk11{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
    .agency{
    }
</style>
<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
$attr_FormSubmit_assessment = array('class' => 'btn btn-primary', 'id' => 'assessment5', 'name' => 'assessment5', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_assessment = array('id' => 'assessment5', 'name' => 'assessment_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "assessment5", 'class' => "healthform");
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
//print_r($wiz_05);
if (empty($wiz_05->sif)):
    $wiz_05 = $autosave;
else:
    $userrole = check_user_role($this->session->userdata('user_id'));
    $unumber = $this->uri->segment(4);
    if (is_numeric($unumber)):
        $status = check_form_status_resubmit($wiz_05->sif);
    else:
        $unumber = $this->session->userdata('resubmit_unique_number');
        if (!empty($unumber)):
            $status = check_form_status_resubmit($wiz_05->sif);
        endif;
    endif;
    if ($status['wizard_status'] == 25 && $userrole->level == 50):
        $assessment_actions .= '<input type="submit" name="rejsubmit" value="Comments for Reject"  class="assessmentaction"   formtarget="_blank">';
        $attr_FormSave_reassessment = array('id' => 'assessment', 'name' => 'assessment_resave', 'value' => 'Resubmit', 'type' => 'submit');
    endif;
endif;
?>
<div id="assessment_wizard_5">
    <section class="page">
        <h1><?= $subtitle ?></h1>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?php if (!empty($editaction) && $wiz_05->wizard_by <> $this->session->userdata('username')): ?>
            <div class="assessmentActions"><?php #echo $assessment_actions;                        ?></div>
        <?php endif; ?>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(5)" id="hide502" name="hide502" value = "on" <?php echo!empty($wiz_05->hide502) ? ' checked ' : '' ?> /> <label for="hide502"><span></span>No needs at this time</label></span>
            <legend>Treatments</legend>
            <div class="hide502">
                <div id="sheepItForm1">
                    <div id="sheepItForm1_template" style="border-bottom: dashed #444 0px;">
                        <section>
                            <label for="sheepItForm1_#index#_treatment">Treatment Order
                                <a id="sheepItForm1_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a>
                            </label>
                            <input type="text" id="sheepItForm1_#index#_treatment" name="sheepItForm1_treatment[#index#]" class="agency"  required="required"/>
                            <label for="frequency1">Frequency</label>
                            <input type="text" id="sheepItForm1_#index#_frequency" name="sheepItForm1_frequency[#index#]" class="agency"  required="required"/>
                            <label for="taken1">Performed:</label>
                            <span class="inline"><input type="radio" id="sheepItForm1_#index#_performed_school1" name="sheepItForm1_#index#_performed_school" value="yes" checked="checked"   /> <label><span></span>At School</label></span>
                            <span class="inline"><input type="radio" id="sheepItForm1_#index#_performed_school2" name="sheepItForm1_#index#_performed_school" value="no" /> <label><span></span>At Home</label></span>
                            <label for="person1">Person Performing</label>
                            <input type="text" id="sheepItForm1_#index#_person" name="sheepItForm1_person[#index#]" class="agency" required="required" />
                        </section>
                    </div>
                    <!-- No forms template -->
                    <div id="sheepItForm1_noforms_template">No Treatments</div>
                    <!-- /No forms template-->
                </div>
                <!--- Add more Treatments button here----->
                <!-- Controls -->
                <div id="sheepItForm1_controls">
                    <div id="sheepItForm1_add"><a class="addnew-button" href="javascript:addNewTreatments()" style="text-decoration:none">Add New Treatments</a></div>
                </div>
                <!-- /Controls -->
            </div>
        </fieldset>
        <fieldset class="new-section">
            <span class="inline hide"><input type="checkbox" onclick="hideSection(6)" id="hide6" name="hide6" value = "on"  <?php echo!empty($wiz_05->hide6) ? ' checked ' : '' ?> /> <label for="hide6"><span></span>No needs at this time</label></span>
            <legend>Allergies</legend>
            <div class="hide6">
                <!-- sheepIt Form -->
                <div id="sheepItForm">
                    <!-- Form template-->
                    <div id="sheepItForm_template">
                        <section>
                            <label for="sheepItForm_#index#_allergy">Allergy
                                <a id="sheepItForm_remove_current">
                                    <img class="delete" src="<?php echo base_url(); ?>assets/images/cross.png" width="16" height="16" border="0">
                                </a>
                            </label>
                            <input type="text" id="sheepItForm_#index#_allergy" name="sheepItForm_allergy[#index#]"  >
                            <label for="sheepItForm_#index#_reaction">Reaction</label>
                            <textarea id="sheepItForm_#index#_reaction" name="sheepItForm_reaction[#index#]" ></textarea>
                            <label for="sheepItForm_#index#_sensitivity">Sensitivity Level</label>
                            <div class="check-group">
                                <span class="inline"><input type="checkbox" name="sheepItForm_#index#_touch" class="req_question" value="yes" id="sheepItForm_#index#_touch"  /> <label for="sheepItForm_#index#_touch"><span></span>Touch/Contact</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm_#index#_ingest" class="req_question" value="yes" id="sheepItForm_#index#_ingest" /> <label for="sheepItForm_#index#_ingest"><span></span>Ingestion</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm_#index#_air" class="req_question"  value="yes"  id="sheepItForm_#index#_air"  /> <label for="sheepItForm_#index#_air" ><span></span>Air</label></span>
                                <span class="inline"><input type="checkbox" name="sheepItForm_#index#_sting" class="req_question"  value="yes"  id="sheepItForm_#index#_sting"  /> <label for="sheepItForm_#index#_sting" ><span></span>Sting/Bite</label></span>
                                <div id="senserror#index#"></div>
                            </div>
                        </section>
                        <section>
                            <label for="sheepItForm_#index#_treatment">Treatment</label>
                            <span class="inline"><input type="checkbox" name="sheepItForm_#index#_epi" value="yes" id="sheepItForm_#index#_epi" value= "yes"  /><label for="sheepItForm_#index#_epi"><span></span>Epinephrine Auto-Injection</label></span>
                            <span class="inline"><input type="checkbox" name="sheepItForm_#index#_antihistamine" value="yes" id="sheepItForm_#index#_antihistamine"   /> <label for="sheepItForm_#index#_antihistamine"><span></span>Antihistamine</label></span>
                            <div id="allerror#index#"></div>
                            <div style="clear:both"></div>
                            <label for="sheepItForm_#index#_diagnosed">How was the allergy diagnosed?</label>
                            <div>
                                <span class="inline"><input type="radio" name="sheepItForm_#index#_diagnosed" value="Exposure" checked="checked" id="sheepItForm_#index#_diagnosed1" /> <label for="diagnosed1">Exposure</label></span><br>
                                <span class="inline"><input type="radio" name="sheepItForm_#index#_diagnosed" value="Allergy Testing and Exposure" id="sheepItForm_#index#_diagnosed2" <?php echo ($wiz_05->diagnosed1 == 'Allergy Testing and Exposure') ? ' checked ' : '' ?> /> <label for="diagnosed1"><span></span>Allergy Testing and Exposure</label></span><br>
                                <span class="inline"><input type="radio" name="sheepItForm_#index#_diagnosed" value="Allergy Testing/Never Exposed" id="sheepItForm_#index#_diagnosed3" <?php echo ($wiz_05->diagnosed1 == 'Allergy Testing/Never Exposed') ? ' checked ' : '' ?> /> <label for="diagnosed1"><span></span>Allergy Testing/Never Exposed</label></span>
                            </div><br>
                            <label for="sheepItForm_#index#_lastevent">Last Event</label>
                            <input type="text" id="sheepItForm_#index#_lastevent" name="sheepItForm_lastevent[#index#]" class="agency" required="required">
                        </section>
                        <div style="clear:both"></div>
                        <section class="largetext">
                            <label for="sheepItForm_#index#_addtnlcomments">Additional Comments</label>
                            <textarea id="sheepItForm_#index#_addtnlcomments" name="sheepItForm_addtnlcomments[#index#]" class="agency" required="required"> </textarea>
                        </section>

                    </div>
                    <!-- /Form template-->
                    <!-- No forms template -->
                    <div id="sheepItForm_noforms_template">No phones</div>
                    <!-- /No forms template-->
                    <div style="clear:both"></div>
                    <!-- Controls -->
                    <div id="sheepItForm_controls">
                        <div id="sheepItForm_add"><p><a class="addnew-button" href="javascript:addNewAllergy()">Add New Allergy</a></p></div>
                    </div>
                    <!-- /Controls -->
                </div>
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
                    if (!empty($wiz_05->sif) && $status['wizard_status'] == 25 && $userrole->level == 50):
                    #echo form_submit($attr_FormSave_reassessment);
                    endif;
                    ?>
                    <?php
                    //click to final page
                    $reviewvalue = $this->session->userdata('reviewassesment');
                    $unique_number = $this->session->userdata('unique_number');
                    if (!empty($reviewvalue)):
                        echo anchor("nurse_assessment/assessment/final_step/" . $wiz_05->sif . "/" . $unique_number, "<button type='button' class='previous'>Go to final page</button>");
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


        //form validation for clone


        // //Allergies
        //Checkbox validation 1
        $('#assessment5').submit(function() {
            var $feed = $('input[name=hide6]:checked', '#assessment5').val();
            var $fields1 = $(this).find('input[name="sheepItForm_0_epi"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm_0_antihistamine"]:checked');
            if ($feed != "on" && !$fields1.length && !$fields2.length) {
                $('.errorchk9').remove();
                $('#allerror0').append("<span class='errorchk9'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk9').remove();
                return true;
            }
        });
        //Checkbox validation 2
        $('#assessment5').submit(function() {
            if ($("#sheepItForm_1_epi").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide6]:checked', '#assessment5').val();
                var $fields1 = $(this).find('input[name="sheepItForm_1_epi"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm_1_antihistamine"]:checked');
                if ($feed != "on" && !$fields1.length && !$fields2.length) {
                    $('.errorchk10').remove();
                    $('#allerror1').append("<span class='errorchk10'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk10').remove();
                    return true;
                }
            }
        });
//                     Checkbox validation 2
        $('#assessment5').submit(function() {
            if ($("#sheepItForm_2_epi").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide6]:checked', '#assessment5').val();
                var $fields1 = $(this).find('input[name="sheepItForm_2_epi"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm_2_antihistamine"]:checked');
                if ($feed != "on" && !$fields1.length && !$fields2.length) {
                    $('.errorchk11').remove();
                    $('#allerror2').append("<span class='errorchk11'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk11').remove();
                    return true;
                }
            }
        });

        //Allergies Sensitive level
        $('#assessment5').submit(function() {
            var $feed = $('input[name=hide6]:checked', '#assessment5').val();
            var $fields1 = $(this).find('input[name="sheepItForm_0_touch"]:checked');
            var $fields2 = $(this).find('input[name="sheepItForm_0_ingest"]:checked');
            var $fields3 = $(this).find('input[name="sheepItForm_0_air"]:checked');
            var $fields4 = $(this).find('input[name="sheepItForm_0_sting"]:checked');
            if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length) {
                $('.errorchk2').remove();
                $('#senserror0').append("<span class='errorchk2'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk2').remove();
                return true;
            }
        });

        $('#assessment5').submit(function() {
            if ($("#sheepItForm_1_touch").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide6]:checked', '#assessment5').val();
                var $fields1 = $(this).find('input[name="sheepItForm_1_touch"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm_1_ingest"]:checked');
                var $fields3 = $(this).find('input[name="sheepItForm_1_air"]:checked');
                var $fields4 = $(this).find('input[name="sheepItForm_1_sting"]:checked');
                var $fields5 = $("#sheepItForm_1_allergy").val();
                if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && $fields5 != "") {
                    $('.errorchk3').remove();
                    $('#senserror1').append("<span class='errorchk3'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk3').remove();
                    return true;
                }
            }
        });
        $('#assessment5').submit(function() {
            if ($("#sheepItForm_2_touch").attr('type') == 'checkbox') {
                var $feed = $('input[name=hide6]:checked', '#assessment5').val();
                var $fields1 = $(this).find('input[name="sheepItForm_2_touch"]:checked');
                var $fields2 = $(this).find('input[name="sheepItForm_2_ingest"]:checked');
                var $fields3 = $(this).find('input[name="sheepItForm_2_air"]:checked');
                var $fields4 = $(this).find('input[name="sheepItForm_2_sting"]:checked');
                var $fields5 = $("#sheepItForm_2_allergy").val();
                if ($feed != "on" && !$fields1.length && !$fields2.length && !$fields3.length && !$fields4.length && $fields5 != "") {
                    $('.errorchk4').remove();
                    $('#senserror2').append("<span class='errorchk4'>Error: " + "You must check at least one" + "</span>");
                    return false; // The form will *not* submit
                }
                else {
                    $('.errorchk4').remove();
                    return true;
                }
            }
        });


        //Autosave
        setInterval(function() {
            var queryString = $('#assessment5').serialize();
            //alert(queryString);
            var baseurl = '<?php echo base_url(); ?>';
            //alert(baseurl);
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
//Autosave end
    });</script>

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
                    if (count($wiz_05->allergy1) > 1) {
                        echo count($wiz_05->allergy1);
                    } else {
                        echo "1";
                    }
                    ?>
        });
<?php
foreach ($wiz_05->allergy1 as $key1 => $value1) {
    ?>
            $('#sheepItForm_<?php echo $key1 ?>_allergy').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wiz_05->reaction1 as $key2 => $value2) {
    ?>
            $('#sheepItForm_<?php echo $key2 ?>_reaction').html(<?php echo $this->db->escape($value2); ?>);
<?php } ?>
<?php
foreach ($wiz_05->addtnlcomments1 as $key2 => $value2) {
    ?>

            $('#sheepItForm_<?php echo $key2 ?>_addtnlcomments').html(<?php echo $this->db->escape($value2); ?>);
<?php } ?>

<?php
foreach ($wiz_05->lastevent1 as $key2 => $value2) {
    ?>
            $('#sheepItForm_<?php echo $key2 ?>_lastevent').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>

<?php
foreach ($wiz_05->ah1 as $key3 => $value3) {
    ?>
            $('#sheepItForm_<?php echo $key3; ?>_ah1').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>

//Edit option data brings
<?php
for ($i = 0; $i < count($wiz_05->allergy1); $i++) {
    if ($wiz_05->deadly1[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_deadly1').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->deadly1[$i] == 'no') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_deadly2').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->diagnosed1[$i] == 'Exposure') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_diagnosed1').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->diagnosed1[$i] == 'Allergy Testing/Never Exposed') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_diagnosed3').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->diagnosed1[$i] == 'Allergy Testing and Exposure') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_diagnosed2').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->sensitivity1_touch[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_touch').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->sensitivity1_ingest[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_ingest').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->sensitivity1_air[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_air').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->sensitivity1_sting[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_sting').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->treatment1_epi[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_epi').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->treatment1_antihistamine[$i] == 'yes') {
        ?>
                $('#sheepItForm_<?php echo $i; ?>_antihistamine').prop('checked', 'true');
        <?php
    }
}
?>

// Add more treatments here
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
if (count($wiz_05->treatment1) > 1) {
    echo count($wiz_05->treatment1);
} else {
    echo "1";
}
?>
        });
<?php
foreach ($wiz_05->treatment1 as $key1 => $value1) {
    ?>
            $('#sheepItForm1_<?php echo $key1 ?>_treatment').val(<?php echo $this->db->escape($value1); ?>);
<?php } ?>
<?php
foreach ($wiz_05->frequency1 as $key2 => $value2) {
    ?>
            $('#sheepItForm1_<?php echo $key2 ?>_frequency').val(<?php echo $this->db->escape($value2); ?>);
<?php } ?>


<?php
foreach ($wiz_05->person1 as $key3 => $value3) {
    ?>
            $('#sheepItForm1_<?php echo $key3 ?>_person').val(<?php echo $this->db->escape($value3); ?>);
<?php } ?>

        //Edit option data brings
<?php
for ($i = 0; $i < count($wiz_05->treatment1); $i++) {
    if ($wiz_05->performed_school1[$i] == 'yes') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_performed_school1').prop('checked', 'true');
        <?php
    }
    if ($wiz_05->performed_school1[$i] == 'no') {
        ?>
                $('#sheepItForm1_<?php echo $i; ?>_performed_school2').prop('checked', 'true');
        <?php
    }
}
?>
    });
</script>