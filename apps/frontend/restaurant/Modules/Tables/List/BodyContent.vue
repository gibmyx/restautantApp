<template>

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Tablas</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive" style="min-height: 150px;">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Nro de mesa</th>
                            <th scope="col" class="sort" data-sort="budget">Maximo de personas</th>
                            <th scope="col" class="sort" data-sort="status">Minimo de personas</th>
                            <th scope="col" class="sort" data-sort="status">Descripción</th>
                            <th scope="col" class="sort">Estado</th>
                            <th scope="col" width="1%"></th>
                        </tr>
                        </thead>

                        <tbody v-if="rows.length >= 1" class="list">
                        <tr v-for="row in rows">
                            <td>{{row.code}}</td>
                            <td>{{row.maxPeople}}</td>
                            <td>{{row.minPeople}}</td>
                            <td>{{row.description}}</td>
                            <td>
                              <span class="badge badge-dot mr-4">
                                  <i :class="row.stateClass"></i>
                                  <span class="status">{{ row.stateText }}</span>
                              </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn" href="#"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opciones <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="#" @click.prevent="viewDetails(row)">Ver detalle</a>
                                    </div>
                                </div>
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
                    <pagination-component :pagination="pagination" :params="params"  @buscar="buscar"></pagination-component>
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

    emits: ["buscar", "viewDetails"],

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
        viewDetails(row) {
            this.$emit('viewDetails', row)
        }
    }
})
</script>

<style scoped>

</style>
