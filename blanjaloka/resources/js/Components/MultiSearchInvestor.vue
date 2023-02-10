<template>
        
          <div class="col d-flex justify-content-center mt-4">
        <div class="container-fluid">
          <div class="row g-3">
        
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="Semua Investor" v-model="this.nama_investor">
        </div>
 
   
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="semua perusahaan" v-model="this.perusahaan_investor">
        </div>
      
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="semua kategori" v-model="this.kategori_investor">
        </div>


        <div class="input-group col">
              <input type="text" class="form-control" placeholder="semua lokasi" v-model="this.lokasi_investor">
        </div>

        <div class="input-group col">
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
	  		nama_investor:null,
	  		perusahaan_investor:null,
	  		kategori_investor:null,
	  		lokasi_investor:null,
	
	  	}
	  },
	  methods:{
	  search(){
	  	let uri = {}
	  	uri['nama_investor'] = this.nama_umkm
	  	uri['perusahaan_investor'] =this.perusahaan_umkm
	  	uri['produk_investor'] =this.produk_umkm
	  	uri['lokasi_investor'] = this.lokasi_umkm
        Inertia.post(this.url,uri,{only:this.lazy,preserveScroll: true,preserveState:true })

	  	}
	  },
     
   props:{
      	url:String,
      	judul:String,
      	lazy:Array,
      	customSearch:String
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