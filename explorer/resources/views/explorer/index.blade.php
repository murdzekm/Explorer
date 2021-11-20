@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @if(session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h4 class=" text-center text-uppercase pb-4">Struktura drzewiasta</h4>
        <!-- Formularz dodawania -->
        <div class="row">
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
            </div>

            <div class="col">
                <h5 class=" text-uppercase ">Zmiana nazwy</h5>
                <form action="{{ route('explorer.update') }}" method="post" class="mt-3 needs-validation" novalidate
                      id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    @method('put')

                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom02">Rodzic</label>
                            <select class="form-control" id="id" name="id"
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

                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">Nowa nazwa</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01"
                                   placeholder="Nazwa"
                                   required>
                            <div class="invalid-feedback">
                                Pole wymagane.
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-primary mb-4" type="submit">Zmień</button>
                </form>

            </div>

            <div class="col">
                <!-- Formularz zmiany węzła -->
                <h5 class=" text-uppercase ">Zmień rodzica</h5>
                <form action="{{ route('explorer.move') }}" method="post" class="mt-3 needs-validation" novalidate
                      id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    @method('put')

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
                <h5 class=" text-uppercase ">Usuń węzeł</h5>
                <form action="{{ route('explorer.delete') }}" method="post" class="mt-3 needs-validation" novalidate
                      id="contactForm" data-sb-form-api-token="API_TOKEN">
                    @csrf
                    @method('delete')

                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom02">Rodzic</label>
                            <select class="form-control" id="id" name="id"
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


    <!-- Tree Section-->
    <section class="page-section" id="contact">
        <div class="container">
            <!-- Contact Section Heading-->
            <h5 class=" text-center text-uppercase  mb-4">Struktura plików</h5>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">ParentId</th>
                </tr>
                </thead>
                <tbody>
                @foreach($name as $value)
                    <tr>
                        <th scope="row">{{$value->id}}</th>
                        <td>{{$value->name}}</td>
                        <td>{{$value->parent_id}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="row justify-content-center">

            </div>
        </div>
    </section>

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
@endsection
