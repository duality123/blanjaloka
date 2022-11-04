<template>
    <Layout>
        <div class="profile-saya  py-5">
            <div class="container ">
                <div class="row">
                    
                    <!-- Sidebar -->
                    <Sidebar />
                    <div class="col col-md-8">
                        <div class="card" style="width: 25rem;">
                            <div class="card-body">
                                
                                
                                <h4>Ubah Kata Sandi</h4>
                                
                                <p class="mt-5">Harap ingat kata sandi baru yang Anda buat. Kata sandi baru akan digunakan saat masuk akun Blanjaloka selanjutnya.</p>
                                
                                <form action="" class="mt-4">
                                    
                                    <div class="mb-3">
                                        
                                        <label for="kata_sandi" class="form-label text-neutral-gray-5">Kata Sandi Lama</label>
                                        <div class="input-group">
                                            <input :type="passwordInputType"  class="form-control" id="kata_sandi"
                                            placeholder="Masukkan kata sandi Anda" v-model="form.passwordLama.value" @focusout="checkPasswordLama">
                                            <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                            class="position-absolute text-primary-blue-6 icon_eye" />
                                        </div>
                                        <div v-if="form.passwordLama.invalid.value">
                                            <small v-for="error in form.passwordLama.invalid.errors" class="text-danger" >{{ error }}</small>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="mb-3">
                                        
                                        <label for="kata_sandi_baru" class="form-label text-neutral-gray-5">Kata Sandi Baru</label>
                                        <div class="input-group">
                                            <input :type="passwordInputType"  class="form-control" v-model.trim="form.passwordBaru.value" id="kata_sandi_baru"
                                            placeholder="Masukkan kata sandi Anda" @keyup="checkPasswordBaru">
                                            <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                            class="position-absolute text-primary-blue-6 icon_eye" />
                                        </div>
                                        <div v-if="form.passwordBaru.invalid.value" class="my-3">
                                            <p v-for="error in form.passwordBaru.invalid.errors" :class="{'text-danger':error.status == true, 'text-success': error.status == false, 'text-secondary' :  error.status == null}" >{{ error.message }}</p>
                                        </div>
                                        <!-- <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small> -->
                                        
                                    </div>
                                    <div class="mb-3">
                                        
                                        <label for="konfirmasi_kata_sandi" class="form-label text-neutral-gray-5">Konfirmasi Kata Sandi Baru</label>
                                        <div class="input-group">
                                            <input :type="passwordInputType"  class="form-control" v-model="form.passwordKonfirmasi.value" id="konfirmasi_kata_sandi"
                                            placeholder="Masukkan kata sandi Anda" @focusout="checkPasswordKonfirmasi">
                                            <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                            class="position-absolute text-primary-blue-6 icon_eye" />
                                        </div>
                                        <!-- <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small> -->
                                        <div v-if="form.passwordKonfirmasi.invalid.value">
                                            <small v-for="error in form.passwordKonfirmasi.invalid.errors" class="text-danger" >{{ error }}</small>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary-blue-5 btn-lanjut float-end text-white"  :disabled="invalid" @click="resetPassword">Ubah Kata Sandi</button>
                                
                                </form>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>



<script>

