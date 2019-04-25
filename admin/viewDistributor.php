<?php 
    $dis = new lsp();
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
    $table = "table_distributor";
    $dataDis = $dis->select($table);
    $autokode = $dis->autokode($table,"kd_distributor","DS");

    if (isset($_GET['delete'])) {
        $where = "kd_distributor";
        $whereValues = $_GET['id'];
        $redirect = "?page=viewDistributor";
        $response = $dis->delete($table,$where,$whereValues,$redirect);
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['id'];
        $editData = $dis->selectWhere($table,"kd_distributor",$id);
        $autokode = $editData['kd_distributor'];
    }
    if (isset($_POST['getSave'])) {
        $kd_distributor   = $dis->validateHtml($_POST['kode_distributor']);
        $nama_distributor = $dis->validateHtml($_POST['nama_distributor']);
        $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
        $alamat           = $dis->validateHtml($_POST['alamat']);

        if ($kd_distributor == " " || empty($kd_distributor) || $nama_distributor == " " || empty($nama_distributor) || $nohp_distributor == " " || empty($nohp_distributor) || $alamat == " " || empty($alamat)) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
            $validno = substr($nohp_distributor, 0,2);
            if ($validno != "08") {
                $response = ['response'=>'negative','alert'=>'Masukan nohp yang valid'];
            }else{
                if (strlen($nohp_distributor) < 11) {
                    $response = ['response'=>'negative','alert'=>'Masukan 11 digit nohp'];
                }else{
                    $value = "'$kd_distributor','$nama_distributor','$alamat','$nohp_distributor'";
                    $response = $dis->insert($table,$value,"?page=viewDistributor");
                }
            }
        }
    }

    if (isset($_POST['getUpdate'])) {
        $kd_distributor   = $dis->validateHtml($_POST['kode_distributor']);
        $nama_distributor = $dis->validateHtml($_POST['nama_distributor']);
        $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
        $alamat           = $dis->validateHtml($_POST['alamat']);

        if ($kd_distributor == "" || $nama_distributor == "" || $nohp_distributor == "" || $alamat == "") {
            $response = ['response'=>'negative','alert'=>'lengkapi field'];
        }else{
            $validno = substr($nohp_distributor, 0,2);
            if ($validno != "08") {
                $response = ['response'=>'negative','alert'=>'Masukan nohp yang valid'];
            }else{
                if (strlen($nohp_distributor) < 11) {
                    $response = ['response'=>'negative','alert'=>'Masukan 11 digit nohp'];
                }else{
                    $value = "kd_distributor='$kd_distributor',nama_distributor='$nama_distributor',no_telp='$nohp_distributor',alamat='$alamat'";
                    $response = $dis->update($table,$value,"kd_distributor",$_GET['id'],"?page=viewDistributor");
                }
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
                                <li class="list-inline-item">Data Distributor</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content" style="margin-top: -60px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" >
                            <strong class="card-title mb-3">Input Distributor</strong>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="">Kode distributor</label>
                                    <input type="text" class="form-control form-control-sm" name="kode_distributor" style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama distributor</label>
                                    <input type="text" class="form-control form-control-sm" name="nama_distributor" value="<?php echo @$editData['nama_distributor'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nohp distributor</label>
                                    <input type="text" class="form-control form-control-sm" name="nohp_distributor" value="<?php echo @$editData['no_telp']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" rows="5" class="form-control"><?php echo @$editData['alamat'] ?></textarea>
                                </div>
                                <hr>
                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])): ?>    
                                <button type="submit" name="getSave" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Distributor</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                   <thead>
                                       <tr>
                                            <th>Kode distributor</th>
                                            <th>Nama</th>
                                            <th>Nohp</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($dataDis as $ds){
                                         ?>
                                       <tr>
                                            <td><?= $ds['kd_distributor'] ?></td>
                                            <td><?= $ds['nama_distributor'] ?></td>
                                            <td><?= $ds['no_telp'] ?></td>
                                            <td><?= $ds['alamat'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="?page=viewDistributor&edit&id=<?= $ds['kd_distributor'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Delete" href="#" class="btn btn-danger"><i class="fa fa-trash" id="btnDelete<?php echo $no; ?>" ></i></a>
                                                </div>
                                            </td>
                                       </tr>
                                       <script src="vendor/jquery-3.2.1.min.js"></script>
                                       <script>
                                        $('#btnDelete<?php echo $no; ?>').click(function(e){
                                                      e.preventDefault();
                                                        swal({
                                                        title: "Hapus",
                                                        text: "Yakin Ingin menghapus?",
                                                        type: "error",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes",
                                                        cancelButtonText: "Cancel",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: true
                                                      }, function(isConfirm) {
                                                        if (isConfirm) {
                                                            window.location.href="?page=viewDistributor&delete&id=<?php echo $ds['kd_distributor'] ?>";
                                                        }
                                                      });
                                                    });
                                        </script>
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
    </div>
</div>
