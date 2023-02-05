<template>
    <Head>
        <title>Игра - Hexapawn</title>
    </Head>
    <div class="mt-5 text-center">Here would be hexapawn game</div>
    <div class="mt-5">
        <div>
            <div class="w-4 h-5 inline-block">
            </div>
            <div class="w-96 h-5 inline-block">
                <div class="w-1/3 h-full text-center inline-block">a</div>
                <div class="w-1/3 h-full text-center inline-block">b</div>
                <div class="w-1/3 h-full text-center inline-block">c</div>
            </div>
        </div>
        <div>
            <div class="w-4 h-96 inline-block">
                <table class="h-full w-full">
                    <tr>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>1</td>
                    </tr>
                </table>
            </div>
            <div class="w-96 h-96 inline-block">
                <table class="h-full w-full border-4 border-black">
                    <tr class="h-1/3 w-full">
                        <td class="bg-stone-200 w-1/3 bg-[url('/img/black.png')]"></td><td class="bg-stone-500 w-1/3 bg-[url('/img/black.png')]"></td><td class="bg-stone-200 w-1/3 bg-[url('/img/black.png')]"></td>
                    </tr>
                    <tr class="h-1/3 w-full">
                        <td class="bg-stone-500 w-1/3"></td><td class="bg-stone-200 w-1/3"></td><td class="bg-stone-500 w-1/3"></td>
                    </tr>
                    <tr class="h-1/3 w-full">
                        <td class="bg-stone-200 w-1/3 bg-[url('/img/white.png')]"></td><td class="bg-stone-500 w-1/3 bg-[url('/img/white.png')]"></td><td class="bg-stone-200 w-1/3 bg-[url('/img/white.png')]"></td>
                    </tr>
                </table>
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
    }
}
</script>

<style scoped>

</style>
