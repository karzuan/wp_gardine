<?php get_header(); ?>

   <main class="cd-main-content">
    <div class="outer-container" >    
<!-- Шапка страницы с фоном-->
        <div class="page-header-wrapper row j-center" style="background: url('../img/07-2.jpg'); background-repeat: no-repeat; background-size: cover; background-color: rgba(24,54,78,0.4);">
                    <!--*********************
                        function change_bg()
                        *********************-->
          <div class="page-header-wrapper--overlay"></div>
            <div class="container">
                <div class="col-half text-center">
                  <div class="page-header-wrapper--content">
                   <!-- Заголовок страницы      -->
                    <h1 class="page-title">Блог</h1>
                    
                    <?php breadcrumbs();?>
                    
                  </div>              
                </div>            
              </div>
          </div>
      </div>

    <!-- Контент страницы -->
    
    <div class="outer-container">
        <div id="single-page-content">
          <div class="inner-wrap">
            <div class="container">
              <div class="row"> 

							
							
                                                                        <!-- Посты списком -->
                                                         <div class="col">
                                                                <div class="blog-standart">
                                                        
                                                        <?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="entry-header article-header">

									<h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline entry-meta vcard">
										<?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                  							     /* the time the post was published */
                  							     '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       								'<span class="by">'.__('by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    							); ?>
									</p>

								</header>

								<section class="entry-content cf">

									<?php the_post_thumbnail( 'bones-thumb-300' ); ?>

									<?php the_excerpt(); ?>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
                                                    

						      </div><!-- /.blog-standart -->
                                                     </div> <!-- /.col -->
                                        <!-- Сайдбар блога -->
                                        <aside class="blog-sidebar col-third">
					<?php get_sidebar(); ?>
                                        </aside>
                            </div><!-- /.row -->
            </div>
          </div>      
        </div>    
      </div> 
      
    </main>
<?php get_footer(); ?>
