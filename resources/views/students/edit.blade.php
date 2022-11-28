<x-layout title="Edit Siswa">
    <div class="card-header bg-white">
        <h1 class="fs-5 m-0">Edit Siswa</h1>
    </div>
    <div class="card-body">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input value="{{ old('name', $student->name) }}" type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option @if ($student->gender == 'Laki-laki') selected @endif value="Laki-laki">Laki-laki</option>
                            <option @if ($student->gender == 'Perempuan') selected @endif value="Perempuan">Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal Lahir</label>
                        <input value="{{ old('date', $student->date) }}" type="date" name="date"
                            class="form-control @error('date') is-invalid @enderror"
                            id="date">
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" id="address" cols="30" class="form-control @error('address')
                        is-invalid
                        @enderror" rows="5">{{$student->address}}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</x-layout>
