<style>
    .help-block{
        color:red;
        font-weight: bold;
        margin-left: 25%;
    }
    .login-box p {
        color: red;
        font-weight: 300;
        margin: 0 auto;
        width: 250px;
        font-weight: bold;

    }
</style>
<?php
// Set form attributes
$attr_FormOpen = array(
    'role' => 'form',
    'id' => 'login-form'
);
$attr_Username = array(
    'name' => 'username',
    'id' => 'username',
    'placeholder' => 'Enter Username'
);
$attr_Password = array(
    'name' => 'password',
    'id' => 'password',
    'type' => 'password',
    'placeholder' => 'Enter Password'
);
$attr_FormSubmit = array(
    'id' => 'login',
    'value' => 'Login',
    'type' => 'submit'
);
?>

<section class="login-box">

    <?= form_open("{$action}", $attr_FormOpen); ?>
    <p style="color: red;font-weight: bold;margin-top: 0px;border-top-width: 500px;padding-bottom: 17px;margin-left: 116px;
       "><?php echo ($error_msg); ?></p>
       <?= form_input($attr_Username); ?>
       <?= form_password($attr_Password); ?>
    <div class ="captcha">
        <div class ="captcha_img">
            <?php echo $captcha['image']; ?>
            <!-- <img src="<?php //echo $captcha['image_src'];       ?>" alt="CAPTCHA security code" /> -->
        </div>
        <div class="captcha_refresh">
            <img src="<?php echo base_url() . "assets/images/refresh1.jpg" ?>" id="imgrefresh">
        </div>
        <input required id="captcha" name="captcha" type="text" autocomplete="off" placeholder = 'Enter Captcha'/>
    </div>
    <?php echo form_error(); ?>
    <?php echo validation_errors(); ?>
    <?= form_submit($attr_FormSubmit); ?>

    <?= form_close(); ?>
    <p>
        <?= anchor(base_url() . "auth/request/password_reset", 'Forgot Password?'); ?>
        <?= br(); ?>
        <?php if (isset($_GET ["PasswordChange"])) : ?>
            <br> <span style="color: red;font-weight: bold; text-align: center">Your password has been changed</span>
        <?php endif; ?>



    </p>

</section>

<script src="<?= base_url("assets/js/jquery.min.js"); ?>"></script>
<script>
    $('img#imgrefresh').click(function() {
        location.reload();
    });
    $(document).load(function()
    {
        function addPlaceholder()
        {
            // Adding placeholder for input fields
            $("input[type=text]").each(function() {
                var placeholder = $(this).attr("placeholder");
                $(this).val(placeholder);
            });

            $("input[type=password]").each(function() {
                var placeholder = $(this).attr("placeholder");
                $(this).val(placeholder);
            });

            // Adding placeholder for textarea
            $("textarea").each(function() {
                var placeholder = $(this).attr("placeholder");
                $(this).val(placeholder);
            });

        }   // Closing addPlaceholder function


        addPlaceholder();
    });


</script>
