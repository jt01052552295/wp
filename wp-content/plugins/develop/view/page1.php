<?php
if(!defined('ABSPATH')) exit;

if($_GET['action'] == 'view'){

	// echo '<pre>'; print_r($result->row); echo '</pre>';
}
?>
<div class="wrap">
	<div class="kboard-header-logo"></div>
	<h1>
		<?php echo __('관리')?>
	</h1>
	<form action="<?php echo admin_url('admin-post.php')?>" method="post">
		<input type="hidden" name="action" value="jtmplug_update_action">
		<input type="text" name="uid" value="<?php echo $result->row->uid?>">

		
		<div class="tab-kboard-setting tab-kboard-setting-active">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="board_name">게시판 이름</label></th>
						<td>
							<input type="text" name="board_name" size="30" value="<?php echo $result->row->board_name?>" id="board_name">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="skin">스킨</label></th>
						<td>
							<input type="text" name="skin" size="30" value="<?php echo $result->row->skin?>" id="skin">
						</td>
					</tr>

					<?php if($result->row->uid):?>
						<tr valign="top">
							<th scope="row"><label for="shortcode">숏코드(Shortcode)</label></th>
							<td>
								<textarea style="width: 350px" id="shortcode">[jtmplug id=<?php echo $result->row->uid?>]</textarea>
								<p class="description">이 숏코드를 페이지에 입력하세요.</p>
							</td>
						</tr>
					<?php endif?>


				</tbody>
			</table>
		</div>
		
		<p class="submit">
			<input type="submit" class="button_basic" value="<?php echo __('변경 사항 저장', 'kboard')?>">
		</p>
	</form>
</div>
