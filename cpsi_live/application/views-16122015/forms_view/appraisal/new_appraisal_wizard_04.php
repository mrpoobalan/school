<style>
    select{
        width:auto!important;
    }
    .error{
        color: red;
    }
    .errorchk,.errorchk2,.errorchk7,.errorchk8,.errorchk9{
        background: none repeat scroll 0 0 #ffecec;
        border: 0 solid #f5aca6;
        color: red;
    }
</style>

<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
if (empty($wizardData->sif)):
    $wizardData = $autosave;
endif;
$attr_FormSubmit_appraisal = array('class' => 'save', 'id' => 'appraisal4', 'name' => 'appraisal4', 'value' => 'Next', 'type' => 'submit');
$attr_FormSave_appraisal = array('id' => 'appraisal', 'name' => 'appraisal_save', 'value' => 'Save & Exit', 'type' => 'submit');
$attr_FormOpen = array('id' => "appraisal4", 'class' => "healthform");
$sif = array('name' => 'sif', 'type' => 'hidden');

// setup values for all checkboxes
if ($wizardData) {
    $checkboxFields = array('missschool', 'missedtimes', 'meddelivery', 'studentadmin', 'selfmdi', 'mdi', 'spacer', 'peak', 'pulmvest', 'chestpt', 'tplan', 'edasthma', 'numvisits');

    foreach ($checkboxFields as $field) {
        if (property_exists($wizardData, $field) && is_array($wizardData->{$field})) {
            foreach ($wizardData->{$field} as $key => $selectedValue) {
                $selectedValue = strtolower($selectedValue);
                $wizardData->$selectedValue = $selectedValue;
            }
        }
    }
}
//Wizard data is empty while copy assessment / appraisal
$previous = $this->uri->segment(4);
$sessionval = $this->session->userdata('copy_assigned_unique_number_appraisal');
if (!empty($sessionval) && !empty($previous) && $previous == "copy"):
    $wizardData = array();
endif;
//echo '<pre>';
//print_r($wizardData);
//exit;
?>
<?php
?>
<section class="page">
    <h1><?= $subtitle ?></h1>
    <?= form_open("{$action}", $attr_FormOpen); ?>



    <!--  due to time constraints, not extending fix below -->
<!--<section class="buttons">
<div class="nextbutton">
    <button class="previous">Previous Page</button>
    <button class="next">Next Page</button>
</div>
<div class="savebuttons">
    <button class="save">Save Form</button>
