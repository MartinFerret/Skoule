<?php
namespace App\Controllers;

abstract class CoreController
{

    public function __construct($Id = '')
    {
        $accessControlList = [
            'teacher-list' => ['admin'],
            'student-list' => ['admin'],
            'teacher-add' => ['admin'],
            'student-add' => ['admin'],
            'teacher-create' => ['admin'],
            'student-create' => ['admin'],
            'teacher-update' => ['admin'],
            'teacher-update-post' => ['admin'],
            'delete-teacher' => ['admin'],
            'delete-student' => ['admin'],
        ];

        if (array_key_exists($Id, $accessControlList)) {
            $authorizedRoles = $accessControlList[$Id];
            $this->checkAuthorization($authorizedRoles);
        }


        CoreController::checkCsrfToken($Id);
    }

    public static function checkCsrfToken($routeId)
    {
        $csrfTokenToCheckInPost = [
            'teacher-create',
            'student-create',

        ];

        if (in_array($routeId, $csrfTokenToCheckInPost)) {

            $formToken = filter_input(INPUT_POST, 'token');

            $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

            if (empty($formToken) || empty($sessionToken) || $formToken !== $sessionToken) {
                $error = new ErrorController();
                $error->err403();
            } else {

                unset($_SESSION['token']);
            }
        }


    }

    protected function redirect($routeId)
    {
        global $router;
        header('Location: ' . $router->generate($routeId));
        exit();
    }

    protected function checkAuthorization($authorizedRoles)
    {
        // Si l'utilisateur est connecté ?
        if (isset($_SESSION['userId'])) {

            
            $user = $_SESSION['userObject'];

            $role = $user->getRole();
            
            if (in_array($role, $authorizedRoles)) {
                return true;
            } else {
                
                $errorController = new ErrorController();
                $errorController->err403();
            }
        } else {
            $this->redirect('signin');
        }
    }

    protected function show($viewName, $viewData = [])
    {
        global $router;
        extract ($viewData);


        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}