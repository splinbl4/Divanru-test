<?php

declare(strict_types=1);

namespace app\controllers\Admin;

use app\Module\Feedback\Command\Edit\EditFeedbackCommand;
use app\Module\Feedback\Command\Edit\EditFeedbackForm;
use app\Module\Feedback\Command\Edit\EditFeedbackHandler;
use app\Module\Feedback\Entity\Feedback;
use app\Module\Feedback\Forms\FeedbackSearch;
use DomainException;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class FeedbackController
 * @package app\controllers\Admin
 */
class FeedbackController extends Controller
{
    /**
     * @var EditFeedbackHandler
     */
    private EditFeedbackHandler $editFeedbackHandler;

    /**
     * FeedbackController constructor.
     * @param $id
     * @param $module
     * @param EditFeedbackHandler $editFeedbackHandler
     * @param array $config
     */
    public function __construct($id, $module, EditFeedbackHandler $editFeedbackHandler, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->editFeedbackHandler = $editFeedbackHandler;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $feedback = $this->findModel($id);
        $form = new EditFeedbackForm($feedback);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $command = new EditFeedbackCommand($feedback, $form->customer, $form->phone, $form->status);
                $this->editFeedbackHandler->handle($command);
                return $this->redirect('index');
            } catch (DomainException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
            'feedback' => $feedback,
        ]);
    }

    /**
     * @param $id
     * @return Feedback
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Feedback
    {
        $model = Feedback::findOne($id);

        if (!$model instanceof Feedback) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}
