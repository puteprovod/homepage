<template>
    <div class="mt-5 lg:w-[32rem] lg:h-[32rem]">
        <Pie :data="data" :options="options"/>
    </div>
</template>

<script>
import {
    Chart as ChartJS,
    Tooltip,
    Legend,
    ArcElement
} from 'chart.js'
import {Pie} from 'vue-chartjs'
ChartJS.register(ArcElement, Tooltip, Legend)
ChartJS.defaults.font.size = 16;


export default {
    name: "index",
    props: [
        'labels', 'datasets', 'percentages'
    ],
    components: {
        Pie
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
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 18,
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.data[context.dataIndex];
                                let formattedString = Intl.NumberFormat('ru-RU', {
                                    style: 'currency',
                                    currency: 'RUB',
                                    currencyDisplay: 'symbol',
                                    maximumFractionDigits: 0
                                }).format(label);
                                let percentString = context.dataset.percentages[context.dataIndex].toFixed(1) + '%';
                                return ' ' + formattedString + ' = ' + percentString;
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
