<?php

namespace Base;

use \VotingUser as ChildVotingUser;
use \VotingUserQuery as ChildVotingUserQuery;
use \Exception;
use \PDO;
use Map\VotingUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'voting_user' table.
 *
 *
 *
 * @method     ChildVotingUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVotingUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildVotingUserQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method     ChildVotingUserQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method     ChildVotingUserQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildVotingUserQuery orderByHash($order = Criteria::ASC) Order by the hash column
 *
 * @method     ChildVotingUserQuery groupById() Group by the id column
 * @method     ChildVotingUserQuery groupByEmail() Group by the email column
 * @method     ChildVotingUserQuery groupByFname() Group by the fname column
 * @method     ChildVotingUserQuery groupByLname() Group by the lname column
 * @method     ChildVotingUserQuery groupByGender() Group by the gender column
 * @method     ChildVotingUserQuery groupByHash() Group by the hash column
 *
 * @method     ChildVotingUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVotingUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVotingUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVotingUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVotingUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVotingUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVotingUserQuery leftJoinVotingUserOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the VotingUserOption relation
 * @method     ChildVotingUserQuery rightJoinVotingUserOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VotingUserOption relation
 * @method     ChildVotingUserQuery innerJoinVotingUserOption($relationAlias = null) Adds a INNER JOIN clause to the query using the VotingUserOption relation
 *
 * @method     ChildVotingUserQuery joinWithVotingUserOption($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VotingUserOption relation
 *
 * @method     ChildVotingUserQuery leftJoinWithVotingUserOption() Adds a LEFT JOIN clause and with to the query using the VotingUserOption relation
 * @method     ChildVotingUserQuery rightJoinWithVotingUserOption() Adds a RIGHT JOIN clause and with to the query using the VotingUserOption relation
 * @method     ChildVotingUserQuery innerJoinWithVotingUserOption() Adds a INNER JOIN clause and with to the query using the VotingUserOption relation
 *
 * @method     \VotingUserOptionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVotingUser findOne(ConnectionInterface $con = null) Return the first ChildVotingUser matching the query
 * @method     ChildVotingUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVotingUser matching the query, or a new ChildVotingUser object populated from the query conditions when no match is found
 *
 * @method     ChildVotingUser findOneById(int $id) Return the first ChildVotingUser filtered by the id column
 * @method     ChildVotingUser findOneByEmail(string $email) Return the first ChildVotingUser filtered by the email column
 * @method     ChildVotingUser findOneByFname(string $fname) Return the first ChildVotingUser filtered by the fname column
 * @method     ChildVotingUser findOneByLname(string $lname) Return the first ChildVotingUser filtered by the lname column
 * @method     ChildVotingUser findOneByGender(string $gender) Return the first ChildVotingUser filtered by the gender column
 * @method     ChildVotingUser findOneByHash(string $hash) Return the first ChildVotingUser filtered by the hash column *

 * @method     ChildVotingUser requirePk($key, ConnectionInterface $con = null) Return the ChildVotingUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUser requireOne(ConnectionInterface $con = null) Return the first ChildVotingUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVotingUser requireOneById(int $id) Return the first ChildVotingUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUser requireOneByEmail(string $email) Return the first ChildVotingUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUser requireOneByFname(string $fname) Return the first ChildVotingUser filtered by the fname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUser requireOneByLname(string $lname) Return the first ChildVotingUser filtered by the lname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUser requireOneByGender(string $gender) Return the first ChildVotingUser filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotingUser requireOneByHash(string $hash) Return the first ChildVotingUser filtered by the hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVotingUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVotingUser objects based on current ModelCriteria
 * @method     ChildVotingUser[]|ObjectCollection findById(int $id) Return ChildVotingUser objects filtered by the id column
 * @method     ChildVotingUser[]|ObjectCollection findByEmail(string $email) Return ChildVotingUser objects filtered by the email column
 * @method     ChildVotingUser[]|ObjectCollection findByFname(string $fname) Return ChildVotingUser objects filtered by the fname column
 * @method     ChildVotingUser[]|ObjectCollection findByLname(string $lname) Return ChildVotingUser objects filtered by the lname column
 * @method     ChildVotingUser[]|ObjectCollection findByGender(string $gender) Return ChildVotingUser objects filtered by the gender column
 * @method     ChildVotingUser[]|ObjectCollection findByHash(string $hash) Return ChildVotingUser objects filtered by the hash column
 * @method     ChildVotingUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VotingUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VotingUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\VotingUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVotingUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVotingUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVotingUserQuery) {
            return $criteria;
        }
        $query = new ChildVotingUserQuery();
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
     * @return ChildVotingUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VotingUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VotingUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVotingUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, email, fname, lname, gender, hash FROM voting_user WHERE id = :p0';
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
            /** @var ChildVotingUser $obj */
            $obj = new ChildVotingUser();
            $obj->hydrate($row);
            VotingUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVotingUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VotingUserTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VotingUserTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VotingUserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VotingUserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByFname($fname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserTableMap::COL_FNAME, $fname, $comparison);
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
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByLname($lname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserTableMap::COL_LNAME, $lname, $comparison);
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
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserTableMap::COL_GENDER, $gender, $comparison);
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
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByHash($hash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hash)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotingUserTableMap::COL_HASH, $hash, $comparison);
    }

    /**
     * Filter the query by a related \VotingUserOption object
     *
     * @param \VotingUserOption|ObjectCollection $votingUserOption the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVotingUserQuery The current query, for fluid interface
     */
    public function filterByVotingUserOption($votingUserOption, $comparison = null)
    {
        if ($votingUserOption instanceof \VotingUserOption) {
            return $this
                ->addUsingAlias(VotingUserTableMap::COL_ID, $votingUserOption->getUserId(), $comparison);
        } elseif ($votingUserOption instanceof ObjectCollection) {
            return $this
                ->useVotingUserOptionQuery()
                ->filterByPrimaryKeys($votingUserOption->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVotingUserOption() only accepts arguments of type \VotingUserOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VotingUserOption relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function joinVotingUserOption($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VotingUserOption');

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
            $this->addJoinObject($join, 'VotingUserOption');
        }

        return $this;
    }

    /**
     * Use the VotingUserOption relation VotingUserOption object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VotingUserOptionQuery A secondary query class using the current class as primary query
     */
    public function useVotingUserOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVotingUserOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VotingUserOption', '\VotingUserOptionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVotingUser $votingUser Object to remove from the list of results
     *
     * @return $this|ChildVotingUserQuery The current query, for fluid interface
     */
    public function prune($votingUser = null)
    {
        if ($votingUser) {
            $this->addUsingAlias(VotingUserTableMap::COL_ID, $votingUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the voting_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VotingUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VotingUserTableMap::clearInstancePool();
            VotingUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VotingUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VotingUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VotingUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VotingUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VotingUserQuery
