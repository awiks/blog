 <?php if(isset($rest_slider)): ?>

 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	<?php foreach ($rest_slider as $key => $item): ?>
  			
    <li data-target="#myCarousel" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? 'active' : '' ?>"></li>
 
   <?php endforeach ?>
  </ol>
  <div class="carousel-inner">

    <?php foreach ($rest_slider as $key => $rows): ?>
        
    <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
      <img class="first-slide" src="<?= base_url('storage/900/' . $rows->images)?>" alt="First slide">
      <div class="container">
        <div class="carousel-caption text-left">
          <h1><?= $rows->title ?></h1>
          <p><?= word_limiter($rows->content) ?></p>
          <p><a class="btn btn-primary" href="<?= base_url('/articles/' . $rows->slug_c . '/' . $rows->slug_a . '')?>" role="button">Baca Selengkapnya <i class="fas fa-angle-double-right"></i></a></p>
        </div>
      </div>
    </div>

<?php endforeach ?>
    
  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

 <?php endif; ?>