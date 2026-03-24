<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SessoesFixture
 */
class SessoesFixture extends TestFixture
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
                'apostila_id' => 1,
                'name' => 'Sessão 01',
                'created' => '2026-01-15 17:25:15',
                'sessao_date' => '2026-01-17',
                'start_time' => '11:00:00',
                'end_time' => '13:30:00',
                'conteudo' => 'Conteúdo 01',
                'objetivo' => 'Objetivo 01',
            ],
            [
                'user_id' => 2,
                'apostila_id' => 2,
                'name' => 'Sessão 11',
                'created' => '2026-02-19 14:25:15',
                'sessao_date' => '2026-02-20',
                'start_time' => '13:00:00',
                'end_time' => '15:30:00',
                'conteudo' => 'Conteúdo 02',
                'objetivo' => 'Objetivo 02',
            ],
        ];
        parent::init();
    }
}
