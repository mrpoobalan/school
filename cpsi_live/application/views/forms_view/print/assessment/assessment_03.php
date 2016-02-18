
<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_2', 'name' =>'view_print_assessment_2','class'=>"button", 'value'=>'View Print Page 2', 'type'=>'submit','content'=>'View Print Page 2');
	$next_button = array('id' =>'view_print_assessment_4', 'name' =>'view_print_assessment_4','class'=>"button", 'value'=>'View Print Page 4', 'type'=>'submit','content'=>'View Print Page 4');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz04);
?>
<body>
	<div id="assessment_wizard_3">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Daily Medications</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Medication Name:</span> <?= $wiz04->med1 ?></p>
					<p class= "cozy"><span class="inline">Dosage:</span> <?= $wiz04->dose1 ?></p>
					<p class= "cozy"><span class="inline">Time/Frequency:</span> <?= $wiz04->time1 ?></p>
					<p class= "cozy"><span class="inline">Route:</span> <?= $wiz04->route1 ?></p>
					<p class= "cozy"><span class="inline">Taken at School:</span> <?= $wiz04->taken1_school ?></p>
					<p class= "cozy"><span class="inline">Taken at Home:</span> <?= $wiz04->taken1_home ?></p>
				</div>
			</fieldset>
			<fieldset class="new-section">
				<legend>PRN Medications</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Medication Name:</span> <?= $wiz04->prnmed1 ?></p>
					<p class= "cozy"><span class="inline">Dosage:</span> <?= $wiz04->prndose1 ?></p>
					<p class= "cozy"><span class="inline">Time/Frequency:</span> <?= $wiz04->prntime1 ?></p>
					<p class= "cozy"><span class="inline">Route:</span> <?= $wiz04->prnroute1 ?></p>
					<p class= "cozy"><span class="inline">Taken at School:</span> <?= $wiz04->prntaken1_school ?></p>
					<p class= "cozy"><span class="inline">Taken at Home:</span> <?= $wiz04->prntaken1_home ?></p>
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