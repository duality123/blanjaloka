<template>
    <div v-if="links.length >= 3">

            <ul class="pagination">
            
                <template v-for="link in links">
                <li  v-if="link.url !== null"  :class="{'active':link.active }">
                
                     <Link v-if="this.lazy" :data="postLazyData" method="post" :only="this.lazy" preserve-state  :href="link.url+'&'+parameters">
                          {{decode(link.label)}}
                    </Link>
                    <Link v-else :href="link.url+'&'+parameters" preserve-state  >
                          {{decode(link.label)}}
                    </Link>
                </li>
                </template>
            </ul>
        
</div>
</template>
<script>
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
                postLazyData:document.sessionStorage
            }
        },
    mounted(){
        let uri = window.location.search.substring(1)
        let params = new URLSearchParams(uri)
        if (params.get('cari')) {
            this.cari= true
        }
         else if(params.get('investor')) {
          this.cari = true
        }
        else if(params.get('umkm')){
            this.cari = true
        }
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

.pagination li:hover a,
.pagination li:hover a svg {
  color: #FFFFFF !important;
}

.pagination li a {
  text-decoration: none;
  color: #3E4041;
  font-weight: 600;
}

.pagination li.active {
  background-color: #398AB9;
}

.pagination li.active a {
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