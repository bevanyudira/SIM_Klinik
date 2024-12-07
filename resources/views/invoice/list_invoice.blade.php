@extends('layout.app')
@section('title', 'List Invoice')
@section('content')
    <div class="flex flex-col justify-between px-8">
        <h1 class="text-lg font-bold">List Invoice</h1>
        <h1 style="font-size: 0.9rem">Jumlah Pasien : 49,000 Jumlah Dokter : 12</h1>
    </div>

    <!-- Input Pencarian dan Filter -->
    <div class="flex p-4 m-4 border-2 rounded-xl">
        <div class="relative w-full p-4 overflow-x-auto border-none sm:rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <!-- Pencarian -->
                <div class="relative w-full max-w-xs">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari..."
                        class="w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5054 10.203C12.3645 9.16492 12.8809 7.83273 12.8809 6.37994C12.8809 3.06624 10.1946 0.379944 6.88086 0.379944C3.56715 0.379944 0.880859 3.06624 0.880859 6.37994C0.880859 9.69365 3.56715 12.3799 6.88086 12.3799C8.33367 12.3799 9.66587 11.8636 10.704 11.0044L13.1468 13.4473C13.3681 13.6686 13.7269 13.6686 13.9482 13.4473C14.1695 13.226 14.1695 12.8672 13.9482 12.6459L11.5054 10.203ZM6.88086 11.2679C4.1813 11.2679 1.99288 9.0795 1.99288 6.37994C1.99288 3.68039 4.1813 1.49197 6.88086 1.49197C9.58041 1.49197 11.7688 3.68039 11.7688 6.37994C11.7688 9.0795 9.58041 11.2679 6.88086 11.2679Z" fill="#99A1B7"/>
                        </svg>
                    </div>
                </div>

                <!-- Filter -->
                <div class="relative inline-block">
                    <!-- Tombol yang diklik -->
                    <button id="filterButton" onclick="toggleDropdown()"
                        class="flex items-center px-3 py-2 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 hover:bg-blue-100">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 2a2 2 0 00-2 2v2a2 2 0 00.586 1.414L9 13.414V18a2 2 0 002 2h2a2 2 0 002-2v-4.586l4.414-6A2 2 0 0016 4V2a2 2 0 00-2-2H6z">
                            </path>
                        </svg>
                        <span id="filterText">Filters</span>
                    </button>
                    <div id="dropdown"
                        class="absolute right-0 z-10 hidden w-48 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg">
                        <ul id="dropdownOptions" class="py-2 text-sm text-gray-700">
                            <li><button onclick="selectOption('Today')"
                                    class="block w-full px-4 py-2 text-left hover:bg-gray-100">Today</button></li>
                            <li><button onclick="selectOption('Yesterday')"
                                    class="block w-full px-4 py-2 text-left hover:bg-gray-100">Yesterday</button></li>
                            <li><button onclick="selectOption('7 Hari yang Lalu')"
                                    class="block w-full px-4 py-2 text-left hover:bg-gray-100">7 Hari yang Lalu</button>
                            </li>
                            <li><button onclick="selectOption('Bulan Lalu')"
                                    class="block w-full px-4 py-2 text-left hover:bg-gray-100">Bulan Lalu</button></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400" id="dataTable">
                    <thead class="text-gray-500 bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">ID</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">No. RM</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">Pasien</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">Owner</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">No Telp</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">Total</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">Status</th>
                            <th scope="col" class="px-6 py-3 text-center border-r border-gray-100"
                                style="font-size: 0.81rem">Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-semibold border-r border-gray-100" style="font-size: 0.8rem">INV-1
                            </td>
                            <td class="px-6 py-4 font-semibold text-center border-r border-gray-100"
                                style="font-size: 0.8rem">29/05/2024</td>
                            <td class="px-6 py-4 font-semibold border-r border-gray-100 " style="font-size: 0.8rem">1</td>
                            <td class="px-6 py-4 border-r border-gray-100" style="font-size: 0.8rem">
                                <a href="#" class="font-semibold underline text-[#036CA1]">Garaga</a>
                                <p style="font-size: 0.8em" >Ular</p>
                            </td>
                            <td class="px-6 py-4 text-center border-r border-gray-100 text-[#036CA1] underline" style="font-size: 0.8rem">
                                <a href="#">Yoga</a></td>
                            <td class="px-6 py-4 text-center border-r border-gray-100" style="font-size: 0.8rem">
                                087799007654</td>
                            <td class="px-6 py-4 border-r border-gray-100" style="font-size: 0.8rem">Rp
                                150.000,00</td>
                            <td class="px-6 py-4 text-center border-r border-gray-100">
                                <div class="flex items-center w-[115px] py-2 pl-2 space-x-2 border border-pink-200 rounded-full bg-pink-50"
                                    style="font-size: 0.8rem">
                                    <span class="w-1.5 h-1.5 bg-pink-500 rounded-full"></span>
                                    <span class="font-semibold text-pink-600">Belum Lunas</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center border-r border-gray-100">
                                <x-link 
                                    data-modal-target="detail-invoice" 
                                    data-modal-toggle="detail-invoice"
                                    color="blue"
                                    class="transition-all duration-200 ease-in-out transform rounded-lg shadow-lg focus:outline-none hover:scale-105 hover:shadow-xl"
                                    href="#">
                                    <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7025 14.3886H3.59136C2.86938 14.3886 2.17698 14.1018 1.66646 13.5912C1.15595 13.0807 0.869141 12.3883 0.869141 11.6663V1.51089C0.869141 0.681005 1.69047 0.15445 2.41303 0.404894C2.51673 0.440672 2.61707 0.493043 2.71403 0.562006L2.85014 0.659228C3.18121 0.894138 3.57727 1.02 3.98321 1.0193C4.38915 1.01861 4.78477 0.891384 5.11503 0.655339C5.57861 0.325417 6.13348 0.148132 6.70247 0.148132C7.27147 0.148132 7.82633 0.325417 8.28992 0.655339C8.62018 0.891384 9.0158 1.01861 9.42174 1.0193C9.82768 1.02 10.2237 0.894138 10.5548 0.659228L10.6909 0.562006C11.4633 0.00978346 12.5358 0.562005 12.5358 1.51089V7.38856H15.258C15.4127 7.38856 15.5611 7.45002 15.6705 7.55942C15.7799 7.66881 15.8414 7.81718 15.8414 7.97189V12.2497C15.8414 12.8169 15.616 13.361 15.2149 13.7621C14.8138 14.1632 14.2697 14.3886 13.7025 14.3886ZM12.7303 8.55523V12.2497C12.7303 12.5075 12.8327 12.7548 13.015 12.9371C13.1973 13.1195 13.4446 13.2219 13.7025 13.2219C13.9603 13.2219 14.2076 13.1195 14.3899 12.9371C14.5723 12.7548 14.6747 12.5075 14.6747 12.2497V8.55523H12.7303ZM9.4247 5.24967C9.4247 5.09496 9.36324 4.94659 9.25384 4.83719C9.14445 4.7278 8.99607 4.66634 8.84136 4.66634H4.1747C4.01999 4.66634 3.87161 4.7278 3.76222 4.83719C3.65282 4.94659 3.59136 5.09496 3.59136 5.24967C3.59136 5.40438 3.65282 5.55275 3.76222 5.66215C3.87161 5.77155 4.01999 5.83301 4.1747 5.83301H8.84136C8.99607 5.83301 9.14445 5.77155 9.25384 5.66215C9.36324 5.55275 9.4247 5.40438 9.4247 5.24967ZM8.64692 7.58301C8.64692 7.4283 8.58546 7.27992 8.47606 7.17053C8.36667 7.06113 8.21829 6.99967 8.06359 6.99967H4.1747C4.01999 6.99967 3.87161 7.06113 3.76222 7.17053C3.65282 7.27992 3.59136 7.4283 3.59136 7.58301C3.59136 7.73771 3.65282 7.88609 3.76222 7.99548C3.87161 8.10488 4.01999 8.16634 4.1747 8.16634H8.06359C8.21829 8.16634 8.36667 8.10488 8.47606 7.99548C8.58546 7.88609 8.64692 7.73771 8.64692 7.58301ZM8.84136 9.333C8.99607 9.333 9.14445 9.39446 9.25384 9.50386C9.36324 9.61326 9.4247 9.76163 9.4247 9.91634C9.4247 10.071 9.36324 10.2194 9.25384 10.3288C9.14445 10.4382 8.99607 10.4997 8.84136 10.4997H4.1747C4.01999 10.4997 3.87161 10.4382 3.76222 10.3288C3.65282 10.2194 3.59136 10.071 3.59136 9.91634C3.59136 9.76163 3.65282 9.61326 3.76222 9.50386C3.87161 9.39446 4.01999 9.333 4.1747 9.333H8.84136Z" fill="#F8F8F8"/>
                                    </svg>
                                </x-link>
                                
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-semibold border-r border-gray-100" style="font-size: 0.8rem">INV-2
                            </td>
                            <td class="px-6 py-4 font-semibold text-center border-r border-gray-100"
                                style="font-size: 0.8rem">11/05/2024</td>
                            <td class="px-6 py-4 font-semibold border-r border-gray-100 " style="font-size: 0.8rem">2</td>
                            <td class="px-6 py-4 border-r border-gray-100" style="font-size: 0.8rem">
                                <a href="#" class="font-semibold underline text-[#036CA1]">Molmo</a>
                                <p style="font-size: 0.8em">Anjing</p>
                            </td>
                            <td class="px-6 py-4 text-center border-r border-gray-100 text-[#036CA1] underline" style="font-size: 0.8rem">
                                <a href="#">Andi</a></td>
                            <td class="px-6 py-4 text-center border-r border-gray-100" style="font-size: 0.8rem">
                                085509094343</td>
                            <td class="px-6 py-4 border-r border-gray-100" style="font-size: 0.8rem">Rp
                                50.000,00</td>
                            <td class="px-6 py-4 text-center border-r border-gray-100">
                                <div class="flex items-center w-20 py-2 pl-2 space-x-2 border border-green-200 rounded-full bg-green-50"
                                    style="font-size: 0.8rem">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    <span class="font-semibold text-green-600">Lunas</span>
                                </div>

                            </td>
                            <td class="px-6 py-4 text-center border-r border-gray-100">
                                <a href="#"
                                    class="inline-flex items-center px-2 py-2 mb-2 text-sm font-medium text-white transition-all duration-200 ease-in-out transform bg-[#036CA1] rounded-lg shadow-lg focus:outline-none hover:bg-[#036CA1]-700 hover:scale-105 hover:shadow-xl">
                                    <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7025 14.3886H3.59136C2.86938 14.3886 2.17698 14.1018 1.66646 13.5912C1.15595 13.0807 0.869141 12.3883 0.869141 11.6663V1.51089C0.869141 0.681005 1.69047 0.15445 2.41303 0.404894C2.51673 0.440672 2.61707 0.493043 2.71403 0.562006L2.85014 0.659228C3.18121 0.894138 3.57727 1.02 3.98321 1.0193C4.38915 1.01861 4.78477 0.891384 5.11503 0.655339C5.57861 0.325417 6.13348 0.148132 6.70247 0.148132C7.27147 0.148132 7.82633 0.325417 8.28992 0.655339C8.62018 0.891384 9.0158 1.01861 9.42174 1.0193C9.82768 1.02 10.2237 0.894138 10.5548 0.659228L10.6909 0.562006C11.4633 0.00978346 12.5358 0.562005 12.5358 1.51089V7.38856H15.258C15.4127 7.38856 15.5611 7.45002 15.6705 7.55942C15.7799 7.66881 15.8414 7.81718 15.8414 7.97189V12.2497C15.8414 12.8169 15.616 13.361 15.2149 13.7621C14.8138 14.1632 14.2697 14.3886 13.7025 14.3886ZM12.7303 8.55523V12.2497C12.7303 12.5075 12.8327 12.7548 13.015 12.9371C13.1973 13.1195 13.4446 13.2219 13.7025 13.2219C13.9603 13.2219 14.2076 13.1195 14.3899 12.9371C14.5723 12.7548 14.6747 12.5075 14.6747 12.2497V8.55523H12.7303ZM9.4247 5.24967C9.4247 5.09496 9.36324 4.94659 9.25384 4.83719C9.14445 4.7278 8.99607 4.66634 8.84136 4.66634H4.1747C4.01999 4.66634 3.87161 4.7278 3.76222 4.83719C3.65282 4.94659 3.59136 5.09496 3.59136 5.24967C3.59136 5.40438 3.65282 5.55275 3.76222 5.66215C3.87161 5.77155 4.01999 5.83301 4.1747 5.83301H8.84136C8.99607 5.83301 9.14445 5.77155 9.25384 5.66215C9.36324 5.55275 9.4247 5.40438 9.4247 5.24967ZM8.64692 7.58301C8.64692 7.4283 8.58546 7.27992 8.47606 7.17053C8.36667 7.06113 8.21829 6.99967 8.06359 6.99967H4.1747C4.01999 6.99967 3.87161 7.06113 3.76222 7.17053C3.65282 7.27992 3.59136 7.4283 3.59136 7.58301C3.59136 7.73771 3.65282 7.88609 3.76222 7.99548C3.87161 8.10488 4.01999 8.16634 4.1747 8.16634H8.06359C8.21829 8.16634 8.36667 8.10488 8.47606 7.99548C8.58546 7.88609 8.64692 7.73771 8.64692 7.58301ZM8.84136 9.333C8.99607 9.333 9.14445 9.39446 9.25384 9.50386C9.36324 9.61326 9.4247 9.76163 9.4247 9.91634C9.4247 10.071 9.36324 10.2194 9.25384 10.3288C9.14445 10.4382 8.99607 10.4997 8.84136 10.4997H4.1747C4.01999 10.4997 3.87161 10.4382 3.76222 10.3288C3.65282 10.2194 3.59136 10.071 3.59136 9.91634C3.59136 9.76163 3.65282 9.61326 3.76222 9.50386C3.87161 9.39446 4.01999 9.333 4.1747 9.333H8.84136Z" fill="#F8F8F8"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <x-pop-up id="detail-invoice" header="Detail Invoice" class="hidden">
                @include('invoice.detail_invoice')
            </x-pop-up>

            <!-- Pagination with Rows Per Page Selector -->
            {{-- <div class="flex items-center justify-between mt-4 text-sm text-gray-700">
                <!-- Rows Per Page Selector -->
                <select id="rowsPerPage" onchange="changeRowsPerPage()"
                    class="p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select> --}}
            {{-- paginate --}}
            {{-- <div class="flex flex-row">

                    <span class="m-2">
                        {{ ($hewan->currentPage() - 1) * $hewan->perPage() + 1 }} -
                        {{ min($hewan->currentPage() * $hewan->perPage(), $hewan->total()) }}
                        dari {{ $hewan->total() }}
                    </span>

                    <div class="flex items-center">
                        <!-- Tombol Sebelumnya -->
                        <button
                            class="px-2 py-1 mx-1 text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-100 disabled:text-gray-300 disabled:cursor-not-allowed"
                            @if ($hewan->onFirstPage()) disabled @endif
                            onclick="window.location='{{ $hewan->previousPageUrl() }}'">
                            &lt;
                        </button>

                        <!-- Nomor Halaman -->
                        @foreach (range(1, $hewan->lastPage()) as $page)
                            @if ($page == $hewan->currentPage())
                                <button class="px-3 py-1 mx-1 text-white bg-blue-600 border border-blue-600 rounded">
                                    {{ $page }}
                                </button>
                            @else
                                <button
                                    class="px-3 py-1 mx-1 text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100"
                                    onclick="window.location='{{ $hewan->url($page) }}'">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach

                        <!-- Tombol Berikutnya -->
                        <button
                            class="px-2 py-1 mx-1 text-gray-500 bg-white border border-gray-300 rounded hover:bg-gray-100 disabled:text-gray-300 disabled:cursor-not-allowed"
                            @if (!$hewan->hasMorePages()) disabled @endif
                            onclick="window.location='{{ $hewan->nextPageUrl() }}'">
                            &gt;
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}


            {{-- <script>
            function changeRowsPerPage() {
                const rows = document.getElementById("rowsPerPage").value;
                const url = new URL(window.location.href);
                url.searchParams.set('rows', rows);
                window.location.href = url.toString(); // Redirect ke URL dengan parameter baru
            }

            // Menjaga pilihan tetap terlihat setelah halaman di-reload
            window.onload = function() {
                const urlParams = new URLSearchParams(window.location.search);
                const rowsParam = urlParams.get('rows');
                if (rowsParam) {
                    document.getElementById("rowsPerPage").value = rowsParam;
                }
            };
        </script> --}}


            <!-- JavaScript untuk Fitur Pencarian -->
            <script>
                function searchTable() {
                    const input = document.getElementById("searchInput").value.toLowerCase();
                    const table = document.getElementById("dataTable");
                    const tr = table.getElementsByTagName("tr");

                    for (let i = 1; i < tr.length; i++) {
                        const tdArray = tr[i].getElementsByTagName("td");
                        let found = false;

                        for (let j = 0; j < tdArray.length; j++) {
                            if (tdArray[j] && tdArray[j].textContent.toLowerCase().includes(input)) {
                                found = true;
                                break;
                            }
                        }
                        tr[i].style.display = found ? "" : "none";
                    }
                }
            </script>

            {{-- Tampilan Filter --}}
            <script>
                let currentOption = null;

                function toggleDropdown() {
                    const dropdown = document.getElementById('dropdown');
                    dropdown.classList.toggle('hidden');
                }

                function selectOption(optionText) {
                    currentOption = optionText;
                    const filterText = document.getElementById('filterText');
                    filterText.textContent = optionText;

                    updateDropdownOptions();
                    const dropdown = document.getElementById('dropdown');
                    dropdown.classList.add('hidden');
                }

                function updateDropdownOptions() {
                    const options = ['Today', 'Yesterday', '7 Hari yang Lalu', 'Bulan Lalu'];
                    const dropdownOptions = document.getElementById('dropdownOptions');
                    dropdownOptions.innerHTML = '';

                    // Masukkan "Hapus Filter" di urutan pertama jika ada opsi yang dipilih
                    if (currentOption) {
                        dropdownOptions.innerHTML += `
            <li><button onclick="clearFilter()" class="block w-full px-4 py-2 text-left hover:bg-gray-100">Hapus Filter</button></li>
            `;
                    }

                    // Tambahkan opsi yang lain, kecuali opsi yang dipilih sebelumnya
                    options.forEach(option => {
                        if (option !== currentOption) {
                            dropdownOptions.innerHTML += `
                <li><button onclick="selectOption('${option}')" class="block w-full px-4 py-2 text-left hover:bg-gray-100">${option}</button></li>
                `;
                        }
                    });
                }

                function clearFilter() {
                    currentOption = null;
                    const filterText = document.getElementById('filterText');
                    filterText.textContent = 'Filters';
                    updateDropdownOptions();

                    const dropdown = document.getElementById('dropdown');
                    dropdown.classList.add('hidden');
                }
            </script>
        @endsection
