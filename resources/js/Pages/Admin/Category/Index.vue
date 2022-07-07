<template>
    <AppLayout>
        <template #header>
            <h1 class="m-0">
                Kategori
            </h1>
        </template>
        <template #breadcrumb>
            <li class="breadcrumb-item active">Kategori</li>
        </template>

        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <Link :href="route('categories.create')" type="button" class="btn btn-outline-primary"><i
                        class="fa fa-plus"></i> Tambah Kategori</Link>

                    <div v-if="$page.props.flash.message" class="mt-3 alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $page.props.flash.message }}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Produk</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="float-right form-control"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="p-0 card-body table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category, index) in categories.data" :key="category.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name }}</td>
                                    <td class="row">
                                        <div class="col-6">
                                            <Link :href="route('categories.edit', category.id)">
                                            <i class="fas fa-edit"></i>
                                            </Link>
                                        </div>
                                        <div class="col-6">
                                            <i role="button" @click="destroy(category.id)"
                                                class="fas fa-trash text-danger"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Pages/Admin/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";

defineProps([
    'categories',
    'errors'
])

function destroy(id) {
    Swal.fire({
        title: 'Anda yakin ingin menghapus kategori?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            Inertia.delete(route('categories.destroy', id))
        }
    });
}

</script>