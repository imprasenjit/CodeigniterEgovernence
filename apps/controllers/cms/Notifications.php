<?php

/**
 * Description of Notifications
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends Eodbc {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model("cms/Notifications_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->view("cms/requires/header", array("title" => "Notifications"));
        $this->load->view("cms/notifications/notifications");
        $this->load->view("cms/requires/footer");
    }

    //End of index()

    function getNotifications() {
        $this->load->model("cms/notifications_model");
        $this->notifications_model->getNotifications();
    }

    //End of getNotifications()

    function AddNotification() {
        $this->load->model("cms/notifications_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->view("cms/requires/header", array("title" => "Add New Notifications"));
        $this->load->view("cms/notifications/addnotifications");
        $this->load->view("cms/requires/footer");
    }

    //End of AddNotification()

    function savenotifications() {
        $this->load->model("cms/notifications_model");
        $this->notifications_model->savenotifications();
    }

    //End of savenotifications()

    function notificationview() {
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("cms/notifications_model");
        $this->load->view("cms/requires/header", array("title" => "View Notification"));
        $this->load->view("cms/notifications/notificationview");
        $this->load->view("cms/requires/footer");
    }

    //End of notificationview()

    function editnotification() {
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("cms/notifications_model");
        $this->load->view("cms/requires/header", array("title" => "View Notification"));
        $this->load->view("cms/notifications/editnotification");
        $this->load->view("cms/requires/footer");
    }

    //End of editnotification()
    
       function updatenotification() {
        $this->load->model("cms/notifications_model");
        $this->notifications_model->updatenotification();
    }

    //End of updatenotification()
}
