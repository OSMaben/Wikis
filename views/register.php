<div class="container-fluid vh-100" style="margin-top:30px">
    <div class="" style="margin-top:200px">
        <div class="rounded d-flex justify-content-center">
            <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                <div class="text-center">
                    <h3 class="text-primary">Create Account</h3>
                </div>
                <div class="p-4">
                    <form method="post">
                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary">
                                            <i class="bi bi-person-plus-fill text-white"></i>
                                        </span>
                                <input type="text" id="userName" name="fullname" class="form-control" placeholder="Username">
                            </div>

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary">
                                        <i class="bi bi-envelope text-white"></i>
                                    </span>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <span class="EmailErro"  style="color: red; text-align: center; font-size: 0.8rem;font-family: system-ui"></span>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary">
                                        <i class="bi bi-key-fill text-white"></i>
                                    </span>
                                <input type="password" id="password" name="password" class="form-control" placeholder="password">
                            </div>
                            <span class="PassErro"  style="color: red; text-align: center; font-size: 0.8rem; font-family: system-ui"></span>
                        </div>
                        <div class="d-grid col-12 mx-auto">
                            <button class="btn btn-primary" id="submit" type="submit">Sign up</button>
                        </div>
                        <p class="text-center mt-3">Already have an account?
                            <a href="/login" class="text-primary">Sign in</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>