<?php snippet('head') ?>

<body> 
	<div class="container">
		<?php snippet('header') ?>
		<div class="content slide">
			<section class="about">
				<p><?php echo $site->find('about')->text() ?></p>
			</section>
		<?php snippet('schedule') ?>
			<section class="footer"></section>
		</div>
	</div>
</body>






