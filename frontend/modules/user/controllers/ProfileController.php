<?php

namespace frontend\modules\user\controllers;

use Yii;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\modules\user\models\forms\PictureForm;
use frontend\modules\user\models\forms\EditForm;
use yii\web\Response;
use yii\web\UploadedFile;

class ProfileController extends Controller
{

    /**
     * @param $nickname
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($nickname)
    {
        /* @var $currentUser User */
        $currentUser =  Yii::$app->user->identity;

        $modelPicture = new PictureForm();

        return $this->render('view',[
            'user' => $this->findUser($nickname),
            'currentUser' => $currentUser,
        ]);
    }


    /**
     * @param $nickname
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionEdit($nickname)
    {

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        /* Получаем данные для формы и изображения */
        $model = new EditForm($currentUser);
        $modelPicture = new PictureForm();
        $user = $this->findUser($nickname);

        /*Если текущий пользователь и пользователь , чей профиль редактируются не совподают ,  тогда высвечиваем ошибку*/
        if (!$currentUser->equals($user)) {
            Yii::$app->session->setFlash('danger', 'Вы не можете редактировать профиль другого пользователя');
            return $this->goHome();
        }


        /*  если данные формы загруженны, и сохранение прошло успешно , возвращаем на страницу пользователя*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Профиль изменён');
            return $this->refresh()->redirect(['/user/profile/edit', 'nickname' => $currentUser->getNickname()]);
        }


        return $this->render('edit', [
            'model' => $model,
            'user' => $user,
            'modelPicture' => $modelPicture,
        ]);
    }

    /**
     * @return array
     */
    public function actionUploadPicture()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new PictureForm();
        $model->picture = UploadedFile::getInstance($model,'picture');

        if ($model->validate()) {

            $user = Yii::$app->user->identity;
            $user->picture = Yii::$app->storage->saveUploadedFile($model->picture);

            if ($user->save(false,['picture'])) {
                return [
                    'success' => true,
                    'pictureUri' => Yii::$app->storage->getFile($user->picture),
                ];
            }

        }
        return ['success' => false,'errors' => $model->getErrors()];
    }


    /**
     * @return Response
     */
    public function actionDeletePicture()
    {
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        if ($currentUser->deletePicture()) {
            Yii::$app->session->setFlash('success', 'Фотография удалена');
        } else {
            Yii::$app->session->setFlash('danger', 'Ошибка удаления фото');
        }

        return $this->refresh()->redirect(['/user/profile/edit', 'nickname' => $currentUser->getNickname()]);
    }


    /**
     * @param string|integer $nickname
     * @return array|\yii\db\ActiveRecord|null
     * @throws NotFoundHttpException
     */
    private function findUser($nickname)
    {
        if ($user = User::find()->where(['nickname' => $nickname])->orWhere(['id' => $nickname])->one()) {
            return $user;
        }
        throw new NotFoundHttpException();
    }
}
