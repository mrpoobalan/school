<style>
    .info, .success, .error, .validation {
        border: 1px solid;
        margin: 10px 0px;
        padding:15px 10px 15px 50px;
        background-repeat: no-repeat;
        background-position: 10px center;
    }
    .info {
        color: #00529B;
        background-color: #BDE5F8;
        background-image: url('info.png');
    }
    .success {
        color: #4F8A10;
        background-color: #DFF2BF;
        background-image:url('success.png');
    }
</style>
<?php
# Set form attributes
$attr_FormOpen = array('role' => 'form', 'id' => 'edit-user');
$uniqueid = array('name' => 'user_id', 'id' => 'disabledInput', 'disabled' => 'disabled', 'placeholder' => 'UserID Disabled');
$hiddenid = array('name' => 'user_id', 'type' => 'hidden');
$cid = array('id' => 'cid', 'name' => 'cid', 'type' => 'hidden', 'value' => $this->form_data->user_id);
$firstname = array('name' => 'first_name', 'placeholder' => 'First Name', 'required' => 'required');
$lastname = array('name' => 'last_name', 'placeholder' => 'Last Name', 'required' => 'required');
$email = array('name' => 'email_address', 'placeholder' => 'Email Address', 'required' => 'required');

// prohibit admin from changing username if the logged in user is the same as the admin...
if ($this->form_data->username === $this->session->userdata("username")) {
    $username = array('name' => 'username', 'placeholder' => 'Username', 'disabled' => 'disabled');
} else {
    $username = array('name' => 'username', 'placeholder' => 'Username');
}
$userstatus = array('name' => 'status', 'placeholder' => 'Account Status', 'required' => 'required');
$admin_role = array('type' => 'radio', 'name' => 'admin_roles');

$attr_FormSubmit = array('value' => 'Save', 'type' => 'submit');
if (!empty($userEditData)):
    $editactn = "1";
else:
    $editactn = "";
endif;

$selected_nurse = json_decode(json_encode($userEditData->surbordinates), true);
//echo "<pre>";
//print_r($selected_nurse);
//exit;
foreach ($selected_nurse as $nurse) {
    if ($nurse[role_id] == 6) {
        $nurse_list = $nurse_list . " " . $nurse['first_name'] . " " . $nurse['last_name'] . " ,";
        $nurse_userid = $nurse_userid . $nurse['user_id'] . ",";
        $nurse_username = $nurse_username . "'" . $nurse['username'] . "'" . ',';
    }
    //$existdates . "'" . convert_qb_date_format($notrainingdate) . "'" . ',';
}
$nurse_display = trim($nurse_list, ",");

$nurse_userid_edit = trim($nurse_userid, ",");
$nurse_username_edit = trim($nurse_username, ",");


// selected program manager
foreach ($selected_nurse as $nurse_supervisor) {
    if ($nurse_supervisor[role_id] == 5) {
        $nurse_super_list = $nurse_super_list . " " . $nurse_supervisor['first_name'] . " " . $nurse_supervisor['last_name'] . " ,";
        $nurse_super_userid = $nurse_super_userid . $nurse_supervisor['user_id'] . ",";
        $nurse_super_username = $nurse_super_username . "'" . $nurse_supervisor['username'] . "'" . ',';
    }
    //$existdates . "'" . convert_qb_date_format($notrainingdate) . "'" . ',';
}
$nurse_super_display = trim($nurse_super_list, ",");

