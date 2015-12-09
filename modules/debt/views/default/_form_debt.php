<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
?>
<div class="col-sm-4">
<?php
$form = ActiveForm::begin([
    'id' => 'debt-'. (empty($model->debt_id)?'new':$model->debt_id),
    'options' => [
        'class' => 'debt-' . (empty($model->debt_id)?'new':'save'),
    ],
]);
?>
    <?= $form->field($model, 'debt_id')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'debt_person')->hiddenInput()->label(false);?>
    <?= $form->field($model, 'debt_sum')->TextInput();?>
    <?= $form->field($model, 'debt_comment')->TextInput();?>
    <?= $form->field($model, 'debt_created_at')->TextInput();?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', [
            'class' => $model->isNewRecord ? 'btn btn-success btn-new':'btn btn-primary btn-save',
        ]) ?>
        <?php if (!$model->isNewRecord) {
            echo Html::a('Удалить', [''], ['data-debt-id' => $model->debt_id, 'class' => 'btn btn-danger btn-delete']);
        }?>
    </div>
<?php ActiveForm::end(); ?>
</div>
