<?php

namespace Map;

use \SmsMessages;
use \SmsMessagesQuery;
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
 * This class defines the structure of the 'sms_messages' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SmsMessagesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SmsMessagesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sms_messages';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SmsMessages';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SmsMessages';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the user_number field
     */
    const COL_USER_NUMBER = 'sms_messages.user_number';

    /**
     * the column name for the question field
     */
    const COL_QUESTION = 'sms_messages.question';

    /**
     * the column name for the choises field
     */
    const COL_CHOISES = 'sms_messages.choises';

    /**
     * the column name for the prev_question field
     */
    const COL_PREV_QUESTION = 'sms_messages.prev_question';

    /**
     * the column name for the id field
     */
    const COL_ID = 'sms_messages.id';

    /**
     * the column name for the topic_Selected field
     */
    const COL_TOPIC_SELECTED = 'sms_messages.topic_Selected';

    /**
     * the column name for the response field
     */
    const COL_RESPONSE = 'sms_messages.response';

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
        self::TYPE_PHPNAME       => array('UserNumber', 'Question', 'Choises', 'PrevQuestion', 'Id', 'TopicSelected', 'Response', ),
        self::TYPE_CAMELNAME     => array('userNumber', 'question', 'choises', 'prevQuestion', 'id', 'topicSelected', 'response', ),
        self::TYPE_COLNAME       => array(SmsMessagesTableMap::COL_USER_NUMBER, SmsMessagesTableMap::COL_QUESTION, SmsMessagesTableMap::COL_CHOISES, SmsMessagesTableMap::COL_PREV_QUESTION, SmsMessagesTableMap::COL_ID, SmsMessagesTableMap::COL_TOPIC_SELECTED, SmsMessagesTableMap::COL_RESPONSE, ),
        self::TYPE_FIELDNAME     => array('user_number', 'question', 'choises', 'prev_question', 'id', 'topic_Selected', 'response', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('UserNumber' => 0, 'Question' => 1, 'Choises' => 2, 'PrevQuestion' => 3, 'Id' => 4, 'TopicSelected' => 5, 'Response' => 6, ),
        self::TYPE_CAMELNAME     => array('userNumber' => 0, 'question' => 1, 'choises' => 2, 'prevQuestion' => 3, 'id' => 4, 'topicSelected' => 5, 'response' => 6, ),
        self::TYPE_COLNAME       => array(SmsMessagesTableMap::COL_USER_NUMBER => 0, SmsMessagesTableMap::COL_QUESTION => 1, SmsMessagesTableMap::COL_CHOISES => 2, SmsMessagesTableMap::COL_PREV_QUESTION => 3, SmsMessagesTableMap::COL_ID => 4, SmsMessagesTableMap::COL_TOPIC_SELECTED => 5, SmsMessagesTableMap::COL_RESPONSE => 6, ),
        self::TYPE_FIELDNAME     => array('user_number' => 0, 'question' => 1, 'choises' => 2, 'prev_question' => 3, 'id' => 4, 'topic_Selected' => 5, 'response' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('sms_messages');
        $this->setPhpName('SmsMessages');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SmsMessages');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addForeignKey('user_number', 'UserNumber', 'VARCHAR', 'sms_user', 'number', false, 100, null);
        $this->addColumn('question', 'Question', 'VARCHAR', false, 500, null);
        $this->addColumn('choises', 'Choises', 'VARCHAR', false, 45, null);
        $this->addColumn('prev_question', 'PrevQuestion', 'VARCHAR', false, 45, null);
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('topic_Selected', 'TopicSelected', 'VARCHAR', false, 45, null);
        $this->addColumn('response', 'Response', 'VARCHAR', false, 45, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SmsUser', '\\SmsUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_number',
    1 => ':number',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 4 + $offset
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
        return $withPrefix ? SmsMessagesTableMap::CLASS_DEFAULT : SmsMessagesTableMap::OM_CLASS;
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
     * @return array           (SmsMessages object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SmsMessagesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SmsMessagesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SmsMessagesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SmsMessagesTableMap::OM_CLASS;
            /** @var SmsMessages $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SmsMessagesTableMap::addInstanceToPool($obj, $key);
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
            $key = SmsMessagesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SmsMessagesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SmsMessages $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SmsMessagesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SmsMessagesTableMap::COL_USER_NUMBER);
            $criteria->addSelectColumn(SmsMessagesTableMap::COL_QUESTION);
            $criteria->addSelectColumn(SmsMessagesTableMap::COL_CHOISES);
            $criteria->addSelectColumn(SmsMessagesTableMap::COL_PREV_QUESTION);
            $criteria->addSelectColumn(SmsMessagesTableMap::COL_ID);
            $criteria->addSelectColumn(SmsMessagesTableMap::COL_TOPIC_SELECTED);
            $criteria->addSelectColumn(SmsMessagesTableMap::COL_RESPONSE);
        } else {
            $criteria->addSelectColumn($alias . '.user_number');
            $criteria->addSelectColumn($alias . '.question');
            $criteria->addSelectColumn($alias . '.choises');
            $criteria->addSelectColumn($alias . '.prev_question');
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.topic_Selected');
            $criteria->addSelectColumn($alias . '.response');
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
        return Propel::getServiceContainer()->getDatabaseMap(SmsMessagesTableMap::DATABASE_NAME)->getTable(SmsMessagesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SmsMessagesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SmsMessagesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SmsMessagesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SmsMessages or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SmsMessages object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SmsMessagesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SmsMessages) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SmsMessagesTableMap::DATABASE_NAME);
            $criteria->add(SmsMessagesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SmsMessagesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SmsMessagesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SmsMessagesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sms_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SmsMessagesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SmsMessages or Criteria object.
     *
     * @param mixed               $criteria Criteria or SmsMessages object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SmsMessagesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SmsMessages object
        }

        if ($criteria->containsKey(SmsMessagesTableMap::COL_ID) && $criteria->keyContainsValue(SmsMessagesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SmsMessagesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SmsMessagesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SmsMessagesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SmsMessagesTableMap::buildTableMap();
