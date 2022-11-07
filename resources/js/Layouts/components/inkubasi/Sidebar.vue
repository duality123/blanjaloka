<template>
    <div class="col-md-3 d-none d-lg-block">
        <ul class="list-group">
            <div class="mb-3">
                <li class="list-group-item" :class="{'active': $page.url === '/umkm-saya/eventual'}" >
                    <font-awesome-icon icon="fa-solid fa-calendar-days" class="text-primary mx-2" />
                    <a href="/umkm-saya/eventual">Eventual</a>
                </li>
                <li class="list-group-item" :class="{'active': $page.url === '/umkm-saya/kegiatan'}" >
                    <font-awesome-icon icon="fa-solid fa-display"  class="text-primary mx-2" />
                    <a href="/umkm-saya/kegiatan">Kegiatan</a>
                </li>
            </div>
            
        </ul>
    </div>
</template>

<script setup>

</script>

<style scoped>
.active{
    background-color: #FFF !important;
    border: 1px solid #F0F0F0 !important;
    color: #0075b9;
    border-radius: 10px !important;
    width: 70%;
}

.list-group-item{
    border: none
}
.list-group-item a{
    color: black;
    text-decoration: none;
}
</style>