<?php

# Set form attributes
$attr_FormOpen = array('role'=>'form', 'id'=>'add-user');
$firstname = array('name' => 'first_name', 'id'=>'first_name', 'placeholder'=>'First Name', 'required' => 'required');
$lastname = array('name' => 'last_name', 'id'=>'last_name', 'placeholder'=>'Last Name', 'required' => 'required');
$email = array('name' => 'email_address', 'id'=>'email_address', 'placeholder'=>'Email Address', 'required' => 'required');
$user = array('name' => 'username', 'id'=>'username', 'placeholder'=>'Username', 'required' => 'required');
$pass = array('name' => 'password', 'id'=>'password', 'required' => 'required','placeholder'=>'Enter Password','type'=>'password');
$pass2 = array('name' => 'password2', 'id'=>'password2', 'required' => 'required','placeholder'=>'Re-enter Password','type'=>'password');
$managedby = array('name' => 'managedby', 'id'=>'managed-by', 'size' => '100', 'placeholder'=>'Enter manager ID');
$roles = array('name' => 'role', 'id'=>'role', 'placeholder'=>'Enter Few words', 'required' => 'required');
$nplist = array('name' => 'multi_nurse_supervisors', 'id'=>'multi_nurse_supervisors', 'placeholder'=>'Enter Few words', 'required' => 'required');
$attr_FormSubmit = array('class'=>'btn btn-primary', 'value' =>'Add User', 'type'=>'submit', 'style' => 'margin-left: 2px;');
//echo '<pre>';
//print_r($roletype_array);
?>


<?php // load top menu ?>
<?php $this->load->view("menu/top_menu"); ?>
		<section class="page">
			<h1>Add User</h1>
			<?= br(); ?>
           	<div>
           	<?= $this->session->flashdata('data'); ?>
           	<?= validation_errors('<p class="error">'); ?>
				<?= form_open("{$add_admin_process}", $attr_FormOpen); ?>				
						<fieldset>
							<label>First Name</label>
							<?= form_input($firstname); ?>
							<label>Last Name</label>
							<?= form_input($lastname); ?>
						</fieldset>
						<fieldset>
							<label>Email</label>
							<?= form_input($email); ?>
							<label>Username</label>
							<?= form_input($user); ?>
						</fieldset>
						<fieldset>
							<label>Password</label>						
							<?= form_input($pass); ?>
							<label>Confirm Password</label>
							<?= form_input($pass2); ?>						
						</fieldset>
                            
                                                <input type="hidden" value="<?php echo $userrole->role_id; ?>" name="userrole_val" id="userrole_id">
                                                <input type="hidden" value="<?php echo $userrole->first_name; ?>" name="userrole_fname" id="userrole_fname">
                                                <input type="hidden" value="<?php echo $userrole->last_name; ?>" name="userrole_lanem" id="userrole_lname">
<!--                                                <fieldset>
							<label>User Types</label>
                                                       <?#= form_input($roles); ?>
						</fieldset>-->
                                                						<fieldset>
							<label>User Type</label>
							<section>
                                                        <?php 
                                                     if($userrole->role_id <> 5){
                                                        ?>
                                                            <select id="role" name="role" class="form-control" onChange="change_managed_by(<?php echo $this->session->userdata('user_id'); ?>)" required style="width: 265px !important">
						       		<option value="">Select User Type</option>
									<?php foreach($roletype_array->result_array() as $row) : ?>
									<option value="<?= $row['role_id']; ?>" <?= set_select("name", "{$row['role_id']}", ( !empty($data) && $data == "{$row['role_id']}" ? TRUE : FALSE )); ?>><?= $row['name']; ?></option>
									<?php endforeach; ?>
								</select>
                                                     <?php } else { ?>
                                                            <input type="text" name="role" id="role" value ="Nurse">
                                                     <?php } ?>
                                                      </section>
						</fieldset>
                                                <div id="managed_by" name="managed_by">
						
						</div>																								        			
					 <?= form_submit($attr_FormSubmit); ?>
				    <?= form_close(); ?>
					<?= br(); ?>
					<?= $error; ?>
					<?php
						if (isset($_GET["success_message"]) == TRUE) {
							echo "admin successfully added. " .anchor("".base_url()."access_control/admin/account_update/{$_GET["user"]}", "Assign role(s)"). "";
						}
					?>       	
           	</div>
		</section>