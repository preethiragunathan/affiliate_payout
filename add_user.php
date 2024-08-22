<?php
include "db/connection.php";
$obj  = new database();
?>
<!doctype html>
<html>

<head>
    <?php include "common/head.php"; ?>
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex flex-row">
            <div class="col-sm-12 col-xs-12 content_box no-padding-lr" id="content_box">
                <div class="login-box">
                    <div class="card login-form">
                        <div class="card-body">
                            <h3 class="card-title text-center">Add User</h3>
                            <div class="card-text">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="password" name="password">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>