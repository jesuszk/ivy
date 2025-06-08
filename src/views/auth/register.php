<?= $this->layout("templates/auth", [
    "pageTitle" => "Login"
]); ?>


<form action="<?= route("auth.register.store"); ?>" method="POST" class="form login">

    <h4 class="text-center login__title">
        <span>WOZK</span>
        <i class="ph ph-minus"></i>
    </h4>



    <div class="form__field">
        <label for="login__username"><i class="ph ph-user"></i><span class="hidden">Username</span></label>
        <input autocomplete="username" id="login__username" type="text" name="username" class="form__input" placeholder="Username" value="<?= applyOldInput("username"); ?>">
    </div>
    <small style="color: red;"><?= applyWrongText("username"); ?></small>

    <div class="form__field">
        <label for="login__password"><i class="ph ph-lock"></i><span class="hidden">Password</span></label>
        <input id="login__password" type="password" name="password" class="form__input" placeholder="Password">
    </div>
    <small style="color: red;"><?= applyWrongText("password"); ?></small>

    <div class="form__field">
        <label for="login__password__confirm"><i class="ph ph-lock"></i><span class="hidden">Password</span></label>
        <input id="login__password__confirm" type="password" name="password_confirmation" class="form__input" placeholder="Password Confirmation">
    </div>
    <small style="color: red;"><?= applyWrongText("password_confirmation"); ?></small>

    <div class="form__field">
        <input type="submit" value="Create Account">
    </div>

</form>

<p class="text--center">Have account? <a href="<?= route("auth.login"); ?>">login now <i class="ph ph-arrow-right"></i></a></p>