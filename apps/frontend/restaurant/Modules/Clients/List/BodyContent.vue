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
                            <th scope="col" class="sort" data-sort="name">Project</th>
                            <th scope="col" class="sort" data-sort="budget">Budget</th>
                            <th scope="col" class="sort" data-sort="status">Status</th>
                            <th scope="col">Users</th>
                            <th scope="col" class="sort" data-sort="completion">Completion</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">

                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">Argon Design System</span>
                                    </div>
                                </div>
                            </th>
                            <td class="budget">
                                $2500 USD
                            </td>
                            <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i>
                        <span class="status">pending</span>
                      </span>
                            </td>
                            <td>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="completion mr-2">60%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
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
import PaginationComponent from "@/Components/Pagination";
import {defineComponent} from "vue";

export default defineComponent({
    name: "BodyContent",

    components: {
        PaginationComponent
    },

})

</script>

<style scoped>

</style>
