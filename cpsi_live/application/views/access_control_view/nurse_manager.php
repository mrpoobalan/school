<?php

# Set form attributes
$attr_FormOpen = array('role'=>'form', 'id'=>'signup-form');
$firstname = array('name' => 'first_name', 'id'=>'first_name', 'placeholder'=>'First Name');
$lastname = array('name' => 'last_name', 'id'=>'last_name', 'placeholder'=>'Last Name');
$email = array('name' => 'email_address', 'id'=>'email_address', 'placeholder'=>'Email Address');
$user = array('name' => 'username', 'id'=>'username', 'placeholder'=>'Email Address');
$pass = array('name' => 'password', 'id'=>'password', 'placeholder' => 'Password');
$pass2 = array('name' => 'password2', 'id'=>'password2', 'placeholder' => 'Confirm password');
$attr_FormSubmit = array('class'=>'btn btn-primary', 'value' =>'Create Admin', 'type'=>'submit');

?>

<?php // load top menu
//ECHO '<pre>'; print_r($pagination);
?>
<?php $this->load->view("menu/top_menu"); ?>
		<section class="page">
			<h1>View / Edit Nurses</h1>
			<?= br(); ?>
           	<div><?= $pagination; ?></div>
			<?= br(); ?>			
			<?= $table; ?>
		</section>

