<style>
input[type='number'] {
    -moz-appearance:textfield;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}
</style>
<template>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                ##
                                </th>
                                <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Название счета
                                </th>
                                <th scope="col" class="text-sm hidden lg:table-cell font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Вид счета
                                </th>
                                <th scope="col" class="text-sm text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Баланс
                                </th>
                                <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Валюта
                                </th>
                                <th scope="col" class="text-sm hidden xl:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Комментарий
                                </th>
                                <th scope="col" class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Стоимость в ₽
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="account in accounts" :class="getColorClass(account.category_id)+' border-b'">
                                <td class="text-sm hidden lg:table-cell text-gray-900 w-20 font-light px-4 py-3 whitespace-nowrap">
                                     <img alt="image" class="img-fluid whitespace-nowrap" style="height: 31px;" :src="'/storage/'+account.image">
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-3">
                                    {{ account.title }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap hidden lg:table-cell text-sm font-medium text-gray-900">
                                    {{ account.category_title}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    <input class="rounded-full h-8 w-24 lg:w-40 min-w-full text-sm border-gray-400 text-right" name="value[{{account.id}}]" placeHolder="value"
                                     type="number" :value="account.value">
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ account.currency_title }}
                                </td>
                                <td class="text-sm hidden xl:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ account.comment }}
                                </td>
                                <td class="text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ account.cost_formatted }} ₽
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "index",
    layout: MainLayout,
    props: [
        'accounts',
    ],
    components: {
        Link
    },
    methods: {
        getColorClass (acc_id){
            switch(acc_id) {
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
