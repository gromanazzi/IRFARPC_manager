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
            [['capostipite', 'arruol_p_visit', 'fpc_mut', 'sorv_rad'], 'integer'],
            [['cognome', 'nome'], 'string', 'max' => 250],
            [['capostipite'], 'exist', 'skipOnError' => true, 'targetClass' => Pazienti::class, 'targetAttribute' => ['capostipite' => 'paziente_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paziente_id' => 'ID Paziente',
            'cognome' => 'Cognome',
            'nome' => 'Nome',
            'data_nascita' => 'Data di nascita',
            'capostipite' => 'Capostipite',
            'data_p_visita' => 'Data Prima Visita',
            'arruol_p_visit' => 'Arruolato Prima Visita',
            'data_arruol' => 'Data Arruolamento',
            'fpc_mut' => 'FPC / Mutati',
            'sorv_rad' => 'Sorveglianza Radiologica',
        ];
    }

    /**
     * Gets query for [[Capostipite0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCapostipite0()
    {
        return $this->hasOne(Pazienti::class, ['paziente_id' => 'capostipite']);
    }

    /**
     * Gets query for [[Pazientis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParenti()
    {
        return $this->hasMany(Pazienti::class, ['capostipite' => 'paziente_id']);
    }

    /**
     * Gets query for [[Risonanzes]].
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
