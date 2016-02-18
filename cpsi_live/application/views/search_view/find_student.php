<?php
$search = array('name' => 'sif', 'id' => 'main-search', 'placeholder' => 'Enter SIF # to find a student');
$search_fil1 = array('name' => 'filter1', 'id' => 'filter1', 'placeholder' => 'Enter search filter"', 'required' => 'required');
$search_fil2 = array('name' => 'filter2', 'id' => 'filter2', 'placeholder' => 'Enter search filter"');
$attr_FormOpen = array('id' => "search", 'type' => 'hidden');
?>


<?php $this->load->view("menu/top_menu"); ?>
<section class="page">
    <h1>Find a Student...</h1>
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
    <?= br() ?>
    <?php if ($userrole->level < NURSE) : ?>
        <button id="advanced-button" type="button">Advanced Search</button>
        <br><br>
        <?php
        if ($this->session->flashdata('exist_user_check') != '')
            echo "<span style='color:red'>" . $this->session->flashdata('exist_user_check') . "</span>";
        ?>
        <?= form_open("{$search_action}", $attr_FormOpen); ?>
        <fieldset id="advanced" class="off">
            <?= form_input($search_fil1, set_value("filter1")); ?>
            <p>in</p>
            <label>
                <select id="filter1-type" name="filter1_type" required>
                    <option value="">Choose a field</option>
                    <option value="wizard_sif_num">SIF</option>
                    <option value="wizard_status">Status</option>
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="birth_date">Date of Birth</option>
                    <option value="student_school">School</option>
                    <?php if ($userrole->level == DIRECTOR) : ?>
                        <option value="form">Form</option>
                    <?php endif; ?>
                </select>
            </label>
            <p>&amp;</p>
            <?= form_input($search_fil2, set_value("filter2")); ?>
            <p>in</p>
            <label>
                <select id="filter2-type" name="filter2_type">
                    <option value="">Choose a field</option>
                    <option value="wizard_sif_num">SIF</option>
                    <option value="wizard_status">Status</option>
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="birth_date">Date of Birth</option>
                    <option value="student_school">School</option>
                    <?php if ($userrole->level == DIRECTOR) : ?>
                        <option value="form">Form</option>
                    <?php endif; ?>
                </select>
            </label>
            <input type="submit" id="search-submit" value="Search" />
        </fieldset>
        <?= form_close(); ?>
    <?php endif; ?>
    <h2>Results <span>(click column name to sort by that field)</span></h2>
    <?= br(); ?>
    <div><?#= $pagination; ?></div>
    <?= br(); ?>
    <?= $table; ?>
    <?= $message; ?>
</section>
<style>
    .noback{
        background: none repeat scroll 0% 0% transparent;
    }
    #results_wrapper{
        overflow: auto;
    }
</style>