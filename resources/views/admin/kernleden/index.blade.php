@extends('layouts.template')

@section('title', 'Kernleden')

@section('main')
    <h1>Kernleden</h1>
    @include('shared.alert')

    <form method="get" action="/admin/kernleden" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <label for="name">Filter Name or Email</label>
                <input type="text" class="form-control" name="name" id="name"
                       value="{{ request()->name }}" placeholder="Filter Name or Email">
            </div>
            <div class="col-sm-3 mb-2">
                <label for="sort">Sort by</label>
                <select class="form-control" name="sort" id="sort">
                    <option value="%" selected>Name (A => Z)</option>
                    <option value="%">Name (Z => A)</option>
                    <option value="%">Email (A => Z)</option>
                    <option value="%">Email (Z => A)</option>
                    <option value="%">Not Active</option>
                    <option value="%">Admin</option>
                </select>
            </div>
            <div class="col-sm-3 mb-2">
                <label>Voeg toe</label><br>
                <a href="#!" class="btn btn-outline-success" id="btn-create">
                    <i class="fas fa-plus-circle mr-1"></i>Nieuw kernlid
                </a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Telefoon</th>
                <th>Geboortedatum</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    @include('admin.kernleden.modal')
@endsection

@section('script_after')
    <script>
        $(function () {
            loadTable();

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                // Set some values for Noty
                let text = `<p>Delete kernlid: <b>${voornaam} ${naam}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Delete Kernlid';
                let btnClass = 'btn-success';

                // Show Noty
                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,
                    buttons: [
                        Noty.button(btnText, `btn ${btnClass}`, function () {
                            // Delete genre and close modal
                            deleteGebruiker(id);
                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                let email = $(this).closest('td').data('email');
                let straat = $(this).closest('td').data('straat');
                let huisnummer = $(this).closest('td').data('huisnummer');
                let postcode = $(this).closest('td').data('postcode');
                let telefoon = $(this).closest('td').data('telefoon');
                let geboortedatum = $(this).closest('td').data('geboortedatum');
                // Update the modal
                $('.modal-title').text(`Edit ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/kernleden/${id}`);

                $('#naam').val(naam);
                $('#voornaam').val(voornaam);
                $('#email').val(email);
                $('#straat').val(straat);
                $('#huisnummer').val(huisnummer);
                $('#postcode').val(postcode);
                $('#telefoon').val(telefoon);
                $('#geboortedatum').val(geboortedatum);

                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-kernleden').modal('show');
            });

            $('#modal-kernleden form').submit(function (e) {
                // Don't submit the form
                e.preventDefault();
                // Get the action property (the URL to submit)
                let action = $(this).attr('action');
                // Serialize the form and send it as a parameter with the post
                let pars = $(this).serialize();
                console.log(pars);
                // Post the data to the URL
                $.post(action, pars, 'json')
                    .done(function (data) {
                        console.log(data);
                        // Noty success message
                        new Noty({
                            type: data.type,
                            text: data.text
                        }).show();
                        // Hide the modal
                        $('#modal-kernleden').modal('hide');
                        // Rebuild the table
                        loadTable();
                    })
                    .fail(function (e) {
                        console.log('error', e);
                        // e.responseJSON.errors contains an array of all the validation errors
                        console.log('error message', e.responseJSON.errors);
                        // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
                        let msg = '<ul>';
                        $.each(e.responseJSON.errors, function (key, value) {
                            msg += `<li>${value}</li>`;
                        });
                        msg += '</ul>';
                        // Noty the errors
                        new Noty({
                            type: 'error',
                            text: msg
                        }).show();
                    });
            });

            $('#btn-create').click(function () {
                // Update the modal
                $('.modal-title').text(`Nieuw kernlid`);
                $('form').attr('action', `/admin/kernleden`);
                $('#naam').val('');
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-kernleden').modal('show');
            });
        });

        // Delete a genre
        function deleteGebruiker(id) {
            // Delete the genre from the database
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/admin/kernleden/${id}`, pars, 'json')
                .done(function (data) {
                    console.log('data', data);
                    // Show toast
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    // Rebuild the table
                    loadTable();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }

        // Load genres with AJAX
        function loadTable() {
            $.getJSON('/admin/qryKernleden')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {

                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${value.naam} ${value.voornaam}</td>
                               <td>${value.email}</td>
                               <td>${value.straat} ${value.huisnummer}</td>
                               <td>${value.postcode}</td>

                               <td>${value.telefoon}</td>
                               <td>${value.geboortedatum}</td>


                               <td data-id="${value.id}"
                                   data-naam="${value.naam}"
                                   data-voornaam="${value.voornaam}"
                                   data-email="${value.email}"
                                   data-straat="${value.straat}"
                                   data-huisnummer="${value.huisnummer}"
                                   data-postcode="${value.postcode}"
                                   data-geboortedatum="${value.geboortedatum}"
                                   data-telefoon="${value.telefoon}">

                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam} ${value.voornaam}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Verwijder ${value.naam} ${value.voornaam}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                               </td>
                           </tr>`;
                        // Append row to tbody
                        $('tbody').append(tr);
                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                })
        }
    </script>
@endsection
