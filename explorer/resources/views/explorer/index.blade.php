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
            <!-- Contact Section Heading-->
            <div class="col-sm-4 ">

                <div class="col-8 ">
                    <h2>Wyszukaj</h2>
                    <div class="form-group">
                        <input type="input" class="form-control" id="search" placeholder="Wyszukaj..."
                               value="">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox" id="chk-select-multi" value="false">
                            Multi Select
                        </label>
                    </div>
                    <!--<div class="checkbox">
                      <label>
                        <input type="checkbox" class="checkbox" id="chk-select-silent" value="false">
                        Silent (No events)
                      </label>
                    </div>      -->
                    <button class="btn btn-primary mb-4" id="btnSearch" onclick="search();return false;">Wyszukaj</button>
                    <button class="btn btn-primary mb-4" id="btnSearch" onclick="openTree();return false;">Rozwiń / zwiń drzewo</button>

                    <input type="text" name="id_wezla" value="" id="id_wezla" disabled>
                </div>
                <h5 class=" text-center text-uppercase  mb-4">Struktura plików</h5>

                <div class="row justify-content-center">

                </div>
                <div id="jstree">

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
                                <option selected>Wybierz..</option>
                                @foreach($name as $value)
                                    <option value="{{ $value->id }}">
                                        {{$value->name }}
                                    </option>
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
                    <input type="text" name="id_wezla" value="" id="id_wezla">
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
                                {{--                                <option selected>Wybierz..</option>--}}
                                @foreach($name as $value)
                                    <option value="{{ $value->id }}">
                                        {{$value->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" data-sb-feedback="parent_idd:required">ParentId jest wymagany.
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-primary mb-4" type="submit">Zmień</button>
                </form>


            </div>

            <div class="col">
                <h5 class=" text-uppercase ">Zmiana nazwy</h5>
                <form action="{{ route('explorer.update') }}" method="post" class="mt-3 needs-validation" novalidate
                      id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    @method('put')
                    <input type="text" name="id_wezla" value="" id="id_wezla1">
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">Element</label>
                            <input type="text" name="name" class="form-control"
                                   id="input_set"
                                   {{--                                   id="validationCustom01"--}}
                                   placeholder="Nazwa"
                                   required disabled>
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">Nowa nazwa</label>
                            <input type="text" name="newName" class="form-control"

{{--                                   id="validationCustom01"--}}
                                   placeholder="Nazwa"
                                   required>
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-primary mb-4" type="submit">Zmień</button>
                </form>

                <h5 class=" text-uppercase ">Usuń węzeł</h5>
                <form action="{{ route('explorer.delete') }}" method="post" class="mt-3 needs-validation" novalidate
                      id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    @method('delete')
                    <input type="text" name="id_wezla" value="" id="id_wezla">
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom02">Element</label>
                            <select class="form-control" id="input-set" name="id"
                                    data-sb-validations="required">
                                <option selected>Wybierz..</option>
                                @foreach($name as $value)
                                    <option value="{{ $value->id }}">
                                        {{$value->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" data-sb-feedback="parent_idd:required">ParentId jest wymagany.
                            </div>
                        </div>
                        <button class="btn btn-danger mb-4" type="submit">Usuń</button>
                    </div>
                </form>

            </div>


        </div>

    </div>



    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
        $(document).ready(function(){
            $('#jstree')
                // listen for event
                .on('changed.jstree', function (e, data) {
                    document.getElementById('id_wezla').value = data.selected[0];
                    document.getElementById('input_set').value = data.node.text;

                    document.getElementById('id_wezla1').value = data.selected[0];

                })

            // var folder_jsondata = JSON.parse($('#txt_folderjsondata').val());
            var jsondata = '<?php echo json_encode($data) ?>' ;
            jsondata = JSON.parse(jsondata);

            $('#jstree').jstree({
                'plugins': ["wholerow", "sort", "search"],
                'core' : {
                    'data' : jsondata,
                    'multiple': false
                }
            });



        });



        function search() {

            var wartosc = document.getElementById("search").value;
            $('#jstree').jstree(true).search(wartosc);

        }

        // Nasłuchiwanie klawisza Enter dla wyszukiwarki

        document.getElementById("search")
            .addEventListener("keyup", function (event) {
                event.preventDefault();
                if (event.keyCode === 13) {
                    document.getElementById("btnSearch").click();
                }
            });
        // Rozwija wszystkie gałęzie drzewa

        let open = 0;
        function openTree() {
            if (open == 0) {
                open = 1;
                $("#jstree").jstree('open_all');
            } else {
                open = 0;
                $("#jstree").jstree('close_all');
            }
        }

    </script>





@endsection
