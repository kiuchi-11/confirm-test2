# confirm-test2

# 作成状況
  商品一覧画面
  商品一覧画面(並び替え結果)
  商品一覧画面(検索結果)

# 環境構築
  1. リポジトリをクローン  
	git clone git@github.com:kiuchi-11/confirm-test2.git
  
  3. Dockerコンテナをビルド  
	docker-compose up -d --build  
  
  4. Laravel環境構築  
	docker-compose exec php bash  
	composer install  
	cp .env.example .env  
	php artisan key:generate  
	php artisan migrate:fresh --seed  

# 開発環境
	商品一覧画面：http://localhost/products
	phpMyAdmin：http://localhost:8080/

# 使用技術
	PHP 8.1.34  
	Laravel 8.83.29  
	MySQL 8.0.26  
	nginx 1.21.1  

# ER図
    +------------------+          +------------------+          +-----------------+
    |    products      |          |  product_season  |          |     seasons     |
    +------------------+          +------------------+          +-----------------+
    | id (PK)          |          | id (PK)          |          | id (PK)         |
    | name             | +-------≡| product_id       |≡--------+| name            |
    | price            |          | season_id        |          | created_at      |
    | image            |          | created_at       |          | updated_at      |
    | description      |          | updated_at       |          +-----------------+
    | created_at       |          +------------------+
    | updated_at       |
    +------------------+