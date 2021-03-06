<?php

# Set form attributes
$attr_FormOpen = array('role'=>'form');
$uniqueid = array('name' => 'role_id', 'id'=>'disabledInput', 'disabled'=>'disabled', 'placeholder'=>'Role ID: Disabled');
$hiddenid = array('name' => 'role_id', 'type'=>'hidden');
$name = array('name' => 'name', 'placeholder'=>'Name');
$slug = array('name' => 'slug', 'placeholder'=>'Slug');
$description = array('name' => 'description', 'placeholder'=>'Description');

//print_r($perm_list);exit;
//$pass = array('name' => 'password', 'placeholder' => 'Password');
//$pass2 = array('name' => 'password2', 'placeholder' => 'Confirm password');
$attr_FormSubmit = array('class'=>'btn btn-primary', 'value' =>'Save', 'type'=>'submit');
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
       <section class="page">     

	<div id="wrapper">
        <!-- /.navbar-static-top -->
        <!-- /.navbar-static-side -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?= $subtitle; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           <i class="fa fa-edit fa-fw"></i> Role ID: &nbsp;<?= $this->form_data->role_id; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" style="background-image:none; border-bottom:none">
                                <li class="active"><a href="#role-pill" data-toggle="tab">Edit <?=$this->form_data->name; ?></a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">                              
								<h4><i class="fa fa-edit fa-fw"></i> Role ID:&nbsp; <?= $this->form_data->role_id; ?> </h4>
                                <div class="tab-pane fade in active" id="perm-pill">
                                   <?php 
                                		if (isset($_GET["UpdateSuccess"])=="success") {
									?>
											<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												Role Updated
											</div>
                                	<?php 	
                                		} elseif (isset($_GET["UpdateFailed"])) {
									?>
											<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												Error Updating Role 
											</div>                                			
                                	<?php 
                               			}
                                	?>  								
								<?= form_open("".$action ."", $attr_FormOpen); ?>
									<fieldset>
				                	    <?= form_error("name"); ?> 
				                        <?= form_error("slug"); ?>
				                        <?= form_error("description"); ?>

										<div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
											<?= form_input($uniqueid, set_value("role_id")); ?>
											<?= form_input($hiddenid, set_value("role_id", $this->form_data->role_id)); ?>                              
										</div>
										<div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-pencil"> </i></span>
											<?= form_input($name, set_value("name", $this->form_data->name)); ?>                                
										</div>
										<div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
											<?= form_input($slug, set_value("slug", $this->form_data->slug)); ?>                                
										</div>									
										<div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
											<?= form_input($description, set_value("description", $this->form_data->description)); ?>                                  
										</div>
			                             <div class="form-group input-group height:auto" >
			                             	<span class="input-group-addon"><i class="fa fa-group"></i></span>
											<select name="perms[]" multiple="multiple" class="form-control" size = "<?=count($perm_list)?>" required>
												<?php foreach($perm_list as $perm){ ?>
												<option value="<?= $perm->perm_id; ?>" <?= (!empty($perm->set)) ? 'selected="selected"' : NULL; ?>><?= $perm->name; ?></option>
												<?php } ?>
											</select>
			                            </div>
										<!-- Change this to a button or input when using this as a form -->
										<?= form_submit($attr_FormSubmit); ?>
										<?= form_close(); ?>
									</fieldset>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                           <span>Role ID: <?= $this->form_data->role_id; ?></span>
                        </div>
                    </div>
                    <?= $link_back; ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    </section>
    </body>