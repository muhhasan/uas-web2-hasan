<?php
session_start();
if ($_SESSION['status'] != "sudah_login") {
    header("location:index.php");
}

include 'koneksi.php';

if (isset($_GET['email'])) {
    $emailParam = $_GET['email'];
    // $query = mysqli_query($db, "call spMS_Personal_GetPersonalDataByEmail('$emailParam')") or die(mysqli_error($db));
    $query = mysqli_query($db, "select * from ms_pesonal where email = '$emailParam'") or die(mysqli_error($db));
    while ($data = mysqli_fetch_assoc($query)) {
?>

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

        <div class="col-md-6 p-3">
            <h4 class="text-center">Update Data</h4>
        </div>
        <div style="margin: 0 auto;">
            <div class="col-md-6 py-3">
                <div class="border p-3">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label for="txtFullName">Nama Lengkap : </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtFullName" value="<?php echo $data['fullName']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label id="txtEmail" for="txtCurrentDistance">Email : </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtEmail" value="<?php echo $data['email']; ?>" />
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
                                            <input type="text" class="form-control" name="txtPhone" id="txtPhone" value="<?php echo $data['phone']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pt-2">
                                        <label for="txtSkill">Keahlian : </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txtSkill" id="txtSkill" value="<?php echo $data['skill']; ?>" />
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
                                            <textarea rows="5" type="text" class="form-control" name="txtAddress" id="txtAddress"><?php echo $data['address']; ?></textarea>
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
                                            <script>
                                                let province = [
                                                    "Aceh",
                                                    "Bali",
                                                    "Kepulauan Bangka Belitung",
                                                    "Banten",
                                                    "Bengkulu",
                                                    "Jawa Tengah",
                                                    "Kalimantan Tengah",
                                                    "Sulawesi Tengah",
                                                    "Jawa Timur",
                                                    "Kalimantan Timur",
                                                    "Nusa Tenggara Timur",
                                                    "Gorontalo",
                                                    "DKI Jakarta",
                                                    "Jambi",
                                                    "Lampung",
                                                    "Maluku",
                                                    "Kalimantan Utara",
                                                    "Maluku Utara",
                                                    "Sulawesi Utara",
                                                    "Sumatera Utara",
                                                    "Papua",
                                                    "Riau",
                                                    "Kepulauan Riau",
                                                    "Sulawesi Tenggara",
                                                    "Kalimantan Selatan",
                                                    "Sulawesi Selatan",
                                                    "Sumatera Selatan",
                                                    "Jawa Barat",
                                                    "Kalimantan Barat",
                                                    "Nusa Tenggara Barat",
                                                    "Papua Barat",
                                                    "Sulawesi Barat",
                                                    "Sumatera Barat",
                                                    "DI Yoygyakarta"
                                                ];

                                                province.sort();

                                                for (let i = 0; i < province.length; i++)
                                                    $("#cmbProvince").append(new Option(province[i], province[i]));

                                                $("#cmbProvince").val("<?php echo $data['provinceName']; ?>");
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="w-100 text-center py-3">
                                    <button class="btn btn-primary" type="submit" name="btnUpdate">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    }
} ?>

<?php
include 'koneksi.php'; 
if (isset($_POST['btnUpdate'])) {
    $nameVal = $_POST['txtFullName'];
    $addressVal = $_POST['txtAddress'];
    $provinceVal = $_POST['cmbProvince'];
    $phoneVal = $_POST['txtPhone'];
    $emailVal = $_POST['txtEmail'];
    $skillVal = $_POST['txtSkill'];

    // $query = mysqli_query($db, "call spMS_Personal_UpdatePersonal('$nameVal', '$emailVal', '$addressVal', '$provinceVal', '$phoneVal', '$skillVal')");
    $query = mysqli_query($db, "update ms_personal set fullName = '$nameVal', address = '$addressVal', provinceName = '$provinceVal', phone = '$phoneVal', skill = '$skillVal' where email = '$emailVal')");
    if ($query) {
        // jika berhasil tampilkan pesan berhasil insert data
        echo '<script LANGUAGE="JavaScript">
        alert("Data Berhasil Diupdate");
        window.location.href="pgMasterRelawan.php";
        </script>';
    } else {
        // jika gagal tampilkan pesan kesalahan
        echo '<script LANGUAGE="JavaScript">
        alert("Data Gagal Diupdate");
        </script>';
    }
}
?>