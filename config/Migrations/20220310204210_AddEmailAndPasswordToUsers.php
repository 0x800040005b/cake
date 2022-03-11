<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddEmailAndPasswordToUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('email','string',[
            'null' => false,
            'default' => null,
            'after' => 'is_active',
        ])
        ->addColumn('password', 'string',[
            'default' => null,
            'null' => false,
            'length' => 255,
            'after' => 'email',
        ])
        ->addIndex(['email'], ['unique' => true]);
        $table->update();
    }
}
