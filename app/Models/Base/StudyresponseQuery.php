<?php

namespace Base;

use \Studyresponse as ChildStudyresponse;
use \StudyresponseQuery as ChildStudyresponseQuery;
use \Exception;
use \PDO;
use Map\StudyresponseTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'StudyResponse' table.
 *
 *
 *
 * @method     ChildStudyresponseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStudyresponseQuery orderByUserId($order = Criteria::ASC) Order by the User_id column
 * @method     ChildStudyresponseQuery orderByQuestionId($order = Criteria::ASC) Order by the Question_id column
 * @method     ChildStudyresponseQuery orderByResponse($order = Criteria::ASC) Order by the Response column
 * @method     ChildStudyresponseQuery orderByLastsenttime($order = Criteria::ASC) Order by the LastSentTime column
 *
 * @method     ChildStudyresponseQuery groupById() Group by the id column
 * @method     ChildStudyresponseQuery groupByUserId() Group by the User_id column
 * @method     ChildStudyresponseQuery groupByQuestionId() Group by the Question_id column
 * @method     ChildStudyresponseQuery groupByResponse() Group by the Response column
 * @method     ChildStudyresponseQuery groupByLastsenttime() Group by the LastSentTime column
 *
 * @method     ChildStudyresponseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStudyresponseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStudyresponseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStudyresponseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStudyresponseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStudyresponseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStudyresponseQuery leftJoinQuestions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Questions relation
 * @method     ChildStudyresponseQuery rightJoinQuestions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Questions relation
 * @method     ChildStudyresponseQuery innerJoinQuestions($relationAlias = null) Adds a INNER JOIN clause to the query using the Questions relation
 *
 * @method     ChildStudyresponseQuery joinWithQuestions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Questions relation
 *
 * @method     ChildStudyresponseQuery leftJoinWithQuestions() Adds a LEFT JOIN clause and with to the query using the Questions relation
 * @method     ChildStudyresponseQuery rightJoinWithQuestions() Adds a RIGHT JOIN clause and with to the query using the Questions relation
 * @method     ChildStudyresponseQuery innerJoinWithQuestions() Adds a INNER JOIN clause and with to the query using the Questions relation
 *
 * @method     ChildStudyresponseQuery leftJoinNewuser($relationAlias = null) Adds a LEFT JOIN clause to the query using the Newuser relation
 * @method     ChildStudyresponseQuery rightJoinNewuser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Newuser relation
 * @method     ChildStudyresponseQuery innerJoinNewuser($relationAlias = null) Adds a INNER JOIN clause to the query using the Newuser relation
 *
 * @method     ChildStudyresponseQuery joinWithNewuser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Newuser relation
 *
 * @method     ChildStudyresponseQuery leftJoinWithNewuser() Adds a LEFT JOIN clause and with to the query using the Newuser relation
 * @method     ChildStudyresponseQuery rightJoinWithNewuser() Adds a RIGHT JOIN clause and with to the query using the Newuser relation
 * @method     ChildStudyresponseQuery innerJoinWithNewuser() Adds a INNER JOIN clause and with to the query using the Newuser relation
 *
 * @method     \QuestionsQuery|\NewuserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStudyresponse findOne(ConnectionInterface $con = null) Return the first ChildStudyresponse matching the query
 * @method     ChildStudyresponse findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStudyresponse matching the query, or a new ChildStudyresponse object populated from the query conditions when no match is found
 *
 * @method     ChildStudyresponse findOneById(int $id) Return the first ChildStudyresponse filtered by the id column
 * @method     ChildStudyresponse findOneByUserId(int $User_id) Return the first ChildStudyresponse filtered by the User_id column
 * @method     ChildStudyresponse findOneByQuestionId(int $Question_id) Return the first ChildStudyresponse filtered by the Question_id column
 * @method     ChildStudyresponse findOneByResponse(string $Response) Return the first ChildStudyresponse filtered by the Response column
 * @method     ChildStudyresponse findOneByLastsenttime(string $LastSentTime) Return the first ChildStudyresponse filtered by the LastSentTime column *

 * @method     ChildStudyresponse requirePk($key, ConnectionInterface $con = null) Return the ChildStudyresponse by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudyresponse requireOne(ConnectionInterface $con = null) Return the first ChildStudyresponse matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStudyresponse requireOneById(int $id) Return the first ChildStudyresponse filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudyresponse requireOneByUserId(int $User_id) Return the first ChildStudyresponse filtered by the User_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudyresponse requireOneByQuestionId(int $Question_id) Return the first ChildStudyresponse filtered by the Question_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudyresponse requireOneByResponse(string $Response) Return the first ChildStudyresponse filtered by the Response column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudyresponse requireOneByLastsenttime(string $LastSentTime) Return the first ChildStudyresponse filtered by the LastSentTime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStudyresponse[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStudyresponse objects based on current ModelCriteria
 * @method     ChildStudyresponse[]|ObjectCollection findById(int $id) Return ChildStudyresponse objects filtered by the id column
 * @method     ChildStudyresponse[]|ObjectCollection findByUserId(int $User_id) Return ChildStudyresponse objects filtered by the User_id column
 * @method     ChildStudyresponse[]|ObjectCollection findByQuestionId(int $Question_id) Return ChildStudyresponse objects filtered by the Question_id column
 * @method     ChildStudyresponse[]|ObjectCollection findByResponse(string $Response) Return ChildStudyresponse objects filtered by the Response column
 * @method     ChildStudyresponse[]|ObjectCollection findByLastsenttime(string $LastSentTime) Return ChildStudyresponse objects filtered by the LastSentTime column
 * @method     ChildStudyresponse[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StudyresponseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StudyresponseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Studyresponse', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStudyresponseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStudyresponseQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStudyresponseQuery) {
            return $criteria;
        }
        $query = new ChildStudyresponseQuery();
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
     * @return ChildStudyresponse|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StudyresponseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StudyresponseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStudyresponse A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, User_id, Question_id, Response, LastSentTime FROM StudyResponse WHERE id = :p0';
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
            /** @var ChildStudyresponse $obj */
            $obj = new ChildStudyresponse();
            $obj->hydrate($row);
            StudyresponseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStudyresponse|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StudyresponseTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StudyresponseTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudyresponseTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudyresponseTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the Question_id column
     *
     * Example usage:
     * <code>
     * $query->filterByQuestionId(1234); // WHERE Question_id = 1234
     * $query->filterByQuestionId(array(12, 34)); // WHERE Question_id IN (12, 34)
     * $query->filterByQuestionId(array('min' => 12)); // WHERE Question_id > 12
     * </code>
     *
     * @see       filterByQuestions()
     *
     * @param     mixed $questionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByQuestionId($questionId = null, $comparison = null)
    {
        if (is_array($questionId)) {
            $useMinMax = false;
            if (isset($questionId['min'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_QUESTION_ID, $questionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($questionId['max'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_QUESTION_ID, $questionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudyresponseTableMap::COL_QUESTION_ID, $questionId, $comparison);
    }

    /**
     * Filter the query on the Response column
     *
     * Example usage:
     * <code>
     * $query->filterByResponse('fooValue');   // WHERE Response = 'fooValue'
     * $query->filterByResponse('%fooValue%', Criteria::LIKE); // WHERE Response LIKE '%fooValue%'
     * </code>
     *
     * @param     string $response The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByResponse($response = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($response)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudyresponseTableMap::COL_RESPONSE, $response, $comparison);
    }

    /**
     * Filter the query on the LastSentTime column
     *
     * Example usage:
     * <code>
     * $query->filterByLastsenttime('2011-03-14'); // WHERE LastSentTime = '2011-03-14'
     * $query->filterByLastsenttime('now'); // WHERE LastSentTime = '2011-03-14'
     * $query->filterByLastsenttime(array('max' => 'yesterday')); // WHERE LastSentTime > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastsenttime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByLastsenttime($lastsenttime = null, $comparison = null)
    {
        if (is_array($lastsenttime)) {
            $useMinMax = false;
            if (isset($lastsenttime['min'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_LASTSENTTIME, $lastsenttime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastsenttime['max'])) {
                $this->addUsingAlias(StudyresponseTableMap::COL_LASTSENTTIME, $lastsenttime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudyresponseTableMap::COL_LASTSENTTIME, $lastsenttime, $comparison);
    }

    /**
     * Filter the query by a related \Questions object
     *
     * @param \Questions|ObjectCollection $questions The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByQuestions($questions, $comparison = null)
    {
        if ($questions instanceof \Questions) {
            return $this
                ->addUsingAlias(StudyresponseTableMap::COL_QUESTION_ID, $questions->getId(), $comparison);
        } elseif ($questions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StudyresponseTableMap::COL_QUESTION_ID, $questions->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
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
     * Filter the query by a related \Newuser object
     *
     * @param \Newuser|ObjectCollection $newuser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStudyresponseQuery The current query, for fluid interface
     */
    public function filterByNewuser($newuser, $comparison = null)
    {
        if ($newuser instanceof \Newuser) {
            return $this
                ->addUsingAlias(StudyresponseTableMap::COL_USER_ID, $newuser->getId(), $comparison);
        } elseif ($newuser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StudyresponseTableMap::COL_USER_ID, $newuser->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildStudyresponse $studyresponse Object to remove from the list of results
     *
     * @return $this|ChildStudyresponseQuery The current query, for fluid interface
     */
    public function prune($studyresponse = null)
    {
        if ($studyresponse) {
            $this->addUsingAlias(StudyresponseTableMap::COL_ID, $studyresponse->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the StudyResponse table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StudyresponseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StudyresponseTableMap::clearInstancePool();
            StudyresponseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StudyresponseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StudyresponseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StudyresponseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StudyresponseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StudyresponseQuery
