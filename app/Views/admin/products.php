<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class= "row pt-5">
<div class="pb-2 row">
  <a type="button" data-bs-toggle="modal" data-bs-target="#add-product" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
</div>
<table id="product-table">
    <thead>
      <tr>
        <th></th>
        <th>name</th>
        <th>price</th>
        <th>reduction</th>
        <th>type</th>
        <th>status</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($products as $product):?>
      <tr>
        <td><?= $product['id']?></td>
        <td><?= $product['name']?></td>
        <td><?= $product['price']?></td>
        <td><?= $product['reduction']?></td>
        <?php foreach($productTypes as $type):?>
          <?php if($type['id'] == $product['product_types_id']):?>
            <td><?= $type['name']?></td>
          <?php endif;?>   
        <?php endforeach;?>
        <td><?= $product['status']?></td>
        <td><button type="button" class="btn btn-outline-success"><i class="fa-solid fa-pen"></i></button></td>
        <td><button type="button" class="btn btn-outline-success delete-product" data-id="<?= $product['id']?>" data-bs-toggle="modal" ><i class="fa-solid fa-trash-can"></i></button></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <script>
    $(document).ready(function () {
      $('#product-table').DataTable();
      $('#product-table_wrapper').addClass("none");
    });
  </script>
   <div class="modal" id="add-product">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
        </div>

        <!-- Modal body -->
        <div class="modal-body"> 
            <div class="mb-3 d-grid text-center form-group">
                <img src="<?= base_url('images/default.png')?>" alt="product" class="img-fluid" id="img">
                <input class="form-control" type="file" id="image" name="image" placeholder="image">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="name" class="form-label">name</label>
                <input class="form-control" type="text" id="name" name="name" placeholder="nom">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="price" class="form-label">price</label>
                <input class="form-control" type="float" id="price" name="price" placeholder="prix">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="product_type_id" class="form-label">product_types_id</label>
                <select class="form-select" id="product_type_id" name="product_type_id">
                  <?php foreach($productTypes as $type):?>
                    <option value="<?= $type['id']?>"><?= $type['name']?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="reduction" class="form-label">reduction</label>
                <input class="form-control" type="float" id="reduction" name="reduction" placeholder="reduction">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <label for="description" class="form-label">description</label>
                <input class="form-control" type="text" id="description" name="description" placeholder="description">
              </div>
              <div class="mb-3 d-grid text-center form-group">
                <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="check-status">
                <label class="form-check-label" for="check-status">status</label>
                </div>
              </div>
              <button class="btn btn-primary d-flex mx-auto" onclick="add_product('<?php echo csrf_hash() ?>')">Se Connecter</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="delete-product" data-id="">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">delete Product</h4>
        </div>

        <!-- Modal body -->
        <div class="modal-body"> 
            <div class="mb-3 d-grid text-center form-group">
              êtes vous sûr de vouloir supprimer ce produit ?
            </div>
              <button class="btn btn-primary d-flex mx-auto" onclick="delete_product($('#delete-product').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
              <button class="btn btn-danger d-flex mx-auto" data-bs-dismiss="delete-product">cancel</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>