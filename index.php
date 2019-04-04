<?php

include 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <button class="btn btn-dark" data-toggle="modal" data-target="#addModal" >Tambah Data</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $conn->query("SELECT * FROM data");
                $no =1;
                while($data=mysqli_fetch_array($query)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['kelas'] ?></td>
                    <td><?php if($data['jk'] === "0"): echo "Perempuan"; else: echo "Laki - laki"; endif;  ?></td>
                    <td><?= $data['tgl_lahir'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td>
                        <a class="btn btn-danger" href="javascipt:void(0)" data-toggle="modal" data-target="#deleteModal<?= $data['id'] ?>">Hapus</a>
                        <a class="btn btn-primary" href="javascipt:void(0)"" data-toggle="modal" data-target="#editModal<?= $data['id'] ?>">Edit</a>
                    </td>
                </tr>
                <!-- Modal Hapus -->
                <div class="modal fade" id="deleteModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3 class="text-center">Yakin ingin menghapus Data ?</h3>
                            </div>
                            <div class="modal-footer">
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="delete" class="btn btn-dark">Yakin!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nama:</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required value="<?= $data['nama'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Kelas:</label>
                                <select name="kelas" class="form-control" required>
                                    <optgroup label="Terpilih">
                                        <option value="<?= $data['kelas'] ?>"> <?= $data['kelas'] ?> </option>
                                    </optgroup>
                                    <optgroup label="Pilihan">
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Tanggal Lahir:</label>
                                <input type="date" class="form-control" name="tgl_lahir" required value="<?= $data['tgl_lahir'] ?>">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Jenis Kelamin:</label>
                                <select name="jk" class="form-control" required>
                                    <optgroup label="Terpilih">
                                        <?php if($data['jk'] === "0"): $jk = 'Perempuan'; else: $jk = 'Laki - Laki'; endif; ?>
                                        <option value="<?= $jk ?>"> <?= $jk ?> </option>
                                    </optgroup>
                                    <optgroup label="Pilihan">
                                        <option value="1">Laki - Laki</option>
                                        <option value="0">Perempuan</option>
                                    </optgroup>
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Alamat:</label>
                                <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap" required><?= $data['alamat'] ?>  </textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="edit" class="btn btn-dark">Edit Data</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>


    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label">Nama:</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Kelas:</label>
                    <select name="kelas" class="form-control" required>
                        <option disabled selected>=== PILIH KELAS ===</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tanggal Lahir:</label>
                    <input type="date" class="form-control" name="tgl_lahir" required>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Jenis Kelamin:</label>
                    <select name="jk" class="form-control" required>
                        <option disabled selected>=== LAKI / PEREMPUAN ===</option>
                        <option value="1">Laki - Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Alamat:</label>
                    <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap" required></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-dark">Tambah Data</button>
            </div>
            </form>
            </div>
        </div>
    </div>








    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php

if(isset($_POST['submit'])){

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];

    $query = $conn->query("INSERT INTO data VALUES('','$nama','$kelas','$tgl_lahir','$alamat','$jk')")or die(mysqli_error($conn));

    if($query){
        echo "<script>alert('Berhasil Menambah!'); window.location.href='index.php';</script>";
    }

}

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $query = $conn->query("DELETE FROM data WHERE id='$id'")or die(mysqli_error($conn));

    if($query){
        echo "<script>alert('Berhasil Menghapus!'); window.location.href='index.php';</script>";
    }

}

if(isset($_POST['edit'])){

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];

    $query = $conn->query("UPDATE data SET nama='$nama',kelas='$kelas',tgl_lahir='$tgl_lahir',jk='$jk',alamat='$alamat'")or die(mysqli_error($conn));

    if($query){
        echo "<script>alert('Berhasil Mengubah Data!'); window.location.href='index.php';</script>";
    }
}




?>