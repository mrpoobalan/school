<?php

# Set form attributes
$attr_FormOpen = array('perm'=>'form', 'id'=>'signup-form');
$name = array('name' => 'name', 'id'=>'name', 'placeholder'=>'Name','required'=>'required');
$slug = array('name' => 'slug', 'id'=>'slug', 'placeholder'=>'Slug','required'=>'required');
$description = array('name' => 'description', 'id'=>'description', 'placeholder'=>'Description','required'=>'required');
$attr_FormSubmit = array('value' =>'Create Permission', 'type'=>'submit');
?>
<?php // load top menu ?>
<?php $this->load->view("menu/top_menu"); ?>
		<section class="page">
			<h1>Permission Manager</h1>
			<?= br(); ?>
           	<div>
	                <?php
                        if (isset($_GET["del_success_message"])) {
                            echo "<div>
									<button type=\"button\" >&times;</button>
									Permission successfully deleted. 
								</div>";
                        } 
                        if (isset($_GET["success_message"])) {
                            echo "<div class=\"alert alert-success alert-dismissable\">
                            		<button type=\"button\" >&times;</button>
									Permission successfully added.
								</div>";
                        }
                 
                      	echo $this->session->flashdata('data'); 
                     ?>                           

                        <!-- /.panel-heading -->
                        <div>
                            <!-- Nav tabs -->
                            <ul>
                                <li><a href="#permissions" data-toggle="tab">Permissions</a>
                                </li>
                                <li ><a href="#add_permission" data-toggle="tab">Add Permission</a>
                                </li>
                            </ul>                    	
                           <!-- Tab panes -->
                            <div>
                                <divid="permissions">
                                	<?= br(); ?>
					            	<div><?= $pagination; ?></div>
					            	<?= br(); ?>
					                <div>
					                    <div>
					                        <!-- /.panel-heading -->
					                        <div>
					                            <div>
												<?= $table; ?>
					                            </div>
					                            <!-- /.table-responsive -->
					                        </div>
					                        <!-- /.panel-body -->
					                    </div>
					                    <!-- /.panel -->
					                </div>
					                <!-- /.col-lg-12 -->
                                </div>
                                <div>
					                <!-- /.col-lg-4 -->
					                <div>
					                	<?= br(); ?>
										<div>
					                        <div>
					                            <fieldset>
					                            	<?= form_open("{$add_perm}", $attr_FormOpen); ?>
					                                <div class="form-group input-group">
					                                	<span></span>
					                                	<?= form_input($name); ?>                                    
					                                </div>
					                                <div class="form-group input-group">
					                                	<span></span>
					                                	<?= form_input($slug); ?>                                    
					                                </div>
					                                <div class="form-group input-group">
					                                	<span></span>
					                                	<?= form_input($description); ?>                                    
					                                </div>                 
						                                                                           
					                                <!-- Change this to a button or input when using this as a form -->
					                                <?= form_submit($attr_FormSubmit); ?>
					                                <?= form_close(); ?>
					                                <?= br(); ?>
					                            </fieldset>
					            <?= br(); ?>
           	</div>
		</section>