<?php
namespace App\Models;
use App\Utils\Database;
use PDO;

class Teacher extends CoreModel {

    private $job;
    

    /**
     * Get the value of job
     */ 
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set the value of job
     *
     * @return  self
     */ 
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    static public function getTeachersForHome () {
        $pdo = Database::getPDO();

        $sql = " SELECT * FROM teacher  LIMIT 3";

        $pdoStatement = $pdo->query($sql);

        $teachers = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $teachers;
    }

    static public function find($Id)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `teacher` WHERE `id` =' . $Id;

        $pdoStatement = $pdo->query($sql);

        $teacher = $pdoStatement->fetchObject(self::class);

        return $teacher;
    }

    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `teacher`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `teacher` 
                (
                    firstname, 
                    lastname, 
                    job, 
                    status

                )
            VALUES
                (
                    :firstname, 
                    :lastname, 
                    :job, 
                    :status
                )
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':job', $this->job, PDO::PARAM_STR);
        $pdoStatement->bindValue(':status', $this->status);

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
            UPDATE `teacher`
            SET
                firstname = :firstname,
                lastname = :lastname,
                status = :status,
                job =:job
            WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue(':status', $this->status);
        $pdoStatement->bindValue(':job', $this->job);

        $pdoStatement->execute();

        $updatedRows = $pdoStatement->rowCount();
        return ($updatedRows > 0);

    }
    public function delete()
    {
        $pdo = Database::getPDO();
        $sql = '
            DELETE FROM teacher
            WHERE id = :id
        ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $deletedRows = $pdoStatement->rowCount();

        return ($deletedRows > 0);
    }

}