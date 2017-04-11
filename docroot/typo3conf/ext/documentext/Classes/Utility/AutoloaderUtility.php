<?php


namespace ReneRoboter\Documentext\Utility;


class AutoloaderUtility
{
    /**
     * @return array
     */
    public static function getConfiguration()
    {
        return [
            'AlternativeImplementations',
            'ExtensionTypoScriptSetup',
            'BackendLayout',
            'StaticTyposcript',
            'ContentObjects',
            'SmartObjects',
            'TcaFiles',
            'FlexForms',
            'Xclass',
            'Hooks',
            'Plugins',
            'LanguageOverride',
            'Slots',
            'CommandController'
        ];
    }
}