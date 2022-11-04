<template>
    <Layout>
        <div class="profile-saya  py-5">
            <div class="container ">
                <div class="row">
                    
                    <!-- Sidebar -->
                    <Sidebar/>
                    <div class="col col-md-8">
                        <div class="card" style="width: 25rem;">
                            <div class="card-body">
                                
                                
                                <h4>Ubah Email</h4>
                                
                                <p class="mt-5">Harap ingat email baru yang Anda buat. Email baru digunakan saat masuk akun Blanjaloka selanjutnya.</p>
                                
                                <form action="" class="mt-4">
                                    
                                    <div class="mb-3">
                                        <label for="email_lama" class="form-label">Email Lama</label>
                                        <input type="email" v-model="form.email" class="form-control" id="email_lama" disabled=true placeholder="Masukkan email lengkap Anda">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email_baru" class="form-label">Email Baru</label>
                                        <input type="email" v-model="form.email_baru.value" class="form-control" id="email_baru" placeholder="Masukkan email lengkap Anda" @focusout="checkEmail">
                                        <div v-if="form.email_baru.error.value">
                                            <small class="text-danger" >{{ form.email_baru.error.message }}</small>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <button type="submit" class="btn btn-primary-blue-5 btn-lanjut float-end text-white"  :disabled="isButtonDisable" @click="">{{isButtonDisable}}Ubah Email</button>
                                    
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
import { useForm } from '@inertiajs/inertia-vue3';
import { computed ,ref} from '@vue/reactivity';
import Layout from '../../Layouts/Layout.vue';
import Sidebar from '../../Layouts/components/profile/Sidebar.vue';
import axios from 'axios';
import { onMounted } from 'vue';

export default{
    components:{
        Layout,
        Sidebar
    },
    setup(){
        
       
        
        const form = useForm({
            email: '',
            email_baru: {
                value:'',
                error:{
                    value:null,
                    message:'Email telah terdaftar silahkan masukan email lain'
                }
            }
        });

        console.log(form)
        
        const checkEmail = () =>{
            
            axios.post('/profile-saya/check-email', {email:form.email_baru.value})
            .then((res)=>{
                form.email_baru.error.value = res.data.invalid;
                
            });
            
        }
        
        onMounted(()=>{
            axios.get('/user')
            .then((res)=>{
                form.email = res.data.email;
            })
        })
        const isButtonDisable = computed(() => {
            console.log('oke')
            if (!form.email_baru.error.value == null || form.email_baru.error.value == false) return false;
            return true;
        });
        
        return {form, isButtonDisable, checkEmail}
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