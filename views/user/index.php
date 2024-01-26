<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
?>
<div class="user-index">
    <div class="row">
        <div class="col-md-6">
            <h3 style="margin: 0;"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="col-md-6">
            <p>
                <?= Html::a('Create User', ['create'], ['class' => 'float-end btn btn-success']) ?>
            </p>
        </div>
    </div>





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'username',
            //'accessToken',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Users $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
