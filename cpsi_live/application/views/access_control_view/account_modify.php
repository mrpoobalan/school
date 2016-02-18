<?php

# Set form attributes
$attr_FormOpen = array('role'=>'form', 'id'=>'edit-user');
$uniqueid = array('name' => 'user_id', 'id'=>'disabledInput', 'disabled'=>'disabled', 'placeholder'=>'UserID Disabled');
$hiddenid = array('name' => 'user_id', 'type'=>'hidden');
$firstname = array('name' => 'first_name', 'placeholder'=>'First Name', 'required'=>'required');
$lastname = array('name' => 'last_name', 'placeholder'=>'Last Name', 'required'=>'required');
$email = array('name' => 'email_address', 'placeholder'=>'Email Address', 'required'=>'required');
$managed_by = array('name' => 'managed_by', 'placeholder'=>'Managed By', 'required'=>'required');
$pass = array('name' => 'password', 'id'=>'password', 'required' => 'required');
$pass2 = array('name' => 'password2', 'id'=>'password2', 'required' => 'required');
// prohibit admin from changing username if the logged in user is the same as the admin...  
if ($this->form_data->username === $this->session->userdata("username")) {
	$username = array('name' => 'username', 'placeholder'=>'Username', 'disabled'=>'disabled');
} else {
	$username = array('name' => 'username', 'placeholder'=>'Username');
}
$userstatus = array('name' => 'status', 'placeholder'=>'Account Status', 'required'=>'required');
$admin_role = array('type'=>'radio', 'name'=>'admin_roles');

$attr_FormSubmit = array('value' =>'Save', 'type'=>'submit');

?>
<?php $this->load->view("menu/top_menu"); ?>

<section class="page">
	<h1>Modify User</h1>
	<section>
		<?= form_error("first_name"); ?>
		<?= form_error("last_name"); ?>
		<?= form_error("email_address"); ?>
		<?= form_error("username"); ?>
		<?= $message; ?>
		<?= $success; ?>
		<?= form_open("".$action ."", $attr_FormOpen); ?>
		
		<fieldset>
			<div>
				<?= form_input($uniqueid, set_value("user_id")); ?>
				<?= form_input($hiddenid, set_value("user_id", $this->form_data->user_id)); ?>
			</div>
		</fieldset>
		<fieldset>
			<div>
				<label>First Name</label>
				<?= form_input($firstname, set_value("first_name", $this->form_data->first_name)); ?>
				<label>Last Name</label>
				<?= form_input($lastname, set_value("last_name", $this->form_data->last_name)); ?>
			</div>
		</fieldset>
		<fieldset>
			<label>Account Status</label> 
			<select name="status">
				<?php 
				if ($this->form_data->status == "1") {
					echo "<option value=\"{$this->form_data->status}\">User Active</option>";
					echo "<option value=\"0\">User Disable</option>";
				} elseif ($this->form_data->status == "0") {
					echo "<option value=\"{$this->form_data->status}\">User Disabled</option>";
					echo "<option value=\"1\">User Enable</option>";
				}                                    
				?>
			</select>
		</fieldset>
		<fieldset>
			<label>Username</label>
			<?= form_input($username, set_value("username", $this->form_data->username)); ?>
			<label>User Role</label> 
			<select name="roles" required="required">
				<?php foreach($role_list as $role): ?>
				<option value="<?= $role->role_id; ?>"
					<?= ($role->set) ? 'selected="selected"' : NULL; ?>>
					<?= $role->name; ?>
				</option>
				<?php endforeach; ?>
			</select> 
			<label>Email Address</label>
			<?= form_input($email, set_value("email_address", $this->form_data->email_address)); ?>
			<label>Password</label>
			<?= form_input($pass); ?>
			<label>Confirm Password</label>
			<?= form_input($pass2); ?>
		</fieldset>

		<?= form_submit($attr_FormSubmit); ?>
		<?= form_close(); ?>
		<?= br(); ?>

		<?= $link_back; ?>

</section>
