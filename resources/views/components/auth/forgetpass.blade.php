<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            <form onsubmit="event.preventDefault();">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Enter your email" />
                                </div>

                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-lg btn-primary" onclick="submitEmail()">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>

    async function submitEmail(){

        let email = document.getElementById('email').value;

        if(email.length==0){
            $.toast({message:"Email is required",type:'error'});
        }else{

            showLoader();
            try{
                let res = await axios.post('/send-otp',{
                email:email
                });
                hideLoader();

                if(res.data['status']=='success'){
                    sessionStorage.setItem('email',email);
                    $.toast({message:"OTP Sent",type:'success'});
                    setTimeout(() => {
                        window.location.href="/submit-otp"
                    }, 2000);
                }else{
                    $.toast({message:"Email does not exist",type:'error'});
                }
            }catch(error){
                hideLoader();
                $.toast({message:"Email Does not exist",type:'error'});
            }
        }
    }

</script>
