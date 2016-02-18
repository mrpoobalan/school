<!-- Core Scripts - Include with every page -->
<script src="<?= base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script src="<?= base_url("assets/js/functions.js"); ?>"></script>

<!-- Form validator -->
<script src="<?= base_url("assets/js/jquery.validate.js"); ?>"></script>
<script src="<?= base_url("assets/js/additional-methods.js"); ?>"></script>
<script src="<?= base_url("assets/js/bootstrapValidator.min.js"); ?>"></script>

<!-- jQuery Form Validation code -->

	<!-- jQuery forgot password validation -->
	<script>
		// password change validation  
	    $('#forgot-password').validate({
	        rules: {
	        	email_address: {
	                required: true,
	                email: true
	            }
	        },
	        
	        // Specify the validation error messages
	        messages: {
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
	            if(element.parent('.input-group').length) {
	                error.insertAfter(element.parent());
	            } else {
	                error.insertAfter(element);
	            }
	        }
	    });
	  
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
	            if(element.parent('.input-group').length) {
	                error.insertAfter(element.parent());
	            } else {
	                error.insertAfter(element);
	            }
	        }
	    });
	  
	  </script>
	<!-- jQuery forgot password validation -->
	<script>
		// password change validation  
	    $('#forgot-password').validate({
	        rules: {
	            email_address: {
	                required: true,
	                email: true
	            }
	        },
	        
	        // Specify the validation error messages
	        messages: {
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
	            if(element.parent('.input-group').length) {
	                error.insertAfter(element.parent());
	            } else {
	                error.insertAfter(element);
	            }
	        }
	    });
	  
	  </script>
	<!-- jQuery Form Validation code -->
	<script>
		// signup form validation  
	    $('#signup-form').validate({
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
	            email_address: {
	                required: true,
	                email: true
	            },
	            username: {
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
	        	username: "Please enter a valid email address",
	        	email_address: "Please enter a valid email address",
	            password: {
	                required: "Please provide a password",
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
	            if(element.parent('.input-group').length) {
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