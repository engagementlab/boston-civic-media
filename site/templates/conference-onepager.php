<?php snippet('head') ?>

<body> 
	<div class="container">
		<?php snippet('header') ?>
		<div class="content slide">
			<section class="about">
				<p><?php echo $page->text() ?></p>
			</section>
			<?php snippet('schedule') ?>
			<iframe width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/mayawagon.m2bo32ji/attribution,zoompan,zoomwheel,geocoder,share.html?access_token=pk.eyJ1IjoibWF5YXdhZ29uIiwiYSI6Im81VmVMRE0ifQ.AQStgQMPXycvI8M3l0_ZGA'></iframe>
		</div>
	</div>
</body>
</html>
