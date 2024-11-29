<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Core\Domain\Validation\DomainValidation;
use Throwable;
class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            $value = '';
            DomainValidation::notNull($value);
            $this->assertTrue(false);
        }catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullWithCustomMessage()
    {
        try {
            $value = '';
            DomainValidation::notNull($value, 'Custom message');
            $this->assertTrue(false);
        }catch (Throwable $th) {
            $this->assertEquals('Custom message', 'Custom message');
        }
    }

    public function testStrMaxLength()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Custom message');

        DomainValidation::strMaxLength(
            str_repeat('a', 256),
            255,
            'Custom message'
        );
    }

    public function testStrMinLength()
    {
        try {
            $value = 'Te';
            DomainValidation::strMinLength($value, 3, 'Custom message');
            $this->assertTrue(false);
        }catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'Custom message');
        }
    }

    public function testStrCanNullAndMaxLength()
    {
        try {
            $value = 'test';
            DomainValidation::strCanNullAndMaxLength($value,3, 'Custom message');
            $this->assertTrue(false);
        }catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'Custom message');
        }
    }

}
