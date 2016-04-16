<?php

class SV_RichUsernameSupport_Listener
{
    const AddonNameSpace = 'SV_RichUsernameSupport_';

    public static function load_class($class, array &$extend)
    {
        $extend[] = self::AddonNameSpace.$class;
    }
}
