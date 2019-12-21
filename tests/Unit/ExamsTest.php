<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ExamsTest extends TestCase
{
    use DatabaseMigrations;

      /** @test */
    public function exams_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('exams', [
            'id', "name", "description", "date_created", "logo_path", "website", "portal-website", "admitting", "type", "phone", "email"
          ]), 1);
    }
}
