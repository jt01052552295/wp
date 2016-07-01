<?php
if(!defined('ABSPATH')) exit;
?>
<div class="wrap">
	<div class="kboard-header-logo"></div>
	<h1>
		<?php echo __('관리')?>
	</h1>
	

		
	<div class="tab-kboard-setting tab-kboard-setting-active">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="board_name">게시판 이름</label></th>
					<td>
						<?php echo $result->row->board_name?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="skin">스킨</label></th>
					<td>
						<?php echo $result->row->skin?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
		

</div>