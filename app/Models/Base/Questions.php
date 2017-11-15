<?php

namespace Base;

use \Newuser as ChildNewuser;
use \NewuserQuery as ChildNewuserQuery;
use \Questions as ChildQuestions;
use \QuestionsQuery as ChildQuestionsQuery;
use \Study as ChildStudy;
use \StudyQuery as ChildStudyQuery;
use \Studyresponse as ChildStudyresponse;
use \StudyresponseQuery as ChildStudyresponseQuery;
use \Exception;
use \PDO;
use Map\QuestionsTableMap;
use Map\StudyresponseTableMap;
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

/**
 * Base class that represents a row from the 'Questions' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Questions implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\QuestionsTableMap';


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
     * The value for the text field.
     *
     * @var        string
     */
    protected $text;

    /**
     * The value for the choises field.
     *
     * @var        string
     */
    protected $choises;

    /**
     * The value for the type field.
     *
     * Note: this column has a database default value of: 'H'
     * @var        string
     */
    protected $type;

    /**
     * The value for the time field.
     *
     * @var        string
     */
    protected $time;

    /**
     * The value for the study_id field.
     *
     * @var        int
     */
    protected $study_id;

    /**
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * @var        ChildStudy
     */
    protected $aStudy;

    /**
     * @var        ChildNewuser
     */
    protected $aNewuser;

    /**
     * @var        ObjectCollection|ChildStudyresponse[] Collection to store aggregation of ChildStudyresponse objects.
     */
    protected $collStudyresponses;
    protected $collStudyresponsesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStudyresponse[]
     */
    protected $studyresponsesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->type = 'H';
    }

    /**
     * Initializes internal state of Base\Questions object.
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
     * Compares this with another <code>Questions</code> instance.  If
     * <code>obj</code> is an instance of <code>Questions</code>, delegates to
     * <code>equals(Questions)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Questions The current object, for fluid interface
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
     * Get the [text] column value.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the [choises] column value.
     *
     * @return string
     */
    public function getChoises()
    {
        return $this->choises;
    }

    /**
     * Get the [type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [time] column value.
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Get the [study_id] column value.
     *
     * @return int
     */
    public function getStudyId()
    {
        return $this->study_id;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Questions The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[QuestionsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [text] column.
     *
     * @param string $v new value
     * @return $this|\Questions The current object (for fluent API support)
     */
    public function setText($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->text !== $v) {
            $this->text = $v;
            $this->modifiedColumns[QuestionsTableMap::COL_TEXT] = true;
        }

        return $this;
    } // setText()

    /**
     * Set the value of [choises] column.
     *
     * @param string $v new value
     * @return $this|\Questions The current object (for fluent API support)
     */
    public function setChoises($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->choises !== $v) {
            $this->choises = $v;
            $this->modifiedColumns[QuestionsTableMap::COL_CHOISES] = true;
        }

        return $this;
    } // setChoises()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\Questions The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[QuestionsTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [time] column.
     *
     * @param string $v new value
     * @return $this|\Questions The current object (for fluent API support)
     */
    public function setTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->time !== $v) {
            $this->time = $v;
            $this->modifiedColumns[QuestionsTableMap::COL_TIME] = true;
        }

        return $this;
    } // setTime()

    /**
     * Set the value of [study_id] column.
     *
     * @param int $v new value
     * @return $this|\Questions The current object (for fluent API support)
     */
    public function setStudyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->study_id !== $v) {
            $this->study_id = $v;
            $this->modifiedColumns[QuestionsTableMap::COL_STUDY_ID] = true;
        }

        if ($this->aStudy !== null && $this->aStudy->getId() !== $v) {
            $this->aStudy = null;
        }

        return $this;
    } // setStudyId()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\Questions The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[QuestionsTableMap::COL_USER_ID] = true;
        }

        if ($this->aNewuser !== null && $this->aNewuser->getId() !== $v) {
            $this->aNewuser = null;
        }

        return $this;
    } // setUserId()

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
            if ($this->type !== 'H') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : QuestionsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : QuestionsTableMap::translateFieldName('Text', TableMap::TYPE_PHPNAME, $indexType)];
            $this->text = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : QuestionsTableMap::translateFieldName('Choises', TableMap::TYPE_PHPNAME, $indexType)];
            $this->choises = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : QuestionsTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : QuestionsTableMap::translateFieldName('Time', TableMap::TYPE_PHPNAME, $indexType)];
            $this->time = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : QuestionsTableMap::translateFieldName('StudyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->study_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : QuestionsTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = QuestionsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Questions'), 0, $e);
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
        if ($this->aStudy !== null && $this->study_id !== $this->aStudy->getId()) {
            $this->aStudy = null;
        }
        if ($this->aNewuser !== null && $this->user_id !== $this->aNewuser->getId()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(QuestionsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildQuestionsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aStudy = null;
            $this->aNewuser = null;
            $this->collStudyresponses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Questions::setDeleted()
     * @see Questions::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildQuestionsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionsTableMap::DATABASE_NAME);
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
                QuestionsTableMap::addInstanceToPool($this);
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

            if ($this->aStudy !== null) {
                if ($this->aStudy->isModified() || $this->aStudy->isNew()) {
                    $affectedRows += $this->aStudy->save($con);
                }
                $this->setStudy($this->aStudy);
            }

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

        $this->modifiedColumns[QuestionsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . QuestionsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(QuestionsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_TEXT)) {
            $modifiedColumns[':p' . $index++]  = 'Text';
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_CHOISES)) {
            $modifiedColumns[':p' . $index++]  = 'Choises';
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'Type';
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'Time';
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_STUDY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'Study_Id';
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'User_id';
        }

        $sql = sprintf(
            'INSERT INTO Questions (%s) VALUES (%s)',
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
                    case 'Text':
                        $stmt->bindValue($identifier, $this->text, PDO::PARAM_STR);
                        break;
                    case 'Choises':
                        $stmt->bindValue($identifier, $this->choises, PDO::PARAM_STR);
                        break;
                    case 'Type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'Time':
                        $stmt->bindValue($identifier, $this->time, PDO::PARAM_STR);
                        break;
                    case 'Study_Id':
                        $stmt->bindValue($identifier, $this->study_id, PDO::PARAM_INT);
                        break;
                    case 'User_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
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
        $pos = QuestionsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getText();
                break;
            case 2:
                return $this->getChoises();
                break;
            case 3:
                return $this->getType();
                break;
            case 4:
                return $this->getTime();
                break;
            case 5:
                return $this->getStudyId();
                break;
            case 6:
                return $this->getUserId();
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

        if (isset($alreadyDumpedObjects['Questions'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Questions'][$this->hashCode()] = true;
        $keys = QuestionsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getText(),
            $keys[2] => $this->getChoises(),
            $keys[3] => $this->getType(),
            $keys[4] => $this->getTime(),
            $keys[5] => $this->getStudyId(),
            $keys[6] => $this->getUserId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aStudy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'study';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Study';
                        break;
                    default:
                        $key = 'Study';
                }

                $result[$key] = $this->aStudy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
     * @return $this|\Questions
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = QuestionsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Questions
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setText($value);
                break;
            case 2:
                $this->setChoises($value);
                break;
            case 3:
                $this->setType($value);
                break;
            case 4:
                $this->setTime($value);
                break;
            case 5:
                $this->setStudyId($value);
                break;
            case 6:
                $this->setUserId($value);
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
        $keys = QuestionsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setText($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setChoises($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTime($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStudyId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUserId($arr[$keys[6]]);
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
     * @return $this|\Questions The current object, for fluid interface
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
        $criteria = new Criteria(QuestionsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(QuestionsTableMap::COL_ID)) {
            $criteria->add(QuestionsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_TEXT)) {
            $criteria->add(QuestionsTableMap::COL_TEXT, $this->text);
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_CHOISES)) {
            $criteria->add(QuestionsTableMap::COL_CHOISES, $this->choises);
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_TYPE)) {
            $criteria->add(QuestionsTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_TIME)) {
            $criteria->add(QuestionsTableMap::COL_TIME, $this->time);
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_STUDY_ID)) {
            $criteria->add(QuestionsTableMap::COL_STUDY_ID, $this->study_id);
        }
        if ($this->isColumnModified(QuestionsTableMap::COL_USER_ID)) {
            $criteria->add(QuestionsTableMap::COL_USER_ID, $this->user_id);
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
        $criteria = ChildQuestionsQuery::create();
        $criteria->add(QuestionsTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Questions (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setText($this->getText());
        $copyObj->setChoises($this->getChoises());
        $copyObj->setType($this->getType());
        $copyObj->setTime($this->getTime());
        $copyObj->setStudyId($this->getStudyId());
        $copyObj->setUserId($this->getUserId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStudyresponses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStudyresponse($relObj->copy($deepCopy));
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
     * @return \Questions Clone of current object.
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
     * Declares an association between this object and a ChildStudy object.
     *
     * @param  ChildStudy $v
     * @return $this|\Questions The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStudy(ChildStudy $v = null)
    {
        if ($v === null) {
            $this->setStudyId(NULL);
        } else {
            $this->setStudyId($v->getId());
        }

        $this->aStudy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStudy object, it will not be re-added.
        if ($v !== null) {
            $v->addQuestions($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStudy object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildStudy The associated ChildStudy object.
     * @throws PropelException
     */
    public function getStudy(ConnectionInterface $con = null)
    {
        if ($this->aStudy === null && ($this->study_id !== null)) {
            $this->aStudy = ChildStudyQuery::create()->findPk($this->study_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStudy->addQuestionss($this);
             */
        }

        return $this->aStudy;
    }

    /**
     * Declares an association between this object and a ChildNewuser object.
     *
     * @param  ChildNewuser $v
     * @return $this|\Questions The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNewuser(ChildNewuser $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aNewuser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildNewuser object, it will not be re-added.
        if ($v !== null) {
            $v->addQuestions($this);
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
        if ($this->aNewuser === null && ($this->user_id !== null)) {
            $this->aNewuser = ChildNewuserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNewuser->addQuestionss($this);
             */
        }

        return $this->aNewuser;
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
        if ('Studyresponse' == $relationName) {
            return $this->initStudyresponses();
        }
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
     * If this ChildQuestions is new, it will return
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
                    ->filterByQuestions($this)
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
     * @return $this|ChildQuestions The current object (for fluent API support)
     */
    public function setStudyresponses(Collection $studyresponses, ConnectionInterface $con = null)
    {
        /** @var ChildStudyresponse[] $studyresponsesToDelete */
        $studyresponsesToDelete = $this->getStudyresponses(new Criteria(), $con)->diff($studyresponses);


        $this->studyresponsesScheduledForDeletion = $studyresponsesToDelete;

        foreach ($studyresponsesToDelete as $studyresponseRemoved) {
            $studyresponseRemoved->setQuestions(null);
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
                ->filterByQuestions($this)
                ->count($con);
        }

        return count($this->collStudyresponses);
    }

    /**
     * Method called to associate a ChildStudyresponse object to this object
     * through the ChildStudyresponse foreign key attribute.
     *
     * @param  ChildStudyresponse $l ChildStudyresponse
     * @return $this|\Questions The current object (for fluent API support)
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
        $studyresponse->setQuestions($this);
    }

    /**
     * @param  ChildStudyresponse $studyresponse The ChildStudyresponse object to remove.
     * @return $this|ChildQuestions The current object (for fluent API support)
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
            $studyresponse->setQuestions(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Questions is new, it will return
     * an empty collection; or if this Questions has previously
     * been saved, it will retrieve related Studyresponses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Questions.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStudyresponse[] List of ChildStudyresponse objects
     */
    public function getStudyresponsesJoinNewuser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStudyresponseQuery::create(null, $criteria);
        $query->joinWith('Newuser', $joinBehavior);

        return $this->getStudyresponses($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aStudy) {
            $this->aStudy->removeQuestions($this);
        }
        if (null !== $this->aNewuser) {
            $this->aNewuser->removeQuestions($this);
        }
        $this->id = null;
        $this->text = null;
        $this->choises = null;
        $this->type = null;
        $this->time = null;
        $this->study_id = null;
        $this->user_id = null;
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
            if ($this->collStudyresponses) {
                foreach ($this->collStudyresponses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStudyresponses = null;
        $this->aStudy = null;
        $this->aNewuser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(QuestionsTableMap::DEFAULT_STRING_FORMAT);
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
