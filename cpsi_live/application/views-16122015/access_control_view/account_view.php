<?php $this->load->view("menu/top_menu"); ?>
		<section class="page">
			<h1>View User</h1>
			<?= br(); ?>
           	<div>
                                	<?php
                                		if ($acct->status == "1") {
                                			$class = "text-success";
                                		} elseif ($acct->status == "0") {
                                			$class = "text-danger";
                                		}                                	
                                	?>
		                            <h4 class="<?= $class; ?>"><i class="fa fa-user fa-fw"></i> <?= $acct->first_name. " ".$acct->last_name; ?></h4>
		                            <address>
		                                <strong>Username</strong>
		                                <br><?= $acct->username; ?>
		                            </address>		                            
		                            <address>
		                                <strong>Account Status</strong>
		                                <br><?= strtoupper($acct->status)=="1"? "Active":"Disabled"; ?>
		                                <br><strong>User Since</strong>
		                                <br><?= date('m/d/Y', strtotime($acct->date_created)); ?>
		                            </address>
		                            <address>
		                                <strong>Email Address</strong>
		                                <br>
		                                <a href="mailto:<?= $acct->email_address; ?>"><?= $acct->email_address; ?></a>
		                            </address>
                    			<?= br(); ?>
                    			<?= $link_back; ?>
           	</div>
		</section>