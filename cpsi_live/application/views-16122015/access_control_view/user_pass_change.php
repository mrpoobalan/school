<?php
# Set form attributes for password change
$attr_FormOpen_passwd = array('role' => 'form', 'id' => 'password-change');
$uniqueid = array('name' => 'user_id', 'id' => 'disabledInput', 'disabled' => 'disabled', 'placeholder' => 'UserID Disabled');
$hiddenid = array('name' => 'user_id', 'type' => 'hidden');
$currpass = array('name' => 'current_password', 'id' => 'current_password', 'placeholder' => 'Current Password');
$pass = array('name' => 'password', 'id' => 'password', 'placeholder' => 'New Password', 'required' => 'required', 'type' => 'password');
$pass2 = array('name' => 'password2', 'id' => 'password2', 'placeholder' => 'Confirm Password', 'required' => 'required', 'type' => 'password');
$hiddenuid = array('name' => 'username', 'type' => 'hidden');
$attr_FormSubmit_passwd = array('class' => 'btn btn-primary', 'value' => 'Change Password', 'type' => 'submit', 'onSubmit'=>'window.location.reload()');
?>

<?php $this->load->view("menu/top_menu"); ?>
<section class="page">
    <h1>Change Password</h1>
    <?= br(); ?>
    <div class="change-password">
        <?php
        if (isset($_GET["PasswordChangeError"]))
        {
            ?>
            <div>
                Password change failed
            </div>
            <?php
        }
        elseif (isset($_GET["PasswordChangeSuccess"]))
        {
            ?>
            <div>
                Password changed
            </div>			                                
        <?php } ?>

        <?= form_open("{$action_passwd_chg}", $attr_FormOpen_passwd); ?>
        <?= form_input($hiddenid, set_value("user_id", $this->form_data->user_id)); ?> 
        <?php
        $change_password_message = $this->session->userdata('change_password_success_msg');
//        exit($change_password_message);
        if ($change_password_message <> ""):
            ?>
            <div class="isa_success">
                <i class="fa fa-check"></i><a href="#" class="close" data-dismiss="alert"></a>
                <strong>Success!</strong> <?php echo $change_password_message; ?>
            </div>
        <?php endif; ?>
        <div>
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <?= form_password($pass); ?>
        </div>
        <div>
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <?= form_password($pass2); ?>
        </div>
        <!-- Change this to a button or input when using this as a form -->
        <?= form_submit($attr_FormSubmit_passwd); ?>
        <?= form_close(); ?>
        <?= $passwd_error; ?>
        <?= form_error("password"); ?> 
        <?= form_error("password2"); ?>
        <?= br(); ?>
    </div>
</section>

<style>
    /*@import url('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');*/

    .isa_info, .isa_success, .isa_warning, .isa_error {
        margin: 10px 0px;
        padding:12px;
    }
    .isa_info {
        color: #00529B;
        background-color: #BDE5F8;
    }
    .isa_success {
        color: #4F8A10;
        background-color: #DFF2BF;
    }
    .isa_warning {
        color: #9F6000;
        background-color: #FEEFB3;
    }
    .isa_error {
        color: #D8000C;
        background-color: #FFBABA;
    }
    .isa_info i, .isa_success i, .isa_warning i, .isa_error i {
        margin:10px 22px;
        font-size:2em;
        vertical-align:middle;
    }
</style>
<!--
<script type="text/javascript">
$(document).ready(function(){    
    //Check if the current URL contains '#'
    if(document.URL.indexOf("#")==-1){
        // Set the URL to whatever it was plus "#".
        url = document.URL+"#";
        location = "#";

        //Reload the page
        location.reload(true);
    }
});
</script>-->