<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Login</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-5 pt-lg-5">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Login!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <?php if (session()->getFlashdata('kesalahan')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('kesalahan'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="text-center text-muted mb-4">
                                <small>Login dengan username</small>
                            </div>
                            <form role="form" action="/auth/login" method="post">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Username" type="text" name="username">
                                    </div>
                                    <small class="text text-danger"><?= $validation->getError('username'); ?></small>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password" name="password">
                                    </div>
                                    <small class="text text-danger"><?= $validation->getError('password'); ?></small>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2020 <a href="https://abdicreative.com" class="font-weight-bold ml-1" target="_blank">Abdi creative</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="/assets/js/argon.js?v=1.2.0"></script>
</body>

</html>