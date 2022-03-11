<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * User seed.
 */
class UserSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'first_name' => 'Maria',
                'last_name' => 'Mathea',
                'is_active' => 0,
                'email' => 'maria@test.com',
                'password' => password_hash('1111',PASSWORD_BCRYPT),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),

            ],
            [
                'first_name' => 'Mark',
                'last_name' => 'Luman',
                'is_active' => 1,
                'email' => 'mark@test.com',
                'password' => password_hash('2222',PASSWORD_BCRYPT),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),


            ],
            [
                'first_name' => 'Colin',
                'last_name' => 'MC Ray',
                'is_active' => 1,
                'email' => 'colin@test.com',
                'password' => password_hash('3333',PASSWORD_BCRYPT),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),

            ],
            [
                'first_name' => 'Mad',
                'last_name' => 'Max',
                'is_active' => 0,
                'email' => 'mad@test.com',
                'password' => password_hash('4444',PASSWORD_BCRYPT),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),

            ],
            
        ];

        $table = $this->table('users');

        $table->insert($data)->save();
    }
}
