<section id="contact-page">
<?php echo $message;?>
<div class="container">
<div class="center">
<h2>Drop Your Message</h2>
<p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
</div>
<div class="row contact-wrap">
<div class="status alert alert-success" style="display: none"></div>
<?php echo form_open('welcome/sendmessage');?>
<div class="col-sm-5 col-sm-offset-1">
<div class="form-group">
<label>Name *</label>
<input type="text" name="nameuser" class="form-control" required="required">
</div>
<div class="form-group">
<label>Email *</label>
<input type="email" name="emailuser" class="form-control" required="required">
</div>
<div class="form-group">
<label>Phone</label>
<input type="number" class="form-control" name="phoneuser">
</div>
<div class="form-group">
<label>Company Name</label>
<input type="text" class="form-control" name="companyuser">
</div>
</div>
<div class="col-sm-5">
<div class="form-group">
<label>Subject *</label>
<input type="text" name="subject" class="form-control" required="required">
</div>
<div class="form-group">
<label>Message *</label>
<textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
</div>
<div class="form-group">
<button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
</div>
</div>
<?php echo form_close();?>
</div> 
</div> 
</section> 