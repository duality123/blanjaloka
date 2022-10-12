<template>
    <DashboardLayout title="Peserta Admin">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
            <h1 class="text-neutral-gray-5 mb-0">Pengguna</h1>
        </div>
        <ul class="tabs mt-4">
            <li v-for="item in tabItems" :class="{'active': item.isActive}" @click="handleChangeCurrentTabItem(item.title)">
                <a :class="{'text-neutral-black': item.isActive, 'text-neutral-gray-4': !item.isActive}">{{ item.title }}</a>
            </li>
        </ul>
        <section v-if="currentTabItem == 'Admin'">
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary-blue-6 text-neutral-white py-2" @click="showModal('insert')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Admin
                </a>
            </div>
            <div class="table-responsive">
                <table class="table mt-3">
                    <thead class="table-primary-blue-4">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(admin, index) in admins">
                            <th scope="row">{{ 1 }}</th>
                            <td>{{ admin.name }}</td>
                            <td>{{admin.email}}</td>
                            <td>{{admin.password}}</td>
                            <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                <a href="#" class="btn btn-semantic-success-4 text-neutral-white" @click="showModal('edit', admin.id)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <img src="../../../assets/icons/icon_update.png" alt="update icon">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-semantic-error-4 text-neutral-white" @click="deleteAdmin(admin.id)">
                                    <img src="../../../assets/icons/icon_delete.png" alt="delete icon" >
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <ul class="pagination">
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">···</a>
                    </li>
                    <li>
                        <a href="#">10</a>
                    </li>
                    <li>
                        <a href="#">
                            <font-awesome-icon icon="fa-solid fa-chevron-right" class="text-primary-blue-6" />
                        </a>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{modalMode}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitMode">
                            <div class="mb-3">
                                <input type="hidden"  class="form-control" id="id" v-model="form.id">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" class="form-control" id="name" v-model="form.name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" v-model="form.email">
                            </div>
                            <div class="mb-3" v-if="modalMode == 'insert'">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" v-model="form.password" class="form-control" id="password">
                            </div>
                            <div class="mb-3" v-if="modalMode == 'insert'">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <input type="password" v-model="form.password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </DashboardLayout>
    
    
    
</template>

<script >
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import { reactive, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2';
import axios from 'axios';
import { computed } from '@vue/reactivity';
export default{
    
    components:{
        DashboardLayout
    },
    
    props: {
        admins: Object,
    },
    
    setup(){
        
        const modalMode = ref('insert');
        const form = reactive({
            id:'',
            name:'',
            email: '',
            password: '',
            password_confirmation: '',
        })
        
        const initialState = reactive({ ...form });
        
        function resetForm() {
            Object.assign(form, initialState);
        }
        
        const tabItems = ref([
        {
            title: 'Admin',
            isActive: true
        },
        {
            title: 'Investor',
            isActive: false
        },
        {
            title: 'UMKM',
            isActive: false
        },
        ]);
        
        
        const currentTabItem = ref('Admin');
        
        const handleChangeCurrentTabItem = (title) => {
            tabItems.value = tabItems.value.map((tab) => {
                return tab.title == title ? { ...tab, isActive: true } : { ...tab, isActive: false };
            });
            currentTabItem.value = title;
        }
        
        const submitMode = computed(() => {
            return modalMode.value == 'insert' ? addAdmin : updateAdmin;
        })
        
        const addAdmin = () =>{
            console.log('oke');
            Inertia.post('/dashboard/pengguna/admin', form, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Admin saved successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }
        
        const updateAdmin = () =>{
            Inertia.put(`/dashboard/pengguna/admin/${form.id}`, {
                //data
                name: form.name,
                email: form.email
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Admin updated successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    
                },
            }
            )
        }
        
        const showModal = (mode, id) => {
            
            if(mode == 'insert') {
                modalMode.value = "insert";
                resetForm()
                return
            }
            if(mode == 'edit' && id) {
                axios({
                    method: 'get',
                    url: '/dashboard/pengguna/admin/'+id+'/edit'
                })
                .then(function (response) {
                    form.id = response.data.id;
                    form.name = response.data.name;
                    form.email = response.data.email;
                });
                modalMode.value = "edit"
                return
            }
        }
        
        const deleteAdmin = (id) => {
           
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    
                    Inertia.delete(`/dashboard/pengguna/admin/${id}`);
                    
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Role deleted successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            })
        }
        
        return {tabItems, 
            currentTabItem, 
            handleChangeCurrentTabItem, 
            form, 
            addAdmin, 
            modalMode, 
            showModal,
            submitMode,
            updateAdmin,
            deleteAdmin}
        }
    }
    
</script>

<style scoped>
h1 {
    font-size: 2.1rem;
    font-weight: 600;
}

.tabs {
    display: flex;
    column-gap: 2rem;
    list-style: none;
    padding: 0;
    border-bottom: 1px solid #F0F0F0;
}

.tabs li {
    cursor: pointer;
}

.tabs li {
    padding-bottom: 0.5rem;
}

.tabs li.active {
    border-bottom: 2px solid #398AB9;
}

.tabs li a {
    text-decoration: none;
    font-weight: 600;
}

table thead tr td,
table thead tr th {
    font-weight: 600;
    color: #3E4041;
    border: none;
    text-align: center;
}

table tbody tr td,
table tbody tr th {
    font-weight: 400;
    color: #3E4041;
    border-bottom: none;
    text-align: center;
}

table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
    background-color: #F2F7FA;
}

.pagination {
    display: flex;
    flex-direction: row;
    column-gap: 2rem;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    list-style: none;
    background-color: #FFFFFF;
}

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