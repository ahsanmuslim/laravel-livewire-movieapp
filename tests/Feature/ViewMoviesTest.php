<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function the_main_page_shows_correct_info()
    {
        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');

    }
}
