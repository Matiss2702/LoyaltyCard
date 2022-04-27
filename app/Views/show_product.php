<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row pt-5">
    <div class="col-lg-5 mt-5">
        <div class="card mb-3">
            <img class="card-img img-fluid" src="<?= base_url('images/'.$product['image']) ?>" alt="Card image cap" id="product-detail">
        </div>
    </div>
    <!-- col end -->
    <div class="col-lg-7 mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="h2">  <?= $product['name'] ?></h1>
                <p class="h3 py-2"><?= $product['price'] ?>€</p>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <h6>categorie:</h6>
                    </li>
                    <li class="list-inline-item">
                        <p class="text-muted"><strong><?= $product_type['name'] ?></strong></p>
                    </li>
                </ul>

                <h6>Description:</h6>
                <p><?= $product['description'] ?></p>
                    <input type="hidden" id="product-id" value="<?= $product['id'] ?>">
                    <div class="row">
                        <div class="col-auto">
                            <ul class="list-inline pb-3">
                                <li class="list-inline-item text-right">
                                    Quantity
                                    <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                </li>
                                <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col d-grid">
                            <button type="submit" class="btn btn-success btn-lg" name="submit" >Buy</button>
                        </div>
                        <div class="col d-grid">
                            <button type="submit" class="btn btn-success btn-lg" name="submit">Add To Cart</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
