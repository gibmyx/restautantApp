<template>

    <header-component>
        <template #header_right>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <inertia-link :href="route('Welcome')" class="nav-link">
                        <i class="ni ni-shop"></i><span class="nav-link-inner--text">Home</span>
                    </inertia-link>
                </li>
            </ul>
        </template>
    </header-component>

    <body-component>
        <template #body-slot>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>

                            <form @submit.prevent="submit">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email"
                                               v-model="form.email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" v-model="form.password"
                                               type="password" autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id=" customCheckLogin" v-model="form.remember"
                                           type="checkbox">
                                    <label class="custom-control-label" for=" customCheckLogin">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4" :disabled="form.processing">Sign
                                        in
                                    </button>
                                </div>
                                <div v-if="!!errors" class="text-center">
                                    <p v-for="error in errors" style="color: red;">{{ error }}</p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 ">
                            <a href="#" class="text-light"><small>Forgot password?</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </body-component>
</template>

<script>
import HeaderComponent from "@/Modules/Components/Header";
import BodyComponent from "@/Modules/Components/Body";

import {defineComponent} from "vue";

export default defineComponent({
    name: "Login",

    props: {
        errors: Object
    },

    mounted() {

        let body = $("body");

        if (!body.hasClass("bg-default"))
            body.addClass("bg-default");
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {

            this.form
                .transform(data => ({
                    ...data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {

                    onFailure: (e) => {
                        this.$toast.success("Solicitud realizada con exito", {duration: 5000, position: "top-right"});
                    },

                    onFinish: () => this.form.reset('password'),
                })
        }
    },
    components: {
        HeaderComponent,
        BodyComponent
    }
})
</script>

<style scoped>

</style>
