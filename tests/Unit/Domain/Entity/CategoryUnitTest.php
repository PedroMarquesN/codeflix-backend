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
            name: 'Cat Name',
            description: 'Cat Desc',
            isActive: true
        );

        $this->assertNotEmpty($category->getId());
        $this->assertEquals('Cat Name', $category->getName());
        $this->assertEquals('Cat Desc', $category->getDescription());
        $this->assertEquals(true, $category->isActive());
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'Cat Name',
            description: 'Cat Desc',
            isActive: true
        );

        $this->assertTrue($category->isActive());
        $category->disable();
        $this->assertFalse($category->isActive());
    }

    public function testUpdate()
    {
        $uuid = (string) \Ramsey\Uuid\Uuid::uuid4()->toString();
        $category = new Category(
            id: $uuid,
            name: 'Cat Name',
            description: 'Cat Desc',
            isActive: true
        );

        $category->update(
            name: 'New Cat Name',
            description: 'New Cat Desc',
            isActive: false
        );

        $this->assertEquals('New Cat Name', $category->getName());
        $this->assertEquals('New Cat Desc', $category->getDescription());
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

    public function testExceptionDescription()
    {
        try {
             new Category(
                name: 'Category Name',
                description: random_bytes(3555555)
            );
            $this->asserttrue(false);
        } catch (EntityValidationException $e) {
            $this->assertInstanceOf(EntityValidationException::class, $e);
        }

    }
}
