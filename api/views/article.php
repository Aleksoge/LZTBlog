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

    <div class="comments-container" id="comments-container"></div>
    <script id="comment_template" type="text/x-handlebars-template">
        {{#each comments}}
        <div class="comment">
            <div class="card">
                <div class="card-header">
                    <div class="comment-author">
                        <img src="https://robohash.org/{{this.name}}">
                        <h3>{{this.name}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <p>{{this.comment}}</p>
                </div>
            </div>
        </div>
        {{/each}}
    </script>
    <?php if(isset($_SESSION['user'])): ?>  
        <div class="add-comment">
            <div class="card">
                <div class="card-header">
                    <h2>Оставить комментарий</h2>
                </div>
                <div class="card-body"> 
                    <form action="#" method="POST" id="add_comment">
                        <?php set_csrf(); ?>
                        <div class="form-field">
                            <textarea rows="5" name="comment" id="comment" class="text-field" placeholder="Ваш комментрий"></textarea>
                        </div>
                        <button type="submit" class="btn btn-main w-100" id="share_comment">Поделиться мнением</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
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
        loadComments(<?= $item_id ?>);
    });
</script>
<?php } ?>

<script>
    document.getElementById('add_comment').addEventListener('submit', function(event) {
        addComment(event, '/api/comments/<?= (int)$item_id ?>', '#');
    });
</script>