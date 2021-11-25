<template>
    <header-component>
        <template #header_right>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <inertia-link :href="route('dashboard')" class="nav-link">
                        <span class="nav-link-inner--text">Dashboard</span>
                    </inertia-link>
                </li>
                <li class="nav-item">
                    <inertia-link :href="route('login')" class="nav-link">
                        <span class="nav-link-inner--text">Login</span>
                    </inertia-link>
                </li>
            </ul>
        </template>
    </header-component>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                     xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>

    </div>
</template>

<script>
import {defineComponent} from "vue";
import HeaderComponent from "./../Components/Header";

export default defineComponent({
    name: "Welcome",

    props: {
        canLogin: Boolean,
    },

    components: {
        HeaderComponent
    }
})
</script>

<style scoped>

</style>
