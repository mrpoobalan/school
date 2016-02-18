<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_8', 'name' =>'view_print_assessment_8','class'=>"button", 'value'=>'View Print Page 8', 'type'=>'submit','content'=>'View Print Page 8');
	$next_button = array('id' =>'view_print_assessment_10', 'name' =>'view_print_assessment_10','class'=>"button", 'value'=>'View Print Page 10', 'type'=>'submit','content'=>'View Print Page 10');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz10);

?>
<body>
	<div id="assessment_wizard_9">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Student Requirements</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Did student miss school last year:</span> <?php echo !empty($wiz10->miss_school)? 'Yes' :'No' ?></p>
					<p class= "cozy"><span class="inline">If yes, how many times:</span> <?php echo !empty($wiz10->missed_times)? $wiz10->missed_times :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Medication Delivery:</span> <?php echo !empty($wiz10->med_delivery)? $wiz10->med_delivery :'NA' ?> </p>

					<p class= "cozy"><span class="inline">Frequency:</span> <?php echo !empty($wiz10->med_freq)? $wiz10->med_freq :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Student able to administer medication:</span> <?php echo !empty($wiz10->student_admin)? $wiz10->student_admin :'NA' ?> </p>

					<p class= "cozy"><span class="inline">Student self-carries MDI:</span> <?php echo !empty($wiz10->self_mdi)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">MDI kept in health room:</span> <?php echo !empty($wiz10->mdi)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Spacer:</span> <?php echo !empty($wiz10->spacer)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Spacer Type:</span> <?php echo !empty($wiz10->spacer_type)? $wiz10->spacer_type :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Peak Flow:</span> <?php echo !empty($wiz10->peak)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Peak Flow Type:</span> <?php echo !empty($wiz10->peak_best)? $wiz10->peak_best :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Pulmonary Vest:</span> <?php echo !empty($wiz10->pulm_vest)? $wiz10->pulm_vest :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Pulmonary Vest Frequency:</span> <?php echo !empty($wiz10->vest_freq)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Chest PT:</span> <?php echo !empty($wiz10->chest_pt)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Chest PT Frequency:</span> <?php echo !empty($wiz10->chest_pt_freq)? $wiz10->chest_pt_freq :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Treatment Plan in School:</span></p>
					<div class="cozy">
						<p class= "cozy"><span class="inline">Standard Asthma Plan:</span> <?php echo !empty($wiz10->standard)? $wiz10->standard :'NA' ?> </p>
						<p class= "cozy"><span class="inline">Asthma Action Plan:</span> <?php echo !empty($wiz10->action)? $wiz10->action :'NA' ?> </p>
						<p class= "cozy"><span class="inline">IHP:</span> <?php echo !empty($wiz10->ihp)? $wiz10->ihp :'NA' ?> </p>
					</div>
					<p class= "cozy"><span class="inline">ED visit(s) and/or hospitalizations in the last 12 months:</span> <?php echo !empty($wiz10->ed_asthma)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">If yes, how many:</span> <?php echo !empty($wiz10->num_visits)? $wiz10->num_visits :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Additional Comments:</span> <?php echo !empty($wiz10->resp_addtnl)? $wiz10->resp_addtnl :'NA' ?> </p>
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
