<?php

namespace Base;

use \ProjectUser as ChildProjectUser;
use \ProjectUserQuery as ChildProjectUserQuery;
use \Exception;
use \PDO;
use Map\ProjectUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'project_user' table.
 *
 *
 *
 * @method     ChildProjectUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProjectUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildProjectUserQuery orderByHash($order = Criteria::ASC) Order by the hash column
 * @method     ChildProjectUserQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method     ChildProjectUserQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method     ChildProjectUserQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildProjectUserQuery orderByRole($order = Criteria::ASC) Order by the role column
 * @method     ChildProjectUserQuery orderBySubscribed($order = Criteria::ASC) Order by the Subscribed column
 * @method     ChildProjectUserQuery orderByStudyId($order = Criteria::ASC) Order by the study_id column
 * @method     ChildProjectUserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProjectUserQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProjectUserQuery groupById() Group by the id column
 * @method     ChildProjectUserQuery groupByEmail() Group by the email column
 * @method     ChildProjectUserQuery groupByHash() Group by the hash column
 * @method     ChildProjectUserQuery groupByFname() Group by the fname column
 * @method     ChildProjectUserQuery groupByLname() Group by the lname column
 * @method     ChildProjectUserQuery groupByGender() Group by the gender column
 * @method     ChildProjectUserQuery groupByRole() Group by the role column
 * @method     ChildProjectUserQuery groupBySubscribed() Group by the Subscribed column
 * @method     ChildProjectUserQuery groupByStudyId() Group by the study_id column
 * @method     ChildProjectUserQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProjectUserQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProjectUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectUserQuery leftJoinProjectStudy($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectStudy relation
 * @method     ChildProjectUserQuery rightJoinProjectStudy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectStudy relation
 * @method     ChildProjectUserQuery innerJoinProjectStudy($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectStudy relation
 *
 * @method     ChildProjectUserQuery joinWithProjectStudy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectStudy relation
 *
 * @method     ChildProjectUserQuery leftJoinWithProjectStudy() Adds a LEFT JOIN clause and with to the query using the ProjectStudy relation
 * @method     ChildProjectUserQuery rightJoinWithProjectStudy() Adds a RIGHT JOIN clause and with to the query using the ProjectStudy relation
 * @method     ChildProjectUserQuery innerJoinWithProjectStudy() Adds a INNER JOIN clause and with to the query using the ProjectStudy relation
 *
 * @method     ChildProjectUserQuery leftJoinProjectDeviceToken($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectDeviceToken relation
 * @method     ChildProjectUserQuery rightJoinProjectDeviceToken($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectDeviceToken relation
 * @method     ChildProjectUserQuery innerJoinProjectDeviceToken($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectDeviceToken relation
 *
 * @method     ChildProjectUserQuery joinWithProjectDeviceToken($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectDeviceToken relation
 *
 * @method     ChildProjectUserQuery leftJoinWithProjectDeviceToken() Adds a LEFT JOIN clause and with to the query using the ProjectDeviceToken relation
 * @method     ChildProjectUserQuery rightJoinWithProjectDeviceToken() Adds a RIGHT JOIN clause and with to the query using the ProjectDeviceToken relation
 * @method     ChildProjectUserQuery innerJoinWithProjectDeviceToken() Adds a INNER JOIN clause and with to the query using the ProjectDeviceToken relation
 *
 * @method     ChildProjectUserQuery leftJoinProjectNotification($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectNotification relation
 * @method     ChildProjectUserQuery rightJoinProjectNotification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectNotification relation
 * @method     ChildProjectUserQuery innerJoinProjectNotification($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectNotification relation
 *
 * @method     ChildProjectUserQuery joinWithProjectNotification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectNotification relation
 *
 * @method     ChildProjectUserQuery leftJoinWithProjectNotification() Adds a LEFT JOIN clause and with to the query using the ProjectNotification relation
 * @method     ChildProjectUserQuery rightJoinWithProjectNotification() Adds a RIGHT JOIN clause and with to the query using the ProjectNotification relation
 * @method     ChildProjectUserQuery innerJoinWithProjectNotification() Adds a INNER JOIN clause and with to the query using the ProjectNotification relation
 *
 * @method     \ProjectStudyQuery|\ProjectDeviceTokenQuery|\ProjectNotificationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProjectUser findOne(ConnectionInterface $con = null) Return the first ChildProjectUser matching the query
 * @method     ChildProjectUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProjectUser matching the query, or a new ChildProjectUser object populated from the query conditions when no match is found
 *
 * @method     ChildProjectUser findOneById(int $id) Return the first ChildProjectUser filtered by the id column
 * @method     ChildProjectUser findOneByEmail(string $email) Return the first ChildProjectUser filtered by the email column
 * @method     ChildProjectUser findOneByHash(string $hash) Return the first ChildProjectUser filtered by the hash column
 * @method     ChildProjectUser findOneByFname(string $fname) Return the first ChildProjectUser filtered by the fname column
 * @method     ChildProjectUser findOneByLname(string $lname) Return the first ChildProjectUser filtered by the lname column
 * @method     ChildProjectUser findOneByGender(string $gender) Return the first ChildProjectUser filtered by the gender column
 * @method     ChildProjectUser findOneByRole(string $role) Return the first ChildProjectUser filtered by the role column
 * @method     ChildProjectUser findOneBySubscribed(string $Subscribed) Return the first ChildProjectUser filtered by the Subscribed column
 * @method     ChildProjectUser findOneByStudyId(int $study_id) Return the first ChildProjectUser filtered by the study_id column
 * @method     ChildProjectUser findOneByCreatedAt(string $created_at) Return the first ChildProjectUser filtered by the created_at column
 * @method     ChildProjectUser findOneByUpdatedAt(string $updated_at) Return the first ChildProjectUser filtered by the updated_at column *

 * @method     ChildProjectUser requirePk($key, ConnectionInterface $con = null) Return the ChildProjectUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOne(ConnectionInterface $con = null) Return the first ChildProjectUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectUser requireOneById(int $id) Return the first ChildProjectUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByEmail(string $email) Return the first ChildProjectUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByHash(string $hash) Return the first ChildProjectUser filtered by the hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByFname(string $fname) Return the first ChildProjectUser filtered by the fname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByLname(string $lname) Return the first ChildProjectUser filtered by the lname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByGender(string $gender) Return the first ChildProjectUser filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByRole(string $role) Return the first ChildProjectUser filtered by the role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneBySubscribed(string $Subscribed) Return the first ChildProjectUser filtered by the Subscribed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByStudyId(int $study_id) Return the first ChildProjectUser filtered by the study_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByCreatedAt(string $created_at) Return the first ChildProjectUser filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectUser requireOneByUpdatedAt(string $updated_at) Return the first ChildProjectUser filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProjectUser objects based on current ModelCriteria
 * @method     ChildProjectUser[]|ObjectCollection findById(int $id) Return ChildProjectUser objects filtered by the id column
 * @method     ChildProjectUser[]|ObjectCollection findByEmail(string $email) Return ChildProjectUser objects filtered by the email column
 * @method     ChildProjectUser[]|ObjectCollection findByHash(string $hash) Return ChildProjectUser objects filtered by the hash column
 * @method     ChildProjectUser[]|ObjectCollection findByFname(string $fname) Return ChildProjectUser objects filtered by the fname column
 * @method     ChildProjectUser[]|ObjectCollection findByLname(string $lname) Return ChildProjectUser objects filtered by the lname column
 * @method     ChildProjectUser[]|ObjectCollection findByGender(string $gender) Return ChildProjectUser objects filtered by the gender column
 * @method     ChildProjectUser[]|ObjectCollection findByRole(string $role) Return ChildProjectUser objects filtered by the role column
 * @method     ChildProjectUser[]|ObjectCollection findBySubscribed(string $Subscribed) Return ChildProjectUser objects filtered by the Subscribed column
 * @method     ChildProjectUser[]|ObjectCollection findByStudyId(int $study_id) Return ChildProjectUser objects filtered by the study_id column
 * @method     ChildProjectUser[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProjectUser objects filtered by the created_at column
 * @method     ChildProjectUser[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProjectUser objects filtered by the updated_at column
 * @method     ChildProjectUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProjectUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProjectUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProjectUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProjectUserQuery) {
            return $criteria;
        }
        $query = new ChildProjectUserQuery();
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
     * @return ChildProjectUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProjectUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, email, hash, fname, lname, gender, role, Subscribed, study_id, created_at, updated_at FROM project_user WHERE id = :p0';
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
            /** @var ChildProjectUser $obj */
            $obj = new ChildProjectUser();
            $obj->hydrate($row);
            ProjectUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProjectUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectUserTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectUserTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the hash column
     *
     * Example usage:
     * <code>
     * $query->filterByHash('fooValue');   // WHERE hash = 'fooValue'
     * $query->filterByHash('%fooValue%', Criteria::LIKE); // WHERE hash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hash The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByHash($hash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hash)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_HASH, $hash, $comparison);
    }

    /**
     * Filter the query on the fname column
     *
     * Example usage:
     * <code>
     * $query->filterByFname('fooValue');   // WHERE fname = 'fooValue'
     * $query->filterByFname('%fooValue%', Criteria::LIKE); // WHERE fname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByFname($fname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_FNAME, $fname, $comparison);
    }

    /**
     * Filter the query on the lname column
     *
     * Example usage:
     * <code>
     * $query->filterByLname('fooValue');   // WHERE lname = 'fooValue'
     * $query->filterByLname('%fooValue%', Criteria::LIKE); // WHERE lname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByLname($lname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_LNAME, $lname, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%', Criteria::LIKE); // WHERE role LIKE '%fooValue%'
     * </code>
     *
     * @param     string $role The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByRole($role = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_ROLE, $role, $comparison);
    }

    /**
     * Filter the query on the Subscribed column
     *
     * Example usage:
     * <code>
     * $query->filterBySubscribed('fooValue');   // WHERE Subscribed = 'fooValue'
     * $query->filterBySubscribed('%fooValue%', Criteria::LIKE); // WHERE Subscribed LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subscribed The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterBySubscribed($subscribed = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subscribed)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_SUBSCRIBED, $subscribed, $comparison);
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
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByStudyId($studyId = null, $comparison = null)
    {
        if (is_array($studyId)) {
            $useMinMax = false;
            if (isset($studyId['min'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_STUDY_ID, $studyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($studyId['max'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_STUDY_ID, $studyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_STUDY_ID, $studyId, $comparison);
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
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProjectUserTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectUserTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProjectStudy object
     *
     * @param \ProjectStudy|ObjectCollection $projectStudy The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByProjectStudy($projectStudy, $comparison = null)
    {
        if ($projectStudy instanceof \ProjectStudy) {
            return $this
                ->addUsingAlias(ProjectUserTableMap::COL_STUDY_ID, $projectStudy->getId(), $comparison);
        } elseif ($projectStudy instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectUserTableMap::COL_STUDY_ID, $projectStudy->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
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
     * Filter the query by a related \ProjectDeviceToken object
     *
     * @param \ProjectDeviceToken|ObjectCollection $projectDeviceToken the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByProjectDeviceToken($projectDeviceToken, $comparison = null)
    {
        if ($projectDeviceToken instanceof \ProjectDeviceToken) {
            return $this
                ->addUsingAlias(ProjectUserTableMap::COL_ID, $projectDeviceToken->getUserId(), $comparison);
        } elseif ($projectDeviceToken instanceof ObjectCollection) {
            return $this
                ->useProjectDeviceTokenQuery()
                ->filterByPrimaryKeys($projectDeviceToken->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProjectDeviceToken() only accepts arguments of type \ProjectDeviceToken or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectDeviceToken relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function joinProjectDeviceToken($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectDeviceToken');

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
            $this->addJoinObject($join, 'ProjectDeviceToken');
        }

        return $this;
    }

    /**
     * Use the ProjectDeviceToken relation ProjectDeviceToken object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProjectDeviceTokenQuery A secondary query class using the current class as primary query
     */
    public function useProjectDeviceTokenQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectDeviceToken($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectDeviceToken', '\ProjectDeviceTokenQuery');
    }

    /**
     * Filter the query by a related \ProjectNotification object
     *
     * @param \ProjectNotification|ObjectCollection $projectNotification the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProjectUserQuery The current query, for fluid interface
     */
    public function filterByProjectNotification($projectNotification, $comparison = null)
    {
        if ($projectNotification instanceof \ProjectNotification) {
            return $this
                ->addUsingAlias(ProjectUserTableMap::COL_ID, $projectNotification->getUserId(), $comparison);
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
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
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
     * @param   ChildProjectUser $projectUser Object to remove from the list of results
     *
     * @return $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function prune($projectUser = null)
    {
        if ($projectUser) {
            $this->addUsingAlias(ProjectUserTableMap::COL_ID, $projectUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectUserTableMap::clearInstancePool();
            ProjectUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectUserTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectUserTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectUserTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectUserTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectUserTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildProjectUserQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectUserTableMap::COL_CREATED_AT);
    }

} // ProjectUserQuery
