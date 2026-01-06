<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Qualifications Model
 *
 * @method \App\Model\Entity\Qualification newEmptyEntity()
 * @method \App\Model\Entity\Qualification newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Qualification> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Qualification get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Qualification findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Qualification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Qualification> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Qualification|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Qualification saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Qualification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Qualification>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Qualification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Qualification> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Qualification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Qualification>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Qualification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Qualification> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QualificationsTable extends Table
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

        $this->setTable('qualifications');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('question_count')
            ->notEmptyString('question_count');

        return $validator;
    }
}
