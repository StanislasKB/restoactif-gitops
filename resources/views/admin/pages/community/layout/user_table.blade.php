<div class="card">

    <div class="p-6">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                    {{-- <div class="py-3 px-4">
                        <div class="relative max-w-xs">
                            <label for="table-with-pagination-search" class="sr-only">Search</label>
                            <input type="text" name="table-with-pagination-search" id="table-with-pagination-search" class="form-input ps-11" placeholder="Search for items">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                <svg class="h-3.5 w-3.5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" >
                                </svg>
                            </div>
                        </div>
                    </div> --}}
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    {{-- <th scope="col" class="py-3 px-4 pe-0">
                                        <div class="flex items-center h-5">
                                            <input id="table-pagination-checkbox-all" type="checkbox" class="form-checkbox rounded">
                                            <label for="table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                                        </div>
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prénom</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th> --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adresse</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $user->last_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $user->first_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">@if( $user->profil()!=null){{ $user->profil()->type }}@endif</td> --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $user->telephone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $user->address }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('vendor.pagination.user', ['paginator' => $users])
                </div>
            </div>
        </div>


    </div>
</div>
