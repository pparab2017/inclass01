<?php

namespace Base;

use \SmsUser as ChildSmsUser;
use \SmsUserQuery as ChildSmsUserQuery;
use \Exception;
use \PDO;
use Map\SmsUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sms_user' table.
 *
 *
 *
 * @method     ChildSmsUserQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildSmsUserQuery orderByCount($order = Criteria::ASC) Order by the count column
 *
 * @method     ChildSmsUserQuery groupByNumber() Group by the number column
 * @method     ChildSmsUserQuery groupByCount() Group by the count column
 *
 * @method     ChildSmsUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSmsUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSmsUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSmsUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSmsUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSmsUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSmsUserQuery leftJoinSmsMessages($relationAlias = null) Adds a LEFT JOIN clause to the query using the SmsMessages relation
 * @method     ChildSmsUserQuery rightJoinSmsMessages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SmsMessages relation
 * @method     ChildSmsUserQuery innerJoinSmsMessages($relationAlias = null) Adds a INNER JOIN clause to the query using the SmsMessages relation
 *
 * @method     ChildSmsUserQuery joinWithSmsMessages($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SmsMessages relation
 *
 * @method     ChildSmsUserQuery leftJoinWithSmsMessages() Adds a LEFT JOIN clause and with to the query using the SmsMessages relation
 * @method     ChildSmsUserQuery rightJoinWithSmsMessages() Adds a RIGHT JOIN clause and with to the query using the SmsMessages relation
 * @method     ChildSmsUserQuery innerJoinWithSmsMessages() Adds a INNER JOIN clause and with to the query using the SmsMessages relation
 *
 * @method     \SmsMessagesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSmsUser findOne(ConnectionInterface $con = null) Return the first ChildSmsUser matching the query
 * @method     ChildSmsUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSmsUser matching the query, or a new ChildSmsUser object populated from the query conditions when no match is found
 *
 * @method     ChildSmsUser findOneByNumber(string $number) Return the first ChildSmsUser filtered by the number column
 * @method     ChildSmsUser findOneByCount(string $count) Return the first ChildSmsUser filtered by the count column *

 * @method     ChildSmsUser requirePk($key, ConnectionInterface $con = null) Return the ChildSmsUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsUser requireOne(ConnectionInterface $con = null) Return the first ChildSmsUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSmsUser requireOneByNumber(string $number) Return the first ChildSmsUser filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSmsUser requireOneByCount(string $count) Return the first ChildSmsUser filtered by the count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSmsUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSmsUser objects based on current ModelCriteria
 * @method     ChildSmsUser[]|ObjectCollection findByNumber(string $number) Return ChildSmsUser objects filtered by the number column
 * @method     ChildSmsUser[]|ObjectCollection findByCount(string $count) Return ChildSmsUser objects filtered by the count column
 * @method     ChildSmsUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SmsUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SmsUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SmsUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSmsUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSmsUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSmsUserQuery) {
            return $criteria;
        }
        $query = new ChildSmsUserQuery();
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
     * @return ChildSmsUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SmsUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SmsUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSmsUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT number, count FROM sms_user WHERE number = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSmsUser $obj */
            $obj = new ChildSmsUser();
            $obj->hydrate($row);
            SmsUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSmsUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSmsUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SmsUserTableMap::COL_NUMBER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSmsUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SmsUserTableMap::COL_NUMBER, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber('fooValue');   // WHERE number = 'fooValue'
     * $query->filterByNumber('%fooValue%', Criteria::LIKE); // WHERE number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $number The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsUserQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($number)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsUserTableMap::COL_NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the count column
     *
     * Example usage:
     * <code>
     * $query->filterByCount('fooValue');   // WHERE count = 'fooValue'
     * $query->filterByCount('%fooValue%', Criteria::LIKE); // WHERE count LIKE '%fooValue%'
     * </code>
     *
     * @param     string $count The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSmsUserQuery The current query, for fluid interface
     */
    public function filterByCount($count = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($count)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SmsUserTableMap::COL_COUNT, $count, $comparison);
    }

    /**
     * Filter the query by a related \SmsMessages object
     *
     * @param \SmsMessages|ObjectCollection $smsMessages the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSmsUserQuery The current query, for fluid interface
     */
    public function filterBySmsMessages($smsMessages, $comparison = null)
    {
        if ($smsMessages instanceof \SmsMessages) {
            return $this
                ->addUsingAlias(SmsUserTableMap::COL_NUMBER, $smsMessages->getUserNumber(), $comparison);
        } elseif ($smsMessages instanceof ObjectCollection) {
            return $this
                ->useSmsMessagesQuery()
                ->filterByPrimaryKeys($smsMessages->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySmsMessages() only accepts arguments of type \SmsMessages or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SmsMessages relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSmsUserQuery The current query, for fluid interface
     */
    public function joinSmsMessages($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SmsMessages');

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
            $this->addJoinObject($join, 'SmsMessages');
        }

        return $this;
    }

    /**
     * Use the SmsMessages relation SmsMessages object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SmsMessagesQuery A secondary query class using the current class as primary query
     */
    public function useSmsMessagesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSmsMessages($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SmsMessages', '\SmsMessagesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSmsUser $smsUser Object to remove from the list of results
     *
     * @return $this|ChildSmsUserQuery The current query, for fluid interface
     */
    public function prune($smsUser = null)
    {
        if ($smsUser) {
            $this->addUsingAlias(SmsUserTableMap::COL_NUMBER, $smsUser->getNumber(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sms_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SmsUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SmsUserTableMap::clearInstancePool();
            SmsUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SmsUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SmsUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SmsUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SmsUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SmsUserQuery
