<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="product-table">
    <thead>
      <tr>
        <th>id</th>
        <th>orders_id</th>
        <th>products_id</th>
        <th>quantity</th>
        <th>sub_total</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($order_product as $order) : ?>
        <tr>
          <td><?= $order['id'] ?></td>
          <?php foreach ($order as $orders) : ?>
            <?php if ($orders['id'] == $order['orders_id']) : ?>
              <td><?= $order['id'] ?></td>
              <?php endif; ?>
          <?php endforeach; ?>
          <?php foreach ($products_id as $product) : ?>
              <?php if ($product['id'] == $order['products_id']) : ?>
              <td><?= $product['name'] ?></td>
              <?php endif; ?>
          <?php endforeach; ?>
          <td><?= $order['quantity'] ?></td>
          <td><?= $order['sub_total'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_order_product('<?= $order['id'] ?>', '<?= $order['orders_id'] ?>', '<?= $order['products_id'] ?>',
          '<?= $order['quantity'] ?>','<?= $order['sub_total'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $order['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
      $('#product-table').DataTable();
      $('#product-table_wrapper').addClass("none");
    });
  </script>

  <div class="modal" id="add-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add commande produit</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-price" class="form-label">price</label>
            <input class="form-control" type="float" id="add-price" name="add-price" placeholder="prix">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-orders_id" class="form-label">orders_id</label>
            <select class="form-select" id="add-orders_id" name="add-orders_id">
              <?php foreach ($orders_id as $order_id) : ?>
                <option value="<?= $order_id['id'] ?>"><?= $order_id['id'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-products_id" class="form-label">products_id</label>
            <select class="form-select" id="add-products_id" name="add-products_id">
              <?php foreach ($products_id as $product_id) : ?>
                <option value="<?= $product_id['id'] ?>"><?= $product_id['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-quantity" class="form-label">quantity</label>
            <input class="form-control" type="float" id="add-quantity" name="add-quantity" placeholder="quantity">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-sub_total" class="form-label">sub_total</label>
            <input class="form-control" type="text" id="add-sub_total" name="add-sub_total" placeholder="sub_total">
          </div>
         <button class="btn btn-primary d-flex mx-auto" onclick="add_order_product('<?php echo csrf_hash() ?>')">Se Connecter</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modify-modal" data-id="">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modifier Product</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" placeholder="id" >
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-orders_id" class="form-label">orders_id</label>
            <select class="form-select" id="modify-orders_id" name="modify-orders_id">
              <?php foreach ($orders_id as $order_id) : ?>
                <option value="<?= $order_id['id'] ?>"><?= $order_id['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-products_id" class="form-label">products_id</label>
            <select class="form-select" id="modify-products_id" name="modify-products_id">
              <?php foreach ($products_id as $product_id) : ?>
                <option value="<?= $product_id['id'] ?>"><?= $product_id['id'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-quantity" class="form-label">quantity</label>
            <input class="form-control" type="text" id="modify-quantity" name="modify-quantity" placeholder="quantity">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-sub_total" class="form-label">sub_total</label>
            <input class="form-control" type="float" id="modify-sub_total" name="modify-sub_total" placeholder="sub_total">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_order_product($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">Se Connecter</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="delete-modal" data-id="">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">delete Product</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer cette commande de produit ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_order_product($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
          <button class="btn btn-danger d-flex mx-auto" data-bs-dismiss="modal">cancel</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
