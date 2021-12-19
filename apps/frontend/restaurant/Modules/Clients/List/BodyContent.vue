<template>

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Light table</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive" style="min-height: 150px;">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Reservaciones totales</th>
                            <th scope="col">Completadas</th>
                            <th scope="col">Pendientes</th>
                        </tr>
                        </thead>

                        <tbody v-if="rows.length >= 1" class="list">
                        <tr v-for="row in rows">
                            <td>{{ row.name }}</td>
                            <td>{{ row.email }}</td>
                            <td># {{ row.reservations }}</td>
                            <td># {{ row.reservationCompleted }}</td>
                            <td># {{ row.reservationPeding }}</td>
                        </tr>
                        </tbody>

                        <tbody v-else>
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-secondary text-center" role="alert">
                                    No se encontraron resultados
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    <pagination-component :pagination="pagination" :params="params"
                                          @buscar="buscar"></pagination-component>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import PaginationComponent from "@/Components/Pagination";
import {defineComponent} from "vue";

export default defineComponent({
    name: "BodyContent",

    emits: ["buscar"],

    props: {
        pagination: {required: true},
        params: {required: true},
        rows: {required: true}
    },

    components: {
        PaginationComponent
    },

    methods: {
        async buscar() {
            await this.$emit('buscar')
        },
    }

})

</script>

<style scoped>

</style>
