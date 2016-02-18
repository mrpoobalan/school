<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_6', 'name' =>'view_print_assessment_6','class'=>"button", 'value'=>'View Print Page 6', 'type'=>'submit','content'=>'View Print Page 6');
	$next_button = array('id' =>'view_print_assessment_8', 'name' =>'view_print_assessment_8','class'=>"button", 'value'=>'View Print Page 8', 'type'=>'submit','content'=>'View Print Page 8');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz08);
?>
<body>
	<div id="assessment_wizard_7">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Cardiac Requirements</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Cardiac History:</span> <?= $wiz08->cardiac_history ?> </p>
					<p class= "cozy"><span class="inline">Restrictions:</span> <?= $wiz08->restrictions ?> </p>
					<p class= "cozy"><span class="inline">If yes, please list:</span> <?php echo !empty($wiz08->restrict_list)? $wiz08->restrict_list :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Baseline Vital Signs:</span> <?php echo !empty($wiz08->baseline)? $wiz08->baseline :'NA' ?> </p>
				</div>
				<div class="cozy">
					<h3>Symptoms of Distress</h3>
					<p class= "cozy"><span class="inline">Chest Pain/Tightness:</span> <?php echo !empty($wiz08->distress_pain)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Shortness of Breath:</span> <?php echo !empty($wiz08->distress_breath)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Palpitations:</span> <?php echo !empty($wiz08->distress_palpitations)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Diaphoresis:</span> <?php echo !empty($wiz08->distress_diaphoresis)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Fatigue:</span> <?php echo !empty($wiz08->distress_fatigue)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Dyspnea on Exertion:</span> <?php echo !empty($wiz08->distress_dyspnea)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Fainting:</span> <?php echo !empty($wiz08->distress_fainting)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Other:</span> <?php echo !empty($wiz08->distress_other)? $wiz08->distress_other :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Pacemaker:</span> <?php echo !empty($wiz08->pacemaker)? ' Yes ':'No' ?></p>
					<p class= "cozy"><span class="inline">Internal Defibrillator:</span> <?php echo !empty($wiz08->defib)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Personal AED:</span> <?php echo !empty($wiz08->aed)? ' Yes ':'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Skin Color</h3>
					<p class= "cozy"><span class="inline">Normal:</span> <?php echo !empty($wiz08->distress_pain)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Cyanosis:</span> <?php echo !empty($wiz08->distress_breath)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Jaundice:</span> <?php echo !empty($wiz08->distress_palpitations)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Pallor:</span> <?php echo !empty($wiz08->distress_diaphoresis)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Erythema:</span> <?php echo !empty($wiz08->distress_fatigue)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Dyspnea on Exertion:</span> <?php echo !empty($wiz08->distress_dyspnea)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Other skin color:</span> <?php echo !empty($wiz08->skin_color_comment)? $wiz08->skin_color_comment :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Additional Comments:</span> <?php echo !empty($wiz08->cardiac_addtnl)? $wiz08->cardiac_addtnl :'NA' ?> </p>

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