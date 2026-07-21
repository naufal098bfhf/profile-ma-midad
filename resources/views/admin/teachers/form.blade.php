@csrf

<div class="row">

    <div class="col-md-4">

        <div class="card">

            <div class="card-body text-center">

                @if(isset($teacher) && $teacher->photo)

                    <img
                        src="{{ asset('storage/'.$teacher->photo) }}"
                        class="img-fluid rounded mb-3"
                        style="max-height:250px; object-fit:cover;">

                @else

                    <img
                        src="{{ asset('images/default-teacher.png') }}"
                        class="img-fluid rounded mb-3"
                        style="max-height:250px; object-fit:cover;">

                @endif

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Foto Guru
                    </label>

                    <input
                        type="file"
                        name="photo"
                        class="form-control @error('photo') is-invalid @enderror">

                    @error('photo')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card">

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $teacher->name ?? '') }}">

                    @error('name')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="position"
                        class="form-control"
                        value="{{ old('position', $teacher->position ?? '') }}">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="subject"
                        class="form-control"
                        value="{{ old('subject', $teacher->subject ?? '') }}">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Pendidikan
                    </label>

                    <input
                        type="text"
                        name="education"
                        class="form-control"
                        value="{{ old('education', $teacher->education ?? '') }}">

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $teacher->email ?? '') }}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Nomor HP
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $teacher->phone ?? '') }}">

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control">{{ old('description', $teacher->description ?? '') }}</textarea>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Urutan
                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                class="form-control"
                                value="{{ old('sort_order', $teacher->sort_order ?? 1) }}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="is_active"
                                class="form-select">

                                <option value="1"
                                    {{ old('is_active', $teacher->is_active ?? 1) == 1 ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="0"
                                    {{ old('is_active', $teacher->is_active ?? 1) == 0 ? 'selected' : '' }}>
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer text-end">

                <a
                    href="{{ route('admin.teachers.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>
