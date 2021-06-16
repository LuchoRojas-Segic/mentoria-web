<h1>Register</h1>

<?php $form = \app\core\widgets\Form::begin('','POST') ?>
  <div class="row">
    <div class="col">
      <?= $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
      <?= $form->field($model, 'lastname') ?>
    </div>
  </div>  

  <button type="submit" class="btn btn-primary">Save</button>

 <?php \app\core\widgets\Form::end() ?>

