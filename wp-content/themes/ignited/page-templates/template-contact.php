<?php /* Template Name: Contact Page */ ?>

<?php get_header(); ?>

<section id="page">

  <?php if (has_post_thumbnail()) : ?>
    <div class="position-relative mb-max" style="height: 500px; background-size: cover; background-position: center center; background-image: url(<?php echo esc_url( the_post_thumbnail_url( 'large' ) ); ?>)">
      <?php if ( ! empty( get_post_meta( get_option( 'page_on_front' ), 'cignited_front_hero_btn_link', true ) ) ) : ?>
        <div class="container">
          <div class="position-absolute" style="bottom: -1rem;">
            <a class="btn btn-gradient-primary" href="<?php echo esc_url( get_post_meta( get_option( 'page_on_front' ), 'cignited_front_hero_btn_link', true ) ) ?>">
              <?php esc_html_e( get_post_meta( get_option( 'page_on_front' ), 'cignited_front_hero_btn_label', true ) ) ?> <i class="ml-2 fas fa-chevron-circle-right"></i>
            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="content container">
    <div class="row">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="col-12 text-center mb-max">

          <?php the_content(); ?>

          <?php if ( ! empty( get_post_meta( get_the_ID(), 'cignited_contact_info_email', true ) ) ) : ?>
            <div class="my-4">
              <strong>E-mail:</strong>
              <a class="text-success" href="<?php printf( 'mailto:%s?subject=%s', sanitize_email( get_post_meta( get_the_ID(), 'cignited_contact_info_email', true ) ), get_post_meta( get_the_ID(), 'cignited_contact_info_email_subject', true ) )?>"><?php echo sanitize_email( get_post_meta( get_the_ID(), 'cignited_contact_info_email', true ) ) ?></a>
            </div>
          <?php endif; ?>
        </div>

      <?php endwhile; endif; ?>

      <div class="col-12 col-lg-3 mb-max">
        <?php if ( ! empty( get_post_meta( get_the_ID(), 'cignited_contact_info_address', true ) ) ) : ?>
          <address class="mb-4">
            <?php echo wpautop( get_post_meta( get_the_ID(), 'cignited_contact_info_address', true ) ) ?>
          </address>
        <?php endif; ?>
        <?php if ( ! empty( get_post_meta( get_the_ID(), 'cignited_contact_info_phone', true ) ) ) : ?>
          <div class="mb-4">
            <strong>Phone:</strong>
            <a class="d-block text-success" href="tel:<?php echo get_post_meta( get_the_ID(), 'cignited_contact_info_phone', true ) ?>"><?php echo get_post_meta( get_the_ID(), 'cignited_contact_info_phone', true ) ?></a>
          </div>
        <?php endif; ?>
        <?php if ( ! empty( get_post_meta( get_the_ID(), 'cignited_contact_info_email', true ) ) ) : ?>
          <div class="mb-4">
            <strong>E-mail:</strong>
            <a class="d-block text-success" href="<?php printf( 'mailto:%s?subject=%s', sanitize_email( get_post_meta( get_the_ID(), 'cignited_contact_info_email', true ) ), get_post_meta( get_the_ID(), 'cignited_contact_info_email_subject', true ) )?>"><?php echo sanitize_email( get_post_meta( get_the_ID(), 'cignited_contact_info_email', true ) ) ?></a>
          </div>
        <?php endif; ?>
      </div>

      <?php if ( ! empty( get_post_meta( get_the_ID(), 'cignited_contact_info_location', true ) ) ) : ?>
        <div class="col-12 col-lg-9 mb-max">
          <?php $location = explode( ',', preg_replace( '/\s+/', '', get_post_meta( get_the_ID(), 'cignited_contact_info_location', true ) ) ) ?>
          <iframe src="<?php echo esc_url( sprintf( 'https://maps.google.com/maps?q=%s,%s&hl=gb&z=12&output=embed', $location[0], $location[1] ) ) ?>" height="400px" width="100%"></iframe>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>