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
import AppLayout from "@/Modules/Components/AppLayout";
import HeaderContent from "@/Modules/Dashboard/List/HeaderContent";
import BodyContent from "@/Modules/Dashboard/List/BodyContent";

export default defineComponent({
    name: "Dashboard",

    components: {
        AppLayout,
        HeaderContent,
        BodyContent,
    }
})
</script>

<style scoped>

</style>
