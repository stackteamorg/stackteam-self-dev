<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_category()
    {
        $response = $this->post('/categories', [
            'name' => 'New Category',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::create(['name' => 'Old Category']);

        $response = $this->put("/categories/{$category->id}", [
            'name' => 'Updated Category',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['name' => 'Updated Category']);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::create(['name' => 'Category to Delete']);

        $response = $this->delete("/categories/{$category->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['name' => 'Category to Delete']);
    }

    /** @test */
    public function it_can_run_edit_categories_command()
    {
        $this->artisan('edit:categories')
            ->assertExitCode(0);
    }
}