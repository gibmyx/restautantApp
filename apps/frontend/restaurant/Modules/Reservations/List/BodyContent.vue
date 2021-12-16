<template>

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Reservaciones</h3>
                </div>

                <!-- Light table -->
                <div class="table-responsive" style="min-height: 150px;">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">Codigo</th>
                            <th scope="col" class="sort">Codigo Mesa</th>
                            <th scope="col" class="sort">Cliente</th>
                            <th scope="col" class="sort">Personas</th>
                            <th scope="col" class="sort">Fecha</th>
                            <th scope="col" class="sort">Estado</th>
                        </tr>
                        </thead>

                        <tbody v-if="rows.length >= 1" class="list">
                        <tr v-for="row in rows">
                            <td>{{ row.code }}</td>
                            <td>{{ row.codeTable }}</td>
                            <td>{{ row.userName }}</td>
                            <td># {{ row.peoples }}</td>
                            <td>{{ row.date }}</td>
                            <td>
                              <span class="badge badge-dot mr-4">
                                  <i :class="row.stateClass"></i>
                                  <span class="status">{{ row.state }}</span>
                              </span>
                            </td>
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

import {defineComponent} from "vue";
import PaginationComponent from "@/Components/Pagination";

export default defineComponent({
    name: "BodyContent",

    emits: ["buscar"],

    props: {
        pagination: {required: true},
        params: {required: true},
        rows: {required: true}
    },

    components: {
        PaginationComponent,
    },

    methods: {
        async buscar() {
            await this.$emit('buscar')
        },
    }
});
</script>

<style scoped>

</style>
