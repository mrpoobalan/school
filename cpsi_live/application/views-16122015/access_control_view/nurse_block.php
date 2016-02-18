<?php

$attr_FormOpen = array('role'=>'form', 'id'=>'delete-form');
$attr_FormSubmit = array('class'=>'btn btn-danger', 'value' =>'Change Status', 'type'=>'submit');
$hiddenid = array('name' => 'user_id', 'type'=>'hidden','disabled'=>'disabled');
$firstname = array('name' => 'first_name', 'placeholder'=>'First Name','required'=>'required','disabled'=>'disabled');
$lastname = array('name' => 'last_name', 'placeholder'=>'Last Name','required'=>'required','disabled'=>'disabled');
$email = array('name' => 'email_address', 'placeholder'=>'Email Address','required'=>'required','disabled'=>'disabled');
$status = array('name' => 'status', 'placeholder'=>'Status','required'=>'required','disabled'=>'disabled');
$attr_FormSubmit = array('value' =>'Change Status', 'type'=>'submit');

// prohibit admin from changing username if the logged in user is the same as the admin...
$username = array('name' => 'username', 'placeholder'=>'Username', 'disabled'=>'disabled','disabled'=>'disabled');
$userstatus = array('name' => 'status', 'placeholder'=>'Account Status','disabled'=>'disabled');
$admin_role = array('type'=>'radio', 'name'=>'admin_roles','disabled'=>'disabled');
?>
<?php $this->load->view("menu/top_menu"); ?>
	<section class="page">
		<h1>View User</h1>
		<?= br(); ?>
        <div>
        <?php
       		if ($acct->status == "1") {
           		$class = "text-success";
            } elseif ($acct->status == "0") {
              	$class = "text-danger";
            }                                	
      	?>
        <fieldset class="legend">
        	<h2>Username</h2>
            <?= $acct->first_name. " ".$acct->last_name; ?>
       	</fieldset>                     			                            
        <fieldset>
        	<h2>Account Status</h2>
			<select name="status" >
				<?php 
					if ($this->form_data->status == "1") {
						echo "<option value=\"{$this->form_data->status}\">Block Nurse</option>";
						echo "<option value=\"0\">Unblock Nurse</option>";
					} elseif ($this->form_data->status == "0") {
						echo "<option value=\"{$this->form_data->status}\">Unblock Nurse</option>";
						echo "<option value=\"1\">Block Nurse</option>";
					}                                    
				?>
			</select>  
		</fieldset>
        <fieldset>
			<h2>User Since</h2>
            <?= date('m/d/Y', strtotime($acct->date_created)); ?>
        </fieldset>
        <fieldset>
        	<h2>Email Address</h2>
          	<a href="mailto:<?= $acct->email_address; ?>"><?= $acct->email_address; ?></a>
       	</fieldset>
             <?= br(); ?>
             <?= br(); ?>
             
		<?= form_submit($attr_FormSubmit); ?>
		<?= form_close(); ?>		                            
            <?= br(); ?>
            <?= br(); ?>
            <?= $link_back; ?>
     	</div>
	</section>