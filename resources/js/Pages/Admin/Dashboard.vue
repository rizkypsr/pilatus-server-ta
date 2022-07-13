<template>
    <AppLayout>
        <template #header>
            <h1 class="m-0">
                Dashboard
            </h1>
        </template>
        <template #breadcrumb>
            <li class="breadcrumb-item active">Dashboard</li>
        </template>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="border-0 card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Produk</h3>
                            <Link :href="route('products.index')">Lihat Produk</Link>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-lg text-bold">{{ products }}</span>
                                <span>Produk</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>
                <div class="card">
                    <div class="border-0 card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Kategori</h3>
                            <Link :href="route('categories.index')">Lihat Kategori</Link>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-lg text-bold">{{ categories }}</span>
                                <span>Kategori</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="border-0 card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Users</h3>
                            <Link :href="route('users.index')">Lihat Users</Link>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-lg text-bold">{{ users }}</span>
                                <span>Users</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>

                <div class="card">
                    <div class="border-0 card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Transaksi</h3>
                            <Link :href="route('orders.index')">Lihat Transaksi</Link>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-lg text-bold">{{ orders }}</span>
                                <span>Transaksi</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Pages/Admin/AppLayout.vue";

defineProps([
    'products',
    'categories',
    'orders',
    'users'
])

</script>