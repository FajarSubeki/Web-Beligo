<?php 
	$br = new lsp();
	if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
  	}
	$table    = "table_barang";
	$data     = $br->selectWhere($table,"kd_barang",$_GET['id']);
	$getMerek = $br->select("table_merek");
	$getDistr = $br->select("table_distributor");
	$waktu    = date("Y-m-d");
	if (isset($_POST['getSimpan'])) {
		$kode_barang  = $br->validateHtml($_POST['kode_barang']);
		$nama_barang  = $br->validateHtml($_POST['nama_barang']);
		$merek_barang = $br->validateHtml($_POST['merek_barang']);
		$distributor  = $br->validateHtml($_POST['distributor']);
		$harga        = $br->validateHtml($_POST['harga']);
		$stok         = $br->validateHtml($_POST['stok']);
		$ket          = $_POST['ket'];

		if ($kode_barang == " " || $nama_barang == " " || $merek_barang == " " || $distributor == " " || $harga == " " || $stok == " " || $ket == " " ) {
			$response = ['response'=>'negative','alert'=>'lengkapi field'];
		}else{
			if ($harga < 0 || $stok < 0) {
			 	$response = ['response'=>'negative','alert'=>'harga atau stok tidak boleh mines'];
			}else{
				if ($_FILES['foto']['name'] == "") {
					$value = "kd_barang='$kode_barang',nama_barang='$nama_barang',kd_merek='$merek_barang',kd_distributor='$distributor',tanggal_masuk='$waktu',harga_barang='$harga',stok_barang='$stok',keterangan='$ket'";
					$response = $br->update($table,$value,"kd_barang",$_GET['id'],"?page=viewBarang");
				}else{
					$response = $br->validateImage();
					if ($response['types'] == "true") {
						$value = "kd_barang='$kode_barang',nama_barang='$nama_barang',kd_merek='$merek_barang',kd_distributor='$distributor',tanggal_masuk='$waktu',harga_barang='$harga',stok_barang='$stok',keterangan='$ket',gambar='$response[image]'";
						$response = $br->update($table,$value,"kd_barang",$_GET['id'],"?page=viewBarang");
					}else{
						$response = ['response'=>'negative','alert'=>'gambar error'];
					}
				}
			} 
		}
	}
 ?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
            		<form method="post" enctype="multipart/form-data">
            			<div class="card">
            				<div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
	                            <div class="bg-overlay bg-overlay--blue"></div>
	                            <h3>
	                            <i class="zmdi zmdi-account-calendar"></i>Data Barang</h3>
                        	</div>
                        	<div class="card-body">
                        		<div class="col-12">
                        			<div class="row">
                        				<div class="col-md-6">
                        					<div class="form-group">
												<label for="">Kode barang</label>
												<input type="text" class="form-control" name="kode_barang" value="<?php echo $data['kd_barang']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="">Nama barang</label>
												<input type="text" class="form-control" name="nama_barang" value="<?php echo @$data['nama_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Merek</label>
												<select name="merek_barang" class="form-control">
													<option value=" ">Pilih merek</option>
													<?php foreach($getMerek as $mr) { ?>
													<?php if ($mr['kd_merek'] == $data['kd_merek']){ ?>
														<option value="<?= $mr['kd_merek'] ?>" selected><?= $mr['merek'] ?></option>
													<?php }else{ ?>
													<option value="<?= $mr['kd_merek'] ?>"><?= $mr['merek'] ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label for="">Distributor</label>
												<select name="distributor" class="form-control">
													<option value=" ">Pilih distributor</option>
													<?php foreach($getDistr as $dr) { ?>
													<?php if ($dr['kd_distributor'] == $data['kd_distributor']){ ?>
													<option value="<?= $dr['kd_distributor'] ?>" selected><?= $dr['nama_distributor'] ?></option>
													<?php }else{ ?>
													<option value="<?= $dr['kd_distributor'] ?>"><?= $dr['nama_distributor'] ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Harga barang</label>
												<input type="number" class="form-control" name="harga" value="<?php echo $data['harga_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Stok barang</label>
												<input type="number" class="form-control" name="stok" value="<?php echo $data['stok_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Keterangan</label>
												<input type="text" class="form-control" name="ket" value="<?php echo $data['keterangan'] ?>">
											</div>
											<div class="form-group" id="fotoF">
												<label for="">Foto</label>
												<div class="row">
													<div class="col-6">
														<input type="file" name="foto" id="gambar" class="form-control-file">
													</div>
													<div class="col-6">
														<div>
					                                        <img style="margin-top: -20px;" alt="" src="img/<?= $data['gambar'] ?>" width="120" class="img-responsive" id="pict">
					                                    </div>
													</div>
												</div>
											</div>
										</div>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="card-footer">
                        		<button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
                        		<a href="?page=viewBarang" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
                        	</div>
            			</div>
            		</form>
            	</div>
            </div>
        </div>
    </div>
</div>