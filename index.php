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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta name="copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">

    <title><?php wp_title( '-', true, 'right' ); ?></title>

    <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />
    <?php wp_head(); ?>
</head>
<body>
    <div id="wrapper">
        <div class="inner">
            <div class="clouds"></div>
            <div class="skyline"></div>
            <div class="trees"></div>
            <div class="foreground">
                <div class="ground"></div>
                <div class="water"></div>
            </div>
            <div class="hotspots"></div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery-ui.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery.ui.touch-punch.min.js"></script>
    
    <?php include_once('inc-data.php'); ?>
    <script>
        function buildHotspots(data) {
            $.each(data.hotspots, function(i, val) {
                var left = (val.position.left ? val.position.left : null);
                var html =  '<div class="hotspot" id="' + val.id + '"' +
                            '     style="height:' + val.size.height + '; width:' + val.size.width + '; left:' + left + '; bottom:' + val.position.bottom + ';"' +
                            '     data-modal="' + val.modal.description + '">' +
                            '</div>';
                
                $('.hotspots').append(html);
            });
        }

        function setMidpoint() {
            var windowWidth = $(window).width();
            var $wrapper = $('#wrapper .inner');

            $wrapper.css('left', -(($wrapper.width()/2) - windowWidth/2));
        }

        function setDraggable() {
            var windowWidth = $(window).width();
            var $wrapper = $('#wrapper .inner');

            $wrapper.draggable({ 
                axis: 'x', 
                drag: function(event, ui) {
                    if (ui.position.left > 0) {
                        ui.position.left = 0;
                    }
                    if (ui.position.left < -($wrapper.width() - windowWidth)) {
                        ui.position.left = -($wrapper.width() - windowWidth);
                    }
                }
            });
        }
        
        $(function(){
            buildHotspots(data);
            setMidpoint();
            setDraggable();
            
            $(document).on('click', '.hotspot', function(){
                var content = $(this).attr('data-modal');
                var html =  '<div class="modal-container">' +
                            '   <div class="modal">' + content + '</div>' +
                            '   <div class="overlay"></div>' +
                            '</div>';

                $('body').append(html);
                setTimeout(function(){ $('.modal-container').addClass('in'); }, 100);
            });

            $(document).on('click', '.overlay', function(){
                $('.modal-container').removeClass('in');
                setTimeout(function(){ $('.modal-container').remove(); }, 550);
            });

            $('body').on('touchmove', function(e) {
                if(!e._isScroller) { e.preventDefault(); }
            });
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>