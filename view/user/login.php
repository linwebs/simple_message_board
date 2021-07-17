<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-4 offset-md-4 mt-4">
			<?php if ($login_msg) { ?>
				<div class="alert alert-warning"><strong>登入失敗！</strong><?= $login_msg ?></div>
			<?php } ?>
			<form action="<?= $config['pre_url'] ?>/login" method="post">
				<h1 class="h3 mt-4 fw-normal">登入帳號</h1>
				<div class="form-floating mt-4">
					<input type="text" class="form-control" name="account" id="account" placeholder="請輸入帳號">
					<label for="account">帳號</label>
				</div>
				<div class="form-floating mt-4">
					<input type="password" class="form-control" name="password" id="password" placeholder="請輸入密碼">
					<label for="password">密碼</label>
				</div>
				<button class="w-100 btn btn-lg btn-login mt-4" type="submit">登入</button>
				<p class="mt-4">沒有帳號? <a href="<?= $config['pre_url'] ?>/register">點此註冊</a></p>
			</form>
		</div>
	</div>
</div>