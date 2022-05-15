<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Commande</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Commande</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="product-table">
    <thead>
      <tr>
        <th>id</th>
        <th>invoice_prefix</th>
        <th>invoice_no</th>
        <th>users_id</th>
        <th>total</th>
        <th>reduction</th>
        <th>payment_country</th>
        <th>payment_firstname</th>
        <th>payment_lastname</th>
        <th>payment_address</th>
        <th>payment_city</th>
        <th>payment_zipcode</th>
        <th>comment</th>
        <th>status</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $order) : ?>
        <tr>
          <td><?= $order['id'] ?></td>
          <td><?= $order['invoice_prefix'] ?></td>
          <td><?= $order['invoice_no'] ?></td>
          <?php foreach ($users_id as $user) : ?>
            <?php if ($user['id'] == $order['users_id']) : ?>
              <td><?= $user['name'] ?></td>
            <?php endif; ?>
          <?php endforeach; ?>
          <td><?= $order['total'] ?></td>
          <td><?= $order['reduction'] ?></td>
          <td><?= $order['payment_country'] ?></td>
          <td><?= $order['payment_firstname'] ?></td>
          <td><?= $order['payment_lastname'] ?></td>
          <td><?= $order['payment_address'] ?></td>
          <td><?= $order['payment_city'] ?></td>
          <td><?= $order['payment_zipcode'] ?></td>
          <td><?= $order['comment'] ?></td>
          <td><?= $order['status'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_order('<?= $order['id'] ?>', '<?= $order['invoice_prefix'] ?>', '<?= $order['invoice_no'] ?>',
          '<?= $order['users_id'] ?>', '<?= $order['total'] ?>', '<?= $order['reduction'] ?>', '<?= $order['payment_country'] ?>', '<?= $order['payment_firstname'] ?>', '<?= $order['payment_lastname'] ?>',, '<?= $order['payment_address'] ?>',, '<?= $order['payment_city'] ?>',, '<?= $order['payment_zipcode'] ?>',, '<?= $order['comment'] ?>',)" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
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
          <h4 class="modal-title">Add Commande</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" placeholder="id">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-invoice_prefix" class="form-label">invoice_prefix</label>
            <input class="form-control" type="text" id="add-invoice_prefix" name="add-invoice_prefix" placeholder="invoice_prefix">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-invoice_no" class="form-label">invoice_no</label>
            <input class="form-control" type="float" id="add-invoice_no" name="add-invoice_no" placeholder="invoice_no">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-user_id" class="form-label">user_id</label>
            <select class="form-select" id="add-user_id" name="add-user_id">
              <?php foreach ($users_id as $user) : ?>
                <option value="<?= $user['id'] ?>"><?= $user['mail'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-total" class="form-label">total</label>
            <input class="form-control" type="float" id="add-total" name="add-total" placeholder="total">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-reduction" class="form-label">reduction</label>
            <input class="form-control" type="float" id="add-reduction" name="add-reduction" placeholder="reduction">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-payment_country" class="form-label">payment_country</label>
            <input class="form-control" type="float" id="add-payment_country" name="add-payment_country" placeholder="payment_country">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-payment_firstname" class="form-label">payment_firstname</label>
            <input class="form-control" type="float" id="add-payment_firstname" name="add-payment_firstname" placeholder="payment_firstname">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-payment_lastname" class="form-label">payment_lastname</label>
            <input class="form-control" type="text" id="add-payment_lastname" name="add-payment_lastname" placeholder="payment_lastname">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-payment_address" class="form-label">payment_address</label>
            <input class="form-control" type="float" id="add-payment_address" name="add-payment_address" placeholder="payment_address">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-payment_city" class="form-label">payment_city</label>
            <input class="form-control" type="float" id="add-payment_city" name="add-payment_city" placeholder="payment_city">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-payment_zipcode" class="form-label">payment_zipcode</label>
            <input class="form-control" type="float" id="add-payment_zipcode" name="add-payment_zipcode" placeholder="payment_zipcode">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-comment" class="form-label">comment</label>
            <input class="form-control" type="float" id="add-comment" name="add-comment" placeholder="comment">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="add-check-status">
              <label class="form-check-label" for="add-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_order('<?php echo csrf_hash() ?>')">Se Connecter</button>
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
          <h4 class="modal-title">Modifier Commande</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
   
        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" >
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-invoice_prefix" class="form-label">invoice_prefix</label>
            <input class="form-control" type="float" id="modify-invoice_prefix" name="modify-invoice_prefix" placeholder="invoice_prefix">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-invoice_no" class="form-label">invoice_no</label>
            <input class="form-control" type="float" id="modify-invoice_no" name="modify-invoice_no" placeholder="invoice_no">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-product-type" class="form-label">users_id</label>
            <select class="form-select" id="modify-product-type" name="modify-product-type">
              <?php foreach ($users_id as $user) : ?>
                <option value="<?= $user['id'] ?>"><?= $user['mail'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>  
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-total" class="form-label">total</label>
            <input class="form-control" type="text" id="modify-total" name="modify-total" placeholder="total">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-reduction" class="form-label">reduction</label>
            <input class="form-control" type="text" id="modify-reduction" name="modify-reduction" placeholder="reduction">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-payment_country" class="form-label">payment_country</label>
            <input class="form-control" type="text" id="modify-payment_country" name="modify-payment_country" placeholder="payment_country">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-payment_firstname" class="form-label">payment_firstname</label>
            <input class="form-control" type="text" id="modify-payment_firstname" name="modify-payment_firstname" placeholder="payment_firstname">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-payment_lastname" class="form-label">payment_lastname</label>
            <input class="form-control" type="text" id="modify-payment_lastname" name="modify-payment_lastname" placeholder="payment_lastname">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-payment_address" class="form-label">payment_address</label>
            <input class="form-control" type="text" id="modify-payment_address" name="modify-payment_address" placeholder="payment_address">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-payment_city" class="form-label">payment_city</label>
            <input class="form-control" type="text" id="modify-payment_city" name="modify-payment_city" placeholder="payment_city">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-payment_zipcode" class="form-label">payment_zipcode</label>
            <input class="form-control" type="text" id="modify-payment_zipcode" name="modify-payment_zipcode" placeholder="payment_zipcode">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-comment" class="form-label">comment</label>
            <input class="form-control" type="text" id="modify-comment" name="modify-comment" placeholder="comment">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="modify-check-status">
              <label class="form-check-label" for="modify-check-status">status</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_order($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">Se Connecter</button>
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
          <h4 class="modal-title">delete Commande</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer cette commande ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_order($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