import { ref, computed} from '@vue/reactivity';
import Layout from '../../Layouts/Layout.vue';
import Sidebar from '../../Layouts/components/profile/Sidebar.vue'
import axios from 'axios';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
export default{
    components:{
        Layout,
        Sidebar
    },
    
    setup(){
        const isPasswordVisible = ref(false);
        const passwordInputType = ref('password');
        const passwordEyeType = ref('fa-solid fa-eye-slash');

        const form = useForm({
            passwordLama: {
                value: '',
                invalid: {
                    value : null,
                    errors:'Kata sandi lama tidak sesuai'
                }
            },
            passwordBaru: {
                value: '',
                invalid: {
                    value : null,
                    errors:[
                    {message: 'Kata sandi terdiri lebih dari 8 karakter', status:null},
                    {message: 'Kata sandi harus mengandung angka ', status:null},
                    {message: 'Kata sandi harus mengandung huruf kapital', status:null},
                    {message: 'Kata sandi harus mengandung huruf simbol', status:null},
                    ]
                }
            },
            passwordKonfirmasi: {
                value: '',
                invalid: {
                    value : null,
                    errors:['Kata sandi tidak sesuai']
                }
            },
        });
        
        const handleTogglePassword = (e) => {
            isPasswordVisible.value = !isPasswordVisible.value;
            passwordInputType.value = isPasswordVisible.value ? 'text' : 'password';
            passwordEyeType.value = isPasswordVisible.value ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
        }
        
        const handleSubmit = () => {
            form.post('/login');
        }
        
        const isButtonDisable = computed(() => {
            if (form.email != '' && form.password != '') return false;
            return true;
        });
        
        const checkPasswordLama = () => {
            axios.post('/profile-saya/check-password', {password:form.passwordLama.value})
            .then((res)=>{
                form.passwordLama.invalid.value = !res.data.result;
            })       
        }
        
        const checkPasswordBaru = () => {
            
            
            if(form.passwordBaru.value.length < 8){
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[0].status = true;
                
            }else{
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[0].status = false;
                
            }
            
            if((/[0-9]/.test(form.passwordBaru.value))){
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[1].status = false;
            }else{
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[1].status = true;
            }
            
            if(/[a-z]/.test(form.passwordBaru.value) && /[A-Z]/.test(form.passwordBaru.value)){
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[2].status = false;
            }else{
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[2].status = true;
            }
            
            let symbol = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            if(symbol.test(form.passwordBaru.value)){
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[3].status = false;
            } else {
                form.passwordBaru.invalid.value = true;
                form.passwordBaru.invalid.errors[3].status = true;
            }

            if(form.passwordBaru.invalid.errors[0].status == false && form.passwordBaru.invalid.errors[1].status == false && form.passwordBaru.invalid.errors[2].status == false && form.passwordBaru.invalid.errors[3].status == false){
                form.passwordBaru.invalid.value = false
            }
          
            }

            const checkPasswordKonfirmasi = () => {
                if(form.passwordBaru.value == form.passwordKonfirmasi.value) {
                    form.passwordKonfirmasi.invalid.value = false;
                }else{
                    form.passwordKonfirmasi.invalid.value = true;
                }

            }

            const invalid = computed(()=>{
                if(form.passwordLama.invalid.value == false && form.passwordBaru.invalid.value == false && form.passwordKonfirmasi.invalid.value == false){
                    return false;
                }else{
                    return true;
                }
            })
            
            const resetPassword = () =>{
                 axios.get('/user')
                      .then((res)=>{
                         axios.post('/profile-saya/ubah-password', {id: res.data.id, password : form.passwordBaru.value})
                      })
            }
            return {form, checkPasswordLama, checkPasswordBaru, checkPasswordKonfirmasi, passwordInputType, passwordEyeType, isPasswordVisible, handleSubmit, resetPassword, handleTogglePassword, isButtonDisable,  invalid}
        }
    }
</script>

<style>



.form-label{
    font-weight: 600;
    font-size: 15px;
    font-style: 'Inter';
}

.input-profile{
    background-color: #F0F0F0;
}


.icon_eye {
    bottom: 0.8rem;
    right: 0;
    cursor: pointer;
}

.inputInvisible{
    color: transparent;
}

.inputVisible{
    color: rgb(0, 0, 0)
}


#formFileLabel{
    cursor:pointer;
    background: #FFF;
    font-size: 12px;
    font-style: 'Inter';
    font-weight: 400;
}

#formFile{
    opacity: 0;
    position: absolute;
    z-index: -1;
}

.form-control, .form-select{
    border: none;
    border-radius: 0;
    border-bottom: 2px solid #AEAEAE;
    padding: 0;
}


.btn-lanjut{
    background-color: #398AB9;
}
.btn-lanjut:hover{
    background-color: #4398c9;
}

</style>