@extends('layouts.app', ['title' => 'Table Gedung'])

@section('content')
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-6">
                            <h2>Table <b> Gedung</b></h2>
                        </div>
                        <div class="col-6">
                            <a href="#addGedungModal" class="btn btn-success" data-bs-toggle="modal">Add New Data</a>
                            <a href="#deleteSelectedGedungModal" class="btn btn-danger" data-bs-toggle="modal">Delete</a>
                            <a href="/tabel/gedung/exportexcel" class="btn btn-info">Export</a>
                            <!-- Button trigger modal -->
                            <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                class="btn btn-warning">Import</a>

                            <a href="#addKategoriModal" class="btn btn-secondary" data-bs-toggle="modal">Add Kategori</a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <div class="row">
                        <div class="col-md-3">
                            <span>Rows per page:</span>
                            <select class="custom-select form-select" onchange="changePaginationLength(this.value)">
                                <option value="10" {{ $gedungs->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $gedungs->perPage() == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $gedungs->perPage() == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $gedungs->perPage() == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <span>Filter by AM:</span>
                            <select class="form-select" id="filter-am" name="filter-am">
                                <option value="" {{ request()->input('filter-am') == '' ? 'selected' : '' }}>All AMs
                                </option>
                                @foreach ($ams as $am)
                                    <option value="{{ $am }}"
                                        {{ request()->input('filter-am') == $am ? 'selected' : '' }}>
                                        {{ $am }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 pb-2 pt-2"></div>
                        <div class="col-md-3 form-inline">
                            <span>Search</span>
                            <input type="text" class="form-control mr-sm-2" id="search" name="search"
                                oninput="search()" placeholder="Search by Name or AMs">
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                    <label class="form-check-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Alamat</th>
                            <th>Koordinat</th>
                            <th>PIC Cust</th>
                            <th>Tel. Cust</th>
                            <th>AM</th>
                            <th>Tel. AM</th>
                            <th>STO</th>
                            <th>Hero</th>
                            <th>Tel. Hero</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($gedungs as $gedung)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll"
                                            onchange="updateCheckboxes()" value="{{ $gedung->id }}">
                                        <label class="form-check-label" for="checkbox1"></label>
                                    </div>
                                </td>
                                <td>{{ $gedung->NAMA }}</td>
                                <td>{{ $gedung->KATEGORI }}</td>
                                <td>{{ $gedung->ALAMAT }}</td>
                                <td>{{ $gedung->KOORDINAT }}</td>
                                <td>{{ $gedung->PIC_CUST }}</td>
                                <td>{{ $gedung->TEL_CUST }}</td>
                                <td>{{ $gedung->AM }}</td>
                                <td>{{ $gedung->TEL_AM }}</td>
                                <td>{{ $gedung->STO }} </td>
                                <td>{{ $gedung->HERO }}</td>
                                <td>{{ $gedung->TEL_HERO }}</td>
                                <td>
                                    <a href="#" class="edit" data-bs-toggle="modal"
                                        data-bs-target="#editGedungModal-{{$gedung->id}}" data-gedung-id="{{ $gedung->id }}">
                                        <i class="ri-pencil-line" data-bs-toggle="tooltip" title="Edit"></i>
                                    </a>
                                    <a href="#" class="delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteGedungModal" data-gedung-id="{{ $gedung->id }}">
                                        <i class="ri-delete-bin-line" data-bs-toggle="tooltip" title="Delete"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>{{ $gedungs->firstItem() }}</b> to
                        <b>{{ $gedungs->lastItem() }}</b> of
                        <b>{{ $gedungs->total() }}</b> entries
                    </div>
                    <ul class="pagination">
                        @if ($gedungs->currentPage() > 1)
                            <li class="page-item">
                                <a href="{{ $gedungs->previousPageUrl() }}" class="page-link">Previous</a>
                            </li>
                        @endif
                        @for ($i = 1; $i <= $gedungs->lastPage(); $i++)
                            <li class="page-item{{ $gedungs->currentPage() == $i ? ' active' : '' }}">
                                <a href="{{ $gedungs->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        @if ($gedungs->currentPage() < $gedungs->lastPage())
                            <li class="page-item">
                                <a href="{{ $gedungs->nextPageUrl() }}" class="page-link">Next</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal import -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('gedung.importexcel') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Insert File</label>
                            <input class="form-control" type="file" id="formFile"
                                name="upexcel"><br>
                            <p>Caution: only .XLSX files allowed</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning"
                            data-bs-dismiss="modal">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal add kategori --}}
    <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-white">
                <form method="POST" action="{{ route('gedung.addkategori') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKategoriModalLabel">Add Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="Kategori" name="Kategori" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add gedung</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div class="modal fade" id="addGedungModal" tabindex="-1" role="dialog" aria-labelledby="addGedungModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-white">
                <form method="POST" action="{{ route('gedung.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGedungModalLabel">Add gedung</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3 ">
                            <label for="kategori" class="form-label select-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->Kategori }}">{{ $kategori->Kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="koordinat" class="form-label">Koordinat</label>
                            <input type="text" class="form-control" id="koordinat" name="koordinat" required>
                        </div>
                        <div class="mb-3">
                            <label for="pic_cust" class="form-label">PIC Cust</label>
                            <input type="text" class="form-control" id="pic_cust" name="pic_cust" required>
                        </div>
                        <div class="mb-3">
                            <label for="tel_cust" class="form-label">Tel. Cust</label>
                            <input type="number" class="form-control" id="tel_cust" name="tel_cust" required>
                        </div>
                        <div class="mb-3">
                            <label for="am" class="form-label">AM</label>
                            <input type="text" class="form-control" id="am" name="am" required>
                        </div>
                        <div class="mb-3">
                            <label for="tel_am" class="form-label">Tel. AM</label>
                            <input type="number" class="form-control" id="tel_am" name="tel_am" required>
                        </div>
                        <div class="mb-3">
                            <label for="sto" class="form-label">STO</label>
                            <input type="text" class="form-control" id="sto" name="sto" required>
                        </div>
                        <div class="mb-3">
                            <label for="hero" class="form-label">Hero</label>
                            <input type="text" class="form-control" id="hero" name="hero" required>
                        </div>
                        <div class="mb-3">
                            <label for="tel_hero" class="form-label">Tel. Hero</label>
                            <input type="number" class="form-control" id="tel_hero" name="tel_hero" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add gedung</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    @foreach ($gedungs as $gedung)
    <div class="modal fade modal-dialog-scrollable" id="editGedungModal-{{ $gedung->id }}" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editGedungModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-white">
                <form method="POST" action="{{ url('/tabel/gedung/edit/'.$gedung->id) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGedungModalLabel">Edit Gedung</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Nama Gedung</label>
                            <input type="text" class="form-control" id="edit-name" name="NAMA" value="{{ $gedung->NAMA }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-kategori" class="form-label select-label">Kategori</label><br>
                            <select name="KATEGORI" class="form-select" id="edit-kategori">
                                @foreach ($kategoris as $kategori)
                                    <option @selected($kategori->Kategori == $gedung->KATEGORI) value="{{ $kategori->Kategori }}">{{ $kategori->Kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit-address" name="ALAMAT" required>{{ $gedung->ALAMAT }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-coor" class="form-label">Koordinat</label>
                            <input type="text" class="form-control" id="edit-coor" name="KOORDINAT" value="{{ $gedung->KOORDINAT }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-piccust" class="form-label">PIC Cust</label>
                            <input type="text" class="form-control" id="edit-piccust" name="PIC_CUST" value="{{ $gedung->PIC_CUST }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-telcust" class="form-label">Tel. Cust</label>
                            <input type="number" class="form-control" id="edit-telcust" name="TEL_CUST" value="{{ $gedung->TEL_CUST }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-am" class="form-label">AM</label>
                            <input type="text" class="form-control" id="edit-am" name="AM" value="{{ $gedung->AM }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-telam" class="form-label">Tel. AM</label>
                            <input type="number" class="form-control" id="edit-telam" name="TEL_AM" value="{{ $gedung->TEL_AM }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-sto" class="form-label">STO</label>
                            <input type="text" class="form-control" id="edit-sto" name="STO" value="{{ $gedung->STO }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-hero" class="form-label">Hero</label>
                            <input type="text" class="form-control" id="edit-hero" name="HERO" value="{{ $gedung->HERO }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-telhero" class="form-label">Tel. Hero</label>
                            <input type="number" class="form-control" id="edit-telhero" name="TEL_HERO" value="{{ $gedung->TEL_HERO }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Delete Modal HTML -->
    <div class="modal fade" id="deleteGedungModal" tabindex="-1" aria-labelledby="deleteGedungModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteGedungModalLabel">Delete Gedung</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <form action="{{ route('gedung.destroy', ':gedungId') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Selected Modal HTML -->
    <div class="modal fade" id="deleteSelectedGedungModal" tabindex="-1"
        aria-labelledby="deleteSelectedGedungModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteSelectedGedungModalLabel">Delete Gedung</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="deleteSelected" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete selected
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
