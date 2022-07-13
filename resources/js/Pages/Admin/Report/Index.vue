<template>
    <AppLayout>
        <template #header>
            <h1 class="m-0">
                Laporan Transaksi
            </h1>
        </template>
        <template #breadcrumb>
            <li class="breadcrumb-item active">Laporan</li>
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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body container">
                        <div class="row">
                            <form class="col-12" @submit.prevent="submit">
                                <div class="row align-items-center">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="inputCategory">Dari</label>
                                            <input v-model="form.start" type="date" class="form-control"
                                                :class="errors.start ? 'is-invalid' : ''" aria-invalid="true" />
                                            <span v-if="errors.start" id="inputCategory-error"
                                                class="error invalid-feedback">{{
                                                        errors.start
                                                }}</span>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="inputCategory">Sampai</label>
                                            <input v-model="form.end" type="date" class="form-control"
                                                :class="errors.end ? 'is-invalid' : ''" aria-invalid="true" />
                                            <span v-if="errors.end" id="inputCategory-error"
                                                class="error invalid-feedback">{{
                                                        errors.end
                                                }}</span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <div v-if="isValid" class="col-12 table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Pengiriman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(order, index) in form.report" :key="order.id">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ order.id }}</td>
                                            <td>{{ order.user.email }}</td>
                                            <td>{{ order.status }}</td>
                                            <td>{{ order.total }}</td>
                                            <td>{{ order.shipping.resi || "Belum Dikirim" }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else="isValid" class="col-12 text-center mt-5">
                                <h6>Data tidak ditemukan</h6>
                            </div>
                        </div>
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
import { useForm } from "@inertiajs/inertia-vue3";
import { computed, ref, watch } from "vue";


defineProps([
    'errors',
])

const form = useForm({
    start: null,
    end: null,
    report: []
});

const isValid = computed(() => {
    return form.report.length > 0
})

function submit() {
    form.post(route('reports.range'), {
        onSuccess: (res) => {
            form.report = res.props.req.report
        },
    })
}

</script>