<div class="bot-form">
  <form class="cmxform" id="contactForm"  method="POST" action="webpages/bottomFormController.php">
    <div class="row">
      <div class="col-lg-6">
        <div class="fldset">
          <input id="username" name="Name" minlength="2" type="text" placeholder="Enter your name" required />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="fldset">
          <input id="cemail" type="email" name="Email" placeholder="Enter email here" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="fldset">
          <input id="phone-coun" name="Number" type="number" placeholder="Phone Number" required />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="fldset">
          <select name="Services">
            <option value="-1">Interested In</option>
            <!-- <option value="Website Design and Development">Website Design and Development</option> -->
            <option value="Reseller">Reseller</option>
            <option value="White labelled Agency Reseller">Agency Reseller </option>
            
            <option value="Referral">Referral</option>
            
          </select>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="fldset">
          <textarea name="Message" placeholder="Enter message here" /></textarea>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="fldset">
          <input type="hidden" name="hiddencapcha" value="">
          <input class="submit" type="submit" value="Submit" />
          <input class="" type="hidden" name="ctry" value="" />
          <input type="hidden" name="pc" value="">
        </div>
      </div>
    </div>
  </form>
</div>