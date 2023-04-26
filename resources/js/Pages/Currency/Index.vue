<style>
input[type='number'] {
    -moz-appearance: textfield;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}
</style>
<template>
    <Head>
        <title>{{ localize('Currencies') }}</title>
    </Head>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div v-if="errorMessage" class="text-red-800 text-center mt-3 mb-5">
                    {{ errorMessage }}
                </div>
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('CurrencyName') }}
                            </th>
                            <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('CurrencyIndex') }}
                            </th>
                            <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('ExchangeRate') }}
                            </th>
                            <th scope="col"
                                class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('Reloaded') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody v-if="currencies">
                        <template v-for="currency in currencies">

                            <tr v-if="currency.title!=='RUB'"
                                :class="currency.priority>=5 ? 'bg-blue-100 border-blue-200 border-b' : 'border-b'">
                                <td class="text-sm text-gray-900 font-light px-4 py-3">
                                    {{localizeCurrency(currency.title, currency.long_title) }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ currency.title }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ currency.exchange_rate }}
                                </td>
                                <td class="text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ currency.date }}
                                </td>
                            </tr>
                        </template>
                        </tbody>
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
    props: [
        'currencies', 'errorMessage'
    ],
    components: {
        Head, Link
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
        },
        localizeCurrency(currency, currencyRuTitle) {
            if (window.lang==='en-US') {
                return '1 '+Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: currency,
                    currencyDisplay: 'name',
                    maximumFractionDigits: 0
                }).format(1).slice(2);
            }
            else {
                return (currency === 'XDR') ? 'СДР' : currencyRuTitle;
            }
        }
    }
}
</script>

<style scoped>

</style>
