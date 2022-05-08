<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Utilisateur</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Utilisateur</li>
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
        <th>address</th>
        <th>city</th>
        <th>zipcode</th>
        <th>country</th>
        <th>group_id</th>
        <th>fidelity_points</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= $user['lastname'] ?></td>
          <td><?= $user['firstname'] ?></td>
          <td><?= $user['password'] ?></td>
          <td><?= $user['mail'] ?></td>
          <td><?= $user['address'] ?></td>
          <td><?= $user['city'] ?></td>
          <td><?= $user['zipcode'] ?></td>
          <td><?= $user['country'] ?></td>
          <?php foreach ($group as $role) : ?>
            <?php if ($role['id'] == $user['group_id']) : ?>
              <td><?= $role['name'] ?></td>
            <?php endif; ?>
          <?php endforeach; ?>>
          <td><?= $user['fidelity_points'] ?></td>
          <td><?= $user['status'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_user('<?= $user['id'] ?>', '<?= $user['lastname'] ?>', '<?= $user['firstname'] ?>', '<?= $user['password'] ?>',
          '<?= $user['mail'] ?>', '<?= $user['address'] ?>', '<?= $user['city'] ?>',
          '<?= $user['zipcode'] ?>', '<?= $user['country'] ?>', '<?= $user['group_id'] ?>', '<?= $user['fidelity_points'] ?>', '<?= $user['status'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $user['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add user</h4>
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
            <input class="form-control" type="text" id="add-password" name="add-password" placeholder="password">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-mail" class="form-label">mail</label>
            <input class="form-control" type="float" id="add-mail" name="add-mail" placeholder="mail">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-address" class="form-label">address</label>
           
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-city" class="form-label">city</label>
            <input class="form-control" type="float" id="add-city" name="add-city" placeholder="city">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-zipcode" class="form-label">zipcode</label>
            <input class="form-control" type="text" id="add-zipcode" name="add-zipcode" placeholder="zipcode">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-country" class="form-label">country</label>
            <input class="form-control" type="text" id="add-country" name="add-country" placeholder="country">
          </div>
          <select class="form-select" id="add-group_id" name="add-group_id">
              <?php foreach ($group as $role) : ?>
                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
              <?php endforeach; ?>
            </select>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-fidelity_points" class="form-label">fidelity_points</label>
            <input class="form-control" type="text" id="add-fidelity_points" name="add-fidelity_points" placeholder="fidelity_points">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="add-check-status">
              <label class="form-check-label" for="add-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_user('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier user</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-firstname" class="form-label">firstname</label>
            <input class="form-control" type="text" id="modify-firstname" name="modify-firstname" placeholder="firstname" value="<?= $user['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-lastname" class="form-label">lastname</label>
            <input class="form-control" type="float" id="modify-lastname" name="modify-lastname" placeholder="lastname">
          </div>
     
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-mail" class="form-label">mail</label>
            <input class="form-control" type="float" id="modify-mail" name="modify-mail" placeholder="mail">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-address" class="form-label">address</label>
            <input class="form-control" type="text" id="modify-address" name="modify-address" placeholder="address">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-city" class="form-label">city</label>
            <input class="form-control" type="text" id="modify-city" name="modify-city" placeholder="city">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-zipcode" class="form-label">zipcode</label>
            <input class="form-control" type="text" id="modify-zipcode" name="modify-zipcode" placeholder="zipcode">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-country" class="form-label">country</label>
            <input class="form-control" type="text" id="modify-country" name="modify-country" placeholder="country">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-group_id" class="form-label">group</label>
            <select class="form-select" id="modify-group_id" name="modify-group_id">
              <?php foreach ($group as $role) : ?>
                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-fidelity_points" class="form-label">fidelity_points</label>
            <input class="form-control" type="text" id="modify-fidelity_points" name="modify-fidelity_points" placeholder="fidelity_points">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="modify-check-status">
              <label class="form-check-label" for="modify-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_user($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete user</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer cette utilisateur ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_user($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
