<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlogLines */

$this->title = 'Create Blog Lines';
$this->params['breadcrumbs'][] = ['label' => 'Blog Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-lines-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
