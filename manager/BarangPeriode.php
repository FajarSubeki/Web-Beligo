<?php 
	$qb = new lsp();

	if (isset($_POST['btnSearch'])) {
		$whereparam = "tanggal_masuk";
		$param      = $_POST['dateAwal'];
		$param1     = $_POST['dateAkhir'];
		$dataB      = $qb->selectBetween("detailbarang",$whereparam,$param,$param1);
	}
?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
            		<div class="card">
            			<form method="post">
            				<div class="card-header">
            					<h3>Periode</h3>
            				</div>
            				<div class="card-body">
            					<div class="row">
            						<div class="col-sm-4">
										<label for="#">Dari Tanggal</label>
										<input value="<?= $_POST['dateAwal'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAwal" required>	
									</div>
									<div class="col-sm-4">
										<label for="#">Ke Tanggal</label>
										<input value="<?= $_POST['dateAkhir'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAkhir" required>	
									</div>
            					</div>
            					<br>
            					<button class="btn btn-primary" name="btnSearch"><i class="fa fa-search"></i> Search</button>
								<a href="?page=periode" class="btn btn-danger">Reload</a>
								<br><br>
								<?php if (isset($_POST['dateAwal'])): ?>
									<a  target="_blank" href="manager/BarangPeriodePrint.php?dateAwal=<?php echo $param ?>&dateAkhir=<?php echo $param1 ?>"  class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
								<?php endif ?>
								<br><br>
								<table class="table table-striped table-hover table-bordered">
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
							        if (count(@$dataB['data']) > 0) {
							            $no = 1;
							            foreach(@$dataB['data'] as $ds){ ?>
										<tr>
											<td><?= $ds['kd_barang'] ?></td>
											<td><?= $ds['nama_barang'] ?></td>
											<td><?= $ds['merek'] ?></td>
											<td><?= $ds['nama_distributor'] ?></td>
											<td><?= $ds['tanggal_masuk'] ?></td>
											<td><?= number_format($ds['harga_barang']) ?></td>
											<td><?= $ds['stok_barang'] ?></td>
							        <?php $no++; } ?>
							        <?php }else{ ?>
							        	<tr>
							        		<td colspan="7" class="text-center">Tidak ada data</td>
							        	</tr>
							        <?php } ?>
							        </tbody>
								</table>
            				</div>
            			</form>
            		</div>
            	</div>		
            </div>
        </div>
    </div>
</div>