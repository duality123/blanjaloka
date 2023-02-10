<template>
    <header>
        <nav class="navbar navbar-white bg-white fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <Link class="navbar-brand ps-5" href="/">Blanjaloka</Link>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ps-4" id="navbarSupportedContent">
                    <div class="justify-content-center mx-auto">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <Link class="nav-link me-4" aria-current="page" href="/">Beranda</Link>
                            </li>

                            <li class="nav-item">
                                <Link class="nav-link me-4" href="#">Tentang Program</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link me-4" href="">Panduan</Link>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-button">

                        <template v-if="user">
                            <ul class="navbar-nav mb-2 mb-lg-0">
                                <li class="nav-item me-3">
                                    <form @submit.prevent="submitLogout()">
                                        <input type="submit" class="btn btn-primary login" value="Keluar" />
                                    </form>
                                </li>
                            </ul>
                        </template>

                        <template v-else>
                            <ul class="navbar-nav mb-2 mb-lg-0">
                                <li class="nav-item me-3">
                                    <Link href="/login" class="btn btn-primary login">Masuk</Link>
                                </li>
                                <li class="nav-item me-3">
                                    <Link href="/register" class="btn btn-primary register">Daftar</Link>
                                </li>
                            </ul>
                        </template>


                    </div>
                </div>
                <div class="me-lg-4"></div>
            </div>
        </nav>
    </header>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
//import inertia adapter
import { Inertia } from "@inertiajs/inertia";
export default {
    data() {
        return {
            user: this.$page.props.auth.user
        }
    },
    components: {
        Link
    },
    methods: {
        submitLogout() {
            Inertia.post("/logout", {
                _token: this.$page.props.csrf_token,
            });
        }
    }
}
</script>

<style scoped>
.register {
    background-color: #398ab9
}

.login {
    background-color: white;
    color: #398ab9;
    border: 1px solid #398ab9;
}

.navbar {
    font-weight: 600;
    font-size: 16px;
    line-height: 140%;
}

.navbar-nav {
    color: #686868;
}

.navbar-brand {
    color: #398ab9;
}
</style>
