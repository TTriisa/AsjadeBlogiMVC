<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BloglinesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Lines';
$this->params['breadcrumbs'][] = $this->title;

if(!isset($blogID)) {
	$blogID = 0;
}
?>
<div class="blog-lines-index">
	<p>
		<?= Html::a('View Blog', ['view', 'id' =>$blogID], ['class' => 'btn btn-success']) ?>
	</p>
	
    <h1><?= Html::encode($this->title) ?></h1>
	
    <p>
        <?= Html::a('Create Blog Lines', ['//bloglines/create', 'id' =>$blogID], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'blogID',
            'title',
            'text' => [ 
				'attribute' => 'text',
				'label' => 'Text',
				'value' => function($model) { 
					if(strlen($model->text) > 30) {
						return substr($model->text,0,30).'...';
					} else { return $model->text;}
				},
			],
            'img',
			
            'actions' => [
				'header' =>  '',
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
				'buttons' => [
					'update' => function ($url, $model) {
						return '<a href="/~triiteet/AsjadeInternetBlogiGenerator/Blogi/web/index.php?r=bloglines%2Fupdate&amp;id='.$model->id.'&amp;blogID='.$model->blogID.'" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
					},
					'delete' => function ($url, $model) {
						return '<a href="/~triiteet/AsjadeInternetBlogiGenerator/Blogi/web/index.php?r=bloglines%2Fdelete&amp;id='.$model->id.'" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
					},
				],
			],
        ],
    ]); ?>


</div>
