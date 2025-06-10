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
</style>




<style>
    .cp-styled {
        border: 1px solid #ccc;
        background-color: #fff;
    }

    .habit-champion {
        background: #fff;
        color: black;
        border-radius: 12px;
        padding: 1rem;
        transition: transform 0.4s ease;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .habit-champion .hc-icon {
        margin-right: 10px;
        background: #F3FBCD;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .habit-champion .hc-habit-count {
        margin-left: 1rem;
    }

    .habit-champion .hc-habit-count .hc-habit {
        font-weight: bold;
        color: rgb(163, 163, 163);
    }
</style>


<div class="parent">
    <div class="cp-styled habit-champion">
        <div class="hc-icon">🏆</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Leitura</div>
            <div class="hc-count"><b>245</b> dias seguidos</div>
        </div>
    </div>

    <div class="cp-styled habit-champion">
        <div class="hc-icon">👻</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Passear com Olga</div>
            <div class="hc-count"><b>12</b> dias atrás</div>
        </div>
    </div>

    <div class="cp-styled habit-champion">
        <div class="hc-icon">🎉</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Concluídos Hoje</div>
            <div class="hc-count"><b>24</b> Hábitos</div>
        </div>
    </div>


    <div class="cp-styled habit-champion">
        <div class="hc-icon">🤨</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Pendentes Hoje</div>
            <div class="hc-count"><b>13</b> hábitos</div>
        </div>
    </div>

    <div class="cp-styled habit-champion">
        <div class="hc-icon">🎉</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Ativos</div>
            <div class="hc-count"><b>20</b> hábitos ativos</div>
        </div>
    </div>







    <div class="div6">6</div>
    <div class="div7">7</div>
    <div class="div8">8</div>
    <div class="div9">9</div>
</div>