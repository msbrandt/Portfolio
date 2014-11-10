<?php 
/**
*
* @subpackage SUVBC
* @since Today
*/
?>

<?php get_header(); ?> 

<main>
<?php 
       $myTheme_pages = myTheme_get_pages();
       $s_count = 0;
       // $b_count = $s_count + 3;

?>
       <section id="myTheme-home"class="page-wrapper" data-magic="image" data-s_count="0">
       <!-- <article class="content-padding"> -->
              <div class="content" id="home-content">
                     <div id="hero-content">
                            <!-- <h1><?php the_title(); ?></h1> -->
                            <h1>mike b</h1>
                            <ul>
                                   <li>Design</li>
                                   <li>Develope</li>
                                   <li>Manage</li>
                            </ul>
                     </div>
              </div>
       <!-- </article> -->
       </section>
<?php 
       myTheme_header();
       foreach ($myTheme_pages as $page) {
              $s_count++;

              $page_title = strtolower($page->post_title);


?>
       <section id="myTheme-<?php echo $page_title; ?>"class="page-wrapper" data-magic="na" data-s_count="<?php echo $s_count; ?>">
              <div class="page-padding">
                     <div class="content" id="<?php echo $page_title; ?>-content">
                     <?php
                            get_template_part( '/page-templates/content-'.$page_title, get_post_format() );
                            $s_count++;
                     ?>
                     </div>
              </div>
       </section>

       <section class="blank" id="blank-<?php echo $s_count;?>" data-magic="image" data-s_count="<?php echo $s_count;?>"></section>
       

<?php
       }


?>
</main>


<?php get_footer(); ?>