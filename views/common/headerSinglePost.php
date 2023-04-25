<header class="masthead d-flex justify-content-center align-items-center" style="background-image: url('./public/assets/img/forest.jpg'); background-position: 30% 55%; filter: grayscale(70%); height: 120px;">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1 class="text-white">Article</h1>
                        </div>
                    </div>
                </div>
            </div>
</header>

<!-- ALERTS -->
<?php
if (!empty($_SESSION['alert'])) {
    foreach ($_SESSION['alert'] as $alert) {
        echo "<div class='text-center m-0 alert " . $alert['type'] . "' role='alert'>
                        " . $alert['message'] . "
                    </div>";
    }
    unset($_SESSION['alert']);
}
?>