<?php get_header(); ?>

			<main class="cd-main-content">


<div class="outer-container">
        <div id="single-page-content">
          <div class="inner-wrap">
            <div class="container">
            <!-- Редактируемый контент -->
            <div class="entry-content">



								<section class="entry-content cf" itemprop="articleBody">
									
                                                                    <h1><?php _e( 'Epic 404 - Article Not Found', 'bonestheme' ); ?></h1>
                                                                    <p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' );   ?></p>
                                                                    <p><?php get_search_form(); ?></p>
                                                                    
								</section> <?php // end article section ?>

								<footer class="article-footer cf">

								</footer>

								<?php //comments_template(); ?>

						

						
					<?php //get_sidebar(); ?>
                                      
                                 </div>
              </div>

            </div>
          </div>
        </div>   
			</main>

<?php get_footer(); ?>