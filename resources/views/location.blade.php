@extends('welcome')

@section('content')
    <div class="row">
        <h1 class="group">Postcodes API
        </h1>
        <div id="mainf">
            <!-- Modal -->
            <div class="modal fade col-auto" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
                <div class="container mt-5 px-2">

                    <span id="validation"></span>
                    <div id='message' role="alert"></div>
                    <div id='success' role="alert"></div>

                    <div class="card bg-gray mb-4">
                        <div class="card-header shadow-lg rounded ">
                            <h5 class="card-title ">SEARCH LOCATION USING YOUR API KEY
                                <button type="button" class="btn btn-sm btn-outline-danger float-end"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    YOUR API KEY
                                </button>
                            </h5>
                        </div>
                    </div>

                    <div class="mb-2 d-flex justify-content-between align-items-center">
                        <form class="row g-3" id="postCode">
                            {{-- @csrf --}}
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">PostCode</label>
                                <input type="text" class="form-control" name='postcode' id='postcode'
                                    placeholder="PostCode" />
                            </div>
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">API KEY</label>
                                <input type="text" class="form-control" name='api_key' id='api_key'
                                    placeholder="API_KEY" />
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3 text-white"
                                    id="submitButton">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive table-borderless">
                            <thead id="thead">
                            </thead>
                            <tbody id="Table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
         <div class="text-center">
            <h4>To Upload File</h4>
            <a href={{ route('upload') }} style="text-decoration:none" class="btn btn-outline-danger">Upload CSV</a>
         </div>
    </div>
@endsection
