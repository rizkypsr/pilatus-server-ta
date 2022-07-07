<template>
    <AppLayout>
        <template #header>
            <h1 class="m-0">
                Ubah Kategori
            </h1>
        </template>
        <template #breadcrumb>
            <li class="breadcrumb-item ">
                <Link :href="route('categories.index')">Kategori</Link>
            </li>
        </template>

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kategori</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form @submit.prevent="submit(props.category.id)">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputCategory">Nama Kategori</label>
                                <input v-model="form.name" type="text" class="form-control"
                                    :class="errors.name ? 'is-invalid' : ''" id="inputCategory" aria-invalid="true" />
                                <span v-if="errors.name" id="inputCategory-error" class="error invalid-feedback">{{
                                        errors.name
                                }}</span>
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

const props = defineProps([
    'category',
    'errors'
])

const form = useForm({
    _method: 'put',
    name: props.category.name,
});

function submit(id) {
    form.post(route('categories.update', id))
}

</script>