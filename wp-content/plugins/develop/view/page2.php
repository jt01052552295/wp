<?php if(!defined('ABSPATH')) exit;?>
<div class="wrap">
	<div class="kboard-header-logo"></div>
	<h1>
		<?php echo __('목록2', 'kboard')?>
	</h1>
	

	<form method="get">
		<input type="hidden" name="page" value="jtmplug_settings_page2">
		<p class="search-box">
			<input type="search" id="kboard_list_search" name="s" value="<?php _admin_search_query()?>">
			<?php submit_button(__('검색'), 'button', false, false, array('id'=>'search-submit'))?>
		</p>

	</form>
	<form method="get">
		<input type="hidden" name="page" value="jtmplug_settings_page2">
		<?php $table->display()?>
	</form>
	<p>
		<a href="<?php echo admin_url('admin.php?page=jtmplug_settings_page1'); ?>">등록</a>
	</p>
</div>