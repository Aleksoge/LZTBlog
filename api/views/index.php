<div class="container">
    <div class="articles-grid my-1" id="articles_container"></div>
    <div id="pagination_controls">
        <button id="prev_page" onclick="changePage(-1)">Предыдущая</button>
        <span id="current_page">1</span>
        <button id="next_page" onclick="changePage(1)">Следующая</button>
    </div>
</div>
<script id="article_template" type="text/x-handlebars-template">
  {{#each articles}}
    <article class="article">
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

document.addEventListener('DOMContentLoaded', function() {
    loadPage(currentPage);
});

function loadPage(pageNumber) {
    getArticles(pageNumber).then(articles => {
        const templateSource = document.getElementById('article_template').innerHTML;
        const template = Handlebars.compile(templateSource);
        const output = template({ articles: articles });  
        document.getElementById('articles_container').innerHTML = output;
        document.getElementById('current_page').textContent = pageNumber;
    })
    .catch(error => {
        console.log("Ошибка при получении статей:", error);
    });
}

function changePage(increment) {
    currentPage += increment;
    loadPage(currentPage);
}

</script>