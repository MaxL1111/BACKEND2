<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="App/templates/css/style.css">

    <title>Админка</title>

    <link href="App/templates/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>

<script type="text/javascript" src="App/templates/js/xhr.js"></script>

<body onload="viewData()">


<div class="container" id="container">
    <div class="row">
        <div id="header" class="col-sm-12">
            <h2>SHOP.RU</h2>
        </div>
    </div>


    <div class="row">
        <div id="content" class="col-sm-12">

            <p></p>
            <button class="btn btn-primary" data-toggle="modal" data-target="#insertProduct">Добавить товар</button>

            <!-- Modal -->
            <div class="modal fade" id="insertProduct" tabindex="-1" role="dialog" aria-labelledby="insertLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="insertLabel">Добавление товара в БД</h4>
                        </div>
                        <form>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="tovar">Наименование товара</label>
                                    <input type="text" class="form-control" id="tovar" placeholder="Ноутбук HP ProBook">
                                </div>

                                <div class="form-group">
                                    <label for="category">Категория товара</label>
                                    <select class="form-control" id="category">
                                        <option>Ноутбуки</option>
                                        <option>Смартфоны</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="prise">Цена товара (руб.)</label>
                                    <input type="number" class="form-control" id="prise"
                                           placeholder="90000">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                <button type="submit" onclick="saveData()" class="btn btn-primary">Добавить товар
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="result"></div>

            <p></p>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Наименование товара</th>
                    <th>Категория товара</th>
                    <th>Стоимость</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>

        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="App/templates/js/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="App/templates/js/bootstrap.min.js"></script>


</div>


</body>
</html>