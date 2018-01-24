<?php

namespace Map;

use \ProjectMessages;
use \ProjectMessagesQuery;
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
 * This class defines the structure of the 'project_messages' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProjectMessagesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProjectMessagesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'project_messages';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ProjectMessages';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ProjectMessages';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'project_messages.id';

    /**
     * the column name for the text field
     */
    const COL_TEXT = 'project_messages.text';

    /**
     * the column name for the reminder_type field
     */
    const COL_REMINDER_TYPE = 'project_messages.reminder_type';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'project_messages.type';

    /**
     * the column name for the Time field
     */
    const COL_TIME = 'project_messages.Time';

    /**
     * the column name for the Study_Id field
     */
    const COL_STUDY_ID = 'project_messages.Study_Id';

    /**
     * the column name for the LastSent field
     */
    const COL_LASTSENT = 'project_messages.LastSent';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'project_messages.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'project_messages.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Text', 'ReminderType', 'Type', 'Time', 'StudyId', 'Lastsent', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'text', 'reminderType', 'type', 'time', 'studyId', 'lastsent', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProjectMessagesTableMap::COL_ID, ProjectMessagesTableMap::COL_TEXT, ProjectMessagesTableMap::COL_REMINDER_TYPE, ProjectMessagesTableMap::COL_TYPE, ProjectMessagesTableMap::COL_TIME, ProjectMessagesTableMap::COL_STUDY_ID, ProjectMessagesTableMap::COL_LASTSENT, ProjectMessagesTableMap::COL_CREATED_AT, ProjectMessagesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'text', 'reminder_type', 'type', 'Time', 'Study_Id', 'LastSent', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Text' => 1, 'ReminderType' => 2, 'Type' => 3, 'Time' => 4, 'StudyId' => 5, 'Lastsent' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'text' => 1, 'reminderType' => 2, 'type' => 3, 'time' => 4, 'studyId' => 5, 'lastsent' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
        self::TYPE_COLNAME       => array(ProjectMessagesTableMap::COL_ID => 0, ProjectMessagesTableMap::COL_TEXT => 1, ProjectMessagesTableMap::COL_REMINDER_TYPE => 2, ProjectMessagesTableMap::COL_TYPE => 3, ProjectMessagesTableMap::COL_TIME => 4, ProjectMessagesTableMap::COL_STUDY_ID => 5, ProjectMessagesTableMap::COL_LASTSENT => 6, ProjectMessagesTableMap::COL_CREATED_AT => 7, ProjectMessagesTableMap::COL_UPDATED_AT => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'text' => 1, 'reminder_type' => 2, 'type' => 3, 'Time' => 4, 'Study_Id' => 5, 'LastSent' => 6, 'created_at' => 7, 'updated_at' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('project_messages');
        $this->setPhpName('ProjectMessages');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ProjectMessages');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('text', 'Text', 'LONGVARCHAR', false, null, null);
        $this->addColumn('reminder_type', 'ReminderType', 'CHAR', false, null, 'H');
        $this->addColumn('type', 'Type', 'CHAR', false, null, 'QUESTION');
        $this->addColumn('Time', 'Time', 'VARCHAR', false, 45, null);
        $this->addForeignKey('Study_Id', 'StudyId', 'INTEGER', 'project_study', 'id', true, null, null);
        $this->addColumn('LastSent', 'Lastsent', 'TIMESTAMP', false, null, null);
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
    0 => ':Study_Id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ProjectNotification', '\\ProjectNotification', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':message_id',
    1 => ':id',
  ),
), null, null, 'ProjectNotifications', false);
    } // buildRelations()

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
        return $withPrefix ? ProjectMessagesTableMap::CLASS_DEFAULT : ProjectMessagesTableMap::OM_CLASS;
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
     * @return array           (ProjectMessages object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProjectMessagesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProjectMessagesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProjectMessagesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProjectMessagesTableMap::OM_CLASS;
            /** @var ProjectMessages $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProjectMessagesTableMap::addInstanceToPool($obj, $key);
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
            $key = ProjectMessagesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProjectMessagesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProjectMessages $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProjectMessagesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_ID);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_TEXT);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_REMINDER_TYPE);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_TYPE);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_TIME);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_STUDY_ID);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_LASTSENT);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProjectMessagesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.text');
            $criteria->addSelectColumn($alias . '.reminder_type');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.Time');
            $criteria->addSelectColumn($alias . '.Study_Id');
            $criteria->addSelectColumn($alias . '.LastSent');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProjectMessagesTableMap::DATABASE_NAME)->getTable(ProjectMessagesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProjectMessagesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProjectMessagesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProjectMessagesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ProjectMessages or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ProjectMessages object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectMessagesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ProjectMessages) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProjectMessagesTableMap::DATABASE_NAME);
            $criteria->add(ProjectMessagesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProjectMessagesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProjectMessagesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProjectMessagesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the project_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProjectMessagesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProjectMessages or Criteria object.
     *
     * @param mixed               $criteria Criteria or ProjectMessages object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectMessagesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProjectMessages object
        }

        if ($criteria->containsKey(ProjectMessagesTableMap::COL_ID) && $criteria->keyContainsValue(ProjectMessagesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProjectMessagesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProjectMessagesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProjectMessagesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProjectMessagesTableMap::buildTableMap();
