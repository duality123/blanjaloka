 <template>
        
          <div class="col d-flex justify-content-center mt-4">
        <div class="container-fluid">
          <div class="row g-3">
        
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="Semua UMKM" v-model="this.searchList.nama_umkm">
        </div>
 
   
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="semua perusahaan" v-model="this.searchList.perusahaan_umkm">
        </div>
      
        <div class="input-group col">
              <input type="text" class="form-control" placeholder="semua kategori" v-model="this.searchList.produk_umkm">
        </div>


        <div class="input-group col">
              <input type="text" class="form-control" placeholder="semua lokasi" v-model="this.searchList.lokasi_umkm">
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
            searchList:{
                nama_umkm:null,
                perusahaan_umkm:null,
                produk_umkm:null,
                lokasi_umkm:null,
            }	
	  	}
	  },
	  methods:{
	  search(){
        /*
	  	let uri = {}
	  	sessionStorage.setItem('nama_investor', this.searchList.nama_investor) 
          sessionStorage.setItem('perusahaan_investor',this.searchList.perusahaan_umkm) 
          sessionStorage.setItem('kategori_investor',this.searchList.produk_umkm) 
          sessionStorage.setItem('nama_umkm',this.searchList.lokasi_umkm)
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