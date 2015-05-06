<?php snippet('head') ?>

<body> 
		<?php snippet('header') ?> <!-- Includes .container opening tag -->
		<div class="content slide">
			<section class="about">
				<p><?php echo $page->text() ?></p>
			</section>
			<?php snippet('schedule') ?>
			<?php snippet('location') ?>
		</div>
	</div>
</body>
</html>
