<?php
declare(strict_types=1);

namespace App\Infrastructure\Qualification;

use App\Domain\Qualification\CreateQualificationRequest;
use App\Domain\Qualification\QualificationRepositoryInterface;
use Cake\ORM\TableRegistry;
use RuntimeException;

final class QualificationRepository implements QualificationRepositoryInterface
{
    public function create(CreateQualificationRequest $req): array
    {
        $table = TableRegistry::getTableLocator()->get('Qualifications');

        $entity = $table->newEntity([
            'title' => $req->title,
            'description' => $req->description,
            'question_count' => $req->questionCount,
        ]);

        if ($entity->hasErrors()) {
            // ドメイン例外にしてもOK。ここではシンプルに。
            throw new RuntimeException('Validation failed');
        }

        $saved = $table->saveOrFail($entity);

        return [
            'id' => (int)$saved->id,
            'title' => (string)$saved->title,
            'description' => $saved->description === null ? null : (string)$saved->description,
            'question_count' => (int)$saved->question_count,
            'created' => $saved->created?->format('c') ?? date('c'),
        ];
    }
}
