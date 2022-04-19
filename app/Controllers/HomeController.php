<?php

namespace App\Controllers;
use App\Models\Student;
use App\Models\Teacher;

class HomeController extends CoreController 
{
public function home () {
    $teachers = Teacher::getTeachersForHome();
    $students = Student::getStudentsForHome();
    $this->show('main/home', ['teachers' => $teachers, 'students' => $students]);
}
}