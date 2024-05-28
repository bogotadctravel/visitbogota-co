<? 

//print_r($b->RLDgeneralInfo); ?>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '656805532370012');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=656805532370012&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<div class="rld_header gbackground ">
<div class="outter bg_left">    
       <h1> <a href="/<?=$lang?>/ruta-leyenda-el-dorado/inicio" class="logo replaced_text">Ruta Leyenda El Dorado</a></h1>
            <nav>
                <ul class="bold">
                    <li><a href="/<?=$lang?>/ruta-leyenda-el-dorado/inicio" class="home replaced_text">Inicio</a></li>
                    <li><a href="#" class=""><?=$b->RLDgeneralInfo->field_rld_uiword1?></a>
                        <ul>
                            <?php $routes = $b->get_rld_routes();
                                for($i=0;$i<count($routes);$i++){
                                    $thealias = $b->get_alias($routes[$i]->title);

                            ?>
                            <li><a href="/<?=$lang?>/ruta-leyenda-el-dorado/ruta/<?=$thealias?>-<?=$routes[$i]->nid?>"><?=$routes[$i]->title?></a></li>
                            <? } ?>
                        </ul>
                    
                    </li>
                    <li><a href="/<?=$lang?>/ruta-leyenda-el-dorado/aprende/" class=""><?=$b->RLDgeneralInfo->field_rld_uiword2?></a></li>
                    <li><a href="/<?=$lang?>/ruta-leyenda-el-dorado/imperdibles/" class=""><?=$b->RLDgeneralInfo->field_rld_uiword3?></a></li>
                </ul>
            </nav>
</div>
    </div>