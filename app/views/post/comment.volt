<h2>Коментувати запис</h2>

<p>{{ content() }}</p>

<form method="post">

    <p>
        <label for="name">Title</label>
        {{ post.getTitle() }}
    </p>

    <p>
        <label for="email">Content</label>
        {{ post.getContent() }}
    </p>

</form>
Коментарі
<p>
    <label for="name">Title</label>
    {% for comment in comments %}
    {{ comment.getContent() }}
    {% endfor %}

</p>
