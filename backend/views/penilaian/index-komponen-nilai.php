<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Penilaian */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian';

// Beda breadcrumb kalo admin dan guru
$user = \app\models\User::findOne(Yii::$app->user->id);
if($user->role == 'admin'){
    $this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['penilaian/index']];
    $this->params['breadcrumbs'][] = ['label' => $kelas_mata_pelajaran->tahunAjaranKelas->kelas->kelas, 'url' => ['penilaian/view-mata-pelajaran', 'id' => $kelas_mata_pelajaran->tahunAjaranKelas->id]];
    $this->params['breadcrumbs'][] = $this->title;
}elseif ($user->role == 'guru'){
    $this->params['breadcrumbs'][] = ['label' => 'Mata Pelajaran Yang Diampu', 'url' => ['guru/mata-pelajaran']];
    $this->params['breadcrumbs'][] = 'Komponen Nilai';
}


?>
<div class="penilaian-index">

    <h3>Komponen Nilai <b><?= $kelas_mata_pelajaran->mataPelajaran->pelajaran ?></b> kelas <b><?= $kelas_mata_pelajaran->tahunAjaranKelas->kelas->kelas ?></b></h3>

    <?php
        if($kelas_mata_pelajaran->tahunAjaranKelas->jumlahSiswa == 0){
            echo 'Siswa Belum Di Assign Ke Kelas Ini';
        }else{
            if(!Yii::$app->user->can('supervisor')){
                echo Html::a('Tambah Komponen Nilai', ['komponen-nilai/index', 'id' => $kelas_mata_pelajaran->id], ['class' => 'btn btn-primary']).'&nbsp';
                echo Html::a('Laporan Nilai Siswa', ['penilaian/laporan-nilai', 'id' => $kelas_mata_pelajaran->id], ['class' => 'btn btn-warning', 'target' => '_blank']);
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'options' => [
                        'style' => [
                            'width' => '500px',
                            'margin-top' => '20px'
                        ]
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'komponen_nilai',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{penilaian}',
                            'buttons'=>[
                                'penilaian'=>function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> Nilai', ['penilaian/view-penilaian', 'id' => $model->id]);
                                },
                            ],
                        ],
                    ],
                ]);
            }
        }
     ?>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <td><b>#</b></td>
            <td><b>NISN</b></td>
            <td><b>Nama</b></td>
            <?php
            foreach ($komponen_nilai as $item){
                echo '<td><b>'.$item->komponen_nilai.'</b></td>';
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach ($kelas_siswa as $value){
            echo '<tr>';
            echo '<td>'.$i.'</td><td>'.$value->nisn.'</td><td>'.$value->siswa->nama.'</td>';
            foreach ($komponen_nilai as $komponen){
                foreach ($penilaian as $nilai){
                    if($nilai->kelasSiswa->nisn == $value->nisn && $komponen->id == $nilai->komponen_nilai_id){
                        echo '<td>'.$nilai->nilai.'</td>';
                    }
                }
            }
            echo '</tr>';
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>
