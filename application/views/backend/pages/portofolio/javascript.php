<script type="text/javascript">

  bsCustomFileInput.init();
 
    // Summernote
    $('.textarea').summernote({
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['style', ['style']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['height', ['height']],
        ['view', ['fullscreen', 'codeview','help']],
      ],

      tabsize: 2,
      height: 300
    });

    $('#simpan').validate({
      ignore: ".note-codable *",
    errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
  });

   // MODAL HAPUS 
  $('body').on('click', '.delete', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    $.ajax({
      url: '<?= base_url('cpanel/pages/portofolio/delete') ?>',
      type: 'post',
      dataType: 'html',
      data: {id:id},
      beforeSend: function(){   
        $(".load-del").css('display','block');
      },
      complete: function(){
        $(".load-del").css('display','none');
      },
      success :function (data){
        $('.modal-del').html(data);
      }
    })
  });

 //HAPUS DATA 
 $('body').on('click', '.hapus_data', function(event) {
   event.preventDefault();
   /* Act on the event */

    var id = $('.del').attr('id');
  
    $.ajax({
        url: '<?= base_url('cpanel/pages/portofolio/hapus') ?>',
        type: 'post',
        dataType: 'html',
        data: {id:id},
        beforeSend: function(){   
          $('.hapus_data').html('<i class="fa fa-spinner fa-spin default"></i> Deleting..');
        },
        complete: function(){
          $('.hapus_data').html('<i class="fa fa-trash"></i> Hapus');
        },
        success :function (data){
      location.reload();
        }
    })

});

</script>

<?php if ( $this->session->flashdata('success')): ?>
<script type="text/javascript" charset="utf-8" async defer>
  
  $(function() {

    toastr.success('<?= $this->session->flashdata('success'); ?>')

  });
</script>
<?php endif ?>

<?php if ( $this->session->flashdata('error')): ?>
<script type="text/javascript" charset="utf-8" async defer>
  
  $(function() {

   toastr.error('<?= $this->session->flashdata('error'); ?>')
   
  });
</script>
<?php endif ?>

<?php if ( $this->session->flashdata('warning')): ?>
<script type="text/javascript" charset="utf-8" async defer>
  
  $(function() {
  
  toastr.warning('<?= $this->session->flashdata('warning'); ?>')
   
  });
</script>
<?php endif ?>