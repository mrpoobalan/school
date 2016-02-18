<?php $this->load->view("forms/header"); ?>

<?php $this->load->view($forms); ?>

<?php 

	if(!$footerData) 
	{
		// enforce footer data (bare min)
		$footerData = array('readOnlyViewing'=>array());
	}
	
	$this->load->view("forms/footer", $footerData); 
?>
