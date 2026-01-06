<?php
declare(strict_types=1);

namespace App\Domain\Qualification;

use InvalidArgumentException;

final class CreateQualificationRequest
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly int $questionCount,
    ) {
        $this->defaultValidation();
    }

    private function defaultValidation(): void
    {
        if ($this->title === '') {
            throw new InvalidArgumentException('title is required');
        }
        if ($this->description === '') {
            throw new InvalidArgumentException('description is required');
        }
        if ($this->questionCount < 1) {
            throw new InvalidArgumentException('questionCount must be >= 1');
        }
    }
}
