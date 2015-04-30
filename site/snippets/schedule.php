<section class="schedule">
	<h2>Schedule</h2>
	<ul class="sessions">
		<?php foreach($page->children()->find('schedule')->children() as $session): ?>
		
		<li class="session">
			<time><?php echo $session->time()?></time>
			<div class="event-info">
				<h3 class="session-title"><?php echo $session->title() ?></h3>
				<p class="byline"><?php echo $session->speaker() ?></p>
				<p><a class="speaker-link" href="<?php echo $session->speakerlink() ?>"><?php echo $session->linktext() ?></a></p>
				<div>
					<p class="event-description"><?php echo $session->description() ?><p>
				</div>
			</div>
		</li>

		<?php endforeach ?>

	</ul>
</section>