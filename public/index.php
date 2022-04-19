<?php

require_once '../vendor/autoload.php';

session_start();

$router = new AltoRouter();

$_SERVER['BASE_URI'] = '/';


$router->map('GET', '/', ['method' => 'home', 'controller' => '\App\Controllers\HomeController'], 'home');

$router->map('GET', '/teachers', ['method' => 'teacherList', 'controller' => '\App\Controllers\TeacherController'], 'teacher-list');

$router->map('GET', '/students', ['method' => 'studentList', 'controller' => '\App\Controllers\StudentController'], 'student-list');

$router->map('GET', '/teacher/add', ['method' => 'add', 'controller' => '\App\Controllers\TeacherController'], 'teacher-add');

$router->map('POST', '/teacher/add', ['method' => 'create', 'controller' => '\App\Controllers\TeacherController'], 'teacher-create');

$router->map('GET', '/student/add', ['method' => 'add', 'controller' => '\App\Controllers\StudentController'], 'student-add');

$router->map('POST', '/student/add', ['method' => 'create', 'controller' => '\App\Controllers\StudentController'], 'student-create');

$router->map('GET', '/student/update/[i:id]', ['method' => 'update', 'controller' => '\App\Controllers\StudentController'], 'student-update');

$router->map('POST', '/student/update/[i:id]', ['method' => 'updateStudent', 'controller' => '\App\Controllers\StudentController'], 'student-update-post');

$router->map('GET', '/teacher/update/[i:id]', ['method' => 'update', 'controller' => '\App\Controllers\TeacherController'], 'teacher-update');

$router->map('POST', '/teacher/update/[i:id]', ['method' => 'updateTeacher', 'controller' => '\App\Controllers\TeacherController'], 'teacher-update-post');

$router->map('GET', '/signin', ['method' => 'loginView', 'controller' => '\App\Controllers\UserController'], 'signin');

$router->map('POST', '/signin', ['method' => 'login', 'controller' => '\App\Controllers\UserController'], 'signin-post');

$router->map('GET', '/logout', ['method' => 'logout', 'controller' => '\App\Controllers\UserController'], 'logout');

$router->map('GET', '/student/delete/[i:id]', ['method' => 'delete', 'controller' => '\App\Controllers\StudentController'], 'delete-student');

$router->map('GET', '/teacher/delete/[i:id]', ['method' => 'delete', 'controller' => '\App\Controllers\TeacherController'], 'delete-teacher');

$router->map('GET', '/users', ['method' => 'userList', 'controller' => '\App\Controllers\UserController'], 'user-list');




$match = $router->match();

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');


 if ($match !== false) { 
    $dispatcher->setControllersArguments($match['name']);

} 

$dispatcher->dispatch();