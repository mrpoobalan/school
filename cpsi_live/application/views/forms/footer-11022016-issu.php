<style type="text/css">

    /*h1 { color: #444; background-color: transparent; border-bottom: 1px solid #D0D0D0; font-size: 19px; font-weight: normal; margin: 0 0 14px 0; padding: 14px 15px 10px 15px; }*/

    #container{ margin: 10px; border: 0px solid #D0D0D0; -webkit-box-shadow: 0 0 8px #D0D0D0; }
    .alert-box { color: #E80D0D;
                 border-radius: 10px;
                 font-family: Tahoma,Geneva,Arial,sans-serif;
                 font-size: 13px;
                 padding: 0px 0px 0px 0px;
                 margin: 10px; }
    .alert-box span { font-weight:bold; text-transform:uppercase; }
    .error { background:#ffecec; border:0px solid #f5aca6; color:red; }
    /*            .success { background:#e9ffd9; border:1px solid #a6ca8a; } */
    #msgbx_err{ display: none; }
    #msgbx_success{ display: none; }

</style>



<script>

    $(function() {
//        Remove all cookies here
//          if (window.location.href.indexOf('reload') == -1) {
//            window.location.replace(window.location.href + '/reload');
//        }
//        alert('call');


        //Date picker for forms
//        $("#sheepItForm1_1_hcap_seizure_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#dob").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_1_hcap_seizure_review").datepicker({dateFormat: 'mm/dd/yy'});

        $("#contactattempt1").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#reevaldate").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#previousdate").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#release_exp1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#release_exp2").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#dentalexam").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#hearingexam").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#visionexam").datepicker({dateFormat: 'mm/dd/yy'});

//        $("#last_revision").datepicker({dateFormat: 'mm/dd/yy'});
//        $("last_seizure").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#shunt_placement").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#sco_last").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#hip_last").datepicker({dateFormat: 'mm/dd/yy'});
        // $("#hcap_seizure_review").datepicker({dateFormat: 'mm/dd/yy'});
        // $("#hcap_seizure_dist").datepicker({dateFormat: 'mm/dd/yy'});
        //        $("#last_seizure_exam").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#last_seizure").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_seizure_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_seizure_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_hypo_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_hypo_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_allergy_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_allergy_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_gtube_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_gtube_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_cardiac_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_cardiac_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_resp_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_resp_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_emer_review").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_hcap_emer_dist").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_release-exp1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#sheepItForm1_0_release-exp2").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastexam2").datepicker({dateFormat: 'mm/dd/yy'});
        $("#nextexam2").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#dentalexam").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#previous").datepicker({dateFormat: 'mm/dd/yy'});
        $("#lastevent1").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#lastseizure").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#lastexam1").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#nextexam1").datepicker({dateFormat: 'mm/dd/yy'});
//        $("#releaseexp1").datepicker({dateFormat: 'mm/dd/yy'});
        $("#releaseexp2").datepicker({dateFormat: 'mm/dd/yy'});

    });</script>

<script>
    $(window).load(function() {

        $("#hideemer0").hide();
        var schoolname = $("#schoolID").val();
//        alert(schoolname);
        if (schoolname != undefined) {
            getSchools(schoolname);
        }
    });
    function getSchools(obj) {
        $('#school').empty();
        var dropDown = document.getElementById("schoolID");
        var schoolID = dropDown.options[dropDown.selectedIndex].value;
        $.ajax({
            type: "POST",
            url: "<?= base_url("search/student_search/schools") ?>",
            data: {'schoolID': schoolID},
            success: function(data) {
                // Parse the returned json data
                var opts = $.parseJSON(data);
                // Use jQuery's each to iterate over the opts value

                $.each(opts, function(i, d) {
                    if ($("#schoolname").val() != "" && $('#schoolname_changed').val() == "1") {
                        var sname = $("#schoolname").val();
                        $("#school option:selected").text(sname);
                        $("#school option:selected").val(sname);
                    }
                    $('#school option:selected').prop('selected', false);
//                     $('#school').find('option').not(':first').remove();
//                   d.Name = 'Southgate Elementary';
                    // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
//                    alert(d.Name);

                    $('#school').append('<option value="' + d.Name + '">' + d.Name + '</option>');

                });
                $('#schoolname_changed').val('0');
            }
        });
    }
</script>

<script>
//js code after document is ready
//Search autocomplete
    $("#student").autocomplete({
        minLength: 3,
        source: function(req, add) {
            $.ajax({
                url: '<?= base_url("search/student_search/students") ?>', //Controller where search is performed
                dataType: 'json',
                type: 'POST',
                data: req,
                success: function(data) {
                    if (data.response == 'true') {
                        return false;
                        add(data.message);
                    }
                }
            });
        }
    });</script>

<!-- Bootstrap SIF validation -->
<script>

    //Check dublicates sif number for copy option
    $(function() {
        if ($('#sifdub').val != 1 && window.location.search.indexOf('action=add') > -1) {
            $('#sif').keyup(function() {
//                alert('call keyup');
                var name = $('#sif').val();
                var sifhide = $('#sifhide').val();
                $.post('<?php echo base_url(); ?>nurse_assessment/assessment/check_exists', {sifnum: name}, function(d) {

                    if (d == 1 && name.trim() != "" && parseInt(name))
                    {
                        $('#msgbx_success').css('display', 'none');
                        $('#msgbx_err').css('display', 'block');
                        $('#sifhide').val(1);

                    }
                    else
                    {
                        $('#sifhide').val(0);
                        $('#msgbx_err').css('display', 'none');
                        $('#msgbx_success').css('display', 'block');
                    }
                });
            });
        }

    });
//    //Check dublicates sif number for copy option when submit the form
//    if ($('#sifdub').val != 1 && window.location.search.indexOf('action=add') > -1) {
//        $('#assessment').on('submit', function(e) {
//            var name = $('#sif').val();
//            var sifhide = $('#sifhide').val();
//            $.post('<?php #echo base_url();                                                                                                                                      ?>nurse_assessment/assessment/check_exists', {sifnum: name}, function(d, event) {
//
//                if (d == 1)
//                {
//                    $('#msgbx_success').css('display', 'none');
//                    $('#msgbx_err').css('display', 'block');
//                    $('#sifhide').val(1);
//                    return false;
//
//                }
//                else
//                {
//                    $('#sifhide').val(0);
//                    $('#msgbx_err').css('display', 'none');
//                    $('#msgbx_success').css('display', 'block');
//                }
//            });
//        });
//    }
    //Only integer
    $.validator.addMethod("nozero", function(value, element) {
        if (value.slice(0, 1) == 0) {
            return false;
        }
        else {
            return true;
        }
    }, "First letter not allowed as ZERO");
    //Onlu alphabetical and space
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
    }, "Only alphabetical characters");

    // sif validation
    // alert('hi');
    $('#appraisal').validate({
        rules: {
            sif: {
                number: true,
                minlength: 6,
                // maxlength: 15,
                maxlength: 6,
                nozero: true, // Add custom rule to validate userid field
                required: true

            },
            confirmsif: {
                equalTo: '#sif'
            },
            statenum: {
                number: true,
                minlength: 10,
                maxlength: 10,
                required: true
            },
            confirmstatenum: {
                equalTo: '#statenum'
            },
            dob: {
                required: true
            },
            'sheepItForm1_addtnlcellphone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[0]']").val() != '' && $("input[name*='sheepItForm1_addtnlhomephone[0]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[0]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlhomephone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[0]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[0]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[0]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlworkphone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[0]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[0]']").val() === '' && $("input[name*='sheepItForm1_addtnlhomephone[0]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlcellphone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[1]']").val() != '' && $("input[name*='sheepItForm1_addtnlhomephone[1]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[1]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlhomephone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[1]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[1]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[1]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlworkphone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[1]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[1]']").val() === '' && $("input[name*='sheepItForm1_addtnlhomephone[1]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlcellphone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[2]']").val() != '' && $("input[name*='sheepItForm1_addtnlhomephone[2]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[2]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlhomephone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[2]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[2]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[2]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlworkphone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[2]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[2]']").val() === '' && $("input[name*='sheepItForm1_addtnlhomephone[2]']").val() === '');

                    }
                }
            }
        },
        // Specify the validation error messages
        messages: {
            sif: {
                required: "SIF number required",
                minlength: "The SIF must be at least {0} digits long"
            },
            confirmsif: {
                equalTo: "SIF number does not match"
            },
            statenum: {
                required: "State number required",
                minlength: "The State number must be {0} digits exactly"
            },
            confirmstatenum: {
                equalTo: "State number does not match"
            }, dob: {
                required: "This field is required"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#assessment').validate({
        rules: {
            sif: {
                number: true,
                minlength: 6,
                //maxlength: 15,
                maxlength: 6,
                nozero: true, // Add custom rule to validate userid field
                required: true

            },
            confirmsif: {
                equalTo: '#sif'
            },
            statenum: {
                number: true,
                minlength: 10,
                maxlength: 10,
                required: true
            },
            confirmstatenum: {
                equalTo: '#statenum'
            },
            dob: {
                required: true
            },
            'sheepItForm1_addtnlcellphone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[0]']").val() != '' && $("input[name*='sheepItForm1_addtnlhomephone[0]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[0]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlhomephone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[0]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[0]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[0]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlworkphone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[0]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[0]']").val() === '' && $("input[name*='sheepItForm1_addtnlhomephone[0]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlcellphone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[1]']").val() != '' && $("input[name*='sheepItForm1_addtnlhomephone[1]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[1]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlhomephone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[1]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[1]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[1]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlworkphone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[1]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[1]']").val() === '' && $("input[name*='sheepItForm1_addtnlhomephone[1]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlcellphone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[2]']").val() != '' && $("input[name*='sheepItForm1_addtnlhomephone[2]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[2]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlhomephone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[2]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[2]']").val() === '' && $("input[name*='sheepItForm1_addtnlworkphone[2]']").val() === '');

                    }
                }
            },
            'sheepItForm1_addtnlworkphone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_addtnlcontact[2]']").val() != '' && $("input[name*='sheepItForm1_addtnlcellphone[2]']").val() === '' && $("input[name*='sheepItForm1_addtnlhomephone[2]']").val() === '');

                    }
                }
            }
