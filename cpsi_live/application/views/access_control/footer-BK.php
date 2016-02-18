<!-- Core Scripts - Include with every page -->
<script src="<?= base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script src="<?= base_url("assets/js/jquery-ui.js"); ?>"></script>
<script src="<?= base_url("assets/js/jquery-ui-1.10.4.custom.js"); ?>"></script>
<script src="<?= base_url("assets/js/functions.js"); ?>"></script>


<!-- Form validator -->
<script src="<?= base_url("assets/js/jquery.validate.js"); ?>"></script>
<script src="<?= base_url("assets/js/additional-methods.js"); ?>"></script>

<!-- Table sorter 2.0 -->
<script src="<?= base_url("assets/js/jquery.tablesorter.js"); ?>"></script>

<!-- Multiseelct jquery --->

<!--<script  src="<? #= base_url("assets/js/jquery.min.js");     ?>"></script>-->
<!--<script  src="<? #= base_url("assets/js/jquery-ui.min.js");     ?>"></script>-->
<script  src="<?= base_url("assets/js/jquery.autocomplete.multiselect.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/ui-auto-multiselect.css"); ?>"/>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/jquery-ui.css"); ?>"/>



<!-- Jquery single autocomplete --->

<!--Pagination-->
<!--<script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>-->
<script  src="<?= base_url("assets/js/jquery.dataTables.min.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/jquery.dataTables.min.css"); ?>"/>
<!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">-->

<!---- If back button is pressed---->

<script>

    $(document).ready(function() {
        $('#results').DataTable();
    });
</script>
<!--pagination end-->
<script>
    $(document).ready(function() {
//        if (window.location.href.indexOf('reload') == -1) {
//            window.location.replace(window.location.href + '/reload');
//        }
        if ($('#userrole_id').val() == 5) {
            $('#role').val('Nurse');
            $("#role").attr('readonly', 'readonly');
            var roleInputName;
            var managedByInput;
            var cid;
            var uem;
            if (!roleInputName)
            {
                roleInputName = 'Nurse';
            }

            if (!managedByInput)
            {
                managedByInput = 'managed_by';
            }

            var rid = roleInputName;
            cid = $("input[name=" + cid + "]").val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url("access_control/admin/roles_select_ui/?rid="); ?>' + rid, //We are going to make the request to the method "list_dropdown" in the match controller
                data: 'role=' + rid + '&uem=' + uem + '&cid=' + cid, //POST parameter to be sent with the role id
                success: function(resp) { //When the request is successfully completed, this function will be executed
                    //Activate and fill in the matches list
                    $('#' + managedByInput).attr({'multiple': 'multiple', 'class': 'form-control'}).html(resp); //With the ".html()" method we include the html code returned by AJAX into the matches list
                    var fname = $('#userrole_fname').val();
                    var lname = $('#userrole_lname').val();
                    var name = fname + ' ' + lname;
                    $('#nurse_supervisor').val(name);
                    $("#nurse_supervisor").attr('readonly', 'readonly');
                }
            });


        }

        //Single autocomplete
        var selectType = $('#roles').val();
        $("#role").autocomplete({
            source: "create_user/" + selectType,
            minLength: 2,
            select: function(event, ui) {
                change_managed_by(ui.item.value);
                $("#role").val(ui.item.value);
                return false;
            }

        });

        // call the tablesorter plugin
        $("#results").tablesorter({
            // sort on the first column and third column, order asc
            sortList: [[0, 0], [2, 0]]
        });


        if ($("section#nurseModify").length > 0)
        {
            change_managed_by('roles', '', 1, 'cid');
        }
        // $('#role').autocomplete("search");
    });
</script>

<script>
//js code after document is ready
//Search autocomplete

    $("#student").autocomplete({
        minLength: 1,
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
    });

    $("#main-search").autocomplete({
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
    });
</script>

<script>
    $(function() {
        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }

        $("#managed-by")
                // don't navigate away from the field on tab when selecting an item
                .bind("keydown", function(event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    source: function(request, response) {
                        $.getJSON("<?= base_url("access_control/admin/user_byjson") ?>", {
                            term: extractLast(request.term)
                        }, response);
                    },
                    search: function() {
                        // custom minLength
                        var term = extractLast(this.value);
                        if (term.length < 2) {
                            return false;
                        }
                    },
                    focus: function() {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function(event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    }
                });
        //Multi Nurse Supervisor
        $("form").submit(function(e) {
            // e.preventDefault();
            $("#multi_nurse_supervisors").parents("div.ui-autocomplete-multiselect.ui-state-default.ui-widget.ui-state-active").find("div.ui-autocomplete-multiselect-item").each(function() {
                var value = $(this).text();
                //alert(value);
                $("form").append("<input name='multi_nurse_supervisors[]' value='" + value + "'>");
            });
            $("#multi_nurses").parents("div.ui-autocomplete-multiselect.ui-state-default.ui-widget.ui-state-active").find("div.ui-autocomplete-multiselect-item").each(function() {
                var value = $(this).text();
                //alert(value);
                $("form").append("<input name='multi_nurses[]' value='" + value + "'>");
            });
//            setTimeout(function(){
//                return true
//            },1000);
        });
    });

