<?php

namespace App\Controllers;

class ErrorController extends CoreController {

    public  function err403()
    {

        echo 'Accès interdit';
        $this->show('error/error403');

        exit();
    }


    public function err404()
    {

        header('HTTP/1.0 404 Not Found');

        $this->show('error/error404');

        exit();
    }
}