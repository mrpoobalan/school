<?php
//Place holder content here
$search = array('name' => 'sif', 'id' => 'student', 'placeholder' => 'Enter SIF # to find a student');
$attr_FormOpen = array('id' => "topsearch");
?>
<section class="user">
    <nav class="topnav">
        <ul>
            <li class="username"><a href="#"><?php echo $firstname . " " . $lastname ?><span><?= $userrole->name; ?></span></a>
                <ul>
                    <li><a href="<?= base_url("auth/logout"); ?>">Log Out</a></li>
                    <?php if ($userrole->level >= ADMIN && $userrole->level <= DIRECTOR) {
                        ?>
                        <li><a href="<?= base_url("access_control/nurse/showLogDetails"); ?>">Access Log</a></li>
                    <?php } ?>
                    <?php
                    if ($userrole->level == NURSE) {
                        ?>
                        <li><a href="<?= base_url("access_control/nurse/user_password_change/" . $this->session->userdata("user_id")); ?>">Change My Password</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a href="<?= base_url("access_control/admin/user_password_change/" . $this->session->userdata("user_id")); ?>">Change My Password</a></li>
                    <?php } ?>
                    <?php
                    if ($userrole->level == NURSE_SUPERVISOR) {
                        ?>
                        <li><a href="<?= base_url("access_control/nurse/nurse_manager"); ?>">Forms Awaiting My Approval</a></li>
                    <?php } ?>

                    <?php
                    if ($userrole->level == PROGRAM_MANAGER) {
                        ?>
                        <li><a href="<?= base_url("access_control/nurse/nurse_manager"); ?>">Forms Escalated to Me</a></li>
                        <?php
                    }
                    if ($userrole->level == NURSE) {
                        ?>
                        <li><a href="<?= base_url("access_control/nurse/nurse_manager"); ?>">Forms Awaiting My Edits</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </nav>
    <?= form_open("{$search_action}", $attr_FormOpen); ?>
    <?php
    if ($userrole->level == NURSE) {
        ?>
        <?= form_input($search, set_value("sif")); ?>
        <?php
    } else {
        ?>
        <?= form_input($search, set_value("lastname")); ?>
    <?php } ?>
    <?= form_close(); ?>
</section>
<nav class="nav">
    <ul>
        <li><a href="<?= base_url("search/student_search/"); ?>">Find a Student</a></li>
        <?php if ($userrole->level <= NURSE) : ?>
            <li class="dropdown" style="width:40% !important"><a href="#">Start a New Form</a>
                <ul>
                    <li><a href="<?= base_url("nurse_assessment/assessment/wizard_01?action=add"); ?>">New Nursing Assessment</a></li>
                    <li><a href="<?= base_url("health_appraisal/appraisal/wizard_01?action=add"); ?>">New Health Appraisal</a></li>
                </ul>
            </li>
        <?php endif; ?>
        <?php if ($userrole->level == NURSE_SUPERVISOR) : ?>
            <li class="dropdown"><a href="<?= base_url("access_control/admin/account_manager"); ?>">Users</a>
                <ul>
    <!--						<li><a href="<? #= base_url("access_control/admin/account_manager");   ?>">View/Edit Nurses Assigned To Me</a></li>-->
                    <li><a href="<?= base_url("access_control/admin/create_user"); ?>">Add Nurse</a></li>
                </ul>
            </li>
        <?php endif; ?>
        <?php if ($userrole->level <= PROGRAM_MANAGER) : ?>
            <li class="dropdown"><a href="<?= base_url("access_control/admin/account_manager"); ?>">Users</a>
                <ul>
    <!--						<li><a href="<? #= base_url("access_control/admin/account_manager");   ?>">View/Edit User</a></li>-->
                    <li><a href="<?= base_url("access_control/admin/create_user"); ?>">Add User</a></li>
                </ul>
            </li>
        <?php endif; ?>

    </ul>
    <div class="clear"></div>
</nav>