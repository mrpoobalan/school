<?php
// load dashboard admin menu

$this->load->view("menu/top_menu");
$attr_FormOpen = array('id' => "appraisal6", 'class' => "healthform");
if (!empty($forminfo)):
    $review = $forminfo['wizard_num'] . "-" . $forminfo['wizard_id'] . "-" . $forminfo['unique_number'];
endif;
?>
<section class="page">
    <h1>Health Appraisal Complete</h1>
    <?= br(); ?>
    <div><?= "Please select what you would like to do next"; ?></div>
    <?= br(); ?>
    <?= br(); ?>
    <div><ul>
            <li><span style="font-size: 16px;"><a href="<?php echo base_url() ?>access_control/admin/form_update/<?php echo $review . '-review' ?>" class="hyper" title="Review the Appraisal before submitting">Review the Appraisal before submitting</a></span></h3></li>
            <?= br(); ?>
            <li><span style="font-size: 16px;"><a href="<?php echo base_url() ?>access_control/admin/form_view/<?php echo $review . "/review" ?>" class="hyper" title="View Printable Appraisal before submitting"> View Printable Appraisal before submitting</a></span></li>
            <?= br(); ?>
            <li><span style="font-size: 16px;"><a href="<?php echo base_url() . "health_appraisal/appraisal/appraisal_complete_form/" . $forminfo['wizard_sif_num'] . "/" . $forminfo['unique_number'] ?>" class="hyper" title="Appraisal is Completed" >Appraisal is Completed</a></span></li>
        </ul></div>
    <?= br(); ?>
    <section class="buttons">
        <div class="nextbutton">
            <?= $link_back; ?>
        </div>
        <div class="clear"></div>
    </section>
</section>

<style>
    .hyper{
        text-decoration: none;font-weight: bold
    }

</style>