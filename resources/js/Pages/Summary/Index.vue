<template>
    <Head>
        <title>{{ localize('Summary') }}</title>
    </Head>
    <div class="mt-5">
        <div>
            <div class="flex flex-wrap">
                <div class="border-2 m-5 p-5 pl-20 pr-20 flex grow flex-col text-xl">
                    <div class="mt-3 text-2xl font-semibold">Баланс:</div>
                    <div class="mt-3 text-2xl text-green-800 font-bold">{{ getFinalCost }}</div>
                    <div class="mt-5">изменился на:</div>
                    <div class="mt-2" :class="[getSumDiff > 0 ? 'text-green-800' : 'text-red-800']">{{ getSumDiffText }}</div>
                    <div class="mt-5">по старому курсу:</div>
                    <div class="mt-2" :class="[getSumRealDiff > 0 ? 'text-green-800' : 'text-red-800']">{{ getSumRealDiffText }}</div>
                </div>
                <div class="border-2 m-5 p-5 pl-10 pr-10 flex grow flex-col text-xl">
                    <table class="w-full h-full">
                        <tr v-for="(currency,index) in currencies" :class="{ 'border-b' : (index!==currencies.length-1) }">
                            <td class="pl-10 pr-5 px-4 py-4">
                                {{ currency.title }}
                            </td>
                            <td class="pr-10 px-4 py-4 font-semibold">
                                {{ currency.exchange_rate.toFixed(2) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import localizeFilter from "@/Filters/localize";

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
            finalCostTextArray: [0,0]
        }
    },
    components: {
        Link, Head
    },
    mounted() {
        this.drawHistory();
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
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
            console.log(arrayOfHistories);
            console.log(this.accountData.accounts);
            for (const [, item] of Object.entries(arrayOfHistories)) {
                if (item.value > 0) {
                    let found = this.accountData.accounts.find(e => e.id === item.account_id);
                    oldCourseSum += found.value * (item.cost / item.value);
                }
            }
            const historySum = this.historySum(arrayOfHistories);
            this.finalCostTextArray[0] = this.calculateFinalCost() - historySum;
            this.finalCostTextArray[1] = oldCourseSum - historySum;
            console.log(this.finalCostTextArray);
        }
    }
}
</script>

<style scoped>

</style>
