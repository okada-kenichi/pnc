# pnc

##URLクエリの数字が素数かどうか判定する
?pnc=n (nは10桁以下の整数)
でその数が素数かチェックしてJSONで返す。

通信の状態と素数判定結果と判定に至るまでの計算の回数を返す。
素数判定は総当たりで平方根までの約数を調べる。
割り切れた場合即座に計算を終了する。（例:偶数の場合計算は1回で終わる）
