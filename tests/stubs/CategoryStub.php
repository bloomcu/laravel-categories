<?php

use BloomCU\Categories\Models\Category;

// Setup a stub model for testing
class CategoryStub extends Category
{
    // This model is loaded from the test environment database
    protected $connection = 'testbench';
    public $table = 'categories';
}
