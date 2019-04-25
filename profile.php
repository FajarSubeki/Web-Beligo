<?php 
	$my   = new lsp();
	$auth = $my->selectWhere("table_user","username",$_SESSION['username']);

	if (isset($_POST['btnUpdate'])) {
		$nama = $my->validateHtml($_POST['nama']);

		if ($_FILES['foto']['name'] == "") {
			$values    = "nama_user='$nama'";
			$response = $my->update("table_user",$values,"username",$_SESSION['username'],"?page=profile");
		}else{
			$response = $my->validateImage();
			if($response['types'] == "true"){
				$value = "nama_user='$nama', foto_user='$response[image]'";
				$response = $my->update("table_user", $value, "username", $_SESSION['username'], "?page=profile");
			}
		}
	}

	if (isset($_POST['ubahPassword'])) {
		$password     = $_POST['password'];
		$passwordbaru = $_POST['passwordbaru'];
		$confirm      = $_POST['confirm'];

		$sql = "SELECT username,password FROM table_user WHERE username = '$_SESSION[username]'";
		$exec = mysqli_query($con,$sql);
		$asso = mysqli_fetch_assoc($exec);
		if (mysqli_num_rows($exec) > 0) {
			if (base64_decode($asso['password']) == $password) {
				if (strlen($passwordbaru) < 6) {
				$response = ['response'=>'negative','alert'=>'Password minimal 6 digit'];
				}else{
					if ($passwordbaru == $confirm) {
						$passwordbaru = base64_encode($passwordbaru);
						$value    = "password='$passwordbaru'";
						$response = $my->update("table_user",$value,"username",$_SESSION['username'],"?page=profile");
					}else{
						$response = ['response'=>'negative','alert'=>'Password Berbeda'];
					}
				}
			}else{
				$response = ['response'=>'negative','alert'=>'Password lama tidak benar'];
			}
		}
	}
 ?>
 <section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                       <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="main-content" style="margin-top: -70px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            		<div class="col-md-6">
            			<form method="post" enctype="multipart/form-data">
            				<div class="card">
	            				<div class="card-header">
	            					<h3>Your Profile</h3>
	            				</div>
	            				<div class="card-body">
	            					<div class="form-group">
										<label for="">Kode User</label>
										<input type="text" class="form-control form-control-sm" style="font-weight: bold; color: red;" value="<?php echo $auth['kd_user'] ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Username</label>
										<input type="text" class="form-control form-control-sm" value="<?php echo $auth['username'] ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Nama</label>
										<input type="text" class="form-control form-control-sm" value="<?php echo $auth['nama_user'] ?>" name="nama">
									</div>
									<div class="form-group">
	                                    <label for="foto_karyawan" class="control-label mb-1">Foto</label>
	                                    <div style="padding-bottom: 15px;">
	                                        <img alt="" width="120" class="img-responsive" id="pict" src="img/<?= $auth['foto_user'] ?>">
	                                    </div>
	                                    <input type="file" name="foto" id="gambar" class="form-control-file">
	                                </div>
									<hr>
									<button name="btnUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update Profile</button>
	            				</div>
	            			</div>
            			</form>
            		</div>
            		<div class="col-md-6">
            			<form method="post">
            				<div class="card">
            					<div class="card-header">
            						<h3>Your Password</h3>
            					</div>
            					<div class="card-body">
            						<div class="form-group">
										<label for="">Password Lama</label>
										<input type="password" class="form-control form-control-sm" name="password">
									</div>
									<div class="form-group">
										<label for="">Password Baru</label>
										<input type="password" class="form-control form-control-sm" name="passwordbaru">
									</div>
									<div class="form-group">
										<label for="">Confirm Password Baru</label>
										<input type="password" class="form-control form-control-sm" name="confirm">
									</div>
									<hr>
									<button name="ubahPassword" class="btn btn-warning"><i class="fa fa-check"></i> Update Password</button>
            					</div>
            				</div>
            			</form>
            		</div>
            </div>
        </div>
    </div>
</div>