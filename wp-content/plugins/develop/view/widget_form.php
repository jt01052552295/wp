<br>
애니메이션 지속 시간 : <input type='text' size='3' id='<?php echo $this->get_field_id('animate_sec');?>' name='<?php echo $this->get_field_name('animate_sec');?>' value='<?php echo $animate_sec;?>' > 초<br><br>
애니메이션 설정 : <input type='checkbox' id='<?php echo $this->get_field_id('animate_setted')?>' name='<?php echo $this->get_field_name('animate_setted');?>' <?php if($animate_setted == 'on') echo 'checked' ?> ><br>
<em>체크하면 위젯의 애니메이션 효과가 추가됩니다!</em>
<br><br>