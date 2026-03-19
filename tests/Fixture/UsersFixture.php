<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'email' => 'test1@mail.com',
                'password' => '123abc',
                'created' => '2026-01-15 16:56:45',
            ],
            [
                'id' => 2,
                'email' => 'test2@email.com',
                'password' => '123456',
                'created' => '2026-02-17 11:56:45',
            ],
        ];
        parent::init();
    }
}
