<template>
    <app-layout>
        <template #header-content>
            <header-content v-show="filtersActive" :params="params"></header-content>
        </template>
        <template #body-content>
            <body-content :pagination="pagination" :params="params" :rows="rows" @buscar="buscar"></body-content>
        </template>
    </app-layout>
</template>


<script>
import {defineComponent} from "vue";
import AppLayout from "@/Components/AppLayout";
import HeaderContent from "@/Modules/Clients/List/HeaderContent";
import BodyContent from "@/Modules/Clients/List/BodyContent";
import params from "@/Modules/Clients/Data/params";
import qs from "qs"

export default defineComponent({
    name: "List",

    components: {
        AppLayout,
        HeaderContent,
        BodyContent,
    },

    data() {
        return {
            params: params(),
            pagination: [],
            rows: [],
            filtersActive: false
        }
    },

    mounted() {
        this.init()
        this.buscar()
    },

    methods: {
        init() {
            let context = this;
            let body = $('body');

            body.off('click', '.uptade').on('click', '.uptade', function () {
                context.buscar();
            });
            body.off('click', '.filters').on('click', '.filters', function () {
                context.filtersActive = !context.filtersActive;
            });
        },
        buscar() {
            axios.get('/clients?'+qs.stringify(this.params)).then(response => {
                this.rows = response.data.rows;
                this.pagination = response.data.pagination;
            });
        },
    }

})
</script>

<style scoped>

</style>
