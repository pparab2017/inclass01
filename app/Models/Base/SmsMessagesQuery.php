<?php

namespace Base;

use \SmsMessages as ChildSmsMessages;
use \SmsMessagesQuery as ChildSmsMessagesQuery;
use \Exception;
use \PDO;
use Map\SmsMessagesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sms_messages' table.
 *
 *
 *
 * @method     ChildSmsMessagesQuery orderByUserNumber($order = Criteria::ASC) Order by the user_number column
 * @method     ChildSmsMessagesQuery orderByQuestion($order = Criteria::ASC) Order by the question column
 * @method     ChildSmsMessagesQuery orderByChoises($order = Criteria::ASC) Order by the choises column
 * @method     ChildSmsMessagesQuery orderByPrevQuestion($order = Criteria::ASC) Order by the prev_question column
 * @method     ChildSmsMessagesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSmsMessagesQuery orderByTopicSelected($order = Criteria::ASC) Order by the topic_Selected column
 * @method     ChildSmsMessagesQuery orderByResponse($order = Criteria::ASC) Order by the response column
 *
 * @method     ChildSmsMessagesQuery groupByUserNumber() Group by the user_number column
 * @method     ChildSmsMessagesQuery groupByQuestion() Group by the question column
 * @method     ChildSmsMessagesQuery groupByChoises() Group by the choises column
 * @method     ChildSmsMessagesQuery groupByPrevQuestion() Group by the prev_question column
 * @method     ChildSmsMessagesQuery groupById() Group by the id column
 * @method     ChildSmsMessagesQuery groupByTopicSelected() Group by the topic_Selected column
 * @method     ChildSmsMessagesQuery groupByResponse() Group by the response column
 *
 * @method     ChildSmsMessagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSmsMessagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSmsMessagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSmsMessagesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSmsMessagesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSmsMessagesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSmsMessagesQuery leftJoinSmsUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SmsUser relation
 * @method     ChildSmsMessagesQuery rightJoinSmsUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SmsUser relation
 * @method     ChildSmsMessagesQuery innerJoinSmsUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SmsUser relation
 *
 * @method     ChildSmsMessagesQuery joinWithSmsUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SmsUser relation
 *
 * @method     ChildSmsMessagesQuery leftJoinWithSmsUser() Adds a LEFT JOIN clause and with to the query using the SmsUser relation
 * @method     ChildSmsMessagesQuery rightJoinWithSmsUser() Adds a RIGHT JOIN clause and with to the query using the SmsUser relation
 * @method     ChildSmsMessagesQuery innerJoinWithSmsUser() Adds a INNER JOIN clause and with to the query using the SmsUser relation
 *
 * @method     \SmsUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSmsMessages findOne(ConnectionInterface $con = null) Return the first ChildSmsMessages matching the query
 * @method     ChildSmsMessages findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSmsMessages matching the query, or a new ChildSmsMessages object populated from the query conditions when no match is found
 *
 * @method     ChildSmsMessages findOneByUserNumber(string $user_number) Return the first ChildSmsMessages filtered by the user_number column
 * @method     ChildSmsMessages findOneByQuestion(string $question) Return the first ChildSmsMessages filtered by the question column
 * @method     ChildSmsMessages findOneByChoises(string $choises) Return the first ChildSmsMessages filtered by the choises column
 * @method     ChildSmsMessages findOneByPrevQuestion(string $prev_question) Return the first ChildSmsMessages filtered by the prev_question column
 * @method     ChildSmsMessages findOneById(int $id) Return the first ChildSmsMessages filtered by the id column
 * @method     ChildSmsMessages findOneByTopicSelected(string $topic_Selected) Return the first ChildSmsMessages filtered by the topic_Selected column
 * @method     ChildSmsMessages findOneByResponse(string $response) Return the first ChildSmsMessages filtered by the response column *

 * @method     ChildSmsMessages requirePk($key, ConnectionInterface $con = null) Return the ChildSmsMessages by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsMessages requireOne(ConnectionInterface $con = null) Return the first ChildSmsMessages matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSmsMessages requireOneByUserNumber(string $user_number) Return the first ChildSmsMessages filtered by the user_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsMessages requireOneByQuestion(string $question) Return the first ChildSmsMessages filtered by the question column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsMessages requireOneByChoises(string $choises) Return the first ChildSmsMessages filtered by the choises column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsMessages requireOneByPrevQuestion(string $prev_question) Return the first ChildSmsMessages filtered by the prev_question column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsMessages requireOneById(int $id) Return the first ChildSmsMessages filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsMessages requireOneByTopicSelected(string $topic_Selected) Return the first ChildSmsMessages filtered by the topic_Selected column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsMessages requireOneByResponse(string $response) Return the first ChildSmsMessages filtered by the response column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSmsMessages[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSmsMessages objects based on current ModelCriteria
 * @method     ChildSmsMessages[]|ObjectCollection findByUserNumber(string $user_number) Return ChildSmsMessages objects filtered by the user_number column
 * @method     ChildSmsMessages[]|ObjectCollection findByQuestion(string $question) Return ChildSmsMessages objects filtered by the question column
 * @method     ChildSmsMessages[]|ObjectCollection findByChoises(string $choises) Return ChildSmsMessages objects filtered by the choises column
 * @method     ChildSmsMessages[]|ObjectCollection findByPrevQuestion(string $prev_question) Return ChildSmsMessages objects filtered by the prev_question column
 * @method     ChildSmsMessages[]|ObjectCollection findById(int $id) Return ChildSmsMessages objects filtered by the id column
 * @method     ChildSmsMessages[]|ObjectCollection findByTopicSelected(string $topic_Selected) Return ChildSmsMessages objects filtered by the topic_Selected column
 * @method     ChildSmsMessages[]|ObjectCollection findByResponse(string $response) Return ChildSmsMessages objects filtered by the response column
 * @method     ChildSmsMessages[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SmsMessagesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SmsMessagesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SmsMessages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSmsMessagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSmsMessagesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSmsMessagesQuery) {
            return $criteria;
        }
        $query = new ChildSmsMessagesQuery();
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
     * @return ChildSmsMessages|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SmsMessagesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SmsMessagesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSmsMessages A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_number, question, choises, prev_question, id, topic_Selected, response FROM sms_messages WHERE id = :p0';
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
            /** @var ChildSmsMessages $obj */
            $obj = new ChildSmsMessages();
            $obj->hydrate($row);
            SmsMessagesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSmsMessages|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SmsMessagesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SmsMessagesTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_number column
     *
     * Example usage:
     * <code>
     * $query->filterByUserNumber('fooValue');   // WHERE user_number = 'fooValue'
     * $query->filterByUserNumber('%fooValue%', Criteria::LIKE); // WHERE user_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByUserNumber($userNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsMessagesTableMap::COL_USER_NUMBER, $userNumber, $comparison);
    }

    /**
     * Filter the query on the question column
     *
     * Example usage:
     * <code>
     * $query->filterByQuestion('fooValue');   // WHERE question = 'fooValue'
     * $query->filterByQuestion('%fooValue%', Criteria::LIKE); // WHERE question LIKE '%fooValue%'
     * </code>
     *
     * @param     string $question The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByQuestion($question = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($question)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsMessagesTableMap::COL_QUESTION, $question, $comparison);
    }

    /**
     * Filter the query on the choises column
     *
     * Example usage:
     * <code>
     * $query->filterByChoises('fooValue');   // WHERE choises = 'fooValue'
     * $query->filterByChoises('%fooValue%', Criteria::LIKE); // WHERE choises LIKE '%fooValue%'
     * </code>
     *
     * @param     string $choises The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByChoises($choises = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($choises)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsMessagesTableMap::COL_CHOISES, $choises, $comparison);
    }

    /**
     * Filter the query on the prev_question column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevQuestion('fooValue');   // WHERE prev_question = 'fooValue'
     * $query->filterByPrevQuestion('%fooValue%', Criteria::LIKE); // WHERE prev_question LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prevQuestion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByPrevQuestion($prevQuestion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prevQuestion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsMessagesTableMap::COL_PREV_QUESTION, $prevQuestion, $comparison);
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
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SmsMessagesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SmsMessagesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsMessagesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the topic_Selected column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicSelected('fooValue');   // WHERE topic_Selected = 'fooValue'
     * $query->filterByTopicSelected('%fooValue%', Criteria::LIKE); // WHERE topic_Selected LIKE '%fooValue%'
     * </code>
     *
     * @param     string $topicSelected The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByTopicSelected($topicSelected = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($topicSelected)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsMessagesTableMap::COL_TOPIC_SELECTED, $topicSelected, $comparison);
    }

    /**
     * Filter the query on the response column
     *
     * Example usage:
     * <code>
     * $query->filterByResponse('fooValue');   // WHERE response = 'fooValue'
     * $query->filterByResponse('%fooValue%', Criteria::LIKE); // WHERE response LIKE '%fooValue%'
     * </code>
     *
     * @param     string $response The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterByResponse($response = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($response)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsMessagesTableMap::COL_RESPONSE, $response, $comparison);
    }

    /**
     * Filter the query by a related \SmsUser object
     *
     * @param \SmsUser|ObjectCollection $smsUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function filterBySmsUser($smsUser, $comparison = null)
    {
        if ($smsUser instanceof \SmsUser) {
            return $this
                ->addUsingAlias(SmsMessagesTableMap::COL_USER_NUMBER, $smsUser->getNumber(), $comparison);
        } elseif ($smsUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SmsMessagesTableMap::COL_USER_NUMBER, $smsUser->toKeyValue('PrimaryKey', 'Number'), $comparison);
        } else {
            throw new PropelException('filterBySmsUser() only accepts arguments of type \SmsUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SmsUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function joinSmsUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SmsUser');

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
            $this->addJoinObject($join, 'SmsUser');
        }

        return $this;
    }

    /**
     * Use the SmsUser relation SmsUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SmsUserQuery A secondary query class using the current class as primary query
     */
    public function useSmsUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSmsUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SmsUser', '\SmsUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSmsMessages $smsMessages Object to remove from the list of results
     *
     * @return $this|ChildSmsMessagesQuery The current query, for fluid interface
     */
    public function prune($smsMessages = null)
    {
        if ($smsMessages) {
            $this->addUsingAlias(SmsMessagesTableMap::COL_ID, $smsMessages->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sms_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SmsMessagesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SmsMessagesTableMap::clearInstancePool();
            SmsMessagesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SmsMessagesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SmsMessagesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SmsMessagesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SmsMessagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SmsMessagesQuery
