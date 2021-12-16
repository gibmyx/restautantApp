<template>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label" for="input-min-people">Numero de mesa</label>
                        <input type="code" min="1" pattern="^[0-9]+" id="input-min-people" v-model="params.code"
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
