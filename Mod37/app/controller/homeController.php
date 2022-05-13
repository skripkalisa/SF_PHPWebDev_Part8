<?php


class homeController extends Controller
{
    public function index($id='', $name='')
    {
        // echo 'Class name: ' . __CLASS__ . ' Method: ' . __METHOD__;
        // echo 'Id is: ' . $id . ' Name is: ' .  $name;
        $this->view('home'. DIRECTORY_SEPARATOR.'index', [
            'name' => $name,
            'id' => $id
        ]);
        $this->view->page_title = 'Index';
        // var_dump($this);
        $this->view->render();
    }
    public function contact()
    {
        // echo 'Class name: ' . __CLASS__ . ' Method: ' . __METHOD__;
        $this->view('home'. DIRECTORY_SEPARATOR.'contact', [

        ]);
        // var_dump($this);
                $this->view->page_title = 'Contact';

        $this->view->render();
    }
}
