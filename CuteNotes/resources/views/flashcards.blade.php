@extends('layouts.app')

@section('title', 'Flashcards')

@section('content')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
.unit-card {
    background:#fff;
    border-radius:16px;
    padding:18px;
    box-shadow:0 4px 14px rgba(0,0,0,.08);
    cursor:pointer;
    transition:.2s;
}
.unit-card:hover {
    transform:translateY(-4px);
}

.flashcard-study {
    perspective:1200px;
}

.flashcard-inner {
    height:260px;
    transition:transform .6s;
    transform-style:preserve-3d;
    position:relative;
}

.flashcard-inner.flipped {
    transform:rotateY(180deg);
}

.flashcard-face {
    position:absolute;
    inset:0;
    background:#fff7e6;
    border-radius:20px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px;
    font-weight:600;
    padding:25px;
    backface-visibility:hidden;
    box-shadow:0 12px 28px rgba(0,0,0,.15);
}

.flashcard-back {
    background:#ffffff;
    transform:rotateY(180deg);
}
</style>

<h4 class="mb-4">Flashcards</h4>

<button class="btn btn-primary mb-4" data-toggle="modal" data-target="#createModal">
    + Crear unidad
</button>

<div class="row">
@foreach($categories as $cat)
    <div class="col-md-4 mb-3">
        <div class="unit-card text-center"
             onclick="openFlashcard({{ $cat->id }})">
            <strong>{{ $cat->name }}</strong>
        </div>
    </div>
@endforeach
</div>

{{-- MODAL CREAR --}}
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form method="POST" action="{{ route('flashcards.store') }}" class="modal-content p-4">
            @csrf

            <h5>Crear unidad</h5>

            <input class="form-control my-3" name="category_name"
                   placeholder="Título" required>

            <div id="items">
                <div class="mb-3">
                    <textarea name="question[]" class="form-control mb-2"
                              placeholder="Concepto" required></textarea>
                    <textarea name="answer[]" class="form-control"
                              placeholder="Definición" required></textarea>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary"
                    onclick="addRow()">+ Agregar tarjeta</button>

            <div class="text-right mt-3">
                <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL ESTUDIO --}}
<div class="modal fade" id="studyModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 text-center">

            <h5 id="unitTitle"></h5>

            <div class="flashcard-study mt-4" onclick="flipCard()">
                <div class="flashcard-inner" id="cardInner">
                    <div class="flashcard-face" id="cardFront"></div>
                    <div class="flashcard-face flashcard-back" id="cardBack"></div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-light text-danger btn-lg" onclick="nextCard()">✕</button>
                <button class="btn btn-light text-success btn-lg" onclick="nextCard()">✓</button>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let cards=[], index=0;

function addRow(){
    document.getElementById('items').insertAdjacentHTML('beforeend', `
        <div class="mb-3">
            <textarea name="question[]" class="form-control mb-2" placeholder="Concepto" required></textarea>
            <textarea name="answer[]" class="form-control" placeholder="Definición" required></textarea>
        </div>
    `);
}

function openFlashcard(id){
    fetch(`/flashcards/${id}`)
        .then(r=>r.json())
        .then(data=>{
            cards=data.cards;
            index=0;
            unitTitle.innerText=data.category.name;
            loadCard();
            $('#studyModal').modal('show');
        });
}

function loadCard(){
    if(index>=cards.length){
        $('#studyModal').modal('hide');
        return;
    }
    cardInner.classList.remove('flipped');
    cardFront.innerText=cards[index].question;
    cardBack.innerText=cards[index].answer;
}

function flipCard(){
    cardInner.classList.toggle('flipped');
}

function nextCard(){
    index++;
    loadCard();
}
</script>

@endsection
