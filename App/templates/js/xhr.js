
//функция добавления нового товара в таблицу БД
function saveData() {
    var tovar = $('#tovar').val();
    var category = $('#category').val();
    var prise = $('#prise').val();
    $.ajax({
        type: "POST",
        url: "index.php?ctrl=Admin&act=InsertOne",
        data: "tovar=" + tovar + "&category=" + category + "&prise=" + prise,
        success: function (data) {
            viewData();
        }

    });
}


//функция вывода всех записей из таблицы товаров
function viewData() {
    $.ajax({
        type: "GET",
        url: "index.php?ctrl=Admin&act=All",
        success: function (data) {
            $('tbody').html(data);
        }
    });
}

//функция редактирования существующей позиции товара в таблице
function updateData(str) {
    var id = str;
    var tovar = $('#tovar-' + str).val();
    var category = $('#category-' + str).val();
    var prise = $('#prise-' + str).val();
    $.ajax({
        type: "POST",
        url: "index.php?ctrl=Admin&act=EditOne",
        data: "tovar=" + tovar + "&category=" + category + "&prise=" + prise + "&id=" + id,
        success: function (data) {
            viewData();
        }
    });
}


//функция удаления позиции товара из таблицы
function deleteData(str) {
    var id = str;
    $.ajax({
        type: "GET",
        url: "index.php?ctrl=Admin&act=Delete",
        data: "id=" + id,
        success: function (data) {
            viewData();
        }
    });
}

