<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sesso Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $apostila_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenDate|null $sessao_date
 * @property \Cake\I18n\Time|null $start_time
 * @property \Cake\I18n\Time|null $end_time
 * @property string|null $conteudo
 * @property string|null $objetivo
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Apostila $apostila
 */
class Sesso extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'user_id' => true,
        'apostila_id' => true,
        'name' => true,
        'created' => true,
        'sessao_date' => true,
        'start_time' => true,
        'end_time' => true,
        'conteudo' => true,
        'objetivo' => true,
        'user' => true,
        'apostila' => true,
    ];

    protected function _getDuracao()
    {
        if (!$this->start_time || !$this->end_time) {
            return null;
        }

        $inicio = strtotime((string)$this->start_time);
        $fim = strtotime((string)$this->end_time);

        $diff = $fim - $inicio;

        $horas = floor($diff / 3600);
        $minutos = floor(($diff % 3600) / 60);

        return sprintf('%02d:%02d', $horas, $minutos);
    }
}
