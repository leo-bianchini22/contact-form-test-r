# お問い合わせフォーム
## 環境構築
#### Dokerビルド  
  
1. git clone git@github.com:leo-bianchini22/contact-form-test.git  
2. mv contact-form-test "ディレクトリ名"  
3. docker-compose up -d --build  

#### Laravel環境構築　　

1. docker-compose exec php bash  
2. composer install  
3. cp .env.example .env  
 (.env.exampleファイルから.env作成、環境変数の変更)
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術  
* PHP 7.4.9  
* Laravel 8.83.27
* MySQL 15.1

## ER図　　
![スクリーンショット (43)](https://github.com/leo-bianchini22/contact-form-test/assets/149698762/2bbef3e3-d6d8-4c28-869b-d3551df18460)

## URL  
開発環境
* http://localhost/
* http://localhost/login

phpMyAdmin
* http://localhost:8080/
