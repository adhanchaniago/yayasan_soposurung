<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "keluar_masuk_barang".
 *
 * @property int $id
 * @property string $nama_barang
 * @property string $tanggal
 * @property string $vendor
 * @property string $jumlah
 * @property int $created_by
 * @property string $keterangan
 *
 * @property User $createdBy
 */
class LogKeluarBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_keluar_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_barang', 'tanggal', 'vendor', 'keterangan', 'jumlah'], 'required'],
            [['tanggal'], 'safe'],
            [['created_by'], 'integer'],
            [['jumlah'], 'string'],
            [['keterangan'], 'string'],
            [['nama_barang'], 'string', 'max' => 500],
            [['vendor'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_barang' => 'Nama Barang',
            'tanggal' => 'Tanggal',
            'vendor' => 'Yang Membawa Keluar',
            'jumlah' => 'Jumlah',
            'created_by' => 'Created By',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
