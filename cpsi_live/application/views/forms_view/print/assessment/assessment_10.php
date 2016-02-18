<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_9', 'name' =>'view_print_assessment_9','class'=>"button", 'value'=>'View Print Page 9', 'type'=>'submit','content'=>'View Print Page 9');
	$next_button = array('id' =>'view_print_assessment_11', 'name' =>'view_print_assessment_11','class'=>"button", 'value'=>'View Print Page 11', 'type'=>'submit','content'=>'View Print Page 11');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	//print_r($wiz11);

?>
<body>
	<div id="assessment_wizard_10">
		<section class="page healthform ">
			<fieldset class="new-section">
				<legend>Respiratory - Oxygen/Tracheostomy/Ventilation Requirements</legend>
				<div class="cozy">
					<h3>Respiratory Assessment</h3>
					<p class= "cozy"><span class="inline">Continuous:</span> <?php echo !empty($wiz11->resp_assess_continuous)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Intermittant/As Needed:</span> <?php echo !empty($wiz11->resp_assess_intermittant)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Student Communicates/Signals Need:</span> <?php echo !empty($wiz11->resp_assess_signal)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Baseline Respiratory Assessment:</span> <?php echo !empty($wiz11->baseline_assess)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Signs/Symptoms of Respiratory Distress:</span> <?php echo !empty($wiz11->distress_sign)? 'Yes' :'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Mechanical Ventilation</h3>
					<p class= "cozy"><span class="inline">Mechanical Ventilation Type:</span> <?php echo !empty($wiz11->ventilation)? $wiz11->ventilation :'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Ventilation Needed</h3>
					<p class= "cozy"><span class="inline">Home:</span> <?php echo !empty($wiz11->where_home)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">School:</span> <?php echo !empty($wiz11->where_school)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Sleep:</span> <?php echo !empty($wiz11->where_sleep)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">As Needed:</span> <?php echo !empty($wiz11->where_as_needed)? 'Yes' :'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Ventilator Dependent</h3>
					<p class= "cozy"><span class="inline">Ventilator Dependent:</span> <?php echo !empty($wiz11->vent_depend_dependent)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Ventilator Assist:</span> <?php echo !empty($wiz11->vent_depend_assist)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">If Vent Assist, how long can student be off vent:</span> <?php echo !empty($wiz11->vent_assist)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Ventilator Settings:</span> <?php echo !empty($wiz11->vent_set)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Ventilator Company:</span> <?php echo !empty($wiz11->vent_contact)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Contact Information:</span> <?php echo !empty($wiz11->vent_co)? 'Yes' :'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Oxygen</h3>
					<p class= "cozy"><span class="inline">Continous:</span> <?php echo !empty($wiz11->oxygen_cont)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Intermittent:</span> <?php echo !empty($wiz11->oxygen_inter)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Oximetry:</span> <?php echo !empty($wiz11->oximetry)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Frequency:</span> <?php echo !empty($wiz11->ox_freq)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Parameters:</span> <?php echo !empty($wiz11->ox_param)? 'Yes' :'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Oxygen Route</h3>
					<p class= "cozy"><span class="inline">Nasal Cannula:</span> <?php echo !empty($wiz11->ox_route_nasal)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Tracheotomy:</span> <?php echo !empty($wiz11->ox_route_trach)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Mask/Non-Rebreather:</span> <?php echo !empty($wiz11->ox_route_mask)? 'Yes' :'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Oxygen Source</h3>
					<p class= "cozy"><span class="inline">Tank:</span> <?php echo !empty($wiz11->ox_source_tank)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Liquid:</span> <?php echo !empty($wiz11->ox_source_liquid)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Concentrator:</span> <?php echo !empty($wiz11->ox_source_concentrator)? 'Yes' :'No' ?> </p>
				</div>
				<p class= "cozy"><span class="inline">Trach Size:</span> <?php echo !empty($wiz11->trach_size)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Cuffed:</span> <?php echo !empty($wiz11->cuffed)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Thermo-Vent:</span> <?php echo !empty($wiz11->thermo)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Passy Muir:</span> <?php echo !empty($wiz11->muir)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">CO2 Monitor:</span> <?php echo !empty($wiz11->co2)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Frequency:</span> <?php echo !empty($wiz11->co2_freq)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Parameters:</span> <?php echo !empty($wiz11->co2_param)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Additional Ventilator Information:</span> <?php echo !empty($wiz11->addtnl_vent)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Suctioning:</span> <?php echo !empty($wiz11->suction)? 'Yes' :'No' ?> </p>
				<p class= "cozy"><span class="inline">Postural Drainage:</span> <?php echo !empty($wiz11->suction_drain)? $wiz11->suction_drain :'NA' ?> </p>
				<div class="cozy">
					<h3>Type</h3>
					<p class= "cozy"><span class="inline">Oropharyngeal:</span> <?php echo !empty($wiz11->trach_type_o)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Nasopharyngeal:</span> <?php echo !empty($wiz11->trach_type_n)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Endotracheal:</span> <?php echo !empty($wiz11->trach_type_e)? 'Yes' :'No' ?> </p>
				</div>
				<div class="cozy">
					<h3>Type</h3>
					<p class= "cozy"><span class="inline">Catheter Type:</span> <?php echo !empty($wiz11->cath_y)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Catheter Size:</span> <?php echo !empty($wiz11->cath_size)? 'Yes' :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Frequency:</span> <?php echo !empty($wiz11->cath_freq)? $wiz11->cath_freq :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Color of Secretions:</span> <?php echo !empty($wiz11->cath_color)? $wiz11->cath_color :'NA' ?> </p>
				</div>
				<p class= "cozy"><span class="inline">Equipment needed for suctioning:</span> <?php echo !empty($wiz11->suction_equip)? $wiz11->suction_equip :'NA' ?> </p>
				<p class= "cozy"><span class="inline">Other Equipment Needed for School:</span> <?php echo !empty($wiz11->other_equip)? $wiz11->action :'No' ?> </p>
				<p class= "cozy"><span class="inline">Equipment Checklist Utilized:</span> <?php echo !empty($wiz11->equip_check)? $wiz11->action :'No' ?> </p>
				<p class= "cozy"><span class="inline">Evacuation/Emergency Instructions:</span> <?php echo !empty($wiz11->evac)? $wiz11->action :'NA' ?> </p>
				<p class= "cozy"><span class="inline">Additional Comments:</span> <?php echo !empty($wiz11->oxy_addtnl)? $wiz11->oxy_addtnl :'NA' ?> </p>
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