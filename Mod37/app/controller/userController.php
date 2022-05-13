<?php

// namespace App\Controller;

class userController extends Controller
{
    public function index()
    {
        $this->model('user');
        $this->view(
            'user' . DIRECTORY_SEPARATOR . 'index',
            ['users' => $this->model->getUsers()]
        );
        $this->view->render();
    }
}
