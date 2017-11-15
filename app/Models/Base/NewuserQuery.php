<?php

namespace Base;

use \Newuser as ChildNewuser;
use \NewuserQuery as ChildNewuserQuery;
use \Exception;
use \PDO;
use Map\NewuserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'NewUser' table.
 *
 *
 *
 * @method     ChildNewuserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildNewuserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildNewuserQuery orderByHash($order = Criteria::ASC) Order by the hash column
 * @method     ChildNewuserQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method     ChildNewuserQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method     ChildNewuserQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildNewuserQuery orderByRole($order = Criteria::ASC) Order by the role column
 * @method     ChildNewuserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildNewuserQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildNewuserQuery orderBySubscribed($order = Criteria::ASC) Order by the Subscribed column
 *
 * @method     ChildNewuserQuery groupById() Group by the id column
 * @method     ChildNewuserQuery groupByEmail() Group by the email column
 * @method     ChildNewuserQuery groupByHash() Group by the hash column
 * @method     ChildNewuserQuery groupByFname() Group by the fname column
 * @method     ChildNewuserQuery groupByLname() Group by the lname column
 * @method     ChildNewuserQuery groupByGender() Group by the gender column
 * @method     ChildNewuserQuery groupByRole() Group by the role column
 * @method     ChildNewuserQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildNewuserQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildNewuserQuery groupBySubscribed() Group by the Subscribed column
 *
 * @method     ChildNewuserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNewuserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNewuserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNewuserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNewuserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNewuserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNewuserQuery leftJoinPatient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Patient relation
 * @method     ChildNewuserQuery rightJoinPatient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Patient relation
 * @method     ChildNewuserQuery innerJoinPatient($relationAlias = null) Adds a INNER JOIN clause to the query using the Patient relation
 *
 * @method     ChildNewuserQuery joinWithPatient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Patient relation
 *
 * @method     ChildNewuserQuery leftJoinWithPatient() Adds a LEFT JOIN clause and with to the query using the Patient relation
 * @method     ChildNewuserQuery rightJoinWithPatient() Adds a RIGHT JOIN clause and with to the query using the Patient relation
 * @method     ChildNewuserQuery innerJoinWithPatient() Adds a INNER JOIN clause and with to the query using the Patient relation
 *
 * @method     ChildNewuserQuery leftJoinQuestions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Questions relation
 * @method     ChildNewuserQuery rightJoinQuestions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Questions relation
 * @method     ChildNewuserQuery innerJoinQuestions($relationAlias = null) Adds a INNER JOIN clause to the query using the Questions relation
 *
 * @method     ChildNewuserQuery joinWithQuestions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Questions relation
 *
 * @method     ChildNewuserQuery leftJoinWithQuestions() Adds a LEFT JOIN clause and with to the query using the Questions relation
 * @method     ChildNewuserQuery rightJoinWithQuestions() Adds a RIGHT JOIN clause and with to the query using the Questions relation
 * @method     ChildNewuserQuery innerJoinWithQuestions() Adds a INNER JOIN clause and with to the query using the Questions relation
 *
 * @method     ChildNewuserQuery leftJoinStudyresponse($relationAlias = null) Adds a LEFT JOIN clause to the query using the Studyresponse relation
 * @method     ChildNewuserQuery rightJoinStudyresponse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Studyresponse relation
 * @method     ChildNewuserQuery innerJoinStudyresponse($relationAlias = null) Adds a INNER JOIN clause to the query using the Studyresponse relation
 *
 * @method     ChildNewuserQuery joinWithStudyresponse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Studyresponse relation
 *
 * @method     ChildNewuserQuery leftJoinWithStudyresponse() Adds a LEFT JOIN clause and with to the query using the Studyresponse relation
 * @method     ChildNewuserQuery rightJoinWithStudyresponse() Adds a RIGHT JOIN clause and with to the query using the Studyresponse relation
 * @method     ChildNewuserQuery innerJoinWithStudyresponse() Adds a INNER JOIN clause and with to the query using the Studyresponse relation
 *
 * @method     ChildNewuserQuery leftJoinSurveylog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Surveylog relation
 * @method     ChildNewuserQuery rightJoinSurveylog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Surveylog relation
 * @method     ChildNewuserQuery innerJoinSurveylog($relationAlias = null) Adds a INNER JOIN clause to the query using the Surveylog relation
 *
 * @method     ChildNewuserQuery joinWithSurveylog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Surveylog relation
 *
 * @method     ChildNewuserQuery leftJoinWithSurveylog() Adds a LEFT JOIN clause and with to the query using the Surveylog relation
 * @method     ChildNewuserQuery rightJoinWithSurveylog() Adds a RIGHT JOIN clause and with to the query using the Surveylog relation
 * @method     ChildNewuserQuery innerJoinWithSurveylog() Adds a INNER JOIN clause and with to the query using the Surveylog relation
 *
 * @method     \PatientQuery|\QuestionsQuery|\StudyresponseQuery|\SurveylogQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNewuser findOne(ConnectionInterface $con = null) Return the first ChildNewuser matching the query
 * @method     ChildNewuser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNewuser matching the query, or a new ChildNewuser object populated from the query conditions when no match is found
 *
 * @method     ChildNewuser findOneById(int $id) Return the first ChildNewuser filtered by the id column
 * @method     ChildNewuser findOneByEmail(string $email) Return the first ChildNewuser filtered by the email column
 * @method     ChildNewuser findOneByHash(string $hash) Return the first ChildNewuser filtered by the hash column
 * @method     ChildNewuser findOneByFname(string $fname) Return the first ChildNewuser filtered by the fname column
 * @method     ChildNewuser findOneByLname(string $lname) Return the first ChildNewuser filtered by the lname column
 * @method     ChildNewuser findOneByGender(string $gender) Return the first ChildNewuser filtered by the gender column
 * @method     ChildNewuser findOneByRole(string $role) Return the first ChildNewuser filtered by the role column
 * @method     ChildNewuser findOneByCreatedAt(string $created_at) Return the first ChildNewuser filtered by the created_at column
 * @method     ChildNewuser findOneByUpdatedAt(string $updated_at) Return the first ChildNewuser filtered by the updated_at column
 * @method     ChildNewuser findOneBySubscribed(string $Subscribed) Return the first ChildNewuser filtered by the Subscribed column *

 * @method     ChildNewuser requirePk($key, ConnectionInterface $con = null) Return the ChildNewuser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOne(ConnectionInterface $con = null) Return the first ChildNewuser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNewuser requireOneById(int $id) Return the first ChildNewuser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByEmail(string $email) Return the first ChildNewuser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByHash(string $hash) Return the first ChildNewuser filtered by the hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByFname(string $fname) Return the first ChildNewuser filtered by the fname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByLname(string $lname) Return the first ChildNewuser filtered by the lname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByGender(string $gender) Return the first ChildNewuser filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByRole(string $role) Return the first ChildNewuser filtered by the role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByCreatedAt(string $created_at) Return the first ChildNewuser filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneByUpdatedAt(string $updated_at) Return the first ChildNewuser filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNewuser requireOneBySubscribed(string $Subscribed) Return the first ChildNewuser filtered by the Subscribed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNewuser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNewuser objects based on current ModelCriteria
 * @method     ChildNewuser[]|ObjectCollection findById(int $id) Return ChildNewuser objects filtered by the id column
 * @method     ChildNewuser[]|ObjectCollection findByEmail(string $email) Return ChildNewuser objects filtered by the email column
 * @method     ChildNewuser[]|ObjectCollection findByHash(string $hash) Return ChildNewuser objects filtered by the hash column
 * @method     ChildNewuser[]|ObjectCollection findByFname(string $fname) Return ChildNewuser objects filtered by the fname column
 * @method     ChildNewuser[]|ObjectCollection findByLname(string $lname) Return ChildNewuser objects filtered by the lname column
 * @method     ChildNewuser[]|ObjectCollection findByGender(string $gender) Return ChildNewuser objects filtered by the gender column
 * @method     ChildNewuser[]|ObjectCollection findByRole(string $role) Return ChildNewuser objects filtered by the role column
 * @method     ChildNewuser[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildNewuser objects filtered by the created_at column
 * @method     ChildNewuser[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildNewuser objects filtered by the updated_at column
 * @method     ChildNewuser[]|ObjectCollection findBySubscribed(string $Subscribed) Return ChildNewuser objects filtered by the Subscribed column
 * @method     ChildNewuser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NewuserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\NewuserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Newuser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNewuserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNewuserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNewuserQuery) {
            return $criteria;
        }
        $query = new ChildNewuserQuery();
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
     * @return ChildNewuser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NewuserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NewuserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNewuser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, email, hash, fname, lname, gender, role, created_at, updated_at, Subscribed FROM NewUser WHERE id = :p0';
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
            /** @var ChildNewuser $obj */
            $obj = new ChildNewuser();
            $obj->hydrate($row);
            NewuserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNewuser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NewuserTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NewuserTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NewuserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NewuserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the hash column
     *
     * Example usage:
     * <code>
     * $query->filterByHash('fooValue');   // WHERE hash = 'fooValue'
     * $query->filterByHash('%fooValue%'); // WHERE hash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hash The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByHash($hash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hash)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_HASH, $hash, $comparison);
    }

    /**
     * Filter the query on the fname column
     *
     * Example usage:
     * <code>
     * $query->filterByFname('fooValue');   // WHERE fname = 'fooValue'
     * $query->filterByFname('%fooValue%'); // WHERE fname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByFname($fname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_FNAME, $fname, $comparison);
    }

    /**
     * Filter the query on the lname column
     *
     * Example usage:
     * <code>
     * $query->filterByLname('fooValue');   // WHERE lname = 'fooValue'
     * $query->filterByLname('%fooValue%'); // WHERE lname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByLname($lname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_LNAME, $lname, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%'); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%'); // WHERE role LIKE '%fooValue%'
     * </code>
     *
     * @param     string $role The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByRole($role = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_ROLE, $role, $comparison);
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
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(NewuserTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NewuserTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(NewuserTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NewuserTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the Subscribed column
     *
     * Example usage:
     * <code>
     * $query->filterBySubscribed('fooValue');   // WHERE Subscribed = 'fooValue'
     * $query->filterBySubscribed('%fooValue%'); // WHERE Subscribed LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subscribed The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function filterBySubscribed($subscribed = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subscribed)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewuserTableMap::COL_SUBSCRIBED, $subscribed, $comparison);
    }

    /**
     * Filter the query by a related \Patient object
     *
     * @param \Patient|ObjectCollection $patient the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByPatient($patient, $comparison = null)
    {
        if ($patient instanceof \Patient) {
            return $this
                ->addUsingAlias(NewuserTableMap::COL_ID, $patient->getUserId(), $comparison);
        } elseif ($patient instanceof ObjectCollection) {
            return $this
                ->usePatientQuery()
                ->filterByPrimaryKeys($patient->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPatient() only accepts arguments of type \Patient or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Patient relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function joinPatient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Patient');

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
            $this->addJoinObject($join, 'Patient');
        }

        return $this;
    }

    /**
     * Use the Patient relation Patient object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PatientQuery A secondary query class using the current class as primary query
     */
    public function usePatientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPatient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Patient', '\PatientQuery');
    }

    /**
     * Filter the query by a related \Questions object
     *
     * @param \Questions|ObjectCollection $questions the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByQuestions($questions, $comparison = null)
    {
        if ($questions instanceof \Questions) {
            return $this
                ->addUsingAlias(NewuserTableMap::COL_ID, $questions->getUserId(), $comparison);
        } elseif ($questions instanceof ObjectCollection) {
            return $this
                ->useQuestionsQuery()
                ->filterByPrimaryKeys($questions->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByQuestions() only accepts arguments of type \Questions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Questions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function joinQuestions($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Questions');

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
            $this->addJoinObject($join, 'Questions');
        }

        return $this;
    }

    /**
     * Use the Questions relation Questions object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \QuestionsQuery A secondary query class using the current class as primary query
     */
    public function useQuestionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinQuestions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Questions', '\QuestionsQuery');
    }

    /**
     * Filter the query by a related \Studyresponse object
     *
     * @param \Studyresponse|ObjectCollection $studyresponse the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNewuserQuery The current query, for fluid interface
     */
    public function filterByStudyresponse($studyresponse, $comparison = null)
    {
        if ($studyresponse instanceof \Studyresponse) {
            return $this
                ->addUsingAlias(NewuserTableMap::COL_ID, $studyresponse->getUserId(), $comparison);
        } elseif ($studyresponse instanceof ObjectCollection) {
            return $this
                ->useStudyresponseQuery()
                ->filterByPrimaryKeys($studyresponse->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByStudyresponse() only accepts arguments of type \Studyresponse or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Studyresponse relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function joinStudyresponse($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Studyresponse');

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
            $this->addJoinObject($join, 'Studyresponse');
        }

        return $this;
    }

    /**
     * Use the Studyresponse relation Studyresponse object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StudyresponseQuery A secondary query class using the current class as primary query
     */
    public function useStudyresponseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStudyresponse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Studyresponse', '\StudyresponseQuery');
    }

    /**
     * Filter the query by a related \Surveylog object
     *
     * @param \Surveylog|ObjectCollection $surveylog the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNewuserQuery The current query, for fluid interface
     */
    public function filterBySurveylog($surveylog, $comparison = null)
    {
        if ($surveylog instanceof \Surveylog) {
            return $this
                ->addUsingAlias(NewuserTableMap::COL_ID, $surveylog->getPatientId(), $comparison);
        } elseif ($surveylog instanceof ObjectCollection) {
            return $this
                ->useSurveylogQuery()
                ->filterByPrimaryKeys($surveylog->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySurveylog() only accepts arguments of type \Surveylog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Surveylog relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function joinSurveylog($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Surveylog');

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
            $this->addJoinObject($join, 'Surveylog');
        }

        return $this;
    }

    /**
     * Use the Surveylog relation Surveylog object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SurveylogQuery A secondary query class using the current class as primary query
     */
    public function useSurveylogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSurveylog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Surveylog', '\SurveylogQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNewuser $newuser Object to remove from the list of results
     *
     * @return $this|ChildNewuserQuery The current query, for fluid interface
     */
    public function prune($newuser = null)
    {
        if ($newuser) {
            $this->addUsingAlias(NewuserTableMap::COL_ID, $newuser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the NewUser table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NewuserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NewuserTableMap::clearInstancePool();
            NewuserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NewuserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NewuserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NewuserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NewuserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // NewuserQuery
