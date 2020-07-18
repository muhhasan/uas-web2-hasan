<?php
session_start();
if ($_SESSION['status'] != "sudah_login") {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relawan Covid-19</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://use.fontawesome.com/cba4c429ff.js"></script>
</head>

<body>
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <div id="topBarMenu" class="ml-auto pull-right">
            <a href="#" class="btn text-primary border-left">Welcome, <?php echo $_SESSION['nama']; ?></a>
            <a href="logout.php" id="btnLogout" class="btn text-primary border-left">Logout</a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 py-3">
                <div class="border p-3">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label for="txtFullName">Nama Lengkap : </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtFullName" id="txtFullName" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label id="txtEmail" for="txtCurrentDistance">Email : </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtEmail" id="txtEmail" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label for="txtPhone">No. Handphone : </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtPhone" id="txtPhone" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label for="txtSkill">Keahlian : </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtSkill" id="txtSkill" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label for="txtAddress">Alamat Rumah : </label>
                                        <div class="input-group">
                                            <textarea rows="5" type="text" class="form-control" name="txtAddress" id="txtAddress"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label for="cmbProvince">Province : </label>
                                        <div class="input-group">
                                            <select name="cmbProvince" class="form-control" id="cmbProvince"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="w-100 text-center py-3">
                                    <button class="btn btn-primary" type="submit" name="btnSave">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="border p-3">
                    <p class="text-center">Data Relawan Covid 19 Wilayah DKI Jakarta<br>
                        Per <?php
                            $tanggal = mktime(date("m"), date("d"), date("Y"));
                            echo "Tanggal : <b>" . date("d-M-Y", $tanggal) . "</b> ";
                            date_default_timezone_set('Asia/Jakarta');
                            $jam = date("H:i:s");
                            echo "| Pukul : <b>" . $jam . " " . "</b>";
                            ?> .
                    </p>

                    <table class="display table table-hover table-responsive-sm table-sm" id="tblDataRelawan" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Propinsi</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>Keahlian</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php
                                include 'koneksi.php';
                                // $query = mysqli_query($db, "call spMS_Personal_GetPersonalData") or die(mysqli_error($db));
                                $query = mysqli_query($db, "select * from ms_personal") or die(mysqli_error($db));
                                while ($data = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $data['fullName']; ?></td>
                                    <td><?php echo $data['address']; ?></td>
                                    <td><?php echo $data['provinceName']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['phone']; ?></td>
                                    <td><?php echo $data['skill']; ?></td>
                                    <td class="text-nowrap">
                                        <a href='update.php?email=<?php echo $data['email']; ?>' class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href='delete.php?email=<?php echo $data['email']; ?>' class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'koneksi.php';
    if (isset($_POST['btnSave'])) {
        $name = $_POST['txtFullName'];
        $address = $_POST['txtAddress'];
        $province = $_POST['cmbProvince'];
        $phone = $_POST['txtPhone'];
        $email = $_POST['txtEmail'];
        $skill = $_POST['txtSkill'];

        // $query = mysqli_query($db, "call spMS_Personal_InsertPersonal('$name', '$email', '$address', '$province', '$phone', '$skill')");
        $query = mysqli_query($db, "INSERT INTO ms_personal (fullName, email, address, provinceName, phone, skill, inputTime, inputUN, modifTime, modifUN) VALUES ('$name', '$email', '$address', '$province', '$phone', '$skillV', now(), 'agus.maulana', now(), 'agus.maulana')");
        if ($query) {
            // jika berhasil tampilkan pesan berhasil insert data
            echo '<script LANGUAGE="JavaScript">
            alert(" Data Berhasil Tersimpan")
            window.location.href="pgMasterRelawan.php";
            </script>';
        } else {
            // jika gagal tampilkan pesan kesalahan
            echo '<script LANGUAGE="JavaScript">
            alert(" Data Gagal Tersimpan")
            </script>';
        }
    }
    ?>
</body>
<script>
    let table;

    $(document).ready(function() {
        table = $('#tblDataRelawan').DataTable({
            dom: 'frtipB',
            buttons: [{
                extend: 'pdf',
                text: 'Export to PDF',
                title: "Data Relawan Covid"
            }]
        });

        BindProvince();
    });

    function BindProvince() {
        let province = [
            'Aceh',
            'Bali',
            'Kepulauan Bangka Belitung',
            'Banten',
            'Bengkulu',
            'Jawa Tengah',
            'Kalimantan Tengah',
            'Sulawesi Tengah',
            'Jawa Timur',
            'Kalimantan Timur',
            'Nusa Tenggara Timur',
            'Gorontalo',
            'DKI Jakarta',
            'Jambi',
            'Lampung',
            'Maluku',
            'Kalimantan Utara',
            'Maluku Utara',
            'Sulawesi Utara',
            'Sumatera Utara',
            'Papua',
            'Riau',
            'Kepulauan Riau',
            'Sulawesi Tenggara',
            'Kalimantan Selatan',
            'Sulawesi Selatan',
            'Sumatera Selatan',
            'Jawa Barat',
            'Kalimantan Barat',
            'Nusa Tenggara Barat',
            'Papua Barat',
            'Sulawesi Barat',
            'Sumatera Barat',
            'DI Yoygyakarta'
        ];

        province.sort();

        for (let i = 0; i < province.length; i++)
            $('#cmbProvince').append(new Option(province[i], province[i]));
    }
</script>

</html>