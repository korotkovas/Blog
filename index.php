<?php get_header(); ?>
<!-- Prijungiam musu headerio linkus -->
<?php get_template_part('template-parts/breadcrumbs'); ?>
<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			
        	<div class="col-md-8">
        	<!-- isvedam postus -->
        	<?php if ( have_posts() ) : ?>
        		<!-- kol yra postai ciklas nesibaigs -->
				<?php while ( have_posts() ) : the_post(); ?>
        			<article class="blog_post">
					<h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h4>
						
						<div class="blog_category">
							<ul> 
								<li><?php the_category(', ');  ?></li>
								<li> <a href="#">Fresh releases </a> </li>
							</ul>
						</div>	
						
						<div class="blog_text">
							<ul>
								<li> | </li>
								<li>Post By : <?php the_author_posts_link(); ?></li>
								<li> | </li>
								<li>  On : <?php the_time('j F Y');?> </li>
							</ul>
						</div>
						
						<div class="blog_post_img">
							<a href="<?php the_permalink(); ?>"><?php  the_post_thumbnail(); ?> </a>
						</div>
						
						<?php the_excerpt();  ?>
					
						<a href="<?php the_permalink(); ?>"> Continue reading <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
						
					
				</article>
        		<?php endwhile; ?>
        	<?php endif; ?>
	
				<article class="blog_post">
					<h4> <a href="#"> All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks </a></h4>
						
						<div class="blog_category">
							<ul> 
								<li> <a href="#">Company news, </a> </li>
								<li> <a href="#">Fresh releases </a> </li>
							</ul>
						</div>	
						
						<div class="blog_text">
							<ul>
								<li> | </li>
								<li> <a href="#"> Post By : Admin   </a> </li>
								<li> | </li>
								<li>  On : 20 may 2016 </li>
							</ul>
						</div>
						
						<div class="blog_post_img">
							<a href="#">	<img src="images/blog_post_img3.png" alt="image"> </a>
						</div>
						
						<p> All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc. </p>
					
						<a href="#"> Continue reading <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</article>						
				
				<div class="next_page">
          			<ul class="page-numbers">
						<li><span class="page-numbers current">1</span></li>
						<li><a href="#" class="page-numbers">2</a></li>
						<li><a href="#" class="page-numbers">3</a></li>
						<li><a href="#" class="page-numbers">4</a></li>
						<li><a href="#" class="next page-numbers">Next</a></li>
					</ul>
       			 </div>
			
			</div>	
			
				<!-- Cia buvo sidebaras -->
			<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>


