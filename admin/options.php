<?php
?>

<div class="wrap">
	<h1 class="wp-heading-inline">Easy Google Maps Shortcode - Options</h1>
	<hr class="wp-header-end">

	<p><?php _e('Options for Google Maps', 'egms'); ?></p>

	<div id="dashboard-widgets" class="metabox-holder">
		<div class="postbox-container">
			<div class="postbox">
				<div class="postbox-header">
					<h2 class="hndle"><?php _e('Options', 'egms'); ?></h2>
				</div>
				<div class="inside">
					<div class="main">
						<form>
							<div class="input-text-wrap">
								<label for="egms_api_key" style="margin-bottom: 4px; font-weight: 600; display: block;">
									<?php _e('Google Maps API Key', 'egms'); ?>
								</label>
								<input type="text" id="egms_api_key" name="egms_api_key">
							</div>
							<p class="submit" style="margin-top: 12px;">
								<input class="button button-primary" type="submit" value="Salvar">
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
