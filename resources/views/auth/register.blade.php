<x-layout title="Register">
    <div class="card-header bg-white">
        <h1 class="fs-5 m-0">Register</h1>
    </div>
    <div class="card-body">
        <form action="{{route('store.register')}}" method="POST">
            @csrf
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="email" class="form-label">Nama</label>
                        <input value="{{ old('name') }}" type="text" name="name"
                           placeholder="Nama Lengkap" class="form-control @error('name') is-invalid @enderror"
                            id="name">
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
                        <input value="{{ old('email') }}" type="email" name="email"
                           placeholder="email" class="form-control @error('email') is-invalid @enderror"
                            id="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="ketik password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary">Submit</button>
            </div>
            <div class="d-flex gap-2">
                <span>Sudah punya akun? <a href="/" style="text-decoration: none;">Login</a></span>
            </div>
        </form>
    </div>
</x-layout>
