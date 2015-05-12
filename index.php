<?php 
    function detectmobile(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $useragents = array (
            "iPhone",
            "iPod",
            "Android",
            "blackberry9500",
            "blackberry9530",
            "blackberry9520",
            "blackberry9550",
            "blackberry9800",
            "webOS",
            "iPad"
            );
            $result = false;
        foreach ( $useragents as $useragent ) {
        if (preg_match("/".$useragent."/i",$agent)){
                $result = true;
            }
        }
        return $result;
    }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta name="copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">

    <title>Hydraulica &ndash; Art on the Circuit</title>

    <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-180x180.png" />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/icons/64_favicon.png" sizes="64x64" />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/icons/32_favicon.png" sizes="32x32" />
    <?php wp_head(); ?>
</head>
<body>
    <a class="menu-link">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="32px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve">
            <path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2 S29.104,22,28,22z"/>
        </svg>
    </a>
    <div id="wrapper">
        <div class="inner">
            <div class="sky"></div>
            <div class="skyline"></div>
            <div class="trees"></div>
            <div class="foreground">
                <div class="ground"></div>
                <div class="river">
                    <div class="water"></div>
                    <div class="water"></div>
                    <div class="water"></div>
                    <div class="water"></div>
                    <div class="water"></div>
                    <div class="water"></div>
                    <div class="water"></div>
                </div>
            </div>
            <div class="hotspots"></div>
        </div>
    </div>

    <?php $post_array = get_pages('pagename = settings'); ?>
    <?php foreach ( $post_array as $post ) : setup_postdata( $post ); ?>
        <nav id="menu" class="panel" role="navigation">
            <ul class="panel-inner">
                <li class="header">Art on the Circuit</li>
                <?php wp_nav_menu( 
                    array(
                        'menu'          => 'Sidebar Menu',
                        'items_wrap'    => '%3$s',
                        'container'     => ''
                )); ?>
            </ul>
            <div class="credits">
                Copyright &copy; <?php echo date('Y'); ?> Art on the Circuit.
                <div class="hidden-xs">
                    <hr>
                    <?php the_field('credits'); ?>
                </div>
            </div>
        </nav>

        <?php if(get_field('show_alert')): ?>
            <a class="alert" target="_blank" href="<?php the_field('alert_link'); ?>">
                <?php the_field('alert_text'); ?>
                <span class="close">&times;</span>
            </a>
        <?php endif; ?>

        <?php if(get_field('show_welcome_modal')): ?>
            <div id="welcome-modal" class="modal fade in" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h2><?php the_field('welcome_modal_title'); ?></h2>
                            <p><?php the_field('welcome_modal_body'); ?></p>
                            <a class="close-welcome"><?php the_field('welcome_modal_link_text'); ?> &raquo;</a>
                            <?php if(get_field('show_alert_in_welcome')): ?>
                                <a target="_blank" href="<?php the_field('alert_link'); ?>">Give us your feedback &raquo;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay in"></div>
        <?php endif; ?>
    <?php endforeach; wp_reset_postdata(); ?>

    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery.pep.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery.cookie.js"></script>
    
    <?php include_once('inc-data.php'); ?>
    <script>
        function buildHotspots(data) {
            $.each(data.hotspots, function(i, val) {
                var link = val.modal.link ? val.modal.link : '';
                var html =  '<a class="hotspot" id="' + val.id + '"' +
                            '     style="height:' + val.size.height + '; ' +
                                        'width:' + val.size.width + '; ' +
                                        'left:' + val.position.left + '; ' +
                                        'bottom:' + val.position.bottom + '; ' +
                                        'z-index:' + val.position.zindex + '; ' +
                                        'background-image: url(' + val.image + ');" ' +
                            '     data-modal-content="' + val.modal.description + '" ' +
                            '     data-modal-title="' + val.modal.title + '" ' +
                            '     data-modal-image="' + val.modal.image + '" ' +
                            '     data-modal-link="' + link + '">' +
                            '     <div class="hotspot-indicator"><?php echo file_get_contents( get_template_directory_uri() . '/images/icon_drops.svg'); ?></div>' +
                            '</a>';
                
                $('.hotspots').append(html);
            });
        }

        function setDraggable() {
            var windowWidth = $(window).width();
            var $wrapper = $('#wrapper .inner');

            var constrainArray = function () {
                var wDiff = $wrapper.width() - $(window).width();
                var hDiff = $wrapper.height() - $(window).height();
                return [
                    -hDiff,
                    0,
                    0,
                    -wDiff
                ];
            };
            var $pep = $wrapper.pep({
                constrainTo: constrainArray(),
                axis: 'x',
                startPos: {
                    left: -(($wrapper.width()/2) - (windowWidth/2)),
                    top: null
                },
                elementsWithInteraction: '.hotspot'
            });
        }

        function closeModal() {
            $('.modal').removeClass('in');
            $('.overlay').removeClass('in');
            setTimeout(function(){ 
                $('.modal').remove(); 
                $('.overlay').remove(); 
            }, 550);
        }
        
        function togglePanel() {
            $('#menu').toggleClass('active');
            $('.menu-link').toggleClass('active');
        }

        function createHotspot(e) {
            var title = $(this).attr('data-modal-title');
            var content = $(this).attr('data-modal-content');
            var link = $(this).attr('data-modal-link');
            var image = $(this).attr('data-modal-image');

            var html =  '<div class="modal fade" tabindex="-1" role="dialog">' +
                        '    <div class="modal-dialog">' + 
                        '        <div class="modal-content"><div class="modal-body">' +
                        '            <div class="close">&times;</div>' +
                        '            <h2>' + title + '</h2>' +
                        '            <p>' + content + '</p>';

            if (image != 'undefined'){ 
                html += '            <img src="' + image + '" alt="' + title + '" />'; 
            }
            if (link){  
                html += '            <a href="' + link + '" target="_blank">Learn More &raquo;</a>'; 
            }
                html += '        </div></div>' +
                        '    </div>' +
                        '</div>' +
                        '<div class="overlay"></div>';

            $('body').append(html);
            unfuckModals();
            setTimeout(function(){ 
                $('.modal').addClass('in');
                $('.overlay').addClass('in');
            }, 100);
        }

        function createEvents() {
            $(document).on('touchmove', function(e) {
                if( $(e.target).hasClass('modal') || $(e.target).closest('.modal').length ){
                    return;
                }
                e.preventDefault();
            });

            $(window).resize(unfuckModals);

            $(document).on('click', '.hotspot', createHotspot);
            $(document).on('touchstart click', '.menu-link', togglePanel);

            $(document).on('touchstart click', '.modal', function(){
                closeModal();
            });

            $(document).on('touchstart click', '.modal-dialog', function(e){
                e.stopPropagation();
            });
            
            $(document).on('touchstart click', '.alert .close', function(e){
                e.preventDefault();
                $(this).parent().remove();
                $.cookie('alert', 'hidden', { expires: 14 });
            });
            
            $(document).on('tap click', '.modal .close', function(e){
                e.preventDefault();
                closeModal();
            });

            $('.modal').on('touchmove', function(e){
                return true;
            });

            $(document).on('touchstart click', '.close-welcome', function(){
                closeModal();
                $.cookie('welcome', 'hidden', { expires: 14 });
            });
        }

        function staggerHighlights() {
            $('.hotspot-indicator svg').each(function() {
                var random = Math.floor((Math.random() * 5) + 1);

                $(this).css('-moz-animation-delay', random + 's');
                $(this).css('-webkit-animation-delay', random + 's');
                $(this).css('animation-delay', random + 's');
            });
        }

        function unfuckModals() {
            var width = $(window).width();

            $('.modal').width(width);
        }
        
        $(function(){
            buildHotspots(data);
            setDraggable();
            createEvents();
            unfuckModals();
            
            if ($.cookie('alert') == 'hidden'){ 
                $('.alert').remove(); }
            if ($.cookie('welcome') == 'hidden'){ 
                $('.modal').remove(); 
                $('.overlay').remove(); }
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>