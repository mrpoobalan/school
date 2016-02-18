	<p><span>SIF Number</span>
	123456789
	</p>
			
				<p><span>State Number</span>
					12345
				</p>
				
				<p><span>First Name</span>
					Name</p>
				<p><span>Last Name</span>
					Name</p>
				<p><span>Nickname</span>
					Name</p>
			<p><span>Date of Birth</span>
				06/16/2001
			<p><span>Parent(s)/Guardian(s)</span>
				Person A and Person B</p>
			
				<p><span>Address</span>
				Street Address<br />
				City, MD Zip Code</p>

				<p><span>>Home Phone Number</span>
				410-765-4321</p>

				<p><span>Cell Phone Number</span>
				123-456-7890</p>

			<p><span>Work Phone Number</span>
				202-213-2345</p>
				
				<p><span>Additional Contact</span>
				Person C</p>
			
				<p><span>Cell Phone Number</span>
				301-908-7890</p>
			<p><span>Home Phone Number</span>
				443-699-9087</p>
			<p><span>Work Phone Number</span>
				212-234-6543</p>
			
				<p><span>Insurance</span>
				<ul>
					<li>Private</li>
					<li>MCHP</li>
					<li>Medicaid</li>
					<li>Other: Other text value</li>
				</ul></p>
				
				<p><span>Preferred Hospital</span>
					Hospital Name</p>
			<p><span>Immunization Current?</span>
				Yes</p>
				
			<p><span>Exemption Type</span>
				<ul>
					<li>Religious Exemption</li>
				<li>Medical Exemption: enter medical exemption text here</li>
			</ul></p>
			
			<p><span>Contact Attempts</span>
				<ul>
					<li>01/14/2014</li>
					<li>02/01/2014</li>
				</ul></p>
				
				<p><span>Type of Assessment</span>
				Initial Assessment</p>

		<p><span>Educational Status</span>
			<ul>
				<li>ITP</li>
				<li>ECI</li>
				<li>IEP</li>
			</ul></p>
				<p><span>Current Grade</span>
				3rd</p>
			<p><span>Current Individual Educational Assistant?</span>
				No</p>
			<p><span>Services Used</span>
				<ul>
					<li>Occupational Therapy</li>
					<li>Counseling</li>
				</ul></p>
			<p><span>Off Location Teaching>
				<ul>
					<li>Home Hospital Teaching</li>
					<li>Concurrent Home Teaching</li>
				</ul></p>
				<p><span>Re-Evaluation Date</span>
				10/20/2013</p>
			
			
				<p><span>Assistive Technology</span>
				No</p>
				<p><span>Please List Assistive Technology</span>
				paragraph of text</p>
			
			
				<p><span>Classroom Accomodations</span>
				No</p>
				<p><span>Please List Classroom Accomodations</span>
				paragraph of text</p>
			
		
		
			<h3>Individualized Healthcare Plan</h3>
			<p><span>IHP?</span>
			Yes</p>

			<p class="note">If Yes, please see Individualized Healthcare Plan</p>

		
		
			<h3>Medical Diagnosis</h3>
			<ul>
				<li>diagnosis 1</li>
				<li>diagnosis 2</li>
			</ul>
			
		
			<h3>Background</h3>
			
				<p><span>Birth Weight</span>
				7 lbs</p>

				<p><span>Gestation</span>
				37 weeks</p>

				<p><span>Birth Type</span>
				C-Section</p>
			
			
				<p><span>Developmental Milestones Met</span>
				No</p>
				
				<p><span>If No, please describe</span>
				paragraph here</p>
			
			
				<span for="complications">Complications</span>
				<textarea id="complications"></textarea>
			
			
				<span for="emergencies">Emergencies, Hospitalizations, or Surgeries</span>
				<textarea id="emergencies"></textarea>
			
		
		
			<h3>History of Diagnosis/Current Health Status</h3>
			<span for="previous">See Previous Nursing Assessment Dated</span>
			<input type="text" id="previous" value="should become date picker" />
			<span for="narrative">Narrative</span>
			<textarea id="narrative"></textarea>

		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
				
			</div>
			<div class="clear"></div>
		
		
			<h3>Physicians</h3>
			
				<label for="primary">Primary Care</label>
				<input type="text" id="primary" />
				<label for="lastexam1">Last Exam</label>
				<input type="text" id="lastexam1" />
				<label for="nextexam1">Next Exam</label>
				<input type="text" id="nextexam1" />
				<label for="phone1">Phone</label>
				<input type="text" id="phone1" />
				<label for="fax1">Fax</label>
				<input type="text" id="fax1" />
				<label for="release1">Release?</label>
				<span class="inline"><input type="checkbox" name="release1" value="Yes" id="release1-yes" /> <label for="release1-yes"><span></span>Yes</label></span>
				<span class="inline"><input type="checkbox" name="release1" value="No" id="release1-no" /> <label for="release1-no"><span></span>No</label></span>
				<label for="release-exp1">Release Expiration</label>
				<input type="text" id="release-exp1" value="should become date picker" />
			
			
				<label for="specialist1">Specialist</label>
				<input type="text" id="specialist1" />
				<label for="lastexam2">Last Exam</label>
				<input type="text" id="lastexam2" />
				<label for="nextexam2">Next Exam</label>
				<input type="text" id="nextexam2" />
				<label for="phone2">Phone</label>
				<input type="text" id="phone2" />
				<label for="fax2">Fax</label>
				<input type="text" id="fax2" />
				<label for="release2">Release?</label>
				<span class="inline"><input type="checkbox" name="release2" value="Yes" id="release2-yes" /> <label for="release2-yes"><span></span>Yes</label></span>
				<span class="inline"><input type="checkbox" name="release2" value="No" id="release2-no" /> <label for="release2-no"><span></span>No</label></span>
				<label for="release-exp2">Release Expiration</label>
				<input type="text" id="release-exp2" value="should become date picker" />
			
			
				<p><a href="javascript:addNewDr()">Add New Specialist</a></p>
			
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(1)" id="hide1" /> <label for="hide1"><span></span>Section Does Not Apply</label></span>
			<h3>Dentist, Hearing, and Vision</h3>
			<div  id="section1">
				
					<label for="dentist">Dentist</label>
					<input type="text" id="dentist" />
					<label for="dentalexam">Exam Date</label>
					<input type="text" id="dentalexam" value="should become date picker" />
					<label for="dentalhistory">History and Treatment</label>
					<textarea id="dentalhistory"></textarea>
					<label for="dentalrelease">Release?</label>
					<span class="inline"><input type="checkbox" name="dentalrelease" value="Yes" id="dentalrelease-yes" /> <label for="dentalrelease-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="dentalrelease" value="No" id="dentalrelease-no" /> <label for="dentalrelease-no"><span></span>No</label></span>
				
				
					<label for="hearing">Hearing</label>
					<input type="text" id="hearing" />
					<label for="hearingexam">Exam Date</label>
					<input type="text" id="hearingexam" value="should become date picker" />
					<label for="hearinghistory">History and Treatment</label>
					<textarea id="hearinghistory"></textarea>
					<label for="hearingrelease">Release?</label>
					<span class="inline"><input type="checkbox" name="hearingrelease" value="Yes" id="hearingrelease-yes" /> <label for="hearingrelease-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="hearingrelease" value="No" id="hearingrelease-no" /> <label for="hearingrelease-no"><span></span>No</label></span>
				
				
					<label for="vision">Vision</label>
					<input type="text" id="vision" />
					<label for="visionexam">Exam Date</label>
					<input type="text" id="visionexam" value="should become date picker" />
					<label for="visionhistory">History and Treatment</label>
					<textarea id="visionhistory"></textarea>
					<label for="visionrelease">Release?</label>
					<span class="inline"><input type="checkbox" name="visionrelease" value="Yes" id="visionrelease-yes" /> <label for="visionrelease-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="visionrelease" value="No" id="visionrelease-no" /> <label for="visionrelease-no"><span></span>No</label></span>
				
			</div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(2)" id="hide2" /> <label for="hide2"><span></span>Section Does Not Apply</label></span>
			<h3>Agencies and Case Managers</h3>
			<div id="section2">
				
					<label for="name1">Name</label>
					<input type="text" id="name1" />
					<label for="phone2">Phone</label>
					<input type="text" id="agencyphone1" />
					<label for="fax2">Fax</label>
					<input type="text" id="agencyfax1" />
					<label for="agencyrelease1">Release?</label>
					<span class="inline"><input type="checkbox" name="agencyrelease1" value="Yes" id="agencyrelease1-yes" /> <label for="agencyrelease1-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="agencyrelease1" value="No" id="agencyrelease1-no" /> <label for="agencyrelease1-no"><span></span>No</label></span>
				
				
					<p><a href="javascript:addNewAgency()">Add New Agency or Case Manager</a></p>
				
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
				
			</div>
			<div class="clear"></div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(3)" id="hide3" /> <label for="hide3"><span></span>Section Does Not Apply</label></span>
			<h3>Daily Medications</h3>
			<div id="section3">
				
					<label for="med1">Medication Name</label>
					<input type="text" id="med1" />
					<label for="dose1">Dosage</label>
					<input type="text" id="dose1" />
					<label for="time1">Time/Frequency</label>
					<input type="text" id="time1" />
					<label for="route1">Route</label>
					<input type="text" id="route1" />
					<label for="taken1">Taken:</label>
					<span class="inline"><input type="checkbox" name="taken1" value="At School" id="taken1-school" /> <label for="taken1-school"><span></span>At School</label></span>
					<span class="inline"><input type="checkbox" name="taken1" value="At Home" id="taken1-home" /> <label for="taken1-home"><span></span>At Home</label></span>
				
				
					<p><a href="javascript:addNewMed()">Add New Daily Medication</a></p>
				
			</div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(4)" id="hide4" /> <label for="hide4"><span></span>Section Does Not Apply</label></span>
			<h3>PRN Medications</h3>
			<div id="section4">
				
					<label for="prnmed1">Medication Name</label>
					<input type="text" id="prnmed1" />
					<label for="prndose1">Dosage</label>
					<input type="text" id="prndose1" />
					<label for="prntime1">Time/Frequency</label>
					<input type="text" id="prntime1" />
					<label for="prnroute1">Route</label>
					<input type="text" id="prnroute1" />
					<label for="prntaken1">Taken:</label>
					<div class="check-group">
						<span class="inline"><input type="checkbox" name="prntaken1" value="At School" id="prntaken1-school" /> <label for="prntaken1-school"><span></span>At School</label></span>
						<span class="inline"><input type="checkbox" name="prntaken1" value="At Home" id="prntaken1-home" /> <label for="prntaken1-home"><span></span>At Home</label></span>
						<span class="inline"><input type="checkbox" name="prntaken1" value="In Emergency" id="prntaken1-emergency" /> <label for="prntaken1-emergency"><span></span>In Emergency</label></span>
					</div>
				
				
					<p><a href="javascript:addNewMed()">Add New PRN Medication</a></p>
				
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
				
			</div>
			<div class="clear"></div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(5)" id="hide5" /> <label for="hide5"><span></span>Section Does Not Apply</label></span>
			<h3>Treatments</h3>
			<div id="section5">
				
					<label for="treatment1">Treatment Order</label>
					<input type="text" id="treatment1" />
					<label for="frequency1">Frequency</label>
					<input type="text" id="frequency1" />
					<label for="taken1">Peformed:</label>
					<span class="inline"><input type="checkbox" name="performed1" value="At School" id="performed1-school" /> <label for="performed1-school"><span></span>At School</label></span>
					<span class="inline"><input type="checkbox" name="performed1" value="At Home" id="performed1-home" /> <label for="performed1-home"><span></span>At Home</label></span>
					<label for="person1">Person Performing</label>
					<input type="text" id="person1" />
				
			</div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(6)" id="hide6" /> <label for="hide6"><span></span>Section Does Not Apply</label></span>
			<h3>Allergies</h3>
			<div id="section6">
				
					<label for="allergy1">Allergic to</label>
					<input type="text" id="allergy1" />
					<label for="reaction1">Reaction</label>
					<input type="text" id="reaction1" />
					<label for="deadly">Life Threatening?</label>
					<span class="inline"><input type="checkbox" name="deadly1" value="Yes" id="deadly1-yes" /> <label for="deadly1-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="deadly1" value="No" id="deadly1-no" /> <label for="deadly1-no"><span></span>No</label></span>
					<label for="sensitivity1">Sensitivity Level</label>
					<div class="check-group">
						<span class="inline"><input type="checkbox" name="sensitivity1" value="Touch/Contact" id="sensitivity1-touch" /> <label for="sensitivity1-touch"><span></span>Touch/Contact</label></span>
						<span class="inline"><input type="checkbox" name="sensitivity1" value="Ingest" id="sensitivity1-ingest" /> <label for="sensitivity1-ingest"><span></span>Ingestion</label></span>
						<span class="inline"><input type="checkbox" name="sensitivity1" value="Air" id="sensitivity1-air" /> <label for="sensitivity1-air"><span></span>Air</label></span>
					</div>
				
				
					<label for="treatment1">Treatment</label>
					<span class="inline"><input type="checkbox" name="treatment1" value="Epi Pen" id="treatment1-epi" /> <label for="treatment1-epi"><span></span>Epi Pen</label></span>
					<span class="inline"><input type="checkbox" name="treatment1" value="Antihistamine" id="treatment1-antihistamine" /> <label for="treatment1-antihistamine"><span></span>Antihistamine</label></span>
					<label for="ah1">Which Antihistamine?</label>
					<input type="text" id="ah1" />
					<label for="diagnosed1">How was the allergy diagnosed?</label>
					<div class="check-group">
						<span class="inline"><input type="checkbox" name="diagnosed1" value="Exposure" id="diagnosed1-exposure" /> <label for="diagnosed1-exposure"><span></span>Exposure</label></span>
						<span class="inline"><input type="checkbox" name="diagnosed1" value="Allergy Testing and Exposure" id="diagnosed1-testingexposure" /> <label for="diagnosed1-testingexposure"><span></span>Allergy Testing and Exposure</label></span>
						<span class="inline"><input type="checkbox" name="diagnosed1" value="Allergy Testing/Never Exposed" id="diagnosed1-testing" /> <label for="diagnosed1-testing"><span></span>Allergy Testing/Never Exposed</label></span>
					</div>
					<label for="lastevent1">Last Event</label>
					<input type="text" id="lastevent1">
				
				<section class="largetext">
					<label for="addtnlcomments1">Additional Comments</label>
					<textarea id="addtnlcomments1"></textarea>
				
				
					<p><a href="javascript:addNewAllergy()">Add New Allergy</a></p>
				
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
			</div>
			<div class="clear"></div>
		
		
			
			<h3>Communication/Vision/Hearing Requirements</h3>
			<div id="section7">
				
					<label for="need-type">Select Requirement Type</label>
					<div class="check-group">
						<span><input type="checkbox" name="need-type" value="Verbal" id="need-type-verbal" /> <label for="need-type-verbal"><span></span>Verbal</label></span>
						<span><input type="checkbox" name="need-type" value="Non-Verbal" id="need-type-nonverbal" /> <label for="need-type-nonverbal"><span></span>Non-Verbal</label></span>
						<span><input type="checkbox" name="need-type" value="Speech/Language Needs" id="need-type-speech" /> <label for="need-type-speech"><span></span>Speech/Language Needs</label></span>
						<span><input type="checkbox" name="need-type" value="Audiology Needs" id="need-type-audiology" /> <label for="need-type-audiology"><span></span>Audiology Needs</label></span>
						<span><input type="checkbox" name="need-type" value="Vision Needs" id="need-type-vision" /> <label for="need-type-vision"><span></span>Vision Needs</label></span>
						<span><input type="checkbox" name="need-type" value="Signs/Gestures" id="need-type-signs" /> <label for="need-type-signs"><span></span>Signs/Gestures</label></span>
						<span><input type="checkbox" name="need-type" value="Expressions" id="need-type-expressions" /> <label for="need-type-expressions"><span></span>Expressions</label></span>
						<span><input type="checkbox" name="need-type" value="Cries/Smiles" id="need-type-cries" /> <label for="need-type-cries"><span></span>Cries/Smiles</label></span>
						<span><input type="checkbox" name="need-type" value="Pictures" id="need-type-pictures" /> <label for="need-type-pictures"><span></span>Pictures</label></span>
						<span><input type="checkbox" name="need-type" value="No Communication" id="need-type-nocommunication" /> <label for="need-type-nocommunication"><span></span>No Communication</label></span>
					</div>
				
				
					<label for="devices">Assistive Communication Devices?</label>
					<span class="inline"><input type="checkbox" name="devices" value="Yes" id="devices-yes" /> <label for="devices-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="devices" value="No" id="devices-no" /> <label for="devices-no"><span></span>No</label></span>
					<label for="device-describe">If Yes, Describe</label>
					<textarea id="device-describe"></textarea>
				
				
					<label for="devicelist">Device(s) Used</label>
					<span><input type="checkbox" name="devicelist" value="Wears Glasses" id="devicelist-glasses" /> <label for="devicelist-glasses"><span></span>Wears Glasses</label></span>
					<span><input type="checkbox" name="devicelist" value="Wears Hearing Aid" id="devicelist-hearingaid" /> <label for="devicelist-hearingaid"><span></span>Wears Hearing Aid</label></span>
					<span><input type="checkbox" name="devicelist" value="Wears Cochlear Implant" id="devicelist-cochlear" /> <label for="devicelist-cochlear"><span></span>Wears Cochlear Implant</label></span>
					<span><input type="checkbox" name="devicelist" value="FM System" id="devicelist-fm" /> <label for="devicelist-fm"><span></span>FM System</label></span>
					<label for="hearing-screening">Last Hearing Screening</label>
					<input type="text" id="hearing-screening" value="should become datepicker" />
					<label for="vision-screening">Last Vision Screening</label>
					<input type="text" id="vision-screening" value="should become datepicker" />
				
				<section class="largetext">
					<label for="communication-comments">Additional Comments</label>
					<textarea id="communication-comments"></textarea>
				
			</div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(8)" id="hide8" /> <label for="hide8"><span></span>Section Does Not Apply</label></span>
			<h3>Neurological Requirements</h3>
			<div id="section8">
				
					<label for="seizures">Seizures Disorder</label>
					<span class="inline"><input type="checkbox" name="seizures" value="Yes" id="seizures-yes" /> <label for="seizures-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="seizures" value="No" id="seizures-no" /> <label for="seizures-no"><span></span>No</label></span>
					<label for="seizure-type">If yes, type:</label>
					<input type="text" id="seizure-type" />
					<label for="last-seizure-exam">Last Exam</label>
					<input type="text" id="last-seizure-exam" value="should become date picker" />
					<label for="onset-age">Age of Onset</label>
					<input type="text" id="onset-age" />
				
				
					<label for="shunt">Shunt?</label>
					<span class="inline"><input type="checkbox" name="shunt" value="Yes" id="shunt-yes" /> <label for="shunt-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="shunt" value="No" id="shunt-no" /> <label for="shunt-no"><span></span>No</label></span>
					<label for="shunt-type">If yes, type:</label>
					<input type="text" id="shunt-type" />
					<label for="placement-date">Date of Shunt Placement</label>
					<input type="text" id="shunt-placement" />
					<label for="last-revision">Date of Last Revision</label>
					<input type="text" id="last-revision" value="should become date picker" />
						
				
					<label for="last-seizure">Date of Last Seizure</label>
					<input type="text" id="last-seizure" />
					<label for="usual-duration">Usual Duration</label>
					<input type="text" id="usual-duration" />
					<label for="seizure-frequency">Frequency of Seizures</label>
					<input type="text" id="seizure-frequncy" />
					<label for="status-epilectus">Hx of Status Epilecticus</label>
					<input type="text" id="status-epilectus" />
				
				
					<label for="triggers">Triggers</label>
					<textarea id="triggers"></textarea>
					<label for="ketogenic">Ketogenic Diet?</label>
					<span class="inline"><input type="checkbox" name="ketogenic" value="Yes" id="ketogenic-yes" /> <label for="ketogenic-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="ketogenic" value="Yes" id="ketogenic-no" /> <label for="ketogenic-no"><span></span> No</label></span>
					<label for="seizure-treatment">Treatment</label>
					<span><input type="checkbox" name="seizure-treatment" value="Diastat" id="treatment-diastat" /> <label for="treatment-diastat"><span></span>Diastat</label></span>
					<span><input type="checkbox" name="seizure-treatment" value="Oxygen" id="treatment-oxygen" /> <label for="treatment-oxygen"><span></span>Oxygen</label></span>
					<span><input type="checkbox" name="seizure-treatment" value="Vagal Nerve Stimulator" id="treatment-vagal" /> <label for="treatment-vagal"><span></span>Vagal Nerve Stimulator</label></span>
					<span><input type="checkbox" name="seizure-treatment" value="Medication (see medication list)" id="treatment-medication" /> <label for="treatment-medication"><span></span>Medication (see medication list)</label></span>
				
				
					<label for="post-seizure">Post Seizure Activity</label>
					<textarea id="post-seizure"></textarea>
					<label for="aura">Aura?</label>
					<span class="inline"><input type="checkbox" name="aura" value="Yes" id="aura-yes" /> <label for="aura-yes"><span></span>Yes</label></span>
					<span class="inline"><input type="checkbox" name="aura" value="No" id="aura-no" /> <label for="aura-no"><span></span>No</label></span>
					<label for="aura-description">If Yes, Describe</label>
					<textarea id="aura-description"></textarea>
				
				<section class="largetext">
					<label for="seizure-comments">Additional Comments</label>
					<textarea id="seizure-comments">(episode description, safety needs)</textarea>
				
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
			</div>
			<div class="clear"></div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(9)" id="hide9" /> <label for="hide9"><span></span>Section Does Not Apply</label></span>
			<h3>Elimination Requirements</h3>
			<div id="section9">
				
					<span class="inline"><input type="checkbox" name="elimination" value="Independent" id="elimination-independent" /> <label for="elimination-independent"><span></span>Independent</label></span>
					<span class="inline"><input type="checkbox" name="elimination" value="Scheduled" id="elimination-scheduled" /> <label for="elimination-scheduled"><span></span>Scheduled</label></span>
					<span class="inline"><input type="checkbox" name="elimination" value="Prompted" id="elimination-prompted" /> <label for="elimination-prompted"><span></span>Prompted</label></span>
					<span class="inline"><input type="checkbox" name="elimination" value="Diapered" id="elimination-diapered" /> <label for="elimination-diapered"><span></span>Diapered</label></span>
				
				<section class="clear threecol">
					<label for="continence">Continence</label>
					<span><input type="checkbox" name="continence" value="Continent" id="continence-continent" /><label for="continence-continent"><span></span> Continent</label></span>
					<span><input type="checkbox" name="continence" value="Incontinent - Bowel" id="continence-incontinent-bowel" /><label for="continence-incontinent-bowel"><span></span> Incontinent - Bowel</label></span>
					<span><input type="checkbox" name="continence" value="Incontinent - Bladder" id="continence-incontinent-bladder" /><label for="continence-incontinent-bladder"><span></span> Incontinent - Bladder</label></span>
				
				<section class="threecol">
					<label for="toilet-type">Toilet Type</label>
					<span><input type="checkbox" name="toilet-type" value="Toilet" id="toilet-toilet" /><label for="toilet-toilet"><span></span> Toilet</label></span>
					<span><input type="checkbox" name="toilet-type" value="Changing Table" id="toilet-changing-table" /><label for="toilet-changing-table"><span></span> Changing Table</label></span>
					<span><input type="checkbox" name="toilet-type" value="Commode" id="toilet-commode" /><label for="toilet-commode"><span></span> Commode</label></span>
					<span><input type="checkbox" name="toilet-type" value="Other" id="toilet-other" /><label for="toilet-other"><span></span> Other</label></span>
					<input type="text" id="other-toilet" value="enter other" />
				
				<section class="threecol norightmargin">
					<label for="toileted">Student Toileted?</label>
					<span><input type="checkbox" name="toileted" value="In HR" id="toileted-inhr" /><label for="toileted-inhr"><span></span> In HR</label></span>
					<span><input type="checkbox" name="toileted" value="In Bathroom" id="toileted-bath" /><label for="toileted-bath"><span></span> In Bathroom</label></span>
					<span><input type="checkbox" name="toileted" value="Other" id="toileted-other" /><label for="toileted-other"><span></span> Other</label></span>
					<input type="text" id="toileted-other" value="Enter Other" />
				
			<fieldset>
				<section class="clear">
					<label for="regime">Bowel Regime</label>
					<span class="inline"><input type="checkbox" name="regime" id="regime-yes" value="Yes" /><label for="regime-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="regime" id="regime-no" value="No" /><label for="regime-no"><span></span> No</label></span>
				
				
					<label for="constipation">History of Constipation?</label>
					<span class="inline"><input type="checkbox" name="constipation" id="constipation-yes" value="Yes" /><label for="constipation-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="constipation" id="constipation-no" value="No" /><label for="constipation-no"><span></span> No</label></span>
				
				
					<label for="constipation-mgmnt">Management</label>
					<textarea id="constipation-mgmnt"></textarea>
				
				<section class="clear">
					<label for="colostomy">Colostomy?</label>
					<span class="inline"><input type="checkbox" name="colostomy" id="colostomy-yes" value="Yes" /><label for="colostomy-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="ccolostomy" id="colostomy-no" value="No" /><label for="colostomy-no"><span></span> No</label></span>
					<label for="colostomy-mgmnt">Management</label>
					<textarea id="colostomy-mgmnt"></textarea>
				
				
					<label for="bladder">Bladder Regime?</label>
					<span class="inline"><input type="checkbox" name="bladder" id="bladder-yes" value="Yes" /><label for="bladder-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="bladder" id="bladder-no" value="No" /><label for="bladder-no"><span></span> No</label></span>
					<label for="bladder-mgmnt">Management</label>
					<textarea id="bladder-mgmnt"></textarea>
				
			
			<fieldset  class="threecol">	
				
					<label for="catheter">Urinary Catheterization?</label>
					<span class="inline"><input type="checkbox" name="catheter" id="catheter-yes" value="Yes" /><label for="catheter-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="catheter" id="catheter-no" value="No" /><label for="catheter-no"><span></span> No</label></span>
					
					<label for="self-catheter">Self-Catheterization?</label>
					<span class="inline"><input type="checkbox" name="self-catheter" id="self-catheter-yes" value="Yes" /><label for="self-catheter-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="self-catheter" id="self-catheter-no" value="No" /><label for="self-catheter-no"><span></span> No</label></span>
				
					<label for="cath-size">Catheter Size</label>
					<input type="text" id="cath-size" />

					<label for="cath-freq">Frequency</label>
					<input type="text" id="cath-freq" />
				
				
				
					<label for="menstruation">Menstruation?</label>
					<span class="inline"><input type="checkbox" name="menstruation" id="menstruation-yes" value="Yes" /><label for="menstruation-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="menstruation" id="menstruation-no" value="No" /><label for="menstruation-no"><span></span> No</label></span>
				
					<label for="menstruation-mgmt">Management</label>
					<textarea id="menstruation-mgmt"></textarea>
				

				
					<label for="stoma">Stoma?</label>
					<span class="inline"><input type="checkbox" name="stoma" id="stoma-yes" value="Yes" /><label for="stoma-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="stoma" id="stoma-no" value="No" /><label for="stoma-no"><span></span> No</label></span>
				
					<label for="diabetic">Diabetic Student?</label>
					<span class="inline"><input type="checkbox" name="diabetic" id="diabetic-yes" value="Yes" /><label for="diabetic-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="diabetic" id="diabetic-no" value="No" /><label for="diabetic-no"><span></span> No</label></span>
					
					<label for="br-privileges">Liberal Bathroom Privileges?</label>
					<span class="inline"><input type="checkbox" name="br-privileges" id="br-privileges-yes" value="Yes" /><label for="br-privileges-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="br-privileges" id="br-privileges-no" value="No" /><label for="br-privileges-no"><span></span> No</label></span>
				
				<section class="largetext">
					<label for="elimination-addtnl">Additional Comments</label>
					<textarea id="elimination-addtnl"></textarea>
				

			
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
			</div>
			<div class="clear"></div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(10)" id="hide10" /> <label for="hide10"><span></span>Section Does Not Apply</label></span>
			<h3>Cardiac Requirements</h3>
			<div id="section10">
				<section class="largetext">
					<label for="cardiac-history">Cardiac History</label>
					<textarea id="cardiac-history"></textarea>
				
				<fieldset class="threecol">
					
						<label for="restrictions">Restrictions?</label>
						<span class="inline"><input type="checkbox" name="restrictions" id="restrictions-yes" value="Yes" /><label for="restrictions-yes" /><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="restrictions" id="restrictions-no" value="No" /><label for="restrictions-no" /><span></span> No</label></span>
						<label for="restrict-list">If yes, please list:</label>
						<textarea id="restrict-list"></textarea>
						<label for="baseline">Baseline Vital Signs</label>
						<textarea id="baseline"></textarea>
					
					
						<label for="distress">Symptoms of Distress</label>
						<span><input type="checkbox" name="distress" id="distress-pain" value="Chest Pain/Tightness" /><label for="distress-pain"><span></span> Chest Pain/Tightness</label></span>
						<span><input type="checkbox" name="distress" id="distress-breath" value="Shortness of Breath" /><label for="distress-breath"><span></span> Shortness of Breath</label></span>
						<span><input type="checkbox" name="distress" id="distress-palpitations" value="Palpitations" /><label for="distress-palpitations"><span></span> Palpitations</label></span>
						<span><input type="checkbox" name="distress" id="distress-diaphoresis" value="Diaphoresis" /><label for="distress-diaphoresis"><span></span> Diaphoresis</label></span>
						<span><input type="checkbox" name="distress" id="distress-fatigue" value="Fatigue" /><label for="distress-fatigue"><span></span> Fatigue</label></span>
						<span><input type="checkbox" name="distress" id="distress-dyspnea" value="Dyspnea on Exertion" /><label for="distress-dyspnea"><span></span> Dyspnea on Exertion</label></span>
						<span><input type="checkbox" name="distress" id="distress-fainting" value="Fainting" /><label for="distress-fainting"><span></span> Fainting</label></span>
						<span><input type="checkbox" name="distress" id="distress-other" value="Other" /><label for="distress-other"><span></span> Other</label></span>
						<input type="text" id="symptom-other" value="enter other symptom" />
					
					
						<label for="pacemaker">Pacemaker?</label>
						<span><input type="checkbox" name="pacemaker" id="pacemaker-yes" value="Yes" /><label for="pacemaker-yes"><span></span> Yes</label></span>
						<span><input type="checkbox" name="pacemaker" id="pacemaker-no" value="No" /><label for="pacemaker-no"><span></span> No</label></span>

						<label for="defib">Internal Defibrillator?</label>
						<span><input type="checkbox" name="defib" id="defib-yes" value="Yes" /><label for="defib-yes"><span></span> Yes</label></span>
						<span><input type="checkbox" name="defib" id="defib-no" value="No" /><label for="defib-no"><span></span> No</label></span>

						<label for="aed">Personal AED?</label>
						<span><input type="checkbox" name="aed" id="aed-yes" value="Yes" /><label for="aed-yes"><span></span> Yes</label></span>
						<span><input type="checkbox" name="aed" id="aed-no" value="No" /><label for="aed-no"><span></span> No</label></span>
					
				
				<fieldset>
					
						<label for="skin-color">Skin Color</label>
						<span><input type="checkbox" name="skin-color" id="skin-color-normal" value="Normal" /><label for="skin-color-normal"><span></span> Normal</label></span>
						<span><input type="checkbox" name="skin-color" id="skin-color-cyanosis" value="Cyanosis" /><label for="skin-color-cyanosis"><span></span> Cyanosis</label></span>
						<span><input type="checkbox" name="skin-color" id="skin-color-jaundice" value="Jaundice" /><label for="skin-color-jaundice"><span></span> Jaundice</label></span>
						<span><input type="checkbox" name="skin-color" id="skin-color-pallor" value="Pallor" /><label for="skin-color-pallor"><span></span> Pallor</label></span>
						<span><input type="checkbox" name="skin-color" id="skin-color-erythema" value="Erythema" /><label for="skin-color-erythema"><span></span> Erythema</label></span>
						<span><input type="checkbox" name="skin-color" id="skin-color-other" value="Other" /><label for="skin-color-other"><span></span> Other</label></span>
						<input type="text" id="skin-color-other" value="enter other skin color" />
					
					
						<label for="cardiac-addtnl">Additional Comments</label>
						<textarea id="cardiac-addtnl"></textarea>
					
				
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
			</div>
			<div class="clear"></div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(11)" id="hide11" /> <label for="hide11"><span></span>Section Does Not Apply</label></span>
			<h3>Respiratory Requirements</h3>
			<div id="section11">
				<fieldset>
				
					<label for="asthma">Asthma?</label>
					<span class="inline"><input type="checkbox" id="asthma-yes" value="Yes" name="asthma" /><label for="asthma-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" id="asthma-no" value="No" name="asthma" /><label for="asthma-no"><span></span> No</label></span>
					<label for="other-diagnosis">If not asthma, what is the diagnosis?</label>
					<input type="text" id="other-diagnosis" />

					<label id="diagnosis-age">Age Diagnosed</label>
					<input type="text" id="diagnosis-age" />
				
				
					<label for="last-year">Symptoms in the last 12 months?</label>
					<span class="inline"><input type="checkbox" id="last-year-yes" value="Yes" name="last-year" /><label for="last-year-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" id="last-year-no" value="No" name="last-year" /><label for="last-year-no"><span></span> No</label></span>
					
					<label for="meds-last-year">Needed to use medication in the last 12 months?</label>
					<span class="inline"><input type="checkbox" id="meds-last-year-yes" value="Yes" name="meds-last-year" /><label for="meds-last-year-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" id="meds-last-year-no" value="No" name="meds-last-year" /><label for="meds-last-year-no"><span></span> No</label></span>

					<label for="doctor-last-year">Seen by health care provider in the last 12 months?</label>
					<span class="inline"><input type="checkbox" id="doctor-last-year-yes" value="Yes" name="doctor-last-year" /><label for="doctor-last-year-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" id="doctor-last-year-no" value="No" name="doctor-last-year" /><label for="doctor-last-year-no"><span></span> No</label></span>

					<label for="ed-last-year">ED visit(s) and/or hospitalizations in the last 12 months?</label>
					<span class="inline"><input type="checkbox" id="ed-last-year-yes" value="Yes" name="ed-last-year" /><label for="ed-last-year-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" id="ed-last-year-no" value="No" name="ed-last-year" /><label for="ed-last-year-no"><span></span> No</label></span>

					<label for="num-ed-visits">If yes, how many?</label>
					<span class="inline"><input type="checkbox" id="num-ed-visits-1" value="1" name="num-ed-visits" /><label for="num-ed-visits-1"><span></span> 1</label></span>
					<span class="inline"><input type="checkbox" id="num-ed-visits-2" value="2" name="num-ed-visits" /><label for="num-ed-visits-2"><span></span> 2</label></span>
					<span class="inline"><input type="checkbox" id="num-ed-visits-3" value="3" name="num-ed-visits" /><label for="num-ed-visits-3"><span></span> 3</label></span>
					<span class="inline"><input type="checkbox" id="num-ed-visits-4" value="4" name="num-ed-visits" /><label for="num-ed-visits-4"><span></span> 4</label></span>
					<span class="inline"><input type="checkbox" id="num-ed-visits-5" value="5 or more" name="num-ed-visits" /><label for="num-ed-visits-5"><span></span> 5 or more</label></span>
				
				
				<fieldset>
				
					<label for="triggers">Triggers</label>
					<span><input type="checkbox" id="triggers-smoke" value="Smoke" name="triggers" /><label for="triggers-smoke"><span></span> Smoke</label></span>
					<span><input type="checkbox" id="triggers-animals" value="Animals" name="triggers" /><label for="triggers-animals"><span></span> Animals</label></span>
					<span><input type="checkbox" id="triggers-dust" value="Dust" name="triggers" /><label for="triggers-dust"><span></span> Dust</label></span>
					<span><input type="checkbox" id="triggers-colds" value="Colds/Illness" name="triggers" /><label for="triggers-colds"><span></span> Colds/Illness</label></span>
					<span><input type="checkbox" id="triggers-weather" value="Changes in Weather" name="triggers" /><label for="triggers-weather"><span></span> Changes in Weather</label></span>
					<span><input type="checkbox" id="triggers-exercise" value="Exercise" name="triggers" /><label for="triggers-exercise"><span></span> Exercise</label></span>
					<span><input type="checkbox" id="triggers-mold" value="Mold" name="triggers" /><label for="triggers-mold"><span></span> Mold</label></span>
					<span><input type="checkbox" id="triggers-grass" value="Grass/Pollen" name="triggers" /><label for="triggers-grass"><span></span> Grass/Pollen</label></span>
					<span><input type="checkbox" id="triggers-perfumes" value="Perfumes/Smells" name="triggers" /><label for="triggers-perfumes"><span></span> Perfumes/Smells</label></span>
					<span><input type="checkbox" id="triggers-stress" value="Stress" name="triggers" /><label for="triggers-stress"><span></span> Stress</label></span>
					<span><input type="checkbox" id="triggers-food" value="Food" name="triggers" /><label for="triggers-food"><span></span> Food</label></span>
					<span><input type="checkbox" id="triggers-other" value="Other" name="triggers" /><label for="triggers-other"><span></span> Other</label></span>
					<input type="text" id="other-trigger" value="enter other trigger" />
				
				
					<label for="usual-symptoms">Usual Symptoms</label>
					<span><input type="checkbox" id="usual-symptoms-wheezing" value="Wheezing" name="usual-symptoms" /><label for="usual-symptoms-wheezing"><span></span> Wheezing</label></span>
					<span><input type="checkbox" id="usual-symptoms-breath" value="Shortness of Breath" name="usual-symptoms" /><label for="usual-symptoms-breath"><span></span> Shortness of Breath</label></span>
					<span><input type="checkbox" id="usual-symptoms-breathing" value="Difficulty Breathing" name="usual-symptoms" /><label for="usual-symptoms-breathing"><span></span> Difficulty Breathing</label></span>
					<span><input type="checkbox" id="usual-symptoms-throat" value="Itchy Throat" name="usual-symptoms" /><label for="usual-symptoms-throat"><span></span> Itchy Throat</label></span>
					<span><input type="checkbox" id="usual-symptoms-cough" value="Coughing" name="usual-symptoms" /><label for="usual-symptoms-cough"><span></span> Coughing</label></span>
					<span><input type="checkbox" id="usual-symptoms-chest" value="Chest Tightness" name="usual-symptoms" /><label for="usual-symptoms-chest"><span></span> Chest Tightness</label></span>
					<span><input type="checkbox" id="usual-symptoms-irritability" value="Irritability" name="usual-symptoms" /><label for="usual-symptoms-irritability"><span></span> Irritability</label></span>
					<span><input type="checkbox" id="usual-symptoms-waking" value="Waking at Night" name="usual-symptoms" /><label for="usual-symptoms-waking"><span></span> Waking at Night</label></span>
					<span><input type="checkbox" id="usual-symptoms-stomacache" value="Stomachache" name="usual-symptoms" /><label for="usual-symptoms-stomacache"><span></span> Stomachache</label></span>
					<span><input type="checkbox" id="usual-symptoms-other" value="Other" name="usual-symptoms" /><label for="usual-symptoms-other"><span></span> Other</label></span>
					<input type="text" id="other-usual-symptoms" value="enter other symptom" />
				
				
					<label for="day-symptoms">Symptoms During the Day <span class="tiny">(in the past month)</span></label>
					<span><input type="checkbox" id="day-symptoms-none" value="None" name="day-symptoms" /><label for="day-symptoms-none"><span></span> None</label></span>
					<span><input type="checkbox" id="day-symptoms-twice" value="2x/week or less" name="day-symptoms" /><label for="day-symptoms-twice"><span></span> 2x/week or less</label></span>
					<span><input type="checkbox" id="day-symptoms-twiceplus" value="More than 2x/week" name="day-symptoms" /><label for="day-symptoms-twiceplus"><span></span> More than 2x/week</label></span>
					<span><input type="checkbox" id="day-symptoms-always" value="Every Day" name="day-symptoms" /><label for="day-symptoms-always"><span></span> Every Day</label></span>

					<label for="night-symptoms">Symptoms at Night <span class="tiny">(in the past month)</span></label>
					<span><input type="checkbox" id="night-symptoms-none" value="None" name="night-symptoms" /><label for="night-symptoms-none"><span></span> None</label></span>
					<span><input type="checkbox" id="night-symptoms-twice" value="2x/week or less" name="night-symptoms" /><label for="night-symptoms-twice"><span></span> 2x/week or less</label></span>
					<span><input type="checkbox" id="night-symptoms-twiceplus" value="More than 2x/week" name="night-symptoms" /><label for="night-symptoms-twiceplus"><span></span> More than 2x/week</label></span>
					<span><input type="checkbox" id="night-symptoms-always" value="Every Night" name="night-symptoms" /><label for="night-symptoms-always"><span></span> Every Night</label></span>

					<label for="season">Symptoms most likely occur in</label>
					<div class="col-one">
					<span><input type="checkbox" name="season" id="season-fall" value="Fall" /><label for="season-fall"><span></span> Fall</label></span>
					<span><input type="checkbox" name="season" id="season-winter" value="Winter" /><label for="season-winter"><span></span> Winter</label></span>
					</div>
					<div class="col-two">
					<span><input type="checkbox" name="season" id="season-spring" value="Spring" /><label for="season-summer"><span></span> Spring</label></span>
					<span><input type="checkbox" name="season" id="season-summer" value="Summer" /><label for="season-summer"><span></span> Summer</label></span>
				</div>
				
				
				<fieldset>
				<section class="largetext">
					<label for="pe">Have symptoms ever prevented student from participating in PE, Recess, Sports, or Other Activites?</label>
					<span class="inline"><input type="checkbox" name="pe" id="pe-yes" value="Yes" /><label for="pe-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="pe" id="pe-no" value="No" /><label for="pe-no"><span></span> No</label></span>

					<label for="pe-explain">If yes, please explain</label>
					<textarea id="pe-explain"></textarea>
				
				
				<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
			</div>
			<div class="clear"></div>
		
				<fieldset>
					
						<label for="miss-school">Did student miss school last year?<span class="tiny">(relating to Diagnosis)</span></label>
						<span class="inline"><input type="checkbox" name="miss-school" id="miss-school-yes" value="Yes" /><label for="miss-school-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="miss-school" id="miss-school-no" value="No" /><label for="miss-school-no"><span></span> No</label></span>

						<label for="missed-times">If yes, how many times?</label>
						<span class="inline"><input type="checkbox" name="missed-times" id="missed-times-1" value="1-2" /><label for="missed-times-1"><span></span> 1-2</label></span>
						<span class="inline"><input type="checkbox" name="missed-times" id="missed-times-3" value="3-5" /><label for="missed-times-3"><span></span> 3-5</label></span>
						<span class="inline"><input type="checkbox" name="missed-times" id="missed-times-6" value="6-9" /><label for="missed-times-6"><span></span> 6-9</label></span>
						<span class="inline"><input type="checkbox" name="missed-times" id="missed-times-10" value="10 or more" /><label for="missed-times-10"><span></span> 10 or more</label></span>

						<label for="med-delivery">Medication Delivery</label>
						<span class="inline"><input type="checkbox" name="med-delivery" id="med-delivery-neb" valule="Nebulizer" /><label for="med-delivery-neb"><span></span> Nebulizer</label></span>
						<span class="inline"><input type="checkbox" name="med-delivery" id="med-delivery-inhaler" valule="Inhaler" /><label for="med-delivery-inhaler"><span></span> Inhaler</label></span>
						<span class="inline"><input type="checkbox" name="med-delivery" id="med-delivery-both" valule="Both" /><label for="med-delivery-both"><span></span> Both</label></span>
						
						<label for="med-freq">Frequency</label>
						<input type="text" id="med-freq" />
					
						<label for="student-admin">Student able to administer medication?</label>
						<span class="inline"><input type="checkbox" name="student-admin" id="student-admin-dependent" value="Dependent" /><label for="student-admin-dependent"><span></span> Dependent<label></span>
						<span class="inline"><input type="checkbox" name="student-admin" id="student-admin-assist" value="Assistance Required" /><label for="student-admin-assist"><span></span> Assistance Required<label></span>
						<span class="inline"><input type="checkbox" name="student-admin" id="student-admin-independent" value="Independent" /><label for="student-admin-independent"><span></span> Independent<label></span>
					
					
						<label for="self-mdi">Student self-carries MDI?</label>
						<span class="inline"><input type="checkbox" name="self-mdi" id="self-mdi-yes" value="Yes" /><label for="self-mdi-yes"><span></span> Yes<label></span>
						<span class="inline"><input type="checkbox" name="self-mdi" id="self-mdi-no" value="No" /><label for="self-mdi-no"><span></span> No<label></span>

						<label for="mdi">MDI kept in health room?</label>
						<span class="inline"><input type="checkbox" name="mdi" id="mdi-yes" value="Yes" /><label for="mdi-yes"><span></span> Yes<label></span>
						<span class="inline"><input type="checkbox" name="mdi" id="mdi-no" value="No" /><label for="mdi-no"><span></span> No<label></span>

						<label for="spacer">Spacer?</label>
						<span class="inline"><input type="checkbox" name="spacer" id="spacer-yes" value="Yes" /><label for="spacer-yes"><span></span> Yes<label></span>
						<span class="inline"><input type="checkbox" name="spacer" id="spacer-no" value="No" /><label for="spacer-no"><span></span> No<label></span>
						<br />
						<input type="text" id="spacer-type" value="enter type" />

						<label for="peak">Peak flow?</label>
						<span class="inline"><input type="checkbox" name="peak" id="peak-yes" value="Yes" /><label for="peak-yes"><span></span> Yes<label></span>
						<span class="inline"><input type="checkbox" name="peak" id="peak-no" value="No" /><label for="peak-no"><span></span> No<label></span>
						<br />
						<input type="text" id="peak-best" value="enter personal best" />
					
				
				<fieldset>
					
											
						<label for="pulm-vest">Pulmonary Vest?</label>
						<span class="inline"><input type="checkbox" name="pulm-vest" id="pulm-vest-yes" value="Yes" /><label for="pulm-vest-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="pulm-vest" id="pulm-vest-no" value="No" /><label for="pulm-vest-no"><span></span> No</label></span>

						<label for="vest-freq">Frequency</label>
						<input type="text" id="vest-freq" />

						<label for="chest-pt">Chest PT?</label>
						<span class="inline"><input type="checkbox" name="chest-pt" id="chest-pt-yes" value="Yes" /><label for="chest-pt-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="chest-pt" id="chest-pt-no" value="No" /><label for="chest-pt-no"><span></span> No</label></span>

						<label for="chest-pt-freq">Frequency</label>
						<input type="text" id="chest-pt-freq" />
					
					
						<label for="t-plan">Treatment Plan in School</label>
						<span><input type="checkbox" name="t-plan" id="tplan-standard" value="Standard Asthma Plan" /><label for="t-plan-standard"><span></span> Standard Asthma Plan</label></span>
						<span><input type="checkbox" name="t-plan" id="tplan-action" value="Asthma Action Plan" /><label for="t-plan-action"><span></span> Asthma Action Plan</label></span>
						<span><input type="checkbox" name="t-plan" id="tplan-ihp" value="IHP" /><label for="t-plan-ihp"><span></span> IHP</label></span>

						<label for="ed-asthma">ED visit(s) and/or hospitalizations in the last 12 months?</label>
						<span class="inline"><input type="checkbox" id="ed-asthma-yes" value="Yes" name="ed-asthma" /><label for="ed-asthma-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" id="ed-asthma-no" value="No" name="ed-asthma" /><label for="ed-asthma-no"><span></span> No</label></span>

						<label for="num-visits">If yes, how many?</label>
						<span class="inline"><input type="checkbox" id="num-visits-1" value="1" name="num-visits" /><label for="num-visits-1"><span></span> 1</label></span>
						<span class="inline"><input type="checkbox" id="num-visits-2" value="2" name="num-visits" /><label for="num-visits-2"><span></span> 2</label></span>
						<span class="inline"><input type="checkbox" id="num-visits-3" value="3" name="num-visits" /><label for="num-visits-3"><span></span> 3</label></span>
						<span class="inline"><input type="checkbox" id="num-visits-4" value="4" name="num-visits" /><label for="num-visits-4"><span></span> 4</label></span>
						<span class="inline"><input type="checkbox" id="num-visits-5" value="5 or more" name="num-visits" /><label for="num-visits-5"><span></span> 5 or more</label></span>
					
					<section class="largetext">
						<label for="resp-addtnl">Additional Comments</label>
						<textarea id="resp-addtnl"></textarea>
					
				
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
			</div>
			<div class="clear"></div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(12)" id="hide12" /> <label for="hide12"><span></span>Section Does Not Apply</label></span>
			<h3>Respiratory - Oxygen/Tracheostomy/Ventilation Requirements</h3>
			<div id="section12">
				<fieldset class="twocol">
				
					<label for="resp-assess">Respiratory Assessment</label>
					<span><input type="checkbox" name="resp-assess" id="resp-assess-continuous" value="Continuous" /><label for="resp-assess-continuous"><span></span> Continuous</label></span>
					<span><input type="checkbox" name="resp-assess" id="resp-assess-intermittant" value="Intermittant/As Needed" /><label for="resp-assess-intermittant"><span></span> Intermittant/As Needed</label></span>
					<span><input type="checkbox" name="resp-assess" id="resp-assess-signal" value="Student Communicates/Signals Need" /><label for="resp-assess-signal"><span></span> Student Communicates/Signals Need</label></span>

					<label for="baseline-assess">Baseline Respiratory Assessment</label>
					<textarea id="baseline-assess"></textarea>

					<label for="distress-sign">Signs/Symptoms of Respiratory Distress</label>
					<textarea id="distress-sign"></textarea>
				
				
					<label for="ventilation">Mechanical Ventilation?</label>
					<span class="inline"><input type="checkbox" name="ventilation" id="ventilation-none" value="None" /><label for="ventilation-none"><span></span> None</label></span>
					<span class="inline"><input type="checkbox" name="ventilation" id="ventilation-cpap" value="CPAP" /><label for="ventilation-cpap"><span></span> CPAP</label></span>
					<span class="inline"><input type="checkbox" name="ventilation" id="ventilation-bipap" value="BIPAP" /><label for="ventilation-bipap"><span></span> BIPAP</label></span>
					
					<label for="where">Ventilation Needed</label>
					<span class="inline"><input type="checkbox" name="where" id="where-home" value="Home" /><label for="where-home"><span></span> Home</label></span>
					<span class="inline"><input type="checkbox" name="where" id="where-school" value="School" /><label for="where-school"><span></span> School</label></span>
					<span class="inline"><input type="checkbox" name="where" id="where-sleep" value="Sleep" /><label for="where-sleep"><span></span> Sleep</label></span>
					<span class="inline"><input type="checkbox" name="where" id="where-as-needed" value="As Needed Per Orders" /><label for="where-as-needed"><span></span> As Needed</label></span>

					<label for="vent-depend">Ventilator Dependent?</label>
					<span class="inline"><input type="checkbox" name="vent-depend" id="vent-depend-dependent" value="Ventilator Dependent" /><label for="vent-depend-dependent"><span></span> Ventilator Dependent</label></span>
					<span class="inline"><input type="checkbox" name="vent-depend" id="vent-depend-assist" value="Ventilator Assist" /><label for="vent-depend-assist"><span></span> Ventilator Assist</label></span>

					<label for="vent-assist">If Vent Assist, how long can student be off vent?</label>
					<input type="text" id="vent-assist" />

					<label for="vent-set">Ventilator Settings</label>
					<input type="text" id="vent-set" />

					<label for="vent-co">Ventilator Company</label>
					<input type="text" id="vent-co" />

					<label for="vent-contact">Contact Information</label>
					<input type="text" id-"vent-contact" />
				
				
				
					<label for="oxygen">Oxygen</label>
					<span class="inline"><input type="checkbox" name="oxygen" id="oxygen-cont" value="Continuous" /><label for="oxygen-cont"><span></span> Continous</label></span>
					<span class="inline"><input type="checkbox" name="oxygen" id="oxygen-inter" value="Intermittent" /><label for="oxygen-inter"><span></span> Intermittent</label></span>

					<label for="oximetry">Oximetry</label>
					<span class="inline"><input type="checkbox" name="oximetry" id="oximetry-yes" value="Yes" /><label for="oximetry-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="oximetry" id="oximetry-no" value="No" /><label for="oximetry-no"><span></span> No</label></span>

					<label for="ox-freq">Frequency</label>
					<input type="text" id="ox-freq" />

					<label for="ox-param">Parameters</label>
					<input type="text" id="ox-param" />
				
				
					<label for="ox-route">Oxygen Route</label>
					<span><input type="checkbox" name="ox-route" id="ox-route-nasal" value="Nasal Cannula" /><label for="ox-route-nasal"><span></span> Nasal Cannula</label></span>
					<span><input type="checkbox" name="ox-route" id="ox-route-trach" value="Tracheotomy" /><label for="ox-route-trach"><span></span> Tracheotomy</label></span>
					<span><input type="checkbox" name="ox-route" id="ox-route-mask" value="Mask/Non-Rebreather" /><label for="ox-route-mask"><span></span> Mask/Non-Rebreather</label></span>

					<label for="ox-source">Oxygen Source</label>
					<span><input type="checkbox" name="ox-source" id="ox-source-tank" value="Tank" /><label for="ox-source-tank"><span></span> Tank</label></span>
					<span><input type="checkbox" name="ox-source" id="ox-source-liquid" value="Liquid" /><label for="ox-source-liquid"><span></span> Liquid</label></span>
					<span><input type="checkbox" name="ox-source" id="ox-source-concentrator" value="Concentrator" /><label for="ox-source-concentrator"><span></span> Concentrator</label></span>

				
				
					<label for="trach-size">Trach Size</label>
					<input type="text" id="trach-size" />

					<label for="cuffed">Cuffed?</label>
					<span class="inline"><input type="checkbox" name="cuffed" id="cuffed-yes" value="Yes" /><label for="cuffed-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="cuffed" id="cuffed-no" value="No" /><label for="cuffed-no"><span></span> No</label></span>
				
					<label for="thermo">Thermo-Vent?</label>
					<span class="inline"><input type="checkbox" name="thermo" id="thermo-yes" value="Yes" /><label for="thermo-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="thermo" id="thermo-no" value="No" /><label for="thermo-no"><span></span> No</label></span>

					<label for="muir">Passy Muir?</label>
					<span class="inline"><input type="checkbox" name="muir" id="muir-yes" value="Yes" /><label for="muir-yes"><span></span> Yes</label></span>
					<span class="inline"><input type="checkbox" name="muir" id="muir-no" value="No" /><label for="muir-no"><span></span> No</label></span>
				
				<fieldset class="twocol clear">
					
						<label for="co2">CO2 Monitor?</label>
						<span class="inline"><input type="checkbox" name="co2" id="co2-yes" value="Yes" /><label for="co2-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="co2" id="co2-no" value="No" /><label for="co2-no"><span></span> No</label></span>

						<label for="co2-freq">Frequency</label>
						<input type="text" id="co2-freq" />

						<label for="co2-param">Parameters</label>
						<input type="text" id="co2-param" />
					
					
						<label for="addtnl-vent">Additional Ventilator Information</label>
						<textarea id="addtnl-vent">Heated or Humidified, Plugged In or Batteries, Is Equipment Portable, etc</textarea>
					
				
				<fieldset class="threecol">
					
						<label for="suction">Suctioning?</label>
						<span class="inline"><input type="checkbox" name="suction" id="suction-yes" value="Yes" /><label for="suction-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="suction" id="suction-no" value="No" /><label for="suction-no"><span></span> No</label></span>
						<span><input type="checkbox" name="suction" id="suction-drain" value="Postural Drainage" /><label for="suction-drain"><span></span> Postural Drainage</label></span>
						
						<label for="trach-type">Type</label>
						<span><input type="checkbox" name="trach-type" id="trach-type-o" value="Oropharyngeal" /><label for="trach-type-o"><span></span> Oropharyngeal</label></span>
						<span><input type="checkbox" name="trach-type" id="trach-type-n" value="Nasopharyngeal" /><label for="trach-type-n"><span></span> Nasopharyngeal</label></span>
						<span><input type="checkbox" name="trach-type" id="trach-type-e" value="Endotracheal" /><label for="trach-type-e"><span></span> Endotracheal</label></span>
						
						
						
						<label for="cath">Catheter Type</label>
						<span class="inline"><input type="checkbox" name="cath" id="cath-y" value="Yankauer Catheter" /><label for="cath-y"><span></span> Yankauer Catheter</label></span>
						<span class="inline"><input type="checkbox" name="cath" id="cath-f" value="Flexible Catheter" /><label for="cath-f"><span></span> Flexible Catheter</label></span>
						
						<label for="cath-size">Catheter Size</label>
						<input type="text" id="cath-size" />

						<label for="cath-freq">Frequency</label>
						<input type="text" id="cath-freq" />
					
					
						<label for="cath-color">Color of Secretions</label>
						<input type="text" id="cath-color" />
					
						<label for="suction-equip">Equipment needed for suctioning</label>
						<textarea id="suction-equip"></textarea>
					
				
				<fieldset class="twocol">
					
						<label for="other-equip">Other Equipment Needed for School</label>
						<textarea id="other-equip"></textarea>

						<label for="equip-check">Equipment Checklist Utilized?</label>
						<span class="inline"><input type="checkbox" name="equip-check" id="equip-check-yes" value="Yes" /><label for="equip-check-yes"><span></span> Yes</label></span>
						<span class="inline"><input type="checkbox" name="equip-check" id="equip-check-no" value="No" /><label for="equip-check-no"><span></span> No</label></span>

					
					
						<label for="evac">Evacuation/Emergency Instructions</label>
						<textarea id="evac"></textarea>
					
				
				<fieldset>
					<section class="largetext">
						<label for="oxy-addntl">Additional Comments</label>
						<textarea id="oxy-addtnl"></textarea>
					
				
			</div>
		
		<section class="buttons">
			<div class="nextbutton">
				<button class="previous">Previous Page</button>
				<button class="next">Next Page</button>
			</div>
			<div class="savebuttons">
				<button class="save">Save Form</button>
			</div>
			<div class="clear"></div>
		
		
			<span class="inline hide"><input type="checkbox" onclick="hideSection(13)" id="hide13" /> <label for="hide13"><span></span>Section Does Not Apply</label></span>
			<h3>Orthopedics and Mobility Requirements</h3>
			<div id="section13">
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