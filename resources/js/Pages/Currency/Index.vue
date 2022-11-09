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
                                <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Наименование
                                </th>
                                <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Индекс
                                </th>
                                <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Курс
                                </th>
                                <th scope="col" class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                    Обновлено
                                </th>
                            </tr>
                            </thead>
                            <tbody v-if="currencies">
                            <template v-for="currency in currencies">
                            <tr v-if="currency.title!=='RUB'" :class="currency.priority>=5 ? 'bg-blue-100 border-blue-200 border-b' : 'border-b'">
                                <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ currency.long_title }}
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
import {Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "index",
    layout: MainLayout,
    props: [
        'currencies',
    ],
    components: {
        Link
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
