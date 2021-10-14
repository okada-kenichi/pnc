<?php
// 文字コード設定
header('Content-Type: application/json; charset=UTF-8');

// pncが存在するかつpncが数字のみで構成されているか
if(isset($_GET["pnc"]) && !preg_match('/[^0-9]/', $_GET["pnc"]) && ($_GET["pnc"]) < 10000000) {
    // pncをエスケープ(xss対策)
    $param = (int)htmlspecialchars($_GET["pnc"]);
    $arr["status"] = "OK";
    //メイン処理
    for($i = 2; $i < sqrt($param); $i++){//平方根まで調べればいいのでsqrt()
        if($param % $i == 0){
            $remainder = 0;
            break;//割り切れた瞬間、合成数であることが確定するのでブレイクしてforを抜ける
        }
        $remainder += 1;
    }
    var_dump($remainder);
    if($remainder == 0){
        $arr["number"] = "{$param} is Composite number";
    }else{
        $arr["number"] = "{$param} is Prime number";
    }
    
} else {
    // paramの値が不適ならstatusをnoにしてプログラム終了
    $arr["status"] = "no";
    var_dump($param);
}

// 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
print json_encode($arr, JSON_PRETTY_PRINT);

//http://localhost/fst_webapi/pnc.php?pnc=10

//https://note.com/kazztech/n/ndb3a5468f299
?>