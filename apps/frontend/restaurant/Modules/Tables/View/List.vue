<template>
    <app-layout>
        <template #header-content>
            <header-content></header-content>
        </template>
        <template #body-content>
            <body-content></body-content>
        </template>
    </app-layout>
</template>


<script>
import {defineComponent} from "vue";
import AppLayout from "@/Components/AppLayout";
import HeaderContent from "@/Modules/Tables/List/HeaderContent";
import BodyContent from "@/Modules/Tables/List/BodyContent";

export default defineComponent({
    name: "List",

    components: {
        AppLayout,
        HeaderContent,
        BodyContent,
    }
})
</script>

<style scoped>

</style>