//            'sheepItForm1_addtnlhomephone[]': {
//                require_from_group: [1,".agencyname"]
//            },
//            'sheepItForm1_addtnlworkphone[]': {
            //                require_from_group: [1,".agencyname"]
//            }
        },
        // Specify the validation error messages
        messages: {
            sif: {
                required: "SIF number required",
                minlength: "The SIF must be at least {0} digits long"
            },
            confirmsif: {
                equalTo: "SIF number does not match"
            },
            statenum: {
                required: "State number required",
                minlength: "The State number must be {0} digits exactly"
            },
            confirmstatenum: {
                equalTo: "State number does not match"
            },
            dob: {
                required: "This field is required"
            }},
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }

        }

    });


    function checkval() {
        if (($('#sifhide').val()) == 1) {
            return false;
        }
        else {
            return true;
        }

    }


    //Assessment 02 validation
    $('#assessment2').validate({
        rules: {
            describe_milestones: {
                required: function() {
                    return $('#milestone:selected:selected').length = 1;
                }
            },
            describe_complications: {
                required: function() {
                    return $('#complications:selected:selected').length = 1;
                }
            },
            describe_emergencies: {
                required: function() {
                    return $('#emergencies:selected:selected').length = 1;
                }
            }, accomodations_lt: {
                required: false
            },
            'sheepItForm_diagnosis[]': {
                required: true
            },
            birthweight: {
                required: false
            },
            gestation: {
                required: false
            },
            complications: {
                required: true
            },
            emergencies: {
                required: true
            },
            previousdate: {
                required: false
            },
            narrative: {
                required: false
            }

        }
    });





    //Assessment 03 validation
    $('#assessment3').validate({
        rules: {
            describe_release1: {
                required: function() {
                    return $('#release1:selected:selected').length = 1;
                }
            },
            describe_sheepItForm: {
                required: function() {
                    return $('#sheepItForm1_release:selected:selected').length = 1;
                }
            },
            primary: {
                required: true
            },
            phone1: {
                required: true
            },
            release_exp1: {
                required: true
            },
            'sheepItForm1_type[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[0]']").val() != '');

                    }
                }
            },
            'sheepItForm1_phone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[0]']").val() != '');

                    }
                }
            },
            'sheepItForm1_type[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[1]']").val() != '');

                    }
                }
            },
            'sheepItForm1_phone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[1]']").val() != '');

                    }
                }
            },
            'sheepItForm1_type[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[2]']").val() != '');

                    }
                }
            },
            'sheepItForm1_phone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[2]']").val() != '');

                    }
                }
            },
//            'sheepItForm1_phone[]': {
//                required: function() {
//                    return $('input[name="sheepItForm1_specialist[]"]').val() != '';
//                }
//            },
//            'sheepItForm1_type[]': {
//                required: function() {
//                    return $('input[name="sheepItForm1_specialist[]"]').val() != '';
            //                }
//            },
            'sheepItForm1_describe_sheepItForm[]': {
                required: function() {
                    return $('input[name="sheepItForm1_release[]"]:checked', '#assessment3').val() != 'yes';
                }
            },
            'sheepItForm1_releaseexp[]': {
                required: function() {
                    return $('input[name="sheepItForm1_release[]"]:checked', '#assessment3').val() != 'yes';
                }
            },
//            'sheepItForm1_releaseexp[]': {
            //                required: true
            //            },
            dentist: {
                required: false
            },
            dentalexam: {
                required: function() {
                    return $('input[name="dentist"]').val() != '';
                }
            },
            dentalhistory: {
                required: function() {
                    return $('input[name="dentist"]').val() != '';
                }
            },
            hearing: {
                required: false
            },
            hearingexam: {
                required: function() {
                    return $('input[name="hearing"]').val() != '';
                }
            },
            hearinghistory: {
                required: function() {
                    return $('input[name="hearing"]').val() != '';
                }
            },
            vision: {
                required: false
            },
            visionexam: {
                required: function() {
                    return $('input[name="vision"]').val() != '';
                }
            },
            visionhistory: {
                required: function() {
                    return $('input[name="vision"]').val() != '';
                }
            }
//            'sheepItForm_name[]': {
//                required: true
//            },
//            'sheepItForm_phone[]': {
//                required: true
//            },
//            'sheepItForm_fax[]': {
            //                required: true
            //            }

        }
    });
    //Assessment 04 validation
    $('#assessment4').validate({
        rules: {
            'sheepItForm_med[]': {
                required: true
            },
            'sheepItForm_dos[]': {
                required: true
            },
            'sheepItForm_time[]': {
                required: true
            },
            'sheepItForm_route[]': {
                required: true
            },
            'sheepItForm1_prnmed[]': {
                required: true
            },
            'sheepItForm1_prndos[]': {
                required: true
            },
            'sheepItForm1_prntime[]': {
                required: true
            },
            'sheepItForm1_prnroute[]': {
                required: true
            }


        }

    });

    //Assessment 05 validation
    $('#assessment5').validate({
        rules: {
            treatment1: {
                required: true
            },
            frequency1: {
                required: true
            },
            person1: {
                required: true
            },
            'sheepItForm_allergy[0]': {
                required: true
            },
            'sheepItForm_reaction[0]': {
                required: true
            },
            'sheepItForm_reaction[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm_allergy[1]']").val() != '');

                    }
                }
            },
            'sheepItForm_reaction[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm_allergy[2]']").val() != '');

                    }
                }
            },
            'sheepItForm_ah[]': {
                required: true
            },
            'sheepItForm_lastevent[]': {
                required: true
            },
            'sheepItForm_addtnlcomments[]': {
                required: false
            }
        }
    });
    //Assessment 06 validation
    $('#assessment6').validate({
        rules: {
            device_describe: {
                required: function() {
                    return $('#devices:selected:selected').length = 1;
                }
            },
            shunt_type: {
                required: function() {
                    return $('input[name=shunt]:checked', '#assessment6').val() == 'yes';
                }
            },
            shunt_placement: {
                required: function() {
                    return $('input[name=shunt]:checked', '#assessment6').val() == 'yes';
                }
            },
            last_revision: {
                required: function() {
                    return $('input[name=shunt]:checked', '#assessment6').val() == 'yes';
                }
            },
            seizure_type: {
                required: function() {
                    return $('input[name=seizures]:checked', '#assessment6').val() == 'yes';
                }
            },
//            hearing_screening: {
//                required: true
//            },
//            vision_screening: {
//                required: true
//            },
//            communication_comments: {
            //                required: true
//            },
            last_seizure_exam: {
                required: true
            },
            onset_age: {
                required: true
            },
            last_seizure: {
                required: true
            },
            usual_duration: {
                required: true
            },
            seizure_frequency: {
                required: true
            },
            status_epilecticus: {
                required: true
            },
            triggers: {
                required: true
            },
            post_seizure: {
                required: true
            }, aura_description: {
                required: true
            }, seizure_comments: {
                required: true
            }
        },
    });
//
//    jQuery.validator.addMethod('check_checkbox', function (value, element, param) {
//        return (value != 0) && (value == parseInt(value, 10));
    //    }, 'Please enter a non zero integer value!');
