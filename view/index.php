<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $html['title'] ?></title>
	<link rel="shortcut icon" href="<?= $config['pre_url'] ?>/favicon.ico">
	<link href="<?= $config['pre_url'] ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $config['pre_url'] ?>/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-navbar">
	<div class="container-fluid">
		<a class="navbar-brand"><?= $html['navbar_name'] ?></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link <?= ($html['location'] == '') ? ('active disabled') : ('') ?>" aria-current="page" href="<?= $config['pre_url'] ?>">首頁</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= ($html['location'] == 'new') ? ('active disabled') : ('') ?>" href="<?= $config['pre_url'] ?>/new">新增留言</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<div class="dropdown">
						<button class="btn btn-outline-user dropdown-toggle" type="button" id="navbar-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
							<?= ($html['user_name']) ? ($html['user_name']) : ('未登入') ?>
						</button>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbar-dropdown">
							<?php if ($html['user_name']) { ?>
								<li><a class="dropdown-item" href="<?= $config['pre_url'] ?>/logout">登出</a></li>
							<?php } else { ?>
								<li><a class="dropdown-item" href="<?= $config['pre_url'] ?>/login">登入</a></li>
								<li><a class="dropdown-item" href="<?= $config['pre_url'] ?>/register">註冊</a></li>
							<?php } ?>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<?= $html['content'] ?>
<script src="<?= $config['pre_url'] ?>/js/bootstrap.min.js"></script>
</body>
</html>