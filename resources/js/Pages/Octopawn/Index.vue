<template>
    <Head >
        <title>{{ localize('Game') }} - Octopawn</title>
    </Head>

    <div class="px-0 p-6 md:px-6 mt-10 max-w-screen-lg border bg-white shadow-lg rounded-xl">
    <div>
        <div class="mt-5 ml-4 text-center text-lg font-bold">Оctopawn</div>
        <div class="text-center text-xs mt-5 ml-4 whitespace-normal mb-3 font-semibold">
            <button @click="changeSize(3)"
                    :class="{'bg-blue-200' : this.fieldSize === 3 }"
                    class="mx-auto block p-1 mr-3 w-14 md:w-20 bg-white hover:bg-blue-300 text-base rounded-lg focus:ring-blue-300 border border-blue-800 text-center text-blue-800 inline-block"
                    type="submit">3x3
            </button>
            <button @click="changeSize(4)"
                    :class="{'bg-blue-200' : this.fieldSize === 4 }"
                    class="mx-auto block p-1 mr-3 w-14 md:w-20 bg-white hover:bg-blue-300 text-base rounded-lg focus:ring-blue-300 border border-blue-800 text-center text-blue-800 inline-block"
                    type="submit">4x4
            </button>
            <button @click="changeSize(5)"
                    :class="{'bg-blue-200' : this.fieldSize === 5 }"
                    class="mx-auto block p-1 mr-3 w-14 md:w-20 bg-white hover:bg-blue-300 text-base rounded-lg focus:ring-blue-300 border border-blue-800 text-center text-blue-800 inline-block"
                    type="submit">5x5
            </button>
            <button @click="changeSize(999)"
                    :class="{'bg-blue-200' : this.fieldSize === 999 }"
                    class="mx-auto block p-1 mr-3 w-16 md:w-20 bg-white hover:bg-blue-300 text-base rounded-lg focus:ring-blue-300 border border-blue-800 text-center text-blue-800 inline-block"
                    type="submit">fantasy
            </button>
        </div>
        <div class="text-center text-xs mt-2 ml-4 whitespace-normal mb-4 font-semibold">
            <button @click="changeDifficulty(0)"
                    :class="{'bg-blue-200' : this.difficulty === 0 }"
                    class="mx-auto block p-1 mr-3 w-32 bg-white hover:bg-blue-300 text-base rounded-lg focus:ring-blue-300 border border-blue-800 text-center text-blue-800 inline-block"
                    type="submit">{{ localize('AIEasy') }}
            </button>
            <button @click="changeDifficulty(1)"
                    :class="{'bg-blue-200' : this.difficulty === 1 }"
                    class="mx-auto block p-1 mr-3 w-32 bg-white hover:bg-blue-300 text-base rounded-lg focus:ring-blue-300 border border-blue-800 text-center text-blue-800 inline-block"
                    type="submit">{{ localize('AIHard') }}
            </button>
        </div>
    </div>
    <div class="p-5 mt-2">
        <div class="w-full hidden md:block ai-move">
            <div class="w-4 h-5 inline-block">
            </div>
            <div class="w-72 md:w-96 h-5 inline-block">
                <div v-for="index in squareSize"
                     :class="'w-1/' + squareSize + ' h-full text-center inline-block'">{{ letterNum(index) }}
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="hidden w-4 md:inline-block h-72 md:h-96">
                <table class="h-full w-full">
                    <tr v-for="index in squareSize">
                        <td>{{ squareSize - index + 1 }}</td>
                    </tr>
                </table>
            </div>
            <div class="w-72 h-72 md:w-96 md:h-96 inline-block">
                <input type="hidden" class="bg-stone-500 w-1/3"><input type="hidden"
                                                                       class="bg-stone-200 w-1/4 w-1/6"><input
                type="hidden" class="bg-stone-200 w-1/5">
                <table class="h-full w-full border-0 border-black">
                    <tr v-for="(rows,index1) in startingField" :class="'h-1/'+squareSize+' w-full'">
                        <td v-for="(row,index2) in rows"
                            :class="'bg-stone-' + (5 - (index1+index2+1) % 2 * 3) +'00 bg-contain w-1/'+squareSize"
                            :id="'square['+String(index1+1)+String(index2+1)+']'">
                            <img v-if="(row!=='none')" :id="String(index1+1)+String(index2+1)" @mousedown="selectFigure"
                                 :src="'/img/'+row+'.png'" class="cursor-pointer" :alt="row">
                            <img v-else @mousedown="selectFigure" :id="String(index1+1)+String(index2+1)"
                                 :src="'/img/'+row+'.png'" class=""
                                 alt="none"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-center text-lg text-green-800 font-bold w-72 md:w-96 mt-5 ml-2 hidden" id="playerWinsBlock">
            {{ localize('YouWon') }} ({{ localize('score') }} 1-0)
        </div>
        <div class="text-center text-lg text-red-800 font-bold w-72 md:w-96 mt-5 ml-2 hidden" id="aiWinsBlock">
            {{ localize('AIWins') }} ({{ localize('score') }} 1-0)
        </div>
        <div class="text-center text-lg text-red-800 font-bold w-72 md:w-96 mt-5 ml-2 hidden" id="newGameButton">
            <button @click="newGame"
                    class="mx-auto block p-1 mr-3 w-40 md:ml-3 bg-white hover:bg-blue-300 focus:ring-4 text-base rounded-lg focus:ring-blue-300 border border-blue-800 text-center text-blue-800 inline-block"
                    type="submit">{{ localize('NewGame') }}
            </button>
        </div>
        <div class="text-center text-xs mt-5 text-gray-400 whitespace-normal w-72 md:w-96" id="serverResponse">
        </div>
    </div>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import localizeFilter from "@/Filters/localize";

