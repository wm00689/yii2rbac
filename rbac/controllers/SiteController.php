<?php
namespace wm00689\rbac\controllers;


use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function init()
    {
        $this->viewPath = '@vendor/wm00689/rbac/rbac/views/site';
        parent::init(); // TODO: Change the autogenerated stub
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if(!(Yii::$app->user->isGuest)){
            return $this->redirect(['/admin/dashboard']);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                Yii::$app->user->login($model->getUser(), $model->rememberMe ? 3600 * 24 * 30 : 0);
                return json_encode(['status'=>'y']);
            } else {
                return json_encode(['status'=>'n','info'=>'密码或用户名错误']);
            }
        }

        return $this->renderPartial('login', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        return $this->renderPartial('signup');
    }

    public function actionLock()
    {
        return $this->renderPartial('lock');
    }
}
