<?php
// require_once  MODEL . "merchant.php";
require_once CORE . "controller.php";


class MerchantController extends Controller
{
    public function __construct()
    {
        // $this->model = new Merchant();
        $this->view = new View();
    }
    public function index()
    {
        // $data = $this->model->getData();
        $this->view->generate('merchant.phtml', 'template.phtml');
    }
}
