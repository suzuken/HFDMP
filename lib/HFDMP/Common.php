<?php
namespace HFDMP;

class Common
{
    public static function generateId()
    {
        return sha1(time());
    }
}
