<?php
/* @var $this \yii\web\View */
/* @var $user \frontend\models\User */


use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<div class="col-sm-5">

    <img src="https://s00.yaplakal.com/pics/pics_original/0/8/6/12319680.jpg" width="150" height="200" alt="mongol">

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



