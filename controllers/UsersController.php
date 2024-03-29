<?php


namespace app\controllers;
use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class UsersController extends Controller
{
public function actionIndex() {
    $user = new Users();
    return $this->renderPartial('login' , ['model'=>$user]);
}

public function actionLogin() {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $user = new Users();
    $user = $user->login($name, $pass);
    if ($user) {
      	$session = Yii::$app->session;
        $session->set('user',$name);
        return  Yii::$app->response->redirect(Url::to(['/']));
    } else {
        return $this->renderPartial('error' , ['user'=>$name]);
    }
}

public function actionReg() {
    $user = new Users();
    return $this->renderPartial('register');
}

public function actionLogout($user){
    $session = Yii::$app->session;
//    if ( $session->get('user') == 'admin')
    if( $session->get('user')){
        $session->remove('user');
          return  Yii::$app->response->redirect(Url::to(['/']));
    }
}
}