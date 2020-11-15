<?php

use Illuminate\Database\Seeder;
// 関連するのModelを入れる
// use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// 元のデータをクリアする
    	\App\Models\Article::truncate();
        // factoryでdataを補充する
        factory(\App\Models\Article::class,30) -> create();
    }
}
