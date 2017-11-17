<?php

namespace Base;

use \Questions as ChildQuestions;
use \QuestionsQuery as ChildQuestionsQuery;
use \Exception;
use \PDO;
use Map\QuestionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Questions' table.
 *
 *
 *
 * @method     ChildQuestionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildQuestionsQuery orderByText($order = Criteria::ASC) Order by the Text column
 * @method     ChildQuestionsQuery orderByChoises($order = Criteria::ASC) Order by the Choises column
 * @method     ChildQuestionsQuery orderByType($order = Criteria::ASC) Order by the Type column
 * @method     ChildQuestionsQuery orderByTime($order = Criteria::ASC) Order by the Time column
 * @method     ChildQuestionsQuery orderByStudyId($order = Criteria::ASC) Order by the Study_Id column
 * @method     ChildQuestionsQuery orderByUserId($order = Criteria::ASC) Order by the User_id column
 * @method     ChildQuestionsQuery orderByLastsent($order = Criteria::ASC) Order by the LastSent column
 *
 * @method     ChildQuestionsQuery groupById() Group by the id column
 * @method     ChildQuestionsQuery groupByText() Group by the Text column
 * @method     ChildQuestionsQuery groupByChoises() Group by the Choises column
 * @method     ChildQuestionsQuery groupByType() Group by the Type column
 * @method     ChildQuestionsQuery groupByTime() Group by the Time column
 * @method     ChildQuestionsQuery groupByStudyId() Group by the Study_Id column
 * @method     ChildQuestionsQuery groupByUserId() Group by the User_id column
 * @method     ChildQuestionsQuery groupByLastsent() Group by the LastSent column
 *
 * @method     ChildQuestionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildQuestionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildQuestionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildQuestionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildQuestionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildQuestionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildQuestionsQuery leftJoinStudy($relationAlias = null) Adds a LEFT JOIN clause to the query using the Study relation
 * @method     ChildQuestionsQuery rightJoinStudy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Study relation
 * @method     ChildQuestionsQuery innerJoinStudy($relationAlias = null) Adds a INNER JOIN clause to the query using the Study relation
 *
 * @method     ChildQuestionsQuery joinWithStudy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Study relation
 *
 * @method     ChildQuestionsQuery leftJoinWithStudy() Adds a LEFT JOIN clause and with to the query using the Study relation
 * @method     ChildQuestionsQuery rightJoinWithStudy() Adds a RIGHT JOIN clause and with to the query using the Study relation
 * @method     ChildQuestionsQuery innerJoinWithStudy() Adds a INNER JOIN clause and with to the query using the Study relation
 *
 * @method     ChildQuestionsQuery leftJoinNewuser($relationAlias = null) Adds a LEFT JOIN clause to the query using the Newuser relation
 * @method     ChildQuestionsQuery rightJoinNewuser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Newuser relation
 * @method     ChildQuestionsQuery innerJoinNewuser($relationAlias = null) Adds a INNER JOIN clause to the query using the Newuser relation
 *
 * @method     ChildQuestionsQuery joinWithNewuser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Newuser relation
 *
 * @method     ChildQuestionsQuery leftJoinWithNewuser() Adds a LEFT JOIN clause and with to the query using the Newuser relation
 * @method     ChildQuestionsQuery rightJoinWithNewuser() Adds a RIGHT JOIN clause and with to the query using the Newuser relation
 * @method     ChildQuestionsQuery innerJoinWithNewuser() Adds a INNER JOIN clause and with to the query using the Newuser relation
 *
 * @method     ChildQuestionsQuery leftJoinStudyresponse($relationAlias = null) Adds a LEFT JOIN clause to the query using the Studyresponse relation
 * @method     ChildQuestionsQuery rightJoinStudyresponse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Studyresponse relation
 * @method     ChildQuestionsQuery innerJoinStudyresponse($relationAlias = null) Adds a INNER JOIN clause to the query using the Studyresponse relation
 *
 * @method     ChildQuestionsQuery joinWithStudyresponse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Studyresponse relation
 *
 * @method     ChildQuestionsQuery leftJoinWithStudyresponse() Adds a LEFT JOIN clause and with to the query using the Studyresponse relation
 * @method     ChildQuestionsQuery rightJoinWithStudyresponse() Adds a RIGHT JOIN clause and with to the query using the Studyresponse relation
 * @method     ChildQuestionsQuery innerJoinWithStudyresponse() Adds a INNER JOIN clause and with to the query using the Studyresponse relation
 *
 * @method     \StudyQuery|\NewuserQuery|\StudyresponseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildQuestions findOne(ConnectionInterface $con = null) Return the first ChildQuestions matching the query
 * @method     ChildQuestions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildQuestions matching the query, or a new ChildQuestions object populated from the query conditions when no match is found
 *
 * @method     ChildQuestions findOneById(int $id) Return the first ChildQuestions filtered by the id column
 * @method     ChildQuestions findOneByText(string $Text) Return the first ChildQuestions filtered by the Text column
 * @method     ChildQuestions findOneByChoises(string $Choises) Return the first ChildQuestions filtered by the Choises column
 * @method     ChildQuestions findOneByType(string $Type) Return the first ChildQuestions filtered by the Type column
 * @method     ChildQuestions findOneByTime(string $Time) Return the first ChildQuestions filtered by the Time column
 * @method     ChildQuestions findOneByStudyId(int $Study_Id) Return the first ChildQuestions filtered by the Study_Id column
 * @method     ChildQuestions findOneByUserId(int $User_id) Return the first ChildQuestions filtered by the User_id column
 * @method     ChildQuestions findOneByLastsent(string $LastSent) Return the first ChildQuestions filtered by the LastSent column *

 * @method     ChildQuestions requirePk($key, ConnectionInterface $con = null) Return the ChildQuestions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOne(ConnectionInterface $con = null) Return the first ChildQuestions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuestions requireOneById(int $id) Return the first ChildQuestions filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOneByText(string $Text) Return the first ChildQuestions filtered by the Text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOneByChoises(string $Choises) Return the first ChildQuestions filtered by the Choises column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOneByType(string $Type) Return the first ChildQuestions filtered by the Type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOneByTime(string $Time) Return the first ChildQuestions filtered by the Time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOneByStudyId(int $Study_Id) Return the first ChildQuestions filtered by the Study_Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOneByUserId(int $User_id) Return the first ChildQuestions filtered by the User_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestions requireOneByLastsent(string $LastSent) Return the first ChildQuestions filtered by the LastSent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuestions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildQuestions objects based on current ModelCriteria
 * @method     ChildQuestions[]|ObjectCollection findById(int $id) Return ChildQuestions objects filtered by the id column
 * @method     ChildQuestions[]|ObjectCollection findByText(string $Text) Return ChildQuestions objects filtered by the Text column
 * @method     ChildQuestions[]|ObjectCollection findByChoises(string $Choises) Return ChildQuestions objects filtered by the Choises column
 * @method     ChildQuestions[]|ObjectCollection findByType(string $Type) Return ChildQuestions objects filtered by the Type column
 * @method     ChildQuestions[]|ObjectCollection findByTime(string $Time) Return ChildQuestions objects filtered by the Time column
 * @method     ChildQuestions[]|ObjectCollection findByStudyId(int $Study_Id) Return ChildQuestions objects filtered by the Study_Id column
 * @method     ChildQuestions[]|ObjectCollection findByUserId(int $User_id) Return ChildQuestions objects filtered by the User_id column
 * @method     ChildQuestions[]|ObjectCollection findByLastsent(string $LastSent) Return ChildQuestions objects filtered by the LastSent column
 * @method     ChildQuestions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class QuestionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\QuestionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Questions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildQuestionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildQuestionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildQuestionsQuery) {
            return $criteria;
        }
        $query = new ChildQuestionsQuery();
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
     * @return ChildQuestions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(QuestionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = QuestionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildQuestions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, Text, Choises, Type, Time, Study_Id, User_id, LastSent FROM Questions WHERE id = :p0';
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
            /** @var ChildQuestions $obj */
            $obj = new ChildQuestions();
            $obj->hydrate($row);
            QuestionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildQuestions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QuestionsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QuestionsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the Text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE Text = 'fooValue'
     * $query->filterByText('%fooValue%', Criteria::LIKE); // WHERE Text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the Choises column
     *
     * Example usage:
     * <code>
     * $query->filterByChoises('fooValue');   // WHERE Choises = 'fooValue'
     * $query->filterByChoises('%fooValue%', Criteria::LIKE); // WHERE Choises LIKE '%fooValue%'
     * </code>
     *
     * @param     string $choises The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByChoises($choises = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($choises)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_CHOISES, $choises, $comparison);
    }

    /**
     * Filter the query on the Type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE Type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE Type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_TYPE, $type, $comparison);
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
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($time)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_TIME, $time, $comparison);
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
     * @see       filterByStudy()
     *
     * @param     mixed $studyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByStudyId($studyId = null, $comparison = null)
    {
        if (is_array($studyId)) {
            $useMinMax = false;
            if (isset($studyId['min'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_STUDY_ID, $studyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($studyId['max'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_STUDY_ID, $studyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_STUDY_ID, $studyId, $comparison);
    }

    /**
     * Filter the query on the User_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE User_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE User_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE User_id > 12
     * </code>
     *
     * @see       filterByNewuser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByLastsent($lastsent = null, $comparison = null)
    {
        if (is_array($lastsent)) {
            $useMinMax = false;
            if (isset($lastsent['min'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_LASTSENT, $lastsent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastsent['max'])) {
                $this->addUsingAlias(QuestionsTableMap::COL_LASTSENT, $lastsent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionsTableMap::COL_LASTSENT, $lastsent, $comparison);
    }

    /**
     * Filter the query by a related \Study object
     *
     * @param \Study|ObjectCollection $study The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByStudy($study, $comparison = null)
    {
        if ($study instanceof \Study) {
            return $this
                ->addUsingAlias(QuestionsTableMap::COL_STUDY_ID, $study->getId(), $comparison);
        } elseif ($study instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuestionsTableMap::COL_STUDY_ID, $study->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStudy() only accepts arguments of type \Study or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Study relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function joinStudy($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Study');

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
            $this->addJoinObject($join, 'Study');
        }

        return $this;
    }

    /**
     * Use the Study relation Study object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StudyQuery A secondary query class using the current class as primary query
     */
    public function useStudyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStudy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Study', '\StudyQuery');
    }

    /**
     * Filter the query by a related \Newuser object
     *
     * @param \Newuser|ObjectCollection $newuser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByNewuser($newuser, $comparison = null)
    {
        if ($newuser instanceof \Newuser) {
            return $this
                ->addUsingAlias(QuestionsTableMap::COL_USER_ID, $newuser->getId(), $comparison);
        } elseif ($newuser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuestionsTableMap::COL_USER_ID, $newuser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNewuser() only accepts arguments of type \Newuser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Newuser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function joinNewuser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Newuser');

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
            $this->addJoinObject($join, 'Newuser');
        }

        return $this;
    }

    /**
     * Use the Newuser relation Newuser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \NewuserQuery A secondary query class using the current class as primary query
     */
    public function useNewuserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNewuser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Newuser', '\NewuserQuery');
    }

    /**
     * Filter the query by a related \Studyresponse object
     *
     * @param \Studyresponse|ObjectCollection $studyresponse the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildQuestionsQuery The current query, for fluid interface
     */
    public function filterByStudyresponse($studyresponse, $comparison = null)
    {
        if ($studyresponse instanceof \Studyresponse) {
            return $this
                ->addUsingAlias(QuestionsTableMap::COL_ID, $studyresponse->getQuestionId(), $comparison);
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
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildQuestions $questions Object to remove from the list of results
     *
     * @return $this|ChildQuestionsQuery The current query, for fluid interface
     */
    public function prune($questions = null)
    {
        if ($questions) {
            $this->addUsingAlias(QuestionsTableMap::COL_ID, $questions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Questions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            QuestionsTableMap::clearInstancePool();
            QuestionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(QuestionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            QuestionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            QuestionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // QuestionsQuery
