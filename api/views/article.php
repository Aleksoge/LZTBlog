<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 id="title"></h1>
        </div>
        <div class="card-body">
            <div class="fr-view" id="description"></div>
        </div>
        <div class="card-footer">
            <p>Автор: <span id="author"></span></p>
        </div>
    </div>
</div>
<?php if(isset($item_id)) { ?> 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getArticle(<?= $item_id ?>).then(articles => {
            document.getElementById("title").innerHTML = articles[0].title;
            document.getElementById("author").innerHTML = articles[0].author;
            document.getElementById("description").innerHTML = articles[0].description;
        })
        .catch(error => {
            console.log("Ошибка при получении статьи: ", error);
        });
    });
</script>
<?php } ?>