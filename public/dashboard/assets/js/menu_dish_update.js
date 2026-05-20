$(document).ready(function() {
    // CSRF token setup for all AJAX requests
    console.log('bonjour tout le monde')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Create Dish
    $('#createDishForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/compte/dashboard/plats/create',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log(response);
                Toastify({
                    text: 'Ajouté avec succès' ,
                    duration: 3000,
                    close: true,
                    style: {
                        background: "green",
                      },
                }).showToast();
                fetchDishes();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });

    // Update Dish
    $('#updateDishForm').on('submit', function(e) {
        e.preventDefault();

        let dishId = $(this).data('id');

        $.ajax({
            url: '/compte/dashboard/plats/' + dishId,
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                console.log(response);
                Toastify({
                    text: 'Ajouté avec succès' ,
                    duration: 3000,
                    close: true,
                    style: {
                        background: "green",
                      },
                }).showToast();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });

    // Delete Dish
    $('.deleteDishBtn').on('click', function() {
        let dishId = $(this).data('id');

        if (confirm('Êtes-vous sûr de vouloir supprimer ce plat ?')) {
            $.ajax({
                url: '/compte/dashboard/plats/' + dishId,
                method: 'DELETE',
                success: function(response) {
                    console.log(response);
                    Toastify({
                        text: 'Supprimé avec succès' ,
                        duration: 3000,
                        close: true,
                        style: {
                            background: "green",
                          },
                    }).showToast();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error: ' + xhr.responseText);
                }
            });
        }
    });





    function fetchDishes() {
        $.ajax({
            url: '/compte/dashboard/plats/', // Assurez-vous que cette route est correcte
            method: 'GET',
            success: function(response) {
                var dishes = response.dishes;
                var $dishSelect = $('#plat_selects'); // Assurez-vous que cet ID correspond à votre <select>
                $dishSelect.empty(); // Vider le select avant de le remplir
                $dishSelect.append(new Option('Select a Dish', ''));
                dishes.forEach(function(dish) {
                    $dishSelect.append(new Option(dish.name, dish.id));
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    }
    function fetchMenuDishes() {
        var menu_id=$('#menu_id').val();
        console.log('menu_id',menu_id);
        $.ajax({
            url: '/compte/dashboard/menus/'+menu_id+'/plats', // Assurez-vous que cette route est correcte
            method: 'GET',
            success: function(response) {
                var dishes = response.dishes;
                console.log('menus',dishes)
                var $dishList = $('#dishList'); // Assurez-vous que cet ID correspond à votre <select>
                $dishList.empty(); // Vider le select avant de le remplir

                dishes.forEach(function(dish) {
                    var listItem = `
                    <li class="inline-flex items-center justify-between gap-x-2 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        ${dish.name}
                        <input type="checkbox" value="${dish.id}" name="dishes[]" class="hidden" checked>
                        <button type="button" class="removeDishBtn bg-red-500 text-white rounded px-2 py-1">Supprimer</button>
                    </li>
                `;

                // Add the new item to the list
                $dishList.append(listItem);
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    }

    // Call fetchDishes when the page loads
    fetchDishes();



    $('#plat_selects').on('change', function() {
        var selectedDishId = $(this).val();
        var menu_id = $('#menu_id').val();
        var selectedDishName = $(this).find('option:selected').text();

        if (selectedDishId) {
            // Check if the dish is already in the list
            $.ajax({
                url: '/compte/dashboard/menus/'+menu_id+'/add-plat',
                method: 'POST',
                data: {
                    dish:selectedDishId
                },
                success: function(response) {
                    $(this).find(`option[value="${selectedDishId}"]`).remove();
                    $(this).val('');
                    fetchMenuDishes();
                    fetchDishes();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error: ' + xhr.responseText);
                }
            });

            // Reset the select element

        }
    });

    // Handle dish removal
    $('#dishList').on('click', '.removeDishBtn', function() {
        var $listItem = $(this).closest('li');
        var dishId = $listItem.find('input[type="checkbox"]').val();
        var dishName = $listItem.contents().get(0).nodeValue.trim();
        var menu_id = $('#menu_id').val();

        // Remove the list item

        if (dishId!=undefined && confirm('Are you sure you want to delete this dish?')) {
            $.ajax({
                url: '/compte/dashboard/menus/'+menu_id+'/delete-plat/'+dishId,
                method: 'DELETE',
                success: function(response) {
                    fetchMenuDishes();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error: ' + xhr.responseText);
                }
            });
        }

        // Check if the dish is already in the select options
        if ($('#plat_selects').find(`option[value="${dishId}"]`).length === 0) {
            // Add the removed dish back to the select options
            $('#plat_selects').append(new Option(dishName, dishId));
        }
    });
});
