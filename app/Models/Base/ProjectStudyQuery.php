<?php

namespace Base;

use \ProjectStudy as ChildProjectStudy;
use \ProjectStudyQuery as ChildProjectStudyQuery;
use \Exception;
use \PDO;
use Map\ProjectStudyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'project_study' table.
 *
 *
 *
 * @method     ChildProjectStudyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProjectStudyQuery orderByStudyName($order = Criteria::ASC) Order by the study_name column
 * @method     ChildProjectStudyQuery orderByStudyDescription($order = Criteria::ASC) Order by the study_description column
 * @method     ChildProjectStudyQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProjectStudyQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProjectStudyQuery groupById() Group by the id column
 * @method     ChildProjectStudyQuery groupByStudyName() Group by the study_name column
 * @method     ChildProjectStudyQuery groupByStudyDescription() Group by the study_description column
 * @method     ChildProjectStudyQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProjectStudyQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProjectStudyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectStudyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectStudyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectStudyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectStudyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectStudyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectStudyQuery leftJoinProjectMessages($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectMessages relation
 * @method     ChildProjectStudyQuery rightJoinProjectMessages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectMessages relation
 * @method     ChildProjectStudyQuery innerJoinProjectMessages($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectMessages relation
 *
 * @method     ChildProjectStudyQuery joinWithProjectMessages($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectMessages relation
 *
 * @method     ChildProjectStudyQuery leftJoinWithProjectMessages() Adds a LEFT JOIN clause and with to the query using the ProjectMessages relation
 * @method     ChildProjectStudyQuery rightJoinWithProjectMessages() Adds a RIGHT JOIN clause and with to the query using the ProjectMessages relation
 * @method     ChildProjectStudyQuery innerJoinWithProjectMessages() Adds a INNER JOIN clause and with to the query using the ProjectMessages relation
 *
 * @method     ChildProjectStudyQuery leftJoinProjectNotification($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectNotification relation
 * @method     ChildProjectStudyQuery rightJoinProjectNotification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectNotification relation
 * @method     ChildProjectStudyQuery innerJoinProjectNotification($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectNotification relation
 *
 * @method     ChildProjectStudyQuery joinWithProjectNotification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectNotification relation
 *
 * @method     ChildProjectStudyQuery leftJoinWithProjectNotification() Adds a LEFT JOIN clause and with to the query using the ProjectNotification relation
 * @method     ChildProjectStudyQuery rightJoinWithProjectNotification() Adds a RIGHT JOIN clause and with to the query using the ProjectNotification relation
 * @method     ChildProjectStudyQuery innerJoinWithProjectNotification() Adds a INNER JOIN clause and with to the query using the ProjectNotification relation
 *
 * @method     ChildProjectStudyQuery leftJoinProjectUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectUser relation
 * @method     ChildProjectStudyQuery rightJoinProjectUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectUser relation
 * @method     ChildProjectStudyQuery innerJoinProjectUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectUser relation
 *
 * @method     ChildProjectStudyQuery joinWithProjectUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectUser relation
 *
 * @method     ChildProjectStudyQuery leftJoinWithProjectUser() Adds a LEFT JOIN clause and with to the query using the ProjectUser relation
 * @method     ChildProjectStudyQuery rightJoinWithProjectUser() Adds a RIGHT JOIN clause and with to the query using the ProjectUser relation
 * @method     ChildProjectStudyQuery innerJoinWithProjectUser() Adds a INNER JOIN clause and with to the query using the ProjectUser relation
 *
 * @method     \ProjectMessagesQuery|\ProjectNotificationQuery|\ProjectUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProjectStudy findOne(ConnectionInterface $con = null) Return the first ChildProjectStudy matching the query
 * @method     ChildProjectStudy findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProjectStudy matching the query, or a new ChildProjectStudy object populated from the query conditions when no match is found
 *
 * @method     ChildProjectStudy findOneById(int $id) Return the first ChildProjectStudy filtered by the id column
 * @method     ChildProjectStudy findOneByStudyName(string $study_name) Return the first ChildProjectStudy filtered by the study_name column
 * @method     ChildProjectStudy findOneByStudyDescription(string $study_description) Return the first ChildProjectStudy filtered by the study_description column
 * @method     ChildProjectStudy findOneByCreatedAt(string $created_at) Return the first ChildProjectStudy filtered by the created_at column
 * @method     ChildProjectStudy findOneByUpdatedAt(string $updated_at) Return the first ChildProjectStudy filtered by the updated_at column *

 * @method     ChildProjectStudy requirePk($key, ConnectionInterface $con = null) Return the ChildProjectStudy by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectStudy requireOne(ConnectionInterface $con = null) Return the first ChildProjectStudy matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectStudy requireOneById(int $id) Return the first ChildProjectStudy filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectStudy requireOneByStudyName(string $study_name) Return the first ChildProjectStudy filtered by the study_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectStudy requireOneByStudyDescription(string $study_description) Return the first ChildProjectStudy filtered by the study_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectStudy requireOneByCreatedAt(string $created_at) Return the first ChildProjectStudy filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectStudy requireOneByUpdatedAt(string $updated_at) Return the first ChildProjectStudy filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectStudy[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProjectStudy objects based on current ModelCriteria
 * @method     ChildProjectStudy[]|ObjectCollection findById(int $id) Return ChildProjectStudy objects filtered by the id column
 * @method     ChildProjectStudy[]|ObjectCollection findByStudyName(string $study_name) Return ChildProjectStudy objects filtered by the study_name column
 * @method     ChildProjectStudy[]|ObjectCollection findByStudyDescription(string $study_description) Return ChildProjectStudy objects filtered by the study_description column
 * @method     ChildProjectStudy[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProjectStudy objects filtered by the created_at column
 * @method     ChildProjectStudy[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProjectStudy objects filtered by the updated_at column
 * @method     ChildProjectStudy[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProjectStudyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProjectStudyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProjectStudy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectStudyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectStudyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProjectStudyQuery) {
            return $criteria;
        }
        $query = new ChildProjectStudyQuery();
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
     * @return ChildProjectStudy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectStudyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectStudyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProjectStudy A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, study_name, study_description, created_at, updated_at FROM project_study WHERE id = :p0';
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
            /** @var ChildProjectStudy $obj */
            $obj = new ChildProjectStudy();
            $obj->hydrate($row);
            ProjectStudyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProjectStudy|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectStudyTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectStudyTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProjectStudyTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectStudyTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStudyTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the study_name column
     *
     * Example usage:
     * <code>
     * $query->filterByStudyName('fooValue');   // WHERE study_name = 'fooValue'
     * $query->filterByStudyName('%fooValue%', Criteria::LIKE); // WHERE study_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $studyName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByStudyName($studyName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($studyName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStudyTableMap::COL_STUDY_NAME, $studyName, $comparison);
    }

    /**
     * Filter the query on the study_description column
     *
     * Example usage:
     * <code>
     * $query->filterByStudyDescription('fooValue');   // WHERE study_description = 'fooValue'
     * $query->filterByStudyDescription('%fooValue%', Criteria::LIKE); // WHERE study_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $studyDescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByStudyDescription($studyDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($studyDescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStudyTableMap::COL_STUDY_DESCRIPTION, $studyDescription, $comparison);
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
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProjectStudyTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProjectStudyTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStudyTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProjectStudyTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProjectStudyTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStudyTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProjectMessages object
     *
     * @param \ProjectMessages|ObjectCollection $projectMessages the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByProjectMessages($projectMessages, $comparison = null)
    {
        if ($projectMessages instanceof \ProjectMessages) {
            return $this
                ->addUsingAlias(ProjectStudyTableMap::COL_ID, $projectMessages->getStudyId(), $comparison);
        } elseif ($projectMessages instanceof ObjectCollection) {
            return $this
                ->useProjectMessagesQuery()
                ->filterByPrimaryKeys($projectMessages->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function joinProjectMessages($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useProjectMessagesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectMessages($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectMessages', '\ProjectMessagesQuery');
    }

    /**
     * Filter the query by a related \ProjectNotification object
     *
     * @param \ProjectNotification|ObjectCollection $projectNotification the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByProjectNotification($projectNotification, $comparison = null)
    {
        if ($projectNotification instanceof \ProjectNotification) {
            return $this
                ->addUsingAlias(ProjectStudyTableMap::COL_ID, $projectNotification->getStudyId(), $comparison);
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
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
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
     * Filter the query by a related \ProjectUser object
     *
     * @param \ProjectUser|ObjectCollection $projectUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProjectStudyQuery The current query, for fluid interface
     */
    public function filterByProjectUser($projectUser, $comparison = null)
    {
        if ($projectUser instanceof \ProjectUser) {
            return $this
                ->addUsingAlias(ProjectStudyTableMap::COL_ID, $projectUser->getStudyId(), $comparison);
        } elseif ($projectUser instanceof ObjectCollection) {
            return $this
                ->useProjectUserQuery()
                ->filterByPrimaryKeys($projectUser->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
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
     * @param   ChildProjectStudy $projectStudy Object to remove from the list of results
     *
     * @return $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function prune($projectStudy = null)
    {
        if ($projectStudy) {
            $this->addUsingAlias(ProjectStudyTableMap::COL_ID, $projectStudy->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project_study table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectStudyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectStudyTableMap::clearInstancePool();
            ProjectStudyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectStudyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectStudyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectStudyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectStudyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectStudyTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectStudyTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectStudyTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectStudyTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectStudyTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildProjectStudyQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectStudyTableMap::COL_CREATED_AT);
    }

} // ProjectStudyQuery
