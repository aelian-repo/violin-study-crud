<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSessoes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('sessoes', [
            'collation' => 'utf8mb4_general_ci',
            'encoding' => 'utf8mb4',
        ]);

        $table->addColumn('user_id', 'integer', [
            'null' => false,
            'signed' => false,
        ]);
        $table->addColumn('apostila_id', 'integer', [
            'null' => true,
            'signed' => false,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
        ]);
        $table->addColumn('sessao_date', 'date', [
            'null' => true,
        ]);
        $table->addColumn('start_time', 'time', [
            'null' => true,
        ]);
        $table->addColumn('end_time', 'time', [
            'null' => true,
        ]);
        $table->addColumn('conteudo', 'text', [
            'null' => true,
        ]);
        $table->addColumn('objetivo', 'text', [
            'null' => true,
        ]);
        $table->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
        ]);
        $table->addForeignKey('apostila_id', 'apostilas', 'id', [
            'delete' => 'SET_NULL',
        ]);
        $table->create();
    }
}
