<?php
namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(string $value, string $exceptMessage = null)
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptMessage ?? 'Value is required');
        }
    }

    public static function strMaxLength(string $value, int $length = 255, string $exceptMessage = null)
    {
        if (strlen($value) > $length) {
            throw new EntityValidationException($exceptMessage ?? 'Value exceeds the maximum length');
        }
    }

    public static function strMinLength(string $value, int $length = 3, string $exceptMessage = null)
    {
        if (strlen($value) < $length) {
            throw new EntityValidationException($exceptMessage ?? 'Value is less than the minimum length');
        }
    }

    public static function strCanNullAndMaxLength(string $value = '', int $length = 255, string $exceptMessage = null)
    {
        if (!empty($value) && strlen($value) > $length) {
            throw new EntityValidationException($exceptMessage ?? 'Value exceeds the maximum length');
        }
    }
}
