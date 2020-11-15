<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="google-site-verification" content="NO72iUJCK0ntX968eOaD-NeYeR3wSzw2Zjs8LqK-c0c" />
	<meta name="yandex-verification" content="5cc3c75aba4471d8" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
	<title><?php the_title(); ?> </title>
</head>

<body <?php body_class(); ?>>
	<header>
		<div class="container">
				<div class="header__wrap">
					<ul class="nav nav_left">
						<li><a href="/meditacija">Медитация</a></li>
						<li><a href="/magazin">Магазин</a></li>
						<li><a href="/muzyka">Музыка</a></li>
					</ul>
					<a href="/"><img src="/wp-content/uploads/2020/10/logo_light.svg" alt="" class="logo__light"></a>
					<ul class="nav nav_right">
						<li><a href="/sozdateli">Создатели</a></li>
						<li><a href="/blog">Блог</a></li>
						<li><a href="/konsultacija">Консультации</a></li>
					</ul>
				</div>
		</div>
	</header>
