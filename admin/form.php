<form name="form1" method="post" action="add_lesson.php">
  <p><label>Введите название урока
    <br><input type="text" name="title" id="title" size="60" required>
    </label>
  </p>
  <p><label>Введите описание урока
    <br><input type="text" name="meta_d" id="meta_d" size="60" required>
    </label>
  </p>
  <p><label>Введите ключевые слова
    <br><input type="text" name="meta_k" id="meta_k" size="60" required>
    </label>
  </p>
  <p><label>Введите дату добавления урока
    <br><input type="text" name="date" id="date"
    value="">
  </label>
  </p>
  <p><label>Введите краткое описание урока с тэгами
    <textarea type="text" name="description" id="description"
    cols="60" rows="5" required></textarea>
    </label>
  </p>
  <p><label>Введите содержание урока урока с тэгами
    <textarea type="text" name="text" id="text" cols="60"
    rows="20" required></textarea>
    </label>
  </p>
  <p><label>Введите автора урока
    <br><input type="text" name="author" id="author" size="50" required>
    </label>
  </p>
  <p><label>
    <input type="submit" value="Добавить" id="submit">
  </label>
  </p>
</form>
