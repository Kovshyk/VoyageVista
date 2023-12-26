<?php $this->append('pageCss'); ?>
    <style type="text/css">
        #system_msg_wrapper {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 301px;
            z-index: 9999;
        }
        .fixed {
            position: fixed;
        }
        .system_msg_bottom, .system_msg_body, .system_msg_top {
            background: #f7f7f7;
        }
        .system_msg_top{
            height: 10px;
        }
        .system_msg_body{
            font-family: 'Open Sans';
            color: #aaa;
            font-size: 10px;
            padding: 2px 20px 5px;
        }
        .system_msg_bottom{
            height: 8px;
            margin: 0;
        }
        .system_msg_close{
            opacity: 0;
            left: auto!important;
            right: 17px!important;
            top: 10px!important;
            width: 16px!important;
            height: 16px!important;
            line-height: 16px!important;
            display: block!important;
            position: absolute;
            cursor: pointer;
            text-indent: -9999em;
        }
        .system_msg_close:before{
            content: '\f00d'!important;
            font-family: FontAwesome!important;
            font-size: 14px!important;
            width: 16px!important;
            height: 16px!important;
            line-height: 16px!important;
            color: #222!important;
            text-indent: 0!important;
            position: absolute!important;
            text-align: center!important;
            right: 0!important;
            top: 0!important;
        }
        .system_success .system_msg_title{
            color: #3498DB;
        }
        .system_error .system_msg_title{
            color: #FF0000;
        }
        .system_msg_title{
            font-size: 15px;
            line-height: 16px;
            padding-bottom: 2px;
            font-weight: 400;
            color: #222;
            text-shadow: none;
        }
        .system_msg p{
            padding: 0;
            font-size: 13px;
            margin: 0;
            word-wrap: break-word;
            color: #666;
        }
        #system_msg_wrapper:hover .system_msg_close {
            opacity: 1;
        }
    </style>
<?php $this->end(); ?>
    <div id="system_msg_wrapper" class="fixed system_success">
        <div class="system_msg_top"></div>
        <div class="system_msg_body">
            <a class="system_msg_close" tabindex="1" style="display: none;">Close</a>
            <div class="system_msg">
                <span class="system_msg_title"><?= __('Системне повідомлення') ?> <?php if(isset($params['title'])){echo $params['title'];} ?></span>
                <p><?= $message ?></p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="system_msg_bottom"></div>
    </div>
<?php $this->append('pageScript'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.system_msg_close').click( function(){
                $('#system_msg_wrapper').remove();
            });
            $(function() {
                $('#system_msg_wrapper').hover(function() {
                        $('#system_msg_wrapper').stop().fadeIn();
                    }
                );
            });
            var hideMessage = function() {
                $('#system_msg_wrapper').fadeOut(3000);
            };
            setTimeout(hideMessage, 3000);
        });
    </script>
<?php $this->end(); ?>