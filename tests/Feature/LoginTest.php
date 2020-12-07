<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    // 現時点のDBのデータを全部なくす,毎回テストする後に、DB全部クリアする
    use RefreshDatabase;

    /**
     * 登録していないユーザー、管理画面見れない
     *
     * @return void
     */
    public function test_login_when_user_go_admin()
    {   
        // 直接管理画面にアクセスするとき
        $response = $this -> get('/admin/index');
        // ログイン画面へ遷移する
        $response -> assertRedirect('/front/login');
      
    }

    /**
     * ユーザー新規登録
     *
     * @return void
     */
    // public function test_signup()
    // {   // 現時点のDBのデータを全部なくす
    //     // factoryでユーザーを作成
    //     $this -> actingAs(factory(User::class) -> create());
    //     // 登録済みのユーザーを管理画面にアクセスするとき
    //     $response = $this -> get('/admin/index');
    //     // httpステータスコードは200であることを検証
    //     $response -> assertOk();
    // }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_can_signup()
    {
        // 具体的なエラーを表示するよう  
        $this -> withoutExceptionHandling();
        // user情報提出
        $response = $this -> post('/front/signup',[
            'username' => 'testuser',
            'password' => '1',
            'role_id' => '4',
            'sex' => '1',

        ]);

        // 追加成功したときのresponseはOK
        $response -> assertOK();

        // DBにユーザー追加したかどうか確認
        $this -> assertCount(1, User::all());      
    }    
}
