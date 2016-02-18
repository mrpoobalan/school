<?php // load dashboard admin menu
	$this->load->view("menu/top_menu");
	$back_button = array('id' =>'view_print_assessment_10', 'name' =>'view_print_assessment_10','class'=>"button", 'value'=>'View Print Page 10', 'type'=>'submit','content'=>'View Print Page 10');
	$next_button = array('id' =>'view_print_assessment_12', 'name' =>'view_print_assessment_12','class'=>"button", 'value'=>'View Print Page 12', 'type'=>'submit','content'=>'View Print Page 12');
	$attr_FormOpen = array('id'=>"assessment",'class'=>"healthform");

	print_r($wiz12);
	//print_r($wiz13);
	//print_r($wiz14);
	//print_r($wiz15);
	//print_r($wiz16);

?>
<body>
	<div id="assessment_wizard_10">
		<section class="page healthform ">
			<fieldset class="new-section">
			<legend>Orthopedics and Mobility Requirements</legend>
				<div class="cozy">
					<p class= "cozy"><span class="inline">Ambulatory:</span> <?php echo !empty($wiz12->mobility_amb)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Independent:</span> <?php echo !empty($wiz12->mobility_ind)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Needs Supervision:</span> <?php echo !empty($wiz12->mobility_ns)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Uses Walker:</span> <?php echo !empty($wiz12->mobility_uw)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Gait Trainer:</span> <?php echo !empty($wiz12->mobility_gt)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Wheelchair:</span> <?php echo !empty($wiz12->mobility_wheel)? 'Yes' :'No' ?> </p>

				</div>
				<div class="cozy">
					<h3>Wheelchair</h3>
					<p class= "cozy"><span class="inline">Manual Independent:</span> <?php echo !empty($wiz12->wc_mi)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Manual Assist:</span> <?php echo !empty($wiz12->wc_ma)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Power Independent:</span> <?php echo !empty($wiz12->wc_pi)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Power Assist:</span> <?php echo !empty($wiz12->wc_pa)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Supervision Only:</span> <?php echo !empty($wiz12->wc_so)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Special Consideration:</span> <?php echo !empty($wiz12->sc)? $wiz12->sc :'No' ?> </p>
					<p class= "cozy"><span class="inline">Equipment Provider:</span> <?php echo !empty($wiz12->equip_provider)? $wiz12->equip_provider :'No' ?> </p>
					<p class= "cozy"><span class="inline">Contact Info:</span> <?php echo !empty($wiz12->c_info)? $wiz12->c_info :'No' ?> </p>				</div>
				</div>
				<div class="cozy">
					<h3>Scoliosis Information</h3>
					<p class= "cozy"><span class="inline">Scoliosis:</span> <?php echo !empty($wiz12->scoliosis)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Last X-Ray/Exam:</span> <?php echo !empty($wiz12->sco_last)? $wiz12->sco_last :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Treatment:</span> <?php echo !empty($wiz12->sco_treat)? $wiz12->sco_treat :'NA' ?> </p>
				</div>
				<div class="cozy">
					<h3>Hip Dislocation Information</h3>
					<p class= "cozy"><span class="inline">Scoliosis:</span> <?php echo !empty($wiz12->hip)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">Last X-Ray/Exam:</span> <?php echo !empty($wiz12->hip_last)? $wiz12->sco_last :'NA' ?> </p>
					<p class= "cozy"><span class="inline">Treatment:</span> <?php echo !empty($wiz12->hip_treat)? $wiz12->sco_treat :'NA' ?> </p>
				</div>
				<div class="cozy">
					<h3>Physical Therapy Services</h3>
					<p class= "cozy"><span class="inline">Physical Therapy:</span> <?php echo !empty($wiz12->pt)? 'Yes' :'No' ?> </p>
					<p class= "cozy"><span class="inline">If Yes, where:</span> <?php echo !empty($wiz12->pt_where)? $wiz12->pt_where :'NA' ?> </p>
				</div>
				<p class= "cozy"><span class="inline">Details of Mobility Concerns:</span> <?php echo !empty($wiz12->mobi_text)? $wiz12->mobi_text :'NA' ?> </p>
				<p class= "cozy"><span class="inline">Orthotics:</span> <?php echo !empty($wiz12->orth)? 'Yes' :'No' ?> </p>

			<div class="cozy">
				<fieldset>

						<span class="inline"><input type="checkbox" name="mobility" id="mobility-amb" value="Ambulatory" /><label for="mobility-amb"><span></span> Ambulatory</label></span>
						<span class="inline"><input type="checkbox" name="mobility" id="mobility-ind" value="Independent" /><label for="mobility-ind"><span></span> Independent</label></span>
						<span class="inline"><input type="checkbox" name="mobility" id="mobility-ns" value="Needs Supervision" /><label for="mobility-ns"><span></span> Needs Supervision</label></span>
						<span class="inline"><input type="checkbox" name="mobility" id="mobility-uw" value="Uses Walker" /><label for="mobility-uw"><span></span> Uses Walker</label></span>
						<span class="inline"><input type="checkbox" name="mobility" id="mobility-gt" value="Gait Trainer" /><label for="mobility-gt"><span></span> Gait Trainer</label></span>
						<span class="inline"><input type="checkbox" name="mobility" id="mobility-wheel" value="Wheelchair" /><label for="mobility-wheel"><span></span> Wheelchair</label></span>

						<label for="wc">Wheelchair</label>
						<span class="inline"><input type="checkbox" name="wc" id="wc-mi" value="Manual Independent" /><label for="wc-mi"><span></span> Manual Independent</label></span>
						<span class="inline"><input type="checkbox" name="wc" id="wc-ma" value="Manual Assist" /><label for="wc-ma"><span></span> Manual Assist</label></span>
						<span class="inline"><input type="checkbox" name="wc" id="wc-pi" value="Power Independent" /><label for="wc-pi"><span></span> Power Independent</label></span>
						<span class="inline"><input type="checkbox" name="wc" id="wc-pa" value="Power Assist" /><label for="wc-pa"><span></span> Power Assist</label></span>
						<span class="inline"><input type="checkbox" name="wc" id="wc-so" value="Supervision Only" /><label for="wc-so"><span></span> Supervision Only</label></span>


				<fieldset>

						<label for="sc">Special Consideration</label>
						<textarea id="sc"></textarea>


						<label for="equip-provider">Equipment Provider</label>
						<input type="text" id="equip-provider" />

						<label for="c-info">Contact Info</label>
						<input type="text" id="c-info" />


				<fieldset>

						<label for="scoliosis">Scoliosis?</label>
						<span class="inline"><input type="checkbox" name="scoliosis" id="scoliosis-yes" value="Yes" /><label for="scoliosis-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="scoliosis" id="scoliosis-no" value="No" /><label for="scoliosis-no"><span></span> No</label></span>

						<label for="sco-last">Last X-Ray/Exam</label>
						<input type="text" id="sco-last" value="should become date picker" />

						<label for="sco-treat">Treatment</label>
						<input type="text" id="sco-treat" />


						<label for="hip">Hip Dislocation?</label>
						<span class="inline"><input type="checkbox" name="hip" id="hip-yes" value="Yes" /><label for="hip-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="hip" id="hip-no" value="No" /><label for="hip-no"><span></span> No</label></span>

						<label for="hip-last">Last X-Ray/Exam</label>
						<input type="text" id="hip-last" value="should become date picker" />

						<label for="hip-treat">Treatment</label>
						<input type="text" id="hip-treat" />


						<p><span>Physical Therapy Services?</span>
						Yes</p>

						<p><span>If Yes, where?</span>
						<ul>
							<li>School</li>
						</ul></p>

						<p><span>Details of Mobility Concerns</span>
						paragraph</p>


						<p><span>Orthotics?</span>
						Yes</p>
							<p><span>Splints?</span>
						<ul>
							<li>Hand</li>
							<li>Leg</li>
						</ul></p>

						<p><span>Transfer/Lift Assistance?</span>
						Hoyer</p>



						<p><span>Positioning Plan?</span>
						Yes</p>

						<p><span>If Yes, describe</span>
						paragraph</p>


						<p><span>Additional Comments</span>
						paragraph</p>

			<h3>Nutrition and Feeding Safety Requirements</h3>


						<ul>
							<li> Nothing By Mouth</li>
						</ul>

						<p><span>Texture</span>
						text</p>

						<ul>
							<li>Parent Prepares</li>
							<li> School Cafe Prepares</li>
						</ul>


						<p><span>Other Dietary Restriction</span>
						paragraph</p>

						<p><span>Fluid Consistency/Restrictions</span>
						paragraph</p>

						<p><span>Feeding Assistance Needed?</span>
						Yes</p>

						<label for="feeding-type">If Yes, what assistance is needed?</label>
						<ul>
							<li>Opening containers</li>
							<li>Cutting food</li>
						</ul>


						<p><span>Feeding Tube?</span>
						G/J Tube</p>


						<p><span>G-Tube Size</span>
						text</p>

						<p><span>Type</span>
						test</p>


						<p><span>Instructions if dislodged at school</span>
						paragraph</p>


						<p><span>Tube Feedings</span>
						Bolus</p>

						<p><span>Type/Time/Frequency (in hours)/Amount</span>
						text</p>


						<p><span>Water Flush?</span>
						Yes</p>

						<p><span>Free Water?</span>
						Yes</p>

						<p><span>Fundoplication?</span>
						Yes</p>



						<p><span>Last Swallow Study</span>
						Endo</p>

						<p><span>Date of Study</span>
						text</p>

						<p><span>Location of Study</span>
						text</p>



						<p><span>Reflux?</span>
						Yes</p>

						<p><span>Treatment</span>
						text</p>

						<p><span>Ordering MD</span>
						text</p>

						<p><span>Feeding Clinic?</span>
						Yes</p>

						<p><span>Where and How Often?</span>
						paragraph</p>


						<p><span>AACPS SMART Team Managing?</span>
						Yes</p>

						<p><span>Case Manager</span>
						text</p>


						<p><span>Mealtime Plan of Care</span>
						paragraph</p>


						<p><span>Additional Comments</span>
						paragraph</p>

			<h3>Diabetes Management</h3>

						<p><span>Tests blood glucose at school?</span>
						No</p>

						<p><span>When should student test?</span>

							<ul>
								<li>Before Breakfast</li>
								<li>Before Dismissal</li>
								<li>PRN if symptomatic</li>
							</ul></p>


						<p><span>Level of Independence</span>
						Dependent</p>


						<p><span>If assistance is needed, describe</span>
						paragraph</p>



						<p><span>Target Range</span>
						text</p>

						<p><span>Insulin Type</span>
						<ul>
							<li>Syringe</li>
							<li>Insulin Pen</li>
						</ul></p>

						<p><span>Manufacturer</span>
						text</p>


						<p><span>Insulin at school?</span>
						Yes</p>

						<p><span>Type of insulin</span>
						text</p>

						<p><span>How is dose calculated?</span>
						Pump calculations</p>


						<p><span>Insulin before lunch?</span>
						Yes</p>

						<p><span>Lunch Correction Factor</span>
						text</p>

						<p><span>Insulin for Snack Order?</span>
						Yes</p>


						<p><span>Counts Carbs?</span>
						Yes</p>

						<p><span>Lunch Carb Ratio</span>
						text</p>

						<p><span>Snack Carb Ratio</span>
						text</p>


						<p><span>Insulin may be given after lunch if</span>
						paragraph</p>

						<p><span>Breakfast at School?</span>
						Yes</p>

						<p><span>Breakfast Carb Ratio</span>
						paragraph</p>


						<p><span>Glucagon at School?</span>
						Yes</p>

						<p><span>Glucagon Order (dose/symptoms)</span>
						paragraph</p>


						<p><span>Treatment for Hypoglycemia</span>
						paragraph</p>

					<p><span>Emergency Kit</span>
						<ul>
							<li>In HR</li>
						</ul></p>


						<p><span>Emergency Kit Contents</span>
						<ul>
							<li>Juice</li>
							<li>Snack(s): Snack type from emer-snacks</li>
						</ul></p>


						<p><span>Treatment for Hyperglycemia</span>
						paragraph</p>

						<p><span>Insulin for Keytones</span>
						Yes</p>

						<p><span>Insulin for Keytones Order</span>
						text</p>

						<p><span>Discretionary Orders</span>
						Yes</p>

						<p><span>If yes, please list</span>
						paragraph</p>


						<p><span>Home Insulin Order</span>
						text</p>

						<p><span>Lock Down Insulin Orders</span>
						text</p>

						<p><span>Additional Comments</span>
						paragraph</p>



			<h3>Transportation Status</h3>


						<p><span>Method of Transportation</span>
						<ul>
							<li>Bus Rider</li>
							<li>Lift Bus</li>
						</ul></p>

						<p><span>Current Bus Services Provided</span>
						<ul>
							<li>Aide on Bus</li>
							<li>Nursing Services on Bus</li>
						</ul></p>

						<p><span>Medication on Bus?</span>
						Yes</p>

						<p><span>If Yes, List</span>
						paragraph</p>


						<p><span>How is medication handled?</span>
						Self Carries/Self Administers</p>



						<p><span>Snacks on Bus</span>
						Yes</p>

						<p><span>Special Modifications Needed for Bus?</span>
						Yes</p>


						<p><span>If Yes, List Special Modifications Needed</span>
						paragraph</p>

					<section class="largetext">
						<p><span>Additional Comments</span>
						paragraph<p>





			<h3>Additional Information</h3>
				<p><span>Enter any additional information or cultural beliefs</span>
				paragraph</p>


			<h3>HCAP/Emergency Plans</h3>

						<p><span>Seizure Plans</span>
						<ul>
							<li>Teachers</li>
							<li>HR File</li>
						</ul></p>

						<p><span>Date Reviewed</span>
						3/14/14</p>

						<p><span>Date Distributed</span>
						3/14/14</p>



						<p><span>Hypo/Hyperglycemia Plans</span>
						<ul>
							<li>Teachers</li>
							<li>HR File</li>
						</ul></p>

						<p><span>Date Reviewed</span>
						3/14/14</p>

						<p><span>Date Distributed</span>
						3/14/14</p>


						<p><span>Allergy Plans</span>
						<ul>
							<li>Teachers</li>
							<li>HR File</li>
						</ul></p>

						<p><span>Date Reviewed</span>
						3/14/14</p>

						<p><span>Date Distributed</span>
						3/14/14</p>


						<p><span>G-Tube Replacement Plans</span>
						<ul>
							<li>Teachers</li>
							<li>HR File</li>
						</ul></p>

						<p><span>Date Reviewed</span>
						3/14/14</p>

						<p><span>Date Distributed</span>
						3/14/14</p>



						<p><span>Cardiac Plans</span>
						<ul>
							<li>Teachers</li>
							<li>HR File</li>
						</ul></p>

						<p><span>Date Reviewed</span>
						3/14/14</p>

						<p><span>Date Distributed</span>
						3/14/14</p>



						<p><span>Respiratory Distress Plans</span>
						ul>
							<li>Teachers</li>
							<li>HR File</li>
						</ul></p>
						<p><span>Date Reviewed</span>
						3/14/14</p>

						<p><span>Date Distributed</span>
						3/14/14</p>




						<p><span>Emergency Exit Plans</span>
						<ul>
							<li>Teachers</li>
							<li>HR File</li>
						</ul></p>

						<p><span>>Date Reviewed</span>
						3/14/14</p>

						<p><span>Date Distributed</span>
						3/14/14</p>


			</div>




			<h3>Needs for School Attendance</h3>
			<p><span>Delegatable Nursing Services During the School Day </span>
			paragraph</p>


						<p><span>Non-Delegatable Nursing Services During the School Day</span>
						paragraph</p>




						<p><span>Parents Will Provide</span>
						paragraph</p>


						<p><span>School Will Provide</span>
						paragraph</p>





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