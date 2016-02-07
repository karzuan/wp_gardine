<?php
/*
 Template Name: страница каталога
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

			<main class="cd-main-content">
                            
                            
                            
                            
              <div class="outer-container" >    
      <!-- Шапка страницы с фоном-->
        <div class="page-header-wrapper row j-center" style="background: url('<?=pages_back(get_the_ID ())?>'); background-repeat: no-repeat; background-size: cover; background-color: rgba(24,54,78,0.4);">
                    <!--*********************
                        function change_bg()
                        *********************-->
          <div class="page-header-wrapper--overlay"></div>
            <div class="container">
                <div class="col-half text-center">
                  <div class="page-header-wrapper--content">
                   <!-- Заголовок страницы      -->
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    
                    <?php breadcrumbs();?>
                    
                  </div>              
                </div>            
              </div>
          </div>
      </div>



			     

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							    <div class="outer-container">
                                                                <div id="single-page-content">
                                                                    <div class="inner-wrap">
                                                                        <div class="container">
                                                                            <!-- Редактируемый контент -->
                                                                                <div class="entry-content">
									<?php
										// the content (pretty self explanatory huh)
										the_content();

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								                </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

								<footer class="article-footer cf">

								</footer>

								<?php //comments_template(); ?>

							</article>

							<?php endwhile; endif; ?>

						<?php //get_sidebar(); ?>
                                    
			</main>

<?php get_footer(); ?>