<template>
    <Head>
        <title>Счета</title>
    </Head>
    <input type="hidden" data-id-page="accounts">
    <div v-if="!$page.props.auth.user" class="mt-4 text-center">
        <p class="bg-yellow-100 border-yellow-200 text-sm">Внимание: значения полей генерируются случайно</p>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                        <tr>
                            <th scope="col"
                                class="text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                ##
                            </th>
                            <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Название счета
                            </th>
                            <th scope="col"
                                class="text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Вид счета
                            </th>
                            <th scope="col" colspan="2"
                                class="text-sm text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Баланс
                            </th>
                            <th scope="col"
                                class="text-sm hidden xl:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Комментарий
                            </th>
                            <th scope="col"
                                class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Стоимость в ₽
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="account in accounts" :class="getColorClass(account.category_id)+' border-b'">
                            <td class="text-sm hidden lg:table-cell text-gray-900 w-20 font-light px-4 py-3 whitespace-nowrap">
                                <img alt="image" class="img-fluid whitespace-nowrap" style="height: 31px;"
                                     :src="'/storage/'+account.image">
                            </td>
                            <td class="text-sm text-gray-900 font-light px-4 py-3">
                                {{ account.title }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap hidden lg:table-cell text-sm font-medium text-gray-900">
                                {{ account.category_title }}
                            </td>
                            <td class="text-sm text-gray-900 font-light whitespace-nowrap">
                                <div class="inline-block ml-2"><input @input="onKeyDown(account.id)"
                                                                      class="rounded-full h-8 w-24 lg:w-40 min-w-full text-sm border-gray-400 text-right"
                                                                      :id="'value['+account.id+']'" :ref="'value['+account.id+']'" placeHolder="value"
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
                            <td class="text-sm hidden xl:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                {{ account.comment }}
                            </td>
                            <td class="text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <input ref="costOriginal" type="hidden" :id="'costOriginal['+account.id+']'"
                                       :value="account.cost"><span
                                :id="'cost['+account.id+']'">{{ formatCost(account.cost) }}</span>
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td colspan="100%"
                                class="text-sm text-right font-bold text-gray-900 px-4 py-3 whitespace-nowrap">
                                Общий баланс счетов: <u><span ref="finalCost"></span></u></td>
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

export default {
    name: "index",
    layout: MainLayout,
    props: [
        'accounts', 'sum', 'status'
    ],
    data() {
        return {
            statusData: null,
            newCost: null,
            accountValues: null
        }
    },
    components: {
        Link, Head
    },
    computed: {},
    mounted() {
        this.newFinalCost();
    },
    methods: {
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

        },
        newFinalCost() {
            let costSum = 0;
            let els = this.$refs.costOriginal;
            for (let i = els.length - 1; i >= 0; i--) {
                costSum += parseInt(els[i].value);
            }
            this.$refs.finalCost.textContent = this.formatCost(costSum);
        },
        formatCost(number) {
            return (
                Intl.NumberFormat('ru-RU', {
                    style: 'currency',
                    currency: 'RUB',
                    currencyDisplay: 'symbol',
                    maximumFractionDigits: 0
                }).format(number));
        },
        showStatusData(id) {
            if (this.statusData === "ok") {
                document.getElementById(`imag[${id}]`).src = "/img/success-image.png";
                document.getElementById(`imag[${id}]`).title = this.statusData;
                this.$refs.costOriginal[id].value = this.newCost;
                document.getElementById(`cost[${id}]`).textContent = this.formatCost(this.newCost);
                this.newFinalCost();
            } else {
                document.getElementById(`imag[${id}]`).src = "/img/error-image.png";
                document.getElementById(`cost[${id}]`).textContent = this.statusData;
                document.getElementById(`imag[${id}]`).title = this.statusData;

            }

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
        }
    }
}
</script>

<style scoped>

</style>
