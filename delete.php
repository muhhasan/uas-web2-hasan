<?php 
include 'koneksi.php';

if (isset($_GET['email'])) {
    $emailParam = $_GET['email'];
    // $query = mysqli_query($db, "call spMS_Personal_DeletePersonalByEmail('$emailParam')") or die(mysqli_error($db));
    $query = mysqli_query($db, "delete from ms_personal where email = '$emailParam'") or die(mysqli_error($db));
    if ($query) {
        echo '<script LANGUAGE="JavaScript">
            alert("Data Berhasil Dihapus")
            window.location.href="pgMasterRelawan.php";
            </script>';
    }
}
?>