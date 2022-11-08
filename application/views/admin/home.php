<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('global/header'); ?>
</head>
<body>
	 <!-- WRAPPER -->
	 <div id="wrapper">
		<!-- NAVBAR -->
		<?php $this->load->view('global/navbar'); ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<?php $this->load->view('admin/menu'); ?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Home</h3>
						</div>
						<div class="panel-body">
							
						</div>
					</div>
					<!-- END OVERVIEW -->
				
				
				
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
	<?php $this->load->view('global/footer'); ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<?php $this->load->view('global/js'); ?>
</body>

<!-- Modal -->
<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenterTitle">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<form>
				<div class="form-group">
					<label for="user-name-txt">User Name</label>
					<input type="text" class="form-control" id="user-name-txt" placeholder="Enter User Name">
					
				</div>
				<div class="form-group">
					<label for="user-pass-txt">Password</label>
					<input type="password" class="form-control" id="user-pass-txt" placeholder="Password">
				</div>
				<div class="form-group form-check">
				
					<label class="form-check-label" for="level-user-txt">Level User</label>
					<select class="form-control" id="level-user-txt">
						<option>admin</option>
						<option>purchasing</option>
						<option>warehouse</option>
						<option>manager</option>
					
					</select>
				</div>
			
		</form>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!--=======modal edit user=========-->
<div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CenterTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<form>
				<div class="form-group">
					<label for="user-name-txt">User Name</label>
					<input type="text" class="form-control" id="edit-name-txt" Disabled>
					
				</div>
		
				<div class="form-group form-check">
				
					<label class="form-check-label" for="level-user-txt">Level User</label>
					<select class="form-control" id="edit-level-txt">
						<option>admin</option>
						<option>purchasing</option>
						<option>warehouse</option>
						<option>manager</option>
					
					</select>
				</div>
			
		</form>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-update">Update</button>
      </div>
    </div>
  </div>
</div>
</html>
<script type = "text/javascript">
	$(document).ready( function () {
		var table = $('#table-user').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order" : [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url('admin/datatable_user'); ?>',
                        "type": "POST"
                    },
					columnDefs : [{
						"orderable" : false,
						"data" : null,
    				"defaultContent" : '',
						"className" : 'select-checkbox',
            "targets" :   0,
					
					}],
					select: {
            "style" :    'os',
            "selector" : 'td:first-child'
        	},
                    //Set column definition initialisation properties.
                   "columns": [
											
												{"data": "no"},
                        {"data": "ID_USER"},
                        {"data": "NAMA_USER"},
                        
                        {"data": "LEVEL_USER"},
                    ]
											
                });
	

	table.on("click", "th.select-checkbox", function() {
    if ($("th.select-checkbox").hasClass("selected")) {
        table.rows().deselect();
        $("th.select-checkbox").removeClass("selected");
    } else {
        table.rows().select();
        $("th.select-checkbox").addClass("selected");
    }
}).on("select deselect", function() {
    ("Some selection or deselection going on")
    if (table.rows({
            selected: true
        }).count() !== table.rows().count()) {
        $("th.select-checkbox").removeClass("selected");
    } else {
        $("th.select-checkbox").addClass("selected");
    }
});

	 $("#btn-edit").click(function(){
  	var data = table
            .row({ selected: true })
            .data();
  	if (!data) {
			alert('Select the data !');
		}else{
			$('#edit-name-txt').val(data.NAMA_USER);
			$('#edit-level-txt').val(data.LEVEL_USER);
			$('#modal-edit-user').modal('show');
		}
		});

	

	$('#btn-delete').click(function(){
		var data = table
            .row({ selected: true })
            .data();
		if (!data) {
			alert('Select the data !')
		} else{
			var r = confirm("Are you sure to delete "+data.NAMA_USER+" ?");
			if (r == true) {
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('admin/hapus_user'); ?>",
					data : "id="+data.ID_USER,

					success : function (response) {
						if (response == "success") {
							window.location = '';
						}else{
							alert(response);
						}
					
					}
				});
			}
		}

		
	});

		$('#btn-save').click(function(){
			var user = $('#user-name-txt').val();
			var pass = $('#user-pass-txt').val();
			var level = $('#level-user-txt').val();

			$.ajax({
				type: "POST",
				url: "admin/add_user",
				data: 'user_name='+user+'&pass='+pass+'&level='+level,

				success: function (response) {
					if (response == "success") {
						alert('Data berhasil disimpan');
						window.location.replace("<?php echo base_url('admin'); ?>");
					} else{
						alert(response);
					}
					
				}
			});
		});

		$('#btn-update').click(function(){
			var data = table
            .row({ selected: true })
            .data();
			var id = data.ID_USER;
			var level = $('#edit-level-txt').val();
						$.ajax({
							type : "POST",
							url : "<?php echo base_url('admin/edit_user') ?>",
							data : 'id='+id+'&level='+level,

							success : function(response){
								if (response == 'success') {
									window.location = '';
								}else{
									alert(response);
								}
							}
						});
		});
} );
</script>