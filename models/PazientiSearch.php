<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pazienti;

class PazientiSearch extends Pazienti {

    public function rules()
    {
        return [
            [['cognome', 'nome', 'capostipite', 'data_nascita', 
            'data_p_visita', 'data_arruol', 'fpc_mut', 'sorv_rad'], 'safe']            
        ];
    }
    
    public function scenarios() {
        return Model::scenarios();
    }

    /**
     * Configure search rules
     */
    public function search($params) {
        $query = Pazienti::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()){
            /**
             * se i parametri non superano la validazione, 
             * ritorna semplicemente il dataprovider vuoto, 
             * altrimenti aggiungi i parametri definiti sotto 
             * */ 
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'nome', $this->nome])
                ->andFilterWhere(['like', 'cognome', $this->cognome])
                ->andFilterWhere(['like', 'capostipite', $this->capostipite]);

        return $dataProvider;
    }

}