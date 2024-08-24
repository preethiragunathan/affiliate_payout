<!-- Top Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= $obj->base_url ?>dashboard.php">Home</a>
                    </li>
                    <?php if ($user_level >= 1 && $user_level <= 5): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $obj->base_url ?>commission.php">Commission</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $obj->base_url ?>logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>