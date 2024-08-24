<?php
include "db/connection.php";
$obj  = new database();
$user_level = $_SESSION['user']['level'];
$user_id=$_SESSION['user']['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "common/head.php"; ?>
</head>

<body>

    <?php include "common/menu.php"; ?>

    <!-- Items with Sale Button -->
    <div class="container mt-5">
        <?php
        if (isset($_SESSION['user']['slale']['alert-class']) && isset($_SESSION['user']['slale']['sale-msg'])) {
            echo '<div class="alert alert-' . $_SESSION['user']['slale']['alert-class'] . '" role="alert">' . $_SESSION['user']['slale']['sale-msg'] . '</div>';
            unset($_SESSION['user']['slale']);
        }
        ?>
        <h2 class="text-center mb-4">Items on Sale</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $obj->base_url ?>img/150.png" class="card-img-top" alt="Item 1">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Item 1</h5>
                            <span class="text-muted">Rs.250.00</span>
                        </div>
                        <p class="card-text">This is a brief description of Item 1.</p>
                        <a href="sales.php?item_id=1&price=250" class="btn btn-danger">Sale</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $obj->base_url ?>img/150.png" class="card-img-top" alt="Item 2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Item 2</h5>
                            <span class="text-muted">Rs.450.00</span>
                        </div>
                        <p class="card-text">This is a brief description of Item 2.</p>
                        <a href="sales.php?item_id=2&price=450" class="btn btn-danger">Sale</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $obj->base_url ?>img/150.png" class="card-img-top" alt="Item 3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Item 3</h5>
                            <span class="text-muted">Rs.350.00</span>
                        </div>
                        <p class="card-text">This is a brief description of Item 3.</p>
                        <a href="sales.php?item_id=3&price=350" class="btn btn-danger">Sale</a>
                    </div>
                </div>
            </div>
        </div>
        <br clear="all">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $obj->base_url ?>img/150.png" class="card-img-top" alt="Item 4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Item 4</h5>
                            <span class="text-muted">Rs.650.00</span>
                        </div>
                        <p class="card-text">This is a brief description of Item 4.</p>
                        <a href="sales.php?item_id=4&price=650" class="btn btn-danger">Sale</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $obj->base_url ?>img/150.png" class="card-img-top" alt="Item 5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Item 5</h5>
                            <span class="text-muted">Rs.840.00</span>
                        </div>
                        <p class="card-text">This is a brief description of Item 5.</p>
                        <a href="sales.php?item_id=1&price=840" class="btn btn-danger">Sale</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $obj->base_url ?>img/150.png" class="card-img-top" alt="Item 6">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Item 6</h5>
                            <span class="text-muted">Rs.740.00</span>
                        </div>
                        <p class="card-text">This is a brief description of Item 6.</p>
                        <a href="sales.php?item_id=1&price=740" class="btn btn-danger">Sale</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>