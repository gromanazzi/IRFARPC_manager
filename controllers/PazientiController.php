<?php

namespace app\controllers;

use app\models\Pazienti;
use app\models\PazientiSearch;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;

class PazientiController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new PazientiSearch();
        $dataProvider= $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'columns' => (new Pazienti)->gridColumns()
        ]);
    }
}