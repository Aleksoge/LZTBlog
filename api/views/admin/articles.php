<div class="container">
    <table class="my-1">
        <caption>Список статей</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Ссылка</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody id="articles_container"></tbody>
    </table>
    <div class="pagination_controls" id="pagination_controls">
        <button id="prev_page" class="btn btn-main" onclick="changePage(-1)">«</button>
        <span id="current_page">1</span>
        <button id="next_page" class="btn btn-main" onclick="changePage(1)">»</button>
    </div>
</div>
<script id="article_template" type="text/x-handlebars-template">
  {{#each articles}}
    <tr id="article-{{this.id}}">
        <td>{{this.id}}</td>
        <td>{{this.title}}</td>
        <td>{{this.date}}</td>
        <td><a href="/article/{{this.id}}" target="_blank">Перейти</a></td>
        <td><a href="/admin/article/{{this.id}}" class="btn btn-main" target="_blank">Редактировать</a><a href="#" class="btn btn-main mt-05" onclick="deleteArticle({{this.id}})">Удалить</a></td>
    </tr>
  {{/each}}
</script>
<script>
let currentPage = 1;
let totalPages = 1;

document.addEventListener('DOMContentLoaded', function() {
    getTotalPages().then(pages => {
        totalPages = pages[0].total_pages;
        updatePaginationControls();
        loadPage(currentPage);
    });
});
</script>
<script>
    function deleteArticle(id) {
        if(confirm('Вы уверены, что хотите удалить эту статью?')) {
            document.getElementById('article-' + id).remove();
            return sendSimpleFetchEvent("/api/articles/" + id, "delete");
        }
    }
</script>