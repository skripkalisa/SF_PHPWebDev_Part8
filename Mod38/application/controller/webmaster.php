<?php
// require_once MODEL . "user.php";

class WebmasterController extends Controller
{
    public function index()
    {
        $this->view->generate('webmaster.phtml', 'template.phtml');
    }
    public function show($id)
    {
        $data = $this->model->getEntity()->getData();
        // var_dump($data);

        $this->view->generate('webmaster.phtml', 'template.phtml', $data);
        // echo $this->model->getUsers();
    }
}
