<?php

namespace common\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidArgumentException;
use yii\web\Cookie;
use common\modules\i18n\models\Lang;

/**
 * Class SetLocaleAction
 * @package common\actions
 *
 * Example:
 *
 *   public function actions()
 *   {
 *       return [
 *           'set-locale'=>[
 *               'class'=>'common\actions\SetLocaleAction',
 *               'locales'=>[
 *                   'en-US', 'ru-RU', 'uk-UA'
 *               ],
 *               'localeCookieName'=>'_locale',
 *               'callback'=>function($action){
 *                   return $this->controller->redirect(/.. some url ../)
 *               }
 *           ]
 *       ];
 *   }
 */
class SetLocaleAction extends Action
{
    /**
     * @var array List of available locales
     */
    public $locales = [];

    /**
     * @var string
     */
    public $localeCookieName = '_locale';

    /**
     * @var integer
     */
    public $cookieExpire;

    /**
     * @var string
     */
    public $cookieDomain;

    /**
     * @var \Closure
     */
    public $callback;


    /**
     * @param $locale
     * @return mixed|static
     */
    public function run($locale)
    {
        if (!is_array($this->locales) || !in_array($locale, $this->locales, true)) {
            throw new InvalidArgumentException('Unacceptable locale');
        }
        $cookie = new Cookie([
            'name' => $this->localeCookieName,
            'value' => $locale,
            'expire' => $this->cookieExpire ?: time() + 60 * 60 * 24 * 365,
            'domain' => $this->cookieDomain ?: '',
        ]);
        Yii::$app->getResponse()->getCookies()->add($cookie);
        if ($this->callback && $this->callback instanceof \Closure) {
            return call_user_func_array($this->callback, [
                $this,
                $locale
            ]);
        }

        $code = substr($locale, 0, 2);
        if(Yii::$app->request->referrer) {
            $codes = [];
            foreach ($this->locales as $k => $v) {
                $codes[] = $k;
            }

            $parser = parse_url(Yii::$app->request->referrer);
            $pathArray= explode('/', $parser['path']);
            $pathArray = array_diff($pathArray, ['']);
            $pathArray = array_merge($pathArray);

            if(isset($pathArray[0]) && in_array($pathArray[0], $codes)) {
                unset($pathArray[0]);
            }
            $path = implode('/', $pathArray);
            $parser['path'] = str_replace(['//'], '/', "/$code/$path");

            $redirectUrl = trim($this->buildUrl($parser), '/');

            return Yii::$app->response->redirect($redirectUrl);
        }

        $redirectUrl = Yii::$app->urlManager->createUrl(['site/index', '_lang' => $code]);

        return Yii::$app->response->redirect($redirectUrl);
    }

    /**
     * @param $params
     * @return string
     */
    protected function buildUrl($params)
    {
        $scheme = isset($params['scheme']) ? $params['scheme'] . '://' : '';
        $host = isset($params['host']) ? $params['host'] : '';
        $port = isset($params['port']) ? ':' . $params['port'] : '';
        $user = isset($params['user']) ? $params['user'] : '';
        $pass = isset($params['pass']) ? ':' . $params['pass'] : '';
        $pass = ($user || $pass) ? "$pass@" : '';
        $path = isset($params['path']) ? $params['path'] : '';
        $query = isset($params['query']) ? '?' . $params['query'] : '';
        $fragment = isset($params['fragment']) ? '#' . $params['fragment'] : '';

        return "$scheme$user$pass$host$port$path$query$fragment";
    }

}
