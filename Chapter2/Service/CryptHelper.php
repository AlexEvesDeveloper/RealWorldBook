<?php

namespace RealWorldBook\Chapter2\Service;

class CryptHelper
{
    protected static $salt = 'salt';

    public static function getConfirmationCode()
    {
        return sha1(uniqid(self::$salt, TRUE));
    }
}