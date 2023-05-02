<?php 
require("takeAndCheck.php");
require("storeAndTransaction.php");
require("result.php");
require("newAndAdd.php");
require("employee.php");

/*if (empty($_SESSION['Emp']['Name'])) {
        $_SESSION['re'] = $_POST['pc'];
        header("Location: login.php");
} */
if($_SERVER['REQUEST_METHOD'] == 'GET' ){
    if (!empty($_GET['pc'])) {
         check($_GET['pc']);
    }
    else if(!empty($_GET['st'])){
        store($_GET['st']);
    }
    else if(!empty($_GET['Tot'])){
        transaction($_GET['Tot'],$_GET['sort']);
    } 
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if (!empty($_POST['pc'])) {
        check($_POST['pc']);
    }
    else if (!empty($_POST['newname'])) {
            newP($_POST['Apcode'], $_POST['newname'], $_POST['no'], $_POST['store'], $_POST['loc']);
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['Anpcode']) || !empty($_POST['Addamt']))) {
        if (!empty($_POST['Anpcode'])) {
            addN1($_POST['Anpcode'], $_POST['amt']);
        } else if (!empty($_POST['Addamt'])) {
            addN($_SESSION['item']['P_code'], $_POST['Addamt']);
    
        }
    } else if (!empty($_POST['Tpcode']) || !empty($_POST['Tamt'])) {
        if (!empty($_POST['Tpcode'])) {
            take1($_POST['Tpcode'], $_POST['amt']);
        } else if (!empty($_POST['Tamt'])) {
            take($_SESSION['item']['P_code'], $_POST['Tamt']);
        }
    } else if (!empty($_POST['Ename'])) {
        newEmp($_POST['Ename'],$_POST['pos'],$_POST['pword']);
    } else if (!empty($_POST['FpEname'])) {
            pReset($_POST['FpEname'],$_POST['FpEpword'],$_POST['Aname'],$_POST['Apword']);
         
    } else if(!empty($_POST['done'])){
            orderdone($_POST['done']);
        $_POST['done'] = null;
    }else if (!empty($_POST['NstId'])) {
        newStore($_POST['NstId'],$_POST['NstName'],$_POST['NstDis']);
     }
}   
?>