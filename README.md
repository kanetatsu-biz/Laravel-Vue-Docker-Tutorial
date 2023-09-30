# Laravel + Vue.js + Docker Compose で作るTODO管理アプリ
TODO管理アプリを**Docker Compose**を用いて、バックエンドは**Laravel**、フロントエンドは**Vue.js**を採用して開発しました。


## デモ動画（2023/09/30時点）
https://github.com/kanetatsu-biz/Laravel-Vue-Docker-Tutorial/assets/123366737/d2a10bec-de42-4cd2-b763-a76f5f7632d8


## 使用環境
<div align="center">

<table>
  <tr>
    <th>開発環境</th>
    <td>Docker Compose</td>
  </tr>
  <tr>
    <th>バックエンドFW</th>
    <td>Laravel</td>
  </tr>
  <tr>
    <th>フロントエンドFW</th>
    <td>Vue.js</td>
  </tr>
  <tr>
    <th>エディター</th>
    <td>Visual Studio Code</td>
  </tr>
  <tr>
    <th>バージョン管理</th>
    <td>Git</td>
  </tr>
</table>

</div>


## 環境構築手順

1. DockerとDocker Composeのインストール
1. プロジェクトを作成し、移動
1. docker-compose.ymlの作成
1. Laravelプロジェクトの作成&DockerFileの作成
1. Vueプロジェクトの作成&DockerFileの作成
1. Dockerコンテナの起動

    ```
    docker-compose up -d
    ```
    もしくは
    ```
    docker-compose up -d --build
    ```

1. ローカル環境のpostgresに今回のプロジェクト用のDBを作成
    ```
    # postgresサーバーに入る
    docker-compose exec postgres bash
    # docker-compose.ymlで設定したデフォルトのユーザーでアクセス
    psql -U postgres postgres
    # プロジェクト用のDBを作成
    CREATE DATABASE laravel_vue_tutorial;
    ```

1. ローカル環境のPostgresにアクセスできるように**.env**を修正
    ```
    DB_CONNECTION=pgsql
    DB_HOST=postgres
    DB_PORT=5432
    DB_DATABASE=laravel_vue_tutorial
    DB_USERNAME=postgres
    DB_PASSWORD=postgres
    ```

1. テストデータの投入
    ```
    chmod +x create_test_data.sh
    ./create_test_data.sh
    ```

1. frontend側のポートにアクセスし、初期ページが表示されることを確認
    ```
    http://localhost:8080/
    ```


