<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Hábito</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" method="post" action="<?= route("habit.add"); ?>">

                <div class="row g-3">
                    <div class="col-12">
                        <label for="habit_title" class="form-label text-muted">Título <span>*</span></label>
                        <input type="text" class="form-control form-control-sm" name="habit_title" id="habit_title">
                    </div>

                    <div class="col-12">
                        <label for="habit_desc" class="form-label text-muted">Descreva o seu hábito <span>*</span></label>
                        <textarea name="habit_desc" id="habit_desc" class="form-control form-control-sm"></textarea>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="habit_time" class="form-label text-muted">Horário <span>*</span></label>
                        <input type="time" name="habit_time" id="habit_time" class="form-control form-control-sm">
                    </div>

                    <div class="col-12 mt-3">
                        <div class="days-btn-container">
                            <input type="hidden" name="habit_days[seg]" value="off">
                            <input class="day-btn" name="habit_days[seg]" id="segunda" type="checkbox" checked="false" />
                            <label class="day-label" for="segunda">Seg</label>

                            <input type="hidden" name="habit_days[ter]" value="off">
                            <input class="day-btn" name="habit_days[ter]" id="terca" type="checkbox" checked="false" />
                            <label class="day-label" for="terca">Ter</label>

                            <input type="hidden" name="habit_days[qua]" value="off">
                            <input class="day-btn" name="habit_days[qua]" id="quarta" type="checkbox" checked="false" />
                            <label class="day-label" for="quarta">Qua</label>

                            <input type="hidden" name="habit_days[qui]" value="off">
                            <input class="day-btn" name="habit_days[qui]" id="quinta" type="checkbox" checked="false" />
                            <label class="day-label" for="quinta">Qui</label>

                            <input type="hidden" name="habit_days[sex]" value="off">
                            <input class="day-btn" name="habit_days[sex]" id="sexta" type="checkbox" checked="false" />
                            <label class="day-label" for="thursday">Sex</label>

                            <input type="hidden" name="habit_days[sab]" value="off">
                            <input class="day-btn" name="habit_days[sab]" id="sabado" type="checkbox" checked="false" />
                            <label class="day-label" for="sabado">Sáb</label>

                            <input type="hidden" name="habit_days[dom]" value="off">
                            <input class="day-btn" name="habit_days[dom]" id="domingo" type="checkbox" checked="false" />
                            <label class="day-label" for="domingo">Dom</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button class="btn btn-sm btn-success float-end">Salvar <i class="ph ph-plus"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>