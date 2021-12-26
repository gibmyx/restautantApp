<template>
    <header-component>
        <template #header_right>
            <ul v-if="$page.props.user" class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <inertia-link :href="`${urlApp}/dashboard`" class="nav-link">
                        <i class="fas fa-home"></i><span class="nav-link-inner--text">Dashboard</span>
                    </inertia-link>
                </li>
            </ul>
            <ul v-else class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <inertia-link :href="`${urlApp}/login`" class="nav-link">
                        <i class="ni ni-key-25"></i><span class="nav-link-inner--text"> Login</span>
                    </inertia-link>
                </li>
            </ul>
        </template>
    </header-component>
    <body-component>
        <template #header-slot>header</template>
        <template #body-slot></template>
    </body-component>
</template>

<script>
import {defineComponent} from "vue";
import HeaderComponent from "@/Components/Header";
import BodyComponent from "@/Components/Body";

export default defineComponent({
    name: "Welcome",

    props: {},

    data () {
        return {
            urlApp: null
        }
    },

    mounted() {
        this.urlApp = process.env.MIX_APP_URL;
        let body = $("body");

        if (!body.hasClass("bg-default"))
            body.addClass("bg-default");
    },

    components: {
        HeaderComponent,
        BodyComponent
    }
})
</script>

<style scoped>

</style>
