<?php
# Set form attributes
$attr_FormOpen = array('role' => 'form', 'id' => 'signup-form');
$firstname = array('name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'First Name');
$lastname = array('name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'Last Name');
$email = array('name' => 'email_address', 'id' => 'email_address', 'placeholder' => 'Email Address');
$user = array('name' => 'username', 'id' => 'username', 'placeholder' => 'Email Address');
$pass = array('name' => 'password', 'id' => 'password', 'placeholder' => 'Password');
$pass2 = array('name' => 'password2', 'id' => 'password2', 'placeholder' => 'Confirm password');
$attr_FormSubmit = array('class' => 'btn btn-primary', 'value' => 'Create Admin', 'type' => 'submit');
?>
<!--<script type="text/javascript">
(function() {
  var cx = '017643444788069204610:4gvhea_mvga'; // Insert your own Custom Search engine ID here
  var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
  gcse.src = (document.location.protocol == 'https' ? 'https:' : 'http:') +
      '//www.google.com/cse/cse.js?cx=' + cx;
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
})();
</script>-->
<?php // load top menu ?>
<?php $this->load->view("menu/top_menu"); ?>
<section class="page">
        <!--<gcse:search enableAutoComplete="true"></gcse:search>-->
    <h1><?= $subtitle ?></h1>
    <?= br(); ?>
    <div><?= $pagination; ?></div>
    <?= br(); ?>
    <span style="color: red"><?php echo $this->session->flashdata('message'); ?></span>
    <?= br(); ?>
    <?= br(); ?>
    <?= br(); ?>
    <?= $table; ?>

</section>
