<template>
    <app-layout @create="create">
        <template #header-content>
            <header-content></header-content>
        </template>
        <template #body-content>
            <body-content></body-content>
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

    mounted() {
        this.buscar()
    },

    methods: {
        buscar() {
            axios.get('/tables').then(response => {
                console.log(response)
            }).catch(e => {

            });
        },
        create() {
            console.log('there hi');
            this.$refs.FormModal.show();
        }
    }
})
</script>

<style scoped>

</style>
