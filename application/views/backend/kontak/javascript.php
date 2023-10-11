<script type="text/javascript">

	function tampildata()
	{
		$("#myTable").DataTable({
	        "processing": true,
	        "serverSide": false,
	        "ajax" :{
	          url : "<?= site_url('cpanel/kontak/ajax') ?>",
	          type: "POST",
	          dataType: "json",
	        },
	        "columns" : [{ "data" : "nomor" }, 
	                     { "data" : "name" }, 
	                     { "data" : "email" }, 
	                     { "data" : "phone" }, 
	                     { "data" : "read" }, 
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

</script>