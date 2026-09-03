<?php
namespace Tests\Feature;
use Tests\TestCase;
class HealthTest extends TestCase {public function test_portal_home_is_reachable(): void {$this->get('/')->assertOk();}}
