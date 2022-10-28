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
                                        <input type="email" class="form-control" id="email_lama" placeholder="Masukkan email lengkap Anda">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email_baru" class="form-label">Email Baru</label>
                                        <input type="email" class="form-control" id="email_baru" placeholder="Masukkan email lengkap Anda">
                                    </div>
                                    
                                    
                                    
                                    <div class="btn btn-lanjut float-end text-white" >Ubah Email</div>
                                    
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
            email: '',
            password: '',
            remember: false,
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
        
        return {form, passwordInputType, passwordEyeType, isPasswordVisible, handleSubmit, handleTogglePassword, isButtonDisable}
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