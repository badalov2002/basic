<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $profile */

$this->title = $profile->name;
?>
<div class="profile-view">
    <div class="row">
        <div class="col-md-6">
            <h3>
                <?= $this->title ?>
            </h3>

        </div>
        <div class="col-md-6 text-right">
            <p>
                <?= Html::a('Update', ['update', 'id' => $profile->id], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
    </div>




    <?= DetailView::widget([
        'model' => $profile,
        'attributes' => [
            'id',
            'user_id',
            'name',
            'fullname',
            'surname',
            'photo',
            'comment',
        ],
    ]) ?>

</div>
