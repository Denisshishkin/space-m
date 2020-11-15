<?php wp_footer(); ?>

<footer>
	<div class="footer__bg">
		<div class="container">
			<img src="/wp-content/uploads/2020/10/logo_light.svg" alt="" class="logo__light">
			<h2 class="footer__description">Мы открыли для себя удивительную возможность делиться с миром энергией, которая поможет каждому человеку стать на свой путь Души, обрести гармонию, счастье, радость, изобилие и любовь.</h2>
			<a href="#" class="btn__outline btn__outline_center">У вас есть вопросы?</a>
		</div>
	</div>

	<div class="footer__links">
		<div class="container">
			<div class="footer__wrap">
				<img src="/wp-content/uploads/2020/10/logo_light.svg" alt="" class="logo__light logo__light_sm">
				<div class="footer__menu">
					<?php
					wp_nav_menu( [
						'theme_location'  => '',
						'menu'            => '2', 
						'container'       => false, 
						'container_class' => '', 
						'container_id'    => '',
						'menu_class'      => 'menu', 
						'menu_id'         => 'footer__mnu',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => '',
					] ); 
					?>
				</div>
				<img class="footer__pay" src="/wp-content/uploads/2020/10/payment_logos.svg">
			</div>
		</div>
	</div>

	<div class="subfooter">
		<p><?php echo get_the_date('Y'); ?> © Space meditation </p>
	</div>


</footer>