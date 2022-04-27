<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class= "row pt-5">
<div class="pb-2 row">
  <button type="button" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></button>
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
        <td><button type="button" class="btn btn-outline-success"><i class="fa-solid fa-trash-can"></i></button></td>
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
</div>
<?= $this->endSection() ?>