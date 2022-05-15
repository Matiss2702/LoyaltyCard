<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">stock</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">stock</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="product-table">
    <thead>
      <tr>
        <th></th>
        <th>warehouses_id</th>
        <th>products_id</th>
        <th>quantity</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($stock as $stocks) : ?>
        <tr>
        <?php foreach ($warehouses_id as $warehouses) : ?>
            <?php if ($warehouses['id'] == $stocks['warehouses_id']) : ?>
              <td><?= $warehouses['name'] ?></td>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php foreach ($products_id as $product) : ?>
            <?php if ($product['id'] == $stocks['products_id']) : ?>
              <td><?= $product['name'] ?></td>
            <?php endif; ?>
          <?php endforeach; ?>
          <td><?= $stocks['quantity'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_stock('<?= $stocks['warehouses_id'] ?>', '<?= $stocks['products_id'] ?>', '<?= $stocks['quantity'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $stocks['warehouses_id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add Stock</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="add-warehouses_id" class="form-label">warehouses_id</label>
            <select class="form-select" id="add-warehouses_id" name="add-warehouses_id">
              <?php foreach ($warehouses_id as $warehouses) : ?>
                <option value="<?= $warehouses['id'] ?>"><?= $warehouses['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-products_id" class="form-label">products_id</label>
            <input class="form-control" type="text" id="add-products_id" name="add-products_id" placeholder="products_id">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-product-type" class="form-label">products_id</label>
            <select class="form-select" id="add-product-type" name="add-product-type">
              <?php foreach ($products_id as $product) : ?>
                <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-quantity" class="form-label">quantity</label>
            <input class="form-control" type="float" id="add-quantity" name="add-quantity" placeholder="quantity">
              </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_stock('<?php echo csrf_hash() ?>')">Se Connecter</button>
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
            <label for="modify-warehouses_id" class="form-label">warehouses_id</label>
            <select class="form-select" id="modify-warehouses_id" name="modify-warehouses_id">
              <?php foreach ($warehouses_id as $warehouses) : ?>
                <option value="<?= $warehouses['id'] ?>"><?= $warehouses['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-products_id" class="form-label">products_id</label>
            <select class="form-select" id="modify-products_id" name="modify-products_id">
              <?php foreach ($products_id as $product) : ?>
                <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-quantity" class="form-label">quantity</label>
            <input class="form-control" type="text" id="modify-quantity" name="modify-quantity" placeholder="quantity">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_stock($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">Se Connecter</button>
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
          <h4 class="modal-title">delete stock</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce stock ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_stock($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
