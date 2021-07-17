# 簡易留言版 - 嘉大資工課外自學讀書會
Author: [Linwebs](https://linwebs.tw/about)

## 功能
* 查看留言
* 匿名留言
* 註冊帳號
* 登入帳號
* 署名留言

## 系統需求
* Apache ^2.2 (with mod_rewrite)
* PHP ^7.3
* MariaDB ^10.2

## 安裝步驟
瀏覽 /initialization 頁面以查看說明

1. 建立使用的資料庫、使用者  
   資料庫建議使用 utf8mb4_unicode_ci 編碼，建議單獨為此系統建立一個資料庫使用者進行存取。

2. 將系統根目錄下的 config.sample.php 複製一份，並重新命名為 config.php。

3. 填寫並修改 config.php 中的欄位以符合當前系統環境。
```php
return array(
	'pre_url' => '在此填寫系統網址前綴字串',
	'website_title' => '在此填寫系統名稱',
	'anonymous' => '在此填寫系統顯示匿名使用者的名稱',
	'db_host' => '在此填寫資料庫的主機名稱',
	'db_port' => '在此填寫資料庫的連接埠',
	'db_name' => '在此填寫資料庫名稱',
	'db_user_name' => '在此填寫登入資料庫的使用者名稱',
	'db_user_password' => '在此填寫登入資料庫的使用者密碼'
);
```

4. 設定完畢後，點選頁面下方按鈕驗證設定檔並安裝系統。
