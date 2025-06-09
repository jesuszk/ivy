<?= $this->layout("templates/panel", []); ?>


<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(10, 1fr);
        gap: 8px;
        width: 100%;
        height: calc(100vh - 100px);
    }






    .div6 {
        grid-column: span 2 / span 2;
        grid-row: span 9 / span 9;
    }

    .div7 {
        grid-column: span 3 / span 3;
        grid-row: span 4 / span 4;
        grid-column-start: 3;
    }

    .div8 {
        grid-column: span 2 / span 2;
        grid-row: span 5 / span 5;
        grid-column-start: 3;
        grid-row-start: 6;
    }

    .div9 {
        grid-row: span 5 / span 5;
        grid-column-start: 5;
        grid-row-start: 6;
    }

    .div1 {
        background: red;
    }

    .div2 {
        background: orange;
    }

    .div3 {
        background: yellow;
    }

    .div4 {
        background: green;
    }

    .div5 {
        background: blue;
    }

    .div6 {
        background: indigo;
    }

    .div7 {
        background: violet;
    }

    .div8 {
        background: pink;
    }

    .div9 {
        background: lightgray;
    }
</style>

<div class="parent">
    <div class="div1">Melhor Hábito (que possui mais conclusões)</div>
    <div class="div2">Dias Perfeitos (Dias que todos os hábitos foram concluídos)</div>
    <div class="div3">Concluídos Hoje</div>
    <div class="div4">Concluídos Ontem</div>
    <div class="div5">Satisfação %</div>
    <div class="div6">6</div>
    <div class="div7">7</div>
    <div class="div8">8</div>
    <div class="div9">9</div>
</div>