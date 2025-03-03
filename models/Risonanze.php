<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "risonanze".
 *
 * @property int $ris_id
 * @property int $paz_id
 * @property int|null $stato_impegn 0=da scrivere, da consegnare; 1=scritta, da consegnare; 2 scritta, consegnata
 * @property string $data_ris
 * @property string|null $esito_ris
 * @property string|null $note
 *
 * @property Pazienti $paz
 */
class Risonanze extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risonanze';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paz_id', 'data_ris'], 'required'],
            [['paz_id', 'stato_impegn'], 'integer'],
            [['data_ris'], 'safe'],
            [['esito_ris', 'note'], 'string', 'max' => 2000],
            [['paz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pazienti::class, 'targetAttribute' => ['paz_id' => 'paziente_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ris_id' => 'ID Risonanza',
            'paz_id' => 'ID Paziente',
            'stato_impegn' => 'Stato Impegnativa', //0=da scrivere, da consegnare; 1=scritta, da consegnare; 2 scritta, consegnata
            'data_ris' => 'Data Risonanza',
            'esito_ris' => 'Esito Risonanza',
            'note' => 'Note',
        ];
    }

    /**
     * Gets query for [[Paz]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaz()
    {
        return $this->hasOne(Pazienti::class, ['paziente_id' => 'paz_id']);
    }
}
