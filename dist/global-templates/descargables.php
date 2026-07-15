<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'have_rows' ) && have_rows( 'fichas_tecnicas' ) ) :
	?>
	<ul class="fichas-tecnicas">
		<?php
		while ( have_rows( 'fichas_tecnicas' ) ) :
			the_row();

			$titulo   = get_sub_field( 'titulo' );
			$variante = get_sub_field( 'variante' );
			$pdf_id   = get_sub_field( 'pdf' );
			$pdf_url  = $pdf_id ? wp_get_attachment_url( $pdf_id ) : '';
			?>
			<li class="fichas-tecnicas__item">
				<?php if ( $pdf_url ) : ?>
					<a href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" rel="noopener">
						<?php echo esc_html( $titulo ); ?>
					</a>
				<?php else : ?>
					<?php echo esc_html( $titulo ); ?>
				<?php endif; ?>

				<?php if ( $variante ) : ?>
					<span class="badge fichas-tecnicas__variante"> (<?php echo esc_html( $variante ); ?>)</span>
				<?php endif; ?>
			</li>
			<?php
		endwhile;
		?>
	</ul>
	<?php
endif;

