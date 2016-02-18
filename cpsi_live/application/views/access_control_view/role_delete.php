<?php 
$attr_FormOpen = array('role'=>'form', 'id'=>'delete-form');
$attr_FormSubmit = array('class'=>'btn btn-danger', 'value' =>'DELETE ROLE', 'type'=>'submit');
$name = array('class'=>'form-control', 'name' => 'name', 'placeholder'=>'Name','required'=>'required','disabled'=>'disabled');
$slug = array('class'=>'form-control', 'name' => 'slug', 'placeholder'=>'Slug','required'=>'required','disabled'=>'disabled');
$description = array('class'=>'form-control', 'name' => 'description', 'placeholder'=>'Description','required'=>'required','disabled'=>'disabled');
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
                    <div class="panel panel-danger">
                        <div class="panel-heading ">
                           <i class="fa fa-trash-o fa-fw "></i> Role ID: &nbsp;<?= $role->role_id?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" style="background-image:none; border-bottom:none">
                                <li class="active"><a href="role_details-pills" data-toggle="tab">Details</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="role_view-pills">
					              <?= form_open("{$del_role}", $attr_FormOpen); ?>                            
		                            <h4><i class="fa fa-trash-o fa-fw"></i> ID &nbsp;<?= $role->role_id?></h4>
									<div class="form-group input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
		                            	<?= form_input($name, set_value("name", $role->name)); ?>                                
		                            </div>	 <br>  
									<div class="form-group input-group">
										<span class="input-group-addon"><i class="fa fa-tags"></i></span>
		                            	<?= form_input($slug, set_value("slug", $role->slug)); ?>                                
		                            </div><br>
									<div class="form-group input-group">
										<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
		                            	<?= form_input($description, set_value("description", $role->description)); ?>                                
		                            </div>	
                                </div>
                             	<?= form_submit($attr_FormSubmit); ?>
                                <?php form_close();?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                          <span> Role ID: &nbsp; <?= $role->role_id ?></span>
                        </div>
                    </div>
                    <?= $link_back; ?>
                </div>
            </div>
            <?= br(); ?>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div></section>
    </body>
    <!-- /#wrapper -->