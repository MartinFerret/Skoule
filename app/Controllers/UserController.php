<?php
namespace App\Controllers;
use App\Models\AppUser;

class UserController extends CoreController{
    
    public function loginView () {
        $this->show('user/signin');
    }

    public function userList () {
        $users = AppUser::findAll();
        $this->show('user/list', ['users' => $users]);
    }

    public function login () {

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $user = AppUser::findByEmail($email);

        if ($user !== false) {


            if (password_verify($password, $user->getPassword())) {

                echo 'Connexion ok';

                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;

                $this->redirect('home');
            } else {
                exit('Courriel ou mot de passe incorrect');
            }
        } else {
            exit('Courriel ou mot de passe incorrect');
        }
    }

    public function logout () {
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);

        $this->redirect('home');
    }
}