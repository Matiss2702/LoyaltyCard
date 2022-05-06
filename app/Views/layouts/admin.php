<!DOCTYPE html>
<html>

<head>
    <title>Administration Loyalty Card - <?= $this->data['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/toastr.min.js"></script>
    <script src="/js/main.js"></script>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/templatemo.css">
    <link rel="stylesheet" href="/css/customtables.css">
    <link rel="stylesheet" href="/css/datatables.css">
    <script src="/js/datatables.js"></script>
    <script src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/js/templatemo.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/modal.js"></script>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="/css/fontawesome/all.min.css">
    <script src="/js/fontawesome/all.min.js"></script>
    <script src="/js/admin.js"></script>
    <script src="js/scripts.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/admin/">LoyaltyCard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/admin/profile">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="/logout/">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Catégorie</div>
                       <?php if($_SESSION['group']=='super_admin'):?>
                        <a class="nav-link" href="/admin/group">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Rôles
                        </a>
                        <a class="nav-link" href="/admin/user">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Utilisateurs
                        </a>
                        <a class="nav-link" href="/admin/type_product">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Catégorie Produits
                        </a> 
                        <a class="nav-link" href="/admin/order">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Commandes
                        </a>
                        <a class="nav-link" href="/admin/order_product">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Commandes Produits
                        </a>  <a class="nav-link" href="/admin/company">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Entreprises
                        </a>
                        <?php endif;?>
                        <a class="nav-link" href="/admin/partner">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Partenaires
                        </a>
                        <a class="nav-link" href="/admin/product">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Produits
                        </a>
                        <a class="nav-link" href="/admin/warehouse">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Entrepots
                        </a>
                        <a class="nav-link" href="/admin/stocks">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Stocks
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
