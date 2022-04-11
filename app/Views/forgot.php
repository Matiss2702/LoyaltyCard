<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <input id="reset-id" type="hidden" value="<?= $id?>">
    <label for="exampleInputemail1" class="form-label">new password</label>
    <input class="form-control" id="reset-password" type="password" name="mail" placeholder="nouveau password" required>
    <label for="exampleInputemail1" class="form-label">confirm password</label>
    <input class="form-control" id="reset-confirm-password" type="password" name="mail" placeholder="confirmation du nouveau password" required>
    <button class="btn btn-primary d-flex mx-auto" onclick="forgot('<?php echo csrf_hash() ?>')">changer le mots de passe</button>
</div>
<?= $this->endSection() ?>
