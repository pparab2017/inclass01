<?php

namespace Base;

use \ProjectMessages as ChildProjectMessages;
use \ProjectMessagesQuery as ChildProjectMessagesQuery;
use \ProjectNotification as ChildProjectNotification;
use \ProjectNotificationQuery as ChildProjectNotificationQuery;
use \ProjectStudy as ChildProjectStudy;
use \ProjectStudyQuery as ChildProjectStudyQuery;
use \ProjectUser as ChildProjectUser;
use \ProjectUserQuery as ChildProjectUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ProjectMessagesTableMap;
use Map\ProjectNotificationTableMap;
use Map\ProjectStudyTableMap;
use Map\ProjectUserTableMap;
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
 * Base class that represents a row from the 'project_study' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class ProjectStudy implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProjectStudyTableMap';


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
     * The value for the study_name field.
     *
     * @var        string
     */
    protected $study_name;

    /**
     * The value for the study_description field.
     *
     * @var        string
     */
    protected $study_description;

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
     * @var        ObjectCollection|ChildProjectMessages[] Collection to store aggregation of ChildProjectMessages objects.
     */
    protected $collProjectMessagess;
    protected $collProjectMessagessPartial;

    /**
     * @var        ObjectCollection|ChildProjectNotification[] Collection to store aggregation of ChildProjectNotification objects.
     */
    protected $collProjectNotifications;
    protected $collProjectNotificationsPartial;

    /**
     * @var        ObjectCollection|ChildProjectUser[] Collection to store aggregation of ChildProjectUser objects.
     */
    protected $collProjectUsers;
    protected $collProjectUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProjectMessages[]
     */
    protected $projectMessagessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProjectNotification[]
     */
    protected $projectNotificationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProjectUser[]
     */
    protected $projectUsersScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\ProjectStudy object.
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
     * Compares this with another <code>ProjectStudy</code> instance.  If
     * <code>obj</code> is an instance of <code>ProjectStudy</code>, delegates to
     * <code>equals(ProjectStudy)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|ProjectStudy The current object, for fluid interface
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
     * Get the [study_name] column value.
     *
     * @return string
     */
    public function getStudyName()
    {
        return $this->study_name;
    }

    /**
     * Get the [study_description] column value.
     *
     * @return string
     */
    public function getStudyDescription()
    {
        return $this->study_description;
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
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ProjectStudyTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [study_name] column.
     *
     * @param string $v new value
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function setStudyName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->study_name !== $v) {
            $this->study_name = $v;
            $this->modifiedColumns[ProjectStudyTableMap::COL_STUDY_NAME] = true;
        }

        return $this;
    } // setStudyName()

    /**
     * Set the value of [study_description] column.
     *
     * @param string $v new value
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function setStudyDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->study_description !== $v) {
            $this->study_description = $v;
            $this->modifiedColumns[ProjectStudyTableMap::COL_STUDY_DESCRIPTION] = true;
        }

        return $this;
    } // setStudyDescription()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProjectStudyTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProjectStudyTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProjectStudyTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProjectStudyTableMap::translateFieldName('StudyName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->study_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProjectStudyTableMap::translateFieldName('StudyDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->study_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProjectStudyTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProjectStudyTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = ProjectStudyTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\ProjectStudy'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ProjectStudyTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProjectStudyQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collProjectMessagess = null;

            $this->collProjectNotifications = null;

            $this->collProjectUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ProjectStudy::setDeleted()
     * @see ProjectStudy::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectStudyTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProjectStudyQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectStudyTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(ProjectStudyTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
                if (!$this->isColumnModified(ProjectStudyTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(ProjectStudyTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProjectStudyTableMap::addInstanceToPool($this);
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

            if ($this->projectMessagessScheduledForDeletion !== null) {
                if (!$this->projectMessagessScheduledForDeletion->isEmpty()) {
                    \ProjectMessagesQuery::create()
                        ->filterByPrimaryKeys($this->projectMessagessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->projectMessagessScheduledForDeletion = null;
                }
            }

            if ($this->collProjectMessagess !== null) {
                foreach ($this->collProjectMessagess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectNotificationsScheduledForDeletion !== null) {
                if (!$this->projectNotificationsScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectNotificationsScheduledForDeletion as $projectNotification) {
                        // need to save related object because we set the relation to null
                        $projectNotification->save($con);
                    }
                    $this->projectNotificationsScheduledForDeletion = null;
                }
            }

            if ($this->collProjectNotifications !== null) {
                foreach ($this->collProjectNotifications as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectUsersScheduledForDeletion !== null) {
                if (!$this->projectUsersScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectUsersScheduledForDeletion as $projectUser) {
                        // need to save related object because we set the relation to null
                        $projectUser->save($con);
                    }
                    $this->projectUsersScheduledForDeletion = null;
                }
            }

            if ($this->collProjectUsers !== null) {
                foreach ($this->collProjectUsers as $referrerFK) {
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

        $this->modifiedColumns[ProjectStudyTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProjectStudyTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProjectStudyTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_STUDY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'study_name';
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_STUDY_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'study_description';
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO project_study (%s) VALUES (%s)',
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
                    case 'study_name':
                        $stmt->bindValue($identifier, $this->study_name, PDO::PARAM_STR);
                        break;
                    case 'study_description':
                        $stmt->bindValue($identifier, $this->study_description, PDO::PARAM_STR);
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
        $pos = ProjectStudyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getStudyName();
                break;
            case 2:
                return $this->getStudyDescription();
                break;
            case 3:
                return $this->getCreatedAt();
                break;
            case 4:
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

        if (isset($alreadyDumpedObjects['ProjectStudy'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ProjectStudy'][$this->hashCode()] = true;
        $keys = ProjectStudyTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getStudyName(),
            $keys[2] => $this->getStudyDescription(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
        );
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collProjectMessagess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'projectMessagess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'project_messagess';
                        break;
                    default:
                        $key = 'ProjectMessagess';
                }

                $result[$key] = $this->collProjectMessagess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectNotifications) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'projectNotifications';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'project_notifications';
                        break;
                    default:
                        $key = 'ProjectNotifications';
                }

                $result[$key] = $this->collProjectNotifications->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'projectUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'project_users';
                        break;
                    default:
                        $key = 'ProjectUsers';
                }

                $result[$key] = $this->collProjectUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\ProjectStudy
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProjectStudyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\ProjectStudy
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setStudyName($value);
                break;
            case 2:
                $this->setStudyDescription($value);
                break;
            case 3:
                $this->setCreatedAt($value);
                break;
            case 4:
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
        $keys = ProjectStudyTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setStudyName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStudyDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreatedAt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUpdatedAt($arr[$keys[4]]);
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
     * @return $this|\ProjectStudy The current object, for fluid interface
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
        $criteria = new Criteria(ProjectStudyTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProjectStudyTableMap::COL_ID)) {
            $criteria->add(ProjectStudyTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_STUDY_NAME)) {
            $criteria->add(ProjectStudyTableMap::COL_STUDY_NAME, $this->study_name);
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_STUDY_DESCRIPTION)) {
            $criteria->add(ProjectStudyTableMap::COL_STUDY_DESCRIPTION, $this->study_description);
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_CREATED_AT)) {
            $criteria->add(ProjectStudyTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ProjectStudyTableMap::COL_UPDATED_AT)) {
            $criteria->add(ProjectStudyTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildProjectStudyQuery::create();
        $criteria->add(ProjectStudyTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \ProjectStudy (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setStudyName($this->getStudyName());
        $copyObj->setStudyDescription($this->getStudyDescription());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProjectMessagess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectMessages($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectNotifications() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectNotification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectUser($relObj->copy($deepCopy));
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
     * @return \ProjectStudy Clone of current object.
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
        if ('ProjectMessages' == $relationName) {
            $this->initProjectMessagess();
            return;
        }
        if ('ProjectNotification' == $relationName) {
            $this->initProjectNotifications();
            return;
        }
        if ('ProjectUser' == $relationName) {
            $this->initProjectUsers();
            return;
        }
    }

    /**
     * Clears out the collProjectMessagess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProjectMessagess()
     */
    public function clearProjectMessagess()
    {
        $this->collProjectMessagess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProjectMessagess collection loaded partially.
     */
    public function resetPartialProjectMessagess($v = true)
    {
        $this->collProjectMessagessPartial = $v;
    }

    /**
     * Initializes the collProjectMessagess collection.
     *
     * By default this just sets the collProjectMessagess collection to an empty array (like clearcollProjectMessagess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectMessagess($overrideExisting = true)
    {
        if (null !== $this->collProjectMessagess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProjectMessagesTableMap::getTableMap()->getCollectionClassName();

        $this->collProjectMessagess = new $collectionClassName;
        $this->collProjectMessagess->setModel('\ProjectMessages');
    }

    /**
     * Gets an array of ChildProjectMessages objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProjectStudy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProjectMessages[] List of ChildProjectMessages objects
     * @throws PropelException
     */
    public function getProjectMessagess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProjectMessagessPartial && !$this->isNew();
        if (null === $this->collProjectMessagess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectMessagess) {
                // return empty collection
                $this->initProjectMessagess();
            } else {
                $collProjectMessagess = ChildProjectMessagesQuery::create(null, $criteria)
                    ->filterByProjectStudy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProjectMessagessPartial && count($collProjectMessagess)) {
                        $this->initProjectMessagess(false);

                        foreach ($collProjectMessagess as $obj) {
                            if (false == $this->collProjectMessagess->contains($obj)) {
                                $this->collProjectMessagess->append($obj);
                            }
                        }

                        $this->collProjectMessagessPartial = true;
                    }

                    return $collProjectMessagess;
                }

                if ($partial && $this->collProjectMessagess) {
                    foreach ($this->collProjectMessagess as $obj) {
                        if ($obj->isNew()) {
                            $collProjectMessagess[] = $obj;
                        }
                    }
                }

                $this->collProjectMessagess = $collProjectMessagess;
                $this->collProjectMessagessPartial = false;
            }
        }

        return $this->collProjectMessagess;
    }

    /**
     * Sets a collection of ChildProjectMessages objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $projectMessagess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProjectStudy The current object (for fluent API support)
     */
    public function setProjectMessagess(Collection $projectMessagess, ConnectionInterface $con = null)
    {
        /** @var ChildProjectMessages[] $projectMessagessToDelete */
        $projectMessagessToDelete = $this->getProjectMessagess(new Criteria(), $con)->diff($projectMessagess);


        $this->projectMessagessScheduledForDeletion = $projectMessagessToDelete;

        foreach ($projectMessagessToDelete as $projectMessagesRemoved) {
            $projectMessagesRemoved->setProjectStudy(null);
        }

        $this->collProjectMessagess = null;
        foreach ($projectMessagess as $projectMessages) {
            $this->addProjectMessages($projectMessages);
        }

        $this->collProjectMessagess = $projectMessagess;
        $this->collProjectMessagessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectMessages objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProjectMessages objects.
     * @throws PropelException
     */
    public function countProjectMessagess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProjectMessagessPartial && !$this->isNew();
        if (null === $this->collProjectMessagess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectMessagess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProjectMessagess());
            }

            $query = ChildProjectMessagesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProjectStudy($this)
                ->count($con);
        }

        return count($this->collProjectMessagess);
    }

    /**
     * Method called to associate a ChildProjectMessages object to this object
     * through the ChildProjectMessages foreign key attribute.
     *
     * @param  ChildProjectMessages $l ChildProjectMessages
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function addProjectMessages(ChildProjectMessages $l)
    {
        if ($this->collProjectMessagess === null) {
            $this->initProjectMessagess();
            $this->collProjectMessagessPartial = true;
        }

        if (!$this->collProjectMessagess->contains($l)) {
            $this->doAddProjectMessages($l);

            if ($this->projectMessagessScheduledForDeletion and $this->projectMessagessScheduledForDeletion->contains($l)) {
                $this->projectMessagessScheduledForDeletion->remove($this->projectMessagessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProjectMessages $projectMessages The ChildProjectMessages object to add.
     */
    protected function doAddProjectMessages(ChildProjectMessages $projectMessages)
    {
        $this->collProjectMessagess[]= $projectMessages;
        $projectMessages->setProjectStudy($this);
    }

    /**
     * @param  ChildProjectMessages $projectMessages The ChildProjectMessages object to remove.
     * @return $this|ChildProjectStudy The current object (for fluent API support)
     */
    public function removeProjectMessages(ChildProjectMessages $projectMessages)
    {
        if ($this->getProjectMessagess()->contains($projectMessages)) {
            $pos = $this->collProjectMessagess->search($projectMessages);
            $this->collProjectMessagess->remove($pos);
            if (null === $this->projectMessagessScheduledForDeletion) {
                $this->projectMessagessScheduledForDeletion = clone $this->collProjectMessagess;
                $this->projectMessagessScheduledForDeletion->clear();
            }
            $this->projectMessagessScheduledForDeletion[]= clone $projectMessages;
            $projectMessages->setProjectStudy(null);
        }

        return $this;
    }

    /**
     * Clears out the collProjectNotifications collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProjectNotifications()
     */
    public function clearProjectNotifications()
    {
        $this->collProjectNotifications = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProjectNotifications collection loaded partially.
     */
    public function resetPartialProjectNotifications($v = true)
    {
        $this->collProjectNotificationsPartial = $v;
    }

    /**
     * Initializes the collProjectNotifications collection.
     *
     * By default this just sets the collProjectNotifications collection to an empty array (like clearcollProjectNotifications());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectNotifications($overrideExisting = true)
    {
        if (null !== $this->collProjectNotifications && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProjectNotificationTableMap::getTableMap()->getCollectionClassName();

        $this->collProjectNotifications = new $collectionClassName;
        $this->collProjectNotifications->setModel('\ProjectNotification');
    }

    /**
     * Gets an array of ChildProjectNotification objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProjectStudy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProjectNotification[] List of ChildProjectNotification objects
     * @throws PropelException
     */
    public function getProjectNotifications(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProjectNotificationsPartial && !$this->isNew();
        if (null === $this->collProjectNotifications || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectNotifications) {
                // return empty collection
                $this->initProjectNotifications();
            } else {
                $collProjectNotifications = ChildProjectNotificationQuery::create(null, $criteria)
                    ->filterByProjectStudy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProjectNotificationsPartial && count($collProjectNotifications)) {
                        $this->initProjectNotifications(false);

                        foreach ($collProjectNotifications as $obj) {
                            if (false == $this->collProjectNotifications->contains($obj)) {
                                $this->collProjectNotifications->append($obj);
                            }
                        }

                        $this->collProjectNotificationsPartial = true;
                    }

                    return $collProjectNotifications;
                }

                if ($partial && $this->collProjectNotifications) {
                    foreach ($this->collProjectNotifications as $obj) {
                        if ($obj->isNew()) {
                            $collProjectNotifications[] = $obj;
                        }
                    }
                }

                $this->collProjectNotifications = $collProjectNotifications;
                $this->collProjectNotificationsPartial = false;
            }
        }

        return $this->collProjectNotifications;
    }

    /**
     * Sets a collection of ChildProjectNotification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $projectNotifications A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProjectStudy The current object (for fluent API support)
     */
    public function setProjectNotifications(Collection $projectNotifications, ConnectionInterface $con = null)
    {
        /** @var ChildProjectNotification[] $projectNotificationsToDelete */
        $projectNotificationsToDelete = $this->getProjectNotifications(new Criteria(), $con)->diff($projectNotifications);


        $this->projectNotificationsScheduledForDeletion = $projectNotificationsToDelete;

        foreach ($projectNotificationsToDelete as $projectNotificationRemoved) {
            $projectNotificationRemoved->setProjectStudy(null);
        }

        $this->collProjectNotifications = null;
        foreach ($projectNotifications as $projectNotification) {
            $this->addProjectNotification($projectNotification);
        }

        $this->collProjectNotifications = $projectNotifications;
        $this->collProjectNotificationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectNotification objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProjectNotification objects.
     * @throws PropelException
     */
    public function countProjectNotifications(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProjectNotificationsPartial && !$this->isNew();
        if (null === $this->collProjectNotifications || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectNotifications) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProjectNotifications());
            }

            $query = ChildProjectNotificationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProjectStudy($this)
                ->count($con);
        }

        return count($this->collProjectNotifications);
    }

    /**
     * Method called to associate a ChildProjectNotification object to this object
     * through the ChildProjectNotification foreign key attribute.
     *
     * @param  ChildProjectNotification $l ChildProjectNotification
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function addProjectNotification(ChildProjectNotification $l)
    {
        if ($this->collProjectNotifications === null) {
            $this->initProjectNotifications();
            $this->collProjectNotificationsPartial = true;
        }

        if (!$this->collProjectNotifications->contains($l)) {
            $this->doAddProjectNotification($l);

            if ($this->projectNotificationsScheduledForDeletion and $this->projectNotificationsScheduledForDeletion->contains($l)) {
                $this->projectNotificationsScheduledForDeletion->remove($this->projectNotificationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProjectNotification $projectNotification The ChildProjectNotification object to add.
     */
    protected function doAddProjectNotification(ChildProjectNotification $projectNotification)
    {
        $this->collProjectNotifications[]= $projectNotification;
        $projectNotification->setProjectStudy($this);
    }

    /**
     * @param  ChildProjectNotification $projectNotification The ChildProjectNotification object to remove.
     * @return $this|ChildProjectStudy The current object (for fluent API support)
     */
    public function removeProjectNotification(ChildProjectNotification $projectNotification)
    {
        if ($this->getProjectNotifications()->contains($projectNotification)) {
            $pos = $this->collProjectNotifications->search($projectNotification);
            $this->collProjectNotifications->remove($pos);
            if (null === $this->projectNotificationsScheduledForDeletion) {
                $this->projectNotificationsScheduledForDeletion = clone $this->collProjectNotifications;
                $this->projectNotificationsScheduledForDeletion->clear();
            }
            $this->projectNotificationsScheduledForDeletion[]= $projectNotification;
            $projectNotification->setProjectStudy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProjectStudy is new, it will return
     * an empty collection; or if this ProjectStudy has previously
     * been saved, it will retrieve related ProjectNotifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProjectStudy.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProjectNotification[] List of ChildProjectNotification objects
     */
    public function getProjectNotificationsJoinProjectMessages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProjectNotificationQuery::create(null, $criteria);
        $query->joinWith('ProjectMessages', $joinBehavior);

        return $this->getProjectNotifications($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProjectStudy is new, it will return
     * an empty collection; or if this ProjectStudy has previously
     * been saved, it will retrieve related ProjectNotifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProjectStudy.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProjectNotification[] List of ChildProjectNotification objects
     */
    public function getProjectNotificationsJoinProjectUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProjectNotificationQuery::create(null, $criteria);
        $query->joinWith('ProjectUser', $joinBehavior);

        return $this->getProjectNotifications($query, $con);
    }

    /**
     * Clears out the collProjectUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProjectUsers()
     */
    public function clearProjectUsers()
    {
        $this->collProjectUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProjectUsers collection loaded partially.
     */
    public function resetPartialProjectUsers($v = true)
    {
        $this->collProjectUsersPartial = $v;
    }

    /**
     * Initializes the collProjectUsers collection.
     *
     * By default this just sets the collProjectUsers collection to an empty array (like clearcollProjectUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectUsers($overrideExisting = true)
    {
        if (null !== $this->collProjectUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProjectUserTableMap::getTableMap()->getCollectionClassName();

        $this->collProjectUsers = new $collectionClassName;
        $this->collProjectUsers->setModel('\ProjectUser');
    }

    /**
     * Gets an array of ChildProjectUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProjectStudy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProjectUser[] List of ChildProjectUser objects
     * @throws PropelException
     */
    public function getProjectUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProjectUsersPartial && !$this->isNew();
        if (null === $this->collProjectUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectUsers) {
                // return empty collection
                $this->initProjectUsers();
            } else {
                $collProjectUsers = ChildProjectUserQuery::create(null, $criteria)
                    ->filterByProjectStudy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProjectUsersPartial && count($collProjectUsers)) {
                        $this->initProjectUsers(false);

                        foreach ($collProjectUsers as $obj) {
                            if (false == $this->collProjectUsers->contains($obj)) {
                                $this->collProjectUsers->append($obj);
                            }
                        }

                        $this->collProjectUsersPartial = true;
                    }

                    return $collProjectUsers;
                }

                if ($partial && $this->collProjectUsers) {
                    foreach ($this->collProjectUsers as $obj) {
                        if ($obj->isNew()) {
                            $collProjectUsers[] = $obj;
                        }
                    }
                }

                $this->collProjectUsers = $collProjectUsers;
                $this->collProjectUsersPartial = false;
            }
        }

        return $this->collProjectUsers;
    }

    /**
     * Sets a collection of ChildProjectUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $projectUsers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProjectStudy The current object (for fluent API support)
     */
    public function setProjectUsers(Collection $projectUsers, ConnectionInterface $con = null)
    {
        /** @var ChildProjectUser[] $projectUsersToDelete */
        $projectUsersToDelete = $this->getProjectUsers(new Criteria(), $con)->diff($projectUsers);


        $this->projectUsersScheduledForDeletion = $projectUsersToDelete;

        foreach ($projectUsersToDelete as $projectUserRemoved) {
            $projectUserRemoved->setProjectStudy(null);
        }

        $this->collProjectUsers = null;
        foreach ($projectUsers as $projectUser) {
            $this->addProjectUser($projectUser);
        }

        $this->collProjectUsers = $projectUsers;
        $this->collProjectUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectUser objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProjectUser objects.
     * @throws PropelException
     */
    public function countProjectUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProjectUsersPartial && !$this->isNew();
        if (null === $this->collProjectUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProjectUsers());
            }

            $query = ChildProjectUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProjectStudy($this)
                ->count($con);
        }

        return count($this->collProjectUsers);
    }

    /**
     * Method called to associate a ChildProjectUser object to this object
     * through the ChildProjectUser foreign key attribute.
     *
     * @param  ChildProjectUser $l ChildProjectUser
     * @return $this|\ProjectStudy The current object (for fluent API support)
     */
    public function addProjectUser(ChildProjectUser $l)
    {
        if ($this->collProjectUsers === null) {
            $this->initProjectUsers();
            $this->collProjectUsersPartial = true;
        }

        if (!$this->collProjectUsers->contains($l)) {
            $this->doAddProjectUser($l);

            if ($this->projectUsersScheduledForDeletion and $this->projectUsersScheduledForDeletion->contains($l)) {
                $this->projectUsersScheduledForDeletion->remove($this->projectUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProjectUser $projectUser The ChildProjectUser object to add.
     */
    protected function doAddProjectUser(ChildProjectUser $projectUser)
    {
        $this->collProjectUsers[]= $projectUser;
        $projectUser->setProjectStudy($this);
    }

    /**
     * @param  ChildProjectUser $projectUser The ChildProjectUser object to remove.
     * @return $this|ChildProjectStudy The current object (for fluent API support)
     */
    public function removeProjectUser(ChildProjectUser $projectUser)
    {
        if ($this->getProjectUsers()->contains($projectUser)) {
            $pos = $this->collProjectUsers->search($projectUser);
            $this->collProjectUsers->remove($pos);
            if (null === $this->projectUsersScheduledForDeletion) {
                $this->projectUsersScheduledForDeletion = clone $this->collProjectUsers;
                $this->projectUsersScheduledForDeletion->clear();
            }
            $this->projectUsersScheduledForDeletion[]= $projectUser;
            $projectUser->setProjectStudy(null);
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
        $this->study_name = null;
        $this->study_description = null;
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
            if ($this->collProjectMessagess) {
                foreach ($this->collProjectMessagess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectNotifications) {
                foreach ($this->collProjectNotifications as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectUsers) {
                foreach ($this->collProjectUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProjectMessagess = null;
        $this->collProjectNotifications = null;
        $this->collProjectUsers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProjectStudyTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildProjectStudy The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[ProjectStudyTableMap::COL_UPDATED_AT] = true;

        return $this;
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
