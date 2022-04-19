<?php
namespace App\Models;
use App\Utils\Database;
use PDO;

class AppUser extends CoreModel{
    private $name;
    private $email;
    private $password;
    private $role;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    static public function findByEmail(string $email)
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM app_user
            WHERE email = :email
        ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
        $pdoStatement->execute();
        // Pour voir la requête réellement exécutée après remplacement
        // des tokens, on peut utiliser :
        // $pdoStatement->debugDumpParams();
        $appUser = $pdoStatement->fetchObject(self::class);

        return $appUser;
    }

    static public function find($Id)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `app_user` WHERE `id` =' . $Id;

        $pdoStatement = $pdo->query($sql);

        $appUser = $pdoStatement->fetchObject(self::class);

        return $appUser;
    }

    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `app_user`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }
}