<template>
    <Head>
        <title>Resizer</title>
    </Head>
    <div class="text-center font-bold mt-8">
        Быстрое изменение размера изображений (resizer)
    </div>
    <div ref="errorBox" class="hidden mt-4 text-center">
        <p class="bg-red-100 border-red-200 text-sm">Ошибка: не загружено изображение или не указаны целевые размеры!</p>
    </div>
    <div class="hidden" ref="progressBox">
        <div class="text-center">
            <img src="/img/spinner.gif" class="mx-auto" alt="processing images...">
        </div>
        <div class="mx-auto text-center">
            Обработка изображений...
        </div>
    </div>
    <div class="h-48 mt-3" ref="inputFormBox">
        <div class="inline-block p-6">
            <div ref="dropzone"
                 class="border-dashed cursor-pointer border-2 rounded-xl border-gray-400 p-10 w-96 align-middle text-center">
                <div class="mb-4">
                    Перетащите файлы сюда или <b>кликните</b> чтобы загрузить
                </div>
                <div class="text-gray-400 mb-5">
                    (jpg, png, gif... )
                </div>
                <div class="text-gray-400 mb-5">
                    Максимум: 20 шт., общий размер - не более 40 Мб
                </div>
                <div v-if="viewErrors.images" class="text-red-700">Не загружены файлы</div>

            </div>
        </div>
        <div class="inline-block p-6 align-top">
            <form @submit.prevent="store">
                <div class="mb-5">
                    <div class="inline-block w-48">
                        Заданная ширина (px):
                    </div>
                    <div class="inline-block">
                        <input v-model="targetWidth" class="rounded-full w-36 border-gray-400" type="number">
                    </div>
                    <div class="inline-block ml-2">
                        <a @click="keepWidth = !keepWidth" class="btn cursor-pointer"
                           :class="keepWidth ? '' : 'text-gray-100 opacity-20'"
                           title="Зафиксировать предельную ширину при изменении размера">🔒</a>
                    </div>
                    <div v-if="viewErrors.targetWidth" class="text-red-700">Не заполнено поле</div>
                </div>
                <div class="mb-5">
                    <div class="inline-block w-48">
                        Заданная высота (px):
                    </div>
                    <div class="inline-block">
                        <input v-model="targetHeight" class="rounded-full w-36 border-gray-400" type="number">
                    </div>
                    <div class="inline-block ml-2">
                        <a @click="keepHeight = !keepHeight" class="btn cursor-pointer"
                           :class="keepHeight ? '' : 'text-gray-100 opacity-20'"
                           title="Зафиксировать предельную ширину при изменении размера">🔒</a>
                    </div>
                    <div v-if="viewErrors.targetHeight" class="text-red-700">Не заполнено поле</div>
                </div>
                <div class="mb-5">
                    <div class="text-center mb-4">
                        <input v-model="keepAspectRatio" type="checkbox" value=""
                               class="w-4 h-4 text-blue-600 bg-gray-200 rounded border-gray-400 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label @click="keepAspectRatio=!keepAspectRatio" for="default-checkbox" class="cursor-pointer ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Сохранить
                            соотношение сторон</label>
                    </div>
                </div>
                <div class="mb-5">
                    <button
                        class="mx-auto block p-1 w-64 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 border rounded-full text-center text-white"
                        type="submit">Обработать изображения
                    </button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>


import {Head, Link} from "@inertiajs/inertia-vue3";
import Dropzone from 'dropzone'
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "index",
    layout: MainLayout,
    props: [
        'token'
    ],
    data() {
        return {
            dropzone: null,
            targetHeight: null,
            targetWidth: null,
            keepAspectRatio: true,
            keepHeight: false,
            keepWidth: false,
            viewErrors: {
                images: null,
                targetHeight: null,
                targetWidth: null
            }
        }
    },
    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone,
            {
                url: "/api/resizer",
                clickable: true,
                autoProcessQueue: false,
                acceptedFiles: 'image/*',
                maxFiles: 20,
                maxFilesize: 40,
                thumbnailMethod: 'contain',
                thumbnailWidth: 250,
                thumbnailHeight: 250,
                previewTemplate: '<div class="dz-preview dz-file-preview">\n' +
                    '<div class="dz-details">\n' +
                    '<img alt="thumb" data-dz-thumbnail class="mx-auto" />\n' +
                    '<div class="dz-filename text-sm"><span data-dz-name></span></div>\n' +
                    '<div class="dz-size text-sm" data-dz-size></div>\n' +
                    '</div>\n' +
                    '<div class="dz-progress mb-4"><span class="dz-upload" data-dz-uploadprogress></span></div>\n' +
                    '</div>'
            })
    },
    components: {
        Link, Head
    },
    methods: {
        store() {
            this.$refs.progressBox.classList.remove('hidden');
            this.$refs.inputFormBox.classList.add('hidden');
            const data = new FormData()
            const files = this.dropzone.getAcceptedFiles()
            files.forEach(file => {
                data.append('images[]', file)
                this.dropzone.removeFile(file);
            })
            data.append('targetHeight', this.targetHeight)
            data.append('targetWidth', this.targetWidth)
            data.append('keepHeight', this.keepHeight)
            data.append('keepWidth', this.keepWidth)
            data.append('keepAspectRatio', this.keepAspectRatio)
            axios.post('/api/resizer', data).then(res => {
                //this.$inertia.visit('/resizer/' + res.data.token)
                this.$inertia.visit('/resizer/'+res.data.token, {
                    method: 'get',
                    data: {
                        timeTaken: res.data.timeTaken
                    },
                })
            }) .catch(error => {
                this.viewErrors=error.response.data.errors
                this.$refs.progressBox.classList.add('hidden');
                this.$refs.inputFormBox.classList.remove('hidden');
            });


        },
    }

}
</script>

<style scoped>

</style>