//

    //Assessment 07 validation
    $('#assessment7').validate({
        rules: {
            constipation_mgmnt: {
                required: function() {
                    return $('input[name=constipation]:checked', '#assessment7').val() == 'yes';
                }
            },
            colostomy_mgmnt: {
                required: function() {
                    return $('input[name=colostomy]:checked', '#assessment7').val() == 'yes';
                }
            },
            bladder_mgmnt: {
                required: function() {
                    return $('input[name=bladder]:checked', '#assessment7').val() == 'yes';
                }
            },
            menstruation_mgmt: {
                required: function() {
                    return $('input[name=menstruation]:checked', '#assessment7').val() == 'yes';
                }
            },
            cath_size: {
                required: function() {
                    return $('input[name=catheter]:checked', '#assessment7').val() == 'yes';
                }
            },
            cath_freq: {
                required: function() {
                    return $('input[name=catheter]:checked', '#assessment7').val() == 'yes';
                }
            },
            elimination_addtnl: {
                required: false
            }



        }
    });
    //Assessment 08 validation
    $('#assessment8').validate({
        rules: {
            cardiac_history: {
                required: true
            },
            restrict_list: {
                required: function() {
                    return $('input[name=restrictions]:checked', '#assessment8').val() == 'yes';
                }
            },
            skin_color_comment: {
                required: function() {
                    return $('input[name=skin_color_other]:checked', '#assessment8').val() == 'Other';
                }
            },
            cardiac_addtnl: {
                required: false
            }
        }
    });
    //Assessment 09 validation
    $('#assessment9').validate({
        rules: {
            med_freq: {
                required: function() {
                    return $('input[name=med_delivery]:checked', '#assessment9').val() == 'None';
                }
            },
            peak_best: {
                required: function() {
                    return $('input[name=peak]:checked', '#assessment9').val() == 'yes';
                }
            },
            vest_freq: {
                required: function() {
                    return $('input[name=pulm_vest]:checked', '#assessment9').val() == 'yes';
                }
            },
            chest_pt_freq: {
                required: function() {
                    return $('input[name=chest_pt]:checked', '#assessment9').val() == 'yes';
                }
            },
            other_trigger: {
                required: function() {
                    return $('input[name=triggers_other]:checked', '#assessment9').val() == 'Other';
                }
            },
            other_usual_symptoms: {
                required: function() {
                    return $('input[name=usual_symptoms_other]:checked', '#assessment9').val() == 'Other';
                }
            },
            pe_explain: {
                required: function() {
                    return $('input[name=pe]:checked', '#assessment9').val() == 'yes';
                }
            },
            med_freq: {
                required: function() {
                    return $('input[name=med_delivery]:checked', '#assessment9').val() != 'None';
                }
            },
            diagnosis_age: {
                required: true
            },
            spacer_type: {
                required: true
            },
            resp_addtnl: {
                required: false
            }

        }
    });
    //Assessment 08 validation
    $('#assessment10').validate({
        rules: {
            med_freq: {
                required: true
            },
            spacer_type: {
                required: true
            },
            peak_best: {
                required: true
            },
            vest_freq: {
                required: true
            },
            chest_pt_freq: {
                required: true
            },
            resp_addtnl: {
                required: false
            }
        }
    });
    //Assessment 11 validation
    $('#assessment11').validate({
        rules: {
            ox_freq: {
                required: function() {
                    return $('input[name=oximetry]:checked', '#assessment11').val() == 'yes';
                }
            },
            ox_param: {
                required: function() {
                    return $('input[name=oximetry]:checked', '#assessment11').val() == 'yes';
                }
            },
            co2_freq: {
                required: function() {
                    return $('input[name=co2]:checked', '#assessment11').val() == 'yes';
                }
            },
            co2_param: {
                required: function() {
                    return $('input[name=co2]:checked', '#assessment11').val() == 'yes';
                }
            },
            vent_assist: {
                required: function() {
                    return $('input[name=vent_depend_assist]:checked', '#assessment11').val() == 'Ventilator Assist';
                }
            },
            vent_co: {
                required: function() {
                    return $('input[name=ventilation]:checked', '#assessment11').val() != "" || $('input[name=vent_depend_dependent]:checked', '#assessment11').val() != undefined || $('input[name=vent_depend_assist]:checked', '#assessment11').val() != undefined;
                },
                lettersonly: true

            },
            addtnl_vent: {
                required: function() {
                    return ($('input[name=ventilation]:checked', '#assessment11').val() == 'CPAP' || $('input[name=ventilation]:checked', '#assessment11').val() == 'BIPAP');
                }
            },
            baseline_assess: {
                required: true
            },
            vent_contact: {
                required: function() {
                    return ($('input[name=ventilation]:checked', '#assessment11').val() == 'CPAP' || $('input[name=ventilation]:checked', '#assessment11').val() == 'BIPAP' || $('input[name=vent_depend_dependent]:checked', '#assessment11').val() != undefined || $('input[name=vent_depend_assist]:checked', '#assessment11').val() != undefined);
                },
                number: true
            },
            distress_sign: {
                required: true
            },
            evac: {
                required: true
            },
            cath_size: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }

            },
            cath_freq: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }
            },
            cath_color: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }
            },
            suction_equip: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }
            },
            //            if trach_type_n check
            cath_size2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }

            },
            cath_freq2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            cath_color2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            suction_equip2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            //            if trach_type_n check
            cath_size3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }

            },
            cath_freq3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            cath_color3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            suction_equip3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            }

        }
    });
    //Assessment 12 validation
    $('#assessment12').validate({
        rules: {
            pos_plan_desc: {
                required: function() {
                    return $('input[name=pos_plan]:checked', '#assessment12').val() == 'yes';
                }
            },
            orth_desc: {
                required: function() {
                    return $('input[name=orth]:checked', '#assessment12').val() == 'yes';
                }
            },
            vent_co: {
                required: true
            }

        }
    });
    //Assessment 13 validation
    $('#assessment13').validate({
        rules: {
            food_texture: {
                required: true
            },
//            fluid_restriction: {
            //                required: true
            //            },
            gtube_size: {
                required: function() {
                    return $('input[name=feeding_tubeval]:checked', '#assessment13').val() == 'yes';
                }
            },
            tube_type: {
                required: function() {
                    return $('input[name=feeding_tubeval]:checked', '#assessment13').val() == 'yes';
                }
            },
            inst_dislodged: {
                required: function() {
                    return $('input[name=feeding_tubeval]:checked', '#assessment13').val() == 'yes';
                }
            },
            swallow_study_date: {
                required: function() {
                    return $('#swallow_vfss:checkbox:checked').length == 1;
                }
            },
            swallow_study_loc: {
                required: function() {
                    return $('#swallow_endo:checkbox:checked').length == 1;
                }
            },
            reflux_tx: {
                required: function() {
                    return $('input[name=reflux]:checked', '#assessment13').val() == 'yes';
                }
            },
            clinic_details: {
                required: function() {
                    return $('input[name=clinic]:checked', '#assessment13').val() == 'yes';
                }
            },
            smart_manager: {
                required: function() {
                    return $('input[name=smart_team]:checked', '#assessment13').val() == 'yes';
                }
            },
//            meal_care: {
//                required: function() {
//                    return $('input[name=smart_team]:checked', '#assessment13').val() == 'yes';
            //                }
            //            },
            feed_freq: {
                required: function() {
                    return ($("#tube_feedings_bolus").val() === 'Bolus' || $("#tube_feedings_pump").val() === 'Pump');
                }
            },
//            inst_dislodged: {
            //                required: true
            //            },
            ordering_doc: {
                required: false
            },
            nutr_comments: {
                required: false
            }
        }
    });
    //Assessment 14 validation
    $('#assessment14').validate({
        rules: {
            othertest: {
                required: function() {
                    return $('input[name=test_when_other]:checked', '#assessment14').val() == 'other';
                }
            },
            type_ins_school: {
                required: function() {
                    return $('input[name=insulin_school]:checked', '#assessment14').val() == 'yes';
                }
            },
            otherins: {
                required: function() {
                    return $('input[name=insulin_type_other]:checked', '#assessment14').val() == 'other';
                }
            },
            insulin_manu: {
                required: function() {
                    return ($('input[name=insulin_type_syringe]:checked', '#assessment14').val() === 'syringe' || $('input[name=insulin_type_pen]:checked', '#assessment14').val() === 'pen' || $('input[name=insulin_type_pod]:checked', '#assessment14').val() === 'pod');
                }
            },
            discretionary_list: {
                required: function() {
                    return $('#discrete:selected:selected').length = 1;
                }
            }, lunch_correction: {
                required: function() {
                    return $('#before_lunch:selected:selected').length = 1;
                }
            },
            lunch_carb: {
                required: function() {
                    return $('#counts_carbs:selected:selected').length = 1;
                }
            },
            snack_carb: {
                required: function() {
                    return $('#counts_carbs:selected:selected').length = 1;
                }
            },
            break_carb: {
                required: function() {
                    return $('#school_breakfast:selected:selected').length = 1;
                }
            },
            glucagon_order: {
                required: function() {
                    return $('#school_glucagon:selected:selected').length = 1;
                }
            },
            othergrade: {
                required: function() {
                    return $('#grade').val() == 'Other';
                }
            },
            target: {
                required: true
            },
            hypo_treatment: {
                required: true
            },
            insulin_key_order: {
                required: true
            },
//            home_insulin_order: {
            //                required: true
            //            },
            lockdown: {
                required: true
            },
            ageofdia: {
                required: true
            },
            crisis_date: {
                required: function() {
                    return $('input[name=crisis_ex]:checked', '#assessment14').val() == 'yes';
                }
            },
            crisis_symptoms: {
                required: function() {
                    return $('input[name=crisis_ex]:checked', '#assessment14').val() == 'yes';
                }
            },
            od_when: {
                required: function() {
                    return $('input[name=routine]:checked', '#assessment14').val() == 'yes';
                }
            },
            od_times: {
                required: function() {
                    return $('input[name=or_surg]:checked', '#assessment14').val() == 'yes';
                }
            },
            od_timelast: {
                required: function() {
                    return $('input[name=or_surg]:checked', '#assessment14').val() == 'yes';
                }
            },
            od_desc: {
                required: function() {
                    return $('input[name=od_needschool]:checked', '#assessment14').val() == 'yes';
                }
            },
            o_supp_desc: {
                required: function() {
                    return $('input[name=o_supp]:checked', '#assessment14').val() == 'yes';
                }
            },
            o_cdue_desc: {
                required: function() {
                    return $('input[name=o_cdue]:checked', '#assessment14').val() == 'yes';
                }
            },
            o_res_desc: {
                required: function() {
                    return $('input[name=o_res]:checked', '#assessment14').val() == 'yes';
                }
            },
            assist_tech_lt: {
                required: function() {
                    return $('input[name=assist_tech]:checked', '#assessment14').val() == 'yes';
                }
            }, accomodations_lt: {
                required: function() {
                    return $('input[name=accomodations]:checked', '#assessment14').val() == 'yes';
                }
            },
            health_concern: {
                required: true
            },
            timedia: {
                required: true
            },
            od_sym: {
                required: true
            },
            od_lvisit: {
                required: true
            },
            od_often: {
                required: true
            },
            describe_Snacks: {
                required: function() {
                    return $('input[name=bus_snacks]:checked', '#assessment14').val() == 'yes';
                }
            },
            bus_mod_list: {
                required: function() {
                    return $('input[name=bus_mod]:checked', '#assessment14').val() == 'yes';
                }
            },
            list_bus_meds: {
                required: function() {
                    return $('input[name=bus_meds]:checked', '#assessment14').val() == 'yes';
                }
            }
        }
    });
    //Assessment 15 validation
    $('#assessment15').validate({
        rules: {
            trans_comments: {
                required: false
            }

        }
    });
    //Assessment 16 validation
    $('#assessment16').validate({
        rules: {
            cultural_info: {
                required: true
            },
            hcap_seizure_review: {
                required: true
            },
            hcap_seizure_dist: {
                required: true
            }, hcap_hypo_review: {
                required: true
            },
            hcap_hypo_dist: {
                required: true
            },
            hcap_allergy_review: {
                required: true
            },
            hcap_allergy_dist: {
                required: true
            },
            hcap_gtube_review: {
                required: true
            },
            hcap_gtube_dist: {
                required: true
            },
            hcap_cardiac_review: {
                required: true
            },
            hcap_cardiac_dist: {
                required: true
            }, hcap_resp_review: {
                required: true
            },
            hcap_resp_dist: {
                required: true
            }, hcap_emer_review: {
                required: true
            },
            hcap_emer_dist: {
                required: true
            },
            delegatable: {
                required: true
            },
            non_delegatable: {
                required: true
            },
            parents_provide: {
                required: true
            },
            school_provide: {
                required: true
            },
            datereview1: {
                required: function() {
                    return $('input[name="planname1"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist1: {
                required: function() {
                    return $('input[name="planname1"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview2: {
                required: function() {
                    return $('input[name="planname2"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist2: {
                required: function() {
                    return $('input[name="planname2"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview3: {
                required: function() {
                    return $('input[name="planname3"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist3: {
                required: function() {
                    return $('input[name="planname3"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview4: {
                required: function() {
                    return $('input[name="planname4"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist4: {
                required: function() {
                    return $('input[name="planname4"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview5: {
                required: function() {
                    return $('input[name="planname5"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist5: {
                required: function() {
                    return $('input[name="planname5"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview6: {
                required: function() {
                    return $('input[name="planname6"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist6: {
                required: function() {
                    return $('input[name="planname6"]:checked', '#assessment16').val() == 'yes';
                }
            },
        }
    });
    //Appraisal 02 validation
    $('#appraisal2').validate({
        rules: {
            describemilestones: {
                required: function() {
                    return $('input[name="milestones"]:checked', '#appraisal2').val() == 'milestoneno';
                }
            },
            list_bus_meds: {
                required: function() {
                    return $('#bus_meds:selected:selected').length = 1;
                }
            },
            othergrade: {
                required: function() {
                    return $('#grade').val() == 'Other';
                }
            },
            bus_mod_list: {
                required: function() {
                    return $('#bus_mod:selected:selected').length = 1;
                }
            },
            describe_complications: {
                required: function() {
                    return $('#complications:selected:selected').length = 1;
                }
            },
            describe_emergencies: {
                required: function() {
                    return $('#emergencies:selected:selected').length = 1;
                }
            },
            assisttechlist: {
                required: false
            },
            reevaldate: {
                required: false
            },
            accomodationslist: {
                required: false
            },
            'sheepItForm_diagnosis[]': {
                required: false
            },
            birthweight: {
                required: false
            },
            gestation: {
                required: false
            },
            complications: {
                required: true
            },
            emergencies: {
                required: true
            },
            previous: {
                required: false
            },
            narrative: {
                required: false
            },
        }
    });


    //Appraisal 3 validation
    $('#appraisal3').validate({
        rules: {
            seizuretype: {
                required: function() {
                    return $('input[name="seizures[]"]:checked', '#appraisal3').val() == 'seizuresyes';
                }
            },
            shunttype: {
                required: function() {
                    return $('input[name="shunt"]:checked', '#appraisal3').val() == 'shuntyes';
                }
            },
            shuntplacement: {
                required: function() {
                    return $('input[name="shunt"]:checked', '#appraisal3').val() == 'shuntyes';
                }
            },
            lastrevision: {
                required: function() {
                    return $('input[name="shunt"]:checked', '#appraisal3').val() == 'shuntyes';
                }
            },
            med_freq: {
                required: function() {
                    return $('input[name=med_delivery]:checked', '#appraisal3').val() != 'None';
                }
            },
            other_trigger: {
                required: function() {
                    return $('input[name=triggers_other]:checked', '#appraisal3').val() == 'Other';
                }
            },
            other_usual_symptoms: {
                required: function() {
                    return $('input[name=usual_symptoms_other]:checked', '#appraisal3').val() == 'Other';
                }
            },
            describe_release1: {
                required: function() {
                    return $('#release1:selected:selected').length = 1;
                }
            },
            describe_sheepItForm: {
                required: function() {
                    return $('#sheepItForm1_release:selected:selected').length = 1;
                }
            },
            device_describe: {
                required: function() {
                    return $('#devices:selected:selected').length = 1;
                }
            },
            'sheepItForm1_type[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[0]']").val() != '');

                    }
                }
            },
            'sheepItForm1_phone[0]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[0]']").val() != '');

                    }
                }
            },
            'sheepItForm1_type[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[1]']").val() != '');

                    }
                }
            },
            'sheepItForm1_phone[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[1]']").val() != '');

                    }
                }
            },
            'sheepItForm1_type[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[2]']").val() != '');

                    }
                }
            },
            'sheepItForm1_phone[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm1_specialist[2]']").val() != '');

                    }
                }
            },
            primary: {
                required: true
            },
            phone1: {
                required: true
            },
            releaseexp1: {
                required: true
            },
            dentist: {
                required: false
            },
            dentalexam: {
                required: function() {
                    return $('input[name="dentist"]').val() != '';
                }
            },
            dentalhistory: {
                required: function() {
                    return $('input[name="dentist"]').val() != '';
                }
            },
            hearing: {
                required: false
            },
            hearingexam: {
                required: function() {
                    return $('input[name="hearing"]').val() != '';
                }
            },
            hearinghistory: {
                required: function() {
                    return $('input[name="hearing"]').val() != '';
                }
            },
            vision: {
                required: false
            },
            visionexam: {
                required: function() {
                    return $('input[name="vision"]').val() != '';
                }
            },
            visionhistory: {
                required: function() {
                    return $('input[name="vision"]').val() != '';
                }
            },
            'dentalrelease[]': {
                required: false
            },
            'hearingrelease[]': {
                required: false
            },
            'visionrelease[]': {
                required: false
            },
            'sheepItForm_name[]': {
                required: true,
            },
            'sheepItForm_phone[]': {
                required: true
            },
            'sheepItForm2_med[]': {
                required: true
            },
            'sheepItForm2_dos[]': {
                required: true
            },
            'sheepItForm2_time[]': {
                required: true
            },
            'sheepItForm2_route[]': {
                required: true
            },
            'sheepItForm2_home0': {
                required: true
            },
            'sheepItForm3_prnmed[]': {
                required: true
            },
            'sheepItForm3_prndos[]': {
                required: true
            },
            'sheepItForm3_prntime[]': {
                required: true
            },
            'sheepItForm3_prnroute[]': {
                required: true
            },
            'sheepItForm3_prnschool0': {
                required: true
            },
            treatment1: {
                required: true
            },
            frequency1: {
                required: true
            },
            'performed1[]': {
                required: true
            },
            person1: {
                required: true
            },
            'sheepItForm4_allergy[0]': {
                required: true
            },
            'sheepItForm4_reaction[0]': {
                required: true
            },
            'sheepItForm4_reaction[1]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm4_allergy[1]']").val() != '');

                    }
                }
            },
            'sheepItForm4_reaction[2]': {
                required: {
                    depends: function(element) {
                        return ($("input[name*='sheepItForm4_allergy[2]']").val() != '');

                    }
                }
            },
            sheepItForm4_0_touch: {
                required: true
            },
            'sheepItForm4_ah[]': {
                required: true
            },
            'sheepItForm4_lastevent[]': {
                required: true
            },
            'sheepItForm4_addtnlcomments[]': {
                required: false
            },
            'needtype[]': {
                required: true
            },
            'devicelist[]': {
                required: true
            },
            lastseizureexam: {
                required: true
            },
            onsetage: {
                required: true
            },
            lastseizure: {
                required: true
            },
            usualduration: {
                required: true
            },
            seizurefrequncy: {
                required: true
            },
            statusepilectus: {
                required: true
            },
            triggers: {
                required: true
            },
            'seizuretreatment[]': {
                required: true
            },
            postseizure: {
                required: true
            },
            auradescription: {
                required: true
            },
            seizurecomments: {
                required: true
            },
            constipation_mgmnt: {
                required: function() {
                    return $('input[name=constipation]:checked', '#appraisal3').val() == 'Yes';
                }
            },
            colostomy_mgmnt: {
                required: function() {
                    return $('input[name=colostomy]:checked', '#appraisal3').val() == 'Yes';
                }
            },
            bladder_mgmnt: {
                required: function() {
                    return $('input[name=bladder]:checked', '#appraisal3').val() == 'Yes';
                }
            },
            menstruation_mgmt: {
                required: function() {
                    return $('input[name=menstruation]:checked', '#appraisal3').val() == 'Yes';
                }
            },
            cath_size: {
                required: function() {
                    return $('input[name=catheter]:checked', '#appraisal3').val() == 'Yes';
                }
            },
            cath_freq: {
                required: function() {
                    return $('input[name=catheter]:checked', '#appraisal3').val() == 'Yes';
                }
            },
            peak_best: {
                required: function() {
                    return $('input[name=peak]:checked', '#appraisal3').val() == 'peakyes';
                }
            },
            vestfreq: {
                required: function() {
                    return $('input[name=pulmvest]:checked', '#appraisal3').val() == 'pulmvestyes';
                }
            },
            chestptfreq: {
                required: function() {
                    return $('input[name=chestpt]:checked', '#appraisal3').val() == 'chestptyes';
                }
            },
            elimination_addtnl: {
                required: false
            },
            cardiac_history: {
                required: true
            },
            restrict_list: {
                required: function() {
                    return $('input[name=restrictions]:checked', '#appraisal3').val() == 'Yes';
                }
            },
            skin_color_comment: {
                required: function() {
                    return $('input[name=skin_color_other]:checked', '#appraisal3').val() == 'Other';
                }
            },
            cardiac_addtnl: {
                required: false
            },
            diagnosis_age: {
                required: true
            },
            pe_explain: {
                required: true
            },
            medfreq: {
                required: true
            },
            spacertype: {
                required: true
            },
            peakbest: {
                required: true
            },
            submitHandler: function(form) {
                return false; // if you need to block normal submit because you used ajax
            }
        }

    });


    //Appraisal 4 validation
    $('#appraisal4').validate({
        rules: {
            baseline_assess: {
                required: true
            },
            distress_sign: {
                required: true
            },
            oximetry: {
                required: true
            },
            ox_freq: {
                required: function() {
                    return $('input[name=oximetry]:checked', '#appraisal4').val() == 'yes';
                }
            },
            ox_param: {
                required: function() {
                    return $('input[name=oximetry]:checked', '#appraisal4').val() == 'yes';
                }
            },
            co2_freq: {
                required: function() {
                    return $('input[name=co2]:checked', '#appraisal4').val() == 'yes';
                }
            },
            co2_param: {
                required: function() {
                    return $('input[name=co2]:checked', '#appraisal4').val() == 'yes';
                }

            },
            vent_co: {
                required: function() {
                    return $('input[name=ventilation]:checked', '#appraisal4').val() != '';
                },
                lettersonly: true
            },
            addtnl_vent: {
                required: function() {
                    return ($('input[name=ventilation]:checked', '#appraisal4').val() == 'CPAP' || $('input[name=ventilation]:checked', '#appraisal4').val() == 'BIPAP');
                }
            },
            vent_assist: {
                required: function() {
                    return $('input[name=vent_depend]:checked', '#appraisal4').val() == '';
                }
            },
            co2: {
                required: true
            },
            suction: {
                required: true
            },
            equip_check: {
                required: true
            },
            vent_set: {
                required: false
            },
//            vent_co: {
            //                required: true
            //            },
            vent_contact: {
                required: function() {
                    return ($('input[name=ventilation]:checked', '#appraisal4').val() == 'CPAP' || $('input[name=ventilation]:checked', '#appraisal4').val() == 'BIPAP');
                },
                number: true
            },
            trach_size: {
                required: false
            },
            evac: {
                required: true
            },
            cath_size: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }

            },
            cath_freq: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }
            },
            cath_color: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }
            },
            suction_equip: {
                required: function() {
                    return $('#trach_type_o:checkbox:checked').length = 1;
                }
            },
            //            if trach_type_n check
            cath_size2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }

            },
            cath_freq2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            cath_color2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            suction_equip2: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            //            if trach_type_n check
            cath_size3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }

            },
            cath_freq3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            cath_color3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            suction_equip3: {
                required: function() {
                    return $('#trach_type_n:checkbox:checked').length = 1;
                }
            },
            pos_plan_desc: {
                required: function() {
                    return $('input[name=pos_plan]:checked', '#appraisal4').val() == 'Yes';
                }
            },
            orth_desc: {
                required: function() {
                    return $('#orth:checkbox:checked').length == 1;
                }
            }

        }
    });
