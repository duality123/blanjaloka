<template>
<Header/>
    <main>
          <slot/>
    </main>
<Footer/>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import Header from './components/Header.vue';
    import Footer from './components/Footer.vue';
    export default {
        components:{
            Header,
            Link,
            Footer,
        }
    }
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
body {
    font-family: "Inter", sans-serif;
    background-color: white;
}
main{
    margin-top:70px;
}
</style>