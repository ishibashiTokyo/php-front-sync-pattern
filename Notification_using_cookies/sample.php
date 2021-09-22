<?php
// 時間のかかる処理を実行
sleep(10);


// 処理が終わったらクッキーを発行してフロントに知らせる
setcookie("exported", "yes", time() + 60, '/');

$input = "sample_data";
$filename = 'samplefile.txt';

// $inputを$filenameに書き込みます。
file_put_contents($filename, $input);

// readfileを使う際の最低限の設定
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename=$filename");

// $filenameという名前でダウンロード
readfile($filename);
