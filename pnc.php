<?php
// 文字コード設定
header('Content-Type: application/json; charset=UTF-8');

// pncが存在するかつpncが数字のみで構成されているか、かつ10桁以下か
if(isset($_GET["pnc"]) && !preg_match('/[^0-9]/', $_GET["pnc"]) && ($_GET["pnc"]) < 10000000000) {
    // pncをエスケープ(xss対策)
    $param = (int)htmlspecialchars($_GET["pnc"]);
    $arr["status"] = "成功";
    //メイン処理
    $remainder = 1;//初期値として1を代入
    for($i = 2; $i < ceil(sqrt($param)); $i++){//平方根まで調べればいいのでsqrt()でceilにて小数点以下切り上げ
        if($param % $i == 0){
            $remainder = 0;//割り切れたら0を代入
            break;//割り切れた瞬間、合成数であることが確定するのでブレイクしてforを抜ける
        }
        //$remainderは1のまま変化せず
    }
    
    if($remainder == 0){
        $arr["number"] = "Composite number";
    }else{
        $arr["number"] = "Prime number";
    }
    $cal = (int)$i - 1;
    $arr["checknumber"] = "{$param}";
    $arr["calculations"] = "{$cal} times";
    
} else {
    // paramの値が不適ならstatusをnoにしてプログラム終了
    $arr["status"] = "no";
}

// 配列をjson形式にデコードして出力, 第二引数は、日本語対応｜整形するためのオプション
echo json_encode($arr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

//https://note.com/kazztech/n/ndb3a5468f299 参考
?>
