<?php

namespace Base;

use \ProjectNotification as ChildProjectNotification;
use \ProjectNotificationQuery as ChildProjectNotificationQuery;
use \Exception;
use \PDO;
use Map\ProjectNotificationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'project_notification' table.
 *
 *
 *
 * @method     ChildProjectNotificationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProjectNotificationQuery orderByStudyId($order = Criteria::ASC) Order by the study_id column
 * @method     ChildProjectNotificationQuery orderByResponseText($order = Criteria::ASC) Order by the response_text column
 * @method     ChildProjectNotificationQuery orderByTime($order = Criteria::ASC) Order by the time column
 * @method     ChildProjectNotificationQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildProjectNotificationQuery orderByMessageId($order = Criteria::ASC) Order by the message_id column
 * @method     ChildProjectNotificationQuery orderByOpenedAt($order = Criteria::ASC) Order by the opened_at column
 * @method     ChildProjectNotificationQuery orderByAnswredAt($order = Criteria::ASC) Order by the answred_at column
 * @method     ChildProjectNotificationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProjectNotificationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProjectNotificationQuery groupById() Group by the id column
 * @method     ChildProjectNotificationQuery groupByStudyId() Group by the study_id column
 * @method     ChildProjectNotificationQuery groupByResponseText() Group by the response_text column
 * @method     ChildProjectNotificationQuery groupByTime() Group by the time column
 * @method     ChildProjectNotificationQuery groupByUserId() Group by the user_id column
 * @method     ChildProjectNotificationQuery groupByMessageId() Group by the message_id column
 * @method     ChildProjectNotificationQuery groupByOpenedAt() Group by the opened_at column
 * @method     ChildProjectNotificationQuery groupByAnswredAt() Group by the answred_at column
 * @method     ChildProjectNotificationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProjectNotificationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProjectNotificationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectNotificationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectNotificationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectNotificationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectNotificationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectNotificationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectNotificationQuery leftJoinProjectMessages($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectMessages relation
 * @method     ChildProjectNotificationQuery rightJoinProjectMessages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectMessages relation
 * @method     ChildProjectNotificationQuery innerJoinProjectMessages($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectMessages relation
 *
 * @method     ChildProjectNotificationQuery joinWithProjectMessages($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectMessages relation
 *
 * @method     ChildProjectNotificationQuery leftJoinWithProjectMessages() Adds a LEFT JOIN clause and with to the query using the ProjectMessages relation
 * @method     ChildProjectNotificationQuery rightJoinWithProjectMessages() Adds a RIGHT JOIN clause and with to the query using the ProjectMessages relation
 * @method     ChildProjectNotificationQuery innerJoinWithProjectMessages() Adds a INNER JOIN clause and with to the query using the ProjectMessages relation
 *
 * @method     ChildProjectNotificationQuery leftJoinProjectStudy($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectStudy relation
 * @method     ChildProjectNotificationQuery rightJoinProjectStudy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectStudy relation
 * @method     ChildProjectNotificationQuery innerJoinProjectStudy($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectStudy relation
 *
 * @method     ChildProjectNotificationQuery joinWithProjectStudy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectStudy relation
 *
 * @method     ChildProjectNotificationQuery leftJoinWithProjectStudy() Adds a LEFT JOIN clause and with to the query using the ProjectStudy relation
 * @method     ChildProjectNotificationQuery rightJoinWithProjectStudy() Adds a RIGHT JOIN clause and with to the query using the ProjectStudy relation
 * @method     ChildProjectNotificationQuery innerJoinWithProjectStudy() Adds a INNER JOIN clause and with to the query using the ProjectStudy relation
 *
 * @method     ChildProjectNotificationQuery leftJoinProjectUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectUser relation
 * @method     ChildProjectNotificationQuery rightJoinProjectUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectUser relation
 * @method     ChildProjectNotificationQuery innerJoinProjectUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectUser relation
 *
 * @method     ChildProjectNotificationQuery joinWithProjectUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectUser relation
 *
 * @method     ChildProjectNotificationQuery leftJoinWithProjectUser() Adds a LEFT JOIN clause and with to the query using the ProjectUser relation
 * @method     ChildProjectNotificationQuery rightJoinWithProjectUser() Adds a RIGHT JOIN clause and with to the query using the ProjectUser relation
 * @method     ChildProjectNotificationQuery innerJoinWithProjectUser() Adds a INNER JOIN clause and with to the query using the ProjectUser relation
 *
 * @method     \ProjectMessagesQuery|\ProjectStudyQuery|\ProjectUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProjectNotification findOne(ConnectionInterface $con = null) Return the first ChildProjectNotification matching the query
 * @method     ChildProjectNotification findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProjectNotification matching the query, or a new ChildProjectNotification object populated from the query conditions when no match is found
 *
 * @method     ChildProjectNotification findOneById(int $id) Return the first ChildProjectNotification filtered by the id column
 * @method     ChildProjectNotification findOneByStudyId(int $study_id) Return the first ChildProjectNotification filtered by the study_id column
 * @method     ChildProjectNotification findOneByResponseText(string $response_text) Return the first ChildProjectNotification filtered by the response_text column
 * @method     ChildProjectNotification findOneByTime(string $time) Return the first ChildProjectNotification filtered by the time column
 * @method     ChildProjectNotification findOneByUserId(int $user_id) Return the first ChildProjectNotification filtered by the user_id column
 * @method     ChildProjectNotification findOneByMessageId(int $message_id) Return the first ChildProjectNotification filtered by the message_id column
 * @method     ChildProjectNotification findOneByOpenedAt(string $opened_at) Return the first ChildProjectNotification filtered by the opened_at column
 * @method     ChildProjectNotification findOneByAnswredAt(string $answred_at) Return the first ChildProjectNotification filtered by the answred_at column
 * @method     ChildProjectNotification findOneByCreatedAt(string $created_at) Return the first ChildProjectNotification filtered by the created_at column
 * @method     ChildProjectNotification findOneByUpdatedAt(string $updated_at) Return the first ChildProjectNotification filtered by the updated_at column *

 * @method     ChildProjectNotification requirePk($key, ConnectionInterface $con = null) Return the ChildProjectNotification by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOne(ConnectionInterface $con = null) Return the first ChildProjectNotification matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectNotification requireOneById(int $id) Return the first ChildProjectNotification filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByStudyId(int $study_id) Return the first ChildProjectNotification filtered by the study_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByResponseText(string $response_text) Return the first ChildProjectNotification filtered by the response_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByTime(string $time) Return the first ChildProjectNotification filtered by the time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByUserId(int $user_id) Return the first ChildProjectNotification filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByMessageId(int $message_id) Return the first ChildProjectNotification filtered by the message_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByOpenedAt(string $opened_at) Return the first ChildProjectNotification filtered by the opened_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByAnswredAt(string $answred_at) Return the first ChildProjectNotification filtered by the answred_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByCreatedAt(string $created_at) Return the first ChildProjectNotification filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectNotification requireOneByUpdatedAt(string $updated_at) Return the first ChildProjectNotification filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectNotification[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProjectNotification objects based on current ModelCriteria
 * @method     ChildProjectNotification[]|ObjectCollection findById(int $id) Return ChildProjectNotification objects filtered by the id column
 * @method     ChildProjectNotification[]|ObjectCollection findByStudyId(int $study_id) Return ChildProjectNotification objects filtered by the study_id column
 * @method     ChildProjectNotification[]|ObjectCollection findByResponseText(string $response_text) Return ChildProjectNotification objects filtered by the response_text column
 * @method     ChildProjectNotification[]|ObjectCollection findByTime(string $time) Return ChildProjectNotification objects filtered by the time column
 * @method     ChildProjectNotification[]|ObjectCollection findByUserId(int $user_id) Return ChildProjectNotification objects filtered by the user_id column
 * @method     ChildProjectNotification[]|ObjectCollection findByMessageId(int $message_id) Return ChildProjectNotification objects filtered by the message_id column
 * @method     ChildProjectNotification[]|ObjectCollection findByOpenedAt(string $opened_at) Return ChildProjectNotification objects filtered by the opened_at column
 * @method     ChildProjectNotification[]|ObjectCollection findByAnswredAt(string $answred_at) Return ChildProjectNotification objects filtered by the answred_at column
 * @method     ChildProjectNotification[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProjectNotification objects filtered by the created_at column
 * @method     ChildProjectNotification[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProjectNotification objects filtered by the updated_at column
 * @method     ChildProjectNotification[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProjectNotificationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProjectNotificationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProjectNotification', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectNotificationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectNotificationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProjectNotificationQuery) {
            return $criteria;
        }
        $query = new ChildProjectNotificationQuery();
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
     * @return ChildProjectNotification|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectNotificationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectNotificationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProjectNotification A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, study_id, response_text, time, user_id, message_id, opened_at, answred_at, created_at, updated_at FROM project_notification WHERE id = :p0';
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
            /** @var ChildProjectNotification $obj */
            $obj = new ChildProjectNotification();
            $obj->hydrate($row);
            ProjectNotificationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProjectNotification|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the study_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStudyId(1234); // WHERE study_id = 1234
     * $query->filterByStudyId(array(12, 34)); // WHERE study_id IN (12, 34)
     * $query->filterByStudyId(array('min' => 12)); // WHERE study_id > 12
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
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByStudyId($studyId = null, $comparison = null)
    {
        if (is_array($studyId)) {
            $useMinMax = false;
            if (isset($studyId['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_STUDY_ID, $studyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($studyId['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_STUDY_ID, $studyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_STUDY_ID, $studyId, $comparison);
    }

    /**
     * Filter the query on the response_text column
     *
     * Example usage:
     * <code>
     * $query->filterByResponseText('fooValue');   // WHERE response_text = 'fooValue'
     * $query->filterByResponseText('%fooValue%', Criteria::LIKE); // WHERE response_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $responseText The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByResponseText($responseText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($responseText)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_RESPONSE_TEXT, $responseText, $comparison);
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
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_TIME, $time, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByProjectUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the message_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageId(1234); // WHERE message_id = 1234
     * $query->filterByMessageId(array(12, 34)); // WHERE message_id IN (12, 34)
     * $query->filterByMessageId(array('min' => 12)); // WHERE message_id > 12
     * </code>
     *
     * @see       filterByProjectMessages()
     *
     * @param     mixed $messageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByMessageId($messageId = null, $comparison = null)
    {
        if (is_array($messageId)) {
            $useMinMax = false;
            if (isset($messageId['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_MESSAGE_ID, $messageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageId['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_MESSAGE_ID, $messageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_MESSAGE_ID, $messageId, $comparison);
    }

    /**
     * Filter the query on the opened_at column
     *
     * Example usage:
     * <code>
     * $query->filterByOpenedAt('2011-03-14'); // WHERE opened_at = '2011-03-14'
     * $query->filterByOpenedAt('now'); // WHERE opened_at = '2011-03-14'
     * $query->filterByOpenedAt(array('max' => 'yesterday')); // WHERE opened_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $openedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByOpenedAt($openedAt = null, $comparison = null)
    {
        if (is_array($openedAt)) {
            $useMinMax = false;
            if (isset($openedAt['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_OPENED_AT, $openedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($openedAt['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_OPENED_AT, $openedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_OPENED_AT, $openedAt, $comparison);
    }

    /**
     * Filter the query on the answred_at column
     *
     * Example usage:
     * <code>
     * $query->filterByAnswredAt('2011-03-14'); // WHERE answred_at = '2011-03-14'
     * $query->filterByAnswredAt('now'); // WHERE answred_at = '2011-03-14'
     * $query->filterByAnswredAt(array('max' => 'yesterday')); // WHERE answred_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $answredAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByAnswredAt($answredAt = null, $comparison = null)
    {
        if (is_array($answredAt)) {
            $useMinMax = false;
            if (isset($answredAt['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_ANSWRED_AT, $answredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($answredAt['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_ANSWRED_AT, $answredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_ANSWRED_AT, $answredAt, $comparison);
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
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProjectNotificationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectNotificationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProjectMessages object
     *
     * @param \ProjectMessages|ObjectCollection $projectMessages The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByProjectMessages($projectMessages, $comparison = null)
    {
        if ($projectMessages instanceof \ProjectMessages) {
            return $this
                ->addUsingAlias(ProjectNotificationTableMap::COL_MESSAGE_ID, $projectMessages->getId(), $comparison);
        } elseif ($projectMessages instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectNotificationTableMap::COL_MESSAGE_ID, $projectMessages->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProjectMessages() only accepts arguments of type \ProjectMessages or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectMessages relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function joinProjectMessages($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectMessages');

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
            $this->addJoinObject($join, 'ProjectMessages');
        }

        return $this;
    }

    /**
     * Use the ProjectMessages relation ProjectMessages object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProjectMessagesQuery A secondary query class using the current class as primary query
     */
    public function useProjectMessagesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectMessages($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectMessages', '\ProjectMessagesQuery');
    }

    /**
     * Filter the query by a related \ProjectStudy object
     *
     * @param \ProjectStudy|ObjectCollection $projectStudy The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByProjectStudy($projectStudy, $comparison = null)
    {
        if ($projectStudy instanceof \ProjectStudy) {
            return $this
                ->addUsingAlias(ProjectNotificationTableMap::COL_STUDY_ID, $projectStudy->getId(), $comparison);
        } elseif ($projectStudy instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectNotificationTableMap::COL_STUDY_ID, $projectStudy->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function joinProjectStudy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useProjectStudyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectStudy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectStudy', '\ProjectStudyQuery');
    }

    /**
     * Filter the query by a related \ProjectUser object
     *
     * @param \ProjectUser|ObjectCollection $projectUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function filterByProjectUser($projectUser, $comparison = null)
    {
        if ($projectUser instanceof \ProjectUser) {
            return $this
                ->addUsingAlias(ProjectNotificationTableMap::COL_USER_ID, $projectUser->getId(), $comparison);
        } elseif ($projectUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectNotificationTableMap::COL_USER_ID, $projectUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProjectUser() only accepts arguments of type \ProjectUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function joinProjectUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectUser');

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
            $this->addJoinObject($join, 'ProjectUser');
        }

        return $this;
    }

    /**
     * Use the ProjectUser relation ProjectUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProjectUserQuery A secondary query class using the current class as primary query
     */
    public function useProjectUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectUser', '\ProjectUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProjectNotification $projectNotification Object to remove from the list of results
     *
     * @return $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function prune($projectNotification = null)
    {
        if ($projectNotification) {
            $this->addUsingAlias(ProjectNotificationTableMap::COL_ID, $projectNotification->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project_notification table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectNotificationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectNotificationTableMap::clearInstancePool();
            ProjectNotificationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectNotificationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectNotificationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectNotificationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectNotificationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectNotificationTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectNotificationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectNotificationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectNotificationTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectNotificationTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildProjectNotificationQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectNotificationTableMap::COL_CREATED_AT);
    }

} // ProjectNotificationQuery
