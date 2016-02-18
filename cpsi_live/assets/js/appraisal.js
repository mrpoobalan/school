$(window).load(function() {
    //alert('come');
    //appraisal 3rd form -- section 1
    var dentist = $('#dentist').val();
    var dentalexam = $('#dentalexam').val();
    var dentalhistory = $('#dentalhistory').val();
    var hearing = $('#hearing').val();
    var hearingexam = $('#hearingexam').val();
    var hearinghistory = $('#hearinghistory').val();
    var vision = $('#vision').val();
    var visionexam = $('#visionexam').val();
    var visionhistory = $('#visionhistory').val();

    if (dentist == "" && dentalexam == "" && dentalhistory == "" && hearing == "" && hearingexam == "" &&
            hearinghistory == "" && vision == "" && dentist == "" && dentist == "") {
        $('#hideSection1').attr('checked', true);
        $(".hideSection1").hide();
    }
    else {
        $('#hideSection1').attr('checked', false);
        $(".hideSection1").show();
    }

    //appraisal 3rd form -- section 2
    var name1 = $('#sheepItForm_0_name').val();
    var phone1 = $('#sheepItForm_0_phone').val();
//    var fax1 = $('#sheepItForm_0_fax').val();

    if (name1 == "" && phone1 == "") {
        $('#hideSection2').attr('checked', true);
        $(".hideSection2").hide();

    }
    else {
        $('#hideSection2').attr('checked', false);
        $(".hideSection2").show();
    }

    //appraisal 3rd form -- section 3
    var sheepItForm2_0amed = $('#sheepItForm2_0_med').val();
    var sheepItForm2_0_dos = $('#sheepItForm2_0_dos').val();
    var sheepItForm2_0_time = $('#sheepItForm2_0_time').val();
    var sheepItForm2_0_route = $('#sheepItForm2_0_route').val();

    if (sheepItForm2_0amed == "" && sheepItForm2_0_dos == "" && sheepItForm2_0_time == "" && sheepItForm2_0_route == "") {
        $('#hideSection3').attr('checked', true);
        $(".hideSection3").hide();
    }
    else {
        $('#hideSection3').attr('checked', false);
        $(".hideSection3").show();
    }


    //appraisal 3rd form -- section 4
    var sheepItForm3_0_prnmed = $('#sheepItForm3_0_prnmed').val();
    var sheepItForm3_0_prndos = $('#sheepItForm3_0_prndos').val();
    var sheepItForm3_0_prntime = $('#sheepItForm3_0_prntime').val();
    var sheepItForm3_0_prnroute = $('#sheepItForm3_0_prnroute').val();

    if (sheepItForm3_0_prnmed == "" && sheepItForm3_0_prndos == "" && sheepItForm3_0_prntime == "" && sheepItForm3_0_prnroute == "") {
        $('#hideSection4').attr('checked', true);
        $(".hideSection4").hide();
    }
    else {
        $('#hideSection4').attr('checked', false);
        $(".hideSection4").show();
    }

    //appraisal 3rd form -- section 5
    var treatment1 = $('#sheepItForm5_0_treatment').val();
    var frequency1 = $('#sheepItForm5_0_frequency').val();
    var person1 = $('#sheepItForm5_0_person').val();

    if (treatment1 == "" && frequency1 == "" && person1 == "") {
        $('#hide555').attr('checked', 'checked');
        $(".hide5").hide();
    }
    else {
        $('#hide555').attr('checked', false);
        $(".hide5").show();
    }


    //appraisal 3rd form -- section 6
    var sheepItForm4_0_allergy = $('#sheepItForm4_0_allergy').val();
    var sheepItForm4_0_reaction = $('#sheepItForm4_0_reaction').val();
//    var sheepItForm4_0_ah1 = $('#sheepItForm4_0_ah1').val();
    var sheepItForm4_0_lastevent = $('#sheepItForm4_0_lastevent').val();
    var sheepItForm4_0_addtnlcomments = $('#sheepItForm4_0_addtnlcomments').val();
    if (sheepItForm4_0_allergy == "" && sheepItForm4_0_reaction == "" && sheepItForm4_0_lastevent == "" && sheepItForm4_0_addtnlcomments.trim() == "") {
        $('#hideSection6').attr('checked', true);
        $(".hideSection6").hide();

    }
    else {
        $('#hideSection6').attr('checked', false);
        $(".hideSection6").show();
    }
    //alert('come');
    //appraisal 3rd form -- section 7

    var hearingscreening = $('#hearingscreening').val();
    var visionscreening = $('#visionscreening').val();
    var communicationcomments = $.trim($('#communication-comments').val());

    if (hearingscreening == "" && visionscreening == "" && communicationcomments == "") {
        $('#hideSection77').attr('checked', true);
        $(".hideSection77").hide();
    }
    else {
        $('#hideSection77').attr('checked', false);
        $(".hideSection77").show();
    }
//appraisal 3rd form -- section 8
//    var lastseizure = $('#lastseizure').val();
//    var usualduration = $('#usualduration').val();
    var lastseizureexam = $('#lastseizureexam').val();
    var shuntplacement = $('#shuntplacement').val();
    var seizurefrequncy = $('#seizurefrequncy').val();
    var onsetage = $('#onsetage').val();
    var lastrevision = $('#lastrevision').val();
    var statusepilectus = $('#statusepilectus').val();
    var triggers = $('#triggers').val();
    var postseizure = $('#postseizure').val();
    var seizurecomments = $('#seizurecomments').val();

    if (lastseizureexam == "" && shuntplacement == "" &&
            seizurefrequncy == "" && onsetage == "" &&
            lastrevision == "" && statusepilectus == "" &&
            triggers == "" && postseizure == "" && seizurecomments == "") {
        $('#hideSection8').attr('checked', true);
        $('.hideSection8').hide();
    }
    else {
        $('#hideSection8').attr('checked', false);
        $('.hideSection8').show();
    }

//appraisal 4th form --- section 1
    var baseline_assess = $('#baseline_assess').val();
    var distress_sign = $('#distress_sign').val();
    var vent_set = $('#vent_set').val();
    var vent_co = $('#vent_co').val();

    var vent_contact = $('#vent_contact').val();
    var trach_size = $('#trach_size').val();
    var ox_freq = $('#ox_freq').val();
    var ox_param = $('#ox_param').val();

    var co2_freq = $('#co2_freq').val();
    var co2_param = $('#co2_param').val();
    var addtnl_vent = $('#addtnl_vent').val();
    var cath_color = $('#cath_color').val();

    var suction_equip = $('#suction_equip').val();
    var other_equip = $.trim($('#other_equip').val());
    var evac = $.trim($('#evac').val());
    var oxy_addtnl = $.trim($('#oxy_addtnl').val());

    if (baseline_assess == "" && distress_sign == "" && vent_set == "" && vent_co == ""
            && vent_contact == "" && trach_size == "" && ox_freq == "" && ox_param == ""
            && co2_freq == "" && co2_param == "" && addtnl_vent == "" && cath_color == ""
            && suction_equip == "" && other_equip == "" && evac == "" && oxy_addtnl == "") {
        $('#hide12').attr('checked', true);
        $('.hide12').hide();
    }
    else {
        $('#hide12').attr('checked', false);
        $('.hide12').show();
    }

    //Appraisal 4th form -- section 2
    var special_cond = $.trim($('#special_cond').val());
    var equip_provider = $('#equip_provider').val();
    var c_info = $('#c_info').val();
    var sco_last = $('#sco_last').val();

    var sco_treat = $('#sco_treat').val();
    var hip_last = $('#hip_last').val();
    var hip_treat = $('#hip_treat').val();
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
            && splint_knee == undefined && splint_leg == undefined && lift_one == undefined && lift_two == undefined && lift_hoyer == undefined && special_cond == "" && equip_provider == "" && c_info == "" && sco_last == ""
            && sco_treat == "" && hip_last == "" && hip_treat == "" && mobi_addtnl == "") {
//    alert('come if');
        $('#hide133').attr('checked', true);
        $('.hide133').hide();
    }
    else {
//        alert('come else');
        $('#hide133').attr('checked', false);
        $('.hide133').show();
    }

    //Appraisal 5th form -- section 1
    var constipation_mgmnt = $.trim($('#constipation_mgmnt').val());
    var colostomy_mgmnt = $('#colostomy_mgmnt').val();
    var bladder_mgmnt = $('#bladder_mgmnt').val();
    var menstruation_mgmt = $('#menstruation_mgmt').val();
    var cath_size = $('#cath_size').val();
    var cath_freq = $('#cath_freq').val();
    var elimination_addtnl = $('#elimination_addtnl').val();

    if (constipation_mgmnt == "" && colostomy_mgmnt == "" && bladder_mgmnt == "" && menstruation_mgmt == ""
            && cath_size == "" && cath_freq == "" && elimination_addtnl == "") {
        $('#hide37').attr('checked', true);
        $('.hide37').hide();
    }
    else {
        $('#hide37').attr('checked', false);
        $('.hide37').show();
    }


    //Appraisal 5th form -- section 2
    var cardiac_history = $.trim($('#cardiac_history').val());
    var baseline = $('#baseline').val();
    var cardiac_addtnl = $('#cardiac_addtnl').val();
    var menstruation_mgmt = $('#menstruation_mgmt').val();
    var cath_size = $('#cath_size').val();
    var cath_freq = $('#cath_freq').val();
    var elimination_addtnl = $('#elimination_addtnl').val();

    if (cardiac_history == "" && baseline == "" && cardiac_addtnl == "") {
        $('#hide38').attr('checked', true);
        $('.hide38').hide();
    }
    else {
        $('#hide38').attr('checked', false);
        $('.hide38').show();
    }

    //Appraisal 5th form -- section 3
    var diagnosis_age = $.trim($('#other_diagnosis').val());
    var resp_addtnl = $('#resp_addtnl').val();

    if (diagnosis_age == "" && resp_addtnl == "") {
        $('#hide39').attr('checked', true);
        $('.hide39').hide();
    }
    else {
        $('#hide39').attr('checked', false);
        $('.hide39').show();
    }
    //16th form section 1
//    var baseline_assess = $('#sheepItForm1_0_hcap_seizure_review').val();
//    var distress_sign = $('#sheepItForm1_0_hcap_seizure_dist').val();
//    if (baseline_assess == "" && distress_sign == "") {
//        $('#hide188').attr('checked', true);
//        $(".hide188").hide();
//    }
//    else {
//        $('#hide188').attr('checked', false);
//        $(".hide188").show();
//    }
    //Appraisal 6th form -- section 1
    var food_texture = $.trim($('#food_texture').val());
    var food_restriction = $('#food_restriction').val();
    var fluid_restriction = $('#fluid_restriction').val();
    var gtube_size = $('#gtube_size').val();
    var tube_type = $('#tube_type').val();
    var inst_dislodged = $('#inst_dislodged').val();
    var vfeed_freq = $.trim($('#feed_freq').val());
    var swallow_study_date = $('#swallow_study_date').val();
    var swallow_study_loc = $('#swallow_study_loc').val();
    var reflux_tx = $('#reflux_tx').val();
//    var ordering_doc = $('#ordering_doc').val();
    var clinic_details = $('#clinic_details').val();
    var smart_manager = $('#smart_manager').val();
    var meal_care = $('#meal_care').val();
    var nutr_comments = $('#nutr_comments').val();


    if (food_texture == "" && food_restriction == "" && fluid_restriction == ""
            && gtube_size == "" && tube_type == "" && inst_dislodged == ""
            && vfeed_freq == "" && swallow_study_date == "" && swallow_study_loc == ""
            && reflux_tx == "" && clinic_details == ""
            && smart_manager == "" && meal_care == "" && nutr_comments == "") {
        $('#hide14').attr('checked', true);
        $('.hide14').hide();
    }
    else {
        $('#hide14').attr('checked', false);
        $('.hide14').show();
    }


    //Appraisal 6th form -- section 2
    var target = $.trim($('#target').val());
    var insulin_manu = $('#insulin_manu').val();
    var type_ins_school = $('#type_ins_school').val();
    var lunch_correction = $('#lunch_correction').val();
    var lunch_carb = $('#lunch_carb').val();
    var after_lunch_reason = $('#after_lunch_reason').val();
    var break_carb = $.trim($('#break_carb').val());
    var glucagon_order = $('#glucagon_order').val();
    var diabetes_additional = $('#diabetes_additional').val();


    if (target == "" && insulin_manu == "" && type_ins_school == ""
            && lunch_correction == "" && lunch_carb == "" && after_lunch_reason == ""
            && break_carb == "" && glucagon_order == "" && diabetes_additional == "") {
        $('#hide15').attr('checked', true);
        $('.hide15').hide();
    }
    else {
        $('#hide15').attr('checked', false);
        $('.hide15').show();
    }

    //Appraisal 6th form -- section 3
//    var trans_comments = $.trim($('#trans_comments').val());
//
//    if (trans_comments == "") {
//        $('#hide16').attr('checked', true);
//        $('.hide16').hide();
//    }
//    else {
//        $('#hide16').attr('checked', false);
//        $('.hide16').show();
//    }
    //Appraisal 6th form -- section 4
    var cultural_info = $.trim($('#cultural_info').val());

    if (cultural_info == "") {
        $('#hide17').attr('checked', true);
        $('.hide17').hide();
    }
    else {
        $('#hide17').attr('checked', false);
        $('.hide17').show();
    }


    //Appraisal 6th form -- section 5
    var hcap_seizure_review = $.trim($('#hcap_seizure_review').val());
    var hcap_seizure_dist = $('#hcap_seizure_dist').val();
    var hcap_hypo_review = $('#hcap_hypo_review').val();
    var hcap_hypo_dist = $('#hcap_hypo_dist').val();
    var hcap_allergy_review = $('#hcap_allergy_review').val();
    var hcap_allergy_dist = $('#hcap_allergy_dist').val();
    var hcap_gtube_review = $.trim($('#hcap_gtube_review').val());
    var hcap_gtube_dist = $('#hcap_gtube_dist').val();
    var hcap_cardiac_review = $('#hcap_cardiac_review').val();
    var hcap_cardiac_dist = $('#hcap_cardiac_dist').val();
    var hcap_resp_review = $('#hcap_resp_review').val();
    var hcap_resp_dist = $('#hcap_resp_dist').val();
    var hcap_emer_review = $('#hcap_emer_review').val();
    var hcap_emer_dist = $('#hcap_emer_dist').val();



    if (hcap_seizure_review == "" && hcap_seizure_dist == "" && hcap_hypo_review == ""
            && hcap_hypo_dist == "" && hcap_allergy_review == "" && hcap_allergy_dist == ""
            && hcap_gtube_review == "" && hcap_gtube_dist == "" && hcap_cardiac_review == ""
            && hcap_cardiac_dist == "" && hcap_resp_review == "" && hcap_resp_dist == ""
            && hcap_emer_review == "" && hcap_emer_dist == "") {
        $('#hide18').attr('checked', true);
        $('.hide18').hide();
    }
    else {
        $('#hide18').attr('checked', false);
        $('.hide18').show();
    }



    //Appraisal 6th form -- section 6
    var delegatable = $.trim($('#delegatable').val());
    var non_delegatable = $('#non_delegatable').val();
    var parents_provide = $('#parents_provide').val();
    var school_provide = $('#school_provide').val();



    if (delegatable == "" && non_delegatable == "" && parents_provide == ""
            && school_provide == "") {
//     alert("if");
        $('#hide19').attr('checked', true);
        $('.hide19').hide();
    }
    else {
//    alert("else");
        $('#hide19').attr('checked', false);
        $('.hide19').show();
    }

});