<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApostilasFixture
 */
class ApostilasFixture extends TestFixture
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
                'user_id' => 1,
                'name' => 'Suzuki Vol.1',
                'nivel' => 'Iniciante',
                'arquivo' => '1771853405_Suzuki Violin Method - Vol. 01.pdf',
                'created' => '2026-01-15 17:14:10',
            ],
            [
                'user_id' => 2,
                'name' => 'Violin Star Vol.2',
                'nivel' => 'Avancado',
                'arquivo' => 'violinstart2.pdf',
                'created' => '2026-02-18 14:19:20',
            ],
        ];
        parent::init();
    }
}