</script>
<!-- jQuery add user validation -->
<script>
    // password change validation
    $('#add-user').validate({
        rules: {
            first_name: {
                minlength: 2,
                maxlength: 50,
                required: true
            },
            last_name: {
                minlength: 2,
                maxlength: 50,
                required: true
            },
            username: {
                minlength: 4,
                maxlength: 16,
                required: true
            },
            email_address: {
                required: true,
                email: true
            },
            password: {
                minlength: 6,
                maxlength: 16,
                required: true
            },
            password2: {
                equalTo: '#password'
            }
        },
        // Specify the validation error messages
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "Your first name must be at least {0} characters long",
                maxlength: "Your first name cannot be more than {0} characters long"
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "Your last name must be at least {0} characters long",
                maxlength: "Your last name cannot be more than {0} characters long"
            },
            username: {
                required: "Please provide a username",
                minlength: "Your username must be at least {0} characters long",
                maxlength: "Your username cannot be more than {0} characters long"
            },
            email_address: "Please enter a valid email address"
        },
        password: {
            required: "Please provide a new password",
            minlength: "Your password must be at least {0} characters long"
        },
        password2: {
            equalTo: "Please enter the same passwords"
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

</script>
<script type="text/javascript">

    function change_managed_by(roleInputName, managedByInput, uem, cid)
    {
//        alert('cal');
        // alert(managedByInput);
        if (!roleInputName == "")
        {
            roleInputName = 'role';
        }


        if (!managedByInput)
        {
            managedByInput = 'managed_by';
        }
        var rid = $('#' + roleInputName + ' option:selected').text();
        cid = $("input[name=" + cid + "]").val();

        //alert($("#role option:selected").text());
        $.ajax({
            type: 'POST',
            url: '<?= base_url("access_control/admin/roles_select_ui/?rid="); ?>' + rid, //We are going to make the request to the method "list_dropdown" in the match controller
            data: 'role=' + rid + '&uem=' + uem + '&cid=' + cid, //POST parameter to be sent with the role id
            success: function(resp) { //When the request is successfully completed, this function will be executed
                //Activate and fill in the matches list

                $('#' + managedByInput).attr({'multiple': 'multiple', 'class': 'form-control'}).html(resp); //With the ".html()" method we include the html code returned by AJAX into the matches list
                //Multiple Autocomplete
                if (rid == "Program Manager") {

                    var np = $('#multi_nurse_supervisors').val();
                    $("#multi_nurse_supervisors").autocomplete({
                        source: "nslist/" + np + "?prof=4",
                        minLength: 2,
                        multiselect: true
                    });
                }
                if (rid == "Nurse") {
                    //$('#nurse_supervisor').val('aaaa');

                    var np = $('#nurse_supervisor').val();
                    $("#nurse_supervisor").autocomplete({
                        source: "nslist/" + np + "?prof=6",
                        minLength: 2,
                        select: function(event, ui) {

                            $("#nurse_supervisor").val(ui.item.value);
                            return false;
                        }

                    });
                }
                if (rid == "Nurse Supervisor") {

                    //Nurse Supervisor
                    // var np = $('#program_manager').val('<?php #echo $this->session->userdata('first_name').$this->session->userdata('last_name')                                                              ?>');
                    var np = $('#program_manager').val();
                    $("#program_manager").autocomplete({
                        source: "nslist" + np + "?prof=5",
                        minLength: 2
                    });
                    //Nurse
                    var np = $('#multi_nurses').val();
                    $("#multi_nurses").autocomplete({
//                        alert('f');
                        source: "nslist/" + np + "?prof=6",
                        minLength: 2,
                        multiselect: true
                    });
                }
            }
        });
    }


    function change_nursesupervisor(source, target)
    {

        $.ajax({
            type: 'POST',
            url: '<?= base_url("access_control/admin/resolveMgr"); ?>', //We are going to make the request to the method "list_dropdown" in the match controller
            data: 'uid=' + uid, //POST parameter to be sent with the role id
            success: function(resp) { //When the request is successfully completed, this function will be executed
                //Activate and fill in the matches list

                $("#" + target).html(resp); //With the ".html()" method we include the html code returned by AJAX into the matches list
            }
        });

    }

    $(function() {

        var seleted_nurse = $("#seleted_nurse").val();
        //If nurse is empty hide the change nurse supervisor
        if (seleted_nurse == "") {
            $("#change_ns").hide();
            $("#seleted_nurses").hide();
        }
        var np = $('#edit_nurse_supervisor').val();
        var nsid = '<?php echo $this->uri->segment(4); ?>';
        //var keywords = <?php echo $this->uri->segment(5); ?>;
        var baseurl = '<?php echo base_url(); ?>';

        $("#edit_nurse_supervisor").autocomplete({
            source: baseurl + "access_control/admin/nslist_edit/" + nsid + "/" + np,
            minLength: 1
        });
    });

//Auto complete for program manager
//added on 28/01/2016
    $(function() {

        var seleted_nurse_supervisor = $("#seleted_nurse_supervisor").val();
        //If nurse is empty hide the change nurse supervisor
        if (seleted_nurse_supervisor == "") {
            $("#change_pm").hide();
            $("#seleted_nursesupervisor").hide();
        }
        var np = $('#edit_program_manager').val();
        var nsid = '<?php echo $this->uri->segment(4); ?>';
        //var keywords = <?php echo $this->uri->segment(5); ?>;
        var baseurl = '<?php echo base_url(); ?>';

        $("#edit_program_manager").autocomplete({
            source: baseurl + "access_control/admin/pmlist_edit/" + nsid + "/" + np,
            minLength: 1
        });
    });
</script>
<!-- jQuery edit user validation -->
<script>
    // password change validation
    $('#edit-user').validate({
        rules: {
            first_name: {
                minlength: 2,
                maxlength: 50,
                required: true
            },
            last_name: {
                minlength: 2,
                maxlength: 50,
                required: true
            },
            username: {
                minlength: 4,
                maxlength: 16,
                required: true
            },
            email_address: {
                required: true,
                email: true
            }

        },
        // Specify the validation error messages
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "Your first name must be at least {0} characters long",
                maxlength: "Your first name cannot be more than {0} characters long"
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "Your last name must be at least {0} characters long",
                maxlength: "Your last name cannot be more than {0} characters long"
            },
            username: {
                required: "Please provide a username",
                minlength: "Your username must be at least {0} characters long",
                maxlength: "Your username cannot be more than {0} characters long"
            },
            email_address: "Please enter a valid email address"
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

</script>
<!-- Page-Level Scripts - Notifications - Use for reference -->
<script>
// tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
</script>
<script>
    $(function() {
        // Javascript to enable link to tab
        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href=#' + url.split('#')[1] + ']').tab('show');
        }

        // Change hash for page-reload
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            window.location.hash = e.target.hash;
        });
    });
