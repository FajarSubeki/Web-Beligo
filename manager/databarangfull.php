<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style>
    body{
     	overflow-x: hidden;
    }
  </style>
  <body onload="" style="padding: 20px;">
  <?php 
  include "../config/controller.php";
  $qb = new lsp();
  $dataB = $qb->select("detailbarang");
  $totbal = $qb->selectSum("detailbarang","stok_barang");
  $total  = $qb->selectCount("detailbarang","kd_barang");
   ?>
<style>
    @media print{
      .btn{
        display: none;
      }
    }
 </style>
<div class="row">
	<div class="col-sm-12">
    <button class="btn" onclick="window.print()">Print</button>
    <h2>Data seluruh barang</h2>
    <p>PT Inventory Indonesia</p>
    <p class="text-right">Tanggal Cetak: <?php echo date("Y-m-d"); ?></p>
			<table border="1" cellspacing="0" width="100%;" cellpadding="20">
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
                <tr>
                	<td colspan="6">Total barang yang di miliki</td>
                	<td><?php echo $totbal['sum']; ?></td>
                </tr>
                <tr>
                	<td colspan="6">Jumlah Model Barang</td>
                	<td><?php echo $total['count']; ?></td>
                </tr>
              </table>
		</div>
</div>

</body>
</html>