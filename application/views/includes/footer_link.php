
<script src="<?=base_url()?>js/components/bs-datatable.js"></script>


<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>
<script>
    function alert_msg(msg,title='ALERT',size='small') {
        //alert('as');
        $('#'+size+'_modal_title').html(title);
        $('#'+size+'_modal_body').html(msg);
        $('#'+size+'_modal_btn').click();

    }
    $('#small_model_btn').hide();
    function load_js()
    {
        var head= document.getElementsByTagName('head')[0];
        var script= document.createElement('script');
        script.src= '<?=base_url()?>js/custom.js';
        head.appendChild(script);
    }
    load_js();
</script>
</body>
<?php
if(isset($pop_message)&&$pop_message!=""){
    $pop_message = trim(nl2br($pop_message));
    echo "<script>
        alert_msg('{$pop_message}','Alert',);
        </script>";
}
?>
</html>
<?php

if(isset($_SESSION['ALERT_MSG'])){
    $msg = isValidData($_SESSION['ALERT_MSG']['MSG']);
    $title = $_SESSION['ALERT_MSG']['TYPE'];
    echo "<script>
        alert_msg('$msg','$title');
        </script>";
    unset($_SESSION['ALERT_MSG']);
}
?>