@extends('layouts.admin')

@push('css')
@endpush

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update city</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-6 offset-3">

                <div class="card-body">
                    <form method="POST" action="{{ route('cities.update', $city->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="state_id" class="col-md-4 col-form-label text-md-end">
                                {{ __('State') }}
                            </label>
                            <div class="col-md-6">
                                <select class="form-control @error('state_id') is-invalid @enderror" name="state_id">
                                    <option>-- Select country --</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ $city->state_id === $state->id ? 'selected' : '' }}>{{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $city->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