export default {
    name: "index",
    layout: MainLayout,
    props: [
        'startingField', 'squareSize', 'playerColor', 'difficulty', 'fieldSize'
    ],
    data() {
        return {
            selectedFigureId: 0,
            aiFigureId: 0,
            gameScore: [0, 0],
            variantsArray: [],
            squaresArray: [],
            situationBoard: [],
            difficultyButton: 0,
            playerMove: true,
            pawnMoves: [[1, -1, true], [-1, -1, true], [0, -1, false]],
            spiderMoves: [[0, -1, false], [0, 1, false], [-1, 0, false], [1, 0, false],
                [1, -1, false], [-1, -1, false], [-1, 1, false], [1, 1, false],
                [0, -1, true], [0, 1, true], [-1, 0, true], [1, 0, true],
                [1, -1, true], [-1, -1, true], [-1, 1, true], [1, 1, true]],
        }
    },
    mounted() {
        this.generateSquaresArray();
    },
    methods: {
        localize(key) {
            return localizeFilter(key, window.lang || 'ru-RU')
        },
        changeDifficulty(difficulty) {
            if (this.difficulty !== difficulty) {
                this.$inertia.visit('/octopawn', {
                    method: 'post',
                    data: {
                        fieldSize: this.fieldSize,
                        difficulty: difficulty
                    },
                });
            }
        },
        changeSize(size) {
            if (this.fieldSize !== size) {
                this.$inertia.visit('/octopawn', {
                    method: 'post',
                    data: {
                        fieldSize: size,
                        difficulty: this.difficulty,
                    },
                });
            }
        },
        newGame() {
            let pos = 0;
            for (let y = 0; y < this.squareSize; y++) {
                for (let x = 0; x < this.squareSize; x++) {
                    pos = (y + 1) * 10 + x + 1;
                    document.getElementById(pos).alt = this.startingField[y][x];
                    document.getElementById(pos).src = `/img/${this.startingField[y][x]}.png`;
                }
            }
            this.playerMove = true;
            document.getElementById('aiWinsBlock').classList.add('hidden');
            document.getElementById('playerWinsBlock').classList.add('hidden');
            document.getElementById('serverResponse').classList.remove('hidden');
            document.getElementById('serverResponse').innerHTML = '';
            document.getElementById('newGameButton').classList.add('hidden');
        },
        selectFigure(event) {
            if (!this.playerMove) return;
            const target = event.target.id;
            if (this.selectedFigureId > 0 && this.variantsArray.includes(Number(target))) {
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
                if (pos !== exclude) {
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
                    array1[y][x] = document.getElementById(String((y + 1) * 10 + (x + 1))).alt;
                }
            }
            return array1;
        },
        drawInfoBlock(data) {
            let score = data [0];
            const timeTaken = data [3];
            const speed = data [4];
            let advantageText = '';
            switch (true) {
                case score >= 9000:
                    advantageText = this.localize('WhiteWillWin');
                    break;
                case score >= 1:
                    advantageText = this.localize('WhiteAdv');
                    break;
                case score >= -0.999:
                    advantageText = this.localize('EqualGame');
                    break;
                case score >= -9000:
                    advantageText = this.localize('BlackAdv');
                    break;
                default:
                    advantageText = this.localize('BlackWillWin');
            }
            document.getElementById('serverResponse').innerHTML = `${advantageText} (${score}) - ${this.localize('score')} ${this.gameScore[0]}-${this.gameScore[1]} - ${timeTaken} sec. - ${speed} b/s.`;
        },
        moveFigure(figure, targetSquare) {
            document.getElementById(targetSquare).alt = document.getElementById(figure).alt;
            document.getElementById(targetSquare).src = document.getElementById(figure).src;
            document.getElementById(targetSquare).classList.add('cursor-pointer');
            document.getElementById(figure).alt = 'none';
            document.getElementById(figure).classList.remove('cursor-pointer');
            document.getElementById(figure).src = '/img/none.png';
            document.getElementById(figure).classList.remove('bg-cyan-400');
            this.clearVariants(targetSquare);
            this.selectedFigureId = 0;
            this.playerMove = !this.playerMove;
            console.log(this.aiFigureId);
            if (this.aiFigureId > 0)
                document.getElementById(`square[${this.aiFigureId}]`).classList.remove('bg-move-ai');
            if (!this.ifEndGame(this.oppColor(this.playerColor))) {
                axios.post('/api/octopawn', {
                    boardSituation: this.boardSituation(),
                    color: this.oppColor(this.playerColor),
                    difficulty: this.difficulty,
                    fieldSize: this.fieldSize,
                })
                    .then(res => {
                        this.drawInfoBlock(res.data);
                        const figure = (res.data[1][1] + 1) * 10 + res.data[1][0] + 1;
                        const targetSquare = (res.data[1][3] + 1) * 10 + res.data[1][2] + 1;
                        console.log(res.data);
                        this.moveAIFigure(figure, targetSquare);
                    })
                    .catch(error => document.getElementById('serverResponse').innerHTML = error);
            }
        },
        moveAIFigure(figure, targetSquare) {
            this.aiFigureId = targetSquare;
            console.log(this.aiFigureId);
            document.getElementById(targetSquare).alt = document.getElementById(figure).alt;
            document.getElementById(targetSquare).src = document.getElementById(figure).src;
            document.getElementById(targetSquare).classList.add('cursor-pointer');
            document.getElementById(figure).alt = 'none';
            document.getElementById(figure).classList.remove('cursor-pointer');
            document.getElementById(figure).src = '/img/none.png';
            document.getElementById(figure).classList.remove('bg-cyan-400');
            this.clearVariants(targetSquare);
            document.getElementById(targetSquare).classList.add('move-variant');
            document.getElementById(`square[${targetSquare}]`).classList.add('bg-move-ai');
            this.selectedFigureId = 0;
            this.playerMove = !this.playerMove;
            this.ifEndGame(this.playerColor);
        },
        drawVariants(variants) {
            this.squaresArray.forEach(function (pos) {
                document.getElementById(`square[${pos}]`).classList.remove('bg-move-variant');
            });
            if (this.aiFigureId) {
                document.getElementById(`square[${this.aiFigureId}]`).classList.add('bg-move-ai');
            }
            variants.forEach(function (pos) {
                document.getElementById(`square[${pos}]`).classList.add('bg-move-variant', 'cursor-pointer');
                document.getElementById(`square[${pos}]`).classList.remove('bg-move-ai');
            });

        },
        checkVariants(square, color) {
            this.variantsArray = [];
            //if (color !== this.playerColor) return false;
            square = Number(square);
            // MOVE VARIANTS
            const target = (color.includes('white')) ? square - 10 : square + 10;
            if (this.squaresArray.includes(target))
                if (this.checkFigure(target) === 'none') this.variantsArray.push(target);
            //EAT VARIANTS
            const targetLeft = (color.includes('white')) ? square - 11 : square + 11;
            const targetRight = (color.includes('white')) ? square - 9 : square + 9;
            //console.log(square, color, this.oppColor(color), target,targetLeft,targetRight);
            if (this.squaresArray.includes(targetLeft))
                if (this.checkFigure(targetLeft).includes(this.oppColor(color))) this.variantsArray.push(targetLeft);
            if (this.squaresArray.includes(targetRight))
                if (this.checkFigure(targetRight).includes(this.oppColor(color))) this.variantsArray.push(targetRight);
            return this.variantsArray;
        },
        ifEndGame(color) {
            const isEndGame = this.checkEndGame(color);
            if (isEndGame) {
                switch (isEndGame) {
                    case "white":
                        document.getElementById('playerWinsBlock').classList.remove('hidden');
                        this.gameScore[0]++;
                        document.getElementById('playerWinsBlock').innerHTML = `${this.localize('YouWon')} (${this.localize('score')} ${this.gameScore[0]}:${this.gameScore[1]})`;
                        this.playerMove = false;
                        break;
                    case "black":
                        document.getElementById('aiWinsBlock').classList.remove('hidden');
                        this.gameScore[1]++;
                        this.playerMove = false;
                        document.getElementById('aiWinsBlock').innerHTML = `${this.localize('AIWins')} (${this.localize('score')} ${this.gameScore[0]}:${this.gameScore[1]})`;
                        break;
                }
                document.getElementById('newGameButton').classList.remove('hidden');
                document.getElementById('serverResponse').classList.add('hidden');
                return true;
            }
            return false;
        },
        checkEndGame(color) {
            const boardSituation = this.boardSituation();
            let variants = 0;
            for (let x = 0; x < this.squareSize; x++) {
                if (boardSituation[0][x] === 'white') return 'white';
                if (boardSituation[this.squareSize - 1][x] === 'black') return 'black';
                for (let y = 0; y < this.squareSize; y++) {
                    if (boardSituation[y][x].includes(color)) {
                        if (this.checkVariants((y + 1) * 10 + x + 1, color).length > 0 || boardSituation[y][x] === 'black spider') {
                            variants++;
                        }
                    }
                }
            }
            if (variants === 0) {
                return this.oppColor(color);
            }
            return null;
        },
        checkFigure(square) {
            return document.getElementById(square).alt;
        },
        oppColor(color) {
            return (color === 'white') ? 'black' : 'white';
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
