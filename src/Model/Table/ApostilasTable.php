<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Apostilas Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\SessoesTable&\Cake\ORM\Association\HasMany $Sessoes
 * @property \App\Model\Table\SessoesTable $Sessoes
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\Apostila newEmptyEntity()
 * @method \App\Model\Entity\Apostila newEntity(array<string, mixed> $data, array<string, mixed> $options = [])
 * @method \App\Model\Entity\Apostila[] newEntities(array<int, array<string, mixed>> $data, array<string, mixed> $options = [])
 * @method \App\Model\Entity\Apostila get($primaryKey, $options = [])
 * @method \App\Model\Entity\Apostila findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Apostila patchEntity(\Cake\Datasource\EntityInterface $entity, array<string, mixed> $data, array<string, mixed> $options = [])
 * @method \App\Model\Entity\Apostila[] patchEntities(iterable<\App\Model\Entity\Apostila> $entities, array<int, array<string, mixed>> $data, array<string, mixed> $options = [])
 * @method \App\Model\Entity\Apostila|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Apostila saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Apostila[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable<\App\Model\Entity\Apostila> $entities, array<string, mixed> $options = [])
 * @method \App\Model\Entity\Apostila[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable<\App\Model\Entity\Apostila> $entities, array<string, mixed> $options = [])
 * @method \App\Model\Entity\Apostila[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable<\App\Model\Entity\Apostila> $entities, array<string, mixed> $options = [])
 * @method \App\Model\Entity\Apostila[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable<\App\Model\Entity\Apostila> $entities, array<string, mixed> $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApostilasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('apostilas');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Sessoes', [
            'foreignKey' => 'apostila_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'O nome da apostila é obrigatório');

        $validator
            ->scalar('nivel')
            ->maxLength('nivel', 255)
            ->requirePresence('nivel', 'create')
            ->inList('dificuldade', ['Iniciante', 'Intermediario', 'Avancado'])
            ->notEmptyString('nivel');

        $validator
            ->scalar('arquivo')
            ->maxLength('arquivo', 255)
            ->requirePresence('arquivo', 'create')
            ->notEmptyString('arquivo', 'Faça upload de um arquivo PDF');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
