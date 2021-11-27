<template>
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <inertia-link :href="route('Welcome')" class="navbar-brand">
                    <img :src="'../img/brand/blue.png'" class="navbar-brand-img" alt="...">
                </inertia-link>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Menu</span>
                    </h6>
                    <!-- Divider -->
                    <hr class="my-3">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <inertia-link :href="route('dashboard')" class="nav-link" :class=" this.route().current('dashboard') ? 'active': ''">
                                <i class="fas fa-home text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </inertia-link>
                        </li>
                        <li class="nav-item">
                            <inertia-link :href="route('clients.list')" class="nav-link" :class=" this.route().current('clients.list') ? 'active': ''">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Clientes</span>
                            </inertia-link>
                        </li>
                        <li class="nav-item">
                            <inertia-link :href="route('tables.list')" class="nav-link" :class=" this.route().current('tables.list') ? 'active': ''">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Mesas</span>
                            </inertia-link>
                        </li>
                        <li class="nav-item">
                            <inertia-link :href="route('reservations.list')" class="nav-link" :class=" this.route().current('reservations.list') ? 'active': ''">
                                <i class="ni ni-collection text-info"></i>
                                <span class="nav-link-text">Reservaciones</span>
                            </inertia-link>
                        </li>
                        <li class="nav-item">
                            <inertia-link :href="route('notifications.list')" class="nav-link" :class=" this.route().current('notifications.list') ? 'active': ''">
                                <i class="ni ni-bell-55 text-pink"></i>
                                <span class="nav-link-text">Notificaciones</span>
                            </inertia-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</template>

<script>

import {defineComponent} from "vue";

export default defineComponent({
    name: "Dashboard",

    components: {

    }
})
</script>

<style scoped>

</style>
