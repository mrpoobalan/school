<?php
// load dashboard admin menu
$this->load->view("menu/top_menu");
//$attr_FormOpen = array('id' => "assessment17", 'class' => "healthform");
if (!empty($forminfo)):
    $review = $forminfo['wizard_num'] . "-" . $forminfo['wizard_id'] . "-" . $forminfo['unique_number'];
endif;
$attr_FormSubmit_assessment = array('class' => 'btn btn_primary', 'id' => 'assessment16', 'name' => 'assessment16', 'value' => 'Submit', 'type' => 'button');
?>
<section class="page">
    <h1>Nursing Assessment</h1>
    <?= br(); ?>
    <div><?= "Please select what you would like to do next"; ?></div>
    <?= br(); ?>
    <?= br(); ?>
    <div><ul>
            <li><span style="font-size: 16px;"><a href="<?php echo base_url() ?>access_control/admin/form_update/<?php echo $review . '-review' ?>" class="hyper" title="Review The Assessment before submitting">Review the Assessment before submitting</a></span></h3></li>
            <?= br(); ?>
            <li><span style="font-size: 16px;"><a href="<?php echo base_url() ?>access_control/admin/form_view/<?php echo $review . "/review" ?>" class="hyper" title=" View Printable Assessment before submitting"> View Printable Assessment before submitting</a></span></li>
            <?= br(); ?>

            <?php if ($userrole->level == 50): ?>
                <li><span style="font-size: 16px;"><a href="<?php echo base_url() . "nurse_assessment/assessment/nurse_escalate_form/" . $forminfo['wizard_sif_num'] . "/" . $forminfo['unique_number'] ?>" class="hyper" title="Escalated to Supervisor" >Assessment is ready to be escalated to Supervisor</a></span></li>
            <?php endif; ?>

            <?php if ($created_user_level == 50 && $userrole->level == 40): ?>
                <li><span style="font-size: 16px;"><a href="<?php echo base_url() . "nurse_assessment/assessment/nurse_reject_form/" . $forminfo['wizard_sif_num'] . "/" . $forminfo['unique_number'] ?>" class="hyper" title="Escalated to Supervisor" >Reject Assessment back to Nurse</a></span></li>
                <?= br(); ?>
                <li><span style="font-size: 16px;"><a href="<?php echo base_url() . "nurse_assessment/assessment/nurse_escalate_form/" . $forminfo['wizard_sif_num'] . "/" . $forminfo['unique_number'] ?>" class="hyper" title="Escalated to Supervisor" >Assessment is ready to be escalated to Program Manager</a></span></li>
            <?php elseif ($created_user_level == 40 && $userrole->level == 30): ?>

                <li><span style="font-size: 16px;"><a href="<?php echo base_url() . "nurse_assessment/assessment/nurse_reject_form/" . $forminfo['wizard_sif_num'] . "/" . $forminfo['unique_number'] ?>" class="hyper" title="Escalated to Supervisor" >Reject Assessment back to Nurse Supervisor</a></span></li>
                <?= br(); ?>
                <li><span style="font-size: 16px;"><a href="<?php echo base_url() . "nurse_assessment/assessment/ns_complete_form/" . $forminfo['wizard_sif_num'] . "/" . $forminfo['unique_number'] ?>" class="hyper" title="Assessment is Completed" >Assessment is Completed</a></span></li>
            <?php elseif ($userrole->level <= 40): ?>
                <li><span style="font-size: 16px;"><a href="<?php echo base_url() . "nurse_assessment/assessment/ns_complete_form/" . $forminfo['wizard_sif_num'] . "/" . $forminfo['unique_number'] ?>" class="hyper" title="Assessment is Completed" >Assessment is Completed</a></span></li>
            <?php endif; ?>
        </ul></div>
    <?= br(); ?>

</section>

<style>
    .hyper{
        text-decoration: none;font-weight: bold
    }

</style>
