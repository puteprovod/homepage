<template>
    <Head>
        <title>{{ localize('Summary') }}</title>
    </Head>
    <div class="md:mt-5">
        <div>
            <div class="flex flex-wrap">
                <div class="border-2 m-5 p-5 pl-10 pr-20 flex grow flex-col text-xl">
                    <div class="mt-3 pl-8 pr-2 text-2xl font-semibold">Баланс:</div>
                    <div class="mt-3 pl-8 pr-2 text-2xl text-green-800 font-bold">{{ getFinalCost }}</div>
                    <div class="mt-5 pl-8 pr-2">изменился на:</div>
                    <div class="mt-2 pl-8 pr-2" :class="[getSumDiff > 0 ? 'text-green-800' : 'text-red-800']">{{ getSumDiffText }}</div>
                    <div class="mt-5 pl-8 pr-2">по старому курсу:</div>
                    <div class="mt-2 mb-3 pl-8 pr-2" :class="[getSumRealDiff > 0 ? 'text-green-800' : 'text-red-800']">{{ getSumRealDiffText }}</div>
                </div>
                <div class="border-2 mx-5 sm:mt-2 mb-5 md:mt-5 p-5 pl-10 pr-10 flex grow flex-col text-xl">
                    <table class="w-full h-full">
                        <tr v-for="(currency,index) in currencies" :class="{ 'border-b' : (index!==currencies.length-1) }">
                            <td class="pl-8 pr-5 px-4 py-4">
                                {{ currency.title }}
                            </td>
                            <td class="pr-8 px-4 py-4 font-semibold">
                                {{ currency.exchange_rate.toFixed(2) }}
                                <span class="ml-2 text-green-500" v-if="isCurrencyGrowth(currency.title) === true">
                                &#9650;
                                </span>
                                <span class="ml-2 text-red-500" v-else-if="isCurrencyGrowth(currency.title) === false">
                                &#9660;
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="border-2 mx-5 mb-5 sm:mt-2 md:mt-5 p-5 pl-10 pr-10">
                <div class="sm:w-48 md:w-[32rem] md:h-[36rem] mx-auto text-center p-2">
                <Pie class="text-center" :data="chartData" :options="chartOptions"/>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import localizeFilter from "@/Filters/localize";
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
    layout: MainLayout,
    props:
        [
            'currencies','accountData'
        ]
    ,
    computed: {
        getFinalCost: function () {
            return this.formatCost(this.calculateFinalCost(),true);
        },
        getSumDiff: function () {
            return this.finalCostTextArray[0];
        },
        getSumRealDiff: function () {
            return this.finalCostTextArray[1];
        },
        getSumRealDiffText: function () {
            return '⇔ ' + this.formatCost(this.getSumRealDiff, true);
        },
        getSumDiffText: function () {
            return this.formatCost(this.getSumDiff, true);
        }
    },
    data() {
        return {
            finalCostTextArray: [0,0],
            chartData: {
                labels: this.accountData.chartValues.labels,
                datasets: [
                    {
                        data: this.accountData.chartValues.datasets,
                        percentages: this.accountData.chartValues.percentages,
                        backgroundColor: [
                            "#147BA3",
                            "#F04D6C",
                            '#35BBF0',
                            "#F0E51D",
                            "#A39C1C"
                        ]
                    }]
            },
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 12,
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
    components: {
        Link, Head, Pie
    },
    mounted() {
        this.drawHistory();
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
        },
        isCurrencyGrowth(title) {
            let usd = this.currencies.find(e => (e.title === 'USD'));
            let history = this.accountData.history[0];
            let account = null;
            for (const [, value] of Object.entries(history)) {
                if(this.accountData.accounts.find(e => (e.currency_title === title && e.id === value.account_id))) {
                    if (value.value > 0) {
                        account = value;
                        break;
                    }
                }
            }
            let currency = this.currencies.find(e => (e.title === title));
            if (account) {
                if (currency.source==='cmc'){
                    console.log(currency.source, currency.title, account.cost/account.value, currency.exchange_rate*usd.exchange_rate);
                    return (account.cost/(account.value*usd.exchange_rate) < currency.exchange_rate)
                }
                else {
                    console.log(currency.source, currency.title, account.cost/account.value, currency.exchange_rate);
                    return (account.cost/account.value < currency.exchange_rate)
                }
            }
            else {
                return null;
            }
        },
        calculateFinalCost(){
            let costSum = 0;
            let els = this.accountData.accounts;
            for (let i = els.length - 1; i >= 0; i--) {
                costSum += els[i].cost;
            }
            return (costSum);
        },
        formatCost(number, addPlus = false) {
            let formattedString = Intl.NumberFormat('ru-RU', {
                style: 'currency',
                currency: 'RUB',
                currencyDisplay: 'symbol',
                maximumFractionDigits: 0
            }).format(number);
            return (addPlus && number > 0) ? '+' + formattedString : formattedString;
        },
        historySum(arr) {
            let sum = 0;
            for (const [, item] of Object.entries(arr)) {
                sum += item.cost;
            }
            return sum;
        },
        drawHistory() {
            const arrayOfHistories = this.accountData.history[0];
            let oldCourseSum = 0;
            for (const [, item] of Object.entries(arrayOfHistories)) {
                if (item.value > 0) {
                    let found = this.accountData.accounts.find(e => e.id === item.account_id);
                    oldCourseSum += found.value * (item.cost / item.value);
                }
            }
            const historySum = this.historySum(arrayOfHistories);
            this.finalCostTextArray[0] = this.calculateFinalCost() - historySum;
            this.finalCostTextArray[1] = oldCourseSum - historySum;
        }
    }
}
</script>

<style scoped>

</style>
