
<title><?php echo $this->page->getTitle(); ?></title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

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
