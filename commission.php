<?php
include "db/connection.php";
$obj  = new database();
$user_id=$_SESSION['user']['id'];
$total_commission = $obj->get_total_commission($user_id);
$user_level = $_SESSION['user']['level'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "common/head.php"; ?>
</head>
<body>
<?php include "common/menu.php"; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">My Total Earnings</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Earned Commission:</h5>
                <p class="card-text">
                    <?php if ($total_commission): ?>
                        <strong>Rs. <?= number_format($total_commission, 2); ?></strong>
                    <?php else: ?>
                        <strong>No commission earned yet.</strong>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>