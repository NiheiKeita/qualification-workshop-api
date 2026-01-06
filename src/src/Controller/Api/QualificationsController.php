<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Domain\Qualification\CreateQualificationRequest;
use App\Form\QualificationCreateForm;
use App\Infrastructure\Qualification\QualificationRepository;
use App\UseCase\Qualification\CreateQualificationUseCase;
use InvalidArgumentException;
use RuntimeException;

final class QualificationsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->request->allowMethod(['post']);
        $this->viewBuilder()->setClassName('Json');
    }

    public function create()
    {
        $body = (array)$this->request->getData();

        try {
            $form = new QualificationCreateForm();
            if (!$form->validate($body)) {
                $errors = $form->getErrors();
                $this->respondValidationError($errors);
                return;
            }

            $req = new CreateQualificationRequest(
                title: $body['title'] ?? null,
                description: $body['description'] ?? null,
                questionCount: isset($body['questionCount']) ? (int)$body['questionCount'] : null,
            );

            // 本当はDIコンテナに登録したいが、まず動く形
            $usecase = new CreateQualificationUseCase(
                repo: new QualificationRepository()
            );

            $res = $usecase->execute($req);

            $this->response = $this->response->withStatus(201);
            $this->set([
                'success' => true,
                'data' => $res->toArray(),
            ]);
            $this->viewBuilder()->setOption('serialize', ['success', 'data']);
            return;

        } catch (InvalidArgumentException $e) {
            $this->response = $this->response->withStatus(400);
            $this->set([
                'success' => false,
                'error' => ['message' => $e->getMessage()],
            ]);
            $this->viewBuilder()->setOption('serialize', ['success', 'error']);
            return;

        } catch (RuntimeException $e) {
            $this->response = $this->response->withStatus(422);
            $this->set([
                'success' => false,
                'error' => ['message' => 'Unprocessable Entity'],
            ]);
            $this->viewBuilder()->setOption('serialize', ['success', 'error']);
            return;
        }
    }
}
