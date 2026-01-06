<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateQualifications extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('qualifications');

        $table
            ->addColumn('title', 'string', [
                'limit' => 255,
                'null' => false,
                'comment' => '資格名',
            ])
            ->addColumn('description', 'text', [
                'null' => true,
                'comment' => '資格の説明',
            ])
            ->addColumn('question_count', 'integer', [
                'null' => false,
                'default' => 0,
                'comment' => '問題数',
            ])
            ->addColumn('created', 'datetime', [
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'null' => false,
            ]);

        $table->create();
    }
}
