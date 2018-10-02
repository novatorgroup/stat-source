<?php

namespace novatorgroup\statsource;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\Response;

class LoadController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            /** @var \novatorgroup\statsource\Module $module */
            $module = $this->module;

            if ($module->username && $module->password) {
                $username = $_SERVER['PHP_AUTH_USER'] ?? null;
                $password = $_SERVER['PHP_AUTH_PW'] ?? null;
                if ($module->username == $username && $module->password == $password) {
                    return true;
                }

                header('HTTP/1.1 401 Unauthorized');
                header('WWW-Authenticate: Basic realm="api"');
                echo 'You must login to use this service.';
                die();
            }

            return true;
        }

        return false;
    }

    public function actionIndex(string $type, ?string $start = null, ?string $end = null)
    {
        /** @var \novatorgroup\statsource\Module $module */
        /** @var DataSourceInterface $object */

        $module = $this->module;

        if (array_key_exists($type, $module->sources) === false) {
            throw new InvalidArgumentException("Type not found [$type]");
        }

        $params = $module->sources[$type];
        $class = $params['class'] ?? $params;
        $object = new $class();
        $result = $object->load($start, $end);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }
}