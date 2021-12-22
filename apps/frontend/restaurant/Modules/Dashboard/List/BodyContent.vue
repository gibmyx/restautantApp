<template>

    <div class="row">
        <div class="col-xl-8">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">

                        <div class="col">
                            <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                            <h5 class="h3 text-white mb-0">Historico reservaciones completadas</h5>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0">
                                    <a href="#" class="nav-link py-2 px-3 active btn btn-sm btn-primary" data-toggle="tab">
                                        <span class="d-block">Update</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-xl-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Reservaciones Confirmada para hoy</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary">Update</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="max-height: 395px;">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Nombre</th>
                        </tr>
                        </thead>

                        <tbody v-if="reservations.length >= 1" class="list">
                        <tr v-for="row in reservations">
                            <td>{{ row.code }}</td>
                            <td>{{ row.codeTable }}</td>
                            <td>{{ row.userName }}</td>
                        </tr>
                        </tbody>

                        <tbody v-else>
                        <tr>
                            <td colspan="3">
                                <div class="alert alert-secondary text-center" role="alert">
                                    No se encontraron resultados
                                </div>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
export default {
    name: "BodyContent",

    props: {
        reservations: {
            type: Array,
            required: true,
        },
    },
    mounted() {
    },

    methods: {
    }
}
</script>

<style scoped>

</style>
