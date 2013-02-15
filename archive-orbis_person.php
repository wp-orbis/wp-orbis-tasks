<?php get_header(); ?>

<div class="page-header clearfix">
	<h1 class="pull-left">
		<?php post_type_archive_title(); ?>

		<small>
			<?php

			printf( __( 'Overview of %1$s', 'orbis' ),
				strtolower( post_type_archive_title( '', false ) )
			);

			?>
		</small>
	</h1>

	<a class="btn btn-primary pull-right" href="<?php echo orbis_get_url_post_new(); ?>">
		<i class="icon-plus-sign icon-white"></i> <?php _e( 'Add person', 'orbis' ); ?>
	</a>
</div>
  
<div class="panel">
	<header>
		<h3><?php _e( 'Overview', 'orbis' ); ?></h3>
	</header>

	<?php $s = filter_input( INPUT_GET, 's', FILTER_SANITIZE_STRING ); ?>
	  
	<form class="well form-search" method="get">
		<input type="text" class="input-medium search-query" name="s" placeholder="<?php esc_attr_e( 'Search', 'orbis' ); ?>" value="<?php if ( ! empty( $_GET['s'] ) ) { echo $_GET['s']; } ?>">
		<button type="submit" class="btn"><?php esc_attr_e( 'Search', 'orbis' ); ?></button>
	</form>
	
	<?php if ( have_posts() ) : ?>
	
		<table class="table table-striped table-bordered table-condense table-hover">
			<thead>
				<tr>
					<th><?php _e( 'Name', 'orbis' ); ?></th>
					<th><?php _e( 'Comments', 'orbis' ); ?></th>
					<th colspan="2"><?php _e( 'Actions', 'orbis' ); ?></th>
				</tr>
			</thead>
		
			<tbody>
				<?php while ( have_posts() ) : the_post(); ?>
	
					<tr>
						<td>
		
							<div class="person-wrapper">
								<div class="avatar">
									<?php if ( has_post_thumbnail() ) : ?>
									
										<?php the_post_thumbnail( 'thumbnail' ); ?>
									
									<?php else : ?>
									
										<img src="<?php bloginfo('template_directory'); ?>/placeholders/avatar.png">
									
									<?php endif; ?>
								</div>
								
								<div class="details">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <br />
		
									<p>
										<?php if ( get_post_meta($post->ID, '_orbis_person_email_address', true ) ) : ?>
						
											<span><?php echo get_post_meta( $post->ID, '_orbis_person_email_address', true ); ?></span> <br />
										
										<?php endif; ?>
										
										<?php if ( get_post_meta( $post->ID, '_orbis_person_phone_number', true ) ) : ?>
						
											<span><?php echo get_post_meta( $post->ID, '_orbis_person_phone_number', true ); ?></span>
										
										<?php endif; ?>
									</p>
								</div>
							</div>
						</td>
						<td>
							<span class="badge"><?php comments_number( '0', '1', '%' ); ?></span>
						</td>
						<td>
							<div class="actions">
								<?php edit_post_link( __( 'Edit', 'orbis' ) ); ?>
							</div>
						</td>
						<td>
							<?php
		
							$phone_number = get_post_meta( $post->ID, '_orbis_person_phone_number', true );
		
							if( ! empty( $phone_number ) && function_exists( 'orbis_snom_call_form' ) ) {
								orbis_snom_call_form( $phone_number );
							}
		
							?>
						</td>
					</tr>
				
				<?php endwhile; ?>
			</tbody>
		</table>

	<?php else : ?>

		<div class="content">
			<p>
				<?php _e( 'No results found.', 'orbis' ); ?>
			</p>
		</div>

	<?php endif; ?>
</div>

<?php orbis_content_nav(); ?>

<?php get_footer(); ?>
