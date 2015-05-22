<?php
    function getBrowser() { 
        $u_agent    = $_SERVER['HTTP_USER_AGENT']; 
        $bname      = 'Unknown';
        $version    = "";
     
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } elseif(preg_match('/Firefox/i',$u_agent)) { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } elseif(preg_match('/Chrome/i',$u_agent)) { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } elseif(preg_match('/Safari/i',$u_agent)) { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } elseif(preg_match('/Opera/i',$u_agent)) { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } elseif(preg_match('/Netscape/i',$u_agent)) { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 
        
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {}
        
        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent,"Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }
        
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version
        );
    }
    $result = false;
    $ua = getBrowser();

    if ($ua['name'] == 'Internet Explorer' && $ua['version'] < 9){ $result = true; }
    if ($ua['name'] == 'Google Chrome' && $ua['version'] < 36){ $result = true; }
    if ($ua['name'] == 'Mozilla Firefox' && $ua['version'] < 32){ $result = true; }
    if ($ua['name'] == 'Apple Safari' && $ua['version'] < 6){ $result = true; }
    if ($ua['name'] == 'Opera'){ $result = true; }
    if ($ua['name'] == 'Netscape'){ $result = true; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); if($result){ echo 'class="bad-browser"'; }?>>
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

    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/modernizr.custom.js"></script>

    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery.kinetic.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery.smoothTouchScroll.min.js"></script>
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
                            '     data-modal-title="' + val.modal.title + '" ';
                if (val.modal.image){ 
                    html += '     data-modal-image="' + val.modal.image + '" ';
                }
                if (val.modal.caption){ 
                    html += '     data-modal-caption="' + val.modal.caption + '"';
                }
                    html += '     data-modal-link="' + link + '">' +
                            '     <div class="hotspot-indicator"' +
                            '     style="top:' + val.icon.top + '; ' +
                                        'margin-left:' + val.icon.marginleft + ';"' +
                            '     ><?php echo file_get_contents( get_template_directory_uri() . '/images/icon_drops.svg'); ?></div>' +
                            '</a>';
                
                $('.hotspots').append(html);
            });
        }

        function setDraggable() {
            var windowWidth = $(window).width();
            var $wrapper = $('#wrapper .inner');

            $('#wrapper').smoothTouchScroll({
                scrollableAreaClass: "inner",
                startAtElementId: "stormwater-sample-1"
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
            var caption = $(this).attr('data-modal-caption');

            var html =  '<div class="modal fade" tabindex="-1" role="dialog">' +
                        '    <div class="modal-dialog">' + 
                        '        <div class="modal-content"><div class="modal-body">' +
                        '            <div class="close">&times;</div>' +
                        '            <h2>' + title + '</h2>' +
                        '            <p>' + content + '</p>';

            if (image){ 
                html += '            <img src="' + image + '" alt="' + title + '" />'; 
            }
            if (caption){ 
                html += '            <figcaption>' + caption + '</figcaption>'; 
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
            $(window).resize(unfuckModals);

            $(document).on('click', '.hotspot', createHotspot);
            $(document).on('tap click', '.menu-link', togglePanel);

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
                //$.cookie('welcome', 'hidden', { expires: 14 });
            });
        }

        function staggerHighlights() {
            $('.hotspot-indicator').each(function() {
                var random = Math.floor((Math.random() * 5) + 1);

                $(this).find('.glow').css({
                    '-o-animation-delay': random + 's',
                    '-moz-animation-delay': random + 's',
                    '-webkit-animation-delay': random + 's',
                    'animation-delay': random + 's'
                });
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
            staggerHighlights();
            
            if ($.cookie('alert') == 'hidden'){ 
                $('.alert').remove(); }
            /*
            if ($.cookie('welcome') == 'hidden'){ 
                $('.modal').remove(); 
                $('.overlay').remove(); }
            */
        });
    </script>

    <?php wp_head(); ?>
</head>
<body>
    <?php $post_array = get_pages('pagename = settings'); ?>
    <?php foreach ( $post_array as $post ) : setup_postdata( $post ); ?>
        <?php if(get_field('show_alert')): ?>
            <a class="alert" target="_blank" href="<?php the_field('alert_link'); ?>">
                <?php the_field('alert_text'); ?>
                <span class="close">&times;</span>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>

    <a class="menu-link">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="32px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve">
            <path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2 S29.104,22,28,22z"/>
        </svg>
    </a>
    <div id="wrapper" class="wrapper">
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
            <div id="auto-center"></div>
        </div>
    </div>

    
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

    <div id="not-available-modal" tabindex="-1" role="dialog">
        <h1>Oh-no! Your browser isn't supported.</h1>
        <h3>Unfortunately, your browser does not meet the requirements to view this site. Please ensure that you JavaScript is enabled, your operating system is up-to-date, and you have a modern supported browser (like <a href="http://www.google.com/chrome/" target="_blank">Google Chrome</a>). If you're seeing this message on a mobile device, make sure your device is updated to the latest browser version available.</h3>
    </div>

    <?php wp_footer(); ?>
</body>
</html>