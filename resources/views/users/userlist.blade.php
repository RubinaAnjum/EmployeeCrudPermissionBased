<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-fixed hover:table-fixed border-collapse w-full text-sm">
                        <thead class="text-left">
                            <tr class="border-y-2 border-white">
                                <th class="p-2">Name</th>
                                <th class="p-2">Email</th>
                                <th class="p-2">Building No</th>
                                <th class="p-2">Street</th>
                                <th class="p-2">City</th>
                                <th class="p-2">State</th>
                                <th class="p-2">Pincode</th>
                                <th class="p-2">Country</th>
                                @can(['users.update', 'users.delete'])
                                <th class="p-2">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody id='userData' class="text-left">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            getAllUser();

            
        });

        function getAllUser() {
                var updateUrl = "{{ url('user_detail') }}";
                $.ajax({
                    type: 'get',
                    url: '/user_detail',
                    success: function(response) {
                        data = response;
                        var tbody = document.getElementById("userData");
                        tbody.innerHTML = "";
                        for (var i = 0; i < data.length; i++) {
                            var row = tbody.insertRow(i);

                            var dynamicUrl = updateUrl + '/' + data[i]['id'];
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            var cell7 = row.insertCell(6);
                            var cell8 = row.insertCell(7);
                            @can(['users.update', 'users.delete'])
                            var cell9 = row.insertCell(8);
                            @endcan

                            cell1.classList.add('p-3');
                            cell2.classList.add('p-3');
                            cell3.classList.add('p-3');
                            cell4.classList.add('p-3');
                            cell5.classList.add('p-3');
                            cell6.classList.add('p-3');
                            cell7.classList.add('p-3');
                            cell8.classList.add('p-3');
                            @can(['users.update', 'users.delete'])
                            cell9.classList.add('p-3');
                            @endcan

                            cell1.innerHTML = data[i].name;
                            cell2.innerHTML = data[i].email;
                            cell3.innerHTML = data[i].user_details.building_no;
                            cell4.innerHTML = data[i].user_details.street_name;
                            cell5.innerHTML = data[i].user_details.city;
                            cell6.innerHTML = data[i].user_details.state;
                            cell7.innerHTML = data[i].user_details.pincode;
                            cell8.innerHTML = data[i].user_details.country;
                            @can(['users.update', 'users.delete'])
                            cell9.innerHTML = "<a href='" + dynamicUrl +
                                "'  class='btn btn-sm btn-primary mb-2 bg-cyan-500 text-white rounded-full shadow-sm px-2'>Update</a> <button class='btn btn-sm btn-danger  bg-red-500 text-white rounded-full shadow-sm px-2' onClick='deleteUser(" +
                                data[i]['id'] + ")'>Delete</button>";
                            @endcan
                        }
                    }
                });
            }

            function deleteUser(id) {
                if (!confirm('Are u sure to delete this User ?'))
                    return;

                $.ajax({
                    type: 'DELETE',
                    url: '/user_detail/' + id,
                    // headers: {
                    //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //   },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User deleted successfully!',
                        }).then(() =>  getAllUser());
                       
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error detected while deleting user!',
                        });
                    }
                });
            }   
    </script>
</x-app-layout>