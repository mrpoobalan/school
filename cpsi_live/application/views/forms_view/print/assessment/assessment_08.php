<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_7', 'name' =>'view_print_assessment_7','class'=>"button", 'value'=>'View Print Page 7', 'type'=>'submit','content'=>'View Print Page 7');
	$next_button = array('id' =>'view_print_assessment_9', 'name' =>'view_print_assessment_9','class'=>"button", 'value'=>'View Print Page 9', 'type'=>'submit','content'=>'View Print Page 9');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz09);
?>
<body>
	<div id="assessment_wizard_8">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Respiratory Requirements</legend>
				<div class="cozy">
				<h3>Asthma</h3>
					<p class= "cozy"><span class="inline">Asthma:</span> <?php echo !empty($wiz09->asthma)? 'Yes' :'No' ?></p>
					<p class= "cozy"><span class="inline">If not asthma, what is the diagnosis:</span> <?php echo !empty($wiz09->other_diagnosis)? $wiz09->other_diagnosis :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Age Diagnosed:</span> <?php echo !empty($wiz09->diagnosis_age)? $wiz09->diagnosis_age :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Symptoms in the last 12 months:</span> <?php echo !empty($wiz09->last_year)? $wiz09->last_year :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Needed to use medication in the last 12 months:</span> <?php echo !empty($wiz09->meds_last_year)? $wiz09->meds_last_year :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Seen by health care provider in the last 12 months:</span> <?php echo !empty($wiz09->doctor_last_year)? $wiz09->doctor_last_year :'NA' ?> </p>
					<p class= "cozy"><span class="inline">ED visit(s) and/or hospitalizations in the last 12 months:</span> <?php echo !empty($wiz09->ed_last_year)? $wiz09->ed_last_year :'NA' ?> </p>
					<p class= "cozy"><span class="inline">If yes, how many:</span> <?php echo !empty($wiz09->num_ed_visits)? $wiz09->num_ed_visits :'NA' ?> </p>
				</div>
				<div class="cozy">
				<h3>Triggers</h3>
					<p class= "cozy"><span class="inline">Smoke:</span> <?php echo !empty($wiz09->triggers_smoke)? 'Yes' :'No' ?></p>
					<p class= "cozy"><span class="inline">Animals:</span> <?php echo !empty($wiz09->triggers_animals)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Dust:</span> <?php echo !empty($wiz09->triggers_dust)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Colds/Illness:</span> <?php echo !empty($wiz09->triggers_colds)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Changes in Weather:</span> <?php echo !empty($wiz09->triggers_weather)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Exercise:</span> <?php echo !empty($wiz09->doctor_last_year)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Mold:</span> <?php echo !empty($wiz09->triggers_mold)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Grass/Pollen:</span> <?php echo !empty($wiz09->triggers_grass)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Perfumes/Smells:</span> <?php echo !empty($wiz09->num_ed_visits)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Stress:</span> <?php echo !empty($wiz09->triggers_stress)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Food:</span> <?php echo !empty($wiz09->triggers_food)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Other:</span> <?php echo !empty($wiz09->other_trigger)? $wiz09->other_trigger :'NA' ?> </p>
				</div>
				<div class="cozy">
					<h3>Usual Symptoms</h3>
					<p class= "cozy"><span class="inline">Wheezing:</span> <?php echo !empty($wiz09->usual_symptoms_wheezing)? 'Yes' :'No' ?></p>
					<p class= "cozy"><span class="inline">Shortness of Breath:</span> <?php echo !empty($wiz09->usual_symptoms_breath)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Difficulty Breathing:</span> <?php echo !empty($wiz09->usual_symptoms_breathing)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Itchy Throat:</span> <?php echo !empty($wiz09->usual_symptoms_throat)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Coughing:</span> <?php echo !empty($wiz09->usual_symptoms_cough)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Chest Tightness:</span> <?php echo !empty($wiz09->usual_symptoms_chest)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Irritability:</span> <?php echo !empty($wiz09->usual_symptoms_irritability)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Waking at Night:</span> <?php echo !empty($wiz09->usual_symptoms_waking)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Stomach Ache:</span> <?php echo !empty($wiz09->usual_symptoms_stomachache)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Other:</span> <?php echo !empty($wiz09->other_usual_symptoms)? $wiz09->other_usual_symptoms :'NA' ?> </p>
				</div>
				<div class="cozy">
					<h3>Symptoms<span class="tiny">(in the past month)</span></h3>
					<p class= "cozy"><span class="inline">During the Day:</span> <?php echo !empty($wiz09->day_symptoms)? $wiz09->day_symptoms :'No' ?></p>
					<p class= "cozy"><span class="inline">At Night:</span> <?php echo !empty($wiz09->night_symptoms)? $wiz09->night_symptoms :'No' ?> </p>
					<p class= "cozy"><span class="inline">Symptoms most likely occur in:</span></p>
					<div class ="cozy">
						<p class= "cozy"><span class="inline">Fall:</span> <?php echo !empty($wiz09->season_fall)? 'Yes' :'No' ?> </p>
						<p class= "cozy"><span class="inline">Winter:</span> <?php echo !empty($wiz09->season_winter)? 'Yes' :'No' ?> </p>
						<p class= "cozy"><span class="inline">Spring:</span> <?php echo !empty($wiz09->season_spring)? 'Yes' :'No' ?></p>
						<p class= "cozy"><span class="inline">Summer:</span> <?php echo !empty($wiz09->season_winter)? 'Yes' :'No' ?></p>
						<p class= "cozy"><span class="inline">Have symptoms ever prevented student from participating in PE, Recess, Sports, or Other Activites:</span> <?php echo !empty($wiz09->pe)? 'Yes' :'No' ?></p>
						<p class= "cozy"><span class="inline">If yes, please explain:</span> <?php echo !empty($wiz09->pe_explain)? $wiz09->pe_explain :'No' ?></p>
					</div>
				</div>
			</fieldset>
			<section class="buttons">
				<div class="nextbutton col-one">
					<?= form_open("".$link_back."", $attr_FormOpen); ?>
						<?= form_button($back_button); ?>
						<?= form_close(); ?>
				</div>
				<div class="col-two">
					<?= form_open("".$action."", $attr_FormOpen); ?>
						<?= form_button($next_button); ?>
						<?= form_close(); ?>
				</div>
				<div class="clear"></div>
			</section>
		</section>
	</div>
</body>