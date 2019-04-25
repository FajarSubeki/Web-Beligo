<?php 
	$dt = new lsp();
	$detail = $dt->selectWhere("detailBarang","kd_barang",$_GET['id']);
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
 ?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-4">
            		<div class="card">
            			<div class="card-header">
            				<img class="align-self-center mr-3" width="70" src="img/<?php echo $detail['foto_merek'] ?>" alt="">
            				<h4 class="text-right"><?= $detail['nama_barang'] ?></h4>
            			</div>
            			<div class="card-body">
            				<img style="min-height: 200px; width: 100%; display: block;" src="img/<?php echo $detail['gambar'] ?>">
            			</div>
            		</div>
            	</div>
            	<div class="col-md-8">
            		<div class="card">
            			<div class="card-header">
            				<h3>Detail Barang</h3>
            			</div>
            			<div class="card-body">
            				<table class="table" cellpadding="10">
	    					<tr>
	    						<td>Kode Barang</td>
	    						<td>:</td>
	    						<td style="font-weight: bold; color: red;"><?php echo $detail['kd_barang']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Nama Barang</td>
	    						<td>:</td>
	    						<td><?php echo $detail['nama_barang']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Merek</td>
	    						<td>:</td>
	    						<td><?php echo $detail['merek']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Distributor</td>
	    						<td>:</td>
	    						<td><?php echo $detail['nama_distributor']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Tanggal Masuk</td>
	    						<td>:</td>
	    						<td><?php echo $detail['tanggal_masuk']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Harga</td>
	    						<td>:</td>
	    						<td><?php echo "Rp.".number_format($detail['harga_barang'])."-,"; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Stok</td>
	    						<td>:</td>
	    						<td><?php echo $detail['stok_barang'] ?></td>
	    					</tr>
	    					<tr>
	    						<td>Keterangan</td>
	    						<td>:</td>
	    						<td><?php echo $detail['keterangan'] ?></td>
	    					</tr>
	    				</table>
            			</div>
            		</div>
            	</div>
            </div>
            <a href="?page=viewBarang" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
        </div>
    </div>
</div>