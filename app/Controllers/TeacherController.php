<?php

namespace App\Controllers;
use App\Models\Teacher;

class TeacherController extends CoreController {

public function teacherList () {
    $teachers = Teacher::findAll();
    $this->show('teacher/list', ['teacherList' => $teachers ]);
}

public function add () {
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;
    $this->show('teacher/add', ['token' => $token]);
}

public function create () {
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
    $job = filter_input(INPUT_POST, 'job', FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST, 'status');

    $errorList = [];

    if ($firstname == '') {
        $errorList[] = 'Votre Prénom n\'est pas valide';
    }     if ($lastname == '') {
        $errorList[] = 'Votre Nom n\'est pas valide';
    }     if ($job == '') {
        $errorList[] = 'Votre Profession n\'est pas valide';
    }     if ($status == '') {
        $errorList[] = 'Votre Statut n\'est pas valide';
    }


    $teacherToInsert = new Teacher();

    $teacherToInsert->setFirstname($firstname);
    $teacherToInsert->setLastname($lastname);
    $teacherToInsert->setJob($job);
    $teacherToInsert->setStatus($status);

    if ($teacherToInsert->insert()) {
        $this->redirect('teacher-list');
    } else {
        $this->show('teacher/add', ['error_list' => $errorList]);
    }
}

public function update ($id) {


    $teacher = Teacher::find($id);
    $this->show('teacher/update', ['teacher' => $teacher]);
}

public function updateTeacher ($id) {

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST, 'status');
    $job = filter_input(INPUT_POST, 'job');


    $studentToUpdate = Teacher::find($id);

    $studentToUpdate->setFirstname($firstname);
    $studentToUpdate->setLastname($lastname);
    $studentToUpdate->setStatus($status);
    $studentToUpdate->setjob($job);


    if ($studentToUpdate->update()) {
        $this->redirect('teacher-list');
    } else {
        exit("Echec lors de la mise à jour du Professeur !");
    }

}

public function delete ($id) {

    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;

    $deletedTeacher = Teacher::find($id);

    if ($deletedTeacher->delete()) {
        $this->redirect('teacher-list', ['token' => $token]);
    } else {
        exit('Echec lors de la suppression');
    }
}
}