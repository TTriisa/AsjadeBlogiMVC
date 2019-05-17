<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlogLines */
/* @var $form yii\widgets\ActiveForm 


    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

*/
?>

<div class="blog-lines-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'blogID')->hiddenInput(['value'])->label(false) ?>
    <?= $form->field($model, 'img')->hiddenInput(['value'])->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	<div style="border: 1px solid #ccc!important; border-radius: 16px; padding: 0.01em 16px; margin-bottom: 15px;">
		<ul class="nav nav-settings" style="display:flex; flex-direction: row;">
			<li id="buttonText" onclick="$('#text').fadeIn(350);$('#graph').hide();" style="display: inline; flex: 1;text-align: center; padding: 5px; border: 1px solid #ccc !important; margin: 5px; background-color: #ddd;">Add Text</li>
			<li id="buttonGraph" onclick="$('#graph').fadeIn(350);$('#text').hide();" style="display: inline; flex: 1;text-align: center; padding: 5px; border: 1px solid #ccc !important; margin: 5px; background-color: #ddd;">Add graph</li>
		</ul>
		
		<div class="settings-content">
			<div id="text" style="display: none;">
				<?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
			</div>
			<div id="graph" style="display: none;">
				<h3>graph settings</h3>
				<div style="margin-bottom: 10px;">
					<select id="csvs" style="margin-bottom: 20px;">
						<option value="" disabled="" selected="">Select CSV</option>
						<option value="timestamps">Reaktsioonimäng</option>
						<option value="mootmed">I sektsioonis temperatuur ja niiskus</option>
						<option value="mullaniiskus_temperatuur">Taime kasvu mullaniiskus ja temperatuur</option>
					</select>
					<div id="capture">
						<div id="legend"></div>
						<div id="chartContainer" style="width:100%; height:300px;"></div>
					</div>
					
					
				</div>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'buttonSave']) ?>
	</div>

	<?php ActiveForm::end(); ?>

	
</div>
<script>
	//
	let graph = 0;
	
	$("#buttonText").click(function() {
		$("#bloglines-img").val(null)
		graph = 0
	})
	
	$("#buttonSave").click(function() {
		if(graph == 1) {
			let name = Date.now()
			html2canvas(document.querySelector("#capture")).then(canvas => {
				document.body.appendChild(canvas)
				var canvas = $( "canvas" )[2]
				console.log(canvas)
				var img = canvas.toDataURL('image/jpeg');
				console.log(img)
				$.ajax({
				  async: false,
				  method: 'POST',
				  url: 'index.php?r=bloglines%2Fsave-pic&id='+name,
				  data: {
					img: img
				  }
				})
			});
			$("#bloglines-img").val('images/'+name+'.jpeg')
		}
	})

	$("#buttonGraph").click(function() {
		$("#bloglines-text").val(null)
		graph = 1;
	})
	
	$("#csvs").change(function() {
		g1 = new Dygraph(document.getElementById("chartContainer"), "csvs/"+$( this ).val()+".csv", {
			legend: 'always',
			labelsDiv: 'legend',
		});
	})
	
</script>
