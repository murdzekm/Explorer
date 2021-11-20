@extends('layouts.app')

@section('content')

        <div class="container mt-5">
            <!-- Contact Section Heading-->
            <h4 class=" text-center text-uppercase ">Struktura drzewiasta</h4>
            <form action="{{ route('explorer.store') }}" method="post" class="mt-3 needs-validation" novalidate id="contactForm" data-sb-form-api-token="API_TOKEN">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">Login</label>
                    <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Nazwa"
                           required>
                    <div class="invalid-feedback">
                        Pole wymaganee.
                    </div>
                </div>


                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Rodzic</label>
                    <input type="text" name="parent_id" class="form-control" id="validationCustom01"
                           placeholder="ParentId" required>
                    <div class="invalid-feedback">
                        Pole wymagane.
                    </div>
                </div>

            </div>


            {{--                        <div class="form-floating mb-3">--}}
            {{--                            <select class="form-control" id="parent_idd" type="text"--}}
            {{--                                   data-sb-validations="required">--}}
            {{--                            <option selected>Wybierz..</option>--}}
            {{--                            @foreach($name as $value)--}}
            {{--                                <option>--}}
            {{--                                    {{ $value->name }}--}}
            {{--                                </option>--}}
            {{--                                @endforeach--}}
            {{--                            </select>--}}
            {{--                            <label for="phone">ParentId</label>--}}
            {{--                            <div class="invalid-feedback" data-sb-feedback="parent_idd:required">ParentId jest wymagany.--}}
            {{--                            </div>--}}
            {{--                        </div>--}}


            <button class="btn btn-primary mb-4" type="submit">Zapisz</button>
            </form>
        </div>


    <!-- Tree Section-->
{{--    <section class="page-section" id="contact">--}}
{{--        <div class="container">--}}
{{--            <!-- Contact Section Heading-->--}}
{{--            <h5 class=" text-center text-uppercase  mb-4">Struktura plików</h5>--}}

{{--            <table class="table table-striped">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th scope="col">Id</th>--}}
{{--                    <th scope="col">Name</th>--}}
{{--                    <th scope="col">ParentId</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($name as $value)--}}
{{--                    <tr>--}}
{{--                        <th scope="row">{{$value->id}}</th>--}}
{{--                        <td>{{$value->name}}</td>--}}
{{--                        <td>{{$value->parent_id}}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}

{{--                </tbody>--}}
{{--            </table>--}}

{{--            <div class="row justify-content-center">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
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
