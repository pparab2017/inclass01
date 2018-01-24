<?php

namespace Base;

use \ProjectMessages as ChildProjectMessages;
use \ProjectMessagesQuery as ChildProjectMessagesQuery;
use \Exception;
use \PDO;
use Map\ProjectMessagesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'project_messages' table.
 *
 *
 *
 * @method     ChildProjectMessagesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProjectMessagesQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method     ChildProjectMessagesQuery orderByReminderType($order = Criteria::ASC) Order by the reminder_type column
 * @method     ChildProjectMessagesQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildProjectMessagesQuery orderByTime($order = Criteria::ASC) Order by the Time column
 * @method     ChildProjectMessagesQuery orderByStudyId($order = Criteria::ASC) Order by the Study_Id column
 * @method     ChildProjectMessagesQuery orderByLastsent($order = Criteria::ASC) Order by the LastSent column
 * @method     ChildProjectMessagesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProjectMessagesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProjectMessagesQuery groupById() Group by the id column
 * @method     ChildProjectMessagesQuery groupByText() Group by the text column
 * @method     ChildProjectMessagesQuery groupByReminderType() Group by the reminder_type column
 * @method     ChildProjectMessagesQuery groupByType() Group by the type column
 * @method     ChildProjectMessagesQuery groupByTime() Group by the Time column
 * @method     ChildProjectMessagesQuery groupByStudyId() Group by the Study_Id column
 * @method     ChildProjectMessagesQuery groupByLastsent() Group by the LastSent column
 * @method     ChildProjectMessagesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProjectMessagesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProjectMessagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectMessagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectMessagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectMessagesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectMessagesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectMessagesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectMessagesQuery leftJoinProjectStudy($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectStudy relation
 * @method     ChildProjectMessagesQuery rightJoinProjectStudy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectStudy relation
 * @method     ChildProjectMessagesQuery innerJoinProjectStudy($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectStudy relation
 *
 * @method     ChildProjectMessagesQuery joinWithProjectStudy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectStudy relation
 *
 * @method     ChildProjectMessagesQuery leftJoinWithProjectStudy() Adds a LEFT JOIN clause and with to the query using the ProjectStudy relation
 * @method     ChildProjectMessagesQuery rightJoinWithProjectStudy() Adds a RIGHT JOIN clause and with to the query using the ProjectStudy relation
 * @method     ChildProjectMessagesQuery innerJoinWithProjectStudy() Adds a INNER JOIN clause and with to the query using the ProjectStudy relation
 *
 * @method     ChildProjectMessagesQuery leftJoinProjectNotification($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectNotification relation
 * @method     ChildProjectMessagesQuery rightJoinProjectNotification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectNotification relation
 * @method     ChildProjectMessagesQuery innerJoinProjectNotification($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectNotification relation
 *
 * @method     ChildProjectMessagesQuery joinWithProjectNotification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectNotification relation
 *
 * @method     ChildProjectMessagesQuery leftJoinWithProjectNotification() Adds a LEFT JOIN clause and with to the query using the ProjectNotification relation
 * @method     ChildProjectMessagesQuery rightJoinWithProjectNotification() Adds a RIGHT JOIN clause and with to the query using the ProjectNotification relation
 * @method     ChildProjectMessagesQuery innerJoinWithProjectNotification() Adds a INNER JOIN clause and with to the query using the ProjectNotification relation
 *
 * @method     \ProjectStudyQuery|\ProjectNotificationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProjectMessages findOne(ConnectionInterface $con = null) Return the first ChildProjectMessages matching the query
 * @method     ChildProjectMessages findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProjectMessages matching the query, or a new ChildProjectMessages object populated from the query conditions when no match is found
 *
 * @method     ChildProjectMessages findOneById(int $id) Return the first ChildProjectMessages filtered by the id column
 * @method     ChildProjectMessages findOneByText(string $text) Return the first ChildProjectMessages filtered by the text column
 * @method     ChildProjectMessages findOneByReminderType(string $reminder_type) Return the first ChildProjectMessages filtered by the reminder_type column
 * @method     ChildProjectMessages findOneByType(string $type) Return the first ChildProjectMessages filtered by the type column
 * @method     ChildProjectMessages findOneByTime(string $Time) Return the first ChildProjectMessages filtered by the Time column
 * @method     ChildProjectMessages findOneByStudyId(int $Study_Id) Return the first ChildProjectMessages filtered by the Study_Id column
 * @method     ChildProjectMessages findOneByLastsent(string $LastSent) Return the first ChildProjectMessages filtered by the LastSent column
 * @method     ChildProjectMessages findOneByCreatedAt(string $created_at) Return the first ChildProjectMessages filtered by the created_at column
 * @method     ChildProjectMessages findOneByUpdatedAt(string $updated_at) Return the first ChildProjectMessages filtered by the updated_at column *

 * @method     ChildProjectMessages requirePk($key, ConnectionInterface $con = null) Return the ChildProjectMessages by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOne(ConnectionInterface $con = null) Return the first ChildProjectMessages matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectMessages requireOneById(int $id) Return the first ChildProjectMessages filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByText(string $text) Return the first ChildProjectMessages filtered by the text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByReminderType(string $reminder_type) Return the first ChildProjectMessages filtered by the reminder_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByType(string $type) Return the first ChildProjectMessages filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByTime(string $Time) Return the first ChildProjectMessages filtered by the Time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByStudyId(int $Study_Id) Return the first ChildProjectMessages filtered by the Study_Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByLastsent(string $LastSent) Return the first ChildProjectMessages filtered by the LastSent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByCreatedAt(string $created_at) Return the first ChildProjectMessages filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectMessages requireOneByUpdatedAt(string $updated_at) Return the first ChildProjectMessages filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectMessages[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProjectMessages objects based on current ModelCriteria
 * @method     ChildProjectMessages[]|ObjectCollection findById(int $id) Return ChildProjectMessages objects filtered by the id column
 * @method     ChildProjectMessages[]|ObjectCollection findByText(string $text) Return ChildProjectMessages objects filtered by the text column
 * @method     ChildProjectMessages[]|ObjectCollection findByReminderType(string $reminder_type) Return ChildProjectMessages objects filtered by the reminder_type column
 * @method     ChildProjectMessages[]|ObjectCollection findByType(string $type) Return ChildProjectMessages objects filtered by the type column
 * @method     ChildProjectMessages[]|ObjectCollection findByTime(string $Time) Return ChildProjectMessages objects filtered by the Time column
 * @method     ChildProjectMessages[]|ObjectCollection findByStudyId(int $Study_Id) Return ChildProjectMessages objects filtered by the Study_Id column
 * @method     ChildProjectMessages[]|ObjectCollection findByLastsent(string $LastSent) Return ChildProjectMessages objects filtered by the LastSent column
 * @method     ChildProjectMessages[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProjectMessages objects filtered by the created_at column
 * @method     ChildProjectMessages[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProjectMessages objects filtered by the updated_at column
 * @method     ChildProjectMessages[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProjectMessagesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProjectMessagesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProjectMessages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectMessagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectMessagesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProjectMessagesQuery) {
            return $criteria;
        }
        $query = new ChildProjectMessagesQuery();
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
     * @return ChildProjectMessages|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectMessagesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectMessagesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProjectMessages A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, text, reminder_type, type, Time, Study_Id, LastSent, created_at, updated_at FROM project_messages WHERE id = :p0';
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
            /** @var ChildProjectMessages $obj */
            $obj = new ChildProjectMessages();
            $obj->hydrate($row);
            ProjectMessagesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProjectMessages|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
     * $query->filterByText('%fooValue%', Criteria::LIKE); // WHERE text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the reminder_type column
     *
     * Example usage:
     * <code>
     * $query->filterByReminderType('fooValue');   // WHERE reminder_type = 'fooValue'
     * $query->filterByReminderType('%fooValue%', Criteria::LIKE); // WHERE reminder_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $reminderType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByReminderType($reminderType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reminderType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_REMINDER_TYPE, $reminderType, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the Time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('fooValue');   // WHERE Time = 'fooValue'
     * $query->filterByTime('%fooValue%', Criteria::LIKE); // WHERE Time LIKE '%fooValue%'
     * </code>
     *
     * @param     string $time The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($time)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_TIME, $time, $comparison);
    }

    /**
     * Filter the query on the Study_Id column
     *
     * Example usage:
     * <code>
     * $query->filterByStudyId(1234); // WHERE Study_Id = 1234
     * $query->filterByStudyId(array(12, 34)); // WHERE Study_Id IN (12, 34)
     * $query->filterByStudyId(array('min' => 12)); // WHERE Study_Id > 12
     * </code>
     *
     * @see       filterByProjectStudy()
     *
     * @param     mixed $studyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByStudyId($studyId = null, $comparison = null)
    {
        if (is_array($studyId)) {
            $useMinMax = false;
            if (isset($studyId['min'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_STUDY_ID, $studyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($studyId['max'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_STUDY_ID, $studyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_STUDY_ID, $studyId, $comparison);
    }

    /**
     * Filter the query on the LastSent column
     *
     * Example usage:
     * <code>
     * $query->filterByLastsent('2011-03-14'); // WHERE LastSent = '2011-03-14'
     * $query->filterByLastsent('now'); // WHERE LastSent = '2011-03-14'
     * $query->filterByLastsent(array('max' => 'yesterday')); // WHERE LastSent > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastsent The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByLastsent($lastsent = null, $comparison = null)
    {
        if (is_array($lastsent)) {
            $useMinMax = false;
            if (isset($lastsent['min'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_LASTSENT, $lastsent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastsent['max'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_LASTSENT, $lastsent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_LASTSENT, $lastsent, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProjectMessagesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectMessagesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProjectStudy object
     *
     * @param \ProjectStudy|ObjectCollection $projectStudy The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByProjectStudy($projectStudy, $comparison = null)
    {
        if ($projectStudy instanceof \ProjectStudy) {
            return $this
                ->addUsingAlias(ProjectMessagesTableMap::COL_STUDY_ID, $projectStudy->getId(), $comparison);
        } elseif ($projectStudy instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectMessagesTableMap::COL_STUDY_ID, $projectStudy->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProjectStudy() only accepts arguments of type \ProjectStudy or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectStudy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function joinProjectStudy($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectStudy');

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
            $this->addJoinObject($join, 'ProjectStudy');
        }

        return $this;
    }

    /**
     * Use the ProjectStudy relation ProjectStudy object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProjectStudyQuery A secondary query class using the current class as primary query
     */
    public function useProjectStudyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectStudy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectStudy', '\ProjectStudyQuery');
    }

    /**
     * Filter the query by a related \ProjectNotification object
     *
     * @param \ProjectNotification|ObjectCollection $projectNotification the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function filterByProjectNotification($projectNotification, $comparison = null)
    {
        if ($projectNotification instanceof \ProjectNotification) {
            return $this
                ->addUsingAlias(ProjectMessagesTableMap::COL_ID, $projectNotification->getMessageId(), $comparison);
        } elseif ($projectNotification instanceof ObjectCollection) {
            return $this
                ->useProjectNotificationQuery()
                ->filterByPrimaryKeys($projectNotification->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProjectNotification() only accepts arguments of type \ProjectNotification or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectNotification relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function joinProjectNotification($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectNotification');

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
            $this->addJoinObject($join, 'ProjectNotification');
        }

        return $this;
    }

    /**
     * Use the ProjectNotification relation ProjectNotification object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProjectNotificationQuery A secondary query class using the current class as primary query
     */
    public function useProjectNotificationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectNotification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectNotification', '\ProjectNotificationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProjectMessages $projectMessages Object to remove from the list of results
     *
     * @return $this|ChildProjectMessagesQuery The current query, for fluid interface
     */
    public function prune($projectMessages = null)
    {
        if ($projectMessages) {
            $this->addUsingAlias(ProjectMessagesTableMap::COL_ID, $projectMessages->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectMessagesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectMessagesTableMap::clearInstancePool();
            ProjectMessagesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectMessagesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectMessagesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectMessagesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectMessagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProjectMessagesQuery
