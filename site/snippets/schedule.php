<section class="schedule">
	<h2>Schedule</h2>
	<ul class="sessions">
		<?php foreach($page->children()->find('schedule')->children() as $session): ?>
		
		<li class="session">
			<div class="time"><time><?php echo $session->time()?></time></div>
			<div class="event-info">
				<h3 class="session-title"><?php echo $session->title() ?></h3>
				<?php if(!$session->speaker()->empty()): ?>
					<p class="byline">
						<?php echo $session->speaker() ?>, <a class="speaker-link" href="<?php echo $session->speakerlink() ?>"><?php echo $session->linktext() ?></a>
						</p>
				<?php endif ?>
				<?php if(!$session->description()->empty()): ?>
					<div>
						<p class="event-description"><?php echo $session->description() ?><p>
					</div>
				<?php endif ?>
			<div class="clear" />
		</li>

		<?php endforeach ?>

	</ul>
</section>