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
                                                placeholder="Masukkan kata sandi Anda">
                                                <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                                class="position-absolute text-primary-blue-6 icon_eye" />
                                            </div>
                                            <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small>
                                            
                                        </div>

                                        <div class="mb-3">
                                            
                                            <label for="kata_sandi_baru" class="form-label text-neutral-gray-5">Kata Sandi Baru</label>
                                            <div class="input-group">
                                                <input :type="passwordInputType"  class="form-control" id="kata_sandi_baru"
                                                placeholder="Masukkan kata sandi Anda">
                                                <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                                class="position-absolute text-primary-blue-6 icon_eye" />
                                            </div>
                                            <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small>
                                            
                                        </div>
                                        <div class="mb-3">
                                            
                                            <label for="konfirmasi_kata_sandi" class="form-label text-neutral-gray-5">Konfirmasi Kata Sandi Baru</label>
                                            <div class="input-group">
                                                <input :type="passwordInputType"  class="form-control" id="konfirmasi_kata_sandi"
                                                placeholder="Masukkan kata sandi Anda">
                                                <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                                class="position-absolute text-primary-blue-6 icon_eye" />
                                            </div>
                                            <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small>
                                            
                                        </div>
                                        
                                    
                                    
                                    <div class="btn btn-lanjut float-end text-white" >Ubah Kata Sandi</div>
                                    
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
import Sidebar from '../../Layouts/components/profile/Sidebar.vue'
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