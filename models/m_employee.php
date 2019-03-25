<?php

// function get data and return an array()
function m_get_data() {
    $query = "select * from employee"; //could be more dynamic next time
    include 'connection.php';
    $result = mysqli_query($connection, $query);
    $rows = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($get_result_to_array = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[] = $get_result_to_array;
        }
    }
    return $rows;
}
function u_get_data() {
    $query = "select * from user";
    include 'connection.php';
    $result = mysqli_query($connection, $query);
    $rows = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($get_result_to_array = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[] = $get_result_to_array;
        }
    }
    return $rows;
}

function m_get_detail() {
    include 'connection.php';
    $id     = $_GET['id'];
    // var_dump($id);die();
    $query  = "SELECT * FROM employee WHERE id = '$id'"; //could be more dynamic next time
    $result = mysqli_query($connection, $query);
    return $result;
}

function u_get_detail() {
    include 'connection.php';
    $id     = $_GET['id'];
    // var_dump($id);die();
    $query  = "SELECT * FROM user WHERE id = '$id'"; //could be more dynamic next time
    $result = mysqli_query($connection, $query);
    return $result;
}

function validateFromDb() {
    include 'connection.php';

    if(isset($_POST['but_submit'])){

        $uname = mysqli_real_escape_string($connection,$_POST['txt_uname']);
        $password = md5(mysqli_real_escape_string($connection,$_POST['txt_pwd']));

        if ($uname != "" && $password != ""){

            $sql_query = "select count(*) as cntUser from user where username='".$uname."' and password='".$password."'";
            $result = mysqli_query($connection,$sql_query);
            $row = mysqli_fetch_array($result);

            $count = $row['cntUser'];

            if($count > 0){
                $_SESSION['uname'] = $uname;
                header('Location: index.php?action=view');
            }else{
                header('Location: index.php?action=login');
            }

        }

    }
}

function UserRegister() {
    include 'connection.php';
    $username = $_POST['username'];
    $name = $_POST['name'];
    $pwd = md5($_POST['pass']);
    
    $query = "insert into user(username, name, password) values('$username', '$name', '$pwd')";
    $result = mysqli_query($connection, $query);
    return $result;
}

function m_add_employee($data) { // get $POST
    include 'connection.php';
    // var_dump($data); die();
    $i = 0;
    foreach ($data as $field => $value) {

        if ($i > 0) {
            $fields .= ",";
            $values .= ",";
        }
        $fields .= $field;
        $values .= "'$value'";
        $i++;
    }
    $query = "insert into employee($fields) values($values)";
    $result = mysqli_query($connection, $query);
    return $result;
}

function m_edit_employee($data) {
    include 'connection.php';
    $id = $_GET['id'];
    $query = "UPDATE employee  SET ";
        foreach ($data as $field => $value) {
            $query .= " $field='$value',";
        }
    $query = substr($query, 0, -1);
    $query .= " WHERE id = '$id'";
    // var_dump($query);die();
    $result = mysqli_query($connection, $query);
    return $result;
}

function u_edit_user($data) {
    include 'connection.php';
    $id = $_GET['id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = md5($_POST['password']);

    $query = "UPDATE user  SET username = '$username', name='$name', password = '$password' WHERE id = '$id'";
    // var_dump($query);die();
    $result = mysqli_query($connection, $query);
    return $result;
}

 function m_get_delete() {
    include 'connection.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM employee WHERE id ='$id'";
    $result = mysqli_query($connection, $sql);
    return $result;
}

 function u_get_delete() {
    include 'connection.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE id ='$id'";
    $result = mysqli_query($connection, $sql);
    return $result;
}


?>