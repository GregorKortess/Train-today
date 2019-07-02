<?php
/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\forms\EditForm */
/* @var $user \frontend\models\User */
/* @var $modelPicture frontend\modules\user\models\forms\PictureForm */
use dosamigos\fileupload\FileUpload;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="profile-edit-index">
    <h1>Редактировать профиль</h1>

    <img src="<?php echo $user->getPicture(); ?>" id="profile-picture" width="150"  height="200"/>


    <div class="alert alert-success" style="display: none" id="profile-image-success">Profile image updated</div>
    <div class="alert alert-danger" style="display: none" id="profile-image-fail"></div>

    <a href="<?php echo Url::to(['/user/profile/delete-picture']); ?>" class="btn btn-warning">Delete picture</a>

    <?= FileUpload::widget([
        'model' => $modelPicture,
        'attribute' => 'picture',
        'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
        'options' => ['accept' => 'image/*'],
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                if (data.result.success) {
                    $("#profile-image-success").show();
                    $("#profile-image-fail").hide();
                    $("#profile-picture").attr("src", data.result.pictureUri);
                } else {
                    $("#profile-image-fail").html(data.result.errors.picture).show();
                    $("#profile-image-success").hide();
                }
            }',
        ],
    ]); ?>

    <br><br>

    <?php $form = ActiveForm::begin();?>



    <?php echo $form->field($model,'nickname')->label('id профиля'); ?>
    <br>


    <?php echo $form->field($model,'about')->label('Статус'); ?>
    <br>

    <?php echo $form->field($model,'height')->label('Рост в см.'); ?>
    <br>

    <?php echo $form->field($model,'weight')->label('Вес в кг.'); ?>
    <br>

    <?php echo Html::submitButton('Сохранить',['class' => 'btn btn-default']); ?>



    <?php ActiveForm::end(); ?>
</div>