</script>
<script>
    function like(placeholder) {
        $.ajax({
            url: $(placeholder).attr('rel'),
            type: "GET",
            success: function() {
                alert("done");
            },
            error: function() {
                alert("testing error");
            }
        });
        return false;
    }
</script>
<!-- jQuery password change validation -->
<script>
    // password change validation
    $('#password-change').validate({
        rules: {
            current_password: {
                minlength: 6,
                maxlength: 16,
                required: true
            },
            password: {
                minlength: 6,
                maxlength: 16,
                required: true
            },
            password2: {
                equalTo: '#password'
            }
        },
        // Specify the validation error messages
        messages: {
            current_password: {
                required: "Please your current password",
                minlength: "Your password must be at least {0} characters long"
            },
            password: {
                required: "Please provide a new password",
                minlength: "Your password must be at least {0} characters long"
            },
            password2: {
                equalTo: "Please enter the same passwords"
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

</script>
<script type="text/javascript">
    // Perm control
    function change_perms() {
        //alert($("#roles option:selected").val());
        var rid = $("#roles option:selected").val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url("access_control/admin/roles_select_ui/?rid="); ?>' + rid, //We are going to make the request to the method "list_dropdown" in the match controller
            data: 'role=' + rid, //POST parameter to be sent with the role id
            success: function(resp) { //When the request is successfully completed, this function will be executed
                //Activate and fill in the matches list
                $('#perms').attr({'disabled': true, 'multiple': 'multiple', 'class': 'form-control'}).html(resp); //With the ".html()" method we include the html code returned by AJAX into the matches list
            }
        });
    }
</script>


</body>

</html>