<?php

/**
 * @var Contact $model
 */

use App\Models\Contact;

?>
<div class="map">
    <iframe src="https://maps.google.com/maps?q=Dynamic%20Layers&t=&z=11&ie=UTF8&iwloc=&output=embed" width="100%" height="350" style="border:0;"></iframe>
</div>

<section class="contact-section">
    
    <div class="row">
        <div class="col-50">
            <h1>Contact Us</h1>
            
            <strong>Address</strong>
            <p> 198 West 21th Street,<br>
                New York, NY 10010</p>

            <strong>Email</strong>
            <p>email@example.com</p>

            <strong>Phone</strong>
            <p>+88 (0) 101 0000 000</p>
        </div>
        <div class="col-50">
            <form action="" method="post" class="contact-form block">
                <h2 class="text-center">Ask A Question</h2>
                <p class="text-center intro">Get in touch with us & send us message today!</p>
                
                <?php if (session()->getSuccessFlash()): ?>
                    <div class="alert-success"> <?= session()->getSuccessFlash() ?> </div>
                <?php else: ?>
                <div class="row">
    
                    <div class="form-item">
                        <label for="email" class="form-label hidden">Email</label>
                        <?php if (session()->isGuest()): ?>
                        <input type="email" name="email" id="email" placeholder="Email"
                               value="<?= $model->email ?>"
                               class="form-control <?= $model->hasError('email')? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback"><?= $model->getFirstError('email') ?></div>
                        <?php else: ?>
                        <input type="email" name="email" id="email" placeholder="Email"
                               value="<?= session()->user->email ?>"
                               class="form-control" disabled>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-item">
                        <label for="name" class="form-label hidden">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name"
                               value="<?= $model->name ?>"
                               class="form-control <?= $model->hasError('name')? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback"><?= $model->getFirstError('name') ?></div>
                    </div>
                    
                    <div class="form-item">
                        <label for="message" class="form-label hidden">Message</label>
                        <textarea name="message" id="message" placeholder="Message" rows="5"
                                  class="form-control <?= $model->hasError('message')? 'is-invalid' : '' ?>"><?= $model->message ?></textarea>
                        <div class="invalid-feedback"><?= $model->getFirstError('message') ?></div>
                    </div>
                    
                    <div class="form-item">
                        <input type="submit" class="btn" value="Send">
                    </div>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>