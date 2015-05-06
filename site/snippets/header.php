<nav role="navigation" class="slide"> <!-- the slideout menu for mobile devices -->
  <ul class="menu cf">
    <?php foreach($pages->visible() as $p): ?>
    <li>
      <a <?php e($p->isOpen(), ' class="active"') ?> href="<?php echo $p->url() ?>"><?php echo $p->title()->html() ?></a>
    </li>
    <?php endforeach ?>
  </ul>
</nav>

<div class="container">

  

  <header class="jumbo slide">
    <header class="slide navbar"> <!--  This is the header that shows up on mobile  -->    
      <ul id="navToggle" class="burger slide"> <!-- hamburger icon/button -->   
        <li></li><li></li><li></li>
      </ul>
    </header>
    <div class="inner">
      <h1><?php echo $page->title()->html() ?></h1>
      <a href="https://www.eventbrite.com/e/boston-civic-media-conference-tickets-16817278934" class="btn">Register</a>
    </div>
  </header> <!-- jumbo header section -->