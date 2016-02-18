<?php
// Set form attributes
$attr_FormOpen = array(
    'role' => 'form',
    'id' => 'password-change'
);
$currpass = array(
    'class' => 'form-control',
    'name' => 'current_password',
    'id' => 'current_password',
    'placeholder' => 'Current Password'
);
$pass = array(
    'class' => 'form-control',
    'name' => 'password',
    'id' => 'password',
    'placeholder' => 'New Password'
);
$pass2 = array(
    'class' => 'form-control',
    'name' => 'password2',
    'id' => 'password2',
    'placeholder' => 'Confirm Password'
);
$hiddenuid = array(
    'class' => 'form-control',
    'name' => 'username',
    'type' => 'hidden'
);
$attr_FormSubmit = array(
    'class' => 'btn btn-lg btn-primary btn-block',
    'value' => 'Change Password',
    'type' => 'submit'
);
?>
<section class="login-box">
    <?= br(); ?>
    <?= form_open("{$action}", $attr_FormOpen); ?>
    <div>
        <?= form_password($currpass); ?>
    </div>
    <div>
        <?= form_password($pass); ?>
    </div>
    <div>
        <?= form_password($pass2); ?>
        <?= form_input($hiddenuid, set_value("username", $user)); ?>
    </div>
    <?= br(); ?>
    <?= form_submit($attr_FormSubmit); ?>
    <?= form_close(); ?>
    <?= br(); ?>
    <?= anchor(base_url("auth/login"), 'Back to Login'); ?>
    <?= br(); ?>
    <?= $error; ?>
    <?= form_error("current_password"); ?>
    <?= form_error("password"); ?>
    <?= form_error("password2"); ?>
</section>

