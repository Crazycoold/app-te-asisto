{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Enfermeros')

{{-- page content --}}
@section('content')
    <style>
        .pdfobject-container {
            height: 30rem;
            border: 1rem solid rgba(0, 0, 0, .1);
        }

    </style>
    <div class="section" id="app">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <label id="label_document_type" for="document_type">Tipo de identificación</label>
                        <select id="document_type" class="browser-default" v-model="data.document_type">
                            <option value="" disabled selected>Seleccione una opcións</option>
                            <option value="CC">CC</option>
                            <option value="CE">CE</option>
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">contacts</i>
                        <input id="dni" type="number" class="uppercase" v-model="data.dni"
                            placeholder="Número de identificación">
                        <label for="dni">Número de identificación</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">filter_1</i>
                        <input id="first_name" type="text" class="uppercase" v-model="data.first_name"
                            placeholder="Primer nombre">
                        <label for="first_name">Primer nombre</label>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">filter_2</i>
                        <input id="last_name" type="text" class="uppercase" v-model="data.last_name"
                            placeholder="Segundo nombre">
                        <label for="last_name">Segundo nombre</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">filter_3</i>
                        <input id="first_surname" type="text" class="uppercase" v-model="data.first_surname"
                            placeholder="Primer apellido">
                        <label for="first_surname">Primer apellido</label>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">filter_4</i>
                        <input id="last_surname" type="text" class="uppercase" v-model="data.last_surname"
                            placeholder="Segundo apellido">
                        <label for="last_surname">Segundo apellido</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6 l6">
                        <label for="gender">Genero</label>
                        <select id="gender" class="browser-default" v-model="data.gender">
                            <option value="" disabled selected>Seleccione una opcións</option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">phone</i>
                        <input id="phone" type="number" v-model="data.phone" placeholder="Teléfono">
                        <label for="phone">Teléfono</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">email</i>
                        <input id="email" type="email" v-model="data.email" placeholder="Email">
                        <label for="email">Email</label>
                    </div>
                    <div class="bottomSpace col s12 m6 l6">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>HV</span>
                                <input id="file" type="file" v-on:change="onFileChange">
                            </div>
                            <div class="file-path-wrapper">
                                <input id="file-path" class="file-path" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="indeterminate" id="progress"></div>
                </div>
                <div class="row">
                    <div class="col s12 display-flex justify-content-end mt-1">
                        <button type="submit" class="btn indigo" id="save" v-on:click="save">
                            Guardar</button>
                        <button type="button" class="btn btn-light" v-on:click="clean">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">search</i>
                        <input id="searchInput" type="text" class="validate uppercase" @keyup="search()"
                            v-model="searchInput" autocomplete="off">
                        <label for="searchInput">Buscar</label>
                    </div>
                </div>
                <div class="row" v-if="dataTable == ''">
                    <div class="col s12 m12 l12">
                        <p>
                            <strong><em>CONSULTAS</em></strong>
                        </p>
                        <div class="card-alert card orange lighten-5">
                            <div class="card-content orange-text">
                                <p><em>No se encontraron registros en la base de datos.</em></p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="striped highlight centered responsive-table" v-if="dataTable != ''">
                    <thead>
                        <tr>
                            <th><b><em>Identificación</em></b></th>
                            <th><b><em>Nombres</em></b></th>
                            <th><b><em>Genero</em></b></th>
                            <th><b><em>Teléfono</em></b></th>
                            <th><b><em>Email</em></b></th>
                            <th><b><em>Opciones</em></b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,index) in dataTable">
                            <td><em><a>@{{ data . dni }}</a></em></td>
                            <td><em>@{{ data . first_name + ' ' + data . last_name + ' ' + data . first_surname + ' ' + data . last_surname }}</em>
                            <td><em>@{{ data . gender }}</em></td>
                            <td><em>@{{ data . phone }}</em></td>
                            <td><em><a>@{{ data . email }}</a></em></td>
                            </td>
                            <td>
                                <a style="cursor:pointer;" v-on:click="edit(data)"><i
                                        class="material-icons orange-text">edit</i></a>
                                <a class="red-text" style="cursor:pointer;" v-on:click="deleteRecord(data.id)"><i
                                        class="material-icons">delete</i></a>
                                <a class="red-text" style="cursor:pointer;" v-on:click="showPdf(data.id)"><i
                                        class="material-icons">picture_as_pdf</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <ul class="pagination right-align" v-if="dataTable != ''">
                    <li>
                        <a class="cursor btn light-blue tooltipped" v-on:click="fetchPaginate(pagination.first_page_url)"
                            :disabled="!pagination.prev_page_url" data-position="top" data-delay="50"
                            data-tooltip="Primera página">
                            <i v-if="!pagination.prev_page_url" class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-double-left-black.png') }}">
                            </i>
                            <i v-else class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-double-left-white.png') }}">
                            </i>
                        </a>
                    </li>
                    <li>
                        <a class="cursor btn light-blue tooltipped" v-on:click="fetchPaginate(pagination.prev_page_url)"
                            :disabled="!pagination.prev_page_url" data-position="top" data-delay="50"
                            data-tooltip="Página anterior">
                            <i v-if="!pagination.prev_page_url" class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-left-black.png') }}">
                            </i>
                            <i v-else class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-left-white.png') }}">
                            </i>
                        </a>
                    </li>
                    <li>Página <b>@{{ pagination . current_page }}</b> de <b>@{{ pagination . last_page }}</b></li>
                    <li>
                        <a class="cursor btn light-blue tooltipped" v-on:click="fetchPaginate(pagination.next_page_url)"
                            :disabled="!pagination.next_page_url" data-position="top" data-delay="50"
                            data-tooltip="Siguiente página">
                            <i v-if="!pagination.next_page_url" class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-right-black.png') }}">
                            </i>
                            <i v-else class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-right-white.png') }}">
                            </i>
                        </a>
                    </li>
                    <li>
                        <a class="cursor btn light-blue tooltipped" v-on:click="fetchPaginate(pagination.last_page_url)"
                            :disabled="!pagination.next_page_url" data-position="top" data-delay="50"
                            data-tooltip="Última página">
                            <i v-if="!pagination.next_page_url" class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-double-right-black.png') }}">
                            </i>
                            <i v-else class="material-icons">
                                <img class="pTop" src="{{ asset('img/chevron-double-right-white.png') }}">
                            </i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="modal" class="modal modal-fixed">
            <div class="modal-content">
                <div id="pdf"></div>
            </div>
        </div>
    </div>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script>
        var app = new Vue({

            el: "#app",
            data: {
                url: '/get-nurses',
                dataTable: [],
                searchInput: '',
                pagination: [],
                data: {
                    id: '',
                    document_type: '',
                    dni: '',
                    first_name: '',
                    last_name: '',
                    first_surname: '',
                    last_surname: '',
                    gender: '',
                    phone: '',
                    email: '',
                    file: ''
                }
            },
            methods: {
                run: function() {
                    this.$http.post(this.url).then(response => {
                        this.dataTable = response.body.data;
                        this.makePagination(response.body);
                    }, response => {
                        M.toast({
                            html: response.status + ' ' + response.statusText + ' (' + response
                                .url,
                            classes: 'rounded red'
                        });
                    });
                },
                search: function() {
                    this.$http.post(this.url, {
                        search: this.searchInput
                    }).then(response => {
                        this.dataTable = response.body.data;
                        this.makePagination(response.body);
                    }, response => {
                        M.toast({
                            html: response.status + ' ' + response.statusText + ' (' + response
                                .url,
                            classes: 'rounded red'
                        });
                    });
                },
                makePagination: function(data) {
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url,
                        first_page_url: data.first_page_url,
                        last_page_url: data.last_page_url,
                    }
                },
                fetchPaginate: function(url) {
                    this.url = url;
                    this.run();
                },
                showPdf: function(data) {
                    if (PDFObject.supportsPDFs) {
                        url = '/hv/' + data + '.pdf';
                        PDFObject.embed(url, "#pdf");
                        $('#modal').modal('open');
                    } else {
                        M.toast({
                            html: 'Este navegador no soporta PDFObject',
                            classes: 'rounded red'
                        });
                        return false;
                    }
                },
                onFileChange: function(e) {
                    var environment = this;
                    var files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    if (files[0].type == 'application/pdf') {
                        if (files[0].size <= 35651584) {
                            var reader = new FileReader();
                            reader.readAsBinaryString(files[0]);
                            environment.createImage(files[0]);
                        } else {
                            M.toast({
                                html: 'Este archivo supera el tamaño permitido',
                                classes: 'rounded orange'
                            });
                            $('#file').val('');
                            $('#file-path').val('');
                            return;
                        }
                    } else {
                        M.toast({
                            html: 'Tipo de archivo no valido',
                            classes: 'rounded orange'
                        });
                        $('#file').val('');
                        $('#file-path').val('');
                        return;
                    }
                },
                createImage: function(file) {
                    var image = new Image();
                    var reader = new FileReader();
                    var vm = this;
                    reader.onload = (e) => {
                        vm.image = e.target.result;
                        this.data.file = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                save: function() {
                    if (this.data.document_type == '') {
                        M.toast({
                            html: 'Campo Tipo de identificación, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#document_type').focus();
                        return;
                    }
                    if (this.data.dni == '') {
                        M.toast({
                            html: 'Campo Número de identificación, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#dni').focus();
                        return;
                    }
                    if (this.data.first_name == '') {
                        M.toast({
                            html: 'Campo Primer nombre, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#first_name').focus();
                        return;
                    }
                    if (this.data.first_surname == '') {
                        M.toast({
                            html: 'Campo Primer apellido, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#first_surname').focus();
                        return;
                    }
                    if (this.data.gender == '') {
                        M.toast({
                            html: 'Campo Genero, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#gender').focus();
                        return;
                    }
                    if (this.data.phone == '') {
                        M.toast({
                            html: 'Campo Teléfono, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#phone').focus();
                        return;
                    }
                    if (this.data.email == '') {
                        M.toast({
                            html: 'Campo Email, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#email').focus();
                        return;
                    }
                    if (this.data.file == '') {
                        M.toast({
                            html: 'Campo HV, es requerido',
                            classes: 'rounded orange'
                        });
                        $('#file').focus();
                        return;
                    }
                    $('#save').addClass('disabled');
                    $('#progress').show();
                    this.$http.post('/save', this.data).then(response => {
                        if (response.body.status == 'save') {
                            $('#progress').hide();
                            $('#save').removeClass('disabled');
                            this.clean();
                            this.run();
                            swal("¡FELICIDADES!", "¡Datos guardados correctamente!", "success");
                        }
                    }, response => {
                        M.toast({
                            html: response.status + ' ' + response.statusText + ' (' + response
                                .url,
                            classes: 'rounded red'
                        });
                    });
                },
                edit: function(data) {
                    this.data = {
                        id: data.id,
                        document_type: data.document_type,
                        dni: data.dni,
                        first_name: data.first_name,
                        last_name: data.last_name,
                        first_surname: data.first_surname,
                        last_surname: data.last_surname,
                        gender: data.gender,
                        phone: data.phone,
                        email: data.email,
                        file: ''
                    };
                    M.toast({
                        html: 'Datos precargados correctamente',
                        classes: 'rounded green'
                    });
                },
                deleteRecord: function(data) {
                    var environment = this;
                    swal({
                        title: "¿Deseas eliminar?",
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        dangerMode: true,
                        buttons: {
                            cancel: false,
                            yes: {
                                text: "SI",
                                value: true,
                                className: "green",
                            },
                            not: {
                                text: "NO",
                                value: false,
                                className: "red"
                            },
                        },
                    }).then(function(willDelete) {
                        if (willDelete) {
                            environment.$http.post('/delete', {
                                id: data
                            }).then(
                                response => {
                                    if (response.body.status == 'delete') {
                                        environment.run();
                                        $('#save').removeClass('disabled');
                                        swal("¡FELICIDADES!", "¡Datos eliminados correctamente!",
                                            "success");
                                    }
                                }, response => {
                                    M.toast({
                                        html: response.status + ' ' + response.statusText +
                                            ' (' + response.url,
                                        classes: 'rounded red'
                                    });
                                });
                        } else {
                            return;
                        }
                    });
                },
                clean: function() {
                    this.data = {
                        id: '',
                        document_type: '',
                        dni: '',
                        first_name: '',
                        last_name: '',
                        first_surname: '',
                        last_surname: '',
                        gender: '',
                        phone: '',
                        email: '',
                        file: ''
                    };
                    $('#file').val('');
                    $('#file-path').val('');
                }
            },
            mounted() {
                var environment = this;
                $('#progress').hide();
                $('.modal').modal();
                environment.run();
            }
        });
    </script>
@endsection
