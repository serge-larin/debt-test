<?php
/**
 * /debt/default/index view
 *
 * @author Serge Larin <serge.larin@gmail.com>
 * @var $this yii\web\View
 */
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\ActiveForm;
use dosamigos\typeahead\Bloodhound;
use dosamigos\typeahead\TypeAhead;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

$this->title = 'Долг';
?>
<div class="debt-default-index">
    <h1><?= Html::encode($this->title)?></h1>

<?php
$debtApiUrl = Url::to(['/api/debt']);
$script = <<<JS
    function setDebtFormHandlers() {
        $('.btn-delete').on('click', function(event) {
            $.ajax({
                type: 'DELETE',
                contentType: "application/json; charset=utf-8",
                url: "$debtApiUrl/" + $(this).attr('data-debt-id'),
                dataType: 'json',
                success: function() {
                    $.pjax.reload('#person-debt');
                }
            });
            event.preventDefault();
            return false;
        });

        $('.debt-save').on('beforeSubmit', function(event) {
           formData = {
                debt_sum: $(this).find('input[name="Debt[debt_sum]"]').val(),
                debt_person: $(this).find('input[name="Debt[debt_person]"]').val(),
                debt_comment: $(this).find('input[name="Debt[debt_comment]"]').val(),
                debt_created_at: $(this).find('input[name="Debt[debt_created_at]"]').val(),
                debt_id: $(this).find('input[name="Debt[debt_id]"]').val(),
            };
           $.ajax({
                type: 'PUT',
                contentType: "application/json; charset=utf-8",
                url: "$debtApiUrl/" + $(this).find('input[name="Debt[debt_id]"]').val(),
                data: JSON.stringify(formData),
                dataType: 'json',
                success: function() {
                    $.pjax.reload('#person-debt');
                }
            });
            event.preventDefault();
            return false;
        });

        $('.debt-new').on('beforeSubmit', function(event) {
           formData = {
                debt_sum: $(this).find('input[name="Debt[debt_sum]"]').val(),
                debt_person: $(this).find('input[name="Debt[debt_person]"]').val(),
                debt_comment: $(this).find('input[name="Debt[debt_comment]"]').val(),
                debt_created_at: $(this).find('input[name="Debt[debt_created_at]"]').val(),
            };
           $.ajax({
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                url: "$debtApiUrl",
                data: JSON.stringify(formData),
                dataType: 'json',
                success: function() {
                    $.pjax.reload('#person-debt');
                }
            });
            event.preventDefault();
            return false;
        });
        $('.debt-save').on('beforeSubmit', function(event) {
            $.pjax.submit(event, '#person-debt');
            return false;
        });
    }
    setDebtFormHandlers();
    $('#person-name').on('typeahead:selected', function(object, data) {
        $('#person-id').val(data['id']);
        $('#person-form').submit();
    });
    $('#person-form').on('submit', function(event) {
        $.pjax.submit(event, '#person-debt');
        return false;
    });

    $('#person-debt').on('pjax:complete', function() {
        setDebtFormHandlers();
    });
JS;
    $this->registerJs($script, View::POS_READY);
    $personEngine = new Bloodhound([
    'name' => 'personEngine',
    'clientOptions' => [
        'limit' => 10,
        'datumTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.obj.whitespace('name')"),
        'queryTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.whitespace"),
        'remote' => [
            'url' => Url::to(['/api/autocomplete/person', 'query'=>'QRY']),
            'wildcard' => 'QRY',
        ],
    ]
    ]);

    echo Html::beginForm([''], 'get', ['id' => 'person-form' , 'autocomplete' => 'off',]);
    echo Html::hiddenInput('id', isset($person)?$person->person_id:null, ['id' => 'person-id']);
    echo TypeAhead::widget([
        'value' => isset($person)?$person->fullName:null,
        'id' => 'person-name',
        'name' => 'person',
        'options' => [
            'class' => 'form-control',
            'type'=> 'search',
            'placeholder' => 'Введите ФИО',
            'tabindex' => 4,
        ],

        'engines' => [ $personEngine ],
        'clientOptions' => [
            'highlight' => true,
            'minLength' => 1
        ],
        'dataSets' => [
            [
            'name' => 'street',
            'displayKey' => 'value',
            'source' => $personEngine->getAdapterScript()
            ]
        ]
    ]);
    echo Html::endForm();
?>
<?php Pjax::begin(['id' => 'person-debt']); ?>
<?php
    if (isset($person)) {
        $newItem = $this->render('_form_debt', ['model' => $newDebt]);
        if (empty($person->debts)) {
            echo Html::tag('div', $newItem, ['class' => 'row']);
        } else {
            echo ListView::widget([
                'dataProvider' => new ArrayDataProvider([
                    'allModels' => $person->debts,
                    'pagination' => false,
                ]),
                'layout' => "<div class=\"row\">" . $newItem ."{items}</div>\n",
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {

                    return $this->render('_form_debt', ['model' => $model]);
                }
            ]);
        }
    }
?>
<?php Pjax::end() ?>
<div>
    <?= GridView::widget([
        'id' => 'debt-grid',
        'pjax' => true,
        'export' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'debt_person',
                'value' => 'debtPerson.fullName',
                'filter' => false,
            ],
            'debt_created_at:datetime',
            [
                'attribute' => 'debt_sum',
                'format' => 'currency',
                'hAlign' => 'right',
            ],
            'debt_comment',
        ],
    ]); ?>
</div>
</div>
