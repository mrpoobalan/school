<?php // load dashboard admin menu
$this->load->view("menu/top_menu");
$back_button = array('id' =>'view_print_assessment_5', 'name' =>'view_print_assessment_5','class'=>"button", 'value'=>'View Print Page 5', 'type'=>'submit','content'=>'View Print Page 5');
$next_button = array('id' =>'view_print_assessment_7', 'name' =>'view_print_assessment_7','class'=>"button", 'value'=>'View Print Page 7', 'type'=>'submit','content'=>'View Print Page 7');
$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

//print_r($wiz07);
?>
<body>
	<div id="assessment_wizard_6">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Elimination Requirements</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Independent:</span> <?php echo !empty($wiz07->elimination_independent)? ' Yes ':'No' ?></p>
					<p class= "cozy"><span class="inline">Scheduled:</span> <?php echo !empty($wiz07->elimination_scheduled)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Prompted:</span> <?php echo !empty($wiz07->elimination_prompted)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Diapered:</span> <?php echo !empty($wiz07->elimination_diapered)? ' Yes ':'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Continence</h3>
					<p class= "cozy"><span class="inline">Continent:</span> <?php echo !empty($wiz07->continence_continent)? ' Yes ':'No' ?></p>
					<p class= "cozy"><span class="inline">Incontinent:</span> <?php echo !empty($wiz07->continence_incontinent_bowel)? ' Yes ':'No' ?> </p>
					<p class= "cozy"><span class="inline">Incontinent:</span> <?php echo !empty($wiz07->continence_incontinent_bladder)? ' Yes ':'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Toilet Type</h3>
					<p class= "cozy"><span class="inline">Toilet:</span> <?php echo !empty($wiz07->toilet)? $wiz07->toilet:'NA' ?></p>
					<p class= "cozy"><span class="inline">Other Toilet Type:</span> <?php echo !empty($wiz07->other_toilet)? $wiz07->other_toilet :'NA' ?></p>
				</div>
				<div class="cozy">
					<h3>Student Toilet</h3>
					<p class= "cozy"><span class="inline">Toileted :</span> <?php echo !empty($wiz07->toileted)? $wiz07->toileted:'NA' ?></p>
					<p class= "cozy"><span class="inline">Other Toilet:</span> <?php echo !empty($wiz07->toileted_student)? $wiz07->toileted_student :'NA' ?></p>
				</div>
				<div class="cozy">
					<h3>History of Constipation</h3>
					<p class= "cozy"><span class="inline">Constipationed:</span> <?php echo !empty($wiz07->constipation)? 'Yes':'No' ?></p>
					<p class= "cozy"><span class="inline">Other Toilet:</span> <?php echo !empty($wiz07->toileted_student)? $wiz07->toileted_student :'NA' ?></p>
					<p class= "cozy"><span class="inline">Management:</span> <?php echo !empty($wiz07->management)?  $wiz07->constipation_mgmnt :'NA' ?></p>
				</div>
				<div class="cozy">
					<h3>Colostomy</h3>
					<p class= "cozy"><span class="inline">Colostomy:</span> <?php echo !empty($wiz07->colostomy)? 'Yes':'No' ?></p>
					<p class= "cozy"><span class="inline">Colostomy Management:</span> <?php echo !empty($wiz07->colostomy_mgmnt)? $wiz07->colostomy_mgmnt :'NA' ?></p>
				</div>
				<div class="cozy">
					<h3>Bladder Regime</h3>
					<p class= "cozy"><span class="inline">Bladder:</span> <?php echo !empty($wiz07->bladder)? 'Yes':'No' ?></p>
					<p class= "cozy"><span class="inline">Bladder Management:</span> <?php echo !empty($wiz07->bladder_mgmnt)? $wiz07->bladder_mgmnt :'NA' ?></p>
				</div>
				<div class="cozy">
					<h3>Urinary Catheterization</h3>
					<p class= "cozy"><span class="inline">Catheter:</span> <?php echo !empty($wiz07->catheter)? 'Yes':'No' ?></p>
					<p class= "cozy"><span class="inline">Catheter Size:</span> <?php echo !empty($wiz07->cath_size)? $wiz07->cath_size :'NA' ?></p>
					<p class= "cozy"><span class="inline">Self Catheter:</span> <?php echo !empty($wiz07->self_catheter)? 'Yes':'No' ?></p>
					<p class= "cozy"><span class="inline">Catheter Size:</span> <?php echo !empty($wiz07->cath_size)? $wiz07->cath_size :'NA' ?></p>
					<p class= "cozy"><span class="inline">Catheter Frequency:</span> <?php echo !empty($wiz07->cath_freq)? $wiz07->cath_freq :'NA' ?></p>
				</div>
				<div class="cozy">
					<h3>Menstruation</h3>
					<p class= "cozy"><span class="inline">Menstruation:</span> <?php echo !empty($wiz07->menstruation)? 'Yes':'No' ?></p>
					<p class= "cozy"><span class="inline">Menstruation Management:</span> <?php echo !empty($wiz07->menstruation_mgmt)? $wiz07->menstruation_mgmt :'NA' ?></p>
				</div>
					<p class= "cozy"><span class="inline">Stoma:</span> <?php echo !empty($wiz07->stoma)? 'Yes':'No' ?></p>
					<p class= "cozy"><span class="inline">Diabetic Student:</span> <?php echo !empty($wiz07->diabetic)? 'Yes' :'No' ?></p>
					<p class= "cozy"><span class="inline">Liberal Bathroom Privileges:</span> <?php echo !empty($wiz07->br_privileges)? 'Yes' :'No' ?></p>
					<p class= "cozy"><span class="inline">Additional Comments:</span> <?php echo !empty($wiz07->elimination_addtnl)? $wiz07->elimination_addtnl :'NA' ?></p>
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