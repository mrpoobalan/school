<style>
    select{
        width:auto!important;
    }
    .error{
        color: red;
    }
</style>

<?php // load dashboard admin menu 
$this->load->view("menu/top_menu");
if(empty($wizardData->sif)):
    $wizardData = $autosave;
endif;
//echo '<pre>';
//print_r($wizardData);
//echo '</pre>';
//exit;
$attr_FormSubmit_appraisal = array('class'=>'save', 'id' =>'appraisal5', 'name' =>'appraisal5', 'value'=>'Next', 'type'=>'submit');
$attr_FormSave_appraisal = array('id' =>'appraisal', 'name' =>'appraisal_save', 'value'=>'Save & Exit', 'type'=>'submit');
$attr_FormOpen = array('id'=>"appraisal5",'class'=>"healthform");
$sif = array('name' => 'sif', 'type'=>'hidden');

// setup values for all checkboxes
if($wizardData)
{
	$checkboxFields = array();

	foreach($checkboxFields as $field)
	{
		if(property_exists($wizardData,$field) && is_array($wizardData->{$field}))
		{
			foreach($wizardData->{$field} as $key=>$selectedValue)
			{
				$selectedValue = strtolower($selectedValue);
				$wizardData->$selectedValue = $selectedValue;
			}
		}
	}
}

?>

