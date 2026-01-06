<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

final class QualificationCreateForm extends Form
{
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->requirePresence('title')
            ->notEmptyString('title', 'このフィールドに入力してください')
            ->minLength('title', 10, 'タイトルは 10 文字以上必要です')
            ->requirePresence('description')
            ->notEmptyString('description', 'このフィールドに入力してください')
            ->requirePresence('questionCount')
            ->notEmptyString('questionCount', 'このフィールドに入力してください')
            ->integer('questionCount', '数値を入力してください')
            ->greaterThanOrEqual('questionCount', 1, 'questionCount は 1 以上にしてください');

        return $validator;
    }
}
