<div class="container">
    <div class="articles-grid my-1" id="articles_container"></div>
    <div class="pagination_controls" id="pagination_controls">
        <button id="prev_page" class="btn btn-main" onclick="changePage(-1)">«</button>
        <span id="current_page">1</span>
        <button id="next_page" class="btn btn-main" onclick="changePage(1)">»</button>
    </div>
</div>
<script id="article_template" type="text/x-handlebars-template">
  {{#each articles}}
    <article class="article" onclick="location.href='/article/{{this.id}}';">
        <div class="article-content">
            <h1 class="my-1">{{this.title}}</h1>
            <div class="fr-view">
                <p>{{{this.shortdescription}}}</p>
            </div>
        </div>
        <div class="article-overlay">
            <img src="{{this.image}}" alt="{{this.title}}">
        </div>
    </article>
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