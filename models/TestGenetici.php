<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_gen".
 *
 * @property int $test_id
 * @property int|null $paz_id
 * @property string|null $tipo_test
 * @property int $stato_test 0=non eseguito, 1= eseguito
 * @property string|null $ris_test
 * @property string|null $note
 *
 * @property Pazienti $paz
 */
class TestGenetici extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_gen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id'], 'required'],
            [['test_id', 'paz_id', 'stato_test'], 'integer'],
            [['tipo_test'], 'string', 'max' => 250],
            [['ris_test', 'note'], 'string', 'max' => 2000],
            [['test_id'], 'unique'],
            [['paz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pazienti::class, 'targetAttribute' => ['paz_id' => 'paziente_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'test_id' => 'ID Test',
            'paz_id' => 'ID Paz',
            'tipo_test' => 'Tipo Test',
            'stato_test' => 'Stato Test', //0=non eseguito, 1= eseguito
            'ris_test' => 'Risultato Test',
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
