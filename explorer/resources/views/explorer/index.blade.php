@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if(session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{--        <h4 class=" text-center text-uppercase pb-4">Struktura drzewiasta</h4>--}}
        <div class="row">
            <div class="col-sm-4 ">
                <div class="col-8 ">
                    <h2>Wyszukaj</h2>
                    <div class="form-group mb-3">
                        <input type="input" class="form-control" id="search" placeholder="Wyszukaj..." value="">
                    </div>
                    <button class="btn btn-primary mb-4" id="btnSearch" onclick="search();return false;">Wyszukaj</button>
                    <button class="btn btn-primary mb-4" id="btnSearch" onclick="openTree();return false;">Rozwiń / zwiń</button>
                </div>

                <h5 class=" text-center text-uppercase  mb-4">Struktura plików</h5>

                <div class="row justify-content-center">
                </div>
                <!--wygenerowanie struktury-->
                <div id="jsTree">
                </div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col">
                <h5 class=" text-uppercase ">Dodaj element</h5>
                <form action="{{ route('explorer.store') }}" method="post" class="mt-3 needs-validation" novalidate
                      id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    {{--                {{ csrf_field() }}--}}
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">Nazwa</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01"
                                   placeholder="Nazwa"
                                   required>
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom02">Rodzic</label>
                            <select class="form-control" id="parent_id" name="parent_id"
                                    data-sb-validations="required">
                                <option selected value="1">Wybierz..</option>
                                @foreach($name as $value)
                                    <option value="{{ $value->id }}">{{$value->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" data-sb-feedback="parent_idd:required">ParentId jest wymagany.
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mb-4" type="submit">Zapisz</button>
                </form>

                <!-- Formularz zmiany węzła -->
                <h5 class=" text-uppercase ">Zmień rodzica</h5>
                <form action="{{ route('explorer.move') }}" method="post" class="mt-3 needs-validation" novalidate
                      id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="" id="element3">
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">Nazwa</label>
                            <input type="text" name="name" class="form-control" id="inputSet2" placeholder="Nazwa" required >
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom02">Nowy rodzic</label>
                            <select class="form-control" id="parent_id" name="parent_id"
                                    data-sb-validations="required">
                                @foreach($name as $value)
                                    <option value="{{ $value->id }}"> {{$value->name }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" data-sb-feedback="parent_id:required">ParentId jest wymagany.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mb-4" type="submit">Zmień</button>
                </form>
            </div>

            <!-- Formularz zmiany nazwy elemenu -->
            <div class="col">
                <h5 class=" text-uppercase ">Zmiana nazwy</h5>
                <form action="{{ route('explorer.update') }}" method="post" class="mt-3 needs-validation" novalidate id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="" id="element1">
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">Element</label>
                            <input type="text" name="name" class="form-control" id="inputSet" placeholder="Nazwa" required >
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">Nowa nazwa</label>
                            <input type="text" name="new" class="form-control"  placeholder="Nazwa" required>
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mb-4" type="submit">Zmień</button>
                </form>

                <!-- Usuwanie węzła -->
                <h5 class=" text-uppercase ">Usuń węzeł</h5>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom02">Element</label>
                            <input type="text" name="name" class="form-control" id="inputSet3" placeholder="Nazwa" required disabled>
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                            <div class="invalid-feedback" data-sb-feedback="parent_idd:required">ParentId jest wymagany.
                            </div>
                        </div>
                        <button class="btn btn-danger mb-4" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Usuń</button>
                    </div>


                <!-- Okno potwierdzenia usunięcia węzła  -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Usuwanie węzła</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('explorer.delete') }}" method="post" class="mt-3 needs-validation" novalidate
                                  id="contactForm" data-sb-form-api-token="API_TOKEN">
                                @csrf
                                @method('delete')
                            <div class="modal-body">
                                    <input type="hidden" name="id" id="element2" value="">
                                    <input type="hidden" name="name" id="inputSet5">
                                Czy na pewno chcesz usunąć węzeł <strong id="inputSet4"></strong> i jego potomków?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                <button type="submit" class="btn btn-primary">Potwierdź</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        // Implementajca walidacji formularza po stronie klienta przy użyciu Bootstrap 5
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script>
        $(document).ready(function () {
            $('#jsTree')
                // Przekazanie wartości/tekstu do elementów
                .on('changed.jstree', function (e, data) {
                    document.getElementById('element1').value = data.selected[0];
                    document.getElementById('element2').value = data.selected[0];
                    document.getElementById('element3').value = data.selected[0];

                    document.getElementById('inputSet').value = data.node.text;
                    document.getElementById('inputSet2').value = data.node.text;
                    document.getElementById('inputSet3').value = data.node.text;
                    document.getElementById('inputSet4').innerText  = data.node.text;
                    document.getElementById('inputSet5').value  = data.node.text;
                })

            // var jsondata = JSON.parse($('#txt_jsondata').val());
            let jsondata = '<?php echo json_encode($data) ?>';
            jsondata = JSON.parse(jsondata);
            $('#jsTree').jstree({
                'plugins': ["wholerow", "sort", "search"],
                'core': {
                    'data': jsondata,
                    'multiple': false
                }
            });
        });
        //Wyszukiwanie w strukturze
        function search() {
            let wartosc = document.getElementById("search").value;
            $('#jsTree').jstree(true).search(wartosc);
        }

        // Nasłuchiwanie klawisza Enter do wyszukiwania elementu w strukturze
        document.getElementById("search")
            .addEventListener("keyup", function (event) {
                event.preventDefault();
                if (event.keyCode === 13) {
                    document.getElementById("btnSearch").click();
                }
            });

        // Rozwijanie/zwijanie całej struktury
        let open = 0;
        function openTree() {
            if (open == 0) {
                open = 1;
                $("#jsTree").jstree('open_all');
            } else {
                open = 0;
                $("#jsTree").jstree('close_all');
            }
        }
    </script>
@endsection
