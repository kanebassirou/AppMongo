
$(document).ready(function() {
    var table = $('.employee-table');
    var rows = table.find('tr').slice(1); // Exclut la première ligne d'en-tête
    var pageSize = 10; // Nombre de colonnes par page
    var currentPage = 1;

    function showPage(page) {
        rows.hide();
        var startIndex = (page - 1) * pageSize;
        var endIndex = startIndex + pageSize;
        rows.slice(startIndex, endIndex).show();
    }

    showPage(currentPage);

    $('#prevPage').click(function() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    $('#nextPage').click(function() {
        var totalPages = Math.ceil((rows.length - 1) / pageSize); // Exclut le premier élément
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // setTimeout(function() {
    //     $('#success-message').fadeOut('slow');
    // }, 5000); // 5000ms = 5s

    // // Autres actions de pagination
    // // ...

});


