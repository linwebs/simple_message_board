<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>簡易留言版系統安裝</title>
	<link rel="shortcut icon" href="<?= $config['pre_url'] ?>/favicon.ico">
	<link href="<?= $config['pre_url'] ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $config['pre_url'] ?>/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-navbar">
	<div class="container-fluid">
		<a class="navbar-brand">簡易留言版系統安裝</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active disabled" aria-current="page" href="<?= $config['pre_url'] ?>">安裝頁面</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<?= $html['content'] ?>
<script src="<?= $config['pre_url'] ?>/js/bootstrap.min.js"></script>
</body>
</html>