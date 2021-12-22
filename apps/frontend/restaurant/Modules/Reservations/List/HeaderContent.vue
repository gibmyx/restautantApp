<template>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label" for="input-code">Nro de reservacion</label>
                        <input type="text" min="1" pattern="^[0-9]+" id="input-code" v-model="params.filter.code"
                               class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label" for="input-codeTable">Nro de reservacion</label>
                        <input type="text" min="1" pattern="^[0-9]+" id="input-codeTable" v-model="params.filter.codeTable"
                               class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label" for="input-dateFrom">Fecha desde</label>
                        <input type="datetime-local" min="1" pattern="^[0-9]+" id="input-dateFrom" v-model="params.filter.dateFrom"
                               class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label" for="input-dateTo">Fecha hasta</label>
                        <input type="datetime-local" min="1" pattern="^[0-9]+" id="input-dateTo" v-model="params.filter.dateTo"
                               class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import {defineComponent} from "vue";

export default defineComponent({
    name: "HeaderContent",

    props: {
        params: {
            type: Object,
            required: true,
            default: []
        }
    },
})
</script>

<style scoped>

</style>
