<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Produit</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Produit</li>
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
        <th>description</th>
        <th>status</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($group as $groups) : ?>
        <tr>
          <td><?= $groups['id'] ?></td>
          <td><?= $groups['name'] ?></td>
          <td><?= $groups['description'] ?></td>
          <td><?= $groups['status'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_group('<?= $groups['id'] ?>', '<?= $groups['name'] ?>', '<?= $groups['description'] ?>', '<?= $groups['status'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $groups['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Ajout Rôle</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" placeholder="id" value="<?= $groups['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-name" class="form-label">name</label>
            <input class="form-control" type="text" id="add-name" name="add-name" placeholder="nom">
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
          <button class="btn btn-primary d-flex mx-auto" onclick="add_group('<?php echo csrf_hash() ?>')">ajouter</button>
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

          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-name" class="form-label">name</label>
            <input class="form-control" type="text" id="modify-name" name="modify-name" placeholder="nom" value="<?= $groups['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-price" class="form-label">price</label>
            <input class="form-control" type="float" id="modify-price" name="modify-price" placeholder="prix">
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
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_group($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">Se Connecter</button>
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
          <h4 class="modal-title">Delete Rôle</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce rôle ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_group($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

</div>
<?= $this->endSection() ?>
