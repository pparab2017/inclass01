<?php

namespace Base;

use \Newuser as ChildNewuser;
use \NewuserQuery as ChildNewuserQuery;
use \SurveylogQuery as ChildSurveylogQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\SurveylogTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'SurveyLog' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Surveylog implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SurveylogTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the patient_id field.
     *
     * @var        int
     */
    protected $patient_id;

    /**
     * The value for the q1 field.
     *
     * @var        string
     */
    protected $q1;

    /**
     * The value for the q2 field.
     *
     * @var        string
     */
    protected $q2;

    /**
     * The value for the q3 field.
     *
     * @var        string
     */
    protected $q3;

    /**
     * The value for the q4 field.
     *
     * @var        string
     */
    protected $q4;

    /**
     * The value for the q5 field.
     *
     * @var        string
     */
    protected $q5;

    /**
     * The value for the q6 field.
     *
     * @var        string
     */
    protected $q6;

    /**
     * The value for the q7 field.
     *
     * @var        string
     */
    protected $q7;

    /**
     * The value for the q8 field.
     *
     * @var        string
     */
    protected $q8;

    /**
     * The value for the q9 field.
     *
     * @var        string
     */
    protected $q9;

    /**
     * The value for the q10 field.
     *
     * @var        string
     */
    protected $q10;

    /**
     * The value for the q11 field.
     *
     * @var        string
     */
    protected $q11;

    /**
     * The value for the q12 field.
     *
     * @var        string
     */
    protected $q12;

    /**
     * The value for the q13 field.
     *
     * @var        string
     */
    protected $q13;

    /**
     * The value for the q14 field.
     *
     * @var        string
     */
    protected $q14;

    /**
     * The value for the q15 field.
     *
     * @var        string
     */
    protected $q15;

    /**
     * The value for the q16 field.
     *
     * @var        string
     */
    protected $q16;

    /**
     * The value for the q17 field.
     *
     * @var        string
     */
    protected $q17;

    /**
     * The value for the q18 field.
     *
     * @var        string
     */
    protected $q18;

    /**
     * The value for the q19 field.
     *
     * @var        string
     */
    protected $q19;

    /**
     * The value for the q20 field.
     *
     * @var        string
     */
    protected $q20;

    /**
     * The value for the q21 field.
     *
     * @var        string
     */
    protected $q21;

    /**
     * The value for the q22 field.
     *
     * @var        string
     */
    protected $q22;

    /**
     * The value for the q23 field.
     *
     * @var        string
     */
    protected $q23;

    /**
     * The value for the q24 field.
     *
     * @var        string
     */
    protected $q24;

    /**
     * The value for the q25 field.
     *
     * @var        string
     */
    protected $q25;

    /**
     * The value for the q26 field.
     *
     * @var        string
     */
    protected $q26;

    /**
     * The value for the q27 field.
     *
     * @var        string
     */
    protected $q27;

    /**
     * The value for the q28 field.
     *
     * @var        string
     */
    protected $q28;

    /**
     * The value for the q29 field.
     *
     * @var        string
     */
    protected $q29;

    /**
     * The value for the q30 field.
     *
     * @var        string
     */
    protected $q30;

    /**
     * The value for the q31 field.
     *
     * @var        string
     */
    protected $q31;

    /**
     * The value for the q32 field.
     *
     * @var        string
     */
    protected $q32;

    /**
     * The value for the q33 field.
     *
     * @var        string
     */
    protected $q33;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * @var        ChildNewuser
     */
    protected $aNewuser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Surveylog object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Surveylog</code> instance.  If
     * <code>obj</code> is an instance of <code>Surveylog</code>, delegates to
     * <code>equals(Surveylog)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Surveylog The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [patient_id] column value.
     *
     * @return int
     */
    public function getPatientId()
    {
        return $this->patient_id;
    }

    /**
     * Get the [q1] column value.
     *
     * @return string
     */
    public function getQ1()
    {
        return $this->q1;
    }

    /**
     * Get the [q2] column value.
     *
     * @return string
     */
    public function getQ2()
    {
        return $this->q2;
    }

    /**
     * Get the [q3] column value.
     *
     * @return string
     */
    public function getQ3()
    {
        return $this->q3;
    }

    /**
     * Get the [q4] column value.
     *
     * @return string
     */
    public function getQ4()
    {
        return $this->q4;
    }

    /**
     * Get the [q5] column value.
     *
     * @return string
     */
    public function getQ5()
    {
        return $this->q5;
    }

    /**
     * Get the [q6] column value.
     *
     * @return string
     */
    public function getQ6()
    {
        return $this->q6;
    }

    /**
     * Get the [q7] column value.
     *
     * @return string
     */
    public function getQ7()
    {
        return $this->q7;
    }

    /**
     * Get the [q8] column value.
     *
     * @return string
     */
    public function getQ8()
    {
        return $this->q8;
    }

    /**
     * Get the [q9] column value.
     *
     * @return string
     */
    public function getQ9()
    {
        return $this->q9;
    }

    /**
     * Get the [q10] column value.
     *
     * @return string
     */
    public function getQ10()
    {
        return $this->q10;
    }

    /**
     * Get the [q11] column value.
     *
     * @return string
     */
    public function getQ11()
    {
        return $this->q11;
    }

    /**
     * Get the [q12] column value.
     *
     * @return string
     */
    public function getQ12()
    {
        return $this->q12;
    }

    /**
     * Get the [q13] column value.
     *
     * @return string
     */
    public function getQ13()
    {
        return $this->q13;
    }

    /**
     * Get the [q14] column value.
     *
     * @return string
     */
    public function getQ14()
    {
        return $this->q14;
    }

    /**
     * Get the [q15] column value.
     *
     * @return string
     */
    public function getQ15()
    {
        return $this->q15;
    }

    /**
     * Get the [q16] column value.
     *
     * @return string
     */
    public function getQ16()
    {
        return $this->q16;
    }

    /**
     * Get the [q17] column value.
     *
     * @return string
     */
    public function getQ17()
    {
        return $this->q17;
    }

    /**
     * Get the [q18] column value.
     *
     * @return string
     */
    public function getQ18()
    {
        return $this->q18;
    }

    /**
     * Get the [q19] column value.
     *
     * @return string
     */
    public function getQ19()
    {
        return $this->q19;
    }

    /**
     * Get the [q20] column value.
     *
     * @return string
     */
    public function getQ20()
    {
        return $this->q20;
    }

    /**
     * Get the [q21] column value.
     *
     * @return string
     */
    public function getQ21()
    {
        return $this->q21;
    }

    /**
     * Get the [q22] column value.
     *
     * @return string
     */
    public function getQ22()
    {
        return $this->q22;
    }

    /**
     * Get the [q23] column value.
     *
     * @return string
     */
    public function getQ23()
    {
        return $this->q23;
    }

    /**
     * Get the [q24] column value.
     *
     * @return string
     */
    public function getQ24()
    {
        return $this->q24;
    }

    /**
     * Get the [q25] column value.
     *
     * @return string
     */
    public function getQ25()
    {
        return $this->q25;
    }

    /**
     * Get the [q26] column value.
     *
     * @return string
     */
    public function getQ26()
    {
        return $this->q26;
    }

    /**
     * Get the [q27] column value.
     *
     * @return string
     */
    public function getQ27()
    {
        return $this->q27;
    }

    /**
     * Get the [q28] column value.
     *
     * @return string
     */
    public function getQ28()
    {
        return $this->q28;
    }

    /**
     * Get the [q29] column value.
     *
     * @return string
     */
    public function getQ29()
    {
        return $this->q29;
    }

    /**
     * Get the [q30] column value.
     *
     * @return string
     */
    public function getQ30()
    {
        return $this->q30;
    }

    /**
     * Get the [q31] column value.
     *
     * @return string
     */
    public function getQ31()
    {
        return $this->q31;
    }

    /**
     * Get the [q32] column value.
     *
     * @return string
     */
    public function getQ32()
    {
        return $this->q32;
    }

    /**
     * Get the [q33] column value.
     *
     * @return string
     */
    public function getQ33()
    {
        return $this->q33;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [patient_id] column.
     *
     * @param int $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setPatientId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->patient_id !== $v) {
            $this->patient_id = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_PATIENT_ID] = true;
        }

        if ($this->aNewuser !== null && $this->aNewuser->getId() !== $v) {
            $this->aNewuser = null;
        }

        return $this;
    } // setPatientId()

    /**
     * Set the value of [q1] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q1 !== $v) {
            $this->q1 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q1] = true;
        }

        return $this;
    } // setQ1()

    /**
     * Set the value of [q2] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q2 !== $v) {
            $this->q2 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q2] = true;
        }

        return $this;
    } // setQ2()

    /**
     * Set the value of [q3] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q3 !== $v) {
            $this->q3 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q3] = true;
        }

        return $this;
    } // setQ3()

    /**
     * Set the value of [q4] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q4 !== $v) {
            $this->q4 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q4] = true;
        }

        return $this;
    } // setQ4()

    /**
     * Set the value of [q5] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ5($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q5 !== $v) {
            $this->q5 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q5] = true;
        }

        return $this;
    } // setQ5()

    /**
     * Set the value of [q6] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ6($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q6 !== $v) {
            $this->q6 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q6] = true;
        }

        return $this;
    } // setQ6()

    /**
     * Set the value of [q7] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ7($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q7 !== $v) {
            $this->q7 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q7] = true;
        }

        return $this;
    } // setQ7()

    /**
     * Set the value of [q8] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ8($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q8 !== $v) {
            $this->q8 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q8] = true;
        }

        return $this;
    } // setQ8()

    /**
     * Set the value of [q9] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ9($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q9 !== $v) {
            $this->q9 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q9] = true;
        }

        return $this;
    } // setQ9()

    /**
     * Set the value of [q10] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ10($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q10 !== $v) {
            $this->q10 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q10] = true;
        }

        return $this;
    } // setQ10()

    /**
     * Set the value of [q11] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ11($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q11 !== $v) {
            $this->q11 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q11] = true;
        }

        return $this;
    } // setQ11()

    /**
     * Set the value of [q12] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ12($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q12 !== $v) {
            $this->q12 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q12] = true;
        }

        return $this;
    } // setQ12()

    /**
     * Set the value of [q13] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ13($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q13 !== $v) {
            $this->q13 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q13] = true;
        }

        return $this;
    } // setQ13()

    /**
     * Set the value of [q14] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ14($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q14 !== $v) {
            $this->q14 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q14] = true;
        }

        return $this;
    } // setQ14()

    /**
     * Set the value of [q15] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ15($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q15 !== $v) {
            $this->q15 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q15] = true;
        }

        return $this;
    } // setQ15()

    /**
     * Set the value of [q16] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ16($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q16 !== $v) {
            $this->q16 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q16] = true;
        }

        return $this;
    } // setQ16()

    /**
     * Set the value of [q17] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ17($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q17 !== $v) {
            $this->q17 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q17] = true;
        }

        return $this;
    } // setQ17()

    /**
     * Set the value of [q18] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ18($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q18 !== $v) {
            $this->q18 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q18] = true;
        }

        return $this;
    } // setQ18()

    /**
     * Set the value of [q19] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ19($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q19 !== $v) {
            $this->q19 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q19] = true;
        }

        return $this;
    } // setQ19()

    /**
     * Set the value of [q20] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ20($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q20 !== $v) {
            $this->q20 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q20] = true;
        }

        return $this;
    } // setQ20()

    /**
     * Set the value of [q21] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ21($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q21 !== $v) {
            $this->q21 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q21] = true;
        }

        return $this;
    } // setQ21()

    /**
     * Set the value of [q22] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ22($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q22 !== $v) {
            $this->q22 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q22] = true;
        }

        return $this;
    } // setQ22()

    /**
     * Set the value of [q23] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ23($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q23 !== $v) {
            $this->q23 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q23] = true;
        }

        return $this;
    } // setQ23()

    /**
     * Set the value of [q24] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ24($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q24 !== $v) {
            $this->q24 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q24] = true;
        }

        return $this;
    } // setQ24()

    /**
     * Set the value of [q25] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ25($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q25 !== $v) {
            $this->q25 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q25] = true;
        }

        return $this;
    } // setQ25()

    /**
     * Set the value of [q26] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ26($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q26 !== $v) {
            $this->q26 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q26] = true;
        }

        return $this;
    } // setQ26()

    /**
     * Set the value of [q27] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ27($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q27 !== $v) {
            $this->q27 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q27] = true;
        }

        return $this;
    } // setQ27()

    /**
     * Set the value of [q28] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ28($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q28 !== $v) {
            $this->q28 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q28] = true;
        }

        return $this;
    } // setQ28()

    /**
     * Set the value of [q29] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ29($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q29 !== $v) {
            $this->q29 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q29] = true;
        }

        return $this;
    } // setQ29()

    /**
     * Set the value of [q30] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ30($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q30 !== $v) {
            $this->q30 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q30] = true;
        }

        return $this;
    } // setQ30()

    /**
     * Set the value of [q31] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ31($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q31 !== $v) {
            $this->q31 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q31] = true;
        }

        return $this;
    } // setQ31()

    /**
     * Set the value of [q32] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ32($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q32 !== $v) {
            $this->q32 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q32] = true;
        }

        return $this;
    } // setQ32()

    /**
     * Set the value of [q33] column.
     *
     * @param string $v new value
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setQ33($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->q33 !== $v) {
            $this->q33 = $v;
            $this->modifiedColumns[SurveylogTableMap::COL_Q33] = true;
        }

        return $this;
    } // setQ33()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SurveylogTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Surveylog The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SurveylogTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SurveylogTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SurveylogTableMap::translateFieldName('PatientId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->patient_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SurveylogTableMap::translateFieldName('Q1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SurveylogTableMap::translateFieldName('Q2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SurveylogTableMap::translateFieldName('Q3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SurveylogTableMap::translateFieldName('Q4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q4 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SurveylogTableMap::translateFieldName('Q5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q5 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SurveylogTableMap::translateFieldName('Q6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q6 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SurveylogTableMap::translateFieldName('Q7', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q7 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SurveylogTableMap::translateFieldName('Q8', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q8 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SurveylogTableMap::translateFieldName('Q9', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q9 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SurveylogTableMap::translateFieldName('Q10', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q10 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SurveylogTableMap::translateFieldName('Q11', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q11 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SurveylogTableMap::translateFieldName('Q12', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q12 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SurveylogTableMap::translateFieldName('Q13', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q13 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SurveylogTableMap::translateFieldName('Q14', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q14 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SurveylogTableMap::translateFieldName('Q15', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q15 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SurveylogTableMap::translateFieldName('Q16', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q16 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SurveylogTableMap::translateFieldName('Q17', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q17 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SurveylogTableMap::translateFieldName('Q18', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q18 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SurveylogTableMap::translateFieldName('Q19', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q19 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SurveylogTableMap::translateFieldName('Q20', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q20 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SurveylogTableMap::translateFieldName('Q21', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q21 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : SurveylogTableMap::translateFieldName('Q22', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q22 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : SurveylogTableMap::translateFieldName('Q23', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q23 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : SurveylogTableMap::translateFieldName('Q24', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q24 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : SurveylogTableMap::translateFieldName('Q25', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q25 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : SurveylogTableMap::translateFieldName('Q26', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q26 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : SurveylogTableMap::translateFieldName('Q27', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q27 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : SurveylogTableMap::translateFieldName('Q28', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q28 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : SurveylogTableMap::translateFieldName('Q29', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q29 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : SurveylogTableMap::translateFieldName('Q30', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q30 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : SurveylogTableMap::translateFieldName('Q31', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q31 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : SurveylogTableMap::translateFieldName('Q32', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q32 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : SurveylogTableMap::translateFieldName('Q33', TableMap::TYPE_PHPNAME, $indexType)];
            $this->q33 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : SurveylogTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : SurveylogTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 37; // 37 = SurveylogTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Surveylog'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aNewuser !== null && $this->patient_id !== $this->aNewuser->getId()) {
            $this->aNewuser = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SurveylogTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSurveylogQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aNewuser = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Surveylog::setDeleted()
     * @see Surveylog::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveylogTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSurveylogQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveylogTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SurveylogTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aNewuser !== null) {
                if ($this->aNewuser->isModified() || $this->aNewuser->isNew()) {
                    $affectedRows += $this->aNewuser->save($con);
                }
                $this->setNewuser($this->aNewuser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[SurveylogTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SurveylogTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SurveylogTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_PATIENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'patient_id';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q1)) {
            $modifiedColumns[':p' . $index++]  = 'Q1';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q2)) {
            $modifiedColumns[':p' . $index++]  = 'Q2';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q3)) {
            $modifiedColumns[':p' . $index++]  = 'Q3';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q4)) {
            $modifiedColumns[':p' . $index++]  = 'Q4';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q5)) {
            $modifiedColumns[':p' . $index++]  = 'Q5';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q6)) {
            $modifiedColumns[':p' . $index++]  = 'Q6';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q7)) {
            $modifiedColumns[':p' . $index++]  = 'Q7';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q8)) {
            $modifiedColumns[':p' . $index++]  = 'Q8';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q9)) {
            $modifiedColumns[':p' . $index++]  = 'Q9';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q10)) {
            $modifiedColumns[':p' . $index++]  = 'Q10';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q11)) {
            $modifiedColumns[':p' . $index++]  = 'Q11';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q12)) {
            $modifiedColumns[':p' . $index++]  = 'Q12';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q13)) {
            $modifiedColumns[':p' . $index++]  = 'Q13';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q14)) {
            $modifiedColumns[':p' . $index++]  = 'Q14';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q15)) {
            $modifiedColumns[':p' . $index++]  = 'Q15';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q16)) {
            $modifiedColumns[':p' . $index++]  = 'Q16';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q17)) {
            $modifiedColumns[':p' . $index++]  = 'Q17';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q18)) {
            $modifiedColumns[':p' . $index++]  = 'Q18';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q19)) {
            $modifiedColumns[':p' . $index++]  = 'Q19';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q20)) {
            $modifiedColumns[':p' . $index++]  = 'Q20';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q21)) {
            $modifiedColumns[':p' . $index++]  = 'Q21';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q22)) {
            $modifiedColumns[':p' . $index++]  = 'Q22';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q23)) {
            $modifiedColumns[':p' . $index++]  = 'Q23';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q24)) {
            $modifiedColumns[':p' . $index++]  = 'Q24';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q25)) {
            $modifiedColumns[':p' . $index++]  = 'Q25';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q26)) {
            $modifiedColumns[':p' . $index++]  = 'Q26';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q27)) {
            $modifiedColumns[':p' . $index++]  = 'Q27';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q28)) {
            $modifiedColumns[':p' . $index++]  = 'Q28';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q29)) {
            $modifiedColumns[':p' . $index++]  = 'Q29';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q30)) {
            $modifiedColumns[':p' . $index++]  = 'Q30';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q31)) {
            $modifiedColumns[':p' . $index++]  = 'Q31';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q32)) {
            $modifiedColumns[':p' . $index++]  = 'Q32';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q33)) {
            $modifiedColumns[':p' . $index++]  = 'Q33';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO SurveyLog (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'patient_id':
                        $stmt->bindValue($identifier, $this->patient_id, PDO::PARAM_INT);
                        break;
                    case 'Q1':
                        $stmt->bindValue($identifier, $this->q1, PDO::PARAM_STR);
                        break;
                    case 'Q2':
                        $stmt->bindValue($identifier, $this->q2, PDO::PARAM_STR);
                        break;
                    case 'Q3':
                        $stmt->bindValue($identifier, $this->q3, PDO::PARAM_STR);
                        break;
                    case 'Q4':
                        $stmt->bindValue($identifier, $this->q4, PDO::PARAM_STR);
                        break;
                    case 'Q5':
                        $stmt->bindValue($identifier, $this->q5, PDO::PARAM_STR);
                        break;
                    case 'Q6':
                        $stmt->bindValue($identifier, $this->q6, PDO::PARAM_STR);
                        break;
                    case 'Q7':
                        $stmt->bindValue($identifier, $this->q7, PDO::PARAM_STR);
                        break;
                    case 'Q8':
                        $stmt->bindValue($identifier, $this->q8, PDO::PARAM_STR);
                        break;
                    case 'Q9':
                        $stmt->bindValue($identifier, $this->q9, PDO::PARAM_STR);
                        break;
                    case 'Q10':
                        $stmt->bindValue($identifier, $this->q10, PDO::PARAM_STR);
                        break;
                    case 'Q11':
                        $stmt->bindValue($identifier, $this->q11, PDO::PARAM_STR);
                        break;
                    case 'Q12':
                        $stmt->bindValue($identifier, $this->q12, PDO::PARAM_STR);
                        break;
                    case 'Q13':
                        $stmt->bindValue($identifier, $this->q13, PDO::PARAM_STR);
                        break;
                    case 'Q14':
                        $stmt->bindValue($identifier, $this->q14, PDO::PARAM_STR);
                        break;
                    case 'Q15':
                        $stmt->bindValue($identifier, $this->q15, PDO::PARAM_STR);
                        break;
                    case 'Q16':
                        $stmt->bindValue($identifier, $this->q16, PDO::PARAM_STR);
                        break;
                    case 'Q17':
                        $stmt->bindValue($identifier, $this->q17, PDO::PARAM_STR);
                        break;
                    case 'Q18':
                        $stmt->bindValue($identifier, $this->q18, PDO::PARAM_STR);
                        break;
                    case 'Q19':
                        $stmt->bindValue($identifier, $this->q19, PDO::PARAM_STR);
                        break;
                    case 'Q20':
                        $stmt->bindValue($identifier, $this->q20, PDO::PARAM_STR);
                        break;
                    case 'Q21':
                        $stmt->bindValue($identifier, $this->q21, PDO::PARAM_STR);
                        break;
                    case 'Q22':
                        $stmt->bindValue($identifier, $this->q22, PDO::PARAM_STR);
                        break;
                    case 'Q23':
                        $stmt->bindValue($identifier, $this->q23, PDO::PARAM_STR);
                        break;
                    case 'Q24':
                        $stmt->bindValue($identifier, $this->q24, PDO::PARAM_STR);
                        break;
                    case 'Q25':
                        $stmt->bindValue($identifier, $this->q25, PDO::PARAM_STR);
                        break;
                    case 'Q26':
                        $stmt->bindValue($identifier, $this->q26, PDO::PARAM_STR);
                        break;
                    case 'Q27':
                        $stmt->bindValue($identifier, $this->q27, PDO::PARAM_STR);
                        break;
                    case 'Q28':
                        $stmt->bindValue($identifier, $this->q28, PDO::PARAM_STR);
                        break;
                    case 'Q29':
                        $stmt->bindValue($identifier, $this->q29, PDO::PARAM_STR);
                        break;
                    case 'Q30':
                        $stmt->bindValue($identifier, $this->q30, PDO::PARAM_STR);
                        break;
                    case 'Q31':
                        $stmt->bindValue($identifier, $this->q31, PDO::PARAM_STR);
                        break;
                    case 'Q32':
                        $stmt->bindValue($identifier, $this->q32, PDO::PARAM_STR);
                        break;
                    case 'Q33':
                        $stmt->bindValue($identifier, $this->q33, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SurveylogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getPatientId();
                break;
            case 2:
                return $this->getQ1();
                break;
            case 3:
                return $this->getQ2();
                break;
            case 4:
                return $this->getQ3();
                break;
            case 5:
                return $this->getQ4();
                break;
            case 6:
                return $this->getQ5();
                break;
            case 7:
                return $this->getQ6();
                break;
            case 8:
                return $this->getQ7();
                break;
            case 9:
                return $this->getQ8();
                break;
            case 10:
                return $this->getQ9();
                break;
            case 11:
                return $this->getQ10();
                break;
            case 12:
                return $this->getQ11();
                break;
            case 13:
                return $this->getQ12();
                break;
            case 14:
                return $this->getQ13();
                break;
            case 15:
                return $this->getQ14();
                break;
            case 16:
                return $this->getQ15();
                break;
            case 17:
                return $this->getQ16();
                break;
            case 18:
                return $this->getQ17();
                break;
            case 19:
                return $this->getQ18();
                break;
            case 20:
                return $this->getQ19();
                break;
            case 21:
                return $this->getQ20();
                break;
            case 22:
                return $this->getQ21();
                break;
            case 23:
                return $this->getQ22();
                break;
            case 24:
                return $this->getQ23();
                break;
            case 25:
                return $this->getQ24();
                break;
            case 26:
                return $this->getQ25();
                break;
            case 27:
                return $this->getQ26();
                break;
            case 28:
                return $this->getQ27();
                break;
            case 29:
                return $this->getQ28();
                break;
            case 30:
                return $this->getQ29();
                break;
            case 31:
                return $this->getQ30();
                break;
            case 32:
                return $this->getQ31();
                break;
            case 33:
                return $this->getQ32();
                break;
            case 34:
                return $this->getQ33();
                break;
            case 35:
                return $this->getCreatedAt();
                break;
            case 36:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Surveylog'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Surveylog'][$this->hashCode()] = true;
        $keys = SurveylogTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPatientId(),
            $keys[2] => $this->getQ1(),
            $keys[3] => $this->getQ2(),
            $keys[4] => $this->getQ3(),
            $keys[5] => $this->getQ4(),
            $keys[6] => $this->getQ5(),
            $keys[7] => $this->getQ6(),
            $keys[8] => $this->getQ7(),
            $keys[9] => $this->getQ8(),
            $keys[10] => $this->getQ9(),
            $keys[11] => $this->getQ10(),
            $keys[12] => $this->getQ11(),
            $keys[13] => $this->getQ12(),
            $keys[14] => $this->getQ13(),
            $keys[15] => $this->getQ14(),
            $keys[16] => $this->getQ15(),
            $keys[17] => $this->getQ16(),
            $keys[18] => $this->getQ17(),
            $keys[19] => $this->getQ18(),
            $keys[20] => $this->getQ19(),
            $keys[21] => $this->getQ20(),
            $keys[22] => $this->getQ21(),
            $keys[23] => $this->getQ22(),
            $keys[24] => $this->getQ23(),
            $keys[25] => $this->getQ24(),
            $keys[26] => $this->getQ25(),
            $keys[27] => $this->getQ26(),
            $keys[28] => $this->getQ27(),
            $keys[29] => $this->getQ28(),
            $keys[30] => $this->getQ29(),
            $keys[31] => $this->getQ30(),
            $keys[32] => $this->getQ31(),
            $keys[33] => $this->getQ32(),
            $keys[34] => $this->getQ33(),
            $keys[35] => $this->getCreatedAt(),
            $keys[36] => $this->getUpdatedAt(),
        );
        if ($result[$keys[35]] instanceof \DateTime) {
            $result[$keys[35]] = $result[$keys[35]]->format('c');
        }

        if ($result[$keys[36]] instanceof \DateTime) {
            $result[$keys[36]] = $result[$keys[36]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aNewuser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'newuser';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'NewUser';
                        break;
                    default:
                        $key = 'Newuser';
                }

                $result[$key] = $this->aNewuser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Surveylog
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SurveylogTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Surveylog
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPatientId($value);
                break;
            case 2:
                $this->setQ1($value);
                break;
            case 3:
                $this->setQ2($value);
                break;
            case 4:
                $this->setQ3($value);
                break;
            case 5:
                $this->setQ4($value);
                break;
            case 6:
                $this->setQ5($value);
                break;
            case 7:
                $this->setQ6($value);
                break;
            case 8:
                $this->setQ7($value);
                break;
            case 9:
                $this->setQ8($value);
                break;
            case 10:
                $this->setQ9($value);
                break;
            case 11:
                $this->setQ10($value);
                break;
            case 12:
                $this->setQ11($value);
                break;
            case 13:
                $this->setQ12($value);
                break;
            case 14:
                $this->setQ13($value);
                break;
            case 15:
                $this->setQ14($value);
                break;
            case 16:
                $this->setQ15($value);
                break;
            case 17:
                $this->setQ16($value);
                break;
            case 18:
                $this->setQ17($value);
                break;
            case 19:
                $this->setQ18($value);
                break;
            case 20:
                $this->setQ19($value);
                break;
            case 21:
                $this->setQ20($value);
                break;
            case 22:
                $this->setQ21($value);
                break;
            case 23:
                $this->setQ22($value);
                break;
            case 24:
                $this->setQ23($value);
                break;
            case 25:
                $this->setQ24($value);
                break;
            case 26:
                $this->setQ25($value);
                break;
            case 27:
                $this->setQ26($value);
                break;
            case 28:
                $this->setQ27($value);
                break;
            case 29:
                $this->setQ28($value);
                break;
            case 30:
                $this->setQ29($value);
                break;
            case 31:
                $this->setQ30($value);
                break;
            case 32:
                $this->setQ31($value);
                break;
            case 33:
                $this->setQ32($value);
                break;
            case 34:
                $this->setQ33($value);
                break;
            case 35:
                $this->setCreatedAt($value);
                break;
            case 36:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = SurveylogTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPatientId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setQ1($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setQ2($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setQ3($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setQ4($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setQ5($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setQ6($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setQ7($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setQ8($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setQ9($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setQ10($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setQ11($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setQ12($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setQ13($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setQ14($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setQ15($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setQ16($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setQ17($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setQ18($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setQ19($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setQ20($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setQ21($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setQ22($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setQ23($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setQ24($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setQ25($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setQ26($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setQ27($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setQ28($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setQ29($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setQ30($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setQ31($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setQ32($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setQ33($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setCreatedAt($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setUpdatedAt($arr[$keys[36]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Surveylog The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SurveylogTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SurveylogTableMap::COL_ID)) {
            $criteria->add(SurveylogTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_PATIENT_ID)) {
            $criteria->add(SurveylogTableMap::COL_PATIENT_ID, $this->patient_id);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q1)) {
            $criteria->add(SurveylogTableMap::COL_Q1, $this->q1);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q2)) {
            $criteria->add(SurveylogTableMap::COL_Q2, $this->q2);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q3)) {
            $criteria->add(SurveylogTableMap::COL_Q3, $this->q3);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q4)) {
            $criteria->add(SurveylogTableMap::COL_Q4, $this->q4);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q5)) {
            $criteria->add(SurveylogTableMap::COL_Q5, $this->q5);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q6)) {
            $criteria->add(SurveylogTableMap::COL_Q6, $this->q6);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q7)) {
            $criteria->add(SurveylogTableMap::COL_Q7, $this->q7);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q8)) {
            $criteria->add(SurveylogTableMap::COL_Q8, $this->q8);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q9)) {
            $criteria->add(SurveylogTableMap::COL_Q9, $this->q9);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q10)) {
            $criteria->add(SurveylogTableMap::COL_Q10, $this->q10);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q11)) {
            $criteria->add(SurveylogTableMap::COL_Q11, $this->q11);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q12)) {
            $criteria->add(SurveylogTableMap::COL_Q12, $this->q12);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q13)) {
            $criteria->add(SurveylogTableMap::COL_Q13, $this->q13);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q14)) {
            $criteria->add(SurveylogTableMap::COL_Q14, $this->q14);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q15)) {
            $criteria->add(SurveylogTableMap::COL_Q15, $this->q15);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q16)) {
            $criteria->add(SurveylogTableMap::COL_Q16, $this->q16);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q17)) {
            $criteria->add(SurveylogTableMap::COL_Q17, $this->q17);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q18)) {
            $criteria->add(SurveylogTableMap::COL_Q18, $this->q18);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q19)) {
            $criteria->add(SurveylogTableMap::COL_Q19, $this->q19);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q20)) {
            $criteria->add(SurveylogTableMap::COL_Q20, $this->q20);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q21)) {
            $criteria->add(SurveylogTableMap::COL_Q21, $this->q21);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q22)) {
            $criteria->add(SurveylogTableMap::COL_Q22, $this->q22);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q23)) {
            $criteria->add(SurveylogTableMap::COL_Q23, $this->q23);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q24)) {
            $criteria->add(SurveylogTableMap::COL_Q24, $this->q24);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q25)) {
            $criteria->add(SurveylogTableMap::COL_Q25, $this->q25);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q26)) {
            $criteria->add(SurveylogTableMap::COL_Q26, $this->q26);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q27)) {
            $criteria->add(SurveylogTableMap::COL_Q27, $this->q27);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q28)) {
            $criteria->add(SurveylogTableMap::COL_Q28, $this->q28);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q29)) {
            $criteria->add(SurveylogTableMap::COL_Q29, $this->q29);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q30)) {
            $criteria->add(SurveylogTableMap::COL_Q30, $this->q30);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q31)) {
            $criteria->add(SurveylogTableMap::COL_Q31, $this->q31);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q32)) {
            $criteria->add(SurveylogTableMap::COL_Q32, $this->q32);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_Q33)) {
            $criteria->add(SurveylogTableMap::COL_Q33, $this->q33);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_CREATED_AT)) {
            $criteria->add(SurveylogTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SurveylogTableMap::COL_UPDATED_AT)) {
            $criteria->add(SurveylogTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildSurveylogQuery::create();
        $criteria->add(SurveylogTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Surveylog (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPatientId($this->getPatientId());
        $copyObj->setQ1($this->getQ1());
        $copyObj->setQ2($this->getQ2());
        $copyObj->setQ3($this->getQ3());
        $copyObj->setQ4($this->getQ4());
        $copyObj->setQ5($this->getQ5());
        $copyObj->setQ6($this->getQ6());
        $copyObj->setQ7($this->getQ7());
        $copyObj->setQ8($this->getQ8());
        $copyObj->setQ9($this->getQ9());
        $copyObj->setQ10($this->getQ10());
        $copyObj->setQ11($this->getQ11());
        $copyObj->setQ12($this->getQ12());
        $copyObj->setQ13($this->getQ13());
        $copyObj->setQ14($this->getQ14());
        $copyObj->setQ15($this->getQ15());
        $copyObj->setQ16($this->getQ16());
        $copyObj->setQ17($this->getQ17());
        $copyObj->setQ18($this->getQ18());
        $copyObj->setQ19($this->getQ19());
        $copyObj->setQ20($this->getQ20());
        $copyObj->setQ21($this->getQ21());
        $copyObj->setQ22($this->getQ22());
        $copyObj->setQ23($this->getQ23());
        $copyObj->setQ24($this->getQ24());
        $copyObj->setQ25($this->getQ25());
        $copyObj->setQ26($this->getQ26());
        $copyObj->setQ27($this->getQ27());
        $copyObj->setQ28($this->getQ28());
        $copyObj->setQ29($this->getQ29());
        $copyObj->setQ30($this->getQ30());
        $copyObj->setQ31($this->getQ31());
        $copyObj->setQ32($this->getQ32());
        $copyObj->setQ33($this->getQ33());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Surveylog Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildNewuser object.
     *
     * @param  ChildNewuser $v
     * @return $this|\Surveylog The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNewuser(ChildNewuser $v = null)
    {
        if ($v === null) {
            $this->setPatientId(NULL);
        } else {
            $this->setPatientId($v->getId());
        }

        $this->aNewuser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildNewuser object, it will not be re-added.
        if ($v !== null) {
            $v->addSurveylog($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildNewuser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildNewuser The associated ChildNewuser object.
     * @throws PropelException
     */
    public function getNewuser(ConnectionInterface $con = null)
    {
        if ($this->aNewuser === null && ($this->patient_id !== null)) {
            $this->aNewuser = ChildNewuserQuery::create()->findPk($this->patient_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNewuser->addSurveylogs($this);
             */
        }

        return $this->aNewuser;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aNewuser) {
            $this->aNewuser->removeSurveylog($this);
        }
        $this->id = null;
        $this->patient_id = null;
        $this->q1 = null;
        $this->q2 = null;
        $this->q3 = null;
        $this->q4 = null;
        $this->q5 = null;
        $this->q6 = null;
        $this->q7 = null;
        $this->q8 = null;
        $this->q9 = null;
        $this->q10 = null;
        $this->q11 = null;
        $this->q12 = null;
        $this->q13 = null;
        $this->q14 = null;
        $this->q15 = null;
        $this->q16 = null;
        $this->q17 = null;
        $this->q18 = null;
        $this->q19 = null;
        $this->q20 = null;
        $this->q21 = null;
        $this->q22 = null;
        $this->q23 = null;
        $this->q24 = null;
        $this->q25 = null;
        $this->q26 = null;
        $this->q27 = null;
        $this->q28 = null;
        $this->q29 = null;
        $this->q30 = null;
        $this->q31 = null;
        $this->q32 = null;
        $this->q33 = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aNewuser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SurveylogTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
