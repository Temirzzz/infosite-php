<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

function connect () {
    $conn = mysqli_connect(SERVERNAME, USENAME, PASSWORD, BASENAME);
    mysqli_set_charset($conn, "utf8");

    if (mysqli_connect_errno()) {
        printf("Не удалось подключиться: %s\n", mysqli_connect_error());
        exit();
    }
    return $conn;
}

function select ($conn) {
    $sql = "SELECT * FROM info";
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row;
        }
    }      
    return $a;
}

function select_main ($conn) {
    $offset = 0;

    if (isset($_GET['page']) AND trim($_GET['page']) != '') {
        $offset = trim($_GET['page']);
    }

    $sql = "SELECT * FROM info ORDER BY id DESC LIMIT 3 OFFSET ".$offset*3;
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row;
        }
    }      
    return $a;
}

function select_article ($conn) {
    $sql = "SELECT * FROM info WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } 
    return false;
}

//------------------------------------------

function pagination_count ($conn) {
    $sql = "SELECT * FROM info";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);
    //var_dump($result);
    return ceil($result/3);
}

function get_all_tags ($conn) {
    $sql = "SELECT DISTINCT(tag) FROM tag";
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row['tag'];
        }
    }      
    return $a;
}
//--------------------------------------------------
function get_article_tags ($conn) {
    $sql = "SELECT * FROM tag WHERE post=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row;
        }
    }      
    return $a;
}

//-------------------------------------------------
function get_post_from_tags ($conn) {
    $sql = "SELECT post FROM tag WHERE tag='".$_GET['tag']."'";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row['post'];
        }
    } 

    $sql = "SELECT * FROM info WHERE id in (".join(",", $a).")";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}

//------------------------------
function get_post_from_category ($conn) {
    $sql = "SELECT * FROM info WHERE category=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row;
        }
    }          
    return $a;
}

//--------------------tcnm
function get_cat_info ($conn) {
    $sql = "SELECT * FROM category WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
    }          
    return $row;
}
//-----------------tcnm
function get_all_cat_info ($conn) {
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);

    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row;
        }
    }          
    return $a;
}
//-----------------------------------------
function close ($conn) {
    mysqli_close($conn);
}