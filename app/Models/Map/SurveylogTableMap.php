<?php

namespace Map;

use \Surveylog;
use \SurveylogQuery;
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
 * This class defines the structure of the 'SurveyLog' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SurveylogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SurveylogTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'SurveyLog';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Surveylog';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Surveylog';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 37;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 37;

    /**
     * the column name for the id field
     */
    const COL_ID = 'SurveyLog.id';

    /**
     * the column name for the patient_id field
     */
    const COL_PATIENT_ID = 'SurveyLog.patient_id';

    /**
     * the column name for the Q1 field
     */
    const COL_Q1 = 'SurveyLog.Q1';

    /**
     * the column name for the Q2 field
     */
    const COL_Q2 = 'SurveyLog.Q2';

    /**
     * the column name for the Q3 field
     */
    const COL_Q3 = 'SurveyLog.Q3';

    /**
     * the column name for the Q4 field
     */
    const COL_Q4 = 'SurveyLog.Q4';

    /**
     * the column name for the Q5 field
     */
    const COL_Q5 = 'SurveyLog.Q5';

    /**
     * the column name for the Q6 field
     */
    const COL_Q6 = 'SurveyLog.Q6';

    /**
     * the column name for the Q7 field
     */
    const COL_Q7 = 'SurveyLog.Q7';

    /**
     * the column name for the Q8 field
     */
    const COL_Q8 = 'SurveyLog.Q8';

    /**
     * the column name for the Q9 field
     */
    const COL_Q9 = 'SurveyLog.Q9';

    /**
     * the column name for the Q10 field
     */
    const COL_Q10 = 'SurveyLog.Q10';

    /**
     * the column name for the Q11 field
     */
    const COL_Q11 = 'SurveyLog.Q11';

    /**
     * the column name for the Q12 field
     */
    const COL_Q12 = 'SurveyLog.Q12';

    /**
     * the column name for the Q13 field
     */
    const COL_Q13 = 'SurveyLog.Q13';

    /**
     * the column name for the Q14 field
     */
    const COL_Q14 = 'SurveyLog.Q14';

    /**
     * the column name for the Q15 field
     */
    const COL_Q15 = 'SurveyLog.Q15';

    /**
     * the column name for the Q16 field
     */
    const COL_Q16 = 'SurveyLog.Q16';

    /**
     * the column name for the Q17 field
     */
    const COL_Q17 = 'SurveyLog.Q17';

    /**
     * the column name for the Q18 field
     */
    const COL_Q18 = 'SurveyLog.Q18';

    /**
     * the column name for the Q19 field
     */
    const COL_Q19 = 'SurveyLog.Q19';

    /**
     * the column name for the Q20 field
     */
    const COL_Q20 = 'SurveyLog.Q20';

    /**
     * the column name for the Q21 field
     */
    const COL_Q21 = 'SurveyLog.Q21';

    /**
     * the column name for the Q22 field
     */
    const COL_Q22 = 'SurveyLog.Q22';

    /**
     * the column name for the Q23 field
     */
    const COL_Q23 = 'SurveyLog.Q23';

    /**
     * the column name for the Q24 field
     */
    const COL_Q24 = 'SurveyLog.Q24';

    /**
     * the column name for the Q25 field
     */
    const COL_Q25 = 'SurveyLog.Q25';

    /**
     * the column name for the Q26 field
     */
    const COL_Q26 = 'SurveyLog.Q26';

    /**
     * the column name for the Q27 field
     */
    const COL_Q27 = 'SurveyLog.Q27';

    /**
     * the column name for the Q28 field
     */
    const COL_Q28 = 'SurveyLog.Q28';

    /**
     * the column name for the Q29 field
     */
    const COL_Q29 = 'SurveyLog.Q29';

    /**
     * the column name for the Q30 field
     */
    const COL_Q30 = 'SurveyLog.Q30';

    /**
     * the column name for the Q31 field
     */
    const COL_Q31 = 'SurveyLog.Q31';

    /**
     * the column name for the Q32 field
     */
    const COL_Q32 = 'SurveyLog.Q32';

    /**
     * the column name for the Q33 field
     */
    const COL_Q33 = 'SurveyLog.Q33';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'SurveyLog.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'SurveyLog.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'PatientId', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Q10', 'Q11', 'Q12', 'Q13', 'Q14', 'Q15', 'Q16', 'Q17', 'Q18', 'Q19', 'Q20', 'Q21', 'Q22', 'Q23', 'Q24', 'Q25', 'Q26', 'Q27', 'Q28', 'Q29', 'Q30', 'Q31', 'Q32', 'Q33', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'patientId', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'q13', 'q14', 'q15', 'q16', 'q17', 'q18', 'q19', 'q20', 'q21', 'q22', 'q23', 'q24', 'q25', 'q26', 'q27', 'q28', 'q29', 'q30', 'q31', 'q32', 'q33', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(SurveylogTableMap::COL_ID, SurveylogTableMap::COL_PATIENT_ID, SurveylogTableMap::COL_Q1, SurveylogTableMap::COL_Q2, SurveylogTableMap::COL_Q3, SurveylogTableMap::COL_Q4, SurveylogTableMap::COL_Q5, SurveylogTableMap::COL_Q6, SurveylogTableMap::COL_Q7, SurveylogTableMap::COL_Q8, SurveylogTableMap::COL_Q9, SurveylogTableMap::COL_Q10, SurveylogTableMap::COL_Q11, SurveylogTableMap::COL_Q12, SurveylogTableMap::COL_Q13, SurveylogTableMap::COL_Q14, SurveylogTableMap::COL_Q15, SurveylogTableMap::COL_Q16, SurveylogTableMap::COL_Q17, SurveylogTableMap::COL_Q18, SurveylogTableMap::COL_Q19, SurveylogTableMap::COL_Q20, SurveylogTableMap::COL_Q21, SurveylogTableMap::COL_Q22, SurveylogTableMap::COL_Q23, SurveylogTableMap::COL_Q24, SurveylogTableMap::COL_Q25, SurveylogTableMap::COL_Q26, SurveylogTableMap::COL_Q27, SurveylogTableMap::COL_Q28, SurveylogTableMap::COL_Q29, SurveylogTableMap::COL_Q30, SurveylogTableMap::COL_Q31, SurveylogTableMap::COL_Q32, SurveylogTableMap::COL_Q33, SurveylogTableMap::COL_CREATED_AT, SurveylogTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'patient_id', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Q10', 'Q11', 'Q12', 'Q13', 'Q14', 'Q15', 'Q16', 'Q17', 'Q18', 'Q19', 'Q20', 'Q21', 'Q22', 'Q23', 'Q24', 'Q25', 'Q26', 'Q27', 'Q28', 'Q29', 'Q30', 'Q31', 'Q32', 'Q33', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'PatientId' => 1, 'Q1' => 2, 'Q2' => 3, 'Q3' => 4, 'Q4' => 5, 'Q5' => 6, 'Q6' => 7, 'Q7' => 8, 'Q8' => 9, 'Q9' => 10, 'Q10' => 11, 'Q11' => 12, 'Q12' => 13, 'Q13' => 14, 'Q14' => 15, 'Q15' => 16, 'Q16' => 17, 'Q17' => 18, 'Q18' => 19, 'Q19' => 20, 'Q20' => 21, 'Q21' => 22, 'Q22' => 23, 'Q23' => 24, 'Q24' => 25, 'Q25' => 26, 'Q26' => 27, 'Q27' => 28, 'Q28' => 29, 'Q29' => 30, 'Q30' => 31, 'Q31' => 32, 'Q32' => 33, 'Q33' => 34, 'CreatedAt' => 35, 'UpdatedAt' => 36, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'patientId' => 1, 'q1' => 2, 'q2' => 3, 'q3' => 4, 'q4' => 5, 'q5' => 6, 'q6' => 7, 'q7' => 8, 'q8' => 9, 'q9' => 10, 'q10' => 11, 'q11' => 12, 'q12' => 13, 'q13' => 14, 'q14' => 15, 'q15' => 16, 'q16' => 17, 'q17' => 18, 'q18' => 19, 'q19' => 20, 'q20' => 21, 'q21' => 22, 'q22' => 23, 'q23' => 24, 'q24' => 25, 'q25' => 26, 'q26' => 27, 'q27' => 28, 'q28' => 29, 'q29' => 30, 'q30' => 31, 'q31' => 32, 'q32' => 33, 'q33' => 34, 'createdAt' => 35, 'updatedAt' => 36, ),
        self::TYPE_COLNAME       => array(SurveylogTableMap::COL_ID => 0, SurveylogTableMap::COL_PATIENT_ID => 1, SurveylogTableMap::COL_Q1 => 2, SurveylogTableMap::COL_Q2 => 3, SurveylogTableMap::COL_Q3 => 4, SurveylogTableMap::COL_Q4 => 5, SurveylogTableMap::COL_Q5 => 6, SurveylogTableMap::COL_Q6 => 7, SurveylogTableMap::COL_Q7 => 8, SurveylogTableMap::COL_Q8 => 9, SurveylogTableMap::COL_Q9 => 10, SurveylogTableMap::COL_Q10 => 11, SurveylogTableMap::COL_Q11 => 12, SurveylogTableMap::COL_Q12 => 13, SurveylogTableMap::COL_Q13 => 14, SurveylogTableMap::COL_Q14 => 15, SurveylogTableMap::COL_Q15 => 16, SurveylogTableMap::COL_Q16 => 17, SurveylogTableMap::COL_Q17 => 18, SurveylogTableMap::COL_Q18 => 19, SurveylogTableMap::COL_Q19 => 20, SurveylogTableMap::COL_Q20 => 21, SurveylogTableMap::COL_Q21 => 22, SurveylogTableMap::COL_Q22 => 23, SurveylogTableMap::COL_Q23 => 24, SurveylogTableMap::COL_Q24 => 25, SurveylogTableMap::COL_Q25 => 26, SurveylogTableMap::COL_Q26 => 27, SurveylogTableMap::COL_Q27 => 28, SurveylogTableMap::COL_Q28 => 29, SurveylogTableMap::COL_Q29 => 30, SurveylogTableMap::COL_Q30 => 31, SurveylogTableMap::COL_Q31 => 32, SurveylogTableMap::COL_Q32 => 33, SurveylogTableMap::COL_Q33 => 34, SurveylogTableMap::COL_CREATED_AT => 35, SurveylogTableMap::COL_UPDATED_AT => 36, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'patient_id' => 1, 'Q1' => 2, 'Q2' => 3, 'Q3' => 4, 'Q4' => 5, 'Q5' => 6, 'Q6' => 7, 'Q7' => 8, 'Q8' => 9, 'Q9' => 10, 'Q10' => 11, 'Q11' => 12, 'Q12' => 13, 'Q13' => 14, 'Q14' => 15, 'Q15' => 16, 'Q16' => 17, 'Q17' => 18, 'Q18' => 19, 'Q19' => 20, 'Q20' => 21, 'Q21' => 22, 'Q22' => 23, 'Q23' => 24, 'Q24' => 25, 'Q25' => 26, 'Q26' => 27, 'Q27' => 28, 'Q28' => 29, 'Q29' => 30, 'Q30' => 31, 'Q31' => 32, 'Q32' => 33, 'Q33' => 34, 'created_at' => 35, 'updated_at' => 36, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, )
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
        $this->setName('SurveyLog');
        $this->setPhpName('Surveylog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Surveylog');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 5, null);
        $this->addForeignKey('patient_id', 'PatientId', 'INTEGER', 'NewUser', 'id', true, null, null);
        $this->addColumn('Q1', 'Q1', 'VARCHAR', false, 255, null);
        $this->addColumn('Q2', 'Q2', 'VARCHAR', false, 255, null);
        $this->addColumn('Q3', 'Q3', 'VARCHAR', false, 255, null);
        $this->addColumn('Q4', 'Q4', 'VARCHAR', false, 255, null);
        $this->addColumn('Q5', 'Q5', 'VARCHAR', false, 255, null);
        $this->addColumn('Q6', 'Q6', 'VARCHAR', false, 255, null);
        $this->addColumn('Q7', 'Q7', 'VARCHAR', false, 255, null);
        $this->addColumn('Q8', 'Q8', 'VARCHAR', false, 255, null);
        $this->addColumn('Q9', 'Q9', 'VARCHAR', false, 255, null);
        $this->addColumn('Q10', 'Q10', 'VARCHAR', false, 255, null);
        $this->addColumn('Q11', 'Q11', 'VARCHAR', false, 255, null);
        $this->addColumn('Q12', 'Q12', 'VARCHAR', false, 255, null);
        $this->addColumn('Q13', 'Q13', 'VARCHAR', false, 255, null);
        $this->addColumn('Q14', 'Q14', 'VARCHAR', false, 255, null);
        $this->addColumn('Q15', 'Q15', 'VARCHAR', false, 255, null);
        $this->addColumn('Q16', 'Q16', 'VARCHAR', false, 255, null);
        $this->addColumn('Q17', 'Q17', 'VARCHAR', false, 255, null);
        $this->addColumn('Q18', 'Q18', 'VARCHAR', false, 255, null);
        $this->addColumn('Q19', 'Q19', 'VARCHAR', false, 255, null);
        $this->addColumn('Q20', 'Q20', 'VARCHAR', false, 255, null);
        $this->addColumn('Q21', 'Q21', 'VARCHAR', false, 255, null);
        $this->addColumn('Q22', 'Q22', 'VARCHAR', false, 255, null);
        $this->addColumn('Q23', 'Q23', 'VARCHAR', false, 255, null);
        $this->addColumn('Q24', 'Q24', 'VARCHAR', false, 255, null);
        $this->addColumn('Q25', 'Q25', 'VARCHAR', false, 255, null);
        $this->addColumn('Q26', 'Q26', 'VARCHAR', false, 255, null);
        $this->addColumn('Q27', 'Q27', 'VARCHAR', false, 255, null);
        $this->addColumn('Q28', 'Q28', 'VARCHAR', false, 255, null);
        $this->addColumn('Q29', 'Q29', 'VARCHAR', false, 255, null);
        $this->addColumn('Q30', 'Q30', 'VARCHAR', false, 255, null);
        $this->addColumn('Q31', 'Q31', 'VARCHAR', false, 255, null);
        $this->addColumn('Q32', 'Q32', 'VARCHAR', false, 255, null);
        $this->addColumn('Q33', 'Q33', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Newuser', '\\Newuser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':patient_id',
    1 => ':id',
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
        return $withPrefix ? SurveylogTableMap::CLASS_DEFAULT : SurveylogTableMap::OM_CLASS;
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
     * @return array           (Surveylog object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SurveylogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SurveylogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SurveylogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SurveylogTableMap::OM_CLASS;
            /** @var Surveylog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SurveylogTableMap::addInstanceToPool($obj, $key);
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
            $key = SurveylogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SurveylogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Surveylog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SurveylogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SurveylogTableMap::COL_ID);
            $criteria->addSelectColumn(SurveylogTableMap::COL_PATIENT_ID);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q1);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q2);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q3);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q4);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q5);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q6);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q7);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q8);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q9);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q10);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q11);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q12);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q13);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q14);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q15);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q16);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q17);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q18);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q19);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q20);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q21);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q22);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q23);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q24);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q25);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q26);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q27);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q28);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q29);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q30);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q31);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q32);
            $criteria->addSelectColumn(SurveylogTableMap::COL_Q33);
            $criteria->addSelectColumn(SurveylogTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SurveylogTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.patient_id');
            $criteria->addSelectColumn($alias . '.Q1');
            $criteria->addSelectColumn($alias . '.Q2');
            $criteria->addSelectColumn($alias . '.Q3');
            $criteria->addSelectColumn($alias . '.Q4');
            $criteria->addSelectColumn($alias . '.Q5');
            $criteria->addSelectColumn($alias . '.Q6');
            $criteria->addSelectColumn($alias . '.Q7');
            $criteria->addSelectColumn($alias . '.Q8');
            $criteria->addSelectColumn($alias . '.Q9');
            $criteria->addSelectColumn($alias . '.Q10');
            $criteria->addSelectColumn($alias . '.Q11');
            $criteria->addSelectColumn($alias . '.Q12');
            $criteria->addSelectColumn($alias . '.Q13');
            $criteria->addSelectColumn($alias . '.Q14');
            $criteria->addSelectColumn($alias . '.Q15');
            $criteria->addSelectColumn($alias . '.Q16');
            $criteria->addSelectColumn($alias . '.Q17');
            $criteria->addSelectColumn($alias . '.Q18');
            $criteria->addSelectColumn($alias . '.Q19');
            $criteria->addSelectColumn($alias . '.Q20');
            $criteria->addSelectColumn($alias . '.Q21');
            $criteria->addSelectColumn($alias . '.Q22');
            $criteria->addSelectColumn($alias . '.Q23');
            $criteria->addSelectColumn($alias . '.Q24');
            $criteria->addSelectColumn($alias . '.Q25');
            $criteria->addSelectColumn($alias . '.Q26');
            $criteria->addSelectColumn($alias . '.Q27');
            $criteria->addSelectColumn($alias . '.Q28');
            $criteria->addSelectColumn($alias . '.Q29');
            $criteria->addSelectColumn($alias . '.Q30');
            $criteria->addSelectColumn($alias . '.Q31');
            $criteria->addSelectColumn($alias . '.Q32');
            $criteria->addSelectColumn($alias . '.Q33');
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
        return Propel::getServiceContainer()->getDatabaseMap(SurveylogTableMap::DATABASE_NAME)->getTable(SurveylogTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SurveylogTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SurveylogTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SurveylogTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Surveylog or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Surveylog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveylogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Surveylog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SurveylogTableMap::DATABASE_NAME);
            $criteria->add(SurveylogTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SurveylogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SurveylogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SurveylogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the SurveyLog table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SurveylogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Surveylog or Criteria object.
     *
     * @param mixed               $criteria Criteria or Surveylog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveylogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Surveylog object
        }

        if ($criteria->containsKey(SurveylogTableMap::COL_ID) && $criteria->keyContainsValue(SurveylogTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SurveylogTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SurveylogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SurveylogTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SurveylogTableMap::buildTableMap();
