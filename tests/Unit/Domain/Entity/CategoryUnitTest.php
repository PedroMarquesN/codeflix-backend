<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $this->assertEquals('Category Name', $category->getName());
        $this->assertEquals('Category Description', $category->getDescription());
        $this->assertEquals(true, $category->isActive());
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $this->assertTrue($category->isActive());
        $category->disable();
        $this->assertFalse($category->isActive());
    }

    public function testUpdate()
    {
        $uuid = 'uuid.value';
        $category = new Category(
            id: $uuid,
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $category->update(
            name: 'New Category Name',
            description: 'New Category Description',
            isActive: false
        );

        $this->assertEquals('New Category Name', $category->getName());
        $this->assertEquals('New Category Description', $category->getDescription());
        $this->assertEquals(false, $category->isActive());
    }

    public function testValidate()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Name is required');

        $category = new Category(
            name: '',
            description: 'Category Description'
        );

        $category->validate();
    }
}
