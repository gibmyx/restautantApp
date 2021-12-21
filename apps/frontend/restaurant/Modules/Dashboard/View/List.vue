<template>
    <app-layout>
        <template #header-content>
            <header-content :informationHeaderData="informationHeaderData"></header-content>
        </template>
        <template #body-content>
            <body-content></body-content>
        </template>
    </app-layout>
</template>

<script>

import {defineComponent} from "vue";
import AppLayout from "@/Components/AppLayout";
import HeaderContent from "@/Modules/Dashboard/List/HeaderContent";
import BodyContent from "@/Modules/Dashboard/List/BodyContent";

export default defineComponent({
    name: "Dashboard",

    components: {
        AppLayout,
        HeaderContent,
        BodyContent,
    },

    data() {
      return {
          informationHeaderData: {
              newUser: {
                  currentMonth: 0,
                  isPositive: true,
                  lastMonth: 0,
                  porcentaje: 0,
              },
              reservation: {
                  currentMonth: 0,
                  isPositive: true,
                  lastMonth: 0,
                  porcentaje: 0,
              },
              reservationsCanceled: {
                  currentMonth: 0,
                  isPositive: true,
                  lastMonth: 0,
                  porcentaje: 0,
              },
              reservationsCompleted: {
                  currentMonth: 0,
                  isPositive: true,
                  lastMonth: 0,
                  porcentaje: 0,
              },
          },
      }
    },

    mounted() {
        this.init()
        this.informationHeader()
    },

    methods: {
        init() {
            let context = this;
            let body = $('body');

            body.off('click', '.uptade').on('click', '.uptade', function () {
                context.informationHeader();
            });
        },
        informationHeader() {
            axios.get('/dashboard/information').then(response => {
                this.informationHeaderData = response.data.data
            });
        },
    }
})
</script>

<style scoped>

</style>
