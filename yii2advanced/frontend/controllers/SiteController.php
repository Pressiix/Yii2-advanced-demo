<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\helpers\StatHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login','logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login','signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /*------------------------------------NETPIE VALVE STATUS------------------------------------ */
        $App = '/NETPIE2VALVE';
        $Topic = '/relaystat';
        $Key = 'WcTxK4EMocRJCcF';
        $Secret = 'H0AHhsFat0L0AIBmdmR3IhN6J';
        $url = 'https://api.netpie.io/topic'. $App . $Topic .'?retain&auth='. $Key . ':' . $Secret;
        $response = \HttpFull\Request::get($url)->send();
        $result = json_decode($response->body, true);
        $valve_status = $result[0]['payload'];
        $valve_info = [];
        
        if($valve_status){
            if($valve_status == '1'){
                    $valve_info['valve1_status_color'] = 'badge progress-bar-success';
                    $valve_info['valve2_status_color'] = 'badge progress-bar-primary';
                    $valve_info['valve1_status'] = 'On';
                    $valve_info['valve2_status'] = 'Off';
            } 
            if($valve_status == '2'){
                    $valve_info['valve1_status_color'] = 'badge progress-bar-primary';
                    $valve_info['valve2_status_color'] = 'badge progress-bar-success';
                    $valve_info['valve1_status'] = 'Off';
                    $valve_info['valve2_status'] = 'On';
                }  
                if($valve_status == '3'){
                    $valve_info['valve1_status_color'] = 'badge progress-bar-success';
                    $valve_info['valve2_status_color'] = 'badge progress-bar-success';
                    $valve_info['valve1_status'] = 'On';
                    $valve_info['valve2_status'] = 'On';
                }  
                if($valve_status == '4'){
                    $valve_info['valve1_status_color'] = 'badge progress-bar-primary';
                    $valve_info['valve2_status_color'] = 'badge progress-bar-primary';
                    $valve_info['valve1_status'] = 'Off';
                    $valve_info['valve2_status'] = 'Off';
                }                                   
        }
        /*---------------------------------------------------------------------------------------------------------------- */
        /*$arr = array(1,2,3,4,5,6,7,8,9);
        $med = StatHelper::getMedian($arr);*/
        return $this->render('index', [
            'valve_info' => $valve_info,
            //'med' => $med
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
         
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
