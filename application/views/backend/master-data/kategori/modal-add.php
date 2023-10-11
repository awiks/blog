<form id="simpan" enctype="multipart/form-data">
  <div class="form-group">
      <label>Kategori</label>
      <input type="text" 
             name="categorys_name" 
             class="form-control" required>
  </div>

  <div class="form-group">
    <label>Image</label>
    <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="images" required>
          <label class="custom-file-label">
          Choose file only JPG | PNG | JPEG | SVG
          </label>
        </div>
    </div>
  </div>

 <div class="modal-footer mt-2" style="margin:-15px">
	<button type="button" 
	        class="btn btn-info" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn bg-maroon btn_add">
	        <i class="fa fa-check"></i> Simpan
	</button>
  </div>
</form>

<script type="text/javascript" charset="utf-8" async defer>
	$('#simpan').validate({
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

	bsCustomFileInput.init();
</script>