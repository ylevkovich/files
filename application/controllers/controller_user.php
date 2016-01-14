<?php

class Controller_User extends Controller
{

	function __construct()
	{
		$this->model = new Model_User();
		$this->view = new View();
	}

    function action_index()
    {
        $data = $this->model->login();
        $this->view->generate('user/login_view.php', 'template_view.php', $data);
    }

    function action_registration()
    {
        $data = $this->model->registration();
        $this->view->generate('user/registration_view.php', 'template_view.php', $data);
    }

    function action_login()
    {
        $data = $this->model->login();
        $this->view->generate('user/login_view.php', 'template_view.php', $data);
    }

    function action_logout()
    {
        $this->model->logout();
    }

    function action_confirnLogin()
    {
        $this->model->confirnLogin();
//        $this->view->generate('user/registration_view.php', 'template_view.php', $data);
    }
}
