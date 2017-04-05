<?php
/**
 * Class DateTranslateViewHelper
 */
namespace ReneRoboter\Documentext\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class DateTranslateViewHelper
 */
class DateTranslateViewHelper extends AbstractViewHelper
{

    protected $weekDays = [
        'Monday'      => 'Montag',
        'Tuesday'     => 'Dienstag',
        'Wednesday'   => 'Mittwoch',
        'Thursday'    => 'Donnerstag',
        'Friday'      => 'Freitag',
        'Saturday'    => 'Samstag',
        'Sunday'      => 'Sonntag'
    ];

    /**
     * @param $date
     * @return string
     */
    public function render($date)
    {
        $week =  $date->format('l');

        return $this->weekDays[$week];
    }
}

