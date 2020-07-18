<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relawan Covid-19</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="col-md-12 d-table" style="height: 100%; position: absolute">
        <div class="row d-table-cell align-middle">
            <div class="w-100 d-flex justify-content-center">
                <div class="col-md-5 border p-5">
                    <form action="pgLoginProses.php" method="post">
                        <div class="form-group pt-3">
                            <label for="txtUserName">Username</label>
                            <div>
                                <input type="text" class="form-control" name="txtUserName" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtPassword">Password</label>
                            <div>
                                <input class="form-control" name="txtPassword" type="password" />
                            </div>
                        </div>
                        <div class="w-100 text-center">
                            <button type="submit" class="btn" style="background-color: #155695; color: #fff;">Login</button>
                        </div>
                    </form>
                    <?php if (isset($_GET['pesan'])) {  ?>
                        <label style="color:red;"><?php echo $_GET['pesan']; ?></label>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>