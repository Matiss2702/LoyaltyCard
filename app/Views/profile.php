<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">

    <p class="text-center mb-0"><?= $user['lastname']." ".$user['firstname']?></p>
    <p class="text-center mb-0"><?= $user['fidelity_points']?> <i class="fa-solid fa-euro-sign"></i></p>
  
     <label for="lastname" class="form-label">changer votre nom</label>
        <input class="form-control" value="<?= $user['lastname']?>" id="lastname" type="text" name="lastname"  required>
            <label for="firstname" class="form-label">changer votre prenom</label>
                <input class="form-control" id="firstname" value="<?=$user['firstname']?>" type="text" name="firstname" required>
                <label for="address" class="form-label">changer votre address</label>
                <input class="form-control" id="address" value="<?=$user['address']?>" type="text" name="address" required>
                <label for="zipcode" class="form-label">changer votre code postale</label>
                <input class="form-control" value="<?= $user['zipcode']?>" id="zipcode" type="text" name="zipcode" required>
                <label for="city" class="form-label">changer votre code ville</label>
                <input class="form-control" id="city" value="<?=$user['city']?>" type="text" name="city" required>
                <label for="country" class="form-label">changer votre pays</label>
                <input class="form-control" id="country" value="<?=$user['country']?>" type="text" name="country" required>
                <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="check-pwd">
                <label class="form-check-label" for="check-pwd">modifier mots de passe</label>
                </div>
                <label for="pwd" class="form-label d-none" id="lbl-pwd">mot de passe</label>
        <input class="form-control d-none" id="pwd" type="password" name="pwd" placeholder="mot de passe" required>
        <label for="pwd-confirm" class="form-label d-none" id="lbl-pwd-confirm">confirmation du mot de passe</label>
        <input class="form-control d-none" id="pwd-confirm" type="password" name="pwd-confirm" placeholder="confirmation du mot de passe" required>
        <button class="btn btn-primary d-flex mx-auto" onclick="profile('<?php echo csrf_hash() ?>')">Mettre à jours vos information</button>
</div>
<?= $this->endSection() ?>
