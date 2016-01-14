<?php

class Controller_Files extends Controller
{

	function __construct()
	{
		$this->model = new Model_Files();
		$this->view = new View();
	}

    function action_index()
    {
        if($_GET['hash'])
        {
            $this->model->takeFile($_GET['hash']);
        }
        else if($this->model->get_data())
        {
            $data = $this->model->functional_panel();
            $this->view->generate('files/main_view.php', 'template_view.php',$data);
        }
    }

    function action_upload()
    {
        if($this->model->get_data())
        {
            $this->model->upload();
        }
    }

    function action_delFile()
    {
        if($this->model->get_data())
        {
            $this->model->delFile();
        }
    }

    function action_share()
    {
        if($this->model->get_data())
        {
            $data = $this->model->share();
            $this->view->generate('files/share_view.php', 'template_view.php',$data);
        }
    }

    function action_downloadFile()
    {
        if($this->model->get_data())
        {
            $this->model->downloadFile();
        }
    }
}
