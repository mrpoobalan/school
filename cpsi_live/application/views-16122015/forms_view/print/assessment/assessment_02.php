<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_1', 'name' =>'view_print_assessment_1','class'=>"button", 'value'=>'View Print Page 1', 'type'=>'submit','content'=>'View Print Page 1');
	$next_button = array('id' =>'view_print_assessment_3', 'name' =>'view_print_assessment_3','class'=>"button", 'value'=>'View Print Page 3', 'type'=>'submit','content'=>'View Print Page 3');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz01);
	//print_r($wiz02);
?>
<body>
<div id="assessment_wizard_2">
	<section class="page healthform ">
		<fieldset class="new-section">
			<legend>Physicians</legend>
				<p class= "cozy"><span class="inline">Primary Care:</span> <?= $wiz03->primary ?></p>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Last Exam:</span> <?= $wiz03->lastexam1 ?></p>
					<p class= "cozy"><span class="inline">Next Exam:</span> <?= $wiz03->nextexam1 ?></p>
					<p class= "cozy"><span class="inline">Phone:</span> <?= $wiz03->phone1 ?></p>
					<p class= "cozy"><span class="inline">Fax:</span> <?= $wiz03->fax1 ?></p>
					<p class= "cozy"><span class="inline">Release:</span> <?= $wiz03->release1 ?></p>
					<p class= "cozy"><span class="inline">Release Expiration:</span> <?= $wiz03->release_exp1 ?></p>
				</div>
		</fieldset>
		<fieldset class="new-section">
			<legend>Specialist Information </legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Specialist Name:</span> <?= $wiz03->specialist1 ?></p>
					<p class= "cozy"><span class="inline">Last Exam:</span> <?= $wiz03->lastexam2 ?></p>
					<p class= "cozy"><span class="inline">Next Exam:</span> <?= $wiz03->nextexam2 ?></p>
					<p class= "cozy"><span class="inline">Phone:</span> <?= $wiz03->phone2 ?></p>
					<p class= "cozy"><span class="inline">Fax:</span> <?= $wiz03->fax2 ?></p>
					<p class= "cozy"><span class="inline">Specialist Release:</span> <?= $wiz03->release2 ?></p>
					<p class= "cozy"><span class="inline">Release Expiration:</span> <?= $wiz03->release_exp2 ?></p>
				</div>
		</fieldset>
		<fieldset class="new-section">
			<legend>Dentist, Hearing, and Vision</legend>
			<div class="cozy">
				<h3>Dentist</h3>
					<p class= "cozy"><span class="inline">Dentist Exam Date:</span> <?= $wiz03->dentalexam ?></p>
					<p class= "cozy"><span class="inline">Dentist History and Treatment:</span> <?= $wiz03->dentalhistory ?></p>
					<p class= "cozy"><span class="inline">Dentist Release:</span> <?= $wiz03->dentalrelease ?></p>
				<h3>Hearing</h3>
					<p class= "cozy"><span class="inline">Hearing Exam Date:</span> <?= $wiz03->hearingexam ?></p>
					<p class= "cozy"><span class="inline">Hearing History and Treatment:</span> <?= $wiz03->hearinghistory ?></p>
					<p class= "cozy"><span class="inline">Hearing Release:</span> <?= $wiz03->hearingrelease ?></p>
				<h3>Vision</h3>
					<p class= "cozy"><span class="inline">Vision Exam Date:</span> <?= $wiz03->visionexam ?></p>
					<p class= "cozy"><span class="inline">Vision History and Treatment:</span> <?= $wiz03->visionhistory ?></p>
					<p class= "cozy"><span class="inline">Vision Release:</span> <?= $wiz03->visionrelease ?></p>
			</div>
		</fieldset>
		<fieldset class="new-section">
			<legend>Agencies and Case Managers</legend>
			<div  class="cozy">
				<p class= "cozy"><span class="inline">Name:</span> <?= $wiz03->name1 ?></p>
				<p class= "cozy"><span class="inline">Phone:</span> <?= $wiz03->agencyphone1 ?></p>
				<p class= "cozy"><span class="inline">Fax:</span> <?= $wiz03->agencyfax1 ?></p>
				<p class= "cozy"><span class="inline">Release:</span> <?= $wiz03->agencyrelease1 ?></p>
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