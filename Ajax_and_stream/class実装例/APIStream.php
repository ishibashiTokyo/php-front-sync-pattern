<?php
namespace sample;

class APIStream
{
    private static $response = [
        'streamed_on' => '',
        'count' => 0
    ];
    public static function start()
    {
        // ストリーム出力するためのヘッダー設定
        header("Content-type: application/octet-stream; charset=UTF-8");
        header("Transfer-encoding: chunked");
        // ini_set('implicit_flush', 1);
        // ob_implicit_flush(1);

        @ob_flush();
        @flush();

        // 最大実行時間の設定（仮で１時間）
        set_time_limit(60 * 60);

        // ブラウザとかサーバーのバッファリング対策用（使わないように環境を整えるのが望ましい）
        // self::$response['dummy'] = str_pad('', 1024 * 4);
    }

    public static function finish()
    {
        // ストリーム出力終了
        self::output_chunk('');
    }

    public static function flush()
    {
        // データをブラウザ側に掃き出し
        self::output_chunk(json_encode(self::$response) . PHP_EOL);

        @ob_flush();
        @flush();
    }

    private static function output_chunk($chunk)
    {
        // echo sprintf("%x\r\n", strlen($chunk));
        echo $chunk . "\r\n";
    }

    public static function setStreamed_on(string $value)
    {
        self::$response['streamed_on'] = $value;
    }

    public static function setCount(int $value)
    {
        self::$response['count'] = $value;
    }

}