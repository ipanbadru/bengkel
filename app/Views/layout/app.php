<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title><?= $title; ?></title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="/img/logo.jpg" class="navbar-brand-img" alt="...">
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <?php if (session()->get('role') == 'admin') : ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($active == 'dashboard') ? 'active' : ''; ?>" href="/admin">
                                    <i class="ni ni-tv-2 text-primary"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item <?= ($active == 'profile') ? 'active' : ''; ?>">
                                <a class="nav-link" href="/profile">
                                    <i class="ni ni-circle-08 text-info"></i>
                                    <span class="nav-link-text">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($active == 'montir') ? 'active' : ''; ?>" href="/montir">
                                    <i class="ni ni-settings text-red"></i>
                                    <span class="nav-link-text">Montir</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($active == 'barang') ? 'active' : ''; ?>" href="/barang">
                                    <i class="ni ni-box-2 text-green"></i>
                                    <span class="nav-link-text">Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($active == 'daftar user') ? 'active' : ''; ?>" href="/user">
                                    <i class="ni ni-badge text-primary"></i>
                                    <span class="nav-link-text">User</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/registrasi">
                                    <i class="ni ni-circle-08 text-pink"></i>
                                    <span class="nav-link-text">Register</span>
                                </a>
                            </li>
                    </ul>
                    <hr class="my-3">
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Customer</span>
                    </h6>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'pelanggan') ? 'active' : ''; ?>" href="/pelanggan">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Pelanggan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'transaksi') ? 'active' : ''; ?>" href="/transaksi">
                                <i class="ni ni-cart"></i>
                                <span class="nav-link-text">Transaksi</span>
                            </a>
                        </li>
                    </ul>
                    <hr class="my-3">
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Kasir</span>
                    </h6>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'pembayaran') ? 'active' : ''; ?>" href="/pembayaran">
                                <i class="ni ni-laptop text-red pembayaran"></i>
                                <span class="nav-link-text">Pembayaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'history') ? 'active' : ''; ?>" href="/pembayaran/history">
                                <i class="ni ni-chart-pie-35 text-primary"></i>
                                <span class="nav-link-text">Pembayaran hari ini</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (session()->get('role') == 'customer') : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'pelanggan') ? 'active' : ''; ?>" href="/pelanggan">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Pelanggan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'transaksi') ? 'active' : ''; ?>" href="/transaksi">
                                <i class="ni ni-cart"></i>
                                <span class="nav-link-text">Transaksi</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($active == 'profile') ? 'active' : ''; ?>">
                            <a class="nav-link" href="/profile">
                                <i class="ni ni-circle-08 text-info"></i>
                                <span class="nav-link-text">Profile</span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (session()->get('role') == 'kasir') : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'pembayaran') ? 'active' : ''; ?>" href="/pembayaran">
                                <i class="ni ni-laptop text-red pembayaran"></i>
                                <span class="nav-link-text">Pembayaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active == 'history') ? 'active' : ''; ?>" href="/pembayaran/history">
                                <i class="ni ni-chart-pie-35 text-primary"></i>
                                <span class="nav-link-text">pembayaran hari ini</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($active == 'profile') ? 'active' : ''; ?>">
                            <a class="nav-link" href="/profile">
                                <i class="ni ni-circle-08 text-info"></i>
                                <span class="nav-link-text">Profile</span>
                            </a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" onclick="return confirm('Yakin?');">
                            <i class="ni ni-key-25 text-info"></i>
                            <span class="nav-link-text">Logout</span>
                        </a>
                    </li>
                    </ul>
                    <!-- Navigation -->
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content" id="panel">
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
                    <!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="Search" type="text">
                            </div>
                        </div>
                        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </form> -->
                    <!-- Navbar links -->
                    <?= $this->renderSection('search'); ?>
                    <div class="media align-items-right mr-auto">
                        <a href="/profile">
                            <span class="avatar avatar-sm rounded-circle">
                                <img src="/img/profile.png">
                            </span>
                            <div class="media-body ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold text-secondary"><?= session()->get('nama'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
    </nav>
    <?= $this->renderSection('content'); ?>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="/assets/js/argon.js?v=1.2.0"></script>
    <script>
        fetch('/pembayaran/notifications', {
            method: "get",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => response.json()).then(ntf => {
            const pembayaran = document.querySelector('.pembayaran');
            if (ntf == 0) {
                pembayaran.innerHTML = '';
            } else {
                pembayaran.innerHTML = ntf;
            }
        });
        setInterval(function() {
            fetch('/pembayaran/dataNotifications', {
                method: "get",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => response.json()).then(data => {
                if (data.length == document.querySelector('.pembayaran').innerHTML) {
                    return false;
                } else {
                    document.querySelector('.pembayaran').innerHTML = data.length;
                    let content = document.querySelector('.content-pembayaran');
                    content.innerHTML = '';
                    let cards = '';
                    data.forEach(d => cards += show(d));
                    content.innerHTML = cards;
                }
            });
        }, 1000);

        function show(data) {
            return `<div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nama Pelanggan : ${data.nama_pelanggan}</h5>
                                        <h5 class="card-title">Jenis Motor : ${data.detail_merk}</h5>
                                        <p class="card-text">Kendala : ${data.kendala}</p>
                                        <a href="/pembayaran/bayar/${data.id}" class="btn btn-success">Bayar</a>
                                    </div>
                                </div>
                            </div>`;
        }
    </script>
    <?= $this->renderSection('script'); ?>
</body>

</html>