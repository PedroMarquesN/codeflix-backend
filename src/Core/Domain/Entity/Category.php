<?php

namespace Core\Domain\Entity;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;


class Category
{
    use MethodsMagicsTrait;
    public function __construct(
        protected Uuid | string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();

        $this->validate();
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function disable(): void
    {
        $this->isActive = false;
    }
    public function update(string $name, string $description, bool $isActive): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->isActive = $isActive;

        $this->validate();
    }

    public function validate()
    {
        DomainValidation::notNull($this->name, 'Name is required');
        DomainValidation::strMinLength($this->name, 3, 'Name must have at least 3 characters');
        DomainValidation::strMaxLength($this->name, 255, 'Name must not exceed 255 characters');
        DomainValidation::strCanNullAndMaxLength($this->description, 255, 'Description must not exceed 255 characters');

    }

}
