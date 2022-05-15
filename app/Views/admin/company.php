<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Company</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Company</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="product-table">
    <thead>
      <tr>
        <th>id</th>
        <th>company_name</th>
        <th>address</th>
        <th>city</th>
        <th>zipcode</th>
        <th>country</th>
        <th>subcription</th>
        <th>subcription_date</th>
        <th>status</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($companys as $company) : ?>
        <tr>
          <td><?= $company['id'] ?></td>
          <td><?= $company['company_name'] ?></td>
          <td><?= $company['address'] ?></td>
          <td><?= $company['city'] ?></td>
          <td><?= $company['zipcode'] ?></td>
          <td><?= $company['country'] ?></td>
          <td><?= $company['subcription'] ?></td>
          <td><?= $company['subcription_date'] ?></td>
          <td><?= $company['status'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_company('<?= $company['id'] ?>', '<?= $company['company_name'] ?>', '<?= $company['address'] ?>',
          '<?= $company['address'] ?>', '<?= $company['city'] ?>', '<?= $company['zipcode'] ?>', '<?= $company['subcription'] ?>', '<?= $company['subcription_date'] ?>','<?= $company['status'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $company['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add company</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" placeholder="id" value="<?= $company['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-company_name" class="form-label">company_name</label>
            <input class="form-control" type="text" id="add-company_name" name="add-company_name" placeholder="company_name">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-address" class="form-label">address</label>
            <input class="form-control" type="float" id="add-address" name="add-address" placeholder="address">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-city" class="form-label">city</label>
            <input class="form-control" type="float" id="add-city" name="add-city" placeholder="city">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-zipcode" class="form-label">zipcode</label>
            <input class="form-control" type="float" id="add-zipcode" name="add-zipcode" placeholder="zipcode">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-country" class="form-label">country</label>
            <input class="form-control" type="float" id="add-country" name="add-country" placeholder="country">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-subcription" class="form-label">subcription</label>
            <input class="form-control" type="float" id="add-subcription" name="add-subcription" placeholder="subcription">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-subcription_date" class="form-label">subcription_date</label>
            <input class="form-control" type="text" id="add-subcription_date" name="add-subcription_date" placeholder="subcription_date">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="add-check-status">
              <label class="form-check-label" for="add-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_company('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier company</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label">id</label>
            <input class="form-control -d none" type="text" id="modify-id" name="modify-id" placeholder="id" value="<?= $company['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-company_name" class="form-label">company_name</label>
            <input class="form-control" type="text" id="modify-company_name" name="modify-company_name" placeholder="company_name">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-address" class="form-label">address</label>
            <input class="form-control" type="float" id="modify-address" name="modify-address" placeholder="address">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-city" class="form-label">city</label>
            <input class="form-control" type="float" id="modify-city" name="modify-city" placeholder="city">
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
            <label for="modify-subcription" class="form-label">subcription</label>
            <input class="form-control" type="text" id="modify-subcription" name="modify-subcription" placeholder="subcription">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-subcription_date" class="form-label">subcription_date</label>
            <input class="form-control" type="text" id="modify-subcription_date" name="modify-subcription_date" placeholder="subcription_date">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="modify-check-status">
              <label class="form-check-label" for="modify-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_company($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">Se Connecter</button>
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
          <h4 class="modal-title">delete Company</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer cette company ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_company($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
