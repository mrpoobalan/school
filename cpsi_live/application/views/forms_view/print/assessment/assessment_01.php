<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$next_button = array('id' =>'view_print_assessment_2', 'name' =>'view_print_assessment_2','class'=>"button", 'value'=>'View Print Page 2', 'type'=>'submit','content'=>'View Print Page 2');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz01);
	//print_r($wiz02);
?>

<body> <div id="assessment_wizard_1"> <section class="page healthform ">

	<h1> Nursing Assessment </h1>

	<fieldset class="new-section">
		<legend>ID</legend>
			<p class="col-one cozy">SIF Number:<span> <?= $wiz01->sif ?></span></p>
			<p class="col-one">State Number: <span><?= $wiz01->statenum ?></span></p>
	</fieldset>
	<fieldset class="new-section">
		<legend>Student Information</legend>
		<section class="inline">

		<p class= "cozy"><span class="inline">First Name:</span> <?= $wiz01->fname ?></p>
		<p class= "cozy"><span class="inline">Last Name:</span> <?= $wiz01->lname ?></p>
		<p class= "cozy"><span class="inline">Nickname:</span> <?= $wiz01->statenum ?></p>
		<p class= "cozy"><span class="inline">Date of Birth:</span> <?= $wiz01->dob ?></p>
		</section>
	</fieldset>
	<fieldset class="new-section">
		<legend>Parent/Guardian Information</legend>

		<p class= "cozy"><span class="inline">Parent(s)/Guardian(s):</span> <?= $wiz01->parentname ?></p>
		<p class= "cozy"><span >Address:</span><p>
		<p class= "cozy">
			<?= $wiz01->street ?><br />
			<?= $wiz01->city ?>,  <?= $wiz01->statenum ?> <?= $wiz01->zip ?>
		</p>
		<p class= "cozy"><span class="inline">Home Phone Number:</span> <?= $wiz01->homephone ?></p>
		<p class= "cozy"><span class="inline">Cell Phone Number:</span> <?= $wiz01->cellphone ?></p>
		<p class= "cozy"><span class="inline">Work Phone Number:</span> <?= $wiz01->workphone ?></p>
		<p class= "cozy"><span class="inline">Additional Contact:</span> <?= $wiz01->addtnlcontact ?></p>
		<p class= "cozy"><span class="inline">Cell Phone Number:</span> <?= $wiz01->addtnlcellphone ?></p>
		<p class= "cozy"><span class="inline">Home Phone Number:</span> <?= $wiz01->addtnlhomephone ?></p>
		<p class= "cozy"><span class="inline">Work Phone Number:</span> <?= $wiz01->addtnlworkphone ?></p>
	</fieldset>

	<fieldset class="new-section">
		<legend>Insurance</legend>
		<p class= "cozy"><span class="inline"> Private:</span> <?= !empty($wiz01->private)? ' Yes ':'No' ?></p>
		<p class= "cozy"><span class="inline"> MCHP:</span> <?= !empty($wiz01->mchp)? ' Yes ':'No' ?></p>
		<p class= "cozy"><span class="inline"> Medicaid:</span> <?= !empty($wiz01->medicaid)? ' Yes ':'No' ?> </p>
		<p class= "cozy"><span class="inline"> Other:</span> <?= !empty($wiz01->none_text)? $wiz01->none_text :'NA' ?></p>
		<p class= "cozy"><span class="inline">Preferred Hospital: </span><?= !empty($wiz01->preferred_hospital)? $wiz01->preferred_hospital :'NA' ?></p>
		<p class= "cozy"><span class="inline">Immunization Current?</span> <?= !empty($wiz01->immunization)? ' Yes ':'No' ?></p>
		<p class= "cozy"><span>Exemption Type</span>
		<div class="cozy">
		<p class= "cozy"><span class="inline">Religious Exemption:</span> <?= !empty($wiz01->religious)? ' Yes ':'No' ?> </p>
		<p class= "cozy"><span class="inline">Medical Exemption:</span> <?= !empty($wiz01->medical)? $wiz01->medical :'NA' ?></p>
		</div>
		<p class= "cozy"><span>Contact Attempts</span>
		<div class="cozy">
			<p class="cozy"><?= !empty($wiz01->contactattempt1)? $wiz01->contactattempt1 :'No Attempt' ?></p>
		</div>
	</fieldset>
	<fieldset class="new-section">
		<legend>Assessment Information</legend>
		<p class= "cozy"><span span class="inline">Type of Assessment:</span> <?= $wiz02->assessment ?></p>
	</fieldset>
	<fieldset class="new-section">
		<legend>Educational Status</legend>
		<p class= "cozy"><span class="inline">ITP:</span> <?= !empty($wiz02->edustatus1)? $wiz02->edustatus1 :'NA' ?> </p>
		<p class= "cozy"><span class="inline">ECI:</span> <?= !empty($wiz02->edustatus2)? $wiz02->edustatus2 :'NA' ?></p>
		<p class= "cozy"><span class="inline">IEP:</span> <?= !empty($wiz02->iep)? $wiz02->iep :'NA' ?></p>
		<p class= "cozy"><span class="inline">Current Grade: </span><?= !empty($wiz02->grade)? $wiz02->grade :'NA' ?></p>
		<p class= "cozy"><span class="inline">Current Individual Educational Assistant: </span> <?= !empty($wiz02->assistant)? $wiz02->assistant :'No' ?></p>

		<p class= "cozy"><span class="inline">Services Used: <?= !empty($wiz02->assistant)? $wiz02->assistant :'No' ?></span><p>
			<div class= "cozy">
				<p class= "cozy"><span class="inline"> Occupational Therapy: </span> <?= !empty($wiz02->eduservices_occupational)? $wiz02->eduservices_occupational :'No' ?></p>
				<p class= "cozy"><span class="inline"> Physical Therapy:</span> <?= !empty($wiz02->eduservices_physical)? $wiz02->eduservices_physical :'No' ?></p>
				<p class= "cozy"><span class="inline"> Speech/Language:</span> <?= !empty($wiz02->eduservices_speech)? $wiz02->eduservices_speech :'No' ?></p>
				<p class= "cozy"><span class="inline"> Counseling:</span> <?= !empty($wiz02->eduservices_counseling)? $wiz02->eduservices_counseling :'No' ?></p>
				<p class= "cozy"><span class="inline"> Adaptive PE:</span> <?= !empty($wiz02->eduservices_pe)? $wiz02->eduservices_pe :'No' ?></p>
			</div>
		</p>
		<p class= "cozy"><span class="inline">Off Location Teaching</span>
			<div class= "cozy">
				<p class= "cozy"><span class="inline">Home Hospital Teaching:</span>  <?= !empty($wiz02->eduservices_pe)? $wiz02->eduservices_pe :'No' ?></p>
				<p class= "cozy"><span class="inline">Concurrent Home Teaching:</span>  <?= !empty($wiz02->eduservices_pe)? $wiz02->eduservices_pe :'No' ?></p>
			</div>
		</p>
		<p class= "cozy"><span>Re-Evaluation Date</span>
			<div class="cozy">
				<p class="cozy"><?= !empty($wiz02->reevaldate)? $wiz02->reevaldate :'NA' ?></p>
			</div>
		</p>
		<p class= "cozy"><span class="inline">Assistive Technology: </span> <?= !empty($wiz02->assist_tech)? $wiz02->assist_tech :'NA' ?></p>
		<p class= "cozy"><span class="inline">Please List Assistive Technology: </span> <?= !empty($wiz02->assist_tech_lt)? $wiz02->assist_tech_lt :'NONE' ?></p>
		<p class= "cozy"><span class="inline">Classroom Accommodations: </span> <?= !empty($wiz02->accomodations_lt)? $wiz02->accomodations_lt :'NONE' ?></p>
	</fieldset>
	<fieldset class="new-section">
		<legend>Individualized Healthcare Plan</legend>
		<p class="cozy"><span class="inline">IHP?</span> <?= !empty($wiz02->ihp)? $wiz02->ihp :'NO' ?></p>
		<p class="cozy"><span class="inline">Medical Diagnosis:</span> <?= !empty($wiz02->diagnosis1)? $wiz02->diagnosis1 :'NO' ?></p>
	</fieldset>
	<fieldset class="new-section">
		<legend>Background</legend>
		<p class="cozy"><span class="inline">Birth Weight: </span> <?= !empty($wiz02->birthweight)? $wiz02->birthweight :'NA' ?></p>
		<p class="cozy"><span class="inline">Gestation: </span> <?= !empty($wiz02->gestation)? $wiz02->gestation :'NA' ?></p>
		<p class="cozy"><span class="inline">Birth Type: </span> <?= !empty($wiz02->birthtype)? $wiz02->birthtype :'NA' ?></p>
		<p class="cozy"><span class="inline">Developmental Milestones Met:</span> <?= !empty($wiz02->milestone)? $wiz02->milestone :'No milestones given' ?></p>
		<p class="cozy"><span class="inline">Complications:</span> <?= !empty($wiz02->complications)? $wiz02->complications :'No complications.' ?></p>
		<p class="cozy"><span class="inline">Emergencies, Hospitalizations, or Surgeries:</span> <?= !empty($wiz02->emergencies)? $wiz02->emergencies :'No emergencies.' ?></p>
	</fieldset>
	<fieldset class="new-section">
		<legend>History of Diagnosis/Current Health Status</legend>
			<p class="cozy"><span>See Previous Nursing Assessment Dated:</span></p>
			<div class="cozy">
				<p class="cozy"><span class="inline"><?= !empty($wiz02->previousdate)? $wiz02->previousdate :'No date given.' ?></span></p>
			</div>
			<p class="cozy"><span class="inline">Narrative:</span> <?= !empty($wiz02->narrative)? $wiz02->narrative :'No narrative.' ?></p>
	</fieldset>
		<section class="buttons">
			<div class="nextbutton">
				<?= form_open("".$action."", $attr_FormOpen); ?>
					<?= form_button($next_button); ?>
					<?= form_close(); ?>
			</div>
			<div class="clear"></div>
		</section>
	</section>
</div>
</body>
