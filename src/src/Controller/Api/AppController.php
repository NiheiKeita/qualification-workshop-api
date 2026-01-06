<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    protected function respondValidationError(array $errors): void
    {
        $this->response = $this->response->withStatus(400);
        $this->set([
            'success' => false,
            'error' => [
                'message' => 'Validation failed',
                'details' => $errors,
            ],
        ]);
        $this->viewBuilder()->setOption('serialize', ['success', 'error']);
    }
}
