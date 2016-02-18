<?php
# Set form attributes
$attr_FormOpen = array('role' => 'form', 'id' => 'forgot-password');
$attr_Email = array(
    'name' => 'email_address',
    'id' => 'username',
    'placeholder' => 'Enter email',
    'onfocus' => 'clearUn()',
    'onBlur' => 'createLabelU()',
    'required' => 'required'
);

$attr_FormSubmit = array(
    'id' => 'forgot-password',
    'value' => 'Forgot Password',
    'type' => 'submit'
);
?>
<!-- Request password change -->

<section class="login-box">
<?= form_open("" . $action . "", $attr_FormOpen); ?>
    <label for="username">Enter Email</label>
    <?= form_input($attr_Email); ?>
   
    <?= form_submit($attr_FormSubmit); ?>
    <?= form_close(); ?>
    <p>
    <?= anchor(base_url("auth/login"), 'Back to Login'); ?>
        <?= br(); ?>
        <?php if (isset($_GET ["PasswordChange"])) : ?>
            <?= "Your password has been changed"; ?>
        <?php endif; ?>
        <?= validation_errors(); ?>
        <?= br(); ?>
        <b><P class="help-block"> <?= $success; ?> </P></b>
         <span class="help-block">  <?= $error; ?> </span>
</section>
    <style>
        .help-block{
            margin-left: 22%;
        }
    </style>