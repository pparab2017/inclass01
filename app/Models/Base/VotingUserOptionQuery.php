<?php

namespace Base;

use \VotingUserOption as ChildVotingUserOption;
use \VotingUserOptionQuery as ChildVotingUserOptionQuery;
use \Exception;
use \PDO;
use Map\VotingUserOptionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'voting_user_option' table.
 *
 *
 *
 * @method     ChildVotingUserOptionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVotingUserOptionQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildVotingUserOptionQuery orderByVoteId($order = Criteria::ASC) Order by the vote_id column
 *
 * @method     ChildVotingUserOptionQuery groupById() Group by the id column
 * @method     ChildVotingUserOptionQuery groupByUserId() Group by the user_id column
 * @method     ChildVotingUserOptionQuery groupByVoteId() Group by the vote_id column
 *
 * @method     ChildVotingUserOptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVotingUserOptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVotingUserOptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVotingUserOptionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVotingUserOptionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVotingUserOptionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVotingUserOptionQuery leftJoinVotingOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the VotingOption relation
 * @method     ChildVotingUserOptionQuery rightJoinVotingOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VotingOption relation
 * @method     ChildVotingUserOptionQuery innerJoinVotingOption($relationAlias = null) Adds a INNER JOIN clause to the query using the VotingOption relation
 *
 * @method     ChildVotingUserOptionQuery joinWithVotingOption($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VotingOption relation
 *
 * @method     ChildVotingUserOptionQuery leftJoinWithVotingOption() Adds a LEFT JOIN clause and with to the query using the VotingOption relation
 * @method     ChildVotingUserOptionQuery rightJoinWithVotingOption() Adds a RIGHT JOIN clause and with to the query using the VotingOption relation
 * @method     ChildVotingUserOptionQuery innerJoinWithVotingOption() Adds a INNER JOIN clause and with to the query using the VotingOption relation
 *
 * @method     ChildVotingUserOptionQuery leftJoinVotingUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the VotingUser relation
 * @method     ChildVotingUserOptionQuery rightJoinVotingUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VotingUser relation
 * @method     ChildVotingUserOptionQuery innerJoinVotingUser($relationAlias = null) Adds a INNER JOIN clause to the query using the VotingUser relation
 *
 * @method     ChildVotingUserOptionQuery joinWithVotingUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VotingUser relation
 *
 * @method     ChildVotingUserOptionQuery leftJoinWithVotingUser() Adds a LEFT JOIN clause and with to the query using the VotingUser relation
 * @method     ChildVotingUserOptionQuery rightJoinWithVotingUser() Adds a RIGHT JOIN clause and with to the query using the VotingUser relation
 * @method     ChildVotingUserOptionQuery innerJoinWithVotingUser() Adds a INNER JOIN clause and with to the query using the VotingUser relation
 *
 * @method     \VotingOptionQuery|\VotingUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVotingUserOption findOne(ConnectionInterface $con = null) Return the first ChildVotingUserOption matching the query
 * @method     ChildVotingUserOption findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVotingUserOption matching the query, or a new ChildVotingUserOption object populated from the query conditions when no match is found
 *
 * @method     ChildVotingUserOption findOneById(int $id) Return the first ChildVotingUserOption filtered by the id column
 * @method     ChildVotingUserOption findOneByUserId(int $user_id) Return the first ChildVotingUserOption filtered by the user_id column
 * @method     ChildVotingUserOption findOneByVoteId(int $vote_id) Return the first ChildVotingUserOption filtered by the vote_id column *

 * @method     ChildVotingUserOption requirePk($key, ConnectionInterface $con = null) Return the ChildVotingUserOption by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUserOption requireOne(ConnectionInterface $con = null) Return the first ChildVotingUserOption matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVotingUserOption requireOneById(int $id) Return the first ChildVotingUserOption filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUserOption requireOneByUserId(int $user_id) Return the first ChildVotingUserOption filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUserOption requireOneByVoteId(int $vote_id) Return the first ChildVotingUserOption filtered by the vote_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVotingUserOption[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVotingUserOption objects based on current ModelCriteria
 * @method     ChildVotingUserOption[]|ObjectCollection findById(int $id) Return ChildVotingUserOption objects filtered by the id column
 * @method     ChildVotingUserOption[]|ObjectCollection findByUserId(int $user_id) Return ChildVotingUserOption objects filtered by the user_id column
 * @method     ChildVotingUserOption[]|ObjectCollection findByVoteId(int $vote_id) Return ChildVotingUserOption objects filtered by the vote_id column
 * @method     ChildVotingUserOption[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VotingUserOptionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VotingUserOptionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\VotingUserOption', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVotingUserOptionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVotingUserOptionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVotingUserOptionQuery) {
            return $criteria;
        }
        $query = new ChildVotingUserOptionQuery();
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
     * @return ChildVotingUserOption|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VotingUserOptionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VotingUserOptionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVotingUserOption A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, vote_id FROM voting_user_option WHERE id = :p0';
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
            /** @var ChildVotingUserOption $obj */
            $obj = new ChildVotingUserOption();
            $obj->hydrate($row);
            VotingUserOptionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVotingUserOption|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VotingUserOptionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VotingUserOptionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VotingUserOptionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VotingUserOptionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserOptionTableMap::COL_ID, $id, $comparison);
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
     * @see       filterByVotingUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(VotingUserOptionTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(VotingUserOptionTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserOptionTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the vote_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVoteId(1234); // WHERE vote_id = 1234
     * $query->filterByVoteId(array(12, 34)); // WHERE vote_id IN (12, 34)
     * $query->filterByVoteId(array('min' => 12)); // WHERE vote_id > 12
     * </code>
     *
     * @see       filterByVotingOption()
     *
     * @param     mixed $voteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function filterByVoteId($voteId = null, $comparison = null)
    {
        if (is_array($voteId)) {
            $useMinMax = false;
            if (isset($voteId['min'])) {
                $this->addUsingAlias(VotingUserOptionTableMap::COL_VOTE_ID, $voteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($voteId['max'])) {
                $this->addUsingAlias(VotingUserOptionTableMap::COL_VOTE_ID, $voteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserOptionTableMap::COL_VOTE_ID, $voteId, $comparison);
    }

    /**
     * Filter the query by a related \VotingOption object
     *
     * @param \VotingOption|ObjectCollection $votingOption The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function filterByVotingOption($votingOption, $comparison = null)
    {
        if ($votingOption instanceof \VotingOption) {
            return $this
                ->addUsingAlias(VotingUserOptionTableMap::COL_VOTE_ID, $votingOption->getId(), $comparison);
        } elseif ($votingOption instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VotingUserOptionTableMap::COL_VOTE_ID, $votingOption->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVotingOption() only accepts arguments of type \VotingOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VotingOption relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function joinVotingOption($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VotingOption');

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
            $this->addJoinObject($join, 'VotingOption');
        }

        return $this;
    }

    /**
     * Use the VotingOption relation VotingOption object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VotingOptionQuery A secondary query class using the current class as primary query
     */
    public function useVotingOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVotingOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VotingOption', '\VotingOptionQuery');
    }

    /**
     * Filter the query by a related \VotingUser object
     *
     * @param \VotingUser|ObjectCollection $votingUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function filterByVotingUser($votingUser, $comparison = null)
    {
        if ($votingUser instanceof \VotingUser) {
            return $this
                ->addUsingAlias(VotingUserOptionTableMap::COL_USER_ID, $votingUser->getId(), $comparison);
        } elseif ($votingUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VotingUserOptionTableMap::COL_USER_ID, $votingUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVotingUser() only accepts arguments of type \VotingUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VotingUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function joinVotingUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VotingUser');

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
            $this->addJoinObject($join, 'VotingUser');
        }

        return $this;
    }

    /**
     * Use the VotingUser relation VotingUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VotingUserQuery A secondary query class using the current class as primary query
     */
    public function useVotingUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVotingUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VotingUser', '\VotingUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVotingUserOption $votingUserOption Object to remove from the list of results
     *
     * @return $this|ChildVotingUserOptionQuery The current query, for fluid interface
     */
    public function prune($votingUserOption = null)
    {
        if ($votingUserOption) {
            $this->addUsingAlias(VotingUserOptionTableMap::COL_ID, $votingUserOption->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the voting_user_option table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VotingUserOptionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VotingUserOptionTableMap::clearInstancePool();
            VotingUserOptionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VotingUserOptionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VotingUserOptionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VotingUserOptionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VotingUserOptionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VotingUserOptionQuery
