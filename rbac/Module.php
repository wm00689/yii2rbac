<?php
/**
 * Created by PhpStorm.
 * User: feli
 * Date: 2018/1/28
 * Time: PM10:48
 */

namespace wm00689\rbac;


use backend\classes\common;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();
        $this->layout = '@vendor/wm00689/rbac/views/layouts/admin';
    }




}