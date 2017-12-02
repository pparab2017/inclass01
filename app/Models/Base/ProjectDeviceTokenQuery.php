<?php

namespace Base;

use \ProjectDeviceToken as ChildProjectDeviceToken;
use \ProjectDeviceTokenQuery as ChildProjectDeviceTokenQuery;
use \Exception;
use \PDO;
use Map\ProjectDeviceTokenTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'project_device_token' table.
 *
 *
 *
 * @method     ChildProjectDeviceTokenQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProjectDeviceTokenQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildProjectDeviceTokenQuery orderByToken($order = Criteria::ASC) Order by the token column
 *
 * @method     ChildProjectDeviceTokenQuery groupById() Group by the id column
 * @method     ChildProjectDeviceTokenQuery groupByUserId() Group by the user_id column
 * @method     ChildProjectDeviceTokenQuery groupByToken() Group by the token column
 *
 * @method     ChildProjectDeviceTokenQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectDeviceTokenQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectDeviceTokenQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectDeviceTokenQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectDeviceTokenQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectDeviceTokenQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectDeviceTokenQuery leftJoinProjectUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectUser relation
 * @method     ChildProjectDeviceTokenQuery rightJoinProjectUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectUser relation
 * @method     ChildProjectDeviceTokenQuery innerJoinProjectUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectUser relation
 *
 * @method     ChildProjectDeviceTokenQuery joinWithProjectUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectUser relation
 *
 * @method     ChildProjectDeviceTokenQuery leftJoinWithProjectUser() Adds a LEFT JOIN clause and with to the query using the ProjectUser relation
 * @method     ChildProjectDeviceTokenQuery rightJoinWithProjectUser() Adds a RIGHT JOIN clause and with to the query using the ProjectUser relation
 * @method     ChildProjectDeviceTokenQuery innerJoinWithProjectUser() Adds a INNER JOIN clause and with to the query using the ProjectUser relation
 *
 * @method     \ProjectUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProjectDeviceToken findOne(ConnectionInterface $con = null) Return the first ChildProjectDeviceToken matching the query
 * @method     ChildProjectDeviceToken findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProjectDeviceToken matching the query, or a new ChildProjectDeviceToken object populated from the query conditions when no match is found
 *
 * @method     ChildProjectDeviceToken findOneById(int $id) Return the first ChildProjectDeviceToken filtered by the id column
 * @method     ChildProjectDeviceToken findOneByUserId(int $user_id) Return the first ChildProjectDeviceToken filtered by the user_id column
 * @method     ChildProjectDeviceToken findOneByToken(string $token) Return the first ChildProjectDeviceToken filtered by the token column *

 * @method     ChildProjectDeviceToken requirePk($key, ConnectionInterface $con = null) Return the ChildProjectDeviceToken by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectDeviceToken requireOne(ConnectionInterface $con = null) Return the first ChildProjectDeviceToken matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectDeviceToken requireOneById(int $id) Return the first ChildProjectDeviceToken filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectDeviceToken requireOneByUserId(int $user_id) Return the first ChildProjectDeviceToken filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectDeviceToken requireOneByToken(string $token) Return the first ChildProjectDeviceToken filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectDeviceToken[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProjectDeviceToken objects based on current ModelCriteria
 * @method     ChildProjectDeviceToken[]|ObjectCollection findById(int $id) Return ChildProjectDeviceToken objects filtered by the id column
 * @method     ChildProjectDeviceToken[]|ObjectCollection findByUserId(int $user_id) Return ChildProjectDeviceToken objects filtered by the user_id column
 * @method     ChildProjectDeviceToken[]|ObjectCollection findByToken(string $token) Return ChildProjectDeviceToken objects filtered by the token column
 * @method     ChildProjectDeviceToken[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProjectDeviceTokenQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProjectDeviceTokenQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProjectDeviceToken', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectDeviceTokenQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectDeviceTokenQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProjectDeviceTokenQuery) {
            return $criteria;
        }
        $query = new ChildProjectDeviceTokenQuery();
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
     * @return ChildProjectDeviceToken|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectDeviceTokenTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectDeviceTokenTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProjectDeviceToken A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, token FROM project_device_token WHERE id = :p0';
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
            /** @var ChildProjectDeviceToken $obj */
            $obj = new ChildProjectDeviceToken();
            $obj->hydrate($row);
            ProjectDeviceTokenTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProjectDeviceToken|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProjectDeviceTokenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProjectDeviceTokenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProjectDeviceTokenQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildProjectDeviceTokenQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $token The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectDeviceTokenQuery The current query, for fluid interface
     */
    public function filterByToken($token = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_TOKEN, $token, $comparison);
    }

    /**
     * Filter the query by a related \ProjectUser object
     *
     * @param \ProjectUser|ObjectCollection $projectUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProjectDeviceTokenQuery The current query, for fluid interface
     */
    public function filterByProjectUser($projectUser, $comparison = null)
    {
        if ($projectUser instanceof \ProjectUser) {
            return $this
                ->addUsingAlias(ProjectDeviceTokenTableMap::COL_USER_ID, $projectUser->getId(), $comparison);
        } elseif ($projectUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectDeviceTokenTableMap::COL_USER_ID, $projectUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProjectDeviceTokenQuery The current query, for fluid interface
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
     * @param   ChildProjectDeviceToken $projectDeviceToken Object to remove from the list of results
     *
     * @return $this|ChildProjectDeviceTokenQuery The current query, for fluid interface
     */
    public function prune($projectDeviceToken = null)
    {
        if ($projectDeviceToken) {
            $this->addUsingAlias(ProjectDeviceTokenTableMap::COL_ID, $projectDeviceToken->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project_device_token table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectDeviceTokenTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectDeviceTokenTableMap::clearInstancePool();
            ProjectDeviceTokenTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectDeviceTokenTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectDeviceTokenTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectDeviceTokenTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectDeviceTokenTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProjectDeviceTokenQuery
