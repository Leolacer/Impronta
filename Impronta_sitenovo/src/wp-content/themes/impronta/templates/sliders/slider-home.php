<?php 
/**
 * Template de Slider
 * Use esse arquivo como ponto de partida para os seus customs sliders
 * É bem simples: basta modificar o loop da forma que melhor funcione com seus propósitos
 *
 * Variaveis disponíveis:
 * $slides array Array cotnendo os slides.
 * $sliderID string Id desse slider.
 * $Tema object Variavel global do tema que carrega muita coisa util e importante.
 */
?>

<?php //var_dump($slides); ?>

<?php if (!empty($slides)) : ?>

<!-- Slider -->
<div id="slider-<?php echo $sliderID; ?>" class="swiper-container">
  <div class="slider-container swiper-wrapper">

    <?php foreach ($slides as $slide) : ?>
    <!-- Slide -->
      <div class="swiper-slide">
        
        <?php if (has_post_thumbnail($slide->ID)) : ?>
          <?php echo get_the_post_thumbnail($slide->ID); ?>
        <?php endif; ?>
        
        <h1><?php echo get_the_title($slide->ID); ?></h1>
        <p><?php echo get_the_content($slide->ID); ?></p>
        
      </div>
    <!-- FIM Slide -->
    <?php endforeach; ?>

  </div>

  <div class="slider-<?php echo $sliderID; ?>-pagination"></div>
</div>
<!-- FIM Slider -->

<!-- Nosso JS. Colocamos aqui para ficar mais fácil fazer mudanças nos scripts -->
<script>
  var swiper = new Swiper('#slider-<?php echo $sliderID; ?>', {
      pagination: '.slider-<?php echo $sliderID; ?>-pagination',
      paginationClickable: true,
      autoplay: 3000
  });
</script>

<?php endif; ?>