<?php

declare(strict_types=1);

namespace app\controllers;

use DomainException;
use app\Module\Feedback\Command\Create\CreateFeedbackCommand;
use app\Module\Feedback\Command\Create\CreateFeedbackForm;
use app\Module\Feedback\Command\Create\CreateFeedbackHandler;
use Yii;
use yii\web\Controller;

/**
 * Class FeedbackController
 * @package app\controllers
 */
class FeedbackController extends Controller
{
    /**
     * @var CreateFeedbackHandler
     */
    private CreateFeedbackHandler $handler;

    /**
     * FeedbackController constructor.
     * @param $id
     * @param $module
     * @param CreateFeedbackHandler $handler
     * @param array $config
     */
    public function __construct($id, $module, CreateFeedbackHandler $handler, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->handler = $handler;
    }

    public function actionIndex()
    {
        $form = new CreateFeedbackForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $command = new CreateFeedbackCommand($form->customer, $form->phone);
                $this->handler->handle($command);
                Yii::$app->session->setFlash('success', 'Обращение успешно отправлено!');
            } catch (DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }

            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }
}
