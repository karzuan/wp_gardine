<?php get_header(); ?>

                       <main class="cd-main-content">
      <div class="outer-container">
       <div id="single-page-content">
         <div class="inner-wrap">
           <div class="container">
            <!-- Редактируемый контент -->
             <div class="entry-content">
                    <h1 class="archive-title"><span><?php _e( 'Search Results for:', 'bonestheme' );  ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                                        
                                                                              <!-- Пост -->
                                                      <div class="blog-standart--single-post">
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
                                                                
                                                             <!-- Post ft img -->
                                                                <div class="blog-standart--post-main-img">
                                                                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'bones-thumb-300' ); ?></a>
                                                                </div>
                                                                                        <!-- Post details -->
                        <div class="blog-standart--post-details">
                          
                          <!-- Time published -->
                          <span class="post-details--date"><?=get_the_time('d F Y ');?></span>
                          <!-- Permalink -->
                          <a href="<?php the_permalink() ?>" class="post-details--permalink" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                          <!-- Exerpt -->
                          <p class="post-details--exerpt">
                                <?php 
                                
                                $content = get_the_content();
                                echo blog_piece($content, 550); // in bones
                                ?>...
                          </p>

                          <!-- Bottom post details panel -->
                          <div class="post-details--bottom-panel row">
                            <div class="col">
                              <ul class="post-details--meta no-list"><?php 
                                                                        $categories = get_the_category();//fetch the category
                                                                        $cat = my_category($categories);
                                                                        ?>
                                <li><span>В рубрике: </span><a href="<?=$cat[link];?>"><?=$cat[name];?></a></li>
                                <li><span>Автор: </span><a href="#"><?=get_the_author_link( );?></a></li>
                              </ul>
                            </div>
                            <div class="col text-right">
                              <div class="post-details--read-more-button">
                                <a href="<?php the_permalink() ?>" class="btn btn-primary">Читать далее</a>
                              </div>
                              
                            </div>
                          </div><!-- /.Bottom post details panel -->
                        </div><!-- /.Post details -->
								
                                                    </article>
                                                    </div><!-- /.Пост -->    
                                                        

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php //_e( 'This is the error message in the search.php template.', 'bonestheme' ); ?></p>
										</footer>
                                                                               <p><?php get_search_form(); ?></p>
									</article>

							<?php endif; ?>
			     
             </div>
           </div>
         </div>
       </div>
      </div>   
							

			</main>

							<?php //get_sidebar(); ?>

<?php get_footer(); ?>