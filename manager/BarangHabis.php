<?php 
	$qb = new lsp();
	$dataB = $qb->edit("detailbarang","stok_barang",0);
	if (isset($_GET['export'])) {
		$dateNow = date("Y-m-d");
		header("Content-type:application/vnd-ms-excel");
		header("Content-Disposition:attachment;filename='$dateNow'-DataBarangHabis.xls");
	}
 ?>
 <style>
 	@media print{
 		.btn{
 			display: none;
 		}
 		.hd{
 			display: none;
 		}
 	}
 </style>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-sm-12" style="background: white; padding: 50px;">
            		<h3>Laporan barang habis</h3>
					<p>PT Inventory Indonesia</p>
					<hr>
					<button class="btn btn-primary"><a href="manager/BarangHabisPrint.php" style="color: white;">Export</a></button>
					<button class="btn btn-info" onclick="window.print()">Print</button>
					<br>
					<br>
					<p class="text-right">Tanggal Cetak : <?= date("Y-m-d"); ?></p>
					<br>
					<table class="table" border="1" cellspacing="0" width="100%;">
		                <thead>
		                  <tr>
		                    <th>Kode barang</th>
		                    <th>Nama barang</th>
		                    <th>Merek</th>
		                    <th>Distributor</th>
		                    <th>Tanggal Masuk</th>
		                    <th>Harga</th>
		                    <th>Stok</th>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $no = 1;
		                  foreach($dataB as $ds){ ?>
							<tr>
								<td><?= $ds['kd_barang'] ?></td>
								<td><?= $ds['nama_barang'] ?></td>
								<td><?= $ds['merek'] ?></td>
								<td><?= $ds['nama_distributor'] ?></td>
								<td><?= $ds['tanggal_masuk'] ?></td>
								<td><?= number_format($ds['harga_barang']) ?></td>
								<td><?= $ds['stok_barang'] ?></td>
		                  <?php $no++; } ?>
		                </tbody>
		              </table>
            	</div>
            </div>
        </div>
    </div>
</div>