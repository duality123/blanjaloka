<template>
    <DashboardLayout title="Kegiatan">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
        <form>
            <div class="form-add">
                <div class="form-section mb-5">
                    <h4 class="form-section-title">Bagian 1</h4>
                    <div class="my-3">
                        <label for="tema" class="form-label">Tema Kegiatan</label>
                        <input type="text" class="form-control" id="tema" placeholder="Masukan tema kegiatan">
                    </div>
                    <div class="my-3">
                        <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                        <input type="text" class="form-control" id="deskripsi" onkeyup="countChars(this)" placeholder="Tuliskan deskripsi kegiatan" maxlength="512"><span id=charcount></span>
                    </div>
                    <div class="my-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" v-model="form.email" placeholder="name@example.com">
                    </div>
                </div>
                <div class="form-section my-5">
                    <h4 class="form-section-title">Bagian 2</h4>
                    <div class="my-3">
                        <label for="partisipan" class="form-label">Jumlah Partisipan</label>
                        <div class="col-lg-7">
                            <div class="input-group">
                                <input type="text" class="form-control" id="partisipan" placeholder="Masukan jumlah partisipan">
                                <span id="basic-addon2">Orang</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="juri" class="form-label">Nama Juri</label>
                        
                        <VoerroTagsInput class="form-control" 
                        lement-id="tags" @tag-added="onTagAdded" @tag-removed="onTagRemoved"
                        v-model="form.selectedTags"
                        :existing-tags="form.existingTags"
                        :typeahead="true" typeahead-style="dropdown" :typeahead-max-results=10 :typeahead-activation-threshold=0 :placeholder="form.selectedTags.length > 0 ? '' : 'Masukan nama juri kegiatan'" :typeahead-hide-discard=true></VoerroTagsInput>
                        
                    </div>
                    <div class="my-3">
                        <label for="investor" class="form-label">Nama Investor</label>
                        <input type="text" class="form-control" id="investor" placeholder="Masukan nama-nama investor kegiatan">
                    </div>
                </div>
                
                <div class="form-section my-5">
                    <h4 class="form-section-title">Bagian 3</h4>
                    <div class="my-3">
                        <label for="inkubasi" class="form-label">Masa Inkubasi</label>
                        <div class="col-lg-7">
                            <div class="input-group">
                                <input type="text" class="form-control" id="inkubasi" placeholder="Masukan lama masa inkubasi">
                                <span id="basic-addon2">Bulan</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="kurikulum" class="form-label">Kurikulum</label>
                        <input type="text" class="form-control" id="kurikulum" placeholder="Masukan kurikulum kegiatan">
                    </div>
                    <div class="my-3">
                        <label for="pic" class="form-label">PIC</label>
                        <input type="text" class="form-control" id="pic" placeholder="Masukan nama PIC kegiatan">
                    </div>
                    <div class="my-3">
                        <label for="pic" class="form-label">Kontak Nomor PIC</label>
                        <div class="input-group">
                            <span id="basic-addon-pic">+62</span>
                            <input type="text" class="form-control" id="pic" placeholder=" Nomor handphone">
                        </div>
                    </div>
                    
                </div>

                <button class="btn float-end">Submit</button>
            </div>
            
        </form>
    </DashboardLayout>
</template>


<script>
    import DashboardLayout from '../../../Layouts/Dashboard.vue'
    import VoerroTagsInput from '@voerro/vue-tagsinput';
    import { reactive,computed, ref  } from 'vue';
    export default{
        components:{
            DashboardLayout,
            VoerroTagsInput
        },
        
        setup(){
            
            const placeholder = ref('Masukan nama juri kegiatan');
            
            
            const form = reactive({
                email: '',
                password: '',
                selectedTags: [],
                existingTags: [{ key: '1', value: 'Irene' },
                { key: '2', value: 'Wendy' },
                { key: '3', value: 'Seulgi' }, { key: '4', value: 'Joy' },
                { key: '5', value: 'Yeri' }
                ],
                
            });
            
            
            const onTagAdded = function(slug){
                form.selectedTags.push(slug);
            }
            
            const onTagRemoved = function(slug){
                const result = form.selectedTags.filter((tag) => tag.value != slug.value );
                form.selectedTags = result;
            }
            
            return {form, onTagAdded, placeholder, onTagRemoved}
        }
    }
    
    
</script>

<style scoped>
    .form-add{
        /* background-color: rgb(73, 136, 81); */
        width: 50%;
        margin-left: 10%;
    }
    
    .form-label{
        font-weight: 500;
    }
    .form-control{
        background-color: rgba(var(--bs-neutral-white-2-rgb), var(--bs-bg-opacity)) !important;
        border: none;
        border-radius: 0;
        border-bottom: 2px solid #AEAEAE;
        padding: 0;
    }
    
    #basic-addon-pic{
        border-bottom: 2px solid #AEAEAE;
    }
    
    #charcount{
        float:right;
    }

    .btn{
        background-color: #D7E8F1;
        color: #fff;
    }
    
    
    
    
    
</style>