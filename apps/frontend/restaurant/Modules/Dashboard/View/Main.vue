<template>
    <app-layout></app-layout>
</template>

<script>

import {defineComponent} from "vue";
import AppLayout from "@/Modules/Components/AppLayout";

export default defineComponent({
    name: "Dashboard",

    components: {
        AppLayout,
    }
})
</script>

<style scoped>

</style>
