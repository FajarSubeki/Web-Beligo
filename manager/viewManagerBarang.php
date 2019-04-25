<?php 
	$qb = new lsp();
	$dataB = $qb->select("detailbarang");
	if ($_SESSION['level'] != "Manager") {
    header("location:../index.php");
  	}
 ?>
<div class="main-content" style="margin-top: 30px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
            		<div class="card">
            			<div class="card-header">
            				<h3>Semua Barang</h3>
            				<br>
            				<a href="manager/export.php" name="export" class="btn btn-success" target="_blank">Export Excel</a>
        					<a href="manager/databarangfull.php" target="_blank" class="btn btn-info">Print</a>
            			</div>
            			<div class="card-body">
            				<table class="table table-hover table-bordered" id="sampleTable">
								<thead>
				                  <tr>
				                    <th>Kode barang</th>
				                    <th>Nama barang</th>
				                    <th>Merek</th>
				                    <th>Distributor</th>
				                    <th>Tanggal Masuk</th>
				                    <th>Harga</th>
				                    <th>Stok</th>
				                    <th>Action</th>
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
											<td class="text-center">
													<a href="?page=viewBarangDetail&id=<?php echo $ds['kd_barang'] ?>" class="btn btn-warning"><i class="fa fa-search"></i></a>
											</td>
										</tr>
					                  <?php $no++; } ?>
				                </tbody>
            				</table>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>