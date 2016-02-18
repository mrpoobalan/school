<?php $this->load->view("menu/top_menu"); ?>
<section class="page">

    <h1>View <?php echo $userEditData->editedUser->roleName; ?></h1>

    <section class="new-section">
        <?php
        if ($acct->status == "1") {
            $class = "text-success";
        } elseif ($acct->status == "0") {
            $class = "text-danger";
        }
        ?>
        <ul>
            <li class="<?= $class; ?>">
                <label>Name:</label>
                <div><?= $userEditData->editedUser->first_name . " " . $userEditData->editedUser->last_name; ?></div>
            </li>
            <li>
                <label>Email</label>
                <div><a href="mailto:<?= $userEditData->editedUser->email_address; ?>"><?= $userEditData->editedUser->email_address; ?></a></div>
            </li>
            <li>
                <label>User Type</label>
                <div><?= $userEditData->editedUser->roleName; ?></div>
            </li>


            <?php
            // only show the vacant checkbox when the user is a nurse
            if ($userEditData->editedUser->roleName == "Nurse") {
                ?>
                <li>
                    <label>Nurse Supervisor</label>
                    <div class="readOnlyField">
                        <?php
                        $names = array();
                        foreach ($userEditData->manager1 as $row) {

                            $names[] = "<li>" . $row->first_name . " " . $row->last_name . "</li>";
                        }
                        print "<ul>" . implode("", $names) . "</ul>";
                        ?>
                    </div>
                </li>

                <li>
                    <label>Program Manager</label>
                    <div class="readOnlyField">
                        <?php
                        $names = array();
                        foreach ($userEditData->manager2 as $row) {
                            $names[] = "<li>" . $row->first_name . " " . $row->last_name . "</li>";
                        }
                        print "<ul>" . implode("", $names) . "</ul>";
                        ?>
                    </div>
                </li>

                <li>
                    <div><?= $viewUserFormsLink; ?></div>
                </li>
                <?php
            } else if ($userEditData->editedUser->roleName == "Nurse Supervisor") {
                ?>
                <li>
                    <label>Program Manager</label>
                    <div class="readOnlyField">
                        <?php
                        $names = array();
                        foreach ($userEditData->manager1 as $row) {
                            $names[] = "<li>" . $row->first_name . " " . $row->last_name . "</li>";
                        }
                        print "<ul>" . implode("", $names) . "</ul>";
                        ?>
                    </div>
                </li>
                <li>
                    <label>Nurses</label>
                    <div class="readOnlyField">
                        <?php
                        $names = array();
                        foreach ($userEditData->surbordinates as $row) {
                            $names[] = "<li>" . $row->first_name . " " . $row->last_name . "</li>";
                        }
                        print "<ul>" . implode("", $names) . "</ul>";
                        ?>
                    </div>
                </li>
                <!--                <li>
                                    <label>Vacant <?= form_checkbox('vacant', 'vacant'); ?>	</label>
                                </li>-->
                <?php
            } else if ($userEditData->editedUser->roleName == "Program Manager") {
                ?>
                <li>
                    <label>Director</label>
                    <div class="readOnlyField">
                        <?php
                        $names = array();
                        foreach ($userEditData->manager1 as $row) {
                            $names[] = "<li>" . $row->first_name . " " . $row->last_name . "</li>";
                        }
                        print "<ul>" . implode("", $names) . "</ul>";
                        ?>
                    </div>
                </li>
                <li>
                    <?php if ($userEditData->editedUser->roleName == "Program Manager") { ?>
                        <label>Nurse</label>
                    <?php }
                    ?>
                    <div class = "readOnlyField">
                        <?php
                        $names = array();
                        foreach ($userEditData->surbordinates as $row) {
                            if ($row->role_id == 6) {
                                $names[] = "<li>" . $row->first_name . " " . $row->last_name . "</li>";
                            }
                        }

                        print "<ul>" . implode("", $names) . "</ul>";
                        ?>
                    </div>
                </li>
                <!--Nurse supervisor-->
                <li>
                    <?php if ($userEditData->editedUser->roleName == "Program Manager") { ?>
                        <label>Nurse <br>Supervisors</label>

                        <div class="readOnlyField">
                            <?php
                            $names_supervisor = array();
                            foreach ($userEditData->surbordinates as $row) {
                                if ($row->role_id == 5) {
                                    $names_supervisor[] = "<li>" . $row->first_name . " " . $row->last_name . "</li>";
                                }
                            }

                            print "<ul>" . implode("", $names_supervisor) . "</ul>";
                            ?>
                        </div>
                    <?php } ?>
                </li>



                <?php
            }
            ?>
        </ul>

        <?= $link_back; ?>
    </section>
</section>