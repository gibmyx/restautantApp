<template>
    <!-- Card stats -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Nuevo Usuarios</h5>
                            <span class="h2 font-weight-bold mb-0">{{informationHeaderData.newUser.currentMonth}}</span>
                        </div>
                        <div class="col-auto">
                            <div
                                class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="mr-2" :class="informationHeaderData.newUser.isPositive ? 'text-success' : 'text-danger'">
                            <i class="fa" :class="informationHeaderData.newUser.isPositive ? 'fa-arrow-up' : 'fa-arrow-down'"></i> {{informationHeaderData.newUser.porcentaje}}%</span>
                        <span class="text-nowrap">Desde el mes pasado</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Reservaciones Totales</h5>
                            <span class="h2 font-weight-bold mb-0">{{informationHeaderData.reservation.currentMonth}}</span>
                        </div>
                        <div class="col-auto">
                            <div
                                class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="mr-2" :class="informationHeaderData.reservation.isPositive ? 'text-success' : 'text-danger'">
                            <i class="fa" :class="informationHeaderData.reservation.isPositive ? 'fa-arrow-up' : 'fa-arrow-down'"></i> {{informationHeaderData.reservation.porcentaje}}%</span>
                        <span class="text-nowrap">Desde el mes pasado</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Reservaciones Completadas</h5>
                            <span class="h2 font-weight-bold mb-0">{{informationHeaderData.reservationsCompleted.currentMonth}}</span>
                        </div>
                        <div class="col-auto">
                            <div
                                class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="mr-2" :class="informationHeaderData.reservationsCompleted.isPositive ? 'text-success' : 'text-danger'">
                            <i class="fa" :class="informationHeaderData.reservationsCompleted.isPositive ? 'fa-arrow-up' : 'fa-arrow-down'"></i> {{informationHeaderData.reservationsCompleted.porcentaje}}%</span>
                        <span class="text-nowrap">Desde el mes pasado</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Reservaciones Canceladas</h5>
                            <span class="h2 font-weight-bold mb-0">{{informationHeaderData.reservationsCanceled.currentMonth}}</span>
                        </div>
                        <div class="col-auto">
                            <div
                                class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="mr-2" :class="informationHeaderData.reservationsCanceled.isPositive ? 'text-success' : 'text-danger'">
                            <i class="fa" :class="informationHeaderData.reservationsCanceled.isPositive ? 'fa-arrow-up' : 'fa-arrow-down'"></i> {{informationHeaderData.reservationsCanceled.porcentaje}}%</span>
                        <span class="text-nowrap">Desde el mes pasado</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({

    props: {
        informationHeaderData: {
            type: Object,
            required: true,
        }
    },

    name: "HeaderContent",

});
</script>

<style scoped>

</style>
