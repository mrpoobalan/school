<?php

# Set form attributes
$attr_FormOpen = array('role'=>'form', 'id'=>'signup-form');
$name = array('class'=>'form-control', 'name' => 'name', 'id'=>'name', 'placeholder'=>'Name','required'=>'required');
$slug = array('class'=>'form-control', 'name' => 'slug', 'id'=>'slug', 'placeholder'=>'Slug','required'=>'required');
$description = array('class'=>'form-control', 'name' => 'description', 'id'=>'description', 'placeholder'=>'Description','required'=>'required');
$attr_FormSubmit = array('class'=>'btn btn-primary', 'value' =>'Create Role', 'type'=>'submit');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Role Manager</title>
<?php
//<!-- Core CSS - Include with every page -->
$style = array(
	'href' => base_url().'assets/css/bootstrap/css/bootstrap.min.css',
    'rel' => 'stylesheet'		
);

$font = array(
		'href' => base_url().'assets/bootstrap/font-awesome/css/font-awesome.css',
		'rel' => 'stylesheet'
);

//<!-- Page-Level Plugin CSS - Dashboard -->
$morrischart = array(
		'href' => base_url().'assets/css/plugins/morris/morris-0.4.3.min.css',
		'rel' => 'stylesheet'
);

$timeline = array(
		'href' => base_url().'assets/css/plugins/timeline/timeline.css',
		'rel' => 'stylesheet'
);

// <!-- SB Admin CSS - Include with every page -->
$sbadmin = array(
		'href' => base_url().'assets/css/bootstrap/css/sb-admin.css',
		'rel' => 'stylesheet'
);

echo link_tag($style);
echo link_tag($font);


?>
</head>
<body>
	<div id="wrapper">
        <!-- /.navbar-static-top -->
		<?php // load dashboard admin menu ?>
        <!-- /.navbar-static-side -->
            <!-- /.row -->					          
       <section class="page">     
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?= $subtitle; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">
            <!-- start tab view for access control list -->
            	<div class="col-lg-12">
                <!--   ?= $error; ? -->
                	<?php
                    	if (isset($_GET["success_message"]) == TRUE) {
                        	echo "<div class=\"alert alert-success alert-dismissable\">
                            	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
									Role successfully added.
							</div>";
					    }                               
			            if (isset($_GET["del_success_message"]) == TRUE) {
		            		echo "<div class=\"alert alert-success alert-dismissable\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
									Role successfully deleted.
							</div>";
			            }
			            if (isset($_GET["name_error_message"])) {
                         	echo "<div class=\"alert alert-danger alert-dismissable\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                	Error, Role name already exist...
							</div>";
					 	}        
				      	if (isset($_GET["slug_error_message"])) {
					     	echo "<div class=\"alert alert-danger alert-dismissable\">
                            	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                	Error, Slug name already exists. 
							</div>";
				     	}
					?>         
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-group fa-fw"></i> <?= $panel_title; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" style="background-image:none; border-bottom:none">
                                <li class="active"><a href="#roles" data-toggle="tab">Roles</a>
                                </li>
                                <li><a href="#add_role" data-toggle="tab">Add Role</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="roles">
		                	    <?= form_error("name"); ?> 
		                        <?= form_error("slug"); ?>
		                        <?= form_error("description"); ?>
              	
                                <?= br(); ?>
					            <div><?= $pagination; ?></div>
					            	<?= br(); ?>
					                <div class="col-lg-12">
					                    <div class="panel panel-default">
					                        <!-- /.panel-heading -->
					                        <div class="panel-body">
					                            <div class="table-responsive">
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
                                <div class="tab-pane fade" id="add_role">
					                <!-- /.col-lg-4 -->
					                <div class="col-lg-4">
					                	<?= br(); ?>
					                    <div class="panel panel-primary">
											<div class="panel-heading">
					                           <i class="fa fa-plus fa-fw"></i>
					                        </div>
					                        <div class="panel-body">
					                            <fieldset>
					                            	<?= form_open("{$add_role_process}", $attr_FormOpen); ?>
					                                <div class="form-group input-group">
					                                	<span class="input-group-addon"><i class="fa fa-group"></i></span>
					                                	<?= form_input($name); ?>                                    
					                                </div>
					                                <div class="form-group input-group">
					                                	<span class="input-group-addon"><i class="fa fa-group"></i></span>
					                                	<?= form_input($slug); ?>                                    
					                                </div>
					                                <div class="form-group input-group">
					                                	<span class="input-group-addon"><i class="fa fa-group"></i></span>
					                                	<?= form_input($description); ?>                                    
					                                </div>                 
						                             <div class="form-group input-group height:100%" >
						                             	<span class="input-group-addon"><i class="fa fa-group"></i></span>
														<select id="perms" name="perms[]" multiple="multiple" class="form-control" size = "<?=count($perm_list)?>" required>
															<?php foreach($perm_list as $perm){ ?>
															<option value="<?= $perm->perm_id; ?>" <?= (!empty($perm->set)) ? 'selected="selected"' : NULL; ?>><?= $perm->name; ?></option>
															<?php }?>
														</select>
						                            </div>						                                                                           
					                                <!-- Change this to a button or input when using this as a form -->
					                                <?= form_submit($attr_FormSubmit); ?>
					                                <?= form_close(); ?>
					                                <?= br(); ?>

					                            </fieldset>
					                        </div>
					                    </div>
					                </div>
					                <!-- /.col-lg-4 -->									
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- end tab view -->
            </div>
            <!-- /.row -->
        </div></section>   
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->