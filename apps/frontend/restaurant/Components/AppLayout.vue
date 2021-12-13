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
                        <div class="col-lg-6 col-5 text-right" v-html="getOpctions"></div>
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
const optionOne =  `<button class="btn btn-sm btn-neutral uptade">Uptade</button>`;

const optionTwo =  `<button class="btn btn-sm btn-neutral filters">Filters</button>
                    <button class="btn btn-sm btn-neutral uptade">Uptade</button>`;

const optionThree =  `<button class="btn btn-sm btn-neutral create">New</button>
                    <button class="btn btn-sm btn-neutral filters">Filters</button>
                    <button class="btn btn-sm btn-neutral uptade">Uptade</button>`;

import SidenavComponent from "@/Components/Sidenav";
import TopnavComponent from "@/Components/Topnav";
import {defineComponent} from "vue";

export default defineComponent({

    name: "AppLayout",

    mounted() {
        let body = $("body");

        if (body.hasClass("bg-default"))
            body.removeClass("bg-default");
    },

    computed: {
        getOpctions() {
            if(route().current('dashboard') || route().current('user.profile')) return optionOne;

            if(route().current('clients.list') || route().current('reservations.list')) return optionTwo;

            if(route().current('tables.list') || route().current('notifications.list')) return optionThree;
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
