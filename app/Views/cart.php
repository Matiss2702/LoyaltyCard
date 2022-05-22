<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <?php var_dump($cart);?>
        <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>sub_total</th>
                <th>image</th>
                <th>reduction</th>
                <th>quantity</th>
                <th>description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cart as $key => $product):?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['sub_total'] ?></td>
                    <td><img  src="<?= base_url('images/'.$product['image']) ?>" alt="Card image cap" id="product-detail"></td>
                    <td><?= $product['reduction'] ?></td>
                    <td><?= $product['quantity'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><button type="button" class="btn btn-outline-success" onclick="modify_cart('<?= $product['id'] ?>','<?= $product['quantity'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
                    <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $product['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>  
            <?php endforeach; ?>
        </tbody>
    </table>
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
            <label for="modify-quantity" class="form-label">quantity</label>
            <input class="form-control" type="number" id="modify-quantity" name="modify-quantity">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_cart($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">Modifié</button>
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
            êtes vous sûr de vouloir supprimer ce produit ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_cart($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
          <button class="btn btn-danger d-flex mx-auto" data-bs-dismiss="modal">cancel</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>
