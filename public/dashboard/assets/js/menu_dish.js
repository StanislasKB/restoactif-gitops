$(document).ready(function() {
    // CSRF token setup for all AJAX requests
    console.log('bonjour tout le monde')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Create Dish
    // $('#createDishForm').on('submit', async function(e) {
    //     e.preventDefault();

    //    await $.ajax({
    //         url: 'https://restoactif.modernetsoft.net/compte/dashboard/plats/',
    //         method: 'POST',
    //         type:'POST',
    //         data: $(this).serialize(),
    //         success: async function(response) {
    //             console.log(response);
    //             alert('Dish created successfully!');
    //             await fetchDishes();
    //         },
    //         error: function(xhr) {
    //             console.log(xhr.responseText);
    //             alert('Error: ' + xhr.responseText);
    //         }
    //     });
    // });
    $('#createDishForm').on('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch('/compte/dashboard/plats/create', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }

            const result = await response.json();
            console.log(result);
            await fetchDishes();
            Toastify({
                text: 'Ajouté avec succès' ,
                duration: 3000,
                close: true,
                style: {
                    background: "green",
                  },
            }).showToast();
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
            Toastify({
                text: 'Une erreur s\'est produite ' ,
                duration: 3000,
                close: true,
                style: {
                    background: "red",
                  },
            }).showToast();
        }
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
                    text: 'Modification avec succès' ,
                    duration: 3000,
                    close: true,
                    style: {
                        background: "green",
                      },
                }).showToast();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                Toastify({
                    text: 'Erreur' ,
                    duration: 3000,
                    close: true,
                    style: {
                        background: "red",
                      },
                }).showToast();
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
                    Toastify({
                        text: 'Erreur' ,
                        duration: 3000,
                        close: true,
                        style: {
                            background: "red",
                          },
                    }).showToast();
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
                $dishSelect.append(new Option('Sélectionner le plat', ''));
                dishes.forEach(function(dish) {
                    $dishSelect.append(new Option(dish.name, dish.id));
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                Toastify({
                    text: 'Erreur' ,
                    duration: 3000,
                    close: true,
                    style: {
                        background: "red",
                      },
                }).showToast();
            }
        });
    }

    // Call fetchDishes when the page loads
    fetchDishes();



    $('#plat_selects').on('change', function() {
        var selectedDishId = $(this).val();
        var selectedDishName = $(this).find('option:selected').text();

        if (selectedDishId) {
            // Check if the dish is already in the list
            if ($('#dishList').find(`input[value="${selectedDishId}"]`).length === 0) {
                // Create new list item
                var listItem = `
                    <li class="inline-flex items-center justify-between gap-x-2 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        ${selectedDishName}
                        <input type="checkbox" value="${selectedDishId}" name="dishes[]" class="hidden" checked>
                        <button type="button" class="removeDishBtn bg-red-500 text-white rounded px-2 py-1">Remove</button>
                    </li>
                `;

                // Add the new item to the list
                $('#dishList').append(listItem);

                // Remove the selected option from the dropdown
                $(this).find(`option[value="${selectedDishId}"]`).remove();
            } else {
                Toastify({
                    text: 'Existe dejà' ,
                    duration: 3000,
                    close: true,
                    style: {
                        background: "red",
                      },
                }).showToast();
            }

            // Reset the select element
            $(this).val('');
        }
    });

    // Handle dish removal
    $('#dishList').on('click', '.removeDishBtn', function() {
        var $listItem = $(this).closest('li');
        var dishId = $listItem.find('input[type="checkbox"]').val();
        var dishName = $listItem.contents().get(0).nodeValue.trim();

        // Remove the list item
        $listItem.remove();

        // Check if the dish is already in the select options
        if ($('#plat_selects').find(`option[value="${dishId}"]`).length === 0) {
            // Add the removed dish back to the select options
            $('#plat_selects').append(new Option(dishName, dishId));
        }
    });
});
