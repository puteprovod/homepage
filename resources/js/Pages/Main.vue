<template>
    <Head>
        <title>Обо мне</title>
    </Head>
    <div class="p-10 max-w-screen-xl md:space-x-10 space-x-0 space-y-10 md:space-y-0 flex flex-wrap md:flex-nowrap">
        <div class="md:basis-1/2 border shadow-lg rounded-lg p-10 text-lg space-y-5">
            <p>Меня зовут Сергей.</p>
            <p>Я веб-разработчик. Создаю современные, безопасные веб-приложения любого уровня сложности. Опыт разработки и поддержки
                сайтов - более 8 лет.
            </p>
            <p>Мой основной профиль - <b>backend-разработка с использованием PHP-фреймворка Laravel</b>,
                но также я могу обеспечить современную и функциональную визуальную составляющую сайта с использованием
                Vue.js и Tailwind CSS.</p>
        </div>
        <div class="md:basis-1/2">
            <div class="space-y-10">
                <div class="border shadow-lg rounded-lg h-25">
                    <div class="border-b text-center p-4 md:text-lg text-gray-600">
                        Основной стек
                    </div>
                    <div class="border-b text-center p-3 text-gray-600 inline-block w-1/2 border-r">
                        backend
                    </div>
                    <div class="border-b text-center p-3 text-gray-600 inline-block w-1/2">
                        database
                    </div>
                    <div class="p-5 text-lg space-x-1 inline-block w-1/2 border-r text-center">
                        <span class="font-semibold">PHP</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Laravel</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Redis</span>
                    </div>
                    <div class="p-5 text-lg space-x-1 inline-block w-1/2 text-center">
                        <span class="font-semibold">MySQL</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">PostgreSQL</span>
                    </div>
                </div>
                <div class="border shadow-lg rounded-lg h-25">
                    <div class="border-b text-center p-4 md:text-lg text-gray-600">
                        Дополнительный стек
                    </div>
                    <div class="border-b text-center p-3 text-gray-600 inline-table w-1/2 border-r">
                        frontend
                    </div>
                    <div class="border-b text-center p-3 text-gray-600 inline-table w-1/2">
                        dev-ops
                    </div>
                    <div class="p-5 space-x-1 text-lg inline-block w-1/2 align-middle border-r text-center">
                        <span class="font-semibold">Vue.js</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Inertia.js</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Tailwind CSS</span>
                    </div>
                    <div class="p-5 space-x-1 text-lg inline-block w-1/2 align-middle border-r text-center">
                        <span class="font-semibold">Docker</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Git</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">CICD</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Linux</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-10 mb-10 max-w-screen-xl md:space-x-10 space-x-0 space-y-10 md:space-y-0 flex flex-wrap md:flex-nowrap">
        <div class="md:basis-full">
            <div class="space-y-10">
                <div class="border shadow-lg rounded-lg h-25">
                    <div class="border-b font-red text-center text-gray-600 p-4 md:text-lg">
                        Сайт болельщиков футбольного клуба СКА-Хабаровск
                    </div>
                    <div class="text-center p-6 text-gray-600 inline-block w-full">
                        <div class="w-1/2 pr-3 inline-block">
                            <a href="https://skaenergy.ru/" target="_blank"><img src="/img/skaenergy.jpg" class="border-2 cursor-pointer shadow-lg rounded-lg rounded-lg" alt=""></a>
                        </div>
                        <div class="w-1/2 pl-3 inline-block">
                            <a href="https://skaenergy.ru/" target="_blank"><img src="/img/ska-khabarovsk.jpg" class="border-2 cursor-pointer shadow-lg rounded-lg rounded-lg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="border shadow-lg rounded-lg h-25">
                    <div class="border-b font-red text-center text-gray-600 p-4 md:text-lg">
                        Пример исполнения онлайн-магазина
                    </div>
                    <div class="text-center p-6 text-gray-600 inline-block w-full">
                        <div class="w-1/2 pr-3 inline-block align-top">
                            <a href="https://subdomain.inshin.org/" target="_blank"><img src="/img/karte.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
                        </div>
                        <div class="w-1/2 pl-3 inline-block align-top">
                            <a href="https://subdomain.inshin.org/" target="_blank"><img src="/img/karte2.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import localizeFilter from "@/Filters/localize";

const a = [0, 1, 2];
a[100] = 100;
console.log(a.length);
console.log(a);
export default {
    name: "index",
    layout: MainLayout,
    components: {
        Link, Head
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
        },
    }
}
</script>

<style scoped>

</style>
