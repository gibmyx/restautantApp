<template>
    <app-layout @create="create">
        <template #header-content>
            <header-content></header-content>
        </template>
        <template #body-content>
            <body-content :pagination="pagination" :params="params" :rows="rows" @buscar="buscar" @viewDetails="viewDetails"></body-content>
        </template>
    </app-layout>
    <form-modal name="FormModal" ref="FormModal"></form-modal>
</template>


<script>
import {defineComponent} from "vue";
import AppLayout from "@/Components/AppLayout";
import HeaderContent from "@/Modules/Tables/List/HeaderContent";
import BodyContent from "@/Modules/Tables/List/BodyContent";
import FormModal from "@/Modules/Tables/Modals/FormModal";

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
            params: [],
            pagination: [],
            rows: [],
        }
    },

    mounted() {
        this.buscar()
    },

    methods: {
        buscar() {
            axios.get('/tables').then(response => {
                this.rows = response.data.rows;
                this.pagination = response.data.pagination;
            });
        },
        create() {
            this.$refs.FormModal.show();
        },
        viewDetails(row) {
            this.$refs.FormModal.showDetails(row);
        }
    }
})
</script>

<style scoped>

</style>
