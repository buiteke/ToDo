<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
	'DebugKit.Toolbar',
        'Session',
        'Auth' => array(
            // ログイン後のアクション指定
            'loginRedirect' => array('controller' => 'tasks', 'action' => 'index'),
            // ログアウト後のアクション指定
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        )
	//'Auth' => array(
	//	'authenticate' => array(
	//		'Twim.Twitter' => array(/* options */),
	//	),
	//	'loginAction' => array(
	//		'plugin' => 'twim',
	//		'controller' => 'oauth',
	//		'action' => 'login'
	//	),
	//),
	//'Auth' => array(
	//	// （1）認証の設定
	//	'authenticate' => array(
	//		'all' => array(
	//			'fields' => array(
	//				'username' => 'username',
	//				'password' => 'password',
	//			),
	//		),
	//		'TwitterKit.TwitterOauth',
	//	),
	//	// （2）ログインURL
	//	'loginAction' => array(
	//		'plugin' => 'twitter_kit',
	//		'controller' => 'users',
	//		'action' => 'login',
	//	),
	//	// （3）ログイン完了後に遷移するURL
	//	'loginRedirect' => array(
	//		'plugin' => 'twitter_kit',
	//		'controller' => 'users',
	//		'action' => 'login',
	//	),
	//),
	//'TwitterKit.Twitter',

    );

    public function beforeFilter() {
        // 認証不要のアクション指定（AppControllerなので複数のコントローラ間で横断的に指定していることを意味）
        $this->Auth->allow('index', 'view');
    }

        public function _tweet($tweet) {

                // OAuthスクリプトの読み込み
                //require_once('../webroot/files/twitteroauth/twitteroauth/twitteroauth.php'');
				require_once('D:\home\site\wwwroot\app\webroot\files\twitteroauth\twitteroauth\twitteroauth.php');

                // Consumer key
                $consumer_key = "HpHdBxp6ZdvQDdSunB8pG6tz1";
                // Consumer secret
                $consumer_secret = "Z0OBWi5ukA7OS8M55Skm04tmy21ZJhwNi1GclElZRd9Ki0iVeh";
                // Access token
                $access_token = "2904456636-l686WIpsrAEggQWDiPlOGz1pPtlicgRP0LqcLyw";
                // Access token secret
                $access_token_secret = "uYf6mtHvmVQ3uW6KOSrIrB2fQzavILQUBhPexjIbxOEAx";

                // とりあえず、Twitterの文字制限のことは無視して
                // つぶやく
                $connection = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
                $req = $connection->OAuthRequest("https://api.twitter.com/1.1/statuses/update.json","POST",array("status"=> $tweet ));

        }

}