<section class="page">
<h1><?= $subtitle ?></h1>
<?= form_open("{$action}", $attr_FormOpen); ?>
		<fieldset class="new-section">
			<span class="inline hide"><input type="checkbox" onclick="hideSection(37)" id="hide37"  /> <label for="hide37"><span></span>Not Applicable</label></span>
			<legend  for="elimination_requirements">Elimination Requirements</legend>
			<div class="hide37">
				<section class="clear">
					<span class="inline"><input type="checkbox" name="elimination_independent" value="Independent" id="elimination_independent" <?= !empty($wizardData->{'elimination_independent'})? ' checked ':'';  ?> /> <label for="elimination_independent"><span></span>Independent</label></span>
					<span class="inline"><input type="checkbox" name="elimination_scheduled" value="Scheduled" id="elimination_scheduled" <?= !empty($wizardData->{'elimination_scheduled'})? ' checked ':'';  ?> /> <label for="elimination_scheduled"><span></span>Scheduled</label></span>
					<span class="inline"><input type="checkbox" name="elimination_prompted" value="Prompted" id="elimination_prompted" <?= !empty($wizardData->{'elimination_prompted'})? ' checked ':'';  ?> /> <label for="elimination_prompted"><span></span>Prompted</label></span>
					<span class="inline"><input type="checkbox" name="elimination_diapered" value="Diapered" id="elimination_diapered" <?= !empty($wizardData->{'elimination_diapered'})? ' checked ':'';  ?> /> <label for="elimination_diapered"><span></span>Diapered</label></span>
				</section>
				<div style="clear:both"></div>
				<section class="threecol">
					<label for="continence">Continence</label>
					<span><input type="checkbox" name="continence_continent" value="Continent" id="continence_continent" <?= !empty($wizardData->{'continence_continent'})? ' checked ':'';  ?> /><label for="continence_continent"><span></span> Continent</label></span>
					<span><input type="checkbox" name="continence_incontinent_bowel" value="Incontinent _ Bowel" id="continence_incontinent_bowel" <?= !empty($wizardData->{'continence_incontinent_bowel'})? ' checked ':'';  ?> /><label for="continence_incontinent_bowel"><span></span> Incontinent - Bowel</label></span>
					<span><input type="checkbox" name="continence_incontinent_bladder" value="Incontinent _ Bladder" id="continence_incontinent_bladder" <?= !empty($wizardData->{'continence_incontinent_bladder'})? ' checked ':'';  ?> /><label for="continence_incontinent_bladder"><span></span> Incontinent - Bladder</label></span>
				</section>
				<section class="threecol">
					<label for="toilet_type">How Student is Toileted</label>
					<span><input type="checkbox" name="toilet_toilet" value="Toilet" id="toilet_toilet" <?= !empty($wizardData->{'toilet_toilet'})? ' checked ':'';  ?> /><label for="toilet_toilet"><span></span> Toilet</label></span>
					<span><input type="checkbox" name="toilet_changing_table" value="Changing Table" id="toilet_changing_table" <?= !empty($wizardData->{'toilet_changing_table'})? ' checked ':'';  ?> /><label for="toilet_changing_table"><span></span> Changing Table</label></span>
					<span><input type="checkbox" name="toilet_commode" value="Commode" id="toilet_commode" <?= !empty($wizardData->{'toilet_commode'})? ' checked ':'';  ?>/><label for="toilet_commode"><span></span> Commode</label></span>
					<span><input type="checkbox" name="toilet_other" value="Other" id="toilet_other" <?= !empty($wizardData->{'toilet_other'})? ' checked ':'';  ?> /><label for="toilet_other"><span></span> Other</label></span>
					<input type="text" id="other_toilet" name="other_toilet" placeholder="enter other" value="<?= !empty($wizardData->other_toilet)? $wizardData->other_toilet : '';  ?>" />
				</section>
				<section class="">
					<label for="toileted">Where Student is Toileted</label>
					<span><input type="checkbox" name="toileted_inhr" value="In HR" id="toileted_inhr" <?= !empty($wizardData->{'toileted_inhr'})? ' checked ':'';  ?> /><label for="toileted_inhr"><span></span> In HR</label></span>
					<span><input type="checkbox" name="toileted_bath" value="In Bathroom" id="toileted_bath" <?= !empty($wizardData->{'toileted_bath'})? ' checked ':'';  ?> /><label for="toileted_bath"><span></span> In Bathroom</label></span>
					<span><input type="checkbox" name="toileted_other" value="Other" id="toileted_other" <?= !empty($wizardData->{'toileted_other'})? ' checked ':'';  ?>/><label for="toileted_other"><span></span> Other</label></span>
					<input type="text" id="toileted_other_desc" name="toileted_other_desc" placeholder="Enter Other" value="<?= !empty($wizardData->toileted_other_desc)? $wizardData->toileted_other_desc : '';  ?>" />
				</section>
				<div style="clear:both"></div>
			<fieldset>
				<section class="">
					<label for="regime">Bowel Regime</label>
					<span class="inline"><input type="radio" name="regime" id="regime_yes" value="Yes" <?= !empty($wizardData->{'regime'})? ' checked ':'';  ?> /><label for="regime_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="regime" id="regime_no" value="" <?= empty($wizardData->{'regime'})? ' checked ':'';  ?> /><label for="regime_no"><span></span> No</label></span>
				</section>
				<section>
					<label for="constipation">History of Constipation?</label>
					<span class="inline"><input type="radio" name="constipation" id="constipation_yes" value="Yes" <?= !empty($wizardData->{'constipation'})? ' checked ':'';  ?> /><label for="constipation_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="constipation" id="constipation_no" value="" <?= empty($wizardData->{'constipation'})? ' checked ':'';  ?> /><label for="constipation_no"><span></span> No</label></span>
				<label for="constipation_mgmnt">Management</label>
					<textarea id="constipation_mgmnt" name="constipation_mgmnt"><?= !empty($wizardData->constipation_mgmnt)? $wizardData->constipation_mgmnt : '';  ?></textarea>
                </section>
				<section  class="clear threecol">
					<label for="colostomy">Colostomy?</label>
					<span class="inline"><input type="radio" name="colostomy" id="colostomy_yes" value="Yes" <?= !empty($wizardData->{'colostomy'})? ' checked ':'';  ?> /><label for="colostomy_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="colostomy" id="colostomy_no" value="" <?= empty($wizardData->{'colostomy'})? ' checked ':'';  ?>/><label for="colostomy_no"><span></span> No</label></span>
					<label for="colostomy_mgmnt">Management</label>
					<textarea id="colostomy_mgmnt" name="colostomy_mgmnt" ><?= !empty($wizardData->colostomy_mgmnt)? $wizardData->colostomy_mgmnt : '';  ?></textarea>
				</section>
				<section>
					<label for="bladder">Bladder Regime?</label>
					<span class="inline"><input type="radio" name="bladder" id="bladder_yes" value="Yes" <?= !empty($wizardData->{'bladder'})? ' checked ':'';  ?> /><label for="bladder_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="bladder" id="bladder_no" value="" <?= empty($wizardData->{'bladder'})? ' checked ':'';  ?> /><label for="bladder_no"><span></span> No</label></span>
					<label for="bladder_mgmnt">Management</label>
					<textarea id="bladder_mgmnt" name="bladder_mgmnt"><?= !empty($wizardData->bladder_mgmnt)? $wizardData->bladder_mgmnt : '';  ?></textarea>
				</section>
			</fieldset>
			<fieldset  class="">	
				<section>
					<label for="catheter">Urinary Catheterization?</label>
					<span class="inline"><input type="radio" name="catheter" id="catheter_yes" value="Yes" <?= !empty($wizardData->{'elimination_diapered'})? ' checked ':'';  ?> /><label for="catheter_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="catheter" id="catheter_no" value="" <?= empty($wizardData->{'elimination_diapered'})? ' checked ':'';  ?> /><label for="catheter_no"><span></span> No</label></span>
					
					<label for="self_catheter">Self-Catheterization?</label>
					<span class="inline"><input type="radio" name="self_catheter" id="self_catheter_yes" value="Yes" <?= !empty($wizardData->{'self_catheter'})? ' checked ':'';  ?> /><label for="self_catheter_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="self_catheter" id="self_catheter_no" value="" <?= empty($wizardData->{'self_catheter'})? ' checked ':'';  ?> /><label for="self_catheter_no"><span></span> No</label></span>
				
					<label for="cath_size">Catheter Size</label>
					<input type="text" id="cath_size" name="cath_size" value="<?= !empty($wizardData->cath_size) ? $wizardData->cath_size : '';  ?>" />

					<label for="cath_freq">Frequency</label>
					<input type="text" id="cath_freq" name="cath_freq" value="<?= !empty($wizardData->cath_freq)? $wizardData->cath_freq : '';  ?>" />
                    
                    <label for="stoma">Stoma?</label>
					<span class="inline"><input type="radio" name="stoma" id="stoma_yes" value="Yes" <?= !empty($wizardData->{'stoma'})? ' checked ':'';  ?> /><label for="stoma_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="stoma" id="stoma_no" value="" <?= empty($wizardData->{'stoma'})? ' checked ':'';  ?> /><label for="stoma_no"><span></span> No</label></span>
				</section>
				
				<section>
					<label for="menstruation">Menstruation?</label>
					<span class="inline"><input type="radio" name="menstruation" id="menstruation_yes" value="Yes" <?= !empty($wizardData->{'menstruation'})? ' checked ':'';  ?> /><label for="menstruation_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="menstruation" id="menstruation_no" value="" <?= empty($wizardData->{'menstruation'})? ' checked ':'';  ?> /><label for="menstruation_no"><span></span> No</label></span>
				
					<label for="menstruation_mgmt">Management</label>
					<textarea id="menstruation_mgmt" name="menstruation_mgmt"><?= !empty($wizardData->menstruation_mgmt)? $wizardData->menstruation_mgmt : '';  ?></textarea>
				</section>

				<section>
					<label for="diabetic">Diabetic Student?</label>
					<span class="inline"><input type="radio" name="diabetic" id="diabetic_yes" value="Yes" <?= !empty($wizardData->{'diabetic'})? ' checked ':'';  ?> /><label for="diabetic_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="diabetic" id="diabetic_no" value="" <?= empty($wizardData->{'diabetic'})? ' checked ':'';  ?> /><label for="diabetic_no"><span></span> No</label></span>
					
					<label for="br_privileges">Liberal Bathroom Privileges?</label>
					<span class="inline"><input type="radio" name="br_privileges" id="br_privileges_yes" value="Yes" <?= !empty($wizardData->{'br_privileges'})? ' checked ':'';  ?> /><label for="br_privileges_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="br_privileges" id="br_privileges_no" value=""  <?= empty($wizardData->{'br_privileges'})? ' checked ':'';  ?>/><label for="br_privileges_no"><span></span> No</label></span>
				</section>
				<section class="largetext">
					<label for="elimination_addtnl">Additional Comments</label>
					<textarea id="elimination_addtnl" name ="elimination_addtnl"><?= !empty($wizardData->elimination_addtnl)? $wizardData->elimination_addtnl : '';  ?></textarea>
				</section>

			</fieldset>
			</div>
		</fieldset>
		<fieldset class="new-section">
			<span class="inline hide"><input type="checkbox" onclick="hideSection(38)" id="hide38"  /> <label for="hide38"><span></span>Not Applicable</label></span>
			<legend>Cardiac Requirements</legend>
			<div class="hide38">
				<section class="largetext">
					<label for="cardiac_history">Cardiac History</label>
					<textarea id="cardiac_history" name="cardiac_history"><?= !empty($wizardData->cardiac_history)? $wizardData->cardiac_history : '';  ?></textarea>
				</section>
				<fieldset class=" clear threecol">
					<section>
						<label for="restrictions">Restrictions?</label>
						<span class="inline"><input type="radio" name="restrictions" id="restrictions_yes" onclick="showval6(this.value)" value="Yes" <?= !empty($wizardData->{'restrictions'})? ' checked ':'';  ?> /><label for="restrictions_yes" ><span></span> Yes</label></span>
						<span class="inline"><input type="radio" name="restrictions" id="restrictions_no" onclick="showval6(this.value)"  value="" <?= empty($wizardData->{'restrictions'})? ' checked ':'';  ?> /><label for="restrictions_no" ><span></span> No</label></span>
                                                <div id="hidename16" style="display: none">
                                                <label for="restrict_list">If yes, please list:</label>
						<textarea id="restrict_list" name ="restrict_list"><?= !empty($wizardData->restrict_list)? $wizardData->restrict_list : '';  ?></textarea>
						</div>
                                                <label for="baseline">Baseline Vital Signs</label>
						<textarea id="baseline" name="baseline"><?= !empty($wizardData->baseline)? $wizardData->baseline : '';  ?></textarea>
                                                
                                        </section>
					<section>
						<label for="distress">Symptoms of Distress</label>
						<span><input type="checkbox" name="distress_pain" id="distress_pain" value="Chest Pain/Tightness" <?= !empty($wizardData->{'distress_pain'})? ' checked ':'';  ?> /><label for="distress_pain"><span></span> Chest Pain/Tightness</label></span>
						<span><input type="checkbox" name="distress_breath" id="distress_breath" value="Shortness of Breath" <?= !empty($wizardData->{'distress_breath'})? ' checked ':'';  ?> /><label for="distress_breath"><span></span> Shortness of Breath</label></span>
						<span><input type="checkbox" name="distress_palpitations" id="distress_palpitations" value="Palpitations" <?= !empty($wizardData->{'distress_palpitations'})? ' checked ':'';  ?> /><label for="distress_palpitations"><span></span> Palpitations</label></span>
						<span><input type="checkbox" name="distress_diaphoresis" id="distress_diaphoresis" value="Diaphoresis" <?= !empty($wizardData->{'distress_diaphoresis'})? ' checked ':'';  ?> /><label for="distress_diaphoresis"><span></span> Diaphoresis</label></span>
						<span><input type="checkbox" name="distress_fatigue" id="distress_fatigue" value="Fatigue" <?= !empty($wizardData->{'distress_fatigue'})? ' checked ':'';  ?> /><label for="distress_fatigue"><span></span> Fatigue</label></span>
						<span><input type="checkbox" name="distress_dyspnea" id="distress_dyspnea" value="Dyspnea on Exertion" <?= !empty($wizardData->{'distress_dyspnea'})? ' checked ':'';  ?> /><label for="distress_dyspnea"><span></span> Dyspnea on Exertion</label></span>
						<span><input type="checkbox" name="distress_fainting" id="distress_fainting" value="Fainting" <?= !empty($wizardData->{'distress_fainting'})? ' checked ':'';  ?> /><label for="distress_fainting"><span></span> Fainting</label></span>
						<span><input type="checkbox" name="distress_other" id="distress_other" value="Other" <?= !empty($wizardData->{'distress_other'})? ' checked ':'';  ?> /><label for="distress_other"><span></span> Other</label></span>
						<input type="text" id="symptom_other" name="symptom_other" placeholder="enter other symptom" value="<?= !empty($wizardData->symptom_other)? $wizardData->symptom_other : '';  ?>" />
					</section>
					<section>
						<label for="pacemaker">Pacemaker?</label>
						<span class="inline"><input type="radio" name="pacemaker" id="pacemaker_yes" value="Yes" <?= !empty($wizardData->{'pacemaker'})? ' checked ':'';  ?> /><label for="pacemaker_yes"><span></span> Yes</label></span>
						<span class="inline"><input type="radio" name="pacemaker" id="pacemaker_no" value="" <?= empty($wizardData->{'pacemaker'})? ' checked ':'';  ?> /><label for="pacemaker_no"><span></span> No</label></span>

						<label for="defib">Internal Defibrillator?</label>
						<span class="inline"><input type="radio" name="defib" id="defib_yes" value="Yes" <?= !empty($wizardData->{'defib'})? ' checked ':'';  ?> /><label for="defib_yes"><span></span> Yes</label></span>
						<span class="inline"><input type="radio" name="defib" id="defib_no" value="" <?= empty($wizardData->{'defib'})? ' checked ':'';  ?> /><label for="defib_no"><span></span> No</label></span>

						<label for="aed">Personal AED?</label>
						<span class="inline"><input type="radio" name="aed" id="aed_yes" value="Yes" <?= !empty($wizardData->{'aed'})? ' checked ':'';  ?> /><label for="aed_yes"><span></span> Yes</label></span>
						<span class="inline"><input type="radio" name="aed" id="aed_no" value="" <?= empty($wizardData->{'aed'})? ' checked ':'';  ?> /><label for="aed_no"><span></span> No</label></span>
					</section>
				</fieldset>
				<fieldset>
					<section>
						<label for="skin_color">Baseline Skin Color</label>
						<span><input type="checkbox" name="skin_color_normal" id="skin_color_normal" value="Normal" <?= !empty($wizardData->{'skin_color_normal'})? ' checked ':'';  ?> /><label for="skin_color_normal"><span></span> Normal</label></span>
						<span><input type="checkbox" name="skin_color_cyanosis" id="skin_color_cyanosis" value="Cyanosis" <?= !empty($wizardData->{'skin_color_cyanosis'})? ' checked ':'';  ?> /><label for="skin_color_cyanosis"><span></span> Cyanosis</label></span>
						<span><input type="checkbox" name="skin_color_jaundice" id="skin_color_jaundice" value="Jaundice" <?= !empty($wizardData->{'skin_color_jaundice'})? ' checked ':'';  ?> /><label for="skin_color_jaundice"><span></span> Jaundice</label></span>
						<span><input type="checkbox" name="skin_color_pallor" id="skin_color_pallor" value="Pallor" <?= !empty($wizardData->{'skin_color_pallor'})? ' checked ':'';  ?> /><label for="skin_color_pallor"><span></span> Pallor</label></span>
						<span><input type="checkbox" name="skin_color_erythema" id="skin_color_erythema" value="Erythema" <?= !empty($wizardData->{'skin_color_erythema'})? ' checked ':'';  ?> /><label for="skin_color_erythema"><span></span> Erythema</label></span>
						<span><input type="checkbox" name="skin_color_other" id="skin_color_other" value="Other" <?= !empty($wizardData->{'skin_color_other'})? ' checked ':'';  ?> /><label for="skin_color_other"><span></span> Other</label></span>
						<input type="text" id="skin_color_other" name="skin_color_other" placeholder="enter other skin color" value="<?= !empty($wizardData->skin_color_other)? $wizardData->skin_color_other : '';  ?>" />
					</section>
					<section>
						<label for="cardiac_addtnl">Additional Comments</label>
						<textarea id="cardiac_addtnl" name="cardiac_addtnl"><?= !empty($wizardData->cardiac_addtnl)? $wizardData->cardiac_addtnl : '';  ?></textarea>
					</section>
				</fieldset>
			</div>
		</fieldset>
		<fieldset class="new-section">
			<span class="inline hide"><input type="checkbox" onclick="hideSection(39)" id="hide39"  /> <label for="hide39"><span></span>Not Applicable</label></span>
			<legend>Respiratory Requirements</legend>
			<div class="hide39">
				<fieldset>
				<section>
					<label for="asthma">Asthma?</label>
                                        <span class="inline"><input type="radio" id="asthma_yes" value="Yes" onclick="showval7(this.value)" name="asthma" <?= !empty($wizardData->{'asthma'})? ' checked ':'';  ?> /><label for="asthma_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" id="asthma_no" value=""  onclick="showval7(this.value)" name="asthma" <?= empty($wizardData->{'asthma'})? ' checked ':'';  ?> /><label for="asthma_no"><span></span> No</label></span>
                                        <div id="hidename17">
					<label for="other_diagnosis">If not asthma, what is the diagnosis?</label>
					<input type="text" id="other_diagnosis" name="other_diagnosis" value="<?= !empty($wizardData->other_diagnosis)? $wizardData->other_diagnosis : '';  ?>" />
                                        </div>
					<label id="diagnosis_age">Age Diagnosed</label>
					<input type="text" id="diagnosis_age" name="diagnosis_age" value="<?= !empty($wizardData->diagnosis_age)? $wizardData->diagnosis_age : '';  ?>" />
				</section>
				<section>
					<label for="last_year">Symptoms in the last 12 months?</label>
					<span class="inline"><input type="radio" id="last_year_yes" value="Yes" name="last_year" <?= !empty($wizardData->{'last_year'})? ' checked ':'';  ?> /><label for="last_year_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" id="last_year_no" value="" name="last_year" <?= empty($wizardData->{'last_year'})? ' checked ':'';  ?> /><label for="last_year_no"><span></span> No</label></span>
					
					<label for="meds_last_year">Needed to use medication in the last 12 months?</label>
					<span class="inline"><input type="radio" id="meds_last_year_yes" value="Yes" name="meds_last_year" <?= !empty($wizardData->{'meds_last_year'})? ' checked ':'';  ?> /><label for="meds_last_year_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" id="meds_last_year_no" value="" name="meds_last_year" <?= empty($wizardData->{'meds_last_year'})? ' checked ':'';  ?> /><label for="meds_last_year_no"><span></span> No</label></span>

					<label for="doctor_last_year">Seen by health care provider in the last 12 months?</label>
					<span class="inline"><input type="radio" id="doctor_last_year_yes" value="Yes" name="doctor_last_year" <?= !empty($wizardData->{'doctor_last_year'})? ' checked ':'';  ?> /><label for="doctor_last_year_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" id="doctor_last_year_no" value="" name="doctor_last_year" <?= empty($wizardData->{'doctor_last_year'})? ' checked ':'';  ?> /><label for="doctor_last_year_no"><span></span> No</label></span>

					<label for="ed_last_year">ED visit(s) and/or hospitalizations in the last 12 months?</label>
                                        <span class="inline"><input type="radio" id="ed_last_year_yes" onclick="showval8(this.value)" value="Yes" name="ed_last_year" <?= !empty($wizardData->{'ed_last_year'})? ' checked ':'';  ?>  /><label for="ed_last_year_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" id="ed_last_year_no" onclick="showval8(this.value)" value="" name="ed_last_year" <?= empty($wizardData->{'ed_last_year'})? ' checked ':'';  ?> /><label for="ed_last_year_no"><span></span> No</label></span>
                                        <div id="hidename18">
					<label for="num_ed_visits">If yes, how many?</label>
					<span class="inline"><input type="radio" id="num_ed_visits_1" value="1" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'} == '1')? ' checked ':'';  ?>/><label for="num_ed_visits_1"><span></span> 1</label></span>
					<span class="inline"><input type="radio" id="num_ed_visits_2" value="2" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'}  == '2')? ' checked ':'';  ?>/><label for="num_ed_visits_2"><span></span> 2</label></span>
					<span class="inline"><input type="radio" id="num_ed_visits_3" value="3" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'}  == '3')? ' checked ':'';  ?>/><label for="num_ed_visits_3"><span></span> 3</label></span>
					<span class="inline"><input type="radio" id="num_ed_visits_4" value="4" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'}  == '4')? ' checked ':'';  ?>/><label for="num_ed_visits_4"><span></span> 4</label></span>
					<span class="inline"><input type="radio" id="num_ed_visits_5" value="5 or more" name="num_ed_visits" <?= ($wizardData->{'num_ed_visits'}  == '5')? ' checked ':'';  ?>/><label for="num_ed_visits_5"><span></span> 5 or more</label></span>
                                        </div>
                                </section>
				</fieldset>
				<fieldset>
				<section>
					<label for="triggers">Triggers</label>
					<span><input type="checkbox" id="triggers_smoke" value="Smoke" name="triggers_smoke" <?= !empty($wizardData->{'triggers_smoke'})? ' checked ':'';  ?>/><label for="triggers_smoke"><span></span> Smoke</label></span>
					<span><input type="checkbox" id="triggers_animals" value="Animals" name="triggers_animals" <?= !empty($wizardData->{'triggers_animals'})? ' checked ':'';  ?>/><label for="triggers_animals"><span></span> Animals</label></span>
					<span><input type="checkbox" id="triggers_dust" value="Dust" name="triggers_dust" <?= !empty($wizardData->{'triggers_dust'})? ' checked ':'';  ?>/><label for="triggers_dust"><span></span> Dust</label></span>
					<span><input type="checkbox" id="triggers_colds" value="Colds/Illness" name="triggers_colds" <?= !empty($wizardData->{'triggers_colds'})? ' checked ':'';  ?>/><label for="triggers_colds"><span></span> Colds/Illness</label></span>
					<span><input type="checkbox" id="triggers_weather" value="Changes in Weather" name="triggers_weather" <?= !empty($wizardData->{'triggers_weather'})? ' checked ':'';  ?>/><label for="triggers_weather"><span></span> Changes in Weather</label></span>
					<span><input type="checkbox" id="triggers_exercise" value="Exercise" name="triggers_exercise" <?= !empty($wizardData->{'triggers_exercise'})? ' checked ':'';  ?>/><label for="triggers_exercise"><span></span> Exercise</label></span>
					<span><input type="checkbox" id="triggers_mold" value="Mold" name="triggers_mold" <?= !empty($wizardData->{'triggers_mold'})? ' checked ':'';  ?>/><label for="triggers_mold"><span></span> Mold</label></span>
					<span><input type="checkbox" id="triggers_grass" value="Grass/Pollen" name="triggers_grass" <?= !empty($wizardData->{'triggers_grass'})? ' checked ':'';  ?>/><label for="triggers_grass"><span></span> Grass/Pollen</label></span>
					<span><input type="checkbox" id="triggers_perfumes" value="Perfumes/Smells" name="triggers_perfumes"<?= !empty($wizardData->{'triggers_perfumes'})? ' checked ':'';  ?> /><label for="triggers_perfumes"><span></span> Perfumes/Smells</label></span>
					<span><input type="checkbox" id="triggers_stress" value="Stress" name="triggers_stress" <?= !empty($wizardData->{'triggers_stress'})? ' checked ':'';  ?>/><label for="triggers_stress"><span></span> Stress</label></span>
					<span><input type="checkbox" id="triggers_food" value="Food" name="triggers_food" <?= !empty($wizardData->{'triggers_food'})? ' checked ':'';  ?>/><label for="triggers_food"><span></span> Food</label></span>
					<span><input type="checkbox" id="triggers_other" value="Other" name="triggers_other" <?= !empty($wizardData->{'triggers_other'})? ' checked ':'';  ?>/><label for="triggers_other"><span></span> Other</label></span>
					<input type="text" id="other_trigger" placeholder="enter other trigger" name="other_trigger" value="<?= !empty($wizardData->other_trigger)? $wizardData->other_trigger : '';  ?>" />
				</section>
				<section>
					<label for="usual_symptoms">Usual Symptoms</label>
					<span><input type="checkbox" id="usual_symptoms_wheezing" value="Wheezing" name="usual_symptoms_wheezing" <?= !empty($wizardData->{'usual_symptoms_wheezing'})? ' checked ':'';  ?>/><label for="usual_symptoms_wheezing"><span></span> Wheezing</label></span>
					<span><input type="checkbox" id="usual_symptoms_breath" value="Shortness of Breath" name="usual_symptoms_breath" <?= !empty($wizardData->{'usual_symptoms_breath'})? ' checked ':'';  ?>/><label for="usual_symptoms_breath"><span></span> Shortness of Breath</label></span>
					<span><input type="checkbox" id="usual_symptoms_breathing" value="Difficulty Breathing" name="usual_symptoms_breathing" <?= !empty($wizardData->{'usual_symptoms_breathing'})? ' checked ':'';  ?>/><label for="usual_symptoms_breathing"><span></span> Difficulty Breathing</label></span>
					<span><input type="checkbox" id="usual_symptoms_throat" value="Itchy Throat" name="usual_symptoms_throat" <?= !empty($wizardData->{'usual_symptoms_throat'})? ' checked ':'';  ?>/><label for="usual_symptoms_throat"><span></span> Itchy Throat</label></span>
					<span><input type="checkbox" id="usual_symptoms_cough" value="Coughing" name="usual_symptoms_cough" <?= !empty($wizardData->{'usual_symptoms_cough'})? ' checked ':'';  ?>/><label for="usual_symptoms_cough"><span></span> Coughing</label></span>
					<span><input type="checkbox" id="usual_symptoms_chest" value="Chest Tightness" name="usual_symptoms_chest" <?= !empty($wizardData->{'usual_symptoms_chest'})? ' checked ':'';  ?>/><label for="usual_symptoms_chest"><span></span> Chest Tightness</label></span>
					<span><input type="checkbox" id="usual_symptoms_irritability" value="Irritability" name="usual_symptoms_irritability" <?= !empty($wizardData->{'usual_symptoms_irritability'})? ' checked ':'';  ?>/><label for="usual_symptoms_irritability"><span></span> Irritability</label></span>
					<span><input type="checkbox" id="usual_symptoms_waking" value="Waking at Night" name="usual_symptoms_waking" <?= !empty($wizardData->{'usual_symptoms_waking'})? ' checked ':'';  ?>/><label for="usual_symptoms_waking"><span></span> Waking at Night</label></span>
					<span><input type="checkbox" id="usual_symptoms_stomachache" value="Stomachache" name="usual_symptoms_stomachache" <?= !empty($wizardData->{'usual_symptoms_stomachache'})? ' checked ':'';  ?>/><label for="usual_symptoms_stomachache"><span></span> Stomach Ache</label></span>
					<span><input type="checkbox" id="usual_symptoms_other" value="Other" name="usual_symptoms_other" <?= !empty($wizardData->{'usual_symptoms_other'})? ' checked ':'';  ?>/><label for="usual_symptoms_other"><span></span> Other</label></span>
					<input type="text" id="other_usual_symptoms" name="other_usual_symptoms" placeholder="enter other symptom" value="<?= !empty($wizardData->other_usual_symptoms)? $wizardData->other_usual_symptoms : '';  ?>" />
				</section>
				<section>
					<label for="day_symptoms">Symptoms During the Day <span class="tiny">(in the past month)</span></label>
					<span><input type="checkbox" id="day_symptoms_none" value="None" name="day_symptoms_none" <?= !empty($wizardData->{'day_symptoms_none'})? ' checked ':'';  ?> /><label for="day_symptoms_none"><span></span> None</label></span>
					<span><input type="checkbox" id="day_symptoms_twice" value="2x/week or less" name="day_symptoms_twice" <?= !empty($wizardData->{'day_symptoms_twice'})? ' checked ':'';  ?> /><label for="day_symptoms_twice"><span></span> 2x/week or less</label></span>
					<span><input type="checkbox" id="day_symptoms_twiceplus" value="More than 2x/week" name="day_symptoms_twiceplus" <?= !empty($wizardData->{'day_symptoms_twiceplus'})? ' checked ':'';  ?> /><label for="day_symptoms_twiceplus"><span></span> More than 2x/week</label></span>
					<span><input type="checkbox" id="day_symptoms_always" value="Every Day" name="day_symptoms_always" <?= !empty($wizardData->{'day_symptoms_always'})? ' checked ':'';  ?> /><label for="day_symptoms_always"><span></span> Every Day</label></span>

					<label for="night_symptoms">Symptoms at Night <span class="tiny">(in the past month)</span></label>
					<span><input type="checkbox" id="night_symptoms_none" value="None" name="night_symptoms_none" <?= !empty($wizardData->{'night_symptoms_none'})? ' checked ':'';  ?> /><label for="night_symptoms_none"><span></span> None</label></span>
					<span><input type="checkbox" id="night_symptoms_twice" value="2x/week or less" name="night_symptoms_twice" <?= !empty($wizardData->{'night_symptoms_twice'})? ' checked ':'';  ?> /><label for="night_symptoms_twice"><span></span> 2x/week or less</label></span>
					<span><input type="checkbox" id="night_symptoms_twiceplus" value="More than 2x/week" name="night_symptoms_twiceplus" <?= !empty($wizardData->{'night_symptoms_twiceplus'})? ' checked ':'';  ?> /><label for="night_symptoms_twiceplus"><span></span> More than 2x/week</label></span>
					<span><input type="checkbox" id="night_symptoms_always" value="Every Night" name="night_symptoms_always" <?= !empty($wizardData->{'night_symptoms_always'})? ' checked ':'';  ?> /><label for="night_symptoms_always"><span></span> Every Night</label></span>

					<label for="season">Symptoms most likely occur in</label>
					<div class="col_one">
					<span><input type="checkbox" name="season_fall" id="season_fall" value="Fall"  <?= !empty($wizardData->{'season_fall'})? ' checked ':'';  ?> /><label for="season_fall"><span></span> Fall</label></span>
					<span><input type="checkbox" name="season_winter" id="season_winter" value="Winter" <?= !empty($wizardData->{'season_winter'})? ' checked ':'';  ?> /><label for="season_winter"><span></span> Winter</label></span>
					</div>
					<div class="col_two">
					<span><input type="checkbox" name="season_spring" id="season_spring" value="Spring" <?= !empty($wizardData->{'season_spring'})? ' checked ':'';  ?> /><label for="season_spring"><span></span> Spring</label></span>
					<span><input type="checkbox" name="season_summer" id="season_summer" value="Summer" <?= !empty($wizardData->{'season_summer'})? ' checked ':'';  ?> /><label for="season_summer"><span></span> Summer</label></span>
				</div>
				</section>
				</fieldset>
				<fieldset>
				<section class="largetext">
					<label for="pe">Have symptoms ever prevented student from participating in PE, Recess, Sports, or Other Activites?</label>
                                        <span class="inline"><input type="radio" name="pe" onclick="showval9(this.value)" id="pe_yes" value="Yes" <?= !empty($wizardData->{'pe'})? ' checked ':'';  ?> /><label for="pe_yes"><span></span> Yes</label></span>
					<span class="inline"><input type="radio" name="pe" onclick="showval9(this.value)" id="pe_no" value="" <?= empty($wizardData->{'pe'})? ' checked ':'';  ?> /><label for="pe_no"><span></span> No</label></span>
                                        <div id="hidename19" style="display: none">
					<label for="pe_explain">If yes, please explain</label>
					<textarea id="pe_explain" name="pe_explain"><?= !empty($wizardData->pe_explain)? $wizardData->pe_explain : '';  ?></textarea>
                                        </div>
                                </section>
				</fieldset>
                            	<fieldset>
			<section>
				<label for="miss_school">Did student miss school last year?<span class="tiny">(relating to Diagnosis)</span></label>
                                <span class="inline"><input type="radio" name="missschool" id="missschoolyes" onclick="showval(this.value)"   value="missschoolyes" <?= !empty($wizardData->{'missschool'})? ' checked ':'';  ?> /><label for="missschoolyes"><span></span> Yes</label></span>
				<span class="inline"><input type="radio" name="missschool" id="missschoolno" onclick="showval(this.value)"  value="" <?= empty($wizardData->{'missschool'})? ' checked ':'';  ?>/><label for="missschoolno"><span></span> No</label></span>
                                <div id="hidename11">
				<label for="missed_times">If yes, how many times?</label>
				<span class="inline"><input type="checkbox" name="missedtimes[]" id="missedtimes12" value="missedtimes12" <?= !empty($wizardData->{'missedtimes12'})? ' checked ':'';  ?>/><label for="missedtimes12"><span></span> 1_2</label></span>
				<span class="inline"><input type="checkbox" name="missedtimes[]" id="missedtimes35" value="missedtimes35" <?= !empty($wizardData->{'missedtimes35'})? ' checked ':'';  ?>/><label for="missedtimes35"><span></span> 3_5</label></span>
				<span class="inline"><input type="checkbox" name="missedtimes[]" id="missedtimes69" value="missedtimes69" <?= !empty($wizardData->{'missedtimes69'})? ' checked ':'';  ?>/><label for="missedtimes69"><span></span> 6_9</label></span>
				<span class="inline"><input type="checkbox" name="missedtimes[]" id="missedtimes10" value="missedtimes10" <?= !empty($wizardData->{'missedtimes10'})? ' checked ':'';  ?>/><label for="missedtimes10"><span></span> 10 or more</label></span>
                                </div>
				<label for="med_delivery">Medication Delivery</label>
				<span class="inline"><input type="checkbox" name="meddelivery[]" id="meddeliverynebulizer" value="meddeliverynebulizer" <?= !empty($wizardData->{'meddeliverynebulizer'})? ' checked ':'';  ?>/><label for="meddeliverynebulizer"><span></span> Nebulizer</label></span>
				<span class="inline"><input type="checkbox" name="meddelivery[]" id="meddeliveryinhaler" value="meddeliveryinhaler" <?= !empty($wizardData->{'meddeliveryinhaler'})? ' checked ':'';  ?>/><label for="meddeliveryinhaler"><span></span> Inhaler</label></span>
				<span class="inline"><input type="checkbox" name="meddelivery[]" id="meddeliveryboth" value="meddeliveryboth" <?= !empty($wizardData->{'meddeliveryboth'})? ' checked ':'';  ?>/><label for="meddeliveryboth"><span></span> Both</label></span>
				
				<label for="med_freq">Frequency</label>
				<input type="text" id="medfreq" name="medfreq" value="<?= !empty($wizardData->medfreq)? $wizardData->medfreq : '';  ?>"/>
			
				<label for="student_admin">Student able to administer medication?</label>
				<span class="inline"><input type="checkbox" name="studentadmin[]" id="studentadmin_dependent" value="studentadmin_dependent" <?= !empty($wizardData->{'studentadmin_dependent'})? ' checked ':'';  ?>/><label for="studentadmin_dependent"><span></span> Dependent<label></span>
				<span class="inline"><input type="checkbox" name="studentadmin[]" id="studentadmin_assistancerequired" value="studentadmin_assistancerequired" <?= !empty($wizardData->{'studentadmin_assistancerequired'})? ' checked ':'';  ?>/><label for="studentadmin_assistancerequired"><span></span> Assistance Required<label></span>
				<span class="inline"><input type="checkbox" name="studentadmin[]" id="studentadmin_independent" value="studentadmin_independent" <?= !empty($wizardData->{'studentadmin_independent'})? ' checked ':'';  ?>/><label for="studentadmin_independent"><span></span> Independent<label></span>
			</section>
			<section>
				<label for="self_mdi">Student self_carries MDI?</label>
				<span class="inline"><input type="radio" name="selfmdi" id="selfmdiyes" value="selfmdiyes" <?= !empty($wizardData->{'selfmdi'})? ' checked ':'';  ?>/><label for="selfmdiyes"><span></span> Yes<label></span>
				<span class="inline"><input type="radio" name="selfmdi" id="selfmdino" value="" <?= empty($wizardData->{'selfmdi'})? ' checked ':'';  ?>/><label for="selfmdino"><span></span> No<label></span>

				<label for="mdi">MDI kept in health room?</label>
				<span class="inline"><input type="radio" name="mdi" id="mdiyes" value="mdiyes" <?= !empty($wizardData->{'mdi'})? ' checked ':'';  ?>/><label for="mdiyes"><span></span> Yes<label></span>
				<span class="inline"><input type="radio" name="mdi" id="mdino" value="" <?= empty($wizardData->{'mdi'})? ' checked ':'';  ?>/><label for="mdino"><span></span> No<label></span>

				<label for="spacer">Spacer?</label>
				<span class="inline"><input type="radio" name="spacer" id="spaceryes" value="spaceryes" <?= !empty($wizardData->{'spacer'})? ' checked ':'';  ?>/><label for="spaceryes"><span></span> Yes<label></span>
				<span class="inline"><input type="radio" name="spacer" id="spacerno" value="" <?= empty($wizardData->{'spacer'})? ' checked ':'';  ?>/><label for="spacerno"><span></span> No<label></span>
				<br />
				<input type="text" id="spacertype" name="spacertype" placeholder="enter type" value="<?= !empty($wizardData->spacertype)? $wizardData->spacertype : '';  ?>" />

				<label for="peak">Peak flow?</label>
				<span class="inline"><input type="radio" name="peak" id="peakyes" value="peakyes" <?= !empty($wizardData->{'peak'})? ' checked ':'';  ?>/><label for="peakyes"><span></span> Yes<label></span>
				<span class="inline"><input type="radio" name="peak" id="peakno" value="" <?= empty($wizardData->{'peak'})? ' checked ':'';  ?>/><label for="peakno"><span></span> No<label></span>
				<br />
				<input type="text" id="peakbest" name="peakbest" placeholder="enter personal best" value="<?= !empty($wizardData->peakbest)? $wizardData->peakbest : '';  ?>"/>
			</section>
		</fieldset>
                            
                            	<fieldset>
			<section>
				<label for="pulm_vest">Pulmonary Vest?</label>
				<span class="inline"><input type="radio" name="pulmvest" id="pulmvestyes" value="pulmvestyes" <?= !empty($wizardData->{'pulmvest'})? ' checked ':'';  ?>/><label for="pulmvestyes"><span></span> Yes</label></span>
				<span class="inline"><input type="radio" name="pulmvest" id="pulmvestno" value="" <?= empty($wizardData->{'pulmvest'})? ' checked ':'';  ?>/><label for="pulmvestno"><span></span> No</label></span>

				<label for="vestfreq">Frequency</label>
				<input type="text" id="vestfreq" name="vestfreq" value="<?= !empty($wizardData->vestfreq)? $wizardData->vestfreq : '';  ?>"/>

				<label for="chest_pt">Chest PT?</label>
				<span class="inline"><input type="radio" name="chestpt" id="chestptyes" value="chestptyes" <?= !empty($wizardData->{'chestpt'})? ' checked ':'';  ?>/><label for="chestptyes"><span></span> Yes</label></span>
				<span class="inline"><input type="radio" name="chestpt" id="chestptno" value="" <?= empty($wizardData->{'chestpt'})? ' checked ':'';  ?>/><label for="chestptno"><span></span> No</label></span>

				<label for="chestptfreq">Frequency</label>
				<input type="text" id="chestptfreq" name="chestptfreq" value="<?= !empty($wizardData->chestptfreq)? $wizardData->chestptfreq : '';  ?>"/>
			</section>
			<section>
				<label for="tplan">Treatment Plan in School</label>
				<span><input type="checkbox" name="tplan[]" id="tplan_standard" value="tplan_standard" <?= !empty($wizardData->{'tplan_standard'})? ' checked ':'';  ?>/><label for="tplan_standard"><span></span> Standard Asthma Plan</label></span>
				<span><input type="checkbox" name="tplan[]" id="tplan_action" value="tplan_action" <?= !empty($wizardData->{'tplan_action'})? ' checked ':'';  ?>/><label for="tplan_action"><span></span> Asthma Action Plan</label></span>
				<span><input type="checkbox" name="tplan[]" id="tplan_ihp" value="tplan_ihp" <?= !empty($wizardData->{'tplan_ihp'})? ' checked ':'';  ?>/><label for="tplan_ihp"><span></span> IHP</label></span>

				<label for="edasthma">ED visit(s) and/or hospitalizations in the last 12 months?</label>
                                <span class="inline"><input type="radio" id="edasthmayes" name="edasthma" value="edasthmayes" onclick="showval2(this.value)"  <?= !empty($wizardData->{'edasthma'})? ' checked ':'';  ?>/><label for="edasthmayes"><span></span> Yes</label></span>
				<span class="inline"><input type="radio" id="edasthmano"  name="edasthma" value="" onclick="showval2(this.value)"  <?= empty($wizardData->{'edasthma'})? ' checked ':'';  ?>/><label for="edasthmano"><span></span> No</label></span>
                                <div id="hidename12">
				<label for="numvisits">If yes, how many?</label>
				<span class="inline"><input type="radio" id="numvisits1" value="numvisits1" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits1')? ' checked ':'';  ?>/><label for="numvisits1"><span></span> 1</label></span>
				<span class="inline"><input type="radio" id="numvisits2" value="numvisits2" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits2')? ' checked ':'';  ?>/><label for="numvisits2"><span></span> 2</label></span>
				<span class="inline"><input type="radio" id="numvisits3" value="numvisits3" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits3')? ' checked ':'';  ?>/><label for="numvisits3"><span></span> 3</label></span>
				<span class="inline"><input type="radio" id="numvisits4" value="numvisits4" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits4')? ' checked ':'';  ?>/><label for="numvisits4"><span></span> 4</label></span>
				<span class="inline"><input type="radio" id="numvisits5" value="numvisits5" name="numvisits" <?= ($wizardData->{'numvisits'} == 'numvisits5')? ' checked ':'';  ?>/><label for="numvisits5"><span></span> 5 or more</label></span>
                                </div>
                        </section>
			<section class="largetext">
				<label for="resp_addtnl">Additional Comments</label>
				<textarea id="resp_addtnl" name="resp_addtnl"><?= !empty($wizardData->{'resp_addtnl'})? $wizardData->{'resp_addtnl'} : '';  ?></textarea>
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
				<?= form_submit($attr_FormSave_appraisal); ?>		
			</div>
			<div class="clear"></div>
		</section>
	<?= form_close(); ?>
</section>
<script type="text/javascript">
$(document).ready(function(){
                //Autosave
setInterval(function(){
    var queryString = $('#appraisal5').serialize();
    //alert(queryString);
    var baseurl = '<?php echo base_url(); ?>';
    //alert(baseurl);
    $.ajax({
    type: "POST",
    url : baseurl + 'nurse_assessment/assessment/autosave?' + queryString,
});
    }, 10000); // 10 seconds
 //Autosave end 

   //Default checkbox checked
//      var constipation_mgmnt = $('#constipation_mgmnt').val();
//      var cardiac_history = $('#cardiac_history').val();
//      var diagnosis_age = $('#diagnosis_age').val();
//
//
//      if(constipation_mgmnt == ""){
//      $('#hide9').attr('checked', true); 
//      }
//      else{
//      $('#hide9').attr('checked', false);
//      }
//      if(cardiac_history == ""){
//      $('#hide10').attr('checked', true); 
//      }
//      else{
//      $('#hide10').attr('checked', false);
//      }
//      if(diagnosis_age == ""){
//      $('#hide11').attr('checked', true); 
//      }
//      else{
//      $('#hide11').attr('checked', false);
//      }

    
})
</script>