<template>
    <Head>
        <title>Игра - Octopawn</title>
    </Head>
    <div class="mt-5 text-center">Here will be octopawn game</div>
    <div class="mt-5">
        <div class="w-full hidden md:block">
            <div class="w-4 h-5 inline-block">
            </div>
            <div class="w-96 h-5 inline-block">
                <div v-for="index in squareSize"
                     :class="'w-1/' + squareSize + ' h-full text-center inline-block'">{{ letterNum(index) }}
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="hidden w-4 md:inline-block h-96">
                <table class="h-full w-full">
                    <tr v-for="index in squareSize">
                        <td>{{ squareSize - index + 1 }}</td>
                    </tr>
                </table>
            </div>
            <div class="w-96 h-96 inline-block">
                <input type="hidden" class="bg-stone-500 w-1/3"><input type="hidden" class="bg-stone-200 w-1/4">
                <table class="h-full w-full border-0 border-black">
                    <tr v-for="(rows,index1,index3) in startingField" :class="'h-1/'+squareSize+' w-full'">
                        <td v-for="(row,index2) in rows"
                            :class="'bg-stone-' + (5 - ++index3 % 2 * 3) +'00 bg-contain w-1/'+squareSize"
                            :id="'square['+index1+index2+']'">
                            <img v-if="(row!=='none')" :id="index1+index2" @mousedown="selectFigure"
                                 :src="'/img/'+row+'.png'" class="cursor-pointer" :alt="row">
                            <img v-else @mousedown="selectFigure" :id="index1+index2" :src="'/img/'+row+'.png'" class=""
                                 alt="none"></td>
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
    props: [
        'startingField', 'squareSize'
    ],
    data() {
        return {
            selectedFigureId: 0,
            squaresArray: [],
            playerColor: 'white',
        }
    },
    mounted() {
        this.generateSquaresArray();
    },
    methods: {
        selectFigure(event) {
            if (document.getElementById(event.target.id).alt === this.playerColor) {
                if (this.selectedFigureId > 0)
                    this.unmarkCursor();
                this.selectedFigureId = event.target.id;
                let selectedFigure = document.getElementById(this.selectedFigureId);

                selectedFigure.classList.add('bg-cyan-400');
                this.drawVariants(this.checkVariants(this.selectedFigureId, selectedFigure.alt));
            } else {
                this.clearVariants(this.squaresArray);
                if (this.selectedFigureId > 0) {
                    this.unmarkCursor();
                    this.selectedFigureId = 0;
                }
            }
        },
        unmarkCursor() {
            document.getElementById(this.selectedFigureId).classList.remove('bg-cyan-400');
        },
        clearVariants() {
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
            const target = (color === 'white') ? square - 10 : square + 10;
            if (this.squaresArray.includes(target))
                if (this.checkFigure(target)==='none') variantsArray.push(target);
            //EAT VARIANTS
            const targetLeft = (color === 'white') ? square - 11 : square + 11;
            const targetRight = (color === 'white') ? square - 9 : square + 9;
            if (this.squaresArray.includes(targetLeft))
                if (this.checkFigure(targetLeft) === this.oppColor(color)) variantsArray.push(targetLeft);
            if (this.squaresArray.includes(targetRight))
                if (this.checkFigure(targetRight) === this.oppColor(color)) variantsArray.push(targetRight);
            return variantsArray;
        },
        checkFigure(square) {
            return document.getElementById(square).alt;
        },
        oppColor(color) {
            return (color === 'white') ? 'black' : color;
        },
        letterNum(numb) {
            const letArray = {
                1: 'a',
                2: 'b',
                3: 'c',
                4: 'd',
                5: 'e',
                6: 'f',
                7: 'g',
                8: 'h',
            };
            return letArray[numb];
        },
        generateSquaresArray() {
            for (let y = 1; y <= this.squareSize; y++) {
                for (let x = 1; x <= this.squareSize; x++) {
                    this.squaresArray.push(y*10+x);
                }
            }
        }
    },
    components: {
        Link, Head
    }
}
</script>

<style scoped>

</style>
