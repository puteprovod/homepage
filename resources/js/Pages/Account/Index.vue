<template>
    <Head>
        <title>{{ localize('Accounts') }}</title>
    </Head>
    <input type="hidden" data-id-page="accounts">
    <div v-if="!$page.props.auth.user" class="mt-4 text-center">
        <p class="bg-yellow-100 border-yellow-200 text-sm">{{ localize('WarningRandom') }}</p>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full mb-10">
                        <thead class="border-b">
                        <tr>
                            <th scope="col"
                                class="text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                ##
                            </th>
                            <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('AccountName') }}
                            </th>
                            <th scope="col"
                                class="text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('AccountType') }}
                            </th>
                            <th scope="col" colspan="2"
                                class="text-sm text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('Balance') }}
                            </th>
                            <th scope="col"
                                class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                {{ localize('CostRubles') }}
                            </th>
                            <th v-if="$page.props.auth.user" scope="col"
                                class="text-sm hidden xl:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                <a @click="changeHistoryPage(false)" href="#" id="leftLink"
                                   :class="{'hidden': this.historyPage===0}">&lt;</a> <span id="historyTh"></span> <a
                                @click="changeHistoryPage(true)" href="#" id="rightLink"
                                :class="{'hidden': this.historyPage===(this.historyPageCount-1)}">&gt;</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="account in accounts" :class="getColorClass(account.category_id)+' border-b'">
                            <td class="text-sm hidden lg:table-cell text-gray-900 w-20 font-light px-4 py-3 whitespace-nowrap">
                                <img alt="image" class="img-fluid whitespace-nowrap" :title="account.comment"
                                     style="height: 31px;"
                                     :src="'/storage/'+account.image">
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-3">
                                {{ localizeAccountName(account.title) }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap hidden lg:table-cell text-sm font-medium text-gray-900">
                                {{ localizeAccountCategory(account.category_title) }}
                            </td>
                            <td class="text-sm text-gray-900 font-light whitespace-nowrap">
                                <div class="inline-block ml-2"><input @input="onKeyDown(account.id)"
                                                                      v-on:keyup.enter="onClick(account.id)"
                                                                      class="rounded-full h-8 w-24 lg:w-40 min-w-full text-sm border-gray-400 text-right"
                                                                      :id="'value['+account.id+']'"
                                                                      :ref="'value['+account.id+']'" placeHolder="value"
                                                                      type="number" :value="account.value"></div>
                                <div class="inline-block align-middle ml-1.5"><img @click="onClick(account.id)"
                                                                                   :id="'imag['+account.id+']'"
                                                                                   title="submit"
                                                                                   class="invisible cursor-pointer"
                                                                                   src="/img/enter.png"
                                                                                   style="width: 25px; height: 25px;"
                                                                                   alt="V"></div>
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                {{ account.currency_title }}
                            </td>
                            <td class="text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <input ref="costOriginal" type="hidden" :id="'costOriginal['+account.id+']'"
                                       :value="account.cost"><span
                                :id="'cost['+account.id+']'">{{ formatCost(account.cost) }}</span>
                            </td>
                            <td v-if="$page.props.auth.user"
                                class="text-sm hidden xl:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <p :id="'history['+account.id+']'" class="text-bold font-bold"></p>
                            </td>
                            <td v-else
                                class="text-sm hidden xl:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td v-if="$page.props.auth.user" colspan="3" class="hidden lg:table-cell">
                                <form @submit.prevent="saveToHistory">
                                    <div class="relative max-w-sm inline-block mr-5 mt-5">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input id="el1" type="text"
                                               class="bg-gray-50 border w-44 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 text-lg"
                                               placeholder="{{ localize('SelectDate') }}" :value="saveDate">
                                    </div>
                                    <div class="inline-block">
                                        <button id="saveBtn" :class="saveButtonClasses" :disabled="!saveButtonStatus"
                                                class="block p-2 pl-10 pr-10 mt-5 text-lg border text-white"
                                                type="submit">{{ localize('SaveToHistory') }}
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td colspan="100%"
                                class="text-sm text-right mt-5 text-gray-900 px-4 pt-5 text-lg whitespace-nowrap">
                                <span class="font-bold mr-1">{{ localize('OverallBalance') }}: </span><span
                                ref="finalCost"
                                class="font-bold underline"></span>
                                <span ref="finalCostChange" class="font-weight-normal text-base pl-2"></span></td>
                        </tr>
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
import Datepicker from 'flowbite-datepicker/Datepicker';
import localizeFilter from "@/Filters/localize";

export default {
    name: "index",
    layout: MainLayout,
    props: [
        'accounts', 'status', 'saveDate', 'history', 'historyDates'
    ],
    data() {
        return {
            statusData: null,
            newCost: null,
            accountValues: null,
            historyCurrent: null,
            historyPage: 0,
            historyPageCount: 0,
            finalCost: 0,
            saveButtonStatus: true,
        }
    },
    components: {
        Link, Head
    },
    computed: {
        saveButtonClasses: function () {
            return {
                'bg-blue-800': this.saveButtonStatus,
                'hover:bg-blue-700': this.saveButtonStatus,
                'bg-gray-500': !this.saveButtonStatus
            }
        }
    },
    mounted() {
        this.newFinalCost();
        this.historyPageCount = this.historyDates.length;
        const datepickerEl = document.getElementById('el1');
        if (this.$page.props.auth.user) {
            Datepicker.locales.ru = {
                days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
                daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб"],
                daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                today: "Сегодня",
                clear: "Очистить",
                format: "dd.mm.yyyy",
                weekStart: 1,
                monthsTitle: 'Месяцы'
            };
            new Datepicker(datepickerEl, {
                autohide: true,
                format: 'dd.mm.yyyy',
                language: 'ru',
            });
            this.historyCurrent = this.history[this.historyPage];

            this.drawHistory(this.history[this.historyPage]);
        }
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
        },
        localizeAccountName(name) {
            if (window.lang === 'en-US') {
                if (name.indexOf('Наличные1') !== -1)
                    return ('Some cash');
                if (name.indexOf('Вклад в') !== -1)
                    return ('Some bank account');
                if (name.indexOf('Счет в') !== -1)
                    return ('Some bank account');
                if (name.indexOf('Ипотечный счет') !== -1)
                    return ('Mortgage account');
                if (name.indexOf('Дебетовая карта') !== -1)
                    return ('Some debit card');
            } else {
                return name;
            }
        },
        localizeAccountCategory(name) {
            if (window.lang === 'en-US') {
                if (name.indexOf('Банковская карта') !== -1)
                    return ('Bank card');
                if (name.indexOf('Вклад') !== -1)
                    return ('Bank deposit');
                if (name.indexOf('Банковский счет') !== -1)
                    return ('Bank account');
                if (name.indexOf('Криптовалютный счет') !== -1)
                    return ('Cryptocurrency account');
                if (name.indexOf('Наличные средства') !== -1)
                    return ('Сash');
            } else {
                return name;
            }
        },
        updateAccount(id) {
            const editedValue = document.getElementById(`value[${id}]`).value;
            // this.$inertia.patch(`/accounts/${id}`, { id: id, value: editedValue });
            axios.patch(`/accounts/${id}`, {id: id, value: editedValue})
                .then(res => {
                    this.statusData = res.data.status;
                    this.newCost = res.data.newCost;
                    this.showStatusData(id)
                })
                .catch(error => console.log(error));
            this.saveButtonStatus = true;
        },
        newFinalCost() {
            let costSum = 0;
            let els = this.$refs.costOriginal;
            for (let i = els.length - 1; i >= 0; i--) {
                // console.log(parseInt(els[i].value));
                costSum += parseInt(els[i].value);
            }
            // console.log('the end');
            console.log(costSum);
            this.finalCost = costSum;
            this.$refs.finalCost.textContent = this.formatCost(costSum);
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
        showStatusData(id) {
            if (this.statusData === "ok") {
                document.getElementById(`imag[${id}]`).src = "/img/success-image.png";
                document.getElementById(`imag[${id}]`).title = this.statusData;
                document.getElementById(`costOriginal[${id}]`).value = this.newCost;
                document.getElementById(`cost[${id}]`).textContent = this.formatCost(this.newCost);
                this.newFinalCost();
            } else {
                document.getElementById(`imag[${id}]`).src = "/img/error-image.png";
                document.getElementById(`cost[${id}]`).textContent = this.statusData;
                document.getElementById(`imag[${id}]`).title = this.statusData;

            }
            this.drawHistory(this.historyCurrent);
        },
        onKeyDown(id) {
            document.getElementById(`imag[${id}]`).src = "/img/enter.png";
            document.getElementById(`imag[${id}]`).style.visibility = 'visible';
        },
        onClick(id) {
            this.updateAccount(id);
            document.getElementById(`imag[${id}]`).style.visibility = 'visible';
        },
        getColorClass(acc_id) {
            switch (acc_id) {
                case 22:
                    return 'bg-green-100 border-green-200';
                case 23:
                    return 'bg-green-100 border-green-200';
                case 24:
                    return 'bg-red-100 border-red-200';
                case 25:
                    return 'bg-indigo-100 border-indigo-200';
                case 26:
                    return 'bg-blue-100 border-blue-200';
                case 27:
                    return 'bg-yellow-100 border-yellow-200';
                default:
                    break;
            }
        },
        drawHistory(arrayOfHistories) {
            document.getElementById('historyTh').innerHTML = this.historyDates[this.historyPage];

            for (const [, item] of Object.entries(arrayOfHistories)) {
                let editedValue = document.getElementById(`value[${item.account_id}]`).value - item.value;
                if (editedValue === 0) {
                    editedValue = '---'
                    document.getElementById(`history[${item.account_id}]`).className = '';
                } else if (editedValue > 0) {
                    editedValue = '+' + editedValue.toString();
                    document.getElementById(`history[${item.account_id}]`).className = 'text-green-700 font-bold';
                } else if (editedValue < 0) {
                    document.getElementById(`history[${item.account_id}]`).className = 'text-red-700 font-bold';
                }
                document.getElementById(`history[${item.account_id}]`).innerHTML = editedValue;
            }
            this.$refs.finalCostChange.textContent = '( ' + this.formatCost(this.finalCost - this.historySum(this.history[this.historyPage]), true) + ' )';
        },
        historySum(arr) {
            let sum = 0;
            for (const [, item] of Object.entries(arr)) {
                sum += item.cost;
            }
            return sum;
        },
        saveToHistory() {
            const savingDate = document.getElementById('el1').value;
            axios.post('/api/accounts', {savingDate: savingDate}).then(res => {
                this.historyCurrent = res.data.history;
                this.history.unshift(res.data.history);
                this.historyPage = 0;
                this.drawHistory(this.history[0]);
            }).catch(error => console.log(error));
            this.saveButtonStatus = false;
        },
        changeHistoryPage(isRight) {
            (isRight) ? this.historyPage++ : this.historyPage--;
            this.drawHistory(this.history[this.historyPage]);
        }
    }
}

</script>
<style scoped>
</style>
