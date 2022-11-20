<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cetak Pengajuan</title>
	<style type="text/css">
		.ttd {
			height: 100px;
		}

		.text-center {
			text-align: center;
		}

		.pt-8 {
			padding-top: 0.8rem;
		}

		.pb-4 {
			padding-bottom: 0.4rem;
		}
	</style>
</head>
<body onload="window.print()">
	<!-- <body> -->
	<h4 class="text-center">
		BERITA ACARA PEMINDAHAN/PENYERAHAN DOKUMEN TIDAK VALID<br/>
		SUKU DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA<br/>
		ADMINISTRASI JAKARTA SELATAN<br/>
		KECAMATAN TEBET<br/>
	</h4>
	<hr/>
	<div class="text-center">
		<b>NOMOR : <?= $data->nomor ?></b>
	</div>
	<p>
		Pada hari <?= $tanggal ?>, kami yang bertanda tangan dibawah ini :
	</p>
	<table style="width: 100%;">
		<tr>
			<td>I.</td>
			<td>Nama</td>
			<td>:</td>
			<td><?= $data->pihak_1_nama ?></td>
		</tr>
		<tr>
			<td></td>
			<td>NIP</td>
			<td>:</td>
			<td><?= $data->pihak_1_nip ?></td>
		</tr>
		<tr>
			<td></td>
			<td>Jabatan</td>
			<td>:</td>
			<td><?= $data->pihak_1_jabatan ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="3" class="pt-8 pb-4">Selanjutnya disebutkan Pihak Pertama</td>
		</tr>

		<tr>
			<td>II.</td>
			<td>Nama</td>
			<td>:</td>
			<td><?= $data->pihak_2_nama ?></td>
		</tr>
		<tr>
			<td></td>
			<td>NIP</td>
			<td>:</td>
			<td><?= $data->pihak_2_nip ?></td>
		</tr>
		<tr>
			<td></td>
			<td>Jabatan</td>
			<td>:</td>
			<td><?= $data->pihak_2_jabatan ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="3" class="pt-8 pb-4">Selanjutnya disebutkan Pihak Kedua</td>
		</tr>
	</table>

	<p>
		Penyerahan Retur Blanko Murni dari Kepala/Pengadministrasi Satuan Pelaksana  Pelayanan Dukcapil Kelurahan Tebet Timur Kecamatan Tebet ke Sudin Dukcapil Kota Jakarta Selatan, dengan rincian sebagai berikut :
	</p>
	
	<table style="width: 100%;">
		<tr>
			<td>1</td>
			<td>Blanko Murni Dokumen KTP-el sebanyak</td>
			<td>( <?= $data->jumlah_ktp ?> Dokumen )</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Blanko Murni Dokumen KIA sebanyak</td>
			<td>( <?= $data->jumlah_kia ?> Dokumen )</td>
		</tr>
	</table>

	<p>Dengan di tandatanganinya Berita Acara ini, maka tugas, wewenang, dan tanggung jawab penyimpanan Retur Blanko Murni dimaksud berpindah dari PIHAK PERTAMA ke PIHAK KEDUA.</p>
	<p>Berita Acara ini dibuat dalam rangkap 2 ( dua )  masing-masing diperuntukan dai PIHAK PERTAMA ke PIHAK KEDUA.</p>

	<table style="width: 100%; text-align: center;">
		<tr>
			<td>
				PIHAK KEDUA<br/>
				Yang menerima<br/>
				a.n. Ka. Sudin Dukcapil<br/>
				Kota Administrasi Jakarta Selatan<br/>
				Pengurus Barang,<br/>
			</td>
			<td>
				PIHAK PERTAMA<br/>
				Yang memindahkan<br/>
				Plh. Kepala/Pengadministrasi Satuan Pelaksana<br/>
				Pelayanan Dukcapil Kelurahan<br/>
				Tebet Timur<br/>
			</td>
		</tr>
		<tr>
			<td class="ttd"></td>
			<td class="ttd"></td>
		</tr>
		<tr>
			<td>
				<?= $data->pihak_2_nama ?><br/>
				NIP. <?= $data->pihak_2_nip ?><br/>
			</td>
			<td>
				<?= $data->pihak_1_nama ?><br/>
				NIP. <?= $data->pihak_1_nip ?><br/>
			</td>
		</tr>
	</table>
</body>
</html>