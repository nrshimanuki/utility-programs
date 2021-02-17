# http通信

## WebブラウザがWebページを表示する手順
----------------------------------------

```
─────────────                     ──────────
  クライアント                        Webサーバ
─────────────                     ──────────
      │
      │
ユーザがWebページの
アドレスを指定
      │
      │
アドレスから接続先の
Webサーバを割り出す
      │
      │
Webサーバに         HTTPリクエスト   クライアントからの
HTTPリクエスト送信 ───────────────>  HTTPリクエスト受信
                                  (80番ポート)
                                         │
                                         │
                                  HTTPリクエストに
                                  応じた処理を行う
                                         │
                                         │
Webサーバからの      HTTPレスポンス   処理結果をHTTPレスポンス
HTTPレスポンス受信 <───────────────  としてクライアントに送信
      │            ここでは
      │            まだ画像は来ない
      │
HTTPレスポンスを
解釈する
      │
      │
必要に応じて画像等を  HTTPリクエスト   要求に応じて画像等を
Webサーバに要求    ───────────────> Webブラウザに送信
                                   /
                   HTTPレスポンス   /
画像等を受信  <─────────────────────
      │
      │
ブラウザに
Webページを表示
```

* リクエストもレスポンスも、全て文字列で送られる
* 画像データはバイナリ → 文字列に直して送る → 受け取ったらバイナリに戻して表示する



## ステータスコード
----------------------------------------

### 200
OK: リクエスト成功

### 301
Moved Permanently: ページのアドレスが移動している

### 304
Not Modified: ページが更新されていない

### 307
Temporary Redirect: ページのアドレスが一時的に移動している

### 400
Bad Request: リクエストが正しくない

### 401
Unauthorized: 認証が必要

### 403
Forbidden: リクエストが禁止されている

### 404
Not Found: ページが見つからない

### 408
Request Timeout: リクエストがタイムアウトした

### 500
Internal Server Error: 処理に失敗した

### 503
Service Unavailable: サーバがリクエストを処理できない(負荷が高い、メンテナンス中など)



## 通信内容の詳細
----------------------------------------

### 要求ヘッダー
* 要求
* Accept
* Accept-Language
* User-Agent
* Accept-Encoding
* Host
* DNT
* Connection

#### GET / HTTP/1.1
→ GET http://www.example.com/ HTTP/1.1<br>
→ GET http://www.example.com/index.html HTTP/1.1

### 応答ヘッダー
* 応答
* Date
* Server
* Last-Modified
* ETag
* Accept-Ranges
* Content-Length
* Keep-Alive
* Connection
* Content-Type
