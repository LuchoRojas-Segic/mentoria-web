<h1>Register</h1>

<?php $form = \app\core\widgets\Form::begin('','POST') ?>
  <?= $form->field($model, 'firstname') ?>
  <?= $form->field($model, 'lastname') ?>
  <?= $form->field($model, 'email')->mailField() ?>
  <?= $form->field($model, 'password')->passwordField() ?>
  <?= $form->field($model, 'confirmPassword')->passwordField() ?>

  <button type="submit" class="btn btn-primary">Save</button>

 <?php \app\core\widgets\Form::end() ?>

