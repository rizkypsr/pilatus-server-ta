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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Pembayaran</h3>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row gx-5 gy-5">
                                <div class="col-md-4 col-12 bg-warning p-3 mr-3 mb-4 mb-md-0">
                                    <h6>Transaksi ID</h6>
                                    <p class="text-bold">{{ order.id }}</p>
                                </div>

                                <div class="col-md col-12 bg-warning p-3 mr-3 mb-4 mb-md-0">
                                    <h6>Total</h6>
                                    <p class="text-bold">Rp. {{ order.total }}</p>
                                </div>

                                <div class="col-md col-12 bg-warning p-3 mr-3 mb-4 mb-md-0">
                                    <h6>Metode Pembayaran</h6>
                                    <p class="text-bold">Bank Transfer {{ order.payment.provider.toUpperCase() }}</p>
                                </div>

                                <div class="col-md col-12 bg-warning p-3">
                                    <h6>Status</h6>
                                    <p class="text-bold">{{ order.status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Item</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Produk</th>
                                    <th>Berat Barang</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(orderItem, index) in order.order_item" :key="orderItem.id">
                                    <td>{{ orderItem.product.id }}</td>
                                    <td>{{ orderItem.product.name }}</td>
                                    <td>{{ orderItem.product.weight }}</td>
                                    <td>{{ orderItem.product.price }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pengiriman</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col text-bold">Resi</div>
                            <div class="col">{{ order.shipping.resi || "Belum Dikirim" }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-bold">Alamat</div>
                            <div class="col">{{ order.shipping.address }}, {{ order.shipping.city }}, {{
                                    order.shipping.province
                            }} - {{ order.shipping.postal_code }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-bold">Kurir</div>
                            <div class="col">{{ order.shipping.courier }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-bold">Servis</div>
                            <div class="col">{{ order.shipping.service }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-bold">Ongkir</div>
                            <div class="col">{{ order.shipping.cost }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Pages/Admin/AppLayout.vue";

defineProps([
    'order',
    'errors'
])
</script>