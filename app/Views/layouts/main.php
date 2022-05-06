<!DOCTYPE html>
<html>

<head>
<title> Loyalty Card - <?= $this->data['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/toastr.min.js"></script>
    <script src="/js/main.js"></script>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/templatemo.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/js/templatemo.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/modal.js"></script>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="/css/fontawesome/all.min.css">
    <script src="/js/fontawesome/all.min.js"></script>
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">LoyaltyCard@gmail.com</a>
                    <i class="fa-solid fa-phone-flip mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">01 22 34 65 75</a>
                </div>
                <div>
                    <a class="text-light" href="#" target="_blank" rel="sponsored"><i class="fa-brands fa-facebook-f me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fa-brands fa-twitter me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
                LoyaltyCard
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/product/">Produit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact/">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                  <?php if(empty($this->data['is_login'])):?>
                       <a class="nav-icon position-relative text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#sign-form">
                          <i class="fa-solid fa-right-to-bracket text-dark mr-3"></i>
                        </a>
                     <?php else:?>
                        <?php if($_SESSION['group']!= "user"):?>
                        <a class="nav-icon position-relative text-decoration-none" href="/admin/">
                          <i class="fa-solid fa-user-tie"></i>
                        </a>
                         <?php endif;?>
                        <a class="nav-icon position-relative text-decoration-none" href="/profile/">
                            <i class="fa-solid fa-user text-dark mr-3"></i>
                        </a>
                        <a class="nav-icon position-relative text-decoration-none" href="/logout/">
                            <i class="fa-solid fa-arrow-right-from-bracket text-dark mr-3"></i>
                        </a>
                      <?php endif;?>
                        <a class="nav-icon position-relative text-decoration-none" href="#">
                          <i class="fa-solid fa-cart-shopping text-dark mr-1"></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">7</span>
                        </a>
                     <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                              <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                      <i class="fa-solid fa-magnifying-glass text-dark mr-2"></i>
                    </a>
                 </div>
            </div>
        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                     <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if($this->data['title'] == 'Acceuil'){ ?>

    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src=".//img/banner_img_01.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>LoyaltyCard</b> eCommerce</h1>
                                <h3 class="h2">Parfait pour des achats moins chère</h3>
                                <p>
                                   LoyaltyCard est une entreprise qui a plusieurs partenaire pour votre bonheure <a rel="sponsored" class="text-success" href="about.html" target="_blank">Notre histoire</a>,
                        
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src=".//img/club_sportif.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Club sportif</h1>
                                <h3 class="h2">acheter des passes de club moins chère </h3>
                                <p>
                                  Vous voulez vous inscrire a un club sportif a moins prix regarder notre catalogue vous trouverez surement votre bonheur!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src=".//img/voyage.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Voyage</h1>
                                <h3 class="h2">Reserver vos voyage</h3>
                                <p>
                               Grâce a nos partenaire nous vous proposons differant lieux de voyage pour vous remettre d'aploms!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
         <i class="fa-solid fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
          <i class="fa-solid fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->
    <?php } ?> 
    <div class="container pb-20r mb-3r">
        <?= $this->renderSection('content') ?>
    </div>
     <!-- Start Footer -->
    <footer class="bg-dark position-fixed  w-100 bottom-0" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">LoyaltyCard</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            4 clos les vergers 
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:01 22 34 65 75">01 22 34 65 75</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">Loyaltycard@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2022 LoyaltyCard
                            | Designed by Matiss Haillouy Neil Chaou Elias Guerfa
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- The Modal -->
  <div class="modal" id="sign-form">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <div class="modal-tabs modal-tabs-fill">
                  <button class="modal-tabs-link active" id="sign-in" onclick='sign_in()'>Se Connecter</button>
                  <button class="modal-tabs-link" id="sign-up" onclick='sign_up()'>S'inscrire</button>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="tab-content" id="tabs">
             <!-- content tabs login -->
            <div class="tab-pane fade show active" id="sign-in-tab">
              <div class="mb-3 d-grid text-center form-group">
                <label for="signin-mail" class="form-label">Adresse Email</label>
                <input class="form-control" type="email" id="signin-mail" name="signin-mail" placeholder="Votre email">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="signin-password" class="form-label">Mot de Passe</label>
                <input class="form-control" type="password" id="signin-password" name="signin-password" placeholder="Votre mot de passe">
              </div>
              <button class="btn btn-primary d-flex mx-auto" onclick="login('<?php echo csrf_hash() ?>')">Se Connecter</button>
            </div>
            <!-- content tabs register -->
            <div class="tab-pane fade" id="sign-up-tab">
               <div class="mb-3 d-grid text-center form-group">
                <label for="signup-lastname" class="form-label">Nom</label>
                <input class="form-control" type="text" id="signup-lastname" name="signup-lastname" placeholder="Nom">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="signup-firstname" class="form-label">Prénom</label>
                <input class="form-control" type="text" id="signup-firstname" name="signup-firstname" placeholder="Prénom">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="signup-mail" class="form-label">Adresse Email</label>
                <input class="form-control" type="email" id="signup-mail" name="signup-mail" placeholder="Votre email">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="signup-password" class="form-label">Mot de Passe</label>
                <input class="form-control" type="password" id="signup-password" name="signup-password" placeholder="Votre mot de passe">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="signup-password-confirm" class="form-label">Confirmation Mot de Passe</label>
                <input class="form-control" type="password" id="signup-password-confirm" name="signup-password-confirm" placeholder="Confirmation mot de passe">
              </div>
              <button class="btn btn-primary d-flex mx-auto" onclick="register('<?php echo csrf_hash() ?>')">S'inscrire</button>
            </div>
            <!-- content tabs reset password -->
            <div class="tab-pane fade" id="reset-tab">
              <div class="mb-3 d-grid text-center form-group">
                <label for="reset-mail" class="form-label">Adresse Email</label>
                <input class="form-control" type="email" id="reset-mail" name="reset-mail" placeholder="Votre email">
              </div>
              <button class="btn btn-primary d-flex mx-auto" onclick="reset('<?php echo csrf_hash() ?>')">Changer de mot de passe</button>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button  id="reset" class="btn btn-link" onclick='reset_pwd()'>Mot de passe oublié?</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>