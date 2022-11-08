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
							<h3 class="panel-title">Blanko KIA</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="mb-8">
									<button id="btn-add" class="btn btn-success btn-xs edit-modal" data-toggle="modal" data-target="#modal-kia"><i class="fa fa-plus"></i> Tambah</button>
									<button id="btn-edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</button>
									<button id="btn-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
								</div>
								<div class="mb-8 flex flex-left">
									<select id="tahun" class="form-control">
										<option value="2022">2022</option>
									</select>
									<select id="bulan" class="form-control">
										<option value="10">Oktobel</option>
									</select>
								</div>
							</div>

							<div class="row">
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="table-kia">
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Terima</th>
											<th>Terpakai</th>
											<th>Return</th>
											<th>Total Cetak</th>
											<th>Sisa</th>
											<th>Keterangan</th>
										</tr>
									</thead>
									</table>
									</div>
							</div>
							
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

<!--=======modal edit kia=========-->
<div class="modal fade" id="modal-kia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CenterTitle">Form Blanko kia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form>
					<div class="form-group">
						<label for="kia-name-txt">Tanggal</label>
						<input id="tanggal" name="tanggal" type="date" class="form-control">
					</div>
					<div class="form-group">
						<label for="kia-name-txt">Terima</label>
						<input id="terima" type="number" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="kia-name-txt">Terpakai</label>
						<input id="terpakai" type="number" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="kia-name-txt">Return</label>
						<input id="return" type="number" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="kia-name-txt">Total Cetak</label>
						<input id="total_cetak" type="number" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="kia-name-txt">Sisa</label>
						<input id="sisa" type="number" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="kia-name-txt">Keterangan</label>
						<textarea id="keterangan" name="keterangan" class="form-control" rows="4"></textarea>
					</div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save">Simpan</button>
      </div>
    </div>
  </div>
</div>
</html>
<script type = "text/javascript">
	$(document).ready( function () {
		var table = $('#table-kia').DataTable({ 
      "processing": true,
      "serverSide": true,
      "order" : [],
      "ajax": {
          "url": '<?php echo base_url('admin/datatable_blank_kia'); ?>',
          "type": "POST"
      },
			select: {
        "style" :    'os',
        "selector" : 'td:first-child'
    	},      
     "columns": [
					{"data" : "tanggal"},
					{"data" : "terima"},
					{"data" : "terpakai"},
					{"data" : "return"},
					{"data" : "total_cetak"},
					{"data" : "sisa"},
					{"data" : "keterangan"},
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

	$("#btn-add").click(function(){
			$('#tanggal').val('');
			$('#terima').val('');
			$('#terpakai').val('');
			$('#return').val('');
			$('#total_cetak').val('');
			$('#sisa').val('');
			$('#keterangan').val('');
	});

 	$("#btn-edit").click(function(){
		var data = table.row({ selected: true }).data();

		if (!data) {
			alert('Select the data !');
		}else{
			$('#tanggal').val(data.tanggal);
			$('#terima').val(data.terima);
			$('#terpakai').val(data.terpakai);
			$('#return').val(data.return);
			$('#total_cetak').val(data.total_cetak);
			$('#sisa').val(data.sisa);
			$('#keterangan').val(data.keterangan);

			$('#modal-kia').modal('show');
		}
	});

	$('#btn-delete').click(function(){
		var data = table.row({ selected: true }).data();
		if (!data) {
			alert('Select the data !')
		} else{
			var r = confirm("Hapus kia untuk tanggal "+data.tanggal+" ?");
			if (r == true) {
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('admin/hapus_kia'); ?>",
					data : "tanggal="+data.tanggal,

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
		var tanggal 		= $('#tanggal').val();
		var terima 			= $('#terima').val();
		var terpakai 		= $('#terpakai').val();
		var return_ 		= $('#return').val();
		var total_cetak = $('#total_cetak').val();
		var sisa 				= $('#sisa').val();
		var keterangan 	= $('#keterangan').val();

		var data = { tanggal: tanggal, terima: terima, terpakai: terpakai, return: return_, total_cetak: total_cetak, sisa: sisa, keterangan: keterangan };

		$.ajax({
			type: "POST",
			url: "/inventory/admin/add_kia",
			data: data,

			success: function (response) {
				if (response == "success") {
					alert('Data berhasil disimpan');
					window.location.replace("<?php echo base_url('admin'); ?>/blankokia");
					$('#modal-kia').modal('hidden');
				} else{
					alert(response);
				}
				
			}
		});
	});

	

});
</script>