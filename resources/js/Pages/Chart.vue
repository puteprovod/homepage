<template>
    <Head>
        <title>Chart</title>
    </Head>
    <div class="mt-5 w-[32rem] h-[32rem]">
        <Pie :data="data" :options="options"/>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import {
    Chart as ChartJS,
    Tooltip,
    Legend,
    ArcElement
} from 'chart.js'
import {Pie} from 'vue-chartjs'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
    name: "index",
    layout: MainLayout,
    props: [
      'labels', 'datasets', 'percentages'
    ],
    components: {
        Link, Head, Pie
    },
    data() {
        return {
            data: {
                labels: this.labels,
                datasets: [
                    {
                        data: this.datasets,
                        percentages: this.percentages,
                        backgroundColor: [
                            "#147BA3",
                            "#F04D6C",
                            '#35BBF0',
                            "#F0E51D",
                            "#A39C1C"
                        ]
                    }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                               let label = context.dataset.data[context.dataIndex];
                                let formattedString = Intl.NumberFormat('ru-RU', {
                                    style: 'currency',
                                    currency: 'RUB',
                                    currencyDisplay: 'symbol',
                                    maximumFractionDigits: 0
                                }).format(label);
                               let percentString = context.dataset.percentages[context.dataIndex].toFixed(1)+'%';
                                return ' '+formattedString+' = '+percentString;
                            }
                        }
                    }
                }

            }
        }
    },
    mounted() {
        this.data.datasets.data = this.datasets;
    }
}
</script>

<style scoped>

</style>
