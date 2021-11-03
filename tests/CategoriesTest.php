<?php

class CategoriesTest extends TestCase
{
    protected $lesson;

    public function setUp(): void
    {
        parent::setUp();

        // Create categories to work with
        $categories = collect([
            [
                'title' => 'PHP',
                'order' => 1
            ],
            [
                'title' => 'JavaScript',
                'order' => 3
            ],
            [
                'title' => 'Ruby on Rails',
                'order' => 2
            ]
        ]);
        foreach ($categories as $category) {
            \CategoryStub::create([
                'title' => $category['title'],
                'order' => $category['order']
            ]);
        }

        // Create a child category
        \CategoryStub::create([
            'title' => 'Laravel',
            'parent_id' => 1
        ]);

        // Create a lesson to work with
        $this->lesson = \LessonStub::create([
            'title' => 'A lesson title'
        ]);
    }

    public function test_it_has_many_children()
    {
        $category = \CategoryStub::create(['title' => 'Parent Category']);
        $category->children()->save(
            \CategoryStub::create(['title' => 'Child Category'])
        );
        $this->assertInstanceOf(BloomCU\Categories\Models\Category::class, $category->children->first());
    }

    public function test_can_get_only_parent_categories()
    {
        $categories = \CategoryStub::parents()->get();
        $this->assertCount(3, $categories);
    }

    public function test_can_get_categories_in_order()
    {
        $category = \CategoryStub::parents()->ordered()->get()->last();
        $this->assertStringContainsString('JavaScript', $category->pluck('title'));
    }

    public function test_can_generate_its_slug_from_title()
    {
        $category = \CategoryStub::create(['title' => 'Sentence case title']);
        $this->assertNotNull($category['slug']);
        $this->assertStringContainsString($category['slug'], 'sentence-case-title');
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

    // TODO
    // public function test_non_existing_category_is_ignored()
    // {
    // }
}
