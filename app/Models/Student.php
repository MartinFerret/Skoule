<?php
namespace App\Models;
use App\Utils\Database;
use PDO;

class Student extends CoreModel {
    private $teacher_id;

    /**
     * Get the value of teacher_id
     */ 
    public function getTeacher_id()
    {
        return $this->teacher_id;
    }

    /**
     * Set the value of teacher_id
     *
     * @return  self
     */ 
    public function setTeacher_id($teacher_id)
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }

    static public function getStudentsForHome () {
        $pdo = Database::getPDO();

        $sql = " SELECT * FROM student  LIMIT 3";

        $pdoStatement = $pdo->query($sql);

        $students = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $students;
    }

    static public function find($Id)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `student` WHERE `id` =' . $Id;

        $pdoStatement = $pdo->query($sql);

        $student = $pdoStatement->fetchObject(self::class);

        return $student;
    }

    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `student`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `student` 
                (
                    firstname, 
                    lastname,  
                    status,
                    teacher_id

                )
            VALUES
                (
                    :firstname, 
                    :lastname, 
                    :status,
                    :teacher_id
                )
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':status', $this->status);
        $pdoStatement->bindValue(':teacher_id', $this->teacher_id);

        $pdoStatement->execute();

        $insertedRows = $pdoStatement->rowCount();

        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `student`
            SET
                firstname = :firstname,
                lastname = :lastname,
                status = :status,
                teacher_id =:teacher_id
            WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':status', $this->status);
        $pdoStatement->bindValue(':teacher_id', $this->teacher_id, PDO::PARAM_INT);

        $pdoStatement->execute();

        $updatedRows = $pdoStatement->rowCount();
        return ($updatedRows > 0);

    }

    public function delete()
    {
        $pdo = Database::getPDO();
        $sql = '
            DELETE FROM student
            WHERE id = :id
        ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $deletedRows = $pdoStatement->rowCount();

        return ($deletedRows > 0);
    }
}