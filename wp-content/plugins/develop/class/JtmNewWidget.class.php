<?php
class JtmNewWidget extends WP_Widget{


	public function __construct(){
		parent::__construct('jtm_widget_1', 'My New Widget Title', array('description'=>'위젯소개글 입니다.'));
	}

	public function form($instance){
		if(isset($instance['animate_sec'])) $animate_sec = $instance['animate_sec'];
		if(isset($instance['animate_setted'])) $animate_setted = $instance['animate_setted'];
?>
			<br>
			애니메이션 지속 시간 : <input type='text' size='3' id='<?php echo $this->get_field_id('animate_sec');?>' name='<?php echo $this->get_field_name('animate_sec');?>' value='<?php echo $animate_sec;?>' > 초<br><br>
			애니메이션 설정 : <input type='checkbox' id='<?php echo $this->get_field_id('animate_setted')?>' name='<?php echo $this->get_field_name('animate_setted');?>' <?php if($animate_setted == 'on') echo 'checked' ?> ><br>
			<em>체크하면 위젯의 애니메이션 효과가 추가됩니다!</em>
			<br><br>


<?php
	}

	public function update ($new_instance, $old_instance){
		// $new_instance : 위젯 설정 페이지에서 저장된 새로운 데이터값입니다.
		// $old_instance : 현재 저장된 설정 이전에 저장된 데이터값입니다.

		$instance = array();
		$instance['animate_sec'] 	= $new_instance['animate_sec'];
		$instance['animate_setted'] = $new_instance['animate_setted'];
		return $new_instance;
	}

	public function widget($args, $instance){
		// echo '<pre>'; print_r($instance); echo '</pre>';
?>
		<aside id='lcp_knowbaseWidget' style='margin-bottom:2em'>
			<div class='row'>
				<h1 class="widget-title">값불러오기</h1>
				<div class='col-xs-12'>
					<code><?php echo $instance['animate_sec'] .", ".$instance['animate_setted'] ?> </code>
				</div>
			</div>

		</aside>


<?php
	}




}
?>