@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Data Transaksi</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title" >Data Delivery Order Tabung</h4>
                        <div class="col-sm-6 col-md-6 col-xl-3">
                            <div class="my-4">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Add Barang</button>
                            </div>

                            <!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{route('store.order.tabung')}}" method="POST">
                                            @csrf
                                            
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Add DO</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>                                             

                                            <div class="modal-body">

                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                                    <div class="col-sm-10">
                                                        <select name="barang_id" class="form-select" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>    
                                                            @foreach ($barang as $item)                                            
                                                                <option value="{{ $item->barang->id }}">{{ $item->barang->nama_barang }}</option>                                        
                                                            @endforeach                                    
                                                        </select>
                                                        @error('barang_id')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- end row -->   

                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Barang Masuk Isi</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" id="barang_masuk_isi" name="barang_masuk_isi" value="{{ old('barang_masuk_isi') }}">
                                                        @error('barang_masuk_isi')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- end row -->
                    
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Barang Keluar Kosong</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text" id="barang_keluar_kosong" name="barang_keluar_kosong" value="{{ old('barang_keluar_kosong') }}">
                                                        @error('barang_keluar_kosong')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- end row -->   
                                                
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal Transaksi DO</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="date" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ old('tanggal_transaksi') }}">                                                        
                                                        @error('tanggal_transaksi')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary waves-effect waves-light" value="Add DO" />
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Barang Masuk Isi</th>
                                    <th>Barang Keluar Kosong</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>          
                                @php
                                    $i = 1;
                                @endphp  
                                @foreach ($listOrder as $item)                                                                                       
                                    <tr>
                                        <td>{{ $i++ }}</td>                                  
                                        <td data-id="{{ $item->id }}" id="barangs_id" data-barang="{{ $item['orderBarang']['nama_barang'] }}">{{ $item['orderBarang']['nama_barang'] }}</td>                                    
                                        <td data-id="{{ $item->id }}" id="barang_masuk_isi" data-masuk="{{ $item->barang_masuk_isi }}">{{ $item->barang_masuk_isi }}</td>                                  
                                        <td data-id="{{ $item->id }}" id="barang_keluar_kosong" data-keluar="{{ $item->barang_keluar_kosong }}">{{ $item->barang_keluar_kosong }}</td>                                  
                                        <td data-id="{{ $item->id }}" id="tanggal_transaksi" data-tanggal="{{ $item->tanggal_transaksi }}">{{ $item->tanggal_transaksi }}</td>                                  
                                        <td>
                                            <a onclick="editRow(this, '{{ $item->id }}'); event.preventDefault();" class="btn btn-info sm" title="Edit Order"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.order.tabung', $item->id) }}" id="delete" class="delete-{{ $item->id }} btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>
</div>

