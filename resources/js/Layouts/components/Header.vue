<template>
     <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../assets/images/blanjaloka_logo.png" alt="blanjaloka logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blanjaloka_navbar"
                aria-controls="blanjaloka_navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="blanjaloka_navbar">
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-link text-neutral-gray-4">Beranda</a>
                    <a href="#" class="nav-link text-neutral-gray-4">Tentang Program</a>
                    <a href="#" class="nav-link text-neutral-gray-4">Panduan</a>
                </div>
                <div class="navbar-nav gap-3 ms-auto">
                    <Link href="/login"
                        class="btn btn-outline-primary-blue-6 text-primary-blue-6 px-4 py-2 border-5 btn_custom_outline">
                    Masuk</Link>
                    <Link href="/kebijakan" class="btn btn-primary-blue-6 text-white px-4 py-2">Daftar</Link>
                </div>
            </div>
        </div>
    </nav>
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
.nav-link,
a.btn {
    font-weight: 600;
}

.btn_custom_outline {
    border-width: 2px !important;
}

.btn_custom_outline:hover {
    color: #FFFFFF !important;
}

@media (max-width: 575.98px) {
    nav {
        background-color: #FFFFFF;
    }
}
</style>
