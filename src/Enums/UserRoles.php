<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRoles: string
{
    case Admin = 'ROLE_ADMIN';
    case Uzivatel = 'ROLE_UZIVATEL';

    public function value(): string {
        return $this->value;
    }
}