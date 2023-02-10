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
                <input type="hidden" class="bg-stone-500 w-1/3"><input type="hidden" class="bg-stone-200 w-1/4"><input type="hidden" class="bg-stone-200 w-1/5">
                <table class="h-full w-full border-0 border-black">
                    <tr v-for="(rows,index1) in startingField" :class="'h-1/'+squareSize+' w-full'">
                        <td v-for="(row,index2) in rows"
                            :class="'bg-stone-' + (5 - (index1+index2+1) % 2 * 3) +'00 bg-contain w-1/'+squareSize"
                            :id="'square['+String(index1+1)+String(index2+1)+']'">
                            <img v-if="(row!=='none')" :id="String(index1+1)+String(index2+1)" @mousedown="selectFigure"
                                 :src="'/img/'+row+'.png'" class="cursor-pointer" :alt="row">
                            <img v-else @mousedown="selectFigure" :id="String(index1+1)+String(index2+1)" :src="'/img/'+row+'.png'" class=""
                                 alt="none"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-center text-xs mt-10 whitespace-normal w-96" id="serverResponse">
            Server response
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
        'startingField', 'squareSize', 'playerColor'
    ],
    data() {
        return {
            selectedFigureId: 0,
            variantsArray: [],
            squaresArray: [],
            situationBoard: [],
            playerMove: true,
        }
    },
    mounted() {
        this.generateSquaresArray();
    },
    methods: {
        selectFigure(event) {
            if (!this.playerMove) return;
            const target = event.target.id;
            if (this.selectedFigureId>0 && this.variantsArray.includes(Number(target))) {
                this.moveFigure(this.selectedFigureId, target);
            } else if (document.getElementById(target).alt === this.playerColor) {
                if (this.selectedFigureId > 0)
                    this.unmarkCursor();
                this.selectedFigureId = target;
                let selectedFigure = document.getElementById(target);

                selectedFigure.classList.add('bg-cyan-400');
                this.drawVariants(this.checkVariants(this.selectedFigureId, selectedFigure.alt));
            } else {
                this.clearVariants();
                if (this.selectedFigureId > 0) {
                    this.unmarkCursor();
                    this.selectedFigureId = 0;
                }

            }
        },
        unmarkCursor() {
            document.getElementById(this.selectedFigureId).classList.remove('bg-cyan-400');
        },
        clearVariants(exclude) {
            this.squaresArray.forEach(function (pos) {
                if (pos!==exclude) {
                    if (document.getElementById(pos).alt === 'none')
                        document.getElementById(`square[${pos}]`).classList.remove('cursor-pointer');
                    document.getElementById(`square[${pos}]`).classList.remove('bg-move-variant');
                }
            });
        },
        boardSituation() {
            let array1 = [];
            for (let y = 0; y < this.squareSize; y++) {
                array1[y] = [];
                for (let x = 0; x < this.squareSize; x++) {
                    array1[y][x]=document.getElementById(String((y+1) * 10 + (x+1))).alt;
                }
            }
            return array1;
        },
        moveFigure(figure, targetSquare) {

            document.getElementById(targetSquare).alt = document.getElementById(figure).alt;
            document.getElementById(targetSquare).src = document.getElementById(figure).src;
            document.getElementById(targetSquare).classList.add('cursor-pointer');
            document.getElementById(figure).alt = 'none';
            document.getElementById(figure).classList.remove('cursor-pointer');
            document.getElementById(figure).src='/img/none.png';
            document.getElementById(figure).classList.remove('bg-cyan-400');
            this.clearVariants(targetSquare);
            this.selectedFigureId=0;
            this.playerMove=!this.playerMove;
            axios.post('/api/octopawn', {boardSituation: this.boardSituation(), color: this.oppColor(this.playerColor)})
                .then(res => {
                    document.getElementById('serverResponse').innerHTML = JSON.stringify(res.data);
                    console.log(res.data);
                    const figure = (res.data[1][1]+1)*10+res.data[1][0]+1;
                    console.log(figure);
                    const targetSquare = (res.data[1][3]+1)*10+res.data[1][2]+1;
                    //this.moveAIFigure(figure, targetSquare);
                })
                .catch(error => document.getElementById('serverResponse').innerHTML= error);
        },
        moveAIFigure(figure, targetSquare) {
            document.getElementById(targetSquare).alt = document.getElementById(figure).alt;
            document.getElementById(targetSquare).src = document.getElementById(figure).src;
            document.getElementById(targetSquare).classList.add('cursor-pointer');
            document.getElementById(figure).alt = 'none';
            document.getElementById(figure).classList.remove('cursor-pointer');
            document.getElementById(figure).src='/img/none.png';
            document.getElementById(figure).classList.remove('bg-cyan-400');
            this.clearVariants(targetSquare);
            this.selectedFigureId=0;
            this.playerMove=!this.playerMove;
        },
        drawVariants(variants) {
            this.squaresArray.forEach(function (pos) {
                document.getElementById(`square[${pos}]`).classList.remove('bg-move-variant');
            });
            variants.forEach(function (pos) {
                document.getElementById(`square[${pos}]`).classList.add('bg-move-variant', 'cursor-pointer');
            });

        },
        checkVariants(square, color) {
            this.variantsArray = [];
            if (color !== this.playerColor) return false;
            square = Number(square);
            // MOVE VARIANTS
            const target = (color === 'white') ? square - 10 : square + 10;
            if (this.squaresArray.includes(target))
                if (this.checkFigure(target) === 'none') this.variantsArray.push(target);
            //EAT VARIANTS
            const targetLeft = (color === 'white') ? square - 11 : square + 11;
            const targetRight = (color === 'white') ? square - 9 : square + 9;
            if (this.squaresArray.includes(targetLeft))
                if (this.checkFigure(targetLeft) === this.oppColor(color)) this.variantsArray.push(targetLeft);
            if (this.squaresArray.includes(targetRight))
                if (this.checkFigure(targetRight) === this.oppColor(color)) this.variantsArray.push(targetRight);
            return this.variantsArray;
        },
        checkEndGame(color){


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
                    this.squaresArray.push(y * 10 + x);
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
