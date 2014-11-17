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
       $b_count = 0;

?>
       <section id="myTheme-home"class="page-wrapper" data-magic="image" data-s_count="0">
       <!-- <article class="content-padding"> -->
              <div class="content" id="home-content">
                     <div id="hero-content">
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
       $page_count = count($myTheme_pages);

       foreach ($myTheme_pages as $page) {
              $s_count++;
              $b_count++;
              // var_dump($page);
              $t = get_the_category($page->ID);
              foreach ($t as $cat) {
                     $cat_name_raw = $cat->name;
                     $cat_name = explode('y', $cat_name_raw);
                     $page_title = strtolower($cat_name[1]);
              }


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
       <?php if($b_count < $page_count): ?>
       <section class="blank-container" data-magic="image">
              <div class="blank" id="blank-<?php echo $s_count;?>" data-s_count="<?php echo $s_count;?>"></div>
       </section>
       <?php endif; ?>

<?php
       }


?>
</main>


<?php get_footer(); ?>