<template>
    <AppLayout>
        <template #header>
            <h1 class="m-0">
                Produk
            </h1>
        </template>
        <template #breadcrumb>
            <li class="breadcrumb-item active">Produk</li>
        </template>

        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <Link :href="route('products.create')" type="button" class="btn btn-outline-primary"><i
                        class="fa fa-plus"></i> Tambah Produk</Link>

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
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Berat Barang</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in products.data" :key="product.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.desc }}</td>
                                    <td>Kategori Coming Soon</td>
                                    <td>Stok Coming Soon</td>
                                    <td>{{ product.weight }}</td>
                                    <td>{{ product.price }}</td>
                                    <td class="row">
                                        <div class="col-md-6">
                                            <Link :href="route('products.edit', product.id)"
                                                class="btn btn-block btn-outline-info">Ubah</Link>
                                        </div>
                                        <div class="col-md-6">
                                            <button @click="destroy(product.id)" type="button"
                                                class="btn btn-block btn-outline-danger">Hapus</button>
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

defineProps([
    'products'
])

function destroy(id) {
    Inertia.delete(route('products.destroy', id))
}

</script>