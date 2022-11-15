<template>
    <Head>
        <title>О сайте</title>
    </Head>
    <div class="mt-5">
        Сайт создан при огромной поддержке Леры.
    </div>
    <div>
        Без тебя я бы не был тем кто я есть :)
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
