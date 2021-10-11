
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title><?php echo $this->page->getTitle(); ?></title>
<meta name="description" content="Datatable HTML table"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

<!-- START OF HEAD CSS -->
<?php 
	$headStyle = $this->page->getHeadStyle();
	foreach($headStyle as $style) { 
		echo '<link href="'.$style.'" rel="stylesheet" type="text/css" />';
 	} 

?>
<!-- END OF HEAD CSS -->

<!-- START OF HEAD JS -->
<?php 
	$headJs = $this->page->getHeadJs();
	foreach($headJs as $js) { 
		echo '<script type="text/javascript" src="'.$js.'"></script>';
 	} 

?>
<!-- END OF HEAD JS -->

<style type="text/css">
	div.dataTables_wrapper {
  		margin: 0 auto;
	}	
</style>	
<link rel="shortcut icon" href="<?php echo base_url();?>assets/demo/default/media/img/logo/SpecXReef_Logo.ico"/>