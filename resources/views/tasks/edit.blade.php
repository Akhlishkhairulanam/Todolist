@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4 text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Tugas</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada beberapa kesalahan:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">📌 Judul Tugas</label>
                        <input type="text" name="title" class="form-control shadow-sm"
                            value="{{ old('title', $task->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">📝 Deskripsi</label>
                        <textarea name="description" class="form-control shadow-sm" rows="4">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">📅 Tanggal Tenggat</label>
                        <input type="date" name="due_date" class="form-control shadow-sm"
                            value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">🎯 Prioritas</label>
                        <select class="form-select shadow-sm" name="priority">
                            @php
                                $priorities = ['High', 'Medium', 'Low'];
                                $selected = old('priority', $task->priority);
                            @endphp
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority }}" {{ $priority == $selected ? 'selected' : '' }}>
                                    {{ $priority }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed" value="1"
                            {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_completed">
                            ✅ Tandai sebagai selesai
                        </label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2 me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
