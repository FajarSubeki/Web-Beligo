<?php 
      $trs = new lsp();
      $dataTransaksi = $trs->select("transaksi_terbaru");
      if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $dataDetail = $trs->edit("detailTransaksi","kd_transaksi",$id);
            $total  = $trs->selectSumWhere("transaksi","sub_total","kd_transaksi='$id'");
            $jumlah_barang = $trs->selectSumWhere("transaksi","jumlah","kd_transaksi='$id'");
      }
?>
<style>
      .col-sm-12{
            background: white;
            padding: 20px;
      }
      @media print{
            table{
                  align-content: center;
            }
            .btn{display: none !important;}
            .ds{
                  display: none;
            }
            .cari{
                  display: none !important;
                  box-shadow: none !important;
            }
            hr{
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
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                  <div class="card cari">
                        <div class="card-header">
                              <h4>Cari Transaksi</h4>
                        </div>
                        <div class="card-body">
                              <form method="post">
                              <div class="form-group">
                                    <a class="btn btn-primary btn-block" href="#fajarmodal" data-toggle="modal">Pilih Barang</a>
                              </div>
                              <?php if (isset($_GET['id'])): ?>  
                              <a href="?page=kelTransaksi" class="btn btn-danger btn-block"><i class="fa fa-repeat"></i> Reload</a>
                              <?php endif ?>
                        </form>
                        </div>
                  </div>
            </div>
            <div class="col-sm-3"></div>
            </div>
            <div class="row">
                  <div class="col-sm-12">
                  <!-- <div class="tile"> -->
                        <?php if (isset($_GET['id'])): ?>
                        <h4>Struk</h4>
                        <p>PT Inventory indonesia</p>
                        <hr>
                        <div class="row">
                              <div class="col-sm-6">Kode Transaksi : <?php echo $id ?></div>
                              <div class="col-sm-6">
                                    <p class="text-right"><span><?php echo "Tanggal Cetak : ".date("Y-m-d"); ?></p>
                              </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered" width="80%">
                              <tr>
                                    <td>Kode Antrian</td>
                                    <td>Nama Barang</td>
                                    <td>Harga Satuan</td>
                                    <td>Jumlah</td>
                                    <td>Sub Total</td>
                              </tr>
                              <?php foreach ($dataDetail as $dd): ?>
                              <tr>
                                    <td><?= $dd['kd_pretransaksi'] ?></td>
                                    <td><?= $dd['nama_barang'] ?></td>
                                    <td><?= $dd['harga_barang'] ?></td>
                                    <td><?= $dd['jumlah'] ?></td>
                                    <td><?= "Rp.".number_format($dd['sub_total']).",-" ?></td>
                              </tr>
                              <?php endforeach ?>
                              <tr>
                                    <td colspan="2"></td>
                                    <td>Jumlah Pembelian Barang</td>
                                    <td><?php echo $jumlah_barang['sum'] ?></td>
                                    <td></td>
                              </tr>
                              <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Total</td>
                                    <td><?php echo "Rp.".number_format($total['sum']).",-" ?></td>
                              </tr>
                        </table>
                        <br>
                        <p>Tanggal Beli : <?php echo $dd['tanggal_beli']; ?></p>
                        <br>
                        <a href="#" class="btn btn-primary" onclick="window.print();">Print</a>
                        <?php endif ?>
                        <?php if (!isset($_GET['id'])): ?>
                        <h4>Data Semua Transaksi</h4>
                        <p>PT Inventory Indonesia</p>
                        <hr>
                        <p class="text-right"><?php echo "Tanggal Cetak : ".date("Y-m-d"); ?></p>
                        <br>
                        <table class="table table-hover table-bordered" width="100%;" align="center">
                                    <thead>
                                          <tr>
                                                <td>Kode Transaksi</td>
                                                <td>Nama Penjual</td>
                                                <td>Jumlah Beli</td>
                                                <td>Total Harga</td>
                                                <td>Tanggal Beli</td>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php foreach ($dataTransaksi as $dts): ?>
                                                <tr>
                                                      <td><?= $dts['kd_transaksi'] ?></td>
                                                      <td><?= $dts['nama_user'] ?></td>
                                                      <td><?= $dts['jumlah_beli'] ?></td>
                                                      <td><?= "Rp.".number_format($dts['total_harga']).",-" ?></td>
                                                      <td><?= $dts['tanggal_beli'] ?></td>
                                                </tr>
                                          <?php endforeach ?>
                                                <?php 
                                                $grand = $trs->selectSum("transaksi","sub_total");
                                                 ?>
                                                 <tr>
                                                      <td colspan="2"></td>
                                                      <td>Grand Total</td>
                                                      <td><?php echo "Rp.".number_format($grand['sum']).",-" ?></td>
                                                      <td></td>
                                                 </tr>

                                    </tbody>
                              </table>
                              <br>
                                    <a href="#" class="btn btn-primary" onclick="window.print();">Print</a>
                        <?php endif ?>
                  <!-- </div> -->
            </div>
            
            </div>
      </div>
      
      </div>
</div>

<div class="modal fade" id="fajarmodal" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h3>Pilih Transaksi</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                        <table class="table table-hover table-bordered" id="sampleTable" width="100%;" align="center">
                        <thead>
                              <tr>
                                    <td>Kode Transaksi</td>
                                    <td>Nama Penjual</td>
                                    <td>Jumlah Beli</td>
                                    <td>Total Harga</td>
                                    <td>Tanggal Beli</td>
                              </tr>
                        </thead>
                        <tbody>
                              <?php foreach ($dataTransaksi as $dts): ?>
                                    <tr>
                                          <td><a href="?page=kelTransaksi&id=<?= $dts['kd_transaksi']; ?>"><?= $dts['kd_transaksi'] ?></a></td>
                                          <td><?= $dts['nama_user'] ?></td>
                                          <td><?= $dts['jumlah_beli'] ?></td>
                                          <td><?= $dts['total_harga'] ?></td>
                                          <td><?= $dts['tanggal_beli'] ?></td>
                                    </tr>
                              <?php endforeach ?>
                        </tbody>
                  </table>
                  </div>
            </div>
      </div>
</div>