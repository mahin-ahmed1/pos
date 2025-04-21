<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Welcome back!</h1>
                    <p class="lead">
                        Sign in to your account to continue
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            <form id="loginForm" onsubmit="event.preventDefault();">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Enter your email" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Enter your password" required />
                                </div>
                                <div>
                                    <div class="form-check align-items-center">
                                        <input id="remember" type="checkbox" class="form-check-input" name="remember" checked>
                                        <label class="form-check-label text-small" for="remember">Remember me</label>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary" onclick="login()">Sign in</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <div class="text-center mb-3">
                    Don't have an account? <a href="/signup">Sign up</a><br/>
                    Don't Remember Password? <a href="/forget">Forget</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function login(){

        let email = document.getElementById('email').value;

        let pass = document.getElementById('password').value;

        if(email.length==0){

            $.toast({
                'message':'Email is required',
                'type':'info'
            });
        }else if(pass.length==0){
            $.toast({
                'message':'Password is required',
                'type':'info'
            });
        

            showLoader();

         
    }
}
</script>

