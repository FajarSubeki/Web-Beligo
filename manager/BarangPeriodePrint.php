<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/mains.css">
  </head>
  <style>
    body{
        overflow-x: hidden;
    }
  </style>
  <body onload="window.print();">
<?php 
include "../config/controller.php";
$qb = new lsp();
        if (!isset($_GET['dateAwal']) || !isset($_GET['dateAkhir'])) {
            header("location:../PageManager.php?page=periode");
        }
        $whereparam = "tanggal_masuk";
        $param      = $_GET['dateAwal'];
        $param1     = $_GET['dateAkhir'];
        $dataB      = $qb->selectBetween("detailbarang",$whereparam,$param,$param1);
 ?>
 <div class="row">
    <div class="col-sm-12" style="padding: 50px;">
    <h3>Data Barang Periode</h3>
    <p>PT Inventory Indonesia</p>
    </div>
 </div>
<div class="row">
    <div class="col-sm-12" style="padding: 50px;">
        <p class="text-right">Dari tanggal:<?php echo $_GET['dateAwal']; ?> Ke:<?php echo $_GET['dateAkhir'] ?></p>
        <table class="table table-striped table-bordered">
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
            if (count(@$dataB) > 0) {
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
                </tr>
            <?php $no++; } ?>
                <tr>
                    <td colspan="5"></td>
                    <td>Jumlah</td>
                    <td>
                        <?php foreach ($dataB['jumlah'] as $datas): ?>
                            <?php echo $datas; ?>
                        <?php endforeach ?>
                </tr>
             <?php }else{ ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada barang di periode ini</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <p>Tanggal cetak : <?= date("Y-m-d"); ?></p>
        </div>
</div>

</body>
</html>