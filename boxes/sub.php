<?php include '../includes/config.php'; ?>
<head>
</head>
<div class="boxes">
    <button type="button" id="closebox" data-fancybox-close><img src="/img/close_box.svg" alt="close box"></button>
    <div class="boxes-container">
    <form action="/s/subscriber/" class="subscribe" id="subscribe" method="POST">
    <label for="emailSub" class="ms900"><?= $b->generalInfo->field_invitacion_newsletter ?></label>
    <input type="email" placeholder="Email*" name="emailSub" id="emailSub">
    <div class="politics_checkbox">
        <input type="checkbox" name="politics" id="politics" checked>
        <span class="politics_checkbox_mark"></span>
        <label for="politics"><?= $b->generalInfo->field_leido_txt ?><a href="/<?= $lang ?>/politica-tratamiento-datos-personales" target="_blank" rel="noopener"><?= $b->generalInfo->field_politic_txt ?></a></label>
    </div>
    <div class="g-recaptcha" id="recaptcha" data-sitekey="6Ld8r44fAAAAANfoX_j3luhSUrB0CkWgPM1zK12f"></div>
        <button type="submit" class="uppercase"><?= $b->generalInfo->field_botones_suscribirme ?></button>
      <br/>

</form>
    </div>
</div>
<script type="text/javascript">
  var onloadCallback = function() {
   
      startRecaptcha();

  };

</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
<!--
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
<script>
   function onSubmit(token) {
    grecaptcha.ready(function() {
            grecaptcha.execute('6Ld65Y0fAAAAAIXjAxyuiCB5OBlroLlkuiarw_Oo', {action: 'subscribe_newsletter'}).then(function(token) {
               /* $('#newsletterForm').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#newsletterForm').prepend('<input type="hidden" name="action" value="subscribe_newsletter">');
                $('#newsletterForm').unbind('submit').submit();*/
            });;
        });
     console.log(token);
     document.getElementById("subscribe").submit();
   }
 </script>-->