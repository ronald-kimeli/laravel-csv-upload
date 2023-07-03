@extends('welcome')

@section('content')
    <div class="row" id="location">

        <h1 class="text-center">Postcodes API
        </h1>
        <!-- Modal -->
        <div class="modal fade col-auto" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">API KEY</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                value="" readonly id="api_data" />
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-outline-success dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
                                <ul class="dropdown-menu">
                                    <!-- Dropdown menu links -->
                                    <li><button class="btn dropdown-item" id="copy"
                                            data-clipboard-target="#api_data">Copy</button></li>
                                    <li><button class="dropdown-item" id="generate">Generate New</button></li>
                                    <li><button class="dropdown-item" id="revoke">Revoke</button></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <div class="justify-content-center">
            <div class="container px-2">
                <div id='message' role="alert"></div>
                <div id='success' role="alert"></div>

                <div class="card shadow rounded">
                    <div class="card-header">
                        <h4>Find Location through Postcode
                            <button type="button" style="text-decoration:none"
                                class="btn btn-success text-dark float-end col-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">YOUR API KEY</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-2 mt-2 d-flex justify-content-between align-items-center">
                            <form class="row g-3" id="postCode">
                                {{-- @csrf --}}
                                <div class="col-auto">
                                    <label for="inputPassword2" class="visually-hidden">PostCode</label>
                                    <input type="text" class="form-control" name='postcode' id='postcode'
                                        placeholder="Enter PostCode" />
                                </div>
                                <div class="col-auto">
                                    <label for="inputPassword2" class="visually-hidden">API KEY</label>
                                    <input type="text" class="form-control" name='api_key' id='api_key'
                                        placeholder="Enter API_KEY" />
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3 text-white"
                                        id="submitButton">Search</button>
                                </div>
                            </form>
                        </div>
                        <div id='output'></div>
                        <table class="table table-bordered table-striped mb-3">
                        </table>
                    </div>
                </div>
            </div>

            <br><br>
            <hr />

            <div class="text-center mt-2">
                <h4>To Upload File</h4>
                <a href={{ route('upload') }} style="text-decoration:none" class="btn btn-primary text-white">Upload CSV</a>
            </div>
        </div>
    </div>
    </div>
@endsection
