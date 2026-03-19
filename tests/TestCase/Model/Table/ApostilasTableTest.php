<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApostilasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApostilasTable Test Case
 */
class ApostilasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApostilasTable
     */
    protected $Apostilas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Apostilas',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Apostilas') ? [] : ['className' => ApostilasTable::class];
        $this->Apostilas = $this->getTableLocator()->get('Apostilas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Apostilas);

        parent::tearDown();
    }

    public function testSaveApostila(): void
    {
        $apostilaCriada = [
            'user_id' => 1,
            'name' => 'Suzuki Vol.2',
            'nivel' => 'Intermediario',
            'arquivo' => 'Suzuki Violin Method - Vol. 02.pdf',
            'created' => '2026-04-15 12:14:10'
        ];

        $apostila = $this->Apostilas->newEntity($apostilaCriada);
        $result = $this->Apostilas->save($apostila);

        $this->assertNotFalse($result);
    }

    public function testUserExiste(): void
    {
        $apostilaCriada = [
            'user_id' => 500,
            'name' => 'Suzuki Vol.2',
            'nivel' => 'Intermediario',
            'arquivo' => 'Suzuki Violin Method - Vol. 01.pdf',
            'created' => '2026-04-15 12:14:10'
        ];

        $apostila = $this->Apostilas->newEntity($apostilaCriada);
        $result = $this->Apostilas->save($apostila);

        $this->assertFalse($result);
    }
}
