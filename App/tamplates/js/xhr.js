
function saveData() {
    var tovar = $('#tovar').val();
    var category = $('#category').val();
    var prise = $('#prise').val();
    $.ajax({
        type: "POST",
        url: "App/Controllers/sendMessage.php?p=insert",
        data: "tovar=" + tovar + "&category=" + category + "&prise=" + prise,
        success: function (data) {
            viewData();
        }

    });
}

function viewData() {
    $.ajax({
        type: "GET",
        url: "App/Controllers/sendMessage.php",
        success: function (data) {
            $('tbody').html(data);
        }
    });
}

function updateData(str) {
    var id = str;
    var tovar = $('#tovar-'+str).val();
    var category = $('#category-'+str).val();
    var prise = $('#prise-'+str).val();
    $.ajax({
        type: "POST",
        url: "App/Controllers/sendMessage.php?p=edit",
        data: "tovar=" + tovar + "&category=" + category + "&prise=" + prise + "&id=" + id,
        success: function (data) {
            viewData();
        }
    });
}


function deleteData(str) {
    var id = str;
    $.ajax({
        type: "GET",
        url: "App/Controllers/sendMessage.php?p=del",
        data: "id=" + id,
        success: function (data) {
            viewData();
        }
    });
}

