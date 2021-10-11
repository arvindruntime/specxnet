<div class="row tab-top-margin">
	<div class="col-lg-6 col-md-12 col-sm-12">
		<div class="md-header btn-toolbar">
			<?php foreach ($tabs as $key => $tab) {
				echo $this->page->getPage('layout/tabs/'.$tab);
			} ?>

		</div>
	</div>
	<div class="col-lg-6 col-md-12 col-sm-12"></div>
</div>


