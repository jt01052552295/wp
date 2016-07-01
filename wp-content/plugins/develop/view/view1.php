<div><?php echo $result->row->uid ?></div>
<div><?php echo $result->row->board_name ?></div>
<div><?php echo $result->row->created ?></div>

<div id="result">
결과:
</div>
<div> <button id="click">클릭</button> <div>

<script>
 $(document).ready(function(){
 	$('#click').on('click', function(){
 		var data={'action':'jtmplug_post', 'uid':'100'};

 		$.ajax({
            url: hwangcAjax.ajaxurl,
            type: "POST",
            data: data,
            success: function(response) {
                console.log(response);
            }
        });

 	});
 });
</script>