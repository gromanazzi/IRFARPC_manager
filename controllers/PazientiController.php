<?php

namespace app\controllers;

use app\models\Pazienti;
use yii\base\Controller;
use yii\data\ActiveDataProvider;

class PazientiController extends Controller
{
    public function actionIndex()
    {
        $model = new Pazienti();
        $dataprovider = new ActiveDataProvider([
            'query' => Pazienti::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataprovider,
            'columns' => $model->gridColumns()
        ]);
    }
}