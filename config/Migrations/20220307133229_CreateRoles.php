<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRoles extends AbstractMigration
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
        $table = $this->table('roles',['identity' => true]);
        $table->addColumn('name','string',[
            'limit' => 100,
            'default' => null,
            'null' => false
        ]);

        $table->addTimestamps('created','modified');
        
        $table->create();
    }
}