<script>
    function editRow(link, deleteId){
        var deleteButton = document.querySelector('.delete-' + deleteId);
        // var deleteButton = document.getElementById('delete-' + deleteId);
        var DeleteoriginalHTML = deleteButton.outerHTML;
        deleteButton.style.display = 'none';

        var row = link.parentNode.parentNode;
        var barang_id = row.querySelector('#barangs_id');
        var barang_masuk_isi = row.querySelector('#barang_masuk_isi');
        var barang_keluar_kosong = row.querySelector('#barang_keluar_kosong');
        var tanggal_transaksi = row.querySelector('#tanggal_transaksi');
        var id = barang_masuk_isi.getAttribute("data-id");

        // Barang ID
        let inputBarang = document.createElement("select");
        inputBarang.classList.add("form-select");
        inputBarang.name = "barang_id";
        inputBarang.id = "barang_id";
        
        @foreach($barang as $b)
            var option = document.createElement("option");
            option.text = "{{ $b->barang->nama_barang }}";
            option.value = "{{ $b->barang_id }}";
            inputBarang.add(option);
            
            if(barang_id.getAttribute('data-barang') == "{{$b->barang->nama_barang}}"){
                option.selected = true;
                inputBarang.value = "{{ $b->barang_id }}";
                inputBarang.setAttribute("data-selected-barang-id", "{{ $b->barang_id }}");
                inputBarang.setAttribute("data-selected-barang-name", "{{ $b->barang->nama_barang }}");
            }           
        @endforeach              

        // Add to row
        barang_id.parentNode.replaceChild(inputBarang, barang_id);
        
        // Barang Masuk Isi
        let inputBarangMasukisi = document.createElement("input");
        inputBarangMasukisi.classList.add("form-control");
        inputBarangMasukisi.value = barang_masuk_isi.innerHTML;
        inputBarangMasukisi.name = "barang_masuk_isi";
        barang_masuk_isi.innerHTML = "";
        barang_masuk_isi.appendChild(inputBarangMasukisi);
        let spanErrorBarangMasukIsi = document.createElement("span");
        spanErrorBarangMasukIsi.classList.add("text-danger");
        spanErrorBarangMasukIsi.textContent = "{{ $errors->first('barang_masuk_isi') }}";
        barang_masuk_isi.appendChild(spanErrorBarangMasukIsi);
        

        // Barang Keluar Kosong
        let inputBarangKeluarkosong = document.createElement("input");
        inputBarangKeluarkosong.classList.add("form-control");
        inputBarangKeluarkosong.value = barang_keluar_kosong.innerHTML;
        inputBarangKeluarkosong.name = "barang_keluar_kosong";
        barang_keluar_kosong.innerHTML = "";
        barang_keluar_kosong.appendChild(inputBarangKeluarkosong);
        let spanErrorBarangKeluarKosong = document.createElement("span");
        spanErrorBarangKeluarKosong.classList.add("text-danger");
        spanErrorBarangKeluarKosong.textContent = "{{ $errors->first('barang_keluar_kosong') }}";
        barang_keluar_kosong.appendChild(spanErrorBarangKeluarKosong);
        

        // Transaksi Tanggal
        let inputBarangTransaksi = document.createElement("input");
        inputBarangTransaksi.classList.add("form-control");
        inputBarangTransaksi.value = tanggal_transaksi.innerHTML;
        tanggal_transaksi.innerHTML = "";
        inputBarangTransaksi.setAttribute('type', 'date');
        tanggal_transaksi.appendChild(inputBarangTransaksi);


        // membuat elemen form
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('update.order.tabung', ['id' => ':id']) }}".replace(':id', id);

        var buttonSubmit = document.createElement('input');
        buttonSubmit.type = 'submit';
        buttonSubmit.innerHTML = 'Simpan';
        buttonSubmit.classList.add("btn", "btn-sm", "btn-primary");

        var csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = "{{ csrf_token() }}";
        form.appendChild(csrf);

        

        form.addEventListener('submit', function () {               
            var data = {
                    barang_id: inputBarang.value,
                    barang_masuk_isi: inputBarangMasukisi.value,
                    barang_keluar_kosong: inputBarangKeluarkosong.value,
                    tanggal_transaksi: inputBarangTransaksi.value,
                    id: id,
                };         
        
            for (const [key, value] of Object.entries(data)) {
                const inputElement = document.createElement('input');
                inputElement.setAttribute('type', 'hidden');
                inputElement.setAttribute('name', key);
                inputElement.setAttribute('value', value);

                
                form.appendChild(inputElement);                
            }

            axios.post(form.action, new FormData(form))
                .then(function (response) {
                    alert('Data berhasil disimpan');
                })
                .catch(function (error) {
                    console.log(error);
                });
        });        

        var batalLink = document.createElement("a");
        batalLink.innerHTML = "Batal";
        batalLink.classList.add("btn", "btn-sm", "btn-secondary", "ml-1");
        batalLink.href = "";
        batalLink.onclick = function (e) {   

            e.preventDefault();

            // untuk mengembalikan nilai data barangs 
            var selectedBarangId = inputBarang.getAttribute("data-selected-barang-id");
            var selectedBarangName = inputBarang.getAttribute("data-selected-barang-name");
            var tdBarang = document.createElement("td");
            tdBarang.setAttribute("data-id", selectedBarangId);
            tdBarang.setAttribute("id", "barangs_id");
            tdBarang.setAttribute("data-barang", selectedBarangName);
            tdBarang.textContent = selectedBarangName;
            inputBarang.parentNode.replaceChild(tdBarang, inputBarang);

            // Untuk mengembalikan tombol delete
            deleteButton.outerHTML = DeleteoriginalHTML;
            link.style.display = "inline";     

            barang_id.innerHTML = barang_id.getAttribute("data-barang");
            barang_masuk_isi.innerHTML = barang_masuk_isi.getAttribute("data-masuk");
            barang_keluar_kosong.innerHTML = barang_keluar_kosong.getAttribute("data-keluar");
            tanggal_transaksi.innerHTML = tanggal_transaksi.getAttribute("data-tanggal");


            // Untuk mengembalikan tombol edit semula
            form.parentNode.replaceChild(link, form);
            
        };

        var btnGroup = document.createElement("div");
        btnGroup.classList.add("btn-group");
        btnGroup.appendChild(buttonSubmit);
        btnGroup.appendChild(batalLink);

        // link.parentNode.replaceChild(btnGroup, link);     
        form.appendChild(btnGroup);
        link.parentNode.replaceChild(form, link);   
    }
</script>

@endsection