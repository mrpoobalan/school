<?php

$attr_FormOpen = array('role'=>'form', 'id'=>'delete-form');
$attr_FormSubmit = array('class'=>'btn btn-danger', 'value' =>'DELETE ACCOUNT', 'type'=>'submit');
$hiddenid = array('name' => 'user_id', 'type'=>'hidden','disabled'=>'disabled');
$firstname = array('name' => 'first_name', 'placeholder'=>'First Name','required'=>'required','disabled'=>'disabled');
$lastname = array('name' => 'last_name', 'placeholder'=>'Last Name','required'=>'required','disabled'=>'disabled');
$email = array('name' => 'email_address', 'placeholder'=>'Email Address','required'=>'required','disabled'=>'disabled');
$status = array('name' => 'status', 'placeholder'=>'Status','required'=>'required','disabled'=>'disabled');

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
									<?= form_open("".$del_account ."", $attr_FormOpen); ?>

										<div >
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<?= form_input($firstname, set_value("first_name", $this->form_data->first_name)); ?>                                
										</div>
										<div >
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<?= form_input($lastname, set_value("last_name", $this->form_data->last_name)); ?>                                
										</div>
										<div >
											<?php
											if ($this->form_data->status == "1") {
												echo "<span class=\"input-group-addon\"><i class=\"fa fa-unlock\"></i></span>";
											} elseif ($this->form_data->status == "0") {
												echo "<span class=\"input-group-addon\"><i class=\"fa fa-lock\"></i></span>";
											}
											if ($this->form_data->status == "1") {
												echo form_input($status, set_value("status", "User Enabled"));
											}else{
												echo form_input($status, set_value("status", "User Disabled"));										
											}
											?>
										 </div>
										<div >
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<?= form_input($username, set_value("username",$this->form_data->username)); ?><br>
											                                 
										</div>
			                             <div >
			                             	<span class="input-group-addon"><i class="fa fa-group"></i></span>
												<select id="roles"  name="roles[]" class="form-control"  disabled ='disabled' required size = "<?=count($role_list)?>" onChange="change_perms()">
													<? foreach($role_list as $role): ?>
													<option name="<?= $role->name;?>"  id="<?= $role->name;?>"value="<?= $role->role_id; ?>" <?= !empty($role->set) ? 'selected="selected"' : NULL; ?>><?= $role->name; ?></option>
													<? endforeach; ?>
												</select>
			                            </div>
										<div><br>
										</div>																				 											                            
			                             <div class="form-group input-group height:100%" >
			                             	<span class="input-group-addon"><i class="fa fa-group"></i></span>
												<select id="perms" name="perms" multiple="multiple" class="form-control" size = "<?=count($perm_list)?>" disabled ='disabled' required>
													<? foreach($perm_list as $perm): ?>
													<option value="<?= $perm->perm_id; ?>" <?= (!empty($perm->set)) ? 'selected="selected"' : NULL; ?>><?= $perm->name; ?></option>
													<? endforeach; ?>
												</select>
			                            </div>
			                            
										<div >
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<?= form_input($email, set_value("email_address", $this->form_data->email_address)); ?>                                   
										</div>
										<!-- Change this to a button or input when using this as a form -->
										<?= br(); ?>
										<?= form_submit($attr_FormSubmit); ?>
										<?= form_close(); ?>
								<!-- Change this to a button or input when using this as a form -->
                    			<?= br(); ?>
                    			<?= $link_back; ?>
           	</div>
		</section>