<script type="text/javascript">

	function tampildata()
	{
		$("#myTable").DataTable({
	        "processing": true,
	        "serverSide": false,
	        "ajax" :{
	          url : "<?= site_url('cpanel/master-data/kategori/ajax') ?>",
	          type: "POST",
	          dataType: "json",
	        },
	        "columns" : [{ "data" : "nomor" }, 
	                     { "data" : "images" }, 
                       { "data" : "categorys_name" }, 
	                     { "data" : "slug" }, 
	                     { "data" : "created_at" }, 
	                     { "data" : "aksi" }],
	          //Set column definition initialisation properties
	          "columnDefs": [{ 
	            "targets": [0],
	            "orderable": false
	          }]
	      });
	}

	tampildata();

	$('body').on('click', '.add', function(event) {
	    event.preventDefault();
	    /* Act on the event */

	    $.ajax({
	      url: '<?= site_url('cpanel/master-data/kategori/modal-add') ?>',
	      type: 'post',
	      dataType: 'html',
	      beforeSend: function(){   
	        $(".load-add").css('display','block');
	      },
	      complete: function(){
	        $(".load-add").css('display','none');
	      },
	      success : function(data){
	        $('.modal-add').html(data);
	      }
	    })
	});

	$('body').on('submit', '#simpan', function(event) {
      event.preventDefault();
      /* Act on the event */

      $.ajax({
        url: '<?= site_url('cpanel/master-data/kategori/simpan') ?>',
        type: 'post',
        dataType: 'html',
        data: new FormData(this),
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function(){   
          $('.btn_add').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
        },
        complete: function(){
          $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
        },
        success : function(data)
        {
          if(data=='oke')
          {
            $('#myTable').DataTable().destroy();
            tampildata();

            $('#Modal-add .close').click();
            toastr.success('Data berhasil disimpan');
          }
          else if(data == 'filed'){
            toastr.warning('Maaf tipe file yang anda masukan salah');
          }
          else
          {
            toastr.error('Data gagal disimpan');
          }
        }
      })
  });

// EDIT DATA
$('body').on('click', '.edit', function(event) {
  event.preventDefault();
  /* Act on the event */
    
    var id = $(this).attr('id');

    $.ajax({
      url: '<?= site_url('cpanel/master-data/kategori/modal-edit') ?>',
      type: 'post',
      dataType: 'html',
      data: {id: id,},
      beforeSend: function(){   
       $(".load-edit").css('display','block');
      },
      complete: function(){
       $(".load-edit").css('display','none');
      },
      success : function(data){
        $('.modal-edit').html(data);
      }
    })
});

 $('body').on('submit', '#perbarui', function(event) {
    event.preventDefault();
    /* Act on the event */

    $.ajax({
      url: '<?= site_url('cpanel/master-data/kategori/perbarui') ?>',
      type: 'post',
      dataType: 'html',
      data: new FormData(this),
      contentType: false,       
      cache: false,             
      processData:false,
      beforeSend: function(){   
        $('.btn_edit').html('<i class="fa fa-spinner fa-spin default"></i> Menyimpan...');
      },
      complete: function(){
        $('.btn_edit').html('<i class="fa fa-check"></i> Perbarui');
      },
      success : function(data)
      {

        if(data=='oke')
        {
          $('#myTable').DataTable().destroy();
          tampildata();

          $('#Modal-edit .close').click();
          toastr.success('Data berhasil diperbarui');
        }
        else if(data == 'filed'){
          toastr.warning('Maaf tipe file yang anda masukan salah');
        }
        else
        {
          toastr.error('Data gagal diperbarui');
        }
      }
    })
  });

  // MODAL HAPUS 
  $('body').on('click', '.delete', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    $.ajax({
      url: '<?= base_url('cpanel/master-data/kategori/delete') ?>',
      type: 'post',
      dataType: 'html',
      data: {id:id,},
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
        url: '<?= base_url('cpanel/master-data/kategori/hapus') ?>',
        type: 'post',
        dataType: 'html',
        data: {id:id,},
        beforeSend: function(){   
          $('.hapus_data').html('<i class="fa fa-spinner fa-spin default"></i> Deleting..');
        },
        complete: function(){
          $('.hapus_data').html('<i class="fa fa-trash"></i> Hapus');
        },
        success :function (data){
          if(data=='oke')
          {
            $('#myTable').DataTable().destroy();
            tampildata();

            $('#Modal-del .close').click();
            toastr.success('Data berhasil dihapus');
          }
          else
          {
            toastr.error('Data gagal dihapus');
          }
        }
    })

  });

</script>