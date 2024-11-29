<?php

namespace Core\Domain\Entity\Traits;

use Exception;

trait MethodsMagicsTrait
{
    public function __get($property)
    {
        if(isset($this->{$property}))
            return $this->{$property};

        $className = get_class($this);
        throw new Exception("Property {$property} not found in {$className}");
    }
    public function getId(): string
    {
        return (string) $this->id;

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

}
