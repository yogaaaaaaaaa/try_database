<?php
// connect database
    $host       = "localhost";
    $user       = "root";
    $password   = "";
    $dbname     = "perpus";

// connection database
    $koneksi = mysqli_connect($host, $user, $password, $dbname) or die (mysqli_error($koneksi));

    if(isset($_POST['bsimpan'])) {

        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $buku = $_POST['buku'];
        $tgl_kembali = $_POST['tgl_kembali'];

//edit data
        if(isset($_GET['hal']) == "edit") {
            $edit = mysqli_query($koneksi, "UPDATE pinjam SET 
                                            name = '$name',
                                            mobile = '$mobile',
                                            buku = '$buku',
                                            tgl_kembali = '$tgl_kembali'
                                            WHERE id_pinjam = '$_GET[id]'");

        if($edit){
            echo "<script>
            alert('Edit data Sukses');
            document.location='index.php';
            </script>";
        }else {
            echo "<script>
            alert('Edit data Gagal');
            document.location='index.php';
            </script>";
            }
        }else {

            //simpan data
                   
            
                    $simpan = mysqli_query($koneksi, "INSERT INTO pinjam (name, mobile, buku, tgl_kembali)
                    VALUES ('$name','$mobile','$buku','$tgl_kembali')");
            
                    if($simpan){
                        echo "<script>
                                alert('Simpan data Sukses');
                                document.location='index.php';
                            </script>";
                    }else {
                        echo "<script>
                                alert('Simpan data Gagal');
                                document.location='index.php';
                            </script>";
                    }
        }

    }

    $vname          = "";
    $vmobile        = "";
    $vbuku          = "";
    $vtgl_kembali   = "";
// edit&hapus data
    if(isset($_GET['hal'])) {

        if($_GET['hal'] == "edit"){

            //menampilkan data yang di edit
            $tampil = mysqli_query($koneksi, "SELECT * FROM pinjam WHERE id_pinjam = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $vname          = $data['name'];
                $vmobile        = $data['mobile'];
                $vbuku          = $data['buku'];
                $vtgl_kembali   = $data['tgl_kembali'];
            }
        }else if($_GET['hal'] == "hapus") {
            $hapus = mysqli_query($koneksi, "DELETE FROM pinjam WHERE id_pinjam = '$_GET[id]'");

            if($hapus){
                echo "<script>
                        alert('Hapus data Sukses');
                        document.location='index.php';
                    </script>";
            }else {
                echo "<script>
                        alert('Hapus data Gagal');
                        document.location='index.php';
                    </script>";
            }
        }
    }



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Try Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
         <h3 class="text-center">Form Pinjam</h3>
        <!-- row -->
         <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header bg-info text-center">
                       <h5>Isi Data</h5>
                     </div>
                     <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" value="<?=$vname?>" class="form-control" placeholder="Masukan Nama">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No.Tlp</label>
                                <input type="text" name="mobile" value="<?=$vmobile?>" class="form-control" placeholder="Masukan No.Tlp">
                            </div>

                            <div class="row">
                                <div class="col">
                                     <div class="mb-3">
                                        <label class="form-label">Buku</label>
                                        <select class="form-select" name="buku">
                                            <option value="<?=$vbuku?>"><?=$vbuku?></option>
                                            <option value="Panduan Bernyanyi">Panduan Bernyanyi</option>
                                            <option value="Puisi">Puisi</option>
                                            <option value="Pemograman Dasar">Pemograman Dasar</option>
                                            <option value="Algoritma Pemograman">Algoritma Pemograman</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                         <label class="form-label">Tanggal Pengembalian</label>
                                         <input type="date" name="tgl_kembali" value="<?=$vtgl_kembali?>" class="form-control" placeholder="Masukan No.Tlp">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="bsimpan" type="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                <div class="card-footer bg-info">
                 
                </div>
             </div>
            </div>
         </div>
        <!-- end row --> 

        <div class="card mt-3 col-md-8 mx-auto">
            <h5 class="card-header bg-info">Data Pinjaman</h5>
            <div class="card-body">

                <form method="POST">
                    <div class="input-group mb-3">
                    <input type="text" value="<?=$_POST['tcari']?>" name="tcari" class="form-control" placeholder="Masukan kata kunci">
                    <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                    <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                    </div>
                </form>

                <table class="table table-striped table-hover table-bordered">
                <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No.Tlp</th>
                        <th>Buku</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
                    </tr>

                    <!-- menampilkan data -->
                    <?php 
                        $no = 1;
                        if(isset($_POST['bcari'])) {
                            $keyword = $_POST['tcari'];
                            $q = "SELECT * FROM pinjam WHERE buku like '%$keyword%' or name like '%$keyword%' order by id_pinjam desc";
                        }else {
                            $q = "SELECT * FROM pinjam order by id_pinjam desc";
                        }

                        $tampil = mysqli_query($koneksi, $q);
                        while($data = mysqli_fetch_array($tampil)) {
                    ?>
                        <tr>
                            <td><?=$no++ ?></td>
                            <td><?=$data['name'] ?></td>
                            <td><?=$data['mobile'] ?></td>
                            <td><?=$data['buku'] ?></td>
                            <td><?=$data['tgl_kembali'] ?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?= $data['id_pinjam']?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?hal=hapus&id=<?= $data['id_pinjam']?>" class="btn btn-danger" 
                                onclick="return confirm ('Apakah anda Yakin akan Hapus Data ini?')">Hapus</a>
                            </td>
                        </tr>

                    <?php  } ?>
                </table>
            </div>
        </div>



         
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></>
  </body>
</html>