<template>
    <Head>
        <title>Обо мне</title>
    </Head>
    <div class="px-0 md:px-10 py-6 md:py-10 max-w-screen-lg md:space-x-10 space-x-0 space-y-6 md:space-y-0 flex flex-wrap md:flex-nowrap">
        <div
            v-html="`<p>${localize('MainNameString')}</p><p>${localize('MainAboutString')}</p><p>${localize('MainProfileString')}</p>`"
            class="md:basis-1/2 border shadow-lg bg-white rounded-lg p-10 py-8 md:p-10 md:py-8 text-base space-y-5">
        </div>
        <div class="md:basis-1/2">
            <div class="space-y-6 md:space-y-10">
                <div class="border shadow-lg bg-white rounded-lg">
                    <div class="border-b text-center p-3 font-semibold text-sm text-gray-600">
                        {{ localize('MainMainStack') }}
                    </div>
                    <div class="border-b text-center p-2 text-gray-600 text-sm inline-block w-1/2 border-r">
                        backend
                    </div>
                    <div class="border-b text-center p-2 text-gray-600 text-sm inline-block w-1/2">
                        database
                    </div>
                    <div class="p-5 space-x-1 inline-block w-1/2 border-r text-center">
                        <span class="font-semibold">PHP</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Laravel</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Redis</span>
                    </div>
                    <div class="p-5 space-x-1 inline-block w-1/2 text-center">
                        <span class="font-semibold">MySQL</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">PostgreSQL</span>
                    </div>
                </div>
                <div class="border shadow-lg bg-white rounded-lg h-25">
                    <div class="border-b text-center p-3 font-semibold text-sm text-gray-600">
                        {{ localize('MainAdditionalStack') }}
                    </div>
                    <div class="border-b text-center p-2 text-sm text-gray-600 inline-block w-1/2 border-r">
                        frontend
                    </div>
                    <div class="border-b text-center p-2 text-sm text-gray-600 inline-block w-1/2">
                        dev-ops
                    </div>
                    <div class="p-5 space-x-1 inline-block w-1/2 align-middle border-r text-center">
                        <span class="font-semibold">Vue.js</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Inertia.js</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Tailwind CSS</span>
                    </div>
                    <div class="p-5 space-x-1 inline-block w-1/2 align-middle border-r text-center">
                        <span class="font-semibold">Docker</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Git</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">CICD</span> <span class="text-gray-400">/</span> <span
                        class="font-semibold">Linux</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-0 md:px-10 mb-6 md:mb-10 max-w-screen-lg md:space-x-10 space-x-0 space-y-6 md:space-y-0 flex flex-wrap md:flex-nowrap">
        <div class="basis-full md:basis-1/2 border shadow-lg bg-white rounded-lg text-base">
            <div class="border-b text-center p-3 font-semibold text-sm text-gray-600">
                {{  localize('MainContactMe') }}
            </div>
            <div class="p-6 pl-10">
                <div class="space-y-2">
                    <div class="grow font-semibold align-middle">
                        <div class="inline-block align-middle">
                            <img src="/img/email.png" class="w-5 align h-5 mr-1" alt="">
                        </div>
                        <div class="inline-block align-middle ml-0.5">
                            E-mail: <a href="mailto:serg-419@yandex.ru" class="text-blue-700 hover:underline ml-1">serg-419@yandex.ru</a>
                        </div>
                    </div>
                    <div class="grow font-semibold align-middle">
                        <div class="inline-block align-middle">
                            <img src="/img/telegram.png" class="w-5 align h-5 mr-1" alt="">
                        </div>
                        <div class="inline-block align-middle ml-0.5">
                            Telegram: <a href="https://github.com/puteprovod" class="text-blue-700 hover:underline ml-1">@sergey914</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="basis-full md:basis-1/2 border shadow-lg bg-white rounded-lg text-base">
            <div class="border-b text-center p-3 font-semibold text-sm text-gray-600">
                {{  localize('MainLinks') }}
            </div>
            <div class="p-6 pl-10">
                <div class="space-y-2">
                    <div class="grow font-semibold align-middle">
                        <div class="inline-block align-middle">
                        <img src="/img/github.png" class="w-5 align h-5 mr-1" alt="">
                        </div>
                        <div class="inline-block align-middle ml-0.5">
                        Github: <a href="https://github.com/puteprovod" class="text-blue-700 hover:underline ml-1">@puteprovod</a>
                        </div>
                    </div>
                    <div class="grow font-semibold align-middle">
                        <div class="inline-block align-middle">
                            <img src="/img/gitlabicon.png" class="w-5 align h-5 mr-1" alt="">
                        </div>
                        <div class="inline-block align-middle ml-0.5">
                            Gitlab: <a href="https://github.com/puteprovod" class="text-blue-700 hover:underline ml-1">@puteprovod</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-0 md:px-10 mb-10 max-w-screen-lg md:space-x-10 space-x-0 space-y-10 md:space-y-0 flex flex-wrap md:flex-nowrap">
        <div class="md:basis-full">
            <div class="space-y-6 md:space-y-10">
                <div class="border bg-white shadow-lg md:rounded-lg h-25">
                    <div class="border-b font-red text-center font-semibold text-sm text-gray-600 p-4">
                        {{ localize('MainSkaKhabarovsk') }}
                    </div>
                    <div class="text-center p-6 text-gray-600 inline-block w-full">
                        <div class="w-1/2 pr-3 inline-block">
                            <a href="https://skaenergy.ru/" target="_blank"><img src="/img/portfolio/skaenergy.jpg" class="border-2 cursor-pointer shadow-lg rounded-lg rounded-lg" alt=""></a>
                        </div>
                        <div class="w-1/2 pl-3 inline-block">
                            <a href="https://skaenergy.ru/" target="_blank"><img src="/img/portfolio/ska-khabarovsk.jpg" class="border-2 cursor-pointer shadow-lg rounded-lg rounded-lg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="border shadow-lg bg-white md:rounded-lg h-25">
                    <div class="border-b font-red text-center text-sm font-semibold text-gray-600 p-4">
                        {{ localize('MainShop') }}
                    </div>
                    <div class="text-center p-6 text-gray-600 inline-block w-full">
                        <div class="w-1/2 pr-3 inline-block align-top">
                            <a href="https://subdomain.inshin.org/" target="_blank"><img src="/img/portfolio/karte.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
                        </div>
                        <div class="w-1/2 pl-3 inline-block align-top">
                            <a href="https://subdomain.inshin.org/" target="_blank"><img src="/img/portfolio/karte2.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="border shadow-lg bg-white md:rounded-lg h-25">
                    <div class="border-b font-red text-center text-sm font-semibold text-gray-600 p-4">
                        {{ localize('MainResizer') }}
                    </div>
                    <div class="text-center p-6 text-gray-600 inline-block w-full">
                        <div class="w-1/2 pr-3 inline-block align-top">
                            <a href="/resizer"><img src="/img/portfolio/resizer1.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
                        </div>
                        <div class="w-1/2 pl-3 inline-block align-top">
                            <a href="/resizer"><img src="/img/portfolio/resizer2.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="border shadow-lg bg-white md:rounded-lg h-25">
                    <div class="border-b font-red text-center text-sm font-semibold text-gray-600 p-4">
                        {{ localize('MainGame') }}
                    </div>
                    <div class="text-center p-6 text-gray-600 inline-block w-full">
                        <div class="w-1/2 pr-3 inline-block align-top">
                            <a href="/octopawn"><img src="/img/portfolio/octopawn1.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
                        </div>
                        <div class="w-1/2 pl-3 inline-block align-top">
                            <a href="/octopawn"><img src="/img/portfolio/octopawn2.jpg" class="border-2 shadow-lg cursor-pointer rounded-lg rounded-lg" alt=""></a>
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
