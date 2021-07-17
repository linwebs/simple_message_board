<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-4 offset-md-4 mt-4">
			<?php if ($register_msg) { ?>
				<div class="alert alert-warning"><strong>註冊失敗！</strong><?= $register_msg ?></div>
			<?php } ?>
			<form action="<?= $config['pre_url'] ?>/register" method="post">
				<h1 class="h3 mt-4 fw-normal">註冊帳號</h1>
				<div class="form-floating mt-4">
					<input type="text" class="form-control" name="name" id="name" placeholder="請輸入姓名" maxlength="20">
					<label for="name">姓名</label>
				</div>
				<div class="form-floating mt-4">
					<input type="text" class="form-control" name="account" id="account" placeholder="請輸入帳號" maxlength="20">
					<label for="account">帳號</label>
				</div>
				<div class="form-floating mt-4">
					<input type="password" class="form-control" name="password" id="password" placeholder="請輸入密碼">
					<label for="password">密碼</label>
				</div>
				<button class="w-100 btn btn-lg btn-login mt-4" type="submit">註冊</button>
				<p class="mt-4">已有帳號? <a href="<?= $config['pre_url'] ?>/login">點此登入</a></p>
			</form>
		</div>
	</div>
</div>