<?php

namespace Tests\Unit\Domain\Entity;


use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            id: '',
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $this->assertEquals('Category Name', $category->getName());
        $this->assertEquals('Category Description', $category->getDescription());
        $this->assertEquals(true, $category->isActive());

    }

}
