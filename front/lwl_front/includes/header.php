
<?php 


  if ($_SERVER['HTTP_HOST'] == "localhost") {
      $folder_name = ""; $path = 'https://localhost/lwl_front/'.$folder_name;
  } else {
    $folder_name = ""; $path = 'https://'.$_SERVER['HTTP_HOST'].''.$folder_name.'/junaid/';
  }

  ?>

<!-- <noscript>
<div id="jqcheck"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAB60lEQVQ4T2NkwAHePzrxf3ebL1jWp/0oA5egGiM2pVgFQQq31uj/N/ANZvj+8T3D7aNHGDwbTxNvwKtbO/9f3dLHYJ+axfDn5w+GI/NnMRhFtTEISJtjGIIh8Pv39/87ak0ZzCLiGMRUNMCufnLxDMOlrZsY3JtOMrCwsKPowTDg3tGZ/59f2sVgFRvPkO+bAzZgwsZJDEcXzWNQtIlikDGIwG3Az+9v/+9qsGOwTc1h4JeQhhswcfMUhrcP7zEcXzyXwb3xMAMbuwDcEBTTzi7P/s/M8IFB3zccbDPMBSADQODs2sUMzFwyDIah/ZgGfHt/7/+BvmAGm+RsBl4RMawGfHr5jOHowlkMjiUbGDj55MCGwE060Of1X0RZi0Hb2Q4e3eguAElc2X2A4e2DmwwOhVsRBnx6cfH/yXm5DFZxyQxcAoJ4Dfj24T3DsUVzGcwSJjLwSxkygk3ZVmv4X805gkHZRBNXwkQRv3/+NsP1nUsYvFvOMzI+PLXo/73DSxgsouIYOHj5UBRi8wJIwY8vnxlOLV/CIGcewsC4vkDhv01yLoOIoiqG7bgMACn88Owxw8HpvQyMGwqV/vs19TMwQnxDEthYW8DAeGCC3/9XN46TpBGmWEzDkoHx06dP/z9//kyWAby8vAwAcza2SBMOSCMAAAAASUVORK5CYII=" alt="No Script" /> Javascript is disabled. Please enable it for better working experience.</div>
</noscript> -->
<!--<div class="mobile-nav"> <a href="<?php// echo $path;?>" class="logo-main"> <img src="<?php //echo $basesurl;?>images/Advantage-Tech-01.png" alt="*" /></a>
   <nav>

    <ul class="unstyled mainnav pbpx-15">
      <li><a href="<?php ///echo $path;?>">Home</a></li>
      <li><a href="javascript:;">Services <i class="xicon icon-angle-down"></i></a>
        <ul class="firstlevel unstyled">
          <li><a href="<?php //echo $path;?>">Logo Design</a></li>
          <li><a href="<?php////echo $path;?>">Website Design &amp; Development</a></li>
          <li><a href="<?php //echo $path;?>">Search Engine Optimization</a></li>
          
          <li><a href="<?php //echo $path;?>">Mobile App Development</a></li>
          <li><a href="<?php //echo $path;?>">Video Animation Services</a></li>
        </ul>
      </li>
      <li><a href="<?php //echo $path;?>">Reseller Program </a>
       
      </li>
      <li><a href="<?php //echo $path;?>">Portfolio</a></li>
      <li><a href="<?php //echo $path;?>">Culture</a></li>
      <li><a href="<?php //echo $path;?>">Pricing</a></li>
    </ul>

    


  </nav>
</div>-->
<!-- <main class="app-container"> -->
<!-- Mobile Navigation Button Start-->
<!-- <div class="mobile-nav-btn"> <span class="lines"></span> </div> -->
<!-- Mobile Navigation Button End-->


<!-- <header>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="logowrp">
          <a href="<?php //echo $path;?>">
            <img class="wht-logo" src="<?php //echo $basesurl;?>images/Advantage-Tech-01.png">
            <img class="drk-logo" src="<?php //echo $basesurl;?>images/Advantage-Tech-01.png"> 
          </a>
        </div>
      </div>
      <div class="col-md-8 my-auto">
        <div class="navwrp">
          <ul>
            
            <li>
              <a href="<?php //echo $path;?>about-us">Home</a>
            </li>
            <li>
              <a href="<?php //echo $path;?>faqs">About Us</a>
            </li>
            <li>
              <a href="<?php //echo $path;?>contact-us">VOIP</a>
            </li>
            <li>
              <a href="<?php //echo $path;?>about-us">Private Area</a>
            </li>
            <li>
              <a href="<?php //echo $path;?>about-us">Domains</a>
            </li>
            <li>
              <a href="<?php // $path;?>about-us">Contact Us</a>
            </li>
            <li class="search-icon">
              <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>
     <div class="col-md-5 my-auto">
        <div class="btnwrp">
          <ul class="">
            <li>
              <a class="" href="<?php //echo $path;?>user/login">User Login/Signin</a>
            </li>
            <li>
              <a class="" href="<?php //echo $path;?>business/login">Login as Business Owner</a>
            </li>
          </ul>
        </div>
      </div> 
    </div>
  </div>
</header> 