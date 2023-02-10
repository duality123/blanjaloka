<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
class dbTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
      /*
      DB_CONNECTION=mysql
      DB_HOST=103.186.1.159
      DB_PORT=8090
      DB_DATABASE=www_blanjaloka
      DB_USERNAME=www_blanjaloka
      DB_PASSWORD=Blanjaloka2015230032

      */
      /*
      if(Schema::hasTable('users')){
        $this->assertTrue(true);
      }
      */
      $this->assertDatabaseMissing('users',['email'=>'pimooki@pinooki.com']);


    }
}
