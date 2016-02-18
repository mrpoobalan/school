
<!-- Core Scripts - Include with every page -->
<script src="<?= base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script src="<?= base_url("assets/js/functions.js"); ?>"></script>


<!-- Form validator -->
<script src="<?= base_url("assets/js/jquery.validate.js"); ?>"></script>
<script src="<?= base_url("assets/js/additional-methods.js"); ?>"></script>

<!-- jQuery Form Validation code -->
<script>
    // login form validation  
    $('#login-form').validate({
        rules: {
            username: {
                required: true,
                minlength: 4,
                maxlength: 16
            },
            password: {
                minlength: 6,
                maxlength: 16,
                required: true
            }
        },
        // Specify the validation error messages
        messages: {
            username: "Please provide a username",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least {0} characters long"
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
<!-- jQuery password change validation -->
<script>
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "Please enter new password");
    // password change validation  
    $('#password-change').validate({
        rules: {
            current_password: {
                minlength: 6,
                maxlength: 16,
                required: true
            },
            password1: {
                minlength: 8,
                maxlength: 16,
                pattern: /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/,
                required: true,
                notEqual: "#current_password"
            },
//            password2: {
//                equalTo: "#password1",
//                required: true
//            },
        },
        // Specify the validation error messages
        messages: {
            current_password: {
                required: "Please your current password",
                minlength: "Your password must be at least {0} characters long"
            },
            password1: {
                required: "Please provide a new password",
                minlength: "Your password must be at least {0} characters long",
                pattern: "password at least one lowercase letter, one uppercase letter, one number, and one special character with a minimum of 8 characters total",
                notEqualTo: "Please Entet New Password"
            },
//            password2: {
//                equalTo: "Please enter the same passwords"
//            }
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
<footer class="footer">
    <p>&copy; 2014 Anne Arundel County Health Department</p>
    <p>Unauthorized or improper use of this system is prohibited.</p>
</footer>
</div>
</body>
</html>