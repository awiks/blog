<form id="perbarui">
	<input type="hidden" name="id" value="<?= sha1($edit->id) ?>">
  <div class="form-group">
      <label>Nama</label>
      <input type="text" 
             name="name"
             value="<?= $edit->name ?>" 
             class="form-control" required>
  </div>
  <div class="form-group">
  	<label>is Active</label>
  	<select name="active" class="form-control" required>
  		<option value="">-- Pilih --</option>
  		<option value="1" <?php if($edit->active == '1'): echo 'selected'; endif; ?>>Aktif</option>
  		<option value="2" <?php if($edit->active == '2'): echo 'selected'; endif; ?>>Non aktif</option>
  	</select>
  </div>

 <div class="modal-footer mt-2" style="margin:-15px">
	<button type="button" 
	        class="btn btn-info" 
	        data-dismiss="modal">
	        <i class="fa fa-undo"></i> Batal
	</button>
	<button type="submit" 
	        class="btn bg-maroon btn_edit">
	        <i class="fa fa-check"></i> Perbarui
	</button>
  </div>
</form>

<script type="text/javascript" charset="utf-8" async defer>
	$('#perbarui').validate({
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
</script>