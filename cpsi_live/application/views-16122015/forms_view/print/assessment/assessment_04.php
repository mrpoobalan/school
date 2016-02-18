<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_3', 'name' =>'view_print_assessment_3','class'=>"button", 'value'=>'View Print Page 3', 'type'=>'submit','content'=>'View Print Page 3');
	$next_button = array('id' =>'view_print_assessment_5', 'name' =>'view_print_assessment_5','class'=>"button", 'value'=>'View Print Page 5', 'type'=>'submit','content'=>'View Print Page 5');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz05);
?>
<body>
	<div id="assessment_wizard_4">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Treatments</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Treatment Order:</span> <?= $wiz05->treatment1 ?></p>
					<p class= "cozy"><span class="inline">Frequency:</span> <?= $wiz05->frequency1 ?></p>
					<h3>Peformed</h3>
					<div class="cozy">
						<p class= "cozy"><span class="inline">At School:</span> <?= $wiz05->performed1_school ?></p>
						<p class= "cozy"><span class="inline">At Home:</span> <?= $wiz05->performed1_home ?></p>
					</div>
					<p class= "cozy"><span class="inline">Person Performing:</span> <?= $wiz05->person1 ?></p>
				</div>
			</fieldset>

			<fieldset class="new-section">
				<legend>Allergies</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Allergic to:</span> <?= $wiz05->allergy1 ?></p>
					<p class= "cozy"><span class="inline">Reaction:</span> <?= $wiz05->reaction1 ?></p>
					<p class= "cozy"><span class="inline">Life Threatening?</span> <?= $wiz05->deadly1 ?></p>

					<h3>Sensitivity Level</h3>
					<div class="cozy">
						<p class= "cozy"><span class="inline">Touch/Contact:</span> <?= $wiz05->sensitivity1_touch ?></p>
						<p class= "cozy"><span class="inline">Ingestion:</span> <?= $wiz05->sensitivity1_ingest ?></p>
						<p class= "cozy"><span class="inline">Air:</span> <?= $wiz05->sensitivity1_air ?></p>
					</div>
					<h3>Treatment</h3>
					<div class="cozy">
						<p class= "cozy"><span class="inline">Epi Pen:</span> <?= $wiz05->treatment1_epi ?></p>
						<p class= "cozy"><span class="inline">Antihistamine:</span> <?= $wiz05->treatment1_antihistamine ?></p>
					</div>
					<p class= "cozy"><span class="inline">Which Antihistamine?:</span> <?= $wiz05->ah1 ?></p>
					<p class= "cozy"><span class="inline">How was the allergy diagnosed?</span> <?= $wiz05->diagnosed1 ?></p>

					<p class= "cozy"><span class="inline">Last Event:</span> <?= $wiz05->lastevent1 ?></p>
					<p class= "cozy"><span class="inline">Additional Comments:</span> <?= $wiz05->addtnlcomments1 ?></p>
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