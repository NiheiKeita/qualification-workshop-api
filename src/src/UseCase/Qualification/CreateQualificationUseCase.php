<?php
declare(strict_types=1);

namespace App\UseCase\Qualification;

use App\Domain\Qualification\CreateQualificationRequest;
use App\Domain\Qualification\CreateQualificationResponse;
use App\Domain\Qualification\QualificationRepositoryInterface;
use InvalidArgumentException;

final class CreateQualificationUseCase
{
    public function __construct(
        private QualificationRepositoryInterface $repo
    ) {}

    public function execute(CreateQualificationRequest $req): CreateQualificationResponse
    {
        // ここでアプリ都合のバリデーション（例：問題数の範囲など）
        if ($req->title === '') {
            throw new InvalidArgumentException('title is required');
        }
        if ($req->questionCount < 1 || $req->questionCount > 100) {
            throw new InvalidArgumentException('questionCount must be 1..100');
        }

        $row = $this->repo->create($req);

        return new CreateQualificationResponse(
            id: $row['id'],
            title: $row['title'],
            description: $row['description'],
            questionCount: $row['question_count'],
            createdAt: $row['created'],
        );
    }
}
