<template>
    <Head>
        <title>Resizer</title>
    </Head>
    <div class="text-center font-bold mt-8">
        Результат обработки изображений
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full" v-if="sizeSum">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-center font-bold text-gray-900 px-6 py-4 text-left">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-center">
                                Изображение
                            </th>
                            <th scope="col" class="text-sm font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Название файла
                            </th>
                            <th scope="col"
                                class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Размер изображения
                            </th>
                            <th scope="col"
                                class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Размер файла
                            </th>
                            <th scope="col"
                                class="text-sm hidden md:table-cell text-center font-medium font-bold text-gray-900 px-6 py-4 text-left">
                                Скачать
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="(element,index) in data">
                            <tr class="border-b">
                                <td class="text-sm text-gray-900 font-light px-4 py-3 text-center">
                                    {{ ++index }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-3 text-center whitespace-nowrap">
                                    <img :src="element.preview_url" class="mx-auto" alt="image">
                                </td>
                                <td class="text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ element.title.length>40 ? element.title.substr(0,40)+'...' : element.title }}
                                </td>
                                <td class="text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 text-center whitespace-nowrap">
                                    {{ element.width }}x{{ element.height }}
                                </td>
                                <td class="text-sm hidden md:table-cell text-gray-900 font-light px-4 py-3 text-center whitespace-nowrap">
                                    {{ element.size }} KB
                                </td>
                                <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    <a :href="element.url" target="_blank"><img src="/img/download.png" class="w-8 h-8 mx-auto cursor-pointer" alt="download"></a>
                                </td>
                            </tr>
                        </template>
                        <tr>
                            <td class="font-light px-4 py-3 whitespace-nowrap" colspan="100%">
                                <div class="flex mt-1">
                                    <div class="inline-block text-gray-300">
                                        {{ this.timeTaken }} sec. (Py: {{ this.timeTakenPy }} sec.)
                                    </div>
                                <div class="inline-block ml-auto text-right">
                                    <a :href="route('resizer.zip', { token: token })" class="text-blue-800 font-bold hover:underline ">Скачать все файлы одним архивом
                                    (~{{ sizeSum }} MB)</a>
                                </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="!sizeSum">
                    Нет доступных для просмотра изображений
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
    components: {
        Link, Head
    },
    data () {
        return {
            timeTaken: null,
            timeTakenPy: null
        }
    },
    props: [
        'data', 'token', 'sizeSum'
    ],
    mounted() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        this.timeTaken = urlParams.get('timeTaken')
        this.timeTakenPy = urlParams.get('timeTakenPy')
    }
}
</script>

<style scoped>

</style>
