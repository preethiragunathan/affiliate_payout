<?php
include "db/connection.php";
$obj  = new database();

if (isset($_POST['submit'])) {

    $data = array();
    if ($_POST['ref_id'] != '' && $_POST['ref_id']>0) {
        $referrer_id = $_POST['ref_id'];
        $referrer_exists = $obj->select_column_by_id('id', 'users', $referrer_id);
        if (!$referrer_exists) {
            $_SESSION['user']['log']['alert-class'] = "danger";
            $_SESSION['user']['log']['msg'] = "Referral ID not found!";
            header('location:add_user.php');
            exit;
        }
        $userlevel = $obj->select_column_by_id('level', 'users', $referrer_id);
        $level = $userlevel + 1;
    } else {
        $referrer_id = 0;
        $level = 1;
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['password'];
    if ($password != $confirm_password) {
        $_SESSION['user']['log']['alert-class'] = "danger";
        $_SESSION['user']['log']['msg'] = "Password not Matching!";
        header('location:add_user.php');
        exit;
    } else {
        $data['referrer_id'] = $referrer_id;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['level'] = $level;
        $data['password'] = $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $res = $obj->insert_data('users', $data);
        if ($res) {
            $_SESSION['user']['log']['alert-class'] = "success";
            $_SESSION['user']['log']['msg'] = "User Created Successfully";
            header('location:index.php');
            exit;
        }
    }
}
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
                            <?php
                            if (isset($_SESSION['user']['log']['alert-class']) && isset($_SESSION['user']['log']['msg'])) {
                                echo '<div class="alert alert-' . $_SESSION['user']['log']['alert-class'] . '" role="alert">' . $_SESSION['user']['log']['msg'] . '</div>';
                                unset($_SESSION['user']['log']);
                            }
                            ?>
                            <h3 class="card-title text-center">Add User</h3>
                            <div class="card-text">
                                <form action="" method="POST" autocomplete="off">
                                    <div class="form-group">
                                        <label for="ref_id">Referal ID</label>
                                        <input type="text" class="form-control form-control-sm" id="ref_id" name="ref_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="con_pass">Confirm Password</label>
                                        <input type="password" class="form-control form-control-sm" id="con_pass" name="con_pass" required>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("customEmail", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
            }, "Please enter a valid email address");

            $("form").validate({
                rules: {

                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        customEmail: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    con_pass: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {

                    name: {
                        required: "Please enter your name"
                    },
                    email: {
                        required: "Please enter your email",
                        customEmail: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    con_pass: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>