</div>
<div class="clear"></div>
</section>-->
    <fieldset class="new-section">
        <span class="inline hide"><input type="checkbox" onclick="hideSection(12)" id="hide12" name="hide12" /> <label for="hide12"><span></span>Not Applicable</label></span>
        <legend>Respiratory - Oxygen/Tracheostomy/Ventilation Requirements</legend>
        <div class="hide12">
            <fieldset class="twocol">
                <section>
                    <label>Respiratory Assessment</label>
                    <span><input type="checkbox" name="resp_assess_continuous" id="resp_assess_continuous" value="Continuous" <?= !empty($wizardData->{'resp_assess_continuous'}) ? ' checked ' : ''; ?> /><label for="resp_assess_continuous"><span></span> Continuous</label></span>
                    <span><input type="checkbox" name="resp_assess_intermittant" id="resp_assess_intermittant" value="Intermittant/As Needed" <?= !empty($wizardData->{'resp_assess_intermittant'}) ? ' checked ' : ''; ?>  /><label for="resp_assess_intermittant"><span></span> Intermittant/As Needed</label></span>
                    <span><input type="checkbox" name="resp_assess_signal" id="resp_assess_signal" value="Student Communicates/Signals Need" <?= !empty($wizardData->{'resp_assess_signal'}) ? ' checked ' : ''; ?>  /><label for="resp_assess_signal"><span></span> Student Communicates/Signals Need</label></span>
                    <div id="chkerror2"></div>
                    <label for="baseline_assess">Baseline Respiratory Assessment</label>
                    <textarea id="baseline_assess" name="baseline_assess" ><?= !empty($wizardData->baseline_assess) ? $wizardData->baseline_assess : ''; ?></textarea>

                    <label for="distress_sign">Signs/Symptoms of Respiratory Distress</label>
                    <textarea id="distress_sign" name="distress_sign" ><?= !empty($wizardData->distress_sign) ? $wizardData->distress_sign : ''; ?></textarea>
                </section>
                <section>
                    <label for="ventilation">Mechanical Ventilation?</label>
                    <span class="inline"><input type="radio" name="ventilation" id="ventilation" value="" checked="checked" /><label for="ventilation-none"><span></span> None</label></span>
                    <span class="inline"><input type="radio" name="ventilation" id="ventilation" value="CPAP" <?php echo ($wizardData->ventilation == 'CPAP') ? ' checked ' : '' ?> /><label for="ventilation-cpap"><span></span> CPAP</label></span>
                    <span class="inline"><input type="radio" name="ventilation" id="ventilation" value="BIPAP" <?php echo ($wizardData->ventilation == 'BIPAP') ? ' checked ' : '' ?> /><label for="ventilation-bipap"><span></span> BIPAP</label></span>

                    <label for="where">Ventilation Needed</label>
                    <span class="inline"><input type="checkbox" name="where_home" id="where_home" value="Home"  <?= !empty($wizardData->{'where_home'}) ? ' checked ' : ''; ?>/><label for="where_home"><span></span> Home</label></span>
                    <span class="inline"><input type="checkbox" name="where_school" id="where_school" value="School"  <?= !empty($wizardData->{'resp_assess_signal'}) ? ' checked ' : ''; ?>/><label for="where_school"><span></span> School</label></span>
                    <span class="inline"><input type="checkbox" name="where_sleep" id="where_sleep" value="Sleep"  <?= !empty($wizardData->{'resp_assess_signal'}) ? ' checked ' : ''; ?>/><label for="where_sleep"><span></span> Sleep</label></span>
                    <span class="inline"><input type="checkbox" name="where_as_needed" id="where_as_needed" value="As Needed Per Orders"  <?= !empty($wizardData->{'resp_assess_signal'}) ? ' checked ' : ''; ?> /><label for="where_as_needed"><span></span> As Needed</label></span>

                    <!--                    <label for="vent_depend">Ventilator Dependent?</label>
                                        <span class="inline"><input type="radio" name="vent_depend" value="Ventilator Dependent" onclick="showval3(this.value)" id="vent_depend_dependent"  <?= !empty($wizardData->{'vent_depend'}) ? ' checked ' : ''; ?> /><label for="vent_depend_dependent"><span></span> Ventilator Dependent</label></span>
                                        <span class="inline"><input type="radio" name="vent_depend" value=""   onclick="showval3(this.value)" id="vent_depend_assist" <?= empty($wizardData->{'vent_depend'}) ? ' checked ' : ''; ?> /><label for="vent_depend_assist"><span></span> Ventilator Assist</label></span>
                                        <div id="hidename13">
                                            <label for="vent_assist">If Vent Assist, how long can student be off vent?</label>
                                            <input type="text" id="vent_assist" name="vent_assist" value="<?= !empty($wizardData->vent_assist) ? $wizardData->vent_assist : ''; ?>" />
                                        </div>
                                        <label for="vent_set">Ventilator Settings</label>
                                        <input type="text" id="vent_set" name="vent_set" value="<?= !empty($wizardData->vent_set) ? $wizardData->vent_set : ''; ?>" />

                                        <label for="vent_co">Ventilator Company</label>
                                        <input type="text" id="vent_co" name="vent_co" value="<?= !empty($wizardData->vent_co) ? $wizardData->vent_co : ''; ?>" />

                                        <label for="vent_contact">Contact Information</label>
                                        <input type="text" id="vent_contact" name="vent_contact" value="<?= !empty($wizardData->vent_contact) ? $wizardData->vent_contact : ''; ?>" />-->
                    <label for="vent-depend">Ventilator Dependent?</label>
                    <span class="inline"><input type="checkbox" name="vent_depend_dependent" onclick="showvalue13()" id="vent_depend_dependent" value="Ventilator Dependent"   <?php echo!empty($wizardData->vent_depend_dependent) ? ' checked ' : '' ?> /><label for="vent_depend_dependent"><span></span> Ventilator Dependent</label></span>
                    <span class="inline"><input type="checkbox" name="vent_depend_assist" id="vent_depend_assist" onclick="showvalue13()" value="Ventilator Assist"   <?php echo!empty($wizardData->vent_depend_assist) ? ' checked ' : '' ?> /><label for="vent_depend_assist"><span></span> Ventilator Assist</label></span>
                    <div id="divval13" style="display: none">
                        <label for="vent-assist">If Vent Assist, how long can student be off vent?</label>
                        <input type="text" id="vent_assist" name="vent_assist" value="<?php echo $wizardData->vent_assist ?>"  />
                    </div>
                    <label for="vent_set">Ventilator Settings</label>
                    <input type="text" id="vent_set"  name="vent_set" value="<?php echo $wizardData->vent_set ?>"  />

                    <label for="vent_co">Ventilator Company</label>
                    <input type="text" id="vent_co" name="vent_co" value="<?php echo $wizardData->vent_co ?>"  />

                    <label for="vent_contact">Contact Information</label>
                    <input type="text" id="vent_contact" name="vent_contact" value="<?php echo $wizardData->vent_contact ?>"  />

                </section>
            </fieldset>
            <section>
                <label for="oxygen">Oxygen</label>
                <span class="inline"><input type="checkbox" name="oxygen_cont" id="oxygen_cont" value="yes"   <?php echo!empty($wizardData->oxygen_cont) ? ' checked ' : '' ?> /><label for="oxygen_cont"><span></span> Continuous</label></span>
                <span class="inline"><input type="checkbox" name="oxygen_inter" id="oxygen_inter" value="yes"   <?php echo!empty($wizardData->oxygen_inter) ? ' checked ' : '' ?> /><label for="oxygen_inter"><span></span> Intermittent</label></span>

                <label for="oximetry">Oximetry</label>
                <span class="inline"><input type="radio" name="oximetry" id="oximetry_yes" onclick="showvalue301(this.value)"  value="yes" <?= !empty($wizardData->{'oximetry'}) ? ' checked ' : ''; ?> /><label for="oximetry_yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="oximetry" id="oximetry_no" onclick="showvalue301(this.value)"  value="" <?= empty($wizardData->{'oximetry'}) ? ' checked ' : ''; ?> /><label for="oximetry_no"><span></span> No</label></span>
                <div id="hidename301">
                    <label for="ox_freq">Frequency</label>
                    <input type="text" id="ox_freq" name="ox_freq" value="<?= !empty($wizardData->ox_freq) ? $wizardData->ox_freq : ''; ?>" />

                    <label for="ox_param">Parameters</label>
                    <input type="text" id="ox_param" name="ox_param" value="<?= !empty($wizardData->ox_param) ? $wizardData->ox_param : ''; ?>" />
                </div>
            </section>
            <section>
                <label for="ox_route">Oxygen Route</label>
                <span><input type="checkbox" name="ox_route_nasal" id="ox_route_nasal" value="Nasal Cannula" <?= !empty($wizardData->{'ox_route_nasal'}) ? ' checked ' : ''; ?>/><label for="ox_route_nasal"><span></span> Nasal Cannula</label></span>
                <span><input type="checkbox" name="ox_route_trach" id="ox_route_trach" value="Tracheotomy" <?= !empty($wizardData->{'ox_route_trach'}) ? ' checked ' : ''; ?>/><label for="ox_route_trach"><span></span> Tracheotomy</label></span>
                <span><input type="checkbox" name="ox_route_mask" id="ox_route_mask" value="Mask/Non_Rebreather" <?= !empty($wizardData->{'ox_route_mask'}) ? ' checked ' : ''; ?> /><label for="ox_route_mask"><span></span> Mask/Non_Rebreather</label></span>

                <label for="ox_source">Oxygen Source</label>
                <span><input type="checkbox" name="ox_source_tank" id="ox_source_tank" value="Tank" <?= !empty($wizardData->{'ox_source_tank'}) ? ' checked ' : ''; ?> /><label for="ox_source_tank"><span></span> Tank</label></span>
                <span><input type="checkbox" name="ox_source_liquid" id="ox_source_liquid" value="Liquid" <?= !empty($wizardData->{'ox_source_liquid'}) ? ' checked ' : ''; ?> /><label for="ox_source_liquid"><span></span> Liquid</label></span>
                <span><input type="checkbox" name="ox_source_concentrator" id="ox_source_concentrator" value="Concentrator" <?= !empty($wizardData->{'ox_source_concentrator'}) ? ' checked ' : ''; ?> /><label for="ox_source_concentrator"><span></span> Concentrator</label></span>

            </section>
            <section>
                <label for="trach_size">Trach Size</label>
                <input type="text" id="trach_size" name="trach_size" value="<?= !empty($wizardData->trach_size) ? $wizardData->trach_size : ''; ?>" />

                <label for="cuffed">Cuffed?</label>
                <span class="inline"><input type="radio" name="cuffed" id="cuffed_yes" value="Yes" <?= !empty($wizardData->{'cuffed'}) ? ' checked ' : ''; ?> /><label for="cuffed_yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="cuffed" id="cuffed_no" value="" <?= empty($wizardData->{'cuffed'}) ? ' checked ' : ''; ?> /><label for="cuffed_no"><span></span> No</label></span>

                <label for="thermo">Thermo_Vent?</label>
                <span class="inline"><input type="radio" name="thermo" id="thermo_yes" value="Yes" <?= !empty($wizardData->{'thermo'}) ? ' checked ' : ''; ?> /><label for="thermo_yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="thermo" id="thermo_no" value="" <?= empty($wizardData->{'thermo'}) ? ' checked ' : ''; ?> /><label for="thermo_no"><span></span> No</label></span>

                <label for="muir">Passy Muir?</label>
                <span class="inline"><input type="radio" name="muir" id="muir_yes" value="Yes" <?= !empty($wizardData->{'muir'}) ? ' checked ' : ''; ?>  /><label for="muir_yes"><span></span> Yes</label></span>
                <span class="inline"><input type="radio" name="muir" id="muir_no" value="" <?= empty($wizardData->{'muir'}) ? ' checked ' : ''; ?>  /><label for="muir_no"><span></span> No</label></span>
            </section>
            <fieldset class="twocol clear">
                <section>
                    <label for="co2">CO2 Monitor?</label>
                    <span class="inline"><input type="radio" name="co2" id="co2_yes" onclick="showvalue302(this.value)" value="yes" <?= !empty($wizardData->{'co2'}) ? ' checked ' : ''; ?> /><label for="co2_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="co2" id="co2_no" onclick="showvalue302(this.value)" value="" <?= empty($wizardData->{'co2'}) ? ' checked ' : ''; ?> /><label for="co2_no"><span></span> No</label></span>
                    <div id="hidename302">
                        <label for="co2_freq">Frequency</label>
                        <input type="text" id="co2_freq" name="co2_freq" value="<?= !empty($wizardData->co2_freq) ? $wizardData->co2_freq : ''; ?>" />

                        <label for="co2_param">Parameters</label>
                        <input type="text" id="co2_param" name="co2_param" value="<?= !empty($wizardData->co2_param) ? $wizardData->co2_param : ''; ?>" />
                    </div>
                </section>
                <section>
                    <label for="addtnl_vent">Additional Ventilator Information - Heated or Humidified, Plugged In or Batteries, Is Equipment Portable, etc</label>
                    <textarea id="addtnl_vent" name="addtnl_vent" placeholder="" ><?= !empty($wizardData->addtnl_vent) ? $wizardData->addtnl_vent : ''; ?></textarea>
                </section>
            </fieldset>
            <fieldset class="threecol">
                <section>
                    <label for="suction">Suctioning?</label>
                    <span class="inline"><input type="radio" name="suction" id="suction_yes" onclick="showvalue338(this.value)"  value="Yes"<?= !empty($wizardData->{'suction'}) ? ' checked ' : ''; ?> /><label for="suction_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="suction" id="suction_no" onclick="showvalue338(this.value)" value="" <?= empty($wizardData->{'suction'}) ? ' checked ' : ''; ?> /><label for="suction_no"><span></span> No</label></span>
                    <!--<span><input type="checkbox" name="suction_drain" id="suction_drain" value="Postural Drainage" <?= !empty($wizardData->{'suction_drain'}) ? ' checked ' : ''; ?> /><label for="suction_drain"><span></span> Postural Drainage</label></span>-->
                    <div id="hidename338">
                        <label for="trach_type">Type</label>
                        <span><input type="checkbox" name="trach_type_o" id="trach_type_o" onchange="typechecked1()" value="Oropharyngeal" <?= !empty($wizardData->{'trach_type_o'}) ? ' checked ' : ''; ?> /><label for="trach_type_o"><span></span> Oropharyngeal</label></span>
                        <!----- Type 1 --->
                        <div id="suctiontype1">
                            <label for="cath">Catheter Type</label>
                            <span class="inline"><input type="checkbox" name="cath_y" id="cath_y" value="Yankauer Catheter" <?= !empty($wizardData->{'cath_y'}) ? ' checked ' : ''; ?> /><label for="cath_y"><span></span> Yankauer Catheter</label></span><br>
                            <span class="inline"><input type="checkbox" name="cath_f" id="cath_f" value="Flexible Catheter" <?= !empty($wizardData->{'cath_f'}) ? ' checked ' : ''; ?> /><label for="cath_f"><span></span> Flexible Catheter</label></span>
                            <div id="oerror"></div>
                            <label for="cath_size">Catheter Size</label>
                            <input type="text" id="cath_size" name="cath_size" value="<?= !empty($wizardData->cath_size) ? $wizardData->cath_size : ''; ?>" />

                            <label for="cath_freq">Frequency</label>
                            <input type="text" id="cath_freq" name="cath_freq" value="<?= !empty($wizardData->cath_freq) ? $wizardData->cath_freq : ''; ?>" />

                            <label for="cath_color">Color of Secretions</label>
                            <input type="text" id="cath_color" name="cath_color" value="<?= !empty($wizardData->cath_color) ? $wizardData->cath_color : ''; ?>" />

                            <label for="suction_equip">Equipment needed for suctioning</label>
                            <textarea id="suction_equip" name="suction_equip" ><?= !empty($wizardData->suction_equip) ? $wizardData->suction_equip : ''; ?></textarea>
                        </div>

                        <span><input type="checkbox" name="trach_type_n" id="trach_type_n" onchange="typechecked1()" value="Nasopharyngeal" <?= !empty($wizardData->{'trach_type_n'}) ? ' checked ' : ''; ?> /><label for="trach_type_n"><span></span> Nasopharyngeal</label></span>
                        <!----- Type 2 --->
                        <div id="suctiontype2">
                            <label for="cath">Catheter Type</label>
                            <span class="inline"><input type="checkbox" name="cath_y2" id="cath_y2" value="Yankauer Catheter" <?= !empty($wizardData->{'cath_y2'}) ? ' checked ' : ''; ?> /><label for="cath_y2"><span></span> Yankauer Catheter</label></span><br>
                            <span class="inline"><input type="checkbox" name="cath_f2" id="cath_f2" value="Flexible Catheter" <?= !empty($wizardData->{'cath_f2'}) ? ' checked ' : ''; ?> /><label for="cath_f2"><span></span> Flexible Catheter</label></span>
                            <div id="nerror"></div>
                            <label for="cath_size">Catheter Size</label>
                            <input type="text" id="cath_size2" name="cath_size2" value="<?= !empty($wizardData->cath_size2) ? $wizardData->cath_size2 : ''; ?>" />

                            <label for="cath_freq">Frequency</label>
                            <input type="text" id="cath_freq2" name="cath_freq2" value="<?= !empty($wizardData->cath_freq2) ? $wizardData->cath_freq2 : ''; ?>" />

                            <label for="cath_color">Color of Secretions</label>
                            <input type="text" id="cath_color2" name="cath_color2" value="<?= !empty($wizardData->cath_color2) ? $wizardData->cath_color2 : ''; ?>" />

                            <label for="suction_equip">Equipment needed for suctioning</label>
                            <textarea id="suction_equip2" name="suction_equip2" ><?= !empty($wizardData->suction_equip2) ? $wizardData->suction_equip2 : ''; ?></textarea>
                        </div>

                        <span><input type="checkbox" name="trach_type_e" id="trach_type_e" onchange="typechecked1()" value="Endotracheal" <?= !empty($wizardData->{'trach_type_e'}) ? ' checked ' : ''; ?> /><label for="trach_type_e"><span></span> Endotracheal</label></span>
                        <!----- Type 3 --->
                        <div id="suctiontype3">
                            <label for="cath">Catheter Type</label>
                            <span class="inline"><input type="checkbox" name="cath_y3" id="cath_y3" value="Yankauer Catheter3" <?= !empty($wizardData->{'cath_y3'}) ? ' checked ' : ''; ?> /><label for="cath_y3"><span></span> Yankauer Catheter</label></span><br>
                            <span class="inline"><input type="checkbox" name="cath_f3" id="cath_f3" value="Flexible Catheter3" <?= !empty($wizardData->{'cath_f3'}) ? ' checked ' : ''; ?> /><label for="cath_f3"><span></span> Flexible Catheter</label></span>
                            <div id="eerror"></div>
                            <label for="cath_size">Catheter Size</label>
                            <input type="text" id="cath_size3" name="cath_size3" value="<?= !empty($wizardData->cath_size3) ? $wizardData->cath_size3 : ''; ?>" />

                            <label for="cath_freq">Frequency</label>
                            <input type="text" id="cath_freq3" name="cath_freq3" value="<?= !empty($wizardData->cath_freq3) ? $wizardData->cath_freq3 : ''; ?>" />

                            <label for="cath_color">Color of Secretions</label>
                            <input type="text" id="cath_color3" name="cath_color3" value="<?= !empty($wizardData->cath_color3) ? $wizardData->cath_color3 : ''; ?>" />

                            <label for="suction_equip">Equipment needed for suctioning</label>
                            <textarea id="suction_equip3" name="suction_equip3" ><?= !empty($wizardData->suction_equip3) ? $wizardData->suction_equip3 : ''; ?></textarea>
                        </div>
                        <div id="chkerror"></div>
                    </div>
                </section>

            </fieldset>
            <fieldset class="twocol">
                <section>
                    <label for="other_equip">Other Equipment Needed for School</label>
                    <textarea id="other_equip" name="other_equip"><?= !empty($wizardData->other_equip) ? $wizardData->other_equip : ''; ?> </textarea>

                    <label for="equip_check">Equipment Checklist Utilized?</label>
                    <span class="inline"><input type="radio" name="equip_check" id="equip_check_yes" value="Yes" <?= !empty($wizardData->{'equip_check'}) ? ' checked ' : ''; ?> /><label for="equip_check_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="equip_check" id="equip_check_no" value="" <?= empty($wizardData->{'equip_check'}) ? ' checked ' : ''; ?> /><label for="equip_check_no"><span></span> No</label></span>

                </section>
                <section>
                    <label for="evac">Evacuation/Emergency Instructions</label>
                    <textarea id="evac" name="evac" ><?= !empty($wizardData->evac) ? $wizardData->evac : ''; ?></textarea>
                </section>
            </fieldset>
            <fieldset>
                <section class="largetext">
                    <label for="oxy_addntl">Additional Comments</label>
                    <textarea id="oxy_addtnl" name="oxy_addtnl"> <?= !empty($wizardData->oxy_addtnl) ? $wizardData->oxy_addtnl : ''; ?></textarea>
                </section>
            </fieldset>
        </div>
    </fieldset>
    <!--<section class="buttons">
            <div class="nextbutton">
                    <button class="previous">Previous Page</button>
                    <button class="next">Next Page</button>
            </div>
            <div class="savebuttons">
                    <button class="save">Save Form</button>
            </div>
            <div class="clear"></div>
    </section>-->
    <fieldset class="new-section">
        <span class="inline hide"><input type="checkbox" onclick="hideSection(133)" id="hide133" name="hide133" /> <label for="hide133"><span></span>Not Applicable</label></span>
        <legend>Orthopedics and Mobility Requirements</legend>
        <div class="hide133">
            <fieldset>
                <section>
                    <span class="inline"><input type="checkbox" name="mobility_amb" id="mobility_amb" value="Ambulatory" <?= !empty($wizardData->{'mobility_amb'}) ? ' checked ' : ''; ?>  /><label for="mobility_amb"><span></span> Ambulatory</label></span>
                    <span class="inline"><input type="checkbox" name="mobility_ind" id="mobility_ind" value="Independent" <?= !empty($wizardData->{'mobility_ind'}) ? ' checked ' : ''; ?> /><label for="mobility_ind"><span></span> Independent</label></span>
                    <span class="inline"><input type="checkbox" name="mobility_ns" id="mobility_ns" value="Needs Supervision" <?= !empty($wizardData->{'mobility_ns'}) ? ' checked ' : ''; ?> /><label for="mobility_ns"><span></span> Needs Supervision</label></span>
                    <span class="inline"><input type="checkbox" name="mobility_uw" id="mobility_uw" value="Uses Walker" <?= !empty($wizardData->{'mobility_uw'}) ? ' checked ' : ''; ?> /><label for="mobility_uw"><span></span> Uses Walker</label></span>
                    <span class="inline"><input type="checkbox" name="mobility_gt" id="mobility_gt" value="Gait Trainer" <?= !empty($wizardData->{'mobility_gt'}) ? ' checked ' : ''; ?> /><label for="mobility_gt"><span></span> Gait Trainer</label></span>
                    <span class="inline"><input type="checkbox" name="mobility_wheel" id="mobility_wheel" value="Wheelchair" <?= !empty($wizardData->{'mobility_wheel'}) ? ' checked ' : ''; ?> /><label for="mobility_wheel"><span></span> Wheelchair</label></span>

                    <label for="wc">Wheelchair</label>
                    <span class="inline"><input type="checkbox" name="wc_mi" id="wc_mi" value="Manual Independent" <?= !empty($wizardData->{'wc_mi'}) ? ' checked ' : ''; ?> /><label for="wc_mi"><span></span> Manual Independent</label></span>
                    <span class="inline"><input type="checkbox" name="wc_ma" id="wc_ma" value="Manual Assist" <?= !empty($wizardData->{'wc_ma'}) ? ' checked ' : ''; ?> /><label for="wc_ma"><span></span> Manual Assist</label></span>
                    <span class="inline"><input type="checkbox" name="wc_pi" id="wc_pi" value="Power Independent" <?= !empty($wizardData->{'wc_pi'}) ? ' checked ' : ''; ?> /><label for="wc_pi"><span></span> Power Independent</label></span>
                    <span class="inline"><input type="checkbox" name="wc_pa" id="wc_pa" value="Power Assist" <?= !empty($wizardData->{'wc_pa'}) ? ' checked ' : ''; ?> /><label for="wc_pa"><span></span> Power Assist</label></span>
                    <span class="inline"><input type="checkbox" name="wc_so" id="wc_so" value="Supervision Only" <?= !empty($wizardData->{'wc_so'}) ? ' checked ' : ''; ?> /><label for="wc_so"><span></span> Supervision Only</label></span>
                </section>
            </fieldset>
            <fieldset>
                <section>
                    <label for="sc">Special Consideration</label>
                    <textarea id="special_cond" name="special_cond"><?= !empty($wizardData->special_cond) ? $wizardData->special_cond : ''; ?></textarea>
                </section>
                <section>
                    <label for="equip_provider">Equipment Provider</label>
                    <input type="text" id="equip_provider" name="equip_provider" value="<?= !empty($wizardData->equip_provider) ? $wizardData->equip_provider : ''; ?>"/>

                    <label for="c_info">Contact Info</label>
                    <input type="text" id="c_info" name="c_info" value="<?= !empty($wizardData->c_info) ? $wizardData->c_info : ''; ?>" />
                </section>
            </fieldset>
            <fieldset>
                <section>
                    <label for="scoliosis">Scoliosis?</label>
                    <span class="inline"><input type="radio" name="scoliosis" id="scoliosis_yes" value="yes" onclick="showvalue303(this.value)" <?= !empty($wizardData->{'scoliosis'}) ? ' checked ' : ''; ?> /><label for="scoliosis_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="scoliosis" id="scoliosis_no" value="" onclick="showvalue303(this.value)"   <?= empty($wizardData->{'scoliosis'}) ? ' checked ' : ''; ?> /><label for="scoliosis_no"><span></span> No</label></span>
                    <div id="hidename303">
                        <label for="sco_last">Last X_Ray/Exam</label>
                        <input type="text" id="sco_last" name="sco_last" value="<?= !empty($wizardData->sco_last) ? $wizardData->sco_last : ''; ?>"/>

                        <label for="sco_treat">Treatment</label>
                        <input type="text" id="sco_treat" name="sco_treat" value="<?= !empty($wizardData->sco_treat) ? $wizardData->sco_treat : ''; ?>"/>
                    </div>
                </section>
                <section>
                    <label for="hip">Hip Dislocation?</label>
                    <span class="inline"><input type="radio" name="hip" id="hip_yes" onclick="showvalue330(this.value)" value="Yes" <?= !empty($wizardData->{'hip'}) ? ' checked ' : ''; ?> /><label for="hip_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="hip" id="hip_no" onclick="showvalue330(this.value)" value="" <?= empty($wizardData->{'hip'}) ? ' checked ' : ''; ?> /><label for="hip_no"><span></span> No</label></span>
                    <div id="hidename330">
                        <label for="hip_last">Last X_Ray/Exam</label>
                        <input type="text" id="hip_last" name="hip_last" placeholder="should become date picker" value="<?= !empty($wizardData->hip_last) ? $wizardData->hip_last : ''; ?>" />
                    </div>
                    <label for="hip_treat">Treatment</label>
                    <input type="text" id="hip_treat" name="hip_treat" value="<?= !empty($wizardData->hip_treat) ? $wizardData->hip_treat : ''; ?>" />
                </section>
                <section>
                    <label for="pt">Physical Therapy Services?</label>
                    <span class="inline"><input type="radio" name="pt" id="pt_yes" onclick="showval4(this.value)" value="Yes" <?= !empty($wizardData->{'pt'}) ? ' checked ' : ''; ?>/><label for="pt_yes"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="pt" id="pt_no" onclick="showval4(this.value)" value="" <?= empty($wizardData->{'pt'}) ? ' checked ' : ''; ?>/><label for="pt_no"><span></span> No</label></span>
                    <div id="hidename14" style="display: none">
                        <label for="pt_where">If Yes, where?</label>
                        <span><input type="radio" name="pt_where" id="pt_where_home" value="Home" <?= ($wizardData->{'pt_where'} == 'Home') ? ' checked ' : ''; ?> /><label for="pt_where_home"><span></span> Home</label></span>
                        <span><input type="radio" name="pt_where" id="pt_where_school" value="School" <?= ($wizardData->{'pt_where'} == 'School') ? ' checked ' : ''; ?> /><label for="pt_where_school"><span></span> School</label></span>
                        <span><input type="radio" name="pt_where" id="pt_where_both" value="Both" <?= ($wizardData->{'pt_where'} == 'Both') ? ' checked ' : ''; ?> /><label for="pt_where_both"><span></span> Both</label></span>
                    </div>
                </section>
            </fieldset>
            <fieldset>
                <section>
                    <label for="mobi_details">Details of Mobility Concerns</label>
                    <textarea name="mobi_details" placeholder="Tone, strength, endurance"><?= !empty($wizardData->mobi_details) ? $wizardData->mobi_details : ''; ?></textarea>
                </section>
                <section>

                    <label for="orth">Orthotics?</label>
                    <span class="inline"><input type="radio" name="orth" id="orth" value="yes" onclick="showvalue305(this.value)" <?php echo!empty($wizardData->orth) ? ' checked ' : '' ?> /><label for="orth"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="orth" id="orth" value="" onclick="showvalue305(this.value)" <?php echo empty($wizardData->orth) ? ' checked ' : '' ?> /><label for="orth"><span></span> No</label></span>
                    <div id="hidename305">
                        <label for="pos_plan_desc">Type</label>
                        <input type="text" id="orth_desc" name="orth_desc" value="<?php echo $wizardData->orth_desc ?>" />
                    </div>
                    <label for="splint">Splints?</label>
                    <span class="inline"><input type="checkbox" name="splint_hand" id="splint_hand" value="Hand" <?= !empty($wizardData->{'splint_hand'}) ? ' checked ' : ''; ?> /><label for="splint_hand"><span></span> Hand</label></span>
                    <span class="inline"><input type="checkbox" name="splint_knee" id="splint_knee" value="Knee" <?= !empty($wizardData->{'splint_knee'}) ? ' checked ' : ''; ?> /><label for="splint_knee"><span></span> Knee</label></span>
                    <span class="inline"><input type="checkbox" name="splint_leg" id="splint_leg" value="Leg" <?= !empty($wizardData->{'splint_leg'}) ? ' checked ' : ''; ?> /><label for="splint_leg"><span></span> Leg</label></span>
                    <span class="inline"><input type="checkbox" name="splint_ankle" id="splint_ankle" value="Ankle" <?php echo!empty($wizardData->splint_ankle) ? ' checked ' : '' ?> /><label for="splint_ankle"><span></span> Ankle</label></span>

                    <label for="lift">Transfer/Lift Assistance?</label>
                    <span class="inline"><input type="checkbox" name="lift_one" id="lift_one" value="One Person" <?= !empty($wizardData->{'lift_one'}) ? ' checked ' : ''; ?> /><label for="lift_one"><span></span> One Person</label></span>
                    <span class="inline"><input type="checkbox" name="lift_two" id="lift_two" value="Two Person" <?= !empty($wizardData->{'lift_two'}) ? ' checked ' : ''; ?> /><label for="lift_two"><span></span> Two Person</label></span>
                    <span class="inline"><input type="checkbox" name="lift_hoyer" id="lift_hoyer" value="Hoyer" <?= !empty($wizardData->{'lift_hoyer'}) ? ' checked ' : ''; ?> /><label for="lift_hoyer"><span></span> Hoyer</label></span>
                </section>
            </fieldset>
            <fieldset class="twocol">
                <section>
                    <label for="pos_plan">Positioning Plan?</label>
                    <span class="inline"><input type="radio" name="pos_plan" id="pos_plan_y" onclick="showval5(this.value)" value="Yes" <?= !empty($wizardData->{'pos_plan'}) ? ' checked ' : ''; ?> /><label for="pos_plan_y"><span></span> Yes</label></span>
                    <span class="inline"><input type="radio" name="pos_plan" id="pos_plan_n" onclick="showval5(this.value)" value="" <?= empty($wizardData->{'pos_plan'}) ? ' checked ' : ''; ?> /><label for="pos_plan_n"><span></span> No</label></span>
                    <div id="hidename15">
                        <label for="pos_plan_desc">If Yes, describe</label>
                        <textarea id="pos_plan_desc" name="pos_plan_desc"><?= !empty($wizardData->pos_plan_desc) ? $wizardData->pos_plan_desc : ''; ?></textarea>
                    </div>
                </section>
                <section>
                    <label for="mobi_addtnl">Additional Comments</label>
                    <textarea id="mobi_addtnl" name="mobi_addtnl"><?= !empty($wizardData->mobi_addtnl) ? $wizardData->mobi_addtnl : ''; ?></textarea>
                </section>
            </fieldset>
        </div>
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
            $wiz04->sif = $this->session->userdata('sifnumberval');
            $wiz04->unique_number = $this->session->userdata('sifunique_number');
            if (!empty($reviewvalue)):
                echo anchor("health_appraisal/appraisal/complete_appraisal/" . $wiz04->sif . "/" . $wiz04->unique_number, "<button type='button' class='previous'>Go to final page</button>");
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
        var depend_assistchkbox = $('#vent_depend_assist').val();
        //alert(depend_assistchkbox);
        if (depend_assistchkbox == 'Ventilator Assist') {
            showvalue13();
        }
        //Autosave
        setInterval(function() {
            var queryString = $('#appraisal4').serialize();
            //alert(queryString);
            var baseurl = '<?php echo base_url(); ?>';
            //alert(baseurl);
            $.ajax({
                type: "POST",
                url: baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
            });
        }, 10000); // 10 seconds
        //Autosave end

        //if type checked 1


    })

