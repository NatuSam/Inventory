<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET' ){
    if (!empty($_GET['pc'])) {
        @check($_GET['pc']);
    }
    else if(!empty($_GET['st'])){
        store($_GET['st']);
    }
    else if(!empty($_GET['Tot'])){
        transaction($_GET['Tot'],$_GET['sort']);
    } 
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['newname'])) {
            @newP($_POST['Apcode'], $_POST['newname'], $_POST['no'], $_POST['store'], $_POST['loc']);
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['Anpcode']) || !empty($_POST['Addamt']))) {
        if (!empty($_POST['Anpcode'])) {
            @addN1($_POST['Anpcode'], $_POST['amt']);
        } else if (!empty($_POST['Addamt'])) {
            @addN($_SESSION['item']['P_code'], $_POST['Addamt']);
    
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['Tpcode']) || !empty($_POST['Tamt']))) {
        if (!empty($_POST['Tpcode'])) {
            @take1($_POST['Tpcode'], $_POST['amt']);
        } else if (!empty($_POST['Tamt'])) {
            @take($_SESSION['item']['P_code'], $_POST['Tamt']);
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  !empty($_POST['Ename'])) {
        $Ename = $_POST['Ename'];
        $pos = $_POST['pos'];
        $lang = $_POST['lang'];
        $pass = $_POST['pword'];
        $query = "insert into employee(Name,Position,Language,Password) VALUES ('$Ename','$pos','$lang','$pass')";
        $result = mysqli_query($con, $query);
    } else if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['done'])){
            orderdone($_POST['done']);
        $_POST['done'] = null;
    }
}   
?>