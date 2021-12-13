<template>
    <app-layout>
        <template #header-content>
            <header-content v-show="filtersActive" :params="params" :buscar="buscar"></header-content>
        </template>
        <template #body-content>
            <body-content :pagination="pagination" :params="params" :rows="rows" @buscar="buscar" @viewDetails="viewDetails"></body-content>
        </template>
    </app-layout>
    <form-modal name="FormModal" ref="FormModal" @reload="buscar"></form-modal>
</template>


<script>
import {defineComponent} from "vue";
import AppLayout from "@/Components/AppLayout";
import HeaderContent from "@/Modules/Tables/List/HeaderContent";
import BodyContent from "@/Modules/Tables/List/BodyContent";
import FormModal from "@/Modules/Tables/Modals/FormModal";
import params from "@/Modules/Tables/Data/params";
import qs from "qs"

export default defineComponent({
    name: "List",

    components: {
        FormModal,
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
            body.off('click', '.create').on('click', '.create', function () {
                context.$refs.FormModal.show();
            });
        },
        buscar() {
            axios.get('/tables?'+qs.stringify(this.params)).then(response => {
                this.rows = response.data.rows;
                this.pagination = response.data.pagination;
            });
        },
        viewDetails(row) {
            this.$refs.FormModal.showDetails(row);
        }
    }
})
</script>

<style scoped>

</style>
