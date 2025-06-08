<?= $this->layout("templates/auth", [
    "pageTitle" => "Login"
]); ?>



<form action="<?= route("auth.login.store"); ?>" method="POST" class="form login">

    <h4 class="text-center login__title">
        <span>WOZK</span>
        <i class="ph ph-minus"></i>
    </h4>



    <div class="form__field">
        <label for="login__username"><i class="ph ph-user"></i><span class="hidden">Username</span></label>
        <input autocomplete="username" id="login__username" type="text" name="username" class="form__input" placeholder="Username" required>
    </div>

    <div class="form__field">
        <label for="login__password"><i class="ph ph-lock"></i><span class="hidden">Password</span></label>
        <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
    </div>

    <div class="form__field">
        <input type="submit" value="Sign In">
    </div>

</form>

<p class="text--center">Not a member? <a href="<?= route("auth.register"); ?>">Sign up now <i class="ph ph-arrow-right"></i></a></p>