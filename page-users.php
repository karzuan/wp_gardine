<?php
/*
 Template Name: страница пользователей
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
                    <h1 class="page-title"><?=wp_title('');?></h1>
                    
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
                                                                   <table>
                                                                       <tr><thead>
                                                                          <td>автор</td><td>кол-во постов</td><td>биография</td><td>e-mail</td><td>аватар</td>
                                                                          </thead>
                                                                         
                                                        <?php
                                   
							$blogauthor = get_users( );
                                                        // Array of stdClass objects.
                                                        foreach ( $blogauthor as $user ) {
                                                        echo '<tr>';
                                                	echo '<td><span> <a href="' . get_author_posts_url( $user->id ) . '">' .  esc_html( $user->display_name ) . '</a></span></td>';
                                                        echo '<td>' . count_user_posts( $user->id , 'post' ) . '</td>';
                                                        echo '<td>' . get_the_author_meta( description, $user->id ) . '</td>';
                                                        echo '<td>' . get_the_author_meta( user_email, $user->id ) . '</td>';
                                                        echo '<td>' . get_avatar( $user->id, $size='55') . '</td>';
                                                        echo '</tr>';
                                                                                        }
                                                        ?>
                                                                  
                                                                  </table>
                                                                    
                                                     
       



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
