<?php
include "db/connection.php";
$obj  = new database();
?>
<!doctype html>
<html>

<head>
  <?php include "common/head.php";?>
</head>

<body>
  <div class="container-fluid">
    <div class="d-flex flex-row">
      <div class="col-sm-12 col-xs-12 content_box no-padding-lr" id="content_box" >
        <div class="login-box">
            <div class="card login-form">
              <div class="card-body">
                <h3 class="card-title text-center">Log in</h3>
                <div class="card-text">
                  <form action="<?=$obj->base_url?>login" method="GET">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control form-control-sm" id="username" name="username">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control form-control-sm" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block sign-in">Sign in</button>
                    <p class="mt-4 text-right">Not have account? <a href="add_user.php">Sign Up</a></p>
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