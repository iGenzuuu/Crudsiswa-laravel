<x-layout title="Profil saya">
    <div class="card-header bg-white">
        <h1 class="fs-5 m-0">Profil Saya</h1>
    </div>
    <div class="card-body">
        <div class="col-sm-12">
            <div id="alert">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-2">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show mb-2">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="row">
                {{-- profile section --}}
                <div class="col-sm-6">
                    <b for="" class="mb-2">Data Saya</b>
                    <form action="{{route('update-profile')}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input value="{{ $user->name }}" type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input value="{{ $user->email }}" type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                {{-- end profile section --}}

                {{-- change password section --}}
                <div class="col-sm-6">
                    <b for="" class="mb-2">Ganti Password</b>
                    <form action="{{route('change-password')}}" id="change-password-form" method="POST">
                        @csrf
                        @method('put')
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password saat ini</label>
                                <input type="password" name="current_password" placeholder="isi password saat ini"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" name="new_password" placeholder="isi password baru"
                                    class="form-control @error('new_password') is-invalid @enderror" id="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" onclick="changePasswordHandler()" class="btn btn-primary">Ganti Password</button>
                        </div>
                    </form>
                </div>
                {{-- end change password section --}}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function changePasswordHandler() {
            var text = 'Anda yakin ingin mengubah password?';
            if (confirm(text) == true) {
                $('#change-password-form').submit()
            }
        }
    </script>
    @endpush
</x-layout>
