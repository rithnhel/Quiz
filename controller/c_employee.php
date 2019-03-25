<?php

$data = array();
get_action($data);

// Default page to load for the first time

function get_action(&$data) { // Main action to start the systme process
    $fun = 'login';
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $fun = $action; // Get function name from action variable
    }

    $fun($data);        // call function name($data);
}

function login(&$data) {
    $data['page'] = "login";
}

function register(&$data) {
    $data['page'] = "user/register";
}

function registerUser() {
    
    $user = UserRegister();

    if(isset($_SESSION['uname'])){
        header('Location: index.php?action=viewUser');
    }else{
        if ($user) {
            $action ="login";
        } else {
            $action = "register";
        }
        header("Location: index.php?action=$action");
    }
}

function logout(&$data){
    // logout
    if(isset($_POST['but_logout'])){
        session_destroy();
        header('Location: index.php?action=login');
    }
}

function loginValidate(&$data) {
    validateFromDb();
}

function add(&$data) {
    if(!isset($_SESSION['uname'])){
        header('Location: index.php?action=login');
    }else{
        $data['page'] = "employee/add";
    }
}

function view(&$data) { // defauld page 
    if(!isset($_SESSION['uname'])){
        header('Location: index.php?action=login');
    }else{
        $data['employee_data'] = m_get_data();
        $data['page'] = "employee/view";  //call page view 
    }
}


function edit(&$data) {
    if(!isset($_SESSION['uname'])){
        header('Location: index.php?action=login');
    }else{
        $data['employee_data'] = m_get_detail();
        $data['page'] = "employee/edit";
    }
}

function editUser(&$data) {
    if(!isset($_SESSION['uname'])){
        header('Location: index.php?action=login');
    }else{
        $data['user_data'] = u_get_detail();
        $data['page'] = "user/edit";
    }
}

function delete(&$data){
    $data_delete = m_get_delete();
    if ($data_delete) {
        $action ="view";
    } else {
        echo "You canot delete this .'$id'.";
        $action = "view";
    }
    header("Location: index.php?action=$action");
}

function deleteUser(&$data){
    $data_delete = u_get_delete();
    if ($data_delete) {
        $action ="viewUser";
    } else {
        echo "You canot delete this .'$id'.";
        $action = "view";
    }
    header("Location: index.php?action=$action");
}

function detail(&$data) {
    if(!isset($_SESSION['uname'])){
        header('Location: index.php?action=login');
    }else{
        $data['employee_data_detail'] = m_get_detail();
        $data['page'] = "employee/detail";
    }
}

function get_form_data(&$data) {
    $add_data = m_add_employee($_POST);
    if ($add_data) {
        $action ="view";
    } else {
        $action ="add";
    }
    header("Location: index.php?action=$action");
}

function edit_get_form_data(&$data) {
   $edit = m_edit_employee($_POST);
   if($edit){
       $action = "view" ;
   }else {
        $action = "edit&id=$id";
   }
   header("Location: index.php?action=$action");
   
}

function updateUser(&$data) {
   $edit = u_edit_user($_POST);
   if($edit){
       $action = "viewUser" ;
   }else {
        $action = "editUser&id=$id";
   }
   header("Location: index.php?action=$action");
   
}

function viewUser(&$data) {
    if(!isset($_SESSION['uname'])){
        header('Location: index.php?action=login');
    }else{
        $data['user_data'] = u_get_data();
        $data['page'] = "user/view"; 
    }
}



?>