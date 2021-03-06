<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LogMasukBarang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Log Masuk Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-masuk-barang-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?php
        if(Yii::$app->user->can('admin')){
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_barang',
            'tanggal',
            'vendor',
            'jumlah',
//            'created_by',
            [
                'attribute' => 'Created By',
                'value' => $model->createdBy->username
            ],
            'keterangan:ntext',
        ],
    ]) ?>

</div>
