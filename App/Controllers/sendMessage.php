<?php

//require __DIR__ . '../Db.php';

//$db = Db;
$dsn = 'mysql:host=localhost;dbname=backend';
$dbh = new PDO($dsn, 'root', '');

$page = isset($_GET['p']) ? $_GET['p'] : '';
if ($page == 'insert') {
    $prise = $_POST['prise'];
    $tovar = $_POST['tovar'];
    $category = $_POST['category'];

    $sql = 'INSERT INTO product (tovar, category, prise) VALUES(:tovar, :category, :prise)';
    $sth = $dbh->prepare($sql);
    if ($sth->execute([':tovar' => $tovar, ':category' => $category, ':prise' => $prise])) {
        echo "Данные добавлены";
    } else {
        echo "Ошибка добавления";
    }
} elseif ($page == 'edit') {
    $id = $_POST['id'];
    $prise = $_POST['prise'];
    $tovar = $_POST['tovar'];
    $category = $_POST['category'];
    $sql = 'UPDATE product SET tovar=:tovar, category=:category, prise=:prise WHERE id=:id';
    $sth = $dbh->prepare($sql);
    if ($sth->execute([':tovar' => $tovar, ':category' => $category, ':prise' => $prise, ':id' => $id])) {
        echo "Данные обновлены";
    } else {
        echo "Ошибка обновления";
    }


} elseif ($page == 'del') {
    $id = $_GET['id'];
    $sql = 'DELETE FROM product WHERE id=:id';
    $sth = $dbh->prepare($sql);
    if ($sth->execute([':id' => $id])) {
        echo "Позиция удалена";
    } else {
        echo "Ошибка удаления";
    }

} else {
    $sql = 'SELECT * FROM product ORDER BY id DESC';
    $sth = $dbh->prepare($sql);
    $sth->execute();

    while ($data = $sth->fetchAll()) {
        ?>
        <tr>
        <?php foreach ($data as $item): ?>
            <td><?php echo $item['id'] ?></td>
            <td><?php echo $item['tovar'] ?></td>
            <td><?php echo $item['category'] ?></td>
            <td><?php echo $item['prise'] ?></td>
            <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#edit-<?php echo $item['id'] ?>">
                    Редактировать
                </button>
                <!-- Modal -->
                <div class="modal fade" id="edit-<?php echo $item['id'] ?>" tabindex="-1" role="dialog"
                     aria-labelledby="editLabel-<?php echo $item['id'] ?>">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>

                                <h4 class="modal-title" id="editLabel-<?php echo $item['id'] ?>">Редактировать
                                    данные</h4>
                            </div>
                            <form>
                                <div class="modal-body">

                                    <input type="hidden" id="<?php echo $item['id'] ?>"
                                           value="<?php echo $item['id'] ?>">

                                    <div class="form-group">
                                        <label for="tovar">Наименование товара</label>
                                        <input type="text" class="form-control" id="tovar-<?php echo $item['id'] ?>"
                                               value="<?php echo $item['tovar'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Категория товара</label>
                                        <select class="form-control" id="category-<?php echo $item['id'] ?>">
                                            <option selected disabled>Выберите категорию</option>
                                            <option>Ноутбуки</option>
                                            <option>Смартфоны</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="prise">Цена товара (руб.)</label>
                                        <input type="number" class="form-control" id="prise-<?php echo $item['id'] ?>"
                                               value="<?php echo $item['prise'] ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                    <button type="submit" onclick="updateData(<?php echo $item['id'] ?>)"
                                            class="btn btn-primary">Обновить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <button onclick="deleteData(<?php echo $item['id'] ?>)" class="btn btn-danger">Удалить</button>
            </td>

            </tr>
        <?php endforeach; ?>

        <?php

    }

}
