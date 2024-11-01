@extends('layouts.template')

@section('content')
    <div class="card mx-3">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update') }}">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Nama Lengkap</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap"
                                        id="first-name-icon" name="name" value="{{ Auth::user()->name }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">

                            <div class="form-group has-icon-left">
                                <label for="email-id-icon">Email</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Masukan Email"
                                        id="email-id-icon" name="email" value="{{ Auth::user()->email }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <a type="button" href="{{ route('dashboard') }}"
                                class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            })
        </script>
    @endif
@endsection
