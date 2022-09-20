<template>
   <Layout>
<div class="container" >
<h1 align="center">Kode verifikasi telah dikirim ke email anda :). Token akan kadaluwarsa dalam 24 jam.</h1>
<div class="d-flex justify-content-center">
<form method="post" action="{{route('verification.send')}}">
   @csrf
   <!--
    <input type ="hidden" name="id" value="{{Request('id')}}">
<div class="mb-3 row">
    <label class="col-sm-10 col-form-label">Masukkan Token</label>
    <div class="col-sm-10">
      <input type="text" name="token"  class="form-control " >
    </div>
  </div>
  -->
<button type="submit" class="btn btn-primary">Kirim</button><br>
<small>Klik link berikut untuk resend :)</small>
</form>
    </div>

</div>
</Layout>
</template>

<script>
//import layout

//import reactive
import { reactive } from "vue";

//import inertia adapter
import { Inertia } from "@inertiajs/inertia";

//import Heade and useForm from Inertia
import { Link } from "@inertiajs/inertia-vue3";

import Layout from "../../Layouts/Layout.vue";

export default {
    
    //register component
    components: {
        Layout,
        Link,
        
    },


   
};
</script>