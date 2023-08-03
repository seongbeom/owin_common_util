<?php

namespace Owin\OwinCommonUtil\Enums;

Enum CharactersEnum: string
{
    case NUMERIC = '0123456789';
    case ALPHABETIC = 'abcdefghijklmnopqrstuvwxyz';
    case ALPHABETIC_CAPITAL = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    case ALPHANUMERIC = '0123456789abcdefghijklmnopqrstuvwxyz';
    case ALPHANUMERIC_CAPITAL = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
}