<h2>Коментувати запис</h2>

<p>{{ content() }}</p>

    <p>
        <label for="name">Title</label>
        {{ post.getTitle() }}
    </p>

    <p>
        <label for="email">Content</label>
        {{ post.getContent() }}
    </p>


<form method="post">

    <p>
        <label for="email">Коментар</label>
        {{ tag.textArea("content") }}
    </p>

    <p>
        {{ tag.submitButton("Додати") }}
    </p>
    Коментарі
    <p>
        <label for="name">Коментар</label><br>
        {% for comment in comments %}
            {{ comment.getContent() }}   <br>
        {% endfor %}

    </p>

</form>

