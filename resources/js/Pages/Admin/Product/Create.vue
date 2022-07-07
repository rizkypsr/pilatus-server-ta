<template>
    <AppLayout>
        <template #header>
            <h1 class="m-0">
                Tambah Produk
            </h1>
        </template>
        <template #breadcrumb>
            <li class="breadcrumb-item ">
                <Link :href="route('products.index')">Produk</Link>
            </li>
            <li class="breadcrumb-item active">Tambah</li>
        </template>

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form @submit.prevent="submit">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputProduct">Nama Produk</label>
                                <input v-model="form.name" type="text" class="form-control"
                                    :class="errors.name ? 'is-invalid' : ''" id="inputProduct" aria-invalid="true" />
                                <span v-if="errors.name" id="inputProduct-error" class="error invalid-feedback">{{
                                        errors.name
                                }}</span>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <textarea v-model="form.description" class="form-control" aria-invalid="true"
                                    :class="errors.description ? 'is-invalid' : ''" rows="3"></textarea>
                                <span v-if="errors.description" id="exampleInputEmail1-error"
                                    class="error invalid-feedback">{{
                                            errors.description
                                    }}</span>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select v-model="form.category" class="form-control" aria-invalid="true"
                                    :class="errors.category ? 'is-invalid' : ''">
                                    <option v-for="category in categories" :value="category.id">{{ category.name }}
                                    </option>
                                </select>
                                <span v-if="errors.category" id="exampleInputEmail1-error"
                                    class="error invalid-feedback">{{
                                            errors.category
                                    }}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Gambar Produk</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input @input="form.photo = $event.target.files[0]" type="file"
                                            class="custom-file-input" id="inputImage" aria-invalid="true"
                                            :class="errors.photo ? 'is-invalid' : ''">
                                        <label class="custom-file-label" for="inputImage">Choose file</label>

                                    </div>

                                </div>
                                <span v-if="errors.photo" id="exampleInputFile-error"
                                    class="error invalid-feedback d-block">{{
                                            errors.photo
                                    }}</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputStock">Stok Produk</label>
                                        <input v-model="form.stock" type="number" class="form-control" id="inputStock"
                                            autocomplete="one-time-code" aria-invalid="true"
                                            :class="errors.stock ? 'is-invalid' : ''">
                                        <span v-if="errors.stock" id="exampleInputEmail1-error"
                                            class="error invalid-feedback">{{
                                                    errors.stock
                                            }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputProductWeight">Berat Produk</label>
                                        <input v-model="form.weight" type="number" class="form-control"
                                            id="inputProductWeight" autocomplete="one-time-code" aria-invalid="true"
                                            :class="errors.weight ? 'is-invalid' : ''">
                                        <span v-if="errors.weight" id="exampleInputEmail1-error"
                                            class="error invalid-feedback">{{
                                                    errors.weight
                                            }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPrice">Harga Produk</label>
                                        <input v-model="form.price" type="number" class="form-control" id="inputPrice"
                                            autocomplete="one-time-code" aria-invalid="true"
                                            :class="errors.price ? 'is-invalid' : ''">
                                        <span v-if="errors.price" id="exampleInputEmail1-error"
                                            class="error invalid-feedback">{{
                                                    errors.price
                                            }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Pages/Admin/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps([
    'categories',
    'errors'
])

const form = useForm({
    name: '',
    description: '',
    category: '',
    stock: '',
    photo: null,
    price: '',
    weight: '',
});


function submit() {
    form.post(route('products.store'))
}

</script>