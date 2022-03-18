<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 */
?>
<div class="row">
    <aside class="col">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item btn btn-outline-secondary']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <div class="row mb-3">

                    <div class="col">

                        <?= $this->Form->control('first_name', [

                            'class' => 'form-control',
                            'id' => 'first_name',
                            'name' => 'first_name',
                            'required' => true,
                            'placeholder' => 'Enter First name',
                            'label' => [

                                'class' => [

                                    'form-label'
                                ],

                            ]

                        ]); ?>

                    </div>
                </div>


                <div class="row mb-3">

                    <div class="col">

                        <?= $this->Form->control('last_name', [

                            'class' => 'form-control',
                            'id' => 'last_name',
                            'name' => 'last_name',
                            'required' => true,
                            'placeholder' => 'Enter last name',
                            'label' => [

                                'class' => [

                                    'form-label'
                                ],

                            ]

                        ]); ?>

                    </div>
                </div>


                <div class="row mb-3">

                    <div class="col">

                        <?= $this->Form->control('email', [

                            'class' => '',
                            'id' => 'email',
                            'name' => 'email',
                            'placeholder' => 'Enter Email',
                            'class' => 'form-control',
                            'type' => 'email',
                            'label' => [

                                'class' => [

                                    'form-label'
                                ],

                            ]

                        ]); ?>

                    </div>
                </div>


                <div class="row mb-3">

                    <div class="col">

                        <?= $this->Form->control('password', [

                            'class' => '',
                            'id' => 'password',
                            'name' => 'password',
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => 'Enter password',
                            'label' => [

                                'class' => [

                                    'form-label'
                                ],

                            ]

                        ]); ?>

                    </div>
                </div>


                <div class="row mb-3">

                    <div class="col">

                        <?= $this->Form->control('roles._ids', ['options' => $roles, 'class' => 'form-control', 'multiple' => false]) ?>

                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col">

                        <div class="form-check form-switch">
                            <?= $this->Form->control('is_active', [

                                'class' => 'form-check-input',
                                'id' => 'is_active',
                                'name' => 'is_active',
                                'role' => 'switch',
                                'label' => [

                                    'class' => [

                                        'form-check-label'
                                    ],

                                ]

                            ]); ?>
                        </div>

                    </div>
                </div>






            </fieldset>
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success btn-lg']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>