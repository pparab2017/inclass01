<?php

namespace Map;

use \ProjectUser;
use \ProjectUserQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'project_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProjectUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProjectUserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'project_user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ProjectUser';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ProjectUser';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'project_user.id';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'project_user.email';

    /**
     * the column name for the hash field
     */
    const COL_HASH = 'project_user.hash';

    /**
     * the column name for the fname field
     */
    const COL_FNAME = 'project_user.fname';

    /**
     * the column name for the lname field
     */
    const COL_LNAME = 'project_user.lname';

    /**
     * the column name for the gender field
     */
    const COL_GENDER = 'project_user.gender';

    /**
     * the column name for the role field
     */
    const COL_ROLE = 'project_user.role';

    /**
     * the column name for the Subscribed field
     */
    const COL_SUBSCRIBED = 'project_user.Subscribed';

    /**
     * the column name for the study_id field
     */
    const COL_STUDY_ID = 'project_user.study_id';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'project_user.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'project_user.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Email', 'Hash', 'Fname', 'Lname', 'Gender', 'Role', 'Subscribed', 'StudyId', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'email', 'hash', 'fname', 'lname', 'gender', 'role', 'subscribed', 'studyId', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProjectUserTableMap::COL_ID, ProjectUserTableMap::COL_EMAIL, ProjectUserTableMap::COL_HASH, ProjectUserTableMap::COL_FNAME, ProjectUserTableMap::COL_LNAME, ProjectUserTableMap::COL_GENDER, ProjectUserTableMap::COL_ROLE, ProjectUserTableMap::COL_SUBSCRIBED, ProjectUserTableMap::COL_STUDY_ID, ProjectUserTableMap::COL_CREATED_AT, ProjectUserTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'email', 'hash', 'fname', 'lname', 'gender', 'role', 'Subscribed', 'study_id', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Email' => 1, 'Hash' => 2, 'Fname' => 3, 'Lname' => 4, 'Gender' => 5, 'Role' => 6, 'Subscribed' => 7, 'StudyId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'email' => 1, 'hash' => 2, 'fname' => 3, 'lname' => 4, 'gender' => 5, 'role' => 6, 'subscribed' => 7, 'studyId' => 8, 'createdAt' => 9, 'updatedAt' => 10, ),
        self::TYPE_COLNAME       => array(ProjectUserTableMap::COL_ID => 0, ProjectUserTableMap::COL_EMAIL => 1, ProjectUserTableMap::COL_HASH => 2, ProjectUserTableMap::COL_FNAME => 3, ProjectUserTableMap::COL_LNAME => 4, ProjectUserTableMap::COL_GENDER => 5, ProjectUserTableMap::COL_ROLE => 6, ProjectUserTableMap::COL_SUBSCRIBED => 7, ProjectUserTableMap::COL_STUDY_ID => 8, ProjectUserTableMap::COL_CREATED_AT => 9, ProjectUserTableMap::COL_UPDATED_AT => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'email' => 1, 'hash' => 2, 'fname' => 3, 'lname' => 4, 'gender' => 5, 'role' => 6, 'Subscribed' => 7, 'study_id' => 8, 'created_at' => 9, 'updated_at' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('project_user');
        $this->setPhpName('ProjectUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ProjectUser');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('hash', 'Hash', 'VARCHAR', true, 255, null);
        $this->addColumn('fname', 'Fname', 'VARCHAR', false, 255, null);
        $this->addColumn('lname', 'Lname', 'VARCHAR', false, 255, null);
        $this->addColumn('gender', 'Gender', 'CHAR', false, null, null);
        $this->addColumn('role', 'Role', 'CHAR', false, null, 'STUDENT');
        $this->addColumn('Subscribed', 'Subscribed', 'CHAR', false, null, 'YES');
        $this->addForeignKey('study_id', 'StudyId', 'INTEGER', 'project_study', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ProjectStudy', '\\ProjectStudy', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':study_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ProjectDeviceToken', '\\ProjectDeviceToken', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, 'ProjectDeviceTokens', false);
        $this->addRelation('ProjectNotification', '\\ProjectNotification', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, 'ProjectNotifications', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ProjectUserTableMap::CLASS_DEFAULT : ProjectUserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (ProjectUser object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProjectUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProjectUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProjectUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProjectUserTableMap::OM_CLASS;
            /** @var ProjectUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProjectUserTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ProjectUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProjectUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProjectUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProjectUserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ProjectUserTableMap::COL_ID);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_EMAIL);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_HASH);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_FNAME);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_LNAME);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_GENDER);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_ROLE);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_SUBSCRIBED);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_STUDY_ID);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProjectUserTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.hash');
            $criteria->addSelectColumn($alias . '.fname');
            $criteria->addSelectColumn($alias . '.lname');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.role');
            $criteria->addSelectColumn($alias . '.Subscribed');
            $criteria->addSelectColumn($alias . '.study_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ProjectUserTableMap::DATABASE_NAME)->getTable(ProjectUserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProjectUserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProjectUserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProjectUserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ProjectUser or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ProjectUser object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ProjectUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProjectUserTableMap::DATABASE_NAME);
            $criteria->add(ProjectUserTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProjectUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProjectUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProjectUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the project_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProjectUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProjectUser or Criteria object.
     *
     * @param mixed               $criteria Criteria or ProjectUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProjectUser object
        }

        if ($criteria->containsKey(ProjectUserTableMap::COL_ID) && $criteria->keyContainsValue(ProjectUserTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProjectUserTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProjectUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProjectUserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProjectUserTableMap::buildTableMap();
