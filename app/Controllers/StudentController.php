<?php

namespace App\Controllers;
use App\Models\Student;
use App\Models\Teacher;

class StudentController extends CoreController {
    public function studentList () {
        $students = Student::findAll();
        $this->show('student/list', ['studentList' => $students ]);
    }

    public function add () {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        $teachers = Teacher::findAll();
        $this->show('student/add', ['teachers' => $teachers, 'token' => $token]);
    }

    public function create () {
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, 'status');
        $teacher_id = filter_input(INPUT_POST, 'teacher');
    
    
        $studentToInsert = new Student();
    
        $studentToInsert->setFirstname($firstname);
        $studentToInsert->setLastname($lastname);
        $studentToInsert->setStatus($status);
        $studentToInsert->setTeacher_id($teacher_id);
    
        if($studentToInsert->insert()) {
            $this->redirect('student-list');
        } else {
            echo 'Il y a eu un problème quelque part !';
        }
    }

    public function update ($id) {

        $teachers = Teacher::findAll();
        $student = Student::find($id);
        $this->show('student/update', ['teachers' => $teachers, 'student' => $student]);
    }

    public function updateStudent ($id) {

        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, 'status');
        $teacher_id = filter_input(INPUT_POST, 'teacher');
    
    
        $studentToUpdate = Student::find($id);
    
        $studentToUpdate->setFirstname($firstname);
        $studentToUpdate->setLastname($lastname);
        $studentToUpdate->setStatus($status);
        $studentToUpdate->setTeacher_id($teacher_id);


        if ($studentToUpdate->update()) {
            $this->redirect('student-list');
        } else {
            exit("Echec lors de la mise à jour de l'étudiant !");
        }

    }

    public function delete ($id) {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $deletedStudent = Student::find($id);

        if ($deletedStudent->delete()) {
            $this->redirect('student-list', ['token' => $token]);
        } else {
            exit('Echec lors de la suppression');
        }
    }
}