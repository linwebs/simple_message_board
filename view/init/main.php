<div class="container">
	<div class="mt-4">
		<h1>簡易留言版系統安裝步驟</h1>
		<hr>
		<ul>
			<li>
				<p>
					步驟1. 建立使用的資料庫、使用者<br>
					資料庫建議使用 utf8mb4_unicode_ci 編碼，建議單獨為此系統建立一個資料庫使用者進行存取。
				</p>
			</li>
			<li>
				<p>步驟2. 將系統根目錄下的 config.sample.php 複製一份，並重新命名為 config.php。</p>
			</li>
			<li>
				<p>
					步驟3. 填寫並修改 config.php 中的欄位以符合當前系統環境。
					<br>
					<code>return array(<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'pre_url' => '在此填寫系統網址前綴字串',<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'website_title' => '在此填寫系統名稱',<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'anonymous' => '在此填寫系統顯示匿名使用者的名稱',<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'db_host' => '在此填寫資料庫的主機名稱',<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'db_port' => '在此填寫資料庫的連接埠',<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'db_name' => '在此填寫資料庫名稱',<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'db_user_name' => '在此填寫登入資料庫的使用者名稱',<br>
						&nbsp;&nbsp;&nbsp;&nbsp;'db_user_password' => '在此填寫登入資料庫的使用者密碼'<br>
						);</code>
				</p>
			</li>
			<li>
				<p>步驟4. 設定完畢後，點選下方按鈕驗證設定檔並安裝系統。</p>
				<form action="<?= $config['pre_url'] ?>/initialization" method="post">
					<input type="hidden" name="install" value="true">
					<input type="submit" value="安裝" class="btn btn-login">
				</form>
			</li>
		</ul>
	</div>
</div>