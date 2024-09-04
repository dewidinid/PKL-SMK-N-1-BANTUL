@extends('layouts.headeradmin')

@section('content')


<div class="container mt-5">
    <h3 class="text-center">Surat Pengajuan PKL Mandiri</h3>
    <br>
    <br>
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>No Handphone (Ketua)</th>
                <th>Rencana Tempat PKL</th>
                <th>Proposal PKL</th>
                <th>ACC</th>
            </tr>
        </thead>
        <tbody id="data-table">
            <tr>
                <td>1</td>
                <td>
                    <div>1. 123456789</div>
                    <div>2. 234567890</div>
                </td>
                <td>
                    <div>1. John Doe</div>
                    <div>2. Jane Smith</div>
                </td>
                <td>08123456789</td>
                <td>SMK N 1 Bantul</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="1">
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <div>1. 345678901</div>
                    <div>2. 456789012</div>
                </td>
                <td>
                    <div>1. Michael Brown</div>
                    <div>2. Emily Davis</div>
                </td>
                <td>08987654321</td>
                <td>SMK N 2 Yogyakarta</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal2.docx') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="2">
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <div>1. 567890123</div>
                    <div>2. 678901234</div>
                </td>
                <td>
                    <div>1. Sarah Lee</div>
                    <div>2. Chris Johnson</div>
                </td>
                <td>08765432109</td>
                <td>SMK N 3 Sleman</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal3.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="3">
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>
                    <div>1. 789012345</div>
                    <div>2. 890123456</div>
                </td>
                <td>
                    <div>1. Daniel White</div>
                    <div>2. Anna Taylor</div>
                </td>
                <td>08212345678</td>
                <td>SMK N 4 Kulon Progo</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal4.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="4">
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>
                    <div>1. 901234567</div>
                    <div>2. 012345678</div>
                </td>
                <td>
                    <div>1. Olivia Moore</div>
                    <div>2. Ethan Wilson</div>
                </td>
                <td>08321234567</td>
                <td>SMK N 5 Gunungkidul</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal5.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="5">
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>
                    <div>1. 234567890</div>
                    <div>2. 345678901</div>
                </td>
                <td>
                    <div>1. Isabella Martinez</div>
                    <div>2. Liam Anderson</div>
                </td>
                <td>08431234567</td>
                <td>SMK N 6 Bantul</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal6.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="6">
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>
                    <div>1. 456789012</div>
                    <div>2. 567890123</div>
                </td>
                <td>
                    <div>1. Sophia Thompson</div>
                    <div>2. Noah Rodriguez</div>
                </td>
                <td>08541234567</td>
                <td>SMK N 7 Wates</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal7.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="7">
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>
                    <div>1. 678901234</div>
                    <div>2. 789012345</div>
                </td>
                <td>
                    <div>1. Mia Martinez</div>
                    <div>2. Lucas Gonzalez</div>
                </td>
                <td>08651234567</td>
                <td>SMK N 8 Yogyakarta</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal8.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="8">
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>
                    <div>1. 890123456</div>
                    <div>2. 901234567</div>
                </td>
                <td>
                    <div>1. Amelia Clark</div>
                    <div>2. Mason Walker</div>
                </td>
                <td>08761234567</td>
                <td>SMK N 9 Sleman</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal9.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="9">
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td>
                    <div>1. 012345678</div>
                    <div>2. 123456789</div>
                </td>
                <td>
                    <div>1. Harper Lewis</div>
                    <div>2. James Hill</div>
                </td>
                <td>08871234567</td>
                <td>SMK N 10 Kulon Progo</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal10.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="10">
                </td>
            </tr>
             <tr>
        <td>11</td>
        <td>
            <div>1. 234567890</div>
            <div>2. 345678901</div>
        </td>
        <td>
            <div>1. Lily Adams</div>
            <div>2. Oliver King</div>
        </td>
        <td>08912345678</td>
        <td>SMK N 11 Bantul</td>
        <td class="text-center">
            <a href="{{ asset('storage/proposals/sample-proposal11.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
        </td>
        <td class="text-center">
            <input type="checkbox" name="check[]" value="11">
        </td>
    </tr>
    <tr>
        <td>12</td>
        <td>
            <div>1. 345678901</div>
            <div>2. 456789012</div>
        </td>
        <td>
            <div>1. Henry Scott</div>
            <div>2. Ava Davis</div>
        </td>
        <td>08812345678</td>
        <td>SMK N 12 Yogyakarta</td>
        <td class="text-center">
            <a href="{{ asset('storage/proposals/sample-proposal12.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
        </td>
        <td class="text-center">
            <input type="checkbox" name="check[]" value="12">
        </td>
    </tr>
    <tr>
        <td>13</td>
        <td>
            <div>1. 456789012</div>
            <div>2. 567890123</div>
        </td>
        <td>
            <div>1. Amelia Green</div>
            <div>2. Logan Harris</div>
        </td>
        <td>08712345678</td>
        <td>SMK N 13 Sleman</td>
        <td class="text-center">
            <a href="{{ asset('storage/proposals/sample-proposal13.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
        </td>
        <td class="text-center">
            <input type="checkbox" name="check[]" value="13">
        </td>
    </tr>
    <tr>
        <td>14</td>
        <td>
            <div>1. 567890123</div>
            <div>2. 678901234</div>
        </td>
        <td>
            <div>1. Mason Carter</div>
            <div>2. Mia Edwards</div>
        </td>
        <td>08612345678</td>
        <td>SMK N 14 Gunungkidul</td>
        <td class="text-center">
            <a href="{{ asset('storage/proposals/sample-proposal14.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
        </td>
        <td class="text-center">
            <input type="checkbox" name="check[]" value="14">
        </td>
    </tr>
    <tr>
        <td>15</td>
        <td>
            <div>1. 678901234</div>
            <div>2. 789012345</div>
        </td>
        <td>
            <div>1. Lucas White</div>
            <div>2. Charlotte Lewis</div>
        </td>
        <td>08512345678</td>
        <td>SMK N 15 Wates</td>
        <td class="text-center">
            <a href="{{ asset('storage/proposals/sample-proposal15.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
        </td>
        <td class="text-center">
            <input type="checkbox" name="check[]" value="15">
        </td>
    </tr>
        </tbody>
        
    </table>

    <br>
    <br>

    <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
        <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
        <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
            <!-- Angka halaman akan diisi dengan JavaScript -->
        </div>
        <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
    </div>
  
</div>

<br>
<br>
<br>
<br>
<br>

@include('layouts.footer')
@endsection