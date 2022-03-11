<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users',['identity' => true]);

        $table->addColumn('first_name','string',[

            "limit" => 100,
            'null' => false,
        ]);

       $table ->addColumn('last_name', 'string',[

            "limit" => 100,
            'null' => false,
        ]);

        $table->addTimestamps('created', 'modified');

        $table->create();
    }
}
