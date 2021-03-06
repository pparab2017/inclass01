<?php

namespace Base;

use \Devicetokens as ChildDevicetokens;
use \DevicetokensQuery as ChildDevicetokensQuery;
use \Newuser as ChildNewuser;
use \NewuserQuery as ChildNewuserQuery;
use \Patient as ChildPatient;
use \PatientQuery as ChildPatientQuery;
use \Questions as ChildQuestions;
use \QuestionsQuery as ChildQuestionsQuery;
use \Studyresponse as ChildStudyresponse;
use \StudyresponseQuery as ChildStudyresponseQuery;
use \Surveylog as ChildSurveylog;
use \SurveylogQuery as ChildSurveylogQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\DevicetokensTableMap;
use Map\NewuserTableMap;
use Map\PatientTableMap;
use Map\QuestionsTableMap;
use Map\StudyresponseTableMap;
use Map\SurveylogTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'NewUser' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Newuser implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\NewuserTableMap';


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
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the hash field.
     *
     * @var        string
     */
    protected $hash;

    /**
     * The value for the fname field.
     *
     * @var        string
     */
    protected $fname;

    /**
     * The value for the lname field.
     *
     * @var        string
     */
    protected $lname;

    /**
     * The value for the gender field.
     *
     * @var        string
     */
    protected $gender;

    /**
     * The value for the role field.
     *
     * Note: this column has a database default value of: 'PATIENT'
     * @var        string
     */
    protected $role;

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
     * The value for the subscribed field.
     *
     * Note: this column has a database default value of: 'YES'
     * @var        string
     */
    protected $subscribed;

    /**
     * @var        ObjectCollection|ChildDevicetokens[] Collection to store aggregation of ChildDevicetokens objects.
     */
    protected $collDevicetokenss;
    protected $collDevicetokenssPartial;

    /**
     * @var        ObjectCollection|ChildPatient[] Collection to store aggregation of ChildPatient objects.
     */
    protected $collPatients;
    protected $collPatientsPartial;

    /**
     * @var        ObjectCollection|ChildQuestions[] Collection to store aggregation of ChildQuestions objects.
     */
    protected $collQuestionss;
    protected $collQuestionssPartial;

    /**
     * @var        ObjectCollection|ChildStudyresponse[] Collection to store aggregation of ChildStudyresponse objects.
     */
    protected $collStudyresponses;
    protected $collStudyresponsesPartial;

    /**
     * @var        ObjectCollection|ChildSurveylog[] Collection to store aggregation of ChildSurveylog objects.
     */
    protected $collSurveylogs;
    protected $collSurveylogsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDevicetokens[]
     */
    protected $devicetokenssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPatient[]
     */
    protected $patientsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildQuestions[]
     */
    protected $questionssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStudyresponse[]
     */
    protected $studyresponsesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurveylog[]
     */
    protected $surveylogsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->role = 'PATIENT';
        $this->subscribed = 'YES';
    }

    /**
     * Initializes internal state of Base\Newuser object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>Newuser</code> instance.  If
     * <code>obj</code> is an instance of <code>Newuser</code>, delegates to
     * <code>equals(Newuser)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Newuser The current object, for fluid interface
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
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [hash] column value.
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Get the [fname] column value.
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Get the [lname] column value.
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Get the [gender] column value.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the [role] column value.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
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
     * Get the [subscribed] column value.
     *
     * @return string
     */
    public function getSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[NewuserTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[NewuserTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [hash] column.
     *
     * @param string $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setHash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hash !== $v) {
            $this->hash = $v;
            $this->modifiedColumns[NewuserTableMap::COL_HASH] = true;
        }

        return $this;
    } // setHash()

    /**
     * Set the value of [fname] column.
     *
     * @param string $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setFname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fname !== $v) {
            $this->fname = $v;
            $this->modifiedColumns[NewuserTableMap::COL_FNAME] = true;
        }

        return $this;
    } // setFname()

    /**
     * Set the value of [lname] column.
     *
     * @param string $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setLname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lname !== $v) {
            $this->lname = $v;
            $this->modifiedColumns[NewuserTableMap::COL_LNAME] = true;
        }

        return $this;
    } // setLname()

    /**
     * Set the value of [gender] column.
     *
     * @param string $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[NewuserTableMap::COL_GENDER] = true;
        }

        return $this;
    } // setGender()

    /**
     * Set the value of [role] column.
     *
     * @param string $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setRole($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->role !== $v) {
            $this->role = $v;
            $this->modifiedColumns[NewuserTableMap::COL_ROLE] = true;
        }

        return $this;
    } // setRole()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NewuserTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NewuserTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Set the value of [subscribed] column.
     *
     * @param string $v new value
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function setSubscribed($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subscribed !== $v) {
            $this->subscribed = $v;
            $this->modifiedColumns[NewuserTableMap::COL_SUBSCRIBED] = true;
        }

        return $this;
    } // setSubscribed()

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
            if ($this->role !== 'PATIENT') {
                return false;
            }

            if ($this->subscribed !== 'YES') {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : NewuserTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : NewuserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : NewuserTableMap::translateFieldName('Hash', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hash = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : NewuserTableMap::translateFieldName('Fname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : NewuserTableMap::translateFieldName('Lname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : NewuserTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : NewuserTableMap::translateFieldName('Role', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : NewuserTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : NewuserTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : NewuserTableMap::translateFieldName('Subscribed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subscribed = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = NewuserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Newuser'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(NewuserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildNewuserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDevicetokenss = null;

            $this->collPatients = null;

            $this->collQuestionss = null;

            $this->collStudyresponses = null;

            $this->collSurveylogs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Newuser::setDeleted()
     * @see Newuser::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NewuserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildNewuserQuery::create()
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

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NewuserTableMap::DATABASE_NAME);
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
                NewuserTableMap::addInstanceToPool($this);
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

            if ($this->devicetokenssScheduledForDeletion !== null) {
                if (!$this->devicetokenssScheduledForDeletion->isEmpty()) {
                    foreach ($this->devicetokenssScheduledForDeletion as $devicetokens) {
                        // need to save related object because we set the relation to null
                        $devicetokens->save($con);
                    }
                    $this->devicetokenssScheduledForDeletion = null;
                }
            }

            if ($this->collDevicetokenss !== null) {
                foreach ($this->collDevicetokenss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->patientsScheduledForDeletion !== null) {
                if (!$this->patientsScheduledForDeletion->isEmpty()) {
                    \PatientQuery::create()
                        ->filterByPrimaryKeys($this->patientsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->patientsScheduledForDeletion = null;
                }
            }

            if ($this->collPatients !== null) {
                foreach ($this->collPatients as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->questionssScheduledForDeletion !== null) {
                if (!$this->questionssScheduledForDeletion->isEmpty()) {
                    foreach ($this->questionssScheduledForDeletion as $questions) {
                        // need to save related object because we set the relation to null
                        $questions->save($con);
                    }
                    $this->questionssScheduledForDeletion = null;
                }
            }

            if ($this->collQuestionss !== null) {
                foreach ($this->collQuestionss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->studyresponsesScheduledForDeletion !== null) {
                if (!$this->studyresponsesScheduledForDeletion->isEmpty()) {
                    foreach ($this->studyresponsesScheduledForDeletion as $studyresponse) {
                        // need to save related object because we set the relation to null
                        $studyresponse->save($con);
                    }
                    $this->studyresponsesScheduledForDeletion = null;
                }
            }

            if ($this->collStudyresponses !== null) {
                foreach ($this->collStudyresponses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->surveylogsScheduledForDeletion !== null) {
                if (!$this->surveylogsScheduledForDeletion->isEmpty()) {
                    \SurveylogQuery::create()
                        ->filterByPrimaryKeys($this->surveylogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->surveylogsScheduledForDeletion = null;
                }
            }

            if ($this->collSurveylogs !== null) {
                foreach ($this->collSurveylogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[NewuserTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NewuserTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NewuserTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_HASH)) {
            $modifiedColumns[':p' . $index++]  = 'hash';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_FNAME)) {
            $modifiedColumns[':p' . $index++]  = 'fname';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_LNAME)) {
            $modifiedColumns[':p' . $index++]  = 'lname';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'gender';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_ROLE)) {
            $modifiedColumns[':p' . $index++]  = 'role';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(NewuserTableMap::COL_SUBSCRIBED)) {
            $modifiedColumns[':p' . $index++]  = 'Subscribed';
        }

        $sql = sprintf(
            'INSERT INTO NewUser (%s) VALUES (%s)',
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
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'hash':
                        $stmt->bindValue($identifier, $this->hash, PDO::PARAM_STR);
                        break;
                    case 'fname':
                        $stmt->bindValue($identifier, $this->fname, PDO::PARAM_STR);
                        break;
                    case 'lname':
                        $stmt->bindValue($identifier, $this->lname, PDO::PARAM_STR);
                        break;
                    case 'gender':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);
                        break;
                    case 'role':
                        $stmt->bindValue($identifier, $this->role, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'Subscribed':
                        $stmt->bindValue($identifier, $this->subscribed, PDO::PARAM_STR);
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
        $pos = NewuserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmail();
                break;
            case 2:
                return $this->getHash();
                break;
            case 3:
                return $this->getFname();
                break;
            case 4:
                return $this->getLname();
                break;
            case 5:
                return $this->getGender();
                break;
            case 6:
                return $this->getRole();
                break;
            case 7:
                return $this->getCreatedAt();
                break;
            case 8:
                return $this->getUpdatedAt();
                break;
            case 9:
                return $this->getSubscribed();
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

        if (isset($alreadyDumpedObjects['Newuser'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Newuser'][$this->hashCode()] = true;
        $keys = NewuserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getHash(),
            $keys[3] => $this->getFname(),
            $keys[4] => $this->getLname(),
            $keys[5] => $this->getGender(),
            $keys[6] => $this->getRole(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getSubscribed(),
        );
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collDevicetokenss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'devicetokenss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'DeviceTokenss';
                        break;
                    default:
                        $key = 'Devicetokenss';
                }

                $result[$key] = $this->collDevicetokenss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPatients) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'patients';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Patients';
                        break;
                    default:
                        $key = 'Patients';
                }

                $result[$key] = $this->collPatients->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collQuestionss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'questionss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Questionss';
                        break;
                    default:
                        $key = 'Questionss';
                }

                $result[$key] = $this->collQuestionss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStudyresponses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'studyresponses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'StudyResponses';
                        break;
                    default:
                        $key = 'Studyresponses';
                }

                $result[$key] = $this->collStudyresponses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSurveylogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveylogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'SurveyLogs';
                        break;
                    default:
                        $key = 'Surveylogs';
                }

                $result[$key] = $this->collSurveylogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Newuser
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = NewuserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Newuser
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setEmail($value);
                break;
            case 2:
                $this->setHash($value);
                break;
            case 3:
                $this->setFname($value);
                break;
            case 4:
                $this->setLname($value);
                break;
            case 5:
                $this->setGender($value);
                break;
            case 6:
                $this->setRole($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
            case 9:
                $this->setSubscribed($value);
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
        $keys = NewuserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmail($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setHash($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLname($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setGender($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRole($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSubscribed($arr[$keys[9]]);
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
     * @return $this|\Newuser The current object, for fluid interface
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
        $criteria = new Criteria(NewuserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(NewuserTableMap::COL_ID)) {
            $criteria->add(NewuserTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_EMAIL)) {
            $criteria->add(NewuserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_HASH)) {
            $criteria->add(NewuserTableMap::COL_HASH, $this->hash);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_FNAME)) {
            $criteria->add(NewuserTableMap::COL_FNAME, $this->fname);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_LNAME)) {
            $criteria->add(NewuserTableMap::COL_LNAME, $this->lname);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_GENDER)) {
            $criteria->add(NewuserTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_ROLE)) {
            $criteria->add(NewuserTableMap::COL_ROLE, $this->role);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_CREATED_AT)) {
            $criteria->add(NewuserTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_UPDATED_AT)) {
            $criteria->add(NewuserTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(NewuserTableMap::COL_SUBSCRIBED)) {
            $criteria->add(NewuserTableMap::COL_SUBSCRIBED, $this->subscribed);
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
        $criteria = ChildNewuserQuery::create();
        $criteria->add(NewuserTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Newuser (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setHash($this->getHash());
        $copyObj->setFname($this->getFname());
        $copyObj->setLname($this->getLname());
        $copyObj->setGender($this->getGender());
        $copyObj->setRole($this->getRole());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setSubscribed($this->getSubscribed());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDevicetokenss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDevicetokens($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPatients() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPatient($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getQuestionss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addQuestions($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStudyresponses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStudyresponse($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSurveylogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurveylog($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \Newuser Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Devicetokens' == $relationName) {
            $this->initDevicetokenss();
            return;
        }
        if ('Patient' == $relationName) {
            $this->initPatients();
            return;
        }
        if ('Questions' == $relationName) {
            $this->initQuestionss();
            return;
        }
        if ('Studyresponse' == $relationName) {
            $this->initStudyresponses();
            return;
        }
        if ('Surveylog' == $relationName) {
            $this->initSurveylogs();
            return;
        }
    }

    /**
     * Clears out the collDevicetokenss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDevicetokenss()
     */
    public function clearDevicetokenss()
    {
        $this->collDevicetokenss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDevicetokenss collection loaded partially.
     */
    public function resetPartialDevicetokenss($v = true)
    {
        $this->collDevicetokenssPartial = $v;
    }

    /**
     * Initializes the collDevicetokenss collection.
     *
     * By default this just sets the collDevicetokenss collection to an empty array (like clearcollDevicetokenss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDevicetokenss($overrideExisting = true)
    {
        if (null !== $this->collDevicetokenss && !$overrideExisting) {
            return;
        }

        $collectionClassName = DevicetokensTableMap::getTableMap()->getCollectionClassName();

        $this->collDevicetokenss = new $collectionClassName;
        $this->collDevicetokenss->setModel('\Devicetokens');
    }

    /**
     * Gets an array of ChildDevicetokens objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildNewuser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDevicetokens[] List of ChildDevicetokens objects
     * @throws PropelException
     */
    public function getDevicetokenss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDevicetokenssPartial && !$this->isNew();
        if (null === $this->collDevicetokenss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDevicetokenss) {
                // return empty collection
                $this->initDevicetokenss();
            } else {
                $collDevicetokenss = ChildDevicetokensQuery::create(null, $criteria)
                    ->filterByNewuser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDevicetokenssPartial && count($collDevicetokenss)) {
                        $this->initDevicetokenss(false);

                        foreach ($collDevicetokenss as $obj) {
                            if (false == $this->collDevicetokenss->contains($obj)) {
                                $this->collDevicetokenss->append($obj);
                            }
                        }

                        $this->collDevicetokenssPartial = true;
                    }

                    return $collDevicetokenss;
                }

                if ($partial && $this->collDevicetokenss) {
                    foreach ($this->collDevicetokenss as $obj) {
                        if ($obj->isNew()) {
                            $collDevicetokenss[] = $obj;
                        }
                    }
                }

                $this->collDevicetokenss = $collDevicetokenss;
                $this->collDevicetokenssPartial = false;
            }
        }

        return $this->collDevicetokenss;
    }

    /**
     * Sets a collection of ChildDevicetokens objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $devicetokenss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function setDevicetokenss(Collection $devicetokenss, ConnectionInterface $con = null)
    {
        /** @var ChildDevicetokens[] $devicetokenssToDelete */
        $devicetokenssToDelete = $this->getDevicetokenss(new Criteria(), $con)->diff($devicetokenss);


        $this->devicetokenssScheduledForDeletion = $devicetokenssToDelete;

        foreach ($devicetokenssToDelete as $devicetokensRemoved) {
            $devicetokensRemoved->setNewuser(null);
        }

        $this->collDevicetokenss = null;
        foreach ($devicetokenss as $devicetokens) {
            $this->addDevicetokens($devicetokens);
        }

        $this->collDevicetokenss = $devicetokenss;
        $this->collDevicetokenssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Devicetokens objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Devicetokens objects.
     * @throws PropelException
     */
    public function countDevicetokenss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDevicetokenssPartial && !$this->isNew();
        if (null === $this->collDevicetokenss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDevicetokenss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDevicetokenss());
            }

            $query = ChildDevicetokensQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNewuser($this)
                ->count($con);
        }

        return count($this->collDevicetokenss);
    }

    /**
     * Method called to associate a ChildDevicetokens object to this object
     * through the ChildDevicetokens foreign key attribute.
     *
     * @param  ChildDevicetokens $l ChildDevicetokens
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function addDevicetokens(ChildDevicetokens $l)
    {
        if ($this->collDevicetokenss === null) {
            $this->initDevicetokenss();
            $this->collDevicetokenssPartial = true;
        }

        if (!$this->collDevicetokenss->contains($l)) {
            $this->doAddDevicetokens($l);

            if ($this->devicetokenssScheduledForDeletion and $this->devicetokenssScheduledForDeletion->contains($l)) {
                $this->devicetokenssScheduledForDeletion->remove($this->devicetokenssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDevicetokens $devicetokens The ChildDevicetokens object to add.
     */
    protected function doAddDevicetokens(ChildDevicetokens $devicetokens)
    {
        $this->collDevicetokenss[]= $devicetokens;
        $devicetokens->setNewuser($this);
    }

    /**
     * @param  ChildDevicetokens $devicetokens The ChildDevicetokens object to remove.
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function removeDevicetokens(ChildDevicetokens $devicetokens)
    {
        if ($this->getDevicetokenss()->contains($devicetokens)) {
            $pos = $this->collDevicetokenss->search($devicetokens);
            $this->collDevicetokenss->remove($pos);
            if (null === $this->devicetokenssScheduledForDeletion) {
                $this->devicetokenssScheduledForDeletion = clone $this->collDevicetokenss;
                $this->devicetokenssScheduledForDeletion->clear();
            }
            $this->devicetokenssScheduledForDeletion[]= $devicetokens;
            $devicetokens->setNewuser(null);
        }

        return $this;
    }

    /**
     * Clears out the collPatients collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPatients()
     */
    public function clearPatients()
    {
        $this->collPatients = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPatients collection loaded partially.
     */
    public function resetPartialPatients($v = true)
    {
        $this->collPatientsPartial = $v;
    }

    /**
     * Initializes the collPatients collection.
     *
     * By default this just sets the collPatients collection to an empty array (like clearcollPatients());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPatients($overrideExisting = true)
    {
        if (null !== $this->collPatients && !$overrideExisting) {
            return;
        }

        $collectionClassName = PatientTableMap::getTableMap()->getCollectionClassName();

        $this->collPatients = new $collectionClassName;
        $this->collPatients->setModel('\Patient');
    }

    /**
     * Gets an array of ChildPatient objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildNewuser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPatient[] List of ChildPatient objects
     * @throws PropelException
     */
    public function getPatients(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPatientsPartial && !$this->isNew();
        if (null === $this->collPatients || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPatients) {
                // return empty collection
                $this->initPatients();
            } else {
                $collPatients = ChildPatientQuery::create(null, $criteria)
                    ->filterByNewuser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPatientsPartial && count($collPatients)) {
                        $this->initPatients(false);

                        foreach ($collPatients as $obj) {
                            if (false == $this->collPatients->contains($obj)) {
                                $this->collPatients->append($obj);
                            }
                        }

                        $this->collPatientsPartial = true;
                    }

                    return $collPatients;
                }

                if ($partial && $this->collPatients) {
                    foreach ($this->collPatients as $obj) {
                        if ($obj->isNew()) {
                            $collPatients[] = $obj;
                        }
                    }
                }

                $this->collPatients = $collPatients;
                $this->collPatientsPartial = false;
            }
        }

        return $this->collPatients;
    }

    /**
     * Sets a collection of ChildPatient objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $patients A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function setPatients(Collection $patients, ConnectionInterface $con = null)
    {
        /** @var ChildPatient[] $patientsToDelete */
        $patientsToDelete = $this->getPatients(new Criteria(), $con)->diff($patients);


        $this->patientsScheduledForDeletion = $patientsToDelete;

        foreach ($patientsToDelete as $patientRemoved) {
            $patientRemoved->setNewuser(null);
        }

        $this->collPatients = null;
        foreach ($patients as $patient) {
            $this->addPatient($patient);
        }

        $this->collPatients = $patients;
        $this->collPatientsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Patient objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Patient objects.
     * @throws PropelException
     */
    public function countPatients(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPatientsPartial && !$this->isNew();
        if (null === $this->collPatients || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPatients) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPatients());
            }

            $query = ChildPatientQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNewuser($this)
                ->count($con);
        }

        return count($this->collPatients);
    }

    /**
     * Method called to associate a ChildPatient object to this object
     * through the ChildPatient foreign key attribute.
     *
     * @param  ChildPatient $l ChildPatient
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function addPatient(ChildPatient $l)
    {
        if ($this->collPatients === null) {
            $this->initPatients();
            $this->collPatientsPartial = true;
        }

        if (!$this->collPatients->contains($l)) {
            $this->doAddPatient($l);

            if ($this->patientsScheduledForDeletion and $this->patientsScheduledForDeletion->contains($l)) {
                $this->patientsScheduledForDeletion->remove($this->patientsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPatient $patient The ChildPatient object to add.
     */
    protected function doAddPatient(ChildPatient $patient)
    {
        $this->collPatients[]= $patient;
        $patient->setNewuser($this);
    }

    /**
     * @param  ChildPatient $patient The ChildPatient object to remove.
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function removePatient(ChildPatient $patient)
    {
        if ($this->getPatients()->contains($patient)) {
            $pos = $this->collPatients->search($patient);
            $this->collPatients->remove($pos);
            if (null === $this->patientsScheduledForDeletion) {
                $this->patientsScheduledForDeletion = clone $this->collPatients;
                $this->patientsScheduledForDeletion->clear();
            }
            $this->patientsScheduledForDeletion[]= clone $patient;
            $patient->setNewuser(null);
        }

        return $this;
    }

    /**
     * Clears out the collQuestionss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addQuestionss()
     */
    public function clearQuestionss()
    {
        $this->collQuestionss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collQuestionss collection loaded partially.
     */
    public function resetPartialQuestionss($v = true)
    {
        $this->collQuestionssPartial = $v;
    }

    /**
     * Initializes the collQuestionss collection.
     *
     * By default this just sets the collQuestionss collection to an empty array (like clearcollQuestionss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initQuestionss($overrideExisting = true)
    {
        if (null !== $this->collQuestionss && !$overrideExisting) {
            return;
        }

        $collectionClassName = QuestionsTableMap::getTableMap()->getCollectionClassName();

        $this->collQuestionss = new $collectionClassName;
        $this->collQuestionss->setModel('\Questions');
    }

    /**
     * Gets an array of ChildQuestions objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildNewuser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildQuestions[] List of ChildQuestions objects
     * @throws PropelException
     */
    public function getQuestionss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collQuestionssPartial && !$this->isNew();
        if (null === $this->collQuestionss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collQuestionss) {
                // return empty collection
                $this->initQuestionss();
            } else {
                $collQuestionss = ChildQuestionsQuery::create(null, $criteria)
                    ->filterByNewuser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collQuestionssPartial && count($collQuestionss)) {
                        $this->initQuestionss(false);

                        foreach ($collQuestionss as $obj) {
                            if (false == $this->collQuestionss->contains($obj)) {
                                $this->collQuestionss->append($obj);
                            }
                        }

                        $this->collQuestionssPartial = true;
                    }

                    return $collQuestionss;
                }

                if ($partial && $this->collQuestionss) {
                    foreach ($this->collQuestionss as $obj) {
                        if ($obj->isNew()) {
                            $collQuestionss[] = $obj;
                        }
                    }
                }

                $this->collQuestionss = $collQuestionss;
                $this->collQuestionssPartial = false;
            }
        }

        return $this->collQuestionss;
    }

    /**
     * Sets a collection of ChildQuestions objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $questionss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function setQuestionss(Collection $questionss, ConnectionInterface $con = null)
    {
        /** @var ChildQuestions[] $questionssToDelete */
        $questionssToDelete = $this->getQuestionss(new Criteria(), $con)->diff($questionss);


        $this->questionssScheduledForDeletion = $questionssToDelete;

        foreach ($questionssToDelete as $questionsRemoved) {
            $questionsRemoved->setNewuser(null);
        }

        $this->collQuestionss = null;
        foreach ($questionss as $questions) {
            $this->addQuestions($questions);
        }

        $this->collQuestionss = $questionss;
        $this->collQuestionssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Questions objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Questions objects.
     * @throws PropelException
     */
    public function countQuestionss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collQuestionssPartial && !$this->isNew();
        if (null === $this->collQuestionss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collQuestionss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getQuestionss());
            }

            $query = ChildQuestionsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNewuser($this)
                ->count($con);
        }

        return count($this->collQuestionss);
    }

    /**
     * Method called to associate a ChildQuestions object to this object
     * through the ChildQuestions foreign key attribute.
     *
     * @param  ChildQuestions $l ChildQuestions
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function addQuestions(ChildQuestions $l)
    {
        if ($this->collQuestionss === null) {
            $this->initQuestionss();
            $this->collQuestionssPartial = true;
        }

        if (!$this->collQuestionss->contains($l)) {
            $this->doAddQuestions($l);

            if ($this->questionssScheduledForDeletion and $this->questionssScheduledForDeletion->contains($l)) {
                $this->questionssScheduledForDeletion->remove($this->questionssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildQuestions $questions The ChildQuestions object to add.
     */
    protected function doAddQuestions(ChildQuestions $questions)
    {
        $this->collQuestionss[]= $questions;
        $questions->setNewuser($this);
    }

    /**
     * @param  ChildQuestions $questions The ChildQuestions object to remove.
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function removeQuestions(ChildQuestions $questions)
    {
        if ($this->getQuestionss()->contains($questions)) {
            $pos = $this->collQuestionss->search($questions);
            $this->collQuestionss->remove($pos);
            if (null === $this->questionssScheduledForDeletion) {
                $this->questionssScheduledForDeletion = clone $this->collQuestionss;
                $this->questionssScheduledForDeletion->clear();
            }
            $this->questionssScheduledForDeletion[]= $questions;
            $questions->setNewuser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Newuser is new, it will return
     * an empty collection; or if this Newuser has previously
     * been saved, it will retrieve related Questionss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Newuser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildQuestions[] List of ChildQuestions objects
     */
    public function getQuestionssJoinStudy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildQuestionsQuery::create(null, $criteria);
        $query->joinWith('Study', $joinBehavior);

        return $this->getQuestionss($query, $con);
    }

    /**
     * Clears out the collStudyresponses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStudyresponses()
     */
    public function clearStudyresponses()
    {
        $this->collStudyresponses = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collStudyresponses collection loaded partially.
     */
    public function resetPartialStudyresponses($v = true)
    {
        $this->collStudyresponsesPartial = $v;
    }

    /**
     * Initializes the collStudyresponses collection.
     *
     * By default this just sets the collStudyresponses collection to an empty array (like clearcollStudyresponses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStudyresponses($overrideExisting = true)
    {
        if (null !== $this->collStudyresponses && !$overrideExisting) {
            return;
        }

        $collectionClassName = StudyresponseTableMap::getTableMap()->getCollectionClassName();

        $this->collStudyresponses = new $collectionClassName;
        $this->collStudyresponses->setModel('\Studyresponse');
    }

    /**
     * Gets an array of ChildStudyresponse objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildNewuser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStudyresponse[] List of ChildStudyresponse objects
     * @throws PropelException
     */
    public function getStudyresponses(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStudyresponsesPartial && !$this->isNew();
        if (null === $this->collStudyresponses || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collStudyresponses) {
                // return empty collection
                $this->initStudyresponses();
            } else {
                $collStudyresponses = ChildStudyresponseQuery::create(null, $criteria)
                    ->filterByNewuser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStudyresponsesPartial && count($collStudyresponses)) {
                        $this->initStudyresponses(false);

                        foreach ($collStudyresponses as $obj) {
                            if (false == $this->collStudyresponses->contains($obj)) {
                                $this->collStudyresponses->append($obj);
                            }
                        }

                        $this->collStudyresponsesPartial = true;
                    }

                    return $collStudyresponses;
                }

                if ($partial && $this->collStudyresponses) {
                    foreach ($this->collStudyresponses as $obj) {
                        if ($obj->isNew()) {
                            $collStudyresponses[] = $obj;
                        }
                    }
                }

                $this->collStudyresponses = $collStudyresponses;
                $this->collStudyresponsesPartial = false;
            }
        }

        return $this->collStudyresponses;
    }

    /**
     * Sets a collection of ChildStudyresponse objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $studyresponses A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function setStudyresponses(Collection $studyresponses, ConnectionInterface $con = null)
    {
        /** @var ChildStudyresponse[] $studyresponsesToDelete */
        $studyresponsesToDelete = $this->getStudyresponses(new Criteria(), $con)->diff($studyresponses);


        $this->studyresponsesScheduledForDeletion = $studyresponsesToDelete;

        foreach ($studyresponsesToDelete as $studyresponseRemoved) {
            $studyresponseRemoved->setNewuser(null);
        }

        $this->collStudyresponses = null;
        foreach ($studyresponses as $studyresponse) {
            $this->addStudyresponse($studyresponse);
        }

        $this->collStudyresponses = $studyresponses;
        $this->collStudyresponsesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Studyresponse objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Studyresponse objects.
     * @throws PropelException
     */
    public function countStudyresponses(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStudyresponsesPartial && !$this->isNew();
        if (null === $this->collStudyresponses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStudyresponses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStudyresponses());
            }

            $query = ChildStudyresponseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNewuser($this)
                ->count($con);
        }

        return count($this->collStudyresponses);
    }

    /**
     * Method called to associate a ChildStudyresponse object to this object
     * through the ChildStudyresponse foreign key attribute.
     *
     * @param  ChildStudyresponse $l ChildStudyresponse
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function addStudyresponse(ChildStudyresponse $l)
    {
        if ($this->collStudyresponses === null) {
            $this->initStudyresponses();
            $this->collStudyresponsesPartial = true;
        }

        if (!$this->collStudyresponses->contains($l)) {
            $this->doAddStudyresponse($l);

            if ($this->studyresponsesScheduledForDeletion and $this->studyresponsesScheduledForDeletion->contains($l)) {
                $this->studyresponsesScheduledForDeletion->remove($this->studyresponsesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStudyresponse $studyresponse The ChildStudyresponse object to add.
     */
    protected function doAddStudyresponse(ChildStudyresponse $studyresponse)
    {
        $this->collStudyresponses[]= $studyresponse;
        $studyresponse->setNewuser($this);
    }

    /**
     * @param  ChildStudyresponse $studyresponse The ChildStudyresponse object to remove.
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function removeStudyresponse(ChildStudyresponse $studyresponse)
    {
        if ($this->getStudyresponses()->contains($studyresponse)) {
            $pos = $this->collStudyresponses->search($studyresponse);
            $this->collStudyresponses->remove($pos);
            if (null === $this->studyresponsesScheduledForDeletion) {
                $this->studyresponsesScheduledForDeletion = clone $this->collStudyresponses;
                $this->studyresponsesScheduledForDeletion->clear();
            }
            $this->studyresponsesScheduledForDeletion[]= $studyresponse;
            $studyresponse->setNewuser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Newuser is new, it will return
     * an empty collection; or if this Newuser has previously
     * been saved, it will retrieve related Studyresponses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Newuser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStudyresponse[] List of ChildStudyresponse objects
     */
    public function getStudyresponsesJoinQuestions(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStudyresponseQuery::create(null, $criteria);
        $query->joinWith('Questions', $joinBehavior);

        return $this->getStudyresponses($query, $con);
    }

    /**
     * Clears out the collSurveylogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSurveylogs()
     */
    public function clearSurveylogs()
    {
        $this->collSurveylogs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSurveylogs collection loaded partially.
     */
    public function resetPartialSurveylogs($v = true)
    {
        $this->collSurveylogsPartial = $v;
    }

    /**
     * Initializes the collSurveylogs collection.
     *
     * By default this just sets the collSurveylogs collection to an empty array (like clearcollSurveylogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveylogs($overrideExisting = true)
    {
        if (null !== $this->collSurveylogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveylogTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveylogs = new $collectionClassName;
        $this->collSurveylogs->setModel('\Surveylog');
    }

    /**
     * Gets an array of ChildSurveylog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildNewuser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurveylog[] List of ChildSurveylog objects
     * @throws PropelException
     */
    public function getSurveylogs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSurveylogsPartial && !$this->isNew();
        if (null === $this->collSurveylogs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSurveylogs) {
                // return empty collection
                $this->initSurveylogs();
            } else {
                $collSurveylogs = ChildSurveylogQuery::create(null, $criteria)
                    ->filterByNewuser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveylogsPartial && count($collSurveylogs)) {
                        $this->initSurveylogs(false);

                        foreach ($collSurveylogs as $obj) {
                            if (false == $this->collSurveylogs->contains($obj)) {
                                $this->collSurveylogs->append($obj);
                            }
                        }

                        $this->collSurveylogsPartial = true;
                    }

                    return $collSurveylogs;
                }

                if ($partial && $this->collSurveylogs) {
                    foreach ($this->collSurveylogs as $obj) {
                        if ($obj->isNew()) {
                            $collSurveylogs[] = $obj;
                        }
                    }
                }

                $this->collSurveylogs = $collSurveylogs;
                $this->collSurveylogsPartial = false;
            }
        }

        return $this->collSurveylogs;
    }

    /**
     * Sets a collection of ChildSurveylog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $surveylogs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function setSurveylogs(Collection $surveylogs, ConnectionInterface $con = null)
    {
        /** @var ChildSurveylog[] $surveylogsToDelete */
        $surveylogsToDelete = $this->getSurveylogs(new Criteria(), $con)->diff($surveylogs);


        $this->surveylogsScheduledForDeletion = $surveylogsToDelete;

        foreach ($surveylogsToDelete as $surveylogRemoved) {
            $surveylogRemoved->setNewuser(null);
        }

        $this->collSurveylogs = null;
        foreach ($surveylogs as $surveylog) {
            $this->addSurveylog($surveylog);
        }

        $this->collSurveylogs = $surveylogs;
        $this->collSurveylogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Surveylog objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Surveylog objects.
     * @throws PropelException
     */
    public function countSurveylogs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSurveylogsPartial && !$this->isNew();
        if (null === $this->collSurveylogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveylogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveylogs());
            }

            $query = ChildSurveylogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNewuser($this)
                ->count($con);
        }

        return count($this->collSurveylogs);
    }

    /**
     * Method called to associate a ChildSurveylog object to this object
     * through the ChildSurveylog foreign key attribute.
     *
     * @param  ChildSurveylog $l ChildSurveylog
     * @return $this|\Newuser The current object (for fluent API support)
     */
    public function addSurveylog(ChildSurveylog $l)
    {
        if ($this->collSurveylogs === null) {
            $this->initSurveylogs();
            $this->collSurveylogsPartial = true;
        }

        if (!$this->collSurveylogs->contains($l)) {
            $this->doAddSurveylog($l);

            if ($this->surveylogsScheduledForDeletion and $this->surveylogsScheduledForDeletion->contains($l)) {
                $this->surveylogsScheduledForDeletion->remove($this->surveylogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurveylog $surveylog The ChildSurveylog object to add.
     */
    protected function doAddSurveylog(ChildSurveylog $surveylog)
    {
        $this->collSurveylogs[]= $surveylog;
        $surveylog->setNewuser($this);
    }

    /**
     * @param  ChildSurveylog $surveylog The ChildSurveylog object to remove.
     * @return $this|ChildNewuser The current object (for fluent API support)
     */
    public function removeSurveylog(ChildSurveylog $surveylog)
    {
        if ($this->getSurveylogs()->contains($surveylog)) {
            $pos = $this->collSurveylogs->search($surveylog);
            $this->collSurveylogs->remove($pos);
            if (null === $this->surveylogsScheduledForDeletion) {
                $this->surveylogsScheduledForDeletion = clone $this->collSurveylogs;
                $this->surveylogsScheduledForDeletion->clear();
            }
            $this->surveylogsScheduledForDeletion[]= clone $surveylog;
            $surveylog->setNewuser(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->email = null;
        $this->hash = null;
        $this->fname = null;
        $this->lname = null;
        $this->gender = null;
        $this->role = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->subscribed = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collDevicetokenss) {
                foreach ($this->collDevicetokenss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPatients) {
                foreach ($this->collPatients as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collQuestionss) {
                foreach ($this->collQuestionss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStudyresponses) {
                foreach ($this->collStudyresponses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSurveylogs) {
                foreach ($this->collSurveylogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDevicetokenss = null;
        $this->collPatients = null;
        $this->collQuestionss = null;
        $this->collStudyresponses = null;
        $this->collSurveylogs = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NewuserTableMap::DEFAULT_STRING_FORMAT);
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
