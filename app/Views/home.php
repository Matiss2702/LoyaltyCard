<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <?php 
    foreach($this->data['product'] as $key => $product){
    ?>
        <div class="col-md-3">
            <div class="card product-wap" style="border-radius: 1rem;">
                <div class="card" style="padding: 0.4rem;border-radius: 1rem;">
                  <img class="card-img img-fluid" src="images/<?= $product['image']?>" style="border-radius: 1rem;/* padding: 1rem; */">
                    <div class="card-img-overlay product-overlay d-flex align-items-center justify-content-center" style="border-radius: 1rem;/* padding:  1rem; */">
                        <ul class="list-unstyled">
                            <li><a class="btn btn-success text-white mt-2" href="/product/<?= $product['id']?>"><i class="fa-solid fa-eye"></i></a></li>
                            <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fa-solid fa-cart-shopping"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                 <a href="/product/<?= $product['id']?>" class="h3 text-decoration-none"><?= $product['name']?></a>
                 <p class="text-center mb-0"><?= $product['price']?> <i class="fa-solid fa-euro-sign"></i></p>
                </div>
            </div>
        </div>
    <?php }?>
</div>
<?= $this->endSection() ?>
