<template>
	
                 <ul class="mt-4">
                    <li >
                    <Link :href="`/umkm/dashboard/kegiatanku/detail/${id_kegiatan}`">Deskripsi</Link>                 </li>
                    <li >
                       <Link :href="`/umkm/dashboard/kegiatanku/${id_kegiatan}/elearning/1`">Elearning</Link>
                    </li>
                    <li class="active"  >
                        <Link :href="`/umkm/dashboard/kegiatanku/eventual/${id_kegiatan}`" class="active">Eventual</Link>
                    </li>
                    <li >
                         <Link :href="`/umkm/dashboard/kegiatanku/logbook/${id_kegiatan}`">Logbook</Link>
                    </li>
                </ul>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default{
  props:{
  	id_kegiatan:null
  }
}
</script>
<style>
	

</style>