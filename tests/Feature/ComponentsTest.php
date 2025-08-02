<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComponentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_navigation_component_renders(): void
    {
        $view = $this->blade('<x-navigation/>');

        $view->assertSee('PHP Tek 2026', false);
        $view->assertSee('About', false);
        $view->assertSee('Venue', false);
        $view->assertSee('Partners', false);
        $view->assertSee('Register', false);
    }

    public function test_footer_component_renders(): void
    {
        $view = $this->blade('<x-footer/>');

        $view->assertSee('PHPTek', false);
        $view->assertSee('2026', false);
        $view->assertSee('PHP Tek Conference', false);
        $view->assertSee('Code', false);
        $view->assertSee('Conduct', false);
        $view->assertSee('&copy; '.date('Y'), false);
    }

    public function test_about_section_component_renders(): void
    {
        $view = $this->blade('<x-about-section/>');

        $view->assertSee('About', false);
        $view->assertSee('PHP Tek', false);
    }

    public function test_venue_section_component_renders(): void
    {
        $view = $this->blade('<x-venue-section/>');

        $view->assertSee('Venue', false);
    }

    public function test_sponsors_section_component_renders(): void
    {
        $view = $this->blade('<x-sponsors-section/>');

        $view->assertSee('Sponsors', false);
    }

    public function test_registration_section_component_renders(): void
    {
        $view = $this->blade('<x-registration-section/>');

        $view->assertSee('Register', false);
    }

    public function test_code_of_conduct_modal_component_renders(): void
    {
        $view = $this->blade('<x-modals.code-of-conduct-modal/>');

        $view->assertSee('Code of Conduct', false);
    }

    public function test_code_of_privacy_policy_modal_component_renders(): void
    {
        $view = $this->blade('<x-modals.privacy-policy-modal/>');

        $view->assertSee('Privacy Policy', false);
    }

    public function test_code_of_cookie_policy_modal_component_renders(): void
    {
        $view = $this->blade('<x-modals.cookie-policy-modal/>');

        $view->assertSee('Cookie Policy', false);
    }
}
