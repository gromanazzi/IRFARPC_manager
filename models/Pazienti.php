<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pazienti".
 *
 * @property int $paziente_id
 * @property string $cognome
 * @property string $nome
 * @property string $data_nascita
 * @property int|null $capostipite
 * @property string $data_p_visita
 * @property int $arruol_p_visit
 * @property string|null $data_arruol
 * @property int $fpc_mut 0=FPC, 1=MUT
 * @property int $sorv_rad
 *
 * @property Pazienti $capostipite
 * @property Pazienti[] $pazientis
 * @property Risonanze[] $risonanzes
 * @property TestGenetici[] $testGens
 */
class Pazienti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pazienti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cognome', 'nome', 'data_nascita', 'data_p_visita', 'fpc_mut'], 'required'],
            [['data_nascita', 'data_p_visita', 'data_arruol'], 'safe'],
            [['fpc_mut', 'sorv_rad'], 'boolean'],
            [['cognome', 'nome'], 'string', 'max' => 250],
            [['capostipite, id_reg'], 'integer'],
            [['capostipite'], 'exist', 'skipOnError' => true, 'targetClass' => Pazienti::class, 'targetAttribute' => ['capostipite' => 'paziente_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paziente_id' => 'ID',
            'cognome' => 'Cognome',
            'nome' => 'Nome',
            'data_nascita' => 'Data di nascita',
            'capostipite' => 'Capostipite',
            'data_p_visita' => 'Data Prima Visita',
            'id_reg' => "ID Registro",
            'data_arruol' => 'Data Arruolamento',
            'fpc_mut' => 'FPC / Mutati',
            'sorv_rad' => 'Sorveglianza Radiologica',
        ];
    }

    public function gridColumns()
    {
        return [
            'paziente_id',
            'cognome',
            'nome',
            [
                'attribute' => 'data_nascita',
                'format' => ['date', 'php:d/m/Y'],
                'headerOptions' => ['style' => 'white-space: normal;'],
            ],
            [
                'attribute' => 'capostipite',
                'value' => function ($model) {
                    return $model->getNomeCapostipite();
                }
            ],
            [
                'attribute' => 'data_p_visita',
                'format' => ['date', 'php:d/m/Y'],
                'headerOptions' => ['style' => 'white-space: normal;'],
            ],
            'id_reg',
            [
                'attribute' => 'data_arruol',
                'format' => ['date', 'php:d/m/Y'],
                'headerOptions' => ['style' => 'white-space: normal;'],
            ],
            'fpc_mut',
            [
                'attribute' => 'sorv_rad',
                'headerOptions' => ['style' => 'white-space: normal;'],
            ]
        ];
    }
    
    /**
     * Get query to retrieve all patients
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getPazienti()
    {
        return $this->find()->all();
    }


    /**
     * Gets query for [[Capostipite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCapostipite()
    {
        return $this->hasOne(Pazienti::class, ['paziente_id' => 'capostipite']);
    }

    /**
     * Return capostipite name
     * 
     * @return string
     */

    public function getNomeCapostipite()
    {
        $capostipite = $this->getCapostipite()->one();
        return $capostipite ?
            $capostipite->cognome . ' ' . $capostipite->nome :
            'Nope';
    }

    /**
     * Gets query for [[Pazienti]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParenti()
    {
        return $this->hasMany(Pazienti::class, ['capostipite' => 'paziente_id']);
    }

    /**
     * Gets query for [[Risonanze]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRisonanze()
    {
        return $this->hasMany(Risonanze::class, ['paz_id' => 'paziente_id']);
    }

    /**
     * Gets query for [[TestGens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestGens()
    {
        return $this->hasMany(TestGenetici::class, ['paz_id' => 'paziente_id']);
    }
}
