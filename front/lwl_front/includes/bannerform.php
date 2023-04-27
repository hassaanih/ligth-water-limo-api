<section class="banform">
  <div class="container">
    <div class="row">
      <div class="">
        <div class="ban-form">
          <form class="cmxform" id="bannerform"  method="POST" action="webpages/bannerFormController.php">
            <div class="row">
              <div class="col-lg-12">
                <div class="fldset">
                  <input id="username" name="Name" minlength="2" type="text" placeholder="Enter your name" required />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="fldset">
                  <input id="cemail" type="email" name="Email" placeholder="Enter email here" required>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="fldset">
                  <input id="phone-coun" name="Number" type="number" placeholder="Phone Number" required />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="fldset">
                  <input name="submit" type="submit" placeholder="Connect With Us" required />

                  <script type="text/javascript">
                document.getElementById('location').value = window.location.href;
              </script>
              <input type="hidden" name="hiddencapcha" value="">
              <input type="hidden" id="location" name="locationURL" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php echo $path;?>
<?php echo $basesurl;?>
"background-image:url(<?php echo $basesurl;?>images/banners/homebanner.jpg