<?php

use Illuminate\Database\Eloquent\Model;
use BloomCU\Categories\Traits\HasCategory;

// Setup a stub model for testing
class LessonStub extends Model
{
    use HasCategory;

    // This model is loaded from the test environment database
    protected $connection = 'testbench';
    public $table = 'lessons';
}
