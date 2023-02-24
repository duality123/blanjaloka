<template>
        
          <div class="input-group">
          	  <input type="text" class="form-control" :placeholder="this.judul" v-model="this.searchList.cari">
             <button @click="search()" class="btn btn-primary-blue-6 text-neutral-white py-2">
             <font-awesome-icon icon="fas fa-search" /> </button>
     
        </div>
</template>
<script>
	import { Inertia } from "@inertiajs/inertia";
	export default{
	  data(){
	  	return{
	  		searchList:{
	  			cari:null
	  		}
	  	} 
	  },
	  methods:{
	  search(){
	  	/*
	  	sessionStorage.clear()
      	sessionStorage.setItem('cari', this.searchList.cari) 
      	*/
        Inertia.get(this.url,this.searchList,{only:this.lazy,preserveScroll: true,preserveState:true })
	  },
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
	    if (params.get('cari')) {
	      this.cari = params.get('cari')	    
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
   border-bottom-right-radius:0px!important ;
   border-top-right-radius: 0px!important;
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