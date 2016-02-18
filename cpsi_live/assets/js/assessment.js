$(window).load(function() {

    $("input[type=checkbox]").change(function()
    {
        var divId = $(this).attr("id");
        //alert(divId);
        if ($(this).is(":checked")) {
            // alert('calling');
            $("." + divId).hide();
        }
        else {
            // alert('calling else');
            $("." + divId).show();
        }
    });
    $("input[type=checkbox]").change();
    $(document).trigger('ready');


    $("#dob").datepicker({dateFormat: 'mm/dd/yy'});
    $("#contactattempt1").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#reevaldate").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#previousdate").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#release_exp1").datepicker({dateFormat: 'mm/dd/yy'});
    $("#release_exp2").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#dentalexam").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#hearingexam").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#visionexam").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#hearing_screening").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#vision_screening").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#last_seizure_exam").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#last_seizure").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#last_revision").datepicker({dateFormat: 'mm/dd/yy'});
//     $("last_seizure").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#shunt_placement").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#sco_last").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#hip_last").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#swallow_study_date").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_seizure_review").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_seizure_dist").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_hypo_review").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_hypo_dist").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_allergy_review").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_allergy_dist").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_gtube_review").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_gtube_dist").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_cardiac_review").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_cardiac_dist").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_resp_review").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_resp_dist").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_emer_review").datepicker({dateFormat: 'mm/dd/yy'});
    $("#hcap_emer_dist").datepicker({dateFormat: 'mm/dd/yy'});
    $("#release-exp1").datepicker({dateFormat: 'mm/dd/yy'});
    $("#release-exp2").datepicker({dateFormat: 'mm/dd/yy'});
    $("#lastexam2").datepicker({dateFormat: 'mm/dd/yy'});
    $("#nextexam2").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#dentalexam").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#previous").datepicker({dateFormat: 'mm/dd/yy'});
    $("#lastevent1").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#lastseizure").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#lastexam1").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#nextexam1").datepicker({dateFormat: 'mm/dd/yy'});
//    $("#releaseexp1").datepicker({dateFormat: 'mm/dd/yy'});
    $("#releaseexp2").datepicker({dateFormat: 'mm/dd/yy'});
//     $("#lastseizureexam").datepicker({dateFormat: 'mm/dd/yy'});

    //3 form - Section 1
    var baseline_assess = $('#dentist').val();
    var dentalexam = $('#dentalexam').val();
    var dentalexam = $('#dentalexam').val();
    var hearing = $('#hearing').val();
    var hearingexam = $('#hearingexam').val();
    var hearinghistory = $('#hearinghistory').val();
    var vision = $('#vision').val();
    var visionexam = $('#visionexam').val();
    var visionhistory = $('#visionhistory').val();
    if (baseline_assess == "" && dentalexam == "" && dentalexam == "" && hearing == "" && hearingexam == "" && hearinghistory == "" && vision == "" && visionexam == "" && visionhistory == "") {
        //alert('call '); 
        $('#hide1').attr('checked', true);
        $(".hide1").hide();
    }
    else {
        $('#hide1').attr('checked', false);
        $(".hide1").show();
    }
//section 2
    var sheepItForm_0_name = $('#sheepItForm_0_name').val();
    var sheepItForm_0_phone = $('#sheepItForm_0_phone').val();
//      var sheepItForm_0_fax = $('#sheepItForm_0_fax').val();
    if (sheepItForm_0_name == "" && sheepItForm_0_phone == "") {
        $('#hide2').attr('checked', true);
        $(".hide2").hide();
    }
    else {
//      alert('COME');
        $('#hide2').attr('checked', false);
        $(".hide2").show();
    }
//section 2
    //Add Medical diagonisis
    var sheepItForm_0_diagnosis = $('#sheepItForm_0_diagnosis').val();
    if (sheepItForm_0_diagnosis == "") {
        $('#hide366').attr('checked', true);
        $(".hide366").hide();
    }
    else {
        $('#hide366').attr('checked', false);
        $(".hide366").show();
    }
//End of 3 form
    //Educational Status
    var reevaldate = $('#reevaldate').val();
    var assist_tech_lt = $('#assist_tech_lt').val();

    var edustatus2_regular = $('input[name=edustatus2_regular]:checked').val();
    var edustatus2_iep = $('input[name=edustatus2_iep]:checked').val();
    var edustatus2_504 = $('input[name=edustatus2_504]:checked').val();

    var eduservices_occupational = $('input[name=eduservices_occupational]:checked').val();
    var eduservices_physical = $('input[name=eduservices_physical]:checked').val();
    var eduservices_speech = $('input[name=eduservices_speech]:checked').val();
    var eduservices_counseling = $('input[name=eduservices_counseling]:checked').val();
    var eduservices_pe = $('input[name=eduservices_pe]:checked').val();

    var offlocation_hospital = $('input[name=offlocation_hospital]:checked').val();
    var offlocation_home = $('input[name=offlocation_home]:checked').val();


    if ($('#assist_tech_lt').length > 0) {
        var assist_tech_lt = $('#assist_tech_lt').val();
        var accomodations_lt = $('#accomodations_lt').val();
    }
    else {
        var assist_tech_lt = $('#assisttechlist').val();
        var accomodations_lt = $('#accomodationslist').val();
    }
    if (reevaldate == "" && assist_tech_lt == "" && accomodations_lt == "" && eduservices_occupational == undefined && eduservices_physical == undefined &&
            eduservices_speech == undefined && eduservices_counseling == undefined && eduservices_pe == undefined && offlocation_hospital == undefined &&
            offlocation_home == undefined && edustatus2_regular == undefined && edustatus2_iep == undefined && edustatus2_504 == undefined) {
        $('#hide367').attr('checked', true);
        $(".hide367").hide();
    }
    else {
        $('#hide367').attr('checked', false);
        $(".hide367").show();
    }
//End of 3 form

//4th form section 1
    var sheepItForm_0_med = $('#sheepItForm_0_med').val();
    var dentalexam = $('#sheepItForm_0_dos').val();
    var sheepItForm_0_time = $('#sheepItForm_0_time').val();
    var sheepItForm_0_route = $('#sheepItForm_0_route').val();
    if (sheepItForm_0_med == "" && dentalexam == "" && sheepItForm_0_time == "" && sheepItForm_0_route == "") {
        $('#hide3').attr('checked', true);
        $(".hide3").hide();
    }
    else {
        $('#hide3').attr('checked', false);
        $(".hide3").show();
    }
    //Section 2
    var sheepItForm1_0_prnmed = $('#sheepItForm1_0_prnmed').val();
    var sheepItForm1_0_prndos = $('#sheepItForm1_0_prndos').val();
    var sheepItForm1_0_prntime = $('#sheepItForm1_0_prntime').val();
    var sheepItForm1_0_prnroute = $('#sheepItForm1_0_prnroute').val();
    if (sheepItForm1_0_prnmed == "" && sheepItForm1_0_prndos == "" && sheepItForm1_0_prntime == "" && sheepItForm1_0_prnroute == "") {
        $('#hide4').attr('checked', true);
        $(".hide4").hide();
    }
    else {
        $('#hide4').attr('checked', false);
        $(".hide4").show();
    }
//End of 4th form

//5th form section 1 Assessment
    var treatment1 = $('#sheepItForm1_0_treatment').val();
    var frequency1 = $('#sheepItForm1_0_frequency').val();
    var person1 = $('#sheepItForm1_0_person').val();

    if ((treatment1 == "" || treatment1 == undefined) && (frequency1 == "" || frequency1 == undefined) && (person1 == "" || person1 == undefined)) {
//        alert('come');
        $('#hide502').attr('checked', true);
        $(".hide502").hide();
    }
    else {
//        alert('not come');
        $('#hide502').attr('checked', false);
        $(".hide502").show();
    }
//5th form section 1 Appraisal
    var treatment1 = $('#sheepItForm5_0_treatment').val();
    var frequency1 = $('#sheepItForm5_0_frequency').val();
    var person1 = $('#sheepItForm5_0_person').val();

    if ((treatment1 == "" || treatment1 == undefined) && (frequency1 == "" || frequency1 == undefined) && (person1 == "" || person1 == undefined)) {
//        alert('come');
        $('#hide5022').attr('checked', true);
        $(".hide5022").hide();
    }
    else {
//        alert('not come');
        $('#hide5022').attr('checked', false);
        $(".hide5022").show();
    }
//16th form section last
    var ihp = $('input[name=ihp]:checked').val();

    if (ihp != "yes") {
        $('#hide115').attr('checked', true);
        $(".hide115").hide();
    }
    else {
        $('#hide115').attr('checked', false);
        $(".hide115").show();
    }
//11th form section 1
    var treatment1 = $('#baseline_assess').val();
    var frequency1 = $('#vent_set').val();
    var person1 = $('#vent_co').val();

    if (treatment1 == "" && frequency1 == "" && person1 == "") {
        $('#hide122').attr('checked', true);
        $(".hide122").hide();
    }
    else {
        $('#hide122').attr('checked', false);
        $(".hide122").show();
    }
//Section 2
    var sheepItForm_0_allergy = $('#sheepItForm_0_allergy').val();

    var sheepItForm_0_reaction = $('#sheepItForm_0_reaction').val();
//      var sheepItForm_0_ah1 = $('#sheepItForm_0_ah1').val();
    var sheepItForm_0_lastevent = $('#sheepItForm_0_lastevent').val();
    var sheepItForm_0_addtnlcomments = $('#sheepItForm_0_addtnlcomments').val();
//       alert(sheepItForm_0_ah1);

    if (sheepItForm_0_allergy == "" && sheepItForm_0_reaction == "" && sheepItForm_0_lastevent == "" && sheepItForm_0_addtnlcomments.trim() == "") {
        $('#hide6').attr('checked', true);
        $(".hide6").hide();
    }
    else {
        $('#hide6').attr('checked', false);
        $(".hide6").show();
    }

//End of 5th form

//6th form section 1
    var device_describe = $('#device_describe').val();
    var hearing_screening = $('#hearing_screening').val();
    var vision_screening = $('#vision_screening').val();
    var communication_comments = $('#communication_comments').val();

    if (device_describe == "" && hearing_screening == "" && vision_screening == "" && communication_comments == "") {
        $('#hide7').attr('checked', true);
        $(".hide7").hide();
    }
    else {
        $('#hide7').attr('checked', false);
        $(".hide7").show();
    }
//Second form
    var last_seizure_exam = $('#last_seizure_exam').val();
    var onset_age = $('#onset_age').val();
    var last_revision = $('#last_revision').val();
    var last_seizure = $('#last_seizure').val();
    var usual_duration = $('#usual_duration').val();
    var seizure_frequency = $('#seizure_frequency').val();
    var status_epilecticus = $('#status_epilecticus').val();
    var triggers = $.trim($('#triggers').val());
    var post_seizure = $.trim($('#post_seizure').val());
    var aura_description = $.trim($('#aura_description').val());
    var seizure_comments = $.trim($('#seizure_comments').val());
    if (last_seizure_exam == "" && onset_age == "" && last_revision == "" && last_seizure == "" && usual_duration == "" &&
            seizure_frequency == "" && status_epilecticus == "" && triggers == "" && post_seizure == "" && aura_description == "" && seizure_comments == "") {
        $('#hide8').attr('checked', true);
        $(".hide8").hide();
    }
    else {

        $('#hide8').attr('checked', false);
        $(".hide8").show();
    }
    //End of 6th form

//7th form section 1
    var constipation_mgmnt = $('#constipation_mgmnt').val();
    var colostomy_mgmnt = $('#colostomy_mgmnt').val();
    var bladder_mgmnt = $('#bladder_mgmnt').val();
    var cath_size = $('#cath_size').val();
    var cath_freq = $('#cath_freq').val();
    var menstruation_mgmt = $('#menstruation_mgmt').val();
    var elimination_addtnl = $('#elimination_addtnl').val();

    if (constipation_mgmnt == "" && colostomy_mgmnt.trim() == "" && bladder_mgmnt.trim() == "" && cath_size == "" && cath_freq == "" && menstruation_mgmt == "" && elimination_addtnl.trim() == "") {
        //alert('come');
        $('#hide9').attr('checked', true);
        $(".hide9").hide();
    }
    else {
        //alert('not come');
        $('#hide9').attr('checked', false);
        $(".hide9").show();
    }


//8th form section 1

    var cardiac_history = $.trim($('#cardiac_history').val());
    var baseline = $.trim($("#baseline").val());
    var cardiac_addtnl = $('#cardiac_addtnl').val();
    //alert('hif'+baseline);
    if (cardiac_history == "" && baseline == "" && cardiac_addtnl == "") {
        $('#hide10').attr('checked', true);
        $(".hide10").hide();
        //return true;
    }
    else {
        $('#hide10').attr('checked', false);
        $(".hide10").show();
    }

    //End of 8th form
//9th form section 1
    var diagnosis_age = $('#diagnosis_age').val();
    if (diagnosis_age == "") {
        $('#hide11').attr('checked', true);
        $(".hide11").hide();
    }
    else {
        $('#hide11').attr('checked', false);
        $(".hide11").show();
    }

    //Adrenal Insufficiency
    var ageofdia = $('#ageofdia').val();
    if (ageofdia == "") {
        $('#hide334').attr('checked', true);
        $("#hidename334").hide();
    }
    else {
        $('#hide334').attr('checked', false);
        $("#hidename334").show();
    }
    //Other Diagnosis
    var health_concern = $('#health_concern').val();
    if (health_concern == "") {
        $('#hide335').attr('checked', true);
        $("#hidename335").hide();
    }
    else {
        $('#hide335').attr('checked', false);
        $("#hidename335").show();
    }

//16th form section 1
    var planname1 = $('input[name=planname1]:checked').val();
    var planname2 = $('input[name=planname2]:checked').val();
    var planname3 = $('input[name=planname3]:checked').val();
    var planname4 = $('input[name=planname4]:checked').val();
    var planname5 = $('input[name=planname5]:checked').val();
    var planname6 = $('input[name=planname6]:checked').val();
    var planname7 = $('input[name=sheepItForm1_0_seizure_planname7]:checked').val();
    if ($('#sheepItForm1_1_newplanname').length > 0) {
        var planname8 = $('input[name=sheepItForm1_1_newplanname]:checked').val();
        var planname9 = $('input[name=sheepItForm1_2_newplanname]:checked').val();
        var planname10 = $('input[name=sheepItForm1_3_newplanname]:checked').val();
    }
    else {
        planname8 = "";
        planname9 = "";
        planname10 = "";
    }

    if (planname1 == "" && planname2 == "" && planname3 == "" && planname4 == "" && planname5 == "" && planname6 == "" && planname7 == ""
            && planname8 == "" && planname9 == "" && planname10 == "") {
        $('#hide188').attr('checked', true);
        $(".hide188").hide();
    }
    else {
        $('#hide188').attr('checked', false);
        $(".hide188").show();
    }
//11th form end

//12 th form section 1
    var sc = $('#sc').val();
    var equip_provider = $('#equip_provider').val();
    var vent_co = $('#vent_co').val();
    var c_info = $('#c_info').val();
    var sco_last = $('#sco_last').val();
    var sco_treat = $('#sco_treat').val();
    var hip_last = $('#hip_last').val();
    var hip_treat = $('#hip_treat').val();
    var mobi_text = $('#mobi_text').val();
    var mobi_addtnl = $('#mobi_addtnl').val();

    var mobility_amb = $('input[name=mobility_amb]:checked').val();
    var mobility_ind = $('input[name=mobility_ind]:checked').val();
    var mobility_ns = $('input[name=mobility_ns]:checked').val();
    var mobility_uw = $('input[name=mobility_uw]:checked').val();
    var mobility_gt = $('input[name=mobility_gt]:checked').val();
    var mobility_wheel = $('input[name=mobility_wheel]:checked').val();

    var wc_mi = $('input[name=wc_mi]:checked').val();
    var wc_ma = $('input[name=wc_ma]:checked').val();
    var wc_pi = $('input[name=wc_pi]:checked').val();
    var wc_pa = $('input[name=wc_pa]:checked').val();
    var wc_so = $('input[name=wc_so]:checked').val();
    var sc = $('input[name=sc]:checked').val();

    var splint_hand = $('input[name=splint_hand]:checked').val();
    var splint_ankle = $('input[name=splint_ankle]:checked').val();
    var splint_knee = $('input[name=splint_knee]:checked').val();
    var splint_leg = $('input[name=splint_leg]:checked').val();

    var lift_one = $('input[name=lift_one]:checked').val();
    var lift_two = $('input[name=lift_two]:checked').val();
    var lift_hoyer = $('input[name=lift_hoyer]:checked').val();


    if (mobility_amb == undefined && mobility_ind == undefined && mobility_ns == undefined && mobility_uw == undefined && mobility_gt == undefined && mobility_wheel == undefined
            && wc_mi == undefined && wc_ma == undefined && wc_pi == undefined && wc_pa == undefined && wc_so == undefined && sc == undefined && splint_hand == undefined && splint_ankle == undefined
            && splint_knee == undefined && splint_leg == undefined && lift_one == undefined && lift_two == undefined && lift_hoyer == undefined && equip_provider == ""
            && c_info == "" && sco_last == "" && sco_treat == "" && sco_treat == "" && hip_last == "" && hip_treat == "" && mobi_addtnl == "")
    {
        $('#hide13').attr('checked', true);
        $(".hide13").hide();
    }
    else {
        $('#hide13').attr('checked', false);
        $(".hide13").show();
    }

    //13th form 1 session
    var food_texture = $('#food_texture').val();
    var food_restriction = $('#food_restriction').val();
    var fluid_restriction = $('#fluid_restriction').val();
    var gtube_size = $('#gtube_size').val();
    var tube_type = $('#tube_type').val();
    var inst_dislodged = $('#inst_dislodged').val();
    var feed_freq = $('#feed_freq').val();
    var swallow_study_date = $('#swallow_study_date').val();
    var swallow_study_loc = $('#swallow_study_loc').val();
    var reflux_tx = $('#reflux_tx').val();
//        var ordering_doc = $('#ordering_doc').val();
    var clinic_details = $('#clinic_details').val();
    var smart_manager = $('#smart_manager').val();
    var meal_care = $('#meal_care').val();
    var nutr_comments = $('#nutr_comments').val();

//        alert(ordering_doc);

    if (food_texture == "" && food_restriction == "" && fluid_restriction == "" && gtube_size == "" &&
            tube_type == "" && inst_dislodged == "" &&
            feed_freq == "" && swallow_study_date == "" &&
            swallow_study_loc == "" && reflux_tx == "" && clinic_details == "" && smart_manager == "" &&
            meal_care == "" && nutr_comments == "") {

        $('#hide144').attr('checked', true);
        $(".hide144").hide();

    }
    else {
        $('#hide144').attr('checked', false);
        $(".hide144").show();
    }

    //14 th form section one 

    var target = $('#target').val();
    var insulin_manu = $('#insulin_manu').val();
    var type_ins_school = $('#type_ins_school').val();
    var lunch_correction = $('#lunch_correction').val();
    var lunch_carb = $('#lunch_carb').val();
    var snack_carb = $('#snack_carb').val();
    var after_lunch_reason = $('#after_lunch_reason').val();
    var break_carb = $('#break_carb').val();
    var glucagon_order = $('#glucagon_order').val();
    var diabetes_additional = $('#diabetes_additional').val();


    if (target == "" && insulin_manu == "" && type_ins_school == "" && lunch_correction == "" &&
            lunch_carb == "" && after_lunch_reason == "" &&
            break_carb == "" && diabetes_additional == "") {
        $('#hide15').attr('checked', true);
        $(".hide15").hide();
    }
    else {
        $('#hide15').attr('checked', false);
        $(".hide15").show();
    }

    //15th form section 1

    var trans_comments = $.trim($('#trans_comments').val());

    var trans_method_walker = $('input[name=trans_method_walker]:checked').val();
    var trans_method_car = $('input[name=trans_method_car]:checked').val();
    var trans_method_bus = $('input[name=trans_method_bus]:checked').val();
    var trans_method_lift = $('input[name=trans_method_lift]:checked').val();

    var bus_services_assist = $('input[name=bus_services_assist]:checked').val();
    var bus_services_aide = $('input[name=bus_services_aide]:checked').val();
    var bus_services_nursing = $('input[name=bus_services_nursing]:checked').val();
    var bus_services_equip = $('input[name=bus_services_equip]:checked').val();

    var med_bus_selfadmin = $('input[name=med_bus_selfadmin]:checked').val();
    var med_bus_selfmed = $('input[name=med_bus_selfmed]:checked').val();
    var med_bus_aideadmin = $('input[name=med_bus_aideadmin]:checked').val();


    if (trans_comments == "" && trans_method_walker == undefined && trans_method_car == undefined && trans_method_bus == undefined &&
            trans_method_lift == undefined && bus_services_assist == undefined && bus_services_aide == undefined && bus_services_nursing == undefined &&
            bus_services_equip == undefined && med_bus_selfadmin == undefined && med_bus_selfmed == undefined && med_bus_aideadmin == undefined) {
        $('#hide16').attr('checked', true);
        $(".hide16").hide();
    }
    else {
        $('#hide16').attr('checked', false);
        $(".hide16").show();
    }

    //16th form section 1

    //First form
    var cultural_info = $.trim($('#cultural_info').val());

    if (cultural_info == "") {
        $('#hide17').attr('checked', true);
        $('.hide17').hide();
    }
    else {
        $('#hide17').attr('checked', false);
        $('.hide17').show();
    }

//Second Form
    //Second form
//        var hcap_seizure_review = $('#hcap_seizure_review').val();
//        var hcap_seizure_dist = $('#hcap_seizure_dist').val();
//        var hcap_hypo_review = $('#hcap_hypo_review').val();
//        var hcap_hypo_dist = $('#hcap_hypo_dist').val();
//        var hcap_allergy_review = $('#hcap_allergy_review').val();
//        var hcap_allergy_dist = $('#hcap_allergy_dist').val();
//        var hcap_gtube_review = $('#hcap_gtube_review').val();
//        var hcap_cardiac_review = $('#hcap_cardiac_review').val();
//        var hcap_cardiac_dist = $('#hcap_cardiac_dist').val();
//        var hcap_resp_review = $('#hcap_resp_review').val();
//        var hcap_resp_dist = $('#hcap_resp_dist').val();
//        var hcap_emer_review = $('#hcap_emer_review').val();
//        var hcap_emer_dist = $('#hcap_emer_dist').val();
//
//
//
//        if (hcap_seizure_review == "" && hcap_seizure_dist == "" && hcap_hypo_review == "" && hcap_hypo_dist == "" &&
//            hcap_allergy_review == "" && hcap_allergy_dist == "" && hcap_gtube_review == "" && 
//            hcap_cardiac_review == "" && hcap_cardiac_dist == "" && hcap_resp_review == "" &&
//            hcap_resp_dist == "" && hcap_emer_review == "" && hcap_emer_dist == "") {
//            $('#hide18').attr('checked', true); 
//            $('.hide18').hide();
//        }
//        else{
//            $('#hide18').attr('checked', false); 
//            $('.hide18').show();
//        }

//Third Form
    var delegatable = $('#delegatable').val();
    var non_delegatable = $('#non_delegatable').val();
    var parents_provide = $('#parents_provide').val();
    var school_provide = $('#school_provide').val();


    if (delegatable == "" && non_delegatable == "" && parents_provide == "" && school_provide == "") {
        $('#hide19').attr('checked', true);
        $('.hide19').hide();
    }
    else {
        $('#hide19').attr('checked', false);
        $('.hide19').show();
    }

    //assessment 14rd form -- section 2
//    var name1 = $('#ageofdia').val();
//    var phone1 = $('#addcomments').val();
//    
//    if (name1 == "" && phone1 == "") {
//        $('#hide334').attr('checked', true);
//        $(".hidename334").hide();
//        
//    }
//    else {
//        $('#hide334').attr('checked', false);
//         $(".hidename334").show();
//    }

});
