<?php

namespace Base;

use \Surveylog as ChildSurveylog;
use \SurveylogQuery as ChildSurveylogQuery;
use \Exception;
use \PDO;
use Map\SurveylogTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'SurveyLog' table.
 *
 *
 *
 * @method     ChildSurveylogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSurveylogQuery orderByPatientId($order = Criteria::ASC) Order by the patient_id column
 * @method     ChildSurveylogQuery orderByQ1($order = Criteria::ASC) Order by the Q1 column
 * @method     ChildSurveylogQuery orderByQ2($order = Criteria::ASC) Order by the Q2 column
 * @method     ChildSurveylogQuery orderByQ3($order = Criteria::ASC) Order by the Q3 column
 * @method     ChildSurveylogQuery orderByQ4($order = Criteria::ASC) Order by the Q4 column
 * @method     ChildSurveylogQuery orderByQ5($order = Criteria::ASC) Order by the Q5 column
 * @method     ChildSurveylogQuery orderByQ6($order = Criteria::ASC) Order by the Q6 column
 * @method     ChildSurveylogQuery orderByQ7($order = Criteria::ASC) Order by the Q7 column
 * @method     ChildSurveylogQuery orderByQ8($order = Criteria::ASC) Order by the Q8 column
 * @method     ChildSurveylogQuery orderByQ9($order = Criteria::ASC) Order by the Q9 column
 * @method     ChildSurveylogQuery orderByQ10($order = Criteria::ASC) Order by the Q10 column
 * @method     ChildSurveylogQuery orderByQ11($order = Criteria::ASC) Order by the Q11 column
 * @method     ChildSurveylogQuery orderByQ12($order = Criteria::ASC) Order by the Q12 column
 * @method     ChildSurveylogQuery orderByQ13($order = Criteria::ASC) Order by the Q13 column
 * @method     ChildSurveylogQuery orderByQ14($order = Criteria::ASC) Order by the Q14 column
 * @method     ChildSurveylogQuery orderByQ15($order = Criteria::ASC) Order by the Q15 column
 * @method     ChildSurveylogQuery orderByQ16($order = Criteria::ASC) Order by the Q16 column
 * @method     ChildSurveylogQuery orderByQ17($order = Criteria::ASC) Order by the Q17 column
 * @method     ChildSurveylogQuery orderByQ18($order = Criteria::ASC) Order by the Q18 column
 * @method     ChildSurveylogQuery orderByQ19($order = Criteria::ASC) Order by the Q19 column
 * @method     ChildSurveylogQuery orderByQ20($order = Criteria::ASC) Order by the Q20 column
 * @method     ChildSurveylogQuery orderByQ21($order = Criteria::ASC) Order by the Q21 column
 * @method     ChildSurveylogQuery orderByQ22($order = Criteria::ASC) Order by the Q22 column
 * @method     ChildSurveylogQuery orderByQ23($order = Criteria::ASC) Order by the Q23 column
 * @method     ChildSurveylogQuery orderByQ24($order = Criteria::ASC) Order by the Q24 column
 * @method     ChildSurveylogQuery orderByQ25($order = Criteria::ASC) Order by the Q25 column
 * @method     ChildSurveylogQuery orderByQ26($order = Criteria::ASC) Order by the Q26 column
 * @method     ChildSurveylogQuery orderByQ27($order = Criteria::ASC) Order by the Q27 column
 * @method     ChildSurveylogQuery orderByQ28($order = Criteria::ASC) Order by the Q28 column
 * @method     ChildSurveylogQuery orderByQ29($order = Criteria::ASC) Order by the Q29 column
 * @method     ChildSurveylogQuery orderByQ30($order = Criteria::ASC) Order by the Q30 column
 * @method     ChildSurveylogQuery orderByQ31($order = Criteria::ASC) Order by the Q31 column
 * @method     ChildSurveylogQuery orderByQ32($order = Criteria::ASC) Order by the Q32 column
 * @method     ChildSurveylogQuery orderByQ33($order = Criteria::ASC) Order by the Q33 column
 * @method     ChildSurveylogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSurveylogQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSurveylogQuery groupById() Group by the id column
 * @method     ChildSurveylogQuery groupByPatientId() Group by the patient_id column
 * @method     ChildSurveylogQuery groupByQ1() Group by the Q1 column
 * @method     ChildSurveylogQuery groupByQ2() Group by the Q2 column
 * @method     ChildSurveylogQuery groupByQ3() Group by the Q3 column
 * @method     ChildSurveylogQuery groupByQ4() Group by the Q4 column
 * @method     ChildSurveylogQuery groupByQ5() Group by the Q5 column
 * @method     ChildSurveylogQuery groupByQ6() Group by the Q6 column
 * @method     ChildSurveylogQuery groupByQ7() Group by the Q7 column
 * @method     ChildSurveylogQuery groupByQ8() Group by the Q8 column
 * @method     ChildSurveylogQuery groupByQ9() Group by the Q9 column
 * @method     ChildSurveylogQuery groupByQ10() Group by the Q10 column
 * @method     ChildSurveylogQuery groupByQ11() Group by the Q11 column
 * @method     ChildSurveylogQuery groupByQ12() Group by the Q12 column
 * @method     ChildSurveylogQuery groupByQ13() Group by the Q13 column
 * @method     ChildSurveylogQuery groupByQ14() Group by the Q14 column
 * @method     ChildSurveylogQuery groupByQ15() Group by the Q15 column
 * @method     ChildSurveylogQuery groupByQ16() Group by the Q16 column
 * @method     ChildSurveylogQuery groupByQ17() Group by the Q17 column
 * @method     ChildSurveylogQuery groupByQ18() Group by the Q18 column
 * @method     ChildSurveylogQuery groupByQ19() Group by the Q19 column
 * @method     ChildSurveylogQuery groupByQ20() Group by the Q20 column
 * @method     ChildSurveylogQuery groupByQ21() Group by the Q21 column
 * @method     ChildSurveylogQuery groupByQ22() Group by the Q22 column
 * @method     ChildSurveylogQuery groupByQ23() Group by the Q23 column
 * @method     ChildSurveylogQuery groupByQ24() Group by the Q24 column
 * @method     ChildSurveylogQuery groupByQ25() Group by the Q25 column
 * @method     ChildSurveylogQuery groupByQ26() Group by the Q26 column
 * @method     ChildSurveylogQuery groupByQ27() Group by the Q27 column
 * @method     ChildSurveylogQuery groupByQ28() Group by the Q28 column
 * @method     ChildSurveylogQuery groupByQ29() Group by the Q29 column
 * @method     ChildSurveylogQuery groupByQ30() Group by the Q30 column
 * @method     ChildSurveylogQuery groupByQ31() Group by the Q31 column
 * @method     ChildSurveylogQuery groupByQ32() Group by the Q32 column
 * @method     ChildSurveylogQuery groupByQ33() Group by the Q33 column
 * @method     ChildSurveylogQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSurveylogQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSurveylogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSurveylogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSurveylogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSurveylogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSurveylogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSurveylogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSurveylogQuery leftJoinNewuser($relationAlias = null) Adds a LEFT JOIN clause to the query using the Newuser relation
 * @method     ChildSurveylogQuery rightJoinNewuser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Newuser relation
 * @method     ChildSurveylogQuery innerJoinNewuser($relationAlias = null) Adds a INNER JOIN clause to the query using the Newuser relation
 *
 * @method     ChildSurveylogQuery joinWithNewuser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Newuser relation
 *
 * @method     ChildSurveylogQuery leftJoinWithNewuser() Adds a LEFT JOIN clause and with to the query using the Newuser relation
 * @method     ChildSurveylogQuery rightJoinWithNewuser() Adds a RIGHT JOIN clause and with to the query using the Newuser relation
 * @method     ChildSurveylogQuery innerJoinWithNewuser() Adds a INNER JOIN clause and with to the query using the Newuser relation
 *
 * @method     \NewuserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSurveylog findOne(ConnectionInterface $con = null) Return the first ChildSurveylog matching the query
 * @method     ChildSurveylog findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSurveylog matching the query, or a new ChildSurveylog object populated from the query conditions when no match is found
 *
 * @method     ChildSurveylog findOneById(int $id) Return the first ChildSurveylog filtered by the id column
 * @method     ChildSurveylog findOneByPatientId(int $patient_id) Return the first ChildSurveylog filtered by the patient_id column
 * @method     ChildSurveylog findOneByQ1(string $Q1) Return the first ChildSurveylog filtered by the Q1 column
 * @method     ChildSurveylog findOneByQ2(string $Q2) Return the first ChildSurveylog filtered by the Q2 column
 * @method     ChildSurveylog findOneByQ3(string $Q3) Return the first ChildSurveylog filtered by the Q3 column
 * @method     ChildSurveylog findOneByQ4(string $Q4) Return the first ChildSurveylog filtered by the Q4 column
 * @method     ChildSurveylog findOneByQ5(string $Q5) Return the first ChildSurveylog filtered by the Q5 column
 * @method     ChildSurveylog findOneByQ6(string $Q6) Return the first ChildSurveylog filtered by the Q6 column
 * @method     ChildSurveylog findOneByQ7(string $Q7) Return the first ChildSurveylog filtered by the Q7 column
 * @method     ChildSurveylog findOneByQ8(string $Q8) Return the first ChildSurveylog filtered by the Q8 column
 * @method     ChildSurveylog findOneByQ9(string $Q9) Return the first ChildSurveylog filtered by the Q9 column
 * @method     ChildSurveylog findOneByQ10(string $Q10) Return the first ChildSurveylog filtered by the Q10 column
 * @method     ChildSurveylog findOneByQ11(string $Q11) Return the first ChildSurveylog filtered by the Q11 column
 * @method     ChildSurveylog findOneByQ12(string $Q12) Return the first ChildSurveylog filtered by the Q12 column
 * @method     ChildSurveylog findOneByQ13(string $Q13) Return the first ChildSurveylog filtered by the Q13 column
 * @method     ChildSurveylog findOneByQ14(string $Q14) Return the first ChildSurveylog filtered by the Q14 column
 * @method     ChildSurveylog findOneByQ15(string $Q15) Return the first ChildSurveylog filtered by the Q15 column
 * @method     ChildSurveylog findOneByQ16(string $Q16) Return the first ChildSurveylog filtered by the Q16 column
 * @method     ChildSurveylog findOneByQ17(string $Q17) Return the first ChildSurveylog filtered by the Q17 column
 * @method     ChildSurveylog findOneByQ18(string $Q18) Return the first ChildSurveylog filtered by the Q18 column
 * @method     ChildSurveylog findOneByQ19(string $Q19) Return the first ChildSurveylog filtered by the Q19 column
 * @method     ChildSurveylog findOneByQ20(string $Q20) Return the first ChildSurveylog filtered by the Q20 column
 * @method     ChildSurveylog findOneByQ21(string $Q21) Return the first ChildSurveylog filtered by the Q21 column
 * @method     ChildSurveylog findOneByQ22(string $Q22) Return the first ChildSurveylog filtered by the Q22 column
 * @method     ChildSurveylog findOneByQ23(string $Q23) Return the first ChildSurveylog filtered by the Q23 column
 * @method     ChildSurveylog findOneByQ24(string $Q24) Return the first ChildSurveylog filtered by the Q24 column
 * @method     ChildSurveylog findOneByQ25(string $Q25) Return the first ChildSurveylog filtered by the Q25 column
 * @method     ChildSurveylog findOneByQ26(string $Q26) Return the first ChildSurveylog filtered by the Q26 column
 * @method     ChildSurveylog findOneByQ27(string $Q27) Return the first ChildSurveylog filtered by the Q27 column
 * @method     ChildSurveylog findOneByQ28(string $Q28) Return the first ChildSurveylog filtered by the Q28 column
 * @method     ChildSurveylog findOneByQ29(string $Q29) Return the first ChildSurveylog filtered by the Q29 column
 * @method     ChildSurveylog findOneByQ30(string $Q30) Return the first ChildSurveylog filtered by the Q30 column
 * @method     ChildSurveylog findOneByQ31(string $Q31) Return the first ChildSurveylog filtered by the Q31 column
 * @method     ChildSurveylog findOneByQ32(string $Q32) Return the first ChildSurveylog filtered by the Q32 column
 * @method     ChildSurveylog findOneByQ33(string $Q33) Return the first ChildSurveylog filtered by the Q33 column
 * @method     ChildSurveylog findOneByCreatedAt(string $created_at) Return the first ChildSurveylog filtered by the created_at column
 * @method     ChildSurveylog findOneByUpdatedAt(string $updated_at) Return the first ChildSurveylog filtered by the updated_at column *

 * @method     ChildSurveylog requirePk($key, ConnectionInterface $con = null) Return the ChildSurveylog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOne(ConnectionInterface $con = null) Return the first ChildSurveylog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveylog requireOneById(int $id) Return the first ChildSurveylog filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByPatientId(int $patient_id) Return the first ChildSurveylog filtered by the patient_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ1(string $Q1) Return the first ChildSurveylog filtered by the Q1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ2(string $Q2) Return the first ChildSurveylog filtered by the Q2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ3(string $Q3) Return the first ChildSurveylog filtered by the Q3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ4(string $Q4) Return the first ChildSurveylog filtered by the Q4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ5(string $Q5) Return the first ChildSurveylog filtered by the Q5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ6(string $Q6) Return the first ChildSurveylog filtered by the Q6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ7(string $Q7) Return the first ChildSurveylog filtered by the Q7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ8(string $Q8) Return the first ChildSurveylog filtered by the Q8 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ9(string $Q9) Return the first ChildSurveylog filtered by the Q9 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ10(string $Q10) Return the first ChildSurveylog filtered by the Q10 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ11(string $Q11) Return the first ChildSurveylog filtered by the Q11 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ12(string $Q12) Return the first ChildSurveylog filtered by the Q12 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ13(string $Q13) Return the first ChildSurveylog filtered by the Q13 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ14(string $Q14) Return the first ChildSurveylog filtered by the Q14 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ15(string $Q15) Return the first ChildSurveylog filtered by the Q15 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ16(string $Q16) Return the first ChildSurveylog filtered by the Q16 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ17(string $Q17) Return the first ChildSurveylog filtered by the Q17 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ18(string $Q18) Return the first ChildSurveylog filtered by the Q18 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ19(string $Q19) Return the first ChildSurveylog filtered by the Q19 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ20(string $Q20) Return the first ChildSurveylog filtered by the Q20 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ21(string $Q21) Return the first ChildSurveylog filtered by the Q21 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ22(string $Q22) Return the first ChildSurveylog filtered by the Q22 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ23(string $Q23) Return the first ChildSurveylog filtered by the Q23 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ24(string $Q24) Return the first ChildSurveylog filtered by the Q24 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ25(string $Q25) Return the first ChildSurveylog filtered by the Q25 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ26(string $Q26) Return the first ChildSurveylog filtered by the Q26 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ27(string $Q27) Return the first ChildSurveylog filtered by the Q27 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ28(string $Q28) Return the first ChildSurveylog filtered by the Q28 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ29(string $Q29) Return the first ChildSurveylog filtered by the Q29 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ30(string $Q30) Return the first ChildSurveylog filtered by the Q30 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ31(string $Q31) Return the first ChildSurveylog filtered by the Q31 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ32(string $Q32) Return the first ChildSurveylog filtered by the Q32 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByQ33(string $Q33) Return the first ChildSurveylog filtered by the Q33 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByCreatedAt(string $created_at) Return the first ChildSurveylog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveylog requireOneByUpdatedAt(string $updated_at) Return the first ChildSurveylog filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveylog[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSurveylog objects based on current ModelCriteria
 * @method     ChildSurveylog[]|ObjectCollection findById(int $id) Return ChildSurveylog objects filtered by the id column
 * @method     ChildSurveylog[]|ObjectCollection findByPatientId(int $patient_id) Return ChildSurveylog objects filtered by the patient_id column
 * @method     ChildSurveylog[]|ObjectCollection findByQ1(string $Q1) Return ChildSurveylog objects filtered by the Q1 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ2(string $Q2) Return ChildSurveylog objects filtered by the Q2 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ3(string $Q3) Return ChildSurveylog objects filtered by the Q3 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ4(string $Q4) Return ChildSurveylog objects filtered by the Q4 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ5(string $Q5) Return ChildSurveylog objects filtered by the Q5 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ6(string $Q6) Return ChildSurveylog objects filtered by the Q6 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ7(string $Q7) Return ChildSurveylog objects filtered by the Q7 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ8(string $Q8) Return ChildSurveylog objects filtered by the Q8 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ9(string $Q9) Return ChildSurveylog objects filtered by the Q9 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ10(string $Q10) Return ChildSurveylog objects filtered by the Q10 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ11(string $Q11) Return ChildSurveylog objects filtered by the Q11 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ12(string $Q12) Return ChildSurveylog objects filtered by the Q12 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ13(string $Q13) Return ChildSurveylog objects filtered by the Q13 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ14(string $Q14) Return ChildSurveylog objects filtered by the Q14 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ15(string $Q15) Return ChildSurveylog objects filtered by the Q15 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ16(string $Q16) Return ChildSurveylog objects filtered by the Q16 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ17(string $Q17) Return ChildSurveylog objects filtered by the Q17 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ18(string $Q18) Return ChildSurveylog objects filtered by the Q18 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ19(string $Q19) Return ChildSurveylog objects filtered by the Q19 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ20(string $Q20) Return ChildSurveylog objects filtered by the Q20 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ21(string $Q21) Return ChildSurveylog objects filtered by the Q21 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ22(string $Q22) Return ChildSurveylog objects filtered by the Q22 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ23(string $Q23) Return ChildSurveylog objects filtered by the Q23 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ24(string $Q24) Return ChildSurveylog objects filtered by the Q24 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ25(string $Q25) Return ChildSurveylog objects filtered by the Q25 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ26(string $Q26) Return ChildSurveylog objects filtered by the Q26 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ27(string $Q27) Return ChildSurveylog objects filtered by the Q27 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ28(string $Q28) Return ChildSurveylog objects filtered by the Q28 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ29(string $Q29) Return ChildSurveylog objects filtered by the Q29 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ30(string $Q30) Return ChildSurveylog objects filtered by the Q30 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ31(string $Q31) Return ChildSurveylog objects filtered by the Q31 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ32(string $Q32) Return ChildSurveylog objects filtered by the Q32 column
 * @method     ChildSurveylog[]|ObjectCollection findByQ33(string $Q33) Return ChildSurveylog objects filtered by the Q33 column
 * @method     ChildSurveylog[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildSurveylog objects filtered by the created_at column
 * @method     ChildSurveylog[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildSurveylog objects filtered by the updated_at column
 * @method     ChildSurveylog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SurveylogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SurveylogQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Surveylog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSurveylogQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSurveylogQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSurveylogQuery) {
            return $criteria;
        }
        $query = new ChildSurveylogQuery();
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
     * @return ChildSurveylog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SurveylogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SurveylogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSurveylog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, patient_id, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15, Q16, Q17, Q18, Q19, Q20, Q21, Q22, Q23, Q24, Q25, Q26, Q27, Q28, Q29, Q30, Q31, Q32, Q33, created_at, updated_at FROM SurveyLog WHERE id = :p0';
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
            /** @var ChildSurveylog $obj */
            $obj = new ChildSurveylog();
            $obj->hydrate($row);
            SurveylogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSurveylog|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SurveylogTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SurveylogTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the patient_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPatientId(1234); // WHERE patient_id = 1234
     * $query->filterByPatientId(array(12, 34)); // WHERE patient_id IN (12, 34)
     * $query->filterByPatientId(array('min' => 12)); // WHERE patient_id > 12
     * </code>
     *
     * @see       filterByNewuser()
     *
     * @param     mixed $patientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByPatientId($patientId = null, $comparison = null)
    {
        if (is_array($patientId)) {
            $useMinMax = false;
            if (isset($patientId['min'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_PATIENT_ID, $patientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($patientId['max'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_PATIENT_ID, $patientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_PATIENT_ID, $patientId, $comparison);
    }

    /**
     * Filter the query on the Q1 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ1('fooValue');   // WHERE Q1 = 'fooValue'
     * $query->filterByQ1('%fooValue%'); // WHERE Q1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ1($q1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q1, $q1, $comparison);
    }

    /**
     * Filter the query on the Q2 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ2('fooValue');   // WHERE Q2 = 'fooValue'
     * $query->filterByQ2('%fooValue%'); // WHERE Q2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ2($q2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q2, $q2, $comparison);
    }

    /**
     * Filter the query on the Q3 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ3('fooValue');   // WHERE Q3 = 'fooValue'
     * $query->filterByQ3('%fooValue%'); // WHERE Q3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ3($q3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q3, $q3, $comparison);
    }

    /**
     * Filter the query on the Q4 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ4('fooValue');   // WHERE Q4 = 'fooValue'
     * $query->filterByQ4('%fooValue%'); // WHERE Q4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ4($q4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q4, $q4, $comparison);
    }

    /**
     * Filter the query on the Q5 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ5('fooValue');   // WHERE Q5 = 'fooValue'
     * $query->filterByQ5('%fooValue%'); // WHERE Q5 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q5 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ5($q5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q5)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q5, $q5, $comparison);
    }

    /**
     * Filter the query on the Q6 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ6('fooValue');   // WHERE Q6 = 'fooValue'
     * $query->filterByQ6('%fooValue%'); // WHERE Q6 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q6 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ6($q6 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q6)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q6, $q6, $comparison);
    }

    /**
     * Filter the query on the Q7 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ7('fooValue');   // WHERE Q7 = 'fooValue'
     * $query->filterByQ7('%fooValue%'); // WHERE Q7 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q7 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ7($q7 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q7)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q7, $q7, $comparison);
    }

    /**
     * Filter the query on the Q8 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ8('fooValue');   // WHERE Q8 = 'fooValue'
     * $query->filterByQ8('%fooValue%'); // WHERE Q8 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q8 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ8($q8 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q8)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q8, $q8, $comparison);
    }

    /**
     * Filter the query on the Q9 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ9('fooValue');   // WHERE Q9 = 'fooValue'
     * $query->filterByQ9('%fooValue%'); // WHERE Q9 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q9 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ9($q9 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q9)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q9, $q9, $comparison);
    }

    /**
     * Filter the query on the Q10 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ10('fooValue');   // WHERE Q10 = 'fooValue'
     * $query->filterByQ10('%fooValue%'); // WHERE Q10 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q10 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ10($q10 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q10)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q10, $q10, $comparison);
    }

    /**
     * Filter the query on the Q11 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ11('fooValue');   // WHERE Q11 = 'fooValue'
     * $query->filterByQ11('%fooValue%'); // WHERE Q11 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q11 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ11($q11 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q11)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q11, $q11, $comparison);
    }

    /**
     * Filter the query on the Q12 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ12('fooValue');   // WHERE Q12 = 'fooValue'
     * $query->filterByQ12('%fooValue%'); // WHERE Q12 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q12 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ12($q12 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q12)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q12, $q12, $comparison);
    }

    /**
     * Filter the query on the Q13 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ13('fooValue');   // WHERE Q13 = 'fooValue'
     * $query->filterByQ13('%fooValue%'); // WHERE Q13 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q13 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ13($q13 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q13)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q13, $q13, $comparison);
    }

    /**
     * Filter the query on the Q14 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ14('fooValue');   // WHERE Q14 = 'fooValue'
     * $query->filterByQ14('%fooValue%'); // WHERE Q14 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q14 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ14($q14 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q14)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q14, $q14, $comparison);
    }

    /**
     * Filter the query on the Q15 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ15('fooValue');   // WHERE Q15 = 'fooValue'
     * $query->filterByQ15('%fooValue%'); // WHERE Q15 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q15 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ15($q15 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q15)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q15, $q15, $comparison);
    }

    /**
     * Filter the query on the Q16 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ16('fooValue');   // WHERE Q16 = 'fooValue'
     * $query->filterByQ16('%fooValue%'); // WHERE Q16 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q16 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ16($q16 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q16)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q16, $q16, $comparison);
    }

    /**
     * Filter the query on the Q17 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ17('fooValue');   // WHERE Q17 = 'fooValue'
     * $query->filterByQ17('%fooValue%'); // WHERE Q17 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q17 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ17($q17 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q17)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q17, $q17, $comparison);
    }

    /**
     * Filter the query on the Q18 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ18('fooValue');   // WHERE Q18 = 'fooValue'
     * $query->filterByQ18('%fooValue%'); // WHERE Q18 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q18 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ18($q18 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q18)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q18, $q18, $comparison);
    }

    /**
     * Filter the query on the Q19 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ19('fooValue');   // WHERE Q19 = 'fooValue'
     * $query->filterByQ19('%fooValue%'); // WHERE Q19 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q19 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ19($q19 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q19)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q19, $q19, $comparison);
    }

    /**
     * Filter the query on the Q20 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ20('fooValue');   // WHERE Q20 = 'fooValue'
     * $query->filterByQ20('%fooValue%'); // WHERE Q20 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q20 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ20($q20 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q20)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q20, $q20, $comparison);
    }

    /**
     * Filter the query on the Q21 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ21('fooValue');   // WHERE Q21 = 'fooValue'
     * $query->filterByQ21('%fooValue%'); // WHERE Q21 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q21 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ21($q21 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q21)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q21, $q21, $comparison);
    }

    /**
     * Filter the query on the Q22 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ22('fooValue');   // WHERE Q22 = 'fooValue'
     * $query->filterByQ22('%fooValue%'); // WHERE Q22 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q22 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ22($q22 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q22)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q22, $q22, $comparison);
    }

    /**
     * Filter the query on the Q23 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ23('fooValue');   // WHERE Q23 = 'fooValue'
     * $query->filterByQ23('%fooValue%'); // WHERE Q23 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q23 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ23($q23 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q23)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q23, $q23, $comparison);
    }

    /**
     * Filter the query on the Q24 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ24('fooValue');   // WHERE Q24 = 'fooValue'
     * $query->filterByQ24('%fooValue%'); // WHERE Q24 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q24 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ24($q24 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q24)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q24, $q24, $comparison);
    }

    /**
     * Filter the query on the Q25 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ25('fooValue');   // WHERE Q25 = 'fooValue'
     * $query->filterByQ25('%fooValue%'); // WHERE Q25 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q25 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ25($q25 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q25)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q25, $q25, $comparison);
    }

    /**
     * Filter the query on the Q26 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ26('fooValue');   // WHERE Q26 = 'fooValue'
     * $query->filterByQ26('%fooValue%'); // WHERE Q26 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q26 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ26($q26 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q26)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q26, $q26, $comparison);
    }

    /**
     * Filter the query on the Q27 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ27('fooValue');   // WHERE Q27 = 'fooValue'
     * $query->filterByQ27('%fooValue%'); // WHERE Q27 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q27 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ27($q27 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q27)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q27, $q27, $comparison);
    }

    /**
     * Filter the query on the Q28 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ28('fooValue');   // WHERE Q28 = 'fooValue'
     * $query->filterByQ28('%fooValue%'); // WHERE Q28 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q28 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ28($q28 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q28)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q28, $q28, $comparison);
    }

    /**
     * Filter the query on the Q29 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ29('fooValue');   // WHERE Q29 = 'fooValue'
     * $query->filterByQ29('%fooValue%'); // WHERE Q29 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q29 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ29($q29 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q29)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q29, $q29, $comparison);
    }

    /**
     * Filter the query on the Q30 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ30('fooValue');   // WHERE Q30 = 'fooValue'
     * $query->filterByQ30('%fooValue%'); // WHERE Q30 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q30 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ30($q30 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q30)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q30, $q30, $comparison);
    }

    /**
     * Filter the query on the Q31 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ31('fooValue');   // WHERE Q31 = 'fooValue'
     * $query->filterByQ31('%fooValue%'); // WHERE Q31 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q31 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ31($q31 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q31)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q31, $q31, $comparison);
    }

    /**
     * Filter the query on the Q32 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ32('fooValue');   // WHERE Q32 = 'fooValue'
     * $query->filterByQ32('%fooValue%'); // WHERE Q32 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q32 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ32($q32 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q32)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q32, $q32, $comparison);
    }

    /**
     * Filter the query on the Q33 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ33('fooValue');   // WHERE Q33 = 'fooValue'
     * $query->filterByQ33('%fooValue%'); // WHERE Q33 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q33 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByQ33($q33 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q33)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_Q33, $q33, $comparison);
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
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SurveylogTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SurveylogTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Newuser object
     *
     * @param \Newuser|ObjectCollection $newuser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSurveylogQuery The current query, for fluid interface
     */
    public function filterByNewuser($newuser, $comparison = null)
    {
        if ($newuser instanceof \Newuser) {
            return $this
                ->addUsingAlias(SurveylogTableMap::COL_PATIENT_ID, $newuser->getId(), $comparison);
        } elseif ($newuser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SurveylogTableMap::COL_PATIENT_ID, $newuser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNewuser() only accepts arguments of type \Newuser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Newuser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function joinNewuser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Newuser');

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
            $this->addJoinObject($join, 'Newuser');
        }

        return $this;
    }

    /**
     * Use the Newuser relation Newuser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \NewuserQuery A secondary query class using the current class as primary query
     */
    public function useNewuserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNewuser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Newuser', '\NewuserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSurveylog $surveylog Object to remove from the list of results
     *
     * @return $this|ChildSurveylogQuery The current query, for fluid interface
     */
    public function prune($surveylog = null)
    {
        if ($surveylog) {
            $this->addUsingAlias(SurveylogTableMap::COL_ID, $surveylog->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the SurveyLog table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveylogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SurveylogTableMap::clearInstancePool();
            SurveylogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveylogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SurveylogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SurveylogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SurveylogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SurveylogQuery
