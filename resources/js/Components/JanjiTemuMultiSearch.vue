<template>
         <div class="col d-flex justify-content-center ">
        <div class="container-fluid">
          <div class="row g-3">
        
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="Semua Lokasi" v-model="this.searchList.lokasi">
        </div>
 
   
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="berakhir" v-model="this.searchList.berakhir">
        </div>
      
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="dimulai" v-model="this.searchList.dimulai">
        </div>
         <div class="input-group col">
              <input type="text" class="form-control" placeholder="UMKM" v-model="this.searchList.nama_umkm">
        </div>


        <div class="input-group col">
              <input type="text" class="form-control" placeholder="Investor" v-model="this.searchList.nama_investor">
        </div>

        <div class="input-group col ">
             <button @click="search()" class="btn btn-primary-blue-6 text-neutral-white py-2">Cari
              <font-awesome-icon icon="fas fa-search" /> 
            </button>
      </div>
    </div>
  </div>
    </div>
</template>
<script>
  import { Inertia } from "@inertiajs/inertia";
  export default{
    data(){
      return{
        searchList:{
          lokasi:null,
          berakhir:null,
          dimulai:null,
          nama_umkm:null,
          nama_investor:null
          } 
      }
    },

    methods:{
    search(){
      let uri = {}
      /*
      sessionStorage.clear()
      sessionStorage.setItem('lokasi', this.searchList.lokasi) 
      sessionStorage.setItem('event_berakhir',this.searchList.berakhir) 
      sessionStorage.setItem('event_dimulai',this.searchList.dimulai) 
      sessionStorage.setItem('nama_umkm',this.searchList.nama_umkm)
      sessionStorage.setItem('nama_investor',this.searchList.nama_investor)
  */
        Inertia.get(this.url,this.searchList,{only:this.lazy,preserveScroll: true,preserveState:true })

      }
    },
     
   props:{
        url:String,
        judul:String,
        lazy:Array,
        customSearch:String
      },
  mounted(){
     let uri = window.location.search.substring(1)
      let params = new URLSearchParams(uri)
      if (params.get('nama_umkm')) {
        this.nama_umkm = params.get('nama_umkm')      
    }
    if (params.get('perusahaan_umkm')) {
        this.perusahaan_umkm = params.get('perusahaan_umkm')      
    }
    if (params.get('produk_umkm')) {
        this.produk_umkm = params.get('produk_umkm')      
    }
    if (params.get('lokasi_umkm')) {
        this.lokasi_umkm = params.get('lokasi_umkm')      
    }
    }
}
  
</script>
<style scoped>
.form-control,
.form-select,
.vs__dropdown-toggle {
    border-width: 1px !important;
   border-radius: 5px!important;
   border: 1px solid #aeaeae !important;
    padding:5px !important;

}

.vs__search {
    padding-left: 0 !important;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
}


.form-control:focus {
  box-shadow: none;
   border: 1px solid  #398ab9 !important;
}
.form-control:click {
  border: 1px solid #3ccede !important;
}
</style>