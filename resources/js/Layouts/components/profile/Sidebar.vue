<template>
    <div class="col-md-3 d-none d-md-block">
        <ul class="list-group">
            <div class="mb-3">
                <li class="list-group-item" :class="{'active': $page.url === '/dashboard'}" ><a href="#"><font-awesome-icon icon="fa-solid fa-bell"></font-awesome-icon>   Notifikasi</a></li>
            </div>
            <div class="mb-3">
                <li class="list-group-item" :class="{'active': $page.url === '/profile-saya/'}" ><a href="/profile-saya/"><font-awesome-icon icon="fa-solid fa-user"></font-awesome-icon>   Profile Saya</a></li>
            </div>
            <div class="mb-3">
                <li class="list-group-item" :class="{'active': $page.url === '/profile-saya/ubah-password'}" ><a href="/profile-saya/ubah-password"><font-awesome-icon icon="fa-solid fa-lock"></font-awesome-icon>   Ubah Kata Sandi</a></li>
            </div>
            <div class="mb-3">
                <li class="list-group-item" :class="{'active': $page.url === '/profile-saya/ubah-email'}" ><a href="/profile-saya/ubah-email"><font-awesome-icon icon="fa-solid fa-at"></font-awesome-icon>   Ubah Email</a></li>
            </div>
        </ul>
    </div>
</template>

<script>
export default{
    
}
</script>

<style>
.active{
    background-color: #FFF !important;
    border: 1px solid #F0F0F0 !important;
    color: #398AB9;
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