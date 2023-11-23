<div class="input-group mt-2 d-flex">
    <div class="input-group-prepend">
        <i class="fas fa-asterisk text-windx" aria-hidden="true"></i>
    </div>
    <input type="text" id="captcha" placeholder="Captcha"
           class="form-control inputs-login" name="captcha" aria-describedby="captcha"
           autocomplete="off">
    <div class="captcha d-flex">
        @captcha
        <div class="btn-reload-captcha m-2">
            <span class="reload fa fa-fw fa-sync text-primary"></span>
        </div>
    </div>
</div>
<small class="text-danger mt-3 captcha_error"></small>
