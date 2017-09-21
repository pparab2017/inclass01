<?php

namespace Base;

use \Messages as ChildMessages;
use \MessagesQuery as ChildMessagesQuery;
use \Exception;
use \PDO;
use Map\MessagesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Messages' table.
 *
 *
 *
 * @method     ChildMessagesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMessagesQuery orderByFromid($order = Criteria::ASC) Order by the fromID column
 * @method     ChildMessagesQuery orderByToid($order = Criteria::ASC) Order by the toID column
 * @method     ChildMessagesQuery orderByTime($order = Criteria::ASC) Order by the time column
 * @method     ChildMessagesQuery orderByRegion($order = Criteria::ASC) Order by the region column
 * @method     ChildMessagesQuery orderByContent($order = Criteria::ASC) Order by the Content column
 * @method     ChildMessagesQuery orderByMsgread($order = Criteria::ASC) Order by the msgRead column
 * @method     ChildMessagesQuery orderByMsglock($order = Criteria::ASC) Order by the msgLock column
 *
 * @method     ChildMessagesQuery groupById() Group by the id column
 * @method     ChildMessagesQuery groupByFromid() Group by the fromID column
 * @method     ChildMessagesQuery groupByToid() Group by the toID column
 * @method     ChildMessagesQuery groupByTime() Group by the time column
 * @method     ChildMessagesQuery groupByRegion() Group by the region column
 * @method     ChildMessagesQuery groupByContent() Group by the Content column
 * @method     ChildMessagesQuery groupByMsgread() Group by the msgRead column
 * @method     ChildMessagesQuery groupByMsglock() Group by the msgLock column
 *
 * @method     ChildMessagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMessagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMessagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMessagesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMessagesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMessagesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMessagesQuery leftJoinUserRelatedByFromid($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByFromid relation
 * @method     ChildMessagesQuery rightJoinUserRelatedByFromid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByFromid relation
 * @method     ChildMessagesQuery innerJoinUserRelatedByFromid($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByFromid relation
 *
 * @method     ChildMessagesQuery joinWithUserRelatedByFromid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByFromid relation
 *
 * @method     ChildMessagesQuery leftJoinWithUserRelatedByFromid() Adds a LEFT JOIN clause and with to the query using the UserRelatedByFromid relation
 * @method     ChildMessagesQuery rightJoinWithUserRelatedByFromid() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByFromid relation
 * @method     ChildMessagesQuery innerJoinWithUserRelatedByFromid() Adds a INNER JOIN clause and with to the query using the UserRelatedByFromid relation
 *
 * @method     ChildMessagesQuery leftJoinUserRelatedByToid($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByToid relation
 * @method     ChildMessagesQuery rightJoinUserRelatedByToid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByToid relation
 * @method     ChildMessagesQuery innerJoinUserRelatedByToid($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByToid relation
 *
 * @method     ChildMessagesQuery joinWithUserRelatedByToid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByToid relation
 *
 * @method     ChildMessagesQuery leftJoinWithUserRelatedByToid() Adds a LEFT JOIN clause and with to the query using the UserRelatedByToid relation
 * @method     ChildMessagesQuery rightJoinWithUserRelatedByToid() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByToid relation
 * @method     ChildMessagesQuery innerJoinWithUserRelatedByToid() Adds a INNER JOIN clause and with to the query using the UserRelatedByToid relation
 *
 * @method     \UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMessages findOne(ConnectionInterface $con = null) Return the first ChildMessages matching the query
 * @method     ChildMessages findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMessages matching the query, or a new ChildMessages object populated from the query conditions when no match is found
 *
 * @method     ChildMessages findOneById(int $id) Return the first ChildMessages filtered by the id column
 * @method     ChildMessages findOneByFromid(int $fromID) Return the first ChildMessages filtered by the fromID column
 * @method     ChildMessages findOneByToid(int $toID) Return the first ChildMessages filtered by the toID column
 * @method     ChildMessages findOneByTime(string $time) Return the first ChildMessages filtered by the time column
 * @method     ChildMessages findOneByRegion(string $region) Return the first ChildMessages filtered by the region column
 * @method     ChildMessages findOneByContent(string $Content) Return the first ChildMessages filtered by the Content column
 * @method     ChildMessages findOneByMsgread(string $msgRead) Return the first ChildMessages filtered by the msgRead column
 * @method     ChildMessages findOneByMsglock(string $msgLock) Return the first ChildMessages filtered by the msgLock column *

 * @method     ChildMessages requirePk($key, ConnectionInterface $con = null) Return the ChildMessages by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOne(ConnectionInterface $con = null) Return the first ChildMessages matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMessages requireOneById(int $id) Return the first ChildMessages filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByFromid(int $fromID) Return the first ChildMessages filtered by the fromID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByToid(int $toID) Return the first ChildMessages filtered by the toID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByTime(string $time) Return the first ChildMessages filtered by the time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByRegion(string $region) Return the first ChildMessages filtered by the region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByContent(string $Content) Return the first ChildMessages filtered by the Content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByMsgread(string $msgRead) Return the first ChildMessages filtered by the msgRead column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByMsglock(string $msgLock) Return the first ChildMessages filtered by the msgLock column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMessages[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMessages objects based on current ModelCriteria
 * @method     ChildMessages[]|ObjectCollection findById(int $id) Return ChildMessages objects filtered by the id column
 * @method     ChildMessages[]|ObjectCollection findByFromid(int $fromID) Return ChildMessages objects filtered by the fromID column
 * @method     ChildMessages[]|ObjectCollection findByToid(int $toID) Return ChildMessages objects filtered by the toID column
 * @method     ChildMessages[]|ObjectCollection findByTime(string $time) Return ChildMessages objects filtered by the time column
 * @method     ChildMessages[]|ObjectCollection findByRegion(string $region) Return ChildMessages objects filtered by the region column
 * @method     ChildMessages[]|ObjectCollection findByContent(string $Content) Return ChildMessages objects filtered by the Content column
 * @method     ChildMessages[]|ObjectCollection findByMsgread(string $msgRead) Return ChildMessages objects filtered by the msgRead column
 * @method     ChildMessages[]|ObjectCollection findByMsglock(string $msgLock) Return ChildMessages objects filtered by the msgLock column
 * @method     ChildMessages[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MessagesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MessagesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Messages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMessagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMessagesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMessagesQuery) {
            return $criteria;
        }
        $query = new ChildMessagesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildMessages|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MessagesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MessagesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMessages A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, fromID, toID, time, region, Content, msgRead, msgLock FROM Messages WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildMessages $obj */
            $obj = new ChildMessages();
            $obj->hydrate($row);
            MessagesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildMessages|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessagesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessagesTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the fromID column
     *
     * Example usage:
     * <code>
     * $query->filterByFromid(1234); // WHERE fromID = 1234
     * $query->filterByFromid(array(12, 34)); // WHERE fromID IN (12, 34)
     * $query->filterByFromid(array('min' => 12)); // WHERE fromID > 12
     * </code>
     *
     * @see       filterByUserRelatedByFromid()
     *
     * @param     mixed $fromid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByFromid($fromid = null, $comparison = null)
    {
        if (is_array($fromid)) {
            $useMinMax = false;
            if (isset($fromid['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_FROMID, $fromid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fromid['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_FROMID, $fromid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_FROMID, $fromid, $comparison);
    }

    /**
     * Filter the query on the toID column
     *
     * Example usage:
     * <code>
     * $query->filterByToid(1234); // WHERE toID = 1234
     * $query->filterByToid(array(12, 34)); // WHERE toID IN (12, 34)
     * $query->filterByToid(array('min' => 12)); // WHERE toID > 12
     * </code>
     *
     * @see       filterByUserRelatedByToid()
     *
     * @param     mixed $toid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByToid($toid = null, $comparison = null)
    {
        if (is_array($toid)) {
            $useMinMax = false;
            if (isset($toid['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_TOID, $toid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($toid['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_TOID, $toid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_TOID, $toid, $comparison);
    }

    /**
     * Filter the query on the time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('2011-03-14'); // WHERE time = '2011-03-14'
     * $query->filterByTime('now'); // WHERE time = '2011-03-14'
     * $query->filterByTime(array('max' => 'yesterday')); // WHERE time > '2011-03-13'
     * </code>
     *
     * @param     mixed $time The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_TIME, $time, $comparison);
    }

    /**
     * Filter the query on the region column
     *
     * Example usage:
     * <code>
     * $query->filterByRegion('fooValue');   // WHERE region = 'fooValue'
     * $query->filterByRegion('%fooValue%'); // WHERE region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $region The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByRegion($region = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($region)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_REGION, $region, $comparison);
    }

    /**
     * Filter the query on the Content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE Content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE Content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the msgRead column
     *
     * Example usage:
     * <code>
     * $query->filterByMsgread('fooValue');   // WHERE msgRead = 'fooValue'
     * $query->filterByMsgread('%fooValue%'); // WHERE msgRead LIKE '%fooValue%'
     * </code>
     *
     * @param     string $msgread The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByMsgread($msgread = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($msgread)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_MSGREAD, $msgread, $comparison);
    }

    /**
     * Filter the query on the msgLock column
     *
     * Example usage:
     * <code>
     * $query->filterByMsglock('fooValue');   // WHERE msgLock = 'fooValue'
     * $query->filterByMsglock('%fooValue%'); // WHERE msgLock LIKE '%fooValue%'
     * </code>
     *
     * @param     string $msglock The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByMsglock($msglock = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($msglock)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_MSGLOCK, $msglock, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByFromid($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(MessagesTableMap::COL_FROMID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MessagesTableMap::COL_FROMID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByFromid() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByFromid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function joinUserRelatedByFromid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByFromid');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UserRelatedByFromid');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByFromid relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByFromidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByFromid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByFromid', '\UserQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByToid($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(MessagesTableMap::COL_TOID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MessagesTableMap::COL_TOID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByToid() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByToid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function joinUserRelatedByToid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByToid');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UserRelatedByToid');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByToid relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByToidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByToid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByToid', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMessages $messages Object to remove from the list of results
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function prune($messages = null)
    {
        if ($messages) {
            $this->addUsingAlias(MessagesTableMap::COL_ID, $messages->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessagesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MessagesTableMap::clearInstancePool();
            MessagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessagesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MessagesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MessagesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MessagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MessagesQuery
