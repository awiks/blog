<script type="text/javascript">

load_data();

function load_data(id='')
{
	$.ajax({
		url: '<?= site_url('home/load_data') ?>',
		type: 'get',
		dataType: 'html',
		data: {id: id,},
		beforeSend: function(){   
      $('.load').css('display', 'flex');
    },
    complete: function(){
	  $('.load').css('display', 'none');
      },
      success :function(data)
      {
        $('#load_more_button').remove();
        $('#post_data').append(data);
      }
	})
	
}


$(document).on('click', '#load_more_button', function(){
  var id = $(this).data('id');
  $('#load_more_button').html('<i class="fa fa-spinner fa-spin default"></i> Loading...');
  load_data(id);
});
</script>