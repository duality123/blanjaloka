<template>
    <div v-if="links.length >= 3">

            <ul class="pagination">
            
                <template v-for="link in links">
                <li  v-if="link.url !== null"  :class="{'active':link.active }">
                
                     <button @click="visitWithLazy(link.url)" >
                          {{decode(link.label)}}
                    </button>
                </li>
                </template>
            </ul>
        
</div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import { Link,useForm } from '@inertiajs/inertia-vue3';
    export default {
        components:{
            Link
        },
         props: {
            links:Object,
            lazy:Array,
            },
        data(){
            return{
                parameters : document.location.search.substring(8),
                currentPage :document.location.href,
                cari:false ,
                postData:{},
                getParams:''
            }
        },
    mounted(){
        /*
        let search = Object.keys(sessionStorage)
        let values = Object.values(sessionStorage)
        for (var i = 0;i < search.length; i++) {
         if(values[i] != 'null' ){
            console.log(values[i])
            this.postData[search[i]] = values[i]
        }
    }
        console.log(sessionStorage)
        */
        

    },
    methods:{
        decode(strings){
           if(strings.includes(' &raquo;')){
              return 'Berikutnya'
           }
           else if(strings.includes('&laquo; ')){
              return 'Sebelumnya'
           }
           else{
            return strings;
           }
        },
        visitWithLazy(url){
            let params = new URLSearchParams(window.location.search);
            params.delete('page');
            let searchList =Object.fromEntries(params.entries());
            Inertia.get(url,searchList,{only:this.lazy,preserveScroll: false,preserveState:true })
        }
    }
}
</script>
<style scoped>
.pagination li {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5px 12px;
  border-radius: 2px;
  cursor: pointer;
  transition: 300ms;
}

.pagination li:hover {
  background-color: #398AB9;
}

button{
    background-color: transparent;
    border: 0px;
    border-color: transparent;
}

.pagination li:hover button,
.pagination li:hover button svg {
  color: #FFFFFF !important;
}

.pagination li button {
  text-decoration: none;
  color: #3E4041;
  font-weight: 600;
}

.pagination li.active {
  background-color: #398AB9;
}

.pagination li.active button {
  color: #FFFFFF;
}

@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }

  .pagination li:nth-child(3),
  .pagination li:nth-child(4) {
    display: none;
  }
}
</style>