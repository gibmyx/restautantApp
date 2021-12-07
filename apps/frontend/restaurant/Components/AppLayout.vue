<template>
    <!-- Sidenav -->
    <sidenav-component></sidenav-component>
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <topnav-component></topnav-component>

        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                        </div>
                        <div class="col-lg-6 col-5 text-right" v-if="!route().current('dashboard') && !route().current('user.profile')">
                            <button class="btn btn-sm btn-neutral" @click.prevent="create">New</button>
                            <button class="btn btn-sm btn-neutral">Filters</button>
                        </div>
                        <div class="col-lg-6 col-5 text-right" v-else>
                            <button class="btn btn-sm btn-neutral">Uptade</button>
                        </div>
                    </div>
                    <slot name="header-content"/>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <div class="container-fluid mt--6"><slot name="body-content"/></div>
    </div>
</template>

<script>
import SidenavComponent from "@/Components/Sidenav";
import TopnavComponent from "@/Components/Topnav";
import {defineComponent} from "vue";

export default defineComponent({

    name: "AppLayout",

    emits: ["create"],

    mounted() {
        let body = $("body");

        if (body.hasClass("bg-default"))
            body.removeClass("bg-default");
    },

    methods: {
        create() {
            this.$emit('create')
        }
    },

    components: {
        SidenavComponent,
        TopnavComponent,
    }
})
</script>

<style scoped>

</style>
