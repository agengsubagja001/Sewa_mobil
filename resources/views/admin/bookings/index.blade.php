@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <section class="content pt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Semua Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat Lengkap</th>
                        <th>Nomer HP/Whatsap</th>
                        <th>Nomor SIM</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Jumlah Hari</th>
                        <th>Tagihan Pembayaran</th>
                        <th>Mobil</th>
                        <th>Plat Nomor</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->nama_lengkap }}</td>
                                <td>{{ $booking->alamat_lengkap }}</td>
                                <td>
                                  <a href="https://wa.me/62{{ $booking->nomer_wa }}">{{ $booking->nomer_wa }}</a>
                                </td>
                                <td>{{ $booking->no_sim }}</td>
                                <td>{{ $booking->start_date }}</td>
                                
                                <td>{{ $booking->end_date }}</td>
                                <td>
                                  <?php
                                      $startDate = new DateTime($booking->start_date);
                                      $endDate = new DateTime($booking->end_date);
                                      $interval = $startDate->diff($endDate);
                                      echo $interval->format('%a days');
                                      ?>
                                  </td>
                                <td>
                                  <?php
                                  $startDate = new DateTime($booking->start_date);
                                  $endDate = new DateTime($booking->end_date);
                                  $interval = $startDate->diff($endDate);
                                  $totalPrice = $interval->days * $booking->car->price;
                                  echo "Rp " . number_format($totalPrice, 0, ",", ".");
                                  ?>
                                </td>
                                <td>{{ $booking->car->nama_mobil }}</td>
                                <td>{{ $booking->car->plat_nomor }}</td>
                                <td>
                                <div class="btn-group btn-group-sm">
                                    <form onclick="return confirm('are you sure !')" action="{{ route('admin.bookings.destroy', $booking) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" booking="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data Kosong !</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('style-alt')
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush

@push('script-alt') 
    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous"
    >
    </script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
    $("#data-table").DataTable();
    </script>
@endpush