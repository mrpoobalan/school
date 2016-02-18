<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_4', 'name' =>'view_print_assessment_4','class'=>"button", 'value'=>'View Print Page 4', 'type'=>'submit','content'=>'View Print Page 4');
	$next_button = array('id' =>'view_print_assessment_6', 'name' =>'view_print_assessment_6','class'=>"button", 'value'=>'View Print Page 6', 'type'=>'submit','content'=>'View Print Page 6');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz06);
?>
<body>
	<div id="assessment_wizard_5">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Select Requirement Type</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Verbal:</span> <?php echo !empty($wiz_06->need_type_verbal)? ' Yes ':'No' ?></p>
					<p class= "cozy"><span class="inline">Non-Verbal:</span> <?php echo !empty($wiz_06->need_type_nonverbal)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Speech/Language Needs:</span> <?php echo !empty($wiz_06->need_type_speech)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Audiology Needs:</span> <?php echo !empty($wiz_06->need_type_audiology)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Vision Needs:</span> <?php echo !empty($wiz_06->need_type_vision)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Signs/Gestures:</span> <?php echo !empty($wiz_06->need_type_signs)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Expressions:</span> <?php echo !empty($wiz_06->need_type_expressions)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Cries/Smiles:</span> <?php echo !empty($wiz_06->need_type_cries)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Pictures:</span> <?php echo !empty($wiz_06->need_type_pictures)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">No Communication:</span> <?php echo !empty($wiz_06->need_type_nocommunication)? ' Yes ':'No' ?></p>
				</div>
			</fieldset>
			<fieldset class="new-section">
				<legend>Assistive Communication Devices</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Assistive Communication Devices:</span> <?php echo !empty($wiz_06->devices)? ' Yes ':'No' ?></p>
					<p class= "cozy"><span class="inline">Assistive Communication Device Description:</span> <?= $wiz06->device_describe ?></p>
					<div class="cozy">

					<h3>Device(s) Used</h3>
						<p class= "cozy"><span class="inline">Wears Glasses:</span> <?php echo !empty($wiz_06->devicelist_glasses)? ' Yes ':'No' ?></p>
						<p class= "cozy"><span class="inline">Wears Hearing Aid:</span> <?php echo !empty($wiz_06->devicelist_hearingaid)? ' Yes ':'No' ?></p>
						<p class= "cozy"><span class="inline">Wears Cochlear Implant:</span> <?php echo !empty($wiz_06->devicelist_cochlear)? ' Yes ':'No' ?></p>
						<p class= "cozy"><span class="inline">FM System:</span> <?php echo !empty($wiz_06->devicelist_fm)? ' Yes ':'No' ?></p>

						<p class= "cozy"><span class="inline">Last Hearing Screening:</span> <?= $wiz06->hearing_screening ?></p>
						<p class= "cozy"><span class="inline">Last Vision Screening:</span> <?= $wiz06->vision_screening ?> </p>
						<p class= "cozy"><span class="inline">Additional Comments:</span> <?= $wiz06->communication_comments ?> </p>
					</div>
				</div>
			</fieldset>

			<fieldset class="new-section">
				<legend>Neurological Requirements</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Seizures Disorder:</span> <?php echo !empty($wiz_06->devices)? ' Yes ':'No' ?></p>
					<p class= "cozy"><span class="inline">Seizure Description:</span> <?= $wiz06->device_describe ?></p>
					<p class= "cozy"><span class="inline">Last Exam:</span> <?= $wiz06->communication_comments ?> </p>
					<p class= "cozy"><span class="inline">Age of Onset:</span> <?= $wiz06->communication_comments ?> </p>
					<div class="cozy">
						<h3>Shunt Information</h3>
							<p class= "cozy"><span class="inline">Shunt:</span> <?php echo !empty($wiz_06->devicelist_glasses)? ' Yes ':'No' ?></p>
							<p class= "cozy"><span class="inline">Shunt Type:</span> <?= $wiz06->shunt_type ?></p>
							<p class= "cozy"><span class="inline">Date of Shunt Placement:</span> <?= $wiz06->shunt_placement ?></p>
							<p class= "cozy"><span class="inline">Date of Last Revision:</span> <?= $wiz06->last_revision ?></p>
							<p class= "cozy"><span class="inline">Date of Last Seizure:</span>  <?= $wiz06->last_seizure ?></p>

							<p class= "cozy"><span class="inline">Usual Duration:</span> <?= $wiz06->usual_duration ?></p>
							<p class= "cozy"><span class="inline">Frequency of Seizures:</span> <?= $wiz06->seizure_frequency ?> </p>
							<p class= "cozy"><span class="inline">Hx of Status Epilecticus:</span> <?= $wiz06->status_epilecticus ?></p>
							<p class= "cozy"><span class="inline">Triggers:</span> <?= $wiz06->triggers ?></p>
							<p class= "cozy"><span class="inline">Ketogenic Diet:</span> <?php echo !empty($wiz_06->ketogenic)? ' Yes ':'No' ?></p>
						</div>
						<div class="cozy">
							<h3>Treatment</h3>
								<p class= "cozy"><span class="inline">Diastat:</span> <?php echo !empty($wiz_06->treatment_diastat)? ' Yes ':'No' ?></p>
								<p class= "cozy"><span class="inline">Oxygen:</span> <?php echo !empty($wiz_06->treatment_oxygen)? ' Yes ':'No' ?></p>
								<p class= "cozy"><span class="inline">Vagal Nerve Stimulator:</span> <?php echo !empty($wiz_06->treatment_vagal)? ' Yes ':'No' ?></p>
								<p class= "cozy"><span class="inline">Medication (see medication list):</span> <?php echo !empty($wiz_06->treatment_medication)? ' Yes ':'No' ?></p>
							</div>
								<p class= "cozy"><span class="inline">Post Seizure Activity:</span> <?= $wiz06->post_seizure ?></p>
								<p class= "cozy"><span class="inline">Aura:</span> <?= $wiz06->aura ?> </p>
								<p class= "cozy"><span class="inline">Aura Description:</span> <?= $wiz06->aura_description ?> </p>
								<p class= "cozy"><span class="inline">Additional Comments:</span> <?= $wiz06->seizure_comments ?> </p>
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