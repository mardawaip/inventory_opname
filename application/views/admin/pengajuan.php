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
							<h3 class="panel-title">Blanko pengajuan</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="mb-8">
									<button id="btn-add" class="btn btn-success btn-xs edit-modal" data-toggle="modal" data-target="#modal-pengajuan"><i class="fa fa-plus"></i> Tambah</button>
									<button id="btn-edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</button>
									<button id="btn-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
									<button id="btn-cetak" class="btn btn-danger btn-xs"><i class="fa fa-print"></i> Cetak</button>
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
									<table class="table table-striped table-bordered table-hover" id="table-pengajuan">
										<thead>
											<tr>
												<th>Tanggal</th>
												<th>Nomor</th>
												<th>Pihak 1</th>
												<th>Pihak 2</th>
												<th>Jumlah KTP</th>
												<th>Jumlah KIA</th>
												<th>Status Pengajuan</th>												
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

<!--=======modal edit pengajuan=========-->
<div class="modal fade" id="modal-pengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="CenterTitle">Form Blanko pengajuan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="pengajuan-name-txt">Tanggal</label>
						<input id="tanggal" name="tanggal" type="date" class="form-control">
					</div>
					<div class="form-group">
						<label for="pengajuan-name-txt">Nomor</label>
						<input id="nomor" type="text" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="pengajuan-name-txt">Pihak 1</label>
						<select id="pihak_1" name="pihak_1" class="form-control">
							<?php
								foreach ($atasan_1 as $key) {
									$value = $key->atasan_id;
									$label = $key->nama;
									echo "<option value=$value>$label</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="pengajuan-name-txt">Pihak 2</label>
						<select id="pihak_2" name="pihak_2" class="form-control">
							<?php
								foreach ($atasan_2 as $key) {
									$value = $key->atasan_id;
									$label = $key->nama;
									echo "<option value=$value>$label</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="pengajuan-name-txt">Jumlah KTP</label>
						<input id="jumlah_ktp" type="number" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="pengajuan-name-txt">Jumlah KIA</label>
						<input id="jumlah_kia" type="number" class="form-control" value="0">
					</div>
					<div class="form-group">
						<label for="pengajuan-name-txt">Status Pengajuan</label>
						<select id="status_pengajuan" name="status_pengajuan" class="form-control">
							<?php
								foreach ($status_pengajuan as $key) {
									$value = $key->status_pengajuan_id;
									$label = $key->nama;
									echo "<option value=$value>$label</option>";
								}
							?>
						</select>
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
		var table = $('#table-pengajuan').DataTable({ 
			"processing": true,
			"serverSide": true,
			"order" : [],
			"ajax": {
				"url": '<?php echo base_url('admin/datatable_blank_pengajuan'); ?>',
				"type": "POST"
			},
			select: {
				"style" :    'os',
				"selector" : 'td:first-child'
			},      
			"columns": [
				{"data" : "tanggal"},
				{"data" : "nomor"},
				{"data" : "pihak_1"},
				{"data" : "pihak_2"},
				{"data" : "jumlah_ktp"},
				{"data" : "jumlah_kia"},
				{"data" : "status_pengajuan"},
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
			$('#nomor').val('');
			$('#pihak_1').val('');
			$('#pihak_2').val('');
			$('#jumlah_ktp').val('');
			$('#jumlah_kia').val('');
			$('#status_pengajuan').val('');
		});

		$("#btn-edit").click(function(){
			var data = table.row({ selected: true }).data();

			if (!data) {
				alert('Select the data !');
			}else{
				$('#tanggal').val(data.tanggal);
				$('#nomor').val(data.nomor);
				$('#pihak_1').val(data.pihak_1);
				$('#pihak_2').val(data.pihak_2);
				$('#jumlah_ktp').val(data.jumlah_ktp);
				$('#jumlah_kia').val(data.jumlah_kia);
				$('#status_pengajuan').val(data.status_pengajuan);

				$('#modal-pengajuan').modal('show');
			}
		});

		$("#btn-cetak").click(function(){
			var data = table.row({ selected: true }).data();
			if (!data) {
				alert('Select the data !');
			}else{
				window.open(`http://localhost/inventory_opname/admin/pengajuan_cetak?id=${data.pengajuan_id}`);
			}
		});

		$('#btn-delete').click(function(){
			var data = table.row({ selected: true }).data();
			if (!data) {
				alert('Select the data !')
			} else{
				var r = confirm("Hapus pengajuan untuk tanggal "+data.tanggal+" ?");
				if (r == true) {
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('admin/hapus_pengajuan'); ?>",
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
			var tanggal = $('#tanggal').val();
			var nomor = $('#nomor').val();
			var pihak_1 = $('#pihak_1').val();
			var pihak_2 = $('#pihak_2').val();
			var jumlah_ktp = $('#jumlah_ktp').val();
			var jumlah_kia = $('#jumlah_kia').val();
			var status_pengajuan = $('#status_pengajuan').val();

			var data = {
				tanggal: tanggal,
				nomor: nomor,
				pihak_1: pihak_1,
				pihak_2: pihak_2,
				jumlah_ktp: jumlah_ktp,
				jumlah_kia: jumlah_kia,
				status_pengajuan: status_pengajuan,
			};

			$.ajax({
				type: "POST",
				url: "/inventory/admin/add_pengajuan",
				data: data,

				success: function (response) {
					if (response == "success") {
						alert('Data berhasil disimpan');
						window.location.replace("<?php echo base_url('admin'); ?>/pengajuan");
						$('#modal-pengajuan').modal('hidden');
					} else{
						alert(response);
					}
					
				}
			});
		});

		

	});
</script>