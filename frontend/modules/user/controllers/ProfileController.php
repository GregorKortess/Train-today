<?php

namespace frontend\modules\user\controllers;

use Yii;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\modules\user\models\forms\PictureForm;
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
            'modelPicture' => $modelPicture,
        ]);
    }


    public function actionUploadPicture()
    {
        $model = new PictureForm();
        $model->picture = UploadedFile::getInstance($model,'picture');

        if ($model->validate()) {

            $user = Yii::$app->user->identity;
            $user->picture = Yii::$app->storage->saveUploadedFile($model->picture);

            if ($user->save(false,['picture'])) {
                print_r($user->attributes);die;
            }

        }
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
