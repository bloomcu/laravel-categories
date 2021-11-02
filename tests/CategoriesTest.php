<?php

class CategoriesTest extends TestCase
{
    protected $lesson;

    public function setUp(): void
    {
        parent::setUp();

        // Create categories to work with
        foreach (['PHP', 'JavaScript', 'HTML'] as $category) {
            \CategoryStub::create(['title' => $category]);
        }

        // Create a child category
        \CategoryStub::create(['title' => 'Laravel', 'parent_id' => 1]);

        // Create a lesson to work with
        $this->lesson = \LessonStub::create([
            'title' => 'A lesson title'
        ]);
    }

    public function test_can_get_only_parent_categories()
    {
        $parents = \CategoryStub::parents()->get();
        $this->assertCount(3, $parents);
    }

    public function test_category_generates_its_slug_from_title()
    {
        $categories = collect([
            ['title' => 'Ruby on Rails', 'slug' => 'ruby-on-rails'],
            ['title' => 'SCSS', 'slug' => 'scss'],
            ['title' => 'c++', 'slug' => 'c'],
        ]);

        foreach ($categories as $category) {
            // Create category with only title
            $newCategory = \CategoryStub::create(['title' => $category['title']]);

            // Assert category has correct slug
            $this->assertStringContainsString($category['slug'], $newCategory->slug);
        }
    }

    public function test_can_categorize_lesson()
    {
        $this->lesson->category_id = 1;
        $this->assertContains('PHP', $this->lesson->category->pluck('title'));
    }

    public function test_can_recategorize_lesson()
    {
        $this->lesson->category_id = 1;
        $this->lesson->category_id = 2;
        $this->assertContains('JavaScript', $this->lesson->category->pluck('title'));
    }

    public function test_can_uncategorize_lesson()
    {
        $this->lesson->category_id = 1;
        $this->lesson->category_id = NULL;
        $this->assertEmpty($this->lesson->category);
    }

    // public function test_non_existing_category_is_ignored()
    // {
    //     // Categorize lesson
    //     $this->lesson->categorize('hamburger');
    //
    //     // Assert lesson has no category
    //     $this->assertEmpty($this->lesson->category);
    // }

    // public function test_random_category_cases_are_normalised()
    // {
    //     // Categorize lesson
    //     $this->lesson->categorize('TruCK');
    //
    //     // Assert lesson has 1 category
    //     $this->assertCount(1, $this->lesson->category);
    //
    //     // Assert lesson has the right category
    //     $this->assertContains('truck', $this->lesson->category->pluck('title'));
    // }
}
