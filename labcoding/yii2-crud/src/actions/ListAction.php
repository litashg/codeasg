<?php

namespace labcoding\crud\actions;

use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\base\ErrorException;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\LinkPager;
use labcoding\crud\models\filter\FilterModelInterface;

class ListAction extends Action
{

    /**
     * Search model
     * @var FilterModelInterface
     */
    protected $filterModel;

    /**
     * Анонимная-функция запускаемая в случае ошибки валидации модели поиска
     * @var callable
     */
    protected $validationFailedCallback;

    /**
     * Метод вставки данных из запроса,
     * Если true, то данные в запросе должны быть в под-массиве e.g. $_GET/$_POST[SearchModel][attribute]
     * @var bool
     */
    public $directPopulating = true;

    /**
     * Метод получение пагинации, если true, то получаем уже готовый html пагинации,
     * нужно для AJAX запросов
     * @var bool
     */
    public $paginationAsHTML = false;

    /**
     * Тип запроса
     * @var string
     */
    public $requestType = 'get';

    /**
     * Пусть до представления
     * @var string
     */
    public $view = '@app/modules/crud/views/list';

    /**
     * @var array
     */
    public $params = [];

    /**
     * @return array|mixed|string
     * @throws ErrorException
     * @throws \Exception
     */
    public function run()
    {
        if (!$this->filterModel) {
            throw new ErrorException('Params $filterModel not defined');
        }
        Url::remember('list', 'user');

        $request = Yii::$app->request;

        $data = (strtolower($this->requestType) === 'post' && $request->isPost) ? $request->post() : $request->get();
        $this->filterModel->load(($this->directPopulating) ? $data : [$this->filterModel->formName() => $data]);

        $this->filterModel->search($data);

        if ($this->filterModel->hasErrors()) {
            if ($request->isAjax){
                return (is_callable($this->validationFailedCallback))
                    ? call_user_func($this->validationFailedCallback, $this->filterModel)
                    : [
                        'error' => current($this->filterModel->getErrors())
                    ];
            }

            if (empty($data)) {
                $this->filterModel->clearErrors();
            }
        }

        if (!($dataProvider = $this->filterModel->getDataProvider())) {
            throw new ErrorException('DataProvider not initialized');
        }

        $params = ArrayHelper::merge(
            [
                'filterModel' => $this->filterModel,
                'dataProvider' => $dataProvider,
                'requestType' => $this->requestType,
                'directPopulating' => $this->directPopulating
            ],
            $this->params
        );

        if ($request->isAjax) {
            return $this->controller->renderAjax($this->view ?: $this->id, $params);
        }

        return $this->controller->render($this->view ?: $this->id, $params);
    }

    /**
     * @param FilterModelInterface $model
     */
    public function setFilterModel(FilterModelInterface $model)
    {
        $this->filterModel = $model;
    }

    /**
     * @param callable $callback
     */
    public function setValidationFailedCallback(callable $callback)
    {
        $this->validationFailedCallback = $callback;
    }
}
