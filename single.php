<?php get_header(); ?>
                        <main class="cd-main-content">
                                   <div class="outer-container">
                                      <div id="single-page-content">
                                          <div class="inner-wrap">
                                             <div class="container">
                                               <!-- Редактируемый контент -->
                                                <div class="entry-content">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								/*
								 * Ah, post formats. Nature's greatest mystery (aside from the sloth).
								 *
								 * So this function will bring in the needed template file depending on what the post
								 * format is. The different post formats are located in the post-formats folder.
								 *
								 *
								 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php" FOR POSTS THAT AREN'T
								 * A SPECIFIC POST FORMAT.
								 *
								 * If you want to remove post formats, just delete the post-formats folder and
								 * replace the function below with the contents of the "format.php" file.
								*/
								get_template_part( 'post-formats/format', get_post_format() );
							?>

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
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
                                                    
                      <!-- комменты, поделиться !-->
                      
                      	<br>

						<p><b>Оставить комментарий:</b></p>

<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

<script type="text/javascript">
  VK.init({apiId: 4868122, onlyWidgets: true});
</script>

<!-- Put this div tag to the place, where the Comments block will be -->
<div id="vk_comments"></div>
<script type="text/javascript">
    $width = 80;
VK.Widgets.Comments("vk_comments", {limit: 10, width: '$width', attach: "*"});
</script>

					<footer class="post-share">
						<p><b>Поделится статьей с друзьями:</b> <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div></p>
					</footer>

                      <!-- комменты, поделиться !-->

					</main>

					<? //php get_sidebar(); ?>

				     </div><!-- /.entry-content-->

				</div>
                              </div>
                            </div>
                          </div>

			</main>

<?php get_footer(); ?>
