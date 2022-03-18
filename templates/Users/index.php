<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
if(!empty($loggedUser)):

 
 ?>
 


 

<div class="users index content">
    <h4 class="message-error"><?=$this->Flash->render()?></h4>
    <div class="row">
        <div class="col">
            <div class="content d-flex mb-3">
                <h4 class="content__data"><?=$loggedUser->first_name?></h4>
                <h4 class="content__data"><?=$loggedUser->last_name?></h4>
            </div>


        </div>
        <div class="col">
            <div class="content d-flex mb-3">
                <h4 class="content__data">Role: </h4>
                <h4 class="content__data"><?=$loggedUser->getRole()?></h4>
            </div>
        </div>
    </div>
<div class="row">
    <div class="d-grid gap-2">
        <?php if($loggedUser->is_admin()): ?>
    <?= $this->Html->link(__('Add User'), ['controller' => 'Users','action' => 'add'], ['class' => 'btn btn-success']) ?>
    <?php endif; ?>
    <?= $this->Html->link(__('Logout'), ['controller' => 'Main','action' => 'logout'], ['class' => 'btn btn-danger']) ?>

    </div>
</div>
    <h3><?= __('Users') ?></h3>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user):
                $statusUser = 'circle';
                if($user->is_active){
                    $statusUser = 'circle active';
                }else{
                    $statusUser = 'circle inactive';
                }
                     
                ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->first_name) ?></td>
                    <td><?= h($user->last_name) ?></td>
                    <?php
                     
                    ?>
                    <td><div class="<?= $statusUser?>"></div></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id],['class' => 'btn btn-dark']) ?>
                        <?php
                        if($loggedUser->is_admin()):?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],['class' => 'btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],['class' => 'btn btn-danger'], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                        
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->numbers() ?>

        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

<?php
    
 endif; ?>