$nurse_super_userid_edit = trim($nurse_super_userid, ",");
$nurse_super_username_edit = trim($nurse_super_username, ",");
?>
<?php $this->load->view("menu/top_menu"); ?>
<section class="page" id="nurseModify">
    <h1>Modify <?= $userEditData->editedUser->roleName ?></h1>
    <div>
        <?= form_open("" . $action . "", $attr_FormOpen); ?>
        <?= form_error("first_name"); ?>
        <?= form_error("last_name"); ?>
        <?= form_error("email_address"); ?>
        <?= form_error("username"); ?>
        <?php
        if (!empty($message)):
            ?>
            <div class="success"><?= $message; ?></div>
        <?php endif; ?>

        <fieldset>
            <div>
                <?= form_input($uniqueid, set_value("user_id")); ?>
                <?= form_input($hiddenid, set_value("user_id", $this->form_data->user_id)); ?>
                <?= form_input($cid); ?>
            </div>
        </fieldset>
        <fieldset>
            <div>
                <label>First Name</label>
                <?= form_input($firstname, set_value("first_name", $userEditData->editedUser->first_name)); ?>
                <label>Last Name</label>
                <?= form_input($lastname, set_value("last_name", $userEditData->editedUser->last_name)); ?>
            </div>
        </fieldset>
        <fieldset>
            <label>Account Status</label>
            <select name="status" >
                <?php
                if ($userEditData->editedUser->status == "1") {
                    echo "<option value=\"{$this->form_data->status}\">User Active</option>";
                    echo "<option value=\"0\">User Disable</option>";
                } elseif ($userEditData->editedUser->status == "0") {
                    echo "<option value=\"{$this->form_data->status}\">User Disabled</option>";
                    echo "<option value=\"1\">User Enable</option>";
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <?php
//echo '<pre>';
// print_r($nurseSupervisors);
            ?>
            <label>Username</label>
            <?= form_input($username, set_value("username", $userEditData->editedUser->username)); ?>

            <label>User Type <span class='warning'>(changing a user type may break the management hierarchy)</span></label>
            <?php
            if ($userrole->role_id <> 5) {
                ?>
                <select id="roles" name="roles" class="form-control"  required="required" <?php
                if (!empty($editactn)): echo "disabled='disabled'";
                endif;
                ?>>
                            <?php
                            foreach ($role_list as $role) {
                                ?>
                        <option value="<?= $role->role_id; ?>"<?= ($userEditData->editedUser->role_id == $role->role_id) ? 'selected="selected"' : NULL; ?>>
                            <?= $role->name; ?>
                        </option>
                    <?php } ?>
                </select>
                <?php
            } else {
                ?>
                <input type="text" name="role" id="role" value ="Nurse" readonly="readonly" >
                <label>Nurse Supervisor</label>
                <input type="text" name="nurse_supervisor" id="nurse_supervisor" value ="<?php echo $userrole->first_name . " " . $userrole->last_name; ?>" readonly="readonly" >
            <?php } ?>
            <label>Email Address</label>
            <?= form_input($email, set_value("email_address", $userEditData->editedUser->email_address)); ?>



        </fieldset>
        <!--
                <fieldset id="seleted_nurses">
                    <label>Selected Nurse</label>
                    <textarea name="seleted_nurse" id="seleted_nurse" readonly="readonly"><?php # echo $nurse_display;                                                                                                                                                                 ?></textarea>
                </fieldset>-->
        <?php
        if ($userEditData->editedUser->role_id == 5) {

            if (!empty($nurse_display)):
                ?>
                <fieldset id="seleted_nurses">
                    <label>Selected Nurse</label><br>
                    <input type="checkbox" id="checkAll"/> <b>Select All</b><br><br><br>
                    <?php
                    foreach ($selected_nurse as $key => $val) {
                        if ($val['role_id'] == 6) {
                            ?>
                            <input type="checkbox"  class='nurse' name="selecednur[]" id="seleted_nurse" value="<?php echo $val['user_id'] . "," . $val['username']; ?>">
                            <?php echo $val['first_name'] . "  " . $val['last_name'] . "<br><br>"; ?>
                            <?php
                        }
                    }
                    ?>
                </fieldset>

                <br>
                <fieldset id="change_ns">
                    <label>Change nurse supervisor</label>
                    <input type="text" name="edit_nurse_supervisor" id="edit_nurse_supervisor" >
                    <input type="hidden" name="edit_nurse_id" id="edit_nurse_id" value="<?php echo $nurse_userid_edit; ?>" >
                    <input type="hidden" name="edit_nurse_username" id="edit_nurse_username" value="<?php echo $nurse_username_edit; ?>" >
                </fieldset>
            <?php endif; ?>
        <?php } ?>


        <?php if ($userEditData->editedUser->role_id == 4) { ?>

            <!-- Change Program manager start-->
            <?php
            if (!empty($nurse_super_display)):
                ?>
                <fieldset id="seleted_nursesupervisor">
                    <label>Selected Nurse Supervisor</label><br>
                    <input type="checkbox" id="checkAllns"/> <b>Select All</b><br><br><br>
                    <?php
                    foreach ($selected_nurse as $key => $val) {
                        if ($val['role_id'] == 5) {
                            ?>
                            <input type="checkbox" name="selecednursup[]" class='nurse_supervisor' id="seleted_nurse_supervisor" value="<?php echo $val['user_id'] . "," . $val['username']; ?>">
                            <?php echo $val['first_name'] . "  " . $val['last_name'] . "<br><br>"; ?>
                            <?php
                        }
                    }
                    ?>
                </fieldset>

                <br>
                <fieldset id="change_pm">
                    <label>Change Program Manager</label>
                    <input type="text" name="edit_program_manager" id="edit_program_manager" >
                    <input type="hidden" name="edit_nursesupervisor_id" id="edit_nursesupervisor_id" value="<?php echo $nurse_super_userid_edit; ?>" >
                    <input type="hidden" name="edit_nursesupervisor_username" id="edit_nursesupervisor_username" value="<?php echo $nurse_super_username_edit; ?>" >
                </fieldset>
            <?php endif; ?>
        <?php } ?>
        <!-- End-->




        <!-- Change Program manager for the nurse supervisor -->
        <?php if ($userEditData->editedUser->role_id == 5 && $userrole->role_id <= 3) { ?>
            <!--            <fieldset>
                            <label>Change Program Manager</label>

                            <select id="program_manager" name="program_manager" class="form-control"  required="required" <?php ?>>
                                <option value="">&lt;Select One &gt;</option>
            <?php
            foreach ($programManagers as $role) {
                ?>
                                                <option value="<?= $role->user_id; ?>"<?= ($userEditData->manager1{0}->user_id == $role->user_id) ? 'selected="selected"' : NULL; ?>>
                <?= $role->first_name . ' ' . $role->last_name; ?>
                                                </option>
            <?php } ?>
                            </select>

                        </fieldset>-->
        <?php } ?>


        <!-- Change this to a button or input when using this as a form -->
        <?= form_submit($attr_FormSubmit); ?>
        <?= form_close(); ?>
        <?= br(); ?>
        <?= $link_back; ?>
    </div>
</section>

<script>
    $(document).ready(function() {
        $("#checkAll").change(function() {
            $('.nurse').prop('checked', $(this).prop('checked'));
        });
        $("#checkAllns").change(function() {
            $('.nurse_supervisor').prop('checked', $(this).prop('checked'));
        });
    });

</script>
