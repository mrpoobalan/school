 <?php 
 $attr_FormOpen = array('role'=>'form');
 $hiddenid = array('name' => 'user_id', 'type'=>'hidden','disabled'=>'disabled');
 $name = array('name' => 'name', 'placeholder'=>'Name','required'=>'required','disabled'=>'disabled');
 $slug = array('name' => 'slug', 'placeholder'=>'Slug','required'=>'required','disabled'=>'disabled');
 $description = array('name' => 'description', 'placeholder'=>'Description','required'=>'required','disabled'=>'disabled');
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
    <div>

        <!-- /.navbar-static-side -->
        <div id="page-wrapper">
       <section class="page">     
            <div>
                <div>
                    <h1><?= $subtitle; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div>
                <!-- /.col-lg-6 -->
                <div>
                    <div>
                        <div>
                           Role ID: &nbsp;<?= $role->role_id?>
                        </div>
                        <!-- /.panel-heading -->
                        <div>
                            <!-- Nav tabs -->
                            <ul>
                                <li><a href="role_details-pills" data-toggle="tab">Details</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div>
                                <div>

		                            <h4>ID &nbsp;<?= $role->role_id?></h4><br>
									<div>
										<span></span>
		                            	<?= form_input($name, set_value("name", $role->name)); ?>                                
		                            </div>	 <br>  
									<div>
										<span></span>
		                            	<?= form_input($slug, set_value("slug", $role->slug)); ?>                                
		                            </div><br>
									<div>
										<span></span>
		                            	<?= form_input($description, set_value("description", $role->description)); ?>                                
		                            </div>		                            		                            
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                        <div>
                           Role ID: &nbsp; <?= $role->role_id ?>
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