<template>
    <app-layout @create="create" @filters="filters" @uptade="buscar">
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
        this.buscar()
    },

    methods: {
        buscar() {
            axios.get('/tables?'+qs.stringify(this.params)).then(response => {
                this.rows = response.data.rows;
                this.pagination = response.data.pagination;
            });
        },
        create() {
            this.$refs.FormModal.show();
        },
        filters() {
            this.filtersActive = !this.filtersActive;
        },
        viewDetails(row) {
            this.$refs.FormModal.showDetails(row);
        }
    }
})
</script>

<style scoped>

</style>
