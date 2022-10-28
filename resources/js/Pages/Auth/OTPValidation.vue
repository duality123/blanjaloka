<template>
    <Layout>
        <div class="container-sm text-center">
            <div class="row">
                <div class="col"></div>
                <div class="col-7">
                    <img src="../../assets/images/verifikasi_email/handphone.png" alt="">
                    <h2 class="mt-5">Verifikasi No. Handphone Anda</h2>
                    <p>Silakan masukan kode OTP yang telah kami kirimkan ke nomor <b>{{ $page.props.auth.user.no_telepon }}</b>.</p>
                    <p>Sisa waktu <span>(00:{{countdown}})</span></p>
                    <div class="d-flex justify-content-center my-2">
                        <button class="btn btn-send-otp btn-outline-primary-blue-5 text-primary-blue-6 px-4 py-2" :disabled="toggleButtonResend" >Kirim ulang kode otp</button>
                    </div>
                    
                    <div id="otp" class="inputs d-flex flex-row justify-content-center my-5"> 
                        <input class="m-2 me-4 text-center form-control " type="text" id="first" maxlength="1"  /> 
                        <input class="m-2 me-4 text-center form-control " type="text" id="second" maxlength="1"  /> 
                        <input class="m-2 me-4 text-center form-control " type="text" id="third" maxlength="1"  /> 
                        <input class="m-2 me-4 text-center form-control " type="text" id="fourth" maxlength="1"  /> 
                        <input class="m-2 me-4 text-center form-control " type="text" id="fifth" maxlength="1"  /> 
                        <input class="m-2 me-4 text-center form-control " type="text" id="sixth" maxlength="1"  /> 
                    </div>
                    
                    <div class="d-flex justify-content-center flex-column flex-md-row">
                        <p>Tidak mendapat kode OTP?</p>
                        <a href="#" class="link-change-email ms-2">Ganti nomor handphone</a>
                    </div>
                    
                    <div class="d-flex justify-content-center my-2">
                        <button class="btn btn-lanjut btn-primary-blue-5 text-white px-4 py-2" :disabled="isButtonDisable" @click="toggleButtonLanjut">Lanjutkan</button>
                    </div>
                    
                </div>
                <div class="col"></div>
            </div>
            
        </div>
    </Layout>
</template>





<script>
//import layout

//import reactive
import { onMounted, ref, watch } from "vue";

//import inertia adapter
import { Inertia } from "@inertiajs/inertia";

import { Link} from "@inertiajs/inertia-vue3";

import Layout from "../../Layouts/Layout.vue";
import { computed } from "@vue/reactivity";

export default {
    
    //register component
    components: {
        Layout,
        Link,
        
    },
    
    props:{
        no_telepon: String
    },
    
    setup(props){
        
        const handleButtonLanjut = () => {
            Inertia.get('/');
        }
        const otp = ref('')
        
        const countdown = ref(30);
        const toggleButtonResend = ref(true);
        
        const isButtonDisable = computed(() => {
            if (otp.value.length == 6) return false;
            return true;
        });
        
        
        
        const countDownTimer = () =>{
            const timer = setInterval(() => {
                if (countdown.value > 0) {
                    countdown.value--;
                } else {
                    clearInterval(timer);
                    toggleButtonResend.value = false
                    
                }
            }, 1000);
        }
        
        const OTPInput = () =>{
            const inputs = document.querySelectorAll('#otp > *[id]');
            for (let i = 0; i < inputs.length; i++) { 
                inputs[i].addEventListener('keydown', function(event) {
                    if (event.key==="Backspace" ) {
                        
                        if(inputs[i].value == ''){
                            return;
                        }else{
                            console.log(otp.value[i])
                            otp.value = otp.value.replace(otp.value[i],'.');
                        } 
                        inputs[i].value='';
                        
                    } else { 
                        if (i===inputs.length - 1 && inputs[i].value !=='' ) { 
                            return true
                        } else if (event.keyCode> 47 && event.keyCode < 58) {
                            
                            if(i === inputs.length - 1){
                                
                                if(otp.value[i] != '.' ){
                                    inputs[i].value=event.key;
                                    otp.value+=event.key;
                                    console.log(otp.value);
                                }else{
                                    otp.value = otp.value.replace(otp.value[i],event.key);
                                } 
                                
                            }else{
                                if(inputs[i+1].value != '' ){
                                    inputs[i].value=event.key;
                                    otp.value = otp.value.replace(otp.value[i],event.key);
                                }else{
                                    inputs[i].value=event.key;
                                    otp.value+=(event.key);
                                }
                                
                                if (i !==inputs.length - 1 && inputs[i+1].value == '') inputs[i + 1].focus(); 
                                event.preventDefault()
                            }
                            
                        } else if (event.keyCode> 64 && event.keyCode < 91) {
                            if(i === inputs.length - 1){
                                inputs[i].value=String.fromCharCode(event.keyCode);
                                otp.value+=String.fromCharCode(event.keyCode);
                                
                            }else{
                                if( inputs[i+1].value != '' ){
                                    inputs[i].value=String.fromCharCode(event.keyCode);
                                    otp.value = otp.value.replace(otp.value[i],String.fromCharCode(event.keyCode));
                                }else{
                                    
                                    inputs[i].value=String.fromCharCode(event.keyCode);
                                    otp.value+=String.fromCharCode(event.keyCode);
                                }
                                
                                if (i !==inputs.length - 1 && inputs[i+1].value == '') inputs[i + 1].focus(); 
                                event.preventDefault() 
                            }
                        } 
                    } 
                }); 
            } 
        }
        
        const toggleButtonLanjut = () => {
            Inertia.post('/otp/verify', {otp: otp.value, no_telepon: props.no_telepon})
        }
        
        onMounted(() => {
            countDownTimer();
            
            
            OTPInput();
            
        })
        
        return {handleButtonLanjut,countdown, toggleButtonResend, isButtonDisable, toggleButtonLanjut}
        
        
        
    }
}
</script>

<style scoped>
.link-change-email{
    list-style: none;
    text-decoration: none;
}

.inputs input{
    width:50px;
    height:40px;
    border-radius: 0;
}

.form-control:focus{
    box-shadow:none;
    border:2px solid rgb(81, 125, 207)
}
.validate{
    border-radius:20px;
    height:40px;
    background-color:red;
    border:1px solid red;
    width:140px
    
}

.btn{
    width: 50%;
}

.btn-send-otp:hover{
    background-color: #f8fcff;
    color: #398AB9;
}

</style>