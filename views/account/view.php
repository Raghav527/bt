<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Comments;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price',
            'description:ntext',
        ],
    ]) ?>
	

</div>

<?php
 $commentsmodel = new Comments();
?>
<?= DetailView::widget([
        'model' => $commentsmodel,
        'attributes' => [
            'comments',
			array(
                'attribute' => 'product_id',
                'value' => $model->id,
            )
        ],
    ])
?>
	<div class="acount-comment">
    <?php $form = ActiveForm::begin(['action' => ['account/savecomment']]); ?>
        <?= $form->field($commentsmodel, 'comments')->textarea(['rows' => 6]) ?>
        <?= $form->field($commentsmodel, 'product_id')->hiddenInput(['value'=> $model->id])->label(false); ?>
        <?= $form->field($commentsmodel, 'comments_status')->hiddenInput(['value'=>3])->label(false); ?>  
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- acount-comment -->