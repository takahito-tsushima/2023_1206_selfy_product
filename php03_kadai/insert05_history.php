<?php

require_once('funcs.php');


//1. POSTデータ取得
$childhood = $_POST['childhood'];
$teenage = $_POST['teenage'];
$new_grad = $_POST['new_grad'];
$job_change = $_POST['job_change'];
$crossroads = $_POST['crossroads'];
$vision = $_POST['vision'];


//2. DB接続します   try=内容を実行  catch=エラーがあれば処理を止めて以下を実行
$pdo = db_conn();


//３．データ登録SQL作成

// 1. SQL文を用意    【 処理の内容 を記述 】
$stmt = $pdo->prepare("INSERT INTO register05_history(
  id,
  childhood,
  teenage,
  new_grad,
  job_change,
  crossroads,
  vision,
  date)
                      
VALUES(NULL,
  :childhood,
  :teenage,
  :new_grad,
  :job_change,
  :crossroads,
  :vision,
  sysdate() )" 
);


//  2. バインド変数を用意    【 SQL injection 攻撃の回避 】
// ※フォームからそのままデータを取り込むのは危険 → :○○と置いてから取り込み処理を実行

// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':childhood', $childhood, PDO::PARAM_STR);
$stmt->bindValue(':teenage', $teenage, PDO::PARAM_STR);
$stmt->bindValue(':new_grad', $new_grad, PDO::PARAM_STR);
$stmt->bindValue(':job_change', $job_change, PDO::PARAM_STR);
$stmt->bindValue(':crossroads', $crossroads, PDO::PARAM_STR);
$stmt->bindValue(':vision', $vision, PDO::PARAM_STR);


//  3. 実行
$status = $stmt->execute();


//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{


  //５．index.phpへリダイレクト
header('Location: register05_history.php');
}


?>
