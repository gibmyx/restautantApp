<template>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label">Numero de mesa</label>
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

    data() {
        return {
            options: [{id: 1, text: '1'}],
        }
    }
})
</script>

<style scoped>

</style>
