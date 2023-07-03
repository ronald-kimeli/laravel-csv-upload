@extends('welcome')

@section('content')
    <div class="row mt-4">
        <h1 class="text-center mb-3">Upload CSV
        </h1>

        <!-- print success message after file upload  -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif
        <div class="mx-auto">
            <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data"
                class="row g-3 d-flex justify-content-center">
                @csrf
                <div class="col-auto">
                    <label for="formFileMultiple" class="visually-hidden">Multiple files input
                        example</label>
                    <input class="form-control" type="file" name="filenames[]" multiple>
                    @if ($errors->has('filenames'))
                        <span class="help-block text-danger">{{ $errors->first('filenames') }}</span>
                    @endif
                </div>
                <div class="col-auto">
                    <button type="submit" name="import" class="btn btn-primary mb-3">Upload</button>
                </div>
            </form>
        </div>
    </div>
    <hr />
    <div class="row">
        <div id="mainf">
            <div class="text-center">
                <h4>Ensure CSV file resembles this table</h4>
            </div>
            <div class="py-3">
                <div class="card shadow rounded mb-3">
                    <div class="card-body" id="table">
                        <table class="table table-bordered table-striped mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">0</th>
                                    <th scope="col">Street_Address</th>
                                    <th scope="col">Postcode</th>
                                    <th scope="col">Lat</th>
                                    <th scope="col">Long</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>52 MOUNT PARK CONWY</td>
                                    <td>LL328RN</td>
                                    <td>53.277687</td>
                                    <td>-3.837099</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>70 PARC SYCHNANT CONWY</td>
                                    <td>LL328SB</td>
                                    <td>53.2760474</td>
                                    <td>-3.843148</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
