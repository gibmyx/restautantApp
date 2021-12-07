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
                            <th scope="col" class="sort" data-sort="name">Numero de mesa</th>
                            <th scope="col" class="sort" data-sort="budget">Maximo de personas</th>
                            <th scope="col" class="sort" data-sort="status">Minimo de personas</th>
                            <th scope="col" width="1%"></th>
                        </tr>
                        </thead>
                        <tbody class="list">

                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn" href="#"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opciones <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    <pagination-component></pagination-component>
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

    components: {
        PaginationComponent
    },
})
</script>

<style scoped>

</style>
