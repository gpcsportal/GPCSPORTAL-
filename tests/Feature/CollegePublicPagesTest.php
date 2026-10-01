<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollegePublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_college_information_is_public_and_has_unique_metadata(): void
    {
        foreach (config('college.pages') as $slug => $page) {
            $response = $this->get('/'.$slug);
            $response->assertOk()->assertSee($page['title'])->assertSee('name="description"', false);
            $this->assertSame(1, substr_count($response->getContent(), '<h1'));
        }
    }

    public function test_programmes_and_sitemap_follow_active_branch_configuration(): void
    {
        foreach (array_keys(config('college.programmes')) as $slug) {
            $this->get('/programmes/'.$slug)->assertOk();
        }
        $this->get('/programmes/unknown')->assertNotFound();
        $this->get('/sitemap.xml')->assertOk()->assertSee('/admissions')->assertSee('/programmes/cs');
        $this->get('/api/papers')->assertUnauthorized();
        $this->get('/api/notes')->assertUnauthorized();
        $this->get('/api/gallery')->assertUnauthorized();
    }

    public function test_home_keeps_existing_resource_controls_and_correct_main_landmark(): void
    {
        $response = $this->get('/');
        $response->assertOk()->assertSee('Explore Programmes')->assertSee('Student Login')->assertSee('id="gpcsRouteView"', false);
        $html = preg_replace('/<script\b[^>]*>.*?<\/script>/s', '', $response->getContent());
        $this->assertSame(1, substr_count($html, '<main'));
        $this->assertLessThan(strpos($html, '</main>'), strpos($html, 'id="gpcsRouteView"'));
    }
}
