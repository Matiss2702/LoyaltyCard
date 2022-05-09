<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">abonnement</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Abonnement</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="product-table">
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>nb_users</th>
        <th>description</th>
        <th>status</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($subcription as $abonnement) : ?>
        <tr>
          <td><?= $abonnement['id'] ?></td>
          <td><?= $abonnement['name'] ?></td>
          <td><?= $abonnement['price'] ?></td>
          <td><?= $abonnement['nb_users'] ?></td>
          <td><?= $abonnement['description'] ?></td>
          <td><?= $product['status'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_subcription('<?= $abonnement['id'] ?>', '<?= $abonnement['name'] ?>', '<?= $abonnement['price'] ?>',
          '<?= $abonnement['nb_users'] ?>', '<?= $abonnement['productdescription'] ?>', '<?= $abonnement['status'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $product['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" placeholder="id" value="<?= $product['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-name" class="form-label">name</label>
            <input class="form-control" type="text" id="add-name" name="add-name" placeholder="nom">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-price" class="form-label">price</label>
            <input class="form-control" type="float" id="add-price" name="add-price" placeholder="prix">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-product-type" class="form-label">product_types_id</label>
            <select class="form-select" id="add-product-type" name="add-product-type">
              <?php foreach ($productTypes as $type) : ?>
                <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-reduction" class="form-label">reduction</label>
            <input class="form-control" type="float" id="add-reduction" name="add-reduction" placeholder="reduction">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-description" class="form-label">description</label>
            <input class="form-control" type="text" id="add-description" name="add-description" placeholder="description">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="add-check-status">
              <label class="form-check-label" for="add-check-status">status</label>
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
            <img src="<?= base_url('images/default.png') ?>" alt="product" class="img-fluid" id="modify-img" onclick="img_data('update')" data-bs-toggle="modal" data-bs-target="#image-modal">
            <span>Cliquez pour modifier l'image</span>
            <input type="hidden" id="modify-hidden-img">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-name" class="form-label">name</label>
            <input class="form-control" type="text" id="modify-name" name="modify-name" placeholder="nom" value="<?= $product['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-price" class="form-label">price</label>
            <input class="form-control" type="float" id="modify-price" name="modify-price" placeholder="prix">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-product-type" class="form-label">product_types_id</label>
            <select class="form-select" id="modify-product-type" name="modify-product-type">
              <?php foreach ($productTypes as $type) : ?>
                <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-reduction" class="form-label">reduction</label>
            <input class="form-control" type="float" id="modify-reduction" name="modify-reduction" placeholder="reduction">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-description" class="form-label">description</label>
            <input class="form-control" type="text" id="modify-description" name="modify-description" placeholder="description">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="modify-check-status">
              <label class="form-check-label" for="modify-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_product($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">Se Connecter</button>
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
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_product($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
          <button class="btn btn-danger d-flex mx-auto" data-bs-dismiss="modal">cancel</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="image-modal" data-status="">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Changer l'image du produit</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="upload-file" method="post" enctype="multipart/form-data">
            <div class="mb-3 d-grid text-center form-group">
              <img src="<?= base_url('images/default.png') ?>" id="preview">
              <input class="form-control" type="file" id="file-name" name="file" placeholder="">
            </div>
          </form>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_image('<?php echo csrf_hash() ?>')">Ajouter l'Image</button>
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
