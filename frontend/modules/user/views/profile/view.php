<?php
/* @var $this \yii\web\View */
/* @var $user \frontend\models\User */
/* @var $currentUser \common\models\User */
/* @var $modelPicture \frontend\modules\user\models\forms\PictureForm */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;

?>
<div class="col-sm-5">

    <img src="<?php echo $user->getPicture(); ?>" width="150" height="200" alt="mongol">

    <div class="pull-right">
    <p style="font-weight: bold" class="text-danger text-nowrap"> <?php echo Html::encode($user->username); ?> <button class="btn btn-default">Редактировать профиль</button></p>



    <p><?php echo HtmlPurifier::process($user->about) ?></p>

    <b>Рост:&nbsp;<?php echo $user->height ?>&nbsp;см.</b>
    <br>
    <b>Вес:&nbsp;<?php echo $user->weight ?>&nbsp;кг.</b>
    <br>
    <h4  class="text-primary">Программа тренировок:</h4>

    <h5>Lorem impsum Shreder five mounth testing</h5>
    </div>

</div>


<div class="col-xs-offset-5">

    <h4>Каллорийность и БЖУ</h4>
<ul class="list-group">
    <li class="list-group-item">Каллорий за день:&nbsp;&nbsp;<?php echo $user->calorie ?>&nbsp;ккал.</li>
    <li class="list-group-item">Белков за день:&nbsp;&nbsp;<?php echo $user->protein ?>&nbsp;г.</li>
    <li class="list-group-item">Углеводов за день:&nbsp;&nbsp;<?php echo $user->carbohydrates ?>&nbsp;г.</li>
    <li class="list-group-item">Жиров за день:&nbsp;&nbsp;<?php echo $user->fat ?>&nbsp;г.</li>
</ul>

</div>



<hr>
<h1 align="center">Дневник тренировок</h1>

<?= FileUpload::widget([
    'model' => $modelPicture,
    'attribute' => 'picture',
    'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
    'options' => ['accept' => 'image/*'],
        'clientOptions' => [
        'maxFileSize' => 2000000,
    ],
    // Also, you can specify jQuery-File-Upload events
    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
]); ?>



