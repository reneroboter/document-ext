<?php
namespace ReneRoboter\Documentext\Domain\Repository;
/**
 * Class ContentRepository
 */
use ReneRoboter\Documentext\Domain\Model\Content;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class ContentRepository
 */
class ContentRepository extends Repository
{

    /**
     * @param $weekday
     * @return QueryResultInterface
     */
    public function findByWeekday($weekday)
    {
        $query = $this->createQuery();
        $query->matching($query->equals('workdayAt', $weekday));
        return $query->execute();
    }
    
    /**
     * @param $start
     * @param $end
     * @return array|QueryResultInterface
     */
    public function findByCalenderWeekEntries($start, $end)
    {
        /** @var Query $query */
        $query = $this->createQuery();
        $query->setOrderings(array('workdayAt' => QueryInterface::ORDER_ASCENDING));
        $query->matching($query->between('workdayAt', $start, $end));
        return $query->execute();
    }
    
    /**
     * @param $start
     * @param $end
     * @return mixed
     */
    public function findBySchool($start, $end)
    {
        /** @var Query $query */
        $query = $this->createQuery();
        $query->setOrderings(array('workdayAt' => QueryInterface::ORDER_ASCENDING));
        $query->matching($query->logicalAnd($query->between('workdayAt', $start, $end), $query->equals('category', 1)));
        return $query->execute();
    }
    
    /**
     * @param $start
     * @param $end
     * @return mixed
     */
    public function findByWork($start, $end)
    {
        /** @var Query $query */
        $query = $this->createQuery();
        $query->setOrderings(array('workdayAt' => QueryInterface::ORDER_ASCENDING));
        $query->matching($query->logicalAnd($query->between('workdayAt', $start, $end), $query->equals('category', 0)));
        return $query->execute();
    }
    
    /**
     * @param Content $content
     * @return Content|null
     */
    public function findOneNextByContent(Content $content)
    {
        $workday = $content->getWorkdayAt();
        $query = $this->createQuery();
        $query->setOrderings(array('workdayAt' => QueryInterface::ORDER_ASCENDING));
        $query->matching($query->greaterThan('workday_at', $workday));
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }
    
    /**
     * @param Content $content
     * @return Content|null
     */
    public function findOnePrevByContent(Content $content)
    {
        $workday = $content->getWorkdayAt();
        $query = $this->createQuery();
        $query->setOrderings(array('workdayAt' => QueryInterface::ORDER_DESCENDING));
        $query->matching($query->lessThan('workday_at', $workday));
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }
    
    /**
     * @param string $search
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findBySearchForm($search)
    {
        $query = $this->createQuery();
        $query->matching($query->like('title', '%' . $search . '%'));
        $query->setOrderings(array('title' => QueryInterface::ORDER_DESCENDING));
        $query->setLimit(5);
        return $query->execute();
    }

}