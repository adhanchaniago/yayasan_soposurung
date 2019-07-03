<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\AplMalamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apl-malam-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun_ajaran_kelas_id') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'hadir') ?>

    <?= $form->field($model, 'tidak_hadir') ?>

    <?php // echo $form->field($model, 'keterangan_tidak_hadir') ?>

    <?php // echo $form->field($model, 'jurnal_laporan_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
