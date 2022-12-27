<template>
   <BaseLayout title="UMKM Profile">
    <section class="mt-10">
      <div class="container">
        <div class="row gap-4">
          <StatusChecked :sessionCondition="checkSessionCondition"/>
          <UmkmDashboardSidebar section="profil_usaha"/>
               <div class="col-lg-8">
                 <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">{{ currentStep }}</span>
                    dari 3</p>
                </div>
                 <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    Anda wajib mengisi profil anda sesuai data anda saat ini !. Perusahaan anda harus legal di Indonesia.
                  </p>
                </div>
              </div>
                  <h1>Profil Saya</h1>
                <form @submit.prevent="submit()">
                  <div class="mb-4">
                    <label for="nama_lengkap" class="form-label text-neutral-gray-5">Nama Perusahaan</label>
                    <input type="text" v-model="form.nama_perusahaan" class="form-control" id="nama_lengkap" placeholder="Masukkan nama perusahaan Anda" >
                     <small class="text-danger" v-if="form.errors.nama_perusahaan">{{ form.errors.nama_perusahaan}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="tempat_kelahiran" class="form-label text-neutral-gray-5">Status Perusahaan</label>
                    <input type="text" class="form-control" v-model="form.status_perusahaan" id="tempat_kelahiran" placeholder="Masukkan status perusahaan Anda">
                    <small class="text-danger" v-if="form.errors.status_perusahaan">{{ form.errors.status_perusahaan}}
                    </small>
                  </div>
                            <div class="mb-4">
                    <label for="dokumen_amdal" class="form-label text-neutral-gray-5 mb-2">Dokumen Legalitas</label>
                    <div v-if="form.legalitas == null" class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="position-relative">
                        <h1 class="text-neutral-gray-5">Upload your file</h1>
                      </div>
                      <div class="position-relative">
                        <h2 class="text-primary-blue-6">Pilih</h2>
                        <input type="file" @change="inputDokumen($event,'legalitas')" id="dokumen_amdal">
                      </div>
                    </div>
                      <div v-else class="d-flex align-items-center px-4 py-2 alert alert-success gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="position-relative">
                           <h1 v-if="this.$page.props.auth.usaha['legalitas'] != null" class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${this.$page.props.auth.usaha['legalitas']}`">{{form.legalitas.split('/')[2]}}</a></h1>
                        <h1 v-else class="text-neutral-gray-5">{{form.legalitas.name}}</h1>
                      </div>
                      <div class="position-relative break">
                        <h2 class="text-primary-blue-6">Ganti Dokumen</h2>
                        <input type="file" @change="inputDokumen($event,'legalitas')" id="dokumen_amdal">
                      </div>
                    </div>
                      <small class="text-danger text-center" v-if="this.fileError" >{{this.fileError}}</small>
                  </div>
                    <div class="mb-4">
                    <label for="dokumen_amdal" class="form-label text-neutral-gray-5 mb-2">Dokumen AMDAL</label>
                    <div v-if="form.dokumen_amdal==null" class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="position-relative">
                        <h1 class="text-neutral-gray-5">Upload your file</h1>
                        <p class="text-neutral-gray-3">Format file .pdf, maks 10MB</p>
                      </div>
                      <div class="position-relative">
                        <h2 class="text-primary-blue-6">Pilih</h2>
                        <input type="file" @change="inputDokumen($event,'dokumen_amdal')" id="dokumen_amdal">
                      </div>
                      
                    </div>
                    <div v-else class="d-flex align-items-center px-4 py-2 alert alert-success gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                       <div class="position-relative">
                           <h1 v-if="this.$page.props.auth.usaha['dokumen_amdal'] != null" class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${this.$page.props.auth.usaha['dokumen_amdal']}`">{{form.dokumen_amdal.split('/')[2]}}</a></h1>
                        <h1 v-else class="text-neutral-gray-5 break">{{form.dokumen_amdal.name}}</h1>
                      </div>
                      <div class="position-relative">
                        <h2 class="text-primary-blue-6">Ganti Dokumen</h2>
                        <input type="file" @change="inputDokumen($event,'dokumen_amdal')" id="dokumen_amdal">
                      </div>
                      
                    </div>
                      <small class="text-danger text-center" v-if="this.fileError2" >{{this.fileError2}}</small>
                  </div>    

                  <div class="mb-4">
                    <label for="kelurahan" class="form-label text-neutral-gray-5">Informasi Pajak</label>
                       <input type="text" class="form-control" v-model="form.informasi_pajak" id="kelurahan" 
                       placeholder="Masukkan informasi pajak anda" >
                       <small class="text-danger" v-if="form.errors.informasi_pajak">{{ form.errors.informasi_pajak}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kecamatan" class="form-label text-neutral-gray-5">NPWP</label>
                       <input type="text" class="form-control" v-model="form.npwp" id="kecamatan" placeholder="Masukkan NPWP Anda" >
                       <small class="text-danger" v-if="form.errors.npwp">{{ form.errors.npwp}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Deskripsi Usaha</label>
                       <input type="text" class="form-control" v-model="form.deskripsi_usaha" id="kabupaten" placeholder="Masukkan deskripsi usaha Anda" >
                       <small class="text-danger" v-if="form.errors.deskripsi_usaha">{{ form.errors.deskripsi_usaha}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Email Perusahaan</label>
                      <input type="text" class="form-control" v-model="form.email_perusahaan" id="provinsi" placeholder="Masukkan email usaha anda !" >
                      <small class="text-danger" v-if="form.errors.email_perusahaan">{{ form.errors.email_perusahaan}}</small>
                  </div>
                   <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Alamat Perushaan</label>
                       <input type="text" class="form-control" v-model="form.alamat_perusahaan" id="kabupaten" placeholder="Masukkan alamat perusahaan Anda" >
                       <small class="text-danger" v-if="form.errors.alamat_perusahaan">{{ form.errors.alamat_perusahaan}}</small>
                  </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" :disabled="formCheck" class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">Selanjutnya</button>
                </div>
                 </form>
              </div>
          </div>
            </div>
        </section>
        </BaseLayout>
</template>

<script>
import BaseLayout from '../../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../../Components/UmkmDashboardSidebar.vue'
import StatusChecked from '../../../../Components/StatusChecked.vue'
import { ref } from 'vue'
import { useForm,Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
export default{
  data(){
    return{
      currentStep : window.location.pathname.split('/')[2],
      currentPage : window.location.pathname.split('/')[2],
      fileError:null,
      fileError2:null,
    }
  },
  setup () {
    const form = useForm({
      nama_perusahaan: null,
      status_perusahaan: null,
      legalitas: null,
      dokumen_amdal: null,
      informasi_pajak: null,
      npwp: null,
      deskripsi_usaha: null,
      email_perusahaan:null,
      alamat_perusahaan :null
    })

    return { form }
  },
  mounted(){
     this.form.nama_perusahaan= this.$page.props.auth.usaha['nama_perusahaan']
     this.form.status_perusahaan= this.$page.props.auth.usaha['status_perusahaan']
     this.form.legalitas= this.$page.props.auth.usaha['legalitas']
     this.form.dokumen_amdal= this.$page.props.auth.usaha['dokumen_amdal']
     this.form.informasi_pajak= this.$page.props.auth.usaha['informasi_pajak']
     this.form.npwp= this.$page.props.auth.usaha['npwp']
     this.form.deskripsi_usaha= this.$page.props.auth.usaha['deskripsi_usaha']
     this.form.email_perusahaan= this.$page.props.auth.usaha['email_perusahaan']
     this.form.alamat_perusahaan = this.$page.props.auth.usaha['alamat_perusahaan']   
  },
  computed:{
    formCheck(){
      if (this.form.nama_perusahaan == null && this.form.status_perusahaan == null && this.form.legalitas == null && this.form.dokumen_amdal == null && this.form.informasi_pajak == null && this.form.npwp == null && this.form.deskripsi_usaha== null && this.email_perusahaan == null && this.form.alamat_perusahaan == null){
        return true
      }
      return false;
    },
    checkSessionCondition(){
     if(this.$page.props.auth.finansialComplete && this.$page.props.auth.usahaComplete && this.$page.props.auth.produkComplete && this.$page.props.auth.profilComplete && !this.$page.props.auth.user.accepted){
      return true
     }
     return false
    }
  },
  components:{
    BaseLayout,
    Link,
    UmkmDashboardSidebar,
    StatusChecked
  },
  methods:{
    submit(){
         if (this.form.dokumen_amdal=='' || this.form.legalitas == '') {
            this.fileError = "Masukkan dokumen legalitas anda terlebih dahulu"
            this.fileError2 = "Masukkan dokumen amdal anda terlebih dahulu"
            return
        }
        this.form.post('/umkm/dashboard/profil_usaha/')
 
    },
  inputDokumen(event,id){
        if (id == 'legalitas') {
           if(event.target.files[0].type == 'application/pdf' || event.target.files[0].type == 'application/msword'){
              this.form.legalitas = event.target.files[0]
              this.$page.props.auth.usaha['legalitas'] = null;
               this.fileError = null
           }
           else{
               this.fileError = "dokumen anda harus pdf/docx !"
               console.log('test')
           }
        }
        else{
           if(event.target.files[0].type == 'application/pdf' || event.target.files[0].type == 'application/msword'){
               this.form.dokumen_amdal = event.target.files[0]
              this.$page.props.auth.usaha['dokumen_amdal'] = null;
               this.fileError2 = null
           }
            else{
                this.fileError2 = "dokumen anda harus pdf/docx !"
          
           }
        }
    },

  
},

}
</script>

<style scoped>
section {
  margin-top: 10rem !important;
}
.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}
.input_upload_custom h1,
.input_upload_custom h2 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0;
}
.input_upload_custom .position-relative {
  overflow: hidden;
  cursor: pointer;
}
.input_upload_custom p {
  font-size: 0.75rem;
  font-weight: 400;
  margin-bottom: 0;
}
.input_upload_custom input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.form-control {
  border: none;
  border-radius: 0;
  border-bottom: 2px solid #AEAEAE;
  padding-left: 0;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;

}
.hide{
  display: none;
}
.custom-file-input::before {

  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0\00a0Upload Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload.png');
  background-repeat: no-repeat;
  background-size: 18px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

.custom-file-input2::-webkit-file-upload-button {
  visibility: hidden;

}
.custom-file-input2::before {
  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0  Ambil Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload2.png');
  background-repeat: no-repeat;
  background-size: 19px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input2:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}
.card h2 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #3E4041;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
  .break{
   display: none;
  }
}
</style>
