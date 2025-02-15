<?php

namespace ReneRoboter\Documentext\Controller;

/**
 * ContentController
 */
use ReneRoboter\Documentext\Utility\DateUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
/**
 * ContentController
 */
class ContentController extends ActionController
{

    /**
     * contentRepository
     *
     * @var \ReneRoboter\Documentext\Domain\Repository\ContentRepository
     * @inject
     */
    protected $contentRepository;

    /**
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    public function initializeAction()
    {
        if ($this->arguments->hasArgument('content')) {
            foreach (['workdayAt', 'createdAt'] as $field) {
                $this->arguments->getArgument('content')
                    ->getPropertyMappingConfiguration()
                    ->forProperty($field)
                    ->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter',
                        \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                        'd.m.Y H:i');
            }
        }

    }

    /**
     * @param integer $week
     * @param integer $year
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @plugin ListAction
     */
    public function listAction($week = null, $year = null)
    {
        DateUtility::normalizeWeekYear($week, $year);
        $this->pagination($week, $year);

        $date = [
            'weekNumber' => $week,
            'weekDate'   => $this->getWeekStartAndEnd($week, $year)
        ];
        $this->view->assign('date', $date);
        $contents = $this->contentRepository->findByCalenderWeekEntries($date['weekDate']['start'],
            $date['weekDate']['end']);
        $this->view->assign('contents', $contents);

    }

    /**
     * @param \ReneRoboter\Documentext\Domain\Model\Content|null $content
     * @plugin EntryAction
     */
    public function addFormAction(\ReneRoboter\Documentext\Domain\Model\Content $content = null)
    {
        $this->view->assign('content', $content);
    }

    /**
     * @param \ReneRoboter\Documentext\Domain\Model\Content $content
     */
    public function addAction(\ReneRoboter\Documentext\Domain\Model\Content $content)
    {
        $this->contentRepository->add($content);
        $this->redirect('list');
    }

    /**
     * @param \ReneRoboter\Documentext\Domain\Model\Content $content
     *
     */
    public function updateFormAction(\ReneRoboter\Documentext\Domain\Model\Content $content = null)
    {
        $this->view->assign('content', $content);
    }

    /**
     * @param \ReneRoboter\Documentext\Domain\Model\Content $content
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @ignorevalidation $content
     */
    public function updateAction(\ReneRoboter\Documentext\Domain\Model\Content $content)
    {
        $date = new \DateTime();
        $content->setUpdatedAt($date);

        $period['week'] = $content->getWorkdayAt()
            ->format('W');
        $period['year'] = $content->getWorkdayAt()
            ->format('Y');

        $this->contentRepository->update($content);
        $this->redirect('list', null, null, $period);
    }

    /**
     * @param \ReneRoboter\Documentext\Domain\Model\Content $content
     * @ignorevalidation $content
     */
    public function showAction(\ReneRoboter\Documentext\Domain\Model\Content $content)
    {
        $this->view->assignMultiple([
            'content'     => $content,
            'contentPrev' => $this->contentRepository->findOnePrevByContent($content),
            'contentNext' => $this->contentRepository->findOneNextByContent($content),
        ]);
    }

    /**
     * @param int $weekBeginning
     * @ignorevalidation $weekBeginning
     */
    public function printAction($weekBeginning = null)
    {
        $date = new \DateTime();
        $date->setTimestamp($weekBeginning);

        $weekNumber = $date->format('W');
        $weekStart = $date->format('U');

        $date->modify('+4 day');
        $weekend = $date->format('U');

        DateUtility::normalizeApprenticeshipYear($date->format('Y'), $apprenticeshipYear);
        DateUtility::normalizeApprenticeshipNumber($date->format('U'), $apprenticeshipNumber);

        $this->view->assignMultiple([
            'school'               => $this->contentRepository->findBySchool($weekStart, $weekend),
            'work'                 => $this->contentRepository->findByWork($weekStart, $weekend),
            'weekNumber'           => $weekNumber,
            'apprenticeshipNumber' => $apprenticeshipNumber,
            'apprenticeshipYear'   => $apprenticeshipYear,
            'weekStart'            => $weekStart,
            'weekend'              => $weekend,
        ]);
    }

    /**
     * @param \ReneRoboter\Documentext\Domain\Model\Content $content
     * @ignorevalidation $content
     */
    public function deleteConfirmAction(\ReneRoboter\Documentext\Domain\Model\Content $content)
    {
        $this->view->assign('content', $content);
    }

    /**
     * @param \ReneRoboter\Documentext\Domain\Model\Content $content
     * /@ignorevalidation $content
     */
    public function deleteAction(\ReneRoboter\Documentext\Domain\Model\Content $content)
    {
        $this->contentRepository->remove($content);
        $this->redirect('list');
    }

    /**
     * This method return's a array with two unix-timestamps
     * one for the first day of the week
     * and the other for the end.
     *
     * @param $week
     * @param $year
     *
     * @return mixed
     */
    protected function getWeekStartAndEnd($week, $year)
    {
        $date = new \DateTime();
        $result = [];
        $date->setISODate($year, $week);
        $date->setTime(0, 0);

        $result['start'] = $date->format('U');

        $date->modify('+4 days');
        $result['end'] = $date->format('U');

        return $result;
    }

    /**
     * @param $week
     * @param $year
     */
    protected function pagination($week, $year)
    {
        $week++;
        DateUtility::normalizeWeekYear($week, $year);
        $this->view->assign('nextYear', $year);
        $this->view->assign('nextWeek', $week);

        $week -= 2;
        DateUtility::normalizeWeekYear($week, $year);
        $this->view->assign('prevYear', $year);
        $this->view->assign('prevWeek', $week);
    }
}