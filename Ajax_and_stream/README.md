flash()を使った手法のため、Webサーバー（ApacheやNginxなど）が持っているバッファリング手法を上書きすることができない。
そのためgzipなどを行なっているとそのモジュール自体がバッファ機構を持つため、狙ったようなリアルタイムでの通信が行いにくくなるので注意。

## flash()を使うにあたって環境設定

gzipなどのバッファ機構を持つモジュールを停止。

PHPオプションとして以下のように設定
```conf
output_buffering = Off
;output_handler =
zlib.output_compression = Off
;zlib.output_handler =
```

NginxをLBとして使っている場合は以下のオプション
```conf
proxy_buffering off;
```
