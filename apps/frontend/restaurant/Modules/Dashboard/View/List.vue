<template>
    <app-layout>
        <template #header-content>
            <header-content :informationHeaderData="informationHeaderData"></header-content>
        </template>
        <template #body-content>
            <body-content :reservations="reservations"></body-content>
        </template>
    </app-layout>
</template>

<script>

import {defineComponent} from "vue";
import AppLayout from "@/Components/AppLayout";
import HeaderContent from "@/Modules/Dashboard/List/HeaderContent";
import BodyContent from "@/Modules/Dashboard/List/BodyContent";
import informationHeaderData from "@/Modules/Dashboard/Data/informationHeaderData";
import qs from "qs";
import moment from "moment";

export default defineComponent({
    name: "Dashboard",

    components: {
        AppLayout,
        HeaderContent,
        BodyContent,
    },

    data() {
      return {
          reservations: [],
          informationHeaderData: informationHeaderData(),
      }
    },

    mounted() {
        this.init()
        this.informationHeader()
        this.informationChart()
        this.informationReservationTodayConfirmated()
    },

    methods: {
        init() {
            let context = this;
            let body = $('body');

            body.off('click', '.uptade').on('click', '.uptade', function () {
                context.informationReservationTodayConfirmated();
            });

            body.off('click', '.updateHistoricoCompeltado').on('click', '.updateHistoricoCompeltado', function () {
                context.informationChart();
            });

            body.off('click', '.updateReservaConfirmada').on('click', '.updateReservaConfirmada', function () {
                context.informationReservationTodayConfirmated();
            });
        },
        informationHeader() {
            let params = {
                page: 1,
                limit: 100,
                filter: {
                    state: 'approved',
                    dateFrom: moment().startOf('day').format('YYYY-MM-DD HH:mm:ss'),
                    dateTo: moment().endOf('day').format('YYYY-MM-DD HH:mm:ss'),
                }
            };

            axios.get('/reservations?'+qs.stringify(params)).then(response => {
                this.reservations = response.data.rows;
            });
        },
        informationReservationTodayConfirmated() {
            axios.get('/dashboard/information').then(response => {
                this.informationHeaderData = response.data.data
            });
        },
        informationChart() {
            axios.get('/reservations/history').then(response => {

                let historyCount = response.data.historyCount;
                let historyMonths = response.data.historyMonths;

                let $chart = $('#chart-sales-dark');
                let salesChart = new Chart($chart, {
                    type: 'line',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    lineWidth: 1,
                                    color: Charts.colors.gray[900],
                                    zeroLineColor: Charts.colors.gray[900]
                                },
                                ticks: {
                                    callback: function(value) {
                                        if (!(value % 1)) {
                                            return '#' + value ;
                                        }
                                    }
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function(item, data) {
                                    var label = data.datasets[item.datasetIndex].label || '';
                                    var yLabel = item.yLabel;
                                    var content = '';

                                    if (data.datasets.length > 1) {
                                        content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                    }

                                    content += '#' + yLabel;
                                    return content;
                                }
                            }
                        }
                    },
                    data: {
                        labels: historyMonths,
                        datasets: [{
                            label: 'Performance',
                            data: historyCount
                        }]
                    }
                });
                // Save to jQuery object
                $chart.data('chart', salesChart);
            });
        },
    }
})
</script>

<style scoped>

</style>
