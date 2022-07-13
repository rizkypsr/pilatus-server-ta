<template>
    <AppLayout>
        <template #header>
            <h1 class="m-0">
                Transaksi
            </h1>
        </template>
        <template #breadcrumb>
            <li class="breadcrumb-item active">Transaksi</li>
        </template>

        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <div v-if="$page.props.flash.message" class="mt-3 alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $page.props.flash.message }}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi</h3>

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
                                    <th>Order ID</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Pengiriman</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order, index) in orders.data" :key="order.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ order.id }}</td>
                                    <td>{{ order.user.email }}</td>
                                    <td>{{ order.status }}</td>
                                    <td>{{ order.total }}</td>
                                    <td>{{ order.shipping.resi || "Belum Dikirim" }}</td>
                                    <td class="row">
                                        <div class="col-6">
                                           <Link :href="route('orders.edit', order.shipping.id)" class="btn btn-block bg-gradient-info">Resi</Link>
                                        </div>
                                        <div class="col-6">
                                            <Link :href="route('orders.show', order.id)" class="btn btn-block bg-gradient-success">Detail</Link>
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

defineProps([
    'orders',
    'errors'
])

</script>