<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreatePost(){

        $response = $this->call('POST', '/newsPost', [
            'category' => '1',
            'news_title' => 'Test Tile',
            'image'=>'http://imgsv.imaging.nikon.com/lineup/lens/zoom/normalzoom/af-s_dx_18-140mmf_35-56g_ed_vr/img/sample/sample1_l.jpg',
            'news_content'=>'Demo content description.',

        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }
}