</script>

<script type="text/javascript">
    function typechecked1()
    {

        //Tyep1
        if ($('#trach_type_o').is(":checked"))
            $("#suctiontype1").show();
        else
            $("#suctiontype1").hide();
        //Tyep2
        if ($('#trach_type_n').is(":checked"))
            $("#suctiontype2").show();
        else
            $("#suctiontype2").hide();
        //Tyep3
        if ($('#trach_type_e').is(":checked"))
            $("#suctiontype3").show();
        else
            $("#suctiontype3").hide();
    }
    $(document).ready(function() {

        $('#appraisal4').submit(function() {
            var $suction = $('input[name=suction]:checked', '#appraisal4').val();
            var $fields1 = $(this).find('input[name="trach_type_o"]:checked');
            var $fields2 = $(this).find('input[name="trach_type_n"]:checked');
            var $fields3 = $(this).find('input[name="trach_type_e"]:checked');
            if ($suction == "Yes" && !$fields1.length && !$fields2.length && !$fields3.length) {
                $('.errorchk').remove();
                $('#chkerror').append("<span class='errorchk'>Error: " + "You must check at least one type" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk').remove();
                return true;
            }
        });

        //Validation for Respiratory Assessment
        $('#appraisal4').submit(function() {
//            var ckbox = ($('input[name=hide12]:checked', '#appraisal4').val());
            //ckbox != 'on'
            var $fields3 = $(this).find('input[name="resp_assess_continuous"]:checked');
            var $fields4 = $(this).find('input[name="resp_assess_intermittant"]:checked');
            var $fields5 = $(this).find('input[name="resp_assess_signal"]:checked');
            var $fields6 = $(this).find('input[name="hide12"]:checked');
            if (!$fields3.length && !$fields4.length && !$fields5.length && !$fields6.length) {
                $('.errorchk2').remove();
                $('#chkerror2').append("<span class='errorchk2'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk2').remove();
                return true;
            }
        });


        //Validation for Respiratory Assessment Oropharyngeal
        $('#appraisal4').submit(function() {
            var ckbox = ($('input[name=hide12]:checked', '#appraisal4').val());
            var $suction = $('input[name=suction]:checked', '#appraisal4').val();
            var $fields1 = $(this).find('input[name="cath_y"]:checked');
            var $fields2 = $(this).find('input[name="cath_f"]:checked');
            var $fields3 = $(this).find('input[name="trach_type_o"]:checked');
            if ($suction == "Yes" && ckbox != 'on' && !$fields3.lendth && $fields1.length == 0 && $fields2.length == 0) {
                $('.errorchk7').remove();
                $('#oerror').append("<span class='errorchk7'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk7').remove();
                return true;
            }
        });
        //Validation for Respiratory Assessment Nasopharyngeal
        $('#appraisal4').submit(function() {
            var ckbox = ($('input[name=hide12]:checked', '#appraisal4').val());
            var $suction = $('input[name=suction]:checked', '#appraisal4').val();
            var $fields1 = $(this).find('input[name="cath_y2"]:checked');
            var $fields2 = $(this).find('input[name="cath_f2"]:checked');
            var $fields3 = $(this).find('input[name="trach_type_n"]:checked');
            if ($suction == "Yes" && ckbox != 'on' && !$fields3.lendth && $fields1.length == 0 && $fields2.length == 0) {
                $('.errorchk8').remove();
                $('#nerror').append("<span class='errorchk8'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk8').remove();
                return true;
            }
        });
        //Validation for Respiratory Assessment Endotracheal
        $('#appraisal4').submit(function() {
            var ckbox = ($('input[name=hide12]:checked', '#appraisal4').val());
            var $suction = $('input[name=suction]:checked', '#appraisal4').val();
            var $fields1 = $(this).find('input[name="cath_y3"]:checked');
            var $fields2 = $(this).find('input[name="cath_f3"]:checked');
            var $fields3 = $(this).find('input[name="trach_type_e"]:checked');
            if ($suction == "Yes" && ckbox != 'on' && !$fields3.lendth && $fields1.length == 0 && $fields2.length == 0) {
                $('.errorchk9').remove();
                $('#eerror').append("<span class='errorchk9'>Error: " + "You must check at least one" + "</span>");
                return false; // The form will *not* submit
            }
            else {
                $('.errorchk9').remove();
                return true;
            }
        });


    });


</script>