//    //Appraisal 5 validation
//    $('#appraisal5').validate({
//        rules: {
//            constipation_mgmnt: {
//                required: true
//            },
//            colostomy_mgmnt: {
//                required: true
//            },
//            bladder_mgmnt: {
//                required: true
//            },
//            cath_size: {
//                required: true
//            },
//            cath_freq: {
//                required: true
//            },
//            menstruation_mgmt: {
//                required: true
//            },
//            elimination_addtnl: {
//                required: false
//            },
//            cardiac_history: {
//                required: true
//            },
//            baseline: {
//                required: true
//            },
//            cardiac_addtnl: {
//                required: false
//            },
//            diagnosis_age: {
//                required: true
//            },
//            pe_explain: {
//                required: true
//            },
//            medfreq: {
//                required: true
//            },
//            spacertype: {
//                required: true
//            },
//            peakbest: {
//                required: true
    //            }
//        }
//    });

    //Assessment 16 validation
    $('#appraisal6').validate({
        rules: {
            othertest: {
                required: function() {
                    return $('input[name=test_when_other]:checked', '#appraisal6').val() == 'other';
                }
            },
            otherins: {
                required: function() {
                    return $('input[name=insulin_type_other]:checked', '#appraisal6').val() == 'other';
                }
            },
            gtube_size: {
                required: function() {
                    return $('input[name=feeding_tubeval]:checked', '#appraisal6').val() == 'yes';
                }
            },
            tube_type: {
                required: function() {
                    return $('input[name=feeding_tubeval]:checked', '#appraisal6').val() == 'yes';
                }
            },
            swallow_study_date: {
                required: function() {
                    //                    alert($('#swallow_vfss:checkbox:checked').length);
                    return $('#swallow_vfss:checkbox:checked').length == 0;
                }
            },
            swallow_study_loc: {
                required: function() {
                    //                     alert($('#swallow_endo:checkbox:checked').length);
                    return $('#swallow_endo:checkbox:checked').length == 0;
                }
            },
            inst_dislodged: {
                required: function() {
                    return $('input[name=feeding_tubeval]:checked', '#appraisal6').val() == 'yes';
                }
            },
            reflux_tx: {
                required: function() {
                    return $('input[name=reflux]:checked', '#appraisal6').val() == 'Yes';
                }
            },
            clinic_details: {
                required: function() {
                    return $('input[name=clinic]:checked', '#appraisal6').val() == 'yes';
                }
            },
            smart_manager: {
                required: function() {
                    return $('input[name=smart_team]:checked', '#appraisal6').val() == 'yes';
                }
            },
//            meal_care: {
//                required: function() {
//                    return $('input[name=smart_team]:checked', '#appraisal6').val() == 'Yes';
            //                }
            //            },
            o_supp_desc: {
                required: function() {
                    return $('input[name=o_supp]:checked', '#appraisal6').val() == 'yes';
                }
            },
            o_cdue_desc: {
                required: function() {
                    return $('input[name=o_cdue]:checked', '#appraisal6').val() == 'yes';
                }
            },
            o_res_desc: {
                required: function() {
                    return $('input[name=o_res]:checked', '#appraisal6').val() == 'yes';
                }
            },
            assisttechlist: {
                required: function() {
                    return $('input[name=assisttech]:checked', '#appraisal6').val() == 'assisttechyes';
                }
            },
            accomodationslist: {
                required: function() {
                    return $('input[name=accomodations]:checked', '#appraisal6').val() == 'accomodationsyes';
                }
            },
            othergrade: {
                required: function() {
                    return $('#grade').val() == 'Other';
                }
            },
            feed_freq: {
                required: function() {
                    return ($("#tube_feedings_bolus").val() === 'Bolus' || $("#tube_feedings_pump").val() === 'Pump');
                }
            }, lunch_correction: {
                required: function() {
                    return $('#before_lunch:selected:selected').length = 1;
                }
            },
            lunch_carb: {
                required: function() {
                    return $('#counts_carbs:selected:selected').length = 1;
                }
            },
            snack_carb: {
                required: function() {
                    return $('#counts_carbs:selected:selected').length = 1;
                }
            },
            break_carb: {
                required: function() {
                    return $('#school_breakfast:selected:selected').length = 1;
                }
            },
            glucagon_order: {
                required: function() {
                    return $('#school_glucagon:selected:selected').length = 1;
                }
            },
            food_texture: {
                required: true
            },
            nutr_comments: {
                required: false
            },
            target: {
                required: true
            },
            insulin_manu: {
                required: function() {
                    return ($('input[name=insulin_type_syringe]:checked', '#appraisal6').val() === 'syringe' || $('input[name=insulin_type_pen]:checked', '#appraisal6').val() === 'pen' || $('input[name=insulin_type_pod]:checked', '#appraisal6').val() === 'pod');
                }
            },
            type_ins_school: {
                required: function() {
                    return $('input[name=insulin_school]:checked', '#appraisal6').val() == 'Yes';
                }
            },
            hypo_treatment: {
                required: true
            },
            insulin_key_order: {
                required: true
            },
//            home_insulin_order: {
            //                required: true
            //            },
            lockdown: {
                required: true
            },
//            list_bus_meds: {
//                required: true
//            },
//            bus_mod_list: {
            //                required: true
            //            },
            cultural_info: {
                required: true
            },
            hcap_seizure_review: {
                required: true
            }, hcap_hypo_review: {
                required: true
            },
            hcap_allergy_review: {
                required: true
            },
            hcap_seizure_dist: {
                required: true
            },
            hcap_hypo_dist: {
                required: true
            },
            hcap_allergy_dist: {
                required: true
            },
            hcap_gtube_review: {
                required: true
            },
            hcap_gtube_dist: {
                required: true
            },
            hcap_cardiac_review: {
                required: true
            },
            hcap_cardiac_dist: {
                required: true
            }, hcap_resp_review: {
                required: true
            },
            hcap_resp_dist: {
                required: true
            }, hcap_emer_review: {
                required: true
            },
            hcap_emer_dist: {
                required: true
            },
            delegatable: {
                required: true
            },
            non_delegatable: {
                required: true
            },
            parents_provide: {
                required: true
            },
            school_provide: {
                required: true
            },
            ageofdia: {
                required: true
            },
            crisis_date: {
                required: function() {
                    return $('input[name=crisis_ex]:checked', '#appraisal6').val() == 'yes';
                }
            },
            crisis_symptoms: {
                required: function() {
                    return $('input[name=crisis_ex]:checked', '#appraisal6').val() == 'yes';
                }
            },
            od_when: {
                required: function() {
                    return $('input[name=routine]:checked', '#appraisal6').val() == 'yes';
                }
            },
            od_times2: {
                required: function() {
                    return $('input[name=or_surg]:checked', '#appraisal6').val() == 'yes';
                }
            },
            od_timelast: {
                required: function() {
                    return $('input[name=or_surg]:checked', '#appraisal6').val() == 'yes';
                }
            },
            od_desc: {
                required: function() {
                    return $('input[name=od_needschool]:checked', '#appraisal6').val() == 'yes';
                }
            },
            health_concern: {
                required: true
            },
            timedia: {
                required: true
            },
            od_sym: {
                required: true
            },
            od_lvisit: {
                required: true
            },
            od_often: {
                required: true
            },
            describe_Snacks: {
                required: function() {
                    return $('input[name=bus_snacks]:checked', '#appraisal6').val() == 'yes';
                }
            },
            bus_mod_list: {
                required: function() {
                    return $('input[name=bus_mod]:checked', '#appraisal6').val() == 'Yes';
                }
            },
            list_bus_meds: {
                required: function() {
                    return $('input[name=bus_meds]:checked', '#appraisal6').val() == 'Yes';
                }
            },
            datereview1: {
                required: function() {
                    return $('input[name="planname1"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist1: {
                required: function() {
                    return $('input[name="planname1"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview2: {
                required: function() {
                    return $('input[name="planname2"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist2: {
                required: function() {
                    return $('input[name="planname2"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview3: {
                required: function() {
                    return $('input[name="planname3"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist3: {
                required: function() {
                    return $('input[name="planname3"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview4: {
                required: function() {
                    return $('input[name="planname4"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist4: {
                required: function() {
                    return $('input[name="planname4"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview5: {
                required: function() {
                    return $('input[name="planname5"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist5: {
                required: function() {
                    return $('input[name="planname5"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datereview6: {
                required: function() {
                    return $('input[name="planname6"]:checked', '#assessment16').val() == 'yes';
                }
            },
            datedist6: {
                required: function() {
                    return $('input[name="planname6"]:checked', '#assessment16').val() == 'yes';
                }
            },
        }
    });</script>

<script>
    $(document).ready(function() {


//Default


        // $("#hidename11").hide();
        $("input[type=checkbox]").change(function()
        {
            var divId = $(this).attr("id");
            if ($(this).is(":checked")) {
                $("." + divId).hide();
            }
            else {
                $("." + divId).show();
            }
        });
        $("input[type=radio]").change(function()
        {
            var value = $(this).val();
            //alert(value);
            var divclass = $(this).attr("id");
            //alert(divname);
            // var divid = $(this).attr("id");
            if (value == 'yes' || value == 'Yes' && $(this).is(":checked") || value == 'milestoneno') {
                // alert(value);
                $("." + divclass).show();
                $(".ihps").show();
                $(".milestones").show();
                $("#default").hide();
                $("#hidename").show();
                $("#hidenamevals").show();
            } else if (value == 'milestoneyes' || value == 'yes') {
                $("#hidenamevals").hide();
            } else if (value == "seizuresno" && $(this).is(":checked")) {
                $("#hidename2").hide();
            } else if (value == "shuntno" && $(this).is(":checked")) {
                $("#hidename3").hide();
            } else if (value == "postseizureaurano" && $(this).is(":checked")) {
                $("#hidename4").hide();
            } else if (value == "" && $(this).is(":checked")) {
                $("#hidename5").hide();
            } else if (value == "postseizureaurano" && $(this).is(":checked")) {
                $("#hidename6").hide();
            }

//            else if (divname== "edasthmano" && $(this).is(":checked")){
            //                $("#hidename7").hide();
            //            }

            else {
                //alert('come nnot');

                $("." + divclass).hide();
                $("#default").show();
                $("#hidename").hide();
                $("#hidename2").show();
                $("#hidename3").show();
                $("#hidename4").show();
                $("#hidename5").show();
                $("#hidename6").show();
                $(".ihps").hide();
                $(".milestones").hide();
            }
        });
        //$("input[type=radio]").trigger( "change" );
        $("input[type=checkbox]").trigger("change");
        function setReadOnlyView(inputObjectScope)
        {
            // get all the inputs into an array.
            var inputs = $(inputObjectScope);
            var values = {};
            inputs.each(function() {

                $(this).after("<div class='readOnlyViewer'>" + $(this).val() + "</div>");
                $(this).hide();
            });
        }



<?php
// force php to initiate javascript executions for supporting the form view (readonly)
if (is_array($footerData['readOnlyViewing'])) {
    foreach ($footerData['readOnlyViewing'] as $key => $inputObjectScope) {
        print "setReadOnlyView('" . $inputObjectScope . "');";
    }
}
?>

        //For Assessment Radio button
        //2 form
        var medical = $("#ihp:checked").val();
        if (medical == "yes") {
            $(".ihps").show();
        } else {
            $(".ihps").hide();
        }
//
//        var milestone = $("#milestone:checked").val();
//        if(milestone == "yes"){
//             $(".milestones").hide();
//        }else{
        //             $(".milestones").s();
//        }
    });</script>

<script type="text/javascript">
//Assesment


    function showvalue1() {
        if (document.getElementById('ihp').checked == true) {
            document.getElementById('divval1').style.display = 'block';
        }
        else {
            document.getElementById('divval1').style.display = 'none';
        }
    }
    function showvalue2() {

        if (document.getElementById('milestone').checked == true) {
            document.getElementById('divval2').style.display = 'none';
        }
        else {
            document.getElementById('divval2').style.display = 'block';
        }
    }
    function showvalue3() {
        if (document.getElementById('devices').checked == true) {
            document.getElementById('divval3').style.display = 'block';
        }
        else {
            document.getElementById('divval3').style.display = 'none';
        }
    }
    function showvalue4() {

        if (document.getElementById('seizures').checked == true) {

            document.getElementById('divval4').style.display = 'block';
        }
        else {

            document.getElementById('divval4').style.display = 'none';
        }
    }
    function showvalue5() {

        if (document.getElementById('shunt').checked == true) {
            document.getElementById('divval5').style.display = 'block';
        }
        else {
            document.getElementById('divval5').style.display = 'none';
        }
    }
    function showvalue6() {

        if (document.getElementById('aura').checked == true) {
            document.getElementById('divval6').style.display = 'block';
        }
        else {
            document.getElementById('divval6').style.display = 'none';
        }
    }

    function showvalue7() {

        if (document.getElementById('restrictions').checked == true) {
            document.getElementById('divval7').style.display = 'block';
        }
        else {
            document.getElementById('divval7').style.display = 'none';
        }
    }
    function showvalue8() {

        if (document.getElementById('asthma').checked == true) {
            document.getElementById('divval8').style.display = 'none';
        }
        else {
            document.getElementById('divval8').style.display = 'block';
        }
    }
    function showvalue9() {

        if (document.getElementById('ed_last_year').checked == true) {
            document.getElementById('divval9').style.display = 'block';
        }
        else {
            document.getElementById('divval9').style.display = 'none';
        }
    }
    function showvalue10() {

        if (document.getElementById('pe').checked == true) {
            document.getElementById('divval10').style.display = 'block';
        }
        else {
            document.getElementById('divval10').style.display = 'none';
        }
    }
    function showvalue11() {

        if (document.getElementById('miss_school').checked == true) {
            document.getElementById('divval11').style.display = 'block';
        }
        else {
            document.getElementById('divval11').style.display = 'none';
        }
    }
    function showvalue12() {

        if (document.getElementById('ed_asthma').checked == true) {
            document.getElementById('divval12').style.display = 'block';
        }
        else {
            document.getElementById('divval12').style.display = 'none';
        }
    }

    function showvalue13() {

        if (document.getElementById('vent_depend_assist').checked == true) {
            document.getElementById('divval13').style.display = 'block';

        }
        else {
            document.getElementById('divval13').style.display = 'none';

        }
    }
    function showvalue14() {

        if (document.getElementById('pt').checked == true) {
            document.getElementById('divval14').style.display = 'block';
        }
        else {
            document.getElementById('divval14').style.display = 'none';
        }
    }

    function showvalue15() {

        if (document.getElementById('pos_plan').checked == true) {
            document.getElementById('divval15').style.display = 'block';
        }
        else {
            document.getElementById('divval15').style.display = 'none';
        }
    }

    function showvalue16() {

        if (document.getElementById('feeding_assist').checked == true) {
            document.getElementById('divval16').style.display = 'block';
        }
        else {
            document.getElementById('divval16').style.display = 'none';
        }
    }
    function showvalue17() {

        if (document.getElementById('test_ind_assist').checked == true) {
            document.getElementById('divval17').style.display = 'block';
        }
        else {
            document.getElementById('divval17').style.display = 'none';
        }
    }
    function showvalue18() {

        if (document.getElementById('discrete').checked == true) {
            document.getElementById('divval18').style.display = 'block';
        }
        else {
            document.getElementById('divval18').style.display = 'none';
        }
    }
    function showvalue19() {
        if (document.getElementById('bus_meds').checked == true) {
            document.getElementById('divval19').style.display = 'block';
        }
        else {
            document.getElementById('divval19').style.display = 'none';
        }
    }

    function showvalue20() {
        if (document.getElementById('bus_mod').checked == true) {
            document.getElementById('divval20').style.display = 'block';
        }
        else {
            document.getElementById('divval20').style.display = 'none';
        }
    }
    function showvalue50(val) {
        if (val == "yes") {
            $('#hidename50').show();
        }
        else {
            $('#hidename50').hide();
        }
    }
    function showvalue51(val) {

        if (val == "yes" || val == "release1yes") {
            $('#hidename51').show();
        }
        else {
            $('#hidename51').hide();
        }
    }
//    function showvalue52(val) {
//        if (val == "yes") {
//            $('#hidename52').show();
//        }
//        else {
    //            $('#hidename52').hide();
//        }
    //    }     function showvalue52(val, increment) {

    if (val == "yes" && increment == 0) {
        $('#hidename52_' + increment).show();
    }
    else if (val == "no" && increment == 0) {
        $('#hidename52_' + increment).hide();
    }

    if (val == "yes" && increment == 1) {
        $('#hidename52_' + increment).show();
    }
    else if (val == "no" && increment == 1) {
        $('#hidename52_' + increment).hide();
    }
    //Date  inc=2
    if (val == "yes" && increment == 2) {
        $('#hidename52_' + increment).show();
    }
    else if (val == "no" && increment == 2) {
        $('#hidename52_' + increment).hide();
    }

    if (val == "yes" && increment == 3) {
        $('#hidename52_' + increment).show();
    } else if (val == "" && increment == 3) {
        $('#hidename52_' + increment).hide();
    }

    if (val == "yes" && increment == 4) {
        $('#hidename52_' + increment).show();
    } else if (val == "" && increment == 4) {
        $('#hidename52_' + increment).hide();
    }

    }



//Appraisal











    function showva25(val) {
        if (val == "yes") {
            $('#hidename25').hide();
        }
        else {
            $('#hidename25').show();
        }
    }
    function showva75(val) {
        if (val == "yes") {
            $('#hidename75').show();
        }
        else {
            $('#hidename75').hide();
        }
    }
    function showva76(val) {
        if (val == "yes") {
            $('#hidename76').show();
        }
        else {
            $('#hidename76').hide();
        }
    }
    function showvalue26(val) {
//        alert(val);
        if (val == "milestoneyes" || val == 'yes') {
            $('#hidenamevalsmiles').hide();
            //document.getElementById('hidenamevalsmiles').style.display = 'block';
        }
        else {
            $('#hidenamevalsmiles').show();
            //document.getElementById('hidenamevalsmiles').style.display = 'none';
        }
    }
    function showval3(val) {
        if (val == "") {
            $('#hidename13').show();
        }
        else {
            $('#hidename13').hide();
        }
    }

    function showval4(val) {
        //        alert('cal');
        if (val == "Yes") {
            $('#hidename14').show();
        }
        else {
            $('#hidename14').hide();
        }
    }

    function showval5(val) {
        //alert(val);
        if (val == "Yes") {
            $('#hidename15').show();
        }
        else {
            $('#hidename15').hide();
        }

    }

    function showval6(val) {
        if (val == "Yes") {
            $('#hidename16').show();
        }
        else {
            $('#hidename16').hide();
        }
    }
    function showval7(val) {
        if (val == "Yes") {
            $('#hidename17').hide();
        }
        else {
            $('#hidename17').show();
        }
    }

    function showval8(val) {
        if (val == "Yes") {
            $('#hidename18').show();
        }
        else {
            $('#hidename18').hide();
        }
    }
    function showval9(val) {
        if (val == "Yes") {
            $('#hidename19').show();
        }
        else {
            $('#hidename19').hide();
        }
    }

    function showval(val) {
        if (val == "missschoolyes") {
            $('#hidename11').show();
        }
        else {
            $('#hidename11').hide();
        }
    }

    function showval2(val) {
        if (val == "edasthmayes") {
            $('#hidename12').show();
        }
        else {
            $('#hidename12').hide();
        }
    }
    function showva20(val) {
        if (val == "Yes") {
            $('#hidename20').show();
        }
        else {
            $('#hidename20').hide();
        }
    }

    function showva21(val) {
        if (val == "Assistance Needed") {
            $('#hidename21').show();
        }
        else {
            $('#hidename21').hide();
        }
    }

    function showva22(val) {
        if (val == "Yes") {
            $('#hidename22').show();
        }
        else {
            $('#hidename22').hide();
        }
    }

    function showva23(val) {
        if (val == "Yes") {
            $('#hidename23').show();
        }
        else {
            $('#hidename23').hide();
        }
    }


    function showva24(val) {
        if (val == "Yes" || val == "yes") {
            $('#hidename24').show();
            $('#divval20').show();
        }
        else {
            $('#hidename24').hide();
            $('#divval20').hide();
        }
    }

    function showvalue300(val) {
//        alert(val);
        if (val == "yes" || val == "peakyes") {
            $('#hidename300').show();
        }
        else {
            $('#hidename300').hide();
        }
    }
    function showvalue301(val) {
        //        alert(val);
        if (val == "yes") {
            $('#hidename301').show();
        }
        else {
            $('#hidename301').hide();
        }
    }
    function showvalue302(val) {
        //        alert(val);
        if (val == "yes") {
            $('#hidename302').show();
        }
        else {
            $('#hidename302').hide();
        }
    }
    function showvalue303(val) {
        //        alert(val);
        if (val == "yes") {
            $('#hidename303').show();
        }
        else {
            $('#hidename303').hide();
        }
    }
    function showvalue304(val) {
        if ($('#orth:checkbox:checked').length == 1) {
            $('#hidename304').show();
        }
        else {
            $('#hidename304').hide();

        }
    }
    function showvalue305(val) {
        if (val == "yes") {
            $('#hidename305').show();
        }
        else {
            $('#hidename305').hide();
        }
    }
    function showvalue306(val) {
//        alert('cal');
        if (val == "Special Diet") {
            $('#hidename306').show();
        }
        else {
            $('#hidename306').hide();
        }
    }
    function showvalue307(val) {
        if ($('#tube_feedings_bolus:checkbox:checked').length == 1 || $('#tube_feedings_pump:checkbox:checked').length == 1) {
            $('#hidename307').show();
        }
        else {
            $('#hidename307').hide();
        }
    }
    function showvalue308(val) {

        if ($('#diet_special:checkbox:checked').length == 1) {
            $('#hidename308').show();
        }
        else {
            $('#hidename308').hide();
        }
    }
    function showvalue309(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename309').show();
        }
        else {
            $('#hidename309').hide();
        }
    }
    function showvalue310(val) {
        if (val == "yes") {
            $('#hidename310').show();
        }
        else {
            $('#hidename310').hide();
        }

    }
    function showvalue311(val) {
        if (val == "yes") {
            $('#hidename311').show();
        }
        else {
            $('#hidename311').hide();
        }
    }
    function showvalue312(val) {
        if (val == "yes") {
            $('#hidename312').show();
        }
        else {
            $('#hidename312').hide();
        }
    }
    function showvalue313(val) {
        if (val == "yes") {
            $('#hidename313').show();
        }
        else {
            $('#hidename313').hide();
        }
    }
    function showvalue314(val) {
        if (val == "yes") {
            $('#hidename314').show();
        }
        else {
            $('#hidename314').hide();
        }
    }
    function showvalue315(val) {
        if (val == "yes") {
            $('#hidename315').show();
        }
        else {
            $('#hidename315').hide();
        }
    }


    function showvalue316(val, increment) {
        if (val == "yes" && increment == 0) {
            $('#hidename316_' + increment).show();
        } else if (val == "" && increment == 0) {
            $('#hidename316_' + increment).hide();
        }
        //Date1  inc=1
        if (val == "yes" && increment == 1) {
            $('#hidename316_' + increment).show();
        } else if (val == "" && increment == 1) {
            $('#hidename316_' + increment).hide();
        }
        //Date1  inc=2
        if (val == "yes" && increment == 2) {
            $('#hidename316_' + increment).show();
        } else if (val == "" && increment == 2) {
            $('#hidename316_' + increment).hide();
        }
        //Date1  inc=3
        if (val == "yes" && increment == 3) {
            $('#hidename316_' + increment).show();
        } else if (val == "" && increment == 3) {
            $('#hidename316_' + increment).hide();
        }
        //Date1  inc=4
        if (val == "yes" && increment == 4) {
            $('#hidename316_' + increment).show();
        } else if (val == "" && increment == 4) {
            $('#hidename316_' + increment).hide();
        }
        //Date1  inc=5
        if (val == "yes" && increment == 5) {
            $('#hidename316_' + increment).show();
        } else if (val == "" && increment == 5) {
            $('#hidename316_' + increment).hide();
        }
    }

    function showvalue317(val) {
        //         alert(val);
        if (val == "yes") {
            $('#hidename317').show();
        }
        else {
            $('#hidename317').hide();
        }
    }
    function showvalue318(val) {
        //         alert(val);
        if (val == "yes") {
            $('#hidename318').show();
        }
        else {
            $('#hidename318').hide();
        }
    }
    function showvalue319(val) {
        if (val == "yes") {
            $('#hidename319').show();
        }
        else {
            $('#hidename319').hide();
        }
    }
    function showvalue320(val) {
        //        alert(val);
        if (val == "yes") {
            $('#hidename320').show();
        }
        else {
            $('#hidename320').hide();
        }
    }
    function showvalue321(val) {
        if (val == "shuntyes") {
            $('#hidename321').show();
        }
        else {
            $('#hidename321').hide();
        }
    }
    function showvalue322(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename322').show();
        }
        else {
            $('#hidename322').hide();
        }
    }
    function showvalue323(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename323').show();
        }
        else {
            $('#hidename323').hide();
        }
    }
    function showvalue324(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename324').show();
        }
        else {
            $('#hidename324').hide();
        }
    }
    function showvalue325(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename325').show();
        }
        else {
            $('#hidename325').hide();
        }
    }
    function showvalue326(val) {

        if (val == "yes" || val == "Yes") {
            $('#hidename326').show();
        }
        else {
            $('#hidename326').hide();
        }
    }
    function showvalue327(val) {
        if (val != "None") {
            $('#hidename327').show();
        }
        else {
            $('#hidename327').hide();
        }
    }
    function showvalue328(val) {
//        alert(val);
        if (val == "yes" || val == "pulmvestyes") {
            $('#hidename328').show();
        }
        else {
            $('#hidename328').hide();
        }
    }
    function showvalue329(val) {
//        alert(val);
        if (val == "yes" || val == "pulmvestyes") {
            $('#hidename329').show();
        }
        else {
            $('#hidename329').hide();
        }
    }
    function showvalue330(val) {
//        alert(val);
        if (val == "yes" || val == "Yes") {
            $('#hidename330').show();
        }
        else {
            $('#hidename330').hide();
        }
    }
    function showvalue331(val) {
//        alert(val);
        if (val == "yes" || val == "Yes") {
            $('#hidename331').show();
        }
        else {
            $('#hidename331').hide();
        }
    }
    function showvalue332(val) {
//        alert(val);
        if (val == "yes" || val == "Yes") {
            $('#hidename332').show();
        }
        else {
            $('#hidename332').hide();
        }
    }
    function showvalue333(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename333').show();
        }
        else {
            $('#hidename333').hide();
        }
    }
    function showvalue334(val, val2) {
//        alert(val);
        val2 = ($('#hide334:checkbox:checked').length);
        if (val == "" || val2 == "") {
            $('#hidename334').show();
        }
        else {
            $('#hidename334').hide();
        }
    }
    function showvalue335(val, val2) {
        val2 = ($('#hide335:checkbox:checked').length);
        if (val == "" || val2 == "") {
            $('#hidename335').show();
        }
        else {
            $('#hidename335').hide();
        }
    }
    function showvalue336(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename336').show();
        }
        else {
            $('#hidename336').hide();
        }
    }
    function showvalue337(val) {
        if (val == "chestptyes") {
            $('#hidename337').show();
        }
        else {
            $('#hidename337').hide();
        }
    }
    function showvalue338(val) {
        if (val == "Yes" || val == "yes") {
            $('#hidename338').show();
        }
        else {
            $('#hidename338').hide();
        }
    }
    function showvalue339(val) {
        if (val == "Yes" || val == "yes") {
            $('#hidename339').show();
        }
        else {
            $('#hidename339').hide();
        }
    }
    function showvalue340(val) {
        if (val == "Yes" || val == "yes") {
            $('#hidename340').show();
        }
        else {
            $('#hidename340').hide();
        }
    }
    function showvalue341(val) {
        if (val == "Yes" || val == "yes") {
            $('#hidename341').show();
        }
        else {
            $('#hidename341').hide();
        }
    }
    function showvalue342(val) {
        if (val == "Other") {
            $('#hidename342').show();
        }
        else {
            $('#hidename342').hide();
        }
    }
    function showvalue343(val) {
        if (val == "Other") {
            $('#hidename343').show();
        }
        else {
            $('#hidename343').hide();
        }
    }
    function showvalue344(val2) {
        val2 = ($('#triggers_other:checkbox:checked').length);
        if (val2 == "1") {
            $('#hidename344').show();
        }
        else {
            $('#hidename344').hide();
        }
    }
    function showvalue345(val2) {
        val2 = ($('#usual_symptoms_other:checkbox:checked').length);
        if (val2 == "1") {
            $('#hidename345').show();
        }
        else {
            $('#hidename345').hide();
        }
    }
    function showvalue346(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename346').show();
        }
        else {
            $('#hidename346').hide();
        }
    }
    function showvalue347(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename347').show();
        }
        else {
            $('#hidename347').hide();
        }
    }
    function showvalue348(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename348').show();
        }
        else {
            $('#hidename348').hide();
        }
    }
    function showvalue349(val) {
        if (val == "yes" || val == "Yes") {
            $('#hidename349').show();
        }
        else {
            $('#hidename349').hide();
        }
    }
    function showvalue350(val) {
        if (val == "yes") {
            $('#hidename350').show();
        }
        else {
            $('#hidename350').hide();
        }
    }
    function showvalue353(val) {
        if (val == "yes") {
            $('#hidename353').show();
        }
        else {
            $('#hidename353').hide();
        }
    }
    function showvalue354(val) {
        if (val == "yes") {
            $('#hidename354').show();
        }
        else {
            $('#hidename354').hide();
        }
    }
    function showvalue355(val) {
        if (val == "yes") {
            $('#hidename355').show();
        }
        else {
            $('#hidename355').hide();
        }
    }
    function showvalue356(val) {
        if (val == "yes") {
            $('#hidename356').show();
        }
        else {
            $('#hidename356').hide();
        }
    }
    function showvalue357(val) {
        if (val == "Other") {
            $('#hidename357').show();
        }
        else {
            $('#hidename357').hide();
        }
    }
    function showvalue358(val) {
        if (val == "assisttechyes") {
            $('#hidename358').show();
        }
        else {
            $('#hidename358').hide();
        }
    }
    function showvalue359(val) {
        if (val == "accomodationsyes") {
            $('#hidename359').show();
        }
        else {
            $('#hidename359').hide();
        }
    }
    function showvalue360(val) {
        if (val == "postseizureaurayes") {
            $('#hidename360').show();
        }
        else {
            $('#hidename360').hide();
        }
    }


    function readyFunction() {
        //alert('cal');
//        showvalue3();
        $('input[name=dnrorder]').trigger('change');
        showva25($("#milestone:checked").val());

        showva75($("#complications:checked").val());
        showva76($("#emergencies:checked").val());
        showvalue26($("input[name='milestones']:checked").val());
        showval3($("input[name='vent_depend']:checked").val());
        showval4($("input[name='pt']:checked").val());
        showval5($("input[name='pos_plan']:checked").val());
        showval6($("input[name='restrictions']:checked").val());
        showval7($("input[name='asthma']:checked").val());
        showval8($("input[name='ed_last_year']:checked").val());
        showval9($("input[name='pe']:checked").val());
        showval($("input[name='missschool']:checked").val());
        showval2($("input[name='edasthma']:checked").val());
        showva20($("input[name='feeding_assist']:checked").val());
        showva21($("input[name='test_ind']:checked").val());
        showva22($("input[name='discrete']:checked").val());
        showva23($("input[name='bus_meds']:checked").val());
        showva24($("input[name='bus_mod']:checked").val());
        showvalue50($("input[name='bus_snacks']:checked").val());
        //alert($('#release1').val());
        showvalue51($("input[name='release1']:checked").val());

        //alert('here');


        showvalue321($("input[name='shunt']:checked").val());
        showvalue300($("input[name='peak']:checked").val());
        showvalue301($("input[name='oximetry']:checked").val());
        showvalue302($("input[name='co2']:checked").val());
        showvalue303($("input[name='scoliosis']:checked").val());
        showvalue304($('#orth:checkbox:checked').length);
        showvalue305($("input[name='orth']:checked").val());
        showvalue306($("input[name='diet']:checked").val());
        showvalue307($("input[name='tube_feedings_bolus']:checked").val());
        showvalue307($("input[name='tube_feedings_pump']:checked").val());
        showvalue308($("input[name='diet_special']:checked").val());
        showvalue309($("input[name='insulin_key']:checked").val());
        showvalue310($("input[name='planname1']:checked").val());
        showvalue311($("input[name='planname2']:checked").val());
        showvalue312($("input[name='planname3']:checked").val());
        showvalue313($("input[name='planname4']:checked").val());
        showvalue314($("input[name='planname5']:checked").val());
        showvalue315($("input[name='planname6']:checked").val());
        for (var i = 0; i <= 5; i++) {
            showvalue316($("input[name='sheepItForm1_" + i + "_seizure_planname7']:checked").val(), i);
        }
        showvalue317($("input[name='crisis_ex']:checked").val());
        showvalue318($("input[name='routine']:checked").val());
        showvalue319($("input[name='or_surg']:checked").val());
        showvalue320($("input[name='od_needschool']:checked").val());

        showvalue322($("input[name='constipation']:checked").val());
        showvalue323($("input[name='colostomy']:checked").val());
        showvalue324($("input[name='bladder']:checked").val());
        showvalue325($("input[name='menstruation']:checked").val());
        showvalue326($("input[name='catheter']:checked").val());
        showvalue327($("input[name='med_delivery']:checked").val());
        showvalue328($("input[name='pulm_vest']:checked").val());
        showvalue331($("input[name='o_supp']:checked").val());
        showvalue332($("input[name='o_cdue']:checked").val());

        showvalue334($('#hide334:checkbox:checked').length);
        showvalue335($('#hide335:checkbox:checked').length);
        showvalue329($("input[name='pulmvest']:checked").val());
        showvalue336($("input[name='chest_pt']:checked").val());
        showvalue337($("input[name='chestpt']:checked").val());
        showvalue338($("input[name='suction']:checked").val());
        showvalue339($("input[name='feeding_tubeval']:checked").val());
        showvalue340($("input[name='feeding_assist']:checked").val());
        showvalue341($("input[name='reflux']:checked").val());
        showvalue342($("input[name='toilet']:checked").val());
        showvalue343($("input[name='toileted']:checked").val());
        showvalue344($('#triggers_other:checkbox:checked').length);
        showvalue345($('#usual_symptoms_other:checkbox:checked').length);
        showvalue330($("input[name='hip']:checked").val());
        showvalue346($("input[name='before_lunch']:checked").val());
        showvalue347($("input[name='counts_carbs']:checked").val());
        showvalue348($("input[name='school_breakfast']:checked").val());
        showvalue349($("input[name='school_glucagon']:checked").val());
        showvalue350($("input[name='dnrorder']:checked").val());
        showvalue353($("input[name='clinic']:checked").val());
        showvalue354($("input[name='smart_team']:checked").val());
        showvalue355($("input[name='assist_tech']:checked").val());
        showvalue356($("input[name='accomodations']:checked").val());
        showvalue357($("#grade").val());
        showvalue358($("input[name='assisttech']:checked").val());
        showvalue359($("input[name='accomodations']:checked").val());
        showvalue360($("input[name='aura']:checked").val());
        for (var i = 0; i <= 5; i++) {
            showvalue52($('input:radio[name="sheepItForm1_release' + i + '"]:checked').val(), i);
        }

        showvalue333($("input[name='o_res']:checked").val());
        showvalue19($("input[name='bus_meds']:checked").val());
        showvalue3($("input[name='devices']:checked").val());

        showvalue20($("input[name='bus_mod']:checked").val());




    }

</script>
<footer class="footer">
    <p>&copy; 2014 Anne Arundel County Health Department</p>
    <p>Unauthorized or improper use of this system is prohibited.</p>
</footer>
</div>
</body>
</html>

