<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Partner</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Partner</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="utilisateur-table">
    <thead>
      <tr>
        <th>id</th>
        <th>lastname</th>
        <th>firstname</th>
        <th>password</th>
        <th>mail</th>
        <th>group_id</th>
        <th>company_id</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($partner as $partners) : ?>
        <tr>
          <td><?= $partners['id'] ?></td>
          <td><?= $partners['lastname'] ?></td>
          <td><?= $partners['firstname'] ?></td>
          <td><?= $partners['password'] ?></td>
          <td><?= $partners['mail'] ?></td>d>
          <?php foreach ($group_id as $role) : ?>
            <?php if ($role['id'] == $partners['group_id']) : ?>
              <td><?= $role['name'] ?></td>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php foreach ($company_id as $company) : ?>
            <?php if ($company['id'] == $partners['company_id']) : ?>
              <td><?= $company['company_name'] ?></td>
            <?php endif; ?>
          <?php endforeach; ?>
          <td><?= $partners['status'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_partner('<?= $partners['id'] ?>', '<?= $partners['lastname'] ?>', '<?= $partners['firstname'] ?>', '<?= $partners['password'] ?>',
          '<?= $partners['mail'] ?>', '<?= $partners['group_id'] ?>', '<?= $partners['company_id'] ?>',
          '<?= $partners['status'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $partners['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add partner</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-fistname" class="form-label">firstname</label>
            <input class="form-control" type="text" id="add-firstname" name="add-fristname" placeholder="prenom">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-lastname" class="form-label">lastname</label>
            <input class="form-control" type="text" id="add-lastname" name="add-lastname" placeholder="nom">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-password" class="form-label">password</label>
            <input class="form-control" type="password" id="add-password" name="add-password" placeholder="password">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-mail" class="form-label">mail</label>
            <input class="form-control" type="float" id="add-mail" name="add-mail" placeholder="mail">
          </div>
          <select class="form-select" id="add-group_id" name="add-group_id">
              <?php foreach ($group_id as $role) : ?>
                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
              <?php endforeach; ?>
            </select>
            <select class="form-select" id="add-group_id" name="add-group_id">
              <?php foreach ($company_id as $company) : ?>
                <option value="<?= $company['id'] ?>"><?= $company['company_name'] ?></option>
              <?php endforeach; ?>
            </select>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="add-check-status">
              <label class="form-check-label" for="add-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_partner('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier partner</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $partners['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-firstname" class="form-label">firstname</label>
            <input class="form-control" type="text" id="modify-firstname" name="modify-firstname" value="<?= $partners['firstname'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-lastname" class="form-label">lastname</label>
            <input class="form-control" type="float" id="modify-lastname" name="modify-lastname" value="<?= $partners['lastname'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-password" class="form-label">password</label>
            <input class="form-control" type="password" id="modify-password" name="modify-password" value="<?= $partners['password'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-mail" class="form-label">mail</label>
            <input class="form-control" type="float" id="modify-mail" name="modify-mail" value="<?= $partners['mail'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-group_id" class="form-label">group</label>
            <select class="form-select" id="modify-group_id" name="modify-group_id">
              <?php foreach ($group_id as $role) : ?>
                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-company_id" class="form-label">company_id</label>
            <select class="form-select" id="modify-company_id" name="modify-company_id">
              <?php foreach ($company_id as $company) : ?>
                <option value="<?= $company['id'] ?>"><?= $company['company_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="modify-check-status">
              <label class="form-check-label" for="modify-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_partner($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete partner</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce partenaire ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_partner($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
