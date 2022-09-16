<template>
  <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-body">
                    <h5>REGISTER</h5>
                    <hr>
                    <form @submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" v-model="form.name" placeholder="Full Name">
                                </div>
                                <div v-if="errors.name" class="alert alert-danger">
                                    {{ errors.name }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" v-model="form.email" placeholder="Email Address">
                                </div>
                                <div v-if="errors.email" class="alert alert-danger">
                                    {{ errors.email }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" v-model="form.password" placeholder="Password">
                                </div>
                                <div v-if="errors.password" class="alert alert-danger">
                                    {{ errors.password }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password Confirmation</label>
                                    <input type="password" class="form-control" v-model="form.password_confirmation" placeholder="Password Confirmation">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">REGISTER</button>
                    </form>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
 //import layout
    import LayoutAuth from '../../Layouts/Auth.vue';

    //import reactive
    import { reactive } from 'vue';

    //import inertia adapter
    import { Inertia } from '@inertiajs/inertia';

    //import Heade and useForm from Inertia
    import {
        Head,
        Link,
    } from '@inertiajs/inertia-vue3';

    export default {

        //layout
        layout: LayoutAuth,

        //register component
        components: {
            Head,
            Link
        },

        props: {
            errors: Object,
            session: Object
        },

        //define composition API
        setup() {

            //define form state
            const form = reactive({
                name:'',
                email: '',
                password: '',
                password_confirmation:''
            });

            //submit method
            const submit = () => {

                //send data to server
                Inertia.post('/register', {
                    name: form.name,
                    email: form.email,
                    password: form.password,
                    password_confirmation: form.password_confirmation

                });

            }

            //return form state and submit method
            return {
                form,
                submit,
            };

        }

    }
</script>

<style>

</style>