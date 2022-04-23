# PHP_Sample_Project

## 目的

簡易的なToDoアプリの作成

## イメージ図とサンプル

- [イメージ図（index.php）](./image/index.jpg)
    - [サンプル図（index.php）](./image/sample_index.jpg)
- [イメージ図（view.php）](./image/view.jpg)
- [イメージ図（~~edit_check.php~~→edit_confirm.php）](./image/edit_check.jpg)
- [イメージ図（Paging）](./image/paging.png)

## プロジェクトのディレクトリ構成

```
- ~/Desktop/php_training_2022/php_training_app
    - README.md：このプロジェクトについての概要
    - code：PHPのコードを管理するディレクトリ
        - シンボリックリンクを貼りたい
            - /Applications/XAMPP/htdocs/code -> ~/Desktop/php_training_2022/php_training_app/code
            -　不具合によりこの構成を実現できない
        - このディレクトリの中身を毎回コピーする
    - image：ToDoアプリのイメージ図
```

## データベースの定義

- データベース名：sample_project
    - utf8_unicode_ci
- テーブル名：posts

|カラム名|データ型|null許可|カラムの説明|
|---|---|---|---|
|id|INT|not null|主キー（自動採番）|
|title|VARCHAR（31）|not null|レコードのタイトル|
|content|text|not null|レコードの内容|
|created_at|datetime|not null|レコードの作成日時|
|updated_at|datetime|not null|レコードの更新日時|

## 参考

- [気づけばプロ並みPHP 改訂版](https://www.amazon.co.jp/%E6%B0%97%E3%81%A5%E3%81%91%E3%81%B0%E3%83%97%E3%83%AD%E4%B8%A6%E3%81%BFPHP-%E6%94%B9%E8%A8%82%E7%89%88-%E3%82%BC%E3%83%AD%E3%81%8B%E3%82%89%E4%BD%9C%E3%82%8C%E3%82%8B%E4%BA%BA%E3%81%AB%E3%81%AA%E3%82%8B-%E8%B0%B7%E8%97%A4-%E8%B3%A2%E4%B8%80/dp/4865940650)