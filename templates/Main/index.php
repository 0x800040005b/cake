<?php

use Cake\Routing\Router;
?>

<div class="row">

  <div class="col-6 d-flex"><?=$this->Html->link(
    'Sign in',
  Router::url([
    'prefix' => false,
    'plugin' => false,
    'controller' => 'Main',
    'action' => 'login',
  ]),
    ['class' => 'btn btn-dark btn-lg'])?></div>
</div>
<div class="row">
  <div class="col-12">
<table class="table table-striped ">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Is active</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody>
   <?php
   
   foreach ($users as $user):
    $statusUser = 'circle';
    if($user->is_active){
        $statusUser = 'circle active';
    }else{
        $statusUser = 'circle inactive';
    }
    ?>

   <tr>
      <th scope="row"><?=$user->id?></th>
      <td><?=$user->first_name?></td>
      <td><?=$user->last_name?></td>
      <td><div class="<?=$statusUser?>"></div></td>
      <td><?php
      if(!empty($user->roles)):?>
      <?=$user->roles[0]->name?>
      <?php endif;?>
      </td>
    </tr>
   <?php 
   endforeach;
   ?>
  </tbody>
</table>
</div>

</div>