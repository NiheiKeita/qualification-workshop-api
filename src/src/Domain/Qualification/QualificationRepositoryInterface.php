<?php
declare(strict_types=1);

namespace App\Domain\Qualification;

interface QualificationRepositoryInterface
{
    /** @return array{id:int,title:string,description:?string,question_count:int,created:string} */
    public function create(CreateQualificationRequest $req): array;
}
