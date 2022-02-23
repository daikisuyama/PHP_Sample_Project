# PHP_Sample_Project

## 目的

簡易的なメモアプリの作成

## 予定

2/23,24で完成まで漕ぎつける

## アプリのイメージ図

[イメージ図](./image/app_image.jpg)

## プロジェクトのディレクトリ構成

```
- PHP_Sample_Project
    - README.md：このプロジェクトについての概要
    - sample_code：PHPのコードを管理するディレクトリ
        - XAMPPのhtdocs内からシンボリックリンクを張る
        - /Applications/XAMPP/htdocs/sample_code -> /Users/DAIKI/Desktop/PHP_Sample_Project/sample_code
    - app_image：メモアプリのイメージ図
```

## データベースの定義

- データベース名：sample_project
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