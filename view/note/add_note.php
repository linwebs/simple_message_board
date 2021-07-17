<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-8 offset-md-2 mt-4">
			<?php if ($add_note_msg) { ?>
				<div class="alert alert-warning"><strong>留言新增失敗！</strong><?= $add_note_msg ?></div>
			<?php } ?>
			<form action="<?= $config['pre_url'] ?>/new" method="post">
				<h1 class="h3 mt-4 fw-normal">新增留言</h1>
				<div class="mt-3">
					<label for="content" class="form-label">內容</label>
					<textarea class="form-control" name="content" id="content" rows="5" placeholder="在此輸入留言內容..." required></textarea>
				</div>
				<div class="mt-3">
					<p>留言者: <?= $user_name ?> <?= $user_hint ?></p>
				</div>
				<button type="submit" class="btn btn-login">新增留言</button>
			</form>
		</div>
	</div>
</div>