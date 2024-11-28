<?php

namespace Core\Domain\Entity;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;


class Category
{
    use MethodsMagicsTrait;
    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {

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
        if (empty($this->name)) {
            throw new EntityValidationException('Name is required');
        }

        if (strlen($this->name) < 3 || strlen($this->name) > 100) {
            throw new EntityValidationException('Name must be between 3 and 100 characters');
        }

        if (empty($this->description)) {
            throw new EntityValidationException('Description is required');
        }

        if (strlen($this->description) < 3 || strlen($this->description) > 100) {
            throw new EntityValidationException('Description must be between 3 and 100 characters');
        }
    }

}
