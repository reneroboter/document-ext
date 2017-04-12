<?php


namespace ReneRoboter\Documentext\Utility;


class RegisterUtility
{
    /**
     * @return array
     */
    public static function getAutoloaderLoader()
    {
        return [
            'SmartObjects',
            'FlexForms',
            'Plugins',
            'StaticTyposcript',
            'TcaFiles',
            'Slots',
            'BackendLayout'
        ];
    }
}