<template>
    <Head>
        <title>Игра - Hexapawn</title>
    </Head>
    <div class="mt-5 text-center">Here would be hexapawn game</div>
    <div class="mt-5">
        <div class="w-full hidden md:block">
            <div class="w-4 h-5 inline-block">
            </div>
            <div class="w-96 h-5 inline-block">
                <div class="w-1/3 h-full text-center inline-block">a</div>
                <div class="w-1/3 h-full text-center inline-block">b</div>
                <div class="w-1/3 h-full text-center inline-block">c</div>
            </div>
        </div>
        <div class="w-full">
            <div class="hidden w-4 md:inline-block h-96">
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
                <table class="h-full w-full border-0 border-black">
                    <tr class="h-1/3 w-full">
                        <td class="bg-stone-200 w-1/3" id="square[11]"><img @mousedown="selectFigure"
                                                                              src="/img/black.png" id="11"
                                                                              class="cursor-pointer pointer-events-auto"
                                                                              alt="black"></td>
                        <td class="bg-stone-500 w-1/3" id="square[12]"><img @mousedown="selectFigure"
                                                                              src="/img/black.png" id="12"
                                                                              class="cursor-pointer" alt="black"></td>
                        <td class="bg-stone-200 w-1/3" id="square[13]"><img @mousedown="selectFigure"
                                                                              src="/img/black.png" id="13"
                                                                              class="cursor-pointer" alt="black"></td>
                    </tr>
                    <tr class="h-1/3 w-full">
                        <td class="bg-stone-500 w-1/3" id="square[21]"><img @mousedown="selectFigure"
                                                                              src="" id="21"
                                                                              class="cursor-pointer hidden" alt="none"></td>
                        <td class="bg-stone-200 w-1/3" id="square[22]"><img @mousedown="selectFigure"
                                                                              src="" id="22"
                                                                              class="cursor-pointer hidden" alt="none"></td>
                        <td class="bg-stone-500 w-1/3" id="square[23]"><img @mousedown="selectFigure"
                                                                              src="" id="23"
                                                                              class="cursor-pointer hidden" alt="none"></td>
                    </tr>
                    <tr class="h-1/3 w-full">
                        <td class="bg-stone-200 w-1/3" id="square[31]"><img @mousedown="selectFigure"
                                                                              src="/img/white.png" id="31"
                                                                              class="cursor-pointer" alt="white"></td>
                        <td class="bg-stone-500 w-1/3" id="square[32]"><img @mousedown="selectFigure"
                                                                              src="/img/white.png" id="32"
                                                                              class="cursor-pointer" alt="white"></td>
                        <td class="bg-stone-200 w-1/3" id="square[33]"><img @mousedown="selectFigure"
                                                                              src="/img/white.png" id="33"
                                                                              class="cursor-pointer" alt="white"></td>
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
    data() {
        return {
            selectedFigureId: 0,
            squaresArray: [ 11, 12, 13, 21, 22, 23, 31, 32, 33],
            playerColor: 'white',
        }
    },
    methods: {
        selectFigure(event) {
            if (document.getElementById(event.target.id).alt===this.playerColor) {
                if (this.selectedFigureId > 0) {
                    let previousSelectedFigure = document.getElementById(this.selectedFigureId);
                    previousSelectedFigure.classList.remove('bg-cyan-400');
                }
                this.selectedFigureId = event.target.id;
                let selectedFigure = document.getElementById(this.selectedFigureId);
                selectedFigure.classList.add('bg-cyan-400');
                this.drawVariants(this.checkVariants(this.selectedFigureId, selectedFigure.alt));
            }
            else
            {
                this.clearVariants(this.squaresArray);
                if (this.selectedFigureId>0) {
                document.getElementById(this.selectedFigureId).classList.remove('bg-cyan-400');
                this.selectedFigureId = 0;
                }
            }
        },
        clearVariants(){
            this.squaresArray.forEach(function (pos) {
                document.getElementById(`square[${pos}]`).classList.remove('bg-move-variant');
            });
        },
        drawVariants(variants) {
            this.squaresArray.forEach(function (pos) {
                document.getElementById(`square[${pos}]`).classList.remove('bg-move-variant');
            });
            variants.forEach(function (pos) {
                document.getElementById(`square[${pos}]`).classList.add('bg-move-variant');
            });

        },
        checkVariants(square, color) {
            if (color !== this.playerColor) return false;
            let variantsArray = [];
            square = Number(square);
            // MOVE VARIANTS
             let target = (color === 'white') ? square - 10 : square + 10;
                if (this.squaresArray.includes(target))
                    if (!this.checkFigure(target)) variantsArray.push(target);
            //EAT VARIANTS
            let targetLeft = (color === 'white') ? square - 11 : square + 11;
            let targetRight = (color === 'white') ? square - 9 : square + 9;
                if (this.squaresArray.includes(targetLeft))
                    if (this.checkFigure(targetLeft)) variantsArray.push(targetLeft);
                if (this.squaresArray.includes(targetRight))
                    if (this.checkFigure(targetRight)) variantsArray.push(targetRight);
            return variantsArray;
        },
        checkFigure(square) {
            const figure = document.getElementById(square);
            return (figure.alt !== 'none');
        }

    },
    components: {
        Link, Head
    }
}
</script>

<style scoped>

</style>
