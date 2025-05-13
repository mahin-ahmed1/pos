<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            <form onsubmit="event.preventDefault();">
                                <div class="mb-3">
                                    <label class="form-label">OTP</label>
                                    <input class="form-control form-control-lg" type="text" id="otp" name="otp" placeholder="O T P" />
                                </div>

                                <div class="d-grid gap-2 mt-3">
                                    <button type="button" class="btn btn-lg btn-primary" onclick="submitOTP()">Submit</button>

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

    async function submitOTP(){

        let otp = document.getElementById('otp').value;
        let email = sessionStorage.getItem('email');

        if(otp.length==0){
            $.toast({message:'OTP cannot by empty',type:'error'});
        }else{
            showLoader();

            try{
                let res = await axios.post('/verify-otp',{
                    email:email,
                    otp:otp
                });

                hideLoader();
                if(res.data['status']=='success'){
                    window.location.href="/set-password";
                }
            }catch(error){
                $.toast({message:'OTP Verification failed',type:'error'});
            }
        }
    }
</script>
