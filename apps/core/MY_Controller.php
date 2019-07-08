<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

}

class Eodb extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
    }

}

class Eodbu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata("userlogged")) {
            redirect(site_url("site/login"), "refresh");
        }
    }

}

class Eodbc extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata("cms_userlogged")) {
            redirect(site_url("cms/login"), "refresh");
        }
    }

}

class Eodba extends MY_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata("stafflogged")) {
            redirect(site_url("staffs/login"), "refresh");
        }
    }

}

class Eodbs extends MY_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata("stafflogged")) {
            redirect(site_url("staffs/login"), "refresh");
        }
    }

}
