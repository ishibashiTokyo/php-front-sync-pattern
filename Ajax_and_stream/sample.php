<?php
// ストリーム出力するためのヘッダー設定
header('Content-type: application/octet-stream; charset=UTF-8');
header('Transfer-encoding: chunked');
@ob_flush();
@flush();

// 最大実行時間の設定（仮で１時間）
set_time_limit(60 * 60);

$counter = 0;
// 通信終了まで延々とレスポンスを返す
while (!connection_aborted()) {
    // レスポンスするデータ
    $date = date_create();
    $streamed_on = date_format($date, 'Y-m-d H:i:s');

    // データをJSON化する
    $json = json_encode(
        array(
            'streamed_on' => $streamed_on,
            'count' => $counter++
        )
    );

    // データをブラウザ側に掃き出し
    output_chunk($json . PHP_EOL);

    @ob_flush();
    @flush();

    // サンプル用のディレイ
    sleep(1);
}

// ストリーム出力終了
output_chunk('');

// チャンク化されたデータを掃き出す
function output_chunk($chunk)
{
    // echo sprintf("%x\r\n", strlen($chunk));
    echo $chunk . "\r\n";
}
