<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Beasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- 00. Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Tugas UTS Pemograman web (Tema: Data Beasiswa)</div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <!-- Home-->
        <h1 class="text-center mb-4">Program Pengelolaan Data Beasiswa</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card mb-3">
                <div class="card-body">
                    @if (session('sukses'))
                    <div class="alert alert-success">
                        {{ session('sukses') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- CREATE data -->
                    <form id="beasiswa-form" action="{{ route('beasiswa.post') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="task" id="beasiswa-input"
                                placeholder="Tambahkan Data Penerima Beasiswa" required value="{{ old('task') }}">
                            <button class="btn btn-primary" type="submit">
                                Simpan
                            </button>
                        </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <!-- VIEW  data-->
                        <form id="beasiswa-form" action="{{ route('beasiswa') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                    placeholder="masukkan data yang ingin dicari">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>  
                        <ul class="list-group mb-4" id="beasiswa-list">
                            @foreach ($data as $item)

                            <!-- DELET  Data -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="task-text">
                                    {!! $item->is_done == '1'?'<del>':'' !!}
                                        {{ $item->task }}
                                        {!! $item->is_done == '1'?'</del>':'' !!}
                                    </span>
                                <input type="text" class="form-control edit-input" style="display: none;"
                                    value="{{ $item->task }}">
                                <div class="btn-group">
                                    <form action="{{ route('beasiswa.delete',['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('apakah anda yakin untuk menghapus data ini?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete-btn">✕</button>
                                    </form>
                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">✎</button>
                                </div>
                            </li>

                            <!-- UPDATE Data -->
                            <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                <form action="{{ route('beasiswa.update',['id'=>$item->id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="task"
                                                value="{{ $item->task }}">
                                            <button class="btn btn-outline-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="radio px-2">
                                            <label>
                                                <input type="radio" value="1" name="is_done" {{ $item->is_done == '1'?'checked':'' }}> Tidak Diterima
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="0" name="is_done" {{ $item->is_done == '0'?'checked':'' }}> Terkonfirmasi
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>