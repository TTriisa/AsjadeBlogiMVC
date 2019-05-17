<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Blogs */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blogs-view">
	<div class="card">
		<h1><?= Html::encode($this->title) ?></h1>

		<?php foreach($lines as $r) :  ?>
			<div>
				<h2><?= $r->title ?></h2>
				<?php if($r->text == null) : ?>
					<div><img src="<?=$r->img?>"></div>
				<?php else : ?>	
					<div><p><?= $r->text?></p></div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>

	</div>
</div>
