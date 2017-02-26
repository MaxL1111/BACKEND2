<?php
foreach ($value as $item): ?>
    <tr>
        <td><?php echo $item->id ?></td>
        <td><?php echo $item->tovar ?></td>
        <td><?php echo $item->category ?></td>
        <td><?php echo $item->prise ?></td>

        <td>
            <button class="btn btn-warning" data-toggle="modal" data-target="#edit-<?php echo $item->id ?>">
                Редактировать
            </button>
            <!-- Modal -->
            <div class="modal fade" id="edit-<?php echo $item->id ?>" tabindex="-1" role="dialog"
                 aria-labelledby="editLabel-<?php echo $item->id ?>">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="editLabel-<?php echo $item->id ?>">Редактировать
                                данные</h4>
                        </div>
                        <form>
                            <div class="modal-body">

                                <input type="hidden" id="<?php echo $item->id ?>"
                                       value="<?php echo $item->id ?>">

                                <div class="form-group">
                                    <label for="tovar">Наименование товара</label>
                                    <input type="text" class="form-control" id="tovar-<?php echo $item->id ?>"
                                           value="<?php echo $item->tovar ?>">
                                </div>

                                <div class="form-group">
                                    <label for="category">Категория товара</label>
                                    <select class="form-control" id="category-<?php echo $item->id ?>">
                                        <option>Ноутбуки</option>
                                        <option>Смартфоны</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="prise">Цена товара (руб.)</label>
                                    <input type="number" class="form-control" id="prise-<?php echo $item->id ?>"
                                           value="<?php echo $item->prise ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                <button type="submit" onclick="updateData(<?php echo $item->id ?>)"
                                        class="btn btn-primary">Обновить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <button onclick="deleteData(<?php echo $item->id ?>)" class="btn btn-danger">Удалить</button>
        </td>
    </tr>
<?php endforeach; ?>

