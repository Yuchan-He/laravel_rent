<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function a_article_can_be_added()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
