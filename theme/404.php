<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>404 - <?php $this->options->title(); ?></title>	
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/404.css'); ?>">
</head>
<body>
    <div class="code"><p>ERROR 404</p></div>
	<div class="road">
		<div class="shadow">
			<div class="shelt">
				<div class="head">
					<div class="eyes">
						<div class="lefteye">
							<div class="eyeball"></div>
							<div class="eyebrow"></div>
						</div>
						<div class="righteye">
							<div class="eyeball"></div>
							<div class="eyebrow"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="hat"></div>
			<div class="bubble">
				<a href="<?php $this->options->siteUrl(); ?>">回到主页</a>
			</div>
		</div>
			<p>你要寻找的页面丢失啦！</p>
		</div>
		    <script src="<?php $this->options->themeUrl('js/jquery3.6.0.js'); ?>"></script>
		  <script src="<?php $this->options->themeUrl('js/404.js'); ?>"></script>
</body>
</html>