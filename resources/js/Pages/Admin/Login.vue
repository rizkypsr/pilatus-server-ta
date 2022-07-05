<template>
    <div class="login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <Link :href="route('admin.login')" class="h1"><b>Pilatus</b></Link>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <div class="alert alert-danger" role="alert" v-if="errors.username">
                        {{ errors.username }}
                    </div>
                    <form @submit.prevent="submit">
                        <div class="input-group mb-3">
                            <input v-model="form.username" type="text" class="form-control" placeholder="Username"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input v-model="form.password" type="password" class="form-control" placeholder="Password"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    errors: Object,
});

const form = useForm({
    username: '',
    password: '',
});

const submit = () => {
    form.transform(data => ({
        ...data,
    })).post(route('admin.login.post'), {
        onFinish: () => form.reset('password'),
    });
};
</script>