<?php

use app\models\Pazienti;
use yii\debug\components\search\Filter;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Anagrafica Pazienti';
$this->params['breadcrumbs'][] = $this->title;
$model = new Pazienti();
$labels = $model->attributes();
//$pazienti = $model->getPazienti();

?>

<!-- <div class="md-12">
    Elenco dei pazienti trattati nell'ambito del progetto IRFARPC
</div>

<table class="table">
    <thead>
        <?php
        foreach ($labels as $label) {
            echo '<th scope="col">' . $model->getAttributeLabel($label) . '</th>';
        }
        ?>
    </thead>
    <tbody>

    </tbody>
</table> -->
<?php //print_r($pazienti); 
$filter = new Filter();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns, 
    'filterModel' => $searchModel,
    'filterPosition' => 'body',
]);