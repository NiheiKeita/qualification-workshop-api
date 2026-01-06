<?php
declare(strict_types=1);

namespace App\Domain\Qualification;

final class CreateQualificationResponse
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly ?string $description,
        public readonly int $questionCount,
        public readonly string $createdAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'questionCount' => $this->questionCount,
            'createdAt' => $this->createdAt,
        ];
    }
}
