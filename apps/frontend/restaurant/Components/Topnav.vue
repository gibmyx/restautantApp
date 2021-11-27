<template>
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark" style="margin-bottom: 0;">
                        <li class="breadcrumb-item" v-for="value in getBreadcrumb"><inertia-link :href="route(value.link)"><i :class="value.ico"></i>{{value.name}}</inertia-link></li>
                    </ol>
                </nav>

                <!-- Navbar links -->
                <ul class="navbar-nav align-items-center  ml-md-auto "></ul>

                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold mr-1">{{
                                            $page.props.user.name
                                        }} </span>
                                    <i class="ni ni-single-02 "></i>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <inertia-link :href="route('user.profile')" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span class="nav-link-text">Mi perfil</span>
                            </inertia-link>

                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" @click.prevent="logout">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Topnav",

    computed: {

        getBreadcrumb() {

            if(this.route().current('dashboard'))
                return [
                    {ico: 'fas fa-home', name: '', link: 'dashboard'},
                    {ico: '', name: 'Dashboard', link: 'dashboard'}
                ];
            if(this.route().current('clients.list'))
                return [
                    {ico: 'fas fa-home', name: '', link: 'dashboard'},
                    {ico: '', name: 'Clientes', link: 'clients.list'}
                ];
            if(this.route().current('tables.list'))
                return [
                    {ico: 'fas fa-home', name: '', link: 'dashboard'},
                    {ico: '', name: 'Mesas', link: 'tables.list'}
                ];
            if(this.route().current('reservations.list'))
                return [
                    {ico: 'fas fa-home', name: '', link: 'dashboard'},
                    {ico: '', name: 'Reservaciones', link: 'reservations.list'}
                ];
            if(this.route().current('notifications.list'))
                return [
                    {ico: 'fas fa-home', name: '', link: 'dashboard'},
                    {ico: '', name: 'Notificaciones', link: 'notifications.list'}
                ];
            if(this.route().current('user.profile'))
                return [
                    {ico: 'fas fa-home', name: '', link: 'dashboard'},
                    {ico: '', name: 'Perfil', link: 'user.profile'}
                ];

            return [];
        },

    },

    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
}
</script>

<style scoped>

</style>
