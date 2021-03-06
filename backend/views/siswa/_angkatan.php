<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>

<?php
if(!Yii::$app->user->can('supervisor')){
    echo Html::a('Tambah Angkatan', ['angkatan/create'], ['class' => 'btn btn-success', 'style' => ['margin-top' => '10px']]);
    }
?>

<?php
if(Yii::$app->user->can('supervisor')){
    echo GridView::widget([
        'dataProvider' => $semua_angkatan,
        'options' => [
            'style' => [
                'width' => '300px',
            ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'angkatan',
        ],
    ]);
	}else{
    echo GridView::widget([
        'dataProvider' => $semua_angkatan,
        'options' => [
            'style' => [
                'width' => '300px',
            ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'angkatan',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{set_active}',
                'buttons' => [
                    'set_active' => function ($url, $model, $key) {
                        return Html::a('', ['angkatan/delete', 'id' => $model->id], [
                            'class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]);
	}
